<?php
// Script para ver estructura de la tabla de permisos
ini_set('display_errors', 1);
error_reporting(E_ALL);
require_once __DIR__ . '/model/modelo_conexion.php';

echo "<h1>Estructura de Permisos (td_menu_detalle)</h1>";

try {
    $pdo = conexionBD::conexionPDO();

    $tables_to_check = ['td_menu_detalle', 'grupos', 'rol'];

    foreach ($tables_to_check as $tb) {
        echo "<h3>Tabla: $tb</h3>";
        try {
            $cols = $pdo->query("DESCRIBE $tb")->fetchAll(PDO::FETCH_ASSOC);
            echo "<table border='1'><tr><th>Field</th><th>Type</th><th>Key</th></tr>";
            foreach ($cols as $c) {
                echo "<tr><td>{$c['Field']}</td><td>{$c['Type']}</td><td>{$c['Key']}</td></tr>";
            }
            echo "</table>";
        } catch (PDOException $e) {
            echo "No se pudo leer $tb: " . $e->getMessage() . "<br>";
        }
    }

} catch (Exception $e) {
    echo "<h3 style='color:red'>[ERROR] " . $e->getMessage() . "</h3>";
}
?>