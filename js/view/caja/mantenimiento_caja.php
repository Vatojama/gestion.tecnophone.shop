<?php
session_start();
    require_once("../../model/modelo_conexion.php");
    require_once("../../model/modelo_rol.php");
    $rol = new Modelo_Rol();
    $datos = $rol->validar_menu_x_rol($_SESSION['S_ROL'],5);// EL 8 ES MENU CAJA
    //var_dump($datos);
     if (isset($_SESSION['S_IDUSUARIO']))  {
  
        if(is_array($datos) and count($datos)>0){
?>
    <script src="../js/caja.js?rev=<?php echo time();?>"></script>
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">


            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>


    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card ">
                        <div class="card-header ">
                            <!--bg-info -->
                            <h6 class="card-title" style="text-align:center"><b>Arqueo de Caja - </b>&nbsp;&nbsp;
                                <label for="" id="text_estado" class="text-info "></label>&nbsp;&nbsp; <label for=""
                                    id="text_fecha_apert" class="text-info "></label>

                            </h6>
                            <button class="btn btn-outline-success  mb-2 btnAbrirCaja float-right" type="button"
                                onclick="AbrirModalAbrirCaja();" title="Abrir Caja" id="btnAbrirCaja"><i
                                    class="fas fa-unlock"> Abrir caja</i>
                            </button>

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
                                    <button class="btn btn-info btn-sm" onclick="Listar_Caja()"><i
                                            class="fas fa-search"></i></button>

                                </div>

                            </div><br>

                            <div class="row">
                                <div class="col-12 table-responsive">
                                    <table id="tabla_movi_caja" class="display compact" style="width: 100%">
                                        <thead style="background:#343A40; color:white" class="small text left">
                                            <tr>
                                                <th>#</th>
                                                <th>Monto Ini</th>
                                                <th>Monto Servicio</th>
                                                <th>Monto Ventas</th>
                                                <th>Monto Egreso</th>
                                                <th>Fecha Apertura</th>
                                                <th>Fecha Cierre</th>
                                                <!-- <th>Cant Ventas</th>
                                                <th>Cant Egreso</th> -->
                                                <th>Monto Total</th>
                                                 <th>Sucursal</th>
                                                <th>Estado</th>
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
            </div>
        </div>
    </section>


    <!-- Modal abrir caja -->
    <div class="modal fade" id="modal_abrir_caja" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header" style="background:#343A40; color:white">
                    <h5 class="modal-title" id="exampleModalLabel">Abrir Caja</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12 col-xs-12">
                            <label for="">Descripcion </label>
                            <input type="text" id="text_descripcion" class="form-control form-control-sm"
                                placeholder="Apertura de Caja" disabled>
                        </div>
                        <div class="col-12 col-xs-12">
                            <label for="">Monto Inicial</label>
                            <input type="number" id="text_monto" name= "text_monto" class="form-control form-control-sm"
                                placeholder="Monto incial">
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary"
                        onclick="Registrar_Apertura_caja();myFunction(); ">Abrir
                        Caja</button>
                </div>
            </div>
        </div>
    </div>
    <!-- fin Modal -->






    <!-- Modal cerrar caja -->
    <div class="modal fade" id="modal_cerrar_caja" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header" style="background:#990000; color:white">
                    <h5 class="modal-title" id="exampleModalLabel">Cerrar Caja</h5> 
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12 col-xs-12">
                            <input type="text" id="cajaid" hidden>
                            <label for="">Monto Apertura </label>
                            <input type="text" id="text_apertura" class="form-control form-control-sm"
                                placeholder="Apertura de Caja"  disabled>
                        </div>
                        <div class="col-6 col-xs-12">
                            <label for="">Monto Ventas</label>
                            <input type="text" id="text_monto_ventas" 
                                class="form-control form-control-sm" placeholder="Monto incial" disabled>
                        </div>
                        <div class="col-6 col-xs-12">
                            <label for="">Cant Ventas</label>
                            <input type="number" id="text_cant_ventas" class="ver_ventascaja form-control form-control-sm"
                                placeholder="Monto incial" readonly>
                        </div>
                        <div class="col-6 col-xs-12">
                            <label for="">Monto Servicio</label>
                            <input type="text" id="text_monto_servicio" 
                                class="form-control form-control-sm" placeholder="Monto incial" disabled>
                        </div>
                        <div class="col-6 col-xs-12">
                            <label for="">Cant Servicio</label>
                            <input type="number" id="text_cant_servicio" class="form-control form-control-sm"
                                placeholder="Monto incial" disabled>
                        </div>
                         <div class="col-6 col-xs-12">
                            <label for="">Monto Ingreso</label>
                            <input type="text" id="text_monto_ingreso" class="form-control form-control-sm"
                                placeholder="Monto ingreso"  disabled>
                        </div>

                          <div class="col-6 col-xs-12">
                            <label for="">Monto Abonos</label>
                            <input type="text" id="text_monto_abonos" class="form-control form-control-sm"
                                placeholder="Monto Abonos"  disabled>
                        </div>

                        <div class="col-6 col-xs-12">
                            <label for="">Monto Egreso</label>
                            <input type="text" id="text_monto_egreso" class="form-control form-control-sm"
                                placeholder="Monto egreso"  disabled>
                        </div>
                        <div class="col-6 col-xs-12" hidden>
                            <label for="">Cant Egreso</label>
                            <input type="number" id="text_cant_egreso" class="form-control form-control-sm"
                                placeholder="cant egreso" disabled>
                        </div>

                       
                        <div class="col-6 col-xs-12" hidden>
                            <label for="">Cant Ingreso</label>
                            <input type="number" id="text_cant_ingreso" class="form-control form-control-sm"
                                placeholder="Cant. ingreso" disabled>
                        </div>


                        <div class="col-12 col-xs-12">
                            <label for="">Monto Total</label>
                            <input type="text" id="text_monto_total" class="form-control form-control-sm"
                                placeholder="Monto total caja"  disabled>
                        </div>
                        <!-- <div class="  col-6 col-xs-12">
                            <label for="">&nbsp;</label><br>
                            <button class="btn btn-success btn-sm " ><i
                                    class="fas fa-plus"></i> Calcular</button>
                        </div> -->


                    </div>
                </div>
                <div class="modal-footer">
                
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-danger" id="btncerrar"
                        onclick="Registrar_Cierre_caja(); myFunction();">Cerrar Caja</button>
                </div>
            </div>
        </div>
    </div>
    <!-- fin Modal -->

     <!-- Modal IMPRESION -->
     <div class="modal fade" id="modal_impresion" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content modal-sm">
                <div class="modal-header" style="background:#343A40; color:white">
                    <h5 class="modal-title" id="exampleModalLabel">Imprimir</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">

            
                            <input type="hidden" id="text_idcajaa" class="form-control form-control-sm" >
                             <input type="hidden" id="text_idsucur" class="form-control form-control-sm" >
                         

                        <div class="col-12   col-xs-12">
                        <!-- <button class="btn btn-info btn-sm " id="btn_a4">Imp. A4</button> -->

                        <button class="btn btn-info btn-sm " id="btn_formt1">Resumen</button>  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
                                                
                        <button class="btn btn-primary btn-sm " id="btn_formt2">Detallado</button>

                         
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


       <!-- Modal ver detalles del la caja ventas -->

    <div class="modal fade" id="modal_detalle_ventas_caja" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header" style="background:#343A40; color:white">
            <h5 class="modal-title" id="exampleModalLabel">Listado de ventas por caja</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col-12 table-responsive">
                <table id="tabla_ventas_detallecaja" class="display compact" style="width: 100%">
                  <thead style="background:#343A40; color:white" class="small text left">
                    <tr>
                      <th>Cliente </th>
                      <th>Comprobante </th>
                      <th>Total </th>
                      <th>Forma P. </th>
                      <th>Fecha</th>
                      <th>Estado</th>
                    </tr>
                  </thead>
                  <tbody class="small text left">

                  </tbody>
                </table>
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


    // actualizar automaticamente el campo estado y fecha en formulario - llamamos a la funcion traer datos venta
    // const myInterval = setInterval(Traer_datos_ventas, 1500);
    // const myTimeout = setTimeout(myStopFunction, 2000);


    let timeout;
    fechas();
    Listar_Caja();
   
});

Traer_datos_ventas();


function myFunction() {
    timeout = setTimeout(Traer_datos_ventas, 2000);
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




// var f = new Date();
// var anio = f.getFullYear();
// var mes = f.getMonth() + 1;
// var d = f.getDate();


// if (d < 10) {
//     d = '0' + d;
// }
// if (mes < 10) {
//     mes = '0' + mes;
// }

// document.getElementById('text_finicio').value = anio + "-" + mes + "-" + d;
// document.getElementById('text_ffin').value = anio + "-" + mes + "-" + d;


    </script>

<?php
    }else{
        header("Location:".conexionBD::ruta()."view/404/mant_error.php");
    }
    }else{
        header("Location:".conexionBD::ruta()."view/404/mant_error.php");
    }
?>