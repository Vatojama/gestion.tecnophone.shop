<?php 

	require '../../model/modelo_rol.php';
	$MR = new Modelo_Rol();//instaciamops
   // $idrol= htmlspecialchars($_POST['idrol'],ENT_QUOTES,'UTF-8');

	$consulta = $MR->Listar_select_Vista_ini();//llamamos al modelo
	echo json_encode($consulta);


 ?>