<?php
header('Content-Type: application/json; charset=utf-8');
ob_start();

try {
	require_once '../../model/modelo_reporte_venta.php';
	$MRVE = new Modelo_Reporte_Venta();

	$usuario = isset($_POST['usuario']) ? htmlspecialchars($_POST['usuario'], ENT_QUOTES, 'UTF-8') : '';
	$anio = isset($_POST['anio']) ? htmlspecialchars($_POST['anio'], ENT_QUOTES, 'UTF-8') : '';
	$sucursa = isset($_POST['sucursa']) ? htmlspecialchars($_POST['sucursa'], ENT_QUOTES, 'UTF-8') : '';

	$consulta = $MRVE->Listar_Record_usuario_Detallado($usuario, $anio, $sucursa);

	ob_clean();
	if ($consulta) {
		echo json_encode($consulta);
	} else {
		echo json_encode([
			"sEcho" => 1,
			"iTotalRecords" => "0",
			"iTotalDisplayRecords" => "0",
			"aaData" => []
		]);
	}

} catch (Throwable $e) {
	if (ob_get_length())
		ob_clean();
	echo json_encode([
		"error" => true,
		"message" => $e->getMessage(),
		"aaData" => []
	]);
}
?>