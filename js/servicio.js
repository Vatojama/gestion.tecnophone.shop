/********************************************************************
		   LISTAR SERVICIO METODO NORMAL
********************************************************************/

var tbl_servicio;
function Listar_Servicio() {//enviarlo al scrip en MANTENIMIENTO ROL
	var finicio = document.getElementById('text_finicio').value;
	var ffin = document.getElementById('text_ffin').value;
	var idusuario_filtro = document.getElementById('text_Idprincipal').value;
	let sucurid = document.getElementById('text_idsucurs').value;
	let rolid = document.getElementById('text_idrol').value;

	tbl_servicio = $("#tabla_servicio").DataTable({
		"responsive": true,
		"ordering": false,
		"bLengthChange": true,
		"searching": { "regex": false },
		"lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
		"pageLength": 10,
		"destroy": true,
		"async": false,
		"bprocessing": true,
		"dom": 'Blfrtip',
		"buttons": [
			{
				"extend": 'excelHtml5',
				"text": '<i class="fa fa-file-excel"></i>',
				"titleAttr": 'Exportar a Excel'
			},
			/*{
				"extend":    'pdfHtml5',
				"text":      '<i class="fas fa-file-pdf"></i> ',
				"titleAttr": 'Exportar a Pdf',
				"download": 'open',
				'className': 'btn btn-sm btn-success'
			}*/

		],
		"ajax": {
			"url": "../controller/servicio/controlador_servicio_listar.php",
			type: 'POST',
			data: {
				finicio: finicio,
				ffin: ffin,
				idusuario_filtro: idusuario_filtro,
				 sucurid:sucurid,
			   rolid:rolid
			}

		},
		"columns": [
			//todos los datos del procedimiento almacenado
			// { "defaultContent": "" },//cintador 
			{ "data": "referencia" },
			{ "data": "rece_cod" },
			{ "data": "cliente_nombres" },
			{ "data": "fpago_descripcion" },
			{ "data": "concepto" },
			{ "data": "servicio_monto" },
			{ "data": "servicio_comentario" },
			{ "data": "servicio_responsable" },
			{ "data": "servicio_fregistro" },
			{
				"data": "servicio_entrega",
				render: function (data, type, row) {
					if (data === "ENTREGADO") {
						return "<center>" + '<span class="badge badge-info">ENTREGADO</span>'; +"</center>"
					} if (data === "REPARADO") {
						return "<center>" + '<span class="badge badge-success">REPARADO</span>'; +"</center>"
					} if (data === "NO REPARADO") {
						return "<center>" + '<span class="badge badge-danger">NO REPARADO</span>'; +"</center>"
					} else {
						return "<center>" + '<span class="badge badge-info">EN REPARACION</span>'; +"</center>"
					}
				}
			},
			{
				"data": "estado_caja",
				render: function (data, type, row) {
					if (data === "ABIERTO") {
						return "<center>" + "<span class='CambiarEstado text-danger px-1' style='cursor:pointer;' title='Eliminar Servicio' ><i class= 'fa fa-trash'></i></span><span class='imprimir text-success px-1' style='cursor:pointer;' title='Imprimir Comprobante'><i class= 'fa fa-print'></i></span>" + "</center>"
					} else {
						return "<center>" + "<span class=' text-secundary px-1'   ><i class= 'fa fa-trash'></i></span><span class='imprimir text-success px-1' style='cursor:pointer;' title='Imprimir Comprobante'><i class= 'fa fa-print'></i></span>" + "</center>"
					}
				}
			}
			//{"defaultContent": "<center>"+"<span class='CambiarEstado text-danger px-1' style='cursor:pointer;' title='Eliminar Servicio' ><i class= 'fa fa-trash'></i></span><span class='imprimir text-success px-1' style='cursor:pointer;' title='Imprimir Comprobante'><i class= 'fa fa-print'></i></span>"+"</center>"}


		],
		"language": idioma_espanol,
		select: true
	});
	//contador en cada tabla
	// tbl_servicio.on('draw.td', function () {
	// 	var PageInfo = $("#tabla_servicio").DataTable().page.info();
	// 	tbl_servicio.column(0, { page: 'current' }).nodes().each(function (cell, i) {
	// 		cell.innerHTML = i + 1 + PageInfo.start;
	// 	});
	// });
}


/********************************************************************
		   PARA ABRIR MODAL VER LAS RECPCIONES PENDIENTES
********************************************************************/
function AbrirModalVerRecepcion() {
	//para que no se nos salga del modal haciendo click a los costados
	$("#modal_ver_recepcion").modal({ backdrop: 'static', keyboard: false });
	$("#modal_ver_recepcion").modal('show');//abrimos el modal
	Listar_Ver_Recepcion();
	//LimpiarModalUsuario();//limpiar texbox cada que demos en nuevo
	// $('.form-control').removeClass("is-invalid").removeClass("is-valid");//remover las clases
}

/********************************************************************
		  ABRIR MODAL VER LAS RECPCIONES PENDIENTES
********************************************************************/
var tbl_ver_recepcion;
//listar ver recepciones por entregar con sirverside (muchos datos)
function Listar_Ver_Recepcion() {
	tbl_ver_recepcion = $("#tabla_ver_recepcion").DataTable({
		"responsive": true,
		"pageLength": 10,
		"destroy": true,
		"bProcessing": true,
		"bDeferRender": true,
		"bServerSide": true,
		"sAjaxSource": "../controller/servicio/serverside/serverside_ver_recepcion.php",
		"columns": [
			//todos los datos de la vistaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa

			{ "data": 1 },//refere
			{ "data": 2 },//cliente
			//{"data":3},//modelos
			{ "data": 4 },//concepto
			{ "data": 5 },//monto
			//{ "data": 7 },//estado
			{
				"data": 7,
				render: function (data, type, row) {
					 if (data === "REPARADO") {
						return "<center>" + '<span class="badge badge-success">REPARADO</span>'; +"</center>"
					} if (data === "NO REPARADO") {
						return "<center>" + '<span class="badge badge-danger">NO REPARADO</span>'; +"</center>"
					} else {
						return "<center>" + '<span class="badge badge-info">EN REPARACION</span>'; +"</center>"
					}
				}
			},
			{ "data": 6 },//fecha

			{
				"data": null,//boton
				render: function (data, type, row) {
					return "<button class='btn btn-primary btn-sm enviardatos_rece'><i class= 'fa fa-share'></i></button>"
				}
			},

		],
		"language": idioma_espanol,
		select: true
	});
	//contador en cada tabla

}



var tbl_ver_detalle_recep;
function Ver_detalle_recep(idrec) {//enviarlo al scrip en MANTENIMIENTO ROL
	tbl_ver_detalle_recep = $("#tabla_detalle_recep").DataTable({
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
			"url": "../controller/recepcion/controlador_ver_detalle_recpcion.php",
			type: 'POST',
			data: {
				idrec: idrec
			}
		},
		"columns": [
			//todos los datos del procedimiento almacenado
			{ "data": "id_equipo" },
			{ "data": "equipo" },
			// { "data": "serie" },
			{ "data": "falla" },
			{ "data": "monto" },
			{ "data": "abono" },
			{ "data": "diagnostico" },
			{"defaultContent": "<center>"+"<span class='cambiar_monto_equipo text-info px-1' style='cursor:pointer;' data-bs-toggle='tooltip' data-bs-placement='top' title='Quitar de la recepcion'><i class= 'fas fa-pen-square'></i></span> "+"</center>"}


		],
		"language": idioma_espanol,
		select: true
	});

}




/********************************************************************
		  VER DETALLE DE LOS INSUMOS
********************************************************************/
var tbl_ver_insumos_repara;
function Ver_insumos(idrec) {//enviarlo al scrip en MANTENIMIENTO ROL
	tbl_ver_insumos_repara = $("#tabla_insumos").DataTable({
		"responsive": false,
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
			"url": "../controller/recepcion/controlador_ver_detalle_insumos_reparacion.php",
			type: 'POST',
			data: {
				idrec: idrec
			}
		},
		"columns": [
			//todos los datos del procedimiento almacenado
			{ "data": "id_insumo" },
			{ "data": "producto_nombre" },
			
			{ "data": "cantidad" },
			{ "data": "monto_ri" },
			{ "data": "fecha" },
        
			
		//	{"defaultContent": "<center>"+"<span class='elimar_ins text-danger px-2' style='cursor:pointer;' data-bs-toggle='tooltip' data-bs-placement='top' title='agregar disgnostico'><i class= 'fa fa-trash-alt'></i></span> "+"</center>"}


		],
		"language": idioma_espanol,
		select: true
	});

}










/********************************************************************
		  CAMBIAR MONTO A LOS EQUIPOS - REPARACION
********************************************************************/
$('#tabla_detalle_recep').on('click', '.cambiar_monto_equipo', function () {//class foto tiene que ir en el boton
	var data = tbl_ver_detalle_recep.row($(this).parents('tr')).data();//tamaño de escritorio
	if (tbl_ver_detalle_recep.row(this).child.isShown()) {
		var data = tbl_ver_detalle_recep.row(this).data();//para celular y usas el responsive datatable
	}
	//console.log(data);
	$("#modal_cambiar_monto").modal({ backdrop: 'static', keyboard: false });
	$("#modal_cambiar_monto").modal('show');

	document.getElementById('idequipo').value = data.id_equipo;
	document.getElementById('text_monto_e').value = data.monto;
	document.getElementById('text_abono_e').value = data.abono;
	document.getElementById('idrece_e').value = data.rece_id;
	

});


/********************************************************************
		   ENVIAR DATOS AL FORMULARION CON EL CLICK
********************************************************************/
$('#tabla_ver_recepcion').on('click', '.enviardatos_rece', function () { //id enviar( en el boton)
	var data = tbl_ver_recepcion.row($(this).parents('tr')).data();//tamaño de escritorio
	if (tbl_ver_recepcion.row(this).child.isShown()) {
		var data = tbl_ver_recepcion.row(this).data();//para celular y usas el responsive datatable
	}
	console.log("data ver recepcion ",data);
	$("#modal_ver_recepcion").modal('hide');//abrimos el modal*/

	//jalamos los datos al presionar editar (SERVERSIDE)
	document.getElementById('text_idrecepcion').value = data[0];//posisicion de la vista en el serviside
	
	document.getElementById('text_cliente').value = data[2];
	document.getElementById('text_refe').value = data[1];
	document.getElementById('text_model').value = data[3];
	document.getElementById('text_concepto').value = data[4];
	document.getElementById('text_monto').value = data[5];

	document.getElementById('text_frecepcion').value = data[10];
	document.getElementById('text_adelanto').value = data[8];
	document.getElementById('text_pendiente').value = data[9];

	document.getElementById('text_comentario').value = data[11];
	document.getElementById('text_responsable').value = data[12];

	document.getElementById('estado_recep').innerHTML = data[7];
	document.getElementById('text_idtecnico').value = data[13];
	document.getElementById('text_idsucursa').value = data[14];
	Ver_detalle_recep(data[0]) ;
	Ver_insumos(data[0]);
	recalculo_montos();
});



/********************************************************************
		   IMPRIMIR COMPROBANTES
********************************************************************/
$('#tabla_servicio').on('click', '.imprimir', function () {//class foto tiene que ir en el boton
	var data = tbl_servicio.row($(this).parents('tr')).data();//tamaño de escritorio
	if (tbl_servicio.row(this).child.isShown()) {
		var data = tbl_servicio.row(this).data();//para celular y usas el responsive datatable
	}
	//console.log(data);
	$("#modal_impresion").modal({ backdrop: 'static', keyboard: false });
	$("#modal_impresion").modal('show');//abrimos el modal
	document.getElementById('text_idser').value = data.servicio_id;
	document.getElementById('text_idre').value = data.rece_id;

	document.getElementById('text_numerocel').value = data.cliente_celular;
	document.getElementById('text_nombrecliente_w').value = data.nombre_cli;
	
	Traer_url_sistema();
});

//ENVIO RECEPCION A WHATSAPP
$('#btn_whatsapp').on('click', function () {
	var rutaBase = document.getElementById('text_url_sistema').value;
	var cod_pais = document.getElementById('text_cod_pais').value;
	let tick_whatsa = document.getElementById('text_idre').value;
	let clientnombre = document.getElementById('text_nombrecliente_w').value;
	
	var numeromovil = document.getElementById("text_numerocel").value;
	var rutaPDFentrega = rutaBase+"MPDF/reporte_resguardo_entrega.php?codigo=" + parseInt(document.getElementById('text_idre').value) + "#zoom=100";
    
    //Verificar si el número es válido (solo números y longitud adecuada)
    if (numeromovil.match(/^\d+$/) && numeromovil.length >= 9 && numeromovil.length <= 15) {
      // Construir la URL de WhatsApp con el número y el mensaje deseado
	  var mensaje = encodeURIComponent("Enlace para descargar archivo PDF - Nro Recepcion: [R-000"+tick_whatsa +"] |  Cliente: [ "  + clientnombre +" ]  |   CONSTANCIA DE ENTREGA:   " + rutaPDFentrega );
      var url = "https://wa.me/"+cod_pais+numeromovil+"?text=" + mensaje;
      
      // Abrir la ventana de WhatsApp en una nueva pestaña
      window.open(url, '_blank');
    } else {
		Swal.fire("Erro de numero", "Por favor, ingrese un número de WhatsApp válido.", "warning");
    }
});



//IMPRESION TICKET
$('#btn_ticket').on('click', function () {
	//let tick_rec = document.getElementById('text_idser').value;
	let tick_rec = document.getElementById('text_idre').value;

	window.open("../MPDF/reporte_servicio.php?codigo=" + parseInt(tick_rec) + "#zoom=100", "Ticket de Servicio", "scrollbards=NO");
});

//IMPRESION FACTURA
$('#btn_factura').on('click', function () {
	let tick_rec = document.getElementById('text_idre').value;

	window.open("../MPDF/impre_fact_servicio.php?codigo=" + parseInt(tick_rec) + "#zoom=100", "factura", "scrollbards=NO");
});



//IMPRESION RESGUARDO ENTREGA
$('#btn_entrega').on('click', function () {
	let ent_rec = document.getElementById('text_idre').value;

	window.open("../MPDF/reporte_resguardo_entrega.php?codigo=" + parseInt(ent_rec) + "#zoom=100", "Resguardo Entrega", "scrollbards=NO");
});



/********************************************************************
	  CARGAR FORMA DE PAGO EN COMBO
********************************************************************/
function cargar_Select_FormaPAgo_v() {//enviamos al scrpit mantenimiento examen
	$.ajax({
		url: '../controller/cotizacion/controlador_cargar_select_forma_pago.php',
		type: 'POST'
	}).done(function (resp) {
		let data = JSON.parse(resp);//POSICION DE LA FILA Y COLUMNA
		let llenardata = "<option >Seleccione...</option>";
		if (data.length > 0) {
			for (let i = 0; i < data.length; i++) {
				llenardata += "<option value='" + data[i][0] + "'>" + data[i][1] + "</option>";
			}
			document.getElementById('select_forma_pago_V').innerHTML = llenardata;//primero para registrar luego en modificar colocamos el select editar
		} else {
			llenardata += "<option value=''>No se encontraron datos</option>";
			document.getElementById('select_forma_pago_V').innerHTML = llenardata;

		}
	})
}






/********************************************************************
				   REGISTRAR SERVICIO
********************************************************************/
function RegistrarServicio() {
	let idrecepcion = document.getElementById('text_idrecepcion').value;
	let monto = document.getElementById('text_suma_servicio').value;
	let concepto = document.getElementById('text_concepto').value;
	let responsable = document.getElementById('text_responsable').value;
	let comentario = document.getElementById('text_comentario').value;
	//let entrega = document.getElementById('text_entrega').value;
	let cliente = document.getElementById('text_cliente').value;
	let observa = document.getElementById('text_observa').value;
	let modelo = document.getElementById('text_model').value;

	let idformapago = document.getElementById('select_forma_pago_V').value;
	let monto_efectiv = document.getElementById('text_efe').value;
	let cod_opera = document.getElementById('text_tarj').value;
	let monto_tarje = document.getElementById('text_monto_t').value;
	let cajaid_se = document.getElementById('text_idcaja').value;
	let tecnicoid_se = document.getElementById('text_idtecnico').value;
	let estadofinal = "";
	let estado_se = document.getElementById('estado_recep').innerHTML;
	let sucursalid = document.getElementById('text_idsucursa').value;

	if(estado_se == "NO REPARADO") {
		estadofinal = "NO REPARADO";

	} else{
		estadofinal = "ENTREGADO";

	}


	if (comentario.length == 0 || responsable.length == 0 || monto.length == 0 || cliente.length == 0) {
		ValidarCamposServicio("text_comentario", "text_responsable", "text_monto", "text_cliente");
		return Swal.fire("Mensaje de Advertencia", "Tiene campos vacios", "warning");
	}

	if (idformapago == "Seleccione...") {
		return Swal.fire("Mensaje de Advertencia", "Debe seleccionar una forma de pago", "warning");
	}

	if (idformapago == 3) { //tarjeta y efectiv

		//console.log(tipo);

		if (monto_efectiv == "") {
			return Swal.fire("Mensaje de Advertencia", "ingrese el monto en efectivo", "warning");
		}
		if (cod_opera == "") {
			return Swal.fire("Mensaje de Advertencia", "ingrese el codigo de la operacion", "warning");
		}
		if (monto_tarje == "") {
			return Swal.fire("Mensaje de Advertencia", "ingrese el monto de la tarjeta", "warning");
		}

	} else if (idformapago == 2) { //tarjeta

		//console.log(tipo);

		if (cod_opera == "") {
			return Swal.fire("Mensaje de Advertencia", "ingrese el codigo de la operacion", "warning");
		}
		if (monto_tarje == "") {
			return Swal.fire("Mensaje de Advertencia", "ingrese el monto de la tarjeta", "warning");
		}

	} else {
		//console.log("ok");

	}


	$.ajax({
		url: '../controller/servicio/controlador_servicio_registar.php',
		type: 'POST',
		data: {
			idrecepcion: idrecepcion,
			monto: monto,
			concepto: concepto,
			responsable: responsable,
			comentario: comentario,
			observa: observa,
			modelo: modelo,
			idformapago: idformapago,
			monto_efectiv: monto_efectiv,
			cod_opera: cod_opera,
			monto_tarje: monto_tarje,
			cajaid_se: cajaid_se,
			tecnicoid_se:tecnicoid_se,
			estadofinal:estadofinal,
			sucursalid:sucursalid

		}
	}).done(function (resp) {
		//alert(resp);
		if (resp > 0) {
			Swal.fire("Mensaje de Confirmacion", "Servicio Registrados", "success").then((result) => {
				//$('.form-control').removeClass("is-invalid").removeClass("is-valid");//remover las clases
				cargar_Notificaiones_Recepcion();
				if (result.value) {
					$("#contenido_principal").load("servicio/mantenimiento_servicio.php");
				}
			});

		} else {
			return Swal.fire("Mensaje de Error", "No se pudo completar el registro", "error");
		}
	})
}



/********************************************************************
				   VALIDAR CAMPOS 
********************************************************************/
function ValidarCamposServicio(comentario, responsable, monto, cliente) {
	Boolean(document.getElementById(comentario).value.length > 0) ? $("#" + comentario).removeClass("is-invalid").addClass("is-valid") : $("#" + comentario).removeClass("is-valid").addClass("is-invalid");
	Boolean(document.getElementById(responsable).value.length > 0) ? $("#" + responsable).removeClass("is-invalid").addClass("is-valid") : $("#" + responsable).removeClass("is-valid").addClass("is-invalid");
	Boolean(document.getElementById(monto).value.length > 0) ? $("#" + monto).removeClass("is-invalid").addClass("is-valid") : $("#" + monto).removeClass("is-valid").addClass("is-invalid");
	Boolean(document.getElementById(cliente).value.length > 0) ? $("#" + cliente).removeClass("is-invalid").addClass("is-valid") : $("#" + cliente).removeClass("is-valid").addClass("is-invalid");
}



/********************************************************************
				   LIMPIAR TEXBOX
********************************************************************/
function LimpiartxtServicio() {
	document.getElementById('text_idrecepcion').value = "";
	document.getElementById('text_monto').value = "";
	document.getElementById('text_concepto').value = "";
	document.getElementById('text_responsable').value = "";
	document.getElementById('text_comentario').value = "";
	document.getElementById('text_adelanto').value = "";
	document.getElementById('text_pendiente').value = "";

}




/********************************************************************
			   ELIMINAR SERVICIO (MENSAJE)
********************************************************************/
$('#tabla_servicio').on('click', '.CambiarEstado', function () {//campo activar tiene que ir en el boton
	var data = tbl_servicio.row($(this).parents('tr')).data();//tamaño de escritorio
	if (tbl_servicio.row(this).child.isShown()) {
		var data = tbl_servicio.row(this).data();//para celular y usas el responsive datatable
	}
	Swal.fire({
		title: 'Desea Eliminar el Servicio?',
		text: "Retornara el estado de la Recepcion",
		icon: 'warning',
		showCancelButton: true,
		confirmButtonText: 'Si, confirmar'
	}).then((result) => {
		if (result.isConfirmed) {
			Eliminar_Servicio(data.servicio_id, "ELIMINADO");//data[0] (id)
			//console.log(data.rol_id);
		}
	})
});



/********************************************************************
					   ELIMINAR EL SERVICIO 
********************************************************************/
function Eliminar_Servicio(id) {
	$.ajax({
		url: '../controller/servicio/controlador_eliminar_servicio.php',
		type: 'POST',
		data: {
			id: id//le enviamos los campos al controlador


		}
	}).done(function (resp) {
		if (resp > 0) {
			Swal.fire("Mensaje de Confirmacion", "Servicio Eliminado", "success").then((value) => {
				tbl_servicio.ajax.reload();//recargar dataTable
				cargar_Notificaiones_Recepcion();
			});
		} else {
			Swal.fire("Mensaje de Error", "No se puede Eliminar el Servicio", "error");
		}
	})
}


/**********************************************************************
		LISTAR ESTADO DE LA CAJA Y VALIDAR PARA HACER UN SERVICIO
***********************************************************************/

function Traer_estado_caja() {
let sucurid = document.getElementById('text_idsucurs').value;
	$.ajax({
		url: '../controller/caja/controlador_traer_datos_ventas.php',
		type: 'POST',
		data:{
			sucurid: sucurid
		}

	}).done(function (resp) {
		//console.log(resp);
		let data = JSON.parse(resp); //POSICION DE LA FILA Y COLUMNA

		if (data.length > 0 && data[0][5] === 'VIGENTE') {
            // Si hay una caja y su estado es VIGENTE
            document.getElementById('text_estado').innerHTML = data[0][5];
            $('#textnuevoservicio').prop('hidden', false); // Muestra el botón
        } else {
            // Si no hay caja (data.length es 0) o el estado no es VIGENTE
            document.getElementById('text_estado').innerHTML = 'CERRADA';
            Swal.fire("Mensaje de Advertencia", "Debe aperturar una caja para continuar", "warning");
            $('#textnuevoservicio').prop('hidden', true); // Oculta el botón
        }
	})
}


function Traer_caja_id() {
let sucurid = document.getElementById('text_idsucurs').value;
	$.ajax({
		url: '../controller/caja/controlador_traer_datos_ventas.php',
		type: 'POST',
		data:{
			sucurid: sucurid
		}

	}).done(function (resp) {
		//console.log(resp);
		let data = JSON.parse(resp); //POSICION DE LA FILA Y COLUMNA

		if (data.length > 0) {

			document.getElementById('text_idcaja').value = data[0][12];

		}
	})
}




/********************************************************************
		   REGISTRAR DIAGNOSTICO
********************************************************************/
function registrar_monto_equipo(){
       
	let id_equi_r= document.getElementById('idequipo').value;	
	let monto_equi = document.getElementById('text_monto_e').value;
	let abono_equi = document.getElementById('text_abono_e').value;
	let receid_equi = document.getElementById('idrece_e').value;
   
    if (monto_equi == "") {
        return Swal.fire("Debe ingresar un monto","Colocar 0 si no llevara monto","warning");
    }

	if (abono_equi == "") {
        return Swal.fire("Debe ingresar un abono","Colocar 0 si no llevara abono","warning");
    }

	$.ajax({
		 url:'../controller/servicio/controlador_cambiar_monto_equipos.php',
		 type: 'POST',
		 data:{
			id_equi_r:id_equi_r,
			monto_equi:monto_equi,
			abono_equi:abono_equi,
			receid_equi:receid_equi
	   
		 }
	 }).done(function(resp){
		 if (resp>0) {
			
			Swal.fire("Mensaje de Confirmacion", "Se modifico de manera correcta", "success").then((value) => {
				$("#modal_cambiar_monto").modal('hide');//ocultamos el modal
				recalculo_montos();
				document.getElementById('text_monto_e').value = "";
				document.getElementById('text_abono_e').value = "";
				tbl_ver_detalle_recep.ajax.reload();//recargar dataTable

			});


		 }else{
			 return Swal.fire("Mensaje de Error","No se pudo modificar","error");
		 }
	 })	
}

//tener en cuenta que no trae datos si una caja no esta abierta
function Traer_url_sistema() {
let sucurid = document.getElementById('text_idsucurs').value;
console.log(sucurid);
	$.ajax({
		url: '../controller/caja/controlador_traer_datos_ventas.php',
		type: 'POST',
		data:{
			sucurid: sucurid
		}

	}).done(function (resp) {
		//console.log(resp);
		let data = JSON.parse(resp); //POSICION DE LA FILA Y COLUMNA
		//console.log(data[0][13]);
			//document.getElementById('text_numerocel').value = data.cliente_celular;
			document.getElementById('text_url_sistema').value = data[0][13];
			document.getElementById('text_cod_pais').value = data[0][14];

	})
}




/**********************************************************************
		LISTAR ESTADO DE LA CAJA Y VALIDAR PARA HACER UNA RECEPCION
***********************************************************************/

function recalculo_montos() {
	let idrece_calculo = document.getElementById('text_idrecepcion').value;

	$.ajax({
		url: '../controller/recepcion/controlador_traer_montos_recepcion.php',
		type: 'POST',
		data: {
			idrece_calculo: idrece_calculo,
			
		}

	}).done(function (resp) {
		//console.log("1",resp);
		let data = JSON.parse(resp); //POSICION DE LA FILA Y COLUMNA
		
			//console.log("suma de servicios",data);
			//enviamos el estado de la caja al label
			document.getElementById('text_monto').value = data[0][0];
			document.getElementById('text_adelanto').value = data[0][1];
			document.getElementById('text_pendiente').value = data[0][2];
			document.getElementById('text_suma_servicio').value = data[0][4];
			document.getElementById('text_suma_servicio2').value = data[0][4];

			


	})
}





