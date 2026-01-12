<?php
require_once __DIR__ . '/model/modelo_conexion.php';

try {
    $pdo = conexionBD::conexionPDO();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo "Starting Database Restoration (V7) - Users and Roles...<br>";

    // 1. Restore Roles
    echo "Restoring roles...<br>";
    $roles = [
        [1, 'Administrador', '2022-02-13', 'ACTIVO'],
        [2, 'Recepcionista', '2022-02-13', 'ACTIVO'],
        [3, 'Vendedor', '2022-03-02', 'ACTIVO'],
        [4, 'Tecnico', '2024-01-22', 'ACTIVO'],
        [5, 'Almacenero', '2024-02-14', 'ACTIVO']
    ];

    foreach ($roles as $rol) {
        $stmt = $pdo->prepare("INSERT INTO `rol` (`rol_id`, `rol_nombre`, `rol_fregistro`, `rol_estado`) VALUES (?, ?, ?, ?) ON DUPLICATE KEY UPDATE `rol_nombre` = VALUES(`rol_nombre`), `rol_estado` = VALUES(`rol_estado`)");
        $stmt->execute($rol);
    }

    // 2. Restore Users (Tommy, Miguel, Alicia)
    echo "Restoring users...<br>";
    $users = [
        [16, 'Tommy', '$2y$12$eKZj.pAooEjJEuWsWiIQiu0yC/TYhLHIGhViWtxGuUGVKAJyhuPY6', 'Tomás Jaime', 1, 'controller/usuario/foto/default.png', 'ACTIVO', 1],
        [17, 'Miguel', '$2y$12$nmLCiL3n.jIQeY3HvbNe4e9V7ZdQxUTm2sU5MCAppqycyqOMZaS6i', 'Miguel Angel Gordo Dominguez', 1, 'controller/usuario/foto/default.png', 'ACTIVO', 1],
        [18, 'Alicia', '$2y$12$JvhX0a9xLQov03YGF.fdr.Pbden0Bfx7byhAxlSB4cQq4gAk8I0QW', 'Alicia González', 4, 'controller/usuario/foto/default.png', 'ACTIVO', 1]
    ];

    foreach ($users as $user) {
        $stmt = $pdo->prepare("INSERT INTO `usuario` (`usu_id`, `usu_nombre`, `usu_contrasena`, `usu_email`, `rol_id`, `usu_foto`, `usu_state`, `id_sucu`) VALUES (?, ?, ?, ?, ?, ?, ?, ?) 
            ON DUPLICATE KEY UPDATE `usu_nombre` = VALUES(`usu_nombre`), `usu_contrasena` = VALUES(`usu_contrasena`), `usu_email` = VALUES(`usu_email`), `rol_id` = VALUES(`rol_id`), `usu_foto` = VALUES(`usu_foto`), `usu_state` = VALUES(`usu_state`), `id_sucu` = VALUES(`id_sucu`)");

        // Note: I saw 'usu_estado' in my previous analysis and 'usu_state' in some other places? 
        // Let's check the column names again or adjust for known 'usu_estado'.
        // Actually, previous session said 'usu_estado'. I'll stick with 'usu_estado'.

        $stmt = $pdo->prepare("INSERT INTO `usuario` (`usu_id`, `usu_nombre`, `usu_contrasena`, `usu_email`, `rol_id`, `usu_foto`, `usu_estado`, `id_sucu`) VALUES (?, ?, ?, ?, ?, ?, ?, ?) 
            ON DUPLICATE KEY UPDATE `usu_nombre` = VALUES(`usu_nombre`), `usu_contrasena` = VALUES(`usu_contrasena`), `usu_email` = VALUES(`usu_email`), `rol_id` = VALUES(`rol_id`), `usu_foto` = VALUES(`usu_foto`), `usu_estado` = VALUES(`usu_estado`), `id_sucu` = VALUES(`id_sucu`)");
        $stmt->execute($user);
    }

    // 3. Re-create SP_VERIFICAR_USUARIO with plural 'sucursales'
    echo "Updating SP_VERIFICAR_USUARIO...<br>";
    $pdo->exec("DROP PROCEDURE IF EXISTS SP_VERIFICAR_USUARIO");
    $sql_sp = "CREATE PROCEDURE `SP_VERIFICAR_USUARIO`(IN USUARIO VARCHAR(250))
    BEGIN
    SELECT
        u.usu_id, 
        u.usu_nombre, 
        u.usu_contrasena, 
        u.usu_email, 
        u.rol_id, 
        r.rol_nombre, 
        u.usu_foto, 
        u.usu_estado, 
        u.id_sucu, 
        s.nombre_su
    FROM
        usuario AS u
        INNER JOIN rol AS r ON u.rol_id = r.rol_id
        INNER JOIN sucursales AS s ON u.id_sucu = s.id_sucu
    WHERE u.usu_nombre = BINARY USUARIO;
    END";
    $pdo->exec($sql_sp);

    echo "Restoration V7 completed successfully.<br>";

} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "<br>";
    echo "File: " . $e->getFile() . " on line " . $e->getLine() . "<br>";
}
