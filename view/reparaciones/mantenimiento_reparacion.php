<?php
session_start();
    require_once("../../model/modelo_conexion.php");
    require_once("../../model/modelo_rol.php");
    $rol = new Modelo_Rol();
    $datos = $rol->validar_menu_x_rol($_SESSION['S_ROL'],3);// EL 6 ES MENU REPARA
    //var_dump($datos);
     if (isset($_SESSION['S_IDUSUARIO']))  {
  
        if(is_array($datos) and count($datos)>0){
?>
    <script src="../js/reparacion.js?rev=<?php echo time(); ?>"></script>
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">


            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <div class="col-lg-12">
        <div class="card ">
            <div class="card-header">
                <h3 class="card-title"><b>Listado de Reparaciones</b></h3><label for="" id="text_estado" hidden></label>

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
                        <button class="btn btn-info btn-sm" onclick="Listar_Reparacion()"><i class="fas fa-search"></i></button>

                    </div>

                </div><br>
                <div class="row">
                    <div class="col-12 table-responsive">
                        <table id="tabla_reparacion" class="display compact">
                            <thead style="background:#343A40; color:white" class="small text left">
                                <tr>

                                    <th>Rece </th>
                                    <th>Pedido </th>
                                    <th>Cliente</th>
                                    <th style="width:20%">Concepto</th>
                                    <th>Motivo</th>
                                    <th>Fecha</th>
                                    <th>Sucursal</th>
                                    <th>Tecnico</th>
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

    <!-- Modal DEALLE DE REPARACION  -->
    <div class="modal fade" id="modal_detalle_recepcion" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header" style="background:#343A40; color:white">
                    <h5 class="modal-title" id="exampleModalLabel">Detalles de Recepcion</h5> &nbsp;&nbsp;&nbsp; <label for="" id="idrecep_estad" style=" padding: 3px;"> </label>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-8   col-8">
                            <input type="text" id="idreparacion" hidden>
                            <label>Cliente:</label>
                            <input type="text" id="text_cliente_d" class="form-control form-control-sm" placeholder="cliente" disabled>
                        </div>
                        <div class="col-lg-4 col-4">
                            <label>Motivo:</label>
                            <input type="text" id="text_motivo_d" class="form-control form-control-sm" placeholder="motivo" disabled>
                        </div>
                        <div class="col-lg-4 col-4">
                            <label>F. Entrega:</label>
                            <input type="text" id="text_fentrega_d" class="form-control form-control-sm" placeholder="fecha" disabled>
                        </div>
                        <div class="col-lg-8 col-8">
                            <label>Observacion:</label>
                            <input type="text" id="text_observa_d" class="form-control form-control-sm" placeholder="observacion" disabled>
                        </div>
                        <div class="col-lg-8 col-8">
                            <label>Glosa:</label>
                            <input type="text" id="text_glosa_d" class="form-control form-control-sm" onkeyup="mayus(this);" placeholder="glosa">
                        </div>
                        <div class="col-lg-4   col-4" id="ocul_estado">
                            <label>Estado:</label>
                            <select class="form-control form-control-sm js-example-basic-single" id="select_estado_d" style="width: 100%">
                                <option value="">Seleccione</option>
                                <option value="EN REPARACION">EN REPARACION</option>
                                <option value="REPARADO">REPARADO</option>
                                <option value="NO REPARADO">NO REPARADO</option>

                            </select>
                        </div>

                    </div>
                    <br>
                    <br>



                    <!-- <div class="row" >
                        <div class="col-12 table-responsive"><br>
                            <table id="tabla_detalle_equi" class="display" style="width: 100%">
                                <thead style="background: #4f5962;color: #ffffff;" class="small text left">
                                    <tr>
                                        <th>#</th>
                                        <th>Equipo</th>
                                        <th>Falla</th>
                                        <th>Diagnostico</th>
                                        <th>Accion</th>


                                    </tr>
                                </thead>
                                <tbody id="tbody_tabla_det_pro_edit" class="small text left">
                            </tbody>
                            </table>
                            <br>

                        </div>

                    </div> -->

                    <!-- tabpanel -->

                    <div class="row">

                        <div class="col-lg-12">
                            <!-- <div class="card card-dark card-outline card-tabs"> -->
                            <div class="card-header p-0 pt-1 border-bottom-0">
                                <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active small text" id="equipos-tab" data-toggle="pill" href="#equipos" role="tab" aria-controls="equipos" aria-selected="true">Equipos</a>
                                    </li>
                                    <li class="nav-item" id="insumos_tabpanel">
                                        <a class="nav-link small text" id="insumos-tab" data-toggle="pill" href="#insumos" role="tab" aria-controls="insumos" aria-selected="false">Insumos</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="card-body">
                                <div class="tab-content" id="custom-tabs-three-tabContent">
                                    <div class="tab-pane fade active show" id="equipos" role="tabpanel" aria-labelledby="equipos-tab">
                                        <div class="row">
                                            <div class=" table-responsive">
                                                <table id="tabla_detalle_equi" class="display" style="width: 100%">
                                                    <thead style="background: #4f5962;color: #ffffff;" class="small text left">
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Equipo</th>
                                                            <th>Falla</th>
                                                            <th>Diagnostico</th>
                                                            <th>Accion</th>


                                                        </tr>
                                                    </thead>
                                                    <tbody id="tbody_tabla_det_pro_edit" class="small text left">
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="insumos" role="tabpanel" aria-labelledby="insumos-tab">
                                        <div class="row">
                                            <div class=" table-responsive">
                                                <table id="tabla_insumos_ver_rep" class="display " style="width: 100%">
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
                    <button type="button" class="btn btn-primary" id="btn_regis_repara" onclick="Registrar_reparacion();">Registrar</button>
                </div>
            </div>
        </div>
    </div>
    <!-- fin Modal -->




    <!-- Modal REGISTRAR DIAGNOSTICO -->
    <div class="modal fade" id="modal_registrar_diagnostico" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog " role="document">
            <div class="modal-content">
                <div class="modal-header" style="background:#343A40; color:white">
                    <h5 class="modal-title" id="exampleModalLabel">Registrar Diagnostico</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12   col-12">
                            <input type="text" id="idrepa_diagnos" hidden>
                            <input type="text" id="idquipo_diag" hidden>
                            <label>Comentario:</label>
                            <input type="text" id="text_diagnostico" class="form-control form-control-sm" onkeyup="mayus(this);" placeholder="Diagnostico">
                        </div>



                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" onclick="Registrar_diagnostico();">Insertar</button>
                </div>
            </div>
        </div>
    </div>
    <!-- fin Modal -->




    <!-- Modal AGREGAR INSUMOS A LA REPARACION -->
    <div class="modal fade" id="modal_insumos_reparacion" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header" style="background:#343A40; color:white">
                    <h5 class="modal-title" id="exampleModalLabel">Agregar insumos a reparacion</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12 col-12">

                            <label for="">Articulo</label>
                            <input type="text" id="idrepara_ins" hidden>
                            <select class="form-control form-control-sm js-example-basic-single" id="select_produc_ins" style="width:100%"> </select>
                        </div>

                        <div class="col-lg-3 col-4" hidden>

                            <label for="">Stock</label>

                            <input type="text" name="" class="form-control form-control-sm" id="text_stock_insu" placeholder="Stock" disabled>
                        </div>
                        <div class="col-lg-4 col-3" hidden>

                            <label for="">Precio</label>

                            <input type="text" name="" class="form-control form-control-sm" id="text_precio_insu" placeholder="Stock" disabled>
                        </div>
                        <div class="col-lg-4 col-4">

                            <label for="">Cantidad</label>

                            <input type="text" name="" class="form-control form-control-sm" id="text_cantidad_ins" placeholder="cantidad">
                        </div>
                        <div class="col-lg-1 col-1">
                            <label form="">&nbsp;</label><br>
                            <button class="btn btn-success btn-sm" id="btn_agregar_ins" onclick="Registrar_insumos();"><i class="fas fa-plus"></i></button>
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
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <!-- <button type="button" class="btn btn-primary" onclick="">Modificar</button> -->
                </div>
            </div>
        </div>
    </div>
    <!-- fin Modal -->


    <script>
        $(document).ready(function() {
            $('.js-example-basic-single').select2();

            fechasmes()
            Listar_Reparacion();
            cargar_Select_Productos();
            let usuid = document.getElementById('text_Idprincipal').value;
            Notificacion_Tecnico(usuid);
        });

        /*===================================================================*/
        //PARA MAYUSCULAS
        /*===================================================================*/
        function mayus(e) {
            e.value = e.value.toUpperCase();
        }

        function fechasmes() {
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






        /********************************************************************
           PRODUCTOS EN COMBO
        ********************************************************************/
        var arreglo_PRO = new Array();
        var arreglo_stock = new Array();
        var arreglo_precio = new Array();

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

                    }
                    document.getElementById('select_produc_ins').innerHTML = llenardata; //primero para registrar luego en modificar colocamos el select editar

                } else {
                    llenardata += "<option value=''>No se encontraron datos</option>";
                    document.getElementById('select_produc_ins').innerHTML = llenardata;

                }
            })
        }

        //ENVIAMOS DATOS DE PRODUCTOS A CAJAS DE TEXTO DEL PRODUCTO
        $('#select_produc_ins').on('select2:select', function(e) {
            // matcher: matchStart
            let idprod_ins = document.getElementById('select_produc_ins').value;

            document.getElementById('text_stock_insu').value = arreglo_stock[idprod_ins];
            document.getElementById('text_precio_insu').value = arreglo_precio[idprod_ins];
        })
    </script>
    <?php
    }else{
        header("Location:".conexionBD::ruta()."view/404/mant_error.php");
    }
    }else{
        header("Location:".conexionBD::ruta()."view/404/mant_error.php");
    }
?>