<?php
session_start();
require_once "../modelos/Movimiento.php";

$movimiento = new Movimiento();
// condicion de una sola linea
$idmov = isset($_POST["idmov"])? limpiarCadena($_POST["idmov"]):"";
$productoid = isset($_POST["productoid"])? limpiarCadena($_POST["productoid"]):"";
$tipomovimientoid = isset($_POST["tipomovimientoid"])? limpiarCadena($_POST["tipomovimientoid"]):"";
$cantidad = isset($_POST["cantidad"])? limpiarCadena($_POST["cantidad"]):"";
$precio = isset($_POST["precio"])? limpiarCadena($_POST["precio"]):"";
$fecha = isset($_POST["fecha"])? limpiarCadena($_POST["fecha"]):"";



//op significa Operacion
switch($_GET["op"])
{
    case 'guardaryeditar':

        if(empty($idmov))
        {
            $rspta=$movimiento->insertar($productoid,$tipomovimientoid,$cantidad,$precio,$fecha);
            // echo $rspta;
         echo $rspta ? "Artículo registrado" : "Artículo no se pudo registrar";
        }
        else
        {
            $rspta=$movimiento->editar($idmov,$productoid,$tipomovimientoid,$cantidad,$precio,$fecha);
            echo $rspta ? "Artículo actualizado" : "Artículo no se pudo actualizar";
        }
    break;

    case 'eliminar':
        $rspta=$movimiento->eliminar($idmov);
       // echo $rspta;
       echo $rspta ? "Artículo Eliminado" : "Artículo no se puede Eliminar";
    break;

    case 'mostrar':
        $rspta=$movimiento->mostrar($idmov);
        echo json_encode($rspta);
    break;
    case 'listar':
        $rspta=$movimiento->listar();
        $data = Array();
        while ($reg=$rspta->fetch_object()){
            $data[]=array(
                "0"=>'<button class="btn btn-warning" onclick="mostrar('.$reg->id.')"><i class="fa fa-eye"></i></button>'.
                ' <button class="btn btn-danger" onclick="eliminar('.$reg->id.')"><i class="fa fa-close"></i></button>',
                "1"=>$reg->producto,
                "2"=>$reg->usuario,
                "3"=>$reg->tipo,
                "4"=>$reg->cantidad,
                "5"=>$reg->precio,
                "6"=>$reg->fecha_
            );

        }
        $results= array(
            "sEcho"=>1, //info para datatables
            "iTotalRecords"=>count($data),
            "iTotalDisplayRecords"=>count($data),
            "aaData"=>$data);
        echo json_encode($results);
    break;

    case "selectProducto":
        require_once "../modelos/Producto.php";
        $producto = new Producto();
        $rspta = $producto->selectarticulo();

        while($reg = $rspta->fetch_object())
            {
                echo '<option value=' . $reg->idpro . '>' .  $reg->nom_pro . '</option>';
            }
    break;

    case 'listarTipoMovimiento':
        $rspta=$movimiento->listarTipoMovimiento();

        while($reg = $rspta->fetch_object())
            {
                echo '<option value=' . $reg->id . '>' .  $reg->nombre . '</option>';
            }
    break;
    


}
?>