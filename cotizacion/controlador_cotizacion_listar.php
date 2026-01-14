<?php 

	require '../../model/modelo_cotizacion.php';
	$MCOT = new Modelo_Cotizacion();//instaciamops

	$finicio= htmlspecialchars($_POST['finicio'],ENT_QUOTES,'UTF-8');
	$ffin= htmlspecialchars($_POST['ffin'],ENT_QUOTES,'UTF-8');

	$consulta = $MCOT->Listar_Cotizacion($finicio,$ffin);//llamamos al modelo
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