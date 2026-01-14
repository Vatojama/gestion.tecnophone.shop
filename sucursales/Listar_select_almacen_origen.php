<?php 

	require '../../model/modelo_sucursales.php';
	$MSUC = new Modelo_Sucursales();//instaciamos
	$consulta = $MSUC->Listar_select_Almacen_Origen();//llamamos al modelo
	echo json_encode($consulta);
	

 ?>