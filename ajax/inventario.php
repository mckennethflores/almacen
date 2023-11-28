<?php
require_once "../modelos/Inventario.php";

$inventario = new Inventario();
// condicion de una sola linea
$idinventario = isset($_POST["idinventario"])? limpiarCadena($_POST["idinventario"]):"";
$productoid = isset($_POST["productoid"])? limpiarCadena($_POST["productoid"]):"";
$fecha = isset($_POST["fecha"])? limpiarCadena($_POST["fecha"]):"";
$cantidad = isset($_POST["cantidad"])? limpiarCadena($_POST["cantidad"]):"";

//op significa Operacion
switch($_GET["op"]){
    case 'guardaryeditar':

        if(empty($idinventario)){

            $rspta=$inventario->insertar($productoid,$fecha,$cantidad);
         // echo $rspta;
         echo $rspta ? "Artículo registrado" : "Artículo no se pudo registrar";
        }
        else {
            $rspta=$inventario->editar($idinventario,$productoid,$fecha,$cantidad);
            echo $rspta ? "Artículo actualizado" : "Artículo no se pudo actualizar";
        }
    break;
   
    case 'desactivar':
        $rspta=$inventario->desactivar($idinventario);
        echo $rspta ? "Artículo Desactivado" : "Artículo no se puede desactivar";
    break;
    case 'eliminar':
        $rspta=$inventario->eliminar($idinventario);
       // echo $rspta;
       echo $rspta ? "Artículo Eliminado" : "Artículo no se puede Eliminar";
    break;
    case 'activar':
        $rspta=$inventario->activar($idinventario);
        echo $rspta ? "Artículo activado" : "Artículo no se pudo activar";      
    break;
    case 'mostrar':
        $rspta=$inventario->mostrar($idinventario);
        echo json_encode($rspta);
    break;
    case 'listar':
        $rspta=$inventario->listar();
        $data = Array();
        while ($reg=$rspta->fetch_object()){
            $data[]=array(
                "0"=>$reg->idinventario,
                "1"=>$reg->productoid,
                "2"=>$reg->fecha,
                "3"=>$reg->cantidad,
                "4"=>$reg->estado
            );
            
        }
        $results= array(
            "sEcho"=>1, //info para datatables
            "iTotalRecords"=>count($data),
            "iTotalDisplayRecords"=>count($data),
            "aaData"=>$data);
        echo json_encode($results);
    break;
    case 'rpt_exactitud':
        $rspta=$inventario->rpt_exactitud();
        $data = Array();
        while ($reg=$rspta->fetch_object()){
            $data[]=array(
                "0"=>$reg->idproducto,
                "1"=>$reg->nombre_producto,
                "2"=>$reg->cantidad_stock_sistema,
                "3"=>$reg->cantidad_stock_fisico,
                "4"=>"% ".$reg->exactitud
            );
            
        }
        $results= array(
            "sEcho"=>1, //info para datatables
            "iTotalRecords"=>count($data),
            "iTotalDisplayRecords"=>count($data),
            "aaData"=>$data);
        echo json_encode($results);
    break;

    case 'rpt_kardex':
        $rspta=$inventario->rpt_kardex();
        $data = Array();
        while ($reg=$rspta->fetch_object()){
            $data[]=array(
                "0"=>$reg->idpro,
                "1"=>$reg->nom_pro,
                "2"=>$reg->fecha,
                "3"=>$reg->nombre,
                "4"=>$reg->ingreso,
                "5"=>$reg->salida,
                "6"=>$reg->saldo
            );
            
        }
        $results= array(
            "sEcho"=>1, //info para datatables
            "iTotalRecords"=>count($data),
            "iTotalDisplayRecords"=>count($data),
            "aaData"=>$data);
        echo json_encode($results);
    break;

    /* case "selectCategoria":
        require_once "../modelos/Categoria.php";
        $categoria = new Categoria();
        $rspta = $categoria->select();

        while($reg = $rspta->fetch_object())
            {
                echo '<option value=' . $reg->idcategoria . '>' .  $reg->nombre . '</option>';
            }
    break;

    case "selectMedia":
        require_once "../modelos/Media.php";
        $media = new Media();
        $rspta = $media->select();

        while($reg = $rspta->fetch_object())
            {
                echo '<option value=' . $reg->idmedia . ' data-image="' .  $reg->cod_img . '">' .  $reg->imagen . '</option>';
            }
    break;
    
    case "selectArticulo":
        require_once "../modelos/Articulo.php";
        $inventario = new Producto();
        $rspta = $inventario->selectarticulo();
            echo '<option value="0">Todos</option>';
        while($reg = $rspta->fetch_object())
            {
                echo '<option value=' . $reg->idpro . '>' .  $reg->nombre . '</option>';
            }
    break; */


}
?>