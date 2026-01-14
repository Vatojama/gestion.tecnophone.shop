<?php
session_start();
    require_once("../../model/modelo_conexion.php");
    require_once("../../model/modelo_rol.php");
    $rol = new Modelo_Rol();
    $datos = $rol->validar_menu_x_rol($_SESSION['S_ROL'],21);// EL 9 ES MENU GASTOS
    //var_dump($datos);
     if (isset($_SESSION['S_IDUSUARIO']))  {
  
        if(is_array($datos) and count($datos)>0){
?>
    <script src="../js/reporteventa.js?rev=<?php echo time(); ?>"></script>
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

                    <div class="card">
                        <div class="card-header">
                            <h6 class="card-title" style="text-align:center"><b>Reporte de Ventas del dia</b></h6>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                    <i class="fas fa-minus"></i>
                                </button>

                            </div>
                        </div>
                        <div class="card-body">

                            <div class="row">

                                <div class="col-3">
                                    <label for="">Fecha Inicio</label>
                                    <input type="date" name="" id="text_finicio" class="form-control  form-control-sm">
                                </div>
                                <div class="col-3">
                                    <label for="">Fecha Fin</label>
                                    <input type="date" name="" id="text_ffin" class="form-control  form-control-sm">
                                </div>
                                
								<div class="col-lg-4 col-sm-6">

    								<label form="">Sucursal</label>
    								<select class="form-control form-control-sm js-example-basic-single" id="select_sucur" style="width: 100%"> </select>
    							</div>
                                <div class="col-2">
                                    <label for="">&nbsp;</label><br>
                                    <button class="btn btn-info btn-sm" id="btn_venta_del_dia"  ><i class="fas fa-search"></i></button>

                                </div>

                            </div><br>
                            <div class="row">
                                <div class="col-12 table-responsive">
                                    <table id="tabla_reporte_venta_del_dia" class="display compact" style="display:none">
                                        <thead style="background:#343A40; color:white" class="small text left">
                                            <tr>
                                                <th>Sucursal</th>
                                                <th>Fecha</th>
                                                <th>Tipo C.</th>
                                                <th>Comprobante</th>
                                                <th style="width:25%">Cliente</th>
                                                <th>Base Imp.</th>
                                                <th>IGV</th>
                                                <th>Total</th>
                                                <th>Usuario</th>

                                            </tr>
                                        </thead>
                                        <tbody class="small text left">
    									</tbody>
                                        <tfoot>
                                            <tr>
                                                <th></th>
                                                 <th></th>
                                                <th></th>
                                                <th></th>
                                                <th>Totales S/: </th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>




    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">

                    <div class="card">
                        <div class="card-header">
                            <h6 class="card-title" style="text-align:center"><b>Reporte por Mes y Año Ventas</b></h6>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                    <i class="fas fa-minus"></i>
                                </button>

                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">

                                <div class="col-3">
                                    <label for="">Mes</label>
                                    <select class="form-control form-control-sm js-example-basic-single" id="select_mes_venta" style="width: 100%">
                                        <option value="">Seleccione</option>
                                        <option value="1">Enero</option>
                                        <!--iniciar el select 2 en el script -->
                                        <option value="2">Febrero</option>
                                        <option value="3">Marzo</option>
                                        <option value="4">Abril</option>
                                        <option value="5">Mayo</option>
                                        <option value="6">Junio</option>
                                        <option value="7">Julio</option>
                                        <option value="8">Agosto</option>
                                        <option value="9">Septiembre</option>
                                        <option value="10">Octubre</option>
                                        <option value="11">Noviembre</option>
                                        <option value="12">Diciembre</option>
                                    </select>
                                </div>

                                <div class="col-3">
                                    <label for="">Año</label>
                                    <select class="form-control form-control-sm js-example-basic-single" id="select_anio_venta" style="width: 100%"> </select>
                                </div>
                                <div class="col-lg-4 col-sm-6">

    								<label form="">Sucursal</label>
    								<select class="form-control form-control-sm js-example-basic-single" id="select_sucur_anio" style="width: 100%"> </select>
    							</div>

                                <div class="col-2">
                                    <label for="">&nbsp;</label><br>
                                    <button class="btn btn-info btn-sm" id="btn_venta_mes_anio"><i class="fas fa-search"></i></button>

                                </div>

                            </div><br>
                            <div class="row">
                                <div class="col-12 table-responsive">
                                    <table id="tabla_reporte_venta_mes" class="display compact"  style="display:none">
                                        <thead style="background:#343A40; color:white" class="small text left">
                                            <tr>
                                                <th>Sucursal</th>
                                                <th>Cliente</th>
                                                <th>Comprobante</th>
                                                <th>Monto</th>
                                                <th>Cant Productos</th>
                                                <th>Fecha</th>
                                                <th>usuario</th>
                                            </tr>
                                        </thead>
                                        <tbody class="small text left">
    									</tbody>
                                        <tfoot>
                                            <tr>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>



    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">

                    <div class="card">
                        <div class="card-header">
                            <h6 class="card-title" style="text-align:center"><b>Reporte por Año de ventas</b></h6>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                    <i class="fas fa-minus"></i>
                                </button>

                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">



                                <div class="col-5">
                                    <label for="">Año</label>
                                    <select class="form-control form-control-sm js-example-basic-single" id="select_anio_venta02" style="width: 100%"> </select>
                                </div>
                                 <div class="col-lg-5 col-sm-6">

    								<label form="">Sucursal</label>
    								<select class="form-control form-control-sm js-example-basic-single" id="select_sucur_anio_total" style="width: 100%"> </select>
    							</div>
                                 <div class="col-lg-2 col-sm-2">
                                    <label for="">&nbsp;</label><br>
                                    <button class="btn btn-info btn-sm" id="btn_venta_anio_total"><i class="fas fa-search"></i></button>
                                </div>

                            </div><br>
                            <div class="row">
                                <div class="col-12 table-responsive">
                                    <table id="tabla_reporte_venta_anio" class="display compact"  style="display:none">
                                        <thead style="background:#343A40; color:white" class="small text left">
                                            <tr>
                                                <th>Sucursal</th>
                                                 <th>Año</th>
                                                <th>Mes</th>
                                                <th>Cant. Ventas </th>
                                                <th>Total</th>
                                            </tr>
                                        </thead>
                                        <tbody class="small text left">
    									</tbody>
                                        <tfoot>
                                            <tr>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>

                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>



    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">

                    <div class="card">
                        <div class="card-header">
                            <h6 class="card-title" style="text-align:center"><b>Reporte Total Anual</b></h6>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                    <i class="fas fa-minus"></i>
                                </button>

                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                            </div><br>
                            <div class="row">
                                <div class="col-12 table-responsive">
                                    <table id="tabla_reportetotal_anual" class="display compact">
                                        <thead style="background:#343A40; color:white">
                                            <tr>
                                                <th>Año</th>
                                                <th>Cant. Ventas </th>
                                                <th>Total</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>






    <script>
        //para el diseño del combo
        $(document).ready(function() {
            $('.js-example-basic-single').select2();

            cargar_SelectSucursales();

            cargar_SelectAnio_VentaMes();
           // Listar_VentaMes_anio();
            Listar_ReporteVentaTotalAnio();
            cargar_SelectAnioVenta();
           // Listar_Venta_anioM();
           // Listar_Venta_del_dia();


            $("#btn_venta_del_dia").on('click', function() {
                var finicio = document.getElementById('text_finicio').value;
                var ffin = document.getElementById('text_ffin').value;
                 let sucursa = document.getElementById('select_sucur').value;

                if (finicio.length == 0 || ffin.length == 0) {
                    return Swal.fire("Mensaje de Advertencia", "Seleccione una Fecha de inicio y de fin", "warning");
                }

                if (finicio > ffin) {
                    return Swal.fire("Mensaje de Advertencia", "La fecha de inicio no puede ser mayor a la fecha fin", "warning");
                }
               
                    if (sucursa.length == 0) {
                        return Swal.fire("Mensaje de Advertencia", "Seleccione una sucursal", "warning");
                    } 
                    else {
                        $("#tabla_reporte_venta_del_dia").show();
                        Listar_Venta_del_dia();
                    }
            });

         $("#btn_venta_mes_anio").on('click', function() {
                var mes = document.getElementById('select_mes_venta').value;
                var anio = document.getElementById('select_anio_venta').value;
                 let sucursa = document.getElementById('select_sucur_anio').value;

                if (mes == 0) {
                    return Swal.fire("Mensaje de Advertencia", "Seleccione una mes", "warning");
                }

                if (anio == 0) {
                    return Swal.fire("Mensaje de Advertencia", "Seleccione un año", "warning");
                }
            
                if (sucursa.length == 0) {
                    return Swal.fire("Mensaje de Advertencia", "Seleccione una sucursal", "warning");
                } 
                else {
                    $("#tabla_reporte_venta_mes").show();
                    Listar_VentaMes_anio();
                }
        });

         $("#btn_venta_anio_total").on('click', function() {
               
                var anio = document.getElementById('select_anio_venta02').value;
                 let sucursa = document.getElementById('select_sucur_anio_total').value;

                if (anio == 0) {
                    return Swal.fire("Mensaje de Advertencia", "Seleccione un año", "warning");
                }
            
                if (sucursa.length == 0) {
                    return Swal.fire("Mensaje de Advertencia", "Seleccione una sucursal", "warning");
                } 
                else {
                    $("#tabla_reporte_venta_anio").show();
                    Listar_Venta_anioM();
                }
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

        document.getElementById('text_finicio').value = anio + "-" + mes + "-" + d;
        document.getElementById('text_ffin').value = anio + "-" + mes + "-" + d;


    </script>

<?php
    }else{
        header("Location:".conexionBD::ruta()."view/404/mant_error.php");
    }
    }else{
        header("Location:".conexionBD::ruta()."view/404/mant_error.php");
    }
?>