<?php
// Script para listar columnas de la tabla USUARIO
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/model/modelo_conexion.php';

echo "<h1>Estructura de Tabla USUARIO</h1>";

try {
    $pdo = conexionBD::conexionPDO();
    $stmt = $pdo->query("DESCRIBE usuario");
    $columns = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo "<table border='1'>";
    echo "<tr><th>Field</th><th>Type</th><th>Null</th><th>Key</th></tr>";
    foreach ($columns as $col) {
        echo "<tr>";
        echo "<td>" . $col['Field'] . "</td>";
        echo "<td>" . $col['Type'] . "</td>";
        echo "<td>" . $col['Null'] . "</td>";
        echo "<td>" . $col['Key'] . "</td>";
        echo "</tr>";
    }
    echo "</table>";

} catch (PDOException $e) {
    echo "<span style='color:red'>[ERROR] " . $e->getMessage() . "</span>";
}
?>