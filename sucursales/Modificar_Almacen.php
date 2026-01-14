<?php

	require '../../model/modelo_sucursales.php';
	$MSUC = new Modelo_Sucursales();//instaciamos

$idalma = htmlspecialchars($_POST['idalma'], ENT_QUOTES, 'UTF-8');
$descripcion = htmlspecialchars($_POST['descripcion'], ENT_QUOTES, 'UTF-8');
$abrevia = htmlspecialchars($_POST['abrevia'], ENT_QUOTES, 'UTF-8');
$estado = htmlspecialchars($_POST['estado'], ENT_QUOTES, 'UTF-8');

$consulta = $MSUC->Modificar_Almacenes($idalma, $descripcion, $abrevia, $estado); //llamamos al metodo del modelo
echo json_encode($consulta);

?>