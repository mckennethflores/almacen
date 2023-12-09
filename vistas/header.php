<?php
if (strlen(session_id()) < 1)
  session_start();

  require_once "../config/Conexion.php";
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?= NOMBRE_EMPRESA ?></title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="../public/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../public/css/font-awesome.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../public/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="../public/css/_all-skins.min.css">
    <link rel="apple-touch-icon" href="../public/img/apple-touch-icon.png">
    <link rel="shortcut icon" href="../public/img/favicon.ico">

<!-- DATATABLES -->
    <link rel="stylesheet" type="text/css" href="../public/datatables/jquery.dataTables.min.css">
     <link rel="stylesheet" type="text/css" href="../public/datatables/buttons.dataTables.min.css">
     <link rel="stylesheet" type="text/css" href="../public/datatables/responsive.dataTables.min.css">

    <!-- DATATABLES -->
 
    <link rel="stylesheet" type="text/css" href="../public/css/bootstrap-select.min.css">
    <link rel="stylesheet" type="text/css" href="../public/css/style_personalizado.css">
 



<style>

</style>
  </head>
  <body class="hold-transition skin-blue-light sidebar-mini">
    <div class="wrapper">

      <header class="main-header">

        <!-- Logo -->
        <a href="escritorio.php" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b class="logo-small"><?= NOMBRE_EMPRESA_SLUG ?></b></span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg">
   <!--       <b style="
    font-size: 1.3rem !important;
">MULTIMEDIA SOLUTIONS</b>-->
<img src="../public/img/logo.png" alt="" width="100%" style="height: 50px;">
</span>
        </a>

        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Navegación</span>
          </a>
          <!-- Navbar Right Menu -->
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <!-- Messages: style can be found in dropdown.less-->
              
              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <img src="../files/usuarios/<?php echo $_SESSION['imagenusuario']; ?>" class="user-image" alt="User Image">
                  <span class="hidden-xs text-dark"><?php echo $_SESSION['nomusuario']; ?></span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                    <img src="../files/usuarios/<?php echo $_SESSION['imagenusuario']; ?>" class="img-circle" alt="User Image">
                    <p>
                    Nombre: <?php echo $_SESSION['nomusuario']; ?> <br>
                   <!--  Cargo: --> <?php /* echo $_SESSION['cargo']; */ ?>
                    
                   </p>
                  </li>

                      <script src="../public/js/jquery-3.1.1.min.js"></script>
        <!--               <script type="text/javascript" src="scripts/usuario_edit.js"></script> -->
 
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    
                    <div class="pull-right">
                      <a href="../ajax/usuario.php?op=salir" class="btn btn-default btn-flat">Cerrar</a>
                    </div>
                  </li>
                </ul>
              </li>
              
            </ul>
          </div>

        </nav>
      </header>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">       
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header"></li>

<?php

require_once "../modelos/Permiso.php";
$permiso = new Permiso();
$menus = $permiso->listar();
/* var_dump($menus); */

/* while($reg = $menus->fetch_object())
{
    echo '<option value=' . $reg->id . '>' .  $reg->role_id . '</option>';
}
 */
  $rol_id_us = $_SESSION['rol_id_us'];
 foreach ($menus as $key => $menu){

  $rolesIdArray = preg_split('/,/', $menu['role_id']);
  
  if (!in_array($rol_id_us, $rolesIdArray)){
    continue;
  }

  /* var_dump($menu['url']); return; */?>

 <li id="<?php echo $menu['id']  ?>">
                <a href="<?php echo $menu['url'] ?>">
                  <i class="fa <?php echo $menu['icono'] ?>"></i> <span><?php echo $menu['nombre'] ?></span>
                </a>
              </li>

 <?php
 }

?>

            <?php 
            /* $menu = $_SESSION['permisos_idmodulos'];
            var_dump($menu); */
            /* foreach($_SESSION['permisos_idmodulos'] as $permiso){ */
              ?>
             <!--  <li id="<?php echo $menu['id'][$permiso]  ?>">
                <a href="<?php echo $menu['url'][$permiso] ?>">
                  <i class="fa <?php echo $menu['icono'][$permiso] ?>"></i> <span><?php echo $menu[$permiso] ?></span>
                </a>
              </li> -->
              <?php
            /* } */
            ?>            
            <!-- <li>
              <a href="escritorio.php">
                <i class="fa fa-tasks"></i> <span>Escritorio</span>
              </a>
            </li> -->
            
            <?php
           /*  if($_SESSION['escritorio']==1)
            {
              echo '<li>
              <a href="escritorio.php">
                <i class="fa fa-tasks"></i> <span>Escritorio</span>
              </a>
            </li>';
            } */
            ?>

            <!-- Codigo nuevo -->
           <!--  <li class="treeview">
              <a href="#">
                <i class="fa fa-laptop"></i>
                <span>Mantenimiento</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="categoria.php"><i class="fa fa-circle-o"></i>Categorías</a></li>
                <li><a href="media.php"><i class="fa fa-circle-o"></i>Media</a></li>
                <li><a href="producto_nombre.php"><i class="fa fa-circle-o"></i>Productos</a></li>
               <li><a href="proveedores.php"><i class="fa fa-circle-o"></i>Proveedores</a></li>
                <li><a href="clientes.php"><i class="fa fa-circle-o"></i>Clientes</a></li> 
              </ul>
            </li> -->

            <!-- <li class="treeview">
              <a href="#">
                <i class="fa fa-th"></i>
                <span>Compras</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="compras.php"><i class="fa fa-circle-o"></i>Compras</a></li>
              </ul>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-shopping-cart"></i>
                <span>Ventas</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="ventas.php"><i class="fa fa-circle-o"></i>Ventas</a></li>
              </ul>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-bookmark"></i>
                <span>Reservas</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="reservas.php"><i class="fa fa-circle-o"></i>Reservas</a></li>
              </ul>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-exchange"></i>
                <span>Transferencias</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="compras.php"><i class="fa fa-circle-o"></i>Transferencias</a></li>
              </ul>
            </li> -->
           <!--  <li class="treeview">
              <a href="#">
                <i class="fa fa-bar-chart"></i>
                <span>Reportes</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="reporte_general.php"><i class="fa fa-circle-o"></i>Reportes Generales Inf. Mensuales</a></li>
                <li><a href="reporte_kardex.php"><i class="fa fa-circle-o"></i>Reportes Movimiento Inventario</a></li>
                <li><a href="reporte_ganancias.php"><i class="fa fa-circle-o"></i>Reportes de Ganancias</a></li>
                <li><a href="reporte_stock_productos.php"><i class="fa fa-circle-o"></i>Stock de productos</a></li>
                <li><a href="reporte_exactitud.php"><i class="fa fa-circle-o"></i>Reporte de Exactitud o precisión</a></li>
                <li><a href="reporte_kardex.php"><i class="fa fa-circle-o"></i>Reporte de Kardex</a></li>
                <li><a href="reporte_kardex.php"><i class="fa fa-circle-o"></i>Reporte de Productos agotados</a></li>
              </ul>
            </li> -->
            <!-- <li class="treeview">
              <a href="#">
                <i class="fa fa-bell-o"></i>
                <span>Alertas</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="niveles_de_alertas.php"><i class="fa fa-circle-o"></i>Niveles de Alertas</a></li>

              </ul>
            </li> -->
<!--             <li class="treeview">
              <a href="#">
                <i class="fa fa-industry"></i>
                <span>Machine Learning</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="ml_ingreso_rapido_producto.php"><i class="fa fa-circle-o"></i>Ingreso rapido de producto / Codigo de barras</a></li>
                <li><a href="ml_predicciones_ventas.php"><i class="fa fa-circle-o"></i>Predicciones de ventas</a></li>
                <li><a href="ml_predicciones_insumos.php"><i class="fa fa-circle-o"></i>Predicciones de Insumos</a></li>

              </ul>
            </li> -->
          <!--   <li class="treeview">
              <a href="#">
                <i class="fa fa-folder"></i>
                <span>Usuarios</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="usuarios.php"><i class="fa fa-circle-o"></i>Usuarios</a></li>
                <li><a href="perfiles_usuario.php"><i class="fa fa-circle-o"></i>Perfiles de Usuario</a></li> -->
                <!-- <li><a href="ml_predicciones_ventas.php"><i class="fa fa-circle-o"></i>Predicciones de ventas</a></li> -->
               <!--  <li><a href="grupos.php"><i class="fa fa-circle-o"></i>Grupos</a></li> -->

         <!--      </ul>
            </li> -->
            <!-- /Codigo nuevo -->
            <!-- <li class="treeview">
              <a href="#">
                <i class="fa fa-laptop"></i>
                <span>Maestro</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="categoria.php"><i class="fa fa-circle-o"></i> Categorías</a></li>
                <li><a href="media.php"><i class="fa fa-circle-o"></i> Media</a></li>
                <li><a href="producto_nombre.php"><i class="fa fa-circle-o"></i> Productos</a></li>
              </ul>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-laptop"></i>
                <span>Movimiento almacén</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="movimiento.php"><i class="fa fa-circle-o"></i> Movimiento</a></li>
              </ul>
            </li>
            <li class="treeview">
              <a id="mReportes" href="#">
                <i class="fa fa-laptop"></i>
                <span>Inventario</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="reporte_general.php"><i class="fa fa-circle-o"></i>Inventario Productos</a></li>
                <li><a href="inventario.php"><i class="fa fa-circle-o"></i>Inventario</a></li>
              </ul>
            </li>
            <li class="treeview">
              <a id="mReportes" href="#">
                <i class="fa fa-laptop"></i>
                <span>Reportes</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="reporte_general.php"><i class="fa fa-circle-o"></i>Reporte General</a></li>
                <li><a href="reporte_stock_productos.php"><i class="fa fa-circle-o"></i>Stock de productos</a></li>
                <li><a href="reporte_exactitud.php"><i class="fa fa-circle-o"></i>Reporte de Exactitud</a></li>
                <li><a href="reporte_kardex.php"><i class="fa fa-circle-o"></i>Reporte de Kardex</a></li>
              </ul>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-laptop"></i>
                <span>ML</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="producto.php"><i class="fa fa-circle-o"></i> Productos con codigo de barras</a></li>
              </ul>
            </li> -->
            <?php
           /*  if($_SESSION['almacen']==1)
            { */

              
              
             
             /*  echo '<li class="treeview">
              <a href="#">
                <i class="fa fa-laptop"></i>
                <span>Almacén</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
              <li><a href="cliente.php"><i class="fa fa-circle-o"></i> Clientes</a></li>
                <li><a href="articulo.php"><i class="fa fa-circle-o"></i> Artículos</a></li>
                <li><a href="categoria.php"><i class="fa fa-circle-o"></i> Categorías</a></li>
                <li><a href="unidadmedida.php"><i class="fa fa-circle-o"></i> Unidad Medida</a></li>
              </ul>
            </li>'; */
          /*   } */
            ?>            
            <?php
       /*      if($_SESSION['compras']==1)
            {
              echo '<li class="treeview">
              <a href="#">
                <i class="fa fa-th"></i>
                <span>Compras</span>
                 <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="ingreso.php"><i class="fa fa-circle-o"></i> Ingresos</a></li>
                <li><a href="proveedor.php"><i class="fa fa-circle-o"></i> Proveedores</a></li>
              </ul>
            </li>';
            } */
            ?>    
             <?php
        /*     if($_SESSION['cotizacion']==1)
            {
              echo '<li class="treeview">
              <a href="#">
                <i class="fa fa-th"></i>
                <span>Cotizacion</span>
                 <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="cotizacion.php"><i class="fa fa-circle-o"></i> Cotización</a></li>
              
               
              </ul>
            </li>';
            } */
            ?>    
            <?php
        /*     if($_SESSION['ventas']==1)
            {
              echo '<li class="treeview">
              <a href="#">
                <i class="fa fa-shopping-cart"></i>
                <span>Ventas</span>
                 <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="venta.php"><i class="fa fa-circle-o"></i> Ventas</a></li>
                <li><a href="cliente.php"><i class="fa fa-circle-o"></i> Clientes</a></li>
              </ul>
            </li>';
            } */
            ?>
            <?php
          /*   if($_SESSION['acceso']==1)
            {
              echo '<li class="treeview">
              <a href="#">
                <i class="fa fa-folder"></i> <span>Acceso</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="usuario.php"><i class="fa fa-circle-o"></i> Usuarios</a></li>
                <li><a href="permiso.php"><i class="fa fa-circle-o"></i> Permisos</a></li>
                
              </ul>
            </li>';
            } */
            ?>
            <?php
        /*     if($_SESSION['consultac']==1)
            {
              echo '<li class="treeview">
              <a href="#">
                <i class="fa fa-bar-chart"></i> <span>Consulta Compras</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="comprasfecha.php"><i class="fa fa-circle-o"></i> Consulta Compras</a></li>                
              </ul>
            </li>';
            } */
            ?>                       
            <?php
        /*     if($_SESSION['consultav']==1)
            {
              echo '<li class="treeview">
              <a href="#">
                <i class="fa fa-bar-chart"></i> <span>Consulta Ventas</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="ventasfechacliente.php"><i class="fa fa-circle-o"></i> Consulta Ventas</a></li>                
                <li><a href="ventasfechaproducto.php"><i class="fa fa-circle-o"></i> Consulta Ventas por producto</a></li>                
              </ul>
            </li>
            ';
            } */
            ?>
            <?php
         /*    if($_SESSION['reportes']==1)
            {
              echo '<li class="treeview">
              <a href="#">
                <i class="fa fa-tasks"></i> <span>Reportes</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a target="blank_" href="../reportes/rptarticulos.php"><i class="fa fa-circle-o"></i>Reporte Articulos</a></li>                
              </ul>
            </li>
            ';
            } */
            ?>            
            <?php
        /*     if($_SESSION['backup']==1)
            {
              echo '<li class="treeview">
              <a href="#">
                <i class="fa fa-tasks"></i> <span>BackUp</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a target="blank_" href="myphp-backup.php"><i class="fa fa-circle-o"></i>Generar Backup</a></li>                
              </ul>
            </li>
            ';
            } */
            ?>


                        
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>
