document.addEventListener('DOMContentLoaded', function() {
	// let searchDescription = document.getElementById('text_documento');
    // document.getElementById('btn_buscarReparacion').addEventListener('click', function() {
    //     if (searchDescription.value.trim() === '') {
	// 		//alert("Por favor, ingrese un documento de identidad");
	// 		return Swal.fire("Campo vacío", "Por favor, ingrese un documento de identidad", "warning");
           
    //     }
    //     Buscar_Equipo();
    // });

	// document.getElementById('btn_buscarPedido').addEventListener('click', function() {
	// 	let orderDoc = document.getElementById('text_nro_doc');
    //     let orderNum = document.getElementById('text_nro_pedido');
        
    //     if (orderDoc.value.trim() === '') {
	// 		return Swal.fire("Campo vacío", "Por favor, ingrese un documento de identidad", "warning");
           
    //     }
    //     if (orderNum.value.trim() === '') {
	// 		return Swal.fire("Campo vacío", "Por favor, ingrese un número de pedido", "warning");
            
    //     }
	// 	//console.log("funcion para buscar el pedido");
	// 	Buscar_Pedido();
    // });
});



/********************************************************************
 		BUSCAR EQUIPO
 ********************************************************************/

var tbl_buscar_equipo;
 function Buscar_Equipo(){//enviarlo al scrip en MANTENIMIENTO ROL
 	var dni = document.getElementById('text_documento').value;

	tbl_buscar_equipo = $("#tabla_buscar_equipo").DataTable({		
		"responsive" :true,
		"ordering" :false,
		"bLengthChange" : true,
		"searching" : {"regex" : false},
		"lengthMenu" : [[10, 25, 50, 100, -1],[10, 25, 50, 100, "All"]],
		"pageLength" : 10,
		"destroy" :true,
		"async" : false,
		"bprocessing": true,
		"dom": 't',
		"ajax" : {
			"url": "../controller/buscarequipo/controlador_buscar_equipo.php",
			type: 'POST',
			data:{
				dni:dni
			}

		},
		"columns":[
		//todos los datos del procedimiento almacenado
		{"data": "cliente_dni"},
		{"data": "cliente_nombres"},
		{"data": "rece_equipo"},
		{"data": "rece_concepto"},
		{"data": "rece_fregistro"},
		{"data": "rece_estado",
			render: function(data,type,row){
				if (data=="EN REPARACION") {
					return "<center><span class='badge bg-warning text-dark'>"+data+"</span></center>";
						
				} else if (data=="REPARADO") {
					return "<center><span class='badge bg-success'>"+data+"</span></center>";
						
				} else if (data=="NO REPARADO") {
					return "<center><span class='badge bg-danger'>"+data+"</span></center>";
						
				} else {
					return "<center><span class='badge bg-success'>"+data+"</span></center>";
				}
			
				
				
			}
		},
		

		],
		"language":idioma_espanol,
		select:true
	});
 }	

/********************************************************************
 		BUSCAR PEDIDOS
 ********************************************************************/
		 function Buscar_Pedido() {
			var dni = document.getElementById('text_nro_doc').value;
			var pedido = document.getElementById('text_nro_pedido').value;
		
			$.ajax({
				url: "../admin/controller/buscarequipo/controlador_buscar_pedido.php",
				type: 'POST',
				data: {
					dni: dni,
					pedido: pedido
				},
				success: function(resp) {
					try {
						var data = JSON.parse(resp);
						//console.log("FUNCION PEDIDO", data);
						let timelineHTML = '';
		
						// Validar si no hay datos o si es un array vacío
						if (!data || !Array.isArray(data) || data.length === 0) {
							Swal.fire("Error", "No se encontraron registros para el pedido", "error");
							
							document.querySelector('#pedidos-results .timeline').innerHTML = '';
							document.getElementById('pedidos-results').style.display = 'none';
							return;
						}
		
						// Iterar sobre los pedidos encontrados
						data.forEach(function(item) {
							let estadoClass = 'bg-secondary';
							let estado = item.estado_segui || 'Sin estado';
							let correlativo = item.pedido_correlativo || 'No disponible';
							let fecha = item.fecha_segui || 'Fecha no disponible';
							let total = item.total_segui || '0.00';
							let moneda = item.confi_moneda || 'no disponible';
		
							switch (estado.toUpperCase()) {
								case 'PENDIENTE': estadoClass = 'bg-info'; break;
								case 'EN PROCESO': estadoClass = 'bg-warning text-dark'; break;
								case 'ENVIADO': estadoClass = 'bg-primary text-white'; break;
								case 'COMPLETADO': estadoClass = 'bg-success text-white'; break;
								case 'CANCELADO': estadoClass = 'bg-danger text-white'; break;
								default: estadoClass = 'bg-secondary text-white';
							}

							timelineHTML += `
								<div class="timeline-item mb-4 position-relative">
									<div class="timeline-point"></div>
									<div class="timeline-content p-3 rounded shadow-sm ms-4">
										<div class="d-flex flex-column flex-sm-row align-items-sm-center justify-content-between mb-2">
											<h5 class="badge ${estadoClass} mb-2 mb-sm-0">${estado}</h5>
											<small class="text-muted">${fecha}</small>
										</div>
										<div class="d-flex flex-column">
											<p class="mb-2"><strong>Pedido:</strong> ${correlativo}</p>
											<p class="mb-0"><strong>Total:</strong>  ${moneda} ${total}</p>
											${estado.toUpperCase() === 'COMPLETADO' ? '<button class="btn btn-primary mt-3">Ver Detalles</button>' : ''}
										</div>
									</div>
								</div>
							`;

									
						});
		
						document.querySelector('#pedidos-results .timeline').innerHTML = timelineHTML;
						document.getElementById('pedidos-results').style.display = 'block';
					} catch (error) {
						console.error("Error al procesar datos:", error, resp);
						Swal.fire("Error", "Error al procesar la respuesta del servidor", "error");
					}
				},
				error: function(xhr, status) {
					Swal.fire("Error", "No se pudo conectar con el servidor", "error");
				}
			});
		}
		



  /********************************************************************
 		BUSCAR  VENTAS 
 ********************************************************************/

var tbl_buscar_ventas;
function Buscar_ventas(){//enviarlo al scrip en MANTENIMIENTO ROL
	var dni = document.getElementById('text_documento').value;

	tbl_buscar_ventas = $("#tabla_buscar_ventas").DataTable({		
	   "responsive" :true,
	   "ordering" :false,
	   "bLengthChange" : true,
	   "searching" : {"regex" : false},
	   "lengthMenu" : [[10, 25, 50, 100, -1],[10, 25, 50, 100, "All"]],
	   "pageLength" : 10,
	   "destroy" :true,
	   "async" : false,
	   "bprocessing": true,
	   "dom": 't',
	   "ajax" : {
		   "url": "../controller/buscarequipo/controlador_buscar_ventas.php",
		   type: 'POST',
		   data:{
			   dni:dni
		   }

	   },
	   "columns":[
	   //todos los datos del procedimiento almacenado
	   {"data": "comprobante"},
	   {"data": "venta_fregistro"},
	   {"data": "venta_total"},
	   {"data": "equipo"},
	   {
		"data": "venta_estado",
		render: function (data, type, row) {
			if (data === "REGISTRADA") {
				return "<center>" + '<span class="badge badge-warning">REGISTRADA</span>'; +"</center>"

			} if (data === "PAGADA") {
				return "<center>" + '<span class="badge badge-success">PAGADA</span>'; +"</center>"

			} else {
				return "<center>" + '<span class="badge badge-danger">ANULADA</span>'; +"</center>"
			}

		}
	},
	   

	   ],
	   "language":idioma_espanol,
	   select:true
   });
}	


