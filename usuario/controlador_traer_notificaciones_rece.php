<?php 

	require '../../model/modelo_recepcion.php';
	$MU = new Modelo_Recepcion();//instaciamops
	$consulta = $MU->Listar_Notificaiones();//llamamos al modelo
	echo json_encode($consulta);
	

 ?>