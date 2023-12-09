<?php
require_once "../config/Conexion.php";
//$idusuario = $_SESSION['idusuario'];
class Movimiento
{
    private $idUsuarioSesion;
    private $idRol;
    // Implementamos nuestro metodo constructor
    public function __construct(){
        $this->idUsuarioSesion = $_SESSION['idusuario'];
       // $this->idRol = $_SESSION['rol_id_us'];
    }
    // Implementamos metodo para insertar reunion
    
    public function insertar($productoid,$tipomovimientoid,$cantidad,$precio,$fecha)
    {
        $sql = "INSERT INTO `movimiento` (`idmov`, `productoid`, `usuarioid`, `tipomovimientoid`, `cantidad`, `precio`, `fecha`) VALUES (NULL, '$productoid', $this->idUsuarioSesion, '$tipomovimientoid', '$cantidad', '$precio', '$fecha');";
     /*  echo $sql;
      
      return; */
      return ejecutarConsulta($sql);

    }
    public function editar($idmov,$productoid,$tipomovimientoid,$cantidad,$precio,$fecha)
    {

        $sql ="UPDATE movimiento SET productoid='$productoid',tipomovimientoid='$tipomovimientoid',cantidad='$cantidad',
        precio='$precio', fecha='$fecha' WHERE idmov ='$idmov';";
       //echo $sql;
      return ejecutarConsulta($sql);
    }

/*     public function desactivar($idmov)
    {
        $sql = "UPDATE producto SET est_pro='0' WHERE idmov='$idmov' ";
        return ejecutarConsulta($sql);
    } */
    public function eliminar($idmov)
    {
        $sql = "DELETE FROM movimiento WHERE idmov='$idmov' ";
        //echo $sql;
       return ejecutarConsulta($sql);
    }
 
/*     public function activar($idmov)
    {
        $sql = "UPDATE movimiento SET est_pro='1' WHERE idmov='$idmov'";
        return ejecutarConsulta($sql);
    } */

    public function mostrar($idmov)
    {
        $sql = "SELECT * FROM movimiento WHERE idmov='$idmov'";
        return ejecutarConsultaSimpleFila($sql);
    }

    public function listar()
    {
        $sql = "SELECT movimiento.idmov as id, producto.nom_pro as producto, usuario.nom_us as usuario, tipomovimiento.nombre as tipo, movimiento.cantidad, movimiento.precio, movimiento.fecha, DATE_FORMAT(movimiento.fecha, '%d-%m-%Y') AS fecha_ FROM movimiento INNER JOIN producto ON movimiento.productoid = producto.idpro INNER JOIN usuario ON movimiento.usuarioid = usuario.id INNER JOIN tipomovimiento ON movimiento.tipomovimientoid = tipomovimiento.id ORDER BY id;";
        return ejecutarConsulta($sql);
    }
    public function listarParaReporte()
    {
        $sql = "SELECT movimiento.idmov as id, producto.nom_pro as producto, usuario.nom_us as usuario, tipomovimiento.nombre as tipo, movimiento.cantidad, movimiento.precio, movimiento.fecha, DATE_FORMAT(movimiento.fecha, '%Y-%m-%d') AS fecha_ FROM movimiento INNER JOIN producto ON movimiento.productoid = producto.idpro INNER JOIN usuario ON movimiento.usuarioid = usuario.id INNER JOIN tipomovimiento ON movimiento.tipomovimientoid = tipomovimiento.id ORDER BY id;";
        return ejecutarConsulta($sql);
    }
    public function listarAnual()
    {
        $sql = "SELECT DATE_FORMAT(fecha, '%d/%m/%Y') AS fecha, SUM(cantidad) AS cantidad FROM movimiento GROUP BY YEAR(fecha), MONTH(fecha) ORDER BY idmov ASC;";
       /*  $sql = "SELECT YEAR(fecha) AS Año, 
        DATE_FORMAT(fecha, '%d/%m/%Y') AS anios,
        SUM(cantidad) AS cantidades
        FROM movimiento
        GROUP BY YEAR(fecha), MONTH(fecha);"; */
/*         $sql = "SELECT YEAR(fecha) AS anios, SUM(cantidad) AS cantidades
        FROM movimiento
        GROUP BY YEAR(fecha);"; */
        return ejecutarConsulta($sql);
    }
    public function listarTipoMovimiento()
    {
        $sql = "SELECT * FROM `tipomovimiento`";
        return ejecutarConsulta($sql);
    }
    /* // REGISTROS ACTIVOS
    public function listarActivos()
    {
        $sql = "SELECT a.idpro,a.categoriaid,m.nom_med,m.des_med as media,c.nom_cat as categoria,a.nom_pro,a.stock_pro,a.pre_com_pro,a.pre_ven_pro,a.fec_pro, a.est_pro FROM producto a INNER JOIN categoria c ON a.categoriaid=c.idcat INNER JOIN media m ON a.mediaid=m.idmed WHERE a.est_pro='1';";
        return ejecutarConsulta($sql);
    }
    public function listarActivosVenta()
    {
        $sql="SELECT a.idpro,a.categoriaid,m.nom_med,m.des_med as media,c.nom_cat as categoria,a.nom_pro,a.stock_pro,a.pre_com_pro,a.pre_ven_pro,a.fec_pro, a.est_pro FROM producto a INNER JOIN categoria c ON a.categoriaid=c.idcat INNER JOIN media m ON a.mediaid=m.idmed WHERE a.est_pro='1';";
        return ejecutarConsulta($sql); 
    } */

        public function selectarticulo()
    {
        $sql="SELECT * FROM producto";
        return ejecutarConsulta($sql); 
    }

}
?>