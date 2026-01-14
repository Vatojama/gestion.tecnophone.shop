<?php

	require '../../model/modelo_sucursales.php';
	$MSUC = new Modelo_Sucursales();//instaciamos

$descripcion = htmlspecialchars($_POST['descripcion'], ENT_QUOTES, 'UTF-8');
$abrevia = htmlspecialchars($_POST['abrevia'], ENT_QUOTES, 'UTF-8');


$consulta = $MSUC->Registrar_Almacenes($descripcion, $abrevia); //llamamos al metodo del modelo
echo json_encode($consulta);

?>