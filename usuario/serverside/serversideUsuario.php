<?php 
	require 'serverside.php';
	//llamamos al getobtener del serverside
	$table_data->getObtnerListadoUsario('view_listar_usuario','usu_id',array('usu_id','usu_nombre','usu_contrasena','rol_id','rol_nombre','usu_estado','usu_email','usu_foto', 'id_sucu','nombre_su'));

	
 ?>