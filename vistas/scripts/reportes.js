var tabla;

function init() {

	
	$('#mReportes').addClass("active");
  /* 	$("#fecha_inicio").change(listar);
	$("#fecha_fin").change(listar); */
	
	/* $.post("../ajax/auxiliar.php?op=selectAuxiliar", function (r) {
		$("#id_eta_re").html(r);
		$("#id_eta_re").selectpicker("refresh");
	});

	$.post("../ajax/usuario.php?op=selectUsuarios", function (r) {
		$("#id_usuario_re").html(r);
		$("#id_usuario_re").selectpicker("refresh");
	}); */

}

init();


//Función Listar
function listar()
{
	var fecha_inicio = $("#fecha_inicio").val();
	var fecha_fin = $("#fecha_fin").val();

	tabla=$('#tbllistado').dataTable(
	{
		"lengthMenu": [ 5, 10, 25, 75, 100],//mostramos el menú de registros a revisar
		"aProcessing": true,//Activamos el procesamiento del datatables
	    "aServerSide": true,//Paginación y filtrado realizados por el servidor
	    dom: '<Bl<f>rtip>',//Definimos los elementos del control de tabla
	    buttons: [		          
		            'copyHtml5',
		            'excelHtml5',
		            'csvHtml5',
		            'pdf'
		        ],
		"ajax":
				{
					url: '../ajax/reportes.php?op=movimientosfecha',
					data:{fecha_inicio: fecha_inicio,fecha_fin: fecha_fin},
					type : "get",
					dataType : "json",						
					error: function(e){
						console.log(e.responseText);	
					}
				},
		"language": {
            "lengthMenu": "Mostrar : _MENU_ registros",
            "buttons": {
            "copyTitle": "Tabla Copiada",
            "copySuccess": {
                    _: '%d líneas copiadas',
                    1: '1 línea copiada'
                }
            }
        },
		"bDestroy": true,
		"iDisplayLength": 24,//Paginación
	    "order": [[ 0, "desc" ]]//Ordenar (columna,orden)
	}).DataTable();
}


//Función Listar
function listarStockDeProductos()
{
	/* console.log("demo");
	return; */
/* 	var fecha_inicio = $("#fecha_inicio").val();
	var fecha_fin = $("#fecha_fin").val(); */

	tabla=$('#tbllistado').dataTable(
	{
		"lengthMenu": [ 5, 10, 25, 75, 100],//mostramos el menú de registros a revisar
		"aProcessing": true,//Activamos el procesamiento del datatables
	    "aServerSide": true,//Paginación y filtrado realizados por el servidor
	    dom: '<Bl<f>rtip>',//Definimos los elementos del control de tabla
	    buttons: [		          
		            'copyHtml5',
		            'excelHtml5',
		            'csvHtml5',
		            'pdf'
		        ],
		"ajax":
				{
					url: '../ajax/reportes.php?op=stockdeproductos',
					data:{fecha_inicio: 1,fecha_fin: 1},
					type : "get",
					dataType : "json",						
					error: function(e){
						console.log(e.responseText);	
					}
				},
		"language": {
            "lengthMenu": "Mostrar : _MENU_ registros",
            "buttons": {
            "copyTitle": "Tabla Copiada",
            "copySuccess": {
                    _: '%d líneas copiadas',
                    1: '1 línea copiada'
                }
            }
        },
		"bDestroy": true,
		"iDisplayLength": 24,//Paginación
	    "order": [[ 0, "asc" ]]//Ordenar (columna,orden)
	}).DataTable();
}

/* 	function listar() {

		var fecha_inicio = $("#fecha_inicio").val();
		var fecha_fin = $("#fecha_fin").val();
		var id_eta_re = $("#id_eta_re").val();
		var id_usuario_re = $("#id_usuario_re").val();

		if(fecha_inicio == ""){
			bootbox.alert("Selecciona la fecha de inicio");
		}else if (fecha_fin == ""){
			bootbox.alert("ingresa la fecha fin");
		}else if(id_eta_re == null || id_eta_re == "0"){
			bootbox.alert("Selecciona la etapa");
		}else{
	
			tabla = $('#tbllistado').dataTable({
				"aProcessing": true,
				"aServerSide": true,
				dom: 'Bfrtip',
				buttons: [
					'copyHtml5',
					'excelHtml5',
					'csvHtml5',
					'pdf'
				],
				"ajax": {
					url: '../ajax/reportes.php?op=contratosCerrados',
					data:{fecha_inicio: fecha_inicio, fecha_fin: fecha_fin, id_eta_re: id_eta_re, id_usuario_re: id_usuario_re},
					type: "get",
					dataType: "json",
					error: function (e) {
						console.log(e.responseText);
						//bootbox.alert(e.responseText);
					}

				},
				"language": {
					"lengthMenu": "Mostrar : _MENU_ registros",
					"buttons": {
						"copyTitle": "Tabla Copiada",
						"copySuccess": {
							_: '%d líneas copiadas',
							1: '1 línea copiada'
						}
					}
				},
				"bDestroy": true,
				"iDisplayLenght": 25,
				"order": [
					[0, "desc"]
				]

			}).DataTable();
		}
	} */

function verifyRolUser(){

	var formData = new FormData($("#formulario")[0]);
	$.ajax({
		url: "../ajax/usuario.php?op=verifyRolUser",
		type: "POST",
		data: formData,
		contentType: false,
		processData: false,
 
		success: function (datos) {

			var reportes = datos.trim();
			if(reportes == 'ejecutivoventas'){
				$("#empleado").addClass('hidden');
				
			}
			//console.log(datos.trim());
		
		}
	});
}
verifyRolUser();