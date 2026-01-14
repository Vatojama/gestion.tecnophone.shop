/********************************************************************
           LISTAR RECEPCION CON SERVERSIDE (MUCHOS DATOS)
********************************************************************/

var tbl_reparacion;
function Listar_Reparacion() {//enviarlo al scrip en MANTENIMIENTO ROL
    var finicio = document.getElementById('text_finicio').value;
    var ffin = document.getElementById('text_ffin').value;
    var idusuario_filtro = document.getElementById('text_Idprincipal').value;
    let sucurid = document.getElementById('text_idsucurs').value;
	let rolid = document.getElementById('text_idrol').value;

    tbl_reparacion = $("#tabla_reparacion").DataTable({
        "responsive": true,
        "ordering": false,
        "bLengthChange": true,
        "searching": { "regex": false },
        "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
        "pageLength": 10,
        "destroy": true,
        "async": false,
        "bprocessing": true,
        "dom": 'Blfrtip',
        "buttons": [
            {
                "extend": 'excelHtml5',
                "text": '<i class="fa fa-file-excel"></i>',
                "titleAttr": 'Exportar a Excel'
            },
            /*{
                "extend":    'pdfHtml5',
                "text":      '<i class="fas fa-file-pdf"></i> ',
                "titleAttr": 'Exportar a Pdf',
                "download": 'open',
                'className': 'btn btn-sm btn-success'
            }*/

        ],
        "ajax": {
            "url": "../controller/recepcion/controlador_reparacion_listar.php",
            type: 'POST',
            data: {
                finicio: finicio,
                ffin: ffin,
                idusuario_filtro: idusuario_filtro,
                sucurid:sucurid,
			   rolid:rolid
            }

        },
        "columns": [
            //todos los datos del procedimiento almacenado
            // {"defaultContent": ""},//cintador 
            { "data": "referencia" },
            { "data": "rece_cod" },
            { "data": "cliente_nombres" },
            { "data": "motivo" },
            { "data": "motivo_descripcion" },
           
            { "data": "rece_fregistro" },
            { "data": "nombre_su" },
             { "data": "tecniconombre" },
            {
                "data": "rece_estado",
                render: function (data, type, row) {
                    if (data == "EN REPARACION") {
                        return "<center>" + '<span class="badge badge-info">EN REPARACION</span>'; +"</center>"
                    } else if (data == "REPARADO") {
                        return "<center>" + '<span class="badge badge-success">REPARADO</span>'; +"</center>"
                    } else if (data == "NO REPARADO") {
                        return "<center>" + '<span class="badge badge-danger">NO REPARADO</span>'; +"</center>"
                    } else {
                        return "<center>" + '<span class="badge badge-warning">ENTREGADO</span>'; +"</center>"
                    }
                }
            }, //10
           
            {
                "data": "rece_estado",//editar
                render: function (data, type, row) {
                    if (data === "EN REPARACION" || data == "REPARADO" || data == "NO REPARADO") {
                        return "<center>" + "<span class='editar text-primary px-1' style='cursor:pointer;' title='Ver detalles' ><i class= 'fa fa-eye'></i></span> <span class='insertar_insumos text-success px-1' style='cursor:pointer;' title='agregar insumos'><i class= 'fa fa-plus'></i></span> " + "</center>"
                    } else {
                        return "<center>" + "<span class='ver_reparacion text-info px-1' style='cursor:pointer;' title='Ver detalles' ><i class= 'fa fa-eye'></i></span>  " + "</center>"
                    }


                }
            },

            //{"defaultContent": "<center>"+"<span class='CambiarEstado text-danger px-1' style='cursor:pointer;' title='Eliminar Servicio' ><i class= 'fa fa-trash'></i></span><span class='imprimir text-success px-1' style='cursor:pointer;' title='Imprimir Comprobante'><i class= 'fa fa-print'></i></span>"+"</center>"}


        ],
        "language": idioma_espanol,
        select: true
    });

}




/********************************************************************
		  VER DETALLE DE LA REPARACION
********************************************************************/
var tbl_ver_detalle_equi;
function Ver_detalle_equi(idrec) {//enviarlo al scrip en MANTENIMIENTO ROL
	tbl_ver_detalle_equi = $("#tabla_detalle_equi").DataTable({
		"responsive": false,
		"ordering": false,
		"bLengthChange": true,
		"searching": { "regex": false },
		"lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
		"pageLength": 40,
		"destroy": true,
		"async": false,
		"processing": true,
		"dom": '',
		"ajax": {
			"url": "../controller/recepcion/controlador_ver_detalle_recpcion.php",
			type: 'POST',
			data: {
				idrec: idrec
			}
		},
		"columns": [
			//todos los datos del procedimiento almacenado
			{ "data": "id_equipo" },
			{ "data": "equipo" },
			
			{ "data": "falla" },
        //{ "data": "<center>"+"<input type='text' id='text_glosa_d' >" +"<center>" },
            { "data": "diagnostico" },
			
			{"defaultContent": "<center>"+"<span class='observa text-success px-2' style='cursor:pointer;' data-bs-toggle='tooltip' data-bs-placement='top' title='agregar diagnostico'><i class= 'fa fa-file'></i></span> "+"</center>"}


		],
		"language": idioma_espanol,
		select: true
	});

}

var tbl_ver_detalle_equi;
function Ver_detalle_equi2(idrec) {//enviarlo al scrip en MANTENIMIENTO ROL
	tbl_ver_detalle_equi = $("#tabla_detalle_equi").DataTable({
		"responsive": false,
		"ordering": false,
		"bLengthChange": true,
		"searching": { "regex": false },
		"lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
		"pageLength": 40,
		"destroy": true,
		"async": false,
		"processing": true,
		"dom": '',
		"ajax": {
			"url": "../controller/recepcion/controlador_ver_detalle_recpcion.php",
			type: 'POST',
			data: {
				idrec: idrec
			}
		},
		"columns": [
			//todos los datos del procedimiento almacenado
			{ "data": "id_equipo" },
			{ "data": "equipo" },
			
			{ "data": "falla" },
        //{ "data": "<center>"+"<input type='text' id='text_glosa_d' >" +"<center>" },
            { "data": "diagnostico" },
			
			{"defaultContent": ""}
            


		],
		"language": idioma_espanol,
		select: true
	});

}



/********************************************************************
		  VER DETALLE DE LOS INSUMOS
********************************************************************/
var tbl_ver_insumos_repara;
function Ver_detalle_insumos_repara(idrec) {//enviarlo al scrip en MANTENIMIENTO ROL
	tbl_ver_insumos_repara = $("#tabla_insumos_recep").DataTable({
		"responsive": false,
		"ordering": false,
		"bLengthChange": true,
		"searching": { "regex": false },
		"lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
		"pageLength": 40,
		"destroy": true,
		"async": false,
		"processing": true,
		"dom": '',
		"ajax": {
			"url": "../controller/recepcion/controlador_ver_detalle_insumos_reparacion.php",
			type: 'POST',
			data: {
				idrec: idrec
			}
		},
		"columns": [
			//todos los datos del procedimiento almacenado
			{ "data": "id_insumo" },
			{ "data": "producto_nombre" },
			
			{ "data": "cantidad" },
            { "data": "monto_ri" },
        
			
			{"defaultContent": "<center>"+"<span class='elimar_ins text-danger px-2' style='cursor:pointer;' data-bs-toggle='tooltip' data-bs-placement='top' title='Quitar insumo'><i class= 'fa fa-trash-alt'></i></span> "+"</center>"}


		],
		"language": idioma_espanol,
		select: true
	});

}


/********************************************************************
		  VER DETALLE DE LOS INSUMOS - SOLO VER
********************************************************************/
var tbl_ver_insumos_repara_solver;
function Ver_insumos(idrec) {//enviarlo al scrip en MANTENIMIENTO ROL
	tbl_ver_insumos_repara_solver = $("#tabla_insumos_ver_rep").DataTable({
		"responsive": false,
		"ordering": false,
		"bLengthChange": true,
		"searching": { "regex": false },
		"lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
		"pageLength": 40,
		"destroy": true,
		"async": false,
		"processing": true,
		"dom": '',
		"ajax": {
			"url": "../controller/recepcion/controlador_ver_detalle_insumos_reparacion.php",
			type: 'POST',
			data: {
				idrec: idrec
			}
		},
		"columns": [
			//todos los datos del procedimiento almacenado
			{ "data": "id_insumo" },
			{ "data": "producto_nombre" },
			
			{ "data": "cantidad" },
			{ "data": "monto_ri" },
			{ "data": "fecha" },
        
			
		//	{"defaultContent": "<center>"+"<span class='elimar_ins text-danger px-2' style='cursor:pointer;' data-bs-toggle='tooltip' data-bs-placement='top' title='agregar disgnostico'><i class= 'fa fa-trash-alt'></i></span> "+"</center>"}


		],
		"language": idioma_espanol,
		select: true
	});

}








/********************************************************************
		  VER DETALLE DE LA REPARACION
********************************************************************/
$('#tabla_reparacion').on('click', '.editar', function () {//campo activar tiene que ir en el boton
	var data = tbl_reparacion.row($(this).parents('tr')).data();//tamaño de escritorio
	if (tbl_reparacion.row(this).child.isShown()) {
		var data = tbl_reparacion.row(this).data();//para celular y usas el responsive datatable

	}

    $("#modal_detalle_recepcion").modal({ backdrop: 'static', keyboard: false });
	$("#modal_detalle_recepcion").modal('show');//abrimos el modal
	
    document.getElementById('idreparacion').value = data.rece_id;
    document.getElementById('text_cliente_d').value = data.cliente_nombres;
    document.getElementById('text_motivo_d').value = data.motivo_descripcion;
    document.getElementById('text_fentrega_d').value = data.rece_fentrega;
    document.getElementById('text_observa_d').value = data.motivo;
    document.getElementById('text_glosa_d').value = data.diagnostico_tecnico;

    document.getElementById('idrecep_estad').innerHTML = "R-000"+data.rece_id;

    var miInput = document.getElementById("text_glosa_d");
    miInput.disabled = false;

    var estado_vie = document.getElementById("ocul_estado");
    estado_vie.hidden = false;

    var btnregis = document.getElementById("btn_regis_repara");
    btnregis.hidden = false;

    var insumos_tabpanel = document.getElementById("insumos_tabpanel");
    insumos_tabpanel.hidden = true;
   

    $("#select_estado_d").select2().val(data.rece_estado).trigger('change.select2');
    Ver_detalle_equi(data.rece_id) ;
    
});


/********************************************************************
		   ABRIR MODAL DIAGNOSTICO
********************************************************************/
$('#tabla_detalle_equi').on('click', '.observa', function () {
	var data = tbl_ver_detalle_equi.row($(this).parents('tr')).data();
	if (tbl_ver_detalle_equi.row(this).child.isShown()) {
		var data = tbl_ver_detalle_equi.row(this).data();

	}
    var reparaid = document.getElementById('idreparacion').value;

   // console.log(data);

    $("#modal_registrar_diagnostico").modal({ backdrop: 'static', keyboard: false });
	$("#modal_registrar_diagnostico").modal('show');//abrimos el modal

	document.getElementById('idrepa_diagnos').value = reparaid;
    document.getElementById('idquipo_diag').value = data.id_equipo;
   
   // Ver_detalle_equi(data.rece_id) ;
    
});




/********************************************************************
		   REGISTRAR DIAGNOSTICO
********************************************************************/
function Registrar_diagnostico(){
       
     let id_diag = document.getElementById('idrepa_diagnos').value;	
     let id_equi = document.getElementById('idquipo_diag').value;
     let desc_diagnos = document.getElementById('text_diagnostico').value;
    
    //  if (desc_diagnos == "") {
    //      return Swal.fire("Mensaje de Advertencia","Debe calcular el monto total para cerrar la caja","warning");
    //  }
 
     $.ajax({
          url:'../controller/recepcion/controlador_registrar_diagnostico.php',
          type: 'POST',
          data:{
            id_diag:id_diag,
            id_equi:id_equi,
            desc_diagnos:desc_diagnos
        
          }
      }).done(function(resp){
          if (resp>0) {
             limpiar_modal_diagnostico();
             Swal.fire("Mensaje de Confirmacion", "Diagnostico insertado", "success").then((value) => {
                 $("#modal_registrar_diagnostico").modal('hide');//ocultamos el modal
                 tbl_ver_detalle_equi.ajax.reload();//recargar dataTable
             });

 
          }else{
              return Swal.fire("Mensaje de Error","No se pudo insertar","error");
          }
      })	
 }




 /********************************************************************
		   REGISTRAR REPARACION
********************************************************************/
function Registrar_reparacion(){
    let usuid = document.getElementById('text_Idprincipal').value;
    let idrepar = document.getElementById('idreparacion').value;	
    let glosa_repa = document.getElementById('text_glosa_d').value;
    let estado_repa = document.getElementById('select_estado_d').value;
   
    if (glosa_repa == "") {
        return Swal.fire("Mensaje de Advertencia","Inserte un comentario para la reparacion","warning");
    }
    if (estado_repa == "") {
        return Swal.fire("Mensaje de Advertencia","Inserte un estado de la reparacion","warning");
    }
    if (estado_repa == "EN REPARACION") {
        return Swal.fire("Mensaje de Advertencia","CAMBIE EL ESTADO DE LA REPARACION","warning");
    }

    $.ajax({
         url:'../controller/recepcion/controlador_registrar_reparacion.php',
         type: 'POST',
         data:{
            idrepar:idrepar,
            glosa_repa:glosa_repa,
            estado_repa:estado_repa
       
         }
     }).done(function(resp){
         if (resp>0) {
            //limpiar_modal_diagnostico();
            Swal.fire("Mensaje de Confirmacion", "Datos insertados", "success").then((value) => {
                $("#modal_detalle_recepcion").modal('hide');//ocultamos el modal
                tbl_reparacion.ajax.reload();//recargar dataTable
                Notificacion_Tecnico(usuid);
            });


         }else{
             return Swal.fire("Mensaje de Error","No se pudo insertar","error");
         }
     })	
}




/********************************************************************
		  AGREGAR INSUMOS A REPARACION
********************************************************************/
$('#tabla_reparacion').on('click', '.insertar_insumos', function () {//campo activar tiene que ir en el boton
	var data = tbl_reparacion.row($(this).parents('tr')).data();//tamaño de escritorio
	if (tbl_reparacion.row(this).child.isShown()) {
		var data = tbl_reparacion.row(this).data();//para celular y usas el responsive datatable

	}
    limpiar_modal_insumos();

    $("#modal_insumos_reparacion").modal({ backdrop: 'static', keyboard: false });
	$("#modal_insumos_reparacion").modal('show');//abrimos el modal
	
    document.getElementById('idrepara_ins').value = data.rece_id;
    

    //$("#select_estado_d").select2().val(data.rece_estado).trigger('change.select2');
   // Ver_detalle_equi(data.rece_id) ;
   Ver_detalle_insumos_repara(data.rece_id) 
    
});


/********************************************************************
		   REGISTRAR DIAGNOSTICO
********************************************************************/
function Registrar_insumos(){
       
    let id_repa_ins= document.getElementById('idrepara_ins').value;	
    let id_prod_ins= document.getElementById('select_produc_ins').value;
    let cantid_ins = document.getElementById('text_cantidad_ins').value;
    let stock_ins = document.getElementById('text_stock_insu').value;
    let precio_ins = document.getElementById('text_precio_insu').value;
    let idusu_ins = document.getElementById('text_Idprincipal').value;
    let idalmacen = document.getElementById('text_idalmacen').value;
    let monto_ins = 0
   
    if (parseFloat(stock_ins) < parseFloat(cantid_ins)) {
		return Swal.fire("El articulo no tiene Stock suficiente", "Stock actual: " + stock_ins + "  ", "warning");
	}

    if (id_prod_ins.length == 0) {
		return Swal.fire("Mensaje de Advertencia", "Seleccione un articulo", "warning");
	}
    if (id_prod_ins.length == 0) {
		return Swal.fire("Mensaje de Advertencia", "Seleccione un articulo", "warning");
	}

    if (cantid_ins.length == 0) {
		return Swal.fire("Mensaje de Advertencia", "Ingrese una cantidad", "warning");
	}

	if (parseInt(cantid_ins) < 1) {
		return Swal.fire("Mensaje de Advertencia", "La cantidad debe ser mayor a 0", "warning");
	}

    monto_ins =  parseFloat(precio_ins * cantid_ins).toFixed(2);



    $.ajax({
         url:'../controller/recepcion/controlador_registrar_insumos_reparacion.php',
         type: 'POST',
         data:{
            id_repa_ins:id_repa_ins,
            id_prod_ins:id_prod_ins,
            cantid_ins:cantid_ins,
            monto_ins: monto_ins,
            idusu_ins:idusu_ins,
            idalmacen:idalmacen
       
         }
     }).done(function(resp){
        
         if (resp > 0) {
			if (resp == 1) {//validamos la respuesta del procedure si retorna 1 o 2
				Swal.fire("Mensaje de Confirmacion", "Insumo insertado", "success").then((value) => {

					//$("#modal_registro_cliente").modal('hide');
					limpiar_modal_insumos();
                     tbl_ver_insumos_repara.ajax.reload();
                     cargar_Select_Productos();
					
				});
			} else {
				Swal.fire("Mensaje de Advertencia", "El articulo ya se encuentra registrado", "warning");
			}

		} else {
			Swal.fire("Mensaje de Error", "No se pudo insertar", "error");
		}





     })	
}






/********************************************************************
		   ELIMINAR UN INSUMO DEL DETALLE
********************************************************************/
$('#tabla_insumos_recep').on('click', '.elimar_ins', function () {
    let idusu_ins = document.getElementById('text_Idprincipal').value;
	var data = tbl_ver_insumos_repara.row($(this).parents('tr')).data();
	if (tbl_ver_insumos_repara.row(this).child.isShown()) {
		var data = tbl_ver_insumos_repara.row(this).data();

	}
   // console.log(data);

    idinsumo_dele = data.id_insumo;
    canti_dele = data.cantidad;
    produc_dele = data.producto_id;
    idrece_dele = data.rece_id;
    //console.log(idinsumo_dele, ' ', canti_dele, ' ',idrece_dele);
   
    
    Swal.fire({
		title: 'Desea Eliminar el articulo de la reparacion?' ,
		text: "Ya no se podra deshacer el cambio",
		icon: 'warning',
		showCancelButton: true,
		confirmButtonText: 'Eliminar'
	}).then((result) => {

		if (result.isConfirmed) {

			$.ajax({
                url:'../controller/recepcion/controlador_eliminar_insumo_reparacion.php',
                type: 'POST',
                data:{
                    idinsumo_dele:idinsumo_dele,
                    canti_dele:canti_dele,
                    produc_dele:produc_dele,
                    idrece_dele: idrece_dele,
                    idusu_ins:idusu_ins
              
                }
            }).done(function(resp){
                if (resp>0) {
                   //limpiar_modal_diagnostico();
                   Swal.fire("Mensaje de Confirmacion", "Articulo quitado correctamente", "success").then((value) => {
                       //$("#modal_detalle_recepcion").modal('hide');//ocultamos el modal
                       tbl_ver_insumos_repara.ajax.reload();//recargar dataTable
                   });
       
       
                }else{
                    return Swal.fire("Mensaje de Error","No se pudo quitar el articulo","error");
                }
            })	
			
			


		} else {

			//console.log("Error al Eliminar el imei");
		}

	})

   

   
    
});





/********************************************************************
		  SOLO VER REPARACION CUANDO YA ESTE EN ESTADO: ENTREGADO
********************************************************************/
$('#tabla_reparacion').on('click', '.ver_reparacion', function () {//campo activar tiene que ir en el boton
	var data = tbl_reparacion.row($(this).parents('tr')).data();//tamaño de escritorio
	if (tbl_reparacion.row(this).child.isShown()) {
		var data = tbl_reparacion.row(this).data();//para celular y usas el responsive datatable

	}

    $("#modal_detalle_recepcion").modal({ backdrop: 'static', keyboard: false });
	$("#modal_detalle_recepcion").modal('show');//abrimos el modal
	
    document.getElementById('idreparacion').value = data.rece_id;
    document.getElementById('text_cliente_d').value = data.cliente_nombres;
    document.getElementById('text_motivo_d').value = data.motivo_descripcion;
    document.getElementById('text_fentrega_d').value = data.rece_fentrega;
    document.getElementById('text_observa_d').value = data.motivo;
    document.getElementById('text_glosa_d').value = data.diagnostico_tecnico;
    document.getElementById('idrecep_estad').innerHTML = "R-000"+data.rece_id;
    var glosa_in = document.getElementById("text_glosa_d");
    glosa_in.disabled = true;

    var estado_vie = document.getElementById("ocul_estado");
    estado_vie.hidden = true;

    var btnregis = document.getElementById("btn_regis_repara");
    btnregis.hidden = true;

    var insumos_tabpanel = document.getElementById("insumos_tabpanel");
    insumos_tabpanel.hidden = false;

    $("#select_estado_d").select2().val(data.rece_estado).trigger('change.select2');
    Ver_detalle_equi2(data.rece_id) ;
    Ver_insumos(data.rece_id);
    
});



 //PARA LIMPIAR EL MODAL DDE DIAGNOSTICO
 function limpiar_modal_diagnostico() {
    document.getElementById('idrepa_diagnos').value = "";	
    document.getElementById('idquipo_diag').value= "";
    document.getElementById('text_diagnostico').value= "";
}


 //PARA LIMPIAR EL MODAL DE INSUMOS
 function limpiar_modal_insumos() {
    //document.getElementById('idrepara_ins').value = "";	
    document.getElementById('text_cantidad_ins').value= "";
    document.getElementById('text_stock_insu').value= "";
    document.getElementById('text_precio_insu').value= "";
    $("#select_produc_ins").select2().val("").trigger('change.select2');
}





function fechas() {

    var f = new Date();
    var anio = f.getFullYear();
    var mes = f.getMonth() + 1;
    var d = f.getDate();


    if (d < 10) {
        d = '0' + d;
    }
    if (mes < 10) {
        mes = '0' + mes;
    }



    document.getElementById('text_finicio').value = anio + "-" + mes + "-" + d;
    document.getElementById('text_ffin').value = anio + "-" + mes + "-" + d;
}