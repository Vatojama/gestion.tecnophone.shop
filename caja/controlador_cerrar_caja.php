<?php
header('Content-Type: application/json; charset=utf-8');
ob_start();

require '../../model/modelo_caja.php';
$MCAJA = new Modelo_Caja(); //instaciamos

$monto_ventas = htmlspecialchars($_POST['monto_ventas'], ENT_QUOTES, 'UTF-8');
$cant_ventas = htmlspecialchars($_POST['cant_ventas'], ENT_QUOTES, 'UTF-8');
$monto_gasto = htmlspecialchars($_POST['monto_gasto'], ENT_QUOTES, 'UTF-8');
$cant_gasto = htmlspecialchars($_POST['cant_gasto'], ENT_QUOTES, 'UTF-8');
$monto_total = htmlspecialchars($_POST['monto_total'], ENT_QUOTES, 'UTF-8');
$monto_servicio = htmlspecialchars($_POST['monto_servicio'], ENT_QUOTES, 'UTF-8');
$cant_servicio = htmlspecialchars($_POST['cant_servicio'], ENT_QUOTES, 'UTF-8');

$monto_ingre = htmlspecialchars($_POST['monto_ingre'], ENT_QUOTES, 'UTF-8');
$cant_ingre = htmlspecialchars($_POST['cant_ingre'], ENT_QUOTES, 'UTF-8');
$idcaja = htmlspecialchars($_POST['idcaja'], ENT_QUOTES, 'UTF-8');
$montoabono = htmlspecialchars($_POST['montoabono'], ENT_QUOTES, 'UTF-8');


$consulta = $MCAJA->Registrar_Cierre_caja($monto_ventas, $cant_ventas, $monto_gasto, $cant_gasto, $monto_total, $monto_servicio, $cant_servicio, $monto_ingre, $cant_ingre, $idcaja, $montoabono); //llamamos al metodo del modelo
ob_clean();
echo json_encode($consulta);