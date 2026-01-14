/**********************************************************************
                     GRAFICO DE SERVICIO
***********************************************************************/
function Grafico_servicio() {
    var finicio = document.getElementById("text_finicio").value;
    var ffin = document.getElementById("text_ffin").value;
 let sucurid = document.getElementById('select_sucur').value;

    if (finicio.length == 0 || ffin.length == 0) {
        return Swal.fire(
            "Mensaje de Advertencia",
            "Seleccione una Fecha de inicio y de fin",
            "warning"
        );
    }

    if (finicio > ffin) {
        return Swal.fire(
            "Mensaje de Advertencia",
            "La fecha de inicio no puede ser mayor a la fecha fin",
            "warning"
        );
    
    }


    if (sucurid == 0) {
        return Swal.fire(
            "Mensaje de Advertencia Servicio",
            " Seleccione una Sucursal",
            "warning"
        );
    }

    $.ajax({
        url: "../controller/recepcion/controlador_traer_grafico_servicio.php",
        type: "POST",
        data: {
            //enviamos la fechas seleccionas desde el dashboard
            finicio: finicio,
            ffin: ffin,
            sucurid:sucurid

        },
    }).done(function (resp) {
        let data = JSON.parse(resp); //POSICION DE LA FILA Y COLUMNA

        if (data.length > 0) {
            let tiposervicio = new Array();
            let cantidad = new Array();
            let color = new Array();

            for (let i = 0; i < data.length; i++) {
                cantidad.push(data[i][0]);
                tiposervicio.push(data[i][1]);
                color.push(colorRGB());
            }
            const ctx = document.getElementById("grafico_servicio").getContext("2d");
            const myChart = new Chart(ctx, {
                type: "bar",
                data: {
                    labels: tiposervicio,
                    datasets: [
                        {
                            label: "SERVICIOS",
                            data: cantidad,
                            backgroundColor: color,
                            borderColor: color,
                            borderWidth: 1,
                        },
                    ],
                },

                options: {
                    scales: {
                        xAxes: [
                            {
                                stacked: true,
                            },
                        ],
                        yAxes: [
                            {
                                stacked: true,
                            },
                        ],
                    },
                },
            });
        } else {
            const ctx = document.getElementById("grafico_servicio").getContext("2d");
            const myChart = new Chart(ctx, {
                type: "bar",
                data: {
                    labels: ["SIN RESULTADOS"],
                    datasets: [
                        {
                            label: "SERVICIOS",
                            data: [0],
                        },
                    ],
                },
                options: {
                    scales: {
                        xAxes: {
                            stacked: true,
                        },
                        yAxes: {
                            stacked: true,
                        },
                    },
                },
            });
        }
    });
}

/**********************************************************************
                                 GRAFICO DE VENTAS
***********************************************************************/
function Grafico_ventas() {
    var finicio = document.getElementById("text_finicio").value;
    var ffin = document.getElementById("text_ffin").value;
     let sucurid = document.getElementById('select_sucur').value;

    if (finicio.length == 0 || ffin.length == 0) {
        return Swal.fire(
            "Mensaje de Advertencia",
            "Seleccione una Fecha de inicio y de fin",
            "warning"
        );
    }

    if (finicio > ffin) {
        return Swal.fire(
            "Mensaje de Advertencia",
            "La fecha de inicio no puede ser mayor a la fecha fin",
            "warning"
        );
    }
     if (sucurid == 0) {
        return Swal.fire(
            "Mensaje de Advertencia Ventas",
            " Seleccione una Sucursal",
            "warning"
        );
    }


    $.ajax({
        url: "../controller/recepcion/controlador_traer_grafico_ventas.php",
        type: "POST",
        data: {
            //enviamos la fechas seleccionas desde el dashboard
            finicio: finicio,
            ffin: ffin,
            sucurid:sucurid
        },
    }).done(function (resp) {
        let data = JSON.parse(resp); //POSICION DE LA FILA Y COLUMNA

        if (data.length > 0) {
            let tiposervicio = new Array();
            let cantidad = new Array();
            let color = new Array();

            for (let i = 0; i < data.length; i++) {
                cantidad.push(data[i][0]);
                tiposervicio.push(data[i][1]);
                color.push(colorRGB());
            }
            const ctx = document.getElementById("grafico_ventas").getContext("2d");
            const myChart = new Chart(ctx, {
                type: "bar",
                data: {
                    labels: tiposervicio,
                    datasets: [
                        {
                            label: "VENTAS",
                            data: cantidad,
                            backgroundColor: color,
                            borderColor: color,
                            borderWidth: 1,
                        },
                    ],
                },

                options: {
                    scales: {
                        xAxes: [
                            {
                                stacked: true,
                            },
                        ],
                        yAxes: [
                            {
                                stacked: true,
                            },
                        ],
                    },
                },
            });
        } else {
            const ctx = document.getElementById("grafico_ventas").getContext("2d");
            const myChart = new Chart(ctx, {
                type: "bar",
                data: {
                    labels: ["SIN RESULTADOS"],
                    datasets: [
                        {
                            label: "SERVICIOS",
                            data: [0],
                        },
                    ],
                },
                options: {
                    scales: {
                        xAxes: {
                            stacked: true,
                        },
                        yAxes: {
                            stacked: true,
                        },
                    },
                },
            });
        }
    });
}


/**********************************************************************
             TRAER DATOS PARA LOS WIDGET
***********************************************************************/
function Traer_datos_widget() {

    var finicio = document.getElementById('text_finicio').value;
    var ffin = document.getElementById('text_ffin').value;
      let sucurid = document.getElementById('select_sucur').value;

    if (finicio.length == 0 || ffin.length == 0) {
        return Swal.fire("Mensaje de Advertencia", "Seleccione una Fecha de inicio y de fin", "warning");
    }

    if (finicio > ffin) {
        return Swal.fire("Mensaje de Advertencia", "La fecha de inicio no puede ser mayor a la fecha fin",
            "warning");
    }

      if (sucurid == 0) {
        return Swal.fire(
            "Mensaje de Advertencia cajas widget",
            " Seleccione una Sucursal",
            "warning"
        );
    }

    $.ajax({
        url: '../controller/recepcion/controlador_traer_widget.php',
        type: 'POST',
        data: {
            finicio: finicio,
            ffin: ffin,
            sucurid:sucurid
        }
    }).done(function (resp) {
        //alert(resp);
        let data = JSON.parse(resp); //POSICION DE LA FILA Y COLUMNA

        if (data.length > 0) {
            document.getElementById('lbl_ventas').innerHTML = data[0][0];
            document.getElementById('lbl_Cant_ventas').innerHTML = data[0][1];
            document.getElementById('lbl_servicio').innerHTML = data[0][2];
            document.getElementById('lbl_Cant_servicio').innerHTML = data[0][3];
            document.getElementById('lbl_gasto').innerHTML = data[0][4];
            document.getElementById('lbl_Cant_gasto').innerHTML = data[0][5];
            document.getElementById('lbl_Cant_producto').innerHTML = data[0][6];

        }
    })
}





/********************************************************************
                    PRODUCTOS MAS VENDIDOS 
 ********************************************************************/

var tbl_pro_vendidos;
//listar  con metodo normal
function Listar_Productos_Vendidos() { //enviarlo al scrip en MANTENIMIENTO ROL
    var finicio = document.getElementById('text_finicio').value;
    var ffin = document.getElementById('text_ffin').value;
    let sucurid = document.getElementById('select_sucur').value;

    tbl_pro_vendidos = $("#tabla_productos_mas_vendidos").DataTable({
        "responsive": true,
        "ordering": false,
        "bLengthChange": true,
        "searching": {
            "regex": false
        },
        "lengthMenu": [
            [10, 25, 50, 100, -1],
            [10, 25, 50, 100, "All"]
        ],
        "pageLength": 10,
        "destroy": true,
        "async": false,
        "processing": true,
        "ajax": {
            "url": "../controller/producto/controlador_productos_mas_vendidos.php",
            type: 'POST',
             data: {
            finicio: finicio,
            ffin: ffin,
            sucurid:sucurid

        },
        },
        "dom": 'rt',
        "columns": [
            //todos los datos del procedimiento almacenado
            // {"defaultContent": ""},//cintador 
            {
                "data": "Producto"
            },
            {
                "data": "cantidad",
                render: function (data, type, row) {
                    if (data > 0) {
                        return "<center>" + '<span class=" ">' + data + '</span>'; + "</center>"
                    } else {
                        return "<center>" + '<span class="">' + data + '</span>'; + "</center>"
                    }

                }
            },


        ],
        "language": idioma_espanol,
        select: true
    });

}




/********************************************************************
                    PRODUCTOS SIN STOCK  
 ********************************************************************/

var tbl_pro_sinstock;
//listar  con metodo normal
function Listar_Productos_Sin_Stock() { //enviarlo al scrip en MANTENIMIENTO ROL
    //  var finicio = document.getElementById('text_finicio').value;
    // var ffin = document.getElementById('text_ffin').value;
    let sucurid = document.getElementById('select_sucur').value;
    tbl_pro_sinstock = $("#tabla_productos_sin_stock").DataTable({
        "responsive": true,
        "ordering": false,
        "bLengthChange": true,
        "searching": {
            "regex": false
        },
        "lengthMenu": [
            [10, 25, 50, 100, -1],
            [10, 25, 50, 100, "All"]
        ],
        "pageLength": 10,
        "destroy": true,
        "async": false,
        "processing": true,
        "ajax": {
            "url": "../controller/producto/controlador_productos_sin_stock.php",
            type: 'POST',
             data: {
          
            sucurid:sucurid

        },
        },
        "dom": 'rt',
        "columns": [
            //todos los datos del procedimiento almacenado
            // {"defaultContent": ""},//cintador 
            {
                "data": "Producto"
            },
            {
                "data": "stock",
                render: function (data, type, row) {
                    if (data < 3) {
                        return "<center>" + '<span class="badge badge-danger ">' + data +
                            '</span>'; + "</center>"
                    } else {
                        return "<center>" + '<span class="">' + data + '</span>'; + "</center>"
                    }

                }
            },


        ],
        "language": idioma_espanol,
        select: true
    });

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



   function cargar_SelectSucursales(){
 	$.ajax({
 		url:'../controller/usuario/Cargar_select_Sucursal.php',
 		type: 'POST'
 	}).done(function(resp){
 		let data = JSON.parse(resp);//POSICION DE LA FILA Y COLUMNA
 		let llenardata = "<option value=''>Seleccione</option>";
 		if (data.length>0) {
 			for (let i = 0; i < data.length; i++) {
 				llenardata+="<option value='"+data[i][0]+"'>"+data[i][1]+"</option>";
 			}
 			document.getElementById('select_sucur').innerHTML = llenardata;
 			//document.getElementById('select_sucur_editar').innerHTML = llenardata;
 		}else{
 			llenardata+="<option value=''>No se encontraron datos</option>";
 			document.getElementById('select_sucur').innerHTML = llenardata;
 			//document.getElementById('select_sucur_editar').innerHTML = llenardata;

 		}
 	})
 }

