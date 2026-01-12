<?php
session_start();
require_once 'model/modelo_rol.php';

echo "<h2>🔍 DEBUG MENÚS MIGUEL</h2>";

echo "<h3>📋 Sesión Actual:</h3><pre>";
print_r($_SESSION);
echo "</pre>";

if (!isset($_SESSION['S_ROL'])) {
    die("<h3 style='color:red;'>❌ ERROR: Variable S_ROL no existe en sesión</h3>");
}

echo "<h3>🎭 Consultando menús para Rol ID: " . $_SESSION['S_ROL'] . "</h3>";

try {
    $rol = new Modelo_Rol();
    $datos = $rol->get_menu_x_rol($_SESSION['S_ROL']);
    
    echo "<h3>📊 Menús encontrados: <strong>" . count($datos) . "</strong></h3>";
    
    if (count($datos) > 0) {
        echo "<table border='1' cellpadding='10' style='border-collapse: collapse;'>";
        echo "<tr style='background: #4CAF50; color: white;'>";
        echo "<th>ID</th><th>Nombre</th><th>Ruta</th><th>Ícono</th><th>Permiso</th></tr>";
        
        foreach ($datos as $menu) {
            echo "<tr>";
            echo "<td>" . $menu['men_id'] . "</td>";
            echo "<td>" . $menu['men_vista'] . "</td>";
            echo "<td>" . $menu['men_ruta'] . "</td>";
            echo "<td>" . $menu['men_icon'] . "</td>";
            echo "<td>" . $menu['mend_permi'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "<h3 style='color:red;'>❌ NO SE ENCONTRARON MENÚS</h3>";
    }
    
    echo "<h3>🔍 Datos RAW:</h3><pre>";
    print_r($datos);
    echo "</pre>";
    
} catch (Exception $e) {
    echo "<h3 style='color:red;'>❌ ERROR: " . $e->getMessage() . "</h3>";
}
?>;
?>