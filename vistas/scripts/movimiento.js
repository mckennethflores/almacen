var tabla;
 
function init(){
	mostrarform(false);
	listar();

	$("#formulario").on("submit",function(e)
	{
		guardaryeditar(e);	
	})

	$.post("../ajax/movimiento.php?op=selectProducto", function(r){
				$("#productoid").html(r);
				$('#productoid').selectpicker('refresh');
	});

	$.post("../ajax/movimiento.php?op=listarTipoMovimiento", function(r){
				$("#tipomovimientoid").html(r);
				$('#tipomovimientoid').selectpicker('refresh');
	});
	$("#imagenmuestra").hide();
}
 
function limpiar()
{
	
	$("#idmov").val("");
	$("#productoid").val("");
	$("#usuarioid").val("");
	$("#tipomovimientoid").val("");
    $("#cantidad").val("");
	$("#precio").val("");
	
	$("#fecha").val("");
	 
	 

}
// no se modifica nada
function mostrarform(flag){
	limpiar();
	if(flag)
	{
		$("#listadoregistros").hide();
		$("#formularioregistros").show();
		$("btnGuardar").prop("disabled",false);
		$("#btnagregar").hide();
		
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
				url: '../ajax/movimiento.php?op=listar',
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
			url: "../ajax/movimiento.php?op=guardaryeditar",
			type: "POST",
			data: formData,
			contentType: false,
			processData: false,

			success: function(datos) //datos mensaje de archivo categoria ajax
			{
				bootbox.alert(datos);	  
				mostrarform(false);
				tabla.ajax.reload();
			}
		});
		limpiar();
	/* } */
}

function mostrar(idmov)
{
	$.post("../ajax/movimiento.php?op=mostrar",{idmov : idmov}, function(data, status)
	{
 
		data = JSON.parse(data); // convierte los datos que se esta recibiendo de la url a un objeto javascrit
		mostrarform(true);
		
		$("#idmov").val(data.idmov);
		$("#productoid").val(data.productoid);
	    $('#productoid').selectpicker('refresh');
		$("#tipomovimientoid").val(data.tipomovimientoid);
	    $('#tipomovimientoid').selectpicker('refresh');
        $("#cantidad").val(data.cantidad);
        $("#precio").val(data.precio);
        $("#fecha").val(data.fecha);
		 
		//generarbarcode();
	 })
	 
}

/* function desactivar(idmov)
{
	bootbox.confirm("¿Está Seguro de desactivar el artículo?", function(result){
		if(result)
        {
        	$.post("../ajax/movimiento.php?op=desactivar", {idmov : idmov}, function(e){
        		bootbox.alert(e);
	            tabla.ajax.reload();
        	});	
        }
	})
} */

function eliminar(idmov)
{
	bootbox.confirm("¿Está Seguro de eliminar el artículo?", function(result){
		if(result)
        {
        	$.post("../ajax/movimiento.php?op=eliminar", {idmov : idmov}, function(e){
        		bootbox.alert(e);
	            tabla.ajax.reload();
        	});	
        }
	})
}

/* function activar(idmov)
{
	bootbox.confirm("¿Está Seguro de activar el artículo?", function(result){
		if(result)
        {
        	$.post("../ajax/movimiento.php?op=activar", {idmov : idmov}, function(e){
        		bootbox.alert(e);
	            tabla.ajax.reload();
        	});	
        }
	})
} */


init();