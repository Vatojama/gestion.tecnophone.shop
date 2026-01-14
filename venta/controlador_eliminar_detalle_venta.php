<?php
require '../../model/modelo_venta.php';
$MV = new Modelo_Venta();
$idventa = htmlspecialchars($_POST['idventa'], ENT_QUOTES, 'UTF-8');
$idproducto = htmlspecialchars($_POST['idproducto'], ENT_QUOTES, 'UTF-8');
$cantidad = htmlspecialchars($_POST['cantidad'], ENT_QUOTES, 'UTF-8');
$idimei = htmlspecialchars($_POST['idimei'], ENT_QUOTES, 'UTF-8');
$sucurid = htmlspecialchars($_POST['sucurid'], ENT_QUOTES, 'UTF-8');
$iddetalle = htmlspecialchars($_POST['iddetalle'], ENT_QUOTES, 'UTF-8');

$consulta = $MV->Eliminar_Detalle_Venta($idventa, $idproducto, $cantidad, $idimei, $sucurid, $iddetalle);
echo $consulta;
?>