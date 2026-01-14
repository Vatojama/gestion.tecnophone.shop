<?php 

	require '../../model/modelo_usuario.php';
	$MU = new Modelo_Usuario();//instaciamops
	$consulta = $MU->Listar_usuario();//llamamos al modelo
	if ($consulta) {
		echo json_encode($consulta);
	}else{
		echo '{
			"sEcho" : 1,
			"iTotalRecords":"0",
			"iTotalDisplayRecords": "0",
			"aaData": []

		}';
	}


 ?>