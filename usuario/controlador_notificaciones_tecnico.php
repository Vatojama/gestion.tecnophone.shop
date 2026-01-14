<?php 

	require '../../model/modelo_recepcion.php';
	$MU = new Modelo_Recepcion();//instaciamops
    $idtecnico= htmlspecialchars($_POST['idtecnico'],ENT_QUOTES,'UTF-8');
	$consulta = $MU->Listar_Notificaiones_Tecnico( $idtecnico);//llamamos al modelo
	echo json_encode($consulta);
	

 ?>