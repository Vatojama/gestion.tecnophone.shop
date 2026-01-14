<?php
session_start();
    require_once("../../model/modelo_conexion.php");
    require_once("../../model/modelo_rol.php");
    $rol = new Modelo_Rol();
    $datos = $rol->validar_menu_x_rol($_SESSION['S_ROL'],9);// EL 9 ES MENU prod
    //var_dump($datos);
     if (isset($_SESSION['S_IDUSUARIO']))  {
  
        if(is_array($datos) and count($datos)>0){
?>
    <script src="../js/producto.js?rev=<?php echo time(); ?>"></script>
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">


            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <div class="col-lg-12">
        <div class="card ">
            <div class="card-header">
                <h3 class="card-title"><b>Listado de Productos</b></h3>
                <button class="btn btn-info btn-sm float-right" id="btn_nuevo_producto" ><i class="fas fa-plus"></i> Nuevo</button>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12 table-responsive">
                        <table id="tabla_producto" class="display compact" style="width: 100%">
                            <thead style="background:#343A40; color:white" class="small text left">
                                <tr>
                                    <th>#</th>
                                    <th style="width: 8%">C. Barra</th>
                                    <th>Descripcion</th>
                                    <th>Marca</th>
                                    <th>Unidad</th>
                                    <th>Stock</th>
                                    <th>Precio C.</th>
                                    <th>Precio V.</th>
                                    <th>Foto</th>
                                     <th>Almacen</th>
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
    <div class="modal fade" id="modal_registro_producto" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header" style="background:#343A40; color:white">
                    <h5 class="modal-title" id="exampleModalLabel">Registro de Productos</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">

                        <div class="col-12 ">
                            <label for="text_num_compro">Nombre</label>
                            <input type="text" name="text_producto" class="form-control form-control-sm" id="text_producto"  onkeyup="mayus(this);" placeholder="Nombre de producto">
                        </div>
                        <div class="col-12 " hidden>
                            <label for="">Descripcion</label>
                            <input type="text" name="text_descrip_p" class="form-control form-control-sm" id="text_descrip_p"  onkeyup="mayus(this);" placeholder="Descripcion">
                        </div>
                        <div class="col-lg-6 col-sm-6 ">
                            <label for="">Codigo General</label>
                            <input type="text" name="text_codigo_g" class="form-control form-control-sm" id="text_codigo_g" placeholder="Codigo General">
                        </div>
                        <div class="col-lg-6 col-sm-6">

                            <label for="id_label_single">Proveedor</label>
                            <select class="form-control form-control-sm js-example-basic-single " id="select_proveedor" > </select>
                        </div>

                        <div class="col-lg-6 col-sm-6">

                            <label form="">Marca</label>
                            <select class="form-control form-control-sm js-example-basic-single" id="select_marca" style="width: 100%"> </select>
                        </div>

                        <div class="col-lg-6 col-sm-6">

                            <label form="">Categoria</label>
                            <select class="form-control form-control-sm js-example-basic-single" id="select_categoria" style="width: 100%"> </select>
                        </div>

                        <div class="col-6 ">
                            <label for="">Stock</label>
                            <input type="number" name="text_stock" class="form-control form-control-sm" id="text_stock" placeholder="Stock">
                        </div>
                        <div class="col-lg-6 col-sm-6">

                            <label form="">Unidad M</label>
                            <select class="form-control form-control-sm js-example-basic-single" id="select_unidadm" style="width: 100%"> </select>
                        </div>

                        <div class="col-6 col-sm-6 ">
                            <label for="">Precio C.</label>
                            <input type="number" name="text_pcompra" class="form-control form-control-sm" id="text_pcompra" placeholder="Precio Compra">
                        </div>

                        <div class="col-6 col-sm-6 ">
                            <label for="">Precio V.</label>
                            <input type="number" name="text_pventa" class="form-control form-control-sm" id="text_pventa" placeholder="Precio Venta">
                        </div>
                        <div class="col-6 col-sm-6 ">
                            <label for="">Precio Comercial</label>
                            <input type="number" name="text_pcomercial" class="form-control form-control-sm" id="text_pcomercial" placeholder="Precio comercial">
                        </div>
                        <div class="col-6 col-sm-6 ">
                            <label for="">Precio Mayorista</label>
                            <input type="number" name="text_pmayor" class="form-control form-control-sm" id="text_pmayor" placeholder="Precio mayorista">
                        </div>

                        <!-- <div class="col-lg-6 col-sm-6">
                            <label form="">Sucursal</label>
                            <select class="form-control form-control-sm js-example-basic-single" id="select_sucur" style="width: 100%">
                            </select>
                        </div> -->
                         <div class="col-lg-6 col-sm-6">
                            <label form="">Imei/serie</label>
                            <select class="form-control form-control-sm js-example-basic-single" id="select_habi_imei" style="width: 100%">
                                <option value="Seleccione">Seleccione</option>
                                <option value="Si">Si</option>
                                <option value="No">No</option>
                            </select>
                        </div>
                        <div class="col-lg-6 col-sm-6" hidden>
                            <label for="checkbox_discount">Ver en tienda</label>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="chk_ver">
                                <label class="form-check-label" for="checkbox_discount">
                                    Ver
                                </label>
                            </div>
                        </div>


                        <div class="col-12">
                            <label for="">Foto</label></br>
                            <input type="file" id="text_foto">
                        </div>




                    </div>
                    <br>

                    <div class="row" id="ocul_imei" hidden>
                        <div class="col-6">
                            <label form="">Imei/serie:</label>
                            <input type="text" name="" class="form-control form-control-sm" id="text_imei"  placeholder="Imei">
                            <div id="mensaje_imei_invalido" class="invalid-feedback">
                            El IMEI debe tener exactamente 15 dígitos numéricos.
                            </div>
                        </div>

                        <div class="col-1">
                            <label form="">&nbsp;</label><br>
                            <button class="btn btn-success btn-sm" id="btn_agregarImei"><i class="fas fa-plus"></i></button>
                        </div>
                         <div class="col-lg-4 col-sm-4" id="ocul_serie"  >
                            <label for="checkbox_discount">Serie</label>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="chk_serie">
                                <label class="form-check-label" for="checkbox_discount">
                                    Serie
                                </label>
                            </div>
                        </div>

                        <div class="col-12 table-responsive"><br>
                            <table id="tabla_det_pro" class="display" style="width: 100%">
                                <thead style="background: #4f5962;color: #ffffff;">
                                    <tr>


                                        <th>Imei/serie</th>


                                        <th style="text-align: center;">Accion</th>
                                    </tr>
                                </thead>
                                <tbody id="tbody_tabla_det_pro">

                                </tbody>
                            </table>
                            <br>

                        </div>




                    </div>


                    <!-- <br> -->
                    <!-- <hr> -->
                    <!-- <h5 style="text-align:center;">Subir datos desde excel</h5> -->
                    <!-- <br> -->
                    <div class="row" hidden>

                        <div class="col-12  ">

                            <input type="file" id="text_archivo" class="form-control-sm"> <br>
                            <br>
                        </div>



                        <div class="col-12  ">

                            <button type="button" onclick="cargar_excel();" class="btn btn-success btn-sm">Importar</button>
                        </div>

                        <div class="col-12">
                            <a href="../EXCEL/plantilla.xlsx">Descargar Plantilla</a>
                        </div>
                    </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" id="btnRegistrarPro">Registrar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- fin Modal -->

    <!-- Modal Editar  -->
    <div class="modal fade" id="modal_editar_producto" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header" style="background:#343A40; color:white">
                    <h5 class="modal-title" id="exampleModalLabel">Actualizar Producto </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-9 ">
                            <input type="text" id="idproducto" hidden>
                            <label for="text_num_compro">Nombre</label>
                            <input type="text" name="text_producto_editar" class="form-control form-control-sm" id="text_producto_editar" placeholder="Nombre de producto">
                        </div>
                        <div class="col-3 ">

                            <label for="text_num_compro">Codigo I.</label>
                            <input type="text" name="text_codigo_editar" class="form-control form-control-sm" id="text_codigo_editar" placeholder="Codigo" disabled>
                        </div>
                        <div class="col-12 " hidden>
                            <label for="">Descripcion</label>
                            <input type="text" name="text_descrip_p_editar" class="form-control form-control-sm" id="text_descrip_p_editar"  onkeyup="mayus(this);" placeholder="Descripcion">
                        </div>
                        <div class="col-lg-6 col-sm-6">

                            <label for="text_num_compro">Codigo General</label>
                            <input type="text" name="text_codigo_g_editar" class="form-control form-control-sm" id="text_codigo_g_editar" placeholder="Codigo">
                        </div>
                        <div class="col-lg-6 col-sm-6">

                            <label for="">Proveedor</label>
                            <select class="form-control form-control-sm js-example-basic-single" id="select_proveedor_editarr" style="width: 100%"> </select>
                        </div>

                        <div class="col-lg-6 col-sm-6">

                            <label form="">Marca</label>
                            <select class="form-control form-control-sm js-example-basic-single" id="select_marca_editar" style="width: 100%"> </select>
                        </div>

                        <div class="col-lg-6 col-sm-6">

                            <label form="">Categoria</label>
                            <select class="form-control form-control-sm js-example-basic-single" id="select_categoria_editar" style="width: 100%"> </select>
                        </div>
                        <div class="col-6 ">
                            <label for="text_num_compro">Stock</label>
                            <input type="number" name="text_stock_editar" class="form-control form-control-sm" id="text_stock_editar" placeholder="Stock" disabled>
                        </div>
                        <div class="col-lg-6 col-sm-6">

                            <label form="">Unidad M</label>
                            <select class="form-control form-control-sm js-example-basic-single" id="select_unidadm_editar" style="width: 100%"> </select>
                        </div>

                        <div class="col-6 col-sm-6 ">
                            <label for="text_num_compro">Precio C.</label>
                            <input type="number" name="text_pcompra_editar" class="form-control form-control-sm" id="text_pcompra_editar" placeholder="Precio Compra">
                        </div>

                        <div class="col-6 col-sm-6 ">
                            <label for="text_num_compro">Precio V.</label>
                            <input type="number" name="text_pventa_editar" class="form-control form-control-sm" id="text_pventa_editar" placeholder="Precio Venta">
                        </div>
                         <div class="col-6 col-sm-6 ">
                            <label for="">Precio Comercial</label>
                            <input type="number" name="text_pcomercial_editar" class="form-control form-control-sm" id="text_pcomercial_editar" placeholder="Precio comercial">
                        </div>
                        <div class="col-6 col-sm-6 ">
                            <label for="">Precio Mayorista</label>
                            <input type="number" name="text_pmayor_editar" class="form-control form-control-sm" id="text_pmayor_editar" placeholder="Precio mayorista">
                        </div>

                         <!-- <div class="col-lg-6 col-sm-6">
                            <label form="">Sucursal</label>
                            <select class="form-control form-control-sm js-example-basic-single" id="select_sucur_editar" style="width: 100%">
                            </select>
                        </div> -->


                        <div class="col-6 ">

                            <label form="">Estado</label>
                            <select class="form-control form-control-sm js-example-basic-single" id="select_estado_producto_editar" style="width: 100%">
                                <option value="ACTIVO">ACTIVO</option>
                                <!--iniciar el select 2 en el script -->
                                <option value="INACTIVO">INACTIVO</option>
                            </select>
                        </div>

                        <div class="col-lg-6 col-sm-6" hidden>
                            <label for="checkbox_discount">Ver en tienda</label>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="chk_ver_editar">
                                <label class="form-check-label" for="checkbox_discount">
                                    Ver
                                </label>
                            </div>
                        </div>

                      

                    </div>
                    <div class="row" id="traer_imei_editar" hidden>
                        <div class="col-12 table-responsive"><br>
                            <table id="tabla_det_pro_edit" class="display" style="width: 100%">
                                <thead style="background: #4f5962;color: #ffffff;">
                                    <tr>


                                        <th>Imei/serie</th>
                                        <!-- <th>Vendido</th>-->
                                       <th style="text-align: center;">Accion</th> 
                                    </tr>
                                </thead>
                                <tbody id="tbody_tabla_det_pro_edit">

                                </tbody>
                            </table>
                            <br>

                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" onclick="ModificarProducto();">Modificar</button>
                </div>
            </div>
        </div>
    </div>
    <!-- fin Modal -->


    <!-- Modal AUMENTAR STOCK  -->
    <div class="modal fade" id="modal_aumentar_stock" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header" style="background:#343A40; color:white">
                    <h5 class="modal-title" id="exampleModalLabel">Aumentar Stock Producto</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="input-group input-group-sm mb-3 col-10">
                            <div class="input-group-prepend">
                                <input type="text" id="idproducto_aumentar" hidden>
                                <input type="text" id="idalmacen_aumentar" hidden >
                                <span class="input-group-text">Nombre </span>
                            </div>
                            <input type="text" id="text_producto_editar_2" class="form-control form-control-sm" placeholder="Nombre de producto" disabled>
                        </div>
                        <div class="input-group input-group-sm mb-3 col-2">
                            <div class="input-group-prepend">

                            </div>
                            <input type="text" id="text_codigo_editar_2" class="form-control form-control-sm" placeholder="Codigo" disabled>
                        </div>
                        <div class="input-group input-group-sm mb-3 col-6">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Stock</span>
                            </div>
                            <input type="text" id="text_stock_editar_2" class="form-control form-control-sm" oninput="calcular();" placeholder="Stock" disabled>
                        </div>
                        <div class="input-group input-group-sm mb-3 col-4">
                            <div class="input-group-prepend">
                                <span class="input-group-text">+</span>
                            </div>
                            <input type="number" id="text_stock_aumentar" class="form-control form-control-sm" oninput="calcular();" placeholder="Aumentar" onkeypress="return soloNumeros(event)">
                        </div>
                        <div class="input-group input-group-sm mb-3 col-2">
                            <div class="input-group-prepend">

                            </div>
                            <input type="text" id="text_stock_suma" class="form-control form-control-sm" oninput="calcular();" placeholder="Total" disabled>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" onclick="SumarStock();">Modificar</button>
                </div>
            </div>
        </div>
    </div>
    <!-- fin Modal -->

    <!-- Modal AUMENTAR STOCK POR IMEI -->
    <div class="modal fade" id="modal_aumentar_stock_imei" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header" style="background:#343A40; color:white">
                    <h5 class="modal-title" id="exampleModalLabel">Aumentar Stock Producto por Imei</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-8 col-sm-8">

                            <label for="text_num_compro">Nombre</label>
                            <input type="text" id="idproducto_imei" hidden>
                            <input type="text" id="idalmacen_aumentar_imei" hidden >
                            <input type="text" id="idsucu_imei" hidden >
                            <input type="text" name="text_producto_editar_imei" class="form-control form-control-sm" id="text_producto_editar_imei" placeholder="Nombre de producto" disabled>
                        </div>

                        <div class="col-lg-4 col-sm-4">

                            <label for="text_num_compro">Stock</label>

                            <input type="text" name="text_stock_editar_imei" class="form-control form-control-sm" id="text_stock_editar_imei" placeholder="Stock" disabled>
                        </div>

                    </div>

                    <div class="row" id="">
                        <div class="col-6">
                            <label form="">Imei/serie:</label>
                            <input type="text" name="" class="form-control form-control-sm" id="text_imei_aumentar"  placeholder="Imei">
                            <div id="mensaje_imei_invalido_aumentar" class="invalid-feedback">
                                El IMEI debe tener exactamente 15 dígitos numéricos.
                                </div>
                        </div>

                        <div class="col-1">
                            <label form="">&nbsp;</label><br>
                            <button class="btn btn-success btn-sm" id="btn_agregarImei_aumentar"><i class="fas fa-plus"></i></button>
                        </div>
                        <div class="col-12 table-responsive"><br>
                            <table id="tabla_det_pro_aumentar" class="display" style="width: 100%">
                                <thead style="background: #4f5962;color: #ffffff;">
                                    <tr>

                                         <th>#</th>
                                        <th>Imei/serie</th>
                                        <!-- <th>Vendido</th>
                                       <th style="text-align: center;">Accion</th> -->
                                    </tr>
                                </thead>
                                <tbody id="tbody_tabla_det_pro_aumentar">

                                </tbody>
                            </table>
                            <br>

                        </div>

                    </div>



                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <!-- <button type="button" class="btn btn-primary" onclick="">Modificar</button> -->
                </div>
            </div>
        </div>
    </div>
    <!-- fin Modal -->

    <!-- Modal DISMINUIR STOCK  -->
    <div class="modal fade" id="modal_disminuir_stock" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header" style="background:#343A40; color:white">
                    <h5 class="modal-title" id="exampleModalLabel">Salida directa</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="input-group input-group-sm mb-3 col-10">
                            <div class="input-group-prepend">
                                <input type="text" id="idproducto_dis" hidden>
                                 <input type="text" id="idalmacen_dis" hidden>
                                <span class="input-group-text">Nombre </span>
                            </div>
                            <input type="text" id="text_producto_editar_2_dis" class="form-control form-control-sm" placeholder="Nombre de producto" disabled>
                        </div>
                        <div class="input-group input-group-sm mb-3 col-2">
                            <div class="input-group-prepend">

                            </div>
                            <input type="text" id="text_codigo_editar_2_dis" class="form-control form-control-sm" placeholder="Codigo" disabled>
                        </div>
                        <div class="input-group input-group-sm mb-3 col-6">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Stock</span>
                            </div>
                            <input type="text" id="text_stock_editar_2_dis" class="form-control form-control-sm" oninput="calcularResta();" placeholder="Stock" disabled>
                        </div>
                        <div class="input-group input-group-sm mb-3 col-4">
                            <div class="input-group-prepend">
                                <span class="input-group-text">+</span>
                            </div>
                            <input type="number" id="text_stock_disminuir_dis" class="form-control form-control-sm" oninput="calcularResta();" placeholder="Disminuir" onkeypress="return soloNumeros(event)">
                        </div>
                        <div class="input-group input-group-sm mb-3 col-2">
                            <div class="input-group-prepend">

                            </div>
                            <input type="text" id="text_stock_resta" class="form-control form-control-sm" oninput="calcularResta();" placeholder="Total" disabled>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" onclick="DisminuirStock();">Modificar</button>
                </div>
            </div>
        </div>
    </div>
    <!-- fin Modal -->

    <!-- Modal DISMINUIR STOCK POR IMEI -->
    <div class="modal fade" id="modal_disminuir_stock_imei" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header" style="background:#343A40; color:white">
                    <h5 class="modal-title" id="exampleModalLabel">Disminuir Stock Producto por Imei</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-8 col-sm-8">

                            <label for="text_num_compro">Nombre</label>
                            <input type="text" id="idproducto_imei_dis" hidden>
                             <input type="text" id="idalmacen_imei_dis" hidden>
                              <input type="text" id="idsucu_imei_dis" hidden>
                            <input type="text" name="" class="form-control form-control-sm" id="text_producto_dismin_imei" placeholder="Nombre de producto" disabled>
                        </div>

                        <div class="col-lg-4 col-sm-4">

                            <label for="text_num_compro">Stock</label>

                            <input type="text" name="" class="form-control form-control-sm" id="text_stock_dismin_imei" placeholder="Stock" disabled>
                        </div>

                    </div>

                    <div class="row" id="">

                        <div class="col-12 table-responsive"><br>
                            <table id="tabla_det_pro_disminuir" class="display" style="width: 100%">
                                <thead style="background: #4f5962;color: #ffffff;">
                                    <tr>


                                        <th>#</th>
                                        <th>Imei</th>
                                        <!-- <th>Vendido</th>-->
                                        <th style="text-align: center;">Accion</th>
                                    </tr>
                                </thead>
                                <tbody id="tbody_tabla_det_pro_disminuir">

                                </tbody>
                            </table>
                            <br>

                        </div>

                    </div>



                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <!-- <button type="button" class="btn btn-primary" onclick="">Modificar</button> -->
                </div>
            </div>
        </div>
    </div>
    <!-- fin Modal -->


    <!-- Modal Editar FOTO -->
    <div class="modal fade" id="modal_editar_foto" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header" style="background:#343A40; color:white">
                    <h5 class="modal-title" id="exampleModalLabel">Cambiar Foto del producto: <label for="" id="lbl_producto"></label></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="row">

                        <div class="col-12">
                            <input type="text" id="idproducto_foto" hidden="">
                            <input type="text" id="fotoactual" hidden="">
                            <input type="text" id="cod_barra" hidden="">
                            <input type="file" id="text_foto_editar">
                        </div>

                    </div>
                    <br>

                    <div class="row">

                        <div class="col-12">
                            <div class="form-group">
                                <label for="">Foto Actual</label>
                                <div class="card">
                                    <div class="card-body">


                                    </div>

                                    <img class="" id="img-preview">

                                </div>

                            </div>

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" onclick="ModificarFotoEmpresa();">Modificar</button>
                </div>
            </div>
        </div>
    </div>
    <!-- fin Modal -->

    <script>
        //para el diseño del combo
        $(document).ready(function() {
//$('.js-example-basic-single').select2();
// Proveedor
   


           
                 $('#modal_registro_producto').on('shown.bs.modal', function() {
                     inicializarSelects('#modal_registro_producto'); 
                });

                $('#modal_editar_producto').on('shown.bs.modal', function () {
                    inicializarSelects('#modal_editar_producto');
                });


           
             Listar_Producto();
              configurarValidacionImei();
              configurarValidacionImei_aumentar();

        });
        //  rolA = document.getElementById('text_idrol').value; //CAPTURAMOS EL ROL PARA DAR EL ACCESO
        //  console.log(rolA);

        //SELECT DINAMICO PARA P
function cargar_Select_Ajax(selector, url, textoCampo, valorCampo) {
    $.ajax({
        url: url,
        type: 'POST'
    }).done(function (resp) {
        let data = JSON.parse(resp);
        let llenardata = "<option value=''>Seleccione</option>";

        if (data.length > 0) {
            for (let i = 0; i < data.length; i++) {
                llenardata += `<option value="${data[i][valorCampo]}">${data[i][textoCampo]}</option>`;
            }
        } else {
            llenardata += "<option value=''>No se encontraron datos</option>";
        }

        let select = $(selector);
        select.html(llenardata);

        if (select.hasClass("select2-hidden-accessible")) {
            select.select2('destroy');
        }

        let modalParent = select.closest('.modal');
        let optionsSelect2 = { width: '100%' };
        if (modalParent.length) {
            optionsSelect2.dropdownParent = modalParent;
        }

        select.select2(optionsSelect2);
    });
}

function inicializarSelects(modalId) {
    let selectsConfig = [
        { id: '#select_categoria', url: '../controller/producto/controlador_cargar_select_categoria.php', texto: 1, valor: 0 },
        { id: '#select_categoria_editar', url: '../controller/producto/controlador_cargar_select_categoria.php', texto: 1, valor: 0 },

        { id: '#select_marca', url: '../controller/producto/controlador_cargar_select_marca.php', texto: 1, valor: 0 },
        { id: '#select_marca_editar', url: '../controller/producto/controlador_cargar_select_marca.php', texto: 1, valor: 0 },

        { id: '#select_proveedor', url: '../controller/cotizacion/controlador_cargar_select_proveedor.php', texto: 2, valor: 0 },
        { id: '#select_proveedor_editarr', url: '../controller/cotizacion/controlador_cargar_select_proveedor.php', texto: 2, valor: 0 },

        { id: '#select_unidadm', url: '../controller/producto/controlador_cargar_select_unidadm.php', texto: 1, valor: 0 },
        { id: '#select_unidadm_editar', url: '../controller/producto/controlador_cargar_select_unidadm.php', texto: 1, valor: 0 }
    ];

    selectsConfig.forEach(cfg => {
        if ($(modalId).find(cfg.id).length) {
            cargar_Select_Ajax(cfg.id, cfg.url, cfg.texto, cfg.valor);
        }
    });
}

       
        
       // cargar_SelectSucursales();

       // aumentar imei
       function configurarValidacionImei_aumentar() {
            const inputImei = document.getElementById('text_imei_aumentar');
            const mensajeError = document.getElementById('mensaje_imei_invalido_aumentar');
            const btnAgregar = document.getElementById('btn_agregarImei_aumentar'); 

            function validarInput_au() {
                // Permitir solo números y limitar a 15 caracteres
                inputImei.setAttribute('maxlength', 15);
                inputImei.value = inputImei.value.replace(/[^0-9]/g, '').slice(0, 15);

               //  inputImei.value = inputImei.value.replace(/[^a-zA-Z0-9]/g, ''); //para letras y numeros

                // Validar longitud exacta
                if (inputImei.value.length === 15) {
                    inputImei.classList.remove('is-invalid');
                    inputImei.classList.add('is-valid');
                    mensajeError.style.display = 'none'; // Ocultar mensaje
                } else {
                    inputImei.classList.remove('is-valid');
                    inputImei.classList.add('is-invalid');
                    mensajeError.style.display = 'block'; // Mostrar mensaje
                }

           

                // 👉 Deshabilitar o habilitar el botón
                btnAgregar.disabled = inputImei.value.length !== 15;
            }

            inputImei.addEventListener('input', validarInput_au);
        }




        //al ingresar imei - registrar prod
      function configurarValidacionImei() {
        const chkSerie = document.getElementById('chk_serie');
        const inputImei = document.getElementById('text_imei');
        const mensajeError = document.getElementById('mensaje_imei_invalido');
        const btnAgregar = document.getElementById('btn_agregarImei');

        function validarInput() {
            if (chkSerie.checked) {
                // Modo serie personalizada: letras y números permitidos
                $('#ocul_imei').prop('hidden', false);
                inputImei.removeAttribute('maxlength');
                inputImei.value = inputImei.value.replace(/[^a-zA-Z0-9]/g, '');
                inputImei.classList.remove('is-invalid', 'is-valid');
                mensajeError.style.display = 'none';
                btnAgregar.disabled = false; // permitir agregar si es serie personalizada
            } else {
                // Solo números, máximo 15 dígitos
                inputImei.setAttribute('maxlength', 15);
                inputImei.value = inputImei.value.replace(/[^0-9]/g, '').slice(0, 15);

                if (inputImei.value.length === 15) {
                    inputImei.classList.remove('is-invalid');
                    inputImei.classList.add('is-valid');
                    mensajeError.style.display = 'none';
                } else {
                    inputImei.classList.remove('is-valid');
                    inputImei.classList.add('is-invalid');
                    mensajeError.style.display = 'block';
                }

                // 👉 Deshabilitar o habilitar el botón
                btnAgregar.disabled = inputImei.value.length !== 15;
            }
        }

        inputImei.addEventListener('input', validarInput);
        chkSerie.addEventListener('change', validarInput);
    }



        //ENVIAMOS DATOS DE PRODUCTOS A CAJAS DE TEXTO DEL PRODUCTO
        $('#select_habi_imei').on('select2:select', function(e) {
            let habil_table = document.getElementById('select_habi_imei').value;
          //  let aceptaserie = document.getElementById('chk_serie').checked ? "Si" : "No";

            if (habil_table == "Si") {
                $('#ocul_imei').prop('hidden', false);
                document.getElementById('text_stock').value = "";
                var inpStock = document.getElementById("text_stock");
                inpStock.disabled = true;

            } else if (habil_table == "No") {
                $('#ocul_imei').prop('hidden', true);
                limpiarTabla_regimei();
                //document.getElementById('text_stock').value = "";
                var inpStock = document.getElementById("text_stock");
                inpStock.disabled = false;

            } else {
                $('#ocul_imei').prop('hidden', true);
                limpiarTabla_regimei();

            }


        })

        // if (data.producto_tienda == "Si") {
		// 	document.getElementById('chk_ver_editar').checked = true;
		// } else {
		// 	document.getElementById('chk_ver_editar').checked = false;
		// }



        /*===================================================================*/
        //PARA MAYUSCULAS
        /*===================================================================*/
        function mayus(e) {
            e.value = e.value.toUpperCase();
        }



        //validar que solo seleccione un archivo excel 
        document.getElementById("text_archivo").addEventListener("change", () => {
            var fileName = document.getElementById("text_archivo").value;
            var idxDot = fileName.lastIndexOf(".") + 1;
            var extFile = fileName.substr(idxDot, fileName.length).
            toLowerCase();
            if (extFile == "xlsm" || extFile == "xls" || extFile == "xlsx") {
                //TO DO 
            } else {
                Swal.fire("MENSAJE DE ADVERTENCIA",
                    "SOLO SE ACEPTAN ARCHIVOS EXCEL - USTED SUBIO UN ARCHIVO CON EXTESION " + extFile, "warning");
                document.getElementById("text_archivo").value = "";
            }
        });


        //validar que solo seleccione foto (Registrar foto)
        document.getElementById("text_foto").addEventListener("change", () => {
            var fileName = document.getElementById("text_foto").value;
            var idxDot = fileName.lastIndexOf(".") + 1;
            var extFile = fileName.substr(idxDot, fileName.length).
            toLowerCase();
            if (extFile == "jpg" || extFile == "jpeg" || extFile == "png") {
                //TO DO 
            } else {
                Swal.fire("MENSAJE DE ADVERTENCIA", "SOLO SE ACEPTAN IMAGENES - USTED SUBIO UN ARCHIVO CON EXTESION " +
                    extFile, "warning");
                document.getElementById("text_foto").value = "";
            }
        });

        /**************************************************
          IMPORTAR DESDE EXCEL
        ****************************************************/
        function cargar_excel() {
            let archivo = document.getElementById("text_archivo").value;
            if (archivo.length == 0) {
                return Swal.fire("Mensaje de Advertencia", "Selecciones un Archivo", "warning");
            }

            let formData = new FormData();
            let excel = $("#text_archivo")[0].files[0];
            formData.append('excel', excel);
            $.ajax({
                url: '../EXCEL/excel_import.php',
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function(resp) {
                    Swal.fire("Mensaje de Confirmacion", "Importacion de Productos Exitosa", "success")
                    document.getElementById('text_archivo').value = "";


                }

            });
            return false;

        }

        $("#btnRegistrarPro").on('click', function() {
            RegistrarProducto();
        })

        $("#btn_agregarImei").on('click', function() {
           // Agregar_Imei()
           validaImei();
        })

        $("#btn_agregarImei_aumentar").on('click', function() {
            validaImei_reingreso();
        });

         $("#btn_nuevo_producto").on('click', function() {
            AbrirModalRegistroProducto();
        });


         
    </script>



<?php
    }else{
        header("Location:".conexionBD::ruta()."view/404/mant_error.php");
    }
    }else{
        header("Location:".conexionBD::ruta()."view/404/mant_error.php");
    }
?>