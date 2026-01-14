/********************************************************************
		   LISTAR VENTAS POR MES Y AÑO 
********************************************************************/
var tbl_ventaMes_anio;
function Listar_VentaMes_anio() {//enviarlo al scrip en MANTENIMIENTO ROL
	var mes = document.getElementById('select_mes_venta').value;
	var anio = document.getElementById('select_anio_venta').value;
	var sucursa = document.getElementById('select_sucur_anio').value;

		if ($.fn.DataTable.isDataTable('#tabla_reporte_venta_mes')) {
		tbl_servicio_mes.destroy();
	}

	tbl_ventaMes_anio = $("#tabla_reporte_venta_mes").DataTable({
		"responsive": true,
		"ordering": false,
		"bLengthChange": true,
		"searching": { "regex": false },
		"lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
		"pageLength": 10,
		"destroy": true,
		"async": false,
		"processing": true,
		"dom": 'Blfrtip',
		"buttons": [
			{
				"extend": 'excelHtml5',
				"title": 'Reporte Venta por mes',
				"text": '<i class="fa fa-file-excel"></i>',
				"titleAttr": 'Exportar a Excel'
			},
		],
		"drawCallback": function () {
			//alert("La tabla se está recargando"); 
			var api = this.api();
			$(api.column(3).footer()).html(
				'Total: ' + api.column(3, { page: 'current' }).data().sum()
			)
		},


		"ajax": {
			"url": "../controller/reporteventa/controlador_venta_reporte_mes_anio.php",
			type: 'POST',
			data: {
				mes: mes,
				anio: anio,
				sucursa:sucursa
			}
		},
		"columns": [
			//todos los datos del procedimiento almacenado
			{ "data": "sucur" },
			{ "data": "cliente_nombres" },
			{ "data": "comprobante" },
			{ "data": "venta_total" },
			{ "data": "cant_prod" },
			{ "data": "venta_fregistro" },
			{ "data": "usu_nombre" },

		],
		"language": idioma_espanol,
		select: true
	});

}





/********************************************************************
		   VENTA TOTAL DE VENTAS POR AÑO
********************************************************************/
var tbl_reporteventatotalanio;
function Listar_ReporteVentaTotalAnio() {//enviarlo al scrip en MANTENIMIENTO ROL
	tbl_reporteventatotalanio = $("#tabla_reportetotal_anual").DataTable({
		"responsive": true,
		"ordering": false,
		"bLengthChange": true,
		"searching": { "regex": false },
		"lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
		"pageLength": 10,
		"destroy": true,
		"async": false,
		"bprocessing": true,
		"dom": 'Brt',
		"buttons": [
			{
				"extend": 'excelHtml5',
				"title": 'Reporte Venta por Anio',
				"text": '<i class="fa fa-file-excel"></i>',
				"titleAttr": 'Exportar a Excel'
			},
		],
		"ajax": {
			"url": "../controller/reporteventa/controlador_reporteventa_total_anio.php",
			type: 'POST'

		},
		"columns": [
			//todos los datos del procedimiento almacenado

			{ "data": "ano" },
			{ "data": "cant_venta_ano" },
			{ "data": "total_venta_ano" },
			//{"defaultContent": "<center>"+"<span class='imprimir text-success px-1' style='cursor:pointer;' title='Imprimir Comprobante'><i class= 'fa fa-print'></i></span>"+"</center>"}


		],
		"language": idioma_espanol,
		select: true
	});
	//contador en cada tabla

}



    function cargar_SelectSucursales(){
 	$.ajax({
 		url:'../controller/usuario/Cargar_select_Sucursal.php',
 		type: 'POST'
 	}).done(function(resp){
 		let data = JSON.parse(resp);//POSICION DE LA FILA Y COLUMNA
 		let llenardata = "<option value=''>Seleccione</option>";
 		if (data.length>0) {
 			for (let i = 0; i < data.length; i++) {
 				llenardata+="<option value='"+data[i][0]+"'>"+data[i][1]+"</option>";
 			}
 			
			document.getElementById('select_sucur').innerHTML = llenardata; 
			document.getElementById('select_sucur_anio').innerHTML = llenardata;
 			document.getElementById('select_sucur_anio_total').innerHTML = llenardata;

 		}else{
 			llenardata+="<option value=''>No se encontraron datos</option>";

 			document.getElementById('select_sucur').innerHTML = llenardata;
			document.getElementById('select_sucur_anio').innerHTML = llenardata;
			document.getElementById('select_sucur_anio_total').innerHTML = llenardata;
			

 		}
 	})
 }

  function cargar_SelectSucursales_pivot(){
 	$.ajax({
 		url:'../controller/usuario/Cargar_select_Sucursal.php',
 		type: 'POST'
 	}).done(function(resp){
 		let data = JSON.parse(resp);//POSICION DE LA FILA Y COLUMNA
 		let llenardata = "<option value=''>Seleccione</option>";
 		if (data.length>0) {
 			for (let i = 0; i < data.length; i++) {
 				llenardata+="<option value='"+data[i][0]+"'>"+data[i][1]+"</option>";
 			}
 			
		
			document.getElementById('select_sucur_pivot').innerHTML = llenardata;
			document.getElementById('select_sucur_pivot_anio').innerHTML = llenardata;
			document.getElementById('select_sucur_pivot_usuario').innerHTML = llenardata;
 		}else{
 			llenardata+="<option value=''>No se encontraron datos</option>";
			document.getElementById('select_sucur_pivot').innerHTML = llenardata;
			document.getElementById('select_sucur_pivot_anio').innerHTML = llenardata;
			document.getElementById('select_sucur_pivot_usuario').innerHTML = llenardata;

 		}
 	})
 }






/********************************************************************
		  PIVOT VENTAS
********************************************************************/
var tbl_pivot_ventas;
function Listar_pivot_ventas() {//enviarlo al scrip en MANTENIMIENTO ROL
	var sucursa = document.getElementById('select_sucur_pivot').value;

	// 	if ($.fn.DataTable.isDataTable('#tabla_pivot_ventas')) {
	// 	tbl_servicio_mes.destroy();
	// }

	tbl_pivot_ventas = $("#tabla_pivot_ventas").DataTable({
		"responsive": true,
		"ordering": false,
		"bLengthChange": true,
		"searching": { "regex": false },
		"lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
		"pageLength": 10,
		"destroy": true,
		"async": false,
		"bprocessing": true,
		"dom": 'Brt',
		"buttons": [
			{
				"extend": 'excelHtml5',
				"title": 'Reporte Pivot de ventas',
				"text": '<i class="fa fa-file-excel"></i>',
				"titleAttr": 'Exportar a Excel',
				"excelStyles": {
					template: "header_blue",  // Apply the 'header_blue' template part (white font on a blue background in the header/footer)
					//template:"green_medium" 



				},
			},
		],
		"ajax": {
			"url": "../controller/reporteventa/controlador_reporteventa_pivot.php",
			type: 'POST',
			data: {
				sucursa: sucursa
			}

		},


		"columns": [
			//todos los datos del procedimiento almacenado

			{ "data": "anio" },
			{ "data": "enero" },
			{ "data": "febrero" },
			{ "data": "marzo" },
			{ "data": "abril" },
			{ "data": "mayo" },
			{ "data": "junio" },
			{ "data": "julio" },
			{ "data": "agosto" },
			{ "data": "setiembre" },
			{ "data": "octubre" },
			{ "data": "noviembre" },
			{ "data": "diciembre" },
			{ "data": "total" },
			//{"defaultContent": "<center>"+"<span class='imprimir text-success px-1' style='cursor:pointer;' title='Imprimir Comprobante'><i class= 'fa fa-print'></i></span>"+"</center>"}

		],
		"language": idioma_espanol,
		select: true
	});
	//contador en cada tabla

}




/********************************************************************
		   LISTAR VENTAS POR AÑO
********************************************************************/
var tbl_venta_anioM;
function Listar_Venta_anioM() {//enviarlo al scrip en MANTENIMIENTO ROL
	var anio = document.getElementById('select_anio_venta02').value;
	var sucursa = document.getElementById('select_sucur_anio_total').value;

		if ($.fn.DataTable.isDataTable('#tabla_reporte_venta_anio')) {
		tbl_servicio_mes.destroy();
	}

	tbl_venta_anioM = $("#tabla_reporte_venta_anio").DataTable({
		"responsive": true,
		"ordering": false,
		"bLengthChange": true,
		"searching": { "regex": false },
		"lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
		"pageLength": 10,
		"destroy": true,
		"async": false,
		"processing": true,
		"dom": 'Blfrtip',
		"buttons": [
			{
				"extend": 'excelHtml5',
				"title": 'Reporte Venta por mes',
				"text": '<i class="fa fa-file-excel"></i>',
				"titleAttr": 'Exportar a Excel'
			},

		],
		"drawCallback": function () {
			//alert("La tabla se está recargando"); 
			var api = this.api();
			$(api.column(4).footer()).html(
				'Total: ' + api.column(4, { page: 'current' }).data().sum()
			)
		},


		"ajax": {
			"url": "../controller/reporteventa/controlador_venta_reporte_por_anio.php",
			type: 'POST',
			data: {
				anio: anio,
				sucursa:sucursa
			}
		},
		"columns": [
			//todos los datos del procedimiento almacenado
			{ "data": "sucur" },
			{ "data": "ano" },
			{ "data": "mesnombre" },
			{ "data": "cant_ventas" },
			{ "data": "total" },

		],
		"language": idioma_espanol,
		select: true
	});

}




/********************************************************************
		   LISTAR RECORD DE VENTAS POR USUARIO - AÑO
********************************************************************/
var tbl_record_venta_usu;
function Listar_record_Venta_anio() {//enviarlo al scrip en MANTENIMIENTO ROL
	var anio = document.getElementById('select_anio_venta_record_u').value;
	var sucursa = document.getElementById('select_sucur_pivot_anio').value;

		if ($.fn.DataTable.isDataTable('#tabla_reporte_record_venta_usuario')) {
		tbl_record_venta_usu.destroy();
	}
	tbl_record_venta_usu = $("#tabla_reporte_record_venta_usuario").DataTable({
		"responsive": true,
		"ordering": false,
		"bLengthChange": true,
		"searching": { "regex": false },
		"lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
		"pageLength": 10,
		"destroy": true,
		"async": false,
		"processing": true,
		"dom": 'Blfrtip',
		"buttons": [
			{
				"extend": 'excelHtml5',
				"title": 'Reporte Record de Venta por usuario - año',
				"text": '<i class="fa fa-file-excel"></i>',
				"titleAttr": 'Exportar a Excel'
			},
		],
		"drawCallback": function () {
			//alert("La tabla se está recargando"); 
			var api = this.api();
			$(api.column(4).footer()).html(
				'Total: ' + api.column(4, { page: 'current' }).data().sum()
			)
		},


		"ajax": {
			"url": "../controller/reporteventa/controlador_venta_record_usuario.php",
			type: 'POST',
			data: {
				anio: anio,
				sucursa:sucursa
			}
		},
		"columns": [
			//todos los datos del procedimiento almacenado
			{ "data": "sucur" },
			{ "data": "ano" },
			{ "data": "nom_usuario" },
			{ "data": "cant_ventas" },
			{ "data": "total" },

		],
		"language": idioma_espanol,
		select: true
	});

}



/********************************************************************
		   CARGAR AÑOS PARA RECORD USUARIO
********************************************************************/
function cargar_SelectAnio_record_usu() {//enviamos al scrpit mantenimiento examen
	$.ajax({
		url: '../controller/reporteventa/controlador_cargar_anio.php',
		type: 'POST'
	}).done(function (resp) {

		let data = JSON.parse(resp);//POSICION DE LA FILA Y COLUMNA
		let llenardata = "<option value=''>Seleccione</option>";
		if (data.length > 0) {
			for (let i = 0; i < data.length; i++) {
				llenardata += "<option >" + data[i][0] + "</option>";
			}
			document.getElementById('select_anio_venta_record_u').innerHTML = llenardata;//primero para registrar luego en modificar colocamos el select editar
		} else {
			llenardata += "<option value=''>No se encontraron datos</option>";
			document.getElementById('select_anio_venta_record_u').innerHTML = llenardata;


		}
	})
}


/********************************************************************
		   LISTAR VENTAS USUARIO DETALLADO
********************************************************************/
var tbl_record_usuario_deta;
function Listar_record_usuario() {//enviarlo al scrip en MANTENIMIENTO ROL
	var usuario = document.getElementById('select_usuario').value;
	var anio = document.getElementById('select_anio_usuario').value;
	var sucursa = document.getElementById('select_sucur_pivot_usuario').value;

		if ($.fn.DataTable.isDataTable('#tabla_record_usuario_a')) {
		tbl_record_usuario_deta.destroy();
	}
	tbl_record_usuario_deta = $("#tabla_record_usuario_a").DataTable({
		"responsive": true,
		"ordering": false,
		"bLengthChange": true,
		"searching": { "regex": false },
		"lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
		"pageLength": 10,
		"destroy": true,
		"async": false,
		"processing": true,
		"dom": 'Blfrtip',
		"buttons": [
			{
				"extend": 'excelHtml5',
				"title": 'Reporte detallado por usuario',
				"text": '<i class="fa fa-file-excel"></i>',
				"titleAttr": 'Exportar a Excel'
			},
		],
		"drawCallback": function () {
			//alert("La tabla se está recargando"); 
			var api = this.api();
			$(api.column(5).footer()).html(
				'Total: ' + api.column(5, { page: 'current' }).data().sum()
			)
		},


		"ajax": {
			"url": "../controller/reporteventa/controlador_venta_record_usuario_detallado.php",
			type: 'POST',
			data: {
				usuario: usuario,
				anio: anio,
				sucursa:sucursa
			}
		},
		"columns": [
			//todos los datos del procedimiento almacenado
			{ "data": "sucur" },
			{ "data": "ano" },
			{ "data": "mesnombre" },
			{ "data": "usu_nombre" },
			{ "data": "cant_ventas" },
			{ "data": "total" }

		],
		"language": idioma_espanol,
		select: true
	});

}



/********************************************************************
			CARGAR AÑOS RECORD DETALLADO DE USUARIOS
 ********************************************************************/
function cargar_SelectAnio_Venta_usua_detallado() {//enviamos al scrpit mantenimiento examen
	$.ajax({
		url: '../controller/reporteventa/controlador_cargar_anio.php',
		type: 'POST'
	}).done(function (resp) {

		let data = JSON.parse(resp);//POSICION DE LA FILA Y COLUMNA
		let llenardata = "<option value=''>Seleccione</option>";
		if (data.length > 0) {
			for (let i = 0; i < data.length; i++) {
				llenardata += "<option >" + data[i][0] + "</option>";
			}
			document.getElementById('select_anio_usuario').innerHTML = llenardata;//primero para registrar luego en modificar colocamos el select editar
		} else {
			llenardata += "<option value=''>No se encontraron datos</option>";
			document.getElementById('select_anio_usuario').innerHTML = llenardata;


		}
	})
}



/********************************************************************
			CARGAR USUARIOS EN COMBO DE REPORTE - RECORD DETALLADO
 ********************************************************************/
function cargar_Select_Usuarios() {//enviamos la funcion al view mantenimiento examen
	$.ajax({
		url: '../controller/reporteventa/controlador_select_usuarios.php',
		type: 'POST'
	}).done(function (resp) {

		let data = JSON.parse(resp);
		let llenardata = "<option value=''>Seleccione</option>";
		if (data.length > 0) {
			for (let i = 0; i < data.length; i++) {
				//llenardata+="<option >"+data[i][1]+"</option>";
				llenardata += "<option value='" + data[i][0] + "'>" + data[i][1] + "</option>";
			}
			document.getElementById('select_usuario').innerHTML = llenardata;
		} else {
			llenardata += "<option value=''>No se encontraron datos</option>";
			document.getElementById('select_usuario').innerHTML = llenardata;


		}
	})
}




/********************************************************************
		   CARGAR AÑOS EN VENTAS SOLO POR AÑO
********************************************************************/
function cargar_SelectAnio_VentaMes() {//enviamos al scrpit mantenimiento examen
	$.ajax({
		url: '../controller/reporteventa/controlador_cargar_anio.php',
		type: 'POST'
	}).done(function (resp) {

		let data = JSON.parse(resp);//POSICION DE LA FILA Y COLUMNA
		let llenardata = "<option value=''>Seleccione</option>";
		if (data.length > 0) {
			for (let i = 0; i < data.length; i++) {
				llenardata += "<option >" + data[i][0] + "</option>";
			}
			document.getElementById('select_anio_venta').innerHTML = llenardata;//primero para registrar luego en modificar colocamos el select editar
		} else {
			llenardata += "<option value=''>No se encontraron datos</option>";
			document.getElementById('select_anio_venta').innerHTML = llenardata;


		}
	})
}


/********************************************************************
		   CARGAR AÑOS QUE SE ENCUENTRAN EN LA BASE - VENTAS
********************************************************************/
function cargar_SelectAnioVenta() {//enviamos al scrpit mantenimiento examen
	$.ajax({
		url: '../controller/reporteventa/controlador_cargar_anio.php',
		type: 'POST'
	}).done(function (resp) {

		let data = JSON.parse(resp);//POSICION DE LA FILA Y COLUMNA
		let llenardata = "<option value=''>Seleccione</option>";
		if (data.length > 0) {
			for (let i = 0; i < data.length; i++) {
				llenardata += "<option >" + data[i][0] + "</option>";
			}
			document.getElementById('select_anio_venta02').innerHTML = llenardata;//primero para registrar luego en modificar colocamos el select editar
		} else {
			llenardata += "<option value=''>No se encontraron datos</option>";
			document.getElementById('select_anio_venta02').innerHTML = llenardata;


		}
	})
}




/********************************************************************
		   liSTAR VENTAS DEL DIA POR RANGO DE FECHAS
********************************************************************/

var tbl_venta_dia;
function Listar_Venta_del_dia() {//enviarlo al scrip en MANTENIMIENTO reporte venta
	var finicio = document.getElementById('text_finicio').value;
	var ffin = document.getElementById('text_ffin').value;
	var sucursa = document.getElementById('select_sucur').value;

		if ($.fn.DataTable.isDataTable('#tabla_reporte_gasto_anio')) {
		tbl_servicio_mes.destroy();
	}

	tbl_venta_dia = $("#tabla_reporte_venta_del_dia").DataTable({
		"responsive": true,
		"ordering": false,
		"bLengthChange": true,
		"searching": { "regex": false },
		"lengthMenu": [[25, 50, 100, -1], [25, 50, 100, "All"]],
		"pageLength": 25,
		"destroy": true,
		"async": false,
		"processing": true,
		"dom": 'Blfrtip',
		"buttons": [
			{
				"extend": 'excelHtml5',
				"title": 'Reporte Ventas del dia',
				"exportOptions": {
					'columns': [0, 1, 2, 3, 4, 5, 6,7]
				},
				"text": '<i class="fa fa-file-excel"></i>',
				"titleAttr": 'Exportar a Excel'
			},
			{
				"extend": 'pdfHtml5',
				"text": '<i class="fas fa-file-pdf"></i> ',
				"titleAttr": 'Exportar a Pdf',
				"download": 'open'
			}


		],
		"drawCallback": function () {
			//alert("La tabla se está recargando"); 
			var api = this.api();
			var api2 = this.api();
			var api3 = this.api();
			$(api.column(7).footer()).html(
				'' + api.column(7, { page: 'current' }).data().sum()
			)
			$(api2.column(6).footer()).html(
				'' + api2.column(6, { page: 'current' }).data().sum()
			)
			$(api3.column(5).footer()).html(
				'' + api3.column(5, { page: 'current' }).data().sum()
			)
		},

		"ajax": {
			"url": "../controller/reporteventa/controlador_reporteventa_del_dia.php",
			type: 'POST',
			data: {
				finicio: finicio,
				ffin: ffin,
				sucursa: sucursa
			}
		},
		"columns": [
			//todos los datos del procedimiento almacenado
			//	{"defaultContent": ""},//cintador 
			{ "data": "sucur" },
			{ "data": "fecha" },
			{ "data": "tipo_comprobante" },
			{ "data": "comprobante" },
			{ "data": "cliente" },
			{ "data": "base_imp" },
			{ "data": "igv" },
			{ "data": "total" },
			{ "data": "usuario" },

			/*	{"data":"venta_comprobante",//editar
					render: function(data,type,row){
						"<center>"+"<span class='editarv text-primary px-1' style='cursor:pointer;'   title='Editar Comprobante'><i class= 'fa fa-eye'></i></span><span class='pagar text-success px-1' style='cursor:pointer;' title='Pagar la venta total'><i class= 'fa fa-hand-holding-usd'></i></span><span class='imprimir text-primary px-1' style='cursor:pointer;' title='Imprimir Comprobante'><i class= 'fa fa-print'></i></span><span class='anular text-danger px-1' style='cursor:pointer;' title='Anular Comprobante'><i class= 'fa fa-ban'></i></span><span class='imprimirticket text-info px-1' style='cursor:pointer;' title='Imprimir Ticket'><i class= 'fa fa-file-pdf'></i></span>"+"</center>"
									
					}
				},*/


		],
		"language": idioma_espanol,
		select: true
	});
	//contador en cada tabla
	/*	tbl_venta.on('draw.td',function(){
			var PageInfo = $("#tabla_venta").DataTable().page.info();
			tbl_venta.column(0,{page: 'current'}).nodes().each(function(cell,i){
				cell.innerHTML = i + 1 + PageInfo.start;
			});
		});*/
}	