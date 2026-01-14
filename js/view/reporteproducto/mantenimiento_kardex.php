<?php
session_start();
    require_once("../../model/modelo_conexion.php");
    require_once("../../model/modelo_rol.php");
    $rol = new Modelo_Rol();
    $datos = $rol->validar_menu_x_rol($_SESSION['S_ROL'],25);// EL 9 ES MENU GASTOS
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
    						<h6 class="card-title" style="text-align:center"><b>Kardex</b></h6>
    						<div class="card-tools">
    							<button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
    								<i class="fas fa-minus"></i>
    							</button>

    						</div>
    					</div>
    					<div class="card-body">
    						<div class="row">
    							<div class="col-7">
    								<label for="">Producto</label>
    								<select class="form-control form-control-sm js-example-basic-single" id="select_producto" style="width: 100%"> </select>
    							</div>

    							<div class="col-2">
    								<label for="">&nbsp;</label><br>
    								<button class="btn btn-info btn-sm" onclick="llamarKardex();"><i class="fas fa-search"></i></button>

    							</div>

    						</div><br>
    						<div class="row">
    							<div class="col-12 table-responsive">
    								<table id="tabla_reporte_kardex" class="display compact" style="width: 100%">
    									<thead style="background:#343A40; color:white;" class="small text left">
    										<tr>
    											<th style="background:white;"></th>
    											<th style="background:white;"></th>
    											<th style="background:white;"></th>
    											<th style="background:#789395;"></th>
    											<th style="background:#789395;">Entradas</th>
    											<th style="background:#789395;"></th>
    											<th style="background:#BB6464;"></th>
    											<th style="background:#BB6464;">Salidas</th>
    											<th style="background:#BB6464;"></th>
    											<th style="background:#041C32;"></th>
    											<th style="background:#041C32;">Existencias</th>
    											<th style="background:#041C32;"></th>
    										</tr>
    										<tr>
    											<th>Producto</th>
    											<th>Fecha</th>
    											<th>Detalle</th>

    											<th>Cantidad</th>
    											<th>Precio U.</th>
    											<th>Total</th>

    											<th>Cantidad</th>
    											<th>Precio V.</th>
    											<th>Total</th>

    											<th>Stock</th>
    											<th>Precio U.</th>
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
















    <script>
    	//para el diseño del combo
    	$(document).ready(function() {
    		$('.js-example-basic-single').select2();


    	});
    	cargar_Select_Productos();

    	function llamarKardex() {
    		Listar_kardex();
    		validar();
    	}



    	function validar() {
    		let producto = document.getElementById('select_producto').value;
    		if (producto.length == 0) {
    			return Swal.fire("Mensaje de Advertencia", "Seleccione un producto", "warning");
    		}
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