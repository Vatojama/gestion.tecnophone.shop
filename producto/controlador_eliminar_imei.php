<?php 


	require '../../model/modelo_producto.php';
	$MP = new Modelo_Producto();

	$id_pr_e= htmlspecialchars($_POST['id_pr_e'],ENT_QUOTES,'UTF-8');
	$imei_e= htmlspecialchars($_POST['imei_e'],ENT_QUOTES,'UTF-8');
	$almid= htmlspecialchars($_POST['almid'],ENT_QUOTES,'UTF-8');


	$consulta = $MP->Eliminar_imei_disminuir($id_pr_e,$imei_e, $almid);//llamamos al metodo del modelo
	echo $consulta;

 ?>