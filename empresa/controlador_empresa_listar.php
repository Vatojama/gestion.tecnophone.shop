<?php 

	require '../../model/modelo_empresa.php';
	$MEMP = new Modelo_Empresa();//instaciamops
	$consulta = $MEMP->Listar_Empresa();//llamamos al modelo
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