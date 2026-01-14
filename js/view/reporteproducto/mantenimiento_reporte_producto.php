<?php
session_start();
    require_once("../../model/modelo_conexion.php");
    require_once("../../model/modelo_rol.php");
    $rol = new Modelo_Rol();
    $datos = $rol->validar_menu_x_rol($_SESSION['S_ROL'],23);// validar que el rol tenga acceso a la pagina
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
    						<h6 class="card-title" style="text-align:center"><b>Reporte Entrada y Salidas de productos</b></h6>
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
    								<select class="form-control form-control-sm js-example-basic-single" id="select_sucur" style="width: 100%"> </select>
    							</div>

    							<div class="col-lg-2 col-2">
    								<label for="">&nbsp;</label><br>
    								<button class="btn btn-info btn-sm" id="btnrentrada_y_salida"><i class="fas fa-search"></i></button>

    							</div>

    						</div><br>
    						<div class="row">
    							<div class="col-12 table-responsive">
    								<table id="tabla_reporte_producto_ensal" class="display compact" style="display:none">
    									<thead style="background:#343A40; color:white ;width: 100%" class="small text left">
    										<tr>
    											<th>Codigo</th>
    											<th>Producto</th>
    											<!-- <th>Precio U.</th> -->
    											<!-- <th>Ingresos</th>
    											<th>Salidas</th> -->
    											<th>Stock Actual</th>
    											<th>Opcion</th>
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
    											<!-- <th></th>
    											<th></th>
    											<th></th> -->
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



    <!-- Modal MOVIMIENTOS POR IMEI  -->
    <div class="modal fade" id="modal_ver_movimientos_pro_con_imei" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
    					<div class="col-lg-8   col-12">

    						<label>Producto:</label>
    						<input type="text" id="text_producto_mov" class="form-control form-control-sm" placeholder="producto" disabled>
    					</div>

						<div class="col-lg-4   col-12">

    						<label>Stock:</label>
    						<input type="text" id="text_producto_st_imei" class="form-control form-control-sm" placeholder="Stock" disabled>
    					</div>

    				</div>

    				<div class="row">
    					<div class="col-12 table-responsive"><br>
    						<table id="tabla_detalle_movimientos_pro" class="display" style="width: 100%">
    							<thead style="background: #4f5962;color: #ffffff;" class="small text left">
    								<tr>
    									<th>CODIGO</th>
    									<th>COMPROBANTE</th>
    									<th>CONCEPTO</th>
    									<th>FECHA</th>
    									<th>INGRESOS</th>
    									<th>SALIDAS</th>
    									<th>IMEI</th>


    								</tr>
    							</thead>
    							<tbody class="small text left">
    							</tbody>

    						</table>
    						<br>

    					</div>

    				</div>
    			</div>
    			<div class="modal-footer">
    				<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>

    			</div>
    		</div>
    	</div>
    </div>
    <!-- fin Modal -->


    <!-- Modal MOVIMIENTOS POR TECNICO -->
    <div class="modal fade" id="modal_ver_movimientos_pro_con_tecnico" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
    					<div class="col-lg-8  col-12">

    						<label>Producto:</label>
    						<input type="text" id="text_producto_mov_tecni" class="form-control form-control-sm" placeholder="producto" disabled>
    					</div>
						<div class="col-lg-4   col-12">

    						<label>Stock:</label>
    						<input type="text" id="text_producto_st" class="form-control form-control-sm" placeholder="Stock" disabled>
    					</div>


    				</div>

    				<div class="row">
    					<div class="col-12 table-responsive"><br>
    						<table id="tabla_detalle_movimientos_pro_tecnico" class="display" style="width: 100%">
    							<thead style="background: #4f5962;color: #ffffff;" class="small text left">
    								<tr>
    									<th>CODIGO</th>
    									<th>COMPROBANTE</th>
    									<th>CONCEPTO</th>
    									<th>FECHA</th>
    									<th>INGRESOS</th>
    									<th>SALIDAS</th>
    									<th>TECNICO</th>


    								</tr>
    							</thead>
    							<tbody class="small text left">
    							</tbody>

    						</table>
    						<br>

    					</div>

    				</div>
    			</div>
    			<div class="modal-footer">
    				<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>

    			</div>
    		</div>
    	</div>
    </div>
    <!-- fin Modal -->

	<!-- Modal DEALLE DE REPARACION  -->
    <div class="modal fade" id="modal_detalle_imei" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    	<div class="modal-dialog modal-lg" role="document">
    		<div class="modal-content">
    			<div class="modal-header" style="background:#343A40; color:white">
    				<h5 class="modal-title" id="exampleModalLabel">Detalles de Imei </h5> 
    				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
    					<span aria-hidden="true">&times;</span>
    				</button>
    			</div>
    			<div class="modal-body">
    				<div class="row">
    					<div class="col-lg-12   col-12">

    						<label>Articulo:</label>
    						<input type="text" id="text_art_desc" class="form-control form-control-sm" placeholder="producto" disabled>
    					</div>

    				</div>

    				<div class="row">
    					<div class="col-12 table-responsive"><br>
    						<table id="tabla_detalle_imei_ven" class="display" style="width: 100%">
    							<thead style="background: #4f5962;color: #ffffff;" class="small text left">
    								<tr>
    									<th>Imei</th>
    									<th>Vendido</th>
    								</tr>
    							</thead>
    							<tbody class="small text left">
    							</tbody>

    						</table>
    						<br>

    					</div>

    				</div>
    			</div>
    			<div class="modal-footer">
    				<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>

    			</div>
    		</div>
    	</div>
    </div>
    <!-- fin Modal -->



    <script>
    	//para el diseño del combo
    	$(document).ready(function() {
    		$('.js-example-basic-single').select2();


			cargar_SelectSucursales();

			//Listar_Reporte_Producto_EnSal();

			$('#btnrentrada_y_salida').click(function() {
				
				let sucursa = document.getElementById('select_sucur').value;
				if (sucursa.length == 0) {
					return Swal.fire("Mensaje de Advertencia", "Seleccione una sucursal", "warning");
				}else{
					$("#tabla_reporte_producto_ensal").show();
					Listar_Reporte_Producto_EnSal();
					
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