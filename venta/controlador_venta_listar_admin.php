<?php 

	require '../../model/modelo_venta.php';
	$MV = new Modelo_Venta();//instaciamopsç

	$finicio= htmlspecialchars($_POST['finicio'],ENT_QUOTES,'UTF-8');
	$ffin= htmlspecialchars($_POST['ffin'],ENT_QUOTES,'UTF-8');
	$sucurid= htmlspecialchars($_POST['sucurid'],ENT_QUOTES,'UTF-8');
	$almaid= htmlspecialchars($_POST['almaid'],ENT_QUOTES,'UTF-8');
	$rolid= htmlspecialchars($_POST['rolid'],ENT_QUOTES,'UTF-8');
	

	$consulta = $MV->Listar_Venta_Admin($finicio,$ffin,$sucurid,$almaid,$rolid);//llamamos al modelo
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