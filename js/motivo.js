 /********************************************************************
 		LISTAR MOTIVO CON METODO NORMAL
 ********************************************************************/

var tbl_motivo;
//listar  con metodo normal
 function Listar_Motivo(){//enviarlo al scrip en MANTENIMIENTO ROL
	tbl_motivo = $("#tabla_motivo").DataTable({
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
			"url": "../controller/motivo/controlador_motivo_listar.php",
			type: 'POST'
		},
		"columns":[
		//todos los datos del procedimiento almacenado
		{"defaultContent": ""},//cintador 
		{"data": "motivo_descripcion"},
		{"data": "motivo_estado",
			render: function(data,type,row){
				if (data==="ACTIVO") {
					return "<center>"+'<span class="badge badge-success">ACTIVO</span>';+"</center>"
				}else{
					return "<center>"+'<span class="badge badge-danger">INACTIVO</span>';+"</center>"
				}
			}
		},
		{"defaultContent": "<center>"+"<span class=' editar text-primary px-1' style='cursor:pointer;' title='Editar datos'><i class='fa fa-edit'></i></span>&nbsp;"+"</center>"}


		],
		"language":idioma_espanol,
		select:true
	});
	//contador en cada tabla
	tbl_motivo.on('draw.td',function(){
		var PageInfo = $("#tabla_motivo").DataTable().page.info();
		tbl_motivo.column(0,{page: 'current'}).nodes().each(function(cell,i){
			cell.innerHTML = i + 1 + PageInfo.start;
		});
	});
 }





 /********************************************************************
 		   ABRIR MODAL REGISTRAR  MOTIVO
 ********************************************************************/ 
 function AbrirModalRegistroMotivo(){
 	//para que no se nos salga del modal haciendo click a los costados
 	$("#modal_registro_motivo").modal({backdrop:'static', keyboard: false});	
 	$("#modal_registro_motivo").modal('show');//abrimos el modal
 	document.getElementById('text_motivo').value="";
 	$('.form-control').removeClass("is-invalid").removeClass("is-valid");//remover las clases
 }


 



  /**********************************************************************
 		  ABRIR MODAL EDITAR Y TRAER DATOS A LOS CAMPOS
 ***********************************************************************/
 $('#tabla_motivo').on('click', '.editar', function() {//class foto tiene que ir en el boton
	var data = tbl_motivo.row($(this).parents('tr')).data();//tamaño de escritorio
	if (tbl_motivo.row(this).child.isShown()) {
		var data = tbl_motivo.row(this).data();//para celular y usas el responsive datatable
	}
		$("#modal_editar_motivo").modal({backdrop:'static', keyboard: false});	
		$("#modal_editar_motivo").modal('show');//abrimos el modal
		//LimpiarModalUsuario();
		//mandamos parametros a los texbox
		//document.getElementById('idrol').value=data[0];
		document.getElementById('idmotivo').value=data.motivo_id;//id del procedure
		document.getElementById('text_motivo_editar').value=data.motivo_descripcion;//enviamos el nombre del usu al modal
		//console.log(data.rol_id);//para enviar el dato  en console
		$("#select_estado_motivo_editar").select2().val(data.motivo_estado).trigger('change.select2');
 });






  /**********************************************************************
 							  REGISTRAR MOTIVO
 ***********************************************************************/
 function RegistrarMotivo(){
 	let motivo = document.getElementById('text_motivo').value;
 	//let estado = document.getElementById('select_estado').value;
 	if (motivo.length ==0 ) {
 		return Swal.fire("Mensaje de Advertencia","Tiene campos vacios","warning");
 	}
 
	$.ajax({
 		url:'../controller/motivo/controlador_motivo_registar.php',
 		type: 'POST',
 		data:{
 			motivo: motivo//le enviamos los campos al controlador
 			//estado: estado

 		}
 	}).done(function(resp){
 		if (resp>0) {
 			if (resp==1) {//validamos la respuesta del procedure si retorna 1 o 2
 				Swal.fire("Mensaje de Confirmacion","motivo Registrado","success").then((value)=>{
	 					document.getElementById('text_motivo').value="";
	 					$("#modal_registro_motivo").modal('hide');//abrimos el modal

	 					tbl_motivo.ajax.reload();//recargar dataTable
	 					//TraerNotificaciones();
	 				});	
 			}else{
 				Swal.fire("Mensaje de Advertencia","El motivo ya se encuentra registrado","warning");
 			}
	 				 			
	 		}else{
	 			Swal.fire("Mensaje de Error","No se puede registrar el motivo","error");
	 		}
 	})	 
 }



 /**********************************************************************
 							  MODIFICAR MOTIVO
 ***********************************************************************/
 function ModificarMotivo(){
 	let id = document.getElementById('idmotivo').value;
 	let motivo = document.getElementById('text_motivo_editar').value;
 	let estado = document.getElementById('select_estado_motivo_editar').value;
 	if (motivo.length ==0 ) {
 		return Swal.fire("Mensaje de Advertencia","Tiene campos vacios","warning");
 	}
 
	$.ajax({
 		url:'../controller/motivo/controlador_motivo_modificar.php',
 		type: 'POST',
 		data:{
 			id: id,
 			motivo: motivo,//le enviamos los campos al controlador
 			estado: estado

 		}
 	}).done(function(resp){	
		if (resp>0) {
 			if (resp==1) {//validamos la respuesta del procedure si retorna 1 o 2 ()
 				Swal.fire("Mensaje de Confirmacion","Motivo Actualizado","success").then((value)=>{
	 					$("#modal_editar_motivo").modal('hide');//abrimos el modal
	 					tbl_motivo.ajax.reload();//recargar dataTable
	 					//TraerNotificaciones();
	 				});	
 			}else{
 				Swal.fire("Mensaje de Advertencia","El Motivo ya se encuentra registrado","warning");
 			}
	 				 			
	 		}else{
	 			Swal.fire("Mensaje de Error","No se puede registrar el Motivo","error");
	 		}
 		
 	})	 
 }










