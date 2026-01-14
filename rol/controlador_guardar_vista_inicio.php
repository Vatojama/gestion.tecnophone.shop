<?php 

	require '../../model/modelo_rol.php';
	$MR = new Modelo_Rol();//instaciamops
	$sel_vista_ini= htmlspecialchars($_POST['sel_vista_ini'],ENT_QUOTES,'UTF-8');
    $rolid_vi= htmlspecialchars($_POST['rolid_vi'],ENT_QUOTES,'UTF-8');
	//$estado= htmlspecialchars($_POST['e'],ENT_QUOTES,'UTF-8');

	$consulta = $MR->Registrar_Vista_Inicio($sel_vista_ini,  $rolid_vi);//llamamos al modelo
	echo $consulta;

 ?>