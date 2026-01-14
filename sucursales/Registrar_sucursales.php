<?php

	require '../../model/modelo_sucursales.php';
	$MSUC = new Modelo_Sucursales();//instaciamos

$razon = htmlspecialchars($_POST['razon'], ENT_QUOTES, 'UTF-8');
$ruc = htmlspecialchars($_POST['ruc'], ENT_QUOTES, 'UTF-8');
$telefono = htmlspecialchars($_POST['telefono'], ENT_QUOTES, 'UTF-8');
$direccion = htmlspecialchars($_POST['direccion'], ENT_QUOTES, 'UTF-8');
$correo = htmlspecialchars($_POST['correo'], ENT_QUOTES, 'UTF-8');
$id_almacen = htmlspecialchars($_POST['id_almacen'], ENT_QUOTES, 'UTF-8');


$consulta = $MSUC->Registrar_Sucursales( $razon, $ruc, $telefono, $direccion, $correo, $id_almacen); //llamamos al metodo del modelo
echo json_encode($consulta);

?>