<?php
header('Content-Type: application/json; charset=utf-8');
ob_clean();

require '../../model/modelo_notas.php';
$MNT = new Modelo_Notas();
$idusuario = htmlspecialchars($_POST['idusuario'], ENT_QUOTES, 'UTF-8');

$consulta = $MNT->Listar_Notas_por_usuario($idusuario);
echo json_encode($consulta);