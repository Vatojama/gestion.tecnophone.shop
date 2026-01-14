<?php 

	require '../../model/modelo_reporte_servicio.php';
	$MRSE = new Modelo_Reporte_Servicio();//instaciamopsç
	$consulta = $MRSE->Listar_select_Anio_Servicio();//llamamos al modelo
	echo json_encode($consulta);
	

 ?>