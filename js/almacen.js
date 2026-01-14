/********************************************************************
		   LISTAR ALMACENES EN LA TABLA
********************************************************************/
var tbl_almacen;
function Listar_Almacenes() {
  tbl_almacen = $("#tabla_almacen").DataTable({
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
      url: "../controller/sucursales/Listar_Almacenes.php",
      type: "POST",
    },
    dom: "lfrtip",
    "buttons": [
    	{
    		"extend": 'excelHtml5',
    		"title": 'Listado de Almacenes',
    		"exportOptions": {
    			'columns': [0, 1]
    		},
    		"text": '<i class="fa fa-file-excel"></i>',
    		"titleAttr": 'Exportar a Excel'
    	},
    ],
    columns: [
      { data: "descripcion_al" },
      { data: "codigo_al" },
      
        {data: "estado_al",
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
          "<span class='editar_alm text-primary px-1' style='cursor:pointer;' title='Editar Almacen'><i class= 'fa fa-edit'></i></span>" +
          "<span class='eliminar_alm text-danger px-1' style='cursor:pointer;' title='Eliminar Almacen'><i class= 'fa fa-trash'></i></span>" +
          "</center>",
      },
    ],
    language: idioma_espanol,
    select: true,
  });
}


/********************************************************************
 		ABRIR MODAL EDITAR ALMACEN
 ********************************************************************/
 $('#tabla_almacen').on('click', '.editar_alm', function() {//class foto tiene que ir en el boton
	var data = tbl_almacen.row($(this).parents('tr')).data();//tamaño de escritorio
	if (tbl_almacen.row(this).child.isShown()) {
		var data = tbl_almacen.row(this).data();//para celular y usas el responsive datatable
	}
	
		$("#modal_editar_almacen").modal({backdrop:'static', keyboard: false});	
		$("#modal_editar_almacen").modal('show');//abrimos el modal
  
    document.getElementById('id_almacen').value = data.id_almacen; //id del procedure
    document.getElementById('text_descrip_al_editar').value = data.descripcion_al;
    document.getElementById('text_abre_al_editar').value = data.codigo_al;

    $("#select_estado_al").select2().val(data.estado_al).trigger('change.select2');

 });



 /**********************************************************************
 						 ABRIR MODAL REGISTRAR SUCURSALES
 ***********************************************************************/
 function AbrirModalRegistroAlmacen(){
 	//para que no se nos salga del modal haciendo click a los costados
 	$("#modal_registro_almacen").modal({backdrop:'static', keyboard: false});	
 	$("#modal_registro_almacen").modal('show');//abrimos el modal
 	LimpiarModalAlmacen();
  //Listar_Almacenes();
 }


function  LimpiarModalAlmacen() {
 	$("#text_descrip_al").val("");
 	$("#text_abre_al").val("");
}



 /********************************************************************
 		REGISTRAR SUCURSALES
 ********************************************************************/
 function RegistrarAlmacen(){
     	let descripcion = document.getElementById('text_descrip_al').value;
     	let abrevia = document.getElementById('text_abre_al').value;     
    


 	
 	if (descripcion == ""  ) {
 		
 		return Swal.fire("Mensaje de Advertencia","ingrese una descripcion","warning");
 	}
  if (abrevia == ""  ) {
 		return Swal.fire("Mensaje de Advertencia","ingrese una abreviatura","warning");
 	} 
        	
 
	$.ajax({
 		url:'../controller/sucursales/Registrar_Almacen.php',
 		type: 'POST',
 		data:{
 			descripcion: descripcion,//le enviamos los campos al controlador
 			abrevia: abrevia
 			
 		}
 	}).done(function(resp){
  
    let data = JSON.parse(resp);
   

    if (data.tipo_msj === "success") {
        Swal.fire("Mensaje de Confirmación", data.msj, "success").then(() => {
            $("#modal_registro_almacen").modal('hide');
            tbl_almacen.ajax.reload();
        });
    } 
    //  else if (data.tipo_msj === "warning") {
    //     Swal.fire("Mensaje de Advertencia", data.msj, "warning");
    // }
    
    else {
        Swal.fire("Mensaje de Error", data.msj,  data.tipo_msj);
    }



 	})	 
 }


  /********************************************************************
 		MODIFICAR ALMACEN
 ********************************************************************/
 function ModificarAlmacen(){
  	  let idalma = document.getElementById('id_almacen').value; 
     	let descripcion = document.getElementById('text_descrip_al_editar').value;
     	let abrevia = document.getElementById('text_abre_al_editar').value;   
      let estado = document.getElementById('select_estado_al').value;   

 	
 	if (descripcion == ""  ) {
 		
 		return Swal.fire("Mensaje de Advertencia","ingrese una descripcion","warning");
 	}
  if (abrevia == ""  ) {
 		return Swal.fire("Mensaje de Advertencia","ingrese una abreviatura","warning");
 	} 
        	
 
	$.ajax({
 		url:'../controller/sucursales/Modificar_Almacen.php',
 		type: 'POST',
 		data:{
      idalma: idalma,
 			descripcion: descripcion,//le enviamos los campos al controlador
 			abrevia: abrevia,
      estado: estado
 			
 		}
 	}).done(function(resp){
  
    let data = JSON.parse(resp);
   

    if (data.tipo_msj === "success") {
        Swal.fire("Mensaje de Confirmación", data.msj, "success").then(() => {
            $("#modal_editar_almacen").modal('hide');
            tbl_almacen.ajax.reload();
        });
    } 
    //  else if (data.tipo_msj === "warning") {
    //     Swal.fire("Mensaje de Advertencia", data.msj, "warning");
    // }
    
    else {
        Swal.fire("Mensaje de Error", data.msj,  data.tipo_msj);
    }



 	})	 
 }


  /**********************************************************************
 								  ELIMINAR SUCURSAL
 ***********************************************************************/
 $("#tabla_almacen").on("click", ".eliminar_alm", function () {
   //campo activar tiene que ir en el boton
   var data = tbl_almacen.row($(this).parents("tr")).data(); //tamaño de escritorio
   if (tbl_almacen.row(this).child.isShown()) {
     var data = tbl_almacen.row(this).data(); //para celular y usas el responsive datatable
   }
   //console.log(data);//para ver los datos en la consola
   let idalm = data.id_almacen; //id del procedure
  
   Swal.fire({
     title: "Desea Eliminar el Almacen?",
     text: "",
     icon: "warning",
     showCancelButton: true,
     confirmButtonColor: "#3085d6",
     cancelButtonColor: "#d33",
     confirmButtonText: "Si, confirmar",
   }).then((result) => {
     if (result.isConfirmed) {
       $.ajax({
         url: "../controller/sucursales/Eliminar_Almacen.php",
         type: "POST",
         data: {
           idalm: idalm
         },
       }).done(function (resp) {
         
            let data = JSON.parse(resp);
          

            if (data.tipo_msj === "success") {
                Swal.fire("Mensaje de Confirmación", data.msj, "success").then(() => {
                   
                    tbl_almacen.ajax.reload();
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






















