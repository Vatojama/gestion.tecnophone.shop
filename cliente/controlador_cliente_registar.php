<?php
header('Content-Type: application/json; charset=utf-8');
ob_start();

try {
    require_once '../../model/modelo_cliente.php';
    $MCL = new Modelo_Cliente();

    $nombre = isset($_POST['cliente_nombres']) ? htmlspecialchars($_POST['cliente_nombres'], ENT_QUOTES, 'UTF-8') : '';
    $dni = isset($_POST['cliente_dni']) ? htmlspecialchars($_POST['cliente_dni'], ENT_QUOTES, 'UTF-8') : '';
    $cel = isset($_POST['cliente_celular']) ? htmlspecialchars($_POST['cliente_celular'], ENT_QUOTES, 'UTF-8') : '';
    $direccion = isset($_POST['cliente_direccion']) ? htmlspecialchars($_POST['cliente_direccion'], ENT_QUOTES, 'UTF-8') : '';
    $apellidop = isset($_POST['cliente_ape_p']) ? htmlspecialchars($_POST['cliente_ape_p'], ENT_QUOTES, 'UTF-8') : '';
    $apellidom = isset($_POST['cliente_ape_m']) ? htmlspecialchars($_POST['cliente_ape_m'], ENT_QUOTES, 'UTF-8') : '';
    $correo = isset($_POST['cliente_correo']) ? htmlspecialchars($_POST['cliente_correo'], ENT_QUOTES, 'UTF-8') : '';
    $tipo_doc = isset($_POST['cliente_tipo_doc']) ? htmlspecialchars($_POST['cliente_tipo_doc'], ENT_QUOTES, 'UTF-8') : '';
    $sucurid = isset($_POST['id_sucu']) ? htmlspecialchars($_POST['id_sucu'], ENT_QUOTES, 'UTF-8') : '';
    $listanegra = isset($_POST['cliente_listanegra']) ? htmlspecialchars($_POST['cliente_listanegra'], ENT_QUOTES, 'UTF-8') : 'No';

    $consulta = $MCL->Registrar_Cliente($nombre, $dni, $cel, $direccion, $apellidop, $apellidom, $correo, $tipo_doc, $sucurid, $listanegra);

    ob_clean();
    echo json_encode($consulta);

} catch (Throwable $e) {
    ob_clean();
    echo json_encode("Error del servidor: " . $e->getMessage());
}