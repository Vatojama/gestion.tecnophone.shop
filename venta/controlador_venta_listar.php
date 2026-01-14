<?php 

	require '../../model/modelo_venta.php';
	$MV = new Modelo_Venta();//instaciamopsç

	$finicio= htmlspecialchars($_POST['finicio'],ENT_QUOTES,'UTF-8');
	$ffin= htmlspecialchars($_POST['ffin'],ENT_QUOTES,'UTF-8');
	$idusuario_ventas= htmlspecialchars($_POST['idusuario_ventas'],ENT_QUOTES,'UTF-8');

	$consulta = $MV->Listar_Venta($finicio,$ffin, $idusuario_ventas);//llamamos al modelo
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