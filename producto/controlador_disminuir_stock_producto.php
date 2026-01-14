<?php 

	
	require '../../model/modelo_producto.php';
	$MP = new Modelo_Producto();//instaciamops
	$id= htmlspecialchars($_POST['id'],ENT_QUOTES,'UTF-8');
	$cantidad= htmlspecialchars($_POST['cantidad'],ENT_QUOTES,'UTF-8');
	$total= htmlspecialchars($_POST['total'],ENT_QUOTES,'UTF-8');
	$almacenid_d= htmlspecialchars($_POST['almacenid_d'],ENT_QUOTES,'UTF-8');

	$consulta = $MP->Disminuir_Stock($id,$cantidad, $total,$almacenid_d );//llamamos al modelo
	echo $consulta;

 ?>