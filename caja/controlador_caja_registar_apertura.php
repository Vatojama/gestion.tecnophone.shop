<?php
header('Content-Type: application/json; charset=utf-8');
ob_start();

require '../../model/modelo_caja.php';
$MCAJA = new Modelo_Caja(); //instaciamos

$descripcion = htmlspecialchars($_POST['descripcion'], ENT_QUOTES, 'UTF-8');
$monto = htmlspecialchars($_POST['monto'], ENT_QUOTES, 'UTF-8');
$sucurid = htmlspecialchars($_POST['sucurid'], ENT_QUOTES, 'UTF-8');

$consulta = $MCAJA->Registrar_Apertura_caja($descripcion, $monto, $sucurid); //llamamos al metodo del modelo
ob_clean();
echo json_encode($consulta);