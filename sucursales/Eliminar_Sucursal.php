<?php

	require '../../model/modelo_sucursales.php';
	$MSUC = new Modelo_Sucursales();//instaciamos
$idsuc = htmlspecialchars($_POST['idsuc'], ENT_QUOTES, 'UTF-8');



$consulta = $MSUC->Eliminar_Sucursales($idsuc); //llamamos al metodo del modelo
echo json_encode($consulta);

?>