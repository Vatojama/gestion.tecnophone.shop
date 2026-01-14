<?php 

	require '../../model/modelo_comprobante.php';
	$MCOMP = new Modelo_Comprobante();//instaciamops
	
	$tipo= htmlspecialchars($_POST['tipo'],ENT_QUOTES,'UTF-8');
	$serie= htmlspecialchars($_POST['serie'],ENT_QUOTES,'UTF-8');
	$numeroc= htmlspecialchars($_POST['numeroc'],ENT_QUOTES,'UTF-8');

	$consulta = $MCOMP->Registrar_Comprobante($tipo,$serie,$numeroc);//llamamos al metodo del modelo
	echo $consulta;

 ?>