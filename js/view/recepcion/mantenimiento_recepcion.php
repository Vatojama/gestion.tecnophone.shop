<?php
session_start();
require_once("../../model/modelo_conexion.php");
require_once("../../model/modelo_rol.php");
$rol = new Modelo_Rol();
$datos = $rol->validar_menu_x_rol($_SESSION['S_ROL'], 1); // EL 4 ES MENU RECEPCION
//date_default_timezone_set('America/Lima');
//var_dump($datos);
if (isset($_SESSION['S_IDUSUARIO'])) {

  if (is_array($datos) and count($datos) > 0) {
?>
    <script src="../js/recepcion.js?rev=<?php echo time(); ?>"></script>
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">


        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

    <div class="col-lg-12">
      <div class="card ">
        <div class="card-header">
          <h3 class="card-title"><b>Listado de Recepciones</b></h3><label for="" id="text_estado" hidden></label>
          <button class=" btn btn-info btn-sm float-right" id="textnuevarecepcion" onclick="AbrirModalRegistroRecepcion();"><i class="fas fa-plus"></i> Nuevo</button>
        </div>
        <div class="card-body">

          <div class="row">

            <div class="col-5">
              <label for="">Fecha Inicio</label>
              <input type="date" name="" id="text_finicio" class="form-control  form-control-sm">
            </div>
            <div class="col-5">
              <label for="">Fecha Fin</label>
              <input type="date" name="" id="text_ffin" class="form-control  form-control-sm">
            </div>
            <div class="col-2">
              <label for="">&nbsp;</label><br>
              <button class="btn btn-info btn-sm" onclick="Listar_Recepcion()"><i class="fas fa-search"></i></button>

            </div>

          </div><br>
          <div class="row">

            <div class="col-12 table-responsive">
              <table id="tabla_recepcion" class="display compact">
                <thead style="background:#343A40; color:white" class="small text left">
                  <tr>
                    <!-- <th>#</th> -->
                    <th>Rece</th>
                    <th>Pedido</th>
                    <th>Cliente</th>
                    <th>Observacion</th>
                    <th>Motivo</th>
                    <th>Monto</th>
                    <th>Adelanto</th>
                    <th>Debe</th>
                    <th>Fecha</th>
                    <th>Entrega</th>
                    <th>Sucursal</th>
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
    <div class="modal fade" id="modal_registro_recepcion" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header" style="background:#343A40; color:white">
            <h5 class="modal-title" id="exampleModalLabel">Recepcion de Equipos</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="row">


              <div class="col-lg-6   col-10">
                <label>Cliente:</label>
                 <span class="text-danger" id="alerta_listanegra" style="display:none;">Cliente en lista Negra, revisar</span>
                <select class="form-control form-control-sm js-example-basic-single" id="select_cliente" style="width:100%"> </select>
              </div>
              <div class="  col-lg-1 col-2">
                <label for="">&nbsp;</label><br>
                <button class="btn btn-success btn-sm " onclick="AbrirModalRegistroCliente();"><i class="fas fa-plus"></i></button>
              </div>

              <div class="col-lg-5 col-6">
                <label>Motivo:</label>
                <select class="form-control form-control-sm js-example-basic-single" id="select_motivo" style="width: 100%"> </select>
              </div>

              <div class="col-lg-7 col-6">
                <label>F. Entrega:</label>
                <input type="date" id="text_fentrega" class="form-control form-control-sm" placeholder="Accesorios">
              </div>

              <div class="col-lg-5 col-6">
                <label>Nro. Pedido:</label>
                <input type="text" id="text_codigo_r" class="form-control form-control-sm" placeholder="Nro. Pedido">
              </div>

              <div class="col-lg-8 col-12">
                <label>Observacion:</label>
                <input type="text" id="text_accesorios" class="form-control form-control-sm" onkeyup="mayus(this);" placeholder="Observacion">
              </div>
              <div class="col-lg-4 col-12">
                <label>Tecnico:</label>
                <select class="form-control form-control-sm js-example-basic-single" id="select_tecnic" style="width: 100%"> </select>
              </div>



              <div class="col-lg-4 col-4">
                <label>Monto reparacion:</label>
                <input type="number" id="text_monto" class="form-control form-control-sm" oninput="calcular();" placeholder="Monto" value="0" disabled>
              </div>

              <div class="col-lg-1" style="text-align: right;" hidden>
                <label for="">&nbsp;</label><br>
                <input type="checkbox" id="chkadelanto">
              </div>
              <div class="col-lg-4 col-4">
                <label>Adelanto:</label>
                <input type="text" id="text_adelanto" class="form-control form-control-sm" placeholder="0" disabled>
              </div>
              <div class="col-lg-4 col-4">
                <label>Pendiente:</label>
                <input type="text" id="text_debe" class="form-control form-control-sm" oninput="calcular();" value="0" placeholder="0" disabled>
              </div>
               <div class="col-lg-6   col-10">
                <label>Sucursal:</label>
                <select class="form-control form-control-sm js-example-basic-single" id="select_sucursal_r" style="width:100%"> </select>
              </div>
             

            </div>
            <br>
            <br>
            <br>
            <div class="row" id="ocul_imei">
              <div class="col-12">
                <div class="card-header p-0 pt-1 border-bottom-0">
                  <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
                    <li class="nav-item">
                      <a class="nav-link active small text" id="equipos-tab" data-toggle="pill" href="#equipos" role="tab" aria-controls="equipos" aria-selected="true">Equipos Recepcionados</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link small text" id="insumos-tab" data-toggle="pill" href="#insumos" role="tab" aria-controls="insumos" aria-selected="false">Insumos</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link small text" id="fotos-tab" data-toggle="pill" href="#fotos" role="tab" aria-controls="fotos" aria-selected="false">Fotos</a>
                    </li>
                  </ul>
                </div>
                <div class="card-body">
                  <div class="tab-content" id="custom-tabs-three-tabContent">
                    <div class="tab-pane fade active show" id="equipos" role="tabpanel" aria-labelledby="equipos-tab">
                      <!-- <div class="col-12">   -->
                      <div class="row">

                        <div class="col-lg-3 col-6">
                          <label form="">Equipo:</label>
                          <input type="text" name="" class="form-control form-control-sm" id="text_equi2" onkeyup="mayus(this);" placeholder="Equipo">
                        </div>
                        <div class="col-lg-3 col-6">
                          <label form="">Serie/Imei:</label>
                          <input type="text" class="form-control form-control-sm" id="text_serie2" placeholder="Serie">
                        </div>
                        <div class="col-lg-3 col-6">
                          <label form="">Monto:</label>
                          <input type="text" name="" class="form-control form-control-sm" id="text_monto2" placeholder="Monto">
                        </div>
                        <div class="col-lg-3 col-6">
                          <label form="">Abono:</label>
                          <input type="text" name="" class="form-control form-control-sm" id="text_pendite2" value="0" placeholder="Abono">
                        </div>

                        <div class="col-lg-11 col-12">
                          <label>Falla:</label>
                          <input type="text" id="text_concepto" class="form-control form-control-sm" onkeyup="mayus(this);" placeholder="Falla del equipo">
                        </div>

                        <!-- <div class="col-lg-3 col-8 ">
                                            <label>Marca:</label>
                                            <select class="form-control form-control-sm js-example-basic-single" id="select_marca"
                                                style="width: 100%"> </select>
                                        </div> -->
                        <div class="col-1">
                          <label form="">&nbsp;</label><br>
                          <button class="btn btn-success btn-sm" id="btn_agregarImei"><i class="fas fa-plus"></i></button>
                        </div>

                        <div class="col-12 table-responsive"><br>
                          <table id="tabla_det_pro" class="display" style="width: 100%">
                            <thead style="background: #4f5962;color: #ffffff;" class="small text left">
                              <tr>


                                <th>Equipo</th>
                                <th>Serie</th>
                                <th>Falla</th>

                                <th>Monto</th>
                                <th>Adelanto</th>

                                <th style="text-align: center;">Accion</th>
                              </tr>
                            </thead>
                            <tbody id="tbody_tabla_det_pro" class="small text left">

                            </tbody>
                          </table>
                          <!-- <br> -->

                        </div>

                      </div>
                      <!-- </div> -->
                    </div>

                    <div class="tab-pane fade" id="insumos" role="tabpanel" aria-labelledby="insumos-tab">
                      <div class="row">
                        <div class="col-lg-12 col-12">

                          <label for="">Articulo</label>
                          <input type="text" id="idrepara_ins" hidden>
                          <select class="form-control form-control-sm js-example-basic-single" id="select_produc_ins" style="width:100%"> </select>
                        </div>

                        <!-- <div class="col-lg-3 col-4">
                              <label for="">nombre insumo</label>
                              <input type="text" name="" class="form-control form-control-sm" id="text_nomb_insu" placeholder="Stock" disabled>
                            </div> -->

                        <div class="col-lg-3 col-4">
                          <label for="">Stock</label>
                          <input type="text" name="" class="form-control form-control-sm" id="text_stock_insu" placeholder="Stock" disabled>
                        </div>

                        <div class="col-lg-4 col-3">
                          <label for="">Precio</label>
                          <input type="text" name="" class="form-control form-control-sm" id="text_precio_insu" placeholder="Stock" >
                        </div>

                        <!-- <div class="col-lg-4 col-3">
                          <label for="">Precio com</label>
                          <input type="text" name="" class="form-control form-control-sm" id="text_precio_compra_insu" placeholder="Stock" disabled>
                        </div> -->


                        <div class="col-lg-4 col-4">

                          <label for="">Cantidad</label>

                          <input type="number" name="" class="form-control form-control-sm" id="text_cantidad_ins" placeholder="cantidad">
                        </div>
                        <div class="col-lg-1 col-1">
                          <label form="">&nbsp;</label><br>
                          <button class="btn btn-success btn-sm" id="btn_agregar_ins"><i class="fas fa-plus"></i></button>
                        </div>


                      </div>

                      <div class="row" id="">

                        <div class="col-12 table-responsive"><br>
                          <table id="tabla_insumos_recep" class="display" style="width: 100%">
                            <thead style="background: #4f5962;color: #ffffff;" class="small text left">
                              <tr>


                                <th>#</th>
                                <th>Articulo</th>
                                <th>Cant.</th>
                                <th>Monto</th>
                                <th style="text-align: center;">Accion</th>
                              </tr>
                            </thead>
                            <tbody id="tbody_tabla_det_pro_disminuir" class="small text left">

                            </tbody>

                          </table>
                          <br>

                        </div>

                      </div>

                    </div>

                    <div class="tab-pane fade" id="fotos" role="tabpanel" aria-labelledby="fotos-tab">
                      <div class="row">

                        <!-- <div class="col-12">
                            <label for="">Foto</label></br>
                            <input type="file" id="text_foto" > 
                          </div> 
                     <div class="col-12 col-xs-12">
                              <label form="">Usuario: </label>
                            <input type="text" id="text_usuario" class="form-control form-control-sm"  onkeypress="return soloLetras(event)" placeholder="Usuario">
                      </div>-->
                        <!-- LOGO -->
                        <div class="col-md-6">
                          <div class="col-lg-12">
                            <div class="form-group mb-2">

                              <label for="" class=""><span class="small">foto</span></label>
                              <input type="file" class="form-control form-control-sm" id="text_foto" name="text_foto" />
                            </div>
                          </div>

                          <div class="col-md-12">
                            <div class="text-center">
                              <a id="btnremovephoto" class="btn btn-danger btn-sm "><i class="fas fa-trash-alt"></i></a>
                              <div class="profile-user position-relative d-inline-block mx-auto  mb-4">
                                <span id="pre_imagen"></span>
                              </div>
                            </div>
                          </div>
                        </div>

                      </div>

                    </div>
                  </div>
                </div>

              </div>
            </div>
          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            <!-- <button type="button" class="btn btn-primary" onclick="RegistrarRecepcion();">Registrar</button> -->
            <button class="btn btn-info btn-lg  btn-sm" onclick="RegistrarRecepcion();"><i class="fa fa-save"></i> Registrar</button>
          </div>
        </div>
      </div>
    </div>
    <!-- fin Modal -->

    <!-- Modal Editar  -->
    <div class="modal fade" id="modal_editar_recepcion" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header" style="background:#343A40; color:white">
            <h5 class="modal-title" id="exampleModalLabel">Actualizar Recepcion</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="row">

              <div class="col-lg-8   col-8">
                <input type="text" id="idrecepcion" hidden="">
                <label>Cliente:</label>
                <select class="form-control form-control-sm js-example-basic-single" id="select_cliente_editar" style="width:100%"> </select>
              </div>
              <div class="col-lg-4 col-4">
                <label>Movil:</label>
                <input type="text" id="text_movil_editar" class="form-control form-control-sm" placeholder="movil" disabled>
              </div>

              <div class="col-lg-4 col-xs-12" hidden>
                <label>Marca:</label>
                <select class="form-control form-control-sm js-example-basic-single" id="select_marca_editar" style="width: 100%"> </select>
              </div>
              <div class="col-lg-4 col-xs-12" hidden>
                <label>Modelo:</label>
                <input type="text" id="text_caracteristicas_editar" class="form-control form-control-sm" placeholder="Caracteristicas">
              </div>

              <div class="col-lg-4 col-4">
                <label>Nro. Pedido:</label>
                <input type="text" id="text_codigo_r_editar" class="form-control form-control-sm" placeholder="Codigo">
              </div>


              <div class="col-lg-4 col-4">
                <label>Motivo:</label>
                <select class="form-control form-control-sm js-example-basic-single" id="select_motivo_editar" style="width: 100%"> </select>
              </div>
              <div class="col-lg-4 col-4">
                <label>F. Entrega:</label>
                <input type="date" id="text_fentrega_editar" class="form-control form-control-sm" placeholder="Accesorios">
              </div>

              <div class="col-lg-12 col-12" hidden>
                <label>Observacion:</label>
                <input type="text" id="text_accesorios_editar" class="form-control form-control-sm" onkeyup="mayus(this);" placeholder="Observacion">
              </div>
              <div class="col-lg-12 col-12">
                <label>Observacion:</label>
                <input type="text" id="text_concepto_editar" class="form-control form-control-sm" onpaste="return false" placeholder="Falla del equipo">
              </div>



              <div class="col-lg-4 col-4">
                <label>Monto:</label>
                <input type="text" id="text_monto_editar" class="form-control  form-control-sm" oninput="calcularAlEditar();" placeholder="Monto" disabled>
              </div>

              <div class="col-lg-1" style="text-align: right;" hidden>
                <label for="">&nbsp;</label><br>
                <input type="checkbox" id="chkadelanto2">
              </div>
              <div class="col-lg-4 col-4">
                <label>Adelanto:</label>
                <input type="text" id="text_adelanto_editar" class="form-control form-control-sm" oninput="calcularAlEditar();" placeholder="Adelanto" disabled>
              </div>
              <div class="col-lg-4 col-4">
                <label>Pendiente:</label>
                <input type="text" id="text_debe_editar" class="form-control form-control-sm" oninput="calcularAlEditar();" placeholder="Por Pagar" disabled>
              </div>

              <div class="col-lg-4   col-6">

                <label>Estado:</label>
                <select class="form-control form-control-sm js-example-basic-single" id="select_estado_recepcion_editar" style="width: 100%">
                  <option value="ACTIVO">ACTIVO</option>
                  <option value="INACTIVO">INACTIVO</option>
                </select>
              </div>
              <div class="col-lg-4 col-6">
                <label>Tecnico:</label>
                <select class="form-control form-control-sm js-example-basic-single" id="select_tecnic_editar" style="width: 100%"> </select>
              </div>
              <div class="col-lg-4   col-6">
                <label>Recoger:</label>
                <select class="form-control form-control-sm js-example-basic-single" id="select_recoger_recepcion_editar" style="width: 100%">
                  <option value="">Seleccione</option>
                  <option value="EN REPARACION">EN REPARACION</option>
                  <option value="REPARADO">REPARADO</option>
                  <option value="ENTREGADO">ENTREGADO</option>
                  <option value="NO REPARADO">NO REPARADO</option>

                </select>
              </div>
               <div class="col-lg-6   col-10">
                <label>Sucursal:</label>
                <select class="form-control form-control-sm js-example-basic-single" id="select_sucursal_editar" style="width:100%"> </select>
              </div>

            </div>
            <br><br><br>
            <div class="row">
              <div class="col-lg-12">
                <div class="card-header p-0 pt-1 border-bottom-0">
                  <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
                    <li class="nav-item">
                      <a class="nav-link active small text" id="equipos_e-tab" data-toggle="pill" href="#equipos_e" role="tab" aria-controls="equipos_e" aria-selected="true">Equipos Recepcionados</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link small text" id="insumos_e-tab" data-toggle="pill" href="#insumos_e" role="tab" aria-controls="insumos_e" aria-selected="false">Insumos</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link small text" id="fotos_e-tab" data-toggle="pill" href="#fotos_e" role="tab" aria-controls="fotos_e" aria-selected="false">Fotos</a>
                    </li>
                  </ul>
                </div>

                <div class="card-body">
                  <div class="tab-content" id="custom-tabs-three-tabContent">
                    <div class="tab-pane fade active show" id="equipos_e" role="tabpanel" aria-labelledby="equipos_e-tab">
                      <div class="row">
                        <div class="col-lg-3 col-6">
                          <label form="">Equipo:</label>
                          <input type="text" name="" class="form-control form-control-sm" id="text_equi2_e" onkeyup="mayus(this);" placeholder="Equipo">
                        </div>
                        <div class="col-lg-3 col-6">
                          <label form="">Serie:</label>
                          <input type="text" class="form-control form-control-sm" id="text_serie2_e" placeholder="Serie">
                        </div>
                        <div class="col-lg-3 col-6">
                          <label form="">Monto :</label>
                          <input type="number" name="" class="form-control form-control-sm" id="text_monto2_e" value="0" placeholder="Monto">
                        </div>
                        <div class="col-lg-3 col-6">
                          <label form="">Abono:</label>
                          <input type="number" name="" class="form-control form-control-sm" id="text_pendite2_e" value="0" placeholder="Abono">
                        </div>
                        <div class="col-lg-11 col-12">
                          <label>Falla:</label>
                          <input type="text" id="text_falla_equip" class="form-control form-control-sm" onkeyup="mayus(this);" placeholder="Falla del equipo">
                        </div>

                        <div class="col-1">
                          <label form="">&nbsp;</label><br>
                          <button class="btn btn-success btn-sm" id="btn_regis_directo_equipo"><i class="fas fa-plus"></i></button>
                        </div>

                        <div class="col-12 table-responsive"><br>
                          <table id="tabla_det_pro_edit" class="display" style="width: 100%">
                            <thead style="background: #4f5962;color: #ffffff;" class="small text left">
                              <tr>


                                <th>#</th>
                                <th>Equipo</th>
                                <th>Serie</th>
                                <th>Falla</th>
                                <th>monto</th>
                                <th>Adelanto</th>
                                <th style="text-align: center;">Accion</th>
                              </tr>
                            </thead>
                            <tbody id="tbody_tabla_det_pro_edit" class="small text left">

                            </tbody>


                          </table>
                          <br>

                        </div>


                      </div>
                    </div>

                    <div class="tab-pane fade" id="insumos_e" role="tabpanel" aria-labelledby="insumos_e-tab">
                      <div class="row">

                        <div class="col-lg-12 col-12">
                          <label for="">Articulo</label>
                          <input type="text" id="idrepara_ins" hidden>
                          <select class="form-control form-control-sm js-example-basic-single" id="select_produc_ins_e" style="width:100%"> </select>
                        </div>

                        <div class="col-lg-3 col-4">
                          <label for="">Stock</label>
                          <input type="text" name="" class="form-control form-control-sm" id="text_stock_insu_e" placeholder="Stock" disabled>
                        </div>

                        <div class="col-lg-4 col-3">
                          <label for="">Precio</label>
                          <input type="text" name="" class="form-control form-control-sm" id="text_precio_insu_e" placeholder="Stock" disabled>
                        </div>

                        <div class="col-lg-4 col-4">
                          <label for="">Cantidad</label>
                          <input type="text" name="" class="form-control form-control-sm" id="text_cantidad_ins_e" placeholder="cantidad">
                        </div>

                        <div class="col-lg-1 col-1">
                          <label form="">&nbsp;</label><br>
                          <button class="btn btn-success btn-sm" id="btn_agregar_ins_e" onclick="Registrar_insumos_al_Editar();"><i class="fas fa-plus"></i></button>
                        </div>

                      </div>

                      <div class="row" id="">

                        <div class="col-12 table-responsive"><br>
                          <table id="tabla_insumos_recep_e" class="display" style="width: 100%">
                            <thead style="background: #4f5962;color: #ffffff;" class="small text left">
                              <tr>


                                <th>#</th>
                                <th>Articulo</th>
                                <th>Cant.</th>
                                <th>Monto</th>
                                <th style="text-align: center;">Accion</th>
                              </tr>
                            </thead>
                            <tbody id="tbody_tabla_det_pro_disminuir_e" class="small text left">

                            </tbody>

                          </table>
                          <br>

                        </div>

                      </div>
                    </div>

                    <div class="tab-pane fade" id="fotos_e" role="tabpanel" aria-labelledby="fotos_e-tab">
                      <div class="row">

                        <div class="col-12">
                         
                          <input type="file" id="text_foto_e">
                        </div>

                      </div>
                      <br>
                      <div class="row">

                        <div class="col-12">
                          <div class="form-group">
                            <label for="">Foto Actual</label>
                            <div class="card" style="width: 30%;">
                              <div class="card-body">


                              </div>

                              <img class="" id="img-preview">

                            </div>

                          </div>

                        </div>
                      </div>



                    </div>

                  </div>
                </div>

              </div>
            </div>



            <!-- //aqui se borro un div -->
          </div>


          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            <button type="button" class="btn btn-primary" onclick="ModificarRecepcion();">Modificar</button>
          </div>
        </div>
      </div>
    </div>
    <!-- fin Modal -->

    <!-- Modal ver recepcion finalizada  -->
    <div class="modal fade" id="modal_ver_recepcion" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header" style="background:#343A40; color:white">
            <h5 class="modal-title" id="exampleModalLabel">Detalles de Recepcion</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="row">

              <div class="col-lg-8   col-8">
                <input type="text" id="idrecepcion_ver" hidden>
                <label>Cliente:</label>
                <input type="cliente" id="select_cliente_ver" class="form-control form-control-sm" placeholder="movil" disabled>

              </div>
              <div class="col-lg-4 col-4">
                <label>Movil:</label>
                <input type="text" id="text_movil_ver" class="form-control form-control-sm" placeholder="movil" disabled>
              </div>


              <div class="col-lg-4 col-4">
                <label>Nro. Pedido:</label>
                <input type="text" id="text_codigo_r_ver" class="form-control form-control-sm" placeholder="Nro. Pedido" disabled>
              </div>


              <div class="col-lg-4 col-4">
                <label>Motivo:</label>

                <input type="text" id="select_motivo_ver" class="form-control form-control-sm" placeholder="motivo" disabled>
              </div>
              <div class="col-lg-4 col-4">
                <label>F. Entrega:</label>
                <input type="date" id="text_fentrega_ver" class="form-control form-control-sm" placeholder="Accesorios" disabled>
              </div>

              <div class="col-lg-12 col-12" hidden>
                <label>Observacion:</label>
                <input type="text" id="text_accesorios_ver" class="form-control form-control-sm" placeholder="Observacion">
              </div>
              <div class="col-lg-12 col-12">
                <label>Observacion:</label>
                <input type="text" id="text_concepto_ver" class="form-control form-control-sm" onpaste="return false" placeholder="Falla del equipo" disabled>
              </div>








              <div class="col-lg-4 col-4">
                <label>Monto Recep.:</label>
                <input type="text" id="text_monto_ver" class="form-control  form-control-sm" placeholder="Monto" disabled>
              </div>

              <div class="col-lg-1" style="text-align: right;" hidden>
                <label for="">&nbsp;</label><br>
                <input type="checkbox" id="chkadelanto2">
              </div>
              <div class="col-lg-4 col-4">
                <label>Adelanto:</label>
                <input type="text" id="text_adelanto_ver" class="form-control form-control-sm" placeholder="Adelanto" disabled>
              </div>
              <div class="col-lg-4 col-4">
                <label>Pendiente:</label>
                <input type="text" id="text_debe_ver" class="form-control form-control-sm" placeholder="Por Pagar" disabled>
              </div>

              <div class="col-lg-4   col-6">

                <label>Estado:</label>
                <input type="text" id="select_estado_recepcion_ver" class="form-control form-control-sm" placeholder="Por Pagar" disabled>

              </div>
              <div class="col-lg-4 col-6">
                <label>Tecnico:</label>
                <input type="text" id="select_tecnic_ver" class="form-control form-control-sm" placeholder="Por Pagar" disabled>

              </div>
              <div class="col-lg-4   col-6">
                <label>Recoger:</label>
                <input type="text" id="select_recoger_recepcion_ver" class="form-control form-control-sm" placeholder="Por Pagar" disabled>

              </div>
              <div class="col-lg-4   col-6">
                <label>Monto Final:</label>
                <input type="text" id="text_monto_final_rec" class="form-control form-control-sm" placeholder="monto final con servicio" disabled>

              </div>

            </div>
            <br><br><br>


            <!-- tabpanel -->

            <div class="row">

              <div class="col-lg-12">
                <!-- <div class="card card-dark card-outline card-tabs"> -->
                <div class="card-header p-0 pt-1 border-bottom-0">
                  <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
                    <li class="nav-item">
                      <a class="nav-link active small text" id="equipos_v-tab" data-toggle="pill" href="#equipos_v" role="tab" aria-controls="equipos_v" aria-selected="true">Equipos Recepcionados</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link small text" id="insumos_v-tab" data-toggle="pill" href="#insumos_v" role="tab" aria-controls="insumos_v" aria-selected="false">Insumos</a>
                    </li>
                  </ul>
                </div>
                <div class="card-body">
                  <div class="tab-content" id="custom-tabs-three-tabContent">
                    <div class="tab-pane fade active show" id="equipos_v" role="tabpanel" aria-labelledby="equipos_v-tab">
                      <div class="row">
                        <div class=" table-responsive">
                          <table id="tabla_detalle_recep" class="display" style="width: 100%">
                            <thead style="background:#343A40; color:white ;width: 100%" class="small text left">
                              <tr>
                                <th>#</th>
                                <th>Equipo</th>
                                <th>Falla</th>
                                <th>Monto</th>
                                <th>Abono</th>
                                <th>Diagnostico</th>
                                <!-- <th>Accion</th> -->
                              </tr>
                            </thead>
                            <tbody class="small text left">
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                    <div class="tab-pane fade" id="insumos_v" role="tabpanel" aria-labelledby="insumos_v-tab">
                      <div class="row">
                        <div class=" table-responsive">
                          <table id="tabla_insumos" class="display " style="width: 100%">
                            <thead style="background:#343A40; color:white ;width: 100%" class="small text left">
                              <tr>
                                <th>#</th>
                                <th>Articulo</th>
                                <th>Cantidad</th>
                                <th>Monto</th>
                                <th>Fecha</th>

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

              </div>
            </div>

            <!-- end tab panel -->

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            <!-- <button type="button" class="btn btn-primary" onclick="ModificarRecepcion();">Modificar</button> -->
          </div>
        </div>
      </div>
    </div>
    <!-- fin Modal -->


    <!-- Modal registrar -->
    <div class="modal fade" id="modal_registro_cliente" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header" style="background:#343A40; color:white">
            <h5 class="modal-title" id="exampleModalLabel">Registro de Clientes</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="row">

              <div class="col-12   col-xs-12">

                <label>Tipo Doc.:</label>
                <select class="form-control form-control-sm js-example-basic-single" id="select_tipo_doc" style="width: 100%">
                  <option selected="true" disabled>Seleccione Tipo Docmento..</option>
                  <option value="DNI">DNI / NIF</option>
                  <!--iniciar el select 2 en el script -->
                  <option value="R.U.C">R.U.C</option>
                </select>
              </div>

              <div class="col-10 col-xs-10">
                <label for="">Nro Doc.: </label>
                <input type="text" id="text_dni" class="form-control form-control-sm" placeholder="Documento">
              </div>
              <div class="col-2 col-xs-2">
                <div class="form-group mb-2">
                  <label for="">&nbsp;</label> <br>
                  <button type="button" class="btn btn-sm btn-success" id="buscarDni"><i class="fas fa-search"></i></button>
                  <button type="button" class="btn btn-sm btn-danger" id="buscarRuc"><i class="fas fa-search"></i></button>
                </div>
              </div>


              <!-- <div class="col-2 col-xs-2">
                            <label for="">&nbsp;</label> <br>
                            <button type="button" class="btn btn-sm btn-success" id="buscar"><i
                                    class="fas fa-search"></i></button>
                        </div> -->


              <div class="col-12 col-xs-12">
                <label for="">Nombres: </label>
                <input type="text" id="text_nombre" class="form-control form-control-sm" onkeypress="return soloLetras(event)" placeholder="Nombre completo">
              </div>
              <div class="col-12 col-xs-12" hidden>
                <label for="">Apellido P.: </label>
                <input type="text" id="text_ape_p" class="form-control form-control-sm" onkeypress="return soloLetras(event)" placeholder="Apellido Paterno">
              </div>
              <div class="col-12 col-xs-12" hidden>
                <label for="">Apellido M.: </label>
                <input type="text" id="text_ape_m" class="form-control form-control-sm" onkeypress="return soloLetras(event)" placeholder="Apellido Materno">
              </div>

              <div class="col-12 col-xs-12">
                <label for="">Direccion: </label>
                <input type="text" id="text_direccion" class="form-control form-control-sm" placeholder="Direccion">
              </div>

              <div class="col-12 col-xs-12">
                <label for="">Móvil: </label>
                <input type="text" id="text_celular" class="form-control form-control-sm" placeholder="Celular">
              </div>

              <div class="col-12 col-xs-12">
                <label for="">correo: </label>
                <input type="text" id="text_correo" class="form-control form-control-sm" placeholder="Correo">
              </div>

               <div class="col-lg-12 col-xs-12">
                            <div class="form-check"><br>
                                <input class="form-check-input" type="checkbox" value="1" id="chkListanegra" name="chkListanegra" > 
                                <label class="form-check-label" for="chkListanegra">Lista <b>Negra</b></label>
                            </div>
                        </div>

            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Cerrar</button>
            <button type="button" class="btn btn-sm btn-primary" onclick="RegistrarCliente();">Registrar</button>
          </div>
        </div>
      </div>
    </div>
    <!-- fin Modal -->

    <!-- Modal IMPRESION -->
    <div class="modal fade" id="modal_impresion" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header" style="background:#343A40; color:white">
            <h5 class="modal-title" id="exampleModalLabel">Imprimir</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="row">


              <input type="hidden" id="text_idrece_imp" class="form-control form-control-sm">
              <input type="hidden" id="text_idrece_imp2" class="form-control form-control-sm">
              <input type="hidden" id="text_idrece_imp3" class="form-control form-control-sm">
              <input type="hidden" id="text_numerocel" class="form-control form-control-sm">
              <input type="hidden" id="text_nombrecliente_w" class="form-control form-control-sm">
              <input type="hidden" id="text_url_sistema" class="form-control form-control-sm">
              <input type="hidden" id="text_cod_pais" class="form-control form-control-sm">

              <div class="col-lg-4 col-md-3 ">

                <button class="btn btn-danger btn-sm " data-toggle="tooltip" data-placement="top" title="Impresion Constancia de Deposito" id="btn_deposito">Deposito</button> 

              </div>
              
               <div class="col-lg-4 col-md-3 ">
 
                <button class="btn btn-primary btn-sm "  data-toggle="tooltip" data-placement="top" title="Imprimir Ticket" id="btn_ticket"> Ticket</button> 

              </div>
               <div class="col-lg-4 col-md-3 ">

                <button class="btn btn-success btn-sm"  data-toggle="tooltip" data-placement="top" title="Enviar por Whatsapp" id="btn_whatsapp">Whatsapp</button>
              </div>

               <div class="col-lg-3 col-md-3 " hidden>

                <button class="btn btn-info btn-sm " data-toggle="tooltip" data-placement="top" title="Imprimir Constancia de Datos" id="btn_datos" >Datos</button>  

              </div>

              <div class="col-12   col-xs-12" hidden>

                <!-- <a class="btn btn-success  btn-sm" id="btn_whatsapp" href="https://wa.me/51922804671?text=hola deseo informacion del sistema" target="_blank"> Enviar Whatsapp </a> -->


              </div>

            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Cerrar</button>

          </div>
        </div>
      </div>
    </div>
    <!-- fin Modal -->



    <!-- Modal TEST -->
    <div class="modal fade" id="modal_test" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content ">
          <div class="modal-header" style="background:#343A40; color:white">
            <h5 class="modal-title" id="exampleModalLabel">Test del Equipo</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="row">
              <input type="hidden" id="text_idrece_test" class="form-control form-control-sm">

              <!-- <div class="form-check" id="ch_ocultar">
                   <label for="">&nbsp;</label><br>
                    <input class="form-check-input" type="checkbox" value="" id="ch_impuesto">
                           
                </div> -->


              <!-- ENCIENDE -->
              <div class="col-3 col-xs-12">
                <div class="form-group">
                  <i class="fas fa-power-off"></i>
                  <label>Enciende:</label> <br>
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="Si" name="text_enciende_si" id="text_enciende_si">
                    <label class="form-check-label">Si</label>

                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="No" name="text_enciende_no" id="text_enciende_no">
                    <label class="form-check-label">No</label>
                  </div>
                </div>
              </div>
              <!-- TACTIL -->
              <div class="col-3 col-xs-12">
                <div class="form-group"><i class="fas fa-hand-pointer"></i>
                  <label>Tactil:</label> <br>
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="Si" name="text_tactil_si" id="text_tactil_si">
                    <label class="form-check-label">Si</label>

                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="No" name="text_tactil_no" id="text_tactil_no">
                    <label class="form-check-label">No</label>
                  </div>
                </div>
              </div>

              <!-- IMAGEN -->
              <div class="col-3 col-xs-12">
                <div class="form-group">
                  <i class="fas fa-mobile"></i>
                  <label>Imagen:</label> <br>
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="Si" name="text_img_si" id="text_img_si">
                    <label class="form-check-label">Si</label>

                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="No" name="text_img_no" id="text_img_no">
                    <label class="form-check-label">No</label>
                  </div>
                </div>
              </div>

              <!-- VIBRACION -->
              <div class="col-3 col-xs-12">
                <div class="form-group">
                  <i class="fas fa-phone-volume"></i>
                  <label>Vibracion:</label> <br>
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="Si" name="text_vibra_si" id="text_vibra_si">
                    <label class="form-check-label">Si</label>

                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="No" name="text_vibra_no" id="text_vibra_no">
                    <label class="form-check-label">No</label>
                  </div>
                </div>
              </div>

              <!-- COBERTURA -->
              <div class="col-3 col-xs-12">
                <div class="form-group">
                  <i class="fas fa-signal"></i>
                  <label>Cobertura:</label> <br>
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="Si" name="text_cober_si" id="text_cober_si">
                    <label class="form-check-label">Si</label>

                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="No" name="text_cober_no" id="text_cober_no">
                    <label class="form-check-label">No</label>
                  </div>
                </div>
              </div>

              <!-- Sensor Aprox -->
              <div class="col-3 col-xs-12">
                <div class="form-group">
                  <i class="fas fa-assistive-listening-systems"></i>
                  <label>Sensor Aprox:</label> <br>
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="Si" name="text_sensor_si" id="text_sensor_si">
                    <label class="form-check-label">Si</label>

                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="No" name="text_sensor_no" id="text_sensor_no">
                    <label class="form-check-label">No</label>
                  </div>
                </div>
              </div>

              <!-- Carga -->
              <div class="col-3 col-xs-12">
                <div class="form-group">
                  <i class="fas fa-charging-station"></i>
                  <label>Carga:</label> <br>
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="Si" name="text_carga_si" id="text_carga_si">
                    <label class="form-check-label">Si</label>

                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="No" name="text_carga_no" id="text_carga_no">
                    <label class="form-check-label">No</label>
                  </div>
                </div>
              </div>

              <!-- Bluetooth -->
              <div class="col-3 col-xs-12">
                <div class="form-group">
                  <i class="fab fa-bluetooth"></i>
                  <label>Bluetooth:</label> <br>
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="Si" name="text_blue_si" id="text_blue_si">
                    <label class="form-check-label">Si</label>

                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="No" name="text_blue_no" id="text_blue_no">
                    <label class="form-check-label">No</label>
                  </div>
                </div>
              </div>

              <!-- Bluetooth -->
              <div class="col-3 col-xs-12">
                <div class="form-group">
                  <i class="fas fa-wifi"></i>
                  <label>Wifi:</label> <br>
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="Si" name="text_wifi_si" id="text_wifi_si">
                    <label class="form-check-label">Si</label>

                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="No" name="text_wifi_no" id="text_wifi_no">
                    <label class="form-check-label">No</label>
                  </div>
                </div>
              </div>

              <!-- HUELLA -->
              <div class="col-3 col-xs-12">
                <div class="form-group">
                  <i class="fas fa-fingerprint"></i>
                  <label>Huella:</label> <br>
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="Si" name="text_huella_si" id="text_huella_si">
                    <label class="form-check-label">Si</label>

                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="No" name="text_huella_no" id="text_huella_no">
                    <label class="form-check-label">No</label>
                  </div>
                </div>
              </div>
              <!-- boton home -->
              <div class="col-3 col-xs-12">
                <div class="form-group">
                  <i class="fas fa-home"></i>
                  <label>Btn Home:</label> <br>
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="Si" name="text_home_si" id="text_home_si">
                    <label class="form-check-label">Si</label>

                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="No" name="text_home_no" id="text_home_no">
                    <label class="form-check-label">No</label>
                  </div>
                </div>
              </div>

              <!-- boton laterales -->
              <div class="col-3 col-xs-12">
                <div class="form-group">
                  <i class="fas fa-pause-circle"></i>
                  <label>Btn Lateral:</label> <br>
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="Si" name="text_lateral_si" id="text_lateral_si">
                    <label class="form-check-label">Si</label>

                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="No" name="text_lateral_no" id="text_lateral_no">
                    <label class="form-check-label">No</label>
                  </div>
                </div>
              </div>

              <!-- camara -->
              <div class="col-3 col-xs-12">
                <div class="form-group">
                  <i class="fas fa-camera"></i>
                  <label>camara:</label> <br>
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="Si" name="text_camara_si" id="text_camara_si">
                    <label class="form-check-label">Si</label>

                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="No" name="text_camara_no" id="text_camara_no">
                    <label class="form-check-label">No</label>
                  </div>
                </div>
              </div>

              <!-- bateria -->
              <div class="col-3 col-xs-12">
                <div class="form-group">
                  <i class="fas fa-battery-three-quarters"></i>
                  <label>Bateria:</label> <br>
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="Si" name="text_bateria_si" id="text_bateria_si">
                    <label class="form-check-label">Si</label>

                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="No" name="text_bateria_no" id="text_bateria_no">
                    <label class="form-check-label">No</label>
                  </div>
                </div>
              </div>

              <!-- auricular -->
              <div class="col-3 col-xs-12">
                <div class="form-group">
                  <i class="fas fa-headphones"></i>
                  <label>Auricular:</label> <br>
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="Si" name="text_auricu_si" id="text_auricu_si">
                    <label class="form-check-label">Si</label>

                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="No" name="text_auricu_no" id="text_auricu_no">
                    <label class="form-check-label">No</label>
                  </div>
                </div>
              </div>

              <!-- Microfono -->
              <div class="col-3 col-xs-12">
                <div class="form-group">
                  <i class="fas fa-microphone"></i>
                  <label>Mocrofono:</label> <br>
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="Si" name="text_microfo_si" id="text_microfo_si">
                    <label class="form-check-label">Si</label>

                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="No" name="text_microfo_no" id="text_microfo_no">
                    <label class="form-check-label">No</label>
                  </div>
                </div>
              </div>

              <!-- Face Id -->
              <div class="col-3 col-xs-12">
                <div class="form-group">
                  <i class="far fa-smile"></i>
                  <label>Face Id:</label> <br>
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="Si" name="text_face_si" id="text_face_si">
                    <label class="form-check-label">Si</label>

                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="No" name="text_face_no" id="text_face_no">
                    <label class="form-check-label">No</label>
                  </div>
                </div>
              </div>
              <!-- Tornillos -->
              <div class="col-3 col-xs-12">
                <div class="form-group">
                  <i class="fas fa-screwdriver"></i>
                  <label>Tornillos:</label> <br>
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="Si" name="text_torni_si" id="text_torni_si">
                    <label class="form-check-label">Si</label>

                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="No" name="text_torni_no" id="text_torni_no">
                    <label class="form-check-label">No</label>
                  </div>
                </div>
              </div>




            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Cerrar</button>
            <button type="button" class="btn btn-sm btn-primary" onclick="RegistrarTest();">Registrar</button>

          </div>
        </div>
      </div>
    </div>
    <!-- fin Modal -->


  <!-- Modal de Firma -->
<div class="modal fade" id="modal_firma" tabindex="-1" role="dialog" aria-labelledby="firmaModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-dark text-white">
        <h5 class="modal-title" id="firmaModalLabel">Firma Cliente</h5>
        <button type="button" class="close text-white" data-dismiss="modal">
          <span>&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <input type="hidden" id="text_idrece_firma" class="form-control form-control-sm mb-2">
        <canvas id="signature-pad" style="border:1px solid #ccc; width: 100%; height: 200px;"></canvas>
        <input type="hidden" name="firma_base64" id="firma_base64">
        <div class="mt-2">
          <button type="button" id="btn-limpiar-firma" class="btn btn-sm btn-warning">Limpiar</button>
          <button type="button" id="btn-guardar-firma" class="btn btn-sm btn-success">Guardar</button>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

    <!-- fin Modal -->
   



<!-- <script src="https://cdn.jsdelivr.net/npm/signature_pad@4.1.6/dist/signature_pad.umd.min.js"></script> -->
    <script>
      //para el dise単o del combo
      $(document).ready(function() {
        $('.js-example-basic-single').select2();

        
        //LOGO
        $('#pre_imagen').html('<img src="../controller/recepcion/foto/no_imagen.png" style="width: 60px;" class="rounded-circle avatar-xl img-thumbnail user-profile-image" alt="user-profile-image"></img><input type="hidden" name="hidden_usuario_imagen" value="" />');

        let usuid = document.getElementById('text_Idprincipal').value;

        //OCULTAR LO BOTONES DE BUSQUEDAD
        $("#buscarDni").attr('hidden', true);
        $("#buscarRuc").attr('hidden', true);

        //PARA HABILITAR LO BOTONES DE BUSQUEDAD
        $("#select_tipo_doc").change(function() {
          buscarDniRuc();
        });

         $('#modal_registro_recepcion').on('shown.bs.modal', function() {
                   cargar_Select_Productos();
                    cargar_Select_Insumos_Edit();
           });

          $('#modal_editar_recepcion').on('shown.bs.modal', function () {
            cargar_Select_Productos();
             cargar_Select_Insumos_Edit();
          });
        // cargar_Notificaiones_Recepcion();
        //Notificacion_Tecnico(usuid);
        fechas();
        cargar_SelectCliente();
         cargar_SelectSucursales();
        cargar_SelectMotivo();
        cargar_SelectTecnico();
        //cargar_Select_Productos();
        
        Traer_estado_caja();

        let rolid = document.getElementById('text_idrol').value;
        //console.log(rolid);
        Listar_Recepcion();


        //PROCEDIMIENTO PARA LA FIRMA
       let signaturePad;

  function resizeCanvas(canvas) {
    const ratio = Math.max(window.devicePixelRatio || 1, 1);
    canvas.width = canvas.offsetWidth * ratio;
    canvas.height = canvas.offsetHeight * ratio;
    canvas.getContext("2d").scale(ratio, ratio);
  }

  // Cuando se abre el modal, inicializa el SignaturePad
  $('#modal_firma').on('shown.bs.modal', function () {
    const canvas = document.getElementById('signature-pad');
    resizeCanvas(canvas);
    signaturePad = new SignaturePad(canvas);
    signaturePad.clear(); // limpia al abrir
  });

  // Botón para limpiar firma
  $('#btn-limpiar-firma').on('click', function () {
    if (signaturePad) {
      signaturePad.clear();
    } else {
      alert("La firma aún no está lista.");
    }
  });

      // Botón para guardar firma
    $('#btn-guardar-firma').on('click', function () {
        if (!signaturePad || signaturePad.isEmpty()) {
          alert("Por favor firme antes de guardar.");
          return;
        }

        let idrecefirma = $('#text_idrece_firma').val();
        const dataURL = signaturePad.toDataURL(); // base64 de la imagen

        $.ajax({
          url: '../controller/recepcion/controlador_guardar_firma_cliente.php',
          type: 'POST',
          data: {
            idrecefirma: idrecefirma,
            firma_base64: dataURL
          }
        }).done(function (resp) {
          console.log(resp);
          if (resp > 0) {
            Swal.fire("Mensaje de Confirmación", "Firma Registrada", "success").then(() => {
              $("#modal_firma").modal('hide');
            });
          } else {
            Swal.fire("Mensaje de Error", "No se pudo completar el registro", "error");
          }
        })
        // .fail(function (xhr, status, error) {
        //   console.error("AJAX Error:", error);
        //   Swal.fire("Error", "Error en la petición AJAX", "error");
         });

         
});



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

      $("#btn_agregarImei").on('click', function() {
        Agregar_equipo();
      })

      $("#btn_regis_directo_equipo").on('click', function() {
        RegistrarEqui_directo_recep();
      })

      //agregar insumos
      $("#btn_agregar_ins").on('click', function() {
        Agregar_insumos();
      })



      document.getElementById('text_fentrega').value = anio + "-" + mes + "-" + d;
      // document.getElementById('text_finicio').value = anio + "-" + mes + "-" + d;
      // document.getElementById('text_ffin').value = anio + "-" + mes + "-" + d;


      //validar que solo seleccione foto (Registrar foto)
      document.getElementById("text_foto").addEventListener("change", () => {
        var fileName = document.getElementById("text_foto").value;
        var idxDot = fileName.lastIndexOf(".") + 1;
        var extFile = fileName.substr(idxDot, fileName.length).
        toLowerCase();
        if (extFile == "jpg" || extFile == "jpeg" || extFile == "png" || extFile == "PNG") {
          //TO DO 
        } else {
          Swal.fire("MENSAJE DE ADVERTENCIA", "SOLO SE ACEPTAN IMAGENES - USTED SUBIO UN ARCHIVO CON EXTENSION " +
            extFile, "warning");
          document.getElementById("text_foto").value = "";
        }
      });

      /*************************************************************************
                   FUNCION PARA LLAMAR LOS DATOS DE RENIEC DESDE API
           ***************************************************************************/
      $('#buscar').click(function() {
        dni = $('#text_dni').val();
        $.ajax({
          url: '../controller/reniec/consultaDNI.php',
          type: 'post',
          data: 'dni=' + dni,
          dataType: 'json',
          success: function(r) {
            if (r.numeroDocumento == dni) {
              $('#text_ape_p').val(r.apellidoPaterno);
              $('#text_ape_m').val(r.apellidoMaterno);
              $('#text_nombre').val(r.nombres);
            } else {
              alert(r.error);
            }
            //console.log(r)
          }
        });
      });

$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})


      /*===================================================================*/
      //PARA MAYUSCULAS
      /*===================================================================*/
      function mayus(e) {
        e.value = e.value.toUpperCase();
      }

      function fechas() {
        var f = new Date();
        var anio = f.getFullYear();
        var mes = f.getMonth() + 1; // Los meses en JavaScript van de 0 a 11, por lo que sumamos 1.
        var d = f.getDate(); // Día actual
        
        // Obtener el primer día del mes
        var primerDia = '01';
        
        // Asegurar que el día y el mes tengan 2 dígitos
        if (d < 10) {
            d = '0' + d;
        }
        if (mes < 10) {
            mes = '0' + mes;
        }
        
        // Formatear las fechas en formato YYYY-MM-DD
        var fechaInicio = anio + "-" + mes + "-" + primerDia; // Primer día del mes actual
        var fechaFin = anio + "-" + mes + "-" + d; // Fecha actual
        
        // Establecer los valores en los inputs
        document.getElementById('text_finicio').value = fechaInicio;
        document.getElementById('text_ffin').value = fechaFin;
    }


      /*===================================================================*/
      //HABILITAR BOTONES DE BUSQUEDAD
      /*===================================================================*/
      function buscarDniRuc() {
        var tipoDoc = $("#select_tipo_doc").val();
        //console.log(tipoDoc);

        if (tipoDoc == 'DNI') {
          $("#buscarDni").attr('hidden', false);
          $("#buscarRuc").attr('hidden', true);
          $("#text_dni").val("");
          $("#text_direccion").val("");
        } else if (tipoDoc == 'R.U.C') {
          $("#buscarDni").attr('hidden', true);
          $("#buscarRuc").attr('hidden', false);
          $("#text_dni").val("");
        } else {
          alert('Debe Seleccione un tipo de documento');
          // Toast.fire({
          //     icon: 'error',
          //     title: 'Debe Seleccione un tipo de documento'
          // })

          $("#buscarDni").attr('hidden', true);
          $("#buscarRuc").attr('hidden', true);
        }

      }




      /********************************************************************
         PRODUCTOS EN COMBO
      ********************************************************************/
      var arreglo_PRO = new Array();
      var arreglo_stock = new Array();
      var arreglo_precio = new Array();
      //var arreglo_pr_comp = new Array();

      function cargar_Select_Productos() { //enviamos al scrpit mantenimiento examen
        let idalmacen = document.getElementById('text_idalmacen').value;
            let rolid = document.getElementById('text_idrol').value;
            
        $.ajax({
          url: '../controller/recepcion/controlador_cargar_select_productos_reparacion.php',
          type: 'POST',
           data:{
			   idalmacen:idalmacen,
			   rolid:rolid
		   }
        }).done(function(resp) {
          //alert(arreglo_stock);
          let data = JSON.parse(resp); //POSICION DE LA FILA Y COLUMNA
          let llenardata = "<option value=''>Seleccione</option>";
          // let llenardata = "";
          if (data.length > 0) {
            for (let i = 0; i < data.length; i++) {
              llenardata += "<option value='" + data[i][0] + "'>" + data[i][1] + "</option>";
              arreglo_PRO[data[i][0]] = data[i][1];
              arreglo_stock[data[i][0]] = data[i][2]; //PARA JALAR LA STOCK DEL PROCEDURE
              arreglo_precio[data[i][0]] = data[i][3]; //PARA JALAR LA PRECIO DEL PROCEDURE
              // arreglo_pr_comp[data[i][0]] = data[i][4];

            }
            document.getElementById('select_produc_ins').innerHTML = llenardata; //primero para registrar luego en modificar colocamos el select editar

          } else {
            llenardata += "<option value=''>No se encontraron datos</option>";
            document.getElementById('select_produc_ins').innerHTML = llenardata;

          }

          
          let select = $('#select_produc_ins');
            select.html(llenardata);

            // Destruye y vuelve a aplicar select2 correctamente
            if (select.hasClass("select2-hidden-accessible")) {
              select.select2('destroy');
            }

            select.select2({
             dropdownParent: $('#modal_registro_recepcion .modal-content'),
            width: '100%'
            });
        })
      }

      //ENVIAMOS DATOS DE PRODUCTOS A CAJAS DE TEXTO DEL PRODUCTO
      $('#select_produc_ins').on('select2:select', function(e) {
        // matcher: matchStart
        let idprod_ins = document.getElementById('select_produc_ins').value;
        document.getElementById('text_stock_insu').value = arreglo_stock[idprod_ins];
        document.getElementById('text_precio_insu').value = arreglo_precio[idprod_ins];
        // document.getElementById('text_precio_compra_insu').value = arreglo_pr_comp[idprod_ins];
      })

       //MOSTRAR LA ALERTA SI EL CLIENTE ESTA EN LISTA NEGRA
       $('#select_cliente').on('change', function() {
            // Busca la opción que está actualmente seleccionada
            var optionSeleccionada = $(this).find('option:selected');
        
            // Obtiene todos los datos
            var clienteId = optionSeleccionada.val();
            var clienteLista = optionSeleccionada.data('listanegra');
        
            // Muestra todo en la consola
          //  console.log("--- Datos del Cliente Seleccionado ---");
          //console.log("ID:", clienteId);
          // console.log("Lista:", clienteLista);
        
            // --- AQUÍ LA NUEVA LÓGICA ---
            // Comprueba si el cliente está en la lista negra
            if (clienteLista === 'Si') {
                // Si es 'Si', muestra el span de alerta
                $('#alerta_listanegra').show(); 
            } else {
                // Si es cualquier otro valor (o está vacío), oculta el span
                $('#alerta_listanegra').hide();
            }
        });



      var arreglo_PRO_e = new Array();
      var arreglo_stock_e = new Array();
      var arreglo_precio_e = new Array();

      function cargar_Select_Insumos_Edit() { //enviamos al scrpit mantenimiento examen
         let idalmacen = document.getElementById('text_idalmacen').value;
         let rolid = document.getElementById('text_idrol').value;
        $.ajax({
          url: '../controller/recepcion/controlador_cargar_select_productos_reparacion.php',
          type: 'POST',
            data:{
			   idalmacen:idalmacen,
			   rolid:rolid
		   }
        }).done(function(resp) {
          //alert(arreglo_stock);
          let data = JSON.parse(resp); //POSICION DE LA FILA Y COLUMNA
          let llenardata = "<option value=''>Seleccione</option>";
          // let llenardata = "";
          if (data.length > 0) {
            for (let i = 0; i < data.length; i++) {
              llenardata += "<option value='" + data[i][0] + "'>" + data[i][1] + "</option>";
              arreglo_PRO_e[data[i][0]] = data[i][1];
              arreglo_stock_e[data[i][0]] = data[i][2]; //PARA JALAR LA STOCK DEL PROCEDURE
              arreglo_precio_e[data[i][0]] = data[i][3]; //PARA JALAR LA PRECIO DEL PROCEDURE

            }
            document.getElementById('select_produc_ins_e').innerHTML = llenardata; //primero para registrar luego en modificar colocamos el select editar

          } else {
            llenardata += "<option value=''>No se encontraron datos</option>";
            document.getElementById('select_produc_ins_e').innerHTML = llenardata;

          }

           let select = $('#select_produc_ins_e');
            select.html(llenardata);

            // Destruye y vuelve a aplicar select2 correctamente
            if (select.hasClass("select2-hidden-accessible")) {
              select.select2('destroy');
            }

            select.select2({
             dropdownParent: $('#modal_editar_recepcion .modal-content'),
            width: '100%'
            });

        })
      }

      //ENVIAMOS DATOS DE PRODUCTOS A CAJAS DE TEXTO DEL PRODUCTO
      $('#select_produc_ins_e').on('select2:select', function(e) {
        // matcher: matchStart
        let idprod_ins_e = document.getElementById('select_produc_ins_e').value;
        document.getElementById('text_stock_insu_e').value = arreglo_stock[idprod_ins_e];
        document.getElementById('text_precio_insu_e').value = arreglo_precio[idprod_ins_e];
      })
    </script>
<?php
  } else {
    header("Location:" . conexionBD::ruta() . "view/404/mant_error.php");
  }
} else {
  header("Location:" . conexionBD::ruta() . "view/404/mant_error.php");
}
?>