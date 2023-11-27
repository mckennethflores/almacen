import pandas as pd
from sklearn.tree import DecisionTreeClassifier
import numpy as np
import csv
import sys
import json
import mysql.connector
from datetime import datetime


def your_function(param):
    barcode = param
    almacen_data = pd.read_csv('almacen.csv')
    # almacen_data
    X = almacen_data.drop(columns=['categoria']).values  # Convertir a numpy array
    y = almacen_data['categoria'].values  # Convertir a numpy array

    model = DecisionTreeClassifier()
    model.fit(X, y)
    predictions = model.predict(np.array([[param, 1],[3100012345678, 1]]))  # Convertir 
    result = predictions.tolist()
    
    db = mysql.connector.connect(
    host="localhost",  
    user="root",  
    password="",  
    database="almacendb"  
    )

    cursor = db.cursor()

    sql = "SELECT a.idpro,a.categoriaid,a.nom_pro as nombre,m.nom_med,m.nom_med as media, a.codigobarras,c.nom_cat as categoria,a.nom_pro,a.stock_pro,a.pre_com_pro,a.pre_ven_pro,a.fec_pro, a.est_pro FROM producto a INNER JOIN categoria c ON a.categoriaid=c.idcat INNER JOIN media m ON a.mediaid=m.idmed WHERE c.nom_cat = %s ORDER BY a.idpro DESC LIMIT 1"
    value = (result[0],)  

    cursor.execute(sql, value)

    rows = cursor.fetchall()

    for row in rows:
        
        new_query_id = row[0]+1
        name_product_created_by_ml = f"Producto {new_query_id} por ML."
        #print(row[1],new_query_id)
        date_now = datetime.now()
        dateNowFormated = date_now.strftime("%Y-%m-%d")
        
        cursor = db.cursor()
        sql = "INSERT INTO producto (categoriaid,mediaid,nom_pro,stock_pro,pre_com_pro,pre_ven_pro,fec_pro,codigobarras,est_pro) VALUES (%s,'3',%s, '28', '10','15', %s,%s, '1')"
        values = (row[1], name_product_created_by_ml,dateNowFormated,barcode)
        cursor.execute(sql, values)
        db.commit()

        
    cursor.close()
    db.close()

    
    with open('output.csv', 'w', newline='') as f:
        writer = csv.writer(f)
        writer.writerow(result)
    return "MACHINE LEARNING Python --- > fila insertada"

if __name__ == "__main__":
    param = sys.argv[1]
    result = your_function(param)
    print(json.dumps(result))  # Convert array to JSON string for output

    # print(json.dumps(result))  # Convert array to JSON string for output