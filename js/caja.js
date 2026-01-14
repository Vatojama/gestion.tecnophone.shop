/********************************************************************
           LISTAR CAJA 
********************************************************************/

var tbl_caja;
function Listar_Caja() {//enviarlo al scrip en MANTENIMIENTO CLIENTE
    var finicio = document.getElementById('text_finicio').value;
 	var ffin = document.getElementById('text_ffin').value;
    let sucurid = document.getElementById('text_idsucurs').value;
    let rolid = document.getElementById('text_idrol').value;
    
    tbl_caja = $("#tabla_movi_caja").DataTable({
    "responsive": true,
        "ordering": false,
        "bLengthChange": true,
        "searching": { "regex": false },
        "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
        "pageLength": 25,
        "destroy": true,
        "async": false,
        "processing": true,
        "dom": 'Blfrtip',
       
		"buttons":[
			{
		       "extend":    'excelHtml5',
		       "text":      '<i class="fa fa-file-excel"></i>',
		       "titleAttr": 'Exportar a Excel',
			   "excelStyles": {                
				//template: "header_blue",  // Apply the 'header_blue' template part (white font on a blue background in the header/footer)
				//template:"green_medium" 
				
								
			},
		    },
			{
				"extend":    'pdfHtml5',
				"text":      '<i class="fas fa-file-pdf"></i> ',
				"titleAttr": 'Exportar a Pdf',
				"download":  'open'
			}
			
		],
		"rowCallback": function( row, data ) {
		    if ( data.caja_estado == 'CERRADO' ) {
                $('td', row).css({
                    'background-color': '#FFDDDD',
                   
                });
            } 
		  },
		/*  "drawCallback":function(){
			//alert("La tabla se está recargando"); 
			var api = this.api();
			$(api.column(3).footer()).html(
				'Total: '+api.column(3, {page:'current'}).data().sum()
			)
		  },*/
        "ajax": {
            "url": "../controller/caja/controlador_caja_listar.php",
            type: 'POST',
            data:{
				finicio:finicio,
				ffin:ffin,
                sucurid:sucurid,
                rolid:rolid

			}
        },
        "columns": [
            //todos los datos del procedimiento almacenado
            { "defaultContent": "" },//cintador 
            //{ "data": "caja_descripcion" },
            { "data": "caja_monto_inicial" },
            { "data": "caja_monto_servicio" },
            { "data": "caja_monto_final" },
            { "data": "caja_monto_egreso" },
            { "data": "caja_fecha_ap" },
            { "data": "caja_fecha_cie" },
            // { "data": "caja_total_ingreso" },
            // { "data": "caja_total_egreso" },
            { "data": "caja_monto_total" },
             { "data": "nombre_su" },
            {
                "data": "caja_estado",
                render: function (data, type, row) {
                    if (data === "VIGENTE") {

                        return "<center>" + '<span class="badge badge-success">VIGENTE</span>' + "</center>";
                    } else {
                        return "<center>" + '<span class="badge badge-danger">CERRADO</span>' + "</center>";
                    }
                }
            },
            { "data": "caja_estado",//editar
			render: function(data,type,row){
                if (data === "VIGENTE") {
					return "<center>" + "<span class=' cerrar text-danger px-1' style='cursor:pointer;' title='Cerrar Caja' ><i class='fas fa-lock'></i></span><span class=' corte_Caja text-success px-1' style='cursor:pointer;' title='Corte de Caja' ><i class='fas fa-print'></i></span>" + "</center>"
				}else{
					return "<center>" + "<span class='  text-secundary px-1' style='cursor:pointer;' title='' disabled><i class='fas fa-lock'></i></span><span class='imprimir text-danger px-1' style='cursor:pointer;' title='Imprimir Arqueo de caja'><i class= 'fa fa-print'></i></span>" + "</center>"
				}			
			}
		}


        ],
        "language": idioma_espanol,
        select: true
    });
    //contador en cada tabla
    tbl_caja.on('draw.td', function () {
        var PageInfo = $("#tabla_movi_caja").DataTable().page.info();
        tbl_caja.column(0, { page: 'current' }).nodes().each(function (cell, i) {
            cell.innerHTML = i + 1 + PageInfo.start;
        });
    });
}


/**********************************************************************
                     LISTAR TOTAL VENTAS Y DATOS DE LA CAJA
***********************************************************************/

function Traer_datos_ventas(sucurid) {
//let sucurid = document.getElementById('text_idsucurs').value;
    $.ajax({
        url: '../controller/caja/controlador_traer_datos_ventas.php',
        type: 'POST',
        data:{
            sucurid:sucurid
        }

    }).done(function (resp) {
        
        let data = JSON.parse(resp); //POSICION DE LA FILA Y COLUMNA
console.log("datos de cierre",data );
        if (data.length > 0) {
            document.getElementById('text_apertura').value = data[0][0];
            //document.getElementById('text_apertura').innerHTML = data[0][0];

            document.getElementById('text_cant_ventas').value = data[0][1];
            document.getElementById('text_monto_ventas').value = data[0][2];
            document.getElementById('text_cant_egreso').value = data[0][3]; //
            document.getElementById('text_monto_egreso').value = data[0][4];
            document.getElementById('text_cant_servicio').value = data[0][7];
            document.getElementById('text_monto_servicio').value = data[0][8];

           document.getElementById('text_estado').innerHTML = data[0][5];
           document.getElementById('text_fecha_apert').innerHTML = data[0][6];

           document.getElementById('text_cant_ingreso').value = data[0][9];
           document.getElementById('text_monto_ingreso').value = data[0][10];
           document.getElementById('text_monto_abonos').value = data[0][15];
            document.getElementById('text_monto_total').value = data[0][16];


           // console.log(data[0][0]);

        }
    })
}





/********************************************************************
                          SUMAR AUTOMATICAMENTE EN LOS TEXBOX 
 ********************************************************************/
function Sumar() {
   try {
		var a = parseFloat(document.getElementById('text_apertura').value) || 0;
		var b = parseFloat(document.getElementById('text_monto_ventas').value) || 0;
        var c = parseFloat(document.getElementById('text_monto_servicio').value) || 0;
        var d = parseFloat(document.getElementById('text_monto_egreso').value) || 0;
        var i = parseFloat(document.getElementById('text_monto_ingreso').value) || 0;
        var f = parseFloat(document.getElementById('text_monto_abonos').value) || 0;
        
		if (b.length > a.length) {
			return Swal.fire("Mensaje de Advertencia", "Ingrese cantidad menor que la del monto", "warning");
		} else {
			document.getElementById('text_monto_total').value = (a + b + c + i + f) - d;
		}

	} catch (e) { }
    
   
}


/********************************************************************
              ABRIR MODAL abrir caja
********************************************************************/
function AbrirModalAbrirCaja() {
    //para que no se nos salga del modal haciendo click a los costados
    $("#modal_abrir_caja").modal({ backdrop: 'static', keyboard: false });
    $("#modal_abrir_caja").modal('show');//abrimos el modal
    
    document.getElementById('text_descripcion').value = "Apertura de Caja";//titulo
    
    $('#text_monto').trigger('focus');
    document.getElementById('text_monto').value = "";
    
    $('.form-control').removeClass("is-invalid").removeClass("is-valid");//remover las clases
}


/********************************************************************
		IMPRIMIR COMPROBANTE
********************************************************************/
$('#tabla_movi_caja').on('click', '.imprimir', function () {//class foto tiene que ir en el boton
	var data = tbl_caja.row($(this).parents('tr')).data();//tama単o de escritorio
	if (tbl_caja.row(this).child.isShown()) {
		var data = tbl_caja.row(this).data();//para celular y usas el responsive datatable
	}
//console.log(data);
    $("#modal_impresion").modal({ backdrop: 'static', keyboard: false });
	$("#modal_impresion").modal('show');//abrimos el modal
	document.getElementById('text_idcajaa').value = data.caja_id;
    document.getElementById('text_idsucur').value = data.id_sucu;


	//window.open("../MPDF/reporte_arqueocaja.php?codigo=" + parseInt(data.caja_id) + "#zoom=120", "Arqueo de Caja", "scrollbards=NO");
   // window.open("../MPDF/reporte_caja.php?codigo=" + parseInt(data.caja_id) + "#zoom=120", "Arqueo de Caja", "scrollbards=NO");

});

 //IMPRESION RESUMEN
 $('#btn_formt1').on('click', function () {
	let tick_resum = document.getElementById('text_idcajaa').value;
    let sucurid_c = document.getElementById('text_idsucur').value;

    //como concateno sucurid al link
    window.open("../MPDF/reporte_arqueocaja.php?codigo=" + parseInt(tick_resum) + "&sucurid=" + sucurid_c + "#zoom=100", "Cierre de caja Resumido", "scrollbards=NO");
    //console.log("sucurid",sucurid_c);
	//window.open("../MPDF/reporte_arqueocaja.php?codigo=" + parseInt(tick_resum) + "#zoom=100", "Cierre de caja Resumido", "scrollbards=NO");
});


 
//IMPRESION DETALLADO
$('#btn_formt2').on('click', function () {
	let tick_det = document.getElementById('text_idcajaa').value;
    let sucurid_c = document.getElementById('text_idsucur').value;

	window.open("../MPDF/reporte_caja.php?codigo=" + parseInt(tick_det)  + "&sucurid=" + sucurid_c + "#zoom=100", "Cierre de caja Detallado", "scrollbards=NO");
});



/********************************************************************
		IMPRIMIR CORTE DE CAJA
********************************************************************/
$('#tabla_movi_caja').on('click', '.corte_Caja', function () {//class foto tiene que ir en el boton
	var data = tbl_caja.row($(this).parents('tr')).data();//tama単o de escritorio
	if (tbl_caja.row(this).child.isShown()) {
		var data = tbl_caja.row(this).data();//para celular y usas el responsive datatable
	}
//console.log(data);
    
	window.open("../MPDF/reporte_corte_caja.php?codigo=" + parseInt(data.caja_id)  + "&sucurid=" + parseInt(data.id_sucu) + "#zoom=100", "corte de caja", "scrollbards=NO");

});


/********************************************************************
           REGISTRAR APERTURA DE CAJA
********************************************************************/
function Registrar_Apertura_caja() {

    //declaramos los campos y se jalan del index del form
    let descripcion = document.getElementById('text_descripcion').value;
    let monto = document.getElementById('text_monto').value;
     let sucurid = document.getElementById('text_idsucurs').value;

    //valida que se escriba en los campos
    if (descripcion.length == 0) {
        return Swal.fire("Mensaje de Advertencia", "Agregar una Descripcion", "warning");
    }

    if (monto.length == 0) {
        return Swal.fire("Mensaje de Advertencia", "Agregar el monto de caja", "warning");
    }
    if (parseInt(monto) < 1) {
		return Swal.fire("Mensaje de Advertencia", "El Monto debe ser mayor o igual a 0", "warning");
	}

    $.ajax({
        url: '../controller/caja/controlador_caja_registar_apertura.php',
        type: 'POST',
        data: {
            descripcion: descripcion,
            monto: monto,
            sucurid:sucurid


        }
    }).done(function (resp) {
        if (resp > 0) {
            if (resp == 1) {//validamos la respuesta del procedure si retorna 1 o 2
                Swal.fire("Mensaje de Confirmacion", "Caja Aperturada", "success").then((value) => {
                    $("#modal_abrir_caja").modal('hide');//ocultamos el modal
                    tbl_caja.ajax.reload();//recargar dataTable
                });
            } else {
                Swal.fire("Mensaje de Advertencia", "Ya tienes una caja Aperturada", "warning");
            }

        } else {
            Swal.fire("Mensaje de Error", "No se pudo Aperturar la Caja", "error");
        }
    })
}




 /********************************************************************
 		REGISTRAR CIERRE DE CAJA
 ********************************************************************/
         function Registrar_Cierre_caja(){
           //declaramos los campos y se jalan del index del  text_monto_abonos
            
            let monto_ventas = document.getElementById('text_monto_ventas').value;	
            let cant_ventas = document.getElementById('text_cant_ventas').value;
            let monto_gasto = document.getElementById('text_monto_egreso').value;
            let cant_gasto = document.getElementById('text_cant_egreso').value;
            let monto_total = document.getElementById('text_monto_total').value;
            let monto_servicio = document.getElementById('text_monto_servicio').value;
            let cant_servicio = document.getElementById('text_cant_servicio').value;

            let monto_ingre = document.getElementById('text_monto_ingreso').value;
            let cant_ingre = document.getElementById('text_cant_ingreso').value;
            let idcaja = document.getElementById('cajaid').value;
             let montoabono = document.getElementById('text_monto_abonos').value;
                  
            //valida que se seleccione un cliente o comprobante
            if (monto_total.length ==0) {
                return Swal.fire("Mensaje de Advertencia","Debe calcular el monto total para cerrar la caja","warning");
            }
        
            $.ajax({
                 url:'../controller/caja/controlador_cerrar_caja.php',
                 type: 'POST',
                 data:{
                 monto_ventas:monto_ventas,
                cant_ventas:cant_ventas,
                monto_gasto:monto_gasto,
                cant_gasto:cant_gasto,
                monto_total:monto_total,
                monto_servicio:monto_servicio,
                cant_servicio:cant_servicio,
                monto_ingre:monto_ingre,
                cant_ingre:cant_ingre,
                idcaja:idcaja,
                montoabono:montoabono

        
                 }
             }).done(function(resp){
                 //alert(resp);
                 if (resp>0) {
                    LimpiarModalCierre();
                    Swal.fire("Mensaje de Confirmacion", "Caja Cerrada con Exito", "success").then((value) => {
                        $("#modal_cerrar_caja").modal('hide');//ocultamos el modal
                        tbl_caja.ajax.reload();//recargar dataTable
                    });

        
                 }else{
                     return Swal.fire("Mensaje de Error","No se pudo Cerrar la caja","error");
                 }
             })	
        }
        


        
  /********************************************************************
         LIMPIAR TEXBOX
 ********************************************************************/
 function LimpiarModalCierre(){
	document.getElementById('text_monto_ventas').value="";
	document.getElementById('text_cant_ventas').value="";
	document.getElementById('text_monto_egreso').value="";
	document.getElementById('text_cant_egreso').value="";
	document.getElementById('text_monto_total').value="";
	document.getElementById('text_apertura').value="";
    document.getElementById('text_monto_servicio').value="";
	document.getElementById('text_cant_servicio').value="";

 }



  /********************************************************************
        ABRIR MODAL CERRAR CAJA
 ********************************************************************/
        $('#tabla_movi_caja').on('click', '.cerrar', function() {//class cerrar tiene que ir en el boton
            var data = tbl_caja.row($(this).parents('tr')).data();//tamaño de escritorio
            if (tbl_caja.row(this).child.isShown()) {
                var data = tbl_caja.row(this).data();//para celular y usas el responsive datatable
            }
            console.log("presionar boton cerrar:",data);
            $("#modal_cerrar_caja").modal({ backdrop: 'static', keyboard: false });
            $("#modal_cerrar_caja").modal('show');//abrimos el modal
            Traer_datos_ventas(data.id_sucu);
            document.getElementById('cajaid').value=data.caja_id;
            // document.getElementById('text_monto_total').value="";
            // Sumar();
           
         });


 /********************************************************************
        ABRIR MODAL PARA VER LAS VENTAS POR CAJA ID
 ********************************************************************/
         $(document).on('dblclick', '.ver_ventascaja', function() {
            $('#modal_detalle_ventas_caja').modal({backdrop: 'static', keyboard: false});
            $('#modal_detalle_ventas_caja').modal('show');
            Listar_Detalle_ventas();
        });



        ///LISTAR DETALLE DEL PEDIDO
var tbl_ventas_det;
function Listar_Detalle_ventas() {
    var idcaja = document.getElementById('cajaid').value;
    tbl_ventas_det = $("#tabla_ventas_detallecaja").DataTable({
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
      url: "../controller/caja/Listar_Detalle_ventas.php",
      type: "POST",
      data: {
        idcaja: idcaja
				
			},
    },
    dom: "rtip",
    // "buttons": [
    // 	{
    // 		"extend": 'excelHtml5',
    // 		"title": 'Reporte Productos',
    // 		"exportOptions": {
    // 			'columns': [0, 1, 2, 3, 4, 5, 6, 7]
    // 		},
    // 		"text": '<i class="fa fa-file-excel"></i>',
    // 		"titleAttr": 'Exportar a Excel'
    // 	},
    // ],
    columns: [
      { data: "cliente_nombres" },

      { data: "comprobante" },
      { data: "venta_total" },
      { data: "fpago_descripcion" },
      { data: "venta_fregistro" },
      { data: "venta_estado" }

      // {
      //   defaultContent:
      //     "<center>" +
      //     "<span class='ver_detalle_pedido text-info px-1' style='cursor:pointer;' title='Ver detalles del pedido'><i class= 'fa fa-eye'></i></span>" +
      //     "</center>",
      // },
    ],
    language: idioma_espanol,
    select: true,
  });
}
