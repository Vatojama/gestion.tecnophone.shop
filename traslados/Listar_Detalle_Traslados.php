<?php 

	require '../../model/modelo_traslado.php';
	$MTR = new Modelo_Traslados();//instaciamos
    	$idtras= htmlspecialchars($_POST['idtras'],ENT_QUOTES,'UTF-8');
	$consulta = $MTR->Listar_Detalle_Traslados($idtras);//llamamos al modelo
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