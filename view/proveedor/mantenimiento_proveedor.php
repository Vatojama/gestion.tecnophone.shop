<?php
session_start();
require_once("../../model/modelo_conexion.php");
require_once("../../model/modelo_rol.php");
$rol = new Modelo_Rol();
$datos = $rol->validar_menu_x_rol($_SESSION['S_ROL'], 35); 

if (isset($_SESSION['S_IDUSUARIO'])) {
    if (is_array($datos) and count($datos) > 0) {
?>
<script src="../js/proveedor.js?rev=<?php echo time(); ?>"></script>
<div class="content-header">
    <div class="container-fluid"><div class="row mb-2"></div></div>
</div>

<div class="col-lg-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title"><b>Listado de Proveedores</b></h3>
            <button class="btn btn-info btn-sm float-right" onclick="AbrirModalRegistroProveedor();">
                <i class="fas fa-plus"></i> Nuevo
            </button>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-12 table-responsive">
                    <table id="tabla_proveedor" class="display compact" style="width:100%">
                        <thead style="background:#343A40; color:white">
                            <tr>
                                <th>#</th>
                                <th>RUC/CIF</th>
                                <th>Razón Social / Nombre</th>
                                <th>Dirección</th>
                                <th>Celular</th>
                                <th style="text-align: center;">Lista N.</th>
                                <th style="text-align: center;">Estado</th>
                                <th style="text-align: center;">Acción</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal_registro_proveedor" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background:#343A40; color:white">
                <h5 class="modal-title">Registro de Proveedores</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <label>RUC/CIF: </label>
                        <input type="text" id="text_ruc" class="form-control form-control-sm" placeholder="Ingrese RUC">
                    </div>
                    <div class="col-12">
                        <label>Razón Social: </label>
                        <input type="text" id="text_razon" class="form-control form-control-sm" placeholder="Nombre de la empresa">
                    </div>
                    <div class="col-12">
                        <label>Dirección: </label>
                        <input type="text" id="text_direccion" class="form-control form-control-sm" placeholder="Dirección completa">
                    </div>
                    <div class="col-12">
                        <label>Celular: </label>
                        <input type="text" id="text_celular" class="form-control form-control-sm" placeholder="Número de contacto">
                    </div>
                    <div class="col-12">
                        <div class="form-check"><br>
                            <input class="form-check-input" type="checkbox" value="1" id="chkListanegra_prove" name="chkListanegra_prove"> 
                            <label class="form-check-label" for="chkListanegra_prove">Marcar como <b>Lista Negra</b></label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-sm btn-primary" onclick="RegistrarProveedor();">Registrar</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal_editar_proveedor" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background:#343A40; color:white">
                <h5 class="modal-title">Editar Datos de Proveedor</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <input type="text" id="id_proveedor" hidden>
                    <div class="col-12">
                        <label>Nro Documento: </label>
                        <input type="text" id="text_ruc_editar" class="form-control form-control-sm" disabled>
                    </div>
                    <div class="col-12">
                        <label>Razón Social / Nombre: </label>
                        <input type="text" id="text_razon_editar" class="form-control form-control-sm">
                    </div>
                    <div class="col-12">
                        <label>Dirección: </label>
                        <input type="text" id="text_direccion_editar" class="form-control form-control-sm">
                    </div>
                    <div class="col-6">
                        <label>Celular: </label>
                        <input type="text" id="text_celular_editar" class="form-control form-control-sm">
                    </div>
                    <div class="col-6">
                        <label>Estado: </label>
                        <select class="js-example-basic-single" id="select_estado_editar" style="width:100%">
                            <option value="ACTIVO">ACTIVO</option>
                            <option value="INACTIVO">INACTIVO</option>
                        </select>
                    </div>
                    <div class="col-12">
                        <div class="form-check"><br>
                            <input class="form-check-input" type="checkbox" value="1" id="chkListanegra_prove_editar"> 
                            <label class="form-check-label" for="chkListanegra_prove_editar">Lista <b>Negra</b></label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-sm btn-primary" onclick="ModificarProveedor();">Modificar</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal_compras_prove" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background:#343A40; color:white">
                <h5 class="modal-title">Historial de Compras</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <input type="text" id="idproveedor_historial" hidden>
                    <div class="col-5">
                        <label>Desde</label>
                        <input type="date" id="text_finicio" class="form-control form-control-sm">
                    </div>
                    <div class="col-5">
                        <label>Hasta</label>
                        <input type="date" id="text_ffin" class="form-control form-control-sm">
                    </div>
                    <div class="col-2">
                        <label>&nbsp;</label><br>
                        <button class="btn btn-info btn-sm" id="btn_buscarcompras"><i class="fas fa-search"></i></button>
                    </div>
                </div><br>
                <table id="tabla_compras_prove" class="display compact" style="width: 100%">
                    <thead style="background:#343A40; color:white">
                        <tr>
                            <th>Código</th><th>Producto</th><th>P.Compra</th><th>Fecha</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    $('.js-example-basic-single').select2();
    Listar_Proveedor();

    var f = new Date();
    var anio = f.getFullYear();
    var mes = (f.getMonth() + 1);
    var d = f.getDate();
    if (d < 10) d = '0' + d;
    if (mes < 10) mes = '0' + mes;

    document.getElementById('text_finicio').value = anio + "-" + mes + "-" + d;
    document.getElementById('text_ffin').value = anio + "-" + mes + "-" + d;
});
</script>
<?php
    }
}
?>