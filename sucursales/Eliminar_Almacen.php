<?php

	require '../../model/modelo_sucursales.php';
	$MSUC = new Modelo_Sucursales();//instaciamos
$idalm = htmlspecialchars($_POST['idalm'], ENT_QUOTES, 'UTF-8');



$consulta = $MSUC->Eliminar_Almacen($idalm); //llamamos al metodo del modelo
echo json_encode($consulta);

?>