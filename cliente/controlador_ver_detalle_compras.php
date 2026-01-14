<?php 

	require '../../model/modelo_cliente.php';
	$MCL = new Modelo_Cliente();//instaciamops

	$idprovee= htmlspecialchars($_POST['idprovee'],ENT_QUOTES,'UTF-8');
	$finicio= htmlspecialchars($_POST['finicio'],ENT_QUOTES,'UTF-8');
    $ffin= htmlspecialchars($_POST['ffin'],ENT_QUOTES,'UTF-8');

	$consulta = $MCL->Ver_detalle_Compras($idprovee, $finicio, $ffin);//llamamos al modelo
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