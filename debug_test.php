<?php
header('Content-Type: text/html; charset=utf-8');
require_once dirname(__FILE__) . '/model/modelo_conexion.php';

echo "<h1>🔍 Diagnóstico de Base de Datos - SP_REGISTRAR_TEST</h1>";

try {
    $c = conexionBD::conexionPDO();
    $c->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo "<h3>1. Intentando borrar SP si existe...</h3>";
    $c->exec("DROP PROCEDURE IF EXISTS SP_REGISTRAR_TEST");
    echo "<p style='color:green;'>✅ DROP ejecutado correctamente.</p>";

    echo "<h3>2. Intentando crear SP...</h3>";
    $sql = "CREATE PROCEDURE SP_REGISTRAR_TEST(
        IN IDRECEP INT, 
        IN ENCIEND VARCHAR(3), 
        IN TACTI VARCHAR(3), 
        IN IMG VARCHAR(3), 
        IN VIBRA VARCHAR(3), 
        IN COBER VARCHAR(3), 
        IN SENSO VARCHAR(3), 
        IN CARG VARCHAR(3), 
        IN BLUET VARCHAR(3), 
        IN WIF VARCHAR(3), 
        IN HUELL VARCHAR(3), 
        IN HOM VARCHAR(3), 
        IN LATERA VARCHAR(3), 
        IN CAMAR VARCHAR(3), 
        IN BATE VARCHAR(3), 
        IN AURICUL VARCHAR(3), 
        IN MICRO VARCHAR(3), 
        IN FACE_ID VARCHAR(3), 
        IN TORNIL VARCHAR(3),
        IN FOTO_TEST VARCHAR(255)
    )
    BEGIN
        UPDATE recepcion SET
            `enciende` = ENCIEND,
            `tactil` = TACTI,
            `imagen` = IMG,
            `vibra` = VIBRA,
            `cobertura` = COBER,
            `sensor` = SENSO,
            `carga` = CARG,
            `bluetoo` = BLUET,
            `wifi` = WIF,
            `huella` = HUELL,
            `home` = HOM,
            `lateral` = LATERA,
            `camara` = CAMAR,
            `bateria` = BATE,
            `auricular` = AURICUL,
            `micro` = MICRO,
            `face` = FACE_ID,
            `tornillo` = TORNIL,
            `rece_foto2` = FOTO_TEST
        WHERE `rece_id` = IDRECEP;
    END;";

    $c->exec($sql);
    echo "<p style='color:green;'>✅ CREATE PROCEDURE ejecutado correctamente.</p>";

    echo "<h3>3. Verificando si existe ahora...</h3>";
    $res = $c->query("SHOW PROCEDURE STATUS WHERE Name = 'SP_REGISTRAR_TEST'")->fetch();
    if ($res) {
        echo "<p style='color:blue;'>🎉 ¡CONSEGUIDO! El procedimiento existe en la base de datos: " . $res['Db'] . "</p>";
    } else {
        echo "<p style='color:red;'>❌ ERROR: El procedimiento NO aparece en SHOW PROCEDURE STATUS tras intentarlo crear.</p>";
    }

    echo "<h3>4. Verificando permisos de carpeta de fotos...</h3>";
    $foto_dir = dirname(__FILE__) . '/controller/recepcion/foto';
    if (!is_dir($foto_dir)) {
        if (mkdir($foto_dir, 0777, true)) {
            echo "<p style='color:green;'>✅ Carpeta creada: $foto_dir</p>";
        } else {
            echo "<p style='color:red;'>❌ ERROR: No se pudo crear la carpeta: $foto_dir</p>";
        }
    } else {
        echo "<p style='color:green;'>✅ La carpeta de fotos existe.</p>";
        if (is_writable($foto_dir)) {
            echo "<p style='color:green;'>✅ La carpeta TIENE permisos de escritura.</p>";
        } else {
            echo "<p style='color:red;'>❌ ERROR: La carpeta NO tiene permisos de escritura (chmod 777 requerido).</p>";
        }
    }

} catch (Exception $e) {
    echo "<p style='color:red;'>❌ ERROR CRÍTICO: " . $e->getMessage() . "</p>";
}
?>