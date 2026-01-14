 /********************************************************************
 		LISTAR MARCA CON METODO NORMAL
 ********************************************************************/
var tbl_marca;
 function Listar_Marca(){//enviarlo al scrip en MANTENIMIENTO ROL
	tbl_marca = $("#tabla_marca").DataTable({
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
			"url": "../controller/marca/controlador_marca_listar.php",
			type: 'POST'
		},
		"columns":[
		//todos los datos del procedimiento almacenado
		//{"defaultContent": ""},//cintador 
		{"data": "marca_id"},
		{"data": "marca_descripcion"},
		{"data": "marca_estado",
			render: function(data,type,row){
				if (data==="ACTIVO") {
					return "<center>"+'<span class="badge badge-success">ACTIVO</span>'+"</center>";
				}else{
					return "<center>"+'<span class="badge badge-danger">INACTIVO</span>'+"</center>";
				}
			}
		},
		{"defaultContent": "<center>"+"<span class='editar text-primary px-1' style='cursor:pointer;' data-bs-toggle='tooltip' data-bs-placement='top' title='Editar'><i class= 'fa fa-edit'></i></span> <span class=' eliminar text-danger px-1' style='cursor:pointer;' data-bs-toggle='tooltip' data-bs-placement='top' title='Eliminar'><i class='fa fa-trash'></i></span>"+"</center>"}


		],
		"language":idioma_espanol,
		select:true
	});
	/*contador en cada tabla
	tbl_marca.on('draw.td',function(){
		var PageInfo = $("#tabla_marca").DataTable().page.info();
		tbl_marca.column(0,{page: 'current'}).nodes().each(function(cell,i){
			cell.innerHTML = i + 1 + PageInfo.start;
		});
	});*/
 }	


 /********************************************************************
 		   ABRIR MODAL REGISTRAR LA MARCA
 ********************************************************************/
 function AbrirModalRegistroMarca(){
 	//para que no se nos salga del modal haciendo click a los costados
 	$("#modal_registro_marca").modal({backdrop:'static', keyboard: false});	
 	$("#modal_registro_marca").modal('show');//abrimos el modal
 	document.getElementById('text_marca').value="";
 	//LimpiarModalUsuario();//limpiar texbox cada que demos en nuevo
 	$('.form-control').removeClass("is-invalid").removeClass("is-valid");//remover las clases
 }



 /**********************************************************************
 		  ABRIR MODAL EDITAR Y TRAER DATOS A LOS CAMPOS
 ***********************************************************************/
 $('#tabla_marca').on('click', '.editar', function() {//class foto tiene que ir en el boton
	var data = tbl_marca.row($(this).parents('tr')).data();//tamaño de escritorio
	if (tbl_marca.row(this).child.isShown()) {
		var data = tbl_marca.row(this).data();//para celular y usas el responsive datatable
	}
		$("#modal_editar_marca").modal({backdrop:'static', keyboard: false});	
		$("#modal_editar_marca").modal('show');//abrimos el modal
		//LimpiarModalUsuario();
		//mandamos parametros a los texbox
		//document.getElementById('idrol').value=data[0];
		document.getElementById('idmarca').value=data.marca_id;//id del procedure
		document.getElementById('text_marca_editar').value=data.marca_descripcion;//enviamos el nombre del usu al modal
		//console.log(data.rol_id);//para enviar el dato  en console
		$("#select_estado_marca_editar").select2().val(data.marca_estado).trigger('change.select2');
 });





  /**********************************************************************
 				MENSAJE ELIMINAR MARCA
 ***********************************************************************/
 $('#tabla_marca').on('click', '.eliminar', function() {//campo activar tiene que ir en el boton
	var data = tbl_marca.row($(this).parents('tr')).data();//tamaño de escritorio
	if (tbl_marca.row(this).child.isShown()) {
		var data = tbl_marca.row(this).data();//para celular y usas el responsive datatable
	}
	Swal.fire({
	  title: 'Desea Eliminar la marca?',
	  text: "Se borrara el registro de la base de datos",
	  icon: 'warning',
	  showCancelButton: true,
	  confirmButtonColor: '#3085d6',
	  cancelButtonColor: '#d33',
	  confirmButtonText: 'Si, confirmar'
	}).then((result) => {
	  if (result.isConfirmed) {
	   Eliminar_Marca(data.marca_id);//campo id de la marca luego llamamos al metodo
	  }
	})
 });



 /********************************************************************
 		    METODO   ELIMINAR LA MARCA
 ********************************************************************/
 function Eliminar_Marca(id){
	$.ajax({
 		url:'../controller/marca/controlador_marca_eliminar.php',
 		type: 'POST',
 		data:{
 			id: id//le enviamos los campos al controlador


 		}
 	}).done(function(resp){
 		if (resp>0) {
	 				Swal.fire("Mensaje de Confirmacion","Marca Eliminada","success").then((value)=>{
	 					tbl_marca.ajax.reload();//recargar dataTable
	 					//TraerNotificaciones();
	 				});	 			
	 		}else{
	 			Swal.fire("Mensaje de Error","No se puede eliminar la marca","error");
	 		}
 	})
 }



 /********************************************************************
 		       REGISTRAR LA MARCA
 ********************************************************************/
 function RegistrarMarca(){
 	let marca = document.getElementById('text_marca').value;
 	if (marca.length ==0 ) {
 		return Swal.fire("Mensaje de Advertencia","Tiene campos vacios","warning");
 	}
 
	$.ajax({
 		url:'../controller/marca/controlador_marca_registar.php',
 		type: 'POST',
 		data:{
 			marca: marca//le enviamos los campos al controlador
 			//estado: estado

 		}
 	}).done(function(resp){
 		if (resp>0) {
 			if (resp==1) {//validamos la respuesta del procedure si retorna 1 o 2
 				Swal.fire("Mensaje de Confirmacion","Marca Registrada","success").then((value)=>{
	 					document.getElementById('text_marca').value="";
	 					$("#modal_registro_marca").modal('hide');//abrimos el modal

	 					tbl_marca.ajax.reload();//recargar dataTable
	 				});	
 			}else{
 				Swal.fire("Mensaje de Advertencia","La Marca ya se encuentra registrada","warning");
 			}
	 				 			
	 		}else{
	 			Swal.fire("Mensaje de Error","No se puede registrar la Marca","error");
	 		}
 	})	 
 }




  /******************************************************************
 		       MODIFICAR LA MARCA
 ********************************************************************/
 function ModificarMarca(){
 	let id = document.getElementById('idmarca').value;
 	let marca = document.getElementById('text_marca_editar').value;
 	let estado = document.getElementById('select_estado_marca_editar').value;
 	if (marca.length ==0 ) {
 		return Swal.fire("Mensaje de Advertencia","Tiene campos vacios","warning");
 	}

 	/*if (estado.length == 0 ) {
 		return Swal.fire("Mensaje de Advertencia","Seleccione el estado de la marca","warning");
 	}*/
 
	$.ajax({
 		url:'../controller/marca/controlador_marca_modificar.php',
 		type: 'POST',
 		data:{
 			id: id,
 			marca: marca,//le enviamos los campos al controlador
 			estado: estado

 		}
 	}).done(function(resp){	
		if (resp>0) {
 			if (resp==1) {//validamos la respuesta del procedure si retorna 1 o 2 ()
 				Swal.fire("Mensaje de Confirmacion","Marca Actualizada","success").then((value)=>{
	 					$("#modal_editar_marca").modal('hide');//abrimos el modal
	 					tbl_marca.ajax.reload();//recargar dataTable
	 				});	
 			}else{
 				Swal.fire("Mensaje de Advertencia","La Marca ya se encuentra registrada","warning");
 			}
	 				 			
	 		}else{
	 			Swal.fire("Mensaje de Error","No se puede registrar la Marca","error");
	 		}
 		
 	})	 
 }