<?php
// 1. Incluimos tu conexión real para probar la ruta y la clase
require_once 'model/modelo_conexion.php'; 

try {
    echo "<h2>--- Diagnóstico de Conexión a Base de Datos ---</h2>";
    
    // 2. Intentamos conectar usando tu lógica de PDO
    $instancia = new conexionBD();
    $pdo = $instancia->conexionPDO();
    
    if ($pdo) {
        echo "<p style='color:green;'>✅ ÉXITO: Conexión establecida con el servidor de OVH.</p>";
        
        // 3. Probamos ejecutar un Procedimiento Almacenado (SP)
        // Usamos uno que ya tienes definido en tu modelo
        $sql = "CALL SP_LISTAR_SELECT_ROL()"; 
        $query = $pdo->prepare($sql);
        
        if ($query->execute()) {
            $resultado = $query->fetchAll();
            echo "<p style='color:green;'>✅ ÉXITO: El procedimiento almacenado se ejecutó correctamente.</p>";
            echo "<b>Datos encontrados:</b> " . count($resultado) . " roles en la tabla.";
        } else {
            echo "<p style='color:red;'>❌ ERROR: La conexión sirve, pero no tienes permisos para ejecutar Procedimientos Almacenados (SPs).</p>";
            print_r($query->errorInfo());
        }
    }
} catch (PDOException $e) {
    echo "<p style='color:red;'>❌ ERROR CRÍTICO: No se pudo conectar a la base de datos.</p>";
    echo "Detalle: " . $e->getMessage();
}
?>