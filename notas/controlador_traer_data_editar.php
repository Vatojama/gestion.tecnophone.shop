<?php
header('Content-Type: application/json; charset=utf-8');
ob_clean();

require '../../model/modelo_notas.php';
$MNT = new Modelo_Notas();
$idnota = htmlspecialchars($_POST['idnota'], ENT_QUOTES, 'UTF-8');

$consulta = $MNT->Traer_Data_Notas_editar($idnota);
echo json_encode($consulta);