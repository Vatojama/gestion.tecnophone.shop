<?php
header('Content-Type: application/json; charset=utf-8');
ob_start();

try {
	require '../../model/modelo_producto.php';
	$MP = new Modelo_Producto();

	$id = htmlspecialchars($_POST['id'], ENT_QUOTES, 'UTF-8');
	$cantidad = htmlspecialchars($_POST['cantidad'], ENT_QUOTES, 'UTF-8');
	$total = htmlspecialchars($_POST['total'], ENT_QUOTES, 'UTF-8');
	$almacenid = htmlspecialchars($_POST['almacenid'], ENT_QUOTES, 'UTF-8');

	$consulta = $MP->Aumentar_Stock($id, $cantidad, $total, $almacenid);

	ob_clean();
	echo json_encode($consulta);
} catch (Exception $e) {
	ob_clean();
	echo json_encode([
		"status" => "error",
		"message" => $e->getMessage()
	]);
}
?>