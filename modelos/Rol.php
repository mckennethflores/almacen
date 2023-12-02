<?php
require "../config/Conexion.php";

class rol{

    // Implementamos nuestro metodo constructor
    public function __construct(){

    }

    // Implementamos metodo para insertar registros
    public function insertar($nom_rol)
    {
        $sql="INSERT INTO grupo (nom_rol,con_rol) VALUES('$nom_rol','1')";
        return ejecutarConsulta($sql);
    }
    // Metodo para editar registros
    public function editar($id,$nom_rol)
    {
        $sql = "UPDATE grupo SET nom_rol='$nom_rol' WHERE id_rol='$id'";
        return ejecutarConsulta($sql);
    }
    //Metodo para desactivar 
    public  function desactivar($id)
    {
        $sql = "UPDATE grupo SET con_rol='0' WHERE id_rol='$id'";
        return ejecutarConsulta($sql);
    }
    //Metodo para activar 
    public  function activar($id)
    {
        $sql = "UPDATE grupo SET con_rol='1' WHERE id_rol='$id'";
        return ejecutarConsulta($sql);
    }
    // El metodo muestra los datos de un registro a modificar
    public function mostrar($id)
    {
        $sql="SELECT * FROM grupo WHERE id_rol='$id'";
        return ejecutarConsultaSimpleFila($sql);
    }
    // Metodo para listar los registros
    public function listar()
    {
        $sql="SELECT * FROM grupo GROUP BY nom_rol asc;";
        return ejecutarConsulta($sql);
    }
    public function listarRol()
    {
        $sql="SELECT * FROM grupo GROUP BY nom_rol asc;";
        return ejecutarConsulta($sql);
    }
}
?>