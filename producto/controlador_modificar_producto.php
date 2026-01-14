<?php
header('Content-Type: application/json; charset=utf-8');
ob_start();

try {
	require '../../model/modelo_producto.php';
	$MP = new Modelo_Producto();

	$id = htmlspecialchars($_POST['id'], ENT_QUOTES, 'UTF-8');
	$producto = htmlspecialchars($_POST['producto'], ENT_QUOTES, 'UTF-8');
	$marca = htmlspecialchars($_POST['marca'], ENT_QUOTES, 'UTF-8');
	$categoria = htmlspecialchars($_POST['categoria'], ENT_QUOTES, 'UTF-8');
	$pcompra = htmlspecialchars($_POST['pcompra'], ENT_QUOTES, 'UTF-8');
	$pventa = htmlspecialchars($_POST['pventa'], ENT_QUOTES, 'UTF-8');
	$estado = htmlspecialchars($_POST['estado'], ENT_QUOTES, 'UTF-8');
	$cod_gene = htmlspecialchars($_POST['cod_gene'], ENT_QUOTES, 'UTF-8');
	$provee = htmlspecialchars($_POST['provee'], ENT_QUOTES, 'UTF-8');
	$unidadm = htmlspecialchars($_POST['unidadm'], ENT_QUOTES, 'UTF-8');
	$verentienda = htmlspecialchars($_POST['verentienda'], ENT_QUOTES, 'UTF-8');
	$descrip_p = htmlspecialchars($_POST['descrip_p'], ENT_QUOTES, 'UTF-8');
	$prec_comercia = htmlspecialchars($_POST['prec_comercia'], ENT_QUOTES, 'UTF-8');
	$prec_mayor = htmlspecialchars($_POST['prec_mayor'], ENT_QUOTES, 'UTF-8');
	$almaid = htmlspecialchars($_POST['almaid'], ENT_QUOTES, 'UTF-8');

	$consulta = $MP->Modificar_Producto($id, $producto, $marca, $categoria, $pcompra, $pventa, $estado, $cod_gene, $provee, $unidadm, $verentienda, $descrip_p, $prec_comercia, $prec_mayor, $almaid);

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