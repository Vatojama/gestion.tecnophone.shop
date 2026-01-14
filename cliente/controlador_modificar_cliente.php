<?php
header('Content-Type: application/json; charset=utf-8');
ob_start();

try {
    require_once '../../model/modelo_cliente.php';
    $MCL = new Modelo_Cliente();

    $id = isset($_POST['id']) ? htmlspecialchars($_POST['id'], ENT_QUOTES, 'UTF-8') : '';
    $nombre = isset($_POST['nombre']) ? htmlspecialchars($_POST['nombre'], ENT_QUOTES, 'UTF-8') : '';
    $dni = isset($_POST['dni']) ? htmlspecialchars($_POST['dni'], ENT_QUOTES, 'UTF-8') : '';
    $cel = isset($_POST['cel']) ? htmlspecialchars($_POST['cel'], ENT_QUOTES, 'UTF-8') : '';
    $estado = isset($_POST['estado']) ? htmlspecialchars($_POST['estado'], ENT_QUOTES, 'UTF-8') : '';
    $direccion = isset($_POST['direccion']) ? htmlspecialchars($_POST['direccion'], ENT_QUOTES, 'UTF-8') : '';
    $apellidop = isset($_POST['apellidop']) ? htmlspecialchars($_POST['apellidop'], ENT_QUOTES, 'UTF-8') : '';
    $apellidom = isset($_POST['apellidom']) ? htmlspecialchars($_POST['apellidom'], ENT_QUOTES, 'UTF-8') : '';
    $correo = isset($_POST['correo']) ? htmlspecialchars($_POST['correo'], ENT_QUOTES, 'UTF-8') : '';
    $tipo_doc = isset($_POST['tipo_doc']) ? htmlspecialchars($_POST['tipo_doc'], ENT_QUOTES, 'UTF-8') : '';
    $listanegra = isset($_POST['listanegra']) ? htmlspecialchars($_POST['listanegra'], ENT_QUOTES, 'UTF-8') : 'No';

    $consulta = $MCL->Modificar_Cliente($id, $nombre, $dni, $cel, $estado, $direccion, $apellidop, $apellidom, $correo, $tipo_doc, $listanegra);

    ob_clean();
    echo json_encode($consulta);

} catch (Throwable $e) {
    ob_clean();
    echo json_encode("Error del servidor: " . $e->getMessage());
}