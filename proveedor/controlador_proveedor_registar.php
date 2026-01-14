<?php
header('Content-Type: application/json; charset=utf-8');
ob_start();

try {
    require '../../model/modelo_proveedor.php';
    $MPRV = new Modelo_Proveedor();

    $ruc = htmlspecialchars($_POST['ruc'], ENT_QUOTES, 'UTF-8');
    $razon = htmlspecialchars($_POST['razon'], ENT_QUOTES, 'UTF-8');
    $direccion = htmlspecialchars($_POST['direccion'], ENT_QUOTES, 'UTF-8');
    $celular = htmlspecialchars($_POST['celular'], ENT_QUOTES, 'UTF-8');
    $lista_negra = htmlspecialchars($_POST['lista_negra'], ENT_QUOTES, 'UTF-8');

    $consulta = $MPRV->Registrar_Proveedor($ruc, $razon, $direccion, $celular, $lista_negra);

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