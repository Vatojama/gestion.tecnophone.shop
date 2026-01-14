 /********************************************************************
 		LISTAR CTAEGORIA CON METODO NORMAL
 ********************************************************************/

var tbl_categoria;
 function Listar_Categoria(){//enviarlo al scrip en MANTENIMIENTO ROL
	tbl_categoria = $("#tabla_categoria").DataTable({
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
			"url": "../controller/categoria/controlador_categoria_listar.php",
			type: 'POST'
		},
		"columns":[
		//todos los datos del procedimiento almacenado
		//{"defaultContent": ""},//cintador 
		{"data": "categoria_id"},
		{"data": "categoria_descripcion"},
		{"data": "categoria_estado",
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
	/*contador en cada tabla
	tbl_categoria.on('draw.td',function(){
		var PageInfo = $("#tabla_categoria").DataTable().page.info();
		tbl_categoria.column(0,{page: 'current'}).nodes().each(function(cell,i){
			cell.innerHTML = i + 1 + PageInfo.start;
		});
	});*/
 }




 /********************************************************************
 		   ABRIR MODAL REGISTRAR  CATEGORIA
 ********************************************************************/ 
 function AbrirModalRegistroCategoria(){
 	//para que no se nos salga del modal haciendo click a los costados
 	$("#modal_registro_categoria").modal({backdrop:'static', keyboard: false});	
 	$("#modal_registro_categoria").modal('show');//abrimos el modal
 	document.getElementById('text_categoria').value="";
 	//LimpiarModalUsuario();//limpiar texbox cada que demos en nuevo
 	$('.form-control').removeClass("is-invalid").removeClass("is-valid");//remover las clases
 }

 




  /**********************************************************************
 		  ABRIR MODAL EDITAR Y TRAER DATOS A LOS CAMPOS
 ***********************************************************************/
 $('#tabla_categoria').on('click', '.editar', function() {//class foto tiene que ir en el boton
	var data = tbl_categoria.row($(this).parents('tr')).data();//tamaño de escritorio
	if (tbl_categoria.row(this).child.isShown()) {
		var data = tbl_categoria.row(this).data();//para celular y usas el responsive datatable
	}
		$("#modal_editar_categoria").modal({backdrop:'static', keyboard: false});	
		$("#modal_editar_categoria").modal('show');//abrimos el modal
		//LimpiarModalUsuario();
		//mandamos parametros a los texbox
		//document.getElementById('idrol').value=data[0];
		document.getElementById('idcategoria').value=data.categoria_id;//id del procedure
		document.getElementById('text_categoria_editar').value=data.categoria_descripcion;//enviamos el nombre del usu al modal
		//console.log(data.rol_id);//para enviar el dato  en console
		$("#select_estado_categoria_editar").select2().val(data.categoria_estado).trigger('change.select2');
 });






  /**********************************************************************
 							  REGISTRAR CATEGORIA
 ***********************************************************************/
 function RegistrarCategoria(){
 	let categoria = document.getElementById('text_categoria').value;
 	//let estado = document.getElementById('select_estado').value;
 	if (categoria.length ==0 ) {
 		return Swal.fire("Mensaje de Advertencia","Tiene campos vacios","warning");
 	}
 
	$.ajax({
 		url:'../controller/categoria/controlador_categoria_registar.php',
 		type: 'POST',
 		data:{
 			categoria: categoria//le enviamos los campos al controlador
 			//estado: estado

 		}
 	}).done(function(resp){
 		if (resp>0) {
 			if (resp==1) {//validamos la respuesta del procedure si retorna 1 o 2
 				Swal.fire("Mensaje de Confirmacion","categoria Registrado","success").then((value)=>{
	 					document.getElementById('text_categoria').value="";
	 					$("#modal_registro_categoria").modal('hide');//abrimos el modal

	 					tbl_categoria.ajax.reload();//recargar dataTable
	 					//TraerNotificaciones();
	 				});	
 			}else{
 				Swal.fire("Mensaje de Advertencia","La categoria ya se encuentra registrado","warning");
 			}
	 				 			
	 		}else{
	 			Swal.fire("Mensaje de Error","No se puede registrar la categoria","error");
	 		}
 	})	 
 }






 /**********************************************************************
 							  MODIFICAR CATEGORIA
 ***********************************************************************/
 function ModificarCategoria(){
 	let id = document.getElementById('idcategoria').value;
 	let categoria = document.getElementById('text_categoria_editar').value;
 	let estado = document.getElementById('select_estado_categoria_editar').value;
 	if (categoria.length ==0 || estado.length == 0 ) {
 		return Swal.fire("Mensaje de Advertencia","Tiene campos vacios","warning");
 	}
 
	$.ajax({
 		url:'../controller/categoria/controlador_categoria_modificar.php',
 		type: 'POST',
 		data:{
 			id: id,
 			categoria: categoria,//le enviamos los campos al controlador
 			estado: estado

 		}
 	}).done(function(resp){	
		if (resp>0) {
 			if (resp==1) {//validamos la respuesta del procedure si retorna 1 o 2 ()
 				Swal.fire("Mensaje de Confirmacion","categoria Actualizado","success").then((value)=>{
	 					$("#modal_editar_categoria").modal('hide');//abrimos el modal
	 					tbl_categoria.ajax.reload();//recargar dataTable
	 					//TraerNotificaciones();
	 				});	
 			}else{
 				Swal.fire("Mensaje de Advertencia","categoria ya se encuentra registrado","warning");
 			}
	 				 			
	 		}else{
	 			Swal.fire("Mensaje de Error","No se puede registrar categoria","error");
	 		}
 		
 	})	 
 }








