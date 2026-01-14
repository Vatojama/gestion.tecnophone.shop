<?php
header('Content-Type: application/json; charset=utf-8');
ob_clean();

require '../../model/modelo_notas.php';
$MNT = new Modelo_Notas();
$id = htmlspecialchars($_POST['id'], ENT_QUOTES, 'UTF-8');

$consulta = $MNT->Eliminar_Notas($id);
echo json_encode($consulta);