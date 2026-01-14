 /********************************************************************
 		LISTAR EMPRESA CON METODO NORMAL
 ********************************************************************/

var tbl_empresa;
 function Listar_Empresa(){//enviarlo al scrip en MANTENIMIENTO EMPRESA
	tbl_empresa = $("#tabla_empresa").DataTable({
		"responsive" :true,
		"ordering" :false,
		"bLengthChange" : true,
		"searching" : {"regex" : false},
		"lengthMenu" : [[10, 25, 50, 100, -1],[10, 25, 50, 100, "All"]],
		"pageLength" : 10,
		"destroy" :true,
		"async" : false,
		"processing": true,	

		"ajax" : {
			"url": "../controller/empresa/controlador_empresa_listar.php",
			type: 'POST'
		},

		
		"columns":[
		//todos los datos del procedimiento almacenado
		{"defaultContent": ""},//cintador 
		{"data": "confi_razon_social"},
		{"data": "confi_ruc"},
		{"data": "confi_nombre_representante"},
		{"data": "confi_direccion"},
		{"data": "confi_celular"},
		{"data": "confi_correo"},
		{"data": "config_foto",
			render: function(data,type,row){
					return '<img class="img-responsive" style="width:30px" src="../'+data+'">';
			}
		},
		{"data": "confi_estado",
			render: function(data,type,row){
				if (data==="ACTIVO") {
					return "<center>"+'<span class="badge badge-success">ACTIVO</span>';+"</center>"
				}else{
					return "<center>"+'<span class="badge badge-danger">INACTIVO</span>';+"</center>"
				}
			}
		},
		{"defaultContent": "<center>"+"<span class=' editar text-primary px-1' style='cursor:pointer;' title='Editar datos'><i class='fa fa-edit'></i></span>&nbsp;<span class='foto text-info px-1' style='cursor:pointer;' title='Cambiar foto'><i class='fa fa-image'></i></span>"+"</center>"}


		],
		"language":idioma_espanol,
		select:true
	});
	//contador en cada tabla
	tbl_empresa.on('draw.td',function(){
		var PageInfo = $("#tabla_empresa").DataTable().page.info();
		tbl_empresa.column(0,{page: 'current'}).nodes().each(function(cell,i){
			cell.innerHTML = i + 1 + PageInfo.start;
		});
	});
 }	







 /********************************************************************
        ABRIR MODAL REGISTRAR EMPRESA
 ********************************************************************/
function AbrirModalRegistroEmpresa(){
 	//para que no se nos salga del modal haciendo click a los costados
 	$("#modal_registro_empresa").modal({backdrop:'static', keyboard: false});	
 	$("#modal_registro_empresa").modal('show');//abrimos el modal
 	//document.getElementById('text_categoria').value="";
 	LimpiarModalEmpresa();//limpiar texbox cada que demos en nuevo
 	$('.form-control').removeClass("is-invalid").removeClass("is-valid");//remover las clases
 }







 /********************************************************************
        ABRIR MODAL EDITAR EMPRESA
 ********************************************************************/
 $('#tabla_empresa').on('click', '.editar', function() {
	var data = tbl_empresa.row($(this).parents('tr')).data();//tamaño de escritorio
	if (tbl_empresa.row(this).child.isShown()) {
		var data = tbl_empresa.row(this).data();//para celular y usas el responsive datatable
	}
	//console.log(data);
	$('.form-control').removeClass("is-invalid").removeClass("is-valid");//remover las clases
	$("#modal_editar_empresa").modal({backdrop:'static', keyboard: false});	
	$("#modal_editar_empresa").modal('show');//abrimos el modal

	//jalamos los datos al presionar editar
	document.getElementById('idempresa').value=data.confi_id;//id del procedure
	document.getElementById('text_razon_editar').value=data.confi_razon_social;
	document.getElementById('text_ruc_editar').value=data.confi_ruc;
	document.getElementById('text_representante_editar').value=data.confi_nombre_representante;
	document.getElementById('text_direccion_editar').value=data.confi_direccion;
	document.getElementById('text_celular_editar').value=data.confi_celular;
	document.getElementById('text_telefono_editar').value=data.confi_telefono;
	document.getElementById('text_correo_editar').value=data.confi_correo;
	document.getElementById('text_url_editar').value=data.confi_url;

	document.getElementById('text_cuenta01_editar').value=data.confi_cnta01;
	document.getElementById('text_nrocuenta01_editar').value=data.confi_nro_cuenta01;
	document.getElementById('text_cuenta02_editar').value=data.confi_cnta02;
	document.getElementById('text_nrocuenta02_editar').value=data.confi_nro_cuenta02;

	document.getElementById('text_moneda_editar').value=data.confi_moneda;
	document.getElementById('text_cod_post_editar').value=data.confi_codigo_pos;

	document.getElementById('text_tipo_igv_editar').value=data.confi_tipo_igv;
	document.getElementById('text_igv_editar').value=data.confi_igv;
	document.getElementById('text_moenda1_editar').value=data.confi_moneda1;
	document.getElementById('text_moneda2_editar').value=data.confi_moneda2;
	document.getElementById('text_nombre_sist_editar').value=data.confi_nombre_sistema;
	document.getElementById('text_link_sist').value=data.url_sistema;
	document.getElementById('text_codigo_pais').value=data.cod_pais;
	document.getElementById('text_clave_correo').value=data.confi_clave_correo;
	$("#select_estado_empresa_editar").select2().val(data.confi_estado).trigger('change.select2');
 });







  /********************************************************************
        CAMBIAR LOGO DE LA EMPRESA
 ********************************************************************/
 $('#tabla_empresa').on('click', '.foto', function() {//class foto tiene que ir en el boton
	var data = tbl_empresa.row($(this).parents('tr')).data();//tamaño de escritorio
	if (tbl_empresa.row(this).child.isShown()) {
		var data = tbl_empresa.row(this).data();//para celular y usas el responsive datatable
	}
		$("#modal_editar_foto").modal({backdrop:'static', keyboard: false});	
		$("#modal_editar_foto").modal('show');//abrimos el modal
		//LimpiarModalUsuario();
		//mandamos parametros a los texbox
		document.getElementById('idempresa_foto').value=data.confi_id;
		document.getElementById('lbl_empresa').innerHTML=data.confi_razon_social;//enviamos el nombre del usu al modal
		//console.log(data[0]);//para enviar el dato  en console
		document.getElementById('fotoactual').value=data.config_foto;
		//console.log(data[7]);//capturaar ruta
 });









  /********************************************************************
        REGISTRAR LA EMPRESA
 ********************************************************************/
 function RegistrarEmpresa(){
 	let razon = document.getElementById('text_razon').value;
 	let ruc = document.getElementById('text_ruc').value;
 	let repre = document.getElementById('text_representante').value;
 	let direccion = document.getElementById('text_direccion').value;
 	let celular = document.getElementById('text_celular').value;
 	let telefono = document.getElementById('text_telefono').value;
 	let correo = document.getElementById('text_correo').value;
 	let foto = document.getElementById('text_foto').value;
 	let url = document.getElementById('text_url').value;

 	let cuenta01 = document.getElementById('text_cuenta01').value;
 	let nro_cuenta01 = document.getElementById('text_nrocuenta01').value;
 	let cuenta02 = document.getElementById('text_cuenta02').value;
 	let nro_cuenta02 = document.getElementById('text_nrocuenta02').value;

 	if (razon.length ==0 || ruc.length==0 || repre.length== 0 || direccion.length== 0 || celular.length== 0 || correo.length== 0  ) {
 		ValidarCampos("text_razon","text_ruc","text_representante","text_direccion","text_celular","text_correo");
 		return Swal.fire("Mensaje de Advertencia","Tiene campos vacios","warning");
 	}
 	//validar email
 	/*if(validar_email(correo)){
	  }else{
	    return Swal.fire("Mensaje de Advertencia","El formato ingresado del email es incorrecto","warning");
	  }*/

	 //capturar foto
	 let extension = foto.split('.').pop();//capturar despues del punto foto122.jpg
	 let nombrefoto="";
	 let f = new Date();
	 if (foto.length>0) {
	 	nombrefoto="LOGO"+f.getDate()+""+(f.getMonth()+1)+""+f.getFullYear()+""+f.getHours()+""+f.getMilliseconds()+"."+extension;
	 }
	 let formData = new FormData();
	 let fotoObject = $("#text_foto")[0].files[0];//objeto de la foto adjuntada
	 formData.append('razon',razon);
	 formData.append('ruc',ruc);
	 formData.append('repre',repre);
	 formData.append('direccion',direccion);
	 formData.append('celular',celular);
	 formData.append('telefono',telefono);
	 formData.append('correo',correo);
	 formData.append('nombrefoto',nombrefoto);
	 formData.append('foto',fotoObject);
	 formData.append('url',url);

	 formData.append('cuenta01',cuenta01);
	 formData.append('nro_cuenta01',nro_cuenta01);	 
	 formData.append('cuenta02',cuenta02);
	 formData.append('nro_cuenta02',nro_cuenta02);
	 $.ajax({
	 	url: '../controller/empresa/controlador_empresa_registar.php',
	 	type: 'POST',
	 	data:formData,
	 	contentType: false,
	 	processData: false,
	 	success: function(resp){
	 		if (resp>0) {//IF SOLO PARA REGISTRAR
	 			if (resp ==1) {
	 				ValidarCampos("text_razon","text_ruc","text_representante","text_direccion","text_celular","text_correo");
	 				LimpiarModalEmpresa();
	 				Swal.fire("Mensaje de Confirmacion","Empresa registrado","success").then((value)=>{
	 					$("#modal_registro_empresa").modal('hide');//ocultamos modal despues de registrar
	 					tbl_empresa.ajax.reload();//recargar dataTable
	 					//TraerNotificaciones();
	 				});
	 			}else{
	 				Swal.fire("Mensaje de Advertencia","La Empresa ya se encuentra registrado","warning");
	 			}

	 		}else{
	 			Swal.fire("Mensaje de Error","No se puede registrar la Empresa","error");
	 		}
	 	}	 	
	 });	 
	 return false;
 }






 /********************************************************************
        VALIDAR TEXBOX
 ********************************************************************/
 function ValidarCampos(razon,ruc,representante,direccion,celular, correo){
 	Boolean(document.getElementById(razon).value.length>0) ? $("#"+razon).removeClass("is-invalid").addClass("is-valid") : $("#"+razon).removeClass("is-valid").addClass("is-invalid");
 	Boolean(document.getElementById(ruc).value.length>0) ? $("#"+ruc).removeClass("is-invalid").addClass("is-valid") : $("#"+ruc).removeClass("is-valid").addClass("is-invalid");
 	Boolean(document.getElementById(representante).value.length>0) ? $("#"+representante).removeClass("is-invalid").addClass("is-valid") : $("#"+representante).removeClass("is-valid").addClass("is-invalid");
 	Boolean(document.getElementById(direccion).value.length>0) ? $("#"+direccion).removeClass("is-invalid").addClass("is-valid") : $("#"+direccion).removeClass("is-valid").addClass("is-invalid");
     Boolean(document.getElementById(celular).value.length>0) ? $("#"+celular).removeClass("is-invalid").addClass("is-valid") : $("#"+celular).removeClass("is-valid").addClass("is-invalid");
     Boolean(document.getElementById(correo).value.length>0) ? $("#"+correo).removeClass("is-invalid").addClass("is-valid") : $("#"+correo).removeClass("is-valid").addClass("is-invalid");
 	//Boolean(document.getElementById(foto).value.length>0) ? $("#"+foto).removeClass("is-invalid").addClass("is-valid") : $("#"+foto).removeClass("is-valid").addClass("is-invalid");
     //Boolean(document.getElementById(celular).value.length>0) ? $("#"+celular).removeClass("is-invalid").addClass("is-valid") : $("#"+celular).removeClass("is-valid").addClass("is-invalid");
 }



  /********************************************************************
         VALIDAR EMAIL
 ********************************************************************/
 function validar_email(correo){
  var regex = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  return regex.test(correo) ? true : false;
 }





  /********************************************************************
         LIMPIAR TEXBOX
 ********************************************************************/
 function LimpiarModalEmpresa(){
	document.getElementById('text_razon').value="";
	document.getElementById('text_ruc').value="";
	document.getElementById('text_representante').value="";
	document.getElementById('text_direccion').value="";
	document.getElementById('text_celular').value="";
	document.getElementById('text_telefono').value="";
	document.getElementById('text_correo').value="";
	document.getElementById('text_foto').value="";
	document.getElementById('text_url').value="";

 }





  /********************************************************************
         MODIFICAR DATOS DE LA EMPRESA
 ********************************************************************/
 function ModificarEmpresa(){//enviamos los datos del ajax al controlador y al onclick del boton editar
	let id = document.getElementById('idempresa').value;
	let razon = document.getElementById('text_razon_editar').value;
 	let ruc = document.getElementById('text_ruc_editar').value;
 	let repre = document.getElementById('text_representante_editar').value;
 	let direccion = document.getElementById('text_direccion_editar').value;
 	let celular = document.getElementById('text_celular_editar').value;
 	let telefono = document.getElementById('text_telefono_editar').value;
 	let correo = document.getElementById('text_correo_editar').value;
 	let estado = document.getElementById('select_estado_empresa_editar').value;
 	let url = document.getElementById('text_url_editar').value;

 	let cuenta01 = document.getElementById('text_cuenta01_editar').value;
 	let nro_cuenta01 = document.getElementById('text_nrocuenta01_editar').value;
 	let cuenta02 = document.getElementById('text_cuenta02_editar').value;
 	let nro_cuenta02 = document.getElementById('text_nrocuenta02_editar').value;

	 let moned = document.getElementById('text_moneda_editar').value;
	 let cod_posta = document.getElementById('text_cod_post_editar').value;

	 let tipoigv = document.getElementById('text_tipo_igv_editar').value;
	 let igv = document.getElementById('text_igv_editar').value;
	 let moneda1 = document.getElementById('text_moenda1_editar').value;
	 let moneda2 = document.getElementById('text_moneda2_editar').value;
	 let nombresistema = document.getElementById('text_nombre_sist_editar').value;
	 let link_sist = document.getElementById('text_link_sist').value;
	 let codigo_pais = document.getElementById('text_codigo_pais').value;
	 let clave_co = document.getElementById('text_clave_correo').value;
	

 	if (razon.length ==0 || ruc.length==0 || repre.length== 0 || direccion.length== 0 || celular.length== 0 || correo.length== 0  ) {
 		ValidarCampos("text_razon_editar","text_ruc_editar","text_representante_editar","text_direccion_editar","text_celular_editar","text_correo_editar");
 		return Swal.fire("Mensaje de Advertencia","Tiene campos vacios","warning");
 	}
	 if (moned.length ==0) {
		return Swal.fire("Mensaje de Advertencia","Ingrese el simbolo de la moneda","warning");
	}
	if (tipoigv == "") {
		return Swal.fire("Mensaje de Advertencia","Ingrese un tipo de IGV","warning");
	}
	if (igv == "") {
		return Swal.fire("Mensaje de Advertencia","Ingrese el monto de IGV","warning");
	}
	if (moneda1 == "") {
		return Swal.fire("Mensaje de Advertencia","Ingrese nombre de moneda local","warning");
	}
	if (moneda2 == "") {
		return Swal.fire("Mensaje de Advertencia","Ingrese nombre de moneda centimos","warning");
	}
	if (nombresistema == "") {
		return Swal.fire("Mensaje de Advertencia","Ingrese el nombre del sistema","warning");
	}
	if (link_sist == "") {
		return Swal.fire("Mensaje de Advertencia","Ingrese el link del sistema","warning");
	}
	if (codigo_pais == "") {
		return Swal.fire("Mensaje de Advertencia","Ingrese el codigo del pais del sistema","warning");
	}

 	$.ajax({
 		url:'../controller/empresa/controlador_modificar_empresa.php',
 		type: 'POST',
 		data:{
 			id: id,//le enviamos los campos al controlador
 			razon: razon,
 			ruc: ruc,
 			repre: repre,
 			direccion: direccion,
 			celular: celular,
 			telefono: telefono,
 			correo: correo,
 			estado: estado,
 			url: url,
 			cuenta01: cuenta01,
 			nro_cuenta01: nro_cuenta01,
 			cuenta02: cuenta02,
 			nro_cuenta02: nro_cuenta02,
			moned:moned,
			cod_posta:cod_posta,
			tipoigv:tipoigv,
			igv:igv,
			moneda1:moneda1,
			moneda2:moneda2,
			nombresistema:nombresistema,
			link_sist:link_sist,
			codigo_pais:codigo_pais,
			clave_co:clave_co



 		}
 	}).done(function(resp){
 		if (resp>0) {
	 				//ValidarCampos("text_usuario_editar","","select_rol_editar");	
	 				Swal.fire("Mensaje de Confirmacion","Empresa actualizada","success").then((value)=>{
	 					$("#modal_editar_empresa").modal('hide');//ocultamos modal despues de registrar
	 					tbl_empresa.ajax.reload();//recargar dataTable
	 					//TraerNotificaciones();
	 				});	 			
	 		}else{
	 			Swal.fire("Mensaje de Error","No se puede modificar la Empresa","error");
	 		}
 	})
 }









  /********************************************************************
         CAMBIAR LOGO DE LA EMPRESA
 ********************************************************************/
 function ModificarFotoEmpresa(){
 	let id   = document.getElementById('idempresa_foto').value;
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
	 	nombrefoto="LOGO"+f.getDate()+""+(f.getMonth()+1)+""+f.getFullYear()+""+f.getHours()+""+f.getMilliseconds()+"."+extension;
	 }
	 let formData = new FormData();
	 let fotoObject = $("#text_foto_editar")[0].files[0];//objeto de la foto adjuntada
	 formData.append('id',id);
	 formData.append('rutaactual',rutaactual);
	 formData.append('nombrefoto',nombrefoto);
	 formData.append('foto',fotoObject);
	 $.ajax({
	 	url: '../controller/empresa/controlador_empresa_modificar_foto.php',
	 	type: 'POST',
	 	data:formData,
	 	contentType: false,
	 	processData: false,
	 	success: function(resp){
	 		if (resp>0) {
	 				Swal.fire("Mensaje de Confirmacion","Logo Actualizado","success").then((value)=>{
	 					$("#modal_editar_foto").modal('hide');//ocultamos modal despues de registrar
	 					tbl_empresa.ajax.reload();//recargar dataTable
	 					//TraerNotificaciones();
	 				});	 			
	 		}else{
	 			Swal.fire("Mensaje de Error","No se puede Actualizar la foto","error");
	 		}
	 	}	 	
	 });	 
 }
