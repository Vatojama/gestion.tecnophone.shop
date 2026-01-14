<?php 

	require '../../model/modelo_rol.php';
	$MR = new Modelo_Rol();//instaciamops
	$id= htmlspecialchars($_POST['id'],ENT_QUOTES,'UTF-8');
	$rol= htmlspecialchars($_POST['rol'],ENT_QUOTES,'UTF-8');
	$estado= htmlspecialchars($_POST['estado'],ENT_QUOTES,'UTF-8');

	$consulta = $MR->Modificar_Rol($id,$rol,$estado);//llamamos al modelo
	echo $consulta;

 ?>