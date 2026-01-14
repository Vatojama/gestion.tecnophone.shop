<?php
require '../../model/modelo_venta.php';
$MV = new Modelo_Venta();
$term = isset($_GET['q']) ? $_GET['q'] : '';
$idalmac = isset($_GET['idalmac']) ? $_GET['idalmac'] : '';
$consulta = $MV->Listar_Selec_Productos_en_combo($term, $idalmac);
echo json_encode($consulta);
?>
