<?php
require_once "../config/Conexion.php";

class Producto
{
    public function __construct()
    {

    }
    
    public function insertar($categoriaid,$mediaid,$nom_pro,$stock_pro,$pre_com_pro,$pre_ven_pro,$fec_pro)
    {
        $sql = "INSERT INTO producto (categoriaid,mediaid,nom_pro,stock_pro,pre_com_pro,pre_ven_pro,fec_pro,est_pro)
        VALUES ('$categoriaid','$mediaid','$nom_pro','$stock_pro', '$pre_com_pro','$pre_ven_pro','$fec_pro', '1')";
    //  echo $sql;
      return ejecutarConsulta($sql);

    }
    public function editar($idpro,$categoriaid,$mediaid,$nom_pro,$stock_pro,$pre_com_pro,$pre_ven_pro,$fec_pro)
    {
        $sql ="UPDATE producto SET categoriaid='$categoriaid',mediaid='$mediaid',nom_pro='$nom_pro',
        stock_pro='$stock_pro',pre_com_pro='$pre_com_pro',pre_ven_pro='$pre_ven_pro',fec_pro='$fec_pro' WHERE idpro ='$idpro';";
      // echo $sql;
      return ejecutarConsulta($sql);
    }

    public function desactivar($idpro)
    {
        $sql = "UPDATE producto SET est_pro='0' WHERE idpro='$idpro' ";
        return ejecutarConsulta($sql);
    }
    public function eliminar($idpro)
    {
        $sql = "DELETE FROM producto WHERE idpro='$idpro' ";
        //echo $sql;
       return ejecutarConsulta($sql);
    }
 
    public function activar($idpro)
    {
        $sql = "UPDATE producto SET est_pro='1' WHERE idpro='$idpro'";
        return ejecutarConsulta($sql);
    }

    public function mostrar($idpro)
    {
        $sql = "SELECT * FROM producto WHERE idpro='$idpro'";
        return ejecutarConsultaSimpleFila($sql);
    }

    public function listar()
    {
        $sql = "SELECT a.idpro,a.categoriaid,a.nom_pro as nombre,m.nom_med,m.nom_med as media, a.codigobarras,c.nom_cat as categoria,a.nom_pro,a.stock_pro,a.pre_com_pro,a.pre_ven_pro,a.fec_pro, a.est_pro FROM producto a INNER JOIN categoria c ON a.categoriaid=c.idcat INNER JOIN media m ON a.mediaid=m.idmed;";
        return ejecutarConsulta($sql);
    }
    // REGISTROS ACTIVOS
    public function listarActivos()
    {
        $sql = "SELECT a.idpro,a.categoriaid,m.nom_med,m.des_med as media,c.nom_cat as categoria,a.nom_pro,a.stock_pro,a.pre_com_pro,a.pre_ven_pro,a.fec_pro, a.est_pro FROM producto a INNER JOIN categoria c ON a.categoriaid=c.idcat INNER JOIN media m ON a.mediaid=m.idmed WHERE a.est_pro='1';";
        return ejecutarConsulta($sql);
    }
    public function listarActivosVenta()
    {
        $sql="SELECT a.idpro,a.categoriaid,m.nom_med,m.des_med as media,c.nom_cat as categoria,a.nom_pro,a.stock_pro,a.pre_com_pro,a.pre_ven_pro,a.fec_pro, a.est_pro FROM producto a INNER JOIN categoria c ON a.categoriaid=c.idcat INNER JOIN media m ON a.mediaid=m.idmed WHERE a.est_pro='1';";
        return ejecutarConsulta($sql); 
    }

        public function selectarticulo()
    {
        $sql="SELECT * FROM producto";
        return ejecutarConsulta($sql); 
    }

}
?>