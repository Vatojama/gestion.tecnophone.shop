<?php 

	require '../../model/modelo_venta.php';
	$MV = new Modelo_Venta();//instaciamopsç

	$iddetcredito= htmlspecialchars($_POST['iddetcredito'],ENT_QUOTES,'UTF-8');


	$consulta = $MV->Eliminar_Item_abono_venta($iddetcredito);//llamamos al metodo del modelo
	echo $consulta;

 ?>