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

/* if ($_SESSION['productos']==1)
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
                          <h1 class="box-title">Producto <button class="btn btn-success" id="btnagregar" onclick="mostrarform(true)"><i class="fa fa-plus-circle"></i> Agregar</button>
                           <!-- <button class="btn btn-primary" id="btnagregarMl" onclick="mostrarformMl(true)"><i class="fa fa-plus-circle"></i> Agregar con ML</button> --></h1>
                           <!-- <a class="btn btn-warning" target="_blank" href="../reportes/rptarticulos.php"> Reporte Articulos </a> -->
                        <div class="box-tools pull-right">
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <!-- centro -->
                    <div class="panel-body table-responsive" id="listadoregistros">
                        <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
                          <thead>
                          
                          <th>Opciones</th>
                            <th>Nombre</th>
                            <th>Categoría</th>
                            <th>Imagen</th>
                            <th>Cant.</th>
                            <th>P.C.</th>
                            <th>P.V.</th>                            
                            <th>C.Barras</th>                            
                            <th>Estado</th>
                          </thead>
                          <tbody>                            
                          </tbody>
                          <tfoot>
<!--                             <th>codigobarras</th>
                            <th>estado</th>
                            <th>categoria</th> -->
                            <th>Opciones</th>
                            <th>Nombre</th>
                            <th>Categoría</th>
                            <th>Imagen</th>
                            <th>Cant.</th>
                            <th>P.C.</th>
                            <th>P.V.</th>                            
                            <th>C.Barras</th>                            
                            <th>Estado</th>
                          </tfoot>
                        </table>
                    </div>
                    <div class="panel-body" id="formularioregistros">
                        <form name="formulario" id="formulario" method="POST">
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Nombre(*):</label>
                            <input type="hidden" name="idpro" id="idpro">
                            <input type="text" class="form-control" name="nom_pro" id="nom_pro" maxlength="250" placeholder="Nombre" required>
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Categoría(*):</label>
                            <select id="categoriaid" name="categoriaid" class="form-control selectpicker" data-live-search="true" required></select>
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Media(*):</label>
                            <select id="mediaid" name="mediaid" class="form-control selectpicker" data-live-search="true" required></select>
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Cantidad(*):</label>
                            <input type="decimal" class="form-control" name="stock_pro" id="stock_pro" required>
                          </div>                         
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Precio Compra:</label>
                            <input type="text" class="form-control" name="pre_com_pro" id="pre_com_pro" maxlength="255" placeholder="S/">
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Precio Venta:</label>
                            <input type="text" class="form-control" name="pre_ven_pro" id="pre_ven_pro" maxlength="255" placeholder="S/">
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Fecha:</label>
                            <input type="datetime" class="form-control" name="fec_pro" id="fec_pro" >
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Codigo de barras:</label>
                            <input type="text" class="form-control" name="codigobarras" id="codigobarras" maxlength="13" required>
                          </div>
                          
                           
                          <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <button class="btn btn-primary" type="submit" id="btnGuardar"><i class="fa fa-save"></i> Guardar</button>

                            <button class="btn btn-danger" onclick="cancelarform()" type="button"><i class="fa fa-arrow-circle-left"></i> Cancelar</button>
                          </div>
                        </form>
                    </div>
                    <!-- formularioRegistroMl -->
                    <div class="panel-body" id="formularioregistrosMl">
                        <form name="formularioMl" id="formularioMl" method="POST">
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Codigo de barras(*):</label>
                            <input type="hidden" name="idpro" id="idpro">
                            <input type="text" class="form-control" name="barcode_pro" id="barcode_pro" maxlength="250" placeholder="Barcode" >
                          </div>
                          <!-- <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Cantidad(*):</label>
                            <input type="decimal" class="form-control" name="stock_pro" id="stock_pro" >
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Precio Compra:</label>
                            <input type="text" class="form-control" name="pre_com_pro" id="pre_com_pro" maxlength="255" placeholder="S/">
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Precio Venta:</label>
                            <input type="text" class="form-control" name="pre_ven_pro" id="pre_ven_pro" maxlength="255" placeholder="S/">
                          </div> -->
                          <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <button class="btn btn-primary" type="submit" id="btnGuardarMl"><i class="fa fa-save"></i> Guardar</button>
                            <button class="btn btn-danger" onclick="cancelarform()" type="button"><i class="fa fa-arrow-circle-left"></i> Cancelar</button>
                          </div>
                        </form>
                    </div>
                    <!-- /formularioRegistroMl -->                    
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
<script type="text/javascript" src="scripts/producto_nombre.js"></script>
<?php
}
ob_end_flush();
?>