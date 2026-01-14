<?php 

	require '../../model/modelo_comprobante.php';
	$MCOMP = new Modelo_Comprobante();//instaciamops
	$consulta = $MCOMP->Listar_Comprobante();//llamamos al modelo
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