<?php 

	require '../../model/modelo_producto.php';
	$MP = new Modelo_Producto();//instaciamops
	$consulta = $MP->Listar_select_Marca();//llamamos al modelo
	echo json_encode($consulta);
	

 ?>