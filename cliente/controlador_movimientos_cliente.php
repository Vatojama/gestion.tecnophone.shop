<?php 

	require '../../model/modelo_cliente.php';
	$MCL = new Modelo_Cliente();//instaciamops
    $clienteid = htmlspecialchars($_POST['clienteid'], ENT_QUOTES, 'UTF-8');
	$consulta = $MCL->Listar_Movimientos_Cliente($clienteid);//llamamos al modelo
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