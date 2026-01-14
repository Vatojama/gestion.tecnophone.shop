<?php 

	
    require '../../model/modelo_producto.php';
    $MP = new Modelo_Producto();

	$imei_valid= htmlspecialchars($_POST['imei_valid'],ENT_QUOTES,'UTF-8');
	
	$consulta = $MP->Validar_Imei($imei_valid);//llamamos al metodo del modelo
	echo $consulta;

 ?>