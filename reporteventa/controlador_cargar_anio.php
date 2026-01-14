<?php 

	require '../../model/modelo_reporte_venta.php';
	$MRVE = new Modelo_Reporte_Venta();//instaciamops
	$consulta = $MRVE->Listar_select_Anio_Venta_mes();//llamamos al modelo
	echo json_encode($consulta);
	

 ?>