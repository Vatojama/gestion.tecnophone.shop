<?php
header('Content-Type: application/json; charset=utf-8');
ob_clean();
require '../../model/modelo_recepcion.php';
$MREC = new Modelo_Recepcion();//instaciamops

$sucurid = htmlspecialchars($_POST['sucurid'], ENT_QUOTES, 'UTF-8');

$consulta = $MREC->Listar_select_Cliente($sucurid);//llamamos al modelo
echo json_encode($consulta);
?>