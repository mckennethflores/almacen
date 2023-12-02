<?php
require "../config/Conexion.php";

class Login{

    public function __construct(){

    }

    public function listarRol()
	{
		$sql="SELECT * FROM rol order by id_rol asc";
		return ejecutarConsulta($sql);		
    }
}