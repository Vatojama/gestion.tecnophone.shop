<?php
header('Content-Type: application/json; charset=utf-8');
ob_start();

try {
	require '../../model/modelo_producto.php';
	$MP = new Modelo_Producto();

	$id = htmlspecialchars($_POST['id'], ENT_QUOTES, 'UTF-8');
	$producto = htmlspecialchars($_POST['producto'], ENT_QUOTES, 'UTF-8');
	$sucurid = htmlspecialchars($_POST['sucurid'], ENT_QUOTES, 'UTF-8');
	$almaid = htmlspecialchars($_POST['almaid'], ENT_QUOTES, 'UTF-8');

	$array_producto = explode(",", $producto);

	$final_result = 0;
	for ($i = 0; $i < count($array_producto); $i++) {
		$consulta = $MP->Registrar_Detalle_Pro($id, $array_producto[$i], $sucurid, $almaid);
		if ($consulta > 0) {
			$final_result = $consulta;
		}
	}

	ob_clean();
	echo json_encode($final_result);
} catch (Exception $e) {
	ob_clean();
	echo json_encode([
		"status" => "error",
		"message" => $e->getMessage()
	]);
}
?>