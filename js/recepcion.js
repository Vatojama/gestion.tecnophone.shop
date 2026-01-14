/********************************************************************
		   LISTAR RECEPCION CON SERVERSIDE (MUCHOS DATOS)
********************************************************************/



var tbl_recepcion;
function Listar_Recepcion() {
	var finicio = document.getElementById('text_finicio').value;
	var ffin = document.getElementById('text_ffin').value;
	var idusuario_filtro = document.getElementById('text_Idprincipal').value;
	let sucurid = document.getElementById('text_idsucurs').value;
	let rolid = document.getElementById('text_idrol').value;
	

	tbl_recepcion = $("#tabla_recepcion").DataTable({		
	   "responsive" :true,
	   "ordering" :false,
	   "bLengthChange" : true,
	   "searching" : {"regex" : false},
	   "lengthMenu" : [[10, 25, 50, 100, -1],[10, 25, 50, 100, "All"]],
	   "pageLength" : 10,
	   "destroy" :true,
	   "async" : false,
	   "bprocessing": true,
	   "dom": 'Blfrtip',
	   "buttons":[
		   {
			  "extend":    'excelHtml5',
			  "text":      '<i class="fa fa-file-excel"></i>',
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
	   "ajax" : {
		   "url": "../controller/recepcion/controlador_recepcion_listar.php",
		   type: 'POST',
		   data:{
			   finicio:finicio,
			   ffin:ffin,
			   idusuario_filtro: idusuario_filtro,
			   sucurid:sucurid,
			   rolid:rolid
		   }

	   },
	   "columns":[
	   //todos los datos del procedimiento almacenado
	  // {"defaultContent": ""},//cintador 
	   {"data": "referencia"},
	   {"data": "rece_cod"},
	   {"data": "cliente_nombres"},
	   {"data": "motivo"},
	   {"data": "motivo_descripcion"},
	   {"data": "rece_monto"},
	   {"data": "rece_adelanto"},
	   {"data": "rece_debe"},
	   {"data": "rece_fregistro"},
	   {"data": "rece_estado",
			render: function (data, type, row) {
				if (data == "EN REPARACION") {
					return "<center>" + '<span class="badge badge-info">EN REPARACION</span>'; +"</center>"
				} else if (data == "REPARADO") {
					return "<center>" + '<span class="badge badge-success">REPARADO</span>'; +"</center>"
				} else if (data == "NO REPARADO") {
					return "<center>" + '<span class="badge badge-danger">NO REPARADO</span>'; +"</center>"
				} else {
					return "<center>" + '<span class="badge badge-warning">ENTREGADO</span>'; +"</center>"
				}
			}
	}, //10
	 {"data": "nombre_su"},
	   {"data": "rece_estatus", //11
		   
		   render: function (data, type, row) {
			if (data === "ACTIVO") {
				return "<center>" + '<span class="badge badge-success">ACTIVO</span>'; +"</center>"
			} else {
				return "<center>" + '<span class="badge badge-danger">INACTIVO</span>'; +"</center>"
			}
		}
	   },
	   {
		"data": "rece_estado",//editar
		render: function (data, type, row) {
			let foto_icon = "";
			if(row.rece_foto2 && row.rece_foto2 != ""){
				foto_icon = " <span class='ver_foto_test text-secondary px-1' style='cursor:pointer;' title='Ver Foto del Test'><i class='fas fa-image'></i></span>";
			}

			if (data === "EN REPARACION" || data == "REPARADO" || data == "NO REPARADO") {
				return "<center>" + "<span class='editar text-primary px-1' style='cursor:pointer;' title='Editar datos' ><i class= 'fa fa-edit'></i></span> <span class='imprimir text-danger px-1' style='cursor:pointer;' title='Imprimir Comprobante'><i class= 'fa fa-print'></i></span> <span class=' test_re text-info px-1' style='cursor:pointer;'  title='Test del equipo' ><i class= 'fas fa-vial'></i></span><span class=' firma_cliente text-success px-1' style='cursor:pointer;'  title='firma del cliente' ><i class= 'fas fa-file'></i></span>" + foto_icon + "</center>"
			} else {
				return "<center>" + "<span class='ver_recep text-info px-1' style='cursor:pointer;' title='Ver datos'><i class= 'fa fa-eye'></i></span><span class=' imprimir text-danger px-1' style='cursor:pointer;'  title='Imprimir Comprobante' ><i class= 'fa fa-print'></i></span><span class=' text-secundary px-1'   ><i class= 'fas fa-vial'></i></span><span class=' firma_cliente text-success px-1' style='cursor:pointer;'  title='firma del cliente' ><i class= 'fas fa-file'></i></span>" + foto_icon + "</center>"
			}

		}
	},
	  
	   //{"defaultContent": "<center>"+"<span class='CambiarEstado text-danger px-1' style='cursor:pointer;' title='Eliminar Servicio' ><i class= 'fa fa-trash'></i></span><span class='imprimir text-success px-1' style='cursor:pointer;' title='Imprimir Comprobante'><i class= 'fa fa-print'></i></span>"+"</center>"}


	   ],
	   "language":idioma_espanol,
	   select:true
   });
   //contador en cada tabla
//    tbl_servicio.on('draw.td',function(){
// 	   var PageInfo = $("#tabla_servicio").DataTable().page.info();
// 	   tbl_servicio.column(0,{page: 'current'}).nodes().each(function(cell,i){
// 		   cell.innerHTML = i + 1 + PageInfo.start;
// 	   });
//    });
}	


var tbl_recepcion;
function Listar_Recepcion_Admin() {
	var finicio = document.getElementById('text_finicio').value;
	var ffin = document.getElementById('text_ffin').value;
	
	tbl_recepcion = $("#tabla_recepcion").DataTable({		
	   "responsive" :true,
	   "ordering" :false,
	   "bLengthChange" : true,
	   "searching" : {"regex" : false},
	   "lengthMenu" : [[10, 25, 50, 100, -1],[10, 25, 50, 100, "All"]],
	   "pageLength" : 10,
	   "destroy" :true,
	   "async" : false,
	   "bprocessing": true,
	   "dom": 'Blfrtip',
	   "buttons":[
		   {
			  "extend":    'excelHtml5',
			  "text":      '<i class="fa fa-file-excel"></i>',
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
	   "ajax" : {
		   "url": "../controller/recepcion/controlador_recepcion_listar_admin.php",
		   type: 'POST',
		   data:{
			   finicio:finicio,
			   ffin:ffin
		   }

	   },
	   "columns":[
	   //todos los datos del procedimiento almacenado
	  // {"defaultContent": ""},//cintador 
	   {"data": "referencia"},
	   {"data": "rece_cod"},
	   {"data": "cliente_nombres"},
	   {"data": "motivo"},
	   {"data": "motivo_descripcion"},
	   {"data": "rece_monto"},
	   {"data": "rece_adelanto"},
	   {"data": "rece_debe"},
	   {"data": "rece_fregistro"},
	   {"data": "rece_estado",
			render: function (data, type, row) {
				if (data == "EN REPARACION") {
					return "<center>" + '<span class="badge badge-info">EN REPARACION</span>'; +"</center>"
				} else if (data == "REPARADO") {
					return "<center>" + '<span class="badge badge-success">REPARADO</span>'; +"</center>"
				} else if (data == "NO REPARADO") {
					return "<center>" + '<span class="badge badge-danger">NO REPARADO</span>'; +"</center>"
				} else {
					return "<center>" + '<span class="badge badge-warning">ENTREGADO</span>'; +"</center>"
				}
			}
	}, //10
	   {"data": "rece_estatus", //11
		   
		   render: function (data, type, row) {
			if (data === "ACTIVO") {
				return "<center>" + '<span class="badge badge-success">ACTIVO</span>'; +"</center>"
			} else {
				return "<center>" + '<span class="badge badge-danger">INACTIVO</span>'; +"</center>"
			}
		}
	   },
	   {
		"data": "rece_estado",//editar
		render: function (data, type, row) {
			let foto_icon = "";
			if(row.rece_foto2 && row.rece_foto2 != ""){
				foto_icon = " <span class='ver_foto_test text-secondary px-1' style='cursor:pointer;' title='Ver Foto del Test'><i class='fas fa-image'></i></span>";
			}

			if (data === "EN REPARACION" || data == "REPARADO" || data == "NO REPARADO") {
				return "<center>" + "<span class='editar text-primary px-1' style='cursor:pointer;' title='Editar datos' ><i class= 'fa fa-edit'></i></span> <span class='imprimir text-danger px-1' style='cursor:pointer;' title='Imprimir Comprobante'><i class= 'fa fa-print'></i></span> <span class=' test_re text-info px-1' style='cursor:pointer;'  title='Test del equipo' ><i class= 'fas fa-vial'></i></span>" + foto_icon + "</center>"
			} else {
				return "<center>" + "<span class='ver_recep text-info px-1' style='cursor:pointer;' title='Ver datos'><i class= 'fa fa-eye'></i></span><span class=' imprimir text-danger px-1' style='cursor:pointer;'  title='Imprimir Comprobante' ><i class= 'fa fa-print'></i></span><span class=' text-secundary px-1'   ><i class= 'fas fa-vial'></i></span>" + foto_icon + "</center>"
			}


		}
	},
	  
	   //{"defaultContent": "<center>"+"<span class='CambiarEstado text-danger px-1' style='cursor:pointer;' title='Eliminar Servicio' ><i class= 'fa fa-trash'></i></span><span class='imprimir text-success px-1' style='cursor:pointer;' title='Imprimir Comprobante'><i class= 'fa fa-print'></i></span>"+"</center>"}


	   ],
	   "language":idioma_espanol,
	   select:true
   });
   //contador en cada tabla
//    tbl_servicio.on('draw.td',function(){
// 	   var PageInfo = $("#tabla_servicio").DataTable().page.info();
// 	   tbl_servicio.column(0,{page: 'current'}).nodes().each(function(cell,i){
// 		   cell.innerHTML = i + 1 + PageInfo.start;
// 	   });
//    });
}

//var tbl_recepcion;
function Listar_Recepcion2() {
	var idusuario_filtro = document.getElementById('text_Idprincipal').value;
	console.log(idusuario_filtro);
	tbl_recepcion = $("#tabla_recepcion").DataTable({
		"responsive": true,
		"pageLength": 10,
		"destroy": true,
		"searching": true,
		"processing": true,
        "serverSide": true,
		"dom": 'Blfrtip',
		"buttons": [
			{
				"extend": 'excelHtml5',
				"text": '<i class="fa fa-file-excel"></i>',
				"titleAttr": 'Exportar a Excel'
			},
			

		],
		"bDeferRender": true,
		//"bServerSide": true,
		//"sAjaxSource": "../controller/recepcion/serverside/serversideRecepcion.php",
		"ajax": {
			"url": "../controller/recepcion/serverside/serversideRecepcion.php",
			"type": "POST",
			"data": {
				"idusuario_filtro": idusuario_filtro,
				// ... otros parámetros si es necesario ...
			}
		},
		"columns": [

			{ "data": 1 },//id
			{ "data": 3 },//cliente
			{ "data": 4 },//concepto
			{ "data": 7 },//motivo
			{ "data": 8 },//monto
			{ "data": 9 },//fecha
			

			{
				"data": 10,//estatus
				render: function (data, type, row) {
					if (data == "EN REPARACION") {
						return "<center>" + '<span class="badge badge-info">EN REPARACION</span>'; +"</center>"
					} else if (data == "REPARADO") {
						return "<center>" + '<span class="badge badge-success">EN REPARACION</span>'; +"</center>"
					} else if (data == "NO REPARADO") {
						return "<center>" + '<span class="badge badge-danger">EN REPARACION</span>'; +"</center>"
					} else {
						return "<center>" + '<span class="badge badge-warning">ENTREGADO</span>'; +"</center>"
					}
				}
			},
			{
				"data": 11,//estatus
				render: function (data, type, row) {
					if (data === "ACTIVO") {
						return "<center>" + '<span class="badge badge-success">ACTIVO</span>'; +"</center>"
					} else {
						return "<center>" + '<span class="badge badge-danger">INACTIVO</span>'; +"</center>"
					}
				}
			},
			{
				"data": 10,//editar
				render: function (data, type, row) {
					if (data === "EN REPARACION" || data == "REPARADO") {
						return "<center>" + "<span class='editar text-primary px-1' style='cursor:pointer;' title='Editar datos' ><i class= 'fa fa-edit'></i></span> <span class='imprimir text-danger px-1' style='cursor:pointer;' title='Imprimir Comprobante'><i class= 'fa fa-print'></i></span> <span class=' test_re text-info px-1' style='cursor:pointer;'  title='Test del equipo' ><i class= 'fas fa-vial'></i></span>" + "</center>"
					} else {
						return "<center>" + "<span class='text-secondary px-1' style='cursor:pointer;' disabled=''><i class= 'fa fa-edit'></i></span><span class=' imprimir text-danger px-1' style='cursor:pointer;'  title='Imprimir Comprobante' ><i class= 'fa fa-print'></i></span><span class=' text-secundary px-1'   ><i class= 'fas fa-vial'></i></span>" + "</center>"
					}


				}
			},

		],
		"language": idioma_espanol,
		select: true
	});

}


var tbl_ver_detalle_equi;
function Ver_detalle_equi(idrec) {//enviarlo al scrip en MANTENIMIENTO ROL
	tbl_ver_detalle_equi = $("#tabla_det_pro_edit").DataTable({
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
			{ "data": "serie" },
			{ "data": "falla" },
			{ "data": "monto" },
			{ "data": "abono" },
			{"defaultContent": "<center>"+"<span class='eliminar_det_e text-danger px-1' style='cursor:pointer;' data-bs-toggle='tooltip' data-bs-placement='top' title='eliminar'><i class= 'fa fa-trash'></i></span> <span class='imprimi_recibo_reparacion text-info px-1' style='cursor:pointer;' data-bs-toggle='tooltip' data-bs-placement='top' title='imprimir ticket reparacion'><i class= 'fa fa-print'></i></span> "+"</center>"}


		],
		"language": idioma_espanol,
		select: true
	});

}


var tbl_ver_insumos_repara;
function Ver_detalle_insumos_repara(idrec) {//enviarlo al scrip en MANTENIMIENTO ROL
	tbl_ver_insumos_repara = $("#tabla_insumos_recep_e").DataTable({
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
        
			
			{"defaultContent": "<center>"+"<span class='elimar_ins text-danger px-2' style='cursor:pointer;' data-bs-toggle='tooltip' data-bs-placement='top' title='Quitar insumo'><i class= 'fa fa-trash-alt'></i></span> "+"</center>"}


		],
		"language": idioma_espanol,
		select: true
	});

}

/********************************************************************
		   ELIMINAR UN INSUMO DEL DETALLE YA REGISTRADO
********************************************************************/
$('#tabla_insumos_recep_e').on('click', '.elimar_ins', function () {
    let idusu_ins = document.getElementById('text_Idprincipal').value;
	var data = tbl_ver_insumos_repara.row($(this).parents('tr')).data();
	if (tbl_ver_insumos_repara.row(this).child.isShown()) {
		var data = tbl_ver_insumos_repara.row(this).data();

	}
    //console.log(data);

    idinsumo_dele = data.id_insumo;
    canti_dele = data.cantidad;
    produc_dele = data.producto_id;
    idrece_dele = data.rece_id;
    //console.log(idinsumo_dele, ' ', canti_dele, ' ',idrece_dele);
   
    
    Swal.fire({
		title: 'Desea Eliminar el articulo de la reparacion?' ,
		text: "Ya no se podra deshacer el cambio",
		icon: 'warning',
		showCancelButton: true,
		confirmButtonText: 'Eliminar'
	}).then((result) => {

		if (result.isConfirmed) {

			$.ajax({
                url:'../controller/recepcion/controlador_eliminar_insumo_reparacion.php',
                type: 'POST',
                data:{
                    idinsumo_dele:idinsumo_dele,
                    canti_dele:canti_dele,
                    produc_dele:produc_dele,
                    idrece_dele: idrece_dele,
                    idusu_ins:idusu_ins
              
                }
            }).done(function(resp){
                if (resp>0) {
                   //limpiar_modal_diagnostico();
                   Swal.fire("Mensaje de Confirmacion", "Articulo quitado correctamente", "success").then((value) => {
                       //$("#modal_detalle_recepcion").modal('hide');//ocultamos el modal
                       tbl_ver_insumos_repara.ajax.reload();//recargar dataTable
					   recalculo_montos();
                   });
       
       
                }else{
                    return Swal.fire("Mensaje de Error","No se pudo quitar el articulo","error");
                }
            })	
			
			


		} else {

			//console.log("Error al Eliminar el imei");
		}

	})

   

   
    
});



$('#tabla_det_pro_edit').on('click', '.imprimi_recibo_reparacion', function () {//class EDITAR tiene que ir en el boton
	var data = tbl_ver_detalle_equi.row($(this).parents('tr')).data();//tama単o de escritorio
	if (tbl_ver_detalle_equi.row(this).child.isShown()) {
		var data = tbl_ver_detalle_equi.row(this).data();//para celular y usas el responsive datatable
	}

	window.open("../MPDF/reporte_etiqueta.php?codigo=" + data.id_equipo + "#zoom=100", "Ticket de Recepcion", "scrollbards=NO");
	
	//console.log(data);

	
});

/********************************************************************
		   ELIMINAR IMEI DEL DETALLE DEL PRODUCTO
********************************************************************/
$('#tabla_det_pro_edit').on('click', '.eliminar_det_e', function () {//campo activar tiene que ir en el boton
	var data = tbl_ver_detalle_equi.row($(this).parents('tr')).data();//tamaño de escritorio
	if (tbl_ver_detalle_equi.row(this).child.isShown()) {
		var data = tbl_ver_detalle_equi.row(this).data();//para celular y usas el responsive datatable

	}
	id_eq_rec = data.id_equipo;
	//id_prd = document.getElementById('idproducto').value;
	//console.log(data);


	Swal.fire({
		title: 'Desea Eliminar el Equipo con serie: ' + data.serie,
		text: "Ya no se podra deshacer el cambio",
		icon: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: 'Eliminar Equipo'
	}).then((result) => {

		if (result.isConfirmed) {
			Eliminar_equipo(id_eq_rec);//data 0 (id)
			
			//console.log(" Eliminar el imei");



		} else {

			//console.log("Error al Eliminar el imei");
		}

	})
});


/********************************************************************
		 ELIMINAR ITEM DEL DETALLE DE LA RECEPCION - EQUIPO
********************************************************************/
function Eliminar_equipo(id_eq) {
	$.ajax({
		url: '../controller/recepcion/controlador_eliminar_equipo.php',
		type: 'POST',
		data: {
			id_eq: id_eq

		}
	}).done(function (resp) {
		if (resp > 0) {
			Swal.fire("Mensaje de Confirmacion", "Equipo Eliminado", "success").then((value) => {
				tbl_ver_detalle_equi.ajax.reload();//recargar dataTable
				recalculo_montos();
				//TraerNotificaciones();
			});
		} else {
			Swal.fire("Mensaje de Error", "No se puede Eliminar el Equipo", "error");
		}
	})
}


/********************************************************************
        INSERTAR EQUIPOS AL MODIFICAR RECEPCION - EDITAR
********************************************************************/
function RegistrarEqui_directo_recep() {
	let idrp = document.getElementById('idrecepcion').value;
    let equipo_e = document.getElementById('text_equi2_e').value;
	let serie_e = document.getElementById('text_serie2_e').value;
	let falla_e = document.getElementById('text_falla_equip').value;
	let monto_e = document.getElementById('text_monto2_e').value;
	let adelanto_e = document.getElementById('text_pendite2_e').value;


    if (equipo_e.length == 0) {
		return Swal.fire("Mensaje de Advertencia", "Ingrese nombre del equipo", "warning");
	}
	if (serie_e.length == 0) {
		return Swal.fire("Mensaje de Advertencia", "Ingrese una serie o Imei del equipo", "warning");
	}
	if (monto_e.length == 0) {
		return Swal.fire("Mensaje de Advertencia", "Ingrese un Monto", "warning");
	}
	if (falla_e.length == 0) {
		return Swal.fire("Mensaje de Advertencia", "Ingrese una falla del equipos", "warning");
	}

	if (parseInt(monto_e) < 1) {
		return Swal.fire("Mensaje de Advertencia", "El Monto debe ser mayor a 0", "warning");
	}

	//llamamos la funcion para verificar si ya esta agregado en el detalle
	if (verificarid(serie_e)) {
		return Swal.fire("Mensaje de Advertencia", "La serie ya esta agregada", "warning");
	}




    $.ajax({
        url: '../controller/recepcion/controlador_insertar_equipo_directo_recep.php',
        type: 'POST',
        data: {
            idrp: idrp,//le enviamos los campos al controlador
            equipo_e: equipo_e,
            serie_e:serie_e,
			monto_e:monto_e,
			adelanto_e:adelanto_e,
			falla_e: falla_e

        }
    }).done(function (resp) {
        if (resp > 0) {
            if (resp == 1) {//validamos la respuesta del procedure si retorna 1 o 2
                Swal.fire("Mensaje de Confirmacion", "Equipo Insertado", "success").then((value) => {
					document.getElementById('text_equi2_e').value = "";
					document.getElementById('text_serie2_e').value = "";
					document.getElementById('text_monto2_e').value = "0";
					document.getElementById('text_pendite2_e').value = "0";
					document.getElementById('text_falla_equip').value = "";

                    tbl_ver_detalle_equi.ajax.reload();//recargar dataTable
					recalculo_montos();
                });
            } else {
                Swal.fire("Mensaje de Advertencia", "La serie  ya se encuentra registrado", "warning");
            }

        } else {
            Swal.fire("Mensaje de Error", "No se puede Insertar el Equipo", "error");
        }
    })
}







/********************************************************************
	   ABRIR MODAL EDITAR RECEPCION
********************************************************************/
$('#tabla_recepcion').on('click', '.editar', function () {//class EDITAR tiene que ir en el boton
	var data = tbl_recepcion.row($(this).parents('tr')).data();//tama単o de escritorio
	if (tbl_recepcion.row(this).child.isShown()) {
		var data = tbl_recepcion.row(this).data();//para celular y usas el responsive datatable
	}

	rolA = document.getElementById('text_idrol').value;
	
	console.log(data);
	$("#modal_editar_recepcion").modal({ backdrop: 'static', keyboard: false });
	$("#modal_editar_recepcion").modal('show');//abrimos el modal

	if (rolA == 1) {
	document.getElementById('idrecepcion').value = data.rece_id;

	document.getElementById('text_caracteristicas_editar').value = data.rece_caracteristicas;
	document.getElementById('text_concepto_editar').value = data.rece_concepto;
	document.getElementById('text_monto_editar').value = data.rece_monto;
	document.getElementById('text_adelanto_editar').value = data.rece_adelanto;
	document.getElementById('text_debe_editar').value = data.rece_debe;
	$("#select_cliente_editar").select2().val(data.cliente_id).trigger('change.select2');
	$("#select_motivo_editar").select2().val(data.motivo_id).trigger('change.select2');
	$("#select_entrega_editar").select2().val(data.rece_estado).trigger('change.select2');
	$("#select_estado_recepcion_editar").select2().val(data.rece_estatus).trigger('change.select2');
	$('#select_estado_recepcion_editar').prop('disabled', false);
	document.getElementById('text_fentrega_editar').value = data.rece_fentrega;
	document.getElementById('text_accesorios_editar').value = data.rece_accesorios;
	$("#select_marca_editar").select2().val(data.marca_id).trigger('change.select2');
	$("#select_recoger_recepcion_editar").select2().val(data.rece_estado).trigger('change.select2');
	$('#select_recoger_recepcion_editar').prop('disabled', false);
	document.getElementById('text_codigo_r_editar').value = data.rece_cod;
	document.getElementById('text_movil_editar').value = data.cliente_celular;
	$("#select_tecnic_editar").select2().val(data.tecnico).trigger('change.select2');
	$('#select_tecnic_editar').prop('disabled', false);
	$("#select_sucursal_editar").select2().val(data.id_sucu).trigger('change.select2');
	$('#select_sucursal_editar').prop('disabled', false);
	document.getElementById('img-preview').src = "../" + data.rece_foto1;
	// document.getElementById('img-text_foto_e').value = data.rece_foto1;
	// Ver_detalle_equi(data.rece_id);
	// Ver_detalle_insumos_repara(data.rece_id)
	// recalculo_montos();
} else { 

	document.getElementById('idrecepcion').value = data.rece_id;

	document.getElementById('text_caracteristicas_editar').value = data.rece_caracteristicas;
	document.getElementById('text_concepto_editar').value = data.rece_concepto;
	document.getElementById('text_monto_editar').value = data.rece_monto;
	document.getElementById('text_adelanto_editar').value = data.rece_adelanto;
	document.getElementById('text_debe_editar').value = data.rece_debe;
	$("#select_cliente_editar").select2().val(data.cliente_id).trigger('change.select2');
	$("#select_motivo_editar").select2().val(data.motivo_id).trigger('change.select2');
	$("#select_entrega_editar").select2().val(data.rece_estado).trigger('change.select2');
	$("#select_estado_recepcion_editar").select2().val(data.rece_estatus).trigger('change.select2');
	$('#select_estado_recepcion_editar').prop('disabled', true);

	document.getElementById('text_fentrega_editar').value = data.rece_fentrega;
	document.getElementById('text_accesorios_editar').value = data.rece_accesorios;
	$("#select_marca_editar").select2().val(data.marca_id).trigger('change.select2');
	$("#select_recoger_recepcion_editar").select2().val(data.rece_estado).trigger('change.select2');
	$('#select_recoger_recepcion_editar').prop('disabled', true);

	document.getElementById('text_codigo_r_editar').value = data.rece_cod;
	document.getElementById('text_movil_editar').value = data.cliente_celular;
	$("#select_tecnic_editar").select2().val(data.tecnico).trigger('change.select2');
	$('#select_tecnic_editar').prop('disabled', true);
	
	$("#select_sucursal_editar").select2().val(data.id_sucu).trigger('change.select2');
	$('#select_sucursal_editar').prop('disabled', true);

	document.getElementById('img-preview').src = "../" + data.rece_foto1;
	// document.getElementById('img-text_foto_e').value = data.rece_foto1;
	


}
Ver_detalle_equi(data.rece_id);
	Ver_detalle_insumos_repara(data.rece_id)
	recalculo_montos();
	//console.log(data[1]);//para enviar el dato  en console
});


/********************************************************************
	   ABRIR MODAL VER DETALLES DE LA RECEPCION
********************************************************************/
$('#tabla_recepcion').on('click', '.ver_recep', function () {//class EDITAR tiene que ir en el boton
	var data = tbl_recepcion.row($(this).parents('tr')).data();//tama単o de escritorio
	if (tbl_recepcion.row(this).child.isShown()) {
		var data = tbl_recepcion.row(this).data();//para celular y usas el responsive datatable
	}
	
	//console.log(data);
	$("#modal_ver_recepcion").modal({ backdrop: 'static', keyboard: false });
	$("#modal_ver_recepcion").modal('show');//abrimos el modal

	 document.getElementById('idrecepcion_ver').value = data.rece_id;

	
	document.getElementById('text_concepto_ver').value = data.rece_concepto;
	document.getElementById('text_monto_ver').value = data.rece_monto;
	document.getElementById('text_adelanto_ver').value = data.rece_adelanto;
	document.getElementById('text_debe_ver').value = data.rece_debe;
	document.getElementById('select_cliente_ver').value = data.cliente_nombres;
	document.getElementById('select_motivo_ver').value = data.motivo_descripcion;
	document.getElementById('select_tecnic_ver').value = data.usu_nombre;
	document.getElementById('select_recoger_recepcion_ver').value = data.rece_estado;
	document.getElementById('select_estado_recepcion_ver').value = data.rece_estatus;
	
	
	
	$("#select_entrega_ver").select2().val(data.rece_estado).trigger('change.select2');
	
	document.getElementById('text_fentrega_ver').value = data.rece_fentrega;
	document.getElementById('text_accesorios_ver').value = data.rece_accesorios;
	
	
	document.getElementById('text_codigo_r_ver').value = data.rece_cod;
	document.getElementById('text_movil_ver').value = data.cliente_celular;
	
	
	Ver_detalle_recep(data.rece_id);
	Ver_insumos(data.rece_id);
	monto_final_recepmasservicio();
	

	//console.log(data[1]);//para enviar el dato  en console
});

/********************************************************************
	   ABRIR MODAL REGISTRO DE FIRMA DEL CLIENTE
********************************************************************/
$('#tabla_recepcion').on('click', '.firma_cliente', function () {//class EDITAR tiene que ir en el boton
	var data = tbl_recepcion.row($(this).parents('tr')).data();//tama単o de escritorio
	if (tbl_recepcion.row(this).child.isShown()) {
		var data = tbl_recepcion.row(this).data();//para celular y usas el responsive datatable
	}
	
	//console.log(data);
	$("#modal_firma").modal({ backdrop: 'static', keyboard: false });
	$("#modal_firma").modal('show');//abrimos el modal

	 document.getElementById('text_idrece_firma').value = data.rece_id;

	
	
	

	//console.log(data[1]);//para enviar el dato  en console
});









/********************************************************************
	  CARGAR CLIENTES EN COMBO
********************************************************************/
function cargar_SelectCliente() {//enviamos al scrpit mantenimiento examen
	let sucurid = document.getElementById('text_idsucurs').value;
	$.ajax({
		url: '../controller/recepcion/controlador_cargar_select_cliente.php',
		type: 'POST',
		data: {
				sucurid: sucurid	
			}
	}).done(function (resp) {
		let data = JSON.parse(resp);//POSICION DE LA FILA Y COLUMNA
		let llenardata = "<option value=''>Seleccione</option>";
		if (data.length > 0) {
				for (let i = 0; i < data.length; i++) {
                // AQUÍ ESTÁ LA MAGIA: Añadimos los atributos data-*
                llenardata += "<option value='" + data[i][0] + "' " +
                              "data-estado='" + data[i][2] + "' " +
                              "data-listanegra='" + data[i][3] + "'>" +
                              data[i][1] +
                              "</option>";
            }
			
			document.getElementById('select_cliente').innerHTML = llenardata;//primero para registrar luego en modificar colocamos el select editar
			document.getElementById('select_cliente_editar').innerHTML = llenardata;
		} else {
			llenardata += "<option value=''>No se encontraron datos</option>";
			document.getElementById('select_cliente').innerHTML = llenardata;
			document.getElementById('select_cliente_editar').innerHTML = llenardata;

		}
	})
}

/********************************************************************
	  CARGAR CLIENTES EN COMBO
********************************************************************/
function cargar_SelectTecnico() {//enviamos al scrpit mantenimiento examen
	$.ajax({
		url: '../controller/recepcion/controlador_cargar_select_tecnicos.php',
		type: 'POST'
	}).done(function (resp) {
		let data = JSON.parse(resp);//POSICION DE LA FILA Y COLUMNA
		let llenardata = "<option value=''>Seleccione</option>";
		if (data.length > 0) {
			for (let i = 0; i < data.length; i++) {
				llenardata += "<option value='" + data[i][0] + "'>" + data[i][1] + "</option>";
			}
			document.getElementById('select_tecnic').innerHTML = llenardata;//primero para registrar luego en modificar colocamos el select editar
			document.getElementById('select_tecnic_editar').innerHTML = llenardata;
		} else {
			llenardata += "<option value=''>No se encontraron datos</option>";
			document.getElementById('select_tecnic').innerHTML = llenardata;
			document.getElementById('select_tecnic_editar').innerHTML = llenardata;

		}
	})
}








/********************************************************************
	   CARGAR MOTIVOS EN COMBO
 ********************************************************************/
function cargar_SelectMotivo() {//enviamos al scrpit mantenimiento examen
	$.ajax({
		url: '../controller/recepcion/controlador_cargar_select_motivo.php',
		type: 'POST'
	}).done(function (resp) {
		let data = JSON.parse(resp);//POSICION DE LA FILA Y COLUMNA
		let llenardata = "<option value=''>Seleccione</option>";
		if (data.length > 0) {
			for (let i = 0; i < data.length; i++) {
				llenardata += "<option value='" + data[i][0] + "'>" + data[i][1] + "</option>";
			}
			document.getElementById('select_motivo').innerHTML = llenardata;//primero para registrar luego en modificar colocamos el select editar
			document.getElementById('select_motivo_editar').innerHTML = llenardata;
		} else {
			llenardata += "<option value=''>No se encontraron datos</option>";
			document.getElementById('select_motivo').innerHTML = llenardata;
			document.getElementById('select_motivo_editar').innerHTML = llenardata;

		}
	})
}





/********************************************************************
	  CARGAR MARCAS EN COMBO
********************************************************************/
function cargar_SelectMarca() {//enviamos al scrpit mantenimiento examen
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
	  ABRIR MODAL REGISTRO DE RECEPCIONES
 ********************************************************************/
function AbrirModalRegistroRecepcion() {//se jala en el boton nuevo
	//para que no se nos salga del modal haciendo click a los costados
	
	$("#modal_registro_recepcion").modal({ backdrop: 'static', keyboard: false });
	$("#modal_registro_recepcion").modal('show');//abrimos el modal
	//document.getElementById('text_producto').value="";
	LimpiarModalRecepcion();//limpiar texbox cada que demos en nuevo
	$('.form-control').removeClass("is-invalid").removeClass("is-valid");//remover las clases
	codigo_barr();
	limpiarTabla_regiInsumos();
	limpiarTabla_regiEquipo();
}


function codigo_barr() {
	let codigocelrecep="";
    let f = new Date();
    //nombrefoto="PROD"
    codigocelrecep=f.getDate()+""+(f.getMonth()+1)+""+f.getFullYear()+""+f.getHours()+""+f.getMilliseconds();

    var codeb =  Date.now();
    var c = document.getElementById('text_codigo_r');
    c.value = codigocelrecep;

}






/********************************************************************
		ABRIR MODAL REGISTRO DE CLINTES
********************************************************************/
function AbrirModalRegistroCliente() {
	//para que no se nos salga del modal haciendo click a los costados
	$("#modal_registro_cliente").modal({ backdrop: 'static', keyboard: false });
	$("#modal_registro_cliente").modal('show');//abrimos el modal
	//document.getElementById('text_categoria').value="";
	//LimpiarModalCliente();//limpiar texbox cada que demos en nuevo
	$('.form-control').removeClass("is-invalid").removeClass("is-valid");//remover las clases
}




/********************************************************************
		IMPRIMIR COMPROBANTE
********************************************************************/
$('#tabla_recepcion').on('click', '.imprimir', function () {//class foto tiene que ir en el boton
	var data = tbl_recepcion.row($(this).parents('tr')).data();//tama単o de escritorio
	if (tbl_recepcion.row(this).child.isShown()) {
		var data = tbl_recepcion.row(this).data();//para celular y usas el responsive datatable
	}
	//console.log(data);

	$("#modal_impresion").modal({ backdrop: 'static', keyboard: false });
	$("#modal_impresion").modal('show');//abrimos el modal
	document.getElementById('text_idrece_imp').value = data.rece_id;
	 document.getElementById('text_idrece_imp2').value = data.rece_id;
	document.getElementById('text_idrece_imp3').value = data.rece_id;
	document.getElementById('text_numerocel').value = data.cliente_celular;
	document.getElementById('text_nombrecliente_w').value = data.cliente_nombres;
	Traer_url_sistema();
	//window.open("../MPDF/reporte_recepcion.php?codigo=" + parseInt(data[0]) + "#zoom=100", "Ticket de Recepcion", "scrollbards=NO");

});



//IMPRESION TICKET
$('#btn_ticket').on('click', function () {
	let tick_recT = document.getElementById('text_idrece_imp3').value;

	window.open("../MPDF/reporte_recepcion.php?codigo=" + parseInt(tick_recT) + "#zoom=100", "Ticket de Recepcion", "scrollbards=NO");
});

//IMPRESION ETIQUETA
$('#btn_etique').on('click', function () {
	let eti_recE = document.getElementById('text_idrece_imp2').value;

	//window.open("../MPDF/reporte_etiqueta.php?codi=" + parseInt(eti_recE) + "#zoom=100", "Etiqueta de Recepcion", "scrollbards=NO");
	window.open("../MPDF/reporte_codigo_barras2.php?codi=" + parseInt(eti_recE) + "#zoom=100", "Etiqueta de Recepcion", "scrollbards=NO");
});

//IMPRESION RESGUARDO DEPOSITO
$('#btn_deposito').on('click', function () {
	let res_depo = document.getElementById('text_idrece_imp').value;

	window.open("../MPDF/reporte_resguardo_deposito.php?codigo=" + parseInt(res_depo) + "#zoom=100", "Resguardo Entrada", "scrollbards=NO");
});

//IMPRESION CONSTANCIA DE DATOS
$('#btn_datos').on('click', function () {
	let cons_datos = document.getElementById('text_idrece_imp').value;

	window.open("../MPDF/reporte_constancia_datos.php?codigo=" + parseInt(cons_datos) + "#zoom=100", "Constancia de datos", "scrollbards=NO");
});



//IMPRESION A4
$('#btn_a4').on('click', function () {
	let tick_recA = document.getElementById('text_idrece_imp').value;

	window.open("../MPDF/reporte_a4.php?codigo=" + parseInt(tick_recA) + "#zoom=100", "A4 de Recepcion", "scrollbards=NO");
});


//ENVIO RECEPCION A WHATSAPP
$('#btn_whatsapp').on('click', function () {
	var rutaBase = document.getElementById('text_url_sistema').value;
	var cod_pais = document.getElementById('text_cod_pais').value;
	let tick_whatsa = document.getElementById('text_idrece_imp').value;
	let clientnombre = document.getElementById('text_nombrecliente_w').value;
	
	var numeromovil = document.getElementById("text_numerocel").value;
	var rutaPDFticket = rutaBase+"MPDF/reporte_recepcion.php?codigo=" + parseInt(document.getElementById('text_idrece_imp').value) + "#zoom=100";
	var rutaPDFdeposito = rutaBase+"MPDF/reporte_resguardo_deposito.php?codigo=" + parseInt(document.getElementById('text_idrece_imp').value) + "#zoom=100";

    //Verificar si el número es válido (solo números y longitud adecuada)
    if (numeromovil.match(/^\d+$/) && numeromovil.length >= 9 && numeromovil.length <= 15) {
      // Construir la URL de WhatsApp con el número y el mensaje deseado
	  var mensaje = encodeURIComponent("Enlaces para descargar los archivos PDF - Nro Recepcion: [R-000"+tick_whatsa +"] |  Cliente: [ "  + clientnombre +" ] | TICKET: " + rutaPDFticket + "   |    CONSTANCIA DE DEPOSITO:   " + rutaPDFdeposito );
      var url = "https://wa.me/"+cod_pais+numeromovil+"?text=" + mensaje;

      window.open(url, '_blank');
    } else {
			Swal.fire("Error de numero", "Por favor, ingrese un número de WhatsApp válido.", "warning");

    }
});



//IMPRESION RESGUARDO ENTREGA
$('#btn_entrega').on('click', function () {
	let ent_rec = document.getElementById('text_idrece_imp').value;

	window.open("../MPDF/reporte_resguardo_entrega.php?codigo=" + parseInt(ent_rec) + "#zoom=100", "Resguardo Entrada", "scrollbards=NO");
});

//FOTO
function filePreview(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#pre_imagen').html('<img src='+e.target.result+' style="width: 60%;" class="rounded-circle avatar-xl img-thumbnail user-profile-image" alt="user-profile-image"></img>');
        }
        reader.readAsDataURL(input.files[0]);
    }
}

$(document).on('change','#text_foto',function(){
    filePreview(this);
});

$(document).on("click","#btnremovephoto",function(){
    $('#text_foto').val('');
    $('#pre_imagen').html('<img src="../controller/recepcion/foto/no_imagen.png" style="width: 60p%;" class="rounded-circle avatar-xl img-thumbnail user-profile-image" alt="user-profile-image"></img><input type="hidden" name="hidden_usuario_imagen" value="" />');
});


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
 			document.getElementById('select_sucursal_r').innerHTML = llenardata;
 			document.getElementById('select_sucursal_editar').innerHTML = llenardata;
 		}else{
 			llenardata+="<option value=''>No se encontraron datos</option>";
 			document.getElementById('select_sucursal_r').innerHTML = llenardata;
 			document.getElementById('select_sucursal_editar').innerHTML = llenardata;

 		}
 	})
 }






/********************************************************************
		   REGISTRAR CLIENTE
********************************************************************/
function RegistrarCliente() {
	let nombre = document.getElementById('text_nombre').value;
	let dni = document.getElementById('text_dni').value;
	let cel = document.getElementById('text_celular').value;
	let direccion = document.getElementById('text_direccion').value;
	let apellidop = document.getElementById('text_ape_p').value;
	let apellidom = document.getElementById('text_ape_m').value;
	let correo = document.getElementById('text_correo').value;
	let tipo_doc = document.getElementById('select_tipo_doc').value;
	let sucurid = document.getElementById('text_idsucurs').value;
	let listanegra = document.getElementById('chkListanegra').checked ? "Si" : "No";

	if (nombre.length == 0 || dni.length == 0 || cel.length == 0) {
		ValidarCamposCliente("text_nombre", "text_dni", "text_celular", "select_tipo_doc");
		return Swal.fire("Mensaje de Advertencia", "Tiene campos vacios", "warning");
	}

    console.log("Iniciando RegistrarCliente (Recepcion)...");
    const dataCapturada = {
        cliente_nombres: nombre,
        cliente_dni: dni,
        cliente_celular: cel,
        cliente_direccion: direccion,
        cliente_ape_p: apellidop,
        cliente_ape_m: apellidom,
        cliente_correo: correo,
        cliente_tipo_doc: tipo_doc,
        id_sucu: sucurid,
        cliente_listanegra: listanegra
    };
    console.log("Datos capturados:", dataCapturada);

	$.ajax({
		url: '../controller/cliente/controlador_cliente_registar.php',
		type: 'POST',
		data: dataCapturada
	}).done(function (resp) {
        console.log("Respuesta recibida:", resp);
		if (resp > 0 || resp == "1" || resp == "2") {
			if (resp == 1 || resp == "1") {
				Swal.fire("Mensaje de Confirmacion", "Cliente Registrado", "success").then((value) => {
					$("#modal_registro_cliente").modal('hide');
					cargar_SelectCliente();
					if (typeof tbl_cliente !== 'undefined') {
                        tbl_cliente.ajax.reload();
                    }
				});
			} else {
				Swal.fire("Mensaje de Advertencia", "El Cliente ya se encuentra registrado (DNI duplicado)", "warning");
			}

		} else {
			Swal.fire("Mensaje de Error", "No se puede registrar el Cliente. Detalle: " + JSON.stringify(resp), "error");
		}
	}).fail(function(jqXHR, textStatus, errorThrown) {
        console.error("Fallo AJAX RegistrarCliente:", textStatus, errorThrown);
        console.log("Respuesta del servidor:", jqXHR.responseText);
        Swal.fire("Error de Red", "No se pudo conectar con el servidor. Detalle: " + textStatus, "error");
    });
}






/********************************************************************
 REGISTRAR RECEPCION
********************************************************************/
function RegistrarRecepcion() {
$("#btnregistrarrecep").prop('disabled', true);
	let count = 0; //para validar que el detalle tenga un dato
	//recorremos la tabla
	$("#tabla_det_pro  tbody#tbody_tabla_det_pro tr ").each(function () {
		count++; //cuenta las filas 
	})

	if (count == 0) {
		return Swal.fire("Mensaje de Advertencia", "Debe agregar un Equipo en el detalle", "warning");
	}

	let cliente = document.getElementById('select_cliente').value;
	let motivo = document.getElementById('select_motivo').value;
	let fentrega = document.getElementById('text_fentrega').value;
	let cod_re = document.getElementById('text_codigo_r').value;

	let monto = document.getElementById('text_monto').value;
	let adelanto = document.getElementById('text_adelanto').value;
	let debe = document.getElementById('text_debe').value;
	let accesorios = document.getElementById('text_accesorios').value;
	let tecnicoid = document.getElementById('select_tecnic').value;
	let usuario_regist = document.getElementById('text_Idprincipal').value;
	let foto = document.getElementById('text_foto').value;
	let sucursal = document.getElementById('select_sucursal_r').value;



	if (cliente.length == 0) {
		return Swal.fire("Mensaje de Advertencia", "Seleccione un cliente", "warning");
	}
	if (motivo.length == 0) {
		return Swal.fire("Mensaje de Advertencia", "Seleccione un motivo", "warning");
	}
	if (tecnicoid.length == 0) {
		return Swal.fire("Mensaje de Advertencia", "Seleccione un tecnico ", "warning");
	}
	if (parseFloat(adelanto) > parseFloat(monto)) {
		return Swal.fire("Mensaje de Advertencia", "El adelanto no debe sobrepasar el monto de la recepcion", "warning");
	}
	if (accesorios == "") {
		return Swal.fire("Mensaje de Advertencia", "Ingrese una Observación General (pestaña principal)", "warning");
	}
	if (cod_re == "") {
		return Swal.fire("Mensaje de Advertencia", "Ingrese Numero de Pedido", "warning");
	}

	//capturar foto
	let extension = foto.split('.').pop();//capturar despues del punto foto122.jpg
	let nombrefoto="";
	let f = new Date();
	if (foto.length>0) {
		nombrefoto="IMG"+f.getDate()+""+(f.getMonth()+1)+""+f.getFullYear()+""+f.getHours()+""+f.getMilliseconds()+"."+extension;
	}
	let formData = new FormData();
	let fotoObject = $("#text_foto")[0].files[0];//objeto de la foto adjuntada
	 formData.append('monto',monto);
	 formData.append('cliente',cliente);
	 formData.append('motivo',motivo);
	 formData.append('adelanto',adelanto);
	 formData.append('debe',debe);
	 formData.append('accesorios',accesorios);
	 formData.append('fentrega',fentrega);
	 formData.append('cod_re',cod_re);
	 formData.append('tecnicoid',tecnicoid);
	 formData.append('usuario_regist',usuario_regist);
	 formData.append('nombrefoto',nombrefoto);
	 formData.append('foto',fotoObject);
	  formData.append('sucursal',sucursal);
    console.log("Iniciando RegistrarRecepcion...");
    console.log("Datos a enviar:", {
        monto: monto,
        cliente: cliente,
        motivo: motivo,
        adelanto: adelanto,
        debe: debe,
        accesorios: accesorios,
        fentrega: fentrega,
        cod_re: cod_re,
        tecnicoid: tecnicoid,
        usuario_regist: usuario_regist,
        nombrefoto: nombrefoto,
        sucursal: sucursal
    });

	$.ajax({
		url: '../controller/recepcion/controlador_recepcion_registar.php',
	 	type: 'POST',
	 	data:formData,
	 	contentType: false,
	 	processData: false,
	 	success: function(resp){
			console.log("Respuesta RegistrarRecepcion:", resp);
			if (resp > 0) {

				Registrar_Detalle_Equi(parseInt(resp));
				Registrar_insumos(parseInt(resp));
	
			} else {
				Swal.fire("Mensaje de Error", "No se puede registrar la Recepcion. Detalle: " + JSON.stringify(resp), "error");
			}
		
		},
        error: function(jqXHR, textStatus, errorThrown) {
            console.error("Error AJAX RegistrarRecepcion:", textStatus, errorThrown);
            console.log("Respuesta del servidor:", jqXHR.responseText);
            Swal.fire("Error de Red", "No se pudo conectar con el servidor. Detalle: " + textStatus, "error");
        },
        complete: function() {
            $("#btnregistrarrecep").prop('disabled', false);
        }
	})
	return false;
}



/********************************************************************
		   VALIDAR CAMPOS RECEPCION
********************************************************************/
function ValidarCamposRecepcion( caracteristicas, concepto, monto) {
	//Boolean(document.getElementById(equipo).value.length > 0) ? $("#" + equipo).removeClass("is-invalid").addClass("is-valid") : $("#" + equipo).removeClass("is-valid").addClass("is-invalid");
	Boolean(document.getElementById(caracteristicas).value.length > 0) ? $("#" + caracteristicas).removeClass("is-invalid").addClass("is-valid") : $("#" + caracteristicas).removeClass("is-valid").addClass("is-invalid");
	Boolean(document.getElementById(concepto).value.length > 0) ? $("#" + concepto).removeClass("is-invalid").addClass("is-valid") : $("#" + concepto).removeClass("is-valid").addClass("is-invalid");
	Boolean(document.getElementById(monto).value.length > 0) ? $("#" + monto).removeClass("is-invalid").addClass("is-valid") : $("#" + monto).removeClass("is-valid").addClass("is-invalid");
}






/********************************************************************
				   LIMPIAR TEXBOX RECEPCION
********************************************************************/
function LimpiarModalRecepcion() {
	document.getElementById('text_equi2').value = "";
	//document.getElementById('text_caracteristicas').value = "";
	//document.getElementById('text_accesorios').value = "";
	document.getElementById('text_concepto').value = "";
	document.getElementById('text_serie2').value = "";
	document.getElementById('text_monto2').value = "0";
	document.getElementById('text_monto').value = "0";
	document.getElementById('text_adelanto').value = "0";
	document.getElementById('text_debe').value = "0";
	document.getElementById('text_pendite2').value = "0";
	document.getElementById('text_accesorios').value = "";
	document.getElementById('text_codigo_r').value = "";
	$("#select_cliente").select2().val("").trigger('change.select2');
	$("#select_motivo").select2().val("").trigger('change.select2');
	$("#select_tecnic").select2().val("").trigger('change.select2');
}




/********************************************************************
			VALIDAR CAMPOS CLIENTE
 ********************************************************************/
function ValidarCamposCliente(nombre, dni, celular) {
	Boolean(document.getElementById(nombre).value.length > 0) ? $("#" + nombre).removeClass("is-invalid").addClass("is-valid") : $("#" + nombre).removeClass("is-valid").addClass("is-invalid");
	Boolean(document.getElementById(dni).value.length > 0) ? $("#" + dni).removeClass("is-invalid").addClass("is-valid") : $("#" + dni).removeClass("is-valid").addClass("is-invalid");
	Boolean(document.getElementById(celular).value.length > 0) ? $("#" + celular).removeClass("is-invalid").addClass("is-valid") : $("#" + celular).removeClass("is-valid").addClass("is-invalid");
}





/********************************************************************
				   LIMPIAR TEXBOX CLIENTE
********************************************************************/
function LimpiarModalCliente() {
	document.getElementById('text_nombre').value = "";
	document.getElementById('text_dni').value = "";
	document.getElementById('text_celular').value = "";
	document.getElementById('text_direccion').value = "";
}




/********************************************************************
						  SUMAR AUTOMATICAMENTE EN LOS TEXBOX
 ********************************************************************/
function calcular() {
	try {
		var a = parseFloat(document.getElementById('text_monto').value) || 0;
		var b = parseFloat(document.getElementById('text_adelanto').value) || 0;
		if (b.length > a.length) {
			return Swal.fire("Mensaje de Advertencia", "Ingrese cantidad menor que la del monto", "warning");
		} else {
			document.getElementById('text_debe').value = a - b;
		}

	} catch (e) { }

}


function calcularAlEditar() {
	try {
		var a = parseFloat(document.getElementById('text_monto_editar').value) || 0;
		var b = parseFloat(document.getElementById('text_adelanto_editar').value) || 0;
		if (b.length == 0) {
			document.getElementById("text_debe_editar").value = "0";
		}
		document.getElementById('text_debe_editar').value = a - b;

	} catch (e) { }

}




/********************************************************************
							MODIFICAR RECEPCION
 ********************************************************************/
function ModificarRecepcion() {//enviamos los datos del ajax al controlador y al onclick del boton editar
	let id = document.getElementById('idrecepcion').value;
	//let equipo = document.getElementById('text_equipo_editar').value;
	let caracteristicas = document.getElementById('text_caracteristicas_editar').value;
	let concepto = document.getElementById('text_concepto_editar').value;
	let monto = document.getElementById('text_monto_editar').value;
	let cliente = document.getElementById('select_cliente_editar').value;
	let motivo = document.getElementById('select_motivo_editar').value;
	let estado = document.getElementById('select_estado_recepcion_editar').value;
	let adelanto = document.getElementById('text_adelanto_editar').value;
	let debe = document.getElementById('text_debe_editar').value;

	let accesorios = document.getElementById('text_accesorios_editar').value;
	let fentrega = document.getElementById('text_fentrega_editar').value;
	let marca = document.getElementById('select_marca_editar').value;
	let recoger = document.getElementById('select_recoger_recepcion_editar').value;
	let tecnicoid = document.getElementById('select_tecnic_editar').value;

	if (cliente.length == 0) {
		return Swal.fire("Mensaje de Advertencia", "Seleccione un cliente", "warning");
	}
	if (motivo.length == 0) {
		return Swal.fire("Mensaje de Advertencia", "Seleccione un motivo", "warning");
	}
	 if (concepto.length == 0) {
		return Swal.fire("Mensaje de Advertencia", "Ingrese una observacion", "warning");
	}

	if (tecnicoid.length == 0) {
		return Swal.fire("Mensaje de Advertencia", "Seleccione un tecnico", "warning");
	}


	if (monto.length == 0) {
		return Swal.fire("Mensaje de Advertencia", "Debe ingresar un monto para l equipo", "warning");
	}
	


	// if ( caracteristicas.length == 0 || concepto.length == 0 || monto.length == 0) {
	// 	ValidarCamposRecepcion( "text_caracteristicas_editar", "text_concepto_editar", "text_monto_editar");
	// 	return Swal.fire("Mensaje de Advertencia", "Tiene campos vacios", "warning");
	// }

	$.ajax({
		url: '../controller/recepcion/controlador_modificar_recepcion.php',
		type: 'POST',
		data: {
			id: id,//le enviamos los campos al controlador
			cliente: cliente,
		    caracteristicas: caracteristicas,
			motivo: motivo,
			concepto: concepto,
			monto: monto,
			estado: estado,
			adelanto: adelanto,
			debe: debe,
			accesorios: accesorios,
			fentrega: fentrega,
			recoger: recoger,
			tecnicoid: tecnicoid
		}
	}).done(function (resp) {
		if (resp > 0) {
			if (resp == 1) {//validamos la respuesta del procedure si retorna 1 o 2
				//ValidarCamposProducto("text_producto","text_stock","text_pcompra","text_pventa");
				//LimpiarModalPaciente();
				Swal.fire("Mensaje de Confirmacion", "Recepcion Actualizado", "success").then((value) => {
					$("#modal_editar_recepcion").modal('hide');//abrimos el modal
					tbl_recepcion.ajax.reload();//recargar dataTable
					cargar_Notificaiones_Recepcion();
				});
			} else {
				Swal.fire("Mensaje de Advertencia", "La Recepcion ya se encuentra registrado", "warning");

			}

		} else {
			Swal.fire("Mensaje de Error", "No se puede registrar. Verifique si tiene una CAJA ABIERTA o intente de nuevo.", "error");
		}
	})
}


/********************************************************************
		   REGISTRAR DIAGNOSTICO
********************************************************************/
function Registrar_insumos_al_Editar(){
       
    let id_repa_ins= document.getElementById('idrecepcion').value;	
    let id_prod_ins= document.getElementById('select_produc_ins_e').value;
    let cantid_ins = document.getElementById('text_cantidad_ins_e').value;
    let stock_ins = document.getElementById('text_stock_insu_e').value;
    let precio_ins = document.getElementById('text_precio_insu_e').value;
    let idusu_ins = document.getElementById('text_Idprincipal').value;
    let monto_ins = 0
   
    if (parseFloat(stock_ins) < parseFloat(cantid_ins)) {
		return Swal.fire("El articulo no tiene Stock suficiente", "Stock actual: " + stock_ins + "  ", "warning");
	}

    if (id_prod_ins.length == 0) {
		return Swal.fire("Mensaje de Advertencia", "Seleccione un articulo", "warning");
	}
    if (id_prod_ins.length == 0) {
		return Swal.fire("Mensaje de Advertencia", "Seleccione un articulo", "warning");
	}

    if (cantid_ins.length == 0) {
		return Swal.fire("Mensaje de Advertencia", "Ingrese una cantidad", "warning");
	}

	if (parseInt(cantid_ins) < 1) {
		return Swal.fire("Mensaje de Advertencia", "La cantidad debe ser mayor a 0", "warning");
	}

    monto_ins =  parseFloat(precio_ins * cantid_ins).toFixed(2);



    $.ajax({
         url:'../controller/recepcion/controlador_registrar_insumos_reparacion.php',
         type: 'POST',
         data:{
            id_repa_ins:id_repa_ins,
            id_prod_ins:id_prod_ins,
            cantid_ins:cantid_ins,
            monto_ins: monto_ins,
            idusu_ins:idusu_ins
       
         }
     }).done(function(resp){
        
         if (resp > 0) {
			if (resp == 1) {//validamos la respuesta del procedure si retorna 1 o 2
				Swal.fire("Mensaje de Confirmacion", "Insumo insertado", "success").then((value) => {

					//$("#modal_registro_cliente").modal('hide');
					//limpiar_modal_insumos();
                     tbl_ver_insumos_repara.ajax.reload();
					 cargar_Select_Insumos_Edit();
					 recalculo_montos();
						 document.getElementById('text_stock_insu_e').value = "";
						document.getElementById('text_precio_insu_e').value = "";
						document.getElementById('text_cantidad_ins_e').value = "";
						
						$("#select_produc_ins_e").select2().val("").trigger('change.select2');
					
				});
			} else {
				Swal.fire("Mensaje de Advertencia", "El articulo ya se encuentra registrado", "warning");
			}

		} else {
			Swal.fire("Mensaje de Error", "No se pudo insertar", "error");
		}





     })	
}



/**********************************************************************
		LISTAR ESTADO DE LA CAJA Y VALIDAR PARA HACER UNA RECEPCION
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
            $('#textnuevarecepcion').prop('hidden', false); // Muestra el botón
        } else {
            // Si no hay caja (data.length es 0) o el estado no es VIGENTE
            document.getElementById('text_estado').innerHTML = 'CERRADA';
            Swal.fire("Mensaje de Advertencia", "Debe aperturar una caja para continuar", "warning");
            $('#textnuevarecepcion').prop('hidden', true); // Oculta el botón
        }
	})
}

function Traer_url_sistema() {
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
		//console.log(data[0][13]);
			//document.getElementById('text_numerocel').value = data.cliente_celular;
			document.getElementById('text_url_sistema').value = data[0][13];
			document.getElementById('text_cod_pais').value = data[0][14];

	})
}





/********************************************************************
		   BOTON AGREGAR EQUIPOS AL DETALLE
********************************************************************/
function Agregar_equipo() {

	//let idproducto = document.getElementById('text_idproducto').value;
	let equipo = document.getElementById('text_equi2').value;
	let serie = document.getElementById('text_serie2').value;
	let falla_i = document.getElementById('text_concepto').value;
	//let marca_i = document.getElementById('select_marca').value;
	let monto2 = document.getElementById('text_monto2').value;
	let adelant2 = document.getElementById('text_pendite2').value;
	let nombremarca = ($('#select_marca option:selected').text()).split('')[0];

	if (equipo.length == 0) {
		return Swal.fire("Mensaje de Advertencia", "Ingrese nombre del equipo", "warning");
	}
	if (serie.length == 0) {
		return Swal.fire("Mensaje de Advertencia", "Ingrese una serie o Imei del equipo", "warning");
	}
	if (falla_i.length == 0) {
		return Swal.fire("Mensaje de Advertencia", "Ingrese una falla del equipo", "warning");
	}
	
	// if (monto2.length == 0) {
	// 	return Swal.fire("Mensaje de Advertencia", "Ingrese un Monto", "warning");
	// }

	// if (parseInt(monto2) < 1) {
	// 	return Swal.fire("Mensaje de Advertencia", "El Monto debe ser mayor a 0", "warning");
	// }

	//llamamos la funcion para verificar si ya esta agregado en el detalle
	if (verificarid(serie)) {
		return Swal.fire("Mensaje de Advertencia", "La serie ya esta agregada", "warning");
	}

	let datos_agregar = "<tr>"; //para agregar en el detalle DEL EXAMEN
	datos_agregar += "<td >" + equipo + "</td>";//hace referenci al verificar id
	datos_agregar += "<td for='id'>" + serie + "</td>";
	datos_agregar += "<td class='falla'> " + falla_i + "</td>";
	datos_agregar += "<td class='monto'> " + monto2 + "</td>";
	
	
	datos_agregar += "<td class='adelan'> " + adelant2 + "</td>";
	datos_agregar += "<td><button class='btn btn-danger btn-sm remove' onclick='remove(this);'><i class ='fa fa-trash'></i> </button></td>";
	datos_agregar += "</tr>";//cierre de etiqueta
	$("#tbody_tabla_det_pro").append(datos_agregar);//agregamos a la tabla style="text-align: center;"
	document.getElementById('text_equi2').value = "";
	document.getElementById('text_serie2').value = "";
	document.getElementById('text_monto2').value = "0";
	document.getElementById('text_pendite2').value = "0";
	document.getElementById('text_concepto').value = "";
	$("#text_equi2").focus();
	sumar_monto();
	sumar_adelanto();
	calcularPendiente();
}


function verificarid(serie) {
	let idverificar = document.querySelectorAll('#tabla_det_pro td[for="id"]');
	return [].filter.call(idverificar, td => td.textContent === serie).length === 1;
}


/********************************************************************
		  REMOVER IMEI DEL DETALLE
********************************************************************/
function remove(t) {
    var td = t.parentNode;
    var tr = td.parentNode;
    var montoEliminar = parseFloat(tr.querySelector('.monto').innerText);
	var abonoEliminar = parseFloat(tr.querySelector('.adelan').innerText);

    // Verificar si el valor es un número válido
    if (!isNaN(montoEliminar)) {
        Swal.fire({
            title: '¿Desea remover el Imei?',
            text: "",
            icon: 'warning',
            showCancelButton: true,
            // confirmButtonColor: '#3085d6',
            // cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, confirmar'
        }).then((result) => {
            if (result.isConfirmed) {
                tr.remove();
                restar_monto_eliminar(montoEliminar, abonoEliminar);
            }
        });
    } else {
        // En caso de que el valor no sea un número, manejarlo adecuadamente
        Swal.fire("Error", "No se pudo obtener el monto para eliminar.", "error");
    }
}

/********************************************************************
		  AGREGAR INSUMOS ANTS DE REGISTRAR
********************************************************************/
function Agregar_insumos(){
       
    //let id_repa_ins= document.getElementById('idrepara_ins').value;	
    let id_prod_ins= document.getElementById('select_produc_ins').value;
    let cantid_ins = document.getElementById('text_cantidad_ins').value;
    let stock_ins = document.getElementById('text_stock_insu').value;
    let precio_ins = document.getElementById('text_precio_insu').value;
    let idusu_ins = document.getElementById('text_Idprincipal').value;
	let nombre_ins = ($('#select_produc_ins option:selected').text()).split('|')[0];
    let monto_ins = 0
   
    if (parseFloat(stock_ins) < parseFloat(cantid_ins)) {
		return Swal.fire("El articulo no tiene Stock suficiente", "Stock actual: " + stock_ins + "  ", "warning");
	}

    if (id_prod_ins.length == 0) {
		return Swal.fire("Mensaje de Advertencia", "Seleccione un articulo", "warning");
	}
    if (id_prod_ins.length == 0) {
		return Swal.fire("Mensaje de Advertencia", "Seleccione un articulo", "warning");
	}

    if (cantid_ins.length == 0) {
		return Swal.fire("Mensaje de Advertencia", "Ingrese una cantidad", "warning");
	}

	if (parseInt(cantid_ins) < 1) {
		return Swal.fire("Mensaje de Advertencia", "La cantidad debe ser mayor a 0", "warning");
	}

	if (verificarid_insu(id_prod_ins)) {
		return Swal.fire("Mensaje de Advertencia", "El Insumo ya esta agregado", "warning");
	}

    monto_ins =  parseFloat(precio_ins * cantid_ins).toFixed(2);

	let datos_agregar = "<tr>"; //para agregar en el detalle DEL EXAMEN
	datos_agregar += "<td for='id_i'>" + id_prod_ins + "</td>";//hace referenci al verificar id
	datos_agregar += "<td class='descrip_i'>" + nombre_ins + "</td>";
	datos_agregar += "<td class='cantidad_i'>" + cantid_ins + "</td>";
	datos_agregar += "<td class='monto_i'> " + monto_ins + "</td>";

	datos_agregar += "<td><button class='btn btn-danger btn-sm remove_i' onclick='remove_i(this);'><i class ='fa fa-trash'></i> </button></td>";
	datos_agregar += "</tr>";//cierre de etiqueta
	$("#tbody_tabla_det_pro_disminuir").append(datos_agregar);//agregamos a la tabla style="text-align: center;"
	document.getElementById('text_stock_insu').value = "";
	document.getElementById('text_precio_insu').value = "";
	document.getElementById('text_cantidad_ins').value = "";
	
	$("#select_produc_ins").select2().val("").trigger('change.select2');
	sumar_monto_insumo();
	calcularPendiente();
	//cargar_Select_Productos();

  
}

//validar que no se registre 2 veces el mismo prducto en la tabla
function verificarid_insu(idprod) {
	let idverificar = document.querySelectorAll('#tabla_insumos_recep td[for="id_i"]');
	return [].filter.call(idverificar, td => td.textContent === idprod).length === 1;
}

//funcion para quitar item de tabla insumos antes de registrar
function remove_i(t) {
    var td = t.parentNode;
    var tr = td.parentNode;
    var montoEliminar_i = parseFloat(tr.querySelector('.monto_i').innerText);
	//var abonoEliminar = parseFloat(tr.querySelector('.adelan').innerText);

    // Verificar si el valor es un número válido
    if (!isNaN(montoEliminar_i)) {
        Swal.fire({
            title: '¿Desea remover el Imei?',
            text: "",
            icon: 'warning',
            showCancelButton: true,
            // confirmButtonColor: '#3085d6',
            // cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, confirmar'
        }).then((result) => {
            if (result.isConfirmed) {
                tr.remove();
                restar_monto_eliminar_i(montoEliminar_i);
            }
        });
    } else {
        // En caso de que el valor no sea un número, manejarlo adecuadamente
        Swal.fire("Error", "No se pudo obtener el monto para eliminar.", "error");
    }
}



function limpiarTabla_regiEquipo() {
    var table_reg_equi = document.getElementById("tabla_det_pro");
    var rowCount = table_reg_equi.rows.length;

    // Eliminar todas las filas excepto la primera (encabezados)
    while (rowCount > 1) {
        table_reg_equi.deleteRow(1);
        rowCount--;
    }
}

function limpiarTabla_regiInsumos() {
    var table_reg_insu = document.getElementById("tabla_insumos_recep");
    var rowCount = table_reg_insu.rows.length;

    // Eliminar todas las filas excepto la primera (encabezados)
    while (rowCount > 1) {
        table_reg_insu.deleteRow(1);
        rowCount--;
    }
}




/********************************************************************
		   REGISTRAR DETALLE
********************************************************************/
function Registrar_Detalle_Equi(id_re) {
    console.log("Iniciando Registrar_Detalle_Equi para ID:", id_re);
    //let id_alm = document.getElementById('select_alma_reg').value;

    let count = 0;
    let arreglo_equipo = new Array();
	let arreglo_serie = new Array();
	let arreglo_falla = new Array();
	let arreglo_monto = new Array();
	let arreglo_abono = new Array();

    $("#tabla_det_pro  tbody#tbody_tabla_det_pro tr ").each(function () {
        arreglo_equipo.push($(this).find('td').eq(0).text());
		arreglo_serie.push($(this).find('td').eq(1).text());
		arreglo_falla.push($(this).find('td').eq(2).text());
		arreglo_monto.push($(this).find('td').eq(3).text());
		arreglo_abono.push($(this).find('td').eq(4).text());
        count++;
    })

    if (count == 0) {
    	return Swal.fire("Mensaje de Advertencia", "Debe agregar un Equipo en el detalle", "warning");
    } 

    let equipo_d = arreglo_equipo.toString();
	let serie_d = arreglo_serie.toString();
	let falla_d = arreglo_falla.toString();
	let monto_d = arreglo_monto.toString();
	let abono_d = arreglo_abono.toString();

    console.log("Enviando Detalle Equipo:", { id_re, equipo_d, serie_d, falla_d, monto_d, abono_d });

    $.ajax({
        url: '../controller/recepcion/controlador_rece_detalle_registar.php',
        type: 'POST',
        data: {
            id_re: id_re,
            equipo_d: equipo_d,
            serie_d : serie_d ,
			falla_d:falla_d,
			monto_d:monto_d,
			abono_d:abono_d
        }
    }).done(function (resp) {
        console.log("Respuesta Registrar_Detalle_Equi:", resp);
        if (resp > 0) {
            LimpiarModalRecepcion();
            Swal.fire("Mensaje de Confirmacion", "Recepcion Registrada", "success").then((value) => {
                tbl_recepcion.ajax.reload();
				limpiarTabla_regiEquipo();
				$("#modal_registro_recepcion").modal('hide');
            });
        } else {
            return Swal.fire("Mensaje de Error", "No se pudo completar el registro de equipos. Detalle: " + JSON.stringify(resp), "error");
        }
    }).fail(function(jqXHR, textStatus, errorThrown) {
        console.error("Fallo AJAX Registrar_Detalle_Equi:", textStatus, errorThrown);
        console.log("Cuerpo respuesta error:", jqXHR.responseText);
        Swal.fire("Error de Red (Detalle)", "No se pudo registrar el equipo. Detalle: " + textStatus, "error");
    });
}


function Registrar_insumos(idrecep){
    console.log("Iniciando Registrar_insumos para ID:", idrecep);
	let idusu_ins = document.getElementById('text_Idprincipal').value;
	 let idalmacen = document.getElementById('text_idalmacen').value;
   
    let count = 0;
    let arreglo_insumo = new Array();
	let arreglo_cant_i = new Array();
	let arreglo_monto_i = new Array();

    $("#tabla_insumos_recep  tbody#tbody_tabla_det_pro_disminuir tr ").each(function () {
        arreglo_insumo.push($(this).find('td').eq(0).text());
		arreglo_cant_i.push($(this).find('td').eq(2).text());
		arreglo_monto_i.push($(this).find('td').eq(3).text());
        count++;
    })

    let insu_ins = arreglo_insumo.toString();
	let cant_ins = arreglo_cant_i.toString();
	let mont_ins = arreglo_monto_i.toString();

    if (count > 0) {
        console.log("Enviando Detalle Insumos:", { idrecep, insu_ins, cant_ins, mont_ins, idusu_ins, idalmacen });
        $.ajax({
            url: '../controller/recepcion/controlador_registrar_detalle_insumos.php',
            type: 'POST',
            data: {
                idrecep : idrecep,
                insu_ins: insu_ins,
                cant_ins: cant_ins,
                mont_ins : mont_ins,
                idusu_ins :idusu_ins,
                idalmacen:idalmacen
            }
        }).done(function (resp) {
            console.log("Respuesta Registrar_insumos:", resp);
            if (resp > 0) {
                limpiarTabla_regiInsumos();
                document.getElementById('text_stock_insu').value = "";
                document.getElementById('text_precio_insu').value = "";
                document.getElementById('text_cantidad_ins').value = "";
                $("#select_produc_ins").select2().val("").trigger('change.select2');
            } else {
                console.error("Error en Registrar_insumos (valor retornado):", resp);
            }
        }).fail(function(jqXHR, textStatus, errorThrown) {
            console.error("Fallo AJAX Registrar_insumos:", textStatus, errorThrown);
        });
    } else {
        console.log("No hay insumos para registrar.");
    }
}



/*===================================================================*/
    //PARA MAYUSCULAS
/*===================================================================*/
function mayus(e) {
    e.value = e.value.toUpperCase();
}


/*===================================================================*/
//SUMAR COLUMNAS DEL STOCK Y SUMAR EN TEXBOX
/*===================================================================*/

function sumar_monto(){
    var sum=0;
	var sumatot2=0;
	var mnto_in2 = parseFloat($('#text_monto').val()) || 0;
        //itera cada input de clase .subtotal y la suma
        $('.monto').each(function() {
            sum += parseFloat($(this).text()) || 0;
        });
		sumatot2 = parseFloat(sum).toFixed(2); // Usamos sum directamente si queremos el total de la tabla
        $('#text_monto').val(sumatot2);
    }


function sumar_adelanto(){
		var sum2=0;
			//itera cada input de clase .subtotal y la suma
			$('.adelan').each(function() {sum2 += parseFloat($(this).text());
			});
			$('#text_adelanto').val(sum2);
			//$('#iptStockReg').val(sum.toFixed(2));
}


function calcularPendiente() {
	var cal_mont = $("#text_monto").val();
	var cal_adelnt = $("#text_adelanto").val();
	var cal_pendie = cal_mont - cal_adelnt;
		$("#text_debe").val(cal_pendie.toFixed(2));
}


	function sumar_monto_insumo() {
    var sum_equi = 0;
    var sum_insu = 0;
    
    // Sumar montos de equipos
    $('.monto').each(function() {
        sum_equi += parseFloat($(this).text()) || 0;
    });
    
    // Sumar montos de insumos
    $('.monto_i').each(function() {
        sum_insu += parseFloat($(this).text()) || 0;
    });
    
    var total = (sum_equi + sum_insu).toFixed(2);
    $('#text_monto').val(total);
}
				




//PARA CALCULAR MONTOS AL ELIMINAR
function restar_monto_eliminar(montoEliminar, abonoEliminar) {
	var montoActual = parseFloat($('#text_monto').val());
	var abonoActual = parseFloat($('#text_adelanto').val());

	// Verificar si el valor actual es un número válido
	if (!isNaN(montoActual)) {
		var nuevoMonto = montoActual - montoEliminar;
		var nuevoAbono = abonoActual - abonoEliminar;
		var nuevoPendiente= nuevoMonto - nuevoAbono;
		$('#text_monto').val(nuevoMonto.toFixed(2));
		$('#text_adelanto').val(nuevoAbono.toFixed(2));
		$('#text_debe').val(nuevoPendiente.toFixed(2));
	} else {
		// En caso de que el valor actual no sea un número, manejarlo adecuadamente
		$('#text_monto').val(montoActual);
		$('#text_adelanto').val(abonoActual);
		Swal.fire("Error", "No se pudo calcular el nuevo monto total.", "error");
	}
}

//al eliminar un item de insumo al registrar
function restar_monto_eliminar_i(montoEliminar_i) {
	var montoActual_i = parseFloat($('#text_monto').val());
	//var abonoActual = parseFloat($('#text_adelanto').val());

	// Verificar si el valor actual es un número válido
	if (!isNaN(montoActual_i)) {
		var nuevoMonto = montoActual_i - montoEliminar_i;
		// var nuevoAbono = abonoActual - abonoEliminar;
		// var nuevoPendiente= nuevoMonto - nuevoAbono;
		$('#text_monto').val(nuevoMonto.toFixed(2));
		//$('#text_adelanto').val(nuevoAbono.toFixed(2));
		//$('#text_debe').val(nuevoPendiente.toFixed(2));
		calcularPendiente();
	} else {
		// En caso de que el valor actual no sea un número, manejarlo adecuadamente
		$('#text_monto').val(montoActual_i);
		//$('#text_adelanto').val(abonoActual);
		calcularPendiente();
		Swal.fire("Error", "No se pudo calcular el nuevo monto total.", "error");
	}
}


/********************************************************************
ABRIR MODAL EDITAR RECEPCION
********************************************************************/
$('#tabla_recepcion').on('click', '.test_re', function () {//class EDITAR tiene que ir en el boton
	var data = tbl_recepcion.row($(this).parents('tr')).data();//tama単o de escritorio
	if (tbl_recepcion.row(this).child.isShown()) {
		var data = tbl_recepcion.row(this).data();//para celular y usas el responsive datatable
	}
	//console.log(data[20]);
	$("#modal_test").modal({ backdrop: 'static', keyboard: false });
	$("#modal_test").modal('show');//abrimos el modal

	document.getElementById('text_idrece_test').value = data.rece_id;//id

	// ENCIENDE
	if (data.enciende === "Si") {
		$("#text_enciende_si").prop('checked', true);
	} else if (data.enciende === "No") {
		$("#text_enciende_no").prop('checked', true);
	}
	else {
		$("#text_enciende_si").prop('checked', false);
		$("#text_enciende_no").prop('checked', false);
	}

	// TACTIL
	if (data.tactil === "Si") {
		$("#text_tactil_si").prop('checked', true);

	} else if (data.tactil === "No") {
		$("#text_tactil_no").prop('checked', true);
	}
	else {
		$("#text_tactil_si").prop('checked', false);
		$("#text_tactil_no").prop('checked', false);
	}


	// IMAGEN
	if (data.imagen === "Si") {
		$("#text_img_si").prop('checked', true);

	} else if (data.imagen === "No") {
		$("#text_img_no").prop('checked', true);
	}
	else {
		$("#text_img_si").prop('checked', false);
		$("#text_img_no").prop('checked', false);
	}

	// VIBRACION
	if (data.vibra === "Si") {
		$("#text_vibra_si").prop('checked', true);

	} else if (data.vibra === "No") {
		$("#text_vibra_no").prop('checked', true);
	}
	else {
		$("#text_vibra_si").prop('checked', false);
		$("#text_vibra_no").prop('checked', false);
	}


	// COBERTURA
	if (data.cobertura === "Si") {
		$("#text_cober_si").prop('checked', true);
	} else if (data.cobertura === "No") {
		$("#text_cober_no").prop('checked', true);
	}
	else {
		$("#text_cober_si").prop('checked', false);
		$("#text_cober_no").prop('checked', false);
	}

	// sensor
	if (data.sensor === "Si") {
		$("#text_sensor_si").prop('checked', true);
	} else if (data.sensor === "No") {
		$("#text_sensor_no").prop('checked', true);
	}
	else {
		$("#text_sensor_si").prop('checked', false);
		$("#text_sensor_no").prop('checked', false);
	}

	// carga
	if (data.carga === "Si") {
		$("#text_carga_si").prop('checked', true);
	} else if (data.carga === "No") {
		$("#text_carga_no").prop('checked', true);
	}
	else {
		$("#text_carga_si").prop('checked', false);
		$("#text_carga_no").prop('checked', false);
	}

	// bluetoo
	if (data.bluetoo === "Si") {
		$("#text_blue_si").prop('checked', true);
	} else if (data.bluetoo === "No") {
		$("#text_blue_no").prop('checked', true);
	}
	else {
		$("#text_blue_si").prop('checked', false);
		$("#text_blue_no").prop('checked', false);
	}

	// wifi
	if (data.wifi === "Si") {
		$("#text_wifi_si").prop('checked', true);
	} else if (data.wifi === "No") {
		$("#text_wifi_no").prop('checked', true);
	}
	else {
		$("#text_wifi_si").prop('checked', false);
		$("#text_wifi_no").prop('checked', false);
	}

	// huella
	if (data.huella === "Si") {
		$("#text_huella_si").prop('checked', true);
	} else if (data.huella === "No") {
		$("#text_huella_no").prop('checked', true);
	}
	else {
		$("#text_huella_si").prop('checked', false);
		$("#text_huella_no").prop('checked', false);
	}


	// home
	if (data.home === "Si") {
		$("#text_home_si").prop('checked', true);
	} else if (data.home === "No") {
		$("#text_home_no").prop('checked', true);
	}
	else {
		$("#text_home_si").prop('checked', false);
		$("#text_home_no").prop('checked', false);
	}

	// lateral
	if (data.lateral === "Si") {
		$("#text_lateral_si").prop('checked', true);
	} else if (data.lateral === "No") {
		$("#text_lateral_no").prop('checked', true);
	}
	else {
		$("#text_lateral_si").prop('checked', false);
		$("#text_lateral_no").prop('checked', false);
	}

	// camara
	if (data.camara === "Si") {
		$("#text_camara_si").prop('checked', true);
	} else if (data.camara === "No") {
		$("#text_camara_no").prop('checked', true);
	}
	else {
		$("#text_camara_si").prop('checked', false);
		$("#text_camara_no").prop('checked', false);
	}

	// bateria
	if (data.bateria === "Si") {
		$("#text_bateria_si").prop('checked', true);
	} else if (data.bateria === "No") {
		$("#text_bateria_no").prop('checked', true);
	}
	else {
		$("#text_bateria_si").prop('checked', false);
		$("#text_bateria_no").prop('checked', false);
	}

	// auricular
	if (data.auricular === "Si") {
		$("#text_auricu_si").prop('checked', true);
	} else if (data.auricular === "No") {
		$("#text_auricu_no").prop('checked', true);
	}
	else {
		$("#text_auricu_si").prop('checked', false);
		$("#text_auricu_no").prop('checked', false);
	}

	// micro
	if (data.micro === "Si") {
		$("#text_microfo_si").prop('checked', true);
	} else if (data.micro === "No") {
		$("#text_microfo_no").prop('checked', true);
	}
	else {
		$("#text_microfo_si").prop('checked', false);
		$("#text_microfo_no").prop('checked', false);
	}

	// face
	if (data.face === "Si") {
		$("#text_face_si").prop('checked', true);
	} else if (data.face === "No") {
		$("#text_face_no").prop('checked', true);
	}
	else {
		$("#text_face_si").prop('checked', false);
		$("#text_face_no").prop('checked', false);
	}

	// tornillo
	if (data.tornillo === "Si") {
		$("#text_torni_si").prop('checked', true);
	} else if (data.tornillo === "No") {
		$("#text_torni_no").prop('checked', true);
	}
	else {
		$("#text_torni_si").prop('checked', false);
		$("#text_torni_no").prop('checked', false);
	}






});




/********************************************************************
		   REGISTRAR TEST
********************************************************************/
function RegistrarTest() {
	let idrece_test  = document.getElementById('text_idrece_test').value;

	let enciende = "";
	let tactil  = "";
	let imagen  = "";
	let vibra  = "";
	let cobertura  = "";
	let sensor  = "";
	let carga  = "";
	let bluetoo  = "";
	let wifi  = "";
	let huella  = "";
	let home  = "";
	let lateral  = "";
	let camara  = "";
	let bateria  = "";
	let auricular  = "";
	let micro  = "";
	let face  = "";
	let tornillo  = "";

	// enciende
	if ($("#text_enciende_si").is(':checked')) {
		 enciende = document.getElementById('text_enciende_si').value;
	} else if ($("#text_enciende_no").is(':checked')) {
		enciende = document.getElementById('text_enciende_no').value;	
	}  else {
		enciende =  "";
	}


	// tactil
	if ($("#text_tactil_si").is(':checked')) {
		tactil = document.getElementById('text_tactil_si').value;
	} else  if ($("#text_tactil_no").is(':checked')) {
		tactil = document.getElementById('text_tactil_no').value;
	} else {
		tactil = "";
	}

	// imagen
	if ($("#text_img_si").is(':checked')) {
		imagen = document.getElementById('text_img_si').value;
	} else  if ($("#text_img_no").is(':checked')) {
		imagen = document.getElementById('text_img_no').value;
	} else {
		imagen = "";
	}

	// vibracion
	if ($("#text_vibra_si").is(':checked')) {
		vibra = document.getElementById('text_vibra_si').value;
	} else  if ($("#text_vibra_no").is(':checked')) {
		vibra = document.getElementById('text_vibra_no').value;
	} else {
		vibra = "";
	}

	// cobertura
	if ($("#text_cober_si").is(':checked')) {
		cobertura = document.getElementById('text_cober_si').value;
	} else  if ($("#text_cober_no").is(':checked')) {
		cobertura = document.getElementById('text_cober_no').value;
	} else {
		cobertura = "";
	}

	// sensor
	if ($("#text_sensor_si").is(':checked')) {
		sensor = document.getElementById('text_sensor_si').value;
	} else  if ($("#text_sensor_no").is(':checked')) {
		sensor = document.getElementById('text_sensor_no').value;
	} else {
		sensor = "";
	}

	// carga
	if ($("#text_carga_si").is(':checked')) {
		carga = document.getElementById('text_carga_si').value;
	} else  if ($("#text_carga_no").is(':checked')) {
		carga = document.getElementById('text_carga_no').value;
	} else {
		carga = "";
	}

	// bluetoo
	if ($("#text_blue_si").is(':checked')) {
		bluetoo = document.getElementById('text_blue_si').value;
	} else  if ($("#text_blue_no").is(':checked')) {
		bluetoo = document.getElementById('text_blue_no').value;
	} else {
		bluetoo = "";
	}

	// wifi
	if ($("#text_wifi_si").is(':checked')) {
		wifi = document.getElementById('text_wifi_si').value;
	} else  if ($("#text_wifi_no").is(':checked')) {
		wifi = document.getElementById('text_wifi_no').value;
	} else {
		wifi = "";
	}

	// huella
	if ($("#text_huella_si").is(':checked')) {
		huella = document.getElementById('text_huella_si').value;
	} else  if ($("#text_huella_no").is(':checked')) {
		huella = document.getElementById('text_huella_no').value;
	} else {
		huella = "";
	}

	// home
	if ($("#text_home_si").is(':checked')) {
		home = document.getElementById('text_home_si').value;
	} else  if ($("#text_home_no").is(':checked')) {
		home = document.getElementById('text_home_no').value;
	} else {
		home = "";
	}

	// lateral
	if ($("#text_lateral_si").is(':checked')) {
		lateral = document.getElementById('text_lateral_si').value;
	} else  if ($("#text_lateral_no").is(':checked')) {
		lateral = document.getElementById('text_lateral_no').value;
	} else {
		lateral = "";
	}

	// camara
	if ($("#text_camara_si").is(':checked')) {
		camara = document.getElementById('text_camara_si').value;
	} else  if ($("#text_camara_no").is(':checked')) {
		camara = document.getElementById('text_camara_no').value;
	} else {
		camara = "";
	}

	// bateria
	if ($("#text_bateria_si").is(':checked')) {
		bateria = document.getElementById('text_bateria_si').value;
	} else  if ($("#text_bateria_no").is(':checked')) {
		bateria = document.getElementById('text_bateria_no').value;
	} else {
		bateria = "";
	}

	// auricular
	if ($("#text_auricu_si").is(':checked')) {
		auricular = document.getElementById('text_auricu_si').value;
	} else  if ($("#text_auricu_no").is(':checked')) {
		auricular = document.getElementById('text_auricu_no').value;
	} else {
		auricular = "";
	}

	// micro
	if ($("#text_microfo_si").is(':checked')) {
		micro = document.getElementById('text_microfo_si').value;
	} else  if ($("#text_microfo_no").is(':checked')) {
		micro = document.getElementById('text_microfo_no').value;
	} else {
		micro = "";
	}

	// face
	if ($("#text_face_si").is(':checked')) {
		face = document.getElementById('text_face_si').value;
	} else  if ($("#text_face_no").is(':checked')) {
		face = document.getElementById('text_face_no').value;
	} else {
		face = "";
	}

	// tornillo
	if ($("#text_torni_si").is(':checked')) {
		tornillo = document.getElementById('text_torni_si').value;
	} else  if ($("#text_torni_no").is(':checked')) {
		tornillo = document.getElementById('text_torni_no').value;
	} else {
		tornillo = "";
	}


	// capturar foto test
	let foto_test = document.getElementById('text_foto_test').value;
	let extension = foto_test.split('.').pop();
	let nombrefoto_test = "";
	let f = new Date();
	if (foto_test.length > 0) {
		nombrefoto_test = "TEST_" + f.getDate() + "" + (f.getMonth() + 1) + "" + f.getFullYear() + "" + f.getHours() + "" + f.getMilliseconds() + "." + extension;
	}

	let formData = new FormData();
	let fotoObject = $("#text_foto_test")[0].files[0];

	formData.append('idrece_test', idrece_test);
	formData.append('enciende', enciende);
	formData.append('tactil', tactil);
	formData.append('imagen', imagen);
	formData.append('vibra', vibra);
	formData.append('cobertura', cobertura);
	formData.append('sensor', sensor);
	formData.append('carga', carga);
	formData.append('bluetoo', bluetoo);
	formData.append('wifi', wifi);
	formData.append('huella', huella);
	formData.append('home', home);
	formData.append('lateral', lateral);
	formData.append('camara', camara);
	formData.append('bateria', bateria);
	formData.append('auricular', auricular);
	formData.append('micro', micro);
	formData.append('face', face);
	formData.append('tornillo', tornillo);
	formData.append('nombrefoto_test', nombrefoto_test);
	formData.append('foto_test', fotoObject);

	$.ajax({
		url: '../controller/recepcion/controlador_registrar_test.php',
		type: 'POST',
		data: formData,
		contentType: false,
		processData: false,
		success: function (resp) {
			if (resp > 0 || resp == 1) {
				Swal.fire("Mensaje de Confirmacion", "Test Registrado", "success").then((value) => {
					$("#modal_test").modal('hide');
					tbl_recepcion.ajax.reload(); //recargar dataTable
					// Limpiar campos de foto
					document.getElementById('text_foto_test').value = "";
					$('#text_foto_test').next('.custom-file-label').html('Elegir archivo...');
					$('#pre_imagen_test').html('');
				});
			} else {
				let msg = "No se puede registrar el Test.";
				if (resp.message) {
					msg += " " + resp.message;
				} else if (typeof resp === 'string') {
					msg += " " + resp;
				}
				Swal.fire("Mensaje de Error", msg, "error");
			}
		}
	});
}



/**********************************************************************
		LISTAR ESTADO DE LA CAJA Y VALIDAR PARA HACER UNA RECEPCION
***********************************************************************/

function recalculo_montos() {
	let idrece_calculo = document.getElementById('idrecepcion').value;

	$.ajax({
		url: '../controller/recepcion/controlador_traer_montos_recepcion.php',
		type: 'POST',
		data: {
			idrece_calculo: idrece_calculo,
			
		}

	}).done(function (resp) {
		//console.log("1",resp);
		let data = JSON.parse(resp); //POSICION DE LA FILA Y COLUMNA
		
		//	console.log("2",data);
			//enviamos el estado de la caja al label
			document.getElementById('text_monto_editar').value = data[0][4];
			document.getElementById('text_adelanto_editar').value = data[0][1];
			document.getElementById('text_debe_editar').value = data[0][2];

	})
}



function monto_final_recepmasservicio() {
	let idrece_calculo = document.getElementById('idrecepcion_ver').value;

	$.ajax({
		url: '../controller/recepcion/controlador_traer_montos_recepcion.php',
		type: 'POST',
		data: {
			idrece_calculo: idrece_calculo,
			
		}

	}).done(function (resp) {
		//console.log("1",resp);
		let data = JSON.parse(resp); //POSICION DE LA FILA Y COLUMNA
		
		//	console.log("2",data);
			//enviamos el estado de la caja al label
			
			document.getElementById('text_monto_final_rec').value = data[0][4];


	})
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
			// {"defaultContent": "<center>"+"<span class='cambiar_monto_equipo text-info px-1' style='cursor:pointer;' data-bs-toggle='tooltip' data-bs-placement='top' title='Quitar de la recepcion'><i class= 'fas fa-pen-square'></i></span> "+"</center>"}


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
		  REPORTE BUSCAR POR CLIENTE LAS RECEPCIONES
********************************************************************/
var tbl_buscar_recep_cliente;
function Ver_recepciones_cliente(idcli) {//enviarlo al scrip en MANTENIMIENTO ROL
	tbl_buscar_recep_cliente = $("#tabla_buscar_recep_cli").DataTable({
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
			"url": "../controller/recepcion/controlador_buscar_recep_cliente.php",
			type: 'POST',
			data: {
				idcli: idcli
			}
		},
		"columns": [
			//todos los datos del procedimiento almacenado
			{ "data": "rece" },
			{ "data": "cliente_nombres" },
			{ "data": "rece_concepto" },
			{ "data": "rece_monto" },
			{ "data": "rece_fregistro" },
			{ "data": "motivo" },
			{ "data": "rece_estado" },
			{ "data": "diagnostico_tecnico" },
			{ "data": "fechaentrega" },
			{ "data": "equiporevision" },
			{ "data": "falla" },
			{ "data": "diagnostico" },
			{ "data": "nombre_su" },
        
			
		//	{"defaultContent": "<center>"+"<span class='elimar_ins text-danger px-2' style='cursor:pointer;' data-bs-toggle='tooltip' data-bs-placement='top' title='agregar disgnostico'><i class= 'fa fa-trash-alt'></i></span> "+"</center>"}


		],
		"language": idioma_espanol,
		select: true
	});

}


/********************************************************************
	  CARGAR CLIENTES EN COMBO
********************************************************************/
function cargar_SelectCliente_buscar() {//enviamos al scrpit mantenimiento examen
	let sucurid = document.getElementById('text_idsucurs').value;
	$.ajax({
		url: '../controller/recepcion/controlador_cargar_select_cliente.php',
		type: 'POST',
		data: {
				sucurid: sucurid	
			}
	}).done(function (resp) {
		let data = JSON.parse(resp);//POSICION DE LA FILA Y COLUMNA
		let llenardata = "<option value=''>Seleccione</option>";
		if (data.length > 0) {
			for (let i = 0; i < data.length; i++) {
				llenardata += "<option value='" + data[i][0] + "'>" + data[i][1] + "</option>";
			}
			document.getElementById('select_cliente').innerHTML = llenardata;//primero para registrar luego en modificar colocamos el select editar
			//document.getElementById('select_cliente_editar').innerHTML = llenardata;
		} else {
			llenardata += "<option value=''>No se encontraron datos</option>";
			document.getElementById('select_cliente').innerHTML = llenardata;
		//	document.getElementById('select_cliente_editar').innerHTML = llenardata;

		}
	})
}









/*===================================================================*/
//EVENTO PARA DETECTAR SI EL CLIENTE ESTA EN LISTA NEGRA
/*===================================================================*/
$('#select_cliente').on('select2:select', function (e) {
    let data = e.params.data;
    let listanegra = $(data.element).data('listanegra');
    if(listanegra == 'Si'){
        $('#alerta_listanegra').show();
        Swal.fire("Advertencia", "El cliente está en lista negra. Revisar antecedentes.", "warning");
    } else {
        $('#alerta_listanegra').hide();
    }
});

// Actualizar label del input file al elegir archivo
$(document).on('change', '#text_foto_test', function() {
    var fileName = $(this).val().split('\\').pop();
    if(fileName){
        $(this).next('.custom-file-label').addClass("selected").html(fileName);
    } else {
        $(this).next('.custom-file-label').removeClass("selected").html('Elegir archivo...');
    }
});

// Evento para ver la foto del test
$('#tabla_recepcion').on('click', '.ver_foto_test', function () {
    var data = tbl_recepcion.row($(this).parents('tr')).data();
    if (tbl_recepcion.row(this).child.isShown()) {
        var data = tbl_recepcion.row(this).data();
    }
    
    if (data.rece_foto2 && data.rece_foto2 != "") {
        window.open("../" + data.rece_foto2, '_blank');
    } else {
        Swal.fire("Mensaje de Advertencia", "No hay foto registrada para este test", "warning");
    }
});
