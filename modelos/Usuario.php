<?php
require_once "../config/Conexion.php";

class Usuario{

    private $idUsuarioSesion;
    private $idRol;

    public function __construct()
    {
        $this->idUsuarioSesion = $_SESSION['idusuario'];
        $this->idRol = $_SESSION['rol_id_us'];
    }

    public function insertarAdministrador($nom_us,$usu_us,$cla_us,$rol_id_us){
        $sw=true;
        $sql="INSERT INTO usuario_copy (nom_us, usu_us, cla_us, rol_id_us, imagen_us, con_us) VALUES('$nom_us','$usu_us','$cla_us','$rol_id_us', 'perfil_default.jpg', '1')";
            $idusuarionew=ejecutarConsulta_retornarID($sql);

            $sql="SELECT * FROM permiso WHERE idpermiso>0";
            $sql1 = ejecutarConsulta($sql);

            while ($reg = mysqli_fetch_array($sql1)) {

                $idpermiso = $reg['idpermiso'];
                $sql3 = "INSERT INTO  usuario_permiso (idusuario, idpermiso) VALUES ('$idusuarionew', '$idpermiso')";
                ejecutarConsulta($sql3);
                
            }
        return $sw;
    }
    public function insertarVendedor($nom_us,$usu_us,$cla_us,$rol_id_us){
        $sw=true;
            $sql="INSERT INTO usuario_copy (nom_us, usu_us, cla_us, rol_id_us, imagen_us, con_us) VALUES('$nom_us','$usu_us','$cla_us','$rol_id_us', 'perfil_default.jpg', '1')";
            $idusuarionew=ejecutarConsulta_retornarID($sql);

            $sql="SELECT * FROM permiso_vendedor WHERE idpermiso>0";
            $sql1 = ejecutarConsulta($sql);

            while ($reg = mysqli_fetch_array($sql1)) {

                $idpermiso = $reg['idpermiso'];
                $sql3 = "INSERT INTO usuario_permiso(idusuario, idpermiso) VALUES ($idusuarionew, $idpermiso)";
                ejecutarConsulta($sql3);
            }
        return $sw;
    }    

    public function editar($id,$nom_us,$usu_us,$cla_us,$rol_id_us)
    {
        $sw=true;
        // SI ROL = 1
        // BORRAMOS SU ROL ACTUAL
        // LUEGO CREAMOS EL ROL 1
        if((int)$rol_id_us == 1){
            // borramos los permisos actuales
            $sql_delete="DELETE FROM usuario_permiso WHERE idusuario = '$id'";
            $sql_delete = ejecutarConsulta($sql_delete);
            // insertamos los permisos nuevos de acuerdo al rol
            $sql = "UPDATE usuario_copy SET nom_us='$nom_us', usu_us='$usu_us', cla_us='$cla_us', rol_id_us='$rol_id_us' WHERE id='$id'";
            ejecutarConsulta($sql);

            //contar cuantos permisos hay
            $sql="SELECT * FROM permiso WHERE idpermiso>0";
            $sql1 = ejecutarConsulta($sql);

            while ($reg = mysqli_fetch_array($sql1)) {

                $idpermiso = $reg['idpermiso'];

                $sql3 = "INSERT INTO usuario_permiso(idusuario, idpermiso) VALUES ($id, $idpermiso)";
                ejecutarConsulta($sql3);
            }
        }
        else{
            // borramos los permisos actuales
            $sql_delete="DELETE FROM usuario_permiso WHERE idusuario = '$id'";
            $sql_delete = ejecutarConsulta($sql_delete);

            $sql = "UPDATE usuario_copy SET nom_us='$nom_us', usu_us='$usu_us', cla_us='$cla_us', rol_id_us='$rol_id_us' WHERE id='$id'";
            ejecutarConsulta($sql);

            //contar cuantos permisos hay
            $sql="SELECT * FROM permiso_vendedor WHERE idpermiso>0";
            $sql1 = ejecutarConsulta($sql);

            while ($reg = mysqli_fetch_array($sql1)) {

                $idpermiso = $reg['idpermiso'];

                $sql3 = "INSERT INTO usuario_permiso (idusuario, idpermiso) VALUES ($id, $idpermiso)";
                ejecutarConsulta($sql3);
                
            }
        }
        return $sw; 


        // SI ROL = 2
        // BORRAMOS SU ROL ACTUAL
        // LUEGO CREAMOS EL ROL 2



    }

    //Metodo para desactivar 
    public  function desactivar($id)
    {
        $sql = "UPDATE usuario_copy SET con_us='0' WHERE id='$id'";
        return ejecutarConsulta($sql);
    }
    //Metodo para activar 
    public  function activar($id)
    {
        $sql = "UPDATE usuario_copy SET con_us='1' WHERE id='$id'";
        return ejecutarConsulta($sql);
    }

     // El metodo muestra los datos de un registro a modificar
     public function mostrar($id)
     {
         $sql="SELECT usuario_copy.id, usuario_copy.nom_us, usuario_copy.usu_us, usuario_copy.cla_us, rol.nom_rol, rol.id_rol, usuario_copy.con_us FROM usuario_copy INNER JOIN rol ON usuario_copy.rol_id_us = rol.id_rol
          WHERE usuario_copy.id='$id'";
         return ejecutarConsultaSimpleFila($sql);
     }

    public function listar()
    {
        if ($this->idRol == ROL_ADMINISTRADOR) {
            $sql="SELECT usuario_copy.id, usuario_copy.nom_us, usuario_copy.usu_us, usuario_copy.cla_us, rol.nom_rol, rol.id_rol, usuario_copy.con_us FROM usuario_copy INNER JOIN rol ON usuario_copy.rol_id_us = rol.id_rol  WHERE id>0";
        } else {
            $sql="SELECT usuario_copy.id, usuario_copy.nom_us, usuario_copy.usu_us, usuario_copy.cla_us, rol.nom_rol, rol.id_rol,  usuario_copy.con_us FROM usuario_copy INNER JOIN rol ON usuario_copy.rol_id_us = rol.id_rol WHERE usuario_copy.id = $this->idUsuarioSesion";
        }
        return ejecutarConsulta($sql);
    }
/*     public function listarmarcados($idusuario)
    {
        $sql="SELECT * FROM usuario_permiso WHERE idusuario='$idusuario'";
        return ejecutarConsulta($sql);
    } */
    public function listarmarcados($idusuario){
		$sql="SELECT * FROM usuario_permiso up join permiso p on(up.idpermiso = p.idpermiso) WHERE idusuario='$idusuario' order by p.idpermiso asc";
		return ejecutarConsulta($sql);
	}    

    // login
/*     public function verificar($login,$clave)
    {
        $sql="SELECT id_usu AS idusuario,grupoid,nom_usu AS nombre, nom_usu AS login,pas_usu,ima_usu AS imagen,est_usu,ult_usu FROM usuario WHERE nom_usu='$login' AND pas_usu='$clave' AND est_usu='1'";
        return ejecutarConsulta($sql);
    } */

    public function verificar($usu_us,$cla_us,$rol_id_us)
    {
		$sql="SELECT * FROM usuario_copy WHERE usu_us='$usu_us' AND cla_us='$cla_us' AND rol_id_us='$rol_id_us' AND con_us='1'";
        //echo $sql; return;
        return ejecutarConsulta($sql);
    }
}
?>