<?php
session_start();
    require_once("../../model/modelo_conexion.php");
    require_once("../../model/modelo_rol.php");
    $rol = new Modelo_Rol();
    $datos = $rol->validar_menu_x_rol($_SESSION['S_ROL'],27);// EL 9 ES MENU GASTOS
    //var_dump($datos);
     if (isset($_SESSION['S_IDUSUARIO']))  {
  
        if(is_array($datos) and count($datos)>0){
?>
<script src="../js/dashboard.js?rev=<?php echo time();?>"></script>
    <div class="content-header">
      <div class="container-fluid" >
        <div class="row mb-2">
          
          
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-3">
                            <label for="">Fecha Inicio</label>
                            <input type="date" name="" id="text_finicio" class="form-control  form-control-sm">
                        </div>
                        <div class="col-3">
                            <label for="">Fecha Fin</label>
                            <input type="date" name="" id="text_ffin" class="form-control  form-control-sm">
                        </div>
                         <div class="col-4" id="div_sucursal">
                                <label form="">Sucursal:</label>
                                <select class="form-control form-control-sm js-example-basic-single" id="select_sucur" style="width: 100%"> </select>
                        </div> 
                        <div class="col-2">
                            <label for="">&nbsp;</label><br>
                            <button class="btn btn-info btn-sm" style="width:100%" onclick="Traer_datos_widget_Graficos();"><i class="fas fa-search"></i></button><br><br>

                        </div>
                        <div class="col-lg-3 col-6">



                            <div class="small-box bg-info">
                                <div class="inner">
                                    <p style="font-size:16px;display: inline;margin: 0px;padding: 0px;  font-weight:normal;">
                                        <b>Ventas:</b>&nbsp;
                                    </p>
                                    <h3 style="font-size:19px;display: inline;margin: 0px;padding: 0px;  font-weight:normal;" id="lbl_ventas">&nbsp; 0</h3>

                                    <div>
                                        <p style="font-size:16px;display: inline;margin: 0px;padding: 0px;  font-weight:normal;">
                                            <b>Total:</b>&nbsp;
                                        </p>
                                        <h3 style="font-size:19px;display: inline;margin: 0px;padding: 0px;  font-weight:normal;" id="lbl_Cant_ventas">&nbsp; 0</h3>
                                    </div>
                                </div>
                                <div class="icon">

                                </div>
                                <a href="#" class="small-box-footer" ><i class="fas fa-arrow-circle-right"></i></a>
                                    <!-- <a href="#" class="small-box-footer" onclick="cargar_contenido('contenido_principal','venta/mantenimiento_venta.php')">Ir
                                    a Ventas <i class="fas fa-arrow-circle-right"></i></a> -->
                            </div>
                        </div>

                        <div class="col-lg-3 col-6">

                            <div class="small-box bg-success">
                                <div class="inner">
                                    <p style="font-size:16px;display: inline;margin: 0px;padding: 0px;  font-weight:normal;">
                                        <b>Servicios:</b>&nbsp;
                                    </p>
                                    <h3 style="font-size:19px;display: inline;margin: 0px;padding: 0px;  font-weight:normal;" id="lbl_servicio"> &nbsp;0</h3>

                                    <div>
                                        <p style="font-size:16px;display: inline;margin: 0px;padding: 0px;  font-weight:normal;">
                                            <b>Total:</b>&nbsp;
                                        </p>
                                        <h3 style="font-size:19px;display: inline;margin: 0px;padding: 0px;  font-weight:normal;" id="lbl_Cant_servicio">&nbsp;0</h3>
                                    </div>
                                </div>
                                <div class="icon">

                                </div>
                                <a href="#" class="small-box-footer" ><i class="fas fa-arrow-circle-right"></i></a>
                                    <!-- <a href="#" class="small-box-footer" onclick="cargar_contenido('contenido_principal','servicio/mantenimiento_servicio.php')">Ir
                                    a Servicios<i class="fas fa-arrow-circle-right"></i></a> -->
                            </div>
                        </div>

                        <div class="col-lg-3 col-6">

                            <div class="small-box bg-warning">
                                <div class="inner">
                                    <p style="font-size:16px;display: inline;margin: 0px;padding: 0px;  font-weight:normal;">
                                        <b>Gastos:</b>&nbsp;
                                    </p>
                                    <h3 style="font-size:19px;display: inline;margin: 0px;padding: 0px;  font-weight:normal;" id="lbl_gasto">&nbsp;0</h3>

                                    <div>
                                        <p style="font-size:16px;display: inline;margin: 0px;padding: 0px;  font-weight:normal;">
                                            <b>Total:</b>&nbsp;
                                        </p>
                                        <h3 style="font-size:19px;display: inline;margin: 0px;padding: 0px;  font-weight:normal;" id="lbl_Cant_gasto">&nbsp;0</h3>
                                    </div>
                                </div>
                                <div class="icon">

                                </div>
                                <a href="#" class="small-box-footer" ><i class="fas fa-arrow-circle-right"></i></a>
                                    <!-- <a href="#" class="small-box-footer" onclick="cargar_contenido('contenido_principal','gasto/mantenimiento_gasto.php')">Ver
                                    Gastos <i class="fas fa-arrow-circle-right"></i></a> -->
                            </div>
                        </div>

                        <div class="col-lg-3 col-6">

                            <div class="small-box bg-danger">
                                <div class="inner">

                                    <p style="font-size:16px;display: inline;margin: 0px;padding: 0px;  font-weight:normal;">
                                        <b>Productos:</b>&nbsp;
                                    </p>
                                    <h3 style="font-size:19px;display: inline;margin: 0px;padding: 0px;  font-weight:normal;" id="lbl_Cant_producto">&nbsp;0</h3>
                                    <div>
                                        <p style="font-size:16px;display: inline;margin: 0px;padding: 0px;  font-weight:normal;">
                                            &nbsp;</p>
                                        <h3 style="font-size:19px;display: inline;margin: 0px;padding: 0px;  font-weight:normal;">
                                            &nbsp;</h3>
                                    </div>
                                </div>
                                <div class="icon" style="font-size:10px">

                                </div>
                                <a href="#" class="small-box-footer" ><i class="fas fa-arrow-circle-right"></i></a>
                                    <!-- <a href="#" class="small-box-footer" onclick="cargar_contenido('contenido_principal','producto/mantenimiento_producto.php')">Ver
                                    Productos<i class="fas fa-arrow-circle-right"></i></a> -->
                            </div>
                        </div>


                        <div class="col-md-7">

                            <!-- BAR CHART -->
                            <div class="card card-info">
                                <div class="card-header">
                                    <h3 class="card-title">Sevicios</h3>

                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="chart">
                                        <canvas id="grafico_servicio" style="min-height: 250px; height: 400px; max-height: 250px; max-width: 100%;"></canvas>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->

                        </div>

                        <div class="col-md-5">

                            <!-- DATATABLET -->
                            <div class="card card-success">
                                <div class="card-header">
                                    <h3 class="card-title">Producto mas vendidos</h3>

                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12 table-responsive">
                                            <table id="tabla_productos_mas_vendidos" class="display compact">
                                                <thead>
                                                    <tr>
                                                        <th style="text-align: center;">Producto</th>
                                                        <th style="text-align: center;">Cantidad</th>
                                                    </tr>
                                                </thead>

                                            </table>

                                        </div>
                                    </div>
                                </div>
                                <!-- /.card-body  style="background:#343A40; color:white" -->
                            </div>
                            <!-- /.card -->

                        </div>


                        <div class="col-md-7">

                            <!-- BAR CHART -->
                            <div class="card card-info">
                                <div class="card-header">
                                    <h3 class="card-title">Gr&aacute;fico Ventas</h3>

                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="chart">
                                        <canvas id="grafico_ventas" style="min-height: 250px; height: 400px; max-height: 250px; max-width: 100%;"></canvas>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->

                        </div>


                        <div class="col-md-5">

                            <!-- DATATABLET -->
                            <div class="card card-danger">
                                <div class="card-header">
                                    <h3 class="card-title">Productos con poco Stock</h3>

                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12 table-responsive">
                                            <table id="tabla_productos_sin_stock" class="display compact">
                                                <thead>
                                                    <tr>
                                                        <th style="text-align: center;">Producto</th>
                                                        <th style="text-align: center;">Stock</th>
                                                    </tr>
                                                </thead>

                                            </table>

                                        </div>
                                    </div>
                                </div>
                                <!-- /.card-body  style="background:#343A40; color:white" -->
                            </div>
                            <!-- /.card -->

                        </div>

                    </div>
             
                </div><!-- /.container-fluid -->
            </div>






    <script>
  //para el diseño del combo
  $(document).ready(function() {

    cargar_SelectSucursales();
           

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
 });

 
  /**********************************************************************
                  LLAMAMOS A LAS DOS FUNCIONES WIDGET Y GRAFICO 
         ***********************************************************************/
        function Traer_datos_widget_Graficos() {
            Traer_datos_widget();
            Grafico_servicio();
            Grafico_ventas();
            Listar_Productos_Vendidos();
            Listar_Productos_Sin_Stock();
           
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