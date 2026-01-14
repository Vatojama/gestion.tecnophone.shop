<?php 

	require '../../model/modelo_venta.php';
	$MV = new Modelo_Venta();//instaciamopsç

	$idventa= htmlspecialchars($_POST['idventa'],ENT_QUOTES,'UTF-8');
	 

	$consulta = $MV->Listar_Abonos_Venta($idventa);//llamamos al modelo
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