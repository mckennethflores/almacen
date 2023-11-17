<?php
require_once "../modelos/Producto.php";

$producto = new Producto();
// condicion de una sola linea
$idpro = isset($_POST["idpro"])? limpiarCadena($_POST["idpro"]):"";
$categoriaid = isset($_POST["categoriaid"])? limpiarCadena($_POST["categoriaid"]):"";
$mediaid = isset($_POST["mediaid"])? limpiarCadena($_POST["mediaid"]):"";
$nom_pro = isset($_POST["nom_pro"])? limpiarCadena($_POST["nom_pro"]):"";
$stock_pro = isset($_POST["stock_pro"])? limpiarCadena($_POST["stock_pro"]):"";
$pre_com_pro = isset($_POST["pre_com_pro"])? limpiarCadena($_POST["pre_com_pro"]):"";
$pre_ven_pro = isset($_POST["pre_ven_pro"])? limpiarCadena($_POST["pre_ven_pro"]):"";
$fec_pro = isset($_POST["fec_pro"])? limpiarCadena($_POST["fec_pro"]):"";
$est_pro = isset($_POST["est_pro"])? limpiarCadena($_POST["est_pro"]):"";


//op significa Operacion
switch($_GET["op"]){
    case 'guardaryeditar':

        if(empty($idpro)){

            $rspta=$producto->insertar($categoriaid,$mediaid,$nom_pro,$stock_pro,$pre_com_pro,$pre_ven_pro,$fec_pro);
         // echo $rspta;
         echo $rspta ? "Artículo registrado" : "Artículo no se pudo registrar";
        }
        else {
            $rspta=$producto->editar($idpro,$categoriaid,$medidaid,$nom_pro,$stock_pro,$pre_com_pro,$pre_ven_pro,$fec_pro);
            echo $rspta ? "Artículo actualizado" : "Artículo no se pudo actualizar";
        }
    break;
    case 'desactivar':
        $rspta=$producto->desactivar($idpro);
        echo $rspta ? "Artículo Desactivado" : "Artículo no se puede desactivar";
    break;
    case 'eliminar':
        $rspta=$producto->eliminar($idpro);
       // echo $rspta;
       echo $rspta ? "Artículo Eliminado" : "Artículo no se puede Eliminar";
    break;
    case 'activar':
        $rspta=$producto->activar($idpro);
        echo $rspta ? "Artículo activado" : "Artículo no se pudo activar";      
    break;
    case 'mostrar':
        $rspta=$producto->mostrar($idpro);
        echo json_encode($rspta);
    break;
/*     case 'listar':
        $rspta=$producto->listar();
        $data = Array();
        while ($reg=$rspta->fetch_object()){
            $data[]=array(
                "0"=>$reg->codigobarras,
                "1"=>$reg->est_pro,
                "2"=>$reg->categoria
            );
            
        }
        $results= array(
            "sEcho"=>1, //info para datatables
            "iTotalRecords"=>count($data),
            "iTotalDisplayRecords"=>count($data),
            "aaData"=>$data);
        echo json_encode($results);
    break; */
    case 'listar':
        $rspta=$producto->listar();
        $data = Array();
        while ($reg=$rspta->fetch_object()){
            $data[]=array(
                "0"=>($reg->est_pro)?'<button class="btn btn-warning" onclick="mostrar('.$reg->idpro.')"><i class="fa fa-eye"></i></button>'.
                ' <button class="btn btn-alert" onclick="desactivar('.$reg->idpro.')"><i class="fa fa-close"></i></button>'.
                ' <button class="btn btn-danger" onclick="eliminar('.$reg->idpro.')"><i class="fa fa-close"></i></button>':
                '<button class="btn btn-warning" onclick="mostrar('.$reg->idpro.')"><i class="fa fa-eye"></i></button>'.
                ' <button class="btn btn-primary" onclick="activar('.$reg->idpro.')"><i class="fa fa-check"></i></button>'.
                ' <button class="btn btn-danger" onclick="eliminar('.$reg->idpro.')"><i class="fa fa-close"></i></button>',
                "1"=>$reg->nombre,
                "2"=>$reg->categoria,
                "3"=>'<img width="50" height="50" src="../files/media/'.$reg->media.'">',
                "4"=>$reg->stock_pro,
                "5"=>$reg->pre_com_pro,
                "6"=>$reg->pre_ven_pro,
                "7"=>($reg->est_pro)?'<span class="label bg-green">Activado</span>':'<span class="label bg-red">Desactivado</span>'
            );

        }
        $results= array(
            "sEcho"=>1, //info para datatables
            "iTotalRecords"=>count($data),
            "iTotalDisplayRecords"=>count($data),
            "aaData"=>$data);
        echo json_encode($results);
    break;
    case "selectCategoria":
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
        $producto = new Producto();
        $rspta = $producto->selectarticulo();
            echo '<option value="0">Todos</option>';
        while($reg = $rspta->fetch_object())
            {
                echo '<option value=' . $reg->idpro . '>' .  $reg->nombre . '</option>';
            }
    break;


}
?>