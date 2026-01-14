/********************************************************************
		   LISTAR TRASLADOS EN LA TABLA
********************************************************************/
var tbl_traslados;
function Listar_Traslados() {
  tbl_traslados = $("#tabla_traslado").DataTable({
    responsive: true,
    ordering: false,
    bLengthChange: true,
    searching: { regex: false },
    lengthMenu: [
      [10, 25, 50, 100, -1],
      [10, 25, 50, 100, "All"],
    ],
    pageLength: 10,
    destroy: true,
    async: false,
    processing: true,
    ajax: {
      url: "../controller/traslados/Listar_Traslados.php",
      type: "POST",
    },
    dom: "lfrtip",
    "buttons": [
    	{
    		"extend": 'excelHtml5',
    		"title": 'Listado de traslados',
    		"exportOptions": {
    			'columns': [0, 1]
    		},
    		"text": '<i class="fa fa-file-excel"></i>',
    		"titleAttr": 'Exportar a Excel'
    	},
    ],
    columns: [
	  { data: "id_traslado" },
      { data: "almacenorigen" },
      { data: "almacendestino" },
      { data: "fecha_formateada" },
      { data: "usu_nombre" },
      
        {data: "estado",
			render: function(data,type,row){
				if (data==="Activo") {
					return "<span class='badge badge-success'>"+data+"</span>"
				}else{
					return "<span class='badge badge-danger'>"+data+"</span>"
				}
			}
		},
		{
				data: "estado",
				render: function (data, type, row) {
					if (data === "Activo" ) {
						return "<center>" +  "<span class='Editar_tr text-primary px-1' style='cursor:pointer;' title='Editar Traslado'><i class= 'fa fa-edit'></i></span>" +
          										"<span class='Anular_tr text-danger px-1' style='cursor:pointer;' title='Anular Traslado'><i class= 'fa fa-ban'></i></span>" + 
								"</center>"
					} else {
						return "<center>" +  "<span class='Editar_tr text-primary px-1' style='cursor:pointer;' title='Editar Traslado'><i class= 'fa fa-edit'></i></span>" +
          										"<span class=' text-secundary px-1' style='cursor:pointer;' ><i class= 'fa fa-ban'></i></span>" + 
								"</center>"
					}
				}
			},
    //   {

    //     defaultContent:
    //       "<center>" +
    //       "<span class='Editar_tr text-primary px-1' style='cursor:pointer;' title='Editar Traslado'><i class= 'fa fa-edit'></i></span>" +
    //       "<span class='Anular_tr text-danger px-1' style='cursor:pointer;' title='Anular Traslado'><i class= 'fa fa-ban'></i></span>" +
    //       "</center>",
    //   },
    ],
    language: idioma_espanol,
    select: true,
  });
}




 /**********************************************************************
 						 ABRIR MODAL REGISTRAR SUCURSALES
 ***********************************************************************/
 function AbrirModalRegistroTraslado(){
 	//para que no se nos salga del modal haciendo click a los costados
 	$("#modal_registrar_traslado").modal({backdrop:'static', keyboard: false});	
 	$("#modal_registrar_traslado").modal('show');//abrimos el modal
 	LimpiarModalTraslado();
  
 }


 function LimpiarModalTraslado() {
 	document.getElementById('text_descrip_tr').value = "";

 	$("#select_alm_des").select2().val("").trigger('change.select2');
 	document.getElementById('id_traslado').value = "";

 }  



  //LISTAR ALMACENES EN EL COMBO
 function Listar_Almacenes_Origen_OLD() {

  	$.ajax({
      url: "../controller/sucursales/Listar_select_almacen_origen.php",
      type: "POST",
    }).done(function (resp) {
      let data = JSON.parse(resp); //POSICION DE LA FILA Y COLUMNA
      let llenardata = "<option value=''>Seleccione</option>";
      if (data.length > 0) {
        for (let i = 0; i < data.length; i++) {
          llenardata +=
            "<option value='" + data[i][0] + "'>" + data[i][1] + "</option>";
        }
        document.getElementById("select_alm_ori").innerHTML = llenardata;
      //  document.getElementById("select_alm_des_editar").innerHTML = llenardata;
      } else {
        llenardata += "<option value=''>No se encontraron datos</option>";
        document.getElementById("select_alm_ori").innerHTML = llenardata;
      //  document.getElementById("select_alm_des_editar").innerHTML = llenardata;
      }
    });  
 }

 function Listar_Almacenes_Origen() {
	$.ajax({
		 url: "../controller/sucursales/Listar_select_almacen_origen.php",
		type: 'POST'
	}).done(function (resp) {
		let data = JSON.parse(resp);
		let llenardata = "<option value=''>Seleccione</option>";
		if (data.length > 0) {
			for (let i = 0; i < data.length; i++) {
				llenardata += "<option value='" + data[i][0] + "'>" + data[i][1] + "</option>";
			}
		} else {
			llenardata += "<option value=''>No se encontraron datos</option>";
		}

		let select = $('#select_alm_ori');
		select.html(llenardata);

		// Destruye y vuelve a aplicar select2 correctamente
		if (select.hasClass("select2-hidden-accessible")) {
			select.select2('destroy');
		}

		select.select2({
			dropdownParent: $('#modal_registrar_traslado') // si estás dentro de modal, ajusta según tu HTML
		});
	});
}



 function Listar_Almacenes_destino() {
	$.ajax({
		 url: "../controller/sucursales/Listar_select_almacen_destino.php",
		type: 'POST'
	}).done(function (resp) {
		let data = JSON.parse(resp);
		let llenardata = "<option value=''>Seleccione</option>";
		if (data.length > 0) {
			for (let i = 0; i < data.length; i++) {
				llenardata += "<option value='" + data[i][0] + "'>" + data[i][1] + "</option>";
			}
		} else {
			llenardata += "<option value=''>No se encontraron datos</option>";
		}

		let select = $('#select_alm_des');
		select.html(llenardata);

		// Destruye y vuelve a aplicar select2 correctamente
		if (select.hasClass("select2-hidden-accessible")) {
			select.select2('destroy');
		}

		select.select2({
			dropdownParent: $('#modal_registrar_traslado') // si estás dentro de modal, ajusta según tu HTML
		});
	});
}

 
 //LISTAR ALMACENES DE DESTINO EN EL COMBO
 function Listar_Almacenes_destino_OLD() {

  	$.ajax({
      url: "../controller/sucursales/Listar_select_almacen_destino.php",
      type: "POST",
    }).done(function (resp) {
      let data = JSON.parse(resp); //POSICION DE LA FILA Y COLUMNA
      let llenardata = "<option value=''>Seleccione</option>";
      if (data.length > 0) {
        for (let i = 0; i < data.length; i++) {
          llenardata +=
            "<option value='" + data[i][0] + "'>" + data[i][1] + "</option>";
        }
        document.getElementById("select_alm_des").innerHTML = llenardata;
       // document.getElementById("select_alm_des_editar").innerHTML = llenardata;
      } else {
        llenardata += "<option value=''>No se encontraron datos</option>";
        document.getElementById("select_alm_des").innerHTML = llenardata;
      //  document.getElementById("select_alm_des_editar").innerHTML = llenardata;
      }
    });

  
 }



 /********************************************************************
		   BOTON AGREGAR PRODUCTOS AL DETALLE 
********************************************************************/

function Agregar_Producto() {

	let idproducto = document.getElementById('select_producto').value;
  let productonombre = ($('#select_producto option:selected').text()).split(' |')[1];
	let precioproducto = document.getElementById('select_precio_prod').value;
	let cantidad = document.getElementById('text_canti_prod').value;
	let stock = document.getElementById('text_stock_prod').value;

	let operdescuent = 0;



	if (parseFloat(stock) < parseFloat(cantidad)) {
		return Swal.fire("El producto no tiene Stock suficiente", "Stock actual: " + stock + "  ", "warning");
	}

	if (idproducto.length == 0) {
		return Swal.fire("Mensaje de Advertencia", "Ingrese un Producto", "warning");
	}

	if (cantidad.length == 0) {
		return Swal.fire("Mensaje de Advertencia", "Ingrese una cantidad", "warning");
	}

	if (parseInt(cantidad) < 1) {
		return Swal.fire("Mensaje de Advertencia", "La cantidad debe ser mayor a 0", "warning");
	}

	if (parseInt(precioproducto) < 0.1) {
		return Swal.fire("Mensaje de Advertencia", "El precio debe ser mayor a 0", "warning");
	}

  //llamamos la funcion para verificar si ya esta agregado en el detalle
	if (verificarid(idproducto)) {
		return Swal.fire("Mensaje de Advertencia", "El Producto ya esta agregado, revisar", "warning");
	}

	

	let datos_agregar = "<tr>";
	datos_agregar += "<td for='id'>" + idproducto + "</td>";
	datos_agregar += "<td> " + productonombre + "</td>";
	datos_agregar += "<td>" + precioproducto + "</td>";
	datos_agregar += "<td>" + cantidad + "</td>";
	datos_agregar += "<td><button class='btn btn-danger btn-sm remove2'  ><i class ='fa fa-trash'></i> </button></td>";
	datos_agregar += "</tr>";

	$(".tbody_tabla_det_traslado").append(datos_agregar);
//LIMPIAR DATOS AL AGREGAR  
  $('#select_precio_prod').empty();
	//$("#select_producto").select2().val("").trigger('change.select2');
  $('#select_producto').val(null).trigger('change');
  document.getElementById('text_stock_prod').value="";
  document.getElementById('text_canti_prod').value="";

	// $("#ocult_imei_vent").attr('hidden', true);
}

/********************************************************************
		   REMOVER ITEM DEL DETALLE
********************************************************************/
function remove(t) {
	var td = t.parentNode;
	var tr = td.parentNode;
	var table = tr.parentNode;
	table.removeChild(tr);
	}

//REMOVER ITEM DEL DETALLE
$('.tbody_tabla_det_traslado').on('click', '.remove2', function () {//
	var data = tbl_traslados.row($(this).parents('tr')).data();//tamaño de escritorio
	if (tbl_traslados.row(this).child.isShown()) {
		var data = tbl_traslados.row(this).data();//para celular y usas el responsive datatable
	}
	Swal.fire({
		title: 'Desea remover el articulo? ',
		text: "",
		icon: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: 'Si, confirmar'
	}).then((result) => {
		if (result.isConfirmed) {
			remove(this);
		
		}
	})
});


function verificarid(id) {
	let idverificar = document.querySelectorAll('#tabla_traslado_detalle td[for="id"]');
	return [].filter.call(idverificar, td => td.textContent === id).length === 1;
}


/********************************************************************
		   REGISTRAR TRASLADO CABECERA
********************************************************************/
function Registrar_Traslado_cab() {
	let count = 0; //para validar que el detalle tenga un dato
	//recorremos la tabla
	$("#tabla_traslado_detalle  tbody.tbody_tabla_det_traslado tr ").each(function () {
		count++; //cuenta las filas 
	})
	//alert(count);

	//validamos con mensaje que tenga datos en el detalle
	if (count == 0) {
		return Swal.fire("Mensaje de Advertencia", "Debe agregar un Producto en el detalle", "warning");
	}

	let idalmacenorigen = document.getElementById('select_alm_ori').value;
	let idalmacendestino = document.getElementById('select_alm_des').value;
	let idusuario = document.getElementById('text_Idprincipal').value;//id_usuario esta en el index como text_Idprincipal
	let observacion = document.getElementById('text_descrip_tr').value;

	

	//valida que se seleccione un cliente o comprobante
	if (idalmacenorigen.length == 0) {
		return Swal.fire("Mensaje de Advertencia", "Debe seleccionar almacen Principal", "warning");
	}

	if (idalmacendestino.length == 0) {
		return Swal.fire("Mensaje de Advertencia", "Debe seleccionar un almacen de destino", "warning");
	}

	if (observacion == "") {
		return Swal.fire("Mensaje de Advertencia", "Debe ingresar una descripcion", "warning");
	}

	$.ajax({
		url: '../controller/traslados/Registrar_traslado_cabe.php',
		type: 'POST',
		data: {
			idalmacenorigen: idalmacenorigen,
			idalmacendestino: idalmacendestino,
     		 idusuario:idusuario,
			observacion: observacion
		}
	}).done(function (resp) {
    let data = JSON.parse(resp);
		//console.log(data.data);

    if (data.tipo_msj === "success") {
         // Swal.fire("Mensaje de Confirmación", data.msj, "success").then(() => {
            Registrar_Detalle_Traslado(parseInt(data.data));
			//tbl_traslados.ajax.reload();
         // });
      } else {
        Swal.fire("Mensaje de Error", data.msj, "error");
    }
	})
}




/********************************************************************
		   REGISTRAR DETALLE 
********************************************************************/
function Registrar_Detalle_Traslado(id) {
	let idalmacendestino = document.getElementById('select_alm_des').value;
	let idalmacenorigen = document.getElementById('select_alm_ori').value;
	let idusuario = document.getElementById('text_Idprincipal').value;

	let count = 0;
	let arreglo_producto = new Array();
  	let arreglo_precio = new Array();
	let arreglo_cantidad = new Array();
	
	let arreglo_imei = new Array();
	
	$("#tabla_traslado_detalle  tbody.tbody_tabla_det_traslado tr ").each(function () {
		arreglo_producto.push($(this).find('td').eq(0).text());
    	arreglo_precio.push($(this).find('td').eq(2).text());
		arreglo_cantidad.push($(this).find('td').eq(3).text());
	
		count++;
	})

	if (count == 0) {
		return Swal.fire("Mensaje de Advertencia", "Debe agregar un Producto en el detalle", "warning");
	}

	let producto = arreglo_producto.toString();
	let precio = arreglo_precio.toString();
	let cantidad = arreglo_cantidad.toString();
	console.log(producto);
	console.log(precio);
	console.log(cantidad);  
	
	$.ajax({
		url: '../controller/traslados/Registrar_detalle_traslado.php',
		type: 'POST',
		data: {
			id: id,
			producto: producto,
     		precio: precio,
			cantidad: cantidad,
			idalmacendestino:idalmacendestino,
			idalmacenorigen:idalmacenorigen,
			idusuario:idusuario
			
		}
	}).done(function (resp) {
		 let data = JSON.parse(resp);
		//console.log(data.data);

		 if (data.tipo_msj === "success") {
         	 Swal.fire("Mensaje de Confirmación", data.msj, "success").then(() => {
       		 $("#modal_registrar_traslado").modal('hide');
       		 tbl_traslados.ajax.reload();
       
      });

		} else {
			  Swal.fire("Mensaje de Error", data.msj,  data.tipo_msj);
		}
	})
}


/********************************************************************
						CLICK EN ANULAR VENTA - MENSAJE
********************************************************************/
$("#tabla_traslado").on("click", ".Editar_tr", function () {
  //campo activar tiene que ir en el boton
  var data = tbl_traslados.row($(this).parents("tr")).data(); //tamaño de escritorio
  if (tbl_traslados.row(this).child.isShown()) {
    var data = tbl_traslados.row(this).data(); //para celular y usas el responsive datatable
  }

  //rolA = document.getElementById('text_idrol').value; //CAPTURAMOS EL ROL PARA DAR EL ACCESO

  console.log(data);
  $("#modal_ver_traslado").modal({ backdrop: "static", keyboard: false });
  $("#modal_ver_traslado").modal("show"); //abrimos el modal*/

  document.getElementById("select_alm_ori_v").value = data.almacenorigen;
  document.getElementById("select_alm_des_v").value = data.almacendestino;
  document.getElementById("text_descrip_tr_v").value = data.glosa_t;

  Listar_Detalle_Traslados(data.id_traslado);
});




	/********************************************************************
		   LISTAR TRASLADOS EN LA TABLA
********************************************************************/
var tbl_traslados_ver_detalle;
function Listar_Detalle_Traslados(idtras) {
  tbl_traslados_ver_detalle = $("#tabla_traslado_detalle_v").DataTable({
    responsive: true,
    ordering: false,
    bLengthChange: true,
    searching: { regex: false },
    lengthMenu: [
      [10, 25, 50, 100, -1],
      [10, 25, 50, 100, "All"],
    ],
    pageLength: 10,
    destroy: true,
    async: false,
    processing: true,
    ajax: {
      url: "../controller/traslados/Listar_Detalle_Traslados.php",
      type: "POST",
	  data: {
				idtras: idtras
			}
    },
    dom: "lrtip",
    "buttons": [
    	{
    		"extend": 'excelHtml5',
    		"title": 'Listado de detalle de traslados',
    		"exportOptions": {
    			'columns': [0, 1,2,3]
    		},
    		"text": '<i class="fa fa-file-excel"></i>',
    		"titleAttr": 'Exportar a Excel'
    	},
    ],
    columns: [
      { data: "producto_nombre" },
      { data: "precio_v" },
      { data: "cantidad_t" },
     
      
        
    //   {
  
    //     defaultContent:
    //       "<center>" +
    //       "<span class='Editar_tr text-primary px-1' style='cursor:pointer;' title='Editar Traslado'><i class= 'fa fa-edit'></i></span>" +
    //       "<span class='Anular_tr text-danger px-1' style='cursor:pointer;' title='Anular Traslado'><i class= 'fa fa-ban'></i></span>" +
    //       "</center>",
    //   },
    ],
    language: idioma_espanol,
    select: true,
  });
}

/********************************************************************
						CLICK EN ANULAR VENTA - MENSAJE
********************************************************************/
$('#tabla_traslado').on('click', '.Anular_tr', function () {//campo activar tiene que ir en el boton
	var data = tbl_traslados.row($(this).parents('tr')).data();//tamaño de escritorio
	if (tbl_traslados.row(this).child.isShown()) {
		var data = tbl_traslados.row(this).data();//para celular y usas el responsive datatable
	}
	let idusuario = document.getElementById('text_Idprincipal').value;

	//rolA = document.getElementById('text_idrol').value; //CAPTURAMOS EL ROL PARA DAR EL ACCESO
	console.log(data);

	Swal.fire({
		title: 'Desea Anular el Traslado? ',
		text: "Retornara el stock de producto al almacen de origen",
		icon: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: 'Anular Traslado'
	}).then((result) => {

		if (result.isConfirmed) {
			Anular_Traslado(data.id_traslado, idusuario);
		}else {
		}

	})
});



/********************************************************************
	  FUNCION ANULAR LA VENTA Y REGRESAR STOCK A PRODUCTOS
********************************************************************/
function Anular_Traslado(traslado_id, usuario_id) {
	$.ajax({
		url: '../controller/traslados/Anular_Traslado.php',
		type: 'POST',
		data: {
			traslado_id: traslado_id,
			usuario_id: usuario_id

		}
	}).done(function (resp) {
		 let data = JSON.parse(resp);
		//console.log(data.data);

		if (data.tipo_msj === "success") {
         	 Swal.fire("Mensaje de Confirmación", data.msj, "success").then(() => {
       		// $("#modal_registrar_traslado").modal('hide');
       		 tbl_traslados.ajax.reload();
       
      });

		} else {
			  Swal.fire("Mensaje de Error", data.msj,  data.tipo_msj);
		}

		
	})
}









