<?php
require_once "../config/Conexion.php";

class Categoria
{
    public function __construct()
    {

    }
    public function insertar($nombre,$descripcion)
    {
        $sql = "INSERT INTO categoria (nom_cat, des_cat,con_cat)
        VALUES ('$nombre', '$descripcion', '1')";
        return ejecutarConsulta($sql);
    }
    public function editar($idcategoria,$nombre,$descripcion)
    {
        $sql ="UPDATE categoria SET nom_cat='$nombre',des_cat='$descripcion' WHERE idcat ='$idcategoria'";
        return ejecutarConsulta($sql);
    }
 
    public function desactivar($idcategoria)
    {
        $sql = "UPDATE categoria SET con_cat='0' WHERE idcat='$idcategoria' ";
        return ejecutarConsulta($sql);
    }
 
    public function activar($idcategoria)
    {
        $sql = "UPDATE categoria SET con_cat='1' WHERE idcat='$idcategoria' ";
      
        
       return ejecutarConsulta($sql);
    }

    public function mostrar($idcategoria)
    {
        $sql = "SELECT idcat AS idcategoria, nom_cat AS nombre, des_cat AS descripcion ,con_cat AS condicion FROM categoria WHERE idcat='$idcategoria'";
        
        return ejecutarConsultaSimpleFila($sql);
    }

    public function listar()
    {
        $sql = "SELECT idcat AS idcategoria, nom_cat AS nombre, des_cat AS descripcion ,con_cat AS condicion FROM categoria";
        return ejecutarConsulta($sql);
    }
    //funcion que muestra en el selec todos los registros 
    public function select()
    {
        $sql = "SELECT idcat AS idcategoria, nom_cat AS nombre, des_cat AS descripcion ,con_cat AS condicion FROM categoria where condicion=1";
        return ejecutarConsulta($sql);
    }
}
?>