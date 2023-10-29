<?php
require_once "../config/Conexion.php";

class Media
{
    public function __construct()
    {

    }
    public function insertar($nom_med,$des_med,$tipo_med)
    {
        $sql = "INSERT INTO media (nom_med, des_med, tipo_med,con_med)
        VALUES ('$nom_med', '$des_med', '$tipo_med', '1')";
        return ejecutarConsulta($sql);
    }
    public function editar($idmed,$nom_med,$des_med,$tipo_med)
    {
        $sql ="UPDATE media SET nom_med='$nom_med',des_med='$des_med',tipo_med='$tipo_med' WHERE idmed ='$idmed'";
        return ejecutarConsulta($sql);
    }
 
    public function desactivar($idmed)
    {
        $sql = "UPDATE media SET con_med='0' WHERE idmed='$idmed' ";
        return ejecutarConsulta($sql);
    }
 
    public function activar($idmed)
    {
        $sql = "UPDATE media SET con_med='1' WHERE idmed='$idmed' ";
      
        
       return ejecutarConsulta($sql);
    }

    public function mostrar($idmed)
    {
        $sql = "SELECT idmed AS idmedia, nom_med AS cod_img, des_med AS imagen, tipo_med AS tipo, con_med AS condicion FROM media WHERE idmed='$idmed'";
        
        return ejecutarConsultaSimpleFila($sql);
    }

    public function listar()
    {
        $sql = "SELECT idmed AS idmedia, nom_med AS cod_img, des_med AS imagen, tipo_med AS tipo, con_med AS condicion FROM media";
        return ejecutarConsulta($sql);
    }
    //funcion que muestra en el selec todos los registros 
    public function select()
    {
        $sql = "SELECT idmed AS idmedia, nom_med AS cod_img, des_med AS imagen, tipo_med AS tipo, con_med AS condicion FROM media where con_med=1";
        return ejecutarConsulta($sql);
    }
}
?>