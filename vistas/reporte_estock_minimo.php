<?php
ob_start();
session_start();
if(!isset($_SESSION["idusuario"]))
{
  header("Location: login.html");
}
else
{
require_once("header.php");

/* if ($_SESSION['almacen']==1)
{ */
?>

<!--Contenido-->
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">        
        <!-- Main content -->
        <section class="content">
            <div class="row">
              <div class="col-md-12">
                  <div class="box">
                    <div class="box-header with-border">
                          <h1 class="box-title">Reporte de stock minimo <button class="btn btn-success" id="btnagregar" onclick="mostrarform(true)"><i class="fa fa-plus-circle"></i> Agregar</button></h1>
                           <!-- <a class="btn btn-warning" target="_blank" href="../reportes/rptarticulos.php"> Reporte Articulos </a> -->
                        <div class="box-tools pull-right">
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <!-- centro -->
                    <div class="panel-body table-responsive" id="listadoregistros">
                        <table id="tbllistado_vencimiento" class="table table-striped table-bordered table-condensed table-hover">

                          <thead>
                            <th>Codigo</th>
                            <th>Producto</th>
                            <th>Fecha</th>
                            <th>Stock</th>
                            <th>Stock minimo</th>
                            <th>Codigo</th>
                            <th>Pre. Comp.</th>
                          </thead>
                          <tbody>                            
                          </tbody>
                          <tfoot>
                            <th>Codigo</th>
                            <th>Producto</th>
                            <th>Fecha</th>
                            <th>Stock</th>
                            <th>Stock minimo</th>
                            <th>Codigo</th>
                            <th>Pre. Comp.</th>
                          </tfoot>
                        </table>
                    </div>
                    <div class="panel-body" id="formularioregistros">
                        <form name="formulario" id="formulario" method="POST">
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Codigo Producto(*):</label>
                            <input type="hidden" name="idinventario" id="idinventario">
                            <input type="text" class="form-control" name="productoid" id="productoid"
                            required>
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Fecha:</label>
                            <input type="datetime" class="form-control" name="fecha" id="fecha" >
                          </div>

                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Cantidad(*):</label>
                            <input type="text" class="form-control" name="cantidad" id="cantidad" required>
                          </div>                       
                          

                          
                           
                          <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <button class="btn btn-primary" type="submit" id="btnGuardar"><i class="fa fa-save"></i> Guardar</button>

                            <button class="btn btn-danger" onclick="cancelarform()" type="button"><i class="fa fa-arrow-circle-left"></i> Cancelar</button>
                          </div>
                        </form>
                    </div>
                    <!--Fin centro -->
                  </div><!-- /.box -->
              </div><!-- /.col -->
          </div><!-- /.row -->
      </section><!-- /.content -->

    </div><!-- /.content-wrapper -->
  <!--Fin-Contenido-->

<?php
/* }
else
{
  require 'noacceso.php';
} */
require_once("footer.php");
?>
<script type="text/javascript" src="../public/js/JsBarcode.all.min.js"></script>
<script type="text/javascript" src="../public/js/jquery.PrintArea.js "></script>
<script type="text/javascript" src="scripts/inventario.js"></script>
<?php
}
ob_end_flush();
?>