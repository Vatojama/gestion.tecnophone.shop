 /********************************************************************
 		LISTAR TIPO DE PAGO CON METODO NORMAL
 ********************************************************************/
var tbl_fpago;
 function Listar_FormaPAgo(){//enviarlo al scrip en MANTENIMIENTO ROL
	tbl_fpago = $("#tabla_forma_pago").DataTable({
		"responsive":true,
		"ordering" :false,
		"bLengthChange" : true,
		"searching" : {"regex" : false},
		"lengthMenu" : [[10, 25, 50, 100, -1],[10, 25, 50, 100, "All"]],
		"pageLength" : 10,
		"destroy" :true,
		"async" : false,
		"processing": true,
		"ajax" : {
			"url": "../controller/formaPago/controlador_formaPago_listar.php",
			type: 'POST'
		},
		"columns":[
		//todos los datos del procedimiento almacenado
		{"defaultContent": ""},//cintador 
		{"data": "fpago_descripcion"},
		{"data": "fpago_estado",
			render: function(data,type,row){
				if (data==="ACTIVO") {
					return "<center>"+'<span class="badge badge-success">ACTIVO</span>'+"</center>";
				}else{
					return "<center>"+'<span class="badge badge-danger">INACTIVO</span>'+"</center>";
				}
			}
		},
		{"defaultContent": "<center>"+"<span class='editar text-primary px-1' style='cursor:pointer;' data-bs-toggle='tooltip' data-bs-placement='top' title='Editar'><i class= 'fa fa-edit'></i></span> "+"</center>"}


		],
		"language":idioma_espanol,
		select:true
	});
	//contador en cada tabla
	tbl_fpago.on('draw.td',function(){
		var PageInfo = $("#tabla_forma_pago").DataTable().page.info();
		tbl_fpago.column(0,{page: 'current'}).nodes().each(function(cell,i){
			cell.innerHTML = i + 1 + PageInfo.start;
		});
	});
 }	





 /********************************************************************
 		   ABRIR MODAL REGISTRAR LA FORMA PAGO
 ********************************************************************/
 function AbrirModalRegistroFormaPago(){
 	//para que no se nos salga del modal haciendo click a los costados
 	$("#modal_registro_forma_pago").modal({backdrop:'static', keyboard: false});	
 	$("#modal_registro_forma_pago").modal('show');//abrimos el modal
 	document.getElementById('text_f_pago').value="";
 	//LimpiarModalUsuario();//limpiar texbox cada que demos en nuevo
 	$('.form-control').removeClass("is-invalid").removeClass("is-valid");//remover las clases
 }



 /**********************************************************************
 		  ABRIR MODAL EDITAR Y TRAER DATOS A LOS CAMPOS
 ***********************************************************************/
 $('#tabla_forma_pago').on('click', '.editar', function() {//class foto tiene que ir en el boton
	var data = tbl_fpago.row($(this).parents('tr')).data();//tamaño de escritorio
	if (tbl_fpago.row(this).child.isShown()) {
		var data = tbl_fpago.row(this).data();//para celular y usas el responsive datatable
	}
		$("#modal_editar_forma_Pago").modal({backdrop:'static', keyboard: false});	
		$("#modal_editar_forma_Pago").modal('show');//abrimos el modal
		//LimpiarModalUsuario();
		//mandamos parametros a los texbox
		//document.getElementById('idrol').value=data[0];
		document.getElementById('idformapago').value=data.fpago_id;//id del procedure
		document.getElementById('text_f_pago_editar').value=data.fpago_descripcion;//enviamos el nombre del usu al modal
		//console.log(data.rol_id);//para enviar el dato  en console
		$("#select_estado_fpago_editar").select2().val(data.fpago_estado).trigger('change.select2');
 });


 /********************************************************************
 		       REGISTRAR LA MARCA
 ********************************************************************/
 function RegistrarFormaPago(){
 	let formap = document.getElementById('text_f_pago').value;
 	if (formap.length ==0 ) {
 		return Swal.fire("Mensaje de Advertencia","Tiene campos vacios","warning");
 	}
 
	$.ajax({
 		url:'../controller/formaPago/controlador_formaPago_registar.php',
 		type: 'POST',
 		data:{
 			formap: formap//le enviamos los campos al controlador
 			//estado: estado

 		}
 	}).done(function(resp){
 		if (resp>0) {
 			if (resp==1) {//validamos la respuesta del procedure si retorna 1 o 2
 				Swal.fire("Mensaje de Confirmacion","Forma de Pago Registrada","success").then((value)=>{
	 					document.getElementById('text_f_pago').value="";
	 					$("#modal_registro_forma_pago").modal('hide');//ocultamos el modal

	 					tbl_fpago.ajax.reload();//recargar dataTable
	 				});	
 			}else{
 				Swal.fire("Mensaje de Advertencia","La Forma de Pago  ya se encuentra registrada","warning");
 			}
	 				 			
	 		}else{
	 			Swal.fire("Mensaje de Error","No se puede registrar la Forma de Pago ","error");
	 		}
 	})	 
 }





  /******************************************************************
 		       MODIFICAR LA FORMA PAGO
 ********************************************************************/
 function ModificarFormaPago(){
 	let id = document.getElementById('idformapago').value;
 	let formap = document.getElementById('text_f_pago_editar').value;
 	let estado = document.getElementById('select_estado_fpago_editar').value;
 	if (formap.length ==0 ) {
 		return Swal.fire("Mensaje de Advertencia","Tiene campos vacios","warning");
 	}

 	/*if (estado.length == 0 ) {
 		return Swal.fire("Mensaje de Advertencia","Seleccione el estado de la marca","warning");
 	}*/
 
	$.ajax({
 		url:'../controller/formaPago/controlador_formaPago_modificar.php',
 		type: 'POST',
 		data:{
 			id: id,
 			formap: formap,//le enviamos los campos al controlador
 			estado: estado

 		}
 	}).done(function(resp){	
		if (resp>0) {
 			if (resp==1) {//validamos la respuesta del procedure si retorna 1 o 2 ()
 				Swal.fire("Mensaje de Confirmacion","Forma de Pago  Actualizada","success").then((value)=>{
	 					$("#modal_editar_forma_Pago").modal('hide');//abrimos el modal
	 					tbl_fpago.ajax.reload();//recargar dataTable
	 				});	
 			}else{
 				Swal.fire("Mensaje de Advertencia","La Forma de Pago  ya se encuentra registrada","warning");
 			}
	 				 			
	 		}else{
	 			Swal.fire("Mensaje de Error","No se puede registrar la Forma de Pago ","error");
	 		}
 		
 	})	 
 }




