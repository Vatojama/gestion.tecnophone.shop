<?php 

	require '../../model/modelo_rol.php';
	$MR = new Modelo_Rol();//instaciamops
	$mend_id= htmlspecialchars($_POST['mend_id'],ENT_QUOTES,'UTF-8');


	$consulta = $MR->Deshabilitar_permiso($mend_id);//llamamos al modelo
	echo $consulta;

 ?>