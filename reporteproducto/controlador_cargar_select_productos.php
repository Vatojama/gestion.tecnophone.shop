<?php 

	require '../../model/modelo_reporte_producto.php';
	$MRPR = new Modelo_Reporte_Producto();//instaciamops
	$consulta = $MRPR->Listar_select_Producto();//llamamos al modelo
	echo json_encode($consulta);
	

 ?>