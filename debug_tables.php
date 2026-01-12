<?php
// Script para listar Tablas y Estructura de MENU
ini_set('display_errors', 1);
error_reporting(E_ALL);
require_once __DIR__ . '/model/modelo_conexion.php';

echo "<h1>Inspeccion de Base de Datos</h1>";

try {
    $pdo = conexionBD::conexionPDO();

    // 1. Listar todas las tablas
    echo "<h2>Tablas en la BD:</h2>";
    $tables = $pdo->query("SHOW TABLES")->fetchAll(PDO::FETCH_COLUMN);
    echo "<ul>";
    foreach ($tables as $table) {
        echo "<li>$table</li>";
    }
    echo "</ul>";

    // 2. Describir tablas probables de menu
    $possible_tables = ['menu', 'detalle_menu', 'modulo', 'permiso', 'rol_modulo'];

    foreach ($possible_tables as $tb) {
        if (in_array($tb, $tables)) {
            echo "<h3>Estructura de: $tb</h3>";
            $cols = $pdo->query("DESCRIBE $tb")->fetchAll(PDO::FETCH_ASSOC);
            echo "<table border='1'><tr><th>Field</th><th>Type</th><th>Key</th></tr>";
            foreach ($cols as $c) {
                echo "<tr><td>{$c['Field']}</td><td>{$c['Type']}</td><td>{$c['Key']}</td></tr>";
            }
            echo "</table>";
        }
    }

} catch (Exception $e) {
    echo "<h3 style='color:red'>[ERROR] " . $e->getMessage() . "</h3>";
}
?>