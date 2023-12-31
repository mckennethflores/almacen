var tabla;
 
function init(){
	mostrarform(false);
	mostrarformMl(false);
	listar();

	$("#formulario").on("submit",function(e)
	{
		guardaryeditar(e);	
	})
	$("#formularioMl").on("submit",function(e)
	{
		/* e.preventDefault();
		console.log("comunicarme con python");
		return; */
		guardarConIa(e);	
		//guardaryeditarMl(e);	
	})

	$.post("../ajax/producto.php?op=selectCategoria", function(r){
				$("#categoriaid").html(r);
				$('#categoriaid').selectpicker('refresh');
	});

	$.post("../ajax/producto.php?op=selectMedia", function(r){
				$("#mediaid").html(r);
				$('#mediaid').selectpicker('refresh');
	});
	$("#imagenmuestra").hide();
	
}
 

function generateMaterialsPrediction(){
	var divLoading = document.querySelector("#divLoading");
	divLoading.style.display = "flex";
	/* console.log("alerta generateMaterialsPrediction"); */
	$.post("../ajax/producto.php?op=guardarConIaInsumos",{idpro : 1}, function(data, status)
	{
		console.log(data);
		$('#seeReports').removeClass('hidden');
		$('#seeReports').addClass("active");
		var divLoading = document.querySelector("#divLoading");
		divLoading.style.display = "none";

	
		 
	});
}

function limpiar()
{
	
	$("#idpro").val("");
	$("#categoriaid").val("");
	$("#mediaid").val("");
	$("#nom_pro").val("");
    $("#stock_pro").val("");
	$("#pre_com_pro").val("");
	$("#pre_ven_pro").attr("src","");
	$("#fec_pro").val("");
	 
	 

}
// no se modifica nada
function mostrarform(flag){
	limpiar();
	if(flag)
	{
		$("#listadoregistros").hide();
		$("#formularioregistros").show();
		$("#formularioregistrosMl").hide();
		$("#btnagregar2").hide();
		$("btnGuardar").prop("disabled",false);
		$("#btnagregar").hide();
		
	}else{
		$("#listadoregistros").show();
		$("#formularioregistrosMl").hide();
		$("#formularioregistros").hide();
		$("#btnagregar2").show();
		$("#btnagregar").show();
	}
}
// no se modifica nada
function mostrarformMl(flag){
	limpiar();
	if(flag)
	{
		$("#listadoregistros").hide();
		$("#formularioregistros").hide();
		$("#formularioregistrosMl").show();
		$("btnGuardar").prop("disabled",false);
		$("#btnagregar").hide();
		$("#btnagregar2").hide();
		
	}else{
		$("#listadoregistros").show();
		$("#formularioregistros").hide();
		$("#btnagregar").show();
	}
}
// no se modifica nada
function cancelarform(){
	limpiar();
	mostrarform(false);
	mostrarformMl(false);
}

function listar(){
 
	tabla=$('#tbllistado').dataTable(
	{
		"aProcessing": true,
		"aServerSide": true,
		dom: 'Bfrtip',
		buttons:	[
			'copyHtml5',
			'excelHtml5',
			'csvHtml5',
			'pdf'
		],
		"ajax":
			{
				url: '../ajax/producto_nombre.php?op=listarProductosParaProductoNombre',
				type: "get",
				dataType: "json",
				error: function (e){
					console.log(e.responseText);
				}
			},
		"bDestroy": true,
		"iDisplayLength": 25, // Paginacion c/ cuantos registros
		"order": [[ 0, "desc" ]] // Ordenar data
	}).DataTable();

}

 
//Esta función es para guardar o editar

function guardaryeditar(e)
{
	e.preventDefault();  // no activar la accion predeterminada del evento


		//$("#btnGuardar").prop("disabled",true);
		var formData = new FormData($("#formulario")[0]);
		$.ajax({
			url: "../ajax/producto.php?op=guardaryeditar",
			type: "POST",
			data: formData,
			contentType: false,
			processData: false,

			success: function(datos) //datos mensaje de archivo categoria ajax
			{
				bootbox.alert(datos);	  
				mostrarform(false);
				mostrarformMl(false);
				tabla.ajax.reload();
			}
		});
		limpiar();
	/* } */
}

function guardarConIa(e)
{
	e.preventDefault();  // no activar la accion predeterminada del evento

		//$("#btnGuardar").prop("disabled",true);
		var formData = new FormData($("#formularioMl")[0]);
		$.ajax({
			url: "../ajax/producto.php?op=guardarConIa",
			type: "POST",
			data: formData,
			contentType: false,
			processData: false,

			success: function(datos) //datos mensaje de archivo categoria ajax
			{
				bootbox.alert(datos);
				mostrarform(false);
				mostrarformMl(false);
				tabla.ajax.reload();
    /*             var array = JSON.parse(datos);  // Convertir la cadena JSON a un objeto JavaScript
                console.log(array);  // Debería mostrar el array en la consola */
				//$("#idpro").val(array.idpro);
			}
		});
		limpiar();
	/* } */
}

function mostrar(idpro)
{

	 
}

function desactivar(idpro)
{
	bootbox.confirm("¿Está Seguro de desactivar el artículo?", function(result){
		if(result)
        {
        	$.post("../ajax/producto.php?op=desactivar", {idpro : idpro}, function(e){
        		bootbox.alert(e);
	            tabla.ajax.reload();
        	});	
        }
	})
}

function eliminar(idpro)
{
	bootbox.confirm("¿Está Seguro de eliminar el artículo?", function(result){
		if(result)
        {
        	$.post("../ajax/producto.php?op=eliminar", {idpro : idpro}, function(e){
        		bootbox.alert(e);
	            tabla.ajax.reload();
        	});	
        }
	})
}

function activar(idpro)
{
	bootbox.confirm("¿Está Seguro de activar el artículo?", function(result){
		if(result)
        {
        	$.post("../ajax/producto.php?op=activar", {idpro : idpro}, function(e){
        		bootbox.alert(e);
	            tabla.ajax.reload();
        	});	
        }
	})
}



function generarCsvPrediccion()
{
	bootbox.confirm("¿Está Seguro de generar el CSV para predicción?", function(result){
		if(result)
        {
        	$.post("../ajax/reportes.php?op=reporte_prediccion_py", {CSV : 1}, function(e){
        		bootbox.alert(e);
	            tabla.ajax.reload();
/* 				var divLoading = document.querySelector("#btnagregarMl");
				divLoading.style.display = "block"; */
				$('#btnGMP').removeClass('hidden');
				$('#btnGMP').addClass("active");
				$('#generarCsv').addClass("hidden");
				
        	});	
        }
	})
}
init();