<?php 

	require '../../model/modelo_venta.php';
	$MV = new Modelo_Venta();//instaciamopsç

	$id= htmlspecialchars($_POST['id'],ENT_QUOTES,'UTF-8');
	$estado= htmlspecialchars($_POST['estado'],ENT_QUOTES,'UTF-8');


	$consulta = $MV->Pagar_Venta($id,$estado);//llamamos al metodo del modelo
	echo $consulta;

 ?>