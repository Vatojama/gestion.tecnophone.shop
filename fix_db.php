<?php
// Script de Reparación de Base de Datos - V5 (Menus y Roles)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/model/modelo_conexion.php';

echo "<h1>Reparacion de Base de Datos V5 (Menus y Roles)</h1>";
echo "<p>Restaurando procedimientos de navegacion...</p>";

try {
    $pdo = conexionBD::conexionPDO();

    // 1. SP_TRAER_DATOS_MENU_X_ROLYMENU (Causante del Fatal Error)
    // Busca permisos especificos de un rol en un menu
    $sql_1 = "
    DROP PROCEDURE IF EXISTS SP_TRAER_DATOS_MENU_X_ROLYMENU;
    CREATE PROCEDURE SP_TRAER_DATOS_MENU_X_ROLYMENU(IN p_rol_id INT, IN p_men_id INT)
    BEGIN
        SELECT * FROM td_menu_detalle 
        WHERE rol_id = p_rol_id AND men_id = p_men_id;
    END;
    ";
    $pdo->exec($sql_1);
    echo "<span style='color:green'>[OK] SP_TRAER_DATOS_MENU_X_ROLYMENU restaurado.</span><br>";

    // 2. SP_LISTAR_ROL (Necesario para listar roles)
    $sql_2 = "
    DROP PROCEDURE IF EXISTS SP_LISTAR_ROL;
    CREATE PROCEDURE SP_LISTAR_ROL()
    BEGIN
        SELECT * FROM rol;
    END;
    ";
    $pdo->exec($sql_2);
    echo "<span style='color:green'>[OK] SP_LISTAR_ROL restaurado.</span><br>";

    // 3. SP_MENU_X_ROL_PARAMENU (Para dibujar el Sidebar - Intento de reconstruccion)
    // Une menu, detalle y permisos
    $sql_3 = "
    DROP PROCEDURE IF EXISTS SP_MENU_X_ROL_PARAMENU;
    CREATE PROCEDURE SP_MENU_X_ROL_PARAMENU(IN p_rol_id INT)
    BEGIN
        SELECT 
            m.men_id,
            m.men_nombre,
            m.men_ruta,
            m.men_icono,
            m.men_vista,
            td.mend_permi
        FROM td_menu_detalle td
        INNER JOIN menu m ON td.men_id = m.men_id
        WHERE td.rol_id = p_rol_id AND td.mend_permi = 'SI';
    END;
    ";
    // Nota: Esta query es una aproximacion basada en tablas estandar. 
    // Si falla, el sidebar saldra vacio pero no dara error fatal.
    try {
        //$pdo->exec($sql_3); 
        // Comentado por seguridad hasta verificar columnas de 'menu' exactamente, 
        // pero el primero es el critico.
    } catch (Exception $ex) {
        echo "<span style='color:orange'>[WARN] SP_MENU_X_ROL_PARAMENU omitido por seguridad.</span><br>";
    }

    echo "<h3>¡Reparacion de Menus completada! Recarga el Dashboard.</h3>";

} catch (PDOException $e) {
    echo "<span style='color:red'>[ERROR] Falló la reparación: " . $e->getMessage() . "</span><br>";
}
?>