<?php
require_once "../modelos/Media.php";

$media = new Media();
// condicion de una sola linea
$idmedia = isset($_POST["idmedia"])? limpiarCadena($_POST["idmedia"]):"";
$nombre = isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]):"";
$tipo = isset($_POST["tipo"])? limpiarCadena($_POST["tipo"]):"";
$imagen = isset($_POST["imagen"])? limpiarCadena($_POST["imagen"]):"";
//op significa Operacion
switch($_GET["op"]){
    case 'guardaryeditar':


        if(!file_exists($_FILES['imagen']['tmp_name']) || !is_uploaded_file($_FILES['imagen']['tmp_name']))
        {
            $imagen =$_POST["imagenactual"];
    
        }
        else
        {
            // $ext = $extension
            $ext = explode(".", $_FILES["imagen"]["name"]);
            if($_FILES['imagen']['type'] == "image/jpg" || $_FILES['imagen']['type'] == "image/jpeg" || $_FILES['imagen']['type'] == "image/png")
            {
                $n_img = $_FILES["imagen"]["name"];
                $tipo_ = $_FILES['imagen']['type'];
                $imagen = round(microtime(true)) . '.' . end($ext);
                move_uploaded_file($_FILES["imagen"]["tmp_name"], "../files/media/" .$imagen);
            }
        }


        if(empty($idmedia)){
            $rspta=$media->insertar($imagen,$n_img,$tipo_);
            echo $rspta ? "Imagen registrada" : "Imagen no se pudo registrar";
        }
        else {
            $rspta=$media->editar($idmedia,$nombre,$tipo);
            echo $rspta ? "Imagen actualizada" : "Imagen no se pudo actualizar";
        }
    break;
    case 'desactivar':
        $rspta=$media->desactivar($idmedia);
        echo $rspta ? "Imagen Desactivada" : "Imagen no se puede desactivar";
    break;
    case 'activar':
        $rspta=$media->activar($idmedia);
        echo $rspta ? "Imagen activada" : "Imagen no se pudo activar";      
    break;
    case 'mostrar':
        $rspta=$media->mostrar($idmedia);
       // echo $rspta;
        echo json_encode($rspta);
    break;
    case 'listar':
        $rspta=$media->listar();
        $data = Array();
        while ($reg=$rspta->fetch_object()){
            $data[]=array(
                "0"=>($reg->condicion)?'<button class="btn btn-warning" onclick="mostrar('.$reg->idmedia.')"><i class="fa fa-pencil"></i></button>'.
                ' <button class="btn btn-danger" onclick="desactivar('.$reg->idmedia.')"><i class="fa fa-close"></i></button>':
                '<button class="btn btn-warning" onclick="mostrar('.$reg->idmedia.')"><i class="fa fa-pencil"></i></button>'.
                ' <button class="btn btn-primary" onclick="activar('.$reg->idmedia.')"><i class="fa fa-check"></i></button>',
                "1"=>$reg->imagen,
                "2"=>$reg->tipo,
                "3"=>($reg->condicion)?'<span class="label bg-green">Activado</span>':'<span class="label bg-red">Desactivado</span>'
            );

        }
        $results= array(
            "sEcho"=>1, //info para datatables
            "iTotalRecords"=>count($data),
            "iTotalDisplayRecords"=>count($data),
            "aaData"=>$data);
        echo json_encode($results);
    break;

}
?>