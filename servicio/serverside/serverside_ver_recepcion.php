<?php 
	require 'serverside.php';
	//llamamos al getobtener del serverside
	$table_data->getObtnerListadoVerRecepcionEnModal('view_listar_recepcion_en_servicio','rece_id',array('rece_id','referencia','cliente', 'modelo','concepto','monto','fecha','entrega','adelanto','debe','rece_fentrega', 'diagnostico_tecn',  'nombre_tecnico', 'idtecnico','id_sucu'));

	
 ?>