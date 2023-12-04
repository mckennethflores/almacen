import pandas as pd
import matplotlib.pyplot as plt
from statsmodels.tsa.statespace.sarimax import SARIMAX
import locale

df = pd.read_csv('c:/xampp/htdocs/almacen/ajax/mesproductos_test.csv')

# Cambia el idioma a español (puede variar dependiendo del sistema)
locale.setlocale(locale.LC_TIME, 'es_ES.UTF-8')

# Asegúrate de que 'Fecha' sea un datetime
df['fecha'] = pd.to_datetime(df['fecha'])

# Crea un diccionario para renombrar los idinsumos
idinsumo_dict = {1: "Telas", 2: "Botones", 3: "Etiquetas"}

# Renombra los idinsumos
df['idinsumo'] = df['idinsumo'].replace(idinsumo_dict)

# Crea un gráfico para cada insumo
for insumo in df['idinsumo'].unique():
    # Filtra solo para el insumo actual
    df_insumo = df[df['idinsumo'] == insumo]

    # Asegúrate de que los datos estén ordenados por fecha
    df_insumo = df_insumo.sort_values('fecha')

    # Configura 'Fecha' como el índice
    df_insumo.set_index('fecha', inplace=True)

    # Agrupa los datos por mes y suma las cantidades
    df_insumo_mes = df_insumo.resample('M').sum()

    # Crea y entrena el modelo SARIMA
    modelo = SARIMAX(df_insumo_mes['cantidad'], order=(1, 1, 1), seasonal_order=(1, 1, 1, 12))
    resultado = modelo.fit(disp=False)

    # Haz una predicción para los próximos 12 meses
    prediccion = resultado.predict(start=61, end=72)

    # Redondea las predicciones
    prediccion = prediccion.round()

    # Crea un gráfico de líneas con las predicciones
    plt.figure(figsize=(10,6))
    plt.plot(prediccion.index.strftime('%B'), prediccion, marker='o')
    plt.title(f'Predicción del año 2024 para {insumo}')
    plt.xlabel('Mes')
    plt.ylabel('Cantidad')
    plt.xticks(rotation=45)
    plt.grid(True)

    # Muestra las cantidades exactas en el gráfico
    for i, v in enumerate(prediccion):
        plt.text(i, v, int(v), ha='center', va='bottom')
    
    #guardarmos las imagenes
    # Crea un gráfico de líneas con las predicciones
    plt.figure(figsize=(10,6))
    plt.plot(prediccion.index.strftime('%B'), prediccion, marker='o')
    plt.title(f'Predicción del año 2024 para {insumo}')
    plt.xlabel('Mes')
    plt.ylabel('Cantidad')
    plt.xticks(rotation=45)
    plt.grid(True)

    # Muestra las cantidades exactas en el gráfico
    for i, v in enumerate(prediccion):
        plt.text(i, v, int(v), ha='center', va='bottom')

    # Guarda la imagen
    plt.savefig(f'c:/xampp/htdocs/almacen/files/reportes_ml/prediccion_{insumo}_2024.png')
"""     plt.show() """