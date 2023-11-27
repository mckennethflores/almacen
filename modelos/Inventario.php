<?php
require_once "../config/Conexion.php";

class Inventario
{
    public function __construct()
    {

    }
    
    public function insertar($productoid,$fecha,$cantidad)
    {
        $sql = "INSERT INTO `inventariofisico` (`idinventario`, `productoid`, `fecha`, `cantidad`) VALUES (NULL, '$productoid', '$fecha', '$cantidad');";
      /*   $sql = "INSERT INTO producto (categoriaid,mediaid,nom_pro,stock_pro,pre_com_pro,pre_ven_pro,fec_pro,est_pro)
        VALUES ('$categoriaid','$mediaid','$nom_pro','$stock_pro', '$pre_com_pro','$pre_ven_pro','$fec_pro', '1')"; */
    //  echo $sql;
      return ejecutarConsulta($sql);

    }
    public function editar($idinventario,$productoid,$fecha,$cantidad)
    {
        $sql ="UPDATE inventariofisico SET productoid='$productoid',fecha='$fecha',cantidad='$cantidad' WHERE idinventario ='$idinventario';";
      // echo $sql;
      return ejecutarConsulta($sql);
    }

    public function desactivar($idinventario)
    {
        $sql = "UPDATE inventariofisico SET estado='0' WHERE idinventario='$idinventario' ";
        return ejecutarConsulta($sql);
    }
    public function eliminar($idinventario)
    {
        $sql = "DELETE FROM inventariofisico WHERE idinventario='$idinventario' ";
        //echo $sql;
       return ejecutarConsulta($sql);
    }
 
    public function activar($idinventario)
    {
        $sql = "UPDATE inventariofisico SET estado='1' WHERE idinventario='$idinventario'";
        return ejecutarConsulta($sql);
    }

    public function mostrar($idinventario)
    {
        $sql = "SELECT * FROM inventariofisico WHERE idinventario='$idinventario'";
        return ejecutarConsultaSimpleFila($sql);
    }

    public function listar()
    {
        $sql = "SELECT * FROM `inventariofisico`";
        return ejecutarConsulta($sql);
    }
  /*   // REGISTROS ACTIVOS
    public function listarProductosParaProductoNombre()
    {
        $sql = "SELECT a.idpro,a.categoriaid,a.nom_pro as nombre,m.nom_med,m.nom_med as media, a.codigobarras,c.nom_cat as categoria,a.nom_pro,a.stock_pro,a.pre_com_pro,a.pre_ven_pro,a.fec_pro, a.est_pro FROM producto a INNER JOIN categoria c ON a.categoriaid=c.idcat INNER JOIN media m ON a.mediaid=m.idmed ORDER BY a.idpro DESC;";
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
    } */

}
?>