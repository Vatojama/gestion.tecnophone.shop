<?php
header('Content-Type: application/json; charset=utf-8');
ob_clean();

require '../../model/modelo_caja.php';
$MCAJA = new Modelo_Caja(); //instaciamos
$sucurid = htmlspecialchars($_POST['sucurid'], ENT_QUOTES, 'UTF-8');

$consulta = $MCAJA->Listar_Total_Ventas($sucurid); //llamamos al modelo
echo json_encode($consulta);