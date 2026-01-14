<?php
require '../../model/modelo_tienda.php';
$MTIE = new Modelo_Tienda();
$idserv= htmlspecialchars($_POST['idserv'],ENT_QUOTES,'UTF-8');
$titulo= htmlspecialchars($_POST['titulo'],ENT_QUOTES,'UTF-8');
$descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : '';

if (!empty($descripcion)) {
    $consulta = $MTIE->Editar_Servicio($idserv, $titulo, $descripcion);
    echo $consulta;
} else {
    echo "error";
}
?>