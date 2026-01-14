<?php 

	
	require '../../model/modelo_producto.php';
	
	$MP = new Modelo_Producto();//instaciamops
	$idprodt_au= htmlspecialchars($_POST['idprodt_au'],ENT_QUOTES,'UTF-8');
	$imei_au= htmlspecialchars($_POST['imei_au'],ENT_QUOTES,'UTF-8');
	$almacenid= htmlspecialchars($_POST['almacenid'],ENT_QUOTES,'UTF-8');

	$consulta = $MP->Insertar_imei_prod_aumentar($idprodt_au, $imei_au, $almacenid );//llamamos al modelo
	echo $consulta;

	
 ?>