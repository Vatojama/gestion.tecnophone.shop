<?php 

	require '../../model/modelo_formaPago.php';
	$MFPG = new Modelo_Forma_Pago();//instaciamops
	$formap= htmlspecialchars($_POST['formap'],ENT_QUOTES,'UTF-8');
	//$estado= htmlspecialchars($_POST['e'],ENT_QUOTES,'UTF-8');

	$consulta = $MFPG->Registrar_Forma_Pago($formap);//llamamos al metodo del modelo
	echo $consulta;

 ?>