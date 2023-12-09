<?php
session_start();
require_once "../modelos/Usuario.php";

$usuario=new Usuario();

$id=isset($_POST["id"])? limpiarCadena($_POST["id"]):"";
$nom_us=isset($_POST["nom_us"])? limpiarCadena($_POST["nom_us"]):"";
$usu_us=isset($_POST["usu_us"])? limpiarCadena($_POST["usu_us"]):"";
$cla_us=isset($_POST["cla_us"])? limpiarCadena($_POST["cla_us"]):"";

$idusuario_session = $_SESSION['rol_id_us'];
//Rol
$rol_id_us=isset($_POST["rol_id_us"])? limpiarCadena($_POST["rol_id_us"]):"";


switch($_GET["op"]){

    case 'guardaryeditar':

        if(empty($id)){
            
            if((int)$rol_id_us == ROL_ADMINISTRADOR){
                $rspta=$usuario->insertarAdministrador($nom_us,$usu_us,$cla_us,$rol_id_us);
                 echo $rspta ? "Se registro el usuario Administrador Satisfactoriamente": "No se pudo registrar el usuario Administrador";
            }else if((int)$rol_id_us == ROL_VENDEDOR){

                $rspta=$usuario->insertarVendedor($nom_us,$usu_us,$cla_us,$rol_id_us);
                echo $rspta ? "Se registro el usuario Vendedor Satisfactoriamente": "No se pudo registrar el usuario Vendedor";
            }else{
                echo "Rol Ingresado es equivocado: error: 408".$rol_id_us;
            }
            
        }else{
            $rspta=$usuario->editar($id,$nom_us,$usu_us,$cla_us,$rol_id_us);
            
            echo $rspta ? "Usuario Actualizad(a)": "Usuario No se puedo actualizar";
        }
    break;
    
    case 'desactivar';
    $rspta=$usuario->desactivar($id);
    echo $rspta ? "Usuario Desactivad(a)": "Usuario No se pudo desactivar";
    break;

    case 'activar':
    $rspta=$usuario->activar($id);
    echo $rspta ? "Usuario Activad(a)": "Usuario No se pudo activar";
    break;

    case 'mostrar':
        $rspta=$usuario->mostrar($id);
        echo json_encode($rspta);
    break;
    case 'listar':
        $rspta=$usuario->listar();
        $data= Array();
        while ($reg=$rspta->fetch_object()){
            $cond = $reg->con_us;
            $str = '';
            if($cond == '1'){
                $str .= 'Activado';
            }else{
                $str .= 'Desactivado';
            }


            $data[]=array(
                "0"=>($idusuario_session == ROL_ADMINISTRADOR ? ($reg->con_us ?"<button class='btn btn-warning' onclick='mostrar(".$reg->id.")'><i class='fa fa-pencil'></i></button>".
                " <button class='btn btn-danger' onclick='desactivar(".$reg->id.")'><i class='fa fa-close'></i></button>":
                "<button class='btn btn-warning' onclick='mostrar(".$reg->id.")'><i class='fa fa-pencil'></i></button>".
                " <button class='btn btn-primary' onclick='activar(".$reg->id.")'><i class='fa fa-check'></i></button>"): ($reg->con_us ?"<button class='btn btn-warning' onclick='mostrar(".$reg->id.")'><i class='fa fa-pencil'></i></button>".
                " ":
                "<button class='btn btn-warning' onclick='mostrar(".$reg->id.")'><i class='fa fa-pencil'></i></button>".
                ""))
                
                ,
                "1"=>$reg->nom_us,
                "2"=>$reg->usu_us,
                "3"=>$reg->nom_rol,
                "4"=>$str
            );
        }
        $results = array(
            "sEcho"=>1, // Info para el datables
            "iTotalRecords"=>count($data), // Envio total de registros al datatables
            "iTotalDisplayRecords"=>count($data), // Total de registros a visualizar
            "aaData"=>$data);
        echo json_encode($results);
    break;

    case "selectUsuarios":
        require_once "../modelos/Usuario.php";
        $usuario = new Usuario();
        $rspta = $usuario->listar();
        echo '<option value="0" selected disabled>Seleccione porfavor</option>';
        echo '<option value="-1" >Todos</option>';
        while ($reg = $rspta->fetch_object())
            {
                echo '<option value=' . $reg->id . '>' . $reg->nom_us . '</option>';
            }
    break;
    
    case 'verificar':
        //logina acceso
        $usu_us=$_POST['usu_us'];
        $cla_us=$_POST['cla_us'];
        /* $rol_id_us=$_POST['rol_id_us']; */

        /* echo "rol ".$rol_id_us;
        
        return; */
        
        $clavehash=hash("SHA256",$cla_us);

        $rspta=$usuario->verificar($usu_us,$cla_us);
   
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
                in_array(13,$valores)?$_SESSION['grupo']=1:$_SESSION['grupo']=0;
                in_array(14,$valores)?$_SESSION['movimiento']=1:$_SESSION['movimiento']=0;
                in_array(15,$valores)?$_SESSION['rpt_stock_productos']=1:$_SESSION['rpt_stock_productos']=0;
                in_array(16,$valores)?$_SESSION['prt_exactitud']=1:$_SESSION['prt_exactitud']=0;
                in_array(17,$valores)?$_SESSION['rpt_productos_gotados']=1:$_SESSION['rpt_productos_gotados']=0;



        }
        echo json_encode($fetch);
    break;

    case 'salir':
        //limpiamos variables de sesion
        session_unset();
        session_destroy();
        header("Location: ../index.php");
    break;

   /*  case 'mostrardetalleperfil':
            
        if(!empty($_POST)){
            $idusuario=$_POST['idusuario'];
            $rspta=$usuario->mostrardetalleperfil($idusuario);
        }            
    break;

    case 'editarperfil':
        
        if(!empty($_POST)){
            $idusuario=$_POST['idusuario'];
            $nomusuario=$_POST['nomusuario'];
            $dniusuario=$_POST['dniusuario'];
            $rspta=$usuario->editarperfil($idusuario,$nomusuario,$dniusuario);
        }            
    break;

    case 'subir':
        if(!empty($_POST)){
            $idusuario=$_POST['idusuario'];
            $imagenusuario=$_POST['imagenusuario'];
            $rspta=$usuario->subir($idusuario,$imagenusuario);
        }          
    break;
    
    case 'selectSexousuario':
        $rspta = $usuario->listarSexousuario();
        while ($reg = $rspta->fetch_object()){
                    echo '<option value=' . $reg->id . '>' . $reg->descripcion . '</option>';
        }
    break;
    case 'selectPerfilUsuario':
        $rspta = $usuario->listarPerfilUsuario();
        while ($reg = $rspta->fetch_object()){
                    echo '<option value=' . $reg->id . '>' . $reg->descripcion . '</option>';
        }
    break;     */
}
?>