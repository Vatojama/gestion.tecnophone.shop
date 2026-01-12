<?php
require_once __DIR__ . '/model/modelo_conexion.php';

try {
  $pdo = conexionBD::conexionPDO();
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  echo "Starting Master Database Synchronization (V6)...<br>";

  // 1. Ensure 'sucursales' table exists
  echo "Checking 'sucursales' table structure...<br>";
  $sql_table_suc = "CREATE TABLE IF NOT EXISTS `sucursales` (
      `id_sucu` int NOT NULL AUTO_INCREMENT,
      `confi_id` int DEFAULT NULL,
      `nombre_su` varchar(255) DEFAULT NULL,
      `ruc_su` varchar(30) DEFAULT NULL,
      `telefono_su` varchar(20) DEFAULT NULL,
      `direccion_su` varchar(255) DEFAULT NULL,
      `correo_su` varchar(100) DEFAULT NULL,
      `estado_su` varchar(50) DEFAULT NULL,
      `id_almacen` int DEFAULT NULL,
      `fecha_reg` datetime DEFAULT NULL,
      `imagen_su` varchar(255) DEFAULT NULL,
      `moneda_su` varchar(5) DEFAULT NULL,
      PRIMARY KEY (`id_sucu`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;";
  $pdo->exec($sql_table_suc);

  // 2. Ensure 'almacen' table exists
  echo "Checking 'almacen' table structure...<br>";
  $sql_table_alm = "CREATE TABLE IF NOT EXISTS `almacen` (
      `id_almacen` int NOT NULL AUTO_INCREMENT,
      `descripcion_al` varchar(255) DEFAULT NULL,
      `codigo_al` varchar(15) DEFAULT NULL,
      `principal` varchar(5) DEFAULT 'No',
      `estado_al` varchar(15) DEFAULT 'Activo',
      `fecha_reg_al` datetime DEFAULT NULL,
      PRIMARY KEY (`id_almacen`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;";
  $pdo->exec($sql_table_alm);

  // 3. Insert default data if empty
  $stmt = $pdo->query("SELECT COUNT(*) FROM `sucursales`");
  if ($stmt->fetchColumn() == 0) {
    echo "Inserting default branch data...<br>";
    $sql_data_suc = "INSERT INTO `sucursales` (`id_sucu`, `confi_id`, `nombre_su`, `ruc_su`, `telefono_su`, `direccion_su`, `correo_su`, `estado_su`, `id_almacen`, `fecha_reg`) VALUES
        (1, 3, 'Tecnophone.Shop', '2050230125565', '642354483', 'CAMINO VIEJO DE MALAGA Nº3', 'tecnophonevelez@gmail.com', 'Activo', 1, '2025-06-03 22:56:46');";
    $pdo->exec($sql_data_suc);
  }

  $stmt = $pdo->query("SELECT COUNT(*) FROM `almacen`");
  if ($stmt->fetchColumn() == 0) {
    echo "Inserting default warehouse data...<br>";
    $sql_data_alm = "INSERT INTO `almacen` (`id_almacen`, `descripcion_al`, `codigo_al`, `principal`, `estado_al`, `fecha_reg_al`) VALUES
        (1, 'ALMACEN CENTRAL', 'AL-CENTRAL', 'Si', 'Activo', '2025-01-01 00:00:00');";
    $pdo->exec($sql_data_alm);
  }

  // 4. Procedures Restoration
  function recreateProcedure($pdo, $name, $sql)
  {
    echo "Recreating $name...<br>";
    $pdo->exec("DROP PROCEDURE IF EXISTS $name");
    $pdo->exec($sql);
  }

  // SP_LISTAR_SUCURSALES
  recreateProcedure($pdo, 'SP_LISTAR_SUCURSALES', "
    CREATE PROCEDURE `SP_LISTAR_SUCURSALES`()
    BEGIN
    SELECT
        s.id_sucu, 
        s.confi_id, 
        c.confi_razon_social, 
        s.nombre_su, 
        s.ruc_su, 
        s.telefono_su, 
        s.direccion_su, 
        s.correo_su, 
        s.estado_su, 
        s.id_almacen, 
        a.descripcion_al, 
        a.codigo_al, 
        s.fecha_reg
    FROM
        sucursales AS s
        INNER JOIN configuracion AS c ON s.confi_id = c.confi_id
        INNER JOIN almacen AS a ON s.id_almacen = a.id_almacen;
    END");

  // SP_LISTAR_SELECT_SUCURSAL
  recreateProcedure($pdo, 'SP_LISTAR_SELECT_SUCURSAL', "
    CREATE PROCEDURE `SP_LISTAR_SELECT_SUCURSAL`()
    BEGIN
      SELECT id_sucu, nombre_su FROM sucursales WHERE estado_su = 'Activo';
    END");

  // SP_LISTAR_SELECT_ALMACENES
  recreateProcedure($pdo, 'SP_LISTAR_SELECT_ALMACENES', "
    CREATE PROCEDURE `SP_LISTAR_SELECT_ALMACENES`()
    BEGIN
    SELECT a.id_almacen, a.descripcion_al, a.codigo_al FROM almacen AS a WHERE a.estado_al = 'Activo';
    END");

  // SP_REGISTRAR_SUCURSALES
  recreateProcedure($pdo, 'SP_REGISTRAR_SUCURSALES', "
    CREATE PROCEDURE `SP_REGISTRAR_SUCURSALES`(IN p_razon VARCHAR(255), IN p_ruc VARCHAR(30), IN p_telefono VARCHAR(20), IN p_direccion VARCHAR(255), IN p_correo VARCHAR(50), IN p_id_almacen INT)
    BEGIN
        INSERT INTO sucursales (confi_id, nombre_su, ruc_su, telefono_su, direccion_su, correo_su, id_almacen, estado_su, fecha_reg) 
        VALUES (3, p_razon, p_ruc, p_telefono, p_direccion, p_correo, p_id_almacen, 'Activo', CURRENT_TIMESTAMP());
    END");

  // SP_MODIFICAR_SUCURSALES
  recreateProcedure($pdo, 'SP_MODIFICAR_SUCURSALES', "
    CREATE PROCEDURE `SP_MODIFICAR_SUCURSALES`(IN p_idsucu INT, IN p_razon VARCHAR(255), IN p_ruc VARCHAR(30), IN p_telefono VARCHAR(20), IN p_direccion VARCHAR(255), IN p_correo VARCHAR(50), IN p_id_almacen INT, IN p_estadosu VARCHAR(20))
    BEGIN
        UPDATE sucursales SET nombre_su = p_razon, ruc_su = p_ruc, telefono_su = p_telefono, direccion_su = p_direccion, correo_su = p_correo, id_almacen = p_id_almacen, estado_su = p_estadosu WHERE id_sucu = p_idsucu;
    END");

  // SP_ELIMINAR_SUCURSALES
  recreateProcedure($pdo, 'SP_ELIMINAR_SUCURSALES', "
    CREATE PROCEDURE `SP_ELIMINAR_SUCURSALES`(IN p_id_sucu INT)
    BEGIN
        DELETE FROM sucursales WHERE id_sucu = p_id_sucu;
    END");

  // SP_LISTAR_ADLMACENES (Typo preserved as in model)
  recreateProcedure($pdo, 'SP_LISTAR_ADLMACENES', "
    CREATE PROCEDURE `SP_LISTAR_ADLMACENES`()
    BEGIN
    SELECT a.id_almacen, a.descripcion_al, a.codigo_al, a.estado_al, a.fecha_reg_al FROM almacen AS a;
    END");

  // SP_REGISTRAR_ALMACENES
  recreateProcedure($pdo, 'SP_REGISTRAR_ALMACENES', "
    CREATE PROCEDURE `SP_REGISTRAR_ALMACENES`(IN p_descripcion VARCHAR(255), IN p_abrevia VARCHAR(10))
    BEGIN
        INSERT INTO almacen (descripcion_al, codigo_al, estado_al, fecha_reg_al) VALUES (p_descripcion, p_abrevia, 'Activo', CURRENT_TIMESTAMP());
    END");

  // SP_MODIFICAR_ALMACENES
  recreateProcedure($pdo, 'SP_MODIFICAR_ALMACENES', "
    CREATE PROCEDURE `SP_MODIFICAR_ALMACENES`(IN p_idalmacen INT, IN p_descripcion VARCHAR(255), IN p_abrevia VARCHAR(10), IN p_estado VARCHAR(20))
    BEGIN
        UPDATE almacen SET descripcion_al = p_descripcion, codigo_al = p_abrevia, estado_al = p_estado WHERE id_almacen = p_idalmacen;
    END");

  // SP_ELIMINAR_ALMACEN
  recreateProcedure($pdo, 'SP_ELIMINAR_ALMACEN', "
    CREATE PROCEDURE `SP_ELIMINAR_ALMACEN`(IN p_idalmacen INT)
    BEGIN
        DELETE FROM almacen WHERE id_almacen = p_idalmacen;
    END");

  echo "Master Synchronization completed successfully.<br>";

} catch (Exception $e) {
  echo "Error: " . $e->getMessage() . "<br>";
  echo "File: " . $e->getFile() . " on line " . $e->getLine() . "<br>";
}
