<?php 

    require '../../model/modelo_reporte_venta.php';
    $MRVE = new Modelo_Reporte_Venta();//instaciamos
	$consulta = $MRVE->Listar_select_Usuarios();//llamamos al modelo
	echo json_encode($consulta);
	

 ?>