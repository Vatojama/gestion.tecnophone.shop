<?php 

	require '../../model/modelo_gasto.php';
	$MG = new Modelo_Gasto();//instaciamops
	$gasto= htmlspecialchars($_POST['gasto'],ENT_QUOTES,'UTF-8');
	$monto= htmlspecialchars($_POST['monto'],ENT_QUOTES,'UTF-8');
	$responsable= htmlspecialchars($_POST['responsable'],ENT_QUOTES,'UTF-8');
	$tipomov= htmlspecialchars($_POST['tipomov'],ENT_QUOTES,'UTF-8');
	$sucursalid= htmlspecialchars($_POST['sucursalid'],ENT_QUOTES,'UTF-8');
	$usuarioid= htmlspecialchars($_POST['usuarioid'],ENT_QUOTES,'UTF-8');

	$consulta = $MG->Registrar_Gasto($gasto,$monto,$responsable, $tipomov, $sucursalid, $usuarioid);//llamamos al metodo del modelo
	echo $consulta;

 ?>