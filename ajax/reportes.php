<?php
session_start();
require_once "../modelos/Reportes.php";

$reportes = new Reportes();

    switch($_GET["op"]){

        case 'movimientosfecha':
            $fecha_inicio=$_REQUEST["fecha_inicio"];
            $fecha_fin=$_REQUEST["fecha_fin"];
    
            $rspta=$reportes->movimientosfecha($fecha_inicio,$fecha_fin);
             //Vamos a declarar un array
             $data= Array();
    
             while ($reg=$rspta->fetch_object()){
                    $data[]=array(
                        "0"=>$reg->fecha,
                        "1"=>$reg->productoid,
                        "2"=>$reg->cantidad,
                        "3"=>$reg->tipo,
                        "4"=>$reg->producto,
                        "5"=>$reg->cantidad,
                        "6"=>$reg->precio
                        );
             }
             $results = array(
                 "sEcho"=>1, //Información para el datatables
                 "iTotalRecords"=>count($data), //enviamos el total registros al datatable
                 "iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
                 "aaData"=>$data);
             echo json_encode($results);
    
        break;

        case 'reporte_py':
         /*    $fecha_inicio=$_REQUEST["fecha_inicio"];
            $fecha_fin=$_REQUEST["fecha_fin"]; */
            $rspta=$reportes->reportesPy();
             //Vamos a declarar un array
            $data= Array();
            while ($reg=$rspta->fetch_object())
            {
                $data[]=array(
                    "0"=>$reg->fecha,
                    "1"=>$reg->idinsumo,
                    "2"=>$reg->cantidad
                    );
            }
             
            
             $results = array(
                 "sEcho"=>1, //Información para el datatables
                 "iTotalRecords"=>count($data), //enviamos el total registros al datatable
                 "iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
                 "aaData"=>$data);

             echo json_encode($results);
    
        break;

        case 'reporte_barcode_py':

            $rspta=$reportes->reportesBarcodePy();
            echo $rspta ? "CSV Generado" : "CSV no se pudo generar";      
    
        break;

        case 'reporte_prediccion_py':

            $rspta=$reportes->reportesPrediccionPy();
            echo $rspta ? "CSV para predicción Generado" : "CSV predicción no se pudo generar";      
    
        break;

        case 'stockdeproductos':
            $rspta=$reportes->stockdeproductos();
            $data = Array();
            $cont_items = 1;
            while ($reg=$rspta->fetch_object()){
                
                $data[]=array(
                    "0"=>$cont_items,
                    "1"=>$reg->nombre,
                    "2"=>$reg->stock_pro,
                    "3"=>$reg->pre_com_pro,
                    "4"=>$reg->pre_ven_pro
                );
                $cont_items=$cont_items+1;
            }
            $results= array(
                "sEcho"=>1, //info para datatables
                "iTotalRecords"=>count($data),
                "iTotalDisplayRecords"=>count($data),
                "aaData"=>$data);
            echo json_encode($results);
        break;
}