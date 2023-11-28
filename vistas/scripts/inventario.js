var tabla;
 
function init(){
	mostrarform(false);
	listar();
	listar_exactitud();
	listar_kardex();
	$("#formulario").on("submit",function(e)
	{
		guardaryeditar(e);	
	})

/* 	$.post("../ajax/producto.php?op=selectCategoria", function(r){
				$("#categoriaid").html(r);
				$('#categoriaid').selectpicker('refresh');
	});

	$.post("../ajax/producto.php?op=selectMedia", function(r){
				$("#mediaid").html(r);
				$('#mediaid').selectpicker('refresh');
	}); */
	$("#imagenmuestra").hide();
}
 
function limpiar()
{
	
	$("#idinventario").val("");
	$("#productoid").val("");
	$("#fecha").val("");
	$("#cantidad").val("");
/*     $("#stock_pro").val("");
	$("#pre_com_pro").val("");
	$("#pre_ven_pro").attr("src","");
	$("#fec_pro").val("");
	  */
	 

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
		genDate();
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
				url: '../ajax/inventario.php?op=listar',
				type: "get",
				dataType: "json",
				error: function (e){
					console.log(e.responseText);
				}
			},
		"bDestroy": true,
		"iDisplayLength": 25, // Paginacion c/ cuantos registros
		"order": [[ 0, "asc" ]] // Ordenar data
	}).DataTable();

}

function listar_exactitud(){
 
	tabla=$('#tbllistado_exactitud').dataTable(
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
				url: '../ajax/inventario.php?op=rpt_exactitud',
				type: "get",
				dataType: "json",
				error: function (e){
					console.log(e.responseText);
				}
			},
		"bDestroy": true,
		"iDisplayLength": 25, // Paginacion c/ cuantos registros
		"order": [[ 0, "asc" ]] // Ordenar data
	}).DataTable();

}
function listar_kardex(){
 
	tabla=$('#tbllistado_kardex').dataTable(
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
				url: '../ajax/inventario.php?op=rpt_kardex',
				type: "get",
				dataType: "json",
				error: function (e){
					console.log(e.responseText);
				}
			},
		"bDestroy": true,
		"iDisplayLength": 25, // Paginacion c/ cuantos registros
		"order": [[ 0, "asc" ]] // Ordenar data
	}).DataTable();

}

 function genDate(){
    var fechaHoraActual = new Date();
    var fechaFormateada = fechaHoraActual.getFullYear() + '-' + 
    ('0' + (fechaHoraActual.getMonth()+1)).slice(-2) + '-' + 
    ('0' + fechaHoraActual.getDate()).slice(-2) + ' ' + 
    ('0' + fechaHoraActual.getHours()).slice(-2) + ':' + 
    ('0' + fechaHoraActual.getMinutes()).slice(-2) + ':' + 
    ('0' + fechaHoraActual.getSeconds()).slice(-2);
    
    document.getElementById("fecha").value = fechaFormateada;

    //console.log(fechaFormateada);
 }
//Esta función es para guardar o editar

function guardaryeditar(e)
{
	e.preventDefault();  // no activar la accion predeterminada del evento


		//$("#btnGuardar").prop("disabled",true);
		var formData = new FormData($("#formulario")[0]);
		$.ajax({
			url: "../ajax/inventario.php?op=guardaryeditar",
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

function mostrar(idinventario)
{
	$.post("../ajax/inventario.php?op=mostrar",{idinventario : idinventario}, function(data, status)
	{
 
		data = JSON.parse(data); // convierte los datos que se esta recibiendo de la url a un objeto javascrit
		mostrarform(true);
		
		$("#idinventario").val(data.idinventario);
		$("#productoid").val(data.productoid);
	 
		$("#fecha").val(data.fecha);
	    
        $("#cantidad").val(data.cantidad);
       
		//generarbarcode();
	 })
	 
}

function desactivar(idinventario)
{
	bootbox.confirm("¿Está Seguro de desactivar el artículo?", function(result){
		if(result)
        {
        	$.post("../ajax/inventario.php?op=desactivar", {idinventario : idinventario}, function(e){
        		bootbox.alert(e);
	            tabla.ajax.reload();
        	});	
        }
	})
}

function eliminar(idinventario)
{
	bootbox.confirm("¿Está Seguro de eliminar el artículo?", function(result){
		if(result)
        {
        	$.post("../ajax/inventario.php?op=eliminar", {idinventario : idinventario}, function(e){
        		bootbox.alert(e);
	            tabla.ajax.reload();
        	});	
        }
	})
}

function activar(idinventario)
{
	bootbox.confirm("¿Está Seguro de activar el artículo?", function(result){
		if(result)
        {
        	$.post("../ajax/inventario.php?op=activar", {idinventario : idinventario}, function(e){
        		bootbox.alert(e);
	            tabla.ajax.reload();
        	});	
        }
	})
}


init();