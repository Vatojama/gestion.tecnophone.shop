<?php 

	require '../../model/modelo_venta.php';
	$MV = new Modelo_Venta();//instaciamopsç

	$idventa= htmlspecialchars($_POST['idventa'],ENT_QUOTES,'UTF-8');	
	$estado= htmlspecialchars($_POST['estado'],ENT_QUOTES,'UTF-8');
	$cajaid= htmlspecialchars($_POST['cajaid'],ENT_QUOTES,'UTF-8');

	$consulta = $MV->Modificar_estado_Venta($idventa, $estado, $cajaid);//llamamos al metodo del modelo
	echo $consulta;

 ?>