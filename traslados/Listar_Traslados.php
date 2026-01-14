<?php 

	require '../../model/modelo_traslado.php';
	$MTR = new Modelo_Traslados();//instaciamos
	$consulta = $MTR->Listar_Traslados();//llamamos al modelo
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