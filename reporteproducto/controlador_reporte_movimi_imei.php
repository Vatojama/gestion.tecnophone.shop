<?php
header('Content-Type: application/json; charset=utf-8');
ob_start();

try {
    require_once '../../model/modelo_reporte_producto.php';
    $MRPR = new Modelo_Reporte_Producto();

    $pa_imei = isset($_POST['pa_imei']) ? htmlspecialchars($_POST['pa_imei'], ENT_QUOTES, 'UTF-8') : '';

    $consulta = $MRPR->Listar_Movimeintos_imei($pa_imei);

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
    if (ob_get_length())
        ob_clean();
    echo json_encode([
        "error" => true,
        "message" => $e->getMessage(),
        "aaData" => []
    ]);
}
?>