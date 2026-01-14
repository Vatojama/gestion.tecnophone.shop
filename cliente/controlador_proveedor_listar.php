<?php 

	require '../../model/modelo_cliente.php';
	$MCL = new Modelo_Cliente();//instaciamops
	
$sucurid = htmlspecialchars($_POST['sucurid'], ENT_QUOTES, 'UTF-8');
$rolid = htmlspecialchars($_POST['rolid'], ENT_QUOTES, 'UTF-8');

	$consulta = $MCL->Listar_Proveedor($sucurid, $rolid);//llamamos al modelo
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