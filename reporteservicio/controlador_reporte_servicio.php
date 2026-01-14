<?php
header('Content-Type: application/json; charset=utf-8');
ob_start();

try {
    require_once '../../model/modelo_reporte_servicio.php';
    $MRS = new Modelo_Reporte_Servicio();

    $fecha_inicio = isset($_POST['finicio']) ? $_POST['finicio'] : '';
    $fecha_fin = isset($_POST['ffin']) ? $_POST['ffin'] : '';
    $idtecnico = isset($_POST['idtecnico']) ? $_POST['idtecnico'] : 0;

    $consulta = $MRS->Listar_Servicio_fechas_tecnico($fecha_inicio, $fecha_fin, $idtecnico);

    ob_clean();
    echo json_encode($consulta);

} catch (Throwable $e) {
    ob_clean();
    echo json_encode("Error del servidor: " . $e->getMessage());
}
