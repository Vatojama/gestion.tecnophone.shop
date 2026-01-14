<?php 

	require '../../model/modelo_caja.php';
	$MCAJA = new Modelo_Caja();//instaciamos

	$idcaja= htmlspecialchars($_POST['idcaja'],ENT_QUOTES,'UTF-8');


	$consulta = $MCAJA->Listar_venta_por_cajaid($idcaja);//llamamos al modelo
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