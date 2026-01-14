<?php 

	
    require '../../model/modelo_producto.php';
    $MP = new Modelo_Producto();

	$imei_valid_i= htmlspecialchars($_POST['imei_valid_i'],ENT_QUOTES,'UTF-8');
	
	$consulta = $MP->Validar_Imei_reingresar_venta($imei_valid_i);//llamamos al metodo del modelo
	echo $consulta;

 ?>