<?php
require_once __DIR__ . '/model/modelo_conexion.php';

function executeQuery($pdo, $sql, $params = [])
{
    try {
        $stmt = $pdo->prepare($sql);
        $stmt->execute($params);
        return true;
    } catch (Exception $e) {
        echo "Error executing query: " . $e->getMessage() . "\n";
        return false;
    }
}

$pdo = conexionBD::conexionPDO();
$pdo->exec("SET FOREIGN_KEY_CHECKS = 0;");

echo "Restaurando Roles...\n";
$roles = [
    [1, 'Administrador', '2022-02-13', 'ACTIVO'],
    [2, 'Recepcionista', '2022-02-13', 'ACTIVO'],
    [3, 'Vendedor', '2022-03-02', 'ACTIVO'],
    [4, 'Tecnico', '2024-01-22', 'ACTIVO'],
    [5, 'Almacenero', '2024-02-14', 'ACTIVO'],
    [6, 'Cliente', '2024-02-14', 'ACTIVO']
];
$pdo->exec("TRUNCATE TABLE rol;");
foreach ($roles as $r) {
    executeQuery($pdo, "INSERT INTO rol (rol_id, rol_nombre, rol_fregistro, rol_estado) VALUES (?, ?, ?, ?)", $r);
}

echo "Restaurando Configuracion...\n";
$pdo->exec("TRUNCATE TABLE configuracion;");
$pdo->exec("INSERT INTO `configuracion` VALUES (3, 'MI TIENDA DE CELULARES', '1020305648', 'GUSTAVO MASIAS', 'PIURA -PAITA', '922804671', '725632', 'gmasiasdeveloper@gmail.com', 'controller/empresa/foto/LOGO152202410329.jpg', 'ACTIVO', 'http://localhost/sertecver2_nueva/tienda/reparaciones.php', 'INTERBANK', '2548-1463-1263-7895', 'YAPE', '922804671', '$', '20701', 'IGV', 0.18, 'SOLES', 'CENTIMOS', 'SISTEMA SERTEC', 'https://localhost/sertecver2_nueva/admin', '+51', 'worhuswxrqxbwnlf', NULL);");

echo "Restaurando Sucursales...\n";
$pdo->exec("TRUNCATE TABLE sucursales;");
$pdo->exec("INSERT INTO `sucursales` VALUES (1, 3, 'Sucursal Principal', '2050230125565', '92256312', 'calle los jasmines', 'sucursal1@gmail.com', 'Activo', 1, '2025-06-03 22:56:46', NULL, NULL);");

echo "Restaurando Motivo...\n";
$pdo->exec("TRUNCATE TABLE motivo;");
$pdo->exec("INSERT INTO `motivo` VALUES (1, 'Matenimiento', 'ACTIVO');");
$pdo->exec("INSERT INTO `motivo` VALUES (2, 'Garantia ', 'ACTIVO');");
$pdo->exec("INSERT INTO `motivo` VALUES (3, 'Reparacion', 'ACTIVO');");
$pdo->exec("INSERT INTO `motivo` VALUES (4, 'Traspaso Datos', 'ACTIVO');");

echo "Restaurando Marca...\n";
$pdo->exec("TRUNCATE TABLE marca;");
$pdo->exec("INSERT INTO `marca` VALUES (1, 'GENERICO', 'ACTIVO');");
$pdo->exec("INSERT INTO `marca` VALUES (2, 'SAMSUNG ', 'ACTIVO');");
$pdo->exec("INSERT INTO `marca` VALUES (3, 'LG', 'ACTIVO');");
$pdo->exec("INSERT INTO `marca` VALUES (4, 'HONOR', 'ACTIVO');");
$pdo->exec("INSERT INTO `marca` VALUES (5, 'MOTOROLA', 'ACTIVO');");
$pdo->exec("INSERT INTO `marca` VALUES (6, 'ZTE', 'ACTIVO');");
$pdo->exec("INSERT INTO `marca` VALUES (7, 'HUAWEI', 'ACTIVO');");
$pdo->exec("INSERT INTO `marca` VALUES (8, 'XIAOMI', 'ACTIVO');");

echo "Restaurando Categoria...\n";
$pdo->exec("TRUNCATE TABLE categoria;");
$pdo->exec("INSERT INTO `categoria` VALUES (1, 'Generico', 'ACTIVO');");
$pdo->exec("INSERT INTO `categoria` VALUES (2, 'Fundas', 'ACTIVO');");
$pdo->exec("INSERT INTO `categoria` VALUES (3, 'Cargadores', 'ACTIVO');");

echo "Restaurando Forma de Pago...\n";
$pdo->exec("TRUNCATE TABLE forma_pago;");
$pdo->exec("INSERT INTO `forma_pago` VALUES (1, 'EFECTIVO', 'ACTIVO');");
$pdo->exec("INSERT INTO `forma_pago` VALUES (2, 'TARJETA', 'ACTIVO');");
$pdo->exec("INSERT INTO `forma_pago` VALUES (3, 'EFECTIVO Y OTROS', 'ACTIVO');");
$pdo->exec("INSERT INTO `forma_pago` VALUES (5, 'CREDITO', 'ACTIVO');");
$pdo->exec("INSERT INTO `forma_pago` VALUES (6, 'YAPE', 'INACTIVO');");
$pdo->exec("INSERT INTO `forma_pago` VALUES (7, 'PLIN', 'INACTIVO');");

echo "Restaurando Comprobante...\n";
$pdo->exec("TRUNCATE TABLE comprobante;");
$pdo->exec("INSERT INTO `comprobante` VALUES (1, 'BOLETA', 'B001', '9', 'ACTIVO');");
$pdo->exec("INSERT INTO `comprobante` VALUES (2, 'FACTURA', 'F001', '7', 'ACTIVO');");
$pdo->exec("INSERT INTO `comprobante` VALUES (3, 'TICKET', '0001', '1', 'ACTIVO');");
$pdo->exec("INSERT INTO `comprobante` VALUES (4, 'COTIZACION', 'C001', '000001', 'ACTIVO');");
$pdo->exec("INSERT INTO `comprobante` VALUES (11, 'FACTURA FISCAL', 'F010', '6', 'INACTIVO');");

echo "Restaurando Unidad Medida...\n";
$pdo->exec("TRUNCATE TABLE unidadmedida;");
$pdo->exec("INSERT INTO `unidadmedida` VALUES (1, 'Caja', 'CJA', 'ACTIVO');");
$pdo->exec("INSERT INTO `unidadmedida` VALUES (3, 'Bolsa', 'Bl', 'ACTIVO');");
$pdo->exec("INSERT INTO `unidadmedida` VALUES (4, 'PIEZAS', 'PZ', 'ACTIVO');");

echo "Ajustando Roles de Usuarios creados...\n";
// Tommy ya tiene rol 1 (Admin)
// Miguel (rol 3 en V7 era Tecnico, ahora rol 4 es Tecnico)
$pdo->exec("UPDATE usuario SET rol_id = 4 WHERE usu_nombre = 'Miguel';");
// Alicia (rol 4 en V7 era Vendedor, ahora rol 3 es Vendedor)
$pdo->exec("UPDATE usuario SET rol_id = 3 WHERE usu_nombre = 'Alicia';");

echo "Restaurando Procedimientos de Selección...\n";
$sps = [
    "DROP PROCEDURE IF EXISTS `SP_LISTAR_SELECT_ALMACENES`;",
    "CREATE DEFINER=`tecnopvsertec`@`%` PROCEDURE `SP_LISTAR_SELECT_ALMACENES`()
BEGIN
SELECT
	a.id_almacen, 
	a.descripcion_al, 
	a.codigo_al
FROM
	almacen AS a
	WHERE a.estado_al = 'Activo';
		
END",
    "DROP PROCEDURE IF EXISTS `SP_LISTAR_SELECT_ANIO_VENTA`;",
    "CREATE DEFINER=`tecnopvsertec`@`%` PROCEDURE `SP_LISTAR_SELECT_ANIO_VENTA`()
SELECT YEAR(venta_fregistro) as anio FROM venta
where venta_estado <> 'ANULADA' 
GROUP BY YEAR(venta_fregistro)",
    "DROP PROCEDURE IF EXISTS `SP_LISTAR_SELECT_CATEGORIA`;",
    "CREATE DEFINER=`tecnopvsertec`@`%` PROCEDURE `SP_LISTAR_SELECT_CATEGORIA`()
SELECT * FROM categoria WHERE categoria.categoria_estado = 'ACTIVO'",
    "DROP PROCEDURE IF EXISTS `SP_LISTAR_SELECT_CLIENTE`;",
    "CREATE DEFINER=`tecnopvsertec`@`%` PROCEDURE `SP_LISTAR_SELECT_CLIENTE`(IN p_idsucursal INT)
SELECT cliente_id,
CONCAT_WS(' | ',cliente_nombres,cliente_dni) as cliente,
cliente_estado,
cliente_listanegra
 FROM cliente WHERE cliente_estado= 'ACTIVO'  AND id_sucu = p_idsucursal	ORDER BY cliente_id DESC",
    "DROP PROCEDURE IF EXISTS `SP_LISTAR_SELECT_COMPROBANTE`;",
    "CREATE DEFINER=`tecnopvsertec`@`%` PROCEDURE `SP_LISTAR_SELECT_COMPROBANTE`()
SELECT * FROM comprobante WHERE comprobante.compro_estado= 'ACTIVO' and compro_tipo not in ('COTIZACION')",
    "DROP PROCEDURE IF EXISTS `SP_LISTAR_SELECT_COMP_COTIZACION`;",
    "CREATE DEFINER=`tecnopvsertec`@`%` PROCEDURE `SP_LISTAR_SELECT_COMP_COTIZACION`()
SELECT * FROM comprobante WHERE compro_tipo like '%coti%' and comprobante.compro_estado= 'ACTIVO'",
    "DROP PROCEDURE IF EXISTS `SP_LISTAR_SELECT_FOR_PAGO`;",
    "CREATE DEFINER=`tecnopvsertec`@`%` PROCEDURE `SP_LISTAR_SELECT_FOR_PAGO`()
SELECT
	forma_pago.fpago_id, 
	forma_pago.fpago_descripcion
FROM
	forma_pago
	WHERE fpago_estado = 'ACTIVO'",
    "DROP PROCEDURE IF EXISTS `SP_LISTAR_SELECT_MARCA`;",
    "CREATE DEFINER=`tecnopvsertec`@`%` PROCEDURE `SP_LISTAR_SELECT_MARCA`()
SELECT * FROM marca WHERE marca.marca_estado= 'ACTIVO'
ORDER BY marca.marca_id DESC",
    "DROP PROCEDURE IF EXISTS `SP_LISTAR_SELECT_MOTIVO`;",
    "CREATE DEFINER=`tecnopvsertec`@`%` PROCEDURE `SP_LISTAR_SELECT_MOTIVO`()
SELECT * FROM motivo WHERE motivo_estado= 'ACTIVO'",
    "DROP PROCEDURE IF EXISTS `SP_LISTAR_SELECT_PRODUCTO`;",
    "CREATE DEFINER=`tecnopvsertec`@`%` PROCEDURE `SP_LISTAR_SELECT_PRODUCTO`()
SELECT producto_id, CONCAT_WS(' - ',producto_codigo, producto_nombre) as nombre  FROM producto where producto_estado = 'ACTIVO'
ORDER BY producto_id desc",
    "DROP PROCEDURE IF EXISTS `SP_LISTAR_SELECT_PRODUCTO_REPARACION_INSUMO`;",
    "CREATE DEFINER=`tecnopvsertec`@`%` PROCEDURE `SP_LISTAR_SELECT_PRODUCTO_REPARACION_INSUMO`(IN p_idalmacen INT, IN p_rolid INT)
BEGIN
	SELECT 
		s.producto_id, 
		CONCAT(p.producto_nombre, '  | Stock: ', s.cantidad_s) AS nombre,
		s.cantidad_s AS stock,
		s.precio_venta_s AS precio_venta,
		s.precio_uni AS precio_compra,
		s.id_almacen
	FROM stock s
	INNER JOIN producto p ON s.producto_id = p.producto_id
	WHERE 
		p.producto_estado = 'ACTIVO'
		AND p.pro_imei = 'No'
		AND (s.id_almacen = p_idalmacen )
	ORDER BY s.producto_id DESC;
END",
    "DROP PROCEDURE IF EXISTS `SP_LISTAR_SELECT_PRODUCTO_VENTA`;",
    "CREATE DEFINER=`tecnopvsertec`@`%` PROCEDURE `SP_LISTAR_SELECT_PRODUCTO_VENTA`(IN p_descrip VARCHAR(100))
SELECT   producto_id, 
CONCAT(producto_codigo_general,' | ' ,producto_nombre, '  | Stock: ', producto_stock) as nombre,
producto_stock as stock, 
producto_pventa as precio_venta,
pro_imei
FROM producto 
where producto_estado = 'ACTIVO'
AND (producto_nombre LIKE CONCAT('%', p_descrip, '%') OR producto_id LIKE CONCAT('%', p_descrip, '%') OR producto_codigo_general LIKE CONCAT('%', p_descrip, '%'))
ORDER BY producto_id desc",
    "DROP PROCEDURE IF EXISTS `SP_LISTAR_SELECT_PROVEEDOR`;",
    "CREATE DEFINER=`tecnopvsertec`@`%` PROCEDURE `SP_LISTAR_SELECT_PROVEEDOR`()
SELECT * FROM cliente WHERE cliente.cliente_estado= 'ACTIVO' and cliente_tipo_doc = 'R.U.C'",
    "DROP PROCEDURE IF EXISTS `SP_LISTAR_SELECT_ROL`;",
    "CREATE DEFINER=`tecnopvsertec`@`%` PROCEDURE `SP_LISTAR_SELECT_ROL`()
SELECT * FROM rol WHERE rol_estado = 'ACTIVO'",
    "DROP PROCEDURE IF EXISTS `SP_LISTAR_SELECT_SUCURSAL`;",
    "CREATE DEFINER=`tecnopvsertec`@`%` PROCEDURE `SP_LISTAR_SELECT_SUCURSAL`()
BEGIN
SELECT id_sucu, nombre_su FROM sucursales WHERE estado_su = 'Activo';
END",
    "DROP PROCEDURE IF EXISTS `SP_LISTAR_SELECT_TECNICOS`;",
    "CREATE DEFINER=`tecnopvsertec`@`%` PROCEDURE `SP_LISTAR_SELECT_TECNICOS`()
BEGIN
	SELECT
		usu_id,
		usu_nombre 
	FROM
		usuario 
	WHERE
		rol_id IN ( '4', '1') 
		AND usu_estado = 'ACTIVO';
END",
    "DROP PROCEDURE IF EXISTS `SP_LISTAR_SELECT_UNIDAD`;",
    "CREATE DEFINER=`tecnopvsertec`@`%` PROCEDURE `SP_LISTAR_SELECT_UNIDAD`()
SELECT
	unidadmedida.unidad_id, 
  CONCAT_WS(' | ',unidadmedida.unidad_descripcion, unidadmedida.unidad_abrevia) as descripcion, 
	unidadmedida.unidad_estado
FROM
	unidadmedida
	where unidad_estado = 'ACTIVO'",
    "DROP PROCEDURE IF EXISTS `SP_LISTAR_SELECT_USUARIO_RECORD`;",
    "CREATE DEFINER=`tecnopvsertec`@`%` PROCEDURE `SP_LISTAR_SELECT_USUARIO_RECORD`()
Select usu_id,usu_nombre from usuario where usu_estado ='ACTIVO'"
];

foreach ($sps as $sql) {
    if ($pdo->exec($sql) === false) {
        $error = $pdo->errorInfo();
        echo "Error in SQL: " . $sql . "\nError: " . $error[2] . "\n";
    }
}

$pdo->exec("SET FOREIGN_KEY_CHECKS = 1;");
echo "\nRestauración V12 completada exitosamente.\n";
?>