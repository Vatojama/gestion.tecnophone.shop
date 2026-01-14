<?php
header('Content-Type: application/json; charset=utf-8');
ob_start();

try {
	require '../../model/modelo_venta.php';
	$MV = new Modelo_Venta();

	$idcliente = htmlspecialchars($_POST['idcliente'], ENT_QUOTES, 'UTF-8');
	$compro = htmlspecialchars($_POST['compro'], ENT_QUOTES, 'UTF-8');
	$serie = htmlspecialchars($_POST['serie'], ENT_QUOTES, 'UTF-8');
	$numero = htmlspecialchars($_POST['numero'], ENT_QUOTES, 'UTF-8');
	$impuesto = htmlspecialchars($_POST['impuesto'], ENT_QUOTES, 'UTF-8');
	$total = htmlspecialchars($_POST['total'], ENT_QUOTES, 'UTF-8');
	$tipo = htmlspecialchars($_POST['tipo'], ENT_QUOTES, 'UTF-8');
	$porcentaje = htmlspecialchars($_POST['porcentaje'], ENT_QUOTES, 'UTF-8');
	$idusuario = htmlspecialchars($_POST['idusuario'], ENT_QUOTES, 'UTF-8');
	$idformapago = htmlspecialchars($_POST['idformapago'], ENT_QUOTES, 'UTF-8');
	$observacion = htmlspecialchars($_POST['observacion'], ENT_QUOTES, 'UTF-8');

	$monto_efectiv = htmlspecialchars($_POST['monto_efectiv'], ENT_QUOTES, 'UTF-8');
	$cod_opera = htmlspecialchars($_POST['cod_opera'], ENT_QUOTES, 'UTF-8');
	$monto_tarje = htmlspecialchars($_POST['monto_tarje'], ENT_QUOTES, 'UTF-8');
	$cajaid_v = htmlspecialchars($_POST['cajaid_v'], ENT_QUOTES, 'UTF-8');
	$totaldesct = htmlspecialchars($_POST['totaldesct'], ENT_QUOTES, 'UTF-8');
	$sucurid = htmlspecialchars($_POST['sucurid'], ENT_QUOTES, 'UTF-8');
	$almaid = htmlspecialchars($_POST['almaid'], ENT_QUOTES, 'UTF-8');
	$rolid = htmlspecialchars($_POST['rolid'], ENT_QUOTES, 'UTF-8');

	$consulta = $MV->Registrar_Venta($idcliente, $compro, $serie, $numero, $impuesto, $total, $tipo, $porcentaje, $idusuario, $idformapago, $observacion, $monto_efectiv, $cod_opera, $monto_tarje, $cajaid_v, $totaldesct, $sucurid, $almaid, $rolid);

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