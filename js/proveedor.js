/********************************************************************
		LISTAR PROVEEDOR CON METODO NORMAL
********************************************************************/
var tbl_proveedor;
function Listar_Proveedor() {
    tbl_proveedor = $("#tabla_proveedor").DataTable({
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
            "url": "../controller/proveedor/controlador_proveedor_listar.php",
            "type": 'POST'
        },
        "dom": 'Blfrtip',
        "buttons": [
            {
                "extend": 'excelHtml5',
                "text": '<i class="fa fa-file-excel"></i>',
                "titleAttr": 'Exportar a Excel'
            }
        ],
        "columns": [
            { "defaultContent": "" }, // Columna 0: Contador
            { "data": "prove_ruc" },
            { "data": "prove_razon" },
            { "data": "prove_direccion" }, 
            { "data": "prove_celular" },
            {
                "data": "lista_negra",
                render: function (data) {
                    return data == '1' ? "<center><span class='badge badge-danger'>SI</span></center>" : "<center><span class='badge badge-success'>NO</span></center>";
                }
            },
            {
                "data": "prove_estado",
                render: function (data) {
                    return data === "ACTIVO" ? "<center><span class='badge badge-success'>ACTIVO</span></center>" : "<center><span class='badge badge-danger'>INACTIVO</span></center>";
                }
            },
            { "defaultContent": "<center><button class='editar btn btn-primary btn-sm'><i class='fa fa-edit'></i></button> <button class='historial btn btn-info btn-sm'><i class='fa fa-eye'></i></button></center>" }
        ],
        "language": idioma_espanol
    });

    // Función para el contador secuencial 1, 2, 3...
    tbl_proveedor.on('draw.dt', function () {
        var PageInfo = $("#tabla_proveedor").DataTable().page.info();
        tbl_proveedor.column(0, { page: 'current' }).nodes().each(function (cell, i) {
            cell.innerHTML = i + 1 + PageInfo.start;
        });
    });
}

/********************************************************************
		ABRIR MODAL REGISTRAR PROVEEDOR
********************************************************************/
function AbrirModalRegistroProveedor(){
	$("#modal_registro_proveedor").modal({backdrop:'static', keyboard: false});	
	$("#modal_registro_proveedor").modal('show');
	$('.form-control').removeClass("is-invalid").removeClass("is-valid");
}

/********************************************************************
		ABRIR MODAL EDITAR PROVEEDOR
********************************************************************/
$('#tabla_proveedor').on('click', '.editar', function() {
	var data = tbl_proveedor.row($(this).parents('tr')).data();
	if (tbl_proveedor.row(this).child.isShown()) {
		var data = tbl_proveedor.row(this).data();
	}
	$("#modal_editar_proveedor").modal({backdrop:'static', keyboard: false});	
	$("#modal_editar_proveedor").modal('show');

	// Asignación de valores coincidiendo con los IDs de tu HTML
	document.getElementById('idproveedor').value = data.prove_id;
	document.getElementById('text_ruc_editar').value = data.prove_ruc;
	document.getElementById('text_razon_editar').value = data.prove_razon;
	document.getElementById('text_direccion_editar').value = data.prove_direccion;
	document.getElementById('text_celular_editar').value = data.prove_celular;
	
	// Cargar el estado del checkbox de Lista Negra en edición
	if(data.lista_negra == '1'){
		$("#chkListanegra_prove_editar").prop('checked', true);
	} else {
		$("#chkListanegra_prove_editar").prop('checked', false);
	}

	$("#select_estado_proveedor_editar").select2().val(data.prove_estado).trigger('change.select2');
});

/********************************************************************
		VALIDAR TEXBOX PROVEEDOR
********************************************************************/
function ValidarCamposProveedor(ruc,razon,direccion){
	Boolean(document.getElementById(ruc).value.length>0) ? $("#"+ruc).removeClass("is-invalid").addClass("is-valid") : $("#"+ruc).removeClass("is-valid").addClass("is-invalid");
	Boolean(document.getElementById(razon).value.length>0) ? $("#"+razon).removeClass("is-invalid").addClass("is-valid") : $("#"+razon).removeClass("is-valid").addClass("is-invalid");
	Boolean(document.getElementById(direccion).value.length>0) ? $("#"+direccion).removeClass("is-valid").addClass("is-valid") : $("#"+direccion).removeClass("is-valid").addClass("is-invalid");
}

/********************************************************************
		LIMPIAR TEXBOX PROVEEDOR
********************************************************************/
function LimpiarModalProveedor(){
	document.getElementById('text_ruc').value="";
	document.getElementById('text_razon').value="";
	document.getElementById('text_direccion').value="";
	document.getElementById('text_celular').value="";
	$("#chkListanegra_prove").prop('checked', false);
}

/********************************************************************
		REGISTRAR PROVEEDOR
********************************************************************/
function RegistrarProveedor(){
    let ruc = document.getElementById('text_ruc').value;
    let razon = document.getElementById('text_razon').value;
    let direccion = document.getElementById('text_direccion').value;
    let celular = document.getElementById('text_celular').value;
    let lista_negra = document.getElementById('chkListanegra_prove').checked ? '1' : '0';

    if (ruc.length == 0 || razon.length == 0 || direccion.length == 0) {
        ValidarCamposProveedor("text_ruc","text_razon","text_direccion");
        return Swal.fire("Mensaje de Advertencia","Tiene campos vacíos","warning");
    }

    $.ajax({
        url:'../controller/proveedor/controlador_proveedor_registar.php',
        type: 'POST',
        data:{
            ruc: ruc,
            razon: razon,
            direccion: direccion,			
            celular: celular,
            lista_negra: lista_negra
        }
    }).done(function(resp){
        if (resp > 0) {
            if (resp == 1) {
                Swal.fire("Mensaje de Confirmación","Proveedor Registrado","success").then((value)=>{
                    $("#modal_registro_proveedor").modal('hide');
                    tbl_proveedor.ajax.reload();
                    LimpiarModalProveedor();
                });	
            } else {
                Swal.fire("Mensaje de Advertencia","El RUC ya se encuentra en la base de datos","warning");
            }
        } else {
            Swal.fire("Mensaje de Error","No se pudo completar el registro","error");
        }
    })	 
}

/********************************************************************
		MODIFICAR PROVEEDOR
********************************************************************/
function ModificarProveedor() {
    let id = document.getElementById('idproveedor').value;
    let ruc = document.getElementById('text_ruc_editar').value;
    let razon = document.getElementById('text_razon_editar').value;
    let direccion = document.getElementById('text_direccion_editar').value;
    let celular = document.getElementById('text_celular_editar').value;
    let estado = document.getElementById('select_estado_proveedor_editar').value;
    let lista_negra = document.getElementById('chkListanegra_prove_editar').checked ? '1' : '0';

    if (ruc.length == 0 || razon.length == 0 || direccion.length == 0) {
        ValidarCamposProveedor("text_ruc_editar","text_razon_editar","text_direccion_editar");
        return Swal.fire("Mensaje de Advertencia", "Tiene campos vacíos", "warning");
    }

    $.ajax({
        url: '../controller/proveedor/controlador_modificar_proveedor.php',
        type: 'POST',
        data: {
            id: id,
            ruc: ruc,
            razon: razon,
            direccion: direccion,
            celular: celular,
            estado: estado,
            lista_negra: lista_negra
        }
    }).done(function(resp) {
        if (resp > 0) {
            if (resp == 1) {
                Swal.fire("Mensaje de Confirmación", "Proveedor Actualizado", "success").then((value) => {
                    $("#modal_editar_proveedor").modal('hide');
                    tbl_proveedor.ajax.reload();
                });
            } else {
                Swal.fire("Mensaje de Advertencia", "El RUC ya existe en otro proveedor", "warning");
            }
        } else {
            Swal.fire("Mensaje de Error", "No se pudo actualizar el Proveedor", "error");
        }
    });
}