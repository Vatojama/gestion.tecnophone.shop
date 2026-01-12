<?php
require_once __DIR__ . '/model/modelo_conexion.php';

try {
    $pdo = conexionBD::conexionPDO();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo "Starting Critical Auth Fix (V9) - Aligning SP_VERIFICAR_USUARIO Columns...<br>";

    // Re-create SP_VERIFICAR_USUARIO with EXACT order from backup
    echo "Updating SP_VERIFICAR_USUARIO to match JS expectations...<br>";
    $pdo->exec("DROP PROCEDURE IF EXISTS SP_VERIFICAR_USUARIO");

    // Exact order from backup line 9429-9438:
    // 0: u.usu_id
    // 1: u.usu_nombre
    // 2: u.usu_contrasena
    // 3: u.rol_id
    // 4: u.usu_estado
    // 5: u.usu_email
    // 6: u.usu_foto
    // 7: r.rol_nombre
    // 8: u.id_sucu
    // 9: s.id_almacen

    $sql_sp = "CREATE PROCEDURE `SP_VERIFICAR_USUARIO`(IN USUARIO VARCHAR(250))
    BEGIN
    SELECT
        u.usu_id, 
        u.usu_nombre, 
        u.usu_contrasena, 
        u.rol_id, 
        u.usu_estado, 
        u.usu_email, 
        u.usu_foto, 
        r.rol_nombre,
        u.id_sucu,
        s.id_almacen
    FROM
        usuario AS u
        INNER JOIN rol AS r ON u.rol_id = r.rol_id
        INNER JOIN sucursales AS s ON u.id_sucu = s.id_sucu
    WHERE u.usu_nombre = BINARY USUARIO;
    END";

    $pdo->exec($sql_sp);

    // Also a quick fix: Ensure 'admin' has a valid start page if not set
    echo "Ensuring Admin has at least one start page...<br>";
    $pdo->exec("UPDATE td_menu_detalle SET vista_inicio = 1 WHERE rol_id = 1 AND men_id = 27;"); // Set Dashboard as start page if possible

    echo "Auth Fix V9 completed successfully. Please LOGOUT and LOGIN again.<br>";

} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "<br>";
    echo "File: " . $e->getFile() . " on line " . $e->getLine() . "<br>";
}
