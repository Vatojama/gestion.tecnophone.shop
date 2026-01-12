<?php
// Script de Diagnóstico de Conexión y Rutas
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

echo "<h1>Diagnostico del Sistema</h1>";

// 1. Prueba de Rutas
echo "<p>1. Verificando archivo de conexion...</p>";
$file_path = __DIR__ . '/model/modelo_conexion.php';

if (file_exists($file_path)) {
    echo "<span style='color:green'>[OK] Archivo encontrado en: $file_path</span><br>";
    require_once $file_path;
} else {
    echo "<span style='color:red'>[ERROR] Archivo NO encontrado en: $file_path</span><br>";
    die("Detenido por error de archivo.");
}

// 2. Prueba de Clase
echo "<p>2. Verificando Clase conexionBD...</p>";
if (class_exists('conexionBD')) {
    echo "<span style='color:green'>[OK] Clase conexionBD cargada.</span><br>";
} else {
    echo "<span style='color:red'>[ERROR] Clase conexionBD NO existe.</span><br>";
    die("Detenido.");
}

// 3. Prueba de Conexión
echo "<p>3. Intentando conectar a la Base de Datos...</p>";
try {
    $pdo = conexionBD::conexionPDO();
    if ($pdo) {
        echo "<span style='color:green'>[OK] Conexión TCP/IP Exitosa a la BD.</span><br>";
    } else {
        echo "<span style='color:red'>[ERROR] conexionPDO() devolvió null/false.</span><br>";
    }
} catch (Exception $e) {
    echo "<span style='color:red'>[ERROR] Excepción al conectar: " . $e->getMessage() . "</span><br>";
}

// 4. Prueba de Modelo Usuario
echo "<p>4. Verificando Modelo Usuario...</p>";
$model_user_path = __DIR__ . '/model/modelo_usuario.php';
if (file_exists($model_user_path)) {
    require_once $model_user_path;
    if (class_exists('Modelo_Usuario')) {
        echo "<span style='color:green'>[OK] Modelo_Usuario cargado.</span><br>";

        // 5. Prueba de Procedure
        echo "<p>5. Verificando Procedure SP_VERIFICAR_USUARIO...</p>";
        $mu = new Modelo_Usuario();
        try {
            // Probamos con un usuario dummy para ver si el SP existe (no importa si falla el login, importa si falla la query)
            $res = $mu->VerificarUsuario('test_debug', 'nopass');
            echo "<span style='color:green'>[OK] Llamada a Procedure ejecutada sin error fatal (Resultado: " . count($res) . ").</span><br>";
        } catch (Exception $e) {
            echo "<span style='color:red'>[ERROR] Falló llamada al Procedure: " . $e->getMessage() . "</span><br>";
        }

    } else {
        echo "<span style='color:red'>[ERROR] Clase Modelo_Usuario NO existe.</span><br>";
    }
} else {
    echo "<span style='color:red'>[ERROR] Archivo modelo_usuario.php NO encontrado.</span><br>";
}

echo "<h3>Fin del Diagnostico</h3>";
?>