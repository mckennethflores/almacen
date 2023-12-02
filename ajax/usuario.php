<?php
session_start();
require_once "../modelos/Usuario.php";

$usuario = new Usuario();
// condicion de una sola linea
$idusuario = isset($_POST["idusuario"])? limpiarCadena($_POST["idusuario"]):"";
$nombre = isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]):"";
$tipo_documento = isset($_POST["tipo_documento"])? limpiarCadena($_POST["tipo_documento"]):"";
$num_documento = isset($_POST["num_documento"])? limpiarCadena($_POST["num_documento"]):"";
$direccion = isset($_POST["direccion"])? limpiarCadena($_POST["direccion"]):"";
$telefono = isset($_POST["telefono"])? limpiarCadena($_POST["telefono"]):"";
$email = isset($_POST["email"])? limpiarCadena($_POST["email"]):"";
$cargo = isset($_POST["cargo"])? limpiarCadena($_POST["cargo"]):"";
$login = isset($_POST["login"])? limpiarCadena($_POST["login"]):"";
$clave = isset($_POST["clave"])? limpiarCadena($_POST["clave"]):"";
$imagen = isset($_POST["imagen"])? limpiarCadena($_POST["imagen"]):"";
//op significa Operacion
switch($_GET["op"]){
    case 'guardaryeditar':
    // if (usuario no ha seleccionado ningun archivo o no existe ningun archivo dentro del objeto)
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
            $imagen = round(microtime(true)) . '.' . end($ext);
            move_uploaded_file($_FILES["imagen"]["tmp_name"], "../files/usuarios/" .$imagen);
        }
    }
    // Encriptando
    $clavehash=hash("SHA256",$clave);

        if(empty($idusuario)){
            $rspta=$usuario->insertar($nombre,$tipo_documento,$num_documento,$direccion,$telefono,$email,$cargo,$login,$clavehash,$imagen,$_POST['permiso']);
            echo $rspta ? "Usuario registrado" : "No se registraron con exito todos los datos del usuario";
        }
        else {
            $rspta=$usuario->editar($idusuario,$nombre,$tipo_documento,$num_documento,$direccion,$telefono,$email,$cargo,$login,$clavehash,$imagen,$_POST['permiso']);
            echo $rspta ? "Usuario actualizado" : "Usuario no se pudo actualizar";
        }
    break;
    case 'desactivar':
        $rspta=$usuario->desactivar($idusuario);
        echo $rspta ? "Usuario Desactivado" : "Usuario no se puede desactivar";
    break;
    case 'activar':
        $rspta=$usuario->activar($idusuario);
        echo $rspta ? "Usuario activado" : "Usuario no se pudo activar";      
    break;
    case 'mostrar':
        $rspta=$usuario->mostrar($idusuario);
        echo json_encode($rspta);
    break;
    case 'listar':
        $rspta=$usuario->listar();
        $data = Array();
        while ($reg=$rspta->fetch_object()){
            $data[]=array(
                "0"=>($reg->condicion)?'<button class="btn btn-warning" onclick="mostrar('.$reg->idusuario.')"><i class="fa fa-pencil"></i></button>'.
                ' <button class="btn btn-danger" onclick="desactivar('.$reg->idusuario.')"><i class="fa fa-close"></i></button>':
                '<button class="btn btn-warning" onclick="mostrar('.$reg->idusuario.')"><i class="fa fa-pencil"></i></button>'.
                ' <button class="btn btn-primary" onclick="activar('.$reg->idusuario.')"><i class="fa fa-check"></i></button>',
                "1"=>$reg->nombre,
                "2"=>$reg->tipo_documento,
                "3"=>$reg->num_documento,
                "4"=>$reg->telefono,
                "5"=>$reg->email,
                "6"=>$reg->login,
           //     "7"=>'<img width="50" height="50" src="../files/usuarios/'.$reg->imagen.'">',
                 "7"=>'<img width="50" height="50" src="../files/usuarios/1533390361.jpg">',
                "8"=>($reg->condicion)?'<span class="label bg-green">Activado</span>':'<span class="label bg-red">Desactivado</span>'
            );

        }
        $results= array(
            "sEcho"=>1, //info para datatables
            "iTotalRecords"=>count($data),
            "iTotalDisplayRecords"=>count($data),
            "aaData"=>$data);
        echo json_encode($results);
    break;

    case 'permisos':
        require_once "../modelos/Permiso.php";
        $permiso = new Permiso();
        $rspta = $permiso->listar();

        $id=$_GET['id'];
        // Objeto usuario
        $marcados = $usuario->listarmarcados($id);
        $valores=array();
        //almacena todos los permisos
        while($per = $marcados->fetch_object())
        {
            // almacena en tu array valores todas las llaves primarias 
            array_push($valores, $per->idpermiso);
        }
        while ($reg = $rspta->fetch_object())
            {
                $sw=in_array($reg->idpermiso,$valores)?'checked':'';
                echo '<li> <input type="checkbox" '.$sw.' name="permiso[]" value="'.$reg->idpermiso.'">'.$reg->nombre.'</li>';
            }
    break;
    
    case 'verificar':
        //logina acceso
        $usu_us=$_POST['usu_us'];
        $cla_us=$_POST['cla_us'];
        $rol_id_us=$_POST['rol_id_us'];

        /* echo "rol ".$rol_id_us;
        
        return; */
        
        $clavehash=hash("SHA256",$cla_us);

        $rspta=$usuario->verificar($usu_us,$cla_us,$rol_id_us);
   
        $fetch=$rspta->fetch_object();
        
       
        
        if(isset($fetch))
        {
                /*SI HAY UN USUARIO EXISTENTE*/
                /*OBTENGO EN UNA VARIABLE EN SESION LOS DATOS DE ESE USUARIO*/            
                $_SESSION['idusuario']=$fetch->id;
                $_SESSION['nomusuario']=$fetch->nom_us;
                $_SESSION['imagenusuario']=$fetch->imagen_us;
                $_SESSION['dniusuario']=$fetch->usu_us;
                $_SESSION['rol_id_us']=$fetch->rol_id_us;
                /* Trae todos el permiso de los modulos asignados */
                $marcados = $usuario->listarmarcados($fetch->id);
              
                $valores=array();
                $menu = array();
                //recorre todos los datos
                // asigna una matriz doble 
                while ($per = $marcados->fetch_object())
                {
                    array_push($valores, $per->idpermiso);
                    $menu[$per->idpermiso] = $per->nombre;
                    $menu['url'][$per->idpermiso] = $per->url;
                    $menu['id'][$per->idpermiso] = $per->id;
                    $menu['icono'][$per->idpermiso] = $per->icono;
                    
                }
               /*  var_dump($_SESSION['permisos_idmodulos']);  */
                //Esta sesión la uso para seleccionar que modulos mostrar y acceder
                $_SESSION['permisos_idmodulos'] = $valores;
                $_SESSION['permisos_nommodulos'] = $menu;
                in_array(1,$valores)?$_SESSION['escritorio']=1:$_SESSION['escritorio']=0;
                in_array(2,$valores)?$_SESSION['categoria']=1:$_SESSION['categoria']=0;
                in_array(3,$valores)?$_SESSION['media']=1:$_SESSION['media']=0;
                in_array(4,$valores)?$_SESSION['productos']=1:$_SESSION['productos']=0;
                in_array(5,$valores)?$_SESSION['reportes']=1:$_SESSION['reportes']=0;
                in_array(6,$valores)?$_SESSION['rpt_movimiento_inventario']=1:$_SESSION['rpt_movimiento_inventario']=0;
                in_array(7,$valores)?$_SESSION['rpt_ganancia']=1:$_SESSION['rpt_ganancia']=0;
                in_array(8,$valores)?$_SESSION['machine_learning']=1:$_SESSION['machine_learning']=0;
                in_array(9,$valores)?$_SESSION['ml_insumos']=1:$_SESSION['ml_insumos']=0;
                in_array(10,$valores)?$_SESSION['mi_perfil']=1:$_SESSION['mi_perfil']=0;
                in_array(11,$valores)?$_SESSION['usuario']=1:$_SESSION['usuario']=0;


        }
        echo json_encode($fetch);
    break;

    case 'salir':
        //limpiamos variables de sesion
        session_unset();
        session_destroy();
        header("Location: ../index.php");
    

    break;
}
?>