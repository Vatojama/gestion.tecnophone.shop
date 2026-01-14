<?php 

	require '../../model/modelo_venta.php';
	$MV = new Modelo_Venta();//instaciamopsç
	$consulta = $MV->Listar_Selec_Comprobante();//llamamos al modelo
	echo json_encode($consulta);
	

 ?>