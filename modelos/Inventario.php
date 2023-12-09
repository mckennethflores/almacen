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

    public function rpt_exactitud()
    {
        $sql = "SELECT
        producto.idpro AS idproducto,producto.nom_pro AS nombre_producto,
        producto.stock_pro as cantidad_stock_sistema,
        
        inventariofisico.cantidad as cantidad_stock_fisico,
        (inventariofisico.cantidad / producto.stock_pro * 100) AS 'exactitud'
        FROM
        inventariofisico
        INNER JOIN producto ON producto.idpro = inventariofisico.productoid";
        return ejecutarConsulta($sql);
    }
    public function rpt_kardex()
	{
		$sql="SELECT
		kardex.idkardex,
		producto.idpro,
		kardex.productoid,
		producto.nom_pro,
		tipomovimiento.id,
		tipomovimiento.nombre,
		kardex.fecha,
		kardex.tipomovimientoid,
		kardex.ingreso,
		kardex.salida,
		kardex.saldo
		FROM
		kardex
		INNER JOIN producto ON producto.idpro = kardex.productoid
		INNER JOIN tipomovimiento ON tipomovimiento.id = kardex.tipomovimientoid
		";
		return ejecutarConsulta($sql);		
	}
    public function rpt_vencimiento()
	{
		$sql="SELECT * FROM `producto`";
		return ejecutarConsulta($sql);		
	}
}
?>