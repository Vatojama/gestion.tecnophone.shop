<?php
header('Content-Type: application/json; charset=utf-8');
ob_start();

try {
	require '../../model/modelo_venta.php';
	$MV = new Modelo_Venta();

	$id = htmlspecialchars($_POST['id'], ENT_QUOTES, 'UTF-8');
	$producto = htmlspecialchars($_POST['producto'], ENT_QUOTES, 'UTF-8');
	$cantidad = htmlspecialchars($_POST['cantidad'], ENT_QUOTES, 'UTF-8');
	$precio = htmlspecialchars($_POST['precio'], ENT_QUOTES, 'UTF-8');
	$imei_r = htmlspecialchars($_POST['imei_r'], ENT_QUOTES, 'UTF-8');
	$descuent_p = htmlspecialchars($_POST['descuent_p'], ENT_QUOTES, 'UTF-8');
	$idalmac = htmlspecialchars($_POST['idalmac'], ENT_QUOTES, 'UTF-8');
	$idsucu = htmlspecialchars($_POST['idsucu'], ENT_QUOTES, 'UTF-8');
	$idimeiventa = htmlspecialchars($_POST['idimeiventa'], ENT_QUOTES, 'UTF-8');

	$array_producto = explode(",", $producto);
	$array_cantidad = explode(",", $cantidad);
	$array_precio = explode(",", $precio);
	$array_imei = explode(",", $imei_r);
	$array_descnt = explode(",", $descuent_p);
	$array_idimeiv = explode(",", $idimeiventa);

	$final_result = 0;
	for ($i = 0; $i < count($array_producto); $i++) {
		$consulta = $MV->Registrar_Detalle_Venta($id, $array_producto[$i], $array_cantidad[$i], $array_precio[$i], $array_imei[$i], $array_descnt[$i], $idalmac, $idsucu, $array_idimeiv[$i]);
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