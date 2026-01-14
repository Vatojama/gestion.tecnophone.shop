/********************************************************************
           LISTAR UNIDAD DE MEDIDA CON METODO NORMAL
********************************************************************/
var tbl_umedida;
function Listar_UMedida() {//enviarlo al scrip en MANTENIMIENTO ROL
    tbl_umedida = $("#tabla_unidad_medida").DataTable({
        "responsive": true,
        "ordering": false,
        "bLengthChange": true,
        "searching": { "regex": false },
        "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
        "pageLength": 10,
        "destroy": true,
        "async": false,
        "processing": true,
        "ajax": {
            "url": "../controller/medida/controlador_medida_listar.php",
            type: 'POST'
        },
        "columns": [
            //todos los datos del procedimiento almacenado
            //{"defaultContent": ""},//cintador 
            { "data": "unidad_id" },
            { "data": "unidad_descripcion" },
            { "data": "unidad_abrevia" },
            {
                "data": "unidad_estado",
                render: function (data, type, row) {
                    if (data === "ACTIVO") {
                        return "<center>" + '<span class="badge badge-success">ACTIVO</span>' + "</center>";
                    } else {
                        return "<center>" + '<span class="badge badge-danger">INACTIVO</span>' + "</center>";
                    }
                }
            },
            { "defaultContent": "<center>" + "<span class='editar text-primary px-1' style='cursor:pointer;' data-bs-toggle='tooltip' data-bs-placement='top' title='Editar'><i class= 'fa fa-edit'></i></span> <span class=' eliminar text-danger px-1' style='cursor:pointer;' data-bs-toggle='tooltip' data-bs-placement='top' title='Eliminar'><i class='fa fa-trash'></i></span>" + "</center>" }


        ],
        "language": idioma_espanol,
        select: true
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
              ABRIR MODAL REGISTRAR UNIDAD DE MEDIDA
********************************************************************/
function AbrirModalRegistroMedida() {
    $("#modal_registro_unidad_medida").modal({ backdrop: 'static', keyboard: false });
    $("#modal_registro_unidad_medida").modal('show');//abrimos el modal

    document.getElementById('text_descripcion').value = "";
    document.getElementById('text_abreviatura').value = "";

    $('.form-control').removeClass("is-invalid").removeClass("is-valid");//remover las clases
}




/********************************************************************
                  REGISTRAR LA UNIDAD DE MEDIDA
********************************************************************/
function Registrar_Unidad_medida() {
    let descripcion = document.getElementById('text_descripcion').value;
    let abreviatura = document.getElementById('text_abreviatura').value;
    if (descripcion.length == 0) {
        return Swal.fire("Mensaje de Advertencia", "Ingrese una descripcion", "warning");
    }
    if (abreviatura.length == 0) {
        return Swal.fire("Mensaje de Advertencia", "Ingrese la abreviatura", "warning");
    }

    $.ajax({
        url: '../controller/medida/controlador_umedida_registar.php',
        type: 'POST',
        data: {
            descripcion: descripcion,//le enviamos los campos al controlador
            abreviatura: abreviatura

        }
    }).done(function (resp) {
        if (resp > 0) {
            if (resp == 1) {//validamos la respuesta del procedure si retorna 1 o 2
                Swal.fire("Mensaje de Confirmacion", "Unidad de medida Registrada", "success").then((value) => {
                    document.getElementById('text_descripcion').value = "";
                    document.getElementById('text_abreviatura').value = "";
                    $("#modal_registro_unidad_medida").modal('hide');//ocultamos el modal

                    tbl_umedida.ajax.reload();//recargar dataTable
                });
            } else {
                Swal.fire("Mensaje de Advertencia", "La Unidad de medida  ya se encuentra registrada", "warning");
            }

        } else {
            Swal.fire("Mensaje de Error", "No se puede registrar la Unidad de medida ", "error");
        }
    })
}



/**********************************************************************
             ABRIR MODAL EDITAR Y TRAER DATOS A LOS CAMPOS
***********************************************************************/
$('#tabla_unidad_medida').on('click', '.editar', function () {//class foto tiene que ir en el boton
    var data = tbl_umedida.row($(this).parents('tr')).data();//tamaño de escritorio
    if (tbl_umedida.row(this).child.isShown()) {
        var data = tbl_umedida.row(this).data();//para celular y usas el responsive datatable
    }
    $("#modal_editar_unidad_medida").modal({ backdrop: 'static', keyboard: false });
    $("#modal_editar_unidad_medida").modal('show');//abrimos el modal

    //mandamos parametros a los texbox
    //document.getElementById('idrol').value=data[0];
    document.getElementById('idunidadmedida').value = data.unidad_id;//id del procedure
    document.getElementById('text_descripcion_editar').value = data.unidad_descripcion;//enviamos el nombre del usu al modal
    document.getElementById('text_abreviatura_editar').value = data.unidad_abrevia;
    
    $("#select_estado_unidad_editar").select2().val(data.unidad_estado).trigger('change.select2');
});




/********************************************************************
                  MODIFICAR LA UNIDAD DE MEDIDA
********************************************************************/
function Modificar_Unidad_medida() {
    let idmedida = document.getElementById('idunidadmedida').value;
    let descripcion = document.getElementById('text_descripcion_editar').value;
    let abreviatura = document.getElementById('text_abreviatura_editar').value;
    let estado = document.getElementById('select_estado_unidad_editar').value;

    if (descripcion.length == 0) {
        return Swal.fire("Mensaje de Advertencia", "Ingrese una descripcion", "warning");
    }
    if (abreviatura.length == 0) {
        return Swal.fire("Mensaje de Advertencia", "Ingrese la abreviatura", "warning");
    }

    $.ajax({
        url: '../controller/medida/controlador_umedida_modificar.php',
        type: 'POST',
        data: {
            idmedida: idmedida,
            descripcion: descripcion,//le enviamos los campos al controlador
            abreviatura: abreviatura,
            estado: estado

        }
    }).done(function (resp) {
        if (resp > 0) {
            if (resp == 1) {//validamos la respuesta del procedure si retorna 1 o 2
                Swal.fire("Mensaje de Confirmacion", "Unidad de medida Registrada", "success").then((value) => {
                    document.getElementById('text_descripcion_editar').value = "";
                    document.getElementById('text_abreviatura_editar').value = "";
                    $("#modal_editar_unidad_medida").modal('hide');//ocultamos el modal

                    tbl_umedida.ajax.reload();//recargar dataTable
                });
            } else {
                Swal.fire("Mensaje de Advertencia", "La Unidad de medida  ya se encuentra registrada", "warning");
            }

        } else {
            Swal.fire("Mensaje de Error", "No se puede Modificar la Unidad de medida ", "error");
        }
    })
}

/**********************************************************************
                  MENSAJE ELIMINAR MEDIDA
***********************************************************************/
$('#tabla_unidad_medida').on('click', '.eliminar', function () {//campo activar tiene que ir en el boton
    var data = tbl_umedida.row($(this).parents('tr')).data();//tamaño de escritorio
    if (tbl_umedida.row(this).child.isShown()) {
        var data = tbl_umedida.row(this).data();//para celular y usas el responsive datatable
    }
    Swal.fire({
        title: 'Desea Eliminar la Unidad de M.?',
        text: "Se borrara el registro de la base de datos",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, confirmar'
    }).then((result) => {
        if (result.isConfirmed) {
            Eliminar_UMedida(data.unidad_id);//campo id de la marca luego llamamos al metodo
        }
    })
});

/********************************************************************
               METODO   ELIMINAR LA MEDIDA
********************************************************************/
function Eliminar_UMedida(id) {
    $.ajax({
        
        url: '../controller/medida/controlador_umedida_eliminar.php',
        type: 'POST',
        data: {
            id: id//le enviamos los campos al controlador
        }
    }).done(function (resp) {
        if (resp > 0) {
            Swal.fire("Mensaje de Confirmacion", "Unidad Eliminada", "success").then((value) => {
                tbl_umedida.ajax.reload();//recargar dataTable
                //TraerNotificaciones();
            });
        } else {
            Swal.fire("Mensaje de Error", "No se puede eliminar la Unidad", "error");
        }
    })
}