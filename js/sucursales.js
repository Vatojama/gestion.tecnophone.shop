/********************************************************************
		   LISTAR SUCURSALES
********************************************************************/
var tbl_sucursales;
function Listar_Sucursales() {
  tbl_sucursales = $("#tabla_sucursales").DataTable({
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
      url: "../controller/sucursales/Listar_sucursales.php",
      type: "POST",
    },
    dom: "lfrtip",
    "buttons": [
    	{
    		"extend": 'excelHtml5',
    		"title": 'Listado de Sucursales',
    		"exportOptions": {
    			'columns': [0, 1, 2, 3, 4, 5]
    		},
    		"text": '<i class="fa fa-file-excel"></i>',
    		"titleAttr": 'Exportar a Excel'
    	},
    ],
    columns: [
      { data: "confi_razon_social" },
      { data: "nombre_su" },
      { data: "ruc_su" },
      { data: "telefono_su" },
      { data: "direccion_su" },
      { data: "descripcion_al" },
        {data: "estado_su",
			render: function(data,type,row){
				if (data==="Activo") {
					return "<span class='badge badge-success'>"+data+"</span>"
				}else{
					return "<span class='badge badge-danger'>"+data+"</span>"
				}
			}
		},
      {
        defaultContent:
          "<center>" +
          "<span class='editar_s text-primary px-1' style='cursor:pointer;' title='Editar Sucursal'><i class= 'fa fa-edit'></i></span>" +
          "<span class='eliminar_s text-danger px-1' style='cursor:pointer;' title='Eliminar Sucursal'><i class= 'fa fa-trash'></i></span>" +
          "</center>",
      },
    ],
    language: idioma_espanol,
    select: true,
  });
}

 /********************************************************************
 		ABRIR MODAL EDITAR SUCURSAL
 ********************************************************************/
 $('#tabla_sucursales').on('click', '.editar_s', function() {//class foto tiene que ir en el boton
	var data = tbl_sucursales.row($(this).parents('tr')).data();//tamaño de escritorio
	if (tbl_sucursales.row(this).child.isShown()) {
		var data = tbl_sucursales.row(this).data();//para celular y usas el responsive datatable
	}
	
		$("#modal_editar_sucursal").modal({backdrop:'static', keyboard: false});	
		$("#modal_editar_sucursal").modal('show');//abrimos el modal
  
    document.getElementById('id_sucursal').value = data.id_sucu; //id del procedure
    document.getElementById('text_razon_su_editar').value = data.nombre_su;
    document.getElementById('text_ruc_su_editar').value = data.ruc_su;
    document.getElementById('text_telefono_su_editar').value = data.telefono_su; //enviamos el nombre del usu al modal
    document.getElementById('text_direccion_su_editar').value = data.direccion_su;
    document.getElementById('text_correo_su_editar').value = data.correo_su;

    //console.log(data.rol_id);//para enviar el dato  en console
    $("#select_estado_editar").select2().val(data.estado_su).trigger('change.select2');
    $("#select_almacen_editar").select2().val(data.id_almacen).trigger('change.select2');

 });


  /**********************************************************************
 								  ELIMINAR SUCURSAL
 ***********************************************************************/
 $("#tabla_sucursales").on("click", ".eliminar_s", function () {
   //campo activar tiene que ir en el boton
   var data = tbl_sucursales.row($(this).parents("tr")).data(); //tamaño de escritorio
   if (tbl_sucursales.row(this).child.isShown()) {
     var data = tbl_sucursales.row(this).data(); //para celular y usas el responsive datatable
   }
//console.log(data);//para ver los datos en la consola
   let idsuc = data.id_sucu; //id del procedure
   let estado = data.estado_su; //estado del procedure
   Swal.fire({
     title: "Desea Eliminar la sucursal?",
     text: "",
     icon: "warning",
     showCancelButton: true,
     confirmButtonColor: "#3085d6",
     cancelButtonColor: "#d33",
     confirmButtonText: "Si, confirmar",
   }).then((result) => {
     if (result.isConfirmed) {
       $.ajax({
         url: "../controller/sucursales/Eliminar_Sucursal.php",
         type: "POST",
         data: {
           idsuc: idsuc
         },
       }).done(function (resp) {
         
            let data = JSON.parse(resp);
          

            if (data.tipo_msj === "success") {
                Swal.fire("Mensaje de Confirmación", data.msj, "success").then(() => {
                   
                    tbl_sucursales.ajax.reload();
                });
            } 
            //  else if (data.tipo_msj === "warning") {
            //     Swal.fire("Mensaje de Advertencia", data.msj, "warning");
            // }
            
            else {
                Swal.fire("Mensaje de Error", data.msj, "error");
            }
       });
     }
   });
 });




 /**********************************************************************
 						 ABRIR MODAL REGISTRAR SUCURSALES
 ***********************************************************************/
 function AbrirModalRegistroSucursales(){
 	//para que no se nos salga del modal haciendo click a los costados
 	$("#modal_registro_sucursal").modal({backdrop:'static', keyboard: false});	
 	$("#modal_registro_sucursal").modal('show');//abrimos el modal
 	LimpiarModalUsuario();
  //Listar_Almacenes();
 }


 //LIMPIAR TEXT
 function LimpiarModalUsuario() {
 	$("#text_razon_su").val("");
 	$("#text_ruc_su").val("");
 	$("#text_telefono_su").val("");
 	$("#text_direccion_su").val("");
 	$("#text_correo_su").val("");
 	//remover las clases
 	$('.form-control').removeClass("is-invalid").removeClass("is-valid");
 }



 //LISTAR ALMACENES EN EL COMBO
 function Listar_Almacenes() {

  	$.ajax({
      url: "../controller/sucursales/Listar_select_almacen.php",
      type: "POST",
    }).done(function (resp) {
      let data = JSON.parse(resp); //POSICION DE LA FILA Y COLUMNA
      let llenardata = "<option value=''>Seleccione</option>";
      if (data.length > 0) {
        for (let i = 0; i < data.length; i++) {
          llenardata +=
            "<option value='" + data[i][0] + "'>" + data[i][1] + "</option>";
        }
        document.getElementById("select_almacen").innerHTML = llenardata;
        document.getElementById("select_almacen_editar").innerHTML = llenardata;
      } else {
        llenardata += "<option value=''>No se encontraron datos</option>";
        document.getElementById("select_almacen").innerHTML = llenardata;
        document.getElementById("select_almacen_editar").innerHTML = llenardata;
      }
    });

  
 }


 /********************************************************************
 		REGISTRAR SUCURSALES
 ********************************************************************/
 function RegistrarSucursales(){
     	let razon = document.getElementById('text_razon_su').value;
     	//let ruc = document.getElementById('text_ruc_su').value;     
      let ruc = 999999999;     
      let telefono = document.getElementById('text_telefono_su').value;                                    
      let direccion = document.getElementById('text_direccion_su').value;  
      let correo = document.getElementById('text_correo_su').value;
      let id_almacen = document.getElementById('select_almacen').value;


 	
 	if (razon == ""  ) {
 		
 		return Swal.fire("Mensaje de Advertencia","ingrese una razon","warning");
 	}
  // if (ruc == ""  ) {
 	// 	return Swal.fire("Mensaje de Advertencia","ingrese un ruc","warning");
 	// } 
  if (telefono == ""  ) {
 		return Swal.fire("Mensaje de Advertencia","ingrese un telefono","warning");
 	}
  if (direccion == ""  ) {
 		return Swal.fire("Mensaje de Advertencia","ingrese una direccion","warning");
 	} 
  if (correo == ""  ) {
 		return Swal.fire("Mensaje de Advertencia","ingrese un correo","warning");
 	} 
  if (id_almacen.length == 0  ) {
 		return Swal.fire("Mensaje de Advertencia","Seleccione un almacen","warning");
 	}           	
 
	$.ajax({
 		url:'../controller/sucursales/Registrar_sucursales.php',
 		type: 'POST',
 		data:{
 			razon: razon,//le enviamos los campos al controlador
 			ruc: ruc,
 			telefono: telefono,			
 			direccion: direccion,
			correo:correo,
			id_almacen:id_almacen
 		}
 	}).done(function(resp){
  
    let data = JSON.parse(resp);
   

    if (data.tipo_msj === "success") {
        Swal.fire("Mensaje de Confirmación", data.msj, "success").then(() => {
            $("#modal_registro_sucursal").modal('hide');
            tbl_sucursales.ajax.reload();
        });
    } 
    //  else if (data.tipo_msj === "warning") {
    //     Swal.fire("Mensaje de Advertencia", data.msj, "warning");
    // }
    
    else {
        Swal.fire("Mensaje de Error", data.msj, "error");
    }



 	})	 
 }



  /********************************************************************
 		MODIFICAR SUCURSALES
 ********************************************************************/
 function ModificarSucursales(){
  	let idsucu = document.getElementById('id_sucursal').value;
     	let razon = document.getElementById('text_razon_su_editar').value;
     	let ruc = document.getElementById('text_ruc_su_editar').value;     
      let telefono = document.getElementById('text_telefono_su_editar').value;                                    
      let direccion = document.getElementById('text_direccion_su_editar').value;  
      let correo = document.getElementById('text_correo_su_editar').value;
      let id_almacen = document.getElementById('select_almacen_editar').value;
      let estadosu = document.getElementById('select_estado_editar').value;


 	
 	if (razon == ""  ) {
 		
 		return Swal.fire("Mensaje de Advertencia","ingrese una razon","warning");
 	}
  // if (ruc == ""  ) {
 	// 	return Swal.fire("Mensaje de Advertencia","ingrese un ruc","warning");
 	// } 
  if (telefono == ""  ) {
 		return Swal.fire("Mensaje de Advertencia","ingrese un telefono","warning");
 	}
  if (direccion == ""  ) {
 		return Swal.fire("Mensaje de Advertencia","ingrese una direccion","warning");
 	} 
  if (correo == ""  ) {
 		return Swal.fire("Mensaje de Advertencia","ingrese un correo","warning");
 	} 
  if (id_almacen.length == 0  ) {
 		return Swal.fire("Mensaje de Advertencia","Seleccione un almacen","warning");
 	}           	
 
	$.ajax({
 		url:'../controller/sucursales/Modificar_sucursales.php',
 		type: 'POST',
 		data:{
      idsucu:idsucu,
 			razon: razon,//le enviamos los campos al controlador
 			ruc: ruc,
 			telefono: telefono,			
 			direccion: direccion,
			correo:correo,
			id_almacen:id_almacen,
      estadosu:estadosu
 		}
 	}).done(function(resp){
  
    let data = JSON.parse(resp);
   

    if (data.tipo_msj === "success") {
        Swal.fire("Mensaje de Confirmación", data.msj, "success").then(() => {
            $("#modal_editar_sucursal").modal('hide');
            tbl_sucursales.ajax.reload();
        });
    } 
    //  else if (data.tipo_msj === "warning") {
    //     Swal.fire("Mensaje de Advertencia", data.msj, "warning");
    // }
    
    else {
        Swal.fire("Mensaje de Error", data.msj, "error");
    }



 	})	 
 }




