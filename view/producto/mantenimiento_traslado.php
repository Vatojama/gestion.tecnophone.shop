<?php
session_start();
require_once("../../model/modelo_conexion.php");
require_once("../../model/modelo_rol.php");
$rol = new Modelo_Rol();
$datos = $rol->validar_menu_x_rol(
    $_SESSION['S_ROL'],
    34
); // EL 34 ES MENU traslado
//var_dump($datos);
if (isset($_SESSION['S_IDUSUARIO'])) {

    if (is_array($datos) and count($datos) > 0) {
?>
        <script src="../js/traslado.js?rev=<?php echo time(); ?>"></script>
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">


                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>


        <div class="col-lg-12">
            <div class="card ">
                <div class="card-header">
                    <h3 class="card-title"><b>Listado de Traslados</b></h3>
                    <button class="btn btn-info btn-sm float-right" id="btn_nuevo_traslado"><i class="fas fa-plus"></i> Nuevo</button>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 table-responsive">
                            <table id="tabla_traslado" class="display compact" style="width: 100%">
                                <thead style="background:#343A40; color:white" class="small text left">
                                    <tr>
                                        <th>#</th>
                                        <th>Alm. Origen</th>
                                        <th>Alm. Destino</th>
                                        <th>Fecha</th>
                                        <th>Usuario</th>

                                        <th style="text-align: center;">Estado</th>
                                        <th style="text-align: center;">Accion</th>
                                    </tr>
                                </thead>
                                <tbody class="small text left">

                                </tbody>

                            </table>

                        </div>
                    </div>
                </div>
            </div>


        </div>


        <!-- Modal registrar -->
        <div class="modal fade" id="modal_registrar_traslado" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header" style="background:#343A40; color:white">
                        <h5 class="modal-title" id="exampleModalLabel">Registrar Traslado Almacen</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <input type="text" id="id_traslado" class="form-control form-control-sm" hidden>

                            <div class="col-md-6 col-12">
                                <label form="">Almacen Origen: </label>
                                <select class="form-control form-control-sm " id="select_alm_ori" style="width: 100%">

                                </select>
                            </div>

                            <div class="col-md-6 col-12">
                                <label form="">Almacen Destino: </label>
                                <select class="form-control form-control-sm " id="select_alm_des" style="width: 100%">

                                </select>
                            </div>
                            <div class="col-md-12 col-12 ">
                                <label form="">Descripcion: </label>
                                <input type="text" id="text_descrip_tr" class="form-control form-control-sm" placeholder="Descripcion">
                            </div>

                        </div><br>

                        <div class="row">
                            <div class="col-lg-12 col-12">
                                <label form="">Productos</label>
                                <!-- <input type="text" id="" class="form-control form-control-sm" placeholder="Descripcion"> -->
                                <select class="form-control form-control-sm " id="select_producto" style="width:100%">

                                </select>
                            </div>
                            <div class="col-md-4 col-6 ">
                                <label form="">Precio: </label>
                                <select class="form-control form-control-sm" id="select_precio_prod" style="width:100%">

                                </select>
                            </div>
                            <div class="col-md-4 col-6 ">
                                <label form="">Cantidad: </label>
                                <input type="text" id="text_canti_prod" class="form-control form-control-sm" placeholder="Cantidad">
                            </div>
                            <div class="col-md-1 col-6 " hidden>
                                <label form="">stock: </label>
                                <input type="text" id="text_stock_prod" class="form-control form-control-sm" disabled>
                            </div>
                            <div class="col-1">
                                <label form="">&nbsp;</label><br>
                                <button class="btn btn-success btn-sm" id="btn_agregarProd"><i class="fas fa-plus"></i></button>
                            </div>
                        </div><br>
                        <div class="row">
                            <div class="col-12 table-responsive">
                                <table id="tabla_traslado_detalle" class="display compact" style="width: 100%">
                                    <thead style="background:#343A40; color:white" class="small text left">
                                        <tr>
                                            <th>#</th>
                                            <th>Descripcion</th>
                                            <th>Precio</th>
                                            <th>Cantidad</th>
                                            <th>Accion</th>
                                        </tr>
                                    </thead>
                                    <tbody class="tbody_tabla_det_traslado small text left">

                                    </tbody>

                                </table>

                            </div>
                        </div>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="button" class="btn btn-primary" id="btn_registrar_tarslado">Registrar</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- fin Modal -->

         <!-- Modal ver traslado -->
        <div class="modal fade" id="modal_ver_traslado" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header" style="background:#343A40; color:white">
                        <h5 class="modal-title" id="exampleModalLabel">Detalles de Traslado </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <input type="text" id="id_traslado_v" class="form-control form-control-sm" hidden>

                            <div class="col-md-6 col-12">
                                <label form="">Almacen Origen: </label>
                                <!-- <select class="form-control form-control-sm " id="" style="width: 100%" disabled> -->
                                <input type="text" id="select_alm_ori_v" class="form-control form-control-sm" placeholder="" disabled>

                                <!-- </select> -->
                            </div>

                            <div class="col-md-6 col-12">
                                <label form="">Almacen Destino: </label>
                                <!-- <select class="form-control form-control-sm " id="" style="width: 100%" disabled> -->
                                     <input type="text" id="select_alm_des_v" class="form-control form-control-sm" placeholder="" disabled>

                                <!-- </select> -->
                            </div>
                            <div class="col-md-12 col-12 ">
                                <label form="">Descripcion: </label>
                                <input type="text" id="text_descrip_tr_v" class="form-control form-control-sm" placeholder="Descripcion" disabled>
                            </div>

                        </div><br>

                        <div class="row" hidden>
                            <div class="col-lg-12 col-12">
                                <label form="">Productos</label>
                                <!-- <input type="text" id="" class="form-control form-control-sm" placeholder="Descripcion"> -->
                                <select class="form-control form-control-sm " id="select_producto_v" style="width:100%">

                                </select>
                            </div>
                            <div class="col-md-4 col-6 ">
                                <label form="">Precio: </label>
                                <select class="form-control form-control-sm" id="select_precio_prod_v" style="width:100%">

                                </select>
                            </div>
                            <div class="col-md-4 col-6 ">
                                <label form="">Cantidad: </label>
                                <input type="text" id="text_canti_prod_v" class="form-control form-control-sm" placeholder="Cantidad">
                            </div>
                            <div class="col-md-1 col-6 " hidden>
                                <label form="">stock: </label>
                                <input type="text" id="text_stock_prod_v" class="form-control form-control-sm" disabled>
                            </div>
                            <div class="col-1">
                                <label form="">&nbsp;</label><br>
                                <button class="btn btn-success btn-sm" id="btn_agregarProd_v"><i class="fas fa-plus"></i></button>
                            </div>
                        </div><br>
                        <div class="row">
                            <div class="col-12 table-responsive">
                                <table id="tabla_traslado_detalle_v" class="display compact" style="width: 100%">
                                    <thead style="background:#343A40; color:white" class="small text left">
                                        <tr>
                                            <!-- <th>#</th> -->
                                            <th>Descripcion</th>
                                            <th>Precio</th>
                                            <th>Cantidad</th>
                                            <!-- <th>Accion</th> -->
                                        </tr>
                                    </thead>
                                    <tbody class="tbody_tabla_det_traslado_v small text left">

                                    </tbody>

                                </table>

                            </div>
                        </div>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <!-- <button type="button" class="btn btn-primary" id="">Registrar</button> -->
                    </div>
                </div>
            </div>
        </div>

        <!-- fin Modal -->



        <script>
            //para el diseño del combo
            $(document).ready(function() {
                let idalmac = document.getElementById('text_idalmacen').value;

                Listar_Traslados();

                $('#modal_registrar_traslado').on('shown.bs.modal', function() {
                    Listar_Almacenes_Origen();
                    Listar_Almacenes_destino(); // Aquí se cargan los datos y se aplica select2()
                });



                //LISTAR PRODUCTOS AL ESCRIBIR EN SELECT 
                $('#select_producto').select2({
                    placeholder: "Seleccione un producto",
                    allowClear: true,
                    dropdownParent: $('#modal_registrar_traslado'),
                    ajax: {
                        url: '../controller/venta/controlador_cargar_selectcombo_productos_venta.php',
                        dataType: 'json',
                        delay: 250,
                        data: function(params) {
                            return {
                                q: params.term, // search term
                                idalmac: idalmac
                            };
                        },
                        processResults: function(data) {
                            return {
                                results: data
                            };
                        },
                        cache: true
                    },
                    minimumInputLength: 1,
                    templateResult: formatRepo,
                    templateSelection: formatRepoSelection
                }).on('select2:select', function(e) {
                    var data = e.params.data;
                  //  console.log(data);
                    document.getElementById('text_stock_prod').value= data.stock;
                    const selectPrecio = $('#select_precio_prod');
                    let opciones = `
                        <option value="${data.precio_venta}">Precio Venta: S/ ${data.precio_venta}</option>
                        <option value="${data.preciocomercial}">Precio Comercial: S/ ${data.preciocomercial}</option>
                        <option value="${data.preciomayorista}">Precio Mayorista: S/ ${data.preciomayorista}</option>
                    `;
                    selectPrecio.html(opciones);

                });




                $('#btn_nuevo_traslado').click(function() {
                    AbrirModalRegistroTraslado();
                });

                $('#btn_agregarProd').click(function() {
                    Agregar_Producto();
                });

                $('#btn_registrar_tarslado').click(function() {
                    Registrar_Traslado_cab();
                });

            });




            function formatRepo(repo) {
                if (repo.loading) {
                    return repo.text;
                }
                return repo.text;
            }

            function formatRepoSelection(repo) {
                return repo.text;
            }
        </script>



<?php
    } else {
        header("Location:" . conexionBD::ruta() . "view/404/mant_error.php");
    }
} else {
    header("Location:" . conexionBD::ruta() . "view/404/mant_error.php");
}
?>