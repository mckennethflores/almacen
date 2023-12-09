<?php
ob_start();
session_start();

if (!isset($_SESSION["idusuario"]))
{
  header("Location: login.html");
}
else
{
require 'header.php';

/* if ($_SESSION['reportes']==1)
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
                          <h1 class="box-title">Reportes</h1>
                        <div class="box-tools pull-right"></div>
                    </div>
                    <!-- /.box-header -->
                    <!-- centro -->
                    <div class="panel-body table-responsive" id="listadoregistros">
                   
                       <!--  <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                            <label for="">Fecha Inicio</label>
                            <input type="date" class="form-control" name="fecha_inicio" id="fecha_inicio" value="">
                        </div>
                        <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                            <label for="">Fecha Fin</label>
                            <input type="date" class="form-control" name="fecha_fin" id="fecha_fin" value="<?php echo date("Y-m-d"); ?>">
                        </div> -->
                       
                        <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                            <label>Consultar:</label>
                            <button class="btn btn-primary" onclick="listar()"><i class="fa fa-save"></i> Consultar</button>
                        </div>

                 
                        <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
                          <thead>
                            <th>codigobarras</th>
                            <th>estado </th>
                            <th>categoria</th>
                          </thead>
                          <tbody>                            
                          </tbody>
                          <tfoot>
                            <th>codigobarras</th>
                            <th>estado </th>
                            <th>categoria</th>
                          </tfoot>
                        </table>
                    </div>
                    <!--Fin centro -->
                  </div><!-- /.box -->
              </div><!-- /.col -->
          </div><!-- /.row -->
      </section><!-- /.content -->

    </div><!-- /.content-wrapper -->
  <!--Fin-Contenido-->
<?php
/* }else
{
  require 'noacceso.php';
} */
require 'footer.php';
?>
<script src="../public/plugins/chartjs/Chart.min.js"></script>
<script type="text/javascript" src="scripts/reporte_exportar_barcode_py.js"></script>
<?php 
}
ob_end_flush();
?>