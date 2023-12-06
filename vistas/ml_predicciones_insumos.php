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
/* 
if ($_SESSION['ml_insumos']==1)
{ */
?>
<style>
  /*Estilos login*/
#divLoading{
/* 	position: fixed; */
	top: 0;
	width: 100%;
	height: 30%;
	display: flex;
	justify-content: center;
	align-items: center;
	background: rgba(254,254,255, .65);
	z-index: 9999;
	display: none;
}
#divLoading img{
	width: 50px;
	height: 50px;
}
.required{
	color: red;
	font-size: 13pt;
	font-weight: bold;
}
</style>
<!--Contenido-->
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">        
        <!-- Main content -->
        <section class="content">
            <div class="row">
              <div class="col-md-12">
                  <div class="box">
                    <div class="box-header with-border">
                          <h1 class="box-title">Producto 
                           <button class="btn btn-primary" id="btnGMP" onclick="generateMaterialsPrediction()"><i class="fa fa-plus-circle"></i> Agregar con ML</button>
                          </h1>
                           <a class="btn btn-warning hidden" id="seeReports" href="ml_predicciones_insumos.php"> Ver imagenes </a>
                        <div class="box-tools pull-right">
                        </div>
                    </div>
        
              
                      <div id="divLoading">
                      <div>
                      <img src="../public/img/loading.svg" alt="Loading"> <span>Generando Graficos ML</span>
                      </div>
                      </div>
                     
        
            
                    <!-- /.box-header -->
                    <!-- centro -->
                    <div class="panel-body table-responsive" id="listadoregistros2">
                      <div class="imagenes">
                      <img src="../files/reportes_ml/prediccion_Botones_2024.png" alt="">
                      </div>
                      <div class="imagenes">
                      <img src="../files/reportes_ml/prediccion_Etiquetas_2024.png" alt="">
                      </div>
                      <div class="imagenes">
                      <img src="../files/reportes_ml/prediccion_Telas_2024.png" alt="">
                      </div>
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
<script type="text/javascript" src="scripts/ml_predicciones_insumos.js"></script>
<?php
}
ob_end_flush();
?>