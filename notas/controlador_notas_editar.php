<?php
header('Content-Type: application/json; charset=utf-8');
ob_clean();

require '../../model/modelo_notas.php';
$MNT = new Modelo_Notas();
$idnotas_e = htmlspecialchars($_POST['idnotas_e'], ENT_QUOTES, 'UTF-8');
$notas_e = htmlspecialchars($_POST['notas_e'], ENT_QUOTES, 'UTF-8');

$consulta = $MNT->Modificar_Notas($idnotas_e, $notas_e);
echo json_encode($consulta);