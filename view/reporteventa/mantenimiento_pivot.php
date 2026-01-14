<?php
session_start();
    require_once("../../model/modelo_conexion.php");
    require_once("../../model/modelo_rol.php");
    $rol = new Modelo_Rol();
    $datos = $rol->validar_menu_x_rol($_SESSION['S_ROL'],22);// EL 9 ES MENU GASTOS
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
    						<h6 class="card-title" style="text-align:center"><b>Pivot Ventas</b></h6>
    						<div class="card-tools">
    							<button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
    								<i class="fas fa-minus"></i>
    							</button>

    						</div>
    					</div>
    					<div class="card-body">
    						 <div class="row">

                                 <div class="col-lg-6 col-sm-6">

    								<label form="">Sucursal</label>
    								<select class="form-control form-control-sm js-example-basic-single" id="select_sucur_pivot" style="width: 100%"> </select>
    							</div>
                                 <div class="col-lg-2 col-sm-2">
                                    <label for="">&nbsp;</label><br>
                                    <button class="btn btn-info btn-sm" id="btn_venta_anio_total"><i class="fas fa-search"></i></button>
                                </div>

                            </div><br>
    						<div class="row">
    							<div class="col-12 table-responsive">
    								<table id="tabla_pivot_ventas" class="display compact" style="width:100%">
    									<thead style="background:#343A40; color:white" class="small text left">
    										<tr>
    											<th>Año</th>
    											<th>Enero </th>
    											<th>Febrero</th>
    											<th>Marzo</th>
    											<th>Abril</th>
    											<th>Mayo</th>
    											<th>Junio</th>
    											<th>Julio</th>
    											<th>Agosto</th>
    											<th>Setiembre</th>
    											<th>Octubre</th>
    											<th>Noviembre</th>
    											<th>Diciembre</th>
    											<th>Total</th>
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



    <section class="content">
    	<div class="container-fluid">
    		<div class="row">
    			<div class="col-12">

    				<div class="card">
    					<div class="card-header">
    						<h6 class="card-title" style="text-align:center"><b>Record por Año de Usuarios</b></h6>
    						<div class="card-tools">
    							<button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
    								<i class="fas fa-minus"></i>
    							</button>

    						</div>
    					</div>
    					<div class="card-body">
    						<div class="row">

    							<div class="col-lg-5 col-8">

    								<label form="">Año</label>
    								<select class="form-control form-control-sm js-example-basic-single" id="select_anio_venta_record_u" style="width: 100%">

    								</select>
    							</div>
								  <div class="col-lg-5 col-sm-6">

    								<label form="">Sucursal</label>
    								<select class="form-control form-control-sm js-example-basic-single" id="select_sucur_pivot_anio" style="width: 100%"> </select>
    							</div>

    							<div class="col-lg-2 col-4">
    								<label for="">&nbsp;</label><br>
    								<button class="btn btn-info btn-sm" id="btnrecod_anio_sucu"><i class="fas fa-search"></i></button>
    							</div>

    						</div><br>
    						<div class="row">
    							<div class="col-12 table-responsive">
    								<table id="tabla_reporte_record_venta_usuario" class="display compact"  style="display:none">
    									<thead style="background:#343A40; color:white" class="small text left">
    										<tr>
    											<th>Sucursal</th>
												<th>Año</th>
    											<th>Usuario</th>
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
    						<h6 class="card-title" style="text-align:center"><b>Record de Ventas por Usuarios</b></h6>
    						<div class="card-tools">
    							<button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
    								<i class="fas fa-minus"></i>
    							</button>

    						</div>
    					</div>
    					<div class="card-body">
    						<div class="row">

    							<div class="col-lg-3 col-5">
    								<label for="">Usuario</label>
    								<select class="form-control form-control-sm js-example-basic-single" id="select_usuario" style="width: 100%"> </select>
    							</div>

    							<div class="col-lg-3 col-5">
    								<label for="">Año</label>
    								<select class="form-control form-control-sm js-example-basic-single" id="select_anio_usuario" style="width: 100%"> </select>
    							</div>
								 <div class="col-lg-4 col-sm-6">

    								<label form="">Sucursal</label>
    								<select class="form-control form-control-sm js-example-basic-single" id="select_sucur_pivot_usuario" style="width: 100%"> </select>
    							</div>

    							<div class="col-lg-2 col-2">
    								<label for="">&nbsp;</label><br>
    								<button class="btn btn-info btn-sm" id="btnrecord_usuario" onclick=""><i class="fas fa-search"></i></button>

    							</div>

    						</div><br>
    						<div class="row">
    							<div class="col-12 table-responsive">
    								<table id="tabla_record_usuario_a" class="display compact" style="display:none">
    									<thead style="background:#343A40; color:white" class="small text left">
    										<tr>
    											<th>Sucursal</th>
												<th>Año</th>
    											<th>Mes</th>
    											<th>Usuario</th>
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
			 cargar_SelectSucursales_pivot()

    		cargar_SelectAnio_record_usu();
    		cargar_SelectAnio_Venta_usua_detallado();
    		cargar_Select_Usuarios();

    		//Listar_pivot_ventas();

    		//Listar_record_Venta_anio();
    		//Listar_record_usuario();

    		$('#btnrecord_usuario').click(function() {
				let sucursa = document.getElementById('select_sucur_pivot_usuario').value;
				let usuario = document.getElementById('select_usuario').value;
				let anio = document.getElementById('select_anio_usuario').value;
				if (usuario.length == 0) {
					return Swal.fire("Mensaje de Advertencia", "Seleccione un Usuario", "warning");
				}
				if (anio.length == 0) {
					return Swal.fire("Mensaje de Advertencia", "Seleccione un Año", "warning");
				}
				if (sucursa.length == 0) {
					return Swal.fire("Mensaje de Advertencia", "Seleccione una sucursal", "warning");
				}else{
					$("#tabla_record_usuario_a").show();
					Listar_record_usuario();
					
				}
    			


    		});

			$('#btn_venta_anio_total').click(function() {
				let sucursa = document.getElementById('select_sucur_pivot').value;
				if (sucursa.length == 0) {
					return Swal.fire("Mensaje de Advertencia", "Seleccione una sucursal", "warning");
				}else{
					Listar_pivot_ventas();
					//$("#tabla_pivot_ventas").show();
				}
    		});



			$('#btnrecod_anio_sucu').click(function() {
				let anio = document.getElementById('select_anio_venta_record_u').value;
				let sucursa = document.getElementById('select_sucur_pivot_anio').value;
				if (sucursa.length == 0) {
					return Swal.fire("Mensaje de Advertencia", "Seleccione una sucursal", "warning");
				}else if (anio.length == 0) {
    				return Swal.fire("Mensaje de Advertencia", "Seleccione un Año", "warning");
    			}else{
					$("#tabla_reporte_record_venta_usuario").show();
					Listar_record_Venta_anio();
					
				}
    		});



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