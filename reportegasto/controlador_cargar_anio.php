<?php
header('Content-Type: application/json; charset=utf-8');
ob_start();

try {
	require_once '../../model/modelo_reporte_gasto.php';
	$MRGA = new Modelo_Reporte_Gasto();

	$consulta = $MRGA->Listar_select_Anio_Gasto();

	ob_clean();
	echo json_encode($consulta);

} catch (Throwable $e) {
	if (ob_get_length())
		ob_clean();
	echo json_encode([
		"error" => true,
		"message" => $e->getMessage()
	]);
}
?>