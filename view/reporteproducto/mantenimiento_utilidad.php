<?php
session_start();
    require_once("../../model/modelo_conexion.php");
    require_once("../../model/modelo_rol.php");
    $rol = new Modelo_Rol();
    $datos = $rol->validar_menu_x_rol($_SESSION['S_ROL'],24);// EL 9 ES MENU GASTOS
    //var_dump($datos);
     if (isset($_SESSION['S_IDUSUARIO']))  {
  
        if(is_array($datos) and count($datos)>0){
?>
    <script src="../js/reporteproducto.js?rev=<?php echo time(); ?>"></script>
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
    						<h6 class="card-title" style="text-align:center"><b>Reporte Utilidad por productos y ventas</b></h6>
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
							<select class="form-control form-control-sm js-example-basic-single" id="select_sucur_utili" style="width: 100%"> </select>
						</div>

						<div class="col-lg-2 col-2">
							<label for="">&nbsp;</label><br>
							<button class="btn btn-info btn-sm" id="btn_utilidad_prod"><i class="fas fa-search"></i></button>

						</div>

					</div><br>
    						<div class="row">
    							<div class="col-12 table-responsive">
    								<table id="tabla_reporte_utilidad" class="display compact" style="display:none">
    									<thead style="background:#343A40; color:white ;width: 100%" class="small text left">
    										<tr>

    											<th>Producto</th>
    											<th>Cant. Vendida</th>
    											<th>Comprobante</th>
												<th>Fecha</th>
												<th>Imei</th>
												<th>P. Venta</th>
    											<th>P. Unitario</th>
    											<th>Utilidad</th>
    											
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
    											<th>Total:</th>
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



    <script>
    	//para el diseño del combo
    	$(document).ready(function() {
    		$('.js-example-basic-single').select2();

			cargar_SelectSucursales_utilidad();


			
            $("#btn_utilidad_prod").on('click', function() {
                var finicio = document.getElementById('text_finicio').value;
                var ffin = document.getElementById('text_ffin').value;
                 let sucursa = document.getElementById('select_sucur_utili').value;

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
                        $("#tabla_reporte_utilidad").show();
                        Listar_Reporte_Utilidad();
                    }
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



    	});
    	//Listar_Reporte_Utilidad();
    </script>

<?php
    }else{
        header("Location:".conexionBD::ruta()."view/404/mant_error.php");
    }
    }else{
        header("Location:".conexionBD::ruta()."view/404/mant_error.php");
    }
?>