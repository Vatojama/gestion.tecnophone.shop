<?php 

	require '../../model/modelo_tienda.php';
	$MTIE = new Modelo_Tienda();//instaciamos
	$consulta = $MTIE->Listar_Servicio_tabla();//llamamos al modelo
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