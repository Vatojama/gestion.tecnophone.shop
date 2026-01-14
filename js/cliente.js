 /********************************************************************
 		LISTAR CLIENTE CON METODO NORMAL
 ********************************************************************/

var tbl_cliente;
 function Listar_Cliente(){//enviarlo al scrip en MANTENIMIENTO CLIENTE
	let sucurid = document.getElementById('text_idsucurs').value;
	let rolid = document.getElementById('text_idrol').value;
	tbl_cliente = $("#tabla_cliente").DataTable({
		"responsive" :true,
		"ordering" :false,
		"bLengthChange" : true,
		"searching" : {"regex" : false},
		"lengthMenu" : [[10, 25, 50, 100, -1],[10, 25, 50, 100, "All"]],
		"pageLength" : 10,
		"dom": 'Blfrtip',
		"buttons":[
			{
		       "extend":    'excelHtml5',
		       "text":      '<i class="fa fa-file-excel"></i>',
		       "titleAttr": 'Exportar a Excel'
		    },

		],
		"destroy" :true,
		"async" : false,
		"processing": true,	

		"ajax" : {
			"url": "../controller/cliente/controlador_cliente_listar.php",
			type: 'POST',
			data: {
				sucurid: sucurid,
				rolid:rolid
				
			}
		},

		
		"columns":[
		//todos los datos del procedimiento almacenado
		{"defaultContent": ""},//cintador 
		{"data": "cliente_nombres"},
		{"data": "cliente_direccion"},	
		{"data": "cliente_dni"},
		{"data": "cliente_celular"},
		{"data": "nombre_su"},
		{"data": "cliente_listanegra",
			render: function(data,type,row){
				if (data==="Si") {
					return "<center>"+'<span class="badge badge-danger">Si</span>';+"</center>"
				}else{
					return "<center>"+'<span class="badge badge-info">No</span>';+"</center>"
				}
			}
		},

		{"data": "cliente_estado",
			render: function(data,type,row){
				if (data==="ACTIVO") {
					return "<center>"+'<span class="badge badge-success">ACTIVO</span>';+"</center>"
				}else{
					return "<center>"+'<span class="badge badge-danger">INACTIVO</span>';+"</center>"
				}
			}
		},
		{"defaultContent": "<center>"+"<span class=' editar text-primary px-1' style='cursor:pointer;' title='Editar datos'><i class='fa fa-edit'></i></span>"+"</center>"}


		],
		"language":idioma_espanol,
		select:true
	});
	//contador en cada tabla
	tbl_cliente.on('draw.td',function(){
		var PageInfo = $("#tabla_cliente").DataTable().page.info();
		tbl_cliente.column(0,{page: 'current'}).nodes().each(function(cell,i){
			cell.innerHTML = i + 1 + PageInfo.start;
		});
	});
 }


  function Listar_proveedor(){//enviarlo al scrip en MANTENIMIENTO CLIENTE
	let sucurid = document.getElementById('text_idsucurs').value;
	let rolid = document.getElementById('text_idrol').value;
	tbl_cliente = $("#tabla_cliente").DataTable({
		"responsive" :true,
		"ordering" :false,
		"bLengthChange" : true,
		"searching" : {"regex" : false},
		"lengthMenu" : [[10, 25, 50, 100, -1],[10, 25, 50, 100, "All"]],
		"pageLength" : 10,
		"dom": 'Blfrtip',
		"buttons":[
			{
		       "extend":    'excelHtml5',
		       "text":      '<i class="fa fa-file-excel"></i>',
		       "titleAttr": 'Exportar a Excel'
		    },

		],
		"destroy" :true,
		"async" : false,
		"processing": true,	

		"ajax" : {
			"url": "../controller/cliente/controlador_proveedor_listar.php",
			type: 'POST',
			data: {
				sucurid: sucurid,
				rolid:rolid
				
			}
		},

		
		"columns":[
		//todos los datos del procedimiento almacenado
		{"defaultContent": ""},//cintador 
		{"data": "cliente_nombres"},
		{"data": "cliente_direccion"},	
		{"data": "cliente_dni"},
		{"data": "cliente_celular"},
		{"data": "nombre_su"},
		{"data": "cliente_listanegra",
			render: function(data,type,row){
				if (data==="Si") {
					return "<center>"+'<span class="badge badge-danger">Si</span>';+"</center>"
				}else{
					return "<center>"+'<span class="badge badge-info">No</span>';+"</center>"
				}
			}
		},
		{"data": "cliente_estado",
			render: function(data,type,row){
				if (data==="ACTIVO") {
					return "<center>"+'<span class="badge badge-success">ACTIVO</span>';+"</center>"
				}else{
					return "<center>"+'<span class="badge badge-danger">INACTIVO</span>';+"</center>"
				}
			}
		},
		{"defaultContent": "<center>"+"<span class=' editar text-primary px-1' style='cursor:pointer;' title='Editar datos'><i class='fa fa-edit'></i></span><span class='ver_compras text-success px-1' style='cursor:pointer;' title=Ver Compras'><i class='fa fa-eye'></i></span>"+"</center>"}


		],
		"language":idioma_espanol,
		select:true
	});
	//contador en cada tabla
	tbl_cliente.on('draw.td',function(){
		var PageInfo = $("#tabla_cliente").DataTable().page.info();
		tbl_cliente.column(0,{page: 'current'}).nodes().each(function(cell,i){
			cell.innerHTML = i + 1 + PageInfo.start;
		});
	});
 }


 /********************************************************************
		  VER DETALLE DE COMPRAR POR PROVEEDOR
********************************************************************/
$('#tabla_cliente').on('click', '.ver_compras', function () { //id enviar( en el boton)
	var data = tbl_cliente.row($(this).parents('tr')).data();//tamaño de escritorio
	if (tbl_cliente.row(this).child.isShown()) {
		var data = tbl_cliente.row(this).data();//para celular y usas el responsive datatable
	}

	//console.log(data);
		$("#modal_compras_prove").modal({ backdrop: 'static', keyboard: false });
		$("#modal_compras_prove").modal('show');//abrimos el modal*/
		document.getElementById('idproveedor').value = data.cliente_id;

});


/**********************************************************************
			  EDITAR	DETALLE PRODUCTOS
***********************************************************************/

var tbl_ver_detalle_compras;
function Ver_detalle_compras(idprovee) {//enviarlo al scrip en MANTENIMIENTO ROL
	var finicio = document.getElementById('text_finicio').value;
	var ffin = document.getElementById('text_ffin').value;
	tbl_ver_detalle_compras = $("#tabla_compras_prove").DataTable({
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
			url: "../controller/cliente/controlador_ver_detalle_compras.php",
			type: 'POST',
			data: {
				idprovee: idprovee,
				finicio:finicio,
				ffin:ffin
			}
		},
		 dom: "lrtip",
    // "buttons": [
    // 	{
    // 		"extend": 'excelHtml5',
    // 		"title": 'Reporte Productos',
    // 		"exportOptions": {
    // 			'columns': [0, 1, 2, 3, 4, 5, 6, 7]
    // 		},
    // 		"text": '<i class="fa fa-file-excel"></i>',
    // 		"titleAttr": 'Exportar a Excel'
    // 	},
    // ],
		columns: [
			//todos los datos del procedimiento almacenado
			{ data: "producto_codigo" },
			{ data: "producto_nombre" },
			{ data: "producto_pcompra" },
			{ data: "producto_pventa" },
			{ data: "producto_fregistro" },
			{ data: "producto_stock_inicial" },

			// {"defaultContent": "<center>"+"<span class=' editar text-primary px-1' style='cursor:pointer;' data-bs-toggle='tooltip' data-bs-placement='top' title='Editar'><i class= 'fa fa-edit'></i></span> "+"</center>"}


		],
		language: idioma_espanol,
		select: true
	});

}



 /********************************************************************
 		ABRIR MODAL REGISTRAR CLIENTE
 ********************************************************************/
 function AbrirModalRegistroCliente(){
 	//para que no se nos salga del modal haciendo click a los costados
 	$("#modal_registro_cliente").modal({backdrop:'static', keyboard: false});	
 	$("#modal_registro_cliente").modal('show');//abrimos el modal

 	LimpiarModalCliente();//limpiar texbox cada que demos en nuevo
	document.getElementById('chkListanegra').checked = false;
 	$('.form-control').removeClass("is-invalid").removeClass("is-valid");//remover las clases
 }





 /********************************************************************
 		ABRIR MODAL EDITAR CLIENTE
 ********************************************************************/
 $('#tabla_cliente').on('click', '.editar', function() {//class foto tiene que ir en el boton
	var data = tbl_cliente.row($(this).parents('tr')).data();//tamaño de escritorio
	if (tbl_cliente.row(this).child.isShown()) {
		var data = tbl_cliente.row(this).data();//para celular y usas el responsive datatable
	}
	
		$("#modal_editar_cliente").modal({backdrop:'static', keyboard: false});	
		$("#modal_editar_cliente").modal('show');//abrimos el modal
		//LimpiarModalUsuario();
		//mandamos parametros a los texbox
		//document.getElementById('idrol').value=data[0];
		document.getElementById('idcliente').value=data.cliente_id;//id del procedure
		document.getElementById('text_nombre_editar').value=data.cliente_nombres;
		document.getElementById('text_dni_editar').value=data.cliente_dni;
		document.getElementById('text_celular_editar').value=data.cliente_celular;//enviamos el nombre del usu al modal
		document.getElementById('text_direccion_editar').value=data.cliente_direccion;
		document.getElementById('text_ape_p_editar').value=data.cliente_ape_p;
		document.getElementById('text_ape_m_editar').value=data.cliente_ape_m; 
		document.getElementById('text_correo_editar').value=data.cliente_correo; 
		//console.log(data.rol_id);//para enviar el dato  en console
		$("#select_estado_cliente_editar").select2().val(data.cliente_estado).trigger('change.select2');
		$("#select_tipo_doc_editar").select2().val(data.cliente_tipo_doc).trigger('change.select2');
		if (data.cliente_listanegra == "Si") {
			document.getElementById('chkListanegra_editar').checked = true;
		} else {
			document.getElementById('chkListanegra_editar').checked = false;
		}
 });






 /********************************************************************
 		VALIDAR TEXBOX CLIENTE
 ********************************************************************/
 function ValidarCamposCliente(nombre,dni,celular, tipo_doc){
 	Boolean(document.getElementById(nombre).value.length>0) ? $("#"+nombre).removeClass("is-invalid").addClass("is-valid") : $("#"+nombre).removeClass("is-valid").addClass("is-invalid");
 	Boolean(document.getElementById(dni).value.length>0) ? $("#"+dni).removeClass("is-invalid").addClass("is-valid") : $("#"+dni).removeClass("is-valid").addClass("is-invalid");
 	Boolean(document.getElementById(celular).value.length>0) ? $("#"+celular).removeClass("is-invalid").addClass("is-valid") : $("#"+celular).removeClass("is-valid").addClass("is-invalid");
	Boolean(document.getElementById(tipo_doc).value.length>0) ? $("#"+tipo_doc).removeClass("is-invalid").addClass("is-valid") : $("#"+tipo_doc).removeClass("is-valid").addClass("is-invalid");
 }





 /********************************************************************
 		LIMPIAR TEXBOX CLIENTE
 ********************************************************************/
 function LimpiarModalCliente(){
	document.getElementById('text_nombre').value="";
	document.getElementById('text_dni').value="";
	document.getElementById('text_celular').value="";
	document.getElementById('text_direccion').value="";
	document.getElementById('text_ape_p').value="";
	document.getElementById('text_ape_m').value="";
	document.getElementById('text_correo').value="";
	// document.getElementById('select_tipo_doc').value="";
 }







 /********************************************************************
 		REGISTRAR CLIENTE
 ********************************************************************/
 function RegistrarCliente(){
	console.log("Iniciando RegistrarCliente...");
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

	console.log("Datos capturados:", {nombre, dni, cel, direccion, sucurid});

 	if (nombre.length ==0 || dni.length ==0 || cel.length ==0  ) {
 		ValidarCamposCliente("text_nombre","text_dni","text_celular", "select_tipo_doc");
 		return Swal.fire("Mensaje de Advertencia","Tiene campos vacios","warning");
 	}
 
	$.ajax({
 		url:'../controller/cliente/controlador_cliente_registar.php',
 		type: 'POST',
 		data:{
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
}

 	}).done(function(resp){
		console.log("Respuesta recibida:", resp);
 		if (resp>0) {
 			if (resp==1) {//validamos la respuesta del procedure si retorna 1 o 2
 				Swal.fire("Mensaje de Confirmacion","Cliente Registrado","success").then((value)=>{
	 					
	 					$("#modal_registro_cliente").modal('hide');//abrimos el modal

	 					tbl_cliente.ajax.reload();//recargar dataTable
	 					//TraerNotificaciones();
	 				});	
 			}else{
 				Swal.fire("Mensaje de Advertencia","El Cliente ya se encuentra registrado","warning");
 			}
	 				 			
	 		}else{
	 			Swal.fire("Mensaje de Error","No se puede registrar el Cliente. Detalle: " + resp,"error");
	 		}
 	}).fail(function(jqXHR, textStatus, errorThrown){
		console.error("Error en Ajax:", textStatus, errorThrown);
		Swal.fire("Error de Red", "No se pudo conectar con el servidor: " + textStatus, "error");
	});
 }







 /********************************************************************
 		MODIFICAR CLIENTE
 ********************************************************************/
 function ModificarCliente(){//enviamos los datos del ajax al controlador y al onclick del boton editar
 	let id = document.getElementById('idcliente').value;
 	let nombre = document.getElementById('text_nombre_editar').value;
 	let dni = document.getElementById('text_dni_editar').value;
 	let cel = document.getElementById('text_celular_editar').value;
 	let estado = document.getElementById('select_estado_cliente_editar').value;
 	let direccion = document.getElementById('text_direccion_editar').value;
	let apellidop = document.getElementById('text_ape_p_editar').value;
	let apellidom = document.getElementById('text_ape_m_editar').value;
	let correo = document.getElementById('text_correo_editar').value;
	let tipo_doc = document.getElementById('select_tipo_doc_editar').value;
	let listanegra = document.getElementById('chkListanegra_editar').checked ? "Si" : "No";

 	if (nombre.length ==0 || dni.length ==0 || cel.length ==0  ) {
 		ValidarCamposCliente("text_nombre_editar","text_dni_editar","text_celular_editar");
 		return Swal.fire("Mensaje de Advertencia","Tiene campos vacios","warning");
 	}

 	$.ajax({
 		url:'../controller/cliente/controlador_modificar_cliente.php',
 		type: 'POST',
 		data:{
 			id: id,//le enviamos los campos al controlador
 			nombre: nombre,
 			dni: dni,
 			cel: cel,			
 			estado: estado,
 			direccion: direccion,
			apellidop:apellidop,
			apellidom:apellidom,
			correo:correo,
			tipo_doc:tipo_doc,
			listanegra:listanegra	
 		}
 	}).done(function(resp){
 	 	if (resp>0) {
 			if (resp==1) {//validamos la respuesta del procedure si retorna 1 o 2
 					//ValidarCamposCliente("text_nombre_editar","text_dni_editar","text_celular_editar");
	 				LimpiarModalCliente();
 				Swal.fire("Mensaje de Confirmacion","Cliente Actualizado","success").then((value)=>{					
	 					$("#modal_editar_cliente").modal('hide');//abrimos el modal
	 					tbl_cliente.ajax.reload();//recargar dataTable
	 					//TraerNotificaciones();
	 				});	
 			}else{
 				Swal.fire("Mensaje de Advertencia","El Cliente ya se encuentra registrado","warning");

 			}
	 				 			
	 		}else{
	 			Swal.fire("Mensaje de Error","No se puede registrar el Cliente","error");
	 		}
 	})
 }






