<?php
session_start();
    require_once("../../model/modelo_conexion.php");
    require_once("../../model/modelo_rol.php");
    $rol = new Modelo_Rol();
    $datos = $rol->validar_menu_x_rol($_SESSION['S_ROL'],4);// EL 6 ES MENU SERVICIOS
    //var_dump($datos);
     if (isset($_SESSION['S_IDUSUARIO']))  {
  
        if(is_array($datos) and count($datos)>0){
?>
    <script src="../js/servicio.js?rev=<?php echo time();?>"></script>
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">


            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <div class="col-lg-12">
        <div class="card ">
            <div class="card-header">
                <h3 class="card-title"><b>Recepciones Terminadas</b></h3><label for="" id="text_estado" hidden></label>
                <button class=" btn btn-info btn-sm float-right" id="textnuevoservicio"
                    onclick="cargar_contenido('contenido_principal','servicio/mantenimiento_servicio_registrar.php')"><i
                        class="fas fa-plus"></i> Nuevo</button>
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
                        <button class="btn btn-info btn-sm" onclick="Listar_Servicio()"><i
                                class="fas fa-search"></i></button>

                    </div>

                </div><br>
                <div class="row">
                    <div class="col-12 table-responsive">
                        <table id="tabla_servicio" class="display compact">
                            <thead style="background:#343A40; color:white" class="small text left">
                                <tr>
                                    <th>Refe.</th>
                                    <th>Pedido</th>
                                    <th>Cliente </th>
                                    <th>F. Pago </th>
                                    <th>Concepto</th>
                                    <th>Monto</th>
                                    <th>Comentario</th>
                                    <th>Tecnico</th>
                                    <th>Fecha.</th>
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



    <!-- Modal Editar  -->
    <div class="modal fade" id="modal_editar_comprobante" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header" style="background:#343A40; color:white">
                    <h5 class="modal-title" id="exampleModalLabel">Actualizar Marca</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">

                        <div class="input-group input-group-sm mb-3 col-12">
                            <div class="input-group-prepend">
                                <input type="text" id="idcomprobante" hidden="">
                                <span class="input-group-text">Comprobante</span>
                            </div>
                            <input type="text" id="text_tipoc_editar" class="form-control form-control-sm"
                                placeholder="Comprobante">
                        </div>
                        <div class="input-group input-group-sm mb-3 col-6">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Serie</span>
                            </div>
                            <input type="text" id="text_seriec_editar" class="form-control form-control-sm"
                                placeholder="Serie">
                        </div>
                        <div class="input-group input-group-sm mb-3 col-6">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Correlativo</span>
                            </div>
                            <input type="text" id="text_numeroc_editar" class="form-control form-control-sm"
                                placeholder="Correlativo">
                        </div>

                        <div class="input-group input-group-sm mb-3 col-12">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Estado</span>
                            </div>
                            <select class="form-control form-control-sm js-example-basic-single"
                                id="select_estado_compro_editar" style="width: 84%">
                                <option value="ACTIVO">ACTIVO</option>
                                <!--iniciar el select 2 en el script -->
                                <option value="INACTIVO">INACTIVO</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" onclick="ModificarComprobante();">Modificar</button>
                </div>
            </div>
        </div>
    </div>
    <!-- fin Modal -->

      <!-- Modal IMPRESION -->
      <div class="modal fade" id="modal_impresion" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog " role="document">
            <div class="modal-content ">
                <div class="modal-header" style="background:#343A40; color:white">
                    <h5 class="modal-title" id="exampleModalLabel">Imprimir</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">

            
                            <input type="hidden" id="text_idser" class="form-control form-control-sm" >
                            <input type="hidden" id="text_idre" class="form-control form-control-sm" >
                            <input type="hidden" id="text_numerocel" class="form-control form-control-sm">
                             <input type="hidden" id="text_nombrecliente_w" class="form-control form-control-sm">
                             <input type="hidden" id="text_url_sistema" class="form-control form-control-sm">
                             <input type="hidden" id="text_cod_pais" class="form-control form-control-sm">

                        <div class="col-12   col-xs-12">
                        <!-- <button class="btn btn-info btn-sm " id="btn_a4">Imp. A4</button> -->

                        <button class="btn btn-info btn-sm " id="btn_entrega">Const. Entrega</button>  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
                                                
                        <button class="btn btn-primary btn-sm " id="btn_ticket">Ticket</button> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 

                        <button class="btn btn-warning btn-sm " id="btn_factura">Comprobante</button>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;

                        <button class="btn btn-success btn-sm" id="btn_whatsapp">Whatsapp</button>

                         
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


<script>
//para el diseño del combo
$(document).ready(function() {
    $('.js-example-basic-single').select2();
});

fechasmes();
cargar_Notificaiones_Recepcion();
Listar_Servicio();
Traer_estado_caja();

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
    </script>
    <?php
    }else{
        header("Location:".conexionBD::ruta()."view/404/mant_error.php");
    }
    }else{
        header("Location:".conexionBD::ruta()."view/404/mant_error.php");
    }
?>