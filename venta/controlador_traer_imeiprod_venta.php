<?php 

	require '../../model/modelo_venta.php';
	$MV = new Modelo_Venta();//instaciamos
    $id_pro= htmlspecialchars($_POST['id_pro'],ENT_QUOTES,'UTF-8');
	

	$consulta = $MV->Traer_Imei_pro($id_pro);//llamamos al modelo
	echo json_encode($consulta);
    //echo $consulta;
	

 ?>