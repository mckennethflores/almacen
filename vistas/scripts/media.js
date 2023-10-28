var tabla;
 
function init(){
	mostrarform(false);
	listar();

	$("#formulario").on("submit",function(e)
	{
		guardaryeditar(e);	
	})
	$("#imagenmuestra").hide();
}
 
function limpiar()
{
	$("#idmedia").val("");
	$("#nombre").val("");
	$("#tipo").val("");
	$("#imagenmuestra").attr("src","");
	$("#imagenactual").val("");	
}

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

			'excelHtml5',
			'pdf'
		],
		"ajax":
			{
				url: '../ajax/media.php?op=listar',
				type: "get",
				dataType: "json",
				error: function (e){
					console.log(e.responseText);
				}	
			},	
		"bDestroy": true,
		"iDisplayLength": 5, // Paginacion c/ cuantos registros
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
		url: "../ajax/media.php?op=guardaryeditar",
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
}

function mostrar(idmedia)
{
	$.post("../ajax/media.php?op=mostrar",{idmedia : idmedia}, function(data, status)
	{
		/* console.log(data); return; */
		data = JSON.parse(data); // convierte los datos que se esta recibiendo de la url a un objeto javascrit
		mostrarform(true);

		$("#nombre").val(data.nombre);
		$("#tipo").val(data.tipo);
 		$("#idmedia").val(data.idmedia);
		 $("#imagenmuestra").show();
		 $("#imagenmuestra").attr("src","../files/media/"+data.cod_img);
		 $("#imagenactual").val(data.imagen);
 	})
}

function desactivar(idmedia)
{
	bootbox.confirm("¿Está Seguro de desactivar la imagen?", function(result){
		if(result)
        {
        	$.post("../ajax/media.php?op=desactivar", {idmedia : idmedia}, function(e){
        		bootbox.alert(e);
	            tabla.ajax.reload();
        	});	
        }
	})
}

function activar(idmedia)
{
	bootbox.confirm("¿Está Seguro de activar la Imagen?", function(result){
		if(result)
        {
        	$.post("../ajax/media.php?op=activar", {idmedia : idmedia}, function(e){
        		bootbox.alert(e);
	            tabla.ajax.reload();
        	});	
        }
	})
}

init();