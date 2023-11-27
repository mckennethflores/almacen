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
                        "1"=>$reg->producto,
                        "2"=>$reg->usuario,
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

        case 'cerradosPrimeraCita':
            $datos = $reportes->printCerradosPrimeraCita();
        break;
        case 'cerradosSegundaCita':
            $datos = $reportes->printCerradosSegundaCita();
        break;
        case 'prospeccion':
            $datos = $reportes->printProspeccion();
        break;
        case 'cerrados':
            $datos = $reportes->printCerrados();
        break;
        case 'cerradosMes':
            $datos = $reportes->printCerradosMes();
        break;
        case 'montoMes':
            $datos = $reportes->printMontoMes();
        break;
        case 'datosCerrados':
            $datos = $reportes->getDatosClientes();
            $data = array();
            $data['primera_cita'] = count($datos['primera_cita']);
            $data['segunda_cita'] = count($datos['segunda_cita']);
            $data['prospeccion'] = count($datos['prospeccion']);
            $data['cerrados_mes'] = count($datos['cerrados_mes']);
            $data['cerrados'] = count($datos['cerrados']);
            $data['monto_mes'] = $datos['monto_mes'];
            echo json_encode($data);
        break;

        case 'contratosCerrados':
            
            $fecha_inicio=$_REQUEST["fecha_inicio"];
            $fecha_fin=$_REQUEST["fecha_fin"];
            $id_eta_re=$_REQUEST["id_eta_re"];
            $id_eta_re=$_REQUEST["id_eta_re"];
            $id_usuario_re=$_REQUEST["id_usuario_re"];
            /* elseif ($id_usuario_re == null){
                echo "null";
            }else{
                echo "ninguna";
            } */
            
            

            $rspta = $reportes->contratosCerrados($fecha_inicio,$fecha_fin,$id_eta_re,$id_usuario_re);

            $data= Array();
            $moneda = 'S/ ';
            while ($reg = $rspta->fetch_object()){

                $data[]=array(
                    "0"=>$reg->nom_re,
                    "1"=>$moneda.$reg->cos_re,
                    "2"=>$reg->nom_pr .' '.$reg->ape_pr ,
                    "3"=>$reg->fec_created_at,
                    "4"=>$reg->nom_etapa,
                    "5"=>$reg->nom_us
                );
            }
            $results = array(
                "sEcho"=>1,
                "iTotalRecords"=>count($data),
                "iTotalDisplayRecords"=>count($data),
                "aaData"=>$data);
            echo json_encode($results);
        break;
}