<?php
require_once __DIR__ . '/model/modelo_conexion.php';

try {
    $pdo = conexionBD::conexionPDO();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo "Starting Permissions and Menu Restoration (V8.1) - Fixing Foreign Key Error...<br>";

    // Disable Foreign Key Checks to allow dropping/recreating tables with dependencies
    $pdo->exec("SET FOREIGN_KEY_CHECKS = 0;");

    // 1. Restore 'grupos' Table
    echo "Restoring 'grupos' table...<br>";
    $pdo->exec("DROP TABLE IF EXISTS `grupos` CASCADE");
    $pdo->exec("CREATE TABLE `grupos` (
      `grupo_id` int NOT NULL AUTO_INCREMENT,
      `grupo_nombre` varchar(255) DEFAULT NULL,
      `estado` int DEFAULT NULL,
      `icon` varchar(255) DEFAULT NULL,
      `fecha_reg` datetime DEFAULT NULL,
      PRIMARY KEY (`grupo_id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;");

    $sql_grupos = "INSERT INTO `grupos` VALUES (1,'singrupo',1,'users','2024-07-23 00:00:55'),(2,'Usuario',1,'users','2024-07-23 00:01:09'),(3,'Comprobantes',1,'file-code','2024-07-23 00:01:54'),(4,'Configuracion',1,'building','2024-07-23 00:02:21'),(5,'Recepcion',1,'tags','2024-07-23 00:02:58'),(6,'Reparacion_t',1,'coins','2024-07-24 22:47:57'),(7,'Servicios',1,'coins','2024-07-24 22:48:21'),(8,'Caja',1,'cash-register','2024-07-24 22:49:58'),(9,'Productos',1,'box-open','2024-07-24 22:54:44'),(10,'Presupuesto',1,'box-open','2024-07-24 23:01:28'),(11,'ReporVentas',1,'file-alt','2024-07-24 23:05:17'),(12,'ReporProducto',1,'file-alt','2024-07-24 23:05:35'),(13,'Ventas',1,'file-alt','2024-09-07 19:29:11'),(14,'Clientes',1,'file-alt','2024-09-07 19:30:35'),(15,'ReporReparaciones',1,'file-alt','2024-09-07 19:59:22'),(16,'reporteGastos',1,'file-alt','2024-09-07 20:02:05'),(17,'Dashboard',1,'file-alt','2024-09-18 00:50:22'),(18,'Notas',1,'file-alt','2024-09-20 09:58:36'),(19,'Tienda',1,'file-alt','2025-03-16 02:40:02');";
    $pdo->exec($sql_grupos);

    // 2. Restore 'menu' Table
    echo "Restoring 'menu' table...<br>";
    $pdo->exec("DROP TABLE IF EXISTS `menu` CASCADE");
    $pdo->exec("CREATE TABLE `menu` (
      `men_id` int NOT NULL AUTO_INCREMENT,
      `men_vista` varchar(255) DEFAULT NULL,
      `men_icon` varchar(255) DEFAULT NULL,
      `men_ruta` varchar(255) DEFAULT NULL,
      `estado` int DEFAULT NULL,
      `grupo_id` int DEFAULT NULL,
      `fecha_reg` datetime DEFAULT NULL,
      `orden` int DEFAULT NULL,
      PRIMARY KEY (`men_id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;");

    $sql_menu = "INSERT INTO `menu` VALUES (1,'Recepcion','circle','recepcion/mantenimiento_recepcion.php',1,5,'2024-07-24 22:46:24',1),(2,'Motivo','circle','motivo/mantenimiento_motivo.php',1,5,'2024-07-24 22:47:00',2),(3,'Reparaciones Tec.','mobile-alt','reparaciones/mantenimiento_reparacion.php',1,6,'2024-07-24 22:48:29',3),(4,'Terminar Repar.','hand-holding-usd','servicio/mantenimiento_servicio.php',1,7,'2024-07-24 22:49:27',4),(5,'Caja','circle','caja/mantenimiento_caja.php',1,8,'2024-07-24 22:50:26',5),(6,'Movimientos','circle','gasto/mantenimiento_gasto.php',1,8,'2024-07-24 22:51:03',6),(7,'Ventas','cash-register','venta/mantenimiento_venta.php',1,13,'2024-07-24 22:52:11',7),(8,'Clientes','user-friends','cliente/mantenimiento_cliente.php',1,14,'2024-07-24 22:53:19',8),(9,'Productos','circle','producto/mantenimiento_producto.php',1,9,'2024-07-24 22:55:20',9),(10,'Categoria','circle','categoria/mantenimiento_categoria.php',1,9,'2024-07-24 22:55:53',10),(11,'Marca','circle','marca/mantenimiento_marca.php',1,9,'2024-07-24 22:56:46',11),(12,'Unidad Med.','circle','medida/mantenimiento_medida.php',1,9,'2024-07-24 22:56:49',12),(13,'Presupuesto','circle','cotizacion/mantenimiento_cotizacion.php',1,10,'2024-07-24 23:02:07',23),(14,'Tipo Pago','circle','forma_pago/mantenimiento_forma_pago.php',1,10,'2024-07-24 23:02:50',24),(15,'Usuarios','circle','usuario/mantenimiento_usuario.php',1,2,'2024-07-23 00:03:52',13),(16,'Roles','circle','rol/mantenimiento_rol.php',1,2,'2024-07-23 00:04:49',14),(17,'Comprobantes','file','configuracion/mantenimiento_comprobante.php',1,4,'2024-07-23 00:05:36',25),(18,'Empresa','building','configuracion/mantenimiento_configuracion.php',1,4,'2024-08-02 23:54:02',23),(19,'Reporte Reparaciones','file-alt','reporteservicio/mantenimiento_reporte_servicio.php',1,15,'2024-07-24 23:04:07',15),(20,'Reporte Gastos','file-alt','reportegasto/mantenimiento_reporte_gasto.php',1,16,'2024-07-24 23:04:33',16),(21,'Reporte Ventas','circle','reporteventa/mantenimiento_reporte_venta.php',1,11,'2024-07-24 23:06:09',17),(22,'Pivot','circle','reporteventa/mantenimiento_pivot.php',1,11,'2024-07-24 23:06:43',18),(23,'Por Producto','circle','reporteproducto/mantenimiento_reporte_producto.php',1,12,'2024-07-24 23:08:02',19),(24,'Producto - utilidad','circle','reporteproducto/mantenimiento_utilidad.php',1,12,'2024-07-24 23:09:42',20),(25,'Kardex','circle','reporteproducto/mantenimiento_kardex.php',1,12,'2024-07-24 23:10:43',22),(26,'Imei Mov','circle','reporteproducto/mantenimiento_mov_imei.php',1,12,'2024-07-24 23:10:15',21),(27,'Dashboard','circle','dashboard/mantenimiento_dashboard.php',1,17,'2024-09-18 00:50:35',25),(28,'Notas','circle','notas/mantenimiento_notas.php',1,18,'2024-09-20 09:58:47',26),(29,'Banner','circle','tienda/mant_banner.php',1,19,'2025-03-16 02:40:15',27),(30,'Pedido','circle','tienda/mant_pedido.php',1,19,'2025-04-03 18:34:13',28),(31,'Servicios','circle','tienda/mant_servi.php',1,19,'2025-05-06 15:56:06',29),(32,'Sucursales','circle','configuracion/mantenimiento_sucursal.php',1,4,'2025-06-03 21:37:50',30),(33,'Almacen','circle','configuracion/mantenimiento_almacen.php',1,4,'2025-06-05 01:46:13',31),(34,'Traslados','circle','producto/mantenimiento_traslado.php',1,9,'2025-06-11 11:44:58',32),(35,'Proveedor','circle','cliente/mantenimiento_proveedor.php',1,14,'2025-07-09 00:21:05',33),(36,'Recepcion x Cliente','circle','recepcion/mantenimiento_buscar_recep_cliente.php',1,5,'2025-08-20 23:58:43',34);";
    $pdo->exec($sql_menu);

    // 3. Restore 'td_menu_detalle' Table
    echo "Restoring 'td_menu_detalle' table...<br>";
    $pdo->exec("DROP TABLE IF EXISTS `td_menu_detalle` CASCADE");
    $pdo->exec("CREATE TABLE `td_menu_detalle` (
      `mend_id` int NOT NULL AUTO_INCREMENT,
      `rol_id` int DEFAULT NULL,
      `men_id` int DEFAULT NULL,
      `mend_permi` varchar(5) DEFAULT NULL,
      `fecha_fregistro_med` datetime DEFAULT NULL,
      `estado` int DEFAULT NULL,
      `ver` varchar(5) DEFAULT NULL,
      `edit` varchar(5) DEFAULT NULL,
      `eliminar` varchar(5) DEFAULT NULL,
      `vista_inicio` int DEFAULT NULL,
      PRIMARY KEY (`mend_id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;");

    $sql_permisos = "INSERT INTO `td_menu_detalle` VALUES (229,1,1,'Si','2024-08-02 23:58:57',1,'No','No','No',0),(230,1,2,'Si','2024-08-02 23:58:57',1,'No','No','No',0),(231,1,3,'Si','2024-08-02 23:58:57',1,'No','No','No',0),(232,1,4,'Si','2024-08-02 23:58:57',1,'No','No','No',0),(233,1,5,'Si','2024-08-02 23:58:57',1,'No','No','No',0),(234,1,6,'Si','2024-08-02 23:58:57',1,'No','No','No',0),(235,1,7,'Si','2024-08-02 23:58:57',1,'No','No','No',0),(236,1,8,'Si','2024-08-02 23:58:57',1,'No','No','No',0),(237,1,9,'Si','2024-08-02 23:58:57',1,'No','No','No',0),(238,1,10,'Si','2024-08-02 23:58:57',1,'No','No','No',0),(239,1,11,'Si','2024-08-02 23:58:57',1,'No','No','No',0),(240,1,12,'Si','2024-08-02 23:58:57',1,'No','No','No',0),(241,1,13,'Si','2024-08-02 23:58:57',1,'No','No','No',0),(242,1,14,'Si','2024-08-02 23:58:57',1,'No','No','No',0),(243,1,15,'Si','2024-08-02 23:58:57',1,'No','No','No',1),(244,1,16,'Si','2024-08-02 23:58:57',1,'No','No','No',0),(245,1,17,'Si','2024-08-02 23:58:57',1,'No','No','No',0),(246,1,18,'Si','2024-08-02 23:58:57',1,'No','No','No',0),(247,1,19,'Si','2024-08-02 23:58:57',1,'No','No','No',0),(248,1,20,'Si','2024-08-02 23:58:57',1,'No','No','No',0),(249,1,21,'Si','2024-08-02 23:58:57',1,'No','No','No',0),(250,1,22,'Si','2024-08-02 23:58:57',1,'No','No','No',0),(251,1,23,'Si','2024-08-02 23:58:57',1,'No','No','No',0),(252,1,24,'Si','2024-08-02 23:58:57',1,'No','No','No',0),(253,1,25,'Si','2024-08-02 23:58:57',1,'No','No','No',0),(254,1,26,'Si','2024-08-02 23:58:57',1,'No','No','No',0),(255,2,1,'Si','2024-08-07 00:25:31',1,'No','No','No',1),(256,2,2,'Si','2024-08-07 00:25:31',1,'No','No','No',0),(257,2,3,'Si','2024-08-07 00:25:31',1,'No','No','No',0),(258,2,4,'Si','2024-08-07 00:25:31',1,'No','No','No',0),(259,2,5,'No','2024-08-07 00:25:31',1,'No','No','No',0),(260,2,6,'No','2024-08-07 00:25:31',1,'No','No','No',0),(261,2,7,'No','2024-08-07 00:25:31',1,'No','No','No',0),(262,2,8,'No','2024-08-07 00:25:31',1,'No','No','No',0),(263,2,9,'No','2024-08-07 00:25:31',1,'No','No','No',0),(264,2,10,'No','2024-08-07 00:25:31',1,'No','No','No',0),(265,2,11,'No','2024-08-07 00:25:31',1,'No','No','No',0),(266,2,12,'No','2024-08-07 00:25:31',1,'No','No','No',0),(267,2,13,'No','2024-08-07 00:25:31',1,'No','No','No',0),(268,2,14,'No','2024-08-07 00:25:31',1,'No','No','No',0),(269,2,15,'No','2024-08-07 00:25:31',1,'No','No','No',0),(270,2,16,'No','2024-08-07 00:25:31',1,'No','No','No',0),(271,2,17,'No','2024-08-07 00:25:31',1,'No','No','No',0),(272,2,18,'No','2024-08-07 00:25:31',1,'No','No','No',0),(273,2,19,'No','2024-08-07 00:25:31',1,'No','No','No',0),(274,2,20,'No','2024-08-07 00:25:31',1,'No','No','No',0),(275,2,21,'No','2024-08-07 00:25:31',1,'No','No','No',0),(276,2,22,'No','2024-08-07 00:25:31',1,'No','No','No',0),(277,2,23,'No','2024-08-07 00:25:31',1,'No','No','No',0),(278,2,24,'No','2024-08-07 00:25:31',1,'No','No','No',0),(279,2,25,'No','2024-08-07 00:25:31',1,'No','No','No',0),(280,2,26,'No','2024-08-07 00:25:31',1,'No','No','No',0),(286,3,1,'Si','2024-08-07 00:25:39',1,'No','No','No',0),(287,3,2,'Si','2024-08-07 00:25:39',1,'No','No','No',0),(288,3,3,'Si','2024-08-07 00:25:39',1,'No','No','No',0),(289,3,4,'Si','2024-08-07 00:25:39',1,'No','No','No',0),(290,3,5,'Si','2024-08-07 00:25:39',1,'No','No','No',0),(291,3,6,'Si','2024-08-07 00:25:39',1,'No','No','No',0),(292,3,7,'Si','2024-08-07 00:25:39',1,'No','No','No',0),(293,3,8,'Si','2024-08-07 00:25:39',1,'No','No','No',0),(294,3,9,'Si','2024-08-07 00:25:39',1,'No','No','No',1),(295,3,10,'Si','2024-08-07 00:25:39',1,'No','No','No',0),(296,3,11,'No','2024-08-07 00:25:39',1,'No','No','No',0),(297,3,12,'No','2024-08-07 00:25:39',1,'No','No','No',0),(298,3,13,'No','2024-08-07 00:25:39',1,'No','No','No',0),(299,3,14,'No','2024-08-07 00:25:39',1,'No','No','No',0),(300,3,15,'No','2024-08-07 00:25:39',1,'No','No','No',0),(301,3,16,'No','2024-08-07 00:25:39',1,'No','No','No',0),(302,3,17,'No','2024-08-07 00:25:39',1,'No','No','No',0),(303,3,18,'No','2024-08-07 00:25:39',1,'No','No','No',0),(304,3,19,'No','2024-08-07 00:25:39',1,'No','No','No',0),(305,3,20,'No','2024-08-07 00:25:39',1,'No','No','No',0),(306,3,21,'No','2024-08-07 00:25:39',1,'No','No','No',0),(307,3,22,'No','2024-08-07 00:25:39',1,'No','No','No',0),(308,3,23,'No','2024-08-07 00:25:39',1,'No','No','No',0),(309,3,24,'No','2024-08-07 00:25:39',1,'No','No','No',0),(310,3,25,'No','2024-08-07 00:25:39',1,'No','No','No',0),(311,3,26,'No','2024-08-07 00:25:39',1,'No','No','No',0),(317,4,1,'No','2024-08-07 00:25:54',1,'No','No','No',0),(318,4,2,'No','2024-08-07 00:25:54',1,'No','No','No',0),(319,4,3,'Si','2024-08-07 00:25:54',1,'No','No','No',1),(320,4,4,'No','2024-08-07 00:25:54',1,'No','No','No',0),(321,4,5,'No','2024-08-07 00:25:54',1,'No','No','No',0),(322,4,6,'Si','2024-08-07 00:25:54',1,'No','No','No',0),(323,4,7,'No','2024-08-07 00:25:54',1,'No','No','No',0),(324,4,8,'No','2024-08-07 00:25:54',1,'No','No','No',0),(325,4,9,'No','2024-08-07 00:25:54',1,'No','No','No',0),(326,4,10,'No','2024-08-07 00:25:54',1,'No','No','No',0),(327,4,11,'No','2024-08-07 00:25:54',1,'No','No','No',0),(328,4,12,'No','2024-08-07 00:25:54',1,'No','No','No',0),(329,4,13,'No','2024-08-07 00:25:54',1,'No','No','No',0),(330,4,14,'No','2024-08-07 00:25:54',1,'No','No','No',0),(331,4,15,'No','2024-08-07 00:25:54',1,'No','No','No',0),(332,4,16,'No','2024-08-07 00:25:54',1,'No','No','No',0),(333,4,17,'No','2024-08-07 00:25:54',1,'No','No','No',0),(334,4,18,'No','2024-08-07 00:25:54',1,'No','No','No',0),(335,4,19,'No','2024-08-07 00:25:54',1,'No','No','No',0),(336,4,20,'No','2024-08-07 00:25:54',1,'No','No','No',0),(337,4,21,'No','2024-08-07 00:25:54',1,'No','No','No',0),(338,4,22,'No','2024-08-07 00:25:54',1,'No','No','No',0),(339,4,23,'No','2024-08-07 00:25:54',1,'No','No','No',0),(340,4,24,'No','2024-08-07 00:25:54',1,'No','No','No',0),(341,4,25,'No','2024-08-07 00:25:54',1,'No','No','No',0),(342,4,26,'No','2024-08-07 00:25:54',1,'No','No','No',0),(348,5,1,'No','2024-08-07 00:26:17',1,'No','No','No',0),(349,5,2,'No','2024-08-07 00:26:17',1,'No','No','No',0),(350,5,3,'No','2024-08-07 00:26:17',1,'No','No','No',0),(351,5,4,'No','2024-08-07 00:26:17',1,'No','No','No',0),(352,5,5,'No','2024-08-07 00:26:17',1,'No','No','No',0),(353,5,6,'No','2024-08-07 00:26:17',1,'No','No','No',0),(354,5,7,'No','2024-08-07 00:26:17',1,'No','No','No',0),(355,5,8,'No','2024-08-07 00:26:17',1,'No','No','No',0),(356,5,9,'Si','2024-08-07 00:26:17',1,'No','No','No',1),(357,5,10,'No','2024-08-07 00:26:17',1,'No','No','No',0),(358,5,11,'No','2024-08-07 00:26:17',1,'No','No','No',0),(359,5,12,'No','2024-08-07 00:26:17',1,'No','No','No',0),(360,5,13,'No','2024-08-07 00:26:17',1,'No','No','No',0),(361,5,14,'No','2024-08-07 00:26:17',1,'No','No','No',0),(362,5,15,'No','2024-08-07 00:26:17',1,'No','No','No',0),(363,5,16,'No','2024-08-07 00:26:17',1,'No','No','No',0),(364,5,17,'No','2024-08-07 00:26:17',1,'No','No','No',0),(365,5,18,'No','2024-08-07 00:26:17',1,'No','No','No',0),(366,5,19,'No','2024-08-07 00:26:17',1,'No','No','No',0),(367,5,20,'No','2024-08-07 00:26:17',1,'No','No','No',0),(368,5,21,'No','2024-08-07 00:26:17',1,'No','No','No',0),(369,5,22,'No','2024-08-07 00:26:17',1,'No','No','No',0),(370,5,23,'No','2024-08-07 00:26:17',1,'No','No','No',0),(371,5,24,'No','2024-08-07 00:26:17',1,'No','No','No',0),(372,5,25,'No','2024-08-07 00:26:17',1,'No','No','No',0),(373,5,26,'No','2024-08-07 00:26:17',1,'No','No','No',0),(374,1,27,'Si','2024-09-18 00:56:13',1,'No','No','No',0),(375,3,27,'No','2024-09-19 01:20:23',1,'No','No','No',0),(376,4,27,'No','2024-09-19 01:33:41',1,'No','No','No',0),(377,1,28,'Si','2024-09-21 02:30:32',1,'No','No','No',0),(378,2,27,'No','2024-09-21 02:31:25',1,'No','No','No',0),(379,2,28,'No','2024-09-21 02:31:25',1,'No','No','No',0),(381,4,28,'No','2024-09-21 02:31:47',1,'No','No','No',0),(382,1,29,'Si','2025-03-16 02:46:17',1,'No','No','No',0),(383,1,30,'Si','2025-04-03 18:35:18',1,'No','No','No',0),(384,1,31,'Si','2025-05-06 15:56:46',1,'No','No','No',0),(385,1,32,'Si','2025-06-03 21:40:19',1,'No','No','No',0),(386,1,33,'Si','2025-06-05 01:48:16',1,'No','No','No',0),(387,3,28,'No','2025-06-09 18:57:47',1,'No','No','No',0),(388,3,29,'No','2025-06-09 18:57:47',1,'No','No','No',0),(389,3,30,'No','2025-06-09 18:57:47',1,'No','No','No',0),(390,3,31,'No','2025-06-09 18:57:47',1,'No','No','No',0),(391,3,32,'No','2025-06-09 18:57:47',1,'No','No','No',0),(392,3,33,'No','2025-06-09 18:57:47',1,'No','No','No',0),(393,1,34,'Si','2025-06-11 11:45:14',1,'No','No','No',0),(394,3,34,'No','2025-06-23 12:32:26',1,'No','No','No',0),(395,4,29,'No','2025-07-07 23:37:22',1,'No','No','No',0),(396,4,30,'No','2025-07-07 23:37:22',1,'No','No','No',0),(397,4,31,'No','2025-07-07 23:37:22',1,'No','No','No',0),(398,4,32,'No','2025-07-07 23:37:22',1,'No','No','No',0),(399,4,33,'No','2025-07-07 23:37:22',1,'No','No','No',0),(400,4,34,'No','2025-07-07 23:37:22',1,'No','No','No',0),(401,1,35,'Si','2025-07-09 00:21:27',1,'No','No','No',0),(402,1,36,'Si','2025-08-20 23:59:09',1,'No','No','No',0),(403,3,35,'No','2025-12-09 09:01:05',1,'No','No','No',0),(404,3,36,'No','2025-12-09 09:01:05',1,'No','No','No',0);";
    $pdo->exec($sql_permisos);

    // 4. Re-enable Foreign Key Checks
    $pdo->exec("SET FOREIGN_KEY_CHECKS = 1;");

    // 5. Update SPs
    function recreateProcedure($pdo, $name, $sql)
    {
        echo "Recreating $name...<br>";
        $pdo->exec("DROP PROCEDURE IF EXISTS $name");
        $pdo->exec($sql);
    }

    recreateProcedure($pdo, 'SP_MENU_X_ROL_PARAMENU', "
    CREATE PROCEDURE `SP_MENU_X_ROL_PARAMENU`(IN p_rol_id INT)
    BEGIN
      SELECT
        td_menu_detalle.mend_id,
        menu.men_id,
        menu.men_vista,
        menu.men_icon,
        menu.men_ruta,
        td_menu_detalle.vista_inicio,
        menu.grupo_id,
        menu.orden,
        td_menu_detalle.mend_permi
      FROM
        td_menu_detalle
        INNER JOIN menu ON td_menu_detalle.men_id = menu.men_id 
      WHERE
        td_menu_detalle.rol_id = p_rol_id 
        AND menu.estado = 1 
        AND td_menu_detalle.mend_permi = 'Si';
    END");

    echo "Permissions Restoration V8.1 completed successfully.<br>";

} catch (Exception $e) {
    if (isset($pdo)) {
        $pdo->exec("SET FOREIGN_KEY_CHECKS = 1;");
    }
    echo "Error: " . $e->getMessage() . "<br>";
    echo "File: " . $e->getFile() . " on line " . $e->getLine() . "<br>";
}
