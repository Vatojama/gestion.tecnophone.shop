<?php
require '../../model/modelo_tienda.php';
$MTIE = new Modelo_Tienda();
$titulo= htmlspecialchars($_POST['titulo'],ENT_QUOTES,'UTF-8');
$descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : '';

if (!empty($descripcion)) {
    $consulta = $MTIE->Registrar_Servicio($titulo, $descripcion);
    echo $consulta;
} else {
    echo "error";
}
?>