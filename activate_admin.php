<?php
// Script para Activar usuario ADMIN
ini_set('display_errors', 1);
error_reporting(E_ALL);
require_once __DIR__ . '/model/modelo_conexion.php';

try {
    $pdo = conexionBD::conexionPDO();
    // Forzamos update con Collation explicita para asegurar
    $sql = "UPDATE usuario SET usu_estado = 'ACTIVO' WHERE usu_nombre COLLATE utf8mb4_general_ci = 'admin'";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        echo "<h1>[EXITO] Usuario 'admin' ha sido ACTIVADO.</h1>";
    } else {
        echo "<h1>[INFO] El usuario 'admin' ya estaba activo o no se encontro.</h1>";
    }
    echo "<h2>Ahora ve al login e ingresa con admin/admin.</h2>";

} catch (Exception $e) {
    echo "<h1 style='color:red'>[ERROR] " . $e->getMessage() . "</h1>";
}
?>