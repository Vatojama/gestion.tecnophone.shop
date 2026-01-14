
 /********************************************************************
 								INICIAR SESION
 ********************************************************************/
 function Inciar_Sesion ()
 {
	recuerdame();
	let usu  = document.getElementById('text_usuario').value;
	let pass = document.getElementById('text_clave').value;
	if (usu.length == 0 || pass.length == 0) {
		return Swal.fire('Mensaje de Advertencia','Ingrese los Campos en blanco','warning');
	}
	//llamamos al controlador
	$.ajax({
		url : 'controller/usuario/iniciar_sesion.php',
		type: 'POST',
		data: {
			u:usu,
			p:pass
		}
		
	}).done(function(resp) {
		let data = JSON.parse(resp);
		//console.log(data);
		if (data.length>0) {
				if (data[0][4]=='INACTIVO') {//solo envia un campo posicion 0
					return Swal.fire('Mensaje de Error','Usuario '+usu+' se ecuentra desactivado','error');
				}

				$.ajax({
				url : 'controller/usuario/crear_sesion.php',
				type: 'POST',
				data: {
					idusuario:data[0][0],//data contiene el array de todos los datps de la bd
					usuario:data[0][1],
					rol:data[0][3],
					rolnombre:data[0][7],
					correo:data[0][5],
					idsucursal:data[0][8],
					idalmacen:data[0][9]
				}
				
			}).done(function(r) {
				let timerInterval
				Swal.fire({
				  title: 'Bienvenido al Sistema',
				  html: 'Cargando <b></b> .',
				  timer: 10,
				  heightAuto:false,
				  timerProgressBar: true,
				  allowOutsideClick: false,
				  didOpen: () => {
				    Swal.showLoading()
				    const b = Swal.getHtmlContainer().querySelector('b')
				    timerInterval = setInterval(() => {
				      b.textContent = Swal.getTimerLeft()
				    }, 150)
				  },
				  willClose: () => {
				    clearInterval(timerInterval)
				  }
				}).then((result) => {
				  /* Read more about handling dismissals below */
				  if (result.dismiss === Swal.DismissReason.timer) {
				    location.reload();
				  }
				})
			})
			
			
			//Swal.fire('Mensaje de Confirmacion','Logueo exitoso','success');
		}else
		{
			Swal.fire('Mensaje de Error','Usuario o Clave incorrecto','error');
		}
	})
 }



 /********************************************************************
 				RECORDAR USUARIO AL INICIAR SESION
 ********************************************************************/
 function recuerdame (){
	if (rmcheck.checked && usuarioinput.value !== "" && passinput.value !== "") {

		localStorage.usuario = usuarioinput.value;
		localStorage.pass    = passinput.value;
		localStorage.checkbox= rmcheck.value; 
	}else{
		localStorage.usuario = "";
		localStorage.pass    = "";
		localStorage.checkbox= ""; 
	}
 }



 /********************************************************************
 					EJEMPLO DE LISTAR CON METODO NORMAL
 ********************************************************************/
var tbl_usuario_simple;
 function Listar_usuario_simple(){
	tbl_usuario_simple = $("#tabla_usuario_simple").DataTable({

		"ordering" :false,
		"bLengthChange" : true,
		"searching" : {"regex" : false},
		"lengthMenu" : [[10, 25, 50, 100, -1],[10, 25, 50, 100, "All"]],
		"pageLength" : 10,
		"destroy" :true,
		"async" : false,
		"processing": true,
		"ajax" : {
			"url": "../controller/usuario/controlador_usuario_listar.php",
			type: 'POST'
		},
		"columns":[
		//todos los datos del procedimiento almacenado
		{"defaultContent": ""},
		{"data": "usu_nombre"},
		{"data": "usu_email"},
		{"data": "rol_nombre"},
		{"data": "usu_estado",
			render: function(data,type,row){
				if (data==="ACTIVO") {
					return "<span class='badge badge-success'>"+data+"</span>"
				}else{
					return "<span class='badge badge-danger'>"+data+"</span>"
				}
			}
		},
		{"defaultContent": "<button class='btn btn-primary'><i class= 'fa fa-edit'></i></button>"}


		],
		"language":idioma_espanol,
		select:true
	});
	//contador en cada tabla
	tbl_usuario_simple.on('draw.td',function(){
		var PageInfo = $("#tabla_usuario_simple").DataTable().page.info();
		tbl_usuario_simple.column(0,{page: 'current'}).nodes().each(function(cell,i){
			cell.innerHTML = i + 1 + PageInfo.start;
		});

	});
 }	



 /********************************************************************
 			LISTAR USUARIO CON SERVERSIDE (MUCHOS DATOS) SE USA ESTE 
 ********************************************************************/
var tbl_usuario_simple;
 function Listar_usuario_serverside(){
	tbl_usuario_simple = $("#tabla_usuario_simple").DataTable({
		"responsive":true,
		"pageLength" : 10,
		"destroy" :true,
		"bProcessing" :true,
		"bDeferRender" :true,
		"bServerSide" :true,
		"sAjaxSource" : "../controller/usuario/serverside/serversideUsuario.php",
		"columns":[
		//todos los datos de la vista
		{"defaultContent":""},
        {"data":1},//nombre
        {"data":6},//correo
        {"data":4},//rol
        {"data":7,//foto
			render: function(data,type,row){
					return '<img class="img-responsive" style="width:40px" src="../'+data+'">';
			}
		},
		 {"data":9},//nombre sucursal
        {"data":5,//estado
			render: function(data,type,row){
				if (data==="ACTIVO") {
					return "<center>"+'<span class="badge badge-success">ACTIVO</span>'+"</center>";
				}else{
					return "<center>"+'<span class="badge badge-danger">INACTIVO</span>'+"</center>";
				}
			}
		},
		{"data":5,//accion para activar y desactivar los botones
          render: function(data,type,row){
          	if (data==="ACTIVO") {
             return "<center>"+"<span class=' editar text-primary px-1' style='cursor:pointer;' data-bs-toggle='tooltip' data-bs-placement='top' title='Editar'><i class='fa fa-edit'></i></span>&nbsp;<span class='text-secundary px-1' style='cursor:pointer;' data-bs-toggle='tooltip' data-bs-placement='top' title='Activar' disabled ><i class='fa fa-check-circle'></i></span>&nbsp;<span class=' desactivar text-danger px-1' style='cursor:pointer;' data-bs-toggle='tooltip' data-bs-placement='top' title='Desactivar'><i class='fa fa-trash'></i></span>&nbsp;<span class=' foto text-info px-1' style='cursor:pointer;' data-bs-toggle='tooltip' data-bs-placement='top' title='Cambiar foto'><i class='fa fa-image'></i></span>&nbsp;<span class=' clave text-warning px-1' style='cursor:pointer;' data-bs-toggle='tooltip' data-bs-placement='top' title='Cambiar Clave'><i class='fa fa-key'></i></span>"+"</center>";
          }else{
             return "<center>"+"<span class=' editar text-primary px-1' style='cursor:pointer;' data-bs-toggle='tooltip' data-bs-placement='top' title='Editar'><i class='fa fa-edit'></i></span>&nbsp;<span class='activar text-success px-1' style='cursor:pointer;' data-bs-toggle='tooltip' data-bs-placement='top' title='Activar'><i class='fa fa-check-circle'></i></span>&nbsp;<span class='text-secundary px-1' style='cursor:pointer;' data-bs-toggle='tooltip' data-bs-placement='top' title='Desactivar' disabled><i class='fa fa-trash'></i></span>&nbsp;<span class=' text-secundary px-1' style='cursor:pointer;' data-bs-toggle='tooltip' data-bs-placement='top' title='Cambiar foto'><i class='fa fa-image'></i></span>&nbsp;<span class='text-secundary px-1' style='cursor:pointer;' data-bs-toggle='tooltip' data-bs-placement='top' title='Cambiar Clave'><i class='fa fa-key'></i></span>"+"</center>";
          }
     	 }
        },


		],
		"language":idioma_espanol,
		select:true
	});
	//contador en cada tabla
	tbl_usuario_simple.on('draw.td',function(){
		var PageInfo = $("#tabla_usuario_simple").DataTable().page.info();
		tbl_usuario_simple.column(0,{page: 'current'}).nodes().each(function(cell,i){
			cell.innerHTML = i + 1 + PageInfo.start;
		});

	});
 }	



  /********************************************************************
 					LISTAR DATOS DEL PLAN
 ********************************************************************/
var tabla_datos_plan;
function Listar_Datos_perfil_usuario(){
	var idusuario = document.getElementById('text_Idprincipal').value;
	tbl_perfil_usuario = $("#tabla_datos_usuario").DataTable({

	   "ordering" :false,
	   "bLengthChange" : true,
	   "searching" : {"regex" : false},
	   "lengthMenu" : [[10, 25, 50, 100, -1],[10, 25, 50, 100, "All"]],
	   "pageLength" : 10,
	   "destroy" :true,
	   "async" : false,
	   "processing": true,
	   "dom": '',
	   "ajax" : {
		   "url": "../controller/usuario/controlador_datos_perfil.php",
		   type: 'POST',
		   data:{
			idusuario:idusuario
		}
	   },
	   "columns":[
	   //todos los datos del procedimiento almacenado
	   {"data": "usu_nombre"},
	   {"data": "usu_email"},
	   {"data": "rol_nombre"},
	   {"data": "usu_estado"},
	   {"data": "usu_foto",
			render: function(data,type,row){
					return '<img class="img-responsive" style="width:40px" src="../'+data+'">';
			}
		}
		//{"defaultContent": "<center>"+"<span class=' clave_dato text-warning px-1' style='cursor:pointer;' data-bs-toggle='tooltip' data-bs-placement='top' title='Cambiar Clave'><i class='fa fa-key'></i></span> "+"</center>"}


	   ],
	   "language":idioma_espanol,
	   select:true
   });

}	


  /********************************************************************
 					LISTAR DATOS DEL PERFIL DEL USUARIO
 ********************************************************************/
var tabla_datos_plan;
function Listar_Datos_Plan(){
	//var idusuario = document.getElementById('text_Idprincipal').value;
	tabla_datos_plan = $("#tabla_datos_plan").DataTable({

	"ordering" :false,
	"bLengthChange" : true,
	"searching" : {"regex" : false},
	"lengthMenu" : [[10, 25, 50, 100, -1],[10, 25, 50, 100, "All"]],
	"pageLength" : 10,
	"destroy" :true,
	"async" : false,
	"processing": true,
	"dom": '',
	"ajax" : {
		"url": "../controller/usuario/controlador_datos_plan.php",
		type: 'POST',
		// data:{
		// 	idusuario:idusuario
		// }
	},
	"columns":[
	//todos los datos del procedimiento almacenado
	{"data": "plan_nombre_cli"},
	{"data": "descripcion"},
	{"data": "plan_ini"},
	{"data": "plan_fin"},
	{"data": "plan_monto"},
	{"data": "plan_estado"},
	
		//{"defaultContent": "<center>"+"<span class=' clave_dato text-warning px-1' style='cursor:pointer;' data-bs-toggle='tooltip' data-bs-placement='top' title='Cambiar Clave'><i class='fa fa-key'></i></span> "+"</center>"}


	],
	"language":idioma_espanol,
	select:true
});

}	
					 



 /**********************************************************************
 		  ABRIR MODAL EDITAR Y TRAER DATOS A LOS CAMPOS
 ***********************************************************************/
 $('#tabla_usuario_simple').on('click', '.editar', function() {
	var data = tbl_usuario_simple.row($(this).parents('tr')).data();//tamaño de escritorio
	if (tbl_usuario_simple.row(this).child.isShown()) {
		var data = tbl_usuario_simple.row(this).data();//para celular y usas el responsive datatable
	}
	//console.log(data);
	$('.form-control').removeClass("is-invalid").removeClass("is-valid");//remover las clases
	$("#modal_editar_usuario").modal({backdrop:'static', keyboard: false});	
	$("#modal_editar_usuario").modal('show');//abrimos el modal

	//jalamos los datos al presionar editar
	document.getElementById('text_idusuario_editar').value=data[0];//posisicion de la vista en el serviside
	document.getElementById('text_usuario_editar').value=data[1];
	document.getElementById('text_correo_editar').value=data[6];
	
	$("#select_rol_editar").select2().val(data[3]).trigger('change.select2');
	$("#select_sucur_editar").select2().val(data[8]).trigger('change.select2');

	
 });



 /**********************************************************************
 								  ACTIVAR USUARIO
 ***********************************************************************/
 $('#tabla_usuario_simple').on('click', '.activar', function() {//campo activar tiene que ir en el boton
	var data = tbl_usuario_simple.row($(this).parents('tr')).data();//tamaño de escritorio
	if (tbl_usuario_simple.row(this).child.isShown()) {
		var data = tbl_usuario_simple.row(this).data();//para celular y usas el responsive datatable
	}
	Swal.fire({
	  title: 'Desea activar el usuario?',
	  text: "",
	  icon: 'warning',
	  showCancelButton: true,
	  confirmButtonColor: '#3085d6',
	  cancelButtonColor: '#d33',
	  confirmButtonText: 'Si, confirmar'
	}).then((result) => {
	  if (result.isConfirmed) {
	   Modificar_Estado(data[0],"ACTIVO");//data 0 (id)
	  }
	})
 });



 /**********************************************************************
 								  DESACTIVAR USUARIO
 ***********************************************************************/
 $('#tabla_usuario_simple').on('click', '.desactivar', function() {//campo activar tiene que ir en el boton
	var data = tbl_usuario_simple.row($(this).parents('tr')).data();//tamaño de escritorio
	if (tbl_usuario_simple.row(this).child.isShown()) {
		var data = tbl_usuario_simple.row(this).data();//para celular y usas el responsive datatable
	}
	Swal.fire({
	  title: 'Desea Desactivar el usuario?',
	  text: "",
	  icon: 'warning',
	  showCancelButton: true,
	  confirmButtonColor: '#3085d6',
	  cancelButtonColor: '#d33',
	  confirmButtonText: 'Si, confirmar'
	}).then((result) => {
	  if (result.isConfirmed) {
	   Modificar_Estado(data[0],"INACTIVO");//data 0 (id)
	  }
	})
 });




 /**********************************************************************
 								  CAMBIAR FOTO DEL USUARIO
 ***********************************************************************/
 $('#tabla_usuario_simple').on('click', '.foto', function() {//class foto tiene que ir en el boton
	var data = tbl_usuario_simple.row($(this).parents('tr')).data();//tamaño de escritorio
	if (tbl_usuario_simple.row(this).child.isShown()) {
		var data = tbl_usuario_simple.row(this).data();//para celular y usas el responsive datatable
	}
		$("#modal_editar_foto").modal({backdrop:'static', keyboard: false});	
		$("#modal_editar_foto").modal('show');//abrimos el modal
		LimpiarModalUsuario();
		//mandamos parametros a los texbox
		document.getElementById('idusuario_foto').value=data[0];
		document.getElementById('lbl_usuario').innerHTML=data[1];//enviamos el nombre del usu al modal
		//console.log(data[0]);//para enviar el dato  en console
		document.getElementById('fotoactual').value=data[7];
		//console.log(data[7]);//capturaar ruta
 });





 /**********************************************************************
 								  CAMBIAR CLAVE DE USUARIO
 ***********************************************************************/
 $('#tabla_usuario_simple').on('click', '.clave', function() {//class foto tiene que ir en el boton
	var data = tbl_usuario_simple.row($(this).parents('tr')).data();//tamaño de escritorio
	if (tbl_usuario_simple.row(this).child.isShown()) {
		var data = tbl_usuario_simple.row(this).data();//para celular y usas el responsive datatable
	}
		$("#modal_editar_clave").modal({backdrop:'static', keyboard: false});	
		$("#modal_editar_clave").modal('show');//abrimos el modal
		LimpiarModalUsuario();
		document.getElementById('text_clave_editar').value="";
		document.getElementById('text_clave_repetir').value="";
		//mandamos parametros a los texbox
		document.getElementById('idusuario_clave').value=data[0];
		document.getElementById('lbl_usuario_clave').innerHTML=data[1];//enviamos el nombre del usu al modal
		//console.log(data[0]);//capturaar ruta
 });


 
 /**********************************************************************
 				CAMBIAR CLAVE DE USUARIO  DEL PERFIL
 ***********************************************************************/
 /*$('#tabla_datos_usuario').on('click', '.clave_dato', function() {//class foto tiene que ir en el boton
	var data = tbl_perfil_usuario.row($(this).parents('tr')).data();//tamaño de escritorio
	if (tbl_perfil_usuario.row(this).child.isShown()) {
		var data = tbl_perfil_usuario.row(this).data();//para celular y usas el responsive datatable
	}
		$("#modal_editar_clave").modal({backdrop:'static', keyboard: false});	
		$("#modal_editar_clave").modal('show');//abrimos el modal
		document.getElementById('idusuario_clave').value=data[0];
		document.getElementById('lbl_usuario_clave').innerHTML=data[1];//enviamos el nombre del usu al modal

 });*/





 /**********************************************************************
 						 ABRIR MODAL REGISTRAR USUARIO
 ***********************************************************************/
 function AbrirModalRegistroUsuario(){
 	//para que no se nos salga del modal haciendo click a los costados
 	$("#modal_registro_usuario").modal({backdrop:'static', keyboard: false});	
 	$("#modal_registro_usuario").modal('show');//abrimos el modal
 	LimpiarModalUsuario();//limpiar texbox cada que demos en nuevo
 	$('.form-control').removeClass("is-invalid").removeClass("is-valid");//remover las clases
 }





 /**********************************************************************
 						  CARGAR TODOS LOS ROLES EN COMBO
 ***********************************************************************/
 function cargar_SelectRol(){
 	$.ajax({
 		url:'../controller/usuario/controlador_cargar_select_rol.php',
 		type: 'POST'
 	}).done(function(resp){
 		let data = JSON.parse(resp);//POSICION DE LA FILA Y COLUMNA
 		let llenardata = "<option value=''>Seleccione</option>";
 		if (data.length>0) {
 			for (let i = 0; i < data.length; i++) {
 				llenardata+="<option value='"+data[i][0]+"'>"+data[i][1]+"</option>";
 			}
 			document.getElementById('select_rol').innerHTML = llenardata;
 			document.getElementById('select_rol_editar').innerHTML = llenardata;
 		}else{
 			llenardata+="<option value=''>No se encontraron datos</option>";
 			document.getElementById('select_rol').innerHTML = llenardata;
 			document.getElementById('select_rol_editar').innerHTML = llenardata;

 		}
 	})
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
 			document.getElementById('select_sucur_editar').innerHTML = llenardata;
 		}else{
 			llenardata+="<option value=''>No se encontraron datos</option>";
 			document.getElementById('select_sucur').innerHTML = llenardata;
 			document.getElementById('select_sucur_editar').innerHTML = llenardata;

 		}
 	})
 }


 /********************************************************************
	   CARGAR CLIENTES EN COMBO
 ********************************************************************/
function cargar_SelectCliente() {//enviamos al scrpit mantenimiento examen
	// $.ajax({
	// 	url: '../controller/recepcion/controlador_cargar_select_cliente.php',
	// 	type: 'POST'
	// }).done(function (resp) {
	// 	let data = JSON.parse(resp);//POSICION DE LA FILA Y COLUMNA
	// 	let llenardata = "<option >Seleccione...</option>";
	// 	if (data.length > 0) {
	// 		for (let i = 0; i < data.length; i++) {
	// 			llenardata += "<option value='" + data[i][0] + "' >" + data[i][1] + "</option>";
	// 		}
	// 		document.getElementById('select_cliente').innerHTML = llenardata;//primero para registrar luego en modificar colocamos el select editar
	// 		document.getElementById('select_cliente_editar').innerHTML = llenardata;
	// 	} else {
	// 		llenardata += "<option value=''>No se encontraron datos</option>";
	// 		document.getElementById('select_cliente').innerHTML = llenardata;
	// 		document.getElementById('select_cliente_editar').innerHTML = llenardata;

	// 	}
	// })
}






 /**********************************************************************
 								  REGISTRAR USUARIO
 ***********************************************************************/
 function RegistrarUsuario(){
 	let usuario = document.getElementById('text_usuario').value;
 	let clave = document.getElementById('text_clave').value;
 	let correo = document.getElementById('text_correo').value;
 	let rol = document.getElementById('select_rol').value;
 	let foto = document.getElementById('text_foto').value;
	let sucuid = document.getElementById('select_sucur').value;

 	if (usuario.length ==0 || clave.length==0 || correo.length== 0) {
 		ValidarCampos("text_usuario","text_clave","text_correo");
 		return Swal.fire("Mensaje de Advertencia","Tiene campos vacios","warning");
 	}
 	if (rol.length == 0 ) {
 		return Swal.fire("Mensaje de Advertencia","Seleccione un rol para el usuario","warning");
 	}
	if (sucuid.length == 0 ) {
 		return Swal.fire("Mensaje de Advertencia","Seleccione una sucursal para el usuario","warning");
 	}
	
 	//validar email
 	//if(validar_email(correo)){
	 // }else{
	 //   return Swal.fire("Mensaje de Advertencia","El formato ingresado del email es incorrecto","warning");
	 // }

	 //capturar foto
	 let extension = foto.split('.').pop();//capturar despues del punto foto122.jpg
	 let nombrefoto="";
	 let f = new Date();
	 if (foto.length>0) {
	 	nombrefoto="IMG"+f.getDate()+""+(f.getMonth()+1)+""+f.getFullYear()+""+f.getHours()+""+f.getMilliseconds()+"."+extension;
	 }
	 let formData = new FormData();
	 let fotoObject = $("#text_foto")[0].files[0];//objeto de la foto adjuntada
	 formData.append('u',usuario);
	 formData.append('c',clave);
	 formData.append('e',correo);
	 formData.append('r',rol);
	 formData.append('nombrefoto',nombrefoto);
	 formData.append('foto',fotoObject);
	 formData.append('sucuid',sucuid);
	 $.ajax({
	 	url: '../controller/usuario/controlador_usuario_registar.php',
	 	type: 'POST',
	 	data:formData,
	 	contentType: false,
	 	processData: false,
	 	success: function(resp){
	 		if (resp>0) {//IF SOLO PARA REGISTRAR
	 			//Registrar_Permisos(parseInt(resp));
				if (resp ==1) {
	 				ValidarCampos("text_usuario","text_clave","select_rol");
	 				LimpiarModalUsuario();
	 				Swal.fire("Mensaje de Confirmacion","Usuario registrado","success").then((value)=>{
	 					$("#modal_registro_usuario").modal('hide');//ocultamos modal despues de registrar
	 					tbl_usuario_simple.ajax.reload();//recargar dataTable
	 				});
	 			}else{
	 				Swal.fire("Mensaje de Advertencia","El usuario ya se encuentra registrado","warning");
	 			}

	 		}else{
	 			Swal.fire("Mensaje de Error","No se puede registrar el usuario","error");
	 		}

	 	}	 	
	 });	 
 }


/*





 /**********************************************************************
 						  VALIDAR CAMPOS DE LOS TEXBOX
 ***********************************************************************/
 function ValidarCampos(usuario,clave,correo){
 	Boolean(document.getElementById(usuario).value.length>0) ? $("#"+usuario).removeClass("is-invalid").addClass("is-valid") : $("#"+usuario).removeClass("is-valid").addClass("is-invalid");
 	if (clave !="") {
 		Boolean(document.getElementById(clave).value.length>0) ? $("#"+clave).removeClass("is-invalid").addClass("is-valid") : $("#"+clave).removeClass("is-valid").addClass("is-invalid");
 	}	
 	Boolean(document.getElementById(correo).value.length>0) ? $("#"+correo).removeClass("is-invalid").addClass("is-valid") : $("#"+correo).removeClass("is-valid").addClass("is-invalid");
    
 }



 /**********************************************************************
 								  VALIDAR EMAIL
 ***********************************************************************/
 function validar_email(correo){
  var regex = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  return regex.test(correo) ? true : false;
 }





 /**********************************************************************
 								  LIMPIAR CAMPOS DE TEXBOX
 ***********************************************************************/
 function LimpiarModalUsuario(){
	document.getElementById('text_usuario').value="";
	document.getElementById('text_clave').value="";
	document.getElementById('text_correo').value="";
	document.getElementById('text_foto').value="";
	document.getElementById('text_foto_editar').value="";
	//$("#select_cliente").select2().val("").trigger('change.select2');
 }






 /**********************************************************************
 								  MODIFICAR USUARIO
 ***********************************************************************/
 function ModificarUsuario(){//enviamos los datos del ajax al controlador y al onclick del boton editar
	let id = document.getElementById('text_idusuario_editar').value;
	let usuario = document.getElementById('text_usuario_editar').value;
	let correo = document.getElementById('text_correo_editar').value;
 	//let clave = document.getElementById('text_clave').value;	
 	let rol = document.getElementById('select_rol_editar').value;
	let sucuid = document.getElementById('select_sucur_editar').value;
	// let clienteid = document.getElementById('select_cliente_editar').value;
	// console.log(rol);
 	if (usuario.length ==0  ) {//validar que no esten vacios
 		ValidarCampos("text_usuario_editar","","select_rol_editar");
 		return Swal.fire("Mensaje de Advertencia","Tiene campos vacios","warning");
 	}
	 if (rol.length == 0 ) {
		return Swal.fire("Mensaje de Advertencia","Selecciones un rol para el usuario","warning");
	}
	

 	$.ajax({
 		url:'../controller/usuario/controlador_modificar_usuario.php',
 		type: 'POST',
 		data:{
 			id: id,//le enviamos los campos al controlador
 			usuario: usuario,
 			correo: correo,
 			rol: rol,
			 sucuid:sucuid
 		}
 	}).done(function(resp){
 		if (resp>0) {
	 				//ValidarCampos("text_usuario_editar","","select_rol_editar");	
	 				Swal.fire("Mensaje de Confirmacion","Usuario actualizado","success").then((value)=>{
	 					$("#modal_editar_usuario").modal('hide');//ocultamos modal despues de registrar
	 					tbl_usuario_simple.ajax.reload();//recargar dataTable
	 				});	 			
	 		}else{
	 			Swal.fire("Mensaje de Error","No se puede modificar el usuario","error");
	 		}
 	})
 }





 /**********************************************************************
 						  MODIFICAR EL ESTADO DEL USUARIO
 ***********************************************************************/
 function Modificar_Estado(id, estado){
	$.ajax({
 		url:'../controller/usuario/controlador_modificar_usuario_estado.php',
 		type: 'POST',
 		data:{
 			id: id,//le enviamos los campos al controlador
 			estado: estado

 		}
 	}).done(function(resp){
 		if (resp>0) {
	 				Swal.fire("Mensaje de Confirmacion","Estado Actualizado","success").then((value)=>{
	 					tbl_usuario_simple.ajax.reload();//recargar dataTable
	 				});	 			
	 		}else{
	 			Swal.fire("Mensaje de Error","No se puede cambiar el estado","error");
	 		}
 	})
 }







 /**********************************************************************
 							MODIFICAR FOTO DEL USUARIO
 ***********************************************************************/
 function ModificarFotoUsuario(){
 	let id   = document.getElementById('idusuario_foto').value;
 	let foto = document.getElementById('text_foto_editar').value; 
 	let rutaactual = document.getElementById('fotoactual').value; 
 	if (id.length ==0 || foto.length== 0) {		
 		return Swal.fire("Mensaje de Advertencia","Tiene campos vacios","warning");
 	}

	 //capturar foto
	 let extension = foto.split('.').pop();//capturar despues del punto foto122.jpg
	 let nombrefoto="";
	 let f = new Date();
	 if (foto.length>0) {
	 	nombrefoto="IMG"+f.getDate()+""+(f.getMonth()+1)+""+f.getFullYear()+""+f.getHours()+""+f.getMilliseconds()+"."+extension;
	 }
	 let formData = new FormData();
	 let fotoObject = $("#text_foto_editar")[0].files[0];//objeto de la foto adjuntada
	 formData.append('id',id);
	 formData.append('rutaactual',rutaactual);
	 formData.append('nombrefoto',nombrefoto);
	 formData.append('foto',fotoObject);
	 $.ajax({
	 	url: '../controller/usuario/controlador_usuario_mdoficar_foto.php',
	 	type: 'POST',
	 	data:formData,
	 	contentType: false,
	 	processData: false,
	 	success: function(resp){
	 		if (resp>0) {
	 				Swal.fire("Mensaje de Confirmacion","Foto Actualizada","success").then((value)=>{
	 					$("#modal_editar_foto").modal('hide');//ocultamos modal despues de registrar
	 					tbl_usuario_simple.ajax.reload();//recargar dataTable
	 				});	 			
	 		}else{
	 			Swal.fire("Mensaje de Error","No se puede Actualizar la foto","error");
	 		}
	 	}	 	
	 });	 
 }






 /**********************************************************************
 						  MODIFICAR CLAVE DEL USUARIO
 ***********************************************************************/
 function ModificarClaveUsuario(){
 	//validar que no esten vacios
 	let id = document.getElementById('idusuario_clave').value;
 	let clavenueva = document.getElementById('text_clave_editar').value;
 	let claverepeti = document.getElementById('text_clave_repetir').value;
 	if (id.length ==0 || clavenueva.length ==0 || claverepeti.length ==0) {
 		return Swal.fire("Mensaje de Advertencia","Tiene campos vacios","warning");
 	}
 	//validar que sean iguales
 	if (clavenueva != claverepeti) {
 		return Swal.fire("Mensaje de Advertencia","Las claves ingresadas no coninciden","warning");
 	}
 	$.ajax({
 		url:'../controller/usuario/controlador_modificar_usuario_clave.php',
 		type: 'POST',
 		data:{
 			id: id,//le enviamos los campos al controlador
 			clavenueva: clavenueva

 		}
 	}).done(function(resp){
 		if (resp>0) {
	 				Swal.fire("Mensaje de Confirmacion","Clave Actualizada","success").then((value)=>{
	 					document.getElementById('text_clave_editar').value="";
	 					document.getElementById('text_clave_repetir').value="";
	 				   $("#modal_editar_clave").modal('hide');//ocultamos modal
	 					tbl_usuario_simple.ajax.reload();//recargar dataTable
	 				});	 			
	 		}else{
	 			Swal.fire("Mensaje de Error","No se puede cambiar la clave","error");
	 		}
 	})

 }