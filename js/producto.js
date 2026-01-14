/********************************************************************
		   LISTAR PRODUCTO CON METODO NORMAL
********************************************************************/
var tbl_producto;
function Listar_Producto() {//enviarlo al scrip en MANTENIMIENTO ROL
	let idalmacen = document.getElementById('text_idalmacen').value;
	let rolid = document.getElementById('text_idrol').value;
	tbl_producto = $("#tabla_producto").DataTable({
		"responsive": true,
		"ordering": false,
		"bLengthChange": true,
		"searching": { "regex": false },
		"lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
		"pageLength": 10,
		"destroy": true,
		"async": false,
		"processing": true,
		"ajax": {
			"url": "../controller/producto/controlador_producto_listar.php",
			type: 'POST',
			data: {
				idalmacen: idalmacen,
				rolid:rolid
				
			}
		},
		"dom": 'Blfrtip',
		"buttons": [
			{
				"extend": 'excelHtml5',
				"title": 'Reporte Productos',
				"exportOptions": {
					'columns': [0, 1, 2, 3, 4, 5, 6, 7]
				},
				"text": '<i class="fa fa-file-excel"></i>',
				"titleAttr": 'Exportar a Excel'
			},
		],
		"columns": [
			//todos los datos del procedimiento almacenado
			//{"defaultContent": ""},//cintador 
			{ "data": "producto_codigo" },
			{ "data": "producto_codigo_general" },
			{ "data": "producto_nombre" },
			{ "data": "marca_descripcion" },
			{ "data": "unidad_medida" },
			{
				"data": "producto_stock",
				render: function (data, type, row) {
					if (data <= 2) {
						return "<center>" + '<span class="badge badge-danger">' + data + '</span>'; +"</center>"
					} else {
						return "<center>" + '<span class="badge badge-success">' + data + '</span>'; +"</center>"
					}

				}
			},
			{ "data": "producto_pcompra" },
			{ "data": "producto_pventa" },
			{
				"data": "producto_foto",
				render: function (data, type, row) {
					return '<img class="img-responsive" style="width:40px;" src="../' + data + '">';
				}
			},
			{ "data": "descripcion_al" },
			{
				"data": "producto_estado",
				render: function (data, type, row) {
					if (data === "ACTIVO") {
						return "<center>" + '<span class="badge badge-success">ACTIVO</span>'; +"</center>"
					} else {
						return "<center>" + '<span class="badge badge-danger">INACTIVO</span>'; +"</center>"
					}
				}
			},
			{ "defaultContent": "<center>" + "<span class=' editar text-primary px-1' style='cursor:pointer;' title='Editar datos'><i class= 'fa fa-edit'></i></span>"+
				"<span class=' aumentar text-success px-1' style='cursor:pointer;' title='Aumentar Stock'><i class= 'fa fa-plus'></i></span>"+ 
				"<span class=' disminuir text-danger px-1' style='cursor:pointer;' title='Salida directa'><i class= 'fa fa-minus'></i></span>"+ 
				//"<span class='traslado text-warning px-1' style='cursor:pointer;' title='traslado de articulos'><i class='fa fa-car'></i></span>" + 
				"<span class=' codigoqr text-secondary px-1' style='cursor:pointer;' title='Generar codigo Qr'><i class= 'fa fa-qrcode'></i></span>"+
				"<span class='foto text-info px-1' style='cursor:pointer;' title='Cambiar foto'><i class='fa fa-image'></i></span>" + 
				
				"</center>" 
			}


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

function Listar_Producto_admin() {//enviarlo al scrip en MANTENIMIENTO ROL
	tbl_producto = $("#tabla_producto").DataTable({
		"responsive": true,
		"ordering": false,
		"bLengthChange": true,
		"searching": { "regex": false },
		"lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
		"pageLength": 10,
		"destroy": true,
		"async": false,
		"processing": true,
		"ajax": {
			"url": "../controller/producto/controlador_producto_listar.php",
			type: 'POST'
		},
		"dom": 'Blfrtip',
		"buttons": [
			{
				"extend": 'excelHtml5',
				"title": 'Reporte Productos',
				"exportOptions": {
					'columns': [0, 1, 2, 3, 4, 5, 6, 7]
				},
				"text": '<i class="fa fa-file-excel"></i>',
				"titleAttr": 'Exportar a Excel'
			},
		],
		"columns": [
			//todos los datos del procedimiento almacenado
			//{"defaultContent": ""},//cintador 
			{ "data": "producto_codigo" },
			{ "data": "producto_codigo_general" },
			{ "data": "producto_nombre" },
			{ "data": "marca_descripcion" },
			{ "data": "unidad_medida" },
			{
				"data": "producto_stock",
				render: function (data, type, row) {
					if (data <= 2) {
						return "<center>" + '<span class="badge badge-danger">' + data + '</span>'; +"</center>"
					} else {
						return "<center>" + '<span class="badge badge-success">' + data + '</span>'; +"</center>"
					}

				}
			},
			{ "data": "producto_pcompra" },
			{ "data": "producto_pventa" },
			{
				"data": "producto_foto",
				render: function (data, type, row) {
					return '<img class="img-responsive" style="width:40px;" src="../' + data + '">';
				}
			},
			{
				"data": "producto_estado",
				render: function (data, type, row) {
					if (data === "ACTIVO") {
						return "<center>" + '<span class="badge badge-success">ACTIVO</span>'; +"</center>"
					} else {
						return "<center>" + '<span class="badge badge-danger">INACTIVO</span>'; +"</center>"
					}
				}
			},
			{ "defaultContent": "<center>" + "<span class=' editar text-primary px-1' style='cursor:pointer;' title='Editar datos'><i class= 'fa fa-edit'></i></span><span class=' aumentarRRRRR text-success px-1' style='cursor:pointer;' title='Aumentar Stock'><i class= 'fa fa-plus'></i></span><span class=' disminuir text-danger px-1' style='cursor:pointer;' title='Salida directa'><i class= 'fa fa-minus'></i></span><span class=' codigoqr text-secondary px-1' style='cursor:pointer;' title='Generar codigo Qr'><i class= 'fa fa-qrcode'></i></span>&nbsp;<span class='foto text-info px-1' style='cursor:pointer;' title='Cambiar foto'><i class='fa fa-image'></i></span>" + "</center>" }


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


var tbl_ver_detalle_pro;
function Ver_detalle_pro(idpro) {//enviarlo al scrip en MANTENIMIENTO ROL
	tbl_ver_detalle_pro = $("#tabla_det_pro_edit").DataTable({
		"responsive": true,
		"ordering": false,
		"bLengthChange": true,
		"searching": { "regex": false },
		"lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
		"pageLength": 40,
		"destroy": true,
		"async": false,
		"processing": true,
		"dom": '',
		"ajax": {
			"url": "../controller/producto/controlador_ver_detalle_producto.php",
			type: 'POST',
			data: {
				id: idpro
			}
		},
		"columns": [
			//todos los datos del procedimiento almacenado
			{ "data": "imei" },
			// { "data": "vendido" },
			// {
			// 	"data": "vendido",
			// 	render: function (data, type, row) {
			// 		if (data === "Si") {
            //             return "<center>" + "<span class=' text-secondary px-1'  data-bs-toggle='tooltip' data-bs-placement='top' ><i class= 'fa fa-trash'></i></span> <span class=' text-secondary px-1'  data-bs-toggle='tooltip' data-bs-placement='top' ><i class= 'fa fa-share'></i></span>" + "</center>"
            //         } else {
            //             return "<center>" + "<span class=' text-danger px-1' style='cursor:pointer;' data-bs-toggle='tooltip' data-bs-placement='top' title='eliminar'><i class= 'fa fa-trash'></i></span> <span class='enviar_imei text-info px-1' style='cursor:pointer;' data-bs-toggle='tooltip' data-bs-placement='top' title='Enviar Imei'><i class= 'fa fa-share'></i></span>" + "</center>"
            //         }
			// 	}
			// },


			{"defaultContent": "<center>"+"<span class='genera_qr_imei text-info px-1' style='cursor:pointer;' data-bs-toggle='tooltip' data-bs-placement='top' title='Generar Qr'><i class= 'fas fa-qrcode'></i></span> "+"</center>"}


		],
		"language": idioma_espanol,
		select: true
	});

}

var tbl_ver_imei_aumentar;
function Ver_detalle_pro_aumentar(idpro) {//enviarlo al scrip en MANTENIMIENTO ROL
	tbl_ver_imei_aumentar = $("#tabla_det_pro_aumentar").DataTable({
		"responsive": true,
		"ordering": false,
		"bLengthChange": true,
		"searching": { "regex": false },
		"lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
		"pageLength": 40,
		"destroy": true,
		"async": false,
		"processing": true,
		"dom": '',
		"ajax": {
			"url": "../controller/producto/controlador_ver_detalle_producto.php",
			type: 'POST',
			data: {
				id: idpro
			}
		},
		"columns": [
			//todos los datos del procedimiento almacenado
			{ "defaultContent": "" },//cintador 
			{ "data": "imei" },
			// { "data": "vendido" },
			// {
			// 	"data": "vendido",
			// 	render: function (data, type, row) {
			// 		if (data === "Si") {
            //             return "<center>" + "<span class=' text-secondary px-1'  data-bs-toggle='tooltip' data-bs-placement='top' ><i class= 'fa fa-trash'></i></span> <span class=' text-secondary px-1'  data-bs-toggle='tooltip' data-bs-placement='top' ><i class= 'fa fa-share'></i></span>" + "</center>"
            //         } else {
            //             return "<center>" + "<span class=' text-danger px-1' style='cursor:pointer;' data-bs-toggle='tooltip' data-bs-placement='top' title='eliminar'><i class= 'fa fa-trash'></i></span> <span class='enviar_imei text-info px-1' style='cursor:pointer;' data-bs-toggle='tooltip' data-bs-placement='top' title='Enviar Imei'><i class= 'fa fa-share'></i></span>" + "</center>"
            //         }
			// 	}
			// },


			//{"defaultContent": "<center>"+"<span class=' text-danger px-1' style='cursor:pointer;' data-bs-toggle='tooltip' data-bs-placement='top' title='eliminar'><i class= 'fa fa-trash'></i></span> "+"</center>"}


		],
		"language": idioma_espanol,
		select: true
	});
	//contador en cada tabla
	tbl_ver_imei_aumentar.on('draw.td', function () {
		var PageInfo = $("#tabla_det_pro_aumentar").DataTable().page.info();
		tbl_ver_imei_aumentar.column(0, { page: 'current' }).nodes().each(function (cell, i) {
			cell.innerHTML = i + 1 + PageInfo.start;
		});
	});

}

var tbl_ver_imei_disminuir;
function Ver_detalle_pro_disminuir(idpro) {//enviarlo al scrip en MANTENIMIENTO ROL
	tbl_ver_imei_disminuir = $("#tabla_det_pro_disminuir").DataTable({
		"responsive": true,
		"ordering": false,
		"bLengthChange": true,
		"searching": { "regex": false },
		"lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
		"pageLength": 40,
		"destroy": true,
		"async": false,
		"processing": true,
		"dom": '',
		"ajax": {
			"url": "../controller/producto/controlador_ver_detalle_producto.php",
			type: 'POST',
			data: {
				id: idpro
			}
		},
		"columns": [
			//todos los datos del procedimiento almacenado
			{ "defaultContent": "" },//cintador 
			{ "data": "imei" },
			// { "data": "vendido" },
			// {
			// 	"data": "vendido",
			// 	render: function (data, type, row) {
			// 		if (data === "Si") {
            //             return "<center>" + "<span class=' text-secondary px-1'  data-bs-toggle='tooltip' data-bs-placement='top' ><i class= 'fa fa-trash'></i></span> <span class=' text-secondary px-1'  data-bs-toggle='tooltip' data-bs-placement='top' ><i class= 'fa fa-share'></i></span>" + "</center>"
            //         } else {
            //             return "<center>" + "<span class='eliminar_det_p text-danger px-1' style='cursor:pointer;' data-bs-toggle='tooltip' data-bs-placement='top' title='eliminar'><i class= 'fa fa-trash'></i></span> <span class='enviar_imei text-info px-1' style='cursor:pointer;' data-bs-toggle='tooltip' data-bs-placement='top' title='Enviar Imei'><i class= 'fa fa-share'></i></span>" + "</center>"
            //         }
			// 	}
			// },


			{"defaultContent": "<center>"+"<span class='eliminar_det_p text-danger px-1' style='cursor:pointer;' data-bs-toggle='tooltip' data-bs-placement='top' title='eliminar'><i class= 'fa fa-trash'></i></span> "+"</center>"}


		],
		"language": idioma_espanol,
		select: true
	});

	tbl_ver_imei_disminuir.on('draw.td', function () {
		var PageInfo = $("#tabla_det_pro_disminuir").DataTable().page.info();
		tbl_ver_imei_disminuir.column(0, { page: 'current' }).nodes().each(function (cell, i) {
			cell.innerHTML = i + 1 + PageInfo.start;
		});
	});

}


/********************************************************************
		   PARA IMPRIMIR CODIGO QR
********************************************************************/
$('#tabla_producto').on('click', '.codigoqr', function () {//class foto tiene que ir en el boton
	var data = tbl_producto.row($(this).parents('tr')).data();//tamaño de escritorio
	if (tbl_producto.row(this).child.isShown()) {
		var data = tbl_producto.row(this).data();//para celular y usas el responsive datatable
	}
	window.open("../MPDF/genera_qr.php?codigo=" + parseInt(data.producto_id) + "#zoom=100", "Codigo qr del producto", "scrollbards=NO");

});


/********************************************************************
		   PARA IMPRIMIR CODIGO QR - IMEI
********************************************************************/
$('#tabla_det_pro_edit').on('click', '.genera_qr_imei', function () {//class foto tiene que ir en el boton
	 //descr_equi = document.getElementById('text_producto_editar');
	descr_equi = document.getElementById('text_producto_editar').value;
	var data = tbl_ver_detalle_pro.row($(this).parents('tr')).data();//tamaño de escritorio
	if (tbl_ver_detalle_pro.row(this).child.isShown()) {
		var data = tbl_ver_detalle_pro.row(this).data();//para celular y usas el responsive datatable
	}
	//console.log(data);
	window.open("../MPDF/genera_qr_imei.php?codigo=" + parseInt(data.imei) + "#zoom=100", "Codigo qr del producto", "scrollbards=NO");

});



/********************************************************************
			  ABRIR MODAL REGISTRAR  PRODUCTO
********************************************************************/
function AbrirModalRegistroProducto() {//se jala en el boton nuevo
rolvende = document.getElementById('text_idrol').value;
if(rolvende == 3){
	Swal.fire({
		icon: 'error',
		title: 'Oops...',
		text: 'Ud no tiene este permiso!',
		
	  })
	  return false;
	}
	//para que no se nos salga del modal haciendo click a los costados
	$("#modal_registro_producto").modal({ backdrop: 'static', keyboard: false });
	$("#modal_registro_producto").modal('show');//abrimos el modal
	//LimpiarModalProducto();//limpiar texbox cada que demos en nuevo
	$('.form-control').removeClass("is-invalid").removeClass("is-valid");
	document.getElementById('text_producto').value = "";
	document.getElementById('text_stock').value = "";
	document.getElementById('text_pcompra').value = "";
	document.getElementById('text_pventa').value = "";

	document.getElementById('text_imei').value = "";
	$("#select_marca").select2().val("").trigger('change.select2');
	$("#select_categoria").select2().val("").trigger('change.select2');
	$("#select_proveedor").select2().val("").trigger('change.select2');
	$("#select_unidadm").select2().val("").trigger('change.select2');
	$("#select_habi_imei").select2().val("Seleccione").trigger('change.select2');
	let codigoqrpro = "";
	let f = new Date();
	//nombrefoto="PROD"
	codigoqrpro = f.getDate() + "" + (f.getMonth() + 1) + "" + f.getFullYear() + "" + f.getHours() + "" + f.getMilliseconds();

	var codeb = Date.now();
	var c = document.getElementById('text_codigo_g');
	c.value = codigoqrpro;

	var inpStock = document.getElementById("text_stock");
     inpStock.disabled = false;
}




/**********************************************************************
			MODAL AUMENTAR STOCK
***********************************************************************/
$('#tabla_producto').on('click', '.aumentar', function () {//class EDITAR tiene que ir en el boton
	var data = tbl_producto.row($(this).parents('tr')).data();//tamaño de escritorio
	if (tbl_producto.row(this).child.isShown()) {
		var data = tbl_producto.row(this).data();//para celular y usas el responsive datatable
	}
		rolvende = document.getElementById('text_idrol').value;
	//console.log(data);
	 

	tiene_imei_aum = data.pro_imei;
	if(rolvende == 3){
		Swal.fire({
			icon: 'error',
			title: 'Oops...',
			text: 'Ud no tiene este permiso!',
			
		})
		return false;
	}

	if (tiene_imei_aum == "Si") {
		$("#modal_aumentar_stock_imei").modal({ backdrop: 'static', keyboard: false });
		$("#modal_aumentar_stock_imei").modal('show');//abrimos el modal
		 

		document.getElementById('idproducto_imei').value = data.producto_id;
		document.getElementById('idalmacen_aumentar_imei').value = data.id_almacen;
		document.getElementById('idsucu_imei').value = data.id_sucu;
		document.getElementById('text_producto_editar_imei').value = data.producto_nombre + " - " + data.producto_codigo;
		document.getElementById('text_stock_editar_imei').value = data.producto_stock;
		Ver_detalle_pro_aumentar(data.producto_id)
		//document.getElementById('text_codigo_editar_imei').value = data.producto_codigo;

	} else {
		$("#modal_aumentar_stock").modal({ backdrop: 'static', keyboard: false });
		$("#modal_aumentar_stock").modal('show');//abrimos el modal
		//mandamos parametros a los texbox
		document.getElementById('text_stock_aumentar').value = "";
		document.getElementById('text_stock_suma').value = "";
		//document.getElementById('idrol').value=data[0];
		document.getElementById('idproducto_aumentar').value = data.producto_id;
		document.getElementById('idalmacen_aumentar').value = data.id_almacen;
			document.getElementById('idsucu_imei').value = data.id_sucu;
		//console.log(data.producto_id);
		//let id = document.getElementById('idproducto').value;
		document.getElementById('text_producto_editar_2').value = data.producto_nombre;
		document.getElementById('text_stock_editar_2').value = data.producto_stock;
		document.getElementById('text_codigo_editar_2').value = data.producto_codigo;
		limpiarTabla_regimei_aumentar();

	}






});


/**********************************************************************
			MODAL DISMINUIR STOCK
***********************************************************************/
$('#tabla_producto').on('click', '.disminuir', function () {//class EDITAR tiene que ir en el boton
	var data = tbl_producto.row($(this).parents('tr')).data();//tamaño de escritorio
	if (tbl_producto.row(this).child.isShown()) {
		var data = tbl_producto.row(this).data();//para celular y usas el responsive datatable
	}
	
	rolvende = document.getElementById('text_idrol').value;
	//console.log(data);
	tiene_imei_dsim = data.pro_imei;
if(rolvende == 3){
	Swal.fire({
		icon: 'error',
		title: 'Oops...',
		text: 'Ud no tiene este permiso!',
		
	  })
	  return false;
	}
	if (tiene_imei_dsim == "Si") {

		$("#modal_disminuir_stock_imei").modal({ backdrop: 'static', keyboard: false });
		$("#modal_disminuir_stock_imei").modal('show');//abrimos el modal
		document.getElementById('idproducto_imei_dis').value = data.producto_id;
		document.getElementById('idalmacen_imei_dis').value = data.id_almacen;
		document.getElementById('text_producto_dismin_imei').value = data.producto_nombre;
		document.getElementById('text_stock_dismin_imei').value = data.producto_stock;
		document.getElementById('idsucu_imei_dis').value = data.id_sucu;
		Ver_detalle_pro_disminuir(data.producto_id)

	} else {
		$("#modal_disminuir_stock").modal({ backdrop: 'static', keyboard: false });
		$("#modal_disminuir_stock").modal('show');//abrimos el modal
		document.getElementById('text_stock_disminuir_dis').value = "";
		document.getElementById('text_stock_resta').value = "";
		document.getElementById('idproducto_dis').value = data.producto_id;
		document.getElementById('idalmacen_dis').value = data.id_almacen;
		document.getElementById('idsucu_imei_dis').value = data.id_sucu;
		
		document.getElementById('text_producto_editar_2_dis').value = data.producto_nombre;
		document.getElementById('text_stock_editar_2_dis').value = data.producto_stock;
		document.getElementById('text_codigo_editar_2_dis').value = data.producto_codigo;
		limpiarTabla_regimei_disminuir();
	}


});



/********************************************************************
	  CAMBIAR FOTO DEL PRODUCTO
********************************************************************/
$('#tabla_producto').on('click', '.foto', function () {//class foto tiene que ir en el boton
	var data = tbl_producto.row($(this).parents('tr')).data();//tamaño de escritorio
	if (tbl_producto.row(this).child.isShown()) {
		var data = tbl_producto.row(this).data();//para celular y usas el responsive datatable
	}
	$("#modal_editar_foto").modal({ backdrop: 'static', keyboard: false });
	$("#modal_editar_foto").modal('show');//abrimos el modal
	//LimpiarModalUsuario();
	//mandamos parametros a los texbox
	document.getElementById('idproducto_foto').value = data.producto_id;
	document.getElementById('lbl_producto').innerHTML = data.producto_nombre;//enviamos el nombre del producto al modal
	document.getElementById('fotoactual').value = data.producto_foto;
	document.getElementById('cod_barra').value = data.producto_codigo_general;
	document.getElementById('img-preview').src = "../" + data.producto_foto;
	//console.log(data[7]);//capturaar ruta
});



/**********************************************************************
			ABRIR MODAL EDITAR Y TRAER DATOS A LOS CAMPOS
***********************************************************************/
$('#tabla_producto').on('click', '.editar', function () {//class EDITAR tiene que ir en el boton
	var data = tbl_producto.row($(this).parents('tr')).data();//tamaño de escritorio
	if (tbl_producto.row(this).child.isShown()) {
		var data = tbl_producto.row(this).data();//para celular y usas el responsive datatable
		
	}
	//console.log(data);
	rolA = document.getElementById('text_idrol').value; //CAPTURAMOS EL ROL PARA DAR EL ACCESO
	almacid = document.getElementById('text_idalmacen').value;
	tiene_imei = data.pro_imei;

	//console.log("id almacen de tabla",data.id_almacen);
	//console.log("id almacen de usuario", almacid);

	if(rolA == 3){
		Swal.fire({
			icon: 'error',
			title: 'Oops...',
			text: 'Ud no tiene este permiso!',
		})
		return false;
	}

	if (parseInt(data.id_almacen) !== parseInt(almacid)) {
		Swal.fire({
			icon: 'error',
			title: 'Oops...',
			text: 'No puedes editar este producto porque pertenece a otro almacén.',
		});
		return false;
	}

	$("#modal_editar_producto").modal({ backdrop: 'static', keyboard: false });
	$("#modal_editar_producto").modal('show');//abrimos el modal
	//mandamos parametros a los texbox

	if (rolA == 1) {
		document.getElementById('idproducto').value = data.producto_id;//id del procedure
		document.getElementById('text_producto_editar').value = data.producto_nombre;//enviamos el nombre del usu al modal
		document.getElementById('text_stock_editar').value = data.producto_stock;
		document.getElementById('text_codigo_editar').value = data.producto_codigo;
		document.getElementById('text_pcompra_editar').value = data.producto_pcompra;
		document.getElementById('text_pventa_editar').value = data.producto_pventa;
		document.getElementById('text_codigo_g_editar').value = data.producto_codigo_general;
		document.getElementById('text_descrip_p_editar').value = data.producto_descrip_l;
		document.getElementById('text_pcomercial_editar').value = data.producto_pcomercial;
		document.getElementById('text_pmayor_editar').value = data.producto_pmayorista;
		if (data.producto_tienda == "Si") {
			document.getElementById('chk_ver_editar').checked = true;
		} else {
			document.getElementById('chk_ver_editar').checked = false;
		}

		$("#select_marca_editar").select2().val(data.marca_id).trigger('change.select2');//PARA QUE SALGA EN MODAL EDITAR SE COLOCA EN CARGAR SELCT DEJ JS
		$("#select_categoria_editar").select2().val(data.categoria_id).trigger('change.select2');
		$("#select_estado_producto_editar").select2().val(data.producto_estado).trigger('change.select2');
		$("#select_proveedor_editarr").select2().val(data.cliente_id).trigger('change.select2');
		$("#select_unidadm_editar").select2().val(data.unidad_id).trigger('change.select2');

		if(tiene_imei == "Si")
		{
			Ver_detalle_pro(parseInt(data.producto_id));
			$('#traer_imei_editar').prop('hidden', false);
		} else {
			$('#traer_imei_editar').prop('hidden', true);
			limpiarTabla_regimei_editar();
		}

		//Ver_detalle_pro(parseInt(data.producto_id));

	} else {
		document.getElementById('idproducto').value = data.producto_id;//id del procedure
		document.getElementById('text_producto_editar').value = data.producto_nombre;//enviamos el nombre del usu al modal
		document.getElementById('text_stock_editar').value = data.producto_stock;
		document.getElementById('text_codigo_editar').value = data.producto_codigo;

		document.getElementById('text_pcompra_editar').disabled = true;
		document.getElementById('text_pcompra_editar').value = data.producto_pcompra;

		document.getElementById('text_pventa_editar').value = data.producto_pventa;
		document.getElementById('text_pventa_editar').disabled = true;
		document.getElementById('text_codigo_g_editar').value = data.producto_codigo_general;
		document.getElementById('text_descrip_p_editar').value = data.producto_descrip_l;
		document.getElementById('text_pcomercial_editar').value = data.producto_pcomercial;
		document.getElementById('text_pmayor_editar').value = data.producto_pmayorista;
		if (data.producto_tienda == "Si") {
			document.getElementById('chk_ver_editar').checked = true;
		} else {
			document.getElementById('chk_ver_editar').checked = false;
		}


		$("#select_marca_editar").select2().val(data.marca_id).trigger('change.select2');
		$("#select_categoria_editar").select2().val(data.categoria_id).trigger('change.select2');
		$("#select_estado_producto_editar").select2().val(data.producto_estado).trigger('change.select2');
		$("#select_proveedor_editarr").select2().val(data.cliente_id).trigger('change.select2');
		$("#select_unidadm_editar").select2().val(data.unidad_id).trigger('change.select2');
		if(tiene_imei == "Si")
		{
			Ver_detalle_pro(parseInt(data.producto_id));
		} else {
			limpiarTabla_regimei_editar();
		}


	}
	//console.log(data.analisis_id);//para enviar el dato  en console
});


/********************************************************************
		   ELIMINAR IMEI DEL DETALLE DEL PRODUCTO
********************************************************************/
$('#tabla_det_pro_disminuir').on('click', '.eliminar_det_p', function () {//campo activar tiene que ir en el boton
	var data = tbl_ver_imei_disminuir.row($(this).parents('tr')).data();//tamaño de escritorio
	if (tbl_ver_imei_disminuir.row(this).child.isShown()) {
		var data = tbl_ver_imei_disminuir.row(this).data();//para celular y usas el responsive datatable

	}
	 imei_dis = data.imei;
	 id_prd_dis = document.getElementById('idproducto_imei_dis').value;
	let alm_dis = document.getElementById('idalmacen_imei_dis').value;
	//console.log(imei_dis, id_prd_dis, alm_dis);


	Swal.fire({
		title: 'Desea Eliminar el imei: ' + data.imei,
		text: "Ya no se podra deshacer el cambio",
		icon: 'warning',
		showCancelButton: true,
		// confirmButtonColor: '#3085d6',
		// cancelButtonColor: '#d33',
		confirmButtonText: 'Eliminar Imei'
	}).then((result) => {

		if (result.isConfirmed) {
			Eliminar_imei(id_prd_dis,  imei_dis, alm_dis);//data 0 (id)
			//console.log(" Eliminar el imei");



		} else {

			//console.log("Error al Eliminar el imei");
		}

	})
});


/********************************************************************
		 ELIMINAR ITEM DEL DETALLE DEL PRODUCTO - IMEI
********************************************************************/
function Eliminar_imei(id_pr_e, imei_e, almid) {

	let idprodt_au = document.getElementById('idproducto_imei_dis').value;
	let almacenid = document.getElementById('idalmacen_imei_dis').value;
	let sucuid = document.getElementById('idsucu_imei_dis').value;

	$.ajax({
		url: '../controller/producto/controlador_eliminar_imei.php',
		type: 'POST',
		data: {
			id_pr_e: id_pr_e,//le enviamos los campos al controlador
			imei_e: imei_e,
			almid: almid

		}
	}).done(function (resp) {
		if (resp > 0) {
			Swal.fire("Mensaje de Confirmacion", "Imei Eliminado", "success").then((value) => {
				tbl_ver_imei_disminuir.ajax.reload();//recargar dataTable
				tbl_producto.ajax.reload();

				Traer_stock_Producto(idprodt_au, sucuid, almacenid );
				
			});
		} else {
			Swal.fire("Mensaje de Error", "No se puede Eliminar el imei", "error");
		}
	})
}


/********************************************************************
			 CARGAR CATEGORIAS EN COMBO
********************************************************************/
function cargar_SelectCategoria() {
	$.ajax({
		url: '../controller/producto/controlador_cargar_select_categoria.php',
		type: 'POST'
	}).done(function (resp) {
		let data = JSON.parse(resp);
		let llenardata = "<option value=''>Seleccione</option>";
		if (data.length > 0) {
			for (let i = 0; i < data.length; i++) {
				llenardata += "<option value='" + data[i][0] + "'>" + data[i][1] + "</option>";
			}
			document.getElementById('select_categoria').innerHTML = llenardata;
			document.getElementById('select_categoria_editar').innerHTML = llenardata;
		} else {
			llenardata += "<option value=''>No se encontraron datos</option>";
			document.getElementById('select_categoria').innerHTML = llenardata;
			document.getElementById('select_categoria_editar').innerHTML = llenardata;

		}
	})
}



/********************************************************************
			 CARGAR MARCAS EN COMBO
********************************************************************/
function cargar_SelectMarca() {
	$.ajax({
		url: '../controller/producto/controlador_cargar_select_marca.php',
		type: 'POST'
	}).done(function (resp) {
		let data = JSON.parse(resp);//POSICION DE LA FILA Y COLUMNA
		let llenardata = "<option value=''>Seleccione</option>";
		if (data.length > 0) {
			for (let i = 0; i < data.length; i++) {
				llenardata += "<option value='" + data[i][0] + "'>" + data[i][1] + "</option>";
			}
			document.getElementById('select_marca').innerHTML = llenardata;//primero para registrar luego en modificar colocamos el select editar
			document.getElementById('select_marca_editar').innerHTML = llenardata;
		} else {
			llenardata += "<option value=''>No se encontraron datos</option>";
			document.getElementById('select_marca').innerHTML = llenardata;
			document.getElementById('select_marca_editar').innerHTML = llenardata;

		}
	})
}

/********************************************************************
	  CARGAR PROVEEDOR EN COMBO
********************************************************************/
function cargar_Select_Proveedor() {//enviamos al scrpit mantenimiento examen
	$.ajax({
		url: '../controller/cotizacion/controlador_cargar_select_proveedor.php',
		type: 'POST'
	}).done(function (resp) {
		let data = JSON.parse(resp);//POSICION DE LA FILA Y COLUMNA
		let llenardata = "<option value=''>Seleccione</option>";
		if (data.length > 0) {
			for (let i = 0; i < data.length; i++) {
				llenardata += "<option value='" + data[i][0] + "'>" + data[i][2] + "</option>";
			}
			document.getElementById('select_proveedor').innerHTML = llenardata;//primero para registrar luego en modificar colocamos el select editar
			document.getElementById('select_proveedor_editarr').innerHTML = llenardata;
		} else {
			llenardata += "<option value=''>No se encontraron datos</option>";
			document.getElementById('select_proveedor').innerHTML = llenardata;
			document.getElementById('select_proveedor_editarr').innerHTML = llenardata;

		}
	})
}
 

/********************************************************************
			 CARGAR UNIDADES EN COMBO
********************************************************************/
function cargar_Select_Unidad() {//enviamos al scrpit mantenimiento examen
	$.ajax({
		url: '../controller/producto/controlador_cargar_select_unidadm.php',
		type: 'POST'
	}).done(function (resp) {
		let data = JSON.parse(resp);//POSICION DE LA FILA Y COLUMNA
		let llenardata = "<option value=''>Seleccione</option>";
		if (data.length > 0) {
			for (let i = 0; i < data.length; i++) {
				llenardata += "<option value='" + data[i][0] + "'>" + data[i][1] + "</option>";
			}
			document.getElementById('select_unidadm').innerHTML = llenardata;//primero para registrar luego en modificar colocamos el select editar
			document.getElementById('select_unidadm_editar').innerHTML = llenardata;
		} else {
			llenardata += "<option value=''>No se encontraron datos</option>";
			document.getElementById('select_unidadm').innerHTML = llenardata;
			document.getElementById('select_unidadm_editar').innerHTML = llenardata;

		}
	})
}






async function convertToWebP(file) {
    return new Promise((resolve) => {
        const image = new Image();
        image.onload = () => {
            const canvas = document.createElement('canvas');
            canvas.width = image.width;
            canvas.height = image.height;
            canvas.getContext('2d').drawImage(image, 0, 0);
            canvas.toBlob((blob) => {
                resolve(blob);
            }, 'image/webp');
        };
        image.src = URL.createObjectURL(file);
    });
}
/********************************************************************
						 REGISTRAR PRODUCTO
********************************************************************/
function RegistrarProducto() {
	let count = 0;
	let selectImei = document.getElementById('select_habi_imei').value;

	if (selectImei == "Si") {
		$("#tabla_det_pro tbody#tbody_tabla_det_pro tr ").each(function () {
			count++;
		});

		if (count == 0) {
			return Swal.fire("Mensaje de Advertencia", "Debe agregar un imei en el detalle", "warning");
		}
	}
	let producto = document.getElementById('text_producto').value;
	let stock = document.getElementById('text_stock').value;
	let pcompra = document.getElementById('text_pcompra').value;
	let pventa = document.getElementById('text_pventa').value;
	let marca = document.getElementById('select_marca').value;
	let categoria = document.getElementById('select_categoria').value;
	let cod_gene = document.getElementById('text_codigo_g').value;
	let provee = document.getElementById('select_proveedor').value;
	let foto = document.getElementById('text_foto').value;
	let unidadmedida = document.getElementById('select_unidadm').value;
	let verentienda = document.getElementById('chk_ver').checked ? "Si" : "No";
	let descrip_p = document.getElementById('text_descrip_p').value;
	let sucurid = document.getElementById('text_idsucurs').value;
	let almaid = document.getElementById('text_idalmacen').value;
	let rolid = document.getElementById('text_idrol').value;
	let prec_comercia = document.getElementById('text_pcomercial').value;
	let prec_mayor = document.getElementById('text_pmayor').value;

	if (marca.length == 0) {
		return Swal.fire("Mensaje de Advertencia", "Seleccione una marca", "warning");
	}
	if (selectImei == "Seleccione") {
		return Swal.fire("Mensaje de Advertencia", "Selecciones si el El Articulo lleva imei", "warning");
	}
	if (categoria.length == 0) {
		return Swal.fire("Mensaje de Advertencia", "Seleccione una categoria", "warning");
	}
	if (unidadmedida.length == 0) {
		return Swal.fire("Mensaje de Advertencia", "Seleccione ua unidad de medida", "warning");
	}
	if (prec_comercia.length == 0) {
		return Swal.fire("Mensaje de Advertencia", "Ingrese un precio comercial", "warning");
	}
	if (prec_mayor.length == 0) {
		return Swal.fire("Mensaje de Advertencia", "Ingrese un precio mayorista", "warning");
	}

	if (producto.length == 0 || stock.length == 0 || pcompra.length == 0 || pventa.length == 0) {
		ValidarCamposProducto("text_producto", "text_stock", "text_pcompra", "text_pventa");
		return Swal.fire("Mensaje de Advertencia", "Tiene campos vacios", "warning");
	}

	//capturar foto
	let extension = foto.split('.').pop();
	let nombrefoto = "";
	let f = new Date();
	if (foto.length > 0) {
		nombrefoto = "PROD" + f.getDate() + "" + (f.getMonth() + 1) + "" + f.getFullYear() + "" + f.getHours() + "" + f.getMilliseconds() + ".webp";
	}
	let formData = new FormData();
	let fotoObject = $("#text_foto")[0].files[0];
	if (fotoObject) { 
		// Convertir la imagen a WebP antes de enviar
		convertToWebP(fotoObject).then(webpBlob => {
			formData.append('producto', producto);
			formData.append('marca', marca);
			formData.append('categoria', categoria);
			formData.append('stock', stock);
			formData.append('pcompra', pcompra);
			formData.append('pventa', pventa);
			formData.append('cod_gene', cod_gene);
			formData.append('provee', provee);
			formData.append('nombrefoto', nombrefoto);
			//formData.append('foto', fotoObject);
			formData.append('foto', webpBlob, nombrefoto);
			formData.append('unidadmedida', unidadmedida);
			formData.append('selectImei', selectImei);
			formData.append('verentienda', verentienda);
			formData.append('descrip_p', descrip_p);
			formData.append('sucurid', sucurid);
			formData.append('almaid', almaid);
			formData.append('prec_comercia', prec_comercia);
			formData.append('prec_mayor', prec_mayor);
			//formData.append('rolid', rolid);
			//console.log(fotoObject);
		
				$.ajax({
					url: '../controller/producto/controlador_producto_registar.php',
					type: 'POST',
					data: formData,
					contentType: false,
					processData: false,
					success: function (resp) {
						//console.log();
					 // console.log(resp);
						if (resp > 0) {
							if (selectImei == "Si") {
								Registrar_Detalle_Pro(parseInt(resp));
							} else {
								LimpiarModalProducto();
								Swal.fire("Mensaje de Confirmacion", "Producto Registrado", "success").then((value) => {
									tbl_producto.ajax.reload();
									limpiarTabla_regimei();
									$('#ocul_imei').prop('hidden', true);
									$("#modal_registro_producto").modal('hide');
								});
							}
						} else {
							Swal.fire("Mensaje de Error", "No se puede registrar el Producto", "error");
						}
						
					}
				});
			});

	} else {
		// Convertir la imagen a WebP antes de enviar
	
			formData.append('producto', producto);
			formData.append('marca', marca);
			formData.append('categoria', categoria);
			formData.append('stock', stock);
			formData.append('pcompra', pcompra);
			formData.append('pventa', pventa);
			formData.append('cod_gene', cod_gene);
			formData.append('provee', provee);
			formData.append('nombrefoto', nombrefoto);
			//formData.append('foto', fotoObject);
			formData.append('foto', nombrefoto);
			formData.append('unidadmedida', unidadmedida);
			formData.append('selectImei', selectImei);
			formData.append('verentienda', verentienda);
			formData.append('descrip_p', descrip_p);
			formData.append('sucurid', sucurid);
			formData.append('almaid', almaid);
			formData.append('prec_comercia', prec_comercia);
			formData.append('prec_mayor', prec_mayor);
			//formData.append('rolid', rolid);
			//console.log(fotoObject);
		
				$.ajax({
					url: '../controller/producto/controlador_producto_registar.php',
					type: 'POST',
					data: formData,
					contentType: false,
					processData: false,
					success: function (resp) {
						console.log(resp);
						//console.log(resp);
						if (resp > 0) {
							if (selectImei == "Si") {
								Registrar_Detalle_Pro(parseInt(resp));
							} else {
								LimpiarModalProducto();
								Swal.fire("Mensaje de Confirmacion", "Producto Registrado", "success").then((value) => {
									tbl_producto.ajax.reload();
									limpiarTabla_regimei();
									$('#ocul_imei').prop('hidden', true);
									$("#modal_registro_producto").modal('hide');
								});
							}
						} else {
							Swal.fire("Mensaje de Error", "No se puede registrar el Producto", "error");
						}
						
					}
				});
			

	}

	 
	return false;
}



/********************************************************************
	   CAMBIAR FOTO DEL PRODUCTO
********************************************************************/
function ModificarFotoEmpresa() {
	let id = document.getElementById('idproducto_foto').value;
	let foto = document.getElementById('text_foto_editar').value;
	let rutaactual = document.getElementById('fotoactual').value;
	let cod_gen = document.getElementById('cod_barra').value;//codigo de barra
	
	if (id.length == 0 || foto.length == 0) {
		return Swal.fire("Mensaje de Advertencia", "Tiene campos vacios", "warning");
	}

	//capturar foto
	let extension = foto.split('.').pop();//capturar despues del punto foto122.jpg
	let nombrefoto = "";
	let f = new Date();
	if (foto.length > 0) {
		nombrefoto = "PRO-" + f.getDate() + "" + (f.getMonth() + 1) + "" + f.getFullYear() + "" + f.getHours() + "" + f.getMilliseconds()  + ".webp";
		//nombrefoto = "PRO-" + f.getDate() + "" + (f.getMonth() + 1) + "" + f.getFullYear() + "" + f.getHours() + "" + f.getMilliseconds() + "." + extension;

	}
	let formData = new FormData();
	let fotoObject = $("#text_foto_editar")[0].files[0];//objeto de la foto adjuntada

	convertToWebP(fotoObject).then(webpBlob => {
	formData.append('id', id);
	formData.append('rutaactual', rutaactual);
	formData.append('nombrefoto', nombrefoto);
	//formData.append('foto', fotoObject);
	formData.append('foto', webpBlob, nombrefoto);
	
		$.ajax({
			url: '../controller/producto/controlador_producto_modificar_foto.php',
			type: 'POST',
			data: formData,
			contentType: false,
			processData: false,
			success: function (resp) {
				if (resp > 0) {
					Swal.fire("Mensaje de Confirmacion", "Foto del producto Actualizado", "success").then((value) => {
						$("#modal_editar_foto").modal('hide');//ocultamos modal despues de registrar
						tbl_producto.ajax.reload();//recargar dataTable
						//TraerNotificaciones();
					});
				} else {
					Swal.fire("Mensaje de Error", "No se puede Actualizar la foto", "error");
				}
			}
		});
	});
}




/********************************************************************
						 VALIDAR CAMPOS PRODUCTO
********************************************************************/
function ValidarCamposProducto(producto, stock, pcompra, pventa) {
	Boolean(document.getElementById(producto).value.length > 0) ? $("#" + producto).removeClass("is-invalid").addClass("is-valid") : $("#" + producto).removeClass("is-valid").addClass("is-invalid");
	Boolean(document.getElementById(stock).value.length > 0) ? $("#" + stock).removeClass("is-invalid").addClass("is-valid") : $("#" + stock).removeClass("is-valid").addClass("is-invalid");
	Boolean(document.getElementById(pcompra).value.length > 0) ? $("#" + pcompra).removeClass("is-invalid").addClass("is-valid") : $("#" + pcompra).removeClass("is-valid").addClass("is-invalid");
	Boolean(document.getElementById(pventa).value.length > 0) ? $("#" + pventa).removeClass("is-invalid").addClass("is-valid") : $("#" + pventa).removeClass("is-valid").addClass("is-invalid");
}


/********************************************************************
						 LIMPIAR TEXBOX PRODUCTO
********************************************************************/
function LimpiarModalProducto() {
	document.getElementById('text_producto').value = "";
	document.getElementById('text_stock').value = "";
	document.getElementById('text_pcompra').value = "";
	document.getElementById('text_pventa').value = "";
	document.getElementById('text_codigo_g').value = "";
	document.getElementById('text_imei').value = "";
	document.getElementById('text_descrip_p').value = "";
	$("#select_marca").select2().val("").trigger('change.select2');
	$("#select_categoria").select2().val("").trigger('change.select2');
	$("#select_proveedor").select2().val("").trigger('change.select2');
	$("#select_unidadm").select2().val("").trigger('change.select2');
	$("#select_habi_imei").select2().val("Seleccione").trigger('change.select2');
	$("#select_sucur").select2().val("Seleccione").trigger('change.select2');

}


/********************************************************************
						 SUMAR AUTOMATICAMENTE EN LOS TEXBOX 
********************************************************************/
function calcular() {
	try {
		var a = parseFloat(document.getElementById('text_stock_editar_2').value) || 0,
			b = parseFloat(document.getElementById('text_stock_aumentar').value) || 0;

		document.getElementById('text_stock_suma').value = a + b;
	} catch (e) { }

}

function calcularResta() {
	try {
		var c = parseFloat(document.getElementById('text_stock_editar_2_dis').value) || 0,
			d = parseFloat(document.getElementById('text_stock_disminuir_dis').value) || 0;

		document.getElementById('text_stock_resta').value = c - d;
	} catch (e) { }

}


/********************************************************************
						MODIFICAR PRODUCTO
********************************************************************/
function ModificarProducto() {//enviamos los datos del ajax al controlador y al onclick del boton editar
	let id = document.getElementById('idproducto').value;
	let producto = document.getElementById('text_producto_editar').value;
	let pcompra = (document.getElementById('text_pcompra_editar').value).trim();
	let pventa = (document.getElementById('text_pventa_editar').value).trim();
	let marca = document.getElementById('select_marca_editar').value;
	let categoria = document.getElementById('select_categoria_editar').value;
	let estado = document.getElementById('select_estado_producto_editar').value;
	let cod_gene = document.getElementById('text_codigo_g_editar').value;
	let provee = document.getElementById('select_proveedor_editarr').value;
	let unidadm = document.getElementById('select_unidadm_editar').value;
	let verentienda = document.getElementById('chk_ver_editar').checked ? "Si" : "No";
	let descrip_p = document.getElementById('text_descrip_p_editar').value;
	let prec_comercia = document.getElementById('text_pcomercial_editar').value;
	let prec_mayor = document.getElementById('text_pmayor_editar').value;
	let almaid = document.getElementById('text_idalmacen').value;

	if (marca.length == 0) {
		return Swal.fire("Mensaje de Advertencia", "Seleccione una marca", "warning");
	}
	if (categoria.length == 0) {
		return Swal.fire("Mensaje de Advertencia", "Seleccione una categoria", "warning");
	}
	if (prec_comercia.length == 0) {
		return Swal.fire("Mensaje de Advertencia", "Ingrese un precio comercial", "warning");
	}
	if (prec_mayor.length == 0) {
		return Swal.fire("Mensaje de Advertencia", "Ingrese un precio mayorista", "warning");
	}

	if (producto.length == 0 || pcompra.length == 0 || pventa.length == 0) {
		return Swal.fire("Mensaje de Advertencia", "Tiene campos vacios", "warning");
	}

	$.ajax({
		url: '../controller/producto/controlador_modificar_producto.php',
		type: 'POST',
		data: {
			id: id,//le enviamos los campos al controlador
			producto: producto,//le enviamos los campos al controlador
			marca: marca,
			categoria: categoria,
			pcompra: pcompra,
			pventa: pventa,
			estado: estado,
			cod_gene: cod_gene,
			provee: provee,
			unidadm: unidadm,
			verentienda:verentienda,
			descrip_p:descrip_p,
			prec_comercia:prec_comercia,
			prec_mayor:prec_mayor,
			almaid:almaid
			
		}
	}).done(function (resp) {
		if (resp > 0) {
			if (resp == 1) {//validamos la respuesta del procedure si retorna 1 o 2
				//ValidarCamposProducto("text_producto","text_stock","text_pcompra","text_pventa");
				//LimpiarModalPaciente();
				Swal.fire("Mensaje de Confirmacion", "Producto Actualizado", "success").then((value) => {
					$("#modal_editar_producto").modal('hide');//abrimos el modal
					tbl_producto.ajax.reload();//recargar dataTable
					//TraerNotificaciones();
				});
			} else {
				Swal.fire("Mensaje de Advertencia", "El Producto ya se encuentra registrado", "warning");

			}

		} else {
			Swal.fire("Mensaje de Error", "No se puede registrar el Producto", "error");
		}
	})
}





/********************************************************************
					   AUMENTAR STOCK
********************************************************************/
function SumarStock() {//enviamos los datos del ajax al controlador y al onclick del boton editar
	let id = document.getElementById('idproducto_aumentar').value;
	let cantidad = document.getElementById('text_stock_aumentar').value;
	let total = document.getElementById('text_stock_suma').value;
	let almacenid = document.getElementById('idalmacen_aumentar').value;

	if (cantidad.length == 0) {
		return Swal.fire("Mensaje de Advertencia", "Ingrese cantida Aumentar", "warning");
	}

	if (parseInt(cantidad) < 1) {
		return Swal.fire("Mensaje de Advertencia", "La cantidad debe ser mayor a 0", "warning");
	}

	if (parseInt(cantidad) < 0.1) {
		return Swal.fire("Mensaje de Advertencia", "El precio debe ser mayor a 0", "warning");
	}


	$.ajax({
		url: '../controller/producto/controlador_aumentar_stock_producto.php',
		type: 'POST',
		data: {
			id: id,//le enviamos los campos al controlador
			cantidad: cantidad,//le enviamos los campos al controlador
			total: total,
			almacenid: almacenid //almacen donde se va a aumentar el stock

		}
	}).done(function (resp) {
		//alert(resp);
		if (resp > 0) {
			Swal.fire("Mensaje de Confirmacion", "Stock Aumentado", "success").then((result) => {
				$("#modal_aumentar_stock").modal('hide');//abrimos el modal

				tbl_producto.ajax.reload();//recargar dataTable
			});

		} else {
			return Swal.fire("Mensaje de Error", "No se pudo completar el registro", "error");
		}
	})
}




/********************************************************************
						DISMINUIR STOCK
 ********************************************************************/
function DisminuirStock() {//enviamos los datos del ajax al controlador y al onclick del boton editar
	let id = document.getElementById('idproducto_dis').value;
	let cantidad = document.getElementById('text_stock_disminuir_dis').value;
	let total = document.getElementById('text_stock_resta').value;
	let almacenid_d = document.getElementById('idalmacen_dis').value;

	let stockactual = document.getElementById('text_stock_editar_2_dis').value;


	if (cantidad.length == 0) {
		return Swal.fire("Mensaje de Advertencia", "Ingrese cantida Aumentar", "warning");
	}

	if (parseInt(cantidad) < 1) {
		return Swal.fire("Mensaje de Advertencia", "La cantidad debe ser mayor a 0", "warning");
	}

	if (parseInt(cantidad) < 0.1) {
		return Swal.fire("Mensaje de Advertencia", "El precio debe ser mayor a 0", "warning");
	}

	if (parseInt(cantidad) > parseInt(stockactual)) {
		return Swal.fire("Mensaje de Advertencia", "Cantidad tiene que ser menor que el stock actual: " + stockactual, "warning");
	}


	$.ajax({
		url: '../controller/producto/controlador_disminuir_stock_producto.php',
		type: 'POST',
		data: {
			id: id,//le enviamos los campos al controlador
			cantidad: cantidad,//le enviamos los campos al controlador
			total: total,
			almacenid_d:almacenid_d

		}
	}).done(function (resp) {
		//alert(resp);
		if (resp > 0) {
			Swal.fire("Mensaje de Confirmacion", "Salida Registrada", "success").then((result) => {
				$("#modal_disminuir_stock").modal('hide');//abrimos el modal

				tbl_producto.ajax.reload();//recargar dataTable
			});

		} else {
			return Swal.fire("Mensaje de Error", "No se pudo completar el registro", "error");
		}
	})
}



/********************************************************************
	   BOTON AGREGAR IMEI AL DETALLE 
********************************************************************/
function Agregar_Imei() {

	//let idproducto = document.getElementById('text_idproducto').value;
	let imei = document.getElementById('text_imei').value;

	if (imei.length == 0) {
		return Swal.fire("Mensaje de Advertencia", "Ingrese un Imei", "warning");
	}

	//llamamos la funcion para verificar si ya esta agregado en el detalle
	if (verificarid(imei)) {
		return Swal.fire("Mensaje de Advertencia", "El Imei ya esta agregado", "warning");
	}

	let datos_agregar = "<tr>"; //para agregar en el detalle DEL EXAMEN
	datos_agregar += "<td class='im' for='id'>" + imei + "</td>";//hace referenci al verificar id
	datos_agregar += "<td><button class='btn btn-danger btn-sm remove' onclick='remove(this);'><i class ='fa fa-trash'></i> </button></td>";
	datos_agregar += "</tr>";//cierre de etiqueta
	$("#tbody_tabla_det_pro").append(datos_agregar);//agregamos a la tabla style="text-align: center;"
	document.getElementById('text_imei').value = "";
	$("#text_imei").focus();
	sumar_columnas();
}


//VALIDAR QUE EL IMEI YA NO ESTE REGISTRADO EN OTRO EQUIPO
function validaImei() {
	let imei_valid = document.getElementById('text_imei').value;
	$.ajax({
		url: '../controller/producto/controlador_validar_imei.php',
		type: 'POST',
		data: {
			imei_valid: imei_valid

		}
	}).done(function (resp) {
		//console.log(resp);
		if (resp > 0) {
			if (resp == 1) {
				Swal.fire("Mensaje de Advertencia", "El Imei " + imei_valid + " ya se encuentra registrado en un Equipo.", "warning");
				
			} else if (resp == 2) {
				Swal.fire({
					title: "Informacion",
					text: "El Imei " + imei_valid + " ya tuvo una recepción. ¿Deseas agregarlo de todas formas?",
					icon: "info",
					showCancelButton: true,
					confirmButtonText: "Sí, agregar",
					cancelButtonText: "No, cancelar"
				}).then((result) => {
					if (result.isConfirmed) {
						Agregar_Imei();
					}
				});
				
			} else {
				
				Agregar_Imei();
			}

		} else {
			Swal.fire("Mensaje de Error", "No se puede agregar el imei", "error");
		}
	})

}

function sumar_columnas(){
    var sum=0;
        //itera cada input de clase .subtotal y la suma
        $('.im').each(function() {sum += parseFloat(1);                     
        }); 
        $('#text_stock').val(sum);
        //$('#iptStockReg').val(sum.toFixed(2));
    }



/********************************************************************
		   PARA QUE NO SE REPITA UN PRODUCTO EN EL DETALLE
********************************************************************/
function verificarid(imei) {
	let idverificar = document.querySelectorAll('#tabla_det_pro td[for="id"]');
	return [].filter.call(idverificar, td => td.textContent === imei).length === 1;
}


/********************************************************************
		  REMOVER IMEI DEL DETALLE
********************************************************************/
function remove(t) {
	var td = t.parentNode;
	var tr = td.parentNode;
	var table = tr.parentNode;
	Swal.fire({
		title: 'Desea remover el Imei? ',
		text: "",
		icon: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: 'Si, confirmar'
	}).then((result) => {
		if (result.isConfirmed) {
			table.removeChild(tr);
		}
	})

	//SumarTotalneto();
}


/********************************************************************
		   REGISTRAR DETALLE 
********************************************************************/
function Registrar_Detalle_Pro(id) {
	let sucurid = document.getElementById('text_idsucurs').value;
	let almaid = document.getElementById('text_idalmacen').value;

	let count = 0;
	let arreglo_producto = new Array();

	$("#tabla_det_pro  tbody#tbody_tabla_det_pro tr ").each(function () {
		arreglo_producto.push($(this).find('td').eq(0).text());
		count++;
	})

	let producto = arreglo_producto.toString();

	$.ajax({
		url: '../controller/producto/controlador_prod_detalle_registar.php',
		type: 'POST',
		data: {
			id: id,
			producto: producto,
			sucurid:sucurid,
			almaid:almaid

		}
	}).done(function (resp) {
		if (resp > 0) {
			LimpiarModalProducto();
			Swal.fire("Mensaje de Confirmacion", "Producto Registrado", "success").then((value) => {

				tbl_producto.ajax.reload();
				limpiarTabla_regimei();
				$("#modal_registro_producto").modal('hide');
			});
		} else {
			return Swal.fire("Mensaje de Error", "No se pudo completar el registro", "error");
		}
	})
}


function limpiarTabla_regimei() {
	var table_reg_imei = document.getElementById("tabla_det_pro");
	var rowCount = table_reg_imei.rows.length;

	// Eliminar todas las filas excepto la primera (encabezados)
	while (rowCount > 1) {
		table_reg_imei.deleteRow(1);
		rowCount--;
	}
}

function limpiarTabla_regimei_editar() {
	var table_reg_imei_editar = document.getElementById("tabla_det_pro_edit");
	var rowCount = table_reg_imei_editar.rows.length;

	// Eliminar todas las filas excepto la primera (encabezados)
	while (rowCount > 1) {
		table_reg_imei_editar.deleteRow(1);
		rowCount--;
	}
}

function limpiarTabla_regimei_aumentar() {
	var table_reg_imei_aument = document.getElementById("tabla_det_pro_edit");
	var rowCount = table_reg_imei_aument.rows.length;

	// Eliminar todas las filas excepto la primera (encabezados)
	while (rowCount > 1) {
		table_reg_imei_aument.deleteRow(1);
		rowCount--;
	}
}

function limpiarTabla_regimei_disminuir() {
	var table_reg_imei_disminuir = document.getElementById("tabla_det_pro_edit");
	var rowCount = table_reg_imei_disminuir.rows.length;

	// Eliminar todas las filas excepto la primera (encabezados)
	while (rowCount > 1) {
		table_reg_imei_disminuir.deleteRow(1);
		rowCount--;
	}
}
/*===================================================================*/
//PARA MAYUSCULAS
/*===================================================================*/
function mayus(e) {
	e.value = e.value.toUpperCase();
}


/********************************************************************
       AUMENTAR IMEI DIRECTO REGISTRAR
********************************************************************/
function RegisMod_ImeiAumentar() {
    let imei_au = document.getElementById('text_imei_aumentar').value;
    let idprodt_au = document.getElementById('idproducto_imei').value;
	let almacenid = document.getElementById('idalmacen_aumentar_imei').value;

	let sucuid = document.getElementById('idsucu_imei').value;

    if (imei_au.length == 0) {
        return Swal.fire("Mensaje de Advertencia", "Ingrese un Imei", "warning");
     //   $("#text_imei_edit").focus();
    }
	
    // Validar que el IMEI no contenga espacios
    if (/\s/.test(imei_au)) {
        return Swal.fire("Mensaje de Advertencia", "El IMEI no debe contener espacios", "warning");
    }

    // Validar que el IMEI tenga exactamente 15 dígitos
    // if (!/^\d{15}$/.test(imei_au)) {
    //     return Swal.fire("Mensaje de Advertencia", "El IMEI debe tener exactamente 15 dígitos", "warning");
    // }

	// if (!/^\d{10,15}$/.test(imei_au)) {
	// 	return Swal.fire("Mensaje de Advertencia", "El IMEI debe tener entre 10 y 15 dígitos", "warning");
	// }

    $.ajax({
        url: '../controller/producto/controlador_insertar_imei_prod_mod.php',
        type: 'POST',
        data: {
            idprodt_au: idprodt_au,//le enviamos los campos al controlador
            imei_au: imei_au,
			almacenid:almacenid

        }
    }).done(function (resp) {
        if (resp > 0) {     
                Swal.fire("Mensaje de Confirmacion", "Imei Insertado", "success").then((value) => {
                    document.getElementById('text_imei_aumentar').value = "";
                    tbl_ver_imei_aumentar.ajax.reload();//recargar dataTable
					tbl_producto.ajax.reload();

					Traer_stock_Producto(idprodt_au, sucuid, almacenid );
                });
        } else {
            Swal.fire("Mensaje de Error", "No se puede Insertar el Imei", "error");
        }
    })
}


function Traer_stock_Producto(productoid, sucurid, almacen) {

	$.ajax({
		url: '../controller/producto/traer_stock_producto.php',
		type: 'POST',
		data:{
			productoid:productoid,
			sucurid: sucurid,
			almacen: almacen
		}

	}).done(function (resp) {
		//console.log(resp);
		let data = JSON.parse(resp); //POSICION DE LA FILA Y COLUMNA
         console.log("stock",data);
		// if (data.length > 0) {

		 	document.getElementById('text_stock_editar_imei').value = data[0][0];
			document.getElementById('text_stock_dismin_imei').value = data[0][0];

		// }
	})
}




//VALIDAR QUE EL IMEI YA NO ESTE REGISTRADO EN OTRO EQUIPO
function validaImei_reingreso() {
	let imei_valid_i = document.getElementById('text_imei_aumentar').value;

	
	$.ajax({
		url: '../controller/producto/controlador_validar_imei_reingresar_por_venta.php',
		type: 'POST',
		data: {
			imei_valid_i: imei_valid_i

		}
	}).done(function (resp) {
		//console.log(resp);
		if (resp > 0) {
			if (resp == 1) { //revisa si el imei esta registrDO

				Swal.fire("Mensaje de Error", "El Imei  ya se encuentra registrado", "error");
				
				
			} else if (resp == 4) { //revisa si el imei esta en una venta

				Swal.fire("Mensaje de Error", "El Imei  ya se encuentra vendido", "error");
				
				
			}
			/*else if (resp == 2) { //revisa si el imei esta vendido y en estado NO en tabla producto_detalle
				Swal.fire({
					//title: "Informacion",
					text: "El Imei " + imei_valid_i + " ya tuvo una venta. ¿Deseas reingresar, esto aumentará el Stock del Articulo",
					icon: "info",
					showCancelButton: true,
					confirmButtonText: "Sí, agregar",
					cancelButtonText: "No, cancelar"
				}).then((result) => {
					if (result.isConfirmed) {
						RegisMod_ImeiAumentar();
					}
				});
				
			} */
			else {
				
				RegisMod_ImeiAumentar();
				
			}

		} else {
			Swal.fire("Mensaje de Error", "No se puede agregar el imei", "error");
		}
	})

}