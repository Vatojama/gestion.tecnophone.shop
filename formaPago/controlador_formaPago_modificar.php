<?php 

	require '../../model/modelo_formaPago.php';
	$MFPG = new Modelo_Forma_Pago();//instaciamops
	$id= htmlspecialchars($_POST['id'],ENT_QUOTES,'UTF-8');
	$formap= htmlspecialchars($_POST['formap'],ENT_QUOTES,'UTF-8');
	$estado= htmlspecialchars($_POST['estado'],ENT_QUOTES,'UTF-8');

	$consulta = $MFPG->Modificar_Forma_Pago($id,$formap,$estado);//llamamos al metodo del modelo
	echo $consulta;

 ?>