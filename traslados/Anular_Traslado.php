<?php 

	require '../../model/modelo_traslado.php';
	$MTR = new Modelo_Traslados();//instaciamos

	$traslado_id= htmlspecialchars($_POST['traslado_id'],ENT_QUOTES,'UTF-8');
	$usuario_id= htmlspecialchars($_POST['usuario_id'],ENT_QUOTES,'UTF-8');


	$consulta = $MTR->Anular_Traslado($traslado_id, $usuario_id);//llamamos al metodo del modelo
	echo json_encode($consulta);

 ?>