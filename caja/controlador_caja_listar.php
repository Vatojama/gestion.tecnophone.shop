<?php
header('Content-Type: application/json; charset=utf-8');
ob_start();

try {
	require_once '../../model/modelo_caja.php';
	$MCAJA = new Modelo_Caja();

	$finicio = isset($_POST['finicio']) ? htmlspecialchars($_POST['finicio'], ENT_QUOTES, 'UTF-8') : '';
	$ffin = isset($_POST['ffin']) ? htmlspecialchars($_POST['ffin'], ENT_QUOTES, 'UTF-8') : '';
	$sucurid = isset($_POST['sucurid']) ? htmlspecialchars($_POST['sucurid'], ENT_QUOTES, 'UTF-8') : '';
	$rolid = isset($_POST['rolid']) ? htmlspecialchars($_POST['rolid'], ENT_QUOTES, 'UTF-8') : '';

	$consulta = $MCAJA->Listar_Cajas($finicio, $ffin, $sucurid, $rolid);

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
	ob_clean();
	echo json_encode([
		"sEcho" => 1,
		"iTotalRecords" => "0",
		"iTotalDisplayRecords" => "0",
		"aaData" => [],
		"errorMessage" => $e->getMessage()
	]);
}