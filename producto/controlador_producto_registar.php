<?php
header('Content-Type: application/json; charset=utf-8');
ob_start();

try {
	require '../../model/modelo_producto.php';
	$MP = new Modelo_Producto();

	$producto = htmlspecialchars($_POST['producto'], ENT_QUOTES, 'UTF-8');
	$marca = htmlspecialchars($_POST['marca'], ENT_QUOTES, 'UTF-8');
	$categoria = htmlspecialchars($_POST['categoria'], ENT_QUOTES, 'UTF-8');
	$stock = htmlspecialchars($_POST['stock'], ENT_QUOTES, 'UTF-8');
	$pcompra = htmlspecialchars($_POST['pcompra'], ENT_QUOTES, 'UTF-8');
	$pventa = htmlspecialchars($_POST['pventa'], ENT_QUOTES, 'UTF-8');
	$cod_gene = htmlspecialchars($_POST['cod_gene'], ENT_QUOTES, 'UTF-8');
	$provee = htmlspecialchars($_POST['provee'], ENT_QUOTES, 'UTF-8');
	$nombrefoto = htmlspecialchars($_POST['nombrefoto'], ENT_QUOTES, 'UTF-8');
	$unidadmedida = htmlspecialchars($_POST['unidadmedida'], ENT_QUOTES, 'UTF-8');
	$selectImei = htmlspecialchars($_POST['selectImei'], ENT_QUOTES, 'UTF-8');
	$verentienda = htmlspecialchars($_POST['verentienda'], ENT_QUOTES, 'UTF-8');
	$descrip_p = htmlspecialchars($_POST['descrip_p'], ENT_QUOTES, 'UTF-8');
	$sucurid = htmlspecialchars($_POST['sucurid'], ENT_QUOTES, 'UTF-8');
	$almaid = htmlspecialchars($_POST['almaid'], ENT_QUOTES, 'UTF-8');
	$prec_comercia = htmlspecialchars($_POST['prec_comercia'], ENT_QUOTES, 'UTF-8');
	$prec_mayor = htmlspecialchars($_POST['prec_mayor'], ENT_QUOTES, 'UTF-8');

	$ruta = empty($nombrefoto) ? 'controller/producto/foto/default.png' : 'controller/producto/foto/' . $nombrefoto;

	$consulta = $MP->Registrar_Producto($producto, $marca, $categoria, $stock, $pcompra, $pventa, $cod_gene, $provee, $ruta, $unidadmedida, $selectImei, $verentienda, $descrip_p, $sucurid, $almaid, $prec_comercia, $prec_mayor);

	if ($consulta > 0) {
		if (!empty($nombrefoto) && isset($_FILES['foto'])) {
			if (!is_dir("foto/")) {
				mkdir("foto/", 0777, true);
			}
			move_uploaded_file($_FILES['foto']['tmp_name'], "foto/" . $nombrefoto);
		}
	}

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




?>