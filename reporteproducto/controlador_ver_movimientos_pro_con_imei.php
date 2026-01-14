<?php
header('Content-Type: application/json; charset=utf-8');
ob_start();

try {
	require_once '../../model/modelo_reporte_producto.php';
	$MRPR = new Modelo_Reporte_Producto();

	$idprod = isset($_POST['idprod']) ? htmlspecialchars($_POST['idprod'], ENT_QUOTES, 'UTF-8') : '';
	$idalma = isset($_POST['idalma']) ? htmlspecialchars($_POST['idalma'], ENT_QUOTES, 'UTF-8') : '';

	$consulta = $MRPR->Listar_Movimeintos_por_producto_imei($idprod, $idalma);

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