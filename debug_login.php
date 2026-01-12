<?php
// Script Simulador de Login 
// Muestra errores reales en pantalla en lugar de fallar en JSON
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

echo "<h1>Simulador de Login</h1>";
echo "<p>Cargando modelos...</p>";

// Rutas absolutas para evitar problemas
if (file_exists(__DIR__ . '/model/modelo_usuario.php')) {
    require_once __DIR__ . '/model/modelo_usuario.php';
    echo "<span style='color:green'>[OK] Modelo Usuario cargado.</span><br>";
} else {
    die("<span style='color:red'>[FATAL] No se encuentra model/modelo_usuario.php</span>");
}

echo "<hr>";

$usuario = 'admin';
$password = 'admin'; // Contraseña de prueba

echo "<p>Intentando VerificarUsuario('$usuario', '$password')...</p>";

try {
    $MU = new Modelo_Usuario();
    $consulta = $MU->VerificarUsuario($usuario, $password);

    echo "<h3>Resultado Raw (var_dump):</h3>";
    echo "<pre>";
    var_dump($consulta);
    echo "</pre>";

    if (count($consulta) > 0) {
        echo "<h2 style='color:green'>[EXITO] Login Exitoso. Datos recuperados.</h2>";
    } else {
        echo "<h2 style='color:orange'>[FALLO] Login fallido (Credenciales incorrectas o BD vacía).</h2>";
    }

} catch (Throwable $e) {
    echo "<h2 style='color:red'>[ERROR FATAL DE PHP]</h2>";
    echo "<strong>Mensaje:</strong> " . $e->getMessage() . "<br>";
    echo "<strong>Archivo:</strong> " . $e->getFile() . "<br>";
    echo "<strong>Linea:</strong> " . $e->getLine() . "<br>";
}
?>