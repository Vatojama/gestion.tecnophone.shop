<?php 

	require '../../model/modelo_recepcion.php';
	$MREC = new Modelo_Recepcion();//instaciamops
	$consulta = $MREC->Listar_select_Tecnicos();//llamamos al modelo
	echo json_encode($consulta);
	

 ?>