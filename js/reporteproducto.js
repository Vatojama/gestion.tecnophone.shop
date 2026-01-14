/********************************************************************
		   REPORTE PRODUCTO ENTRADAS Y SALIDAD
********************************************************************/
var tbl_reporte_producto_es;
function Listar_Reporte_Producto_EnSal() {//enviarlo al scrip en MANTENIMIENTO ROL
	let sucursa = document.getElementById('select_sucur').value;
		if ($.fn.DataTable.isDataTable('#tabla_reporte_producto_ensal')) {
		tbl_reporte_producto_es.destroy();
	}
	tbl_reporte_producto_es = $("#tabla_reporte_producto_ensal").DataTable({
		"responsive": true,
		"ordering": false,
		"bLengthChange": true,
		"searching": { "regex": false },
		"lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
		"pageLength": 25,
		"destroy": true,
		"async": false,
		"bprocessing": true,
		"dom": 'Bfl',
		"buttons": [
			{
				"extend": 'excelHtml5',
				"titleAttr": 'Exportar a Excel',
				"exportOptions": {
					'columns': [0, 1, 2]
				},
				"text": '<i class="fa fa-file-excel"></i>',

				
			},

			{
				"extend": 'pdfHtml5',
				"text": '<i class="fa fa-print"></i> ',
				"titleAttr": 'Exportar a Pdf',
				"exportOptions": {
					'columns': [0, 1, 2]
				},
				"download": 'open'
			},

		],
		"rowCallback": function (row, data) {
			if (data.stock_actual < 3) {

				$('td', row).css({
					'background-color': '#ff5252',
					'color': 'white',


				});
			}
		},
		/*  "drawCallback":function(){
			//alert("La tabla se está recargando"); 
			var api = this.api();
			$(api.column(3).footer()).html(
				'Total: '+api.column(3, {page:'current'}).data().sum()
			)
		  },*/



		"ajax": {
			"url": "../controller/reporteproducto/controlador_reporteproducto_en_sal.php",
			type: 'POST',
			data: {
				sucursa: sucursa
			}
		},
		"columns": [
			//todos los datos del procedimiento almacenado
			{ "data": "codigo" },
			{ "data": "nombre" },
			// { "data": "precio" },
			// { "data": "ingresos" },
			// { "data": "salidas" },
			{ "data": "stock_actual" },
			{ "defaultContent": "<center>" + "<span class='ver_movimientos text-primary px-1' style='cursor:pointer;' title='ver movimientos del articulo' ><i class= 'fa fa-eye'></i></span><span class='imprimir_kardex text-success px-1' style='cursor:pointer;' title='Imprimir movimientos - kardex'><i class= 'fa fa-print'></i></span> <span class='ver_total_imei text-danger px-1' style='cursor:pointer;' title='Ver detalles de imei'><i class= 'fa fa-file'></i></span>" + "</center>" }
		],
		"language": idioma_espanol,
		select: true
	});
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
			
 		}else{
 			llenardata+="<option value=''>No se encontraron datos</option>";
			document.getElementById('select_sucur').innerHTML = llenardata;
			

 		}
 	})
 }

 function cargar_SelectSucursales_utilidad(){
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

			document.getElementById('select_sucur_utili').innerHTML = llenardata;
			
 		}else{
 			llenardata+="<option value=''>No se encontraron datos</option>";
			document.getElementById('select_sucur_utili').innerHTML = llenardata;
			

 		}
 	})
 }

 
  function cargar_SelectSucursales_imei(){
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
 			
		
			document.getElementById('select_sucur_compra').innerHTML = llenardata;
			
 		}else{
 			llenardata+="<option value=''>No se encontraron datos</option>";
			document.getElementById('select_sucur_compra').innerHTML = llenardata;
			

 		}
 	})
 }




/********************************************************************
				IMPRIMIR REPORTE MOVIMIENTOS
********************************************************************/
$('#tabla_reporte_producto_ensal').on('click', '.imprimir_kardex', function () { //class foto tiene que ir en el boton
	var data = tbl_reporte_producto_es.row($(this).parents('tr')).data(); //tama単o de escritorio
	if (tbl_reporte_producto_es.row(this).child.isShown()) {
		var data = tbl_reporte_producto_es.row(this).data(); //para celular y usas el responsive datatable

	}
	 console.log(data);

	 //agregale el parametro almacen al link
	window.open("../MPDF/reporte_movimientos_pro.php?codigo=" + parseInt(data.producto_id) + "&almacen=" + data.almacen + "#zoom=100", "Movimientos por productos", "scrollbards=NO");
	//agregale el parametro almacen al link
	//window.open("../MPDF/reporte_movimientos_pro.php?codigo=" + parseInt(data.producto_id) + "#zoom=100", "Movimientos por productos", "scrollbards=NO");
	//window.open("../MPDF/reporte_recepcion.php?codigo=" + parseInt(tick_recT) + "#zoom=100", "Ticket de Recepcion", "scrollbards=NO");
});


/********************************************************************
		 VER MOVIMIENTOS KARDEX CON IMEI
********************************************************************/
var tbl_ver_detalle_mov_pro;

function Ver_detalle_movimientos_prod(idprod, idalma) {
	// Evitar declarar dos veces imeis_vendidos
	if (typeof imeis_vendidos === 'undefined') {
		window.imeis_vendidos = new Set();
	} else {
		imeis_vendidos.clear();
	}
	tbl_ver_detalle_mov_pro = $("#tabla_detalle_movimientos_pro").DataTable({
		"responsive": true,
		"ordering": false,
		"bLengthChange": true,
		"searching": { "regex": false },
		"lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
		"pageLength": 25,
		"destroy": true,
		"async": false,
		"processing": true,
		"dom": 'lfrtip',
		"ajax": {
			"url": "../controller/reporteproducto/controlador_ver_movimientos_pro_con_imei.php",
			type: 'POST',
			data: {
				idprod: idprod,
				idalma:idalma
			},
			"dataSrc": function (json) {
				// Primero detectamos todos los IMEIs vendidos
				json.data.forEach(row => {
					let tipo = row.kardex_tipo.toUpperCase();
					if (tipo.includes("VENTA") && row.imei && row.imei.trim() !== "") {
						imeis_vendidos.add(row.imei.trim());
					}
				});
				return json.data;
			}
		
		},
		
		"columns": [
			//todos los datos del procedimiento almacenado
			{ "data": "producto_codigo" },
			{ "data": "comprobante" },

			{ 
				"data": "kardex_tipo",
				"render": function(data, type, row) {
					return data.toUpperCase(); // convierte a mayúsculas
				}
			},
			{ "data": "fecha" },
			{ "data": "kardex_ingreso" },
			{ "data": "kardex_salida" },
			{
				"data": "imei",
				"render": function (data, type, row) {
					if (!data || data.trim() === "") return "";
					let imeiTrim = data.trim();

					// Si el IMEI fue vendido, lo marcamos en rojo
					if (imeis_vendidos.has(imeiTrim)) {
						return `<span style="color:red; font-weight:bold">${imeiTrim}</span>`;
					}

					return imeiTrim;
				}
			}

		],
		"language": idioma_espanol,
		select: true
	});

}



/********************************************************************
		 VER MOVIMIENTOS KARDEX CON TECNICO
********************************************************************/
var tbl_ver_detalle_mov_pro_tecni;
function Ver_detalle_movimientos_prod_tecni(idprod, idalma) {//enviarlo al scrip en MANTENIMIENTO ROL
	tbl_ver_detalle_mov_pro_tecni = $("#tabla_detalle_movimientos_pro_tecnico").DataTable({
		"responsive": true,
		"ordering": false,
		"bLengthChange": true,
		"searching": { "regex": false },
		"lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
		"pageLength": 25,
		"destroy": true,
		"async": false,
		"processing": true,
		"dom": 'lfrtip',
		"ajax": {
			"url": "../controller/reporteproducto/controlador_ver_movimientos_pro_con_tecnico.php",
			type: 'POST',
			data: {
				idprod: idprod,
				idalma:idalma
			}
		},
		"columns": [
			//todos los datos del procedimiento almacenado
			{ "data": "producto_codigo" },
			{ "data": "comprobante" },

			{ 
				"data": "kardex_tipo",
				"render": function(data, type, row) {
					return data.toUpperCase(); // convierte a mayúsculas
				}
			},
			{ "data": "fecha" },
			{ "data": "kardex_ingreso" },
			{ "data": "kardex_salida" },
			{ "data": "tecnico" },

		],
		"language": idioma_espanol,
		select: true
	});

}



/********************************************************************
		   VER MOVIMIENTOS POR PRODUCTO
********************************************************************/
$('#tabla_reporte_producto_ensal').on('click', '.ver_movimientos', function () {//campo activar tiene que ir en el boton
	var data = tbl_reporte_producto_es.row($(this).parents('tr')).data();//tamaño de escritorio
	if (tbl_reporte_producto_es.row(this).child.isShown()) {
		var data = tbl_reporte_producto_es.row(this).data();//para celular y usas el responsive datatable

	}
	console.log(data);

	if (data.pro_imei == "Si") {

		$("#modal_ver_movimientos_pro_con_imei").modal({ backdrop: 'static', keyboard: false });
		$("#modal_ver_movimientos_pro_con_imei").modal('show');//abrimos el modal

		document.getElementById('text_producto_mov').value = data.nombre;
		document.getElementById('text_producto_st_imei').value = data.stock_actual;
		Ver_detalle_movimientos_prod(data.producto_id,  data.almacen);


	} else {

		$("#modal_ver_movimientos_pro_con_tecnico").modal({ backdrop: 'static', keyboard: false });
		$("#modal_ver_movimientos_pro_con_tecnico").modal('show');//abrimos el modal

		document.getElementById('text_producto_mov_tecni').value = data.nombre;
		document.getElementById('text_producto_st').value = data.stock_actual;
		Ver_detalle_movimientos_prod_tecni(data.producto_id, data.almacen );

	}

});

// LISTAR LOS IMEI VENDIDOS
var tbl_ver_imei_vendidos;
function Ver_imei_vendidos(idprod) {//enviarlo al scrip en MANTENIMIENTO ROL
	tbl_ver_imei_vendidos = $("#tabla_detalle_imei_ven").DataTable({
		"responsive": true,
		"ordering": false,
		"bLengthChange": true,
		"searching": { "regex": false },
		"lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
		"pageLength":10,
		"destroy": true,
		"async": false,
		"processing": true,
		"dom": 'Bfl',
		"buttons": [
			{
				"extend": 'excelHtml5',
				"titleAttr": 'Exportar a Excel',
				"exportOptions": {
					'columns': [0, 1]
				},
				"text": '<i class="fa fa-file-excel"></i>',

				
			},
		],
		"ajax": {
			"url": "../controller/reporteproducto/controlador_ver_imei_vendidos.php",
			type: 'POST',
			data: {
				idprod: idprod
			}
		},
		"columns": [
			//todos los datos del procedimiento almacenado
			{ "data": "imei" },
			
			{
				"data": "vendido",
				render: function (data, type, row) {
					if (data === "Si") {
						return "<center>" + '<span class="badge badge-danger">Si</span>'; +"</center>"

					}else if (data === "DEL") {
						return "<center>" + '<span class="badge badge-warning">DEL</span>'; +"</center>"

					}else {
						return "<center>" + '<span class="badge badge-success">'+data+'</span>'; +"</center>"
					}

				}
			},


		],
		"language": idioma_espanol,
		select: true
	});

}




//VER IMEI VENDIDOS
$('#tabla_reporte_producto_ensal').on('click', '.ver_total_imei', function () {//campo activar tiene que ir en el boton
	var data = tbl_reporte_producto_es.row($(this).parents('tr')).data();//tamaño de escritorio
	if (tbl_reporte_producto_es.row(this).child.isShown()) {
		var data = tbl_reporte_producto_es.row(this).data();//para celular y usas el responsive datatable

	}
	//console.log(data.pro_imei);

	if (data.pro_imei == "Si") {

		$("#modal_detalle_imei").modal({ backdrop: 'static', keyboard: false });
		$("#modal_detalle_imei").modal('show');//abrimos el modal

		document.getElementById('text_art_desc').value = data.nombre;
		Ver_imei_vendidos(data.producto_id);


	} else {

		Swal.fire("ERROR ", "EL ARTICULO SELECCIONADO NO TIENE IMEI", "warning");
	}

});




/********************************************************************
					   KARDEX DE PRODUCTOS
********************************************************************/
var tbl_kardex;
function Listar_kardex() {//enviarlo al scrip en MANTENIMIENTO ROL
	var pro = document.getElementById('select_producto').value;
	//var ffin = document.getElementById('text_ffin').value;
	tbl_kardex = $("#tabla_reporte_kardex").DataTable({
		"responsive": true,
		"ordering": false,
		"bLengthChange": true,
		"searching": { "regex": false },
		"lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
		"pageLength": 10,
		"destroy": true,
		"async": false,
		"bprocessing": true,
		"dom": 'Blt',
		/*"buttons":[
			{
			   "extend":    'excelHtml5',
			   "text":      '<i class="fa fa-file-excel"></i>',
			   "titleAttr": 'Exportar a Excel',
			   
			  
			  
		
			},
				
	

			{
				"extend":    'pdfHtml5',
				"text":      '<i class="fas fa-file-pdf"></i> ',
				"titleAttr": 'Exportar a Pdf',
				"download": 'open',

			}
			
		],*/

		"buttons": [
			{
				extend: 'excel',                    // Extend the excel button   
				excelStyles: [
					{                      // Add an excelStyles definition
						//template: 'blue_gray_medium',  // Apply the 'blue_gray_medium' template
					},
					{
						cells: ['D2:F2', 'G2:I2', 'J2:L2'],  // Format the two cells ranges that are merged
						style: {
							font: {
								b: true,
							},
							alignment: {
								vertical: "center",
								horizontal: "center",
							},
							border: {
								top: 'thick',
								bottom: 'thick',
								left: 'thick',
								right: 'thick',
							}
						}
					}
				],
				insertCells: [
					{
						cells: ['s0'],
						content: '',    // Content inserted as an array
						pushRow: true,                                       // Push the columns over
					},

					/* {
						 cells: ['s15','s17'],
						 content: '',
						 pushRow: true
					 },*/
					/* {
						 cells: ['A17'],               // Using the mergeCells option in pageStyle below
						 content: 'Row Span Example',
					 },*/
					{
						cells: ['D2'],               // Using the mergeCells option in pageStyle below
						content: 'INGRESOS',
						//pushCol: true,
					},
					{
						cells: ['G2'],               // Using the mergeCells option in pageStyle below
						content: 'SALIDAS',
					},
					{
						cells: ['J2:L2'],               // Using the mergeCells option in pageStyle below
						content: 'EXISTSTENCIAS',
					},

				],
				pageStyle: {
					sheetPr: {
						pageSetUpPr: {
							fitToPage: 1            // Fit the printing to the page
						}
					},
					printOptions: {
						horizontalCentered: true,
						verticalCentered: true,
					},
					pageSetup: {
						orientation: "landscape",   // Orientation
						paperSize: "9",             // Paper size (9 = A4)
						fitToWidth: "1",            // Fit to page width
						fitToHeight: "0",           // Fit to page height
					},
					pageMargins: {
						left: "0.2",
						right: "0.2",
						top: "0.4",
						bottom: "0.4",
						header: "0",
						footer: "0",
					},
					mergeCells: {                   // Merge Cells
						mergeCell: [
							'D2:F2',
							'G2:I2',
							'J2:L2',

						]
					},
					// repeatHeading: true,
					//repeatRow: 'D2:F2',

				}
			},
		],


		"ajax": {
			"url": "../controller/reporteproducto/controlador_reporte_kardex.php",
			type: 'POST',
			data: {
				pro: pro
			}
		},
		"columns": [
			//todos los datos del procedimiento almacenad
			{ "data": "producto" },
			{ "data": "fecha" },
			{ "data": "tipo" },

			{ "data": "ingreso" },
			{ "data": "precio_ingreso" },
			{ "data": "total_ingreso" },

			{ "data": "salida" },
			{ "data": "precio_salida" },
			{ "data": "total_salida" },

			{ "data": "total_actual" },
			{ "data": "precio_total" },
			{ "data": "total_total" },

		],
		"language": idioma_espanol,
		select: true
	});
}




/********************************************************************
			 CARGAR PRODUCTOS EN COMBO
********************************************************************/
function cargar_Select_Productos() {//enviamos al scrpit mantenimiento examen
	$.ajax({
		url: '../controller/reporteproducto/controlador_cargar_select_productos.php',
		type: 'POST'
	}).done(function (resp) {
		let data = JSON.parse(resp);//POSICION DE LA FILA Y COLUMNA
		let llenardata = "<option value=''>Seleccione</option>";
		if (data.length > 0) {
			for (let i = 0; i < data.length; i++) {
				llenardata += "<option value='" + data[i][0] + "'>" + data[i][1] + "</option>";
			}
			document.getElementById('select_producto').innerHTML = llenardata;
		} else {
			llenardata += "<option value=''>No se encontraron datos</option>";
			document.getElementById('select_producto').innerHTML = llenardata;

		}
	})
}




/********************************************************************
		  REPORTE PRODUCTO ENTRADAS Y SALIDAD
********************************************************************/
var tbl_reporte_utili;
function Listar_Reporte_Utilidad() {//enviarlo al scrip en MANTENIMIENTO ROL
	 var finicio = document.getElementById('text_finicio').value;
	var ffin = document.getElementById('text_ffin').value;
	let sucursa = document.getElementById('select_sucur_utili').value;

		if ($.fn.DataTable.isDataTable('#tabla_reporte_utilidad')) {
		tbl_reporte_utili.destroy();
	}

	tbl_reporte_utili = $("#tabla_reporte_utilidad").DataTable({
		"responsive": true,
		"ordering": false,
		"bLengthChange": true,
		"searching": { "regex": false },
		"lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
		"pageLength": 25,
		"destroy": true,
		"async": false,
		"bprocessing": true,
		"dom": 'Bfl',
		"buttons": [
			{
				"extend": 'excelHtml5',
				"text": '<i class="fa fa-file-excel"></i>',
				"titleAttr": 'Exportar a Excel',
				"excelStyles": {
					//template: "header_blue",  // Apply the 'header_blue' template part (white font on a blue background in the header/footer)
					//template:"green_medium" 

					"template": [
						"blue_medium",
						"header_green",
						"title_medium"
					]

				},
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
			$(api.column(5).footer()).html( api.column(5, { page: 'current' }).data().sum() );
			$(api.column(6).footer()).html( api.column(6, { page: 'current' }).data().sum());
			$(api.column(7).footer()).html( api.column(7, { page: 'current' }).data().sum());
		},



		"ajax": {
			"url": "../controller/reporteproducto/controlador_reporteproducto_utilidad.php",
			type: 'POST',
			data: {
				finicio: finicio,
				ffin: ffin,
				sucursa: sucursa
			}
		},
		"columns": [
			//todos los datos del procedimiento almacenado
			{ "data": "producto" },
			{ "data": "cantida_vendidos" },
			{ "data": "comproventa" },
			{ "data": "fechauti" },
			{ "data": "imei" },
			{ "data": "precio_venta" },
			{ "data": "costo_unitario" },
			{ "data": "ganancia" },
			
		],
		"language": idioma_espanol,
		select: true
	});
}



/********************************************************************
		   LISTAR PRODUCTO CON METODO NORMAL
********************************************************************/
var tbl_mov_prod;
function Listar_Movimientos_imei() {//enviarlo al scrip en MANTENIMIENTO ROL
	 
	var pa_imei = document.getElementById('text_buscar_imei').value;
		if ($.fn.DataTable.isDataTable('#tabla_mov_imei')) {
		tbl_mov_prod.destroy();
	}

	tbl_mov_prod = $("#tabla_mov_imei").DataTable({
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
				"title": 'Reporte Movimientos Imei',
				"exportOptions": {
					'columns': [0, 1, 2, 3, 4]
				},
				"text": '<i class="fa fa-file-excel"></i>',
				"titleAttr": 'Exportar a Excel'
			},
		],
		"ajax": {
			"url": "../controller/reporteproducto/controlador_reporte_movimi_imei.php",
			type: 'POST',
			data: {
				pa_imei: pa_imei
			}
		},
		"columns": [
			{ "data": "campo" },
			{ "data": "valor" },
			{ "data": "sucursal" },
			// { "data": "nombre_u" },
			// { "data": "compro" },
			
		],
		"language": idioma_espanol,
		select: true
	});
	/*contador en cada tabla
	tbl_producto.on('draw.td',function(){
		var PageInfo = $("#tabla_producto").DataTable().page.info();
		tbl_producto.column(0,{page: 'current'}).nodes().each(function(cell,i){
			cell.innerHTML = i + 1 + PageInfo.start;
		});
	});*/
}



/********************************************************************
		   LISTAR COMPRAS DE LOS PRODUCTOS POR IMEI
********************************************************************/
var tbl_compras_imei;
function Listar_Rte_Compras_imei() {//enviarlo al scrip en MANTENIMIENTO ROL
	var sucursal = document.getElementById('select_sucur_compra').value;
		if ($.fn.DataTable.isDataTable('#tabla_compras_imei')) {
		tbl_compras_imei.destroy();
	}


	tbl_compras_imei = $("#tabla_compras_imei").DataTable({
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
				"title": 'Reporte Movimientos Imei',
				"exportOptions": {
					'columns': [0, 1, 2, 3, 4]
				},
				"text": '<i class="fa fa-file-excel"></i>',
				"titleAttr": 'Exportar a Excel'
			},
		],
		"ajax": {
			"url": "../controller/reporteproducto/controlador_reporte_compras_imei.php",
			type: 'POST',
			data: {
				sucursal: sucursal
			}
		},
		"columns": [
			{ "data": "fecha" },
			{ "data": "producto_nombre" },
			{ "data": "imei" },
			{ "data": "cliente_nombres" },
			{ "data": "producto_pcompra" },
			{ "data": "nombre_su" },
			
		],
		"language": idioma_espanol,
		select: true
	});
	/*contador en cada tabla
	tbl_producto.on('draw.td',function(){
		var PageInfo = $("#tabla_producto").DataTable().page.info();
		tbl_producto.column(0,{page: 'current'}).nodes().each(function(cell,i){
			cell.innerHTML = i + 1 + PageInfo.start;
		});
	});*/
}