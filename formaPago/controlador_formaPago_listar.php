<?php 

	require '../../model/modelo_formaPago.php';
	$MFPG = new Modelo_Forma_Pago();//instaciamops
	$consulta = $MFPG->Listar_Forma_Pago();//llamamos al modelo
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