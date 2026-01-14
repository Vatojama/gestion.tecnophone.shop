<?php 

	require '../../model/modelo_sucursales.php';
	$MSUC = new Modelo_Sucursales();//instaciamos
	$consulta = $MSUC->Listar_Almacen_table();//llamamos al modelo
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