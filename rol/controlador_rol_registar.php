<?php 

	require '../../model/modelo_rol.php';
	$MR = new Modelo_Rol();//instaciamops
	$rol= htmlspecialchars($_POST['rol'],ENT_QUOTES,'UTF-8');
	//$estado= htmlspecialchars($_POST['e'],ENT_QUOTES,'UTF-8');

	$consulta = $MR->Registrar_Rol($rol);//llamamos al modelo
	echo $consulta;

 ?>