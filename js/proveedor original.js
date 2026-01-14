 /********************************************************************
 		LISTAR PROVEEDOR CON METODO NORMAL
 ********************************************************************/

var tbl_proveedor;
 function Listar_Proveedor(){//enviarlo al scrip en MANTENIMIENTO PROVEEDOR
	tbl_proveedor = $("#tabla_proveedor").DataTable({
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
			"url": "../controller/proveedor/controlador_proveedor_listar.php",
			type: 'POST'
		},

		
		"columns":[
		//todos los datos del procedimiento almacenado
		//{"defaultContent": ""},//cintador 
		{"data": "prove_id"},
		{"data": "prove_ruc"},
		{"data": "prove_razon"},	
		{"data": "prove_direccion"},
		{"data": "prove_celular"},
		{"data": "prove_estado",
			render: function(data,type,row){
				if (data==="ACTIVO") {
					return "<center>"+'<span class="badge badge-success">ACTIVO</span>';+"</center>"
				}else{
					return "<center>"+'<span class="badge badge-danger">INACTIVO</span>';+"</center>"
				}
			}
		},
		{"defaultContent": "<center>"+"<span class=' editar text-primary px-1' style='cursor:pointer;' title='Editar datos'><i class='fa fa-edit'></i></span>&nbsp;<span class=' eliminar text-danger px-1' style='cursor:pointer;' title='Eliminar datos' hidden><i class='fa fa-trash'></i></span>"+"</center>"}


		],
		"language":idioma_espanol,
		select:true
	});
	/*contador en cada tabla
	tbl_proveedor.on('draw.td',function(){
		var PageInfo = $("#tabla_proveedor").DataTable().page.info();
		tbl_proveedor.column(0,{page: 'current'}).nodes().each(function(cell,i){
			cell.innerHTML = i + 1 + PageInfo.start;
		});
	});*/
 }








 /********************************************************************
 		ABRIR MODAL REGISTRAR PROVEEDOR
 ********************************************************************/
 function AbrirModalRegistroProveedor(){
 	//para que no se nos salga del modal haciendo click a los costados
 	$("#modal_registro_proveedor").modal({backdrop:'static', keyboard: false});	
 	$("#modal_registro_proveedor").modal('show');//abrimos el modal

 	//LimpiarModalCliente();//limpiar texbox cada que demos en nuevo
 	$('.form-control').removeClass("is-invalid").removeClass("is-valid");//remover las clases
 }





 /********************************************************************
 		ABRIR MODAL EDITAR PROVEEDOR
 ********************************************************************/
 $('#tabla_proveedor').on('click', '.editar', function() {//class foto tiene que ir en el boton
	var data = tbl_proveedor.row($(this).parents('tr')).data();//tamaño de escritorio
	if (tbl_proveedor.row(this).child.isShown()) {
		var data = tbl_proveedor.row(this).data();//para celular y usas el responsive datatable
	}
		$("#modal_editar_proveedor").modal({backdrop:'static', keyboard: false});	
		$("#modal_editar_proveedor").modal('show');//abrimos el modal
		//LimpiarModalUsuario();
		//mandamos parametros a los texbox
		//document.getElementById('idrol').value=data[0];
		document.getElementById('idproveedor').value=data.prove_id;//id del procedure
		document.getElementById('text_ruc_editar').value=data.prove_ruc;
		document.getElementById('text_razon_editar').value=data.prove_razon;
		document.getElementById('text_direccion_editar').value=data.prove_direccion;//enviamos el nombre del usu al modal
		document.getElementById('text_celular_editar').value=data.prove_celular;
		//console.log(data.rol_id);//para enviar el dato  en console
		$("#select_estado_proveedor_editar").select2().val(data.prove_estado).trigger('change.select2');
 });





 /********************************************************************
 		VALIDAR TEXBOX PROVEEDOR
 ********************************************************************/
 function ValidarCamposProveedor(ruc,razon,direccion){
 	Boolean(document.getElementById(ruc).value.length>0) ? $("#"+ruc).removeClass("is-invalid").addClass("is-valid") : $("#"+ruc).removeClass("is-valid").addClass("is-invalid");
 	Boolean(document.getElementById(razon).value.length>0) ? $("#"+razon).removeClass("is-invalid").addClass("is-valid") : $("#"+razon).removeClass("is-valid").addClass("is-invalid");
 	Boolean(document.getElementById(direccion).value.length>0) ? $("#"+direccion).removeClass("is-invalid").addClass("is-valid") : $("#"+direccion).removeClass("is-valid").addClass("is-invalid");
 }





 /********************************************************************
 		LIMPIAR TEXBOX PROVEEDOR
 ********************************************************************/
 function LimpiarModalProveedor(){
	document.getElementById('text_ruc').value="";
	document.getElementById('text_razon').value="";
	document.getElementById('text_direccion').value="";
	document.getElementById('text_celular').value="";
 }





 /********************************************************************
 		REGISTRAR PROVEEDOR
 ********************************************************************/
 function RegistrarProveedor(){
 	let ruc = document.getElementById('text_ruc').value;
 	let razon = document.getElementById('text_razon').value;
 	let direccion = document.getElementById('text_direccion').value;
 	let celular = document.getElementById('text_celular').value;

 	if (ruc.length ==0 || razon.length ==0 || direccion.length ==0  ) {
 		ValidarCamposProveedor("text_ruc","text_razon","text_direccion");
 		return Swal.fire("Mensaje de Advertencia","Tiene campos vacios","warning");
 	}
 
	$.ajax({
 		url:'../controller/proveedor/controlador_proveedor_registar.php',
 		type: 'POST',
 		data:{
 			ruc: ruc,//le enviamos los campos al controlador
 			razon: razon,
 			direccion: direccion,			
 			celular: celular
 		}
 	}).done(function(resp){
 		if (resp>0) {
 			if (resp==1) {//validamos la respuesta del procedure si retorna 1 o 2
 				Swal.fire("Mensaje de Confirmacion","Proveedor Registrado","success").then((value)=>{
	 					
	 					$("#modal_registro_proveedor").modal('hide');//abrimos el modal
	 					tbl_proveedor.ajax.reload();//recargar dataTable
	 					//TraerNotificaciones();
	 				});	
 			}else{
 				Swal.fire("Mensaje de Advertencia","El Proveedor ya se encuentra registrado","warning");
 			}
	 				 			
	 		}else{
	 			Swal.fire("Mensaje de Error","No se puede registrar el Proveedor","error");
	 		}
 	})	 
 }




 /********************************************************************
 		MODIFICAR PROVEEDOR
 ********************************************************************/
 function ModificarProveedor(){//enviamos los datos del ajax al controlador y al onclick del boton editar
 	let id = document.getElementById('idproveedor').value;
 	let ruc = document.getElementById('text_ruc_editar').value;
 	let razon = document.getElementById('text_razon_editar').value;
 	let direccion = document.getElementById('text_direccion_editar').value;
 	let celular = document.getElementById('text_celular_editar').value;
 	let estado = document.getElementById('select_estado_proveedor_editar').value;

 	if (ruc.length ==0 || razon.length ==0 || direccion.length ==0  ) {
 		ValidarCamposProveedor("text_ruc_editar","text_razon_editar","text_direccion_editar");
 		return Swal.fire("Mensaje de Advertencia","Tiene campos vacios","warning");
 	}

 	$.ajax({
 		url:'../controller/proveedor/controlador_modificar_proveedor.php',
 		type: 'POST',
 		data:{
 			id: id,//le enviamos los campos al controlador
 			ruc: ruc,
 			razon: razon,
 			direccion: direccion,	
 			celular: celular,			
 			estado: estado
 		}
 	}).done(function(resp){
 	 	if (resp>0) {
 			if (resp==1) {//validamos la respuesta del procedure si retorna 1 o 2
 					
	 				LimpiarModalProveedor();
 				Swal.fire("Mensaje de Confirmacion","Proveedor Actualizado","success").then((value)=>{					
	 					$("#modal_editar_proveedor").modal('hide');//abrimos el modal
	 					tbl_proveedor.ajax.reload();//recargar dataTable
	 					//TraerNotificaciones();
	 				});	
 			}else{
 				Swal.fire("Mensaje de Advertencia","El Proveedor ya se encuentra registrado","warning");

 			}
	 				 			
	 		}else{
	 			Swal.fire("Mensaje de Error","No se puede registrar el Proveedor","error");
	 		}
 	})
 }




