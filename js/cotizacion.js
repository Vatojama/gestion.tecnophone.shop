 /********************************************************************
 		LISTAR COTIZACION METODO NORMAL
 ********************************************************************/

var tbl_cotizacion;
 function Listar_Cotizacion(){//enviarlo al scrip en MANTENIMIENTO ROL
 	var finicio = document.getElementById('text_finicio').value;
 	var ffin = document.getElementById('text_ffin').value;
	tbl_cotizacion = $("#tabla_cotizacion").DataTable({		
		"responsive" :true,
		"ordering" :false,
		"bLengthChange" : true,
		"searching" : {"regex" : false},
		"lengthMenu" : [[10, 25, 50, 100, -1],[10, 25, 50, 100, "All"]],
		"pageLength" : 10,
		"destroy" :true,
		"async" : false,
		"processing": true,
		"dom": 'Blfrtip',
		"buttons":[
			{
		       "extend":    'excelHtml5',
		        "title": 'Reporte Venta',
		        "exportOptions":{
		        	'columns':[0,1,2,3,4,5,6,7]
		        },
		       "text":      '<i class="fa fa-file-excel"></i>',
		       "titleAttr": 'Exportar a Excel'
		    },
			
		],
		"ajax" : {
			"url": "../controller/cotizacion/controlador_cotizacion_listar.php",
			type: 'POST',
			data:{
				finicio:finicio,
				ffin:ffin
			}
		},
		"columns":[
		//todos los datos del procedimiento almacenado
		{"defaultContent": ""},//cintador 
		{"data": "cliente_nombres"},
		{"data": "cotizacion"},
		{"data": "coti_total"},
		{"data": "coti_fregistro"},
		{"data": "usu_nombre"},
		{"data": "coti_estado",
			render: function(data,type,row){
				if (data==="ACTIVO") {
					return "<center>"+'<span class="badge badge-success">ACTIVO</span>';+"</center>"
				}else{
					return "<center>"+'<span class="badge badge-danger">INACTIVO</span>';+"</center>"
				}
				
			}
		},
		{"data":"coti_estado",//editar
			render: function(data,type,row){
				if(data==="ACTIVO"){
					return "<center>"+"<span class='imprimir text-primary px-1' style='cursor:pointer;' title='Imprimir Cotizacion'><i class= 'fa fa-print'></i></span><span class='anular text-danger px-1' style='cursor:pointer;' title='Desactivar Cotizacion'><i class= 'fa fa-trash'></i></span><span class=' text-secundary px-1' style='cursor:pointer;' title='Activar Cotizacion' disabled><i class= 'fa fa-check-circle'></i></span>"+"</center>"
				}else{
					return "<center>"+"<span class=' text-secundary px-1' style='cursor:pointer;' title='Imprimir Cotizacion'><i class= 'fa fa-print'></i></span><span class='text-secundary px-1' style='cursor:pointer;' title='Desactivar Cotizacion' disabled><i class= 'fa fa-trash'></i></span><span class='activar text-success px-1' style='cursor:pointer;' title='Activar Cotizacion'><i class= 'fa fa-check-circle'></i></span>"+"</center>"
				}			
			}
		},

		],
		"language":idioma_espanol,
		select:true
	});
	//contador en cada tabla
	tbl_cotizacion.on('draw.td',function(){
		var PageInfo = $("#tabla_cotizacion").DataTable().page.info();
		tbl_cotizacion.column(0,{page: 'current'}).nodes().each(function(cell,i){
			cell.innerHTML = i + 1 + PageInfo.start;
		});
	});
 }	


 /********************************************************************
       CARGAR FORMA DE PAGO EN COMBO
 ********************************************************************/
 function cargar_Select_FormaPAgo(){//enviamos al scrpit mantenimiento examen
  $.ajax({
    url:'../controller/cotizacion/controlador_cargar_select_forma_pago.php',
    type: 'POST'
  }).done(function(resp){
    let data = JSON.parse(resp);//POSICION DE LA FILA Y COLUMNA
    let llenardata = "<option value=''>Seleccione</option>";
    if (data.length>0) {
      for (let i = 0; i < data.length; i++) {
        llenardata+="<option value='"+data[i][0]+"'>"+data[i][1]+"</option>";
      }
      document.getElementById('select_forma_pago').innerHTML = llenardata;//primero para registrar luego en modificar colocamos el select editar
    }else{
      llenardata+="<option value=''>No se encontraron datos</option>";
      document.getElementById('select_forma_pago').innerHTML = llenardata;

    }
  })
 }


 /********************************************************************
 		PARA IMPRIMIR COTIZACION
 ********************************************************************/
 $('#tabla_cotizacion').on('click', '.imprimir', function() {//class foto tiene que ir en el boton
	var data = tbl_cotizacion.row($(this).parents('tr')).data();//tamaño de escritorio
	if (tbl_cotizacion.row(this).child.isShown()) {
		var data = tbl_cotizacion.row(this).data();//para celular y usas el responsive datatable
	}
	window.open("../MPDF/reporte_cotizacion.php?codigo="+parseInt(data.coti_id)+"#zoom=100", "COTIZACION","scrollbards=NO");
		
 });







 /********************************************************************
 		BOTON AGREGAR PRODUCTOS AL DETALLE 
 ********************************************************************/
function Agregar_Producto(){

	let idproducto = document.getElementById('text_idproducto').value;
	let producto = document.getElementById('text_producto').value;	
	let cantidad = document.getElementById('text_cantidad').value;
	let stock = document.getElementById('text_stock').value;
	let precio = document.getElementById('text_precio').value;
	let subtotal = precio*cantidad;//lo llamamos en el detalle posision 4
	let impuesto = document.getElementById('text_impuesto').value;
	let tipo = document.getElementById('select_tipo_com').value;
	let productonombre = document.getElementById('text_nombre_producto').value;

	
	if(tipo==2){
		if(impuesto.length==0){
			return Swal.fire("Mensaje de Advertencia","Debe llenar el impuesto antes de agregar un producto","warning");
		}
		if(impuesto>1.00){
			return Swal.fire("Mensaje de Advertencia","No puede asignar ese impuesto","warning");
		}

	}
	if (parseFloat(stock) <  parseFloat(cantidad)) {
 		return Swal.fire("Mensaje de Advertencia","El producto no tiene el Stock suficiente","warning");
 	}


	if (producto.length == 0 ) {
 		return Swal.fire("Mensaje de Advertencia","Ingrese un Producto","warning");
 	}
	
	if (cantidad.length == 0 ) {
 		return Swal.fire("Mensaje de Advertencia","Ingrese una cantidad","warning");
 	}

 	if (parseInt(cantidad )<1) {
 		return Swal.fire("Mensaje de Advertencia","La cantidad debe ser mayor a 0","warning");
 	}

 	if (parseInt(precio )<0.1) {
 		return Swal.fire("Mensaje de Advertencia","El precio debe ser mayor a 0","warning");
 	}

 	 //llamamos la funcion para verificar si ya esta agregado en el detalle
	if (verificarid(idproducto)){
 	return Swal.fire("Mensaje de Advertencia","El Producto ya esta agregado","warning");
	 }

 	let datos_agregar = "<tr>"; //para agregar en el detalle DEL EXAMEN
 	datos_agregar+= "<td for='id'>"+idproducto+"</td>";//hace referenci al verificar id
 	datos_agregar+= "<td> "+productonombre+"</td>";
 	datos_agregar+= "<td>"+precio+"</td>";
 	datos_agregar+= "<td>"+cantidad+"</td>";
 	datos_agregar+= "<td>"+subtotal+"</td>";
 	datos_agregar+= "<td><button class='btn btn-danger btn-sm remove2'  ><i class ='fa fa-trash'></i> </button></td>";
	datos_agregar+= "</tr>";//cierre de etiqueta
 	$("#tbody_tabla_detalle_pro").append(datos_agregar);//agregamos a la tabla style="text-align: center;"
 	LimpiarModalProducto();
 	SumarTotalneto();
 }




 /********************************************************************
 					  LIMPIAR TEXBOX PRODUCTO
 ********************************************************************/
function LimpiarModalProducto(){
	document.getElementById('text_producto').value="";
	document.getElementById('text_stock').value="";
	document.getElementById('text_precio').value="";
	document.getElementById('text_cantidad').value="";
	//$("#text_producto").select2().val("").trigger('change.select2');
		$('#text_producto').val(null).trigger('change');


 }



/********************************************************************
 		PARA QUE NO SE REPITA UN PRODUCTO EN EL DETALLE
 ********************************************************************/
function verificarid(id){
	let idverificar = document.querySelectorAll('#tabla_detalle_pro td[for="id"]');//id del examen
	return [].filter.call(idverificar, td=> td.textContent === id).length===1;
}




 /********************************************************************
 		REMOVER ITEM DEL DETALLE
 ********************************************************************/
function remove(t){
	var td = t.parentNode;
	var tr = td.parentNode;
	var table = tr.parentNode;
	table.removeChild(tr);
	SumarTotalneto();
}


 $('#tbody_tabla_detalle_pro').on('click', '.remove2', function() {//campo activar tiene que ir en el boton
	var data = tbl_cotizacion.row($(this).parents('tr')).data();//tamaño de escritorio
	if (tbl_cotizacion.row(this).child.isShown()) {
		var data = tbl_cotizacion.row(this).data();//para celular y usas el responsive datatable
	}
	Swal.fire({
	  title: 'Desea remover el articulo?',
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





 /********************************************************************
 		SUMAR EN LOS LBL
 ********************************************************************/
function SumarTotalneto(){
	let arreglo_total = new Array();
	let count = 0;
	let total = 0;
	let impuestototal=0;
	let impuesto = document.getElementById('text_impuesto').value;
	let subtotal=0;
	$("#tabla_detalle_pro  tbody#tbody_tabla_detalle_pro tr ").each(function(){
		arreglo_total.push($(this).find('td').eq(4).text());//sub total
		count++;
	})
	for (var i = 0; i < count; i++){
		var suma = arreglo_total[i];
		subtotal = (parseFloat(subtotal) + parseFloat(suma)).toFixed(2);//suma del sub total
		impuestototal= parseFloat(subtotal*impuesto).toFixed(2);
	};
	total =parseFloat(subtotal)+parseFloat(impuestototal);
	//calcula si es factura o boleta (factura es 2)
	let tipo = document.getElementById('select_tipo_com').value;
	if(impuesto.length >0){
		$("#lbl_subtotal").html("<b>Sub Total:  </b> S/. "+subtotal);
		$("#lbl_impuesto").html("<b>IGV "+impuesto*100+"%: </b> S/."+impuestototal);
		$("#lbl_totalneto").html("<b>Total: </b> S/."+total.toFixed(2));

		$("#totalVenta").html(total.toFixed(2));
		$("#boleta_total").html(total.toFixed(2));
		$("#boleta_subtotal").html(subtotal);
		$("#boleta_igv").html(impuestototal);
	} else if (impuesto.length == 0) {
		$("#lbl_totalneto").html("<b>Total: </b> S/."+total.toFixed(2));
		$("#totalVenta").html(total.toFixed(2));
		$("#boleta_total").html(total.toFixed(2));
		$("#boleta_subtotal").html(subtotal);
		$("#boleta_igv").html(impuestototal);

	}else{
		$("#lbl_totalneto").html("<b>Total: </b> S/."+total.toFixed(2));

		$("#totalVenta").html(total.toFixed(2));
		$("#boleta_total").html(total.toFixed(2));
		$("#boleta_subtotal").html(subtotal);
		$("#boleta_igv").html(impuestototal);
	}
	/*if(tipo==4){
		$("#lbl_subtotal").html("<b>Sub Total:  </b> S/. "+subtotal);
		$("#lbl_impuesto").html("<b>IGV "+impuesto*100+"%: </b> S/."+impuestototal);
		$("#lbl_totalneto").html("<b>Total: </b> S/."+total.toFixed(2));
	}else{
		$("#lbl_totalneto").html("<b>Total: </b> S/."+total.toFixed(2));
	}*/
}




 /********************************************************************
 		REGISTRAR COTIZACION CABECERA
 ********************************************************************/
function Registrar_Cotizacion(){
	let count=0; //para validar que el detalle tenga un dato
	//recorremos la tabla
	$("#tabla_detalle_pro  tbody#tbody_tabla_detalle_pro tr ").each(function(){
		count++; //cuenta las filas 
	})
	//alert(count);

	//validamos con mensaje que tenga datos en el detalle
	/*if (count==0) {
		return Swal.fire("Mensaje de Advertencia","Debe agregar un Producto en el detalle de la venta","warning");
	}*/

   //declaramos los campos y se jalan del index del form
	
	let idproveedor = document.getElementById('text_idproveedor').value;	
	let compro = document.getElementById('text_compro').value;
	let serie = document.getElementById('text_serie').value;
	//let numero = document.getElementById('text_num_compro').value;
	let impuesto =  document.getElementById('lbl_impuesto').innerHTML.substr(20);
	let total = document.getElementById('lbl_totalneto').innerHTML.substr(18);	
	let tipo = document.getElementById('select_tipo_com').value;
	let porcentaje = document.getElementById('text_impuesto').value;
	let idusuario = document.getElementById('text_Idprincipal').value;//id_usuario esta en el index como text_Idprincipal
	let atiende = document.getElementById('text_atiende').value;

	let dias = document.getElementById('text_dias_validez').value;
	let fpago = document.getElementById('select_forma_pago').value;

	/*if(impuesto.length >0){
		porcentaje = document.getElementById('text_impuesto').value;//campo
		impuesto = document.getElementById('lbl_impuesto').innerHTML.substr(20);//campo del detalle
	}else{
		porcentaje = 0;
		impuesto = 0;
	}*/


 	if (fpago.length == 0 ) {
 		return Swal.fire("Mensaje de Advertencia","Seleccione una Forma de Pago","warning");
 	}
	 if (dias == "") {
		return Swal.fire("Mensaje de Advertencia","Ingrese los dias de validez de Cotizacion","warning");
	}


	//valida que se seleccione un cliente o comprobante
	if (idproveedor.length ==0) {
		return Swal.fire("Mensaje de Advertencia","Debe seleccionar un Cliente","warning");
	}

	if (tipo.length ==0) {
		return Swal.fire("Mensaje de Advertencia","Debe seleccionar un Tipo de Comprobante","warning");
	}

	$.ajax({
 		url:'../controller/cotizacion/controlador_cotizacion_registar.php',
 		type: 'POST',
 		data:{
 		idproveedor:idproveedor,
		compro:compro,
		serie:serie,
		impuesto:impuesto,
		total:total,
		tipo:tipo,
		porcentaje:porcentaje,
		idusuario:idusuario,
		atiende:atiende,
		dias:dias,
		fpago:fpago

 		}
 	}).done(function(resp){
 		//alert(resp);
 		if (resp>0) {
 			//llamamos al registrar detalle y convertirmos en entero la resp
 		Registrar_Detalle_Cotizacion(parseInt(resp));
 		//$("#text_num_compro").load("../view/cotizacion/mantenimiento_cotizacion_registrar.php #text_num_compro");
 		
 		//cargar_Select_num_coti();
 		//console.log(resp);

 		}else{
 			return Swal.fire("Mensaje de Error","No se pudo completar el registro","error");
 		}
 	})	
}


 function cargar_Select_num_coti(){//enviamos al scrpit mantenimiento examen
  $.ajax({
    url:'../controller/cotizacion/controlador_cargar_numer_cotizacion.php',
    type: 'POST'
  }).done(function(resp){
  	 //alert(resp);
    let data = JSON.parse(resp);//POSICION DE LA FILA Y COLUMNA
  
  document.getElementById('text_num_compro').value=data[0][0];
    
  })
 }




 /********************************************************************
 		REGISTRAR DETALLE 
 ********************************************************************/
function Registrar_Detalle_Cotizacion(id){
	let numero = document.getElementById('text_num_compro').value;
	let count=0;
	let arreglo_producto = new Array();
	let arreglo_cantidad = new Array();
	let arreglo_precio = new Array();
	$("#tabla_detalle_pro  tbody#tbody_tabla_detalle_pro tr ").each(function(){
		arreglo_producto.push($(this).find('td').eq(0).text());
		arreglo_cantidad.push($(this).find('td').eq(3).text());
		arreglo_precio.push($(this).find('td').eq(2).text());
		count++;
	})

	if (count==0) {
		return Swal.fire("Mensaje de Advertencia","Debe agregar un Producto en la cotizacion","warning");
	}

	let producto  = arreglo_producto.toString();
	let cantidad = arreglo_cantidad.toString();
	let precio = arreglo_precio.toString();

		$.ajax({
 		url:'../controller/cotizacion/controlador_cotizacion_detalle_registar.php',
 		type: 'POST',
 		data:{
 			id:id,
 			producto:producto,
			cantidad:cantidad,
			precio:precio

 		}
 	}).done(function(resp){
 		//alert(id);
 		if(resp>0){
 			Swal.fire({
					  title: 'Datos Confirmacion',
					  text: "Datos Registrados correctamente",
					  icon: 'success',
					  showCancelButton: true,
					  confirmButtonColor: '#3085d6',
					  cancelButtonColor: '#d33',
					  confirmButtonText: 'Imprimir Cotizacion?'
					}).then((result) => {
					  if (result.value) {
					  	window.open("../MPDF/reporte_cotizacion.php?codigo="+parseInt(id)+"#zoom=100", "Cotizacion","scrollbards=NO");
						 $("#contenido_principal").load("cotizacion/mantenimiento_cotizacion.php");
						 
					  }
					  $("#contenido_principal").load("cotizacion/mantenimiento_cotizacion.php");

					})

 		}else{
 			return Swal.fire("Mensaje de Error","No se pudo completar el registro","error");
 		}
	})
}


 /********************************************************************
 					 CLICK EN ANULAR COTIZACION - MENSAJE
 ********************************************************************/
 $('#tabla_cotizacion').on('click', '.anular', function() {//campo activar tiene que ir en el boton
	var data = tbl_cotizacion.row($(this).parents('tr')).data();//tamaño de escritorio
	if (tbl_cotizacion.row(this).child.isShown()) {
		var data = tbl_cotizacion.row(this).data();//para celular y usas el responsive datatable
	}
	Swal.fire({
	  title: 'Desea Cambiar el estado a la cotización?',
	  text: "Se desactivará la Cotizacion",
	  icon: 'warning',
	  showCancelButton: true,
	  confirmButtonColor: '#3085d6',
	  cancelButtonColor: '#d33',
	  confirmButtonText: 'Si, confirmar'
	}).then((result) => {
	  if (result.isConfirmed) {
	   Anular_Cotizacion(data.coti_id,"INACTIVO");//data 0 (id)
	   //console.log(data.rol_id);
	  }
	})
 });




 function Anular_Cotizacion(id, estado){
	$.ajax({
 		url:'../controller/cotizacion/controlador_anular_cotizacion.php',
 		type: 'POST',
 		data:{
 			    id: id,//le enviamos los campos al controlador
 			estado: estado

 		}
 	}).done(function(resp){
 		if (resp>0) {
	 				Swal.fire("Mensaje de Confirmacion","Cotizacion Desactivada","success").then((value)=>{
	 					tbl_cotizacion.ajax.reload();//recargar dataTable
	 					//TraerNotificaciones();
	 				});	 			
	 		}else{
	 			Swal.fire("Mensaje de Error","No se puede Anular la Cotizacion","error");
	 		}
 	})
 }




 /********************************************************************
 					ACTIVAR COTIZACION - 
 ********************************************************************/
 $('#tabla_cotizacion').on('click', '.activar', function() {//campo activar tiene que ir en el boton
	var data = tbl_cotizacion.row($(this).parents('tr')).data();//tamaño de escritorio
	if (tbl_cotizacion.row(this).child.isShown()) {
		var data = tbl_cotizacion.row(this).data();//para celular y usas el responsive datatable
	}
	Swal.fire({
	  title: 'Desea Cambiar el estado a la cotización?',
	  text: "Se Activará la Cotizacion",
	  icon: 'warning',
	  showCancelButton: true,
	  confirmButtonColor: '#3085d6',
	  cancelButtonColor: '#d33',
	  confirmButtonText: 'Si, confirmar'
	}).then((result) => {
	  if (result.isConfirmed) {
	   Activar_Cotizacion(data.coti_id,"ACTIVO");//data 0 (id)
	   //console.log(data.rol_id);
	  }
	})
 });



 function Activar_Cotizacion(id, estado){
	$.ajax({
 		url:'../controller/cotizacion/controlador_activar_cotizacion.php',
 		type: 'POST',
 		data:{
 			    id: id,//le enviamos los campos al controlador
 			estado: estado

 		}
 	}).done(function(resp){
 		if (resp>0) {
	 				Swal.fire("Mensaje de Confirmacion","Cotizacion Activada","success").then((value)=>{
	 					tbl_cotizacion.ajax.reload();//recargar dataTable
	 					//TraerNotificaciones();
	 				});	 			
	 		}else{
	 			Swal.fire("Mensaje de Error","No se puede Anular la Cotizacion","error");
	 		}
 	})
 }



 
/********************************************************************
		   VALIDAR TEXBOX CLIENTE
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
	document.getElementById('text_ape_p').value = "";
	document.getElementById('text_ape_m').value = "";
}

function Traer_Imei_pro(id_pro) {

	$.ajax({
		url: '../controller/venta/controlador_traer_imeiprod_venta.php',
		type: 'POST',
		data: {
			id_pro: id_pro
		}
	}).done(function (resp) {
		let data = JSON.parse(resp);
		//console.log(data.length);
		let llenardata = "<option value='Seleccione'>Seleccione</option> ";
		if (data.length > 0) {
			for (let i = 0; i < data.length; i++) {
				llenardata += "<option value='" + data[i][0] + "'>" + data[i][1] + "</option>";

			}
			document.getElementById('select_imei').innerHTML = llenardata;
			document.getElementById('text_cantidad').disabled = true;//deshabilitamos el boton
		} else {
			llenardata += "<option value=''>No se encontraron datos</option>";
			document.getElementById('select_imei').innerHTML = llenardata;
			document.getElementById('text_cantidad').disabled = false;

		}
	})
}