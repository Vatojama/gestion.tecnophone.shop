/*
 Navicat Premium Dump SQL

 Source Server         : Mysqll
 Source Server Type    : MySQL
 Source Server Version : 80030 (8.0.30)
 Source Host           : localhost:3306
 Source Schema         : dbsertec_multi

 Target Server Type    : MySQL
 Target Server Version : 80030 (8.0.30)
 File Encoding         : 65001

 Date: 27/09/2025 15:12:01
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for almacen
-- ----------------------------
DROP TABLE IF EXISTS `almacen`;
CREATE TABLE `almacen`  (
  `id_almacen` int NOT NULL AUTO_INCREMENT,
  `descripcion_al` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `codigo_al` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `estado_al` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `fecha_reg_al` datetime NULL DEFAULT NULL,
  `principal` varchar(2) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_almacen`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of almacen
-- ----------------------------
INSERT INTO `almacen` VALUES (1, 'Amacen Principal', 'ALMP01', 'Activo', '2025-06-03 22:41:32', 'Si');

-- ----------------------------
-- Table structure for banner
-- ----------------------------
DROP TABLE IF EXISTS `banner`;
CREATE TABLE `banner`  (
  `id_banner` int NOT NULL AUTO_INCREMENT,
  `descripcion_b` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `foto_b` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `fecha` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`id_banner`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 12 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of banner
-- ----------------------------
INSERT INTO `banner` VALUES (11, 'BNNE', 'controller/tienda/foto/BANNER95202515550.webp', '2025-05-09 15:51:32');

-- ----------------------------
-- Table structure for caja
-- ----------------------------
DROP TABLE IF EXISTS `caja`;
CREATE TABLE `caja`  (
  `caja_id` int NOT NULL AUTO_INCREMENT,
  `caja_descripcion` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `caja_monto_inicial` decimal(10, 2) NULL DEFAULT NULL,
  `caja_monto_final` decimal(10, 2) NULL DEFAULT NULL,
  `caja_monto_egreso` decimal(10, 2) NULL DEFAULT NULL,
  `caja_fecha_ap` date NULL DEFAULT NULL,
  `caja_fecha_cie` date NULL DEFAULT NULL,
  `caja_total_ingreso` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `caja_total_egreso` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `caja_monto_total` decimal(10, 2) NULL DEFAULT NULL,
  `caja_hora_aper` time NULL DEFAULT NULL,
  `caja_estado` enum('VIGENTE','CERRADO') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `caja_monto_servicio` decimal(10, 2) NULL DEFAULT NULL,
  `caja_total_servicio` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `caja_hora_cierre` time NULL DEFAULT NULL,
  `caja_monto_ingreso` decimal(10, 2) NULL DEFAULT NULL,
  `caja_coun_ingreso` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `id_sucu` int NOT NULL,
  `caja_abonos` decimal(10, 2) NULL DEFAULT NULL,
  PRIMARY KEY (`caja_id`) USING BTREE,
  INDEX `id_sucu`(`id_sucu` ASC) USING BTREE,
  CONSTRAINT `caja_ibfk_1` FOREIGN KEY (`id_sucu`) REFERENCES `sucursales` (`id_sucu`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 20 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of caja
-- ----------------------------

-- ----------------------------
-- Table structure for categoria
-- ----------------------------
DROP TABLE IF EXISTS `categoria`;
CREATE TABLE `categoria`  (
  `categoria_id` int NOT NULL AUTO_INCREMENT,
  `categoria_descripcion` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `categoria_estado` enum('ACTIVO','INACTIVO') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`categoria_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 19 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of categoria
-- ----------------------------
INSERT INTO `categoria` VALUES (1, 'Generico', 'ACTIVO');
INSERT INTO `categoria` VALUES (2, 'Fundas', 'ACTIVO');
INSERT INTO `categoria` VALUES (3, 'Cargadores', 'ACTIVO');

-- ----------------------------
-- Table structure for cliente
-- ----------------------------
DROP TABLE IF EXISTS `cliente`;
CREATE TABLE `cliente`  (
  `cliente_id` int NOT NULL AUTO_INCREMENT,
  `cliente_tipo_doc` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `cliente_nombres` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `cliente_celular` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `cliente_dni` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `cliente_fregistro` date NULL DEFAULT NULL,
  `cliente_estado` enum('ACTIVO','INACTIVO') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `cliente_direccion` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `cliente_ape_p` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `cliente_ape_m` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `cliente_correo` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `cliente_tipo` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `id_sucu` int NULL DEFAULT NULL,
  `cliente_listanegra` varchar(2) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`cliente_id`) USING BTREE,
  INDEX `id_sucu`(`id_sucu` ASC) USING BTREE,
  CONSTRAINT `cliente_ibfk_1` FOREIGN KEY (`id_sucu`) REFERENCES `sucursales` (`id_sucu`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 13 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of cliente
-- ----------------------------
INSERT INTO `cliente` VALUES (1, 'R.U.C', 'Publico General', '999999999', '99999999', '2023-06-12', 'ACTIVO', 'Paita', '', '', '', NULL, 1, 'Si');
INSERT INTO `cliente` VALUES (12, 'DNI', 'eryetre', '56456456456', '6456456', '2025-07-18', 'ACTIVO', 'ertetr', '', '', '', NULL, 1, 'Si');

-- ----------------------------
-- Table structure for comprobante
-- ----------------------------
DROP TABLE IF EXISTS `comprobante`;
CREATE TABLE `comprobante`  (
  `compro_id` int NOT NULL AUTO_INCREMENT,
  `compro_tipo` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `compro_serie` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `compro_numero` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `compro_estado` enum('ACTIVO','INACTIVO') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`compro_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 12 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of comprobante
-- ----------------------------
INSERT INTO `comprobante` VALUES (1, 'BOLETA', 'B001', '9', 'ACTIVO');
INSERT INTO `comprobante` VALUES (2, 'FACTURA', 'F001', '7', 'ACTIVO');
INSERT INTO `comprobante` VALUES (3, 'TICKET', '0001', '1', 'ACTIVO');
INSERT INTO `comprobante` VALUES (4, 'COTIZACION', 'C001', '000001', 'ACTIVO');
INSERT INTO `comprobante` VALUES (11, 'FACTURA FISCAL', 'F010', '6', 'INACTIVO');

-- ----------------------------
-- Table structure for configuracion
-- ----------------------------
DROP TABLE IF EXISTS `configuracion`;
CREATE TABLE `configuracion`  (
  `confi_id` int NOT NULL AUTO_INCREMENT,
  `confi_razon_social` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `confi_ruc` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `confi_nombre_representante` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `confi_direccion` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `confi_celular` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `confi_telefono` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `confi_correo` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `config_foto` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `confi_estado` enum('ACTIVO','INACTIVO') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `confi_url` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `confi_cnta01` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `confi_nro_cuenta01` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `confi_cnta02` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `confi_nro_cuenta02` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `confi_moneda` varchar(10) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `confi_codigo_pos` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `confi_tipo_igv` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `confi_igv` decimal(10, 2) NULL DEFAULT NULL,
  `confi_moneda1` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `confi_moneda2` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `confi_nombre_sistema` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `url_sistema` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `cod_pais` varchar(10) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `confi_clave_correo` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `confi_link_pagina` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`confi_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of configuracion
-- ----------------------------
INSERT INTO `configuracion` VALUES (3, 'MI TIENDA DE CELULARES', '1020305648', 'GUSTAVO MASIAS', 'PIURA -PAITA', '922804671', '725632', 'gmasiasdeveloper@gmail.com', 'controller/empresa/foto/LOGO152202410329.jpg', 'ACTIVO', 'http://localhost/sertecver2_nueva/tienda/reparaciones.php', 'INTERBANK', '2548-1463-1263-7895', 'YAPE', '922804671', '$', '20701', 'IGV', 0.18, 'SOLES', 'CENTIMOS', 'SISTEMA SERTEC', 'https://localhost/sertecver2_nueva/admin', '+51', 'worhuswxrqxbwnlf', NULL);

-- ----------------------------
-- Table structure for cotizacion
-- ----------------------------
DROP TABLE IF EXISTS `cotizacion`;
CREATE TABLE `cotizacion`  (
  `coti_id` int NOT NULL AUTO_INCREMENT,
  `cliente_id` int NULL DEFAULT NULL,
  `coti_comprobante` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `coti_serie` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `coti_num_comprobante` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `coti_total` decimal(10, 2) NULL DEFAULT NULL,
  `coti_impuesto` decimal(10, 2) NULL DEFAULT NULL,
  `coti_fregistro` date NULL DEFAULT NULL,
  `coti_hora` time NULL DEFAULT NULL,
  `coti_estado` enum('ACTIVO','INACTIVO') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `compro_id` int NULL DEFAULT NULL,
  `coti_porcentaje` decimal(10, 2) NULL DEFAULT NULL,
  `usu_id` int NULL DEFAULT NULL,
  `coti_atiende` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `coti_dias` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `fpago_id` int NULL DEFAULT NULL,
  PRIMARY KEY (`coti_id`) USING BTREE,
  INDEX `prove_id`(`cliente_id` ASC) USING BTREE,
  INDEX `compro_id`(`compro_id` ASC) USING BTREE,
  INDEX `usu_id`(`usu_id` ASC) USING BTREE,
  INDEX `fpago_id`(`fpago_id` ASC) USING BTREE,
  CONSTRAINT `cotizacion_ibfk_1` FOREIGN KEY (`cliente_id`) REFERENCES `cliente` (`cliente_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `cotizacion_ibfk_2` FOREIGN KEY (`compro_id`) REFERENCES `comprobante` (`compro_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `cotizacion_ibfk_3` FOREIGN KEY (`usu_id`) REFERENCES `usuario` (`usu_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `cotizacion_ibfk_4` FOREIGN KEY (`fpago_id`) REFERENCES `forma_pago` (`fpago_id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of cotizacion
-- ----------------------------

-- ----------------------------
-- Table structure for cotizacion_detalle
-- ----------------------------
DROP TABLE IF EXISTS `cotizacion_detalle`;
CREATE TABLE `cotizacion_detalle`  (
  `coti_detalle_id` int NOT NULL AUTO_INCREMENT,
  `coti_id` int NULL DEFAULT NULL,
  `producto_id` int NULL DEFAULT NULL,
  `coti_detalle_cantidad` decimal(10, 2) NULL DEFAULT NULL,
  `coti_detalle_precio` decimal(10, 2) NULL DEFAULT NULL,
  `coti_detalle_estado` enum('ACTIVO','INACTIVO') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `coti_detalle_fecha` date NULL DEFAULT NULL,
  PRIMARY KEY (`coti_detalle_id`) USING BTREE,
  INDEX `coti_id`(`coti_id` ASC) USING BTREE,
  INDEX `producto_id`(`producto_id` ASC) USING BTREE,
  CONSTRAINT `cotizacion_detalle_ibfk_1` FOREIGN KEY (`coti_id`) REFERENCES `cotizacion` (`coti_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `cotizacion_detalle_ibfk_2` FOREIGN KEY (`producto_id`) REFERENCES `producto` (`producto_id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of cotizacion_detalle
-- ----------------------------

-- ----------------------------
-- Table structure for detalle_pedido
-- ----------------------------
DROP TABLE IF EXISTS `detalle_pedido`;
CREATE TABLE `detalle_pedido`  (
  `pdetalle_id` int NOT NULL AUTO_INCREMENT,
  `pedido_id` int NULL DEFAULT NULL,
  `nro_pedido` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `producto_id` int NULL DEFAULT NULL,
  `pdetalle_cantidad` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `pdetalle_precio` decimal(10, 2) NULL DEFAULT NULL,
  `pdetalle_estado` enum('ANULADA','VENDIDO') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `pdetalle_fecha` date NULL DEFAULT NULL,
  `v_imei` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `pdetalle_descuento` decimal(10, 2) NULL DEFAULT NULL,
  `productodet` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`pdetalle_id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of detalle_pedido
-- ----------------------------

-- ----------------------------
-- Table structure for detalle_traslados
-- ----------------------------
DROP TABLE IF EXISTS `detalle_traslados`;
CREATE TABLE `detalle_traslados`  (
  `id_det_tras` int NOT NULL AUTO_INCREMENT,
  `id_traslado` int NULL DEFAULT NULL,
  `producto_id` int NULL DEFAULT NULL,
  `cantidad_t` int NULL DEFAULT NULL,
  `imei_t` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `fecha_r` datetime NULL DEFAULT NULL,
  `precio_v` decimal(10, 2) NULL DEFAULT NULL,
  `alm_destino_id` int NULL DEFAULT NULL,
  PRIMARY KEY (`id_det_tras`) USING BTREE,
  INDEX `id_traslado`(`id_traslado` ASC) USING BTREE,
  INDEX `producto_id`(`producto_id` ASC) USING BTREE,
  CONSTRAINT `detalle_traslados_ibfk_1` FOREIGN KEY (`id_traslado`) REFERENCES `traslados` (`id_traslado`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `detalle_traslados_ibfk_2` FOREIGN KEY (`producto_id`) REFERENCES `producto` (`producto_id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 16 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of detalle_traslados
-- ----------------------------

-- ----------------------------
-- Table structure for detalle_venta
-- ----------------------------
DROP TABLE IF EXISTS `detalle_venta`;
CREATE TABLE `detalle_venta`  (
  `vdetalle_id` int NOT NULL AUTO_INCREMENT,
  `venta_id` int NULL DEFAULT NULL,
  `producto_id` int NULL DEFAULT NULL,
  `vdetalle_cantidad` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `vdetalle_precio` decimal(10, 2) NULL DEFAULT NULL,
  `vdetalle_estado` enum('ANULADA','VENDIDO') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `vdetalle_fecha` date NULL DEFAULT NULL,
  `v_imei` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `vdetalle_descuento` decimal(10, 2) NULL DEFAULT NULL,
  `id_sucu` int NULL DEFAULT NULL,
  `id_almacen` int NULL DEFAULT NULL,
  `id_pro_imei` int NULL DEFAULT NULL,
  PRIMARY KEY (`vdetalle_id`) USING BTREE,
  INDEX `venta_id`(`venta_id` ASC) USING BTREE,
  INDEX `producto_id`(`producto_id` ASC) USING BTREE,
  CONSTRAINT `detalle_venta_ibfk_1` FOREIGN KEY (`venta_id`) REFERENCES `venta` (`venta_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `detalle_venta_ibfk_2` FOREIGN KEY (`producto_id`) REFERENCES `producto` (`producto_id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 63 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of detalle_venta
-- ----------------------------

-- ----------------------------
-- Table structure for forma_pago
-- ----------------------------
DROP TABLE IF EXISTS `forma_pago`;
CREATE TABLE `forma_pago`  (
  `fpago_id` int NOT NULL AUTO_INCREMENT,
  `fpago_descripcion` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `fpago_estado` enum('ACTIVO','INACTIVO') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`fpago_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of forma_pago
-- ----------------------------
INSERT INTO `forma_pago` VALUES (1, 'EFECTIVO', 'ACTIVO');
INSERT INTO `forma_pago` VALUES (2, 'TARJETA', 'ACTIVO');
INSERT INTO `forma_pago` VALUES (3, 'EFECTIVO Y OTROS', 'ACTIVO');
INSERT INTO `forma_pago` VALUES (5, 'CREDITO', 'ACTIVO');
INSERT INTO `forma_pago` VALUES (6, 'YAPE', 'INACTIVO');
INSERT INTO `forma_pago` VALUES (7, 'PLIN', 'INACTIVO');

-- ----------------------------
-- Table structure for gastos
-- ----------------------------
DROP TABLE IF EXISTS `gastos`;
CREATE TABLE `gastos`  (
  `gastos_id` int NOT NULL AUTO_INCREMENT,
  `gastos_descripcion` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `gastos_monto` decimal(10, 2) NOT NULL,
  `gastos_responsable` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `gastos_fregistro` date NULL DEFAULT NULL,
  `gastos_estado` enum('ACTIVO','INACTIVO') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `estado_caja` enum('ABIERTO','CERRADO') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `tipo_mov` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `id_sucu` int NOT NULL,
  `usu_id` int NULL DEFAULT NULL,
  PRIMARY KEY (`gastos_id`) USING BTREE,
  INDEX `id_sucu`(`id_sucu` ASC) USING BTREE,
  CONSTRAINT `gastos_ibfk_1` FOREIGN KEY (`id_sucu`) REFERENCES `sucursales` (`id_sucu`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 9 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of gastos
-- ----------------------------

-- ----------------------------
-- Table structure for grupos
-- ----------------------------
DROP TABLE IF EXISTS `grupos`;
CREATE TABLE `grupos`  (
  `grupo_id` int NOT NULL AUTO_INCREMENT,
  `men_grupo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `estado` int NULL DEFAULT NULL,
  `grupo_icon` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `fecha_reg` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`grupo_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 20 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of grupos
-- ----------------------------
INSERT INTO `grupos` VALUES (1, 'singrupo', 1, 'users', '2024-07-23 00:00:55');
INSERT INTO `grupos` VALUES (2, 'Usuario', 1, 'users', '2024-07-23 00:01:09');
INSERT INTO `grupos` VALUES (3, 'Comprobantes', 1, 'file-code', '2024-07-23 00:01:54');
INSERT INTO `grupos` VALUES (4, 'Configuracion', 1, 'building', '2024-07-23 00:02:21');
INSERT INTO `grupos` VALUES (5, 'Recepcion', 1, 'tags', '2024-07-23 00:02:58');
INSERT INTO `grupos` VALUES (6, 'Reparacion_t', 1, 'coins', '2024-07-24 22:47:57');
INSERT INTO `grupos` VALUES (7, 'Servicios', 1, 'coins', '2024-07-24 22:48:21');
INSERT INTO `grupos` VALUES (8, 'Caja', 1, 'cash-register', '2024-07-24 22:49:58');
INSERT INTO `grupos` VALUES (9, 'Productos', 1, 'box-open', '2024-07-24 22:54:44');
INSERT INTO `grupos` VALUES (10, 'Presupuesto', 1, 'box-open', '2024-07-24 23:01:28');
INSERT INTO `grupos` VALUES (11, 'ReporVentas', 1, 'file-alt', '2024-07-24 23:05:17');
INSERT INTO `grupos` VALUES (12, 'ReporProducto', 1, 'file-alt', '2024-07-24 23:05:35');
INSERT INTO `grupos` VALUES (13, 'Ventas', 1, 'file-alt', '2024-09-07 19:29:11');
INSERT INTO `grupos` VALUES (14, 'Clientes', 1, 'file-alt', '2024-09-07 19:30:35');
INSERT INTO `grupos` VALUES (15, 'ReporReparaciones', 1, 'file-alt', '2024-09-07 19:59:22');
INSERT INTO `grupos` VALUES (16, 'reporteGastos', 1, 'file-alt', '2024-09-07 20:02:05');
INSERT INTO `grupos` VALUES (17, 'Dashboard', 1, 'file-alt', '2024-09-18 00:50:22');
INSERT INTO `grupos` VALUES (18, 'Notas', 1, 'file-alt', '2024-09-20 09:58:36');
INSERT INTO `grupos` VALUES (19, 'Tienda', 1, 'file-alt', '2025-03-16 02:40:02');

-- ----------------------------
-- Table structure for kardex
-- ----------------------------
DROP TABLE IF EXISTS `kardex`;
CREATE TABLE `kardex`  (
  `kardex_id` int NOT NULL AUTO_INCREMENT,
  `kardex_fecha` date NULL DEFAULT NULL,
  `kardex_tipo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `kardex_ingreso` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `kardex_p_ingreso` decimal(10, 2) NULL DEFAULT NULL,
  `kardex_salida` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `kardex_p_salida` decimal(10, 2) NULL DEFAULT NULL,
  `kardex_total` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `kardex_precio_general` decimal(10, 2) NULL DEFAULT NULL,
  `producto_id` int NULL DEFAULT NULL,
  `vdetalle_id` int NULL DEFAULT NULL,
  `producto_nombre` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `producto_codigo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `venta_id` int NULL DEFAULT NULL,
  `venta_comprobante` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `tecnico` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `imei` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `id_sucu` int NULL DEFAULT NULL,
  `id_almacen` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`kardex_id`) USING BTREE,
  INDEX `producto_id`(`producto_id` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 151 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of kardex
-- ----------------------------

-- ----------------------------
-- Table structure for marca
-- ----------------------------
DROP TABLE IF EXISTS `marca`;
CREATE TABLE `marca`  (
  `marca_id` int NOT NULL AUTO_INCREMENT,
  `marca_descripcion` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `marca_estado` enum('ACTIVO','INACTIVO') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`marca_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 9 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of marca
-- ----------------------------
INSERT INTO `marca` VALUES (1, 'GENERICO', 'ACTIVO');
INSERT INTO `marca` VALUES (2, 'SAMSUNG ', 'ACTIVO');
INSERT INTO `marca` VALUES (3, 'LG', 'ACTIVO');
INSERT INTO `marca` VALUES (4, 'HONOR', 'ACTIVO');
INSERT INTO `marca` VALUES (5, 'MOTOROLA', 'ACTIVO');
INSERT INTO `marca` VALUES (6, 'ZTE', 'ACTIVO');
INSERT INTO `marca` VALUES (7, 'HUAWEI', 'ACTIVO');
INSERT INTO `marca` VALUES (8, 'XIAOMI', 'ACTIVO');

-- ----------------------------
-- Table structure for menu
-- ----------------------------
DROP TABLE IF EXISTS `menu`;
CREATE TABLE `menu`  (
  `men_id` int NOT NULL AUTO_INCREMENT,
  `men_vista` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `men_icon` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `men_ruta` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `estado` int NULL DEFAULT NULL,
  `grupo_id` int NULL DEFAULT NULL,
  `fecha_reg` datetime NULL DEFAULT NULL,
  `orden` int NULL DEFAULT NULL,
  PRIMARY KEY (`men_id`) USING BTREE,
  INDEX `grupo_id`(`grupo_id` ASC) USING BTREE,
  CONSTRAINT `menu_ibfk_1` FOREIGN KEY (`grupo_id`) REFERENCES `grupos` (`grupo_id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 37 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of menu
-- ----------------------------
INSERT INTO `menu` VALUES (1, 'Recepcion', 'circle', 'recepcion/mantenimiento_recepcion.php', 1, 5, '2024-07-24 22:46:24', 1);
INSERT INTO `menu` VALUES (2, 'Motivo', 'circle', 'motivo/mantenimiento_motivo.php', 1, 5, '2024-07-24 22:47:00', 2);
INSERT INTO `menu` VALUES (3, 'Reparaciones Tec.', 'mobile-alt', 'reparaciones/mantenimiento_reparacion.php', 1, 6, '2024-07-24 22:48:29', 3);
INSERT INTO `menu` VALUES (4, 'Terminar Repar.', 'hand-holding-usd', 'servicio/mantenimiento_servicio.php', 1, 7, '2024-07-24 22:49:27', 4);
INSERT INTO `menu` VALUES (5, 'Caja', 'circle', 'caja/mantenimiento_caja.php', 1, 8, '2024-07-24 22:50:26', 5);
INSERT INTO `menu` VALUES (6, 'Movimientos', 'circle', 'gasto/mantenimiento_gasto.php', 1, 8, '2024-07-24 22:51:03', 6);
INSERT INTO `menu` VALUES (7, 'Ventas', 'cash-register', 'venta/mantenimiento_venta.php', 1, 13, '2024-07-24 22:52:11', 7);
INSERT INTO `menu` VALUES (8, 'Clientes', 'user-friends', 'cliente/mantenimiento_cliente.php', 1, 14, '2024-07-24 22:53:19', 8);
INSERT INTO `menu` VALUES (9, 'Productos', 'circle', 'producto/mantenimiento_producto.php', 1, 9, '2024-07-24 22:55:20', 9);
INSERT INTO `menu` VALUES (10, 'Categoria', 'circle', 'categoria/mantenimiento_categoria.php', 1, 9, '2024-07-24 22:55:53', 10);
INSERT INTO `menu` VALUES (11, 'Marca', 'circle', 'marca/mantenimiento_marca.php', 1, 9, '2024-07-24 22:56:46', 11);
INSERT INTO `menu` VALUES (12, 'Unidad Med.', 'circle', 'medida/mantenimiento_medida.php', 1, 9, '2024-07-24 22:56:49', 12);
INSERT INTO `menu` VALUES (13, 'Presupuesto', 'circle', 'cotizacion/mantenimiento_cotizacion.php', 1, 10, '2024-07-24 23:02:07', 23);
INSERT INTO `menu` VALUES (14, 'Tipo Pago', 'circle', 'forma_pago/mantenimiento_forma_pago.php', 1, 10, '2024-07-24 23:02:50', 24);
INSERT INTO `menu` VALUES (15, 'Usuarios', 'circle', 'usuario/mantenimiento_usuario.php', 1, 2, '2024-07-23 00:03:52', 13);
INSERT INTO `menu` VALUES (16, 'Roles', 'circle', 'rol/mantenimiento_rol.php', 1, 2, '2024-07-23 00:04:49', 14);
INSERT INTO `menu` VALUES (17, 'Comprobantes', 'file', 'configuracion/mantenimiento_comprobante.php', 1, 4, '2024-07-23 00:05:36', 25);
INSERT INTO `menu` VALUES (18, 'Empresa', 'building', 'configuracion/mantenimiento_configuracion.php', 1, 4, '2024-08-02 23:54:02', 23);
INSERT INTO `menu` VALUES (19, 'Reporte Reparaciones', 'file-alt', 'reporteservicio/mantenimiento_reporte_servicio.php', 1, 15, '2024-07-24 23:04:07', 15);
INSERT INTO `menu` VALUES (20, 'Reporte Gastos', 'file-alt', 'reportegasto/mantenimiento_reporte_gasto.php', 1, 16, '2024-07-24 23:04:33', 16);
INSERT INTO `menu` VALUES (21, 'Reporte Ventas', 'circle', 'reporteventa/mantenimiento_reporte_venta.php', 1, 11, '2024-07-24 23:06:09', 17);
INSERT INTO `menu` VALUES (22, 'Pivot', 'circle', 'reporteventa/mantenimiento_pivot.php', 1, 11, '2024-07-24 23:06:43', 18);
INSERT INTO `menu` VALUES (23, 'Por Producto', 'circle', 'reporteproducto/mantenimiento_reporte_producto.php', 1, 12, '2024-07-24 23:08:02', 19);
INSERT INTO `menu` VALUES (24, 'Producto - utilidad', 'circle', 'reporteproducto/mantenimiento_utilidad.php', 1, 12, '2024-07-24 23:09:42', 20);
INSERT INTO `menu` VALUES (25, 'Kardex', 'circle', 'reporteproducto/mantenimiento_kardex.php', 1, 12, '2024-07-24 23:10:43', 22);
INSERT INTO `menu` VALUES (26, 'Imei Mov', 'circle', 'reporteproducto/mantenimiento_mov_imei.php', 1, 12, '2024-07-24 23:10:15', 21);
INSERT INTO `menu` VALUES (27, 'Dashboard', 'circle', 'dashboard/mantenimiento_dashboard.php', 1, 17, '2024-09-18 00:50:35', 25);
INSERT INTO `menu` VALUES (28, 'Notas', 'circle', 'notas/mantenimiento_notas.php', 1, 18, '2024-09-20 09:58:47', 26);
INSERT INTO `menu` VALUES (29, 'Banner', 'circle', 'tienda/mant_banner.php', 1, 19, '2025-03-16 02:40:15', 27);
INSERT INTO `menu` VALUES (30, 'Pedido', 'circle', 'tienda/mant_pedido.php', 1, 19, '2025-04-03 18:34:13', 28);
INSERT INTO `menu` VALUES (31, 'Servicios', 'circle', 'tienda/mant_servi.php', 1, 19, '2025-05-06 15:56:06', 29);
INSERT INTO `menu` VALUES (32, 'Sucursales', 'circle', 'configuracion/mantenimiento_sucursal.php', 1, 4, '2025-06-03 21:37:50', 30);
INSERT INTO `menu` VALUES (33, 'Almacen', 'circle', 'configuracion/mantenimiento_almacen.php', 1, 4, '2025-06-05 01:46:13', 31);
INSERT INTO `menu` VALUES (34, 'Traslados', 'circle', 'producto/mantenimiento_traslado.php', 1, 9, '2025-06-11 11:44:58', 32);
INSERT INTO `menu` VALUES (35, 'Proveedor', 'circle', 'cliente/mantenimiento_proveedor.php', 1, 14, '2025-07-09 00:21:05', 33);
INSERT INTO `menu` VALUES (36, 'Recepcion x Cliente', 'circle', 'recepcion/mantenimiento_buscar_recep_cliente.php', 1, 5, '2025-08-20 23:58:43', 34);

-- ----------------------------
-- Table structure for motivo
-- ----------------------------
DROP TABLE IF EXISTS `motivo`;
CREATE TABLE `motivo`  (
  `motivo_id` int NOT NULL AUTO_INCREMENT,
  `motivo_descripcion` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `motivo_estado` enum('ACTIVO','INACTIVO') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`motivo_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of motivo
-- ----------------------------
INSERT INTO `motivo` VALUES (1, 'Matenimiento', 'ACTIVO');
INSERT INTO `motivo` VALUES (2, 'Garantia ', 'ACTIVO');
INSERT INTO `motivo` VALUES (3, 'Reparacion', 'ACTIVO');
INSERT INTO `motivo` VALUES (4, 'Traspaso Datos', 'ACTIVO');

-- ----------------------------
-- Table structure for movimientos
-- ----------------------------
DROP TABLE IF EXISTS `movimientos`;
CREATE TABLE `movimientos`  (
  `id_mov` int NOT NULL AUTO_INCREMENT,
  `producto_id` int NULL DEFAULT NULL,
  `id_almacen` int NULL DEFAULT NULL,
  `cantidad` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `tipo_movimiento` varchar(120) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `referencia_id` int NULL DEFAULT NULL,
  `fecha_reg` datetime NULL DEFAULT NULL,
  `usuario_id` int NULL DEFAULT NULL,
  `observacion` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `precio_unitario` decimal(10, 2) NULL DEFAULT NULL,
  `imei` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `precio_venta_t` decimal(10, 2) NULL DEFAULT NULL,
  `tecnico` int NULL DEFAULT NULL,
  `id_sucu` int NULL DEFAULT NULL,
  `compro_venta` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `id_detalleventa` int NULL DEFAULT NULL,
  `idimei` int NULL DEFAULT NULL,
  PRIMARY KEY (`id_mov`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 219 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of movimientos
-- ----------------------------

-- ----------------------------
-- Table structure for notas
-- ----------------------------
DROP TABLE IF EXISTS `notas`;
CREATE TABLE `notas`  (
  `nota_id` int NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `estado` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `fecha` datetime NULL DEFAULT NULL,
  `usu_id` int NULL DEFAULT NULL,
  PRIMARY KEY (`nota_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 9 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of notas
-- ----------------------------

-- ----------------------------
-- Table structure for pedido
-- ----------------------------
DROP TABLE IF EXISTS `pedido`;
CREATE TABLE `pedido`  (
  `pedido_id` int NOT NULL AUTO_INCREMENT,
  `nro_pedido` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `cliente_id` int NULL DEFAULT NULL,
  `dni` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `nombres` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `telefono` int NULL DEFAULT NULL,
  `direccion` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `correo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `usu` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `clave` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `detalle` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `monto_t` decimal(10, 2) NULL DEFAULT NULL,
  `impuesto` decimal(10, 2) NULL DEFAULT NULL,
  `descuento` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `fecha` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`pedido_id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of pedido
-- ----------------------------

-- ----------------------------
-- Table structure for pedido_bitacora
-- ----------------------------
DROP TABLE IF EXISTS `pedido_bitacora`;
CREATE TABLE `pedido_bitacora`  (
  `id_segui` int NOT NULL AUTO_INCREMENT,
  `pedido_id` int NOT NULL,
  `pedido_correlativo` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `fecha_segui` datetime NULL DEFAULT NULL,
  `estado_segui` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `descrip_segui` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `total_segui` decimal(10, 2) NULL DEFAULT NULL,
  `documento_segui` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_segui`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 30 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of pedido_bitacora
-- ----------------------------

-- ----------------------------
-- Table structure for pedido_detalle_n
-- ----------------------------
DROP TABLE IF EXISTS `pedido_detalle_n`;
CREATE TABLE `pedido_detalle_n`  (
  `detalle_id` int NOT NULL AUTO_INCREMENT,
  `pedido_id` int NULL DEFAULT NULL,
  `producto_nombre` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `cantidad` int NULL DEFAULT NULL,
  `precio` decimal(10, 2) NULL DEFAULT NULL,
  `producto_id` int NULL DEFAULT NULL,
  `pedido_estado` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `pedido_fecha` datetime NULL DEFAULT NULL,
  `pedido_desc` decimal(10, 2) NULL DEFAULT NULL,
  PRIMARY KEY (`detalle_id`) USING BTREE,
  INDEX `pedido_detalle_n_ibfk_1`(`pedido_id` ASC) USING BTREE,
  CONSTRAINT `pedido_detalle_n_ibfk_1` FOREIGN KEY (`pedido_id`) REFERENCES `pedido_n` (`pedido_id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 181 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of pedido_detalle_n
-- ----------------------------

-- ----------------------------
-- Table structure for pedido_n
-- ----------------------------
DROP TABLE IF EXISTS `pedido_n`;
CREATE TABLE `pedido_n`  (
  `pedido_id` int NOT NULL AUTO_INCREMENT,
  `cliente_id` int NULL DEFAULT NULL,
  `pedido_fecha` datetime NULL DEFAULT NULL,
  `pedido_total` decimal(10, 2) NULL DEFAULT NULL,
  `pedido_estado` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `pedido_correlativo` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`pedido_id`) USING BTREE,
  INDEX `cliente_id`(`cliente_id` ASC) USING BTREE,
  CONSTRAINT `pedido_n_ibfk_1` FOREIGN KEY (`cliente_id`) REFERENCES `cliente` (`cliente_id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 88 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of pedido_n
-- ----------------------------

-- ----------------------------
-- Table structure for plan
-- ----------------------------
DROP TABLE IF EXISTS `plan`;
CREATE TABLE `plan`  (
  `plan_id` int NOT NULL AUTO_INCREMENT,
  `plan_nombre_cli` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `descripcion` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `plan_ini` datetime NULL DEFAULT NULL,
  `plan_fin` datetime NULL DEFAULT NULL,
  `plan_monto` decimal(10, 2) NULL DEFAULT NULL,
  `plan_estado` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `plan_correo` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`plan_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of plan
-- ----------------------------
INSERT INTO `plan` VALUES (1, 'Gustavo M', 'Mensual', '2024-09-07 20:43:57', '2024-10-07 20:44:00', 25.00, 'Activo', NULL);

-- ----------------------------
-- Table structure for producto
-- ----------------------------
DROP TABLE IF EXISTS `producto`;
CREATE TABLE `producto`  (
  `producto_id` int NOT NULL AUTO_INCREMENT,
  `producto_codigo` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `producto_nombre` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `marca_id` int NULL DEFAULT NULL,
  `categoria_id` int NULL DEFAULT NULL,
  `producto_stock` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `producto_pcompra` decimal(10, 2) NULL DEFAULT NULL,
  `producto_pventa` decimal(10, 2) NULL DEFAULT NULL,
  `producto_fregistro` date NULL DEFAULT NULL,
  `producto_estado` enum('ACTIVO','INACTIVO') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `producto_stock_inicial` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `producto_aumento` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `producto_codigo_general` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `cliente_id` int NULL DEFAULT NULL,
  `producto_foto` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `unidad_id` int NULL DEFAULT NULL,
  `pro_imei` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `producto_tienda` varchar(4) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `producto_descrip_l` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `id_sucu` int NULL DEFAULT NULL,
  `producto_pcomercial` decimal(10, 2) NULL DEFAULT NULL,
  `producto_pmayorista` decimal(10, 2) NULL DEFAULT NULL,
  PRIMARY KEY (`producto_id`) USING BTREE,
  INDEX `marca_id`(`marca_id` ASC) USING BTREE,
  INDEX `categoria_id`(`categoria_id` ASC) USING BTREE,
  INDEX `prove_id`(`cliente_id` ASC) USING BTREE,
  INDEX `unidad_id`(`unidad_id` ASC) USING BTREE,
  CONSTRAINT `producto_ibfk_1` FOREIGN KEY (`marca_id`) REFERENCES `marca` (`marca_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `producto_ibfk_2` FOREIGN KEY (`categoria_id`) REFERENCES `categoria` (`categoria_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `producto_ibfk_4` FOREIGN KEY (`unidad_id`) REFERENCES `unidadmedida` (`unidad_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `producto_ibfk_5` FOREIGN KEY (`cliente_id`) REFERENCES `cliente` (`cliente_id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 42 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of producto
-- ----------------------------

-- ----------------------------
-- Table structure for producto_detalle
-- ----------------------------
DROP TABLE IF EXISTS `producto_detalle`;
CREATE TABLE `producto_detalle`  (
  `id_prod_imei` int NOT NULL AUTO_INCREMENT,
  `producto_id` int NOT NULL,
  `imei` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `fecha` date NULL DEFAULT NULL,
  `vendido` varchar(5) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_prod_imei`, `producto_id`) USING BTREE,
  UNIQUE INDEX `imei`(`imei` ASC) USING BTREE,
  INDEX `producto_id`(`producto_id` ASC) USING BTREE,
  CONSTRAINT `producto_detalle_ibfk_1` FOREIGN KEY (`producto_id`) REFERENCES `producto` (`producto_id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 66 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of producto_detalle
-- ----------------------------

-- ----------------------------
-- Table structure for proveedor
-- ----------------------------
DROP TABLE IF EXISTS `proveedor`;
CREATE TABLE `proveedor`  (
  `prove_id` int NOT NULL AUTO_INCREMENT,
  `prove_ruc` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `prove_razon` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `prove_direccion` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `prove_celular` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `prove_fregistro` date NULL DEFAULT NULL,
  `prove_estado` enum('ACTIVO','INACTIVO') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`prove_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of proveedor
-- ----------------------------

-- ----------------------------
-- Table structure for recep_equipo
-- ----------------------------
DROP TABLE IF EXISTS `recep_equipo`;
CREATE TABLE `recep_equipo`  (
  `id_equipo` int NOT NULL AUTO_INCREMENT,
  `rece_id` int NOT NULL,
  `equipo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `serie` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `monto` decimal(10, 2) NULL DEFAULT NULL,
  `abono` decimal(10, 2) NULL DEFAULT NULL,
  `pendiente` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `fecha` date NULL DEFAULT NULL,
  `falla` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `diagnostico` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_equipo`) USING BTREE,
  INDEX `rece_id`(`rece_id` ASC) USING BTREE,
  CONSTRAINT `recep_equipo_ibfk_1` FOREIGN KEY (`rece_id`) REFERENCES `recepcion` (`rece_id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 27 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of recep_equipo
-- ----------------------------

-- ----------------------------
-- Table structure for recep_insumos
-- ----------------------------
DROP TABLE IF EXISTS `recep_insumos`;
CREATE TABLE `recep_insumos`  (
  `id_insumo` int NOT NULL AUTO_INCREMENT,
  `rece_id` int NULL DEFAULT NULL,
  `producto_id` int NULL DEFAULT NULL,
  `cantidad` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `fecha` datetime NULL DEFAULT NULL,
  `monto_ri` decimal(10, 2) NULL DEFAULT NULL,
  `precio_compra` decimal(10, 2) NULL DEFAULT NULL,
  PRIMARY KEY (`id_insumo`) USING BTREE,
  INDEX `producto_id`(`producto_id` ASC) USING BTREE,
  CONSTRAINT `recep_insumos_ibfk_1` FOREIGN KEY (`producto_id`) REFERENCES `producto` (`producto_id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 12 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of recep_insumos
-- ----------------------------

-- ----------------------------
-- Table structure for recepcion
-- ----------------------------
DROP TABLE IF EXISTS `recepcion`;
CREATE TABLE `recepcion`  (
  `rece_id` int NOT NULL AUTO_INCREMENT,
  `cliente_id` int NULL DEFAULT NULL,
  `rece_equipo` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `rece_caracteristicas` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `motivo_id` int NULL DEFAULT NULL,
  `rece_concepto` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `rece_monto` decimal(10, 2) NULL DEFAULT NULL,
  `rece_fregistro` date NULL DEFAULT NULL,
  `rece_estado` enum('EN REPARACION','REPARADO','ENTREGADO','NO REPARADO') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `rece_estatus` enum('ACTIVO','INACTIVO') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `rece_adelanto` decimal(10, 2) NULL DEFAULT NULL,
  `rece_debe` decimal(10, 2) NULL DEFAULT NULL,
  `rece_accesorios` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `rece_fentrega` date NULL DEFAULT NULL,
  `marca_id` int NULL DEFAULT NULL,
  `rece_serie` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `enciende` varchar(3) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `tactil` varchar(3) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `imagen` varchar(3) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `vibra` varchar(3) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `cobertura` varchar(3) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `sensor` varchar(3) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `carga` varchar(3) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `bluetoo` varchar(3) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `wifi` varchar(3) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `huella` varchar(3) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `home` varchar(3) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `lateral` varchar(3) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `camara` varchar(3) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `bateria` varchar(3) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `auricular` varchar(3) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `micro` varchar(3) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `face` varchar(3) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `tornillo` varchar(3) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `rece_cod` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `usuario_registrador` int NULL DEFAULT NULL,
  `tecnico` int NULL DEFAULT NULL,
  `diagnostico_tecnico` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `clave` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `rece_foto1` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `rece_foto2` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `id_sucu` int NULL DEFAULT NULL,
  `firma_rece` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  PRIMARY KEY (`rece_id`) USING BTREE,
  INDEX `cliente_id`(`cliente_id` ASC) USING BTREE,
  INDEX `motivo_id`(`motivo_id` ASC) USING BTREE,
  INDEX `marca_id`(`marca_id` ASC) USING BTREE,
  INDEX `id_sucu`(`id_sucu` ASC) USING BTREE,
  CONSTRAINT `recepcion_ibfk_1` FOREIGN KEY (`cliente_id`) REFERENCES `cliente` (`cliente_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `recepcion_ibfk_2` FOREIGN KEY (`motivo_id`) REFERENCES `motivo` (`motivo_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `recepcion_ibfk_3` FOREIGN KEY (`marca_id`) REFERENCES `marca` (`marca_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `recepcion_ibfk_4` FOREIGN KEY (`id_sucu`) REFERENCES `sucursales` (`id_sucu`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 9 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of recepcion
-- ----------------------------

-- ----------------------------
-- Table structure for rol
-- ----------------------------
DROP TABLE IF EXISTS `rol`;
CREATE TABLE `rol`  (
  `rol_id` int NOT NULL AUTO_INCREMENT,
  `rol_nombre` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `rol_fregistro` date NULL DEFAULT NULL,
  `rol_estado` enum('ACTIVO','INACTIVO') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`rol_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of rol
-- ----------------------------
INSERT INTO `rol` VALUES (1, 'Administrador', '2022-02-13', 'ACTIVO');
INSERT INTO `rol` VALUES (2, 'Recepcionista', '2022-02-13', 'ACTIVO');
INSERT INTO `rol` VALUES (3, 'Vendedor', '2022-03-02', 'ACTIVO');
INSERT INTO `rol` VALUES (4, 'Tecnico', '2024-01-22', 'ACTIVO');
INSERT INTO `rol` VALUES (5, 'Almacenero', '2024-02-14', 'ACTIVO');

-- ----------------------------
-- Table structure for servicio
-- ----------------------------
DROP TABLE IF EXISTS `servicio`;
CREATE TABLE `servicio`  (
  `servicio_id` int NOT NULL AUTO_INCREMENT,
  `rece_id` int NOT NULL,
  `servicio_monto` decimal(10, 2) NULL DEFAULT NULL,
  `servicio_concepto` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `servicio_responsable` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `servicio_comentario` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `servicio_fregistro` date NULL DEFAULT NULL,
  `servicio_entrega` enum('ENTREGADO','REPARADO','NO REPARADO','EN REPARACION') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `servicio_estado` enum('ACTIVO','INACTIVO') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `estado_caja` enum('ABIERTO','CERRADO') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `servicio_obser` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `servicio_modelo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `fpago_id` int NULL DEFAULT NULL,
  `monto_efectivo` decimal(10, 2) NULL DEFAULT NULL,
  `cod_operacion` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `monto_tarjeta` decimal(10, 2) NULL DEFAULT NULL,
  `caja_id` int NULL DEFAULT NULL,
  `tecnico_servi` int NULL DEFAULT NULL,
  `id_sucu` int NULL DEFAULT NULL,
  PRIMARY KEY (`servicio_id`) USING BTREE,
  INDEX `rece_id`(`rece_id` ASC) USING BTREE,
  INDEX `fpago_id`(`fpago_id` ASC) USING BTREE,
  INDEX `caja_id`(`caja_id` ASC) USING BTREE,
  CONSTRAINT `servicio_ibfk_1` FOREIGN KEY (`rece_id`) REFERENCES `recepcion` (`rece_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `servicio_ibfk_2` FOREIGN KEY (`fpago_id`) REFERENCES `forma_pago` (`fpago_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `servicio_ibfk_3` FOREIGN KEY (`caja_id`) REFERENCES `caja` (`caja_id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 10 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of servicio
-- ----------------------------

-- ----------------------------
-- Table structure for servicios_tienda
-- ----------------------------
DROP TABLE IF EXISTS `servicios_tienda`;
CREATE TABLE `servicios_tienda`  (
  `idserv` int NOT NULL AUTO_INCREMENT,
  `titulo` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `descripcion` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  `fecha_reg` datetime NULL DEFAULT NULL,
  `estado` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`idserv`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of servicios_tienda
-- ----------------------------
INSERT INTO `servicios_tienda` VALUES (3, 'SOPORTE TECNICO', '<h2 style=\"color: rgb(51, 51, 51); font-family: Roboto, sans-serif;\">Soporte Técnico Especializado</h2><p class=\"lead\" style=\"color: rgb(51, 51, 51); font-family: Roboto, sans-serif;\">Contamos con técnicos certificados para resolver cualquier problema con tus dispositivos electrónicos.</p><ul class=\"list-unstyled\" style=\"color: rgb(51, 51, 51); font-family: Roboto, sans-serif;\"><li><i class=\"bi bi-check-circle-fill text-primary me-2\" style=\"--bs-text-opacity: 1; margin-right: 0.5rem !important; color: rgb(13, 110, 253) !important;\"></i>&nbsp;Reparación de smartphones y tablets</li><li><i class=\"bi bi-check-circle-fill text-primary me-2\" style=\"--bs-text-opacity: 1; margin-right: 0.5rem !important; color: rgb(13, 110, 253) !important;\"></i>&nbsp;Mantenimiento de computadoras</li><li><i class=\"bi bi-check-circle-fill text-primary me-2\" style=\"--bs-text-opacity: 1; margin-right: 0.5rem !important; color: rgb(13, 110, 253) !important;\"></i>&nbsp;Recuperación de datos</li><li><i class=\"bi bi-check-circle-fill text-primary me-2\" style=\"--bs-text-opacity: 1; margin-right: 0.5rem !important; color: rgb(13, 110, 253) !important;\"></i>&nbsp;Instalación de software</li></ul>', NULL, NULL);

-- ----------------------------
-- Table structure for stock
-- ----------------------------
DROP TABLE IF EXISTS `stock`;
CREATE TABLE `stock`  (
  `id_stock` int NOT NULL AUTO_INCREMENT,
  `producto_id` int NULL DEFAULT NULL,
  `id_almacen` int NULL DEFAULT NULL,
  `cantidad_s` int NULL DEFAULT NULL,
  `stock_minimo` int NULL DEFAULT NULL,
  `ultimo_traslado` datetime NULL DEFAULT NULL,
  `fecha_reg` datetime NULL DEFAULT NULL,
  `id_sucu` int NULL DEFAULT NULL,
  `tipo_s` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `precio_venta_s` decimal(10, 2) NULL DEFAULT NULL,
  `precio_uni` decimal(10, 2) NULL DEFAULT NULL,
  PRIMARY KEY (`id_stock`) USING BTREE,
  INDEX `producto_id`(`producto_id` ASC) USING BTREE,
  INDEX `id_almacen`(`id_almacen` ASC) USING BTREE,
  CONSTRAINT `stock_ibfk_1` FOREIGN KEY (`producto_id`) REFERENCES `producto` (`producto_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `stock_ibfk_2` FOREIGN KEY (`id_almacen`) REFERENCES `almacen` (`id_almacen`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 43 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of stock
-- ----------------------------

-- ----------------------------
-- Table structure for sucursales
-- ----------------------------
DROP TABLE IF EXISTS `sucursales`;
CREATE TABLE `sucursales`  (
  `id_sucu` int NOT NULL AUTO_INCREMENT,
  `confi_id` int NULL DEFAULT NULL,
  `nombre_su` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `ruc_su` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `telefono_su` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `direccion_su` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `correo_su` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `estado_su` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `id_almacen` int NULL DEFAULT NULL,
  `fecha_reg` datetime NULL DEFAULT NULL,
  `imagen_su` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `moneda_su` varchar(5) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_sucu` DESC) USING BTREE,
  INDEX `id_almacen`(`id_almacen` ASC) USING BTREE,
  INDEX `confi_id`(`confi_id` ASC) USING BTREE,
  CONSTRAINT `sucursales_ibfk_1` FOREIGN KEY (`id_almacen`) REFERENCES `almacen` (`id_almacen`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `sucursales_ibfk_2` FOREIGN KEY (`confi_id`) REFERENCES `configuracion` (`confi_id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of sucursales
-- ----------------------------
INSERT INTO `sucursales` VALUES (1, 3, 'Sucursal Principal', '2050230125565', '92256312', 'calle los jasmines', 'sucursal1@gmail.com', 'Activo', 1, '2025-06-03 22:56:46', NULL, NULL);

-- ----------------------------
-- Table structure for td_menu_detalle
-- ----------------------------
DROP TABLE IF EXISTS `td_menu_detalle`;
CREATE TABLE `td_menu_detalle`  (
  `mend_id` int NOT NULL AUTO_INCREMENT,
  `rol_id` int NULL DEFAULT NULL,
  `men_id` int NULL DEFAULT NULL,
  `mend_permi` varchar(2) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NULL DEFAULT 'No',
  `fech_crea` datetime NULL DEFAULT CURRENT_TIMESTAMP,
  `estado` int NULL DEFAULT 1,
  `men_crear` varchar(2) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NULL DEFAULT 'No',
  `men_editar` varchar(2) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NULL DEFAULT 'No',
  `men_eliminar` varchar(2) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NULL DEFAULT 'No',
  `vista_inicio` int NULL DEFAULT 0,
  PRIMARY KEY (`mend_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 403 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_spanish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of td_menu_detalle
-- ----------------------------
INSERT INTO `td_menu_detalle` VALUES (229, 1, 1, 'Si', '2024-08-02 23:58:57', 1, 'No', 'No', 'No', 0);
INSERT INTO `td_menu_detalle` VALUES (230, 1, 2, 'Si', '2024-08-02 23:58:57', 1, 'No', 'No', 'No', 0);
INSERT INTO `td_menu_detalle` VALUES (231, 1, 3, 'Si', '2024-08-02 23:58:57', 1, 'No', 'No', 'No', 0);
INSERT INTO `td_menu_detalle` VALUES (232, 1, 4, 'Si', '2024-08-02 23:58:57', 1, 'No', 'No', 'No', 0);
INSERT INTO `td_menu_detalle` VALUES (233, 1, 5, 'Si', '2024-08-02 23:58:57', 1, 'No', 'No', 'No', 0);
INSERT INTO `td_menu_detalle` VALUES (234, 1, 6, 'Si', '2024-08-02 23:58:57', 1, 'No', 'No', 'No', 0);
INSERT INTO `td_menu_detalle` VALUES (235, 1, 7, 'Si', '2024-08-02 23:58:57', 1, 'No', 'No', 'No', 0);
INSERT INTO `td_menu_detalle` VALUES (236, 1, 8, 'Si', '2024-08-02 23:58:57', 1, 'No', 'No', 'No', 0);
INSERT INTO `td_menu_detalle` VALUES (237, 1, 9, 'Si', '2024-08-02 23:58:57', 1, 'No', 'No', 'No', 0);
INSERT INTO `td_menu_detalle` VALUES (238, 1, 10, 'Si', '2024-08-02 23:58:57', 1, 'No', 'No', 'No', 0);
INSERT INTO `td_menu_detalle` VALUES (239, 1, 11, 'Si', '2024-08-02 23:58:57', 1, 'No', 'No', 'No', 0);
INSERT INTO `td_menu_detalle` VALUES (240, 1, 12, 'Si', '2024-08-02 23:58:57', 1, 'No', 'No', 'No', 0);
INSERT INTO `td_menu_detalle` VALUES (241, 1, 13, 'Si', '2024-08-02 23:58:57', 1, 'No', 'No', 'No', 0);
INSERT INTO `td_menu_detalle` VALUES (242, 1, 14, 'Si', '2024-08-02 23:58:57', 1, 'No', 'No', 'No', 0);
INSERT INTO `td_menu_detalle` VALUES (243, 1, 15, 'Si', '2024-08-02 23:58:57', 1, 'No', 'No', 'No', 1);
INSERT INTO `td_menu_detalle` VALUES (244, 1, 16, 'Si', '2024-08-02 23:58:57', 1, 'No', 'No', 'No', 0);
INSERT INTO `td_menu_detalle` VALUES (245, 1, 17, 'Si', '2024-08-02 23:58:57', 1, 'No', 'No', 'No', 0);
INSERT INTO `td_menu_detalle` VALUES (246, 1, 18, 'Si', '2024-08-02 23:58:57', 1, 'No', 'No', 'No', 0);
INSERT INTO `td_menu_detalle` VALUES (247, 1, 19, 'Si', '2024-08-02 23:58:57', 1, 'No', 'No', 'No', 0);
INSERT INTO `td_menu_detalle` VALUES (248, 1, 20, 'Si', '2024-08-02 23:58:57', 1, 'No', 'No', 'No', 0);
INSERT INTO `td_menu_detalle` VALUES (249, 1, 21, 'Si', '2024-08-02 23:58:57', 1, 'No', 'No', 'No', 0);
INSERT INTO `td_menu_detalle` VALUES (250, 1, 22, 'Si', '2024-08-02 23:58:57', 1, 'No', 'No', 'No', 0);
INSERT INTO `td_menu_detalle` VALUES (251, 1, 23, 'Si', '2024-08-02 23:58:57', 1, 'No', 'No', 'No', 0);
INSERT INTO `td_menu_detalle` VALUES (252, 1, 24, 'Si', '2024-08-02 23:58:57', 1, 'No', 'No', 'No', 0);
INSERT INTO `td_menu_detalle` VALUES (253, 1, 25, 'No', '2024-08-02 23:58:57', 1, 'No', 'No', 'No', 0);
INSERT INTO `td_menu_detalle` VALUES (254, 1, 26, 'Si', '2024-08-02 23:58:57', 1, 'No', 'No', 'No', 0);
INSERT INTO `td_menu_detalle` VALUES (255, 2, 1, 'Si', '2024-08-07 00:25:31', 1, 'No', 'No', 'No', 1);
INSERT INTO `td_menu_detalle` VALUES (256, 2, 2, 'Si', '2024-08-07 00:25:31', 1, 'No', 'No', 'No', 0);
INSERT INTO `td_menu_detalle` VALUES (257, 2, 3, 'Si', '2024-08-07 00:25:31', 1, 'No', 'No', 'No', 0);
INSERT INTO `td_menu_detalle` VALUES (258, 2, 4, 'Si', '2024-08-07 00:25:31', 1, 'No', 'No', 'No', 0);
INSERT INTO `td_menu_detalle` VALUES (259, 2, 5, 'No', '2024-08-07 00:25:31', 1, 'No', 'No', 'No', 0);
INSERT INTO `td_menu_detalle` VALUES (260, 2, 6, 'No', '2024-08-07 00:25:31', 1, 'No', 'No', 'No', 0);
INSERT INTO `td_menu_detalle` VALUES (261, 2, 7, 'No', '2024-08-07 00:25:31', 1, 'No', 'No', 'No', 0);
INSERT INTO `td_menu_detalle` VALUES (262, 2, 8, 'No', '2024-08-07 00:25:31', 1, 'No', 'No', 'No', 0);
INSERT INTO `td_menu_detalle` VALUES (263, 2, 9, 'No', '2024-08-07 00:25:31', 1, 'No', 'No', 'No', 0);
INSERT INTO `td_menu_detalle` VALUES (264, 2, 10, 'No', '2024-08-07 00:25:31', 1, 'No', 'No', 'No', 0);
INSERT INTO `td_menu_detalle` VALUES (265, 2, 11, 'No', '2024-08-07 00:25:31', 1, 'No', 'No', 'No', 0);
INSERT INTO `td_menu_detalle` VALUES (266, 2, 12, 'No', '2024-08-07 00:25:31', 1, 'No', 'No', 'No', 0);
INSERT INTO `td_menu_detalle` VALUES (267, 2, 13, 'No', '2024-08-07 00:25:31', 1, 'No', 'No', 'No', 0);
INSERT INTO `td_menu_detalle` VALUES (268, 2, 14, 'No', '2024-08-07 00:25:31', 1, 'No', 'No', 'No', 0);
INSERT INTO `td_menu_detalle` VALUES (269, 2, 15, 'No', '2024-08-07 00:25:31', 1, 'No', 'No', 'No', 0);
INSERT INTO `td_menu_detalle` VALUES (270, 2, 16, 'No', '2024-08-07 00:25:31', 1, 'No', 'No', 'No', 0);
INSERT INTO `td_menu_detalle` VALUES (271, 2, 17, 'No', '2024-08-07 00:25:31', 1, 'No', 'No', 'No', 0);
INSERT INTO `td_menu_detalle` VALUES (272, 2, 18, 'No', '2024-08-07 00:25:31', 1, 'No', 'No', 'No', 0);
INSERT INTO `td_menu_detalle` VALUES (273, 2, 19, 'No', '2024-08-07 00:25:31', 1, 'No', 'No', 'No', 0);
INSERT INTO `td_menu_detalle` VALUES (274, 2, 20, 'No', '2024-08-07 00:25:31', 1, 'No', 'No', 'No', 0);
INSERT INTO `td_menu_detalle` VALUES (275, 2, 21, 'No', '2024-08-07 00:25:31', 1, 'No', 'No', 'No', 0);
INSERT INTO `td_menu_detalle` VALUES (276, 2, 22, 'No', '2024-08-07 00:25:31', 1, 'No', 'No', 'No', 0);
INSERT INTO `td_menu_detalle` VALUES (277, 2, 23, 'No', '2024-08-07 00:25:31', 1, 'No', 'No', 'No', 0);
INSERT INTO `td_menu_detalle` VALUES (278, 2, 24, 'No', '2024-08-07 00:25:31', 1, 'No', 'No', 'No', 0);
INSERT INTO `td_menu_detalle` VALUES (279, 2, 25, 'No', '2024-08-07 00:25:31', 1, 'No', 'No', 'No', 0);
INSERT INTO `td_menu_detalle` VALUES (280, 2, 26, 'No', '2024-08-07 00:25:31', 1, 'No', 'No', 'No', 0);
INSERT INTO `td_menu_detalle` VALUES (286, 3, 1, 'No', '2024-08-07 00:25:39', 1, 'No', 'No', 'No', 0);
INSERT INTO `td_menu_detalle` VALUES (287, 3, 2, 'No', '2024-08-07 00:25:39', 1, 'No', 'No', 'No', 0);
INSERT INTO `td_menu_detalle` VALUES (288, 3, 3, 'No', '2024-08-07 00:25:39', 1, 'No', 'No', 'No', 0);
INSERT INTO `td_menu_detalle` VALUES (289, 3, 4, 'No', '2024-08-07 00:25:39', 1, 'No', 'No', 'No', 0);
INSERT INTO `td_menu_detalle` VALUES (290, 3, 5, 'No', '2024-08-07 00:25:39', 1, 'No', 'No', 'No', 0);
INSERT INTO `td_menu_detalle` VALUES (291, 3, 6, 'Si', '2024-08-07 00:25:39', 1, 'No', 'No', 'No', 0);
INSERT INTO `td_menu_detalle` VALUES (292, 3, 7, 'Si', '2024-08-07 00:25:39', 1, 'No', 'No', 'No', 0);
INSERT INTO `td_menu_detalle` VALUES (293, 3, 8, 'No', '2024-08-07 00:25:39', 1, 'No', 'No', 'No', 0);
INSERT INTO `td_menu_detalle` VALUES (294, 3, 9, 'Si', '2024-08-07 00:25:39', 1, 'No', 'No', 'No', 1);
INSERT INTO `td_menu_detalle` VALUES (295, 3, 10, 'No', '2024-08-07 00:25:39', 1, 'No', 'No', 'No', 0);
INSERT INTO `td_menu_detalle` VALUES (296, 3, 11, 'No', '2024-08-07 00:25:39', 1, 'No', 'No', 'No', 0);
INSERT INTO `td_menu_detalle` VALUES (297, 3, 12, 'No', '2024-08-07 00:25:39', 1, 'No', 'No', 'No', 0);
INSERT INTO `td_menu_detalle` VALUES (298, 3, 13, 'No', '2024-08-07 00:25:39', 1, 'No', 'No', 'No', 0);
INSERT INTO `td_menu_detalle` VALUES (299, 3, 14, 'No', '2024-08-07 00:25:39', 1, 'No', 'No', 'No', 0);
INSERT INTO `td_menu_detalle` VALUES (300, 3, 15, 'No', '2024-08-07 00:25:39', 1, 'No', 'No', 'No', 0);
INSERT INTO `td_menu_detalle` VALUES (301, 3, 16, 'No', '2024-08-07 00:25:39', 1, 'No', 'No', 'No', 0);
INSERT INTO `td_menu_detalle` VALUES (302, 3, 17, 'No', '2024-08-07 00:25:39', 1, 'No', 'No', 'No', 0);
INSERT INTO `td_menu_detalle` VALUES (303, 3, 18, 'No', '2024-08-07 00:25:39', 1, 'No', 'No', 'No', 0);
INSERT INTO `td_menu_detalle` VALUES (304, 3, 19, 'No', '2024-08-07 00:25:39', 1, 'No', 'No', 'No', 0);
INSERT INTO `td_menu_detalle` VALUES (305, 3, 20, 'No', '2024-08-07 00:25:39', 1, 'No', 'No', 'No', 0);
INSERT INTO `td_menu_detalle` VALUES (306, 3, 21, 'No', '2024-08-07 00:25:39', 1, 'No', 'No', 'No', 0);
INSERT INTO `td_menu_detalle` VALUES (307, 3, 22, 'No', '2024-08-07 00:25:39', 1, 'No', 'No', 'No', 0);
INSERT INTO `td_menu_detalle` VALUES (308, 3, 23, 'No', '2024-08-07 00:25:39', 1, 'No', 'No', 'No', 0);
INSERT INTO `td_menu_detalle` VALUES (309, 3, 24, 'No', '2024-08-07 00:25:39', 1, 'No', 'No', 'No', 0);
INSERT INTO `td_menu_detalle` VALUES (310, 3, 25, 'No', '2024-08-07 00:25:39', 1, 'No', 'No', 'No', 0);
INSERT INTO `td_menu_detalle` VALUES (311, 3, 26, 'No', '2024-08-07 00:25:39', 1, 'No', 'No', 'No', 0);
INSERT INTO `td_menu_detalle` VALUES (317, 4, 1, 'No', '2024-08-07 00:25:54', 1, 'No', 'No', 'No', 0);
INSERT INTO `td_menu_detalle` VALUES (318, 4, 2, 'No', '2024-08-07 00:25:54', 1, 'No', 'No', 'No', 0);
INSERT INTO `td_menu_detalle` VALUES (319, 4, 3, 'Si', '2024-08-07 00:25:54', 1, 'No', 'No', 'No', 1);
INSERT INTO `td_menu_detalle` VALUES (320, 4, 4, 'No', '2024-08-07 00:25:54', 1, 'No', 'No', 'No', 0);
INSERT INTO `td_menu_detalle` VALUES (321, 4, 5, 'No', '2024-08-07 00:25:54', 1, 'No', 'No', 'No', 0);
INSERT INTO `td_menu_detalle` VALUES (322, 4, 6, 'Si', '2024-08-07 00:25:54', 1, 'No', 'No', 'No', 0);
INSERT INTO `td_menu_detalle` VALUES (323, 4, 7, 'No', '2024-08-07 00:25:54', 1, 'No', 'No', 'No', 0);
INSERT INTO `td_menu_detalle` VALUES (324, 4, 8, 'No', '2024-08-07 00:25:54', 1, 'No', 'No', 'No', 0);
INSERT INTO `td_menu_detalle` VALUES (325, 4, 9, 'No', '2024-08-07 00:25:54', 1, 'No', 'No', 'No', 0);
INSERT INTO `td_menu_detalle` VALUES (326, 4, 10, 'No', '2024-08-07 00:25:54', 1, 'No', 'No', 'No', 0);
INSERT INTO `td_menu_detalle` VALUES (327, 4, 11, 'No', '2024-08-07 00:25:54', 1, 'No', 'No', 'No', 0);
INSERT INTO `td_menu_detalle` VALUES (328, 4, 12, 'No', '2024-08-07 00:25:54', 1, 'No', 'No', 'No', 0);
INSERT INTO `td_menu_detalle` VALUES (329, 4, 13, 'No', '2024-08-07 00:25:54', 1, 'No', 'No', 'No', 0);
INSERT INTO `td_menu_detalle` VALUES (330, 4, 14, 'No', '2024-08-07 00:25:54', 1, 'No', 'No', 'No', 0);
INSERT INTO `td_menu_detalle` VALUES (331, 4, 15, 'No', '2024-08-07 00:25:54', 1, 'No', 'No', 'No', 0);
INSERT INTO `td_menu_detalle` VALUES (332, 4, 16, 'No', '2024-08-07 00:25:54', 1, 'No', 'No', 'No', 0);
INSERT INTO `td_menu_detalle` VALUES (333, 4, 17, 'No', '2024-08-07 00:25:54', 1, 'No', 'No', 'No', 0);
INSERT INTO `td_menu_detalle` VALUES (334, 4, 18, 'No', '2024-08-07 00:25:54', 1, 'No', 'No', 'No', 0);
INSERT INTO `td_menu_detalle` VALUES (335, 4, 19, 'No', '2024-08-07 00:25:54', 1, 'No', 'No', 'No', 0);
INSERT INTO `td_menu_detalle` VALUES (336, 4, 20, 'No', '2024-08-07 00:25:54', 1, 'No', 'No', 'No', 0);
INSERT INTO `td_menu_detalle` VALUES (337, 4, 21, 'No', '2024-08-07 00:25:54', 1, 'No', 'No', 'No', 0);
INSERT INTO `td_menu_detalle` VALUES (338, 4, 22, 'No', '2024-08-07 00:25:54', 1, 'No', 'No', 'No', 0);
INSERT INTO `td_menu_detalle` VALUES (339, 4, 23, 'No', '2024-08-07 00:25:54', 1, 'No', 'No', 'No', 0);
INSERT INTO `td_menu_detalle` VALUES (340, 4, 24, 'No', '2024-08-07 00:25:54', 1, 'No', 'No', 'No', 0);
INSERT INTO `td_menu_detalle` VALUES (341, 4, 25, 'No', '2024-08-07 00:25:54', 1, 'No', 'No', 'No', 0);
INSERT INTO `td_menu_detalle` VALUES (342, 4, 26, 'No', '2024-08-07 00:25:54', 1, 'No', 'No', 'No', 0);
INSERT INTO `td_menu_detalle` VALUES (348, 5, 1, 'No', '2024-08-07 00:26:17', 1, 'No', 'No', 'No', 0);
INSERT INTO `td_menu_detalle` VALUES (349, 5, 2, 'No', '2024-08-07 00:26:17', 1, 'No', 'No', 'No', 0);
INSERT INTO `td_menu_detalle` VALUES (350, 5, 3, 'No', '2024-08-07 00:26:17', 1, 'No', 'No', 'No', 0);
INSERT INTO `td_menu_detalle` VALUES (351, 5, 4, 'No', '2024-08-07 00:26:17', 1, 'No', 'No', 'No', 0);
INSERT INTO `td_menu_detalle` VALUES (352, 5, 5, 'No', '2024-08-07 00:26:17', 1, 'No', 'No', 'No', 0);
INSERT INTO `td_menu_detalle` VALUES (353, 5, 6, 'No', '2024-08-07 00:26:17', 1, 'No', 'No', 'No', 0);
INSERT INTO `td_menu_detalle` VALUES (354, 5, 7, 'No', '2024-08-07 00:26:17', 1, 'No', 'No', 'No', 0);
INSERT INTO `td_menu_detalle` VALUES (355, 5, 8, 'No', '2024-08-07 00:26:17', 1, 'No', 'No', 'No', 0);
INSERT INTO `td_menu_detalle` VALUES (356, 5, 9, 'Si', '2024-08-07 00:26:17', 1, 'No', 'No', 'No', 1);
INSERT INTO `td_menu_detalle` VALUES (357, 5, 10, 'No', '2024-08-07 00:26:17', 1, 'No', 'No', 'No', 0);
INSERT INTO `td_menu_detalle` VALUES (358, 5, 11, 'No', '2024-08-07 00:26:17', 1, 'No', 'No', 'No', 0);
INSERT INTO `td_menu_detalle` VALUES (359, 5, 12, 'No', '2024-08-07 00:26:17', 1, 'No', 'No', 'No', 0);
INSERT INTO `td_menu_detalle` VALUES (360, 5, 13, 'No', '2024-08-07 00:26:17', 1, 'No', 'No', 'No', 0);
INSERT INTO `td_menu_detalle` VALUES (361, 5, 14, 'No', '2024-08-07 00:26:17', 1, 'No', 'No', 'No', 0);
INSERT INTO `td_menu_detalle` VALUES (362, 5, 15, 'No', '2024-08-07 00:26:17', 1, 'No', 'No', 'No', 0);
INSERT INTO `td_menu_detalle` VALUES (363, 5, 16, 'No', '2024-08-07 00:26:17', 1, 'No', 'No', 'No', 0);
INSERT INTO `td_menu_detalle` VALUES (364, 5, 17, 'No', '2024-08-07 00:26:17', 1, 'No', 'No', 'No', 0);
INSERT INTO `td_menu_detalle` VALUES (365, 5, 18, 'No', '2024-08-07 00:26:17', 1, 'No', 'No', 'No', 0);
INSERT INTO `td_menu_detalle` VALUES (366, 5, 19, 'No', '2024-08-07 00:26:17', 1, 'No', 'No', 'No', 0);
INSERT INTO `td_menu_detalle` VALUES (367, 5, 20, 'No', '2024-08-07 00:26:17', 1, 'No', 'No', 'No', 0);
INSERT INTO `td_menu_detalle` VALUES (368, 5, 21, 'No', '2024-08-07 00:26:17', 1, 'No', 'No', 'No', 0);
INSERT INTO `td_menu_detalle` VALUES (369, 5, 22, 'No', '2024-08-07 00:26:17', 1, 'No', 'No', 'No', 0);
INSERT INTO `td_menu_detalle` VALUES (370, 5, 23, 'No', '2024-08-07 00:26:17', 1, 'No', 'No', 'No', 0);
INSERT INTO `td_menu_detalle` VALUES (371, 5, 24, 'No', '2024-08-07 00:26:17', 1, 'No', 'No', 'No', 0);
INSERT INTO `td_menu_detalle` VALUES (372, 5, 25, 'No', '2024-08-07 00:26:17', 1, 'No', 'No', 'No', 0);
INSERT INTO `td_menu_detalle` VALUES (373, 5, 26, 'No', '2024-08-07 00:26:17', 1, 'No', 'No', 'No', 0);
INSERT INTO `td_menu_detalle` VALUES (374, 1, 27, 'Si', '2024-09-18 00:56:13', 1, 'No', 'No', 'No', 0);
INSERT INTO `td_menu_detalle` VALUES (375, 3, 27, 'No', '2024-09-19 01:20:23', 1, 'No', 'No', 'No', 0);
INSERT INTO `td_menu_detalle` VALUES (376, 4, 27, 'No', '2024-09-19 01:33:41', 1, 'No', 'No', 'No', 0);
INSERT INTO `td_menu_detalle` VALUES (377, 1, 28, 'Si', '2024-09-21 02:30:32', 1, 'No', 'No', 'No', 0);
INSERT INTO `td_menu_detalle` VALUES (378, 2, 27, 'No', '2024-09-21 02:31:25', 1, 'No', 'No', 'No', 0);
INSERT INTO `td_menu_detalle` VALUES (379, 2, 28, 'No', '2024-09-21 02:31:25', 1, 'No', 'No', 'No', 0);
INSERT INTO `td_menu_detalle` VALUES (381, 4, 28, 'No', '2024-09-21 02:31:47', 1, 'No', 'No', 'No', 0);
INSERT INTO `td_menu_detalle` VALUES (382, 1, 29, 'No', '2025-03-16 02:46:17', 1, 'No', 'No', 'No', 0);
INSERT INTO `td_menu_detalle` VALUES (383, 1, 30, 'No', '2025-04-03 18:35:18', 1, 'No', 'No', 'No', 0);
INSERT INTO `td_menu_detalle` VALUES (384, 1, 31, 'No', '2025-05-06 15:56:46', 1, 'No', 'No', 'No', 0);
INSERT INTO `td_menu_detalle` VALUES (385, 1, 32, 'Si', '2025-06-03 21:40:19', 1, 'No', 'No', 'No', 0);
INSERT INTO `td_menu_detalle` VALUES (386, 1, 33, 'No', '2025-06-05 01:48:16', 1, 'No', 'No', 'No', 0);
INSERT INTO `td_menu_detalle` VALUES (387, 3, 28, 'No', '2025-06-09 18:57:47', 1, 'No', 'No', 'No', 0);
INSERT INTO `td_menu_detalle` VALUES (388, 3, 29, 'No', '2025-06-09 18:57:47', 1, 'No', 'No', 'No', 0);
INSERT INTO `td_menu_detalle` VALUES (389, 3, 30, 'No', '2025-06-09 18:57:47', 1, 'No', 'No', 'No', 0);
INSERT INTO `td_menu_detalle` VALUES (390, 3, 31, 'No', '2025-06-09 18:57:47', 1, 'No', 'No', 'No', 0);
INSERT INTO `td_menu_detalle` VALUES (391, 3, 32, 'No', '2025-06-09 18:57:47', 1, 'No', 'No', 'No', 0);
INSERT INTO `td_menu_detalle` VALUES (392, 3, 33, 'No', '2025-06-09 18:57:47', 1, 'No', 'No', 'No', 0);
INSERT INTO `td_menu_detalle` VALUES (393, 1, 34, 'Si', '2025-06-11 11:45:14', 1, 'No', 'No', 'No', 0);
INSERT INTO `td_menu_detalle` VALUES (394, 3, 34, 'No', '2025-06-23 12:32:26', 1, 'No', 'No', 'No', 0);
INSERT INTO `td_menu_detalle` VALUES (395, 4, 29, 'No', '2025-07-07 23:37:22', 1, 'No', 'No', 'No', 0);
INSERT INTO `td_menu_detalle` VALUES (396, 4, 30, 'No', '2025-07-07 23:37:22', 1, 'No', 'No', 'No', 0);
INSERT INTO `td_menu_detalle` VALUES (397, 4, 31, 'No', '2025-07-07 23:37:22', 1, 'No', 'No', 'No', 0);
INSERT INTO `td_menu_detalle` VALUES (398, 4, 32, 'No', '2025-07-07 23:37:22', 1, 'No', 'No', 'No', 0);
INSERT INTO `td_menu_detalle` VALUES (399, 4, 33, 'No', '2025-07-07 23:37:22', 1, 'No', 'No', 'No', 0);
INSERT INTO `td_menu_detalle` VALUES (400, 4, 34, 'No', '2025-07-07 23:37:22', 1, 'No', 'No', 'No', 0);
INSERT INTO `td_menu_detalle` VALUES (401, 1, 35, 'Si', '2025-07-09 00:21:27', 1, 'No', 'No', 'No', 0);
INSERT INTO `td_menu_detalle` VALUES (402, 1, 36, 'Si', '2025-08-20 23:59:09', 1, 'No', 'No', 'No', 0);

-- ----------------------------
-- Table structure for traslados
-- ----------------------------
DROP TABLE IF EXISTS `traslados`;
CREATE TABLE `traslados`  (
  `id_traslado` int NOT NULL AUTO_INCREMENT,
  `fecha_r` datetime NULL DEFAULT NULL,
  `almacen_origen_id` int NULL DEFAULT NULL,
  `almacen_destino_id` int NULL DEFAULT NULL,
  `usu_id` int NULL DEFAULT NULL,
  `estado` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `glosa_t` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_traslado`) USING BTREE,
  INDEX `almacen_origen_id`(`almacen_origen_id` ASC) USING BTREE,
  INDEX `almacen_destino_id`(`almacen_destino_id` ASC) USING BTREE,
  CONSTRAINT `traslados_ibfk_1` FOREIGN KEY (`almacen_origen_id`) REFERENCES `almacen` (`id_almacen`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `traslados_ibfk_2` FOREIGN KEY (`almacen_destino_id`) REFERENCES `almacen` (`id_almacen`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 18 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of traslados
-- ----------------------------

-- ----------------------------
-- Table structure for unidadmedida
-- ----------------------------
DROP TABLE IF EXISTS `unidadmedida`;
CREATE TABLE `unidadmedida`  (
  `unidad_id` int NOT NULL AUTO_INCREMENT,
  `unidad_descripcion` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `unidad_abrevia` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `unidad_estado` enum('ACTIVO','INACTIVO') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`unidad_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of unidadmedida
-- ----------------------------
INSERT INTO `unidadmedida` VALUES (1, 'Caja', 'CJA', 'ACTIVO');
INSERT INTO `unidadmedida` VALUES (3, 'Bolsa', 'Bl', 'ACTIVO');
INSERT INTO `unidadmedida` VALUES (4, 'PIEZAS', 'PZ', 'ACTIVO');

-- ----------------------------
-- Table structure for usuario
-- ----------------------------
DROP TABLE IF EXISTS `usuario`;
CREATE TABLE `usuario`  (
  `usu_id` int NOT NULL AUTO_INCREMENT,
  `usu_nombre` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `usu_contrasena` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `usu_email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `rol_id` int NULL DEFAULT NULL,
  `usu_foto` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `usu_estado` enum('ACTIVO','INACTIVO') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `id_sucu` int NULL DEFAULT NULL,
  PRIMARY KEY (`usu_id`) USING BTREE,
  INDEX `rol_id`(`rol_id` ASC) USING BTREE,
  INDEX `id_sucu`(`id_sucu` ASC) USING BTREE,
  CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`rol_id`) REFERENCES `rol` (`rol_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `usuario_ibfk_2` FOREIGN KEY (`id_sucu`) REFERENCES `sucursales` (`id_sucu`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 16 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of usuario
-- ----------------------------
INSERT INTO `usuario` VALUES (1, 'admin', '$2y$12$C.1yXkkqqs45tHKfUJC4UuOfpRhB5aEQjQkYNVlnbIH/GXCUbeawi', 'Administrador', 1, 'controller/usuario/foto/IMG132202214564.jpg', 'ACTIVO', 1);

-- ----------------------------
-- Table structure for venta
-- ----------------------------
DROP TABLE IF EXISTS `venta`;
CREATE TABLE `venta`  (
  `venta_id` int NOT NULL AUTO_INCREMENT,
  `cliente_id` int NULL DEFAULT NULL,
  `venta_comprobante` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `venta_serie` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `venta_num_comprobante` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `venta_total` decimal(10, 2) NULL DEFAULT NULL,
  `venta_impuesto` decimal(10, 2) NULL DEFAULT NULL,
  `venta_fregistro` date NULL DEFAULT NULL,
  `venta_hora` time NULL DEFAULT NULL,
  `venta_estado` enum('REGISTRADA','PAGADA','ANULADA') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `compro_id` int NULL DEFAULT NULL,
  `venta_porcentaje` decimal(10, 2) NULL DEFAULT NULL,
  `usu_id` int NULL DEFAULT NULL,
  `fpago_id` int NULL DEFAULT NULL,
  `observacion` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `estado_caja` enum('ABIERTO','CERRADO') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `monto_efectivo` decimal(10, 2) NULL DEFAULT NULL,
  `cod_operacion` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `monto_tarjeta` decimal(10, 2) NULL DEFAULT NULL,
  `caja_id` int NULL DEFAULT NULL,
  `venta_descuento` decimal(10, 2) NULL DEFAULT NULL,
  `id_sucu` int NULL DEFAULT NULL,
  `id_almacen` int NULL DEFAULT NULL,
  PRIMARY KEY (`venta_id`) USING BTREE,
  INDEX `cliente_id`(`cliente_id` ASC) USING BTREE,
  INDEX `compro_id`(`compro_id` ASC) USING BTREE,
  INDEX `usu_id`(`usu_id` ASC) USING BTREE,
  INDEX `fpago_id`(`fpago_id` ASC) USING BTREE,
  INDEX `caja_id`(`caja_id` ASC) USING BTREE,
  CONSTRAINT `venta_ibfk_1` FOREIGN KEY (`cliente_id`) REFERENCES `cliente` (`cliente_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `venta_ibfk_2` FOREIGN KEY (`compro_id`) REFERENCES `comprobante` (`compro_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `venta_ibfk_3` FOREIGN KEY (`usu_id`) REFERENCES `usuario` (`usu_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `venta_ibfk_4` FOREIGN KEY (`fpago_id`) REFERENCES `forma_pago` (`fpago_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `venta_ibfk_5` FOREIGN KEY (`caja_id`) REFERENCES `caja` (`caja_id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 56 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of venta
-- ----------------------------

-- ----------------------------
-- Table structure for venta_credito
-- ----------------------------
DROP TABLE IF EXISTS `venta_credito`;
CREATE TABLE `venta_credito`  (
  `id_credito_v` int NOT NULL AUTO_INCREMENT,
  `venta_id` int NULL DEFAULT NULL,
  `monto_total` decimal(10, 2) NULL DEFAULT NULL,
  `monto_abono` decimal(10, 2) NULL DEFAULT NULL,
  `fecha_reg` datetime NULL DEFAULT NULL,
  `forma_pago` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `usu_id` int NULL DEFAULT NULL,
  `id_sucu` int NULL DEFAULT NULL,
  `caja_id` int NULL DEFAULT NULL,
  `estado_caja` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_credito_v`) USING BTREE,
  INDEX `venta_id`(`venta_id` ASC) USING BTREE,
  CONSTRAINT `venta_credito_ibfk_1` FOREIGN KEY (`venta_id`) REFERENCES `venta` (`venta_id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 19 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of venta_credito
-- ----------------------------

-- ----------------------------
-- View structure for view_listar_recepcion
-- ----------------------------
DROP VIEW IF EXISTS `view_listar_recepcion`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `view_listar_recepcion` AS select `recepcion`.`rece_id` AS `rece_id`,concat(' R-000',`recepcion`.`rece_id`) AS `referencia`,`recepcion`.`cliente_id` AS `cliente_id`,`cliente`.`cliente_nombres` AS `cliente_nombres`,concat_ws(' - ',`recepcion`.`rece_equipo`,`recepcion`.`rece_concepto`) AS `motivo`,`recepcion`.`rece_caracteristicas` AS `rece_caracteristicas`,`recepcion`.`motivo_id` AS `motivo_id`,`motivo`.`motivo_descripcion` AS `motivo_descripcion`,`recepcion`.`rece_monto` AS `rece_monto`,`recepcion`.`rece_fregistro` AS `rece_fregistro`,`recepcion`.`rece_estado` AS `rece_estado`,`recepcion`.`rece_estatus` AS `rece_estatus`,`recepcion`.`rece_equipo` AS `rece_equipo`,`recepcion`.`rece_concepto` AS `rece_concepto`,`recepcion`.`rece_adelanto` AS `rece_adelanto`,`recepcion`.`rece_debe` AS `rece_debe`,`recepcion`.`rece_accesorios` AS `rece_accesorios`,`recepcion`.`rece_fentrega` AS `rece_fentrega`,`recepcion`.`marca_id` AS `marca_id`,`marca`.`marca_descripcion` AS `marca_descripcion`,`recepcion`.`rece_serie` AS `rece_serie`,`recepcion`.`enciende` AS `enciende`,`recepcion`.`tactil` AS `tactil`,`recepcion`.`imagen` AS `imagen`,`recepcion`.`vibra` AS `vibra`,`recepcion`.`cobertura` AS `cobertura`,`recepcion`.`sensor` AS `sensor`,`recepcion`.`carga` AS `carga`,`recepcion`.`bluetoo` AS `bluetoo`,`recepcion`.`wifi` AS `wifi`,`recepcion`.`huella` AS `huella`,`recepcion`.`home` AS `home`,`recepcion`.`lateral` AS `lateral`,`recepcion`.`camara` AS `camara`,`recepcion`.`bateria` AS `bateria`,`recepcion`.`auricular` AS `auricular`,`recepcion`.`micro` AS `micro`,`recepcion`.`face` AS `face`,`recepcion`.`tornillo` AS `tornillo`,`recepcion`.`rece_cod` AS `rece_cod`,`cliente`.`cliente_celular` AS `cliente_celular`,`recepcion`.`tecnico` AS `tecnico`,`recepcion`.`usuario_registrador` AS `usuario_registrador` from (((`recepcion` join `cliente` on((`recepcion`.`cliente_id` = `cliente`.`cliente_id`))) join `motivo` on((`recepcion`.`motivo_id` = `motivo`.`motivo_id`))) join `marca` on((`recepcion`.`marca_id` = `marca`.`marca_id`)));

-- ----------------------------
-- View structure for view_listar_recepcion_en_servicio
-- ----------------------------
DROP VIEW IF EXISTS `view_listar_recepcion_en_servicio`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `view_listar_recepcion_en_servicio` AS select `recepcion`.`rece_id` AS `rece_id`,concat(' R-000',`recepcion`.`rece_id`) AS `referencia`,`cliente`.`cliente_nombres` AS `cliente`,`recepcion`.`rece_caracteristicas` AS `modelo`,concat_ws(' - ',`recepcion`.`rece_equipo`,`recepcion`.`rece_concepto`) AS `concepto`,`recepcion`.`rece_monto` AS `monto`,`recepcion`.`rece_fregistro` AS `fecha`,`recepcion`.`rece_estado` AS `entrega`,`recepcion`.`rece_adelanto` AS `adelanto`,`recepcion`.`rece_debe` AS `debe`,`recepcion`.`rece_fentrega` AS `rece_fentrega`,`recepcion`.`diagnostico_tecnico` AS `diagnostico_tecn`,`usu`.`usu_nombre` AS `nombre_tecnico`,`recepcion`.`tecnico` AS `idtecnico`,`recepcion`.`id_sucu` AS `id_sucu` from ((`recepcion` join `cliente` on((`recepcion`.`cliente_id` = `cliente`.`cliente_id`))) join `usuario` `usu` on((`recepcion`.`tecnico` = `usu`.`usu_id`))) where ((`recepcion`.`rece_estado` in ('REPARADO','NO REPARADO')) and (`recepcion`.`rece_estatus` = 'ACTIVO')) limit 100;

-- ----------------------------
-- View structure for view_listar_servicio_rece
-- ----------------------------
DROP VIEW IF EXISTS `view_listar_servicio_rece`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `view_listar_servicio_rece` AS select `servicio`.`servicio_id` AS `servicio_id`,`servicio`.`rece_id` AS `rece_id`,`recepcion`.`cliente_id` AS `cliente_id`,`cliente`.`cliente_nombres` AS `cliente_nombres`,concat_ws(' - ',`recepcion`.`rece_equipo`,`recepcion`.`rece_concepto`) AS `concepto`,`recepcion`.`rece_monto` AS `rece_monto`,`recepcion`.`rece_estado` AS `rece_estado`,`servicio`.`servicio_monto` AS `servicio_monto`,`servicio`.`servicio_concepto` AS `servicio_concepto`,`servicio`.`servicio_responsable` AS `servicio_responsable`,`servicio`.`servicio_comentario` AS `servicio_comentario`,`servicio`.`servicio_entrega` AS `servicio_entrega`,`servicio`.`servicio_fregistro` AS `servicio_fregistro`,`servicio`.`servicio_estado` AS `servicio_estado` from ((`servicio` join `recepcion` on((`servicio`.`rece_id` = `recepcion`.`rece_id`))) join `cliente` on((`recepcion`.`cliente_id` = `cliente`.`cliente_id`)));

-- ----------------------------
-- View structure for view_listar_usuario
-- ----------------------------
DROP VIEW IF EXISTS `view_listar_usuario`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `view_listar_usuario` AS select `u`.`usu_id` AS `usu_id`,`u`.`usu_nombre` AS `usu_nombre`,`u`.`usu_contrasena` AS `usu_contrasena`,`u`.`rol_id` AS `rol_id`,`u`.`usu_estado` AS `usu_estado`,`u`.`usu_email` AS `usu_email`,`u`.`usu_foto` AS `usu_foto`,`r`.`rol_nombre` AS `rol_nombre`,`u`.`id_sucu` AS `id_sucu`,`s`.`nombre_su` AS `nombre_su` from ((`usuario` `u` join `rol` `r` on((`u`.`rol_id` = `r`.`rol_id`))) join `sucursales` `s` on((`u`.`id_sucu` = `s`.`id_sucu`)));

-- ----------------------------
-- Procedure structure for ELIMINAR_ITEN_VENTA_CREDITO
-- ----------------------------
DROP PROCEDURE IF EXISTS `ELIMINAR_ITEN_VENTA_CREDITO`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `ELIMINAR_ITEN_VENTA_CREDITO`(
    IN p_id_detallecredito INT
)
BEGIN
    DELETE FROM venta_credito
    WHERE id_credito_v = p_id_detallecredito;
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for LISTAR_BANNER
-- ----------------------------
DROP PROCEDURE IF EXISTS `LISTAR_BANNER`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `LISTAR_BANNER`()
BEGIN

SELECT id_banner, descripcion_b, foto_b, fecha FROM banner;


END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_ACTIVAR_COTIZACION
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_ACTIVAR_COTIZACION`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_ACTIVAR_COTIZACION`(IN ID INT,IN ESTADO VARCHAR(30))
BEGIN
DECLARE CANTIDAD INT;
DECLARE DETALLEID INT;

UPDATE cotizacion set
coti_estado=ESTADO
where coti_id=ID;

SET @CANTIDAD:=(SELECT COUNT(*) FROM cotizacion_detalle WHERE coti_detalle_estado= 'INACTIVO' AND coti_id=ID);
	WHILE @CANTIDAD > 0 DO

	SET @DETALLEID:=(SELECT coti_detalle_id FROM cotizacion_detalle WHERE coti_detalle_estado= 'INACTIVO' AND coti_id=ID LIMIT 1  );


	
	UPDATE cotizacion_detalle SET 
	coti_detalle_estado= ESTADO
	WHERE coti_detalle_id=@DETALLEID;
	SET @CANTIDAD:= @CANTIDAD - 1;

	END WHILE;
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_ACTUALIZAR_ESTADO_PEDIDO
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_ACTUALIZAR_ESTADO_PEDIDO`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_ACTUALIZAR_ESTADO_PEDIDO`(IN p_estado VARCHAR(20), IN p_pedidoid INT)
BEGIN
DECLARE v_cliente_id INT;
    DECLARE v_correlativo VARCHAR(30);
    DECLARE v_total DECIMAL(10,2);
   

    UPDATE pedido_n
    SET pedido_estado = p_estado
    WHERE pedido_id = p_pedidoid;

    UPDATE pedido_detalle_n
    SET pedido_estado = p_estado
    WHERE pedido_id = p_pedidoid;

 
    

    SELECT cliente_id, pedido_correlativo, pedido_total
    INTO v_cliente_id, v_correlativo, v_total
    FROM pedido_n
    WHERE pedido_id = p_pedidoid
    LIMIT 1;

    INSERT INTO pedido_bitacora (pedido_id,  pedido_correlativo, fecha_segui, estado_segui, total_segui)
    VALUES (p_pedidoid,  v_correlativo, CURRENT_TIMESTAMP(), p_estado, v_total);

  
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_ANULAR_COTIZACION
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_ANULAR_COTIZACION`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_ANULAR_COTIZACION`(IN ID INT,IN ESTADO VARCHAR(30))
BEGIN
DECLARE CANTIDAD INT;
DECLARE DETALLEID INT;

UPDATE cotizacion set
coti_estado=ESTADO
where coti_id=ID;

SET @CANTIDAD:=(SELECT COUNT(*) FROM cotizacion_detalle WHERE coti_detalle_estado= 'ACTIVO' AND coti_id=ID);
	WHILE @CANTIDAD > 0 DO

	SET @DETALLEID:=(SELECT coti_detalle_id FROM cotizacion_detalle WHERE coti_detalle_estado= 'ACTIVO' AND coti_id=ID LIMIT 1  );


	
	UPDATE cotizacion_detalle SET 
	coti_detalle_estado= ESTADO
	WHERE coti_detalle_id=@DETALLEID;
	SET @CANTIDAD:= @CANTIDAD - 1;

	END WHILE;
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_ANULAR_VENTA
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_ANULAR_VENTA`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_ANULAR_VENTA`(IN ID INT,IN ESTADO VARCHAR(30))
BEGIN
DECLARE v_ventaid INT;
DECLARE v_idproducto INT;
DECLARE v_detalleid INT;
DECLARE vcantidad INT;
DECLARE vimei VARCHAR(100);

DECLARE done INT DEFAULT FALSE;

DECLARE cursor_i CURSOR FOR 

SELECT producto_id, vdetalle_id, vdetalle_cantidad, v_imei , venta_id
FROM detalle_venta 
where venta_id = ID;

DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = TRUE;

OPEN cursor_i;
read_loop: LOOP
FETCH cursor_i INTO v_idproducto, v_detalleid, vcantidad, vimei, v_ventaid;

	IF done THEN
	  LEAVE read_loop;
	END IF;
    
    UPDATE producto 
       SET producto_stock = producto_stock + vcantidad
    WHERE producto_id  = v_idproducto ;
		
		
		UPDATE producto_detalle SET
		vendido='No'
		where producto_id= v_idproducto and imei = vimei
		LIMIT 1;
		
		
			UPDATE kardex SET 
			kardex_tipo=ESTADO,
			kardex_total = 0,
			kardex_salida = 0
			WHERE producto_id = v_idproducto and venta_id = v_ventaid;
		
    
END LOOP;
CLOSE cursor_i;

			UPDATE venta set
			venta_estado=ESTADO
			-- venta_comprobante = '-',
			-- venta_serie = '-',
			-- venta_num_comprobante = '-'
			where venta_id=ID;
			
			
			UPDATE detalle_venta SET 
			vdetalle_estado= ESTADO
			WHERE venta_id = ID; 
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_ANULAR_VENTA_NEW
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_ANULAR_VENTA_NEW`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_ANULAR_VENTA_NEW`(IN ID INT, IN ESTADO VARCHAR(30), IN p_idsucu INT)
BEGIN
-- Declaración de variables
  DECLARE v_ventaid INT;
  DECLARE v_idproducto INT;
  DECLARE v_detalleid INT;
  DECLARE vcantidad INT;
  DECLARE vimei VARCHAR(100);
  DECLARE v_idalmacen INT;
  DECLARE v_idimeis INT;
  DECLARE v_abonos_exist INT DEFAULT 0;
  DECLARE done INT DEFAULT FALSE;

  -- Cursor para recorrer los productos de la venta
  DECLARE cursor_i CURSOR FOR 
    SELECT producto_id, vdetalle_id, vdetalle_cantidad, v_imei, venta_id, id_pro_imei
    FROM detalle_venta 
    WHERE venta_id = ID AND id_sucu = p_idsucu;

  -- Handler para terminar el bucle
  DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = TRUE;

  -- Verificar si existen abonos registrados en venta_credito
  SELECT COUNT(*) INTO v_abonos_exist
  FROM venta_credito
  WHERE venta_id = ID;

  IF v_abonos_exist > 0 THEN
    SIGNAL SQLSTATE '45000'
    SET MESSAGE_TEXT = ' [ No se puede anular la venta porque ya tiene abonos registrados ]';
  END IF;

  -- Obtener almacén asociado a la sucursal
  SELECT id_almacen INTO v_idalmacen
  FROM sucursales 
  WHERE id_sucu = p_idsucu;

  -- Procesar los productos de la venta
  OPEN cursor_i;
  read_loop: LOOP
    FETCH cursor_i INTO v_idproducto, v_detalleid, vcantidad, vimei, v_ventaid, v_idimeis;

    IF done THEN
      LEAVE read_loop;
    END IF;

    -- Retornar stock en almacén
    UPDATE stock
    SET cantidad_s = cantidad_s + vcantidad
    WHERE producto_id = v_idproducto AND id_almacen = v_idalmacen;

    -- Liberar IMEI si corresponde
    IF v_idimeis IS NOT NULL AND v_idimeis != '' THEN
      UPDATE producto_detalle 
      SET vendido = 'No'
      WHERE producto_id = v_idproducto AND id_prod_imei = v_idimeis;
    END IF;

    -- Actualizar Kardex
    UPDATE kardex 
    SET 
      kardex_tipo = ESTADO,
      kardex_total = 0,
      kardex_salida = 0
    WHERE producto_id = v_idproducto AND venta_id = v_ventaid;

    -- Actualizar movimientos
    UPDATE movimientos 
    SET tipo_movimiento = ESTADO,
        observacion = CONCAT('Anulación venta: ', v_ventaid, ' - cant: ', vcantidad)
    WHERE producto_id = v_idproducto AND id_almacen = v_idalmacen AND referencia_id = v_ventaid;

  END LOOP;
  CLOSE cursor_i;

  -- Cambiar estado de la venta y detalles
  UPDATE venta 
  SET venta_estado = ESTADO
  WHERE venta_id = ID AND id_sucu = p_idsucu;

  UPDATE detalle_venta 
  SET vdetalle_estado = ESTADO
  WHERE venta_id = ID;
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_AUMENTAR_STOCK
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_AUMENTAR_STOCK`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_AUMENTAR_STOCK`(IN IDPRODUCTO INT, IN CANTIDAAUMENTO INT,IN SUMA VARCHAR(100), IN p_idalmacen INT)
BEGIN
DECLARE v_stock int;

SELECT cantidad_s
INTO  v_stock
from stock
WHERE producto_id = IDPRODUCTO and id_almacen = p_idalmacen;

UPDATE stock SET
cantidad_s = v_stock + CANTIDAAUMENTO
WHERE producto_id = IDPRODUCTO and id_almacen = p_idalmacen;



set @preciocompra = (select producto_pcompra from producto where producto_id =IDPRODUCTO);
set @stock = (select cantidad_s from stock where producto_id =IDPRODUCTO and id_almacen = p_idalmacen);

INSERT INTO movimientos (producto_id, id_almacen, cantidad, tipo_movimiento, referencia_id, fecha_reg, observacion )
							VALUES (IDPRODUCTO, p_idalmacen, CANTIDAAUMENTO, 'ingreso directo', IDPRODUCTO, NOW(), CONCAT('ingreso directo product: ', IDPRODUCTO, ' cant: ',CANTIDAAUMENTO));

insert into kardex (kardex_fecha,kardex_tipo,kardex_ingreso,kardex_p_ingreso,kardex_total,producto_id,kardex_precio_general) 
VALUES (CURDATE(),'INGRESO',CANTIDAAUMENTO,@preciocompra,@stock,IDPRODUCTO,@preciocompra);

END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_BUSCAR_EQUIPO_DNI
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_BUSCAR_EQUIPO_DNI`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_BUSCAR_EQUIPO_DNI`(IN DNI VARCHAR(100))
SELECT
	 r.rece_id   as receid, 
	  MAX(r.cliente_id)   as cliente_id,
		concat( ' R-000', r.rece_id ) as cliente_dni,  
	  MAX(c.cliente_dni)   as cliente_dni2, 
	  MAX(c.cliente_nombres)   as cliente_nombres, 
	  MAX(re.equipo)   as rece_equipo,
	-- GROUP_CONCAT(CONCAT('  ', re.equipo, ' '     AS equipo,
	  MAX(r.rece_concepto)   as rece_concepto,
	  MAX(r.rece_fregistro)   as rece_fregistro, 
	  MAX(r.rece_estado)   as rece_estado
FROM
	recepcion r
	INNER JOIN
	cliente c
	ON 
		r.cliente_id = c.cliente_id
		INNER JOIN recep_equipo re ON r.rece_id = re.rece_id
		where c.cliente_dni = DNI 
		GROUP BY r.rece_id
		ORDER BY r.rece_fregistro DESC
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_BUSCAR_MOV_IMEI
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_BUSCAR_MOV_IMEI`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_BUSCAR_MOV_IMEI`(IN P_IMEI VARCHAR(100))
BEGIN
DECLARE v_idproducto INT DEFAULT NULL;
    DECLARE v_nombre_product VARCHAR(255) DEFAULT NULL;
	
    SELECT producto_id INTO v_idproducto
    FROM producto_detalle
    WHERE imei COLLATE utf8mb4_general_ci = P_IMEI
    LIMIT 1;
    
    SELECT CONCAT(p.producto_codigo, ' - ', p.producto_nombre) INTO v_nombre_product
    FROM producto p
    WHERE p.producto_id = v_idproducto
    LIMIT 1;
    
   
    
    SELECT 
        'Ingreso' AS tipo,
        DATE_FORMAT(pd.fecha, '%d/%m/%Y') AS fecha,
        '1.00' AS cantidad,
        '' AS nombre_u,
        v_nombre_product AS compro
    FROM producto_detalle pd
    WHERE pd.imei COLLATE utf8mb4_general_ci = P_IMEI
    
    UNION ALL
    
    SELECT 
        'Venta' AS tipo,
        DATE_FORMAT(dv.vdetalle_fecha, '%d/%m/%Y') AS fecha,
        dv.vdetalle_cantidad AS cantidad,
        u.usu_nombre AS nombre_u,
        (
            SELECT k.venta_comprobante 
            FROM kardex k 
            WHERE k.imei = P_IMEI AND k.kardex_tipo = 'SALIDA' 
						GROUP BY  k.venta_comprobante
            LIMIT 1
        ) AS compro
    FROM detalle_venta dv
    INNER JOIN venta v ON dv.venta_id = v.venta_id
    INNER JOIN usuario u ON v.usu_id = u.usu_id
    WHERE dv.v_imei = P_IMEI
      AND dv.v_imei IS NOT NULL
      AND dv.v_imei <> ''
    
    UNION ALL
    
    SELECT 
        'Reparación' AS tipo,
        DATE_FORMAT(re.fecha, '%d/%m/%Y') AS fecha,
        '1.00' AS cantidad,
        u.usu_nombre AS nombre_u,
        CONCAT('R000', re.rece_id) AS compro
    FROM recep_equipo re
    INNER JOIN recepcion r ON re.rece_id = r.rece_id
    INNER JOIN usuario u ON r.usuario_registrador = u.usu_id
    WHERE re.serie = P_IMEI;
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_BUSCAR_MOV_IMEI_2
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_BUSCAR_MOV_IMEI_2`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_BUSCAR_MOV_IMEI_2`(IN P_IMEI VARCHAR(100))
BEGIN
    DECLARE v_idproducto INT DEFAULT NULL;
    DECLARE v_nombre_product VARCHAR(255) DEFAULT NULL;
	
    SELECT producto_id INTO v_idproducto
    FROM producto_detalle
    WHERE imei COLLATE utf8mb4_general_ci = P_IMEI
    LIMIT 1;
    
    SELECT CONCAT(p.producto_codigo, ' - ', p.producto_nombre) INTO v_nombre_product
    FROM producto p
    WHERE p.producto_id = v_idproducto
    LIMIT 1;
    
   
    
    SELECT 
        'Ingreso' AS tipo,
        DATE_FORMAT(pd.fecha, '%d/%m/%Y') AS fecha,
        '1.00' AS cantidad,
        '' AS nombre_u,
        v_nombre_product AS compro
    FROM producto_detalle pd
    WHERE pd.imei COLLATE utf8mb4_general_ci = P_IMEI
    
    UNION ALL
    
    SELECT 
        'Venta' AS tipo,
        DATE_FORMAT(dv.vdetalle_fecha, '%d/%m/%Y') AS fecha,
        dv.vdetalle_cantidad AS cantidad,
        u.usu_nombre AS nombre_u,
        (
            SELECT k.venta_comprobante 
            FROM kardex k 
            WHERE k.imei = P_IMEI AND k.kardex_tipo = 'SALIDA' 
            LIMIT 1
        ) AS compro
    FROM detalle_venta dv
    INNER JOIN venta v ON dv.venta_id = v.venta_id
    INNER JOIN usuario u ON v.usu_id = u.usu_id
    WHERE dv.v_imei = P_IMEI
      AND dv.v_imei IS NOT NULL
      AND dv.v_imei <> ''
    
    UNION ALL
    
    SELECT 
        'Reparación' AS tipo,
        DATE_FORMAT(re.fecha, '%d/%m/%Y') AS fecha,
        '1.00' AS cantidad,
        u.usu_nombre AS nombre_u,
        CONCAT('R000', re.rece_id) AS compro
    FROM recep_equipo re
    INNER JOIN recepcion r ON re.rece_id = r.rece_id
    INNER JOIN usuario u ON r.usuario_registrador = u.usu_id
    WHERE re.serie = P_IMEI;
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_BUSCAR_PEDIDO_TIMELINE
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_BUSCAR_PEDIDO_TIMELINE`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_BUSCAR_PEDIDO_TIMELINE`(IN p_dni VARCHAR(50), IN p_nropedido VARCHAR(150))
BEGIN
SELECT
	pb.id_segui,
	pb.pedido_id, 
	pb.pedido_correlativo, 
	DATE_FORMAT(pb.fecha_segui, '%d/%m/%Y %H:%i:%s' ) AS fecha_segui,	
	pb.estado_segui, 
	pb.total_segui,
	(SELECT confi_moneda FROM configuracion LIMIT 1) AS confi_moneda
FROM
	pedido_bitacora AS pb
	WHERE pb.pedido_correlativo = p_nropedido
	ORDER BY pb.id_segui ASC;
	
	END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_BUSCAR_SERIE_RECEP
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_BUSCAR_SERIE_RECEP`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_BUSCAR_SERIE_RECEP`(IN p_serie VARCHAR(100))
BEGIN
  DECLARE v_receid INT;

  -- Obtener ID de la recepción
  SELECT rece_id
  INTO v_receid
  FROM recep_equipo 
  WHERE TRIM(serie) = TRIM(p_serie); 

  -- Datos de recepción
  SELECT 'N° Recepción' AS campo, CONCAT('R-000', r.rece_id) AS valor, s.nombre_su AS sucursal
  FROM recepcion r
  JOIN sucursales s ON s.id_sucu = r.id_sucu
  WHERE r.rece_id = v_receid

  UNION ALL

  SELECT 'Fecha y Monto', 
         CONCAT('Recepcionado el: ', DATE_FORMAT(r.rece_fregistro, '%d/%m/%Y'), ' - Monto de: ', FORMAT(r.rece_monto, 2)), 
         s.nombre_su
  FROM recepcion r
  JOIN sucursales s ON s.id_sucu = r.id_sucu
  WHERE r.rece_id = v_receid

  UNION ALL

  SELECT 'Falla del equipo', re.falla, NULL
  FROM recep_equipo re
  
  WHERE re.rece_id = v_receid

  UNION ALL

  SELECT 'Revisión Técnico', 
         CONCAT('Revisado por Técnico: ', t.usu_nombre, ' - Detalles: ', r.diagnostico_tecnico), 
         s.nombre_su
  FROM recepcion r
  JOIN usuario t ON r.tecnico = t.usu_id
  JOIN sucursales s ON s.id_sucu = r.id_sucu
  WHERE r.rece_id = v_receid

  UNION ALL

  -- Fotos recepción
  SELECT 'Fotos Recepción 1', NULL, r.rece_foto1
  FROM recepcion r
  WHERE r.rece_id = v_receid

 

  UNION ALL

  -- Servicio
  SELECT 'Estado del Servicio', 
         CONCAT('Término de Recep.: ', s.servicio_entrega, ' - Fecha:', DATE_FORMAT(s.servicio_fregistro, '%d/%m/%Y')), 
         su.nombre_su
  FROM servicio s
  JOIN sucursales su ON su.id_sucu = s.id_sucu
  WHERE s.rece_id = v_receid

 

  UNION ALL

  -- Producto
  SELECT 'Producto', CONCAT(p.producto_codigo,' - ', p.producto_nombre), NULL
  FROM producto p
  JOIN producto_detalle pd ON p.producto_id = pd.producto_id
  WHERE TRIM(pd.imei) = TRIM(p_serie)

  UNION ALL

  -- Venta
  SELECT 'Venta Asociada', 
         CONCAT('Venta ', v.venta_comprobante,': ', v.venta_serie, '-', v.venta_num_comprobante, 
                ' - Fecha: ', DATE_FORMAT(v.venta_fregistro, '%d/%m/%Y'), 
                ' - Monto: S/. ', FORMAT(vd.vdetalle_precio, 2)), 
         s.nombre_su
  FROM detalle_venta vd
  JOIN venta v ON v.venta_id = vd.venta_id
  JOIN sucursales s ON s.id_sucu = vd.id_sucu
  WHERE TRIM(vd.v_imei) = TRIM(p_serie);
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_BUSCAR_VENTAS_CLIENTE_INICIO
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_BUSCAR_VENTAS_CLIENTE_INICIO`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_BUSCAR_VENTAS_CLIENTE_INICIO`(IN p_dni VARCHAR(20))
BEGIN

DECLARE idcliente INT;

SET @idcliente:=(SELECT cliente_id FROM cliente where cliente_dni = p_dni );


SELECT
	venta.venta_id, 
	MAX(cliente.cliente_nombres) as cliente_nombres, 
	MAX(venta.venta_comprobante) as venta_comprobante, 
	CONCAT_WS(' - ',venta.venta_serie,venta.venta_num_comprobante) AS comprobante, 
	MAX(venta.venta_total) as venta_total, 
	 
	DATE_FORMAT(venta.venta_fregistro, '%d/%m/%Y') as venta_fregistro, 
	MAX(venta.venta_estado) as venta_estado, 
	MAX(venta.venta_serie) as venta_serie, 
	MAX(venta.venta_num_comprobante) as venta_num_comprobante, 
	MAX(forma_pago.fpago_descripcion) as fpago_descripcion,
	MAX(venta.venta_impuesto) as venta_impuesto,

	GROUP_CONCAT(CONCAT('  ' , producto.producto_nombre  )) as equipo
	-- GROUP_CONCAT(CONCAT('  ' , producto.producto_nombre ,  '   (  ',  recep_equipo.monto , '  ) ' )) as equipos,


	
FROM
	venta
	INNER JOIN
	cliente
	ON 
		venta.cliente_id = cliente.cliente_id
	INNER JOIN
	comprobante
	ON 
		venta.compro_id = comprobante.compro_id

	INNER JOIN
	forma_pago
	ON 
		venta.fpago_id = forma_pago.fpago_id
	INNER JOIN 
	detalle_venta
	ON
	detalle_venta.venta_id = venta.venta_id
	INNER JOIN producto 
	ON
	detalle_venta.producto_id = producto.producto_id
		WHERE venta.cliente_id = @idcliente
GROUP BY venta.venta_id
		ORDER BY venta_id DESC;


END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_CALCULO_MONTOS_RECEP_EQUIPOS
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_CALCULO_MONTOS_RECEP_EQUIPOS`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_CALCULO_MONTOS_RECEP_EQUIPOS`(IN RECEID INT)
SELECT
	SUM( monto ) AS monto_su,
	SUM( abono ) AS abono_s,
	(SUM( monto ) + (SELECT IFNULL(SUM(monto_ri),0) FROM recep_insumos WHERE rece_id = RECEID ) - SUM( abono )) AS resta_s ,
	(SELECT IFNULL(SUM(monto_ri),0) FROM recep_insumos WHERE rece_id = RECEID ) as suma_insumo,
	(SUM( monto ) + (SELECT IFNULL(SUM(monto_ri),0) FROM recep_insumos WHERE rece_id = RECEID )) as suma_total_serv
FROM
	recep_equipo 
WHERE
	rece_id = RECEID
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_CAMBIAR_MONTOS_EQUIPOS_SERVICIO
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_CAMBIAR_MONTOS_EQUIPOS_SERVICIO`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_CAMBIAR_MONTOS_EQUIPOS_SERVICIO`(IN IDEQUIP INT, IN MONTOEQUI DECIMAL(10,2), IN ABONOEQUI DECIMAL(10,2), IN RECEPID INT)
BEGIN

/*ACTUALIZAMOS MONTO Y ABONO DE LOS EQUIPOS*/
UPDATE recep_equipo SET
monto = MONTOEQUI,
abono = ABONOEQUI
WHERE id_equipo = IDEQUIP;



set @montonuevo = (select SUM(monto) from recep_equipo where rece_id =RECEPID);
set @abononuevo = (select SUM(abono) from recep_equipo where rece_id =RECEPID);
set @pendientenuevo = ( @montonuevo - @abononuevo );




/*ACTUALIZAMOS MONTO ABONO Y DEBE -  DE LA RECEPCION*/
UPDATE recepcion SET
rece_monto = @montonuevo,
rece_adelanto = @abononuevo,
rece_debe = @pendientenuevo
WHERE rece_id = RECEPID;


END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for sp_correlativo
-- ----------------------------
DROP PROCEDURE IF EXISTS `sp_correlativo`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_correlativo`()
begin
	declare siguiente_codigo int;
	declare producto_codigo int;
    set @siguiente_codigo = (Select ifnull(max(convert(producto_codigo, signed integer)), 0) from producto) + 1;
    set @producto_codigo = concat('P', LPAD( siguiente_codigo, 4, '0'));
		
		SELECT max(producto_codigo) =  @producto_codigo FROM producto;
end
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_DATOS_PERFIL_USUARIO
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_DATOS_PERFIL_USUARIO`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_DATOS_PERFIL_USUARIO`(IN ID INT)
SELECT
	usuario.usu_id, 
	usuario.usu_nombre, 
	usuario.usu_contrasena, 
	usuario.rol_id, 
	usuario.usu_estado, 
	usuario.usu_email, 
	usuario.usu_foto, 
	rol.rol_nombre
FROM
	usuario
	INNER JOIN
	rol
	ON 
		usuario.rol_id = rol.rol_id
	WHERE  usuario.usu_id = ID
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_DESHABILITAR_PERMISO
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_DESHABILITAR_PERMISO`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_DESHABILITAR_PERMISO`(IN p_mend_id INT)
BEGIN
	UPDATE td_menu_detalle 
	SET mend_permi = 'No'
	
	WHERE
		mend_id = p_mend_id;

END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_DISMINUIR_STOCK
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_DISMINUIR_STOCK`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_DISMINUIR_STOCK`(IN IDPRODUCTO INT, IN CANTIDADISMINUIR INT,IN RESTA VARCHAR(100), IN p_idalmacen INT)
BEGIN

DECLARE v_stock INT;
	DECLARE v_preciocompra DECIMAL(10,2);
	DECLARE v_stock_final INT;
	DECLARE EXIT HANDLER FOR SQLEXCEPTION
	BEGIN
		ROLLBACK;
		SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Error al disminuir stock';
	END;

	START TRANSACTION;

	-- Obtener stock actual
	SELECT cantidad_s INTO v_stock
	FROM stock
	WHERE producto_id = IDPRODUCTO AND id_almacen = p_idalmacen;

	-- Validación opcional de stock suficiente
	IF v_stock IS NULL OR v_stock < CANTIDADISMINUIR THEN
		ROLLBACK;
		SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Stock insuficiente para realizar la salida';
	END IF;

	-- Actualizar stock
	UPDATE stock
	SET cantidad_s = cantidad_s - CANTIDADISMINUIR
	WHERE producto_id = IDPRODUCTO AND id_almacen = p_idalmacen;

	-- Obtener precio de compra y stock actual para kardex
	SELECT producto_pcompra INTO v_preciocompra
	FROM producto
	WHERE producto_id = IDPRODUCTO;

	SELECT cantidad_s INTO v_stock_final
	FROM stock
	WHERE producto_id = IDPRODUCTO AND id_almacen = p_idalmacen;

	-- Registrar en movimientos
	INSERT INTO movimientos (
		producto_id,
		id_almacen,
		cantidad,
		tipo_movimiento,
		referencia_id,
		fecha_reg,
		observacion
	) VALUES (
		IDPRODUCTO,
		p_idalmacen,
		-CANTIDADISMINUIR,
		'SALIDA DIRECTA',
		IDPRODUCTO,
		NOW(),
		CONCAT('salida directa producto: ', IDPRODUCTO, ' cant: ', CANTIDADISMINUIR)
	);

	-- Registrar en kardex
	INSERT INTO kardex (
		kardex_fecha,
		kardex_tipo,
		kardex_salida,
		kardex_p_salida,
		kardex_total,
		producto_id,
		kardex_precio_general
	) VALUES (
		CURDATE(),
		'SALIDA DIRECTA',
		CANTIDADISMINUIR,
		v_preciocompra,
		v_stock_final,
		IDPRODUCTO,
		v_preciocompra
	);

	COMMIT;
/*
DECLARE v_stock int;

SELECT cantidad_s
INTO  v_stock
from stock
WHERE producto_id = IDPRODUCTO and id_almacen = p_idalmacen;

UPDATE stock SET
cantidad_s = v_stock - CANTIDADISMINUIR
WHERE producto_id = IDPRODUCTO and id_almacen = p_idalmacen;


set @preciocompra = (select producto_pcompra from producto where producto_id =IDPRODUCTO);
set @stock = (select cantidad_s from stock where producto_id = IDPRODUCTO and id_almacen = p_idalmacen);

INSERT INTO movimientos (producto_id, id_almacen, cantidad, tipo_movimiento, referencia_id, fecha_reg, observacion )
 VALUES (IDPRODUCTO, p_idalmacen, -CANTIDADISMINUIR, 'salida directa', IDPRODUCTO, NOW(), CONCAT('salida directa product: ', IDPRODUCTO, ' cant: ',CANTIDADISMINUIR));

insert into kardex (kardex_fecha, kardex_tipo, kardex_salida, kardex_p_salida, kardex_total, producto_id, kardex_precio_general) 
VALUES (CURDATE(),'SALIDA DIRECTA',CANTIDADISMINUIR,@preciocompra,@stock,IDPRODUCTO,@preciocompra);
*/
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_EJECUTAR_INSERTAR_MENUS_DET
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_EJECUTAR_INSERTAR_MENUS_DET`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_EJECUTAR_INSERTAR_MENUS_DET`(IN xrol_id INT)
BEGIN
	DECLARE rolCount INT;

	SELECT COUNT(*) INTO rolCount FROM td_menu_detalle WHERE rol_id = xrol_id;
	
	IF rolCount = 0 THEN
		INSERT INTO td_menu_detalle(rol_id,men_id)
		SELECT xrol_id, men_id FROM menu WHERE estado=1;
	ELSE
		INSERT INTO td_menu_detalle(rol_id,men_id)
		SELECT xrol_id,men_id FROM menu WHERE estado=1 AND men_id NOT IN (SELECT men_id FROM td_menu_detalle WHERE rol_id = xrol_id);
	END IF;
	
	SELECT 
		md.mend_id,
		md.rol_id,
		md.mend_permi,
		m.men_id,
		m.men_vista,
		m.men_icon,
		m.men_ruta,
		md.men_crear,
		md.men_editar,
		md.men_eliminar,
		md.vista_inicio
	FROM td_menu_detalle md
	INNER JOIN menu m ON m.men_id = md.men_id
	WHERE 
	md.rol_id = xrol_id
	AND m.estado=1;
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_ELIMINAR_ALMACEN
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_ELIMINAR_ALMACEN`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_ELIMINAR_ALMACEN`(IN p_idalmacen INT)
BEGIN
    -- Borrado lógico: cambia el estado a INACTIVO
    DELETE FROM almacen
   WHERE id_almacen = p_idalmacen;

END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_ELIMINAR_BANNER
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_ELIMINAR_BANNER`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_ELIMINAR_BANNER`(IN p_idbanner INT)
BEGIN

DELETE FROM banner WHERE id_banner = p_idbanner;

END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_ELIMINAR_DETALLE_VENTA
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_ELIMINAR_DETALLE_VENTA`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_ELIMINAR_DETALLE_VENTA`(
    IN p_idventa INT,
    IN p_idproducto INT,
    IN p_cantidad INT,
    IN p_idimei INT,
    IN p_sucurid INT,
    IN p_iddetallev INT
)
BEGIN
    DECLARE TIENE_IMEI VARCHAR(5);
    DECLARE IMEIPROD VARCHAR(200);

    -- Iniciar una transacción
    START TRANSACTION;

    -- Obtener si el producto tiene IMEI
    SELECT pro_imei INTO TIENE_IMEI FROM producto WHERE producto_id = p_idproducto;
 

    IF TIENE_IMEI = 'Si' THEN
    
        -- Retornar el IMEI en producto detalle
        UPDATE producto_detalle
        SET vendido = 'No'
        WHERE producto_id = p_idproducto AND id_prod_imei = p_idimei;

        -- Retornar el stock que es de 1 (1 IMEI a la vez)
        UPDATE producto
        SET producto_stock = producto_stock + 1
        WHERE producto_id = p_idproducto;
        
        -- retornar el stock real
        UPDATE stock
        SET cantidad_s = cantidad_s + 1
        WHERE producto_id = p_idproducto AND id_sucu = p_sucurid;

        -- Eliminar del kardex
        DELETE FROM kardex
        WHERE vdetalle_id = p_iddetallev AND venta_id = p_idventa AND producto_id = p_idproducto AND imei = IMEIPROD;
        
         -- Eliminar de LA TABLA MOVIMIENTOS
        DELETE FROM movimientos
        WHERE id_detalleventa = p_iddetallev  AND producto_id = p_idproducto;

    ELSE
        -- Retornar el stock
        UPDATE producto
        SET producto_stock = producto_stock + p_cantidad
        WHERE producto_id = p_idproducto;
        
         -- retornar el stock real
        UPDATE stock
        SET cantidad_s = cantidad_s + p_cantidad
        WHERE producto_id = p_idproducto AND id_sucu = p_sucurid;

        -- Eliminar del kardex
        DELETE FROM kardex
        WHERE vdetalle_id = p_iddetallev AND venta_id = p_idventa AND producto_id = p_idproducto;
        
         -- Eliminar de LA TABLA MOVIMIENTOS
        DELETE FROM movimientos
        WHERE id_detalleventa = p_iddetallev  AND producto_id = p_idproducto; 
        
        
    END IF;
    
     -- Eliminar el item del detalle de la venta
    DELETE FROM detalle_venta
    WHERE vdetalle_id = p_iddetallev AND venta_id = p_idventa AND producto_id = p_idproducto;
    
    
     UPDATE venta v
    SET
        v.venta_total = (
            SELECT SUM(dv.vdetalle_precio * dv.vdetalle_cantidad - dv.vdetalle_descuento)
            FROM detalle_venta dv
            WHERE dv.venta_id = p_idventa
        ),
        v.venta_impuesto = (
            SELECT SUM((dv.vdetalle_precio * dv.vdetalle_cantidad - dv.vdetalle_descuento) * (v.venta_porcentaje))
            FROM detalle_venta dv
            WHERE dv.venta_id = p_idventa
        ),
        v.venta_descuento = (
            SELECT SUM(dv.vdetalle_descuento)
            FROM detalle_venta dv
            WHERE dv.venta_id = p_idventa
        )
         
    WHERE v.venta_id = p_idventa;

    

   

    -- Confirmar la transacción
    COMMIT;
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_ELIMINAR_EQUIPO_RECE
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_ELIMINAR_EQUIPO_RECE`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_ELIMINAR_EQUIPO_RECE`(IN ID_EQUI INT)
DELETE FROM recep_equipo
	WHERE id_equipo = ID_EQUI
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_ELIMINAR_IMEI
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_ELIMINAR_IMEI`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_ELIMINAR_IMEI`(IN ID_PRO INT, IN IMEI_E VARCHAR(100), IN p_idalmacen INT)
BEGIN

DECLARE v_stock INT;
	DECLARE v_preciocompra DECIMAL(10,2);
	DECLARE v_stock_final INT;
	DECLARE v_imei_limpio VARCHAR(100);

	DECLARE EXIT HANDLER FOR SQLEXCEPTION
	BEGIN
		ROLLBACK;
		SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Error al eliminar IMEI';
	END;

	START TRANSACTION;

	-- Limpiar el IMEI de entrada
	SET v_imei_limpio = TRIM(REPLACE(IMEI_E, ' ', ''));

	-- Verificar stock
	SELECT cantidad_s INTO v_stock
	FROM stock
	WHERE producto_id = ID_PRO AND id_almacen = p_idalmacen;

	IF v_stock IS NULL OR v_stock < 1 THEN
		ROLLBACK;
		SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Stock insuficiente para eliminar el IMEI';
	END IF;

	-- Disminuir stock
	UPDATE stock
	SET cantidad_s = cantidad_s - 1
	WHERE producto_id = ID_PRO AND id_almacen = p_idalmacen;

	-- Marcar IMEI como eliminado
	UPDATE producto_detalle
	SET imei = CONCAT(v_imei_limpio, '-DEL'),
		vendido = 'DEL'
	WHERE producto_id = ID_PRO 
	  AND imei COLLATE utf8mb4_general_ci = v_imei_limpio;

	-- Obtener precio de compra
	SELECT producto_pcompra INTO v_preciocompra
	FROM producto
	WHERE producto_id = ID_PRO;

	-- Obtener stock actualizado
	SELECT cantidad_s INTO v_stock_final
	FROM stock
	WHERE producto_id = ID_PRO AND id_almacen = p_idalmacen;

	-- Registrar movimiento
	INSERT INTO movimientos (
		producto_id,
		id_almacen,
		cantidad,
		tipo_movimiento,
		referencia_id,
		fecha_reg,
		observacion,
		imei
	) VALUES (
		ID_PRO,
		p_idalmacen,
		-1,
		'SALIDA DIRECTA',
		ID_PRO,
		NOW(),
		CONCAT('salida directa producto con IMEI: ', v_imei_limpio),
		v_imei_limpio
	);

	-- Registrar en kardex
	INSERT INTO kardex (
		kardex_fecha,
		kardex_tipo,
		kardex_salida,
		kardex_p_salida,
		kardex_total,
		producto_id,
		kardex_precio_general,
		imei
	) VALUES (
		CURDATE(),
		'SALIDA DIRECTA',
		1,
		v_preciocompra,
		v_stock_final,
		ID_PRO,
		v_preciocompra,
		v_imei_limpio
	);

	COMMIT;

/*
DECLARE v_stock int;

SELECT cantidad_s
INTO  v_stock
from stock
WHERE producto_id = ID_PRO and id_almacen = p_idalmacen;

UPDATE stock SET
cantidad_s = v_stock - 1
WHERE producto_id = ID_PRO and id_almacen = p_idalmacen;

UPDATE producto_detalle SET
    imei = CONCAT(TRIM(REPLACE(IMEI_E, ' ', '')), '-DEL'),
    vendido = 'DEL'
WHERE producto_id = ID_PRO 
  AND TRIM(REPLACE(imei, ' ', '')) COLLATE utf8mb4_general_ci = TRIM(REPLACE(IMEI_E, ' ', ''));

set @preciocompra = (select producto_pcompra from producto where producto_id =ID_PRO);
set @stock = (select cantidad_s from stock where producto_id = ID_PRO and id_almacen = p_idalmacen);

INSERT INTO movimientos (producto_id, id_almacen, cantidad, tipo_movimiento, referencia_id, fecha_reg, observacion, imei )
 VALUES (ID_PRO, p_idalmacen, 1, 'salida directa', ID_PRO, NOW(), CONCAT('salida directa product con imei: ', ID_PRO), IMEI_E);

insert into kardex (kardex_fecha, kardex_tipo, kardex_salida, kardex_p_salida, kardex_total, producto_id, kardex_precio_general, imei) 
VALUES (CURDATE(),'SALIDA DIRECTA',1,@preciocompra,@stock,ID_PRO,@preciocompra, IMEI_E);
*/
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_ELIMINAR_INSUMOS_REPARACION
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_ELIMINAR_INSUMOS_REPARACION`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_ELIMINAR_INSUMOS_REPARACION`(IN IDINSUMOS INT,  IN CANTD VARCHAR(50), IN IDPRODUC INT, IN RECEID INT, IN IDUSUA INT)
BEGIN
DECLARE NOMUSUARIO VARCHAR(200);


SET @NOMUSUARIO:=(select usu_nombre from usuario where usu_id = IDUSUA );


/*ELIMINAMOS EL INSUMO */
DELETE FROM recep_insumos 
where id_insumo = IDINSUMOS;



/* REGRESA EL STOCK*/

UPDATE   producto SET
producto_stock = producto_stock + CANTD
WHERE producto_id =  IDPRODUC;


/* INSERTAR EN KARDEX*/
set @preciocompra = (select producto_pcompra from producto where producto_id =IDPRODUC);
set @stock = (select producto_stock from producto where producto_id =IDPRODUC);

insert into kardex (kardex_fecha,kardex_tipo,kardex_ingreso,kardex_p_ingreso,kardex_total,producto_id,kardex_precio_general, venta_comprobante, tecnico) 
VALUES (CURDATE(),'DEVOLUCION INSUMO',CANTD,@preciocompra,@stock,IDPRODUC,@preciocompra, CONCAT('R-000',RECEID), @NOMUSUARIO);



END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_ELIMINAR_MARCA
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_ELIMINAR_MARCA`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_ELIMINAR_MARCA`(IN ID INT)
DELETE FROM marca WHERE marca_id = ID
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_ELIMINAR_NOTAS
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_ELIMINAR_NOTAS`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_ELIMINAR_NOTAS`(IN p_idnota INT)
BEGIN

DELETE FROM notas 
WHERE nota_id = p_idnota;

END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_ELIMINAR_ROL_ESTADO
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_ELIMINAR_ROL_ESTADO`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_ELIMINAR_ROL_ESTADO`(IN ID INT,IN ESTADO VARCHAR(30))
UPDATE rol set
rol_estado=ESTADO
where rol_id=ID
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_ELIMINAR_SERVICIO
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_ELIMINAR_SERVICIO`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_ELIMINAR_SERVICIO`(IN ID INT)
DELETE  FROM servicio 
where servicio_id=ID
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_ELIMINAR_SUCURSALES
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_ELIMINAR_SUCURSALES`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_ELIMINAR_SUCURSALES`(IN p_id_sucu INT)
BEGIN
   
    DELETE FROM sucursales WHERE id_sucu = p_id_sucu;
		
		
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_ELIMINAR_UMEDIDA
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_ELIMINAR_UMEDIDA`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_ELIMINAR_UMEDIDA`(IN ID INT)
DELETE FROM unidadmedida WHERE unidad_id = ID
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_ELIMINAR_USUARIO_ESTADO
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_ELIMINAR_USUARIO_ESTADO`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_ELIMINAR_USUARIO_ESTADO`(IN ID INT,IN ESTADO VARCHAR(10))
UPDATE usuario set
usu_estado=ESTADO
where usu_id=ID
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_GRAFICO_SERVICIO
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_GRAFICO_SERVICIO`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_GRAFICO_SERVICIO`(IN FINICIO DATE, IN FFIN DATE, IN p_idsucursal INT)
SELECT
COUNT(*) as cantidad,	
 CONCAT(DATE_FORMAT(servicio.servicio_fregistro, '%d/%m/%Y'), ' - R-000',recepcion.rece_id, ' - ', FORMAT(SUM(servicio.servicio_monto), 2)) AS tipos
-- CONCAT_WS(' - ',motivo.motivo_descripcion,recepcion.rece_equipo, DATE_FORMAT(servicio.servicio_fregistro , '%d/%m/%Y') ) as tipos 
FROM
	recepcion
	INNER JOIN
	servicio
	ON 
		recepcion.rece_id = servicio.rece_id
	INNER JOIN
	motivo
	ON 
		recepcion.motivo_id = motivo.motivo_id
			WHERE servicio.servicio_fregistro BETWEEN FINICIO AND FFIN and servicio.id_sucu = p_idsucursal
	-- GROUP BY tipos
	
	GROUP BY servicio.servicio_fregistro, recepcion.rece_id
	ORDER BY servicio.servicio_fregistro
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_GRAFICO_VENTAS
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_GRAFICO_VENTAS`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_GRAFICO_VENTAS`(IN FINICIO DATE, IN FFIN DATE, IN p_idsucursal INT)
SELECT
	COUNT(*) as cant_ventas,
 CONCAT(DATE_FORMAT(venta.venta_fregistro, '%d/%m/%Y'), ' - ', FORMAT(SUM(venta.venta_total), 2)) AS fecha_total_concat
	
FROM
	venta
			WHERE venta.venta_fregistro BETWEEN FINICIO AND FFIN and venta.id_sucu = p_idsucursal and venta.venta_estado <> 'ANULADA'
			GROUP BY venta.venta_fregistro
	ORDER BY venta.venta_fregistro
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_HABILITAR_PERMISO
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_HABILITAR_PERMISO`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_HABILITAR_PERMISO`(IN p_mend_id INT)
BEGIN
	UPDATE td_menu_detalle 
	SET mend_permi = 'Si'
	
	WHERE
		mend_id = p_mend_id;

END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_INICIO
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_INICIO`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_INICIO`()
BEGIN
	DECLARE VENTA INT;
	DECLARE SERVICIO INT;
	SELECT COUNT(*) INTO VENTA FROM venta WHERE venta_estado='REGISTRADA';
	SELECT COUNT(*) INTO SERVICIO FROM servicio WHERE servicio_estado='ACTIVO';
	
	SELECT VENTA, SERVICIO;


END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_INSERTAR_EQUIPO_DIRECTO_MODIFICAR
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_INSERTAR_EQUIPO_DIRECTO_MODIFICAR`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_INSERTAR_EQUIPO_DIRECTO_MODIFICAR`(IN ID_RE INT, IN EQUI VARCHAR(150),IN SERI VARCHAR(150), IN MONT DECIMAL(10,2), IN ADELNT  DECIMAL(10,2), IN P_FALLA VARCHAR(200))
BEGIN
DECLARE CANTIDAD INT;
SET @CANTIDAD:=(SELECT COUNT(*) FROM recep_equipo where rece_id = ID_RE AND serie COLLATE utf8mb4_general_ci= SERI );

if @CANTIDAD = 0 THEN
INSERT into recep_equipo (rece_id, equipo, serie, monto, abono, fecha, falla)values(ID_RE, EQUI,SERI, MONT, ADELNT, CURDATE(), P_FALLA);
SELECT 1;
ELSE
SELECT 2;
END IF;
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_INSERTAR_IMEI_AL_MODIFICAR
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_INSERTAR_IMEI_AL_MODIFICAR`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_INSERTAR_IMEI_AL_MODIFICAR`(IN ID_P INT, IN IMEI_R VARCHAR(100), IN p_idalmacen INT)
BEGIN
DECLARE v_stock int;

SELECT cantidad_s
INTO  v_stock
from stock
WHERE producto_id = ID_P and id_almacen = p_idalmacen;

 -- Verificar si el IMEI ya está registrado
    IF EXISTS (SELECT 1 FROM producto_detalle WHERE imei COLLATE utf8mb4_general_ci = IMEI_R AND producto_id = ID_P AND vendido = 'Si') THEN
        -- Si existe, actualizamos los datos del producto detalle
        UPDATE producto_detalle SET
	vendido = 'No'
        WHERE producto_id = ID_P AND imei = TRIM(REPLACE(IMEI_R, ' ', ''));

      	UPDATE stock  SET 
				cantidad_s = v_stock + 1
        WHERE producto_id = ID_P and id_almacen = p_idalmacen;
    ELSE
        -- Si no existe, lo insertamos
        INSERT INTO producto_detalle (producto_id, imei, fecha, vendido) 
        VALUES (ID_P, TRIM(REPLACE(IMEI_R, ' ', '')), NOW(), 'No');
        
        -- También actualizamos el stock del producto
				UPDATE stock  SET 
				cantidad_s = cantidad_s + 1
        WHERE producto_id = ID_P and id_almacen = p_idalmacen;
				
        
    END IF;

set @preciocompra = (select producto_pcompra from producto where producto_id =ID_P);
set @stock = (select cantidad_s from stock where producto_id =ID_P and id_almacen = p_idalmacen);

INSERT INTO movimientos (producto_id, id_almacen, cantidad, tipo_movimiento, referencia_id, fecha_reg, observacion, imei )
							VALUES (ID_P, p_idalmacen, 1, 'ingreso directo', ID_P, NOW(), CONCAT('ingreso directo de imei: ', IMEI_R), IMEI_R);


insert into kardex (kardex_fecha,kardex_tipo,kardex_ingreso,kardex_p_ingreso,kardex_total,producto_id,kardex_precio_general, imei) 
VALUES (CURDATE(),'INGRESO',1,@preciocompra,@stock,ID_P,@preciocompra, IMEI_R);


END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_KARDEX_COD_PRODUCTO
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_KARDEX_COD_PRODUCTO`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_KARDEX_COD_PRODUCTO`(IN CODPRODUCTO INT)
SELECT
	kardex.kardex_id,
	CONCAT_WS('  ',kardex.producto_codigo,kardex.producto_nombre	) as producto, 
	kardex.kardex_fecha as fecha, 
	kardex.kardex_tipo as tipo, 
	kardex.kardex_ingreso as ingreso, 
	kardex.kardex_p_ingreso as precio_ingreso, 
	(kardex.kardex_ingreso * kardex.kardex_p_ingreso ) as total_ingreso,
	kardex.kardex_salida as salida, 
	kardex.kardex_p_salida as precio_salida, 
	(kardex.kardex_salida * kardex.kardex_p_salida ) as total_salida,
	kardex.kardex_total as total_actual, 
	 kardex_precio_general  as precio_total, 
	(kardex.kardex_total * kardex_precio_general  ) as total_total,
	kardex.producto_id, 
	 
	kardex.venta_comprobante
FROM
	kardex
	where producto_id = CODPRODUCTO and kardex_tipo in ('INICIAL','INGRESO','SALIDA', 'SALIDA DIRECTA', 'SALIDA INSUMOS', 'DEVOLUCION INSUMO')
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_KARDEX_NOMBRE_CODIGO
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_KARDEX_NOMBRE_CODIGO`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_KARDEX_NOMBRE_CODIGO`(IN NOMBRE VARCHAR(255))
SELECT
	kardex.kardex_id, 
	kardex.producto_id, 
  kardex.producto_nombre,
	kardex.kardex_p_ingreso, 
	SUM(kardex_ingreso) as ingresos,
	sum(kardex_salida) as salidas,
	(SUM(kardex_ingreso) - sum(kardex_salida) ) as saldo
FROM
	kardex
	where  kardex.producto_nombre like  CONCAT('%',NOMBRE,'%')
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_LISTAR_ABONOS_VENTA
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_LISTAR_ABONOS_VENTA`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_LISTAR_ABONOS_VENTA`(
    IN p_venta_id INT
)
BEGIN
    SELECT 
        vc.id_credito_v,
        vc.venta_id,
        vc.monto_abono,
        DATE_FORMAT(vc.fecha_reg, '%d/%m/%y %H:%i') as fecha_reg,
        vc.forma_pago,
        vc.usu_id,
        vc.id_sucu,
        vc.caja_id,
        u.usu_nombre
    FROM venta_credito vc
    JOIN usuario u ON
    vc.usu_id = u.usu_id
    WHERE vc.venta_id = p_venta_id
    ORDER BY fecha_reg DESC;
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_LISTAR_ADLMACENES
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_LISTAR_ADLMACENES`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_LISTAR_ADLMACENES`()
BEGIN
SELECT
	a.id_almacen, 
	a.descripcion_al, 
	a.codigo_al, 
	a.estado_al, 
	a.fecha_reg_al
FROM
	almacen AS a;
	
	END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_LISTAR_ANIO_GASTO
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_LISTAR_ANIO_GASTO`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_LISTAR_ANIO_GASTO`()
SELECT YEAR(gastos_fregistro) as anio FROM gastos
where gastos_estado='ACTIVO' 
GROUP BY YEAR(gastos_fregistro)
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_LISTAR_ANIO_SERVICIO
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_LISTAR_ANIO_SERVICIO`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_LISTAR_ANIO_SERVICIO`()
SELECT YEAR(servicio_fregistro) as anio FROM servicio
GROUP BY YEAR(servicio_fregistro)
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_LISTAR_CATEGORIA
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_LISTAR_CATEGORIA`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_LISTAR_CATEGORIA`()
SELECT
	categoria.categoria_id, 
	categoria.categoria_descripcion, 
	categoria.categoria_estado
FROM
	categoria
	WHERE categoria.categoria_estado  = 'ACTIVO' OR categoria.categoria_estado  = 'INACTIVO'
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_LISTAR_CLIENTE
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_LISTAR_CLIENTE`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_LISTAR_CLIENTE`(IN p_idsucur INT, IN p_idrol INT)
BEGIN

SELECT
	c.cliente_id, 
	c.cliente_nombres, 
	c.cliente_celular, 
	c.cliente_dni, 
	c.cliente_estado,
	c.cliente_direccion,
	c.cliente_ape_p,
	c.cliente_ape_m,
	c.cliente_correo,
	c.cliente_tipo_doc,
	c.id_sucu,
	s.nombre_su,
  c.cliente_listanegra
FROM
	cliente c
	INNER JOIN sucursales s ON
	c.id_sucu = s.id_sucu
		 WHERE c.cliente_tipo_doc = 'DNI' AND (p_idrol = 1 OR c.id_sucu = p_idsucur)
		ORDER BY c.cliente_id DESC;
		
		END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_LISTAR_CLIENTE_VENTA
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_LISTAR_CLIENTE_VENTA`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_LISTAR_CLIENTE_VENTA`()
SELECT
	cliente.cliente_id, 
	cliente.cliente_nombres, 
	cliente.cliente_dni
FROM
	cliente
		WHERE cliente.cliente_estado ='ACTIVO'
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_LISTAR_COMPRAS_PRODUCTOS_IMEI
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_LISTAR_COMPRAS_PRODUCTOS_IMEI`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_LISTAR_COMPRAS_PRODUCTOS_IMEI`(IN p_sucursalid INT)
BEGIN
SELECT
	DATE_FORMAT(p.producto_fregistro, '%d/%m/%Y') as fecha,
	p.producto_nombre ,
	pd.imei,
	c.cliente_nombres,
	p.producto_pcompra,
	su.nombre_su,
	pd.vendido
FROM
stock st 
 JOIN producto p ON st.producto_id = p.producto_id
 JOIN cliente c ON p.cliente_id = c.cliente_id
 JOIN producto_detalle pd  ON st.producto_id = pd.producto_id
 JOIN sucursales su on st.id_sucu = su.id_sucu
	WHERE pd.vendido IN ('No', 'Si') and st.id_sucu = p_sucursalid;
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_LISTAR_COMPROBANTE
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_LISTAR_COMPROBANTE`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_LISTAR_COMPROBANTE`()
SELECT
	comprobante.compro_id, 
	comprobante.compro_tipo, 
	comprobante.compro_serie, 
	comprobante.compro_numero, 
	comprobante.compro_estado
FROM
	comprobante
		WHERE comprobante.compro_estado = 'ACTIVO' OR comprobante.compro_estado  = 'INACTIVO'
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_LISTAR_COTIZACION
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_LISTAR_COTIZACION`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_LISTAR_COTIZACION`(IN FINICIO DATE, IN FFIN DATE)
SELECT
	cotizacion.coti_id, 
	cotizacion.cliente_id, 
	cliente.cliente_nombres, 
	CONCAT_WS(' - ',cotizacion.coti_serie, cotizacion.coti_num_comprobante) AS cotizacion, 
	cotizacion.coti_total, 
	cotizacion.coti_fregistro, 
	cotizacion.usu_id, 
	usuario.usu_nombre, 
	cotizacion.coti_estado
FROM
	cotizacion
	INNER JOIN
	cliente
	ON 
		cotizacion.cliente_id = cliente.cliente_id
	INNER JOIN
	usuario
	ON 
		cotizacion.usu_id = usuario.usu_id
		WHERE cotizacion.coti_fregistro BETWEEN FINICIO AND FFIN
		ORDER BY coti_id DESC
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_LISTAR_DATA_CONFIGURACION
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_LISTAR_DATA_CONFIGURACION`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_LISTAR_DATA_CONFIGURACION`()
SELECT
	c.confi_moneda, 
	c.confi_tipo_igv, 
	c.confi_igv, 
	c.confi_moneda1, 
	c.confi_moneda2,
	c.confi_nombre_sistema,
	c.config_foto
FROM
	configuracion AS c
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_LISTAR_DATOS_WIDGET
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_LISTAR_DATOS_WIDGET`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_LISTAR_DATOS_WIDGET`(IN FINICIO DATE, IN FFIN DATE, IN p_idsucursal INT)
SELECT
	(select count(*) from venta where venta_estado='PAGADA' and venta_fregistro BETWEEN FINICIO AND FFIN and id_sucu = p_idsucursal )as ventas,
	(SELECT IFNULL(SUM(venta.venta_total),0) FROM venta WHERE venta_estado='PAGADA' and venta_fregistro BETWEEN FINICIO AND FFIN and id_sucu = p_idsucursal) as total_venta,
	(SELECT COUNT(*) FROM servicio WHERE servicio_fregistro BETWEEN FINICIO AND FFIN and id_sucu = p_idsucursal) as servicio,
	(select IFNULL(SUM(servicio_monto),0) from servicio where servicio_fregistro BETWEEN FINICIO AND FFIN and id_sucu = p_idsucursal) as total_servicio,
	(SELECT COUNT(*) FROM gastos where gastos_fregistro BETWEEN FINICIO AND FFIN and id_sucu = p_idsucursal) as gastos,
	(select IFNULL(SUM(gastos_monto),0) from gastos where gastos_fregistro BETWEEN FINICIO AND FFIN and id_sucu = p_idsucursal) as total_gastos,
	(SELECT COUNT(*) FROM stock where  id_sucu = p_idsucursal) as productos
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_LISTAR_DATOS_WIDGET2
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_LISTAR_DATOS_WIDGET2`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_LISTAR_DATOS_WIDGET2`(IN FINICIO DATE, IN FFIN DATE)
SELECT
	COUNT(*),
	(SELECT COUNT(*) FROM servicio where servicio.servicio_fregistro BETWEEN FINICIO AND FFIN ) as servicio
FROM
	VENTA
	WHERE venta.venta_fregistro BETWEEN FINICIO AND FFIN
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_LISTAR_DETALLE_TRASLADO
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_LISTAR_DETALLE_TRASLADO`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_LISTAR_DETALLE_TRASLADO`(IN p_idtraslado INT)
BEGIN
SELECT
	dt.id_det_tras, 
	dt.id_traslado, 
	dt.producto_id, 
	p.producto_nombre, 
	dt.cantidad_t, 
	dt.imei_t, 
	dt.fecha_r, 
	dt.precio_v
FROM
	detalle_traslados AS dt
	INNER JOIN
	producto AS p
	ON 
		dt.producto_id = p.producto_id 
		WHERE dt.id_traslado = p_idtraslado;
		END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_LISTAR_EMPRESA
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_LISTAR_EMPRESA`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_LISTAR_EMPRESA`()
SELECT
	c.confi_id, 
	c.confi_razon_social, 
	c.confi_ruc, 
	c.confi_nombre_representante, 
	c.confi_direccion, 
	c.confi_celular, 
	c.confi_telefono, 
	c.confi_correo, 
	c.config_foto, 
	c.confi_estado,
	c.confi_url,
	c.confi_cnta01,
	c.confi_nro_cuenta01,
	c.confi_cnta02,
	c.confi_nro_cuenta02,
	c.confi_moneda,
	c.confi_codigo_pos,
	c.confi_tipo_igv, 
	c.confi_igv, 
	c.confi_moneda1, 
	c.confi_moneda2,
	c.confi_nombre_sistema,
	c.url_sistema,
	c.cod_pais,
	c.confi_clave_correo,
	c.confi_link_pagina
	
	
FROM
	configuracion as c
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_LISTAR_FORMA_PAGO
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_LISTAR_FORMA_PAGO`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_LISTAR_FORMA_PAGO`()
SELECT
	forma_pago.fpago_id, 
	forma_pago.fpago_descripcion, 
	forma_pago.fpago_estado
FROM
	forma_pago
	WHERE forma_pago.fpago_id <> '3'
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_LISTAR_GASTO
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_LISTAR_GASTO`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_LISTAR_GASTO`(IN p_idusuario INT , IN p_idsucursal INT, IN p_rolid INT)
SELECT
	gastos.gastos_id, 
	gastos.gastos_descripcion, 
	gastos.gastos_monto, 
	gastos.gastos_responsable, 
	gastos.gastos_fregistro, 
	gastos.gastos_estado,
	gastos.tipo_mov,
	gastos.estado_caja,
	gastos.id_sucu,
	sucursales.nombre_su
FROM
	gastos JOIN sucursales ON
	gastos.id_sucu = sucursales.id_sucu
	WHERE ( p_rolid = 1 OR (gastos.usu_id = p_idusuario AND gastos.id_sucu = p_idsucursal))
	-- WHERE gastos.gastos_estado ='ACTIVO' OR gastos.gastos_estado = 'INACTIVO'
	ORDER BY gastos_id DESC
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_LISTAR_INSUMOS_DETALLE_REPARACION
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_LISTAR_INSUMOS_DETALLE_REPARACION`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_LISTAR_INSUMOS_DETALLE_REPARACION`(IN IDRECEP INT)
BEGIN
	SELECT
		ri.id_insumo,
		p.producto_nombre,
		ri.cantidad,
		ri.rece_id,
		ri.producto_id,
		ri.fecha,
		ri.monto_ri
	FROM
		recep_insumos ri
		INNER JOIN producto p ON ri.producto_id = p.producto_id
WHERE ri.rece_id = IDRECEP;

END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_LISTAR_MARCA
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_LISTAR_MARCA`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_LISTAR_MARCA`()
SELECT
	marca.marca_id, 
	marca.marca_descripcion, 
	marca.marca_estado
FROM
	marca
	WHERE marca.marca_id <> '1'
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_LISTAR_MOTIVO
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_LISTAR_MOTIVO`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_LISTAR_MOTIVO`()
SELECT
	motivo.motivo_id, 
	motivo.motivo_descripcion, 
	motivo.motivo_estado
FROM
	motivo
		WHERE motivo.motivo_estado='ACTIVO' OR motivo.motivo_estado = 'INACTIVO'
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_LISTAR_NOTAS_X_USUARIO
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_LISTAR_NOTAS_X_USUARIO`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_LISTAR_NOTAS_X_USUARIO`(IN p_idusuario INT)
BEGIN

select nota_id,  descripcion, estado,  DATE_FORMAT(fecha, '%d/%m/%Y %H:%i:%s')    from notas where usu_id = p_idusuario;


END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_LISTAR_NOTIFICACION
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_LISTAR_NOTIFICACION`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_LISTAR_NOTIFICACION`()
SELECT
	MAX(cliente.cliente_nombres) as cliente_nombres,
	MAX(recepcion.rece_estado) as rece_estado,
	MAX(recepcion.rece_fregistro) as rece_fregistro,
	MAX(recepcion.rece_concepto) as rece_concepto,
	CONCAT( 'R-000', recepcion.rece_id ) AS ticket,
	GROUP_CONCAT(CONCAT( '  ', recep_equipo.equipo, ' (', recep_equipo.falla, ') ')) AS equipos ,
	usuario.usu_nombre
FROM
	recepcion
	INNER JOIN cliente ON recepcion.cliente_id = cliente.cliente_id
	INNER JOIN recep_equipo ON recepcion.rece_id = recep_equipo.rece_id 
	INNER JOIN usuario on  recepcion.tecnico = usuario.usu_id
WHERE
	recepcion.rece_estado IN ( 'EN REPARACION' ) 
	AND recepcion.rece_estatus = 'ACTIVO' 
	

	GROUP BY recepcion.rece_id
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_LISTAR_NOTIFICACION_TECNICO
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_LISTAR_NOTIFICACION_TECNICO`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_LISTAR_NOTIFICACION_TECNICO`(IN IDTECNI INT)
SELECT
	MAX(cliente.cliente_nombres) as cliente_nombres,
	MAX(recepcion.rece_estado) as rece_estado,
	
	DATE_FORMAT(recepcion.rece_fregistro, '%d/%m/%Y') as rece_fregistro ,
	MAX(recepcion.rece_concepto) as rece_concepto,
	CONCAT( 'R-000', recepcion.rece_id ) as ticket,
GROUP_CONCAT(CONCAT( '  ', recep_equipo.equipo, ' (', recep_equipo.falla, ') ')) as equipos 
FROM
	recepcion
	INNER JOIN cliente ON recepcion.cliente_id = cliente.cliente_id
	INNER JOIN recep_equipo ON recepcion.rece_id = recep_equipo.rece_id 
WHERE
	recepcion.rece_estado IN ( 'EN REPARACION' ) 
	AND recepcion.rece_estatus = 'ACTIVO' 
	AND recepcion.tecnico = IDTECNI 

	GROUP BY recepcion.rece_id
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_LISTAR_NUM_COTIZACION
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_LISTAR_NUM_COTIZACION`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_LISTAR_NUM_COTIZACION`()
SELECT compro_numero FROM comprobante WHERE compro_tipo like '%coti%' and comprobante.compro_estado= 'ACTIVO'
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_LISTAR_PEDIDOS_FECHA
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_LISTAR_PEDIDOS_FECHA`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_LISTAR_PEDIDOS_FECHA`(IN p_fechaini DATE, IN p_fechafin DATE)
BEGIN

 SELECT
	pc.pedido_id, 
	pc.pedido_correlativo,
	c.cliente_nombres, 
	c.cliente_celular, 
	c.cliente_dni,  
	DATE_FORMAT(pc.pedido_fecha, '%d/%m/%Y %H:%i:%s') as pedidofecha,
	pc.pedido_total, 
	pc.pedido_estado, 
	pc.cliente_id
FROM
	pedido_n AS pc
	INNER JOIN
	cliente AS c
	ON 
		pc.cliente_id = c.cliente_id
		WHERE DATE(pc.pedido_fecha)  BETWEEN p_fechaini AND p_fechafin
		ORDER BY pc.pedido_fecha DESC;
		
		END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_LISTAR_PRODUCTO
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_LISTAR_PRODUCTO`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_LISTAR_PRODUCTO`(IN P_IDALMACEN INT, IN P_IDROL INT)
BEGIN
SELECT
	s.id_stock, 
	s.producto_id, 
	p.producto_codigo, 
	p.producto_nombre, 
	p.marca_id, 
	m.marca_descripcion, 
	p.categoria_id, 
	c.categoria_descripcion, 
	s.id_almacen, 
	a.descripcion_al,
	s.cantidad_s as producto_stock, 
	p.producto_pcompra, 
	p.producto_pventa as precioventaantiguo, 
	s.precio_venta_s as producto_pventa,
	p.producto_fregistro, 
	p.producto_estado, 
	p.producto_stock_inicial, 
	p.producto_aumento, 
	p.producto_codigo_general, 
	p.producto_foto, 
	p.unidad_id, 
	u.unidad_descripcion, 
		CONCAT_WS(' | ',u.unidad_descripcion, u.unidad_abrevia) as unidad_medida,
	p.pro_imei, 
	p.producto_tienda, 
	p.producto_descrip_l, 
	s.id_sucu, 
	p.producto_stock as stockantigu, 
	p.cliente_id,
	p.producto_pcomercial,
	p.producto_pmayorista
FROM
	stock AS s
	INNER JOIN producto AS p ON s.producto_id = p.producto_id
	INNER JOIN marca AS m ON p.marca_id = m.marca_id
	INNER JOIN categoria AS c ON p.categoria_id = c.categoria_id
	INNER JOIN unidadmedida AS u ON p.unidad_id = u.unidad_id
	INNER JOIN almacen as a ON s.id_almacen = a.id_almacen
	WHERE ( s.id_almacen = P_IDALMACEN);
	-- WHERE (P_IDROL = 1 OR s.id_almacen = P_IDALMACEN);
		
		
		END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_LISTAR_PRODUCTOS_MAS_VENDIDOS
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_LISTAR_PRODUCTOS_MAS_VENDIDOS`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_LISTAR_PRODUCTOS_MAS_VENDIDOS`(IN FINICIO DATE, IN FFIN DATE, IN p_idsucursal INT)
SELECT 
	detalle_venta.vdetalle_id, 
	detalle_venta.producto_id, 
	CONCAT_WS(' - ',producto.producto_codigo, producto.producto_nombre) as Producto, 
	sum(vdetalle_cantidad) as cantidad
FROM
	detalle_venta
	INNER JOIN
	producto
	ON 
		detalle_venta.producto_id = producto.producto_id
		where vdetalle_fecha BETWEEN FINICIO AND FFIN and detalle_venta.id_sucu = p_idsucursal and vdetalle_estado = 'VENDIDO'
		GROUP BY detalle_venta.vdetalle_id, 
	detalle_venta.producto_id, 
	CONCAT_WS(' - ',producto.producto_codigo, producto.producto_nombre) 
		ORDER BY sum(vdetalle_cantidad) DESC
		LIMIT 7
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_LISTAR_PRODUCTOS_SIN_STOCK
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_LISTAR_PRODUCTOS_SIN_STOCK`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_LISTAR_PRODUCTOS_SIN_STOCK`(IN p_idsucursal INT)
SELECT
p.producto_id,
	CONCAT_WS(' - ',p.producto_codigo, p.producto_nombre) as Producto,
	s.cantidad_s as stock
FROM
	stock s 
	JOIN producto p ON
	s.producto_id = p.producto_id
	where s.cantidad_s < 3 AND s.id_sucu = p_idsucursal
	LIMIT 8
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_LISTAR_PRODUCTO_VENTA
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_LISTAR_PRODUCTO_VENTA`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_LISTAR_PRODUCTO_VENTA`()
SELECT
	producto.producto_id, 
	producto.producto_nombre, 
	producto.marca_id, 
	marca.marca_descripcion, 
	producto.categoria_id, 
	categoria.categoria_descripcion, 
 
	producto.producto_stock, 
	producto.producto_pcompra, 
	producto.producto_pventa, 
	producto.producto_estado
FROM
	producto
	INNER JOIN
	categoria
	ON 
		producto.categoria_id = categoria.categoria_id
	INNER JOIN
	marca
	ON 
		producto.marca_id = marca.marca_id
		where producto.producto_estado = 'ACTIVO' 
		ORDER BY producto_id  DESC
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_LISTAR_PROVEEDOR
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_LISTAR_PROVEEDOR`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_LISTAR_PROVEEDOR`(IN p_idsucur INT, IN p_idrol INT)
BEGIN

SELECT
	c.cliente_id, 
	c.cliente_nombres, 
	c.cliente_celular, 
	c.cliente_dni, 
	c.cliente_estado,
	c.cliente_direccion,
	c.cliente_ape_p,
	c.cliente_ape_m,
	c.cliente_correo,
	c.cliente_tipo_doc,
	c.id_sucu,
	s.nombre_su,
   c.cliente_listanegra
FROM
	cliente c
	INNER JOIN sucursales s ON
	c.id_sucu = s.id_sucu
		 WHERE c.cliente_tipo_doc = 'R.U.C' AND (p_idrol = 1 OR c.id_sucu = p_idsucur)
		ORDER BY c.cliente_id DESC;
		
		END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_LISTAR_RECEPCION
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_LISTAR_RECEPCION`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_LISTAR_RECEPCION`(IN FEINI DATE , IN FEFIN DATE, IN USUID INT, IN p_idsucursal INT, IN p_rolid INT)
BEGIN
SELECT
	r.rece_id ,
	concat( ' R-000', r.rece_id ) as referencia, 
	r.cliente_id  ,
	c.cliente_nombres , 
	concat_ws( ' - ', r.rece_equipo, r.rece_concepto ) as motivo, 
	r.rece_caracteristicas , 
	r.motivo_id,  
	mo.motivo_descripcion, 
	r.rece_monto, 
	DATE_FORMAT(r.rece_fregistro, '%d/%m/%y') as rece_fregistro,
	r.rece_estado , 
	r.rece_estatus , 
	r.rece_equipo , 
	r.rece_concepto , 
	r.rece_adelanto , 
	r.rece_debe , 
	r.rece_accesorios , 
	r.rece_fentrega , 
	r.marca_id, 
	ma.marca_descripcion , 
	r.rece_serie , 
	r.enciende , 
	r.tactil , 
	r.imagen , 
	r.vibra , 
	r.cobertura , 
	r.sensor , 
	r.carga , 
	r.bluetoo, 
	r.wifi , 
	r.huella , 
	r.home , 
	r.lateral , 
	r.camara , 
	r.bateria , 
	r.auricular , 
	r.micro , 
	r.face , 
	r.tornillo , 
	r.rece_cod, 
	c.cliente_celular, 
	r.tecnico , 
	r.usuario_registrador ,
	u.usu_nombre ,
	r.rece_foto1,
	r.id_sucu,
	s.nombre_su
FROM
recepcion as r 
			JOIN cliente as c ON  r.cliente_id = c.cliente_id 
			JOIN motivo as mo ON r.motivo_id = mo.motivo_id
		  JOIN marca as ma ON 	r.marca_id = ma.marca_id
		  JOIN usuario u on r.tecnico = u.usu_id
			JOIN sucursales s ON r.id_sucu = s.id_sucu
		WHERE r.rece_fregistro BETWEEN FEINI and FEFIN and (p_rolid = 1 OR (r.usuario_registrador = USUID AND  r.id_sucu = p_idsucursal));
		
		END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_LISTAR_RECEPCION_ADMIN
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_LISTAR_RECEPCION_ADMIN`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_LISTAR_RECEPCION_ADMIN`(IN FEINI DATE , IN FEFIN DATE)
BEGIN
SELECT
	r.rece_id ,
	concat( ' R-000', r.rece_id ) as referencia, 
	r.cliente_id  ,
	c.cliente_nombres , 
	concat_ws( ' - ', r.rece_equipo, r.rece_concepto ) as motivo, 
	r.rece_caracteristicas , 
	r.motivo_id,  
	mo.motivo_descripcion, 
	r.rece_monto, 
	DATE_FORMAT(r.rece_fregistro, '%d/%m/%y') as rece_fregistro,
	r.rece_estado , 
	r.rece_estatus , 
	r.rece_equipo , 
	r.rece_concepto , 
	r.rece_adelanto , 
	r.rece_debe , 
	r.rece_accesorios , 
	r.rece_fentrega , 
	r.marca_id, 
	ma.marca_descripcion , 
	r.rece_serie , 
	r.enciende , 
	r.tactil , 
	r.imagen , 
	r.vibra , 
	r.cobertura , 
	r.sensor , 
	r.carga , 
	r.bluetoo, 
	r.wifi , 
	r.huella , 
	r.home , 
	r.lateral , 
	r.camara , 
	r.bateria , 
	r.auricular , 
	r.micro , 
	r.face , 
	r.tornillo , 
	r.rece_cod, 
	c.cliente_celular, 
	r.tecnico , 
	r.usuario_registrador ,
	u.usu_nombre ,
	r.rece_foto1
FROM
recepcion as r 
			JOIN cliente as c ON  r.cliente_id = c.cliente_id 
			JOIN motivo as mo ON r.motivo_id = mo.motivo_id
	  	JOIN marca as ma ON 	r.marca_id = ma.marca_id
      JOIN usuario u on r.tecnico = u.usu_id
		
		WHERE  r.rece_fregistro BETWEEN  FEINI and FEFIN;
		
		END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_LISTAR_REPARACION
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_LISTAR_REPARACION`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_LISTAR_REPARACION`(IN FEINI DATE , IN FEFIN DATE, IN USUID INT, IN p_idsucursal INT, IN p_rolid INT)
BEGIN
SELECT
	r.rece_id , 
	concat( ' R-000', r.rece_id ) as referencia, 
	r.cliente_id  , 
	c.cliente_nombres ,  
	concat_ws( ' - ', r.rece_equipo, r.rece_concepto ) as motivo,  
	r.rece_caracteristicas , 
	r.motivo_id,  
	mo.motivo_descripcion, 
	r.rece_monto,  
	DATE_FORMAT(r.rece_fregistro, '%d/%m/%y') as rece_fregistro,
	r.rece_estado , 
	r.rece_estatus , 
	r.rece_equipo , 
	r.rece_concepto , 
	r.rece_adelanto , 
	r.rece_debe , 
	r.rece_accesorios , 
	r.rece_fentrega , 
	r.marca_id, 
	ma.marca_descripcion , 
	r.rece_serie , 
	r.enciende , 
	r.tactil , 
	r.imagen , 
	r.vibra , 
	r.cobertura , 
	r.sensor , 
	r.carga , 
	r.bluetoo, 
	r.wifi , 
	r.huella , 
	r.home , 
	r.lateral ,
	r.camara , 
	r.bateria , 
	r.auricular , 
	r.micro , 
	r.face , 
	r.tornillo , 
	r.rece_cod, 
	c.cliente_celular, 
	r.tecnico , 
	r.usuario_registrador ,
	r.diagnostico_tecnico,
	r.id_sucu,
	s.nombre_su,
	t.usu_nombre as tecniconombre
FROM
recepcion as r 
			JOIN cliente as c ON  r.cliente_id = c.cliente_id 
			JOIN motivo as mo ON r.motivo_id = mo.motivo_id
		JOIN marca as ma ON 	r.marca_id = ma.marca_id
		JOIN sucursales s ON r.id_sucu = s.id_sucu
		JOIN usuario t ON r.tecnico = t.usu_id
		WHERE r.rece_fregistro BETWEEN FEINI AND FEFIN AND ( p_rolid = 1 OR (r.tecnico = USUID AND r.id_sucu = p_idsucursal));
		
		END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_LISTAR_ROL
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_LISTAR_ROL`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_LISTAR_ROL`()
SELECT
	rol.rol_id, 
	rol.rol_nombre, 
	rol.rol_fregistro, 
	rol.rol_estado
FROM
	rol
	WHERE rol.rol_estado ='ACTIVO' OR rol.rol_estado = 'INACTIVO'
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_LISTAR_SELECT_ALMACENES
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_LISTAR_SELECT_ALMACENES`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_LISTAR_SELECT_ALMACENES`()
BEGIN
SELECT
	a.id_almacen, 
	a.descripcion_al, 
	a.codigo_al
FROM
	almacen AS a
	WHERE a.estado_al = 'Activo';
		
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_LISTAR_SELECT_ANIO_VENTA
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_LISTAR_SELECT_ANIO_VENTA`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_LISTAR_SELECT_ANIO_VENTA`()
SELECT YEAR(venta_fregistro) as anio FROM venta
where venta_estado <> 'ANULADA' 
GROUP BY YEAR(venta_fregistro)
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_LISTAR_SELECT_CATEGORIA
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_LISTAR_SELECT_CATEGORIA`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_LISTAR_SELECT_CATEGORIA`()
SELECT * FROM categoria WHERE categoria.categoria_estado = 'ACTIVO'
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_LISTAR_SELECT_CLIENTE
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_LISTAR_SELECT_CLIENTE`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_LISTAR_SELECT_CLIENTE`(IN p_idsucursal INT)
SELECT cliente_id,
CONCAT_WS(' | ',cliente_nombres,cliente_dni) as cliente,
cliente_estado,
cliente_listanegra
 FROM cliente WHERE cliente_estado= 'ACTIVO'  AND id_sucu = p_idsucursal	ORDER BY cliente_id DESC
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_LISTAR_SELECT_COMPROBANTE
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_LISTAR_SELECT_COMPROBANTE`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_LISTAR_SELECT_COMPROBANTE`()
SELECT * FROM comprobante WHERE comprobante.compro_estado= 'ACTIVO' and compro_tipo not in ('COTIZACION')
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_LISTAR_SELECT_COMP_COTIZACION
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_LISTAR_SELECT_COMP_COTIZACION`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_LISTAR_SELECT_COMP_COTIZACION`()
SELECT * FROM comprobante WHERE compro_tipo like '%coti%' and comprobante.compro_estado= 'ACTIVO'
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_LISTAR_SELECT_FOR_PAGO
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_LISTAR_SELECT_FOR_PAGO`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_LISTAR_SELECT_FOR_PAGO`()
SELECT
	forma_pago.fpago_id, 
	forma_pago.fpago_descripcion
FROM
	forma_pago
	WHERE fpago_estado = 'ACTIVO'
	-- ORDER BY forma_pago.fpago_id DESC
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_LISTAR_SELECT_MARCA
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_LISTAR_SELECT_MARCA`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_LISTAR_SELECT_MARCA`()
SELECT * FROM marca WHERE marca.marca_estado= 'ACTIVO'
ORDER BY marca.marca_id DESC
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_LISTAR_SELECT_MOTIVO
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_LISTAR_SELECT_MOTIVO`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_LISTAR_SELECT_MOTIVO`()
SELECT * FROM motivo WHERE motivo_estado= 'ACTIVO'
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_LISTAR_SELECT_PRODUCTO
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_LISTAR_SELECT_PRODUCTO`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_LISTAR_SELECT_PRODUCTO`()
SELECT producto_id, CONCAT_WS(' - ',producto_codigo, producto_nombre) as nombre  FROM producto where producto_estado = 'ACTIVO'
ORDER BY producto_id desc
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_LISTAR_SELECT_PRODUCTO_REPARACION_INSUMO
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_LISTAR_SELECT_PRODUCTO_REPARACION_INSUMO`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_LISTAR_SELECT_PRODUCTO_REPARACION_INSUMO`(IN p_idalmacen INT, IN p_rolid INT)
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
	-- AND ( p_rolid = 1 OR s.id_almacen = p_idalmacen )
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_LISTAR_SELECT_PRODUCTO_VENTA
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_LISTAR_SELECT_PRODUCTO_VENTA`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_LISTAR_SELECT_PRODUCTO_VENTA`(IN p_descrip VARCHAR(100))
SELECT   producto_id, 
CONCAT(producto_codigo_general,' | ' ,producto_nombre, '  | Stock: ', producto_stock) as nombre,
producto_stock as stock, 
producto_pventa as precio_venta,
pro_imei
FROM producto 
where producto_estado = 'ACTIVO'
AND (producto_nombre LIKE CONCAT('%', p_descrip, '%') OR producto_id LIKE CONCAT('%', p_descrip, '%') OR producto_codigo_general LIKE CONCAT('%', p_descrip, '%'))
ORDER BY producto_id desc
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_LISTAR_SELECT_PRODUCTO_VENTA_NEW
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_LISTAR_SELECT_PRODUCTO_VENTA_NEW`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_LISTAR_SELECT_PRODUCTO_VENTA_NEW`(IN p_descrip VARCHAR(100), IN p_idalmacen INT)
BEGIN
SELECT
	s.producto_id, 
	CONCAT(p.producto_codigo_general,' | ' ,p.producto_nombre, '  | Stock: ', s.cantidad_s) as nombre,
	s.cantidad_s as stock, 
	p.producto_pcompra, 
	p.producto_pventa, 
	s.precio_venta_s as precio_venta, 
	s.id_almacen, 
	s.id_stock,  
	p.producto_pcomercial as preciocomercial,
	p.producto_pmayorista as preciomayorista,
	p.producto_stock,
	p.pro_imei
FROM
	stock AS s
	INNER JOIN
	producto AS p
	ON 
		s.producto_id = p.producto_id
		WHERE s.id_almacen = p_idalmacen and p.producto_estado = 'ACTIVO' 
AND (p.producto_nombre LIKE CONCAT('%', p_descrip, '%') OR p.producto_id LIKE CONCAT('%', p_descrip, '%') OR p.producto_codigo_general LIKE CONCAT('%', p_descrip, '%'))
		GROUP BY s.id_stock;
		-- and p.pro_imei = 'No'
		
		END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_LISTAR_SELECT_PROVEEDOR
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_LISTAR_SELECT_PROVEEDOR`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_LISTAR_SELECT_PROVEEDOR`()
SELECT * FROM cliente WHERE cliente.cliente_estado= 'ACTIVO' and cliente_tipo_doc = 'R.U.C'
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_LISTAR_SELECT_ROL
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_LISTAR_SELECT_ROL`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_LISTAR_SELECT_ROL`()
SELECT * FROM rol WHERE rol_estado = 'ACTIVO'
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_LISTAR_SELECT_SUCURSAL
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_LISTAR_SELECT_SUCURSAL`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_LISTAR_SELECT_SUCURSAL`()
BEGIN
SELECT id_sucu, nombre_su FROM sucursales WHERE estado_su = 'Activo';


END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_LISTAR_SELECT_TECNICOS
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_LISTAR_SELECT_TECNICOS`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_LISTAR_SELECT_TECNICOS`()
BEGIN
	SELECT
		usu_id,
		usu_nombre 
	FROM
		usuario 
	WHERE
		rol_id IN ( '4', '1') 
		AND usu_estado = 'ACTIVO';

END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_LISTAR_SELECT_UNIDAD
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_LISTAR_SELECT_UNIDAD`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_LISTAR_SELECT_UNIDAD`()
SELECT
	unidadmedida.unidad_id, 
  CONCAT_WS(' | ',unidadmedida.unidad_descripcion, unidadmedida.unidad_abrevia) as descripcion, 
	unidadmedida.unidad_estado
FROM
	unidadmedida
	
	where unidad_estado = 'ACTIVO'
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_LISTAR_SELECT_USUARIO_RECORD
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_LISTAR_SELECT_USUARIO_RECORD`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_LISTAR_SELECT_USUARIO_RECORD`()
Select usu_id,usu_nombre from usuario where usu_estado ='ACTIVO'
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_LISTAR_SERVICIO
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_LISTAR_SERVICIO`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_LISTAR_SERVICIO`(IN FINICIO DATE, IN FFIN DATE, IN TECNIUSU INT, IN p_idsucursal INT, IN p_rolid INT)
SELECT
	servicio.servicio_id, 
	servicio.rece_id, 
	CONCAT( ' R-000',servicio.rece_id ) as referencia,
	recepcion.cliente_id, 
	CONCAT_WS(' - ',cliente.cliente_nombres,	cliente.cliente_dni) as cliente_nombres,
	CONCAT_WS(' - ',recepcion.rece_equipo,recepcion.rece_concepto) as concepto, 
	recepcion.rece_monto, 
	recepcion.rece_estado, 
	servicio.servicio_monto, 
	servicio.servicio_concepto, 
	servicio.servicio_responsable, 
	servicio.servicio_comentario, 
	servicio.servicio_entrega,
	 DATE_FORMAT(servicio.servicio_fregistro, '%d/%m/%Y') as servicio_fregistro,
	
	
	servicio.servicio_estado,
	cliente.cliente_dni,
	cliente.cliente_celular,
	cliente.cliente_nombres as nombre_cli,
	servicio.estado_caja,
	servicio.fpago_id,
	forma_pago.fpago_descripcion,
	recepcion.rece_cod,
	servicio.id_sucu,
	sucursales.nombre_su
FROM
	servicio
	INNER JOIN
	recepcion
	ON 
		servicio.rece_id = recepcion.rece_id
	INNER JOIN
	cliente
	ON 
		recepcion.cliente_id = cliente.cliente_id 
		INNER JOIN forma_pago 
	ON
	servicio.fpago_id = forma_pago.fpago_id
	JOIN sucursales  ON servicio.id_sucu = sucursales.id_sucu
		-- WHERE servicio.servicio_fregistro BETWEEN FINICIO AND FFIN 
		WHERE servicio.servicio_fregistro BETWEEN FINICIO and FFIN and (p_rolid = 1 OR (servicio.tecnico_servi = TECNIUSU AND servicio.id_sucu = p_idsucursal))
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_LISTAR_SUCURSALES
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_LISTAR_SUCURSALES`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_LISTAR_SUCURSALES`()
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
	INNER JOIN
	configuracion AS c
	ON 
		s.confi_id = c.confi_id
	INNER JOIN
	almacen AS a
	ON 
		s.id_almacen = a.id_almacen;
		
		END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_LISTAR_TRASLADOS
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_LISTAR_TRASLADOS`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_LISTAR_TRASLADOS`()
BEGIN

SELECT
	t.id_traslado, 
	t.fecha_r,
	DATE_FORMAT(t.fecha_r, '%d/%m/%Y %H:%i:%s') AS fecha_formateada, 
	t.almacen_origen_id, 
	ao.descripcion_al as almacenorigen, 
	t.almacen_destino_id, 
	ad.descripcion_al as almacendestino, 
	t.usu_id, 
	u.usu_nombre,
	t.estado, 
	t.glosa_t
FROM
	traslados AS t
	JOIN usuario u ON t.usu_id = u.usu_id
	JOIN almacen AS ao ON t.almacen_origen_id = ao.id_almacen 
	JOIN almacen AS ad ON t.almacen_destino_id = ad.id_almacen 
	ORDER BY t.fecha_r DESC;



END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_LISTAR_UNIDAD_MEDIDA
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_LISTAR_UNIDAD_MEDIDA`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_LISTAR_UNIDAD_MEDIDA`()
SELECT
	unidadmedida.unidad_id,
	unidadmedida.unidad_descripcion, 
	unidadmedida.unidad_abrevia, 
	unidadmedida.unidad_estado
FROM
	unidadmedida
WHERE
	unidadmedida.unidad_estado = 'ACTIVO' OR
	unidadmedida.unidad_estado = 'INACTIVO'
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_LISTAR_USUARIO
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_LISTAR_USUARIO`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_LISTAR_USUARIO`()
SELECT
	usuario.usu_id, 
	usuario.usu_nombre, 
	usuario.usu_contrasena, 
	usuario.rol_id, 
	usuario.usu_estado, 
	usuario.usu_email, 
	usuario.usu_foto, 
	rol.rol_nombre,
	usuario.cliente_id
FROM
	usuario
	INNER JOIN
	rol
	ON 
		usuario.rol_id = rol.rol_id
	WHERE  usuario.usu_id
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_LISTAR_VENTAS_CAJA_ID
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_LISTAR_VENTAS_CAJA_ID`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_LISTAR_VENTAS_CAJA_ID`(IN p_cajaid INT)
BEGIN

SELECT
c.cliente_nombres,
CONCAT(	v.venta_comprobante ,' ', v.venta_serie, ' - ', v.venta_num_comprobante) as comprobante,
v.venta_total,
fp.fpago_descripcion,
v.venta_fregistro,
v.venta_estado,
v.caja_id,
v.estado_caja

FROM 
	venta v
	INNER JOIN cliente c ON
	v.cliente_id = c.cliente_id
	INNER JOIN forma_pago fp ON
	v.fpago_id = fp.fpago_id
	WHERE v.caja_id = p_cajaid AND v.estado_caja = 'ABIERTO' AND v.venta_estado = 'PAGADA';
	
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_LISTAR_VENTA_ADMIN
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_LISTAR_VENTA_ADMIN`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_LISTAR_VENTA_ADMIN`(IN FINICIO DATE, IN FFIN DATE, IN p_sucuid INT, IN p_almaid INT, IN p_rolid INT)
BEGIN
SELECT
	venta.venta_id, 
	cliente.cliente_nombres, 
	venta.venta_comprobante, 
	CONCAT (venta.venta_comprobante,' ',venta.venta_serie,' - ',venta.venta_num_comprobante) AS comprobante, 
	venta.venta_total, 
	 
	DATE_FORMAT(venta.venta_fregistro, '%d/%m/%Y') as venta_fregistro, 
	venta.venta_estado, 
	venta.compro_id, 
	venta.usu_id, 
	usuario.usu_nombre, 
	venta.venta_serie, 
	venta.venta_num_comprobante, 
	venta.cliente_id, 
	venta.fpago_id, 
	forma_pago.fpago_descripcion,
	venta.venta_impuesto,
	venta.venta_porcentaje,
	venta.observacion,
	(venta.venta_total - venta.venta_impuesto + venta.venta_descuento ) as subtotal2,
	venta.monto_efectivo, 
	venta.cod_operacion , 
	venta.monto_tarjeta ,
	(venta.venta_total + venta.venta_impuesto + venta.venta_descuento) as subtotal3,
	venta.venta_descuento,
	cliente.cliente_celular,
	venta.caja_id,
	s.nombre_su
	
FROM
	venta
	INNER JOIN
	cliente
	ON 
		venta.cliente_id = cliente.cliente_id
	INNER JOIN
	comprobante
	ON 
		venta.compro_id = comprobante.compro_id
	INNER JOIN
	usuario
	ON 
		venta.usu_id = usuario.usu_id
	INNER JOIN
	forma_pago
	ON 
		venta.fpago_id = forma_pago.fpago_id
	INNER JOIN sucursales s ON venta.id_sucu = s.id_sucu
		WHERE venta.venta_fregistro BETWEEN FINICIO AND FFIN AND  (p_rolid = 1 OR venta.id_sucu = p_sucuid)
		ORDER BY venta_id DESC;
		
	END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_LISTAR_VENTA_FILTRO
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_LISTAR_VENTA_FILTRO`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_LISTAR_VENTA_FILTRO`(IN FINICIO DATE, IN FFIN DATE, IN IDUSUAR INT)
SELECT
	venta.venta_id, 
	cliente.cliente_nombres, 
	venta.venta_comprobante, 
	CONCAT_WS(' - ',venta.venta_serie,venta.venta_num_comprobante) AS comprobante, 
	venta.venta_total, 
	venta.venta_fregistro, 
	venta.venta_estado, 
	venta.compro_id, 
	venta.usu_id, 
	usuario.usu_nombre, 
	venta.venta_serie, 
	venta.venta_num_comprobante, 
	venta.cliente_id, 
	venta.fpago_id, 
	forma_pago.fpago_descripcion,
	venta.venta_impuesto,
	venta.venta_porcentaje,
	venta.observacion,
	(venta.venta_total - venta.venta_impuesto + venta.venta_descuento ) as subtotal2,
	venta.monto_efectivo, 
	venta.cod_operacion , 
	venta.monto_tarjeta ,
	(venta.venta_total + venta.venta_impuesto + venta.venta_descuento) as subtotal3,
	venta.venta_descuento,
	cliente.cliente_celular,
	venta.caja_id
	
FROM
	venta
	INNER JOIN
	cliente
	ON 
		venta.cliente_id = cliente.cliente_id
	INNER JOIN
	comprobante
	ON 
		venta.compro_id = comprobante.compro_id
	INNER JOIN
	usuario
	ON 
		venta.usu_id = usuario.usu_id
	INNER JOIN
	forma_pago
	ON 
		venta.fpago_id = forma_pago.fpago_id
		WHERE venta.venta_fregistro BETWEEN FINICIO AND FFIN AND venta.usu_id = IDUSUAR
		ORDER BY venta_id DESC
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_LISTAR_VISTA_INICIO
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_LISTAR_VISTA_INICIO`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_LISTAR_VISTA_INICIO`()
BEGIN
SELECT 
		md.mend_id,
		m.men_vista,
		md.vista_inicio
	FROM td_menu_detalle md
	INNER JOIN menu m ON m.men_id = md.men_id
	WHERE 
	-- md.rol_id = p_rol_id 
	-- and md.mend_permi = 'Si'
	m.estado=1;
	
	END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_LISTAR_VISTA_INICIO_ACTIVA
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_LISTAR_VISTA_INICIO_ACTIVA`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_LISTAR_VISTA_INICIO_ACTIVA`(IN p_rol_id INT)
BEGIN
SELECT 
		md.mend_id,
		m.men_vista,
		md.vista_inicio
	FROM td_menu_detalle md
	INNER JOIN menu m ON m.men_id = md.men_id
	WHERE md.rol_id = p_rol_id 
	AND m.estado=1 
	ORDER BY  md.vista_inicio desc;
	
	END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_LISTA_DETALLE_PEDIDO
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_LISTA_DETALLE_PEDIDO`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_LISTA_DETALLE_PEDIDO`(IN p_idpedido INT)
BEGIN
SELECT
  pd.pedido_id,
  pd.producto_id,
  p.producto_nombre,
  SUM(pd.cantidad) AS total_cantidad,
  pd.precio,
  SUM(pd.cantidad * pd.precio) AS subtotal
FROM
  pedido_detalle_n AS pd
INNER JOIN producto AS p ON pd.producto_id = p.producto_id
WHERE
  pd.pedido_id = p_idpedido
GROUP BY
  pd.pedido_id, pd.producto_id, p.producto_nombre, pd.precio;
	
	END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_LSTAR_PLAN
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_LSTAR_PLAN`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_LSTAR_PLAN`()
BEGIN

SELECT
	p.plan_id, 
	p.plan_nombre_cli, 
	p.descripcion, 

	DATE_FORMAT(p.plan_ini, '%d/%m/%Y') as plan_ini, 
	DATE_FORMAT(p.plan_fin, '%d/%m/%Y') as plan_fin, 
	
	p.plan_monto, 
	p.plan_estado
FROM
	plan p ;


END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_MENU_X_ROL_PARAMENU
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_MENU_X_ROL_PARAMENU`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_MENU_X_ROL_PARAMENU`(IN p_rol_id INT)
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
		-- ORDER BY menu.men_id ASC;
	
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_MODIFICAR_ALMACENES
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_MODIFICAR_ALMACENES`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_MODIFICAR_ALMACENES`(IN p_idalmacen INT,
    IN p_descripcion VARCHAR(255),
    IN p_abrevia VARCHAR(10),
    IN p_estado VARCHAR(20))
BEGIN
    UPDATE almacen
    SET
        descripcion_al = p_descripcion,
        codigo_al = p_abrevia,
        estado_al = p_estado
    WHERE id_almacen = p_idalmacen;

END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_MODIFICAR_CATEGORIA
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_MODIFICAR_CATEGORIA`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_MODIFICAR_CATEGORIA`(IN ID INT,IN CATEGORIA VARCHAR(255),IN ESTADO VARCHAR(10))
BEGIN
DECLARE CANTIDAD INT;
DECLARE CATEGORIAACTUAL VARCHAR(25);
SET @CATEGORIAACTUAL:=(SELECT categoria_descripcion from categoria where categoria_id=ID);
IF @CATEGORIAACTUAL = CATEGORIA THEN
	UPDATE categoria set
	categoria_descripcion=CATEGORIA,
	categoria_estado=ESTADO
	where categoria_id=ID;
	SELECT 1;
ELSE
	SET @CANTIDAD:=(SELECT COUNT(*) FROM  categoria where categoria_descripcion=CATEGORIA);
	if @CANTIDAD = 0 THEN
		UPDATE categoria set
		categoria_descripcion=CATEGORIA,
		categoria_estado=ESTADO
		where categoria_id=ID;
		SELECT 1;
	ELSE
		SELECT 2;
	END IF;
END IF;

END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_MODIFICAR_CLAVE_USUARIO
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_MODIFICAR_CLAVE_USUARIO`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_MODIFICAR_CLAVE_USUARIO`(IN ID INT,IN CONTRA VARCHAR(255))
UPDATE usuario set
usu_contrasena=CONTRA
where usu_id=ID
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_MODIFICAR_CLIENTE
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_MODIFICAR_CLIENTE`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_MODIFICAR_CLIENTE`(IN `ID` INT, IN `NOMBRE` VARCHAR(100), IN `DNI` VARCHAR(20), IN `CELULAR` VARCHAR(20), IN `ESTADO` VARCHAR(100), IN `DIRECCION` VARCHAR(255), IN `APE_P` VARCHAR(255), IN `APE_M` VARCHAR(255), IN `CORREO` VARCHAR(255), IN `TIPODOC` VARCHAR(50), IN `p_listanegra` VARCHAR(2))
BEGIN
DECLARE CANTIDAD INT;
DECLARE CLIENTEACTUAL VARCHAR(25);
SET @CLIENTEACTUAL:=(SELECT cliente_dni from cliente where cliente_id=ID);
IF @CLIENTEACTUAL = DNI THEN
	UPDATE cliente set
	cliente_nombres=NOMBRE,
	cliente_celular=CELULAR,
	cliente_dni=DNI,
	cliente_estado=ESTADO,
	cliente_direccion=DIRECCION,
	cliente_ape_p = APE_P,
	cliente_ape_m = APE_M,
	cliente_correo = CORREO,
	cliente_tipo_doc = TIPODOC,
  cliente_listanegra = p_listanegra
	where cliente_id=ID;
	SELECT 1;
ELSE
	SET @CANTIDAD:=(SELECT COUNT(*) FROM cliente where cliente_dni=DNI);
	if @CANTIDAD = 0 THEN
		UPDATE cliente set
		cliente_nombres=NOMBRE,
		cliente_celular=CELULAR,
		cliente_dni=DNI,
		cliente_estado=ESTADO,
		cliente_direccion=DIRECCION,
	  cliente_ape_p = APE_P,
	  cliente_ape_m = APE_M,
		cliente_correo = CORREO,
		cliente_tipo_doc = TIPODOC,
     cliente_listanegra = p_listanegra
		where cliente_id=ID;
		SELECT 1;
	ELSE
		SELECT 2;
	END IF;
END IF;

END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_MODIFICAR_COMPROBANTE
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_MODIFICAR_COMPROBANTE`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_MODIFICAR_COMPROBANTE`(IN ID INT,IN TIPO VARCHAR(100),IN SERIE VARCHAR(100),IN NUMERO VARCHAR(100), IN ESTADO VARCHAR(100))
UPDATE comprobante SET
compro_tipo = TIPO,
compro_serie = SERIE,
compro_numero = NUMERO,
compro_estado = ESTADO
WHERE compro_id = ID
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_MODIFICAR_EMPRESA
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_MODIFICAR_EMPRESA`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_MODIFICAR_EMPRESA`(IN ID INT, IN RAZON VARCHAR(255), IN RUC VARCHAR(255), IN REPRE VARCHAR(255), IN DIRECCION VARCHAR(255), IN CELULAR VARCHAR(255), IN TELEFONO VARCHAR(255), IN CORREO VARCHAR(255), IN ESTADO VARCHAR(255), IN URL VARCHAR(255), IN CUENTA01 VARCHAR(100),IN NRO_CUENTA01 VARCHAR(100),IN CUENTA02 VARCHAR(100),IN NRO_CUENTA02 VARCHAR(100), IN MONED VARCHAR(10), IN CODE_POST VARCHAR(20), IN TIPOIG VARCHAR(50), IN IMPUESTOIGV DECIMAL(10,2), IN MONE1 VARCHAR(50), IN MONED2 VARCHAR(50), IN NOMBRESIST VARCHAR(200), IN p_linksistema VARCHAR(200), IN p_codigopais VARCHAR(50), IN p_clavecorreo VARCHAR(50))
UPDATE configuracion SET
confi_razon_social = RAZON,
confi_ruc = RUC,
confi_nombre_representante = REPRE,
confi_direccion = DIRECCION,
confi_celular = CELULAR,
confi_telefono = TELEFONO,
confi_correo = CORREO,
confi_estado = ESTADO,
confi_url = URL,
confi_cnta01 = CUENTA01,
confi_nro_cuenta01 = NRO_CUENTA01,
confi_cnta02 =  CUENTA02,
confi_nro_cuenta02 = NRO_CUENTA02,
confi_moneda =   MONED,
confi_codigo_pos = CODE_POST,
confi_tipo_igv = TIPOIG,
confi_igv = IMPUESTOIGV,
confi_moneda1 = MONE1,
confi_moneda2 = MONED2,
confi_nombre_sistema = NOMBRESIST,
url_sistema = p_linksistema,
cod_pais = p_codigopais,
confi_clave_correo = p_clavecorreo
WHERE confi_id = ID
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_MODIFICAR_ESTADO_VENTA
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_MODIFICAR_ESTADO_VENTA`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_MODIFICAR_ESTADO_VENTA`(IN p_idventa INT, IN p_estado VARCHAR(100), IN p_cajaid INT)
BEGIN
    DECLARE V_ESTADOCAJA VARCHAR(50);
    DECLARE V_CAJAVIGENTE INT DEFAULT NULL;

    -- Buscar el estado de la caja recibida
    SELECT caja_estado INTO V_ESTADOCAJA
    FROM caja
    WHERE caja_id = p_cajaid
    LIMIT 1;

    IF V_ESTADOCAJA = 'VIGENTE' THEN
        -- Si la caja está vigente, solo actualiza el estado de la venta
        UPDATE venta 
        SET venta_estado = p_estado
        WHERE venta_id = p_idventa;
    ELSE
        -- Si la caja NO está vigente, busca la caja vigente
        SELECT caja_id INTO V_CAJAVIGENTE
        FROM caja
        WHERE caja_estado = 'VIGENTE'
        ORDER BY caja_id DESC
        LIMIT 1;

        -- Actualiza el estado y el id de la caja en la venta
        UPDATE venta 
        SET venta_estado = p_estado,
            caja_id = V_CAJAVIGENTE
        WHERE venta_id = p_idventa;
    END IF;
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_MODIFICAR_FORMA_PAGO
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_MODIFICAR_FORMA_PAGO`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_MODIFICAR_FORMA_PAGO`(IN ID INT,IN FORMAPAGO VARCHAR(25),IN ESTADO VARCHAR(10))
BEGIN
DECLARE CANTIDAD INT;
DECLARE FORMAPACTUAL VARCHAR(25);
SET @FORMAPACTUAL:=(SELECT fpago_descripcion from forma_pago where fpago_id=ID);
IF @FORMAPACTUAL = FORMAPAGO THEN
	UPDATE forma_pago set
	fpago_descripcion=FORMAPAGO,
	fpago_estado=ESTADO
	where fpago_id=ID;
	SELECT 1;
ELSE
	SET @CANTIDAD:=(SELECT COUNT(*) FROM forma_pago where fpago_descripcion=FORMAPAGO);
	if @CANTIDAD = 0 THEN
			UPDATE forma_pago set
			fpago_descripcion=FORMAPAGO,
			fpago_estado=ESTADO
			where fpago_id=ID;
		SELECT 1;
	ELSE
		SELECT 2;
	END IF;
END IF;

END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_MODIFICAR_FOTO_EMPRESA
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_MODIFICAR_FOTO_EMPRESA`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_MODIFICAR_FOTO_EMPRESA`(IN ID INT,IN RUTA VARCHAR(255))
UPDATE configuracion SET
config_foto = RUTA
WHERE confi_id = ID
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_MODIFICAR_FOTO_PRODUCTO
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_MODIFICAR_FOTO_PRODUCTO`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_MODIFICAR_FOTO_PRODUCTO`(IN ID INT,IN RUTA VARCHAR(255))
UPDATE producto SET
producto_foto = RUTA
WHERE producto_id = ID
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_MODIFICAR_FOTO_USUARIO
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_MODIFICAR_FOTO_USUARIO`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_MODIFICAR_FOTO_USUARIO`(IN ID INT,IN RUTA VARCHAR(255))
UPDATE usuario set
usu_foto=RUTA
where usu_id=ID
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_MODIFICAR_GASTOS
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_MODIFICAR_GASTOS`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_MODIFICAR_GASTOS`(IN ID INT,IN GASTO VARCHAR(255),IN NOMTO DECIMAL(10,2),IN RESPONSABLE VARCHAR(255), IN ESTADO VARCHAR(100), IN TIPO_M VARCHAR(50))
BEGIN

	UPDATE gastos set
	gastos_descripcion=GASTO,
	gastos_monto=NOMTO,
	gastos_responsable=RESPONSABLE,
	gastos_estado=ESTADO,
	tipo_mov = TIPO_M
	where gastos_id=ID;



END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_MODIFICAR_MARCA
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_MODIFICAR_MARCA`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_MODIFICAR_MARCA`(IN ID INT,IN MARCA VARCHAR(25),IN ESTADO VARCHAR(10))
BEGIN
DECLARE CANTIDAD INT;
DECLARE MARCAACTUAL VARCHAR(25);
SET @MARCAACTUAL:=(SELECT marca_descripcion from marca where marca_id=ID);
IF @MARCAACTUAL = MARCA THEN
	UPDATE marca set
	marca_descripcion=MARCA,
	marca_estado=ESTADO
	where marca_id=ID;
	SELECT 1;
ELSE
	SET @CANTIDAD:=(SELECT COUNT(*) FROM marca where marca_descripcion=MARCA);
	if @CANTIDAD = 0 THEN
		UPDATE marca set
		marca_descripcion=MARCA,
		marca_estado=ESTADO
		where marca_id=ID;
		SELECT 1;
	ELSE
		SELECT 2;
	END IF;
END IF;

END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_MODIFICAR_MOTIVO
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_MODIFICAR_MOTIVO`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_MODIFICAR_MOTIVO`(IN ID INT,IN MOTIVO VARCHAR(25),IN ESTADO VARCHAR(10))
BEGIN
DECLARE CANTIDAD INT;
DECLARE MOTIVOACTUAL VARCHAR(25);
SET @MOTIVOACTUAL:=(SELECT motivo_descripcion from motivo where motivo_id=ID);
IF @MOTIVOACTUAL = MOTIVO THEN
	UPDATE motivo set
	motivo_descripcion=MOTIVO,
	motivo_estado=ESTADO
	where motivo_id=ID;
	SELECT 1;
ELSE
	SET @CANTIDAD:=(SELECT COUNT(*) FROM motivo where motivo_descripcion=MOTIVO);
	if @CANTIDAD = 0 THEN
		UPDATE motivo set
	motivo_descripcion=MOTIVO,
	motivo_estado=ESTADO
	where motivo_id=ID;
		SELECT 1;
	ELSE
		SELECT 2;
	END IF;
END IF;

END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_MODIFICAR_NOTAS
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_MODIFICAR_NOTAS`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_MODIFICAR_NOTAS`(IN p_idnotas INT, IN p_descrip VARCHAR(250))
BEGIN

UPDATE notas SET 
descripcion = p_descrip
WHERE nota_id = p_idnotas;

END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_MODIFICAR_PRODUCTO
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_MODIFICAR_PRODUCTO`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_MODIFICAR_PRODUCTO`(IN ID INT ,IN PRODUCTO VARCHAR(100),IN IDMARCA INT, IN IDCATEGORIA INT, IN PCOMPRA DECIMAL (10,2), IN PVENTA DECIMAL (10,2), IN ESTADO VARCHAR(100),IN COD_GENERAL VARCHAR(255),  IN PROVE INT, IN IDUNIDAD INT, IN p_veren_tienda VARCHAR(4), IN p_descripcionpro VARCHAR(220), IN PCOMERCIAL DECIMAL (10,2), IN PMAYORISTA DECIMAL (10,2), IN p_almace INT)
BEGIN
DECLARE PRODUCTOACTUAL VARCHAR(100);
DECLARE CANTIDAD INT;
SET @PRODUCTOACTUAL:=(SELECT producto_nombre from producto where producto_id=ID and producto_nombre= PRODUCTO);
if @PRODUCTOACTUAL = PRODUCTO THEN
	UPDATE producto set
	producto_nombre=PRODUCTO,
	marca_id=IDMARCA,
	categoria_id=IDCATEGORIA,
	producto_pcompra=PCOMPRA,
	producto_pventa=PVENTA,
	producto_estado=ESTADO,
	producto_codigo_general= COD_GENERAL,
	cliente_id = PROVE,
	unidad_id = IDUNIDAD,
	producto_tienda = p_veren_tienda,
	producto_descrip_l = p_descripcionpro,
	producto_pcomercial = PCOMERCIAL,
	producto_pmayorista = PMAYORISTA
	WHERE producto_id=ID;
	
	UPDATE kardex SET
	producto_nombre = PRODUCTO,
	kardex_p_ingreso = PCOMPRA,
	kardex_p_salida = PVENTA
	WHERE producto_id = ID and producto_codigo = 	producto_codigo;
  
  UPDATE stock SET
  precio_venta_s = PVENTA,
  precio_uni = PCOMPRA
  WHERE producto_id = ID and id_almacen = p_almace;
	
	SELECT 1;
ELSE
	SET @CANTIDAD:=(SELECT COUNT(*) from producto where producto_nombre COLLATE utf8mb4_general_ci= PRODUCTO  and producto_codigo_general COLLATE utf8mb4_general_ci= COD_GENERAL);
	IF @CANTIDAD = 0 THEN
		UPDATE producto set
	producto_nombre=PRODUCTO,
	marca_id=IDMARCA,
	categoria_id=IDCATEGORIA,
	producto_pcompra=PCOMPRA,
	producto_pventa=PVENTA,
	producto_estado=ESTADO,
  producto_codigo_general= COD_GENERAL,
	cliente_id = PROVE,
	unidad_id = IDUNIDAD,
	producto_tienda = p_veren_tienda,
	producto_descrip_l = p_descripcionpro,
	producto_pcomercial = PCOMERCIAL,
	producto_pmayorista = PMAYORISTA
	WHERE producto_id=ID;
	
	UPDATE kardex SET
	producto_nombre = PRODUCTO,
	kardex_p_ingreso = PCOMPRA,
	kardex_p_salida = PVENTA
	WHERE producto_id = ID and producto_codigo = 	producto_codigo;
  
  UPDATE stock SET
  precio_venta_s = PVENTA,
  precio_uni = PCOMPRA
  WHERE producto_id = ID and id_almacen = p_almace;
	
			SELECT 1;
	ELSE
			SELECT 2;
	END IF;
END IF;

END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_MODIFICAR_PROVEEDOR
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_MODIFICAR_PROVEEDOR`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_MODIFICAR_PROVEEDOR`(IN ID INT,IN RUC VARCHAR(30),IN RAZON VARCHAR(255),IN DIRECCION VARCHAR(255),IN CELULAR VARCHAR(20), IN ESTADO VARCHAR(100))
BEGIN
DECLARE CANTIDAD INT;
DECLARE PROVEACTUAL VARCHAR(25);
SET @PROVEACTUAL:=(SELECT prove_ruc from proveedor where prove_id=ID);
IF @PROVEACTUAL = RUC THEN
	UPDATE proveedor set
	prove_ruc=RUC,
	prove_razon=RAZON,
	prove_direccion=DIRECCION,
	prove_celular=CELULAR,
	prove_estado=ESTADO
	where prove_id=ID;
	SELECT 1;
ELSE
	SET @CANTIDAD:=(SELECT COUNT(*) FROM proveedor where prove_ruc=RUC);
	if @CANTIDAD = 0 THEN
		UPDATE proveedor set
		prove_ruc=RUC,
		prove_razon=RAZON,
		prove_direccion=DIRECCION,
		prove_celular=CELULAR,
		prove_estado=ESTADO
		where prove_id=ID;
		SELECT 1;
	ELSE
		SELECT 2;
	END IF;
END IF;

END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_MODIFICAR_RECEPCION
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_MODIFICAR_RECEPCION`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_MODIFICAR_RECEPCION`(IN IDRECE INT ,IN IDCLIENTE INT, IN CARACTERISTICAS VARCHAR(255), IN IDMOTIVO INT,IN CONCEPTO VARCHAR(255),IN MONTO DECIMAL(10,2),IN ESTADO VARCHAR(100),IN ADELANTO DECIMAL (10,2) ,IN DEBE DECIMAL (10,2),IN ACCESORIOS VARCHAR(255), IN FENTREGA DATE, IN RECOGER VARCHAR(50),  IN TECNICOID INT)
UPDATE recepcion set
	cliente_id=IDCLIENTE,
	rece_caracteristicas=CARACTERISTICAS,
	motivo_id=IDMOTIVO,
	rece_concepto=CONCEPTO,
	rece_monto=MONTO,
	rece_estatus=ESTADO,
	rece_adelanto= ADELANTO,
	rece_debe= DEBE,
	rece_accesorios = ACCESORIOS,
	rece_fentrega = FENTREGA,
	rece_estado = RECOGER,
	tecnico = TECNICOID
	WHERE rece_id=IDRECE
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_MODIFICAR_ROL
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_MODIFICAR_ROL`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_MODIFICAR_ROL`(IN ID INT,IN ROL VARCHAR(25),IN ESTADO VARCHAR(10))
BEGIN
DECLARE CANTIDAD INT;
DECLARE ROLACTUAL VARCHAR(25);
SET @ROLACTUAL:=(SELECT rol_nombre from rol where rol_id=ID);
IF @ROLACTUAL = ROL THEN
	UPDATE rol set
	rol_nombre=ROL,
	rol_estado=ESTADO
	where rol_id=ID;
	SELECT 1;
ELSE
	SET @CANTIDAD:=(SELECT COUNT(*) FROM rol where rol_nombre=ROL);
	if @CANTIDAD = 0 THEN
		UPDATE rol set
		rol_nombre=ROL,
		rol_estado=ESTADO
		where rol_id=ID;
		SELECT 1;
	ELSE
		SELECT 2;
	END IF;
END IF;

END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_MODIFICAR_SUCURSALES
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_MODIFICAR_SUCURSALES`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_MODIFICAR_SUCURSALES`(IN p_idsucu INT,
    IN p_razon VARCHAR(255),
    IN p_ruc VARCHAR(30),
    IN p_telefono VARCHAR(20),
    IN p_direccion VARCHAR(255),
    IN p_correo VARCHAR(50),
    IN p_id_almacen INT,
    IN p_estadosu VARCHAR(20))
BEGIN
    UPDATE sucursales
    SET
        nombre_su = p_razon,
        ruc_su = p_ruc,
        telefono_su = p_telefono,
        direccion_su = p_direccion,
        correo_su = p_correo,
        id_almacen = p_id_almacen,
        estado_su = p_estadosu
    WHERE id_sucu = p_idsucu;


END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_MODIFICAR_UNIDAD_MEDIDA
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_MODIFICAR_UNIDAD_MEDIDA`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_MODIFICAR_UNIDAD_MEDIDA`(IN ID INT,IN DESCRIPCION VARCHAR(25),IN ABREVIATURA VARCHAR(25), IN ESTADO VARCHAR(10))
BEGIN
DECLARE CANTIDAD INT;
DECLARE MEDIDAACTUAL VARCHAR(25);
SET @MEDIDAACTUAL:=(SELECT unidad_descripcion from unidadmedida where unidad_id =ID);
IF @MEDIDAACTUAL = DESCRIPCION THEN
	UPDATE unidadmedida set
	unidad_descripcion=DESCRIPCION,
	unidad_abrevia = ABREVIATURA,
	unidad_estado=ESTADO
	where unidad_id=ID;
	SELECT 1;
ELSE
	SET @CANTIDAD:=(SELECT COUNT(*) FROM unidadmedida where unidad_descripcion = DESCRIPCION);
	if @CANTIDAD = 0 THEN
			UPDATE unidadmedida set
			unidad_descripcion=DESCRIPCION,
			unidad_abrevia = ABREVIATURA,
			unidad_estado=ESTADO
			where unidad_id=ID;
		SELECT 1;
	ELSE
		SELECT 2;
	END IF;
END IF;

END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_MODIFICAR_USUARIO
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_MODIFICAR_USUARIO`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_MODIFICAR_USUARIO`(IN ID INT, IN USUARIO VARCHAR(20), IN CORREO VARCHAR(255), IN ROL INT,IN p_idsucu INT)
UPDATE usuario SET
usu_email = CORREO,
usu_nombre = USUARIO,
rol_id = ROL,
id_sucu = p_idsucu
WHERE usu_id = ID
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_MODIFICAR_USUARIO_ESTADO
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_MODIFICAR_USUARIO_ESTADO`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_MODIFICAR_USUARIO_ESTADO`(IN ID INT,IN ESTADO VARCHAR(10))
UPDATE usuario set
usu_estado=ESTADO
where usu_id=ID
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_MOVIMIENTOS_POR_PRODUCTO_KARDEX
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_MOVIMIENTOS_POR_PRODUCTO_KARDEX`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_MOVIMIENTOS_POR_PRODUCTO_KARDEX`(IN IDPRODUC INT)
SELECT
	producto_id,
	IFNULL(venta_comprobante, '-') as comprobante,
	kardex_tipo,
	DATE_FORMAT(kardex_fecha, '%d/%m/%Y') as fecha, 
	kardex_ingreso,
	kardex_salida,
	kardex.imei,
	kardex.tecnico
FROM
	kardex
WHERE
	producto_id COLLATE utf8mb4_general_ci = IDPRODUC
	AND kardex_tipo IN ('INICIAL', 'INGRESO', 'SALIDA', 'SALIDA DIRECTA', 'SALIDA INSUMOS', 'DEVOLUCION INSUMO')
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_MOVIMIENTOS_PROD_CLIENTE
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_MOVIMIENTOS_PROD_CLIENTE`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_MOVIMIENTOS_PROD_CLIENTE`(IN IDCLIENTE INT)
BEGIN
SELECT
	p.producto_nombre as nombre_prod,
	dv.v_imei as imei,
	dv.vdetalle_cantidad as cantidad,
	DATE_FORMAT(dv.vdetalle_fecha , '%d/%m/%Y') as fecha,
	c.cliente_nombres as cliente,
	CONCAT(v.venta_comprobante, ' ', v.venta_serie, '-', v.venta_num_comprobante) as comprobante,
	u.usu_nombre as vendedor
FROM
	detalle_venta dv
	INNER JOIN producto p ON dv.producto_id = p.producto_id
	INNER JOIN venta v ON dv.venta_id  = v.venta_id
	INNER JOIN cliente c ON v.cliente_id = c.cliente_id
	INNER JOIN usuario u on v.usu_id = u.usu_id
	WHERE v.cliente_id = IDCLIENTE;


END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_PAGAR_VENTA
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_PAGAR_VENTA`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_PAGAR_VENTA`(IN ID INT,IN ESTADO VARCHAR(30))
UPDATE venta set
venta_estado=ESTADO
where venta_id=ID
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_PIVOT_VENTAS
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_PIVOT_VENTAS`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_PIVOT_VENTAS`(IN p_sucursal INT)
SELECT YEAR(venta_fregistro) as anio,
SUM(CASE WHEN MONTH(venta_fregistro)=1 THEN venta_total ELSE 0 END) AS enero,
SUM(CASE WHEN MONTH(venta_fregistro)=2 THEN venta_total ELSE 0 END) AS febrero,
SUM(CASE WHEN MONTH(venta_fregistro)=3 THEN venta_total ELSE 0 END) AS marzo,
SUM(CASE WHEN MONTH(venta_fregistro)=4 THEN venta_total ELSE 0 END) AS abril,
SUM(CASE WHEN MONTH(venta_fregistro)=5 THEN venta_total ELSE 0 END) AS mayo,
SUM(CASE WHEN MONTH(venta_fregistro)=6 THEN venta_total ELSE 0 END) AS junio,
SUM(CASE WHEN MONTH(venta_fregistro)=7 THEN venta_total ELSE 0 END) AS julio,
SUM(CASE WHEN MONTH(venta_fregistro)=8 THEN venta_total ELSE 0 END) AS agosto,
SUM(CASE WHEN MONTH(venta_fregistro)=9 THEN venta_total ELSE 0 END) AS setiembre,
SUM(CASE WHEN MONTH(venta_fregistro)=10 THEN venta_total ELSE 0 END) AS octubre,
SUM(CASE WHEN MONTH(venta_fregistro)=11 THEN venta_total ELSE 0 END) AS noviembre,
SUM(CASE WHEN MONTH(venta_fregistro)=12 THEN venta_total ELSE 0 END) AS diciembre,
SUM(venta_total) as total
FROM venta
WHERE venta_estado ='PAGADA' AND venta.id_sucu = p_sucursal
GROUP BY YEAR(venta_fregistro)
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_REGISTRAR_ABONO_VENTA
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_REGISTRAR_ABONO_VENTA`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_REGISTRAR_ABONO_VENTA`(
    IN p_venta_id INT,
    IN p_monto_abono DECIMAL(10,2),
    IN p_usu_id INT,
    IN p_id_sucu INT,
    IN p_caja_id INT
)
BEGIN
    INSERT INTO venta_credito (
        venta_id,
        monto_abono,
        fecha_reg,
        forma_pago,
        usu_id,
        id_sucu,
        caja_id,
        estado_caja
    ) VALUES (
        p_venta_id,
        p_monto_abono,
        NOW(),
        'EFECTIVO',  
        p_usu_id,
        p_id_sucu,
        p_caja_id,
        'ABIERTO'
    );
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_REGISTRAR_ALMACENES
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_REGISTRAR_ALMACENES`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_REGISTRAR_ALMACENES`(IN p_descripcion VARCHAR(255),
    IN p_abrevia VARCHAR(10))
BEGIN
    INSERT INTO almacen (
        descripcion_al,
        codigo_al,
        estado_al,
        fecha_reg_al
    ) VALUES (
        p_descripcion,
        p_abrevia,
        'Activo',
        CURRENT_TIMESTAMP()
    );


END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_REGISTRAR_APERTURA_CAJA
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_REGISTRAR_APERTURA_CAJA`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_REGISTRAR_APERTURA_CAJA`(IN DESCRIPCION VARCHAR(100),
    IN MONTO_INI DECIMAL(10,2),
    IN p_idsucursal INT)
BEGIN
    DECLARE cantidad INT;

    -- Validar si ya existe una caja VIGENTE en la misma sucursal
    SELECT COUNT(*) INTO cantidad 
    FROM caja 
    WHERE caja_estado = 'VIGENTE' AND id_sucu = p_idsucursal;

    IF cantidad = 0 THEN
        INSERT INTO caja (
            caja_descripcion,
            caja_monto_inicial,
            caja_fecha_ap,
            caja_estado,
            caja_hora_aper,
            id_sucu
        ) VALUES (
            DESCRIPCION,
            MONTO_INI,
            CURDATE(),
            'VIGENTE',
            CURRENT_TIME(),
            p_idsucursal
        );
        SELECT 1; -- Registro exitoso
    ELSE
        SELECT 2; -- Ya existe caja vigente
    END IF;
		
	END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_REGISTRAR_BANNER
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_REGISTRAR_BANNER`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_REGISTRAR_BANNER`(IN p_descrip VARCHAR(200), IN p_imagen VARCHAR(200))
BEGIN

INSERT INTO banner (descripcion_b, foto_b, fecha)VALUES(p_descrip, p_imagen,  CURRENT_TIMESTAMP());


END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_REGISTRAR_CAJA_CIERRE
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_REGISTRAR_CAJA_CIERRE`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_REGISTRAR_CAJA_CIERRE`(IN MONTO_VEN DECIMAL(10,2), IN CANT_VENT VARCHAR(255), IN MONTO_EGRES DECIMAL(10,2),  IN CANT_EGRES VARCHAR(255), IN MONTO_TOTAL DECIMAL(10,2), IN MONTO_SERVI DECIMAL(10,2), IN CANT_SERV VARCHAR(255), IN MONTO_INGRE DECIMAL(10,2), IN CANT_INGRE VARCHAR(50), IN p_idcaja INT, IN p_abonomonto DECIMAL(10,2))
UPDATE caja SET 
caja_monto_final =MONTO_VEN,
caja_monto_egreso = MONTO_EGRES, 
caja_fecha_cie= CURDATE(), 
caja_total_ingreso= CANT_VENT, 
caja_total_egreso = CANT_EGRES, 
caja_monto_total = MONTO_TOTAL, 
caja_estado = 'CERRADO',
caja_monto_servicio = MONTO_SERVI,
caja_total_servicio = CANT_SERV,
caja_hora_cierre = CURRENT_TIME(),
caja_monto_ingreso = MONTO_INGRE,
caja_coun_ingreso = CANT_INGRE,
caja_abonos = p_abonomonto
WHERE caja.caja_estado = 'VIGENTE' and caja_id = p_idcaja
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_REGISTRAR_CATEGORIA
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_REGISTRAR_CATEGORIA`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_REGISTRAR_CATEGORIA`(IN CATEGORIA VARCHAR(25))
BEGIN
DECLARE CANTIDAD INT;
SET @CANTIDAD:=(SELECT COUNT(*) FROM categoria where categoria_descripcion=CATEGORIA);
if @CANTIDAD = 0 THEN
INSERT into categoria(categoria_descripcion,categoria_estado)values(CATEGORIA,'ACTIVO');
SELECT 1;
ELSE
SELECT 2;
END IF;
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_REGISTRAR_CLIENTE
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_REGISTRAR_CLIENTE`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_REGISTRAR_CLIENTE`(IN NOMBRE VARCHAR(100),
	IN DNI VARCHAR(20),
	IN CELULAR VARCHAR(20),
	IN DIRECCION VARCHAR(255),
	IN APE_P VARCHAR(255),
	IN APE_M VARCHAR(255),
	IN CORREO VARCHAR(255),
	IN TIPODOC VARCHAR(50),
	IN p_idsucursal INT,
  IN p_listanegra VARCHAR(2))
BEGIN
	DECLARE v_cantidad INT;

	-- Validar si ya existe por DNI
	SELECT COUNT(*) INTO v_cantidad
	FROM cliente
	WHERE cliente_dni = DNI;

	IF v_cantidad = 0 THEN
		START TRANSACTION;

		INSERT INTO cliente (
			cliente_nombres,
			cliente_celular,
			cliente_dni,
			cliente_fregistro,
			cliente_estado,
			cliente_direccion,
			
			cliente_correo,
			cliente_tipo_doc,
			id_sucu,
      cliente_listanegra
		) VALUES (
			NOMBRE,
			CELULAR,
			DNI,
			CURDATE(),
			'ACTIVO',
			DIRECCION,
			
			CORREO,
			TIPODOC,
			p_idsucursal,
      p_listanegra
		);

		COMMIT;
		SELECT 1 ;  -- Registro exitoso
	ELSE
		-- Ya existe, no insertamos nada
		SELECT 2 ;  -- Cliente duplicado
	END IF;
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_REGISTRAR_COMPROBANTE
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_REGISTRAR_COMPROBANTE`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_REGISTRAR_COMPROBANTE`(IN TIPO VARCHAR(100),IN SERIE VARCHAR(100),IN NUMERO VARCHAR(100))
INSERT into comprobante(compro_tipo,compro_serie,compro_numero,compro_estado)values(TIPO, SERIE,NUMERO,'ACTIVO')
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_REGISTRAR_COTIZACION
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_REGISTRAR_COTIZACION`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_REGISTRAR_COTIZACION`(IN IDPROVEEDOR INT, IN COMPROBANTE VARCHAR(255), IN SERIE VARCHAR(255), IN IMPUESTO DECIMAL(10,2),IN TOTAL DECIMAL(10,2),IN IDCOMPROBANTE INT,IN PORCENTAJE DECIMAL(10,2),IN IDUSUARIO INT, IN ATIENDE VARCHAR(255), IN DIASVAL VARCHAR(10), IN FORMAPAGO INT)
BEGIN

DECLARE COMPRO INT;
DECLARE CORRELATIVO INT;
SET @COMPRO:=(SELECT compro_numero FROM comprobante WHERE compro_id=IDCOMPROBANTE);
SET @CORRELATIVO:=(SELECT COUNT(*) FROM comprobante WHERE compro_numero=@COMPRO);		

INSERT INTO cotizacion(cliente_id,coti_comprobante,coti_serie,coti_num_comprobante,coti_fregistro,coti_impuesto,coti_total,coti_estado,compro_id,coti_porcentaje,usu_id,coti_hora,coti_atiende,coti_dias,fpago_id) VALUES (IDPROVEEDOR,COMPROBANTE,SERIE,@COMPRO,CURDATE(),IMPUESTO,TOTAL,'ACTIVO',IDCOMPROBANTE,PORCENTAJE,IDUSUARIO,CURRENT_TIME(),ATIENDE,DIASVAL,FORMAPAGO);
SELECT LAST_INSERT_ID();
		




UPDATE comprobante SET 
		compro_numero=LPAD( @COMPRO + 1, 6, '0')
		where compro_id=IDCOMPROBANTE;





END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_REGISTRAR_DETALLE_COTIZACION
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_REGISTRAR_DETALLE_COTIZACION`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_REGISTRAR_DETALLE_COTIZACION`(IN IDCOTI INT, IN PRODUCTO INT, IN CANTIDAD DECIMAL(10,2), IN PRECIO DECIMAL(10,2))
BEGIN
INSERT INTO cotizacion_detalle(coti_id, producto_id,coti_detalle_cantidad,coti_detalle_precio,coti_detalle_estado,coti_detalle_fecha)VALUES(IDCOTI,PRODUCTO,CANTIDAD,PRECIO,'ACTIVO',CURDATE());


END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_REGISTRAR_DETALLE_INSUMOS_RECEP
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_REGISTRAR_DETALLE_INSUMOS_RECEP`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_REGISTRAR_DETALLE_INSUMOS_RECEP`(IN p_id_rece INT, IN p_id_insumo INT, IN p_cantid VARCHAR(50), IN p_monto DECIMAL(10,2), IN p_idusuario INT, IN p_idalmacen INT)
BEGIN

DECLARE NOMUSUARIO VARCHAR(200);
	DECLARE v_pcompra DECIMAL(10,2);
    DECLARE v_pventa DECIMAL(10,2);
    DECLARE v_stock INT;

SET @NOMUSUARIO:=(select usu_nombre from usuario where usu_id = p_idusuario );
set @preciocompra = (select producto_pcompra from producto where producto_id =p_id_insumo);

INSERT INTO recep_insumos(rece_id, producto_id, cantidad, monto_ri, fecha, precio_compra) 
VALUES(p_id_rece, p_id_insumo, p_cantid, p_monto, CURRENT_TIMESTAMP(), @preciocompra);



SELECT precio_uni, precio_venta_s, cantidad_s 
		INTO v_pcompra, v_pventa, v_stock 
		from stock 
		WHERE producto_id = p_id_insumo AND id_almacen = p_idalmacen;

 UPDATE stock 
 SET cantidad_s = cantidad_s - p_cantid
 WHERE producto_id = p_id_insumo AND id_almacen = p_idalmacen;


set @precioventa = (select producto_pventa from producto where producto_id =p_id_insumo);
set @stock = (select cantidad_s from stock where producto_id =p_id_insumo  AND id_almacen = p_idalmacen);

INSERT INTO movimientos (producto_id, cantidad, tipo_movimiento, referencia_id, fecha_reg, observacion, precio_venta_t, tecnico, id_almacen, compro_venta)
VALUES (p_id_insumo, -p_cantid,  'Salida insumo Recep', p_id_rece, NOW(), CONCAT('salida insumo desde recep_id: ','R-000',p_id_rece), v_pventa, p_idusuario, p_idalmacen, CONCAT('RECEPCION: R-000',p_id_rece));


insert into kardex (kardex_fecha, kardex_tipo, kardex_salida, kardex_p_salida, kardex_total, producto_id, kardex_precio_general, venta_comprobante, tecnico) 
VALUES (CURDATE(),'SALIDA INSUMOS',p_cantid, @precioventa, @stock, p_id_insumo, @precioventa, CONCAT('R-000',p_id_rece), @NOMUSUARIO);






end
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_REGISTRAR_DETALLE_PROUCTO
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_REGISTRAR_DETALLE_PROUCTO`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_REGISTRAR_DETALLE_PROUCTO`(IN IDPRO INT, IN PRODUCTO VARCHAR(50), IN P_IDSUCU INT,
	IN P_IDALMACE INT)
BEGIN
INSERT INTO producto_detalle(producto_id, imei, fecha, vendido)VALUES(IDPRO,PRODUCTO, CURDATE(), 'No');

INSERT INTO movimientos (producto_id, cantidad, tipo_movimiento, referencia_id, fecha_reg, observacion, imei, id_almacen , id_sucu)
 VALUES (IDPRO, 1,  'ingreso imei', IDPRO, NOW(), CONCAT('Registro inicial del producto - imei: ', PRODUCTO), PRODUCTO, P_IDALMACE, P_IDSUCU);

		END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_REGISTRAR_DETALLE_RECE_EQUIPO
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_REGISTRAR_DETALLE_RECE_EQUIPO`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_REGISTRAR_DETALLE_RECE_EQUIPO`(IN IDRECE INT, IN EQUIP VARCHAR(150), IN SERI VARCHAR(50), IN P_FALLA VARCHAR(250), IN MONT DECIMAL(10,2), IN ABON  DECIMAL(10,2))
BEGIN
INSERT INTO recep_equipo(rece_id, equipo, serie, monto, abono, fecha, falla)VALUES(IDRECE, EQUIP,SERI, MONT, ABON, CURDATE(), P_FALLA);


END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_REGISTRAR_DETALLE_TRASLADO
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_REGISTRAR_DETALLE_TRASLADO`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_REGISTRAR_DETALLE_TRASLADO`(IN p_id_traslado INT,
    IN p_producto_id INT,
		IN p_precio_v DECIMAL(10,2),
    IN p_cantidad_t INT)
BEGIN
    INSERT INTO detalle_traslados (
        id_traslado,
        producto_id,
        cantidad_t,
        fecha_r,
        precio_v
    ) VALUES (
        p_id_traslado,
        p_producto_id,
        p_cantidad_t,
				NOW(),
        p_precio_v
    );

END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_REGISTRAR_DETALLE_VENTA
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_REGISTRAR_DETALLE_VENTA`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_REGISTRAR_DETALLE_VENTA`(IN IDVENTA INT, IN PRODUCTO INT, IN CANTIDAD DECIMAL(10,2), IN PRECIO DECIMAL(10,2), IN P_IMEI VARCHAR(100), IN P_DESCUENTO DECIMAL(10,2), IN p_idalmacen INT, IN p_idsucur INT, IN p_idimei INT)
BEGIN
		DECLARE v_pcompra DECIMAL(10,2);
    DECLARE v_pventa DECIMAL(10,2);
    DECLARE v_stock DECIMAL(10,2);
    DECLARE v_totalstock DECIMAL(10,2);
    DECLARE v_comprobante VARCHAR(100);
    DECLARE v_id_detalle INT;
    DECLARE v_stock_almacen DECIMAL(10,2);
    DECLARE v_totalstock_almacen DECIMAL(10,2);
		DECLARE v_usuarioid INT;
		DECLARE v_vcomprobante VARCHAR(120);
    
  

    -- 1. Insertar detalle de venta
    INSERT INTO detalle_venta (
        venta_id, producto_id, vdetalle_cantidad, vdetalle_precio, 
        vdetalle_estado, vdetalle_fecha, v_imei, vdetalle_descuento, id_sucu, id_pro_imei
    ) 
    VALUES (
        IDVENTA, PRODUCTO, CANTIDAD, PRECIO, 
        'VENDIDO', NOW(), P_IMEI, P_DESCUENTO, p_idsucur, p_idimei
    );

    -- 2. Marcar el IMEI como vendido si aplica
    IF p_idimei IS NOT NULL AND p_idimei > 0  THEN
        UPDATE producto_detalle 
        SET vendido = 'Si'
        WHERE id_prod_imei = p_idimei AND producto_id = PRODUCTO;
    END IF;


		
		SELECT precio_uni, precio_venta_s, cantidad_s 
		INTO v_pcompra, v_pventa, v_stock 
		from stock 
		WHERE producto_id = PRODUCTO AND id_almacen = p_idalmacen;
		
		
		-- Traemos y concatenamora el numero de comprobante de la venta y la enviamos a movi
		SELECT CONCAT(venta_comprobante, ': ', venta_serie,'-',venta_num_comprobante)
		INTO v_vcomprobante 
		from venta 
		WHERE venta_id = IDVENTA AND id_sucu = p_idsucur;

    -- 4. Calcular nuevo stock total
    SET v_totalstock = v_stock - CANTIDAD;

    -- 5. Actualizar stock total del producto
   /* UPDATE producto 
    SET producto_stock = v_totalstock 
    WHERE producto_id = PRODUCTO;*/
		
		 UPDATE stock 
    SET cantidad_s = v_totalstock 
    WHERE producto_id = PRODUCTO AND id_almacen = p_idalmacen;



    -- 9. Obtener comprobante generado
    SELECT CONCAT_WS('-', venta_comprobante, venta_serie, venta_num_comprobante), usu_id
    INTO v_comprobante , v_usuarioid
    FROM venta
    WHERE venta_id = IDVENTA;
		

    -- 10. Obtener ID del detalle recién insertado
    SET v_id_detalle = LAST_INSERT_ID();
		
		INSERT INTO movimientos (producto_id, id_almacen, cantidad, tipo_movimiento, referencia_id, fecha_reg, usuario_id, observacion, compro_venta, imei, id_sucu, id_detalleventa, idimei)
							VALUES (PRODUCTO, p_idalmacen, -CANTIDAD, 'Venta', IDVENTA, NOW(), v_usuarioid,  CONCAT('venta de producto: ', PRODUCTO, 'venta:', IDVENTA, 'Idimei: ', p_idimei), v_vcomprobante, P_IMEI, p_idsucur, v_id_detalle, p_idimei);

    -- 11. Registrar salida en kardex
    INSERT INTO kardex (
        kardex_fecha, kardex_tipo, kardex_salida, kardex_p_salida,
        kardex_total, producto_id, venta_id, vdetalle_id,
        venta_comprobante, kardex_precio_general, imei
    ) 
    VALUES (
        NOW(), 'SALIDA', CANTIDAD, v_pventa,
        v_totalstock, PRODUCTO, IDVENTA, v_id_detalle,
        v_comprobante, v_pcompra, P_IMEI
    );
		END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_REGISTRAR_DETALLE_VENTA_OLD
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_REGISTRAR_DETALLE_VENTA_OLD`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_REGISTRAR_DETALLE_VENTA_OLD`(IN IDVENTA INT, IN PRODUCTO INT, IN CANTIDAD DECIMAL(10,2), IN PRECIO DECIMAL(10,2), IN P_IMEI VARCHAR(100), IN P_DESCUENTO DECIMAL(10,2))
BEGIN
INSERT INTO detalle_venta(venta_id, producto_id,vdetalle_cantidad,vdetalle_precio,vdetalle_estado,vdetalle_fecha, v_imei, vdetalle_descuento)VALUES(IDVENTA,PRODUCTO,CANTIDAD,PRECIO,'VENDIDO',CURDATE(), P_IMEI, P_DESCUENTO);

/*ACTUALIZAR EL IMEI SI SE VENDIO*/
UPDATE producto_detalle SET
	vendido='Si'
where producto_id= PRODUCTO and imei = P_IMEI;

set @preciocompra = (select producto_pcompra from producto where producto_id =PRODUCTO);
set @precioventa = (select producto_pventa from producto where producto_id =PRODUCTO);
set @stock = (select producto_stock from producto where producto_id =PRODUCTO);

set @totalstock = @stock - 1;
set @COMPROBANTE = (select CONCAT_WS('-',venta_comprobante,venta_serie,venta_num_comprobante) as comprobante from venta where venta_id=IDVENTA);

set @ID_DETALLE_VENTA = LAST_INSERT_ID();

INSERT INTO kardex(kardex_fecha,kardex_tipo,kardex_salida,kardex_p_salida,kardex_total,producto_id,venta_id,vdetalle_id,venta_comprobante,kardex_precio_general, imei) 
VALUES(CURDATE(),'SALIDA',CANTIDAD,@precioventa,@totalstock,PRODUCTO,IDVENTA,@ID_DETALLE_VENTA,@COMPROBANTE,@preciocompra, P_IMEI );
		END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_REGISTRAR_DIAGNOSTICO
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_REGISTRAR_DIAGNOSTICO`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_REGISTRAR_DIAGNOSTICO`(IN IDRECEPC INT, IN IDEQUIP INT, IN DIAGNOSTICO VARCHAR(255))
BEGIN

UPDATE recep_equipo SET
diagnostico = DIAGNOSTICO
WHERE rece_id = IDRECEPC   and id_equipo = IDEQUIP;

END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_REGISTRAR_EMPRESA
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_REGISTRAR_EMPRESA`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_REGISTRAR_EMPRESA`(IN RAZON VARCHAR(255), IN RUC VARCHAR(255), IN REPRE VARCHAR(255), IN DIRECCION VARCHAR(255), IN CELULAR VARCHAR(255), IN TELEFONO VARCHAR(255), IN CORREO VARCHAR(255), IN RUTA VARCHAR(255), in URL VARCHAR(255), IN CUENTA01 VARCHAR(100),IN NRO_CUENTA01 VARCHAR(100),IN CUENTA02 VARCHAR(100),IN NRO_CUENTA02 VARCHAR(100))
BEGIN
DECLARE CANT INT;
SET @CANT:=(SELECT COUNT(*) FROM configuracion WHERE confi_ruc = BINARY RUC);
IF @CANT = 0 THEN
	INSERT INTO configuracion(confi_razon_social,confi_ruc,confi_nombre_representante,confi_direccion,confi_celular,confi_telefono,confi_correo,config_foto,confi_estado,confi_url,confi_cnta01,confi_nro_cuenta01,confi_cnta02,confi_nro_cuenta02)
	VALUES (RAZON,RUC,REPRE,DIRECCION,CELULAR,TELEFONO,CORREO,RUTA,'ACTIVO',URL,CUENTA01,NRO_CUENTA01,CUENTA02,NRO_CUENTA02);
SELECT 1;
ELSE
	SELECT 2;
END IF;
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_REGISTRAR_FORMA_PAGO
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_REGISTRAR_FORMA_PAGO`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_REGISTRAR_FORMA_PAGO`(IN FORMAPAGO VARCHAR(255))
BEGIN
DECLARE CANTIDAD INT;
SET @CANTIDAD:=(SELECT COUNT(*) FROM forma_pago where fpago_descripcion=FORMAPAGO);
if @CANTIDAD = 0 THEN
INSERT into forma_pago(fpago_descripcion,fpago_estado)values(FORMAPAGO,'ACTIVO');
SELECT 1;
ELSE
SELECT 2;
END IF;
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_REGISTRAR_GASTOS
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_REGISTRAR_GASTOS`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_REGISTRAR_GASTOS`(IN GASTO VARCHAR(255),IN NOMTO DECIMAL(10,2),IN RESPONSABLE VARCHAR(255), IN TIPO_M VARCHAR(50), IN p_idsucursal INT, IN p_idusuario INT)
INSERT into gastos(gastos_descripcion,gastos_monto,gastos_responsable,gastos_fregistro,gastos_estado, estado_caja, tipo_mov, id_sucu, usu_id)values(GASTO,NOMTO,RESPONSABLE,CURDATE(),'ACTIVO', 'ABIERTO', TIPO_M, p_idsucursal, p_idusuario)
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_REGISTRAR_INSUMOS_REPARACION
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_REGISTRAR_INSUMOS_REPARACION`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_REGISTRAR_INSUMOS_REPARACION`(IN IDRECEP INT, IN IDPROD INT, IN CANTD VARCHAR(50), IN MONTOTOT DECIMAL(10,2), IN IDUSUA INT, IN p_idalmacen INT)
BEGIN
DECLARE v_cantidad_existente INT;
	DECLARE v_nom_usuario VARCHAR(200);
	DECLARE v_precio_venta DECIMAL(10,2);
	DECLARE v_stock_actual INT;
	DECLARE v_cant_int INT;

	-- Convertir la cantidad a INT si viene como VARCHAR
	SET v_cant_int = CAST(CANTD AS UNSIGNED);

	-- Validar si ya existe el insumo registrado para esa reparación
	SELECT COUNT(*) INTO v_cantidad_existente
	FROM recep_insumos 
	WHERE rece_id = IDRECEP AND producto_id = IDPROD;

	-- Obtener el nombre del usuario
	SELECT usu_nombre INTO v_nom_usuario
	FROM usuario 
	WHERE usu_id = IDUSUA;

	-- Si no está registrado el producto en esa reparación
	IF v_cantidad_existente = 0 THEN

		-- Validar stock actual
		SELECT cantidad_s INTO v_stock_actual
		FROM stock 
		WHERE producto_id = IDPROD AND id_almacen = p_idalmacen;

		IF v_stock_actual >= v_cant_int THEN

			-- Insertar insumo
			INSERT INTO recep_insumos (rece_id, producto_id, cantidad, fecha, monto_ri)
			VALUES (IDRECEP, IDPROD, v_cant_int, NOW(), MONTOTOT);

			-- Descontar stock
			UPDATE stock 
			SET cantidad_s = cantidad_s - v_cant_int
			WHERE producto_id = IDPROD AND id_almacen = p_idalmacen;

			-- Obtener precio de venta
			SELECT producto_pventa INTO v_precio_venta 
			FROM producto 
			WHERE producto_id = IDPROD;

			-- Insertar en movimientos
			INSERT INTO movimientos (
				producto_id, cantidad, tipo_movimiento, referencia_id, fecha_reg, observacion, precio_venta_t, tecnico, id_almacen, compro_venta
			)
			VALUES (
				IDPROD, v_cant_int, 'Salida insumo Recep', IDRECEP, NOW(), 
				CONCAT('salida insumo recepcion - idrece: ', IDRECEP, ' producto: ', IDPROD), v_precio_venta, IDUSUA, p_idalmacen, CONCAT('RECEPCION: R-000',p_id_rece) 
			);

			-- Insertar en kardex
			INSERT INTO kardex (
				kardex_fecha, kardex_tipo, kardex_salida, kardex_p_salida, kardex_total,
				producto_id, kardex_precio_general, venta_comprobante, tecnico
			)
			VALUES (
				CURDATE(), 'SALIDA INSUMOS', v_cant_int, v_precio_venta, v_stock_actual,
				IDPROD, v_precio_venta, CONCAT('R-000', IDRECEP), v_nom_usuario
			);

			SELECT 1; -- Registro exitoso

		ELSE
			SELECT 3 ; -- Stock insuficiente
		END IF;

	ELSE
		SELECT 2 ; -- Ya existe el insumo registrado
	END IF;
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_REGISTRAR_MARCA
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_REGISTRAR_MARCA`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_REGISTRAR_MARCA`(IN MARCA VARCHAR(25))
BEGIN
DECLARE CANTIDAD INT;
SET @CANTIDAD:=(SELECT COUNT(*) FROM marca where marca_descripcion=MARCA);
if @CANTIDAD = 0 THEN
INSERT into marca(marca_descripcion,marca_estado)values(MARCA,'ACTIVO');
SELECT 1;
ELSE
SELECT 2;
END IF;
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_REGISTRAR_MOTIVO
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_REGISTRAR_MOTIVO`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_REGISTRAR_MOTIVO`(IN MOTIVO VARCHAR(255))
BEGIN
DECLARE CANTIDAD INT;
SET @CANTIDAD:=(SELECT COUNT(*) FROM motivo where motivo_descripcion=MOTIVO);
if @CANTIDAD = 0 THEN
INSERT into motivo(motivo_descripcion,motivo_estado)values(MOTIVO,'ACTIVO');
SELECT 1;
ELSE
SELECT 2;
END IF;
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_REGISTRAR_NOTAS
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_REGISTRAR_NOTAS`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_REGISTRAR_NOTAS`(IN p_descrip VARCHAR(250), IN p_idusuario INT)
BEGIN

INSERT INTO notas(descripcion, estado,  fecha, usu_id ) VALUES(p_descrip, '1', CURRENT_TIMESTAMP(), p_idusuario);

END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_REGISTRAR_PRODUCTO
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_REGISTRAR_PRODUCTO`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_REGISTRAR_PRODUCTO`(IN PRODUCTO VARCHAR(100),
	IN IDMARCA INT,
	IN IDCATEGORIA INT,
	IN STOCK INT,
	IN PCOMPRA DECIMAL(10,2),
	IN PVENTA DECIMAL(10,2),
	IN COD_GENERAL VARCHAR(255),
	IN PROVEE INT,
	IN RUTA VARCHAR(255),
	IN IDUNIDAD INT,
	IN P_IMEI VARCHAR(10),
	IN p_veren_tienda VARCHAR(4),
	IN p_descripcionpro VARCHAR(220),
	IN P_IDSUCU INT,
	IN P_IDALMACE INT,
	IN PCOMERCIAL DECIMAL(10,2),
	IN PMAYORISTA DECIMAL(10,2))
BEGIN
	DECLARE v_id_producto INT;

	-- Iniciar transacción
	START TRANSACTION;

	-- Insertar producto
	INSERT INTO producto (
		producto_nombre,
		marca_id,
		categoria_id,
		producto_stock,
		producto_pcompra,
		producto_pventa,
		producto_fregistro,
		producto_estado,
		producto_stock_inicial,
		producto_codigo_general,
		cliente_id,
		producto_foto,
		unidad_id,
		pro_imei,
		producto_tienda,
		producto_descrip_l,
		producto_pcomercial,
		producto_pmayorista
	) VALUES (
		PRODUCTO,
		IDMARCA,
		IDCATEGORIA,
		STOCK,
		PCOMPRA,
		PVENTA,
		CURDATE(),
		'ACTIVO',
		STOCK,
		COD_GENERAL,
		PROVEE,
		RUTA,
		IDUNIDAD,
		P_IMEI,
		p_veren_tienda,
		p_descripcionpro,
		PCOMERCIAL,
		PMAYORISTA
	);

	-- Guardar el ID del nuevo producto
	SET v_id_producto = LAST_INSERT_ID();

	-- Insertar en stock
	INSERT INTO stock (
		producto_id,
		id_almacen,
		cantidad_s,
		fecha_reg,
		id_sucu,
		tipo_s,
		precio_venta_s,
		precio_uni
		
	) VALUES (
		v_id_producto,
		P_IDALMACE,
		STOCK,
		NOW(),
		P_IDSUCU,
		'INGRESO',
		PVENTA,
		PCOMPRA
	);

	-- Insertar en movimientos
	INSERT INTO movimientos (
		producto_id,
		id_almacen,
		cantidad,
		tipo_movimiento,
		referencia_id,
		fecha_reg,
		usuario_id,
		precio_unitario,
		observacion,
		id_sucu
	) VALUES (
		v_id_producto,
		P_IDALMACE,
		STOCK,
		'INGRESO',
		v_id_producto,
		NOW(),
		1,
		PCOMPRA,
		'Registro inicial del producto',
		P_IDSUCU
	);

	-- Confirmar todo
	COMMIT;

	-- Retornar el ID insertado
	SELECT v_id_producto AS producto_id;
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_REGISTRAR_PROVEEDOR
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_REGISTRAR_PROVEEDOR`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_REGISTRAR_PROVEEDOR`(IN RUC VARCHAR(30),IN RAZON VARCHAR(255),IN DIRECCION VARCHAR(255),IN CELULAR VARCHAR(20))
BEGIN
DECLARE CANTIDAD INT;
SET @CANTIDAD:=(SELECT COUNT(*) FROM proveedor where prove_ruc=RUC);
if @CANTIDAD = 0 THEN
INSERT into proveedor(prove_ruc,prove_razon,prove_direccion,prove_celular,prove_fregistro,prove_estado)values(RUC,RAZON,DIRECCION,CELULAR,CURDATE(),'ACTIVO');
SELECT 1;
ELSE
SELECT 2;
END IF;
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_REGISTRAR_RECEPCION
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_REGISTRAR_RECEPCION`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_REGISTRAR_RECEPCION`(IN MONTO DECIMAL(10,2),IN IDCLIENTE INT, IN IDMOTIVO INT,IN ADELANTO DECIMAL (10,2) ,IN DEBE DECIMAL (10,2),IN ACCESORIOS VARCHAR(255), IN FENTREGA DATE, IN COD_REC VARCHAR(50), IN TECNICOID INT, IN USUA_ID INT, IN RUTA VARCHAR(255), IN p_idsucursal INT)
BEGIN
INSERT INTO recepcion(cliente_id, motivo_id, rece_monto, rece_fregistro, rece_estado, rece_estatus, rece_adelanto, rece_debe, rece_concepto,rece_fentrega, rece_cod, marca_id, tecnico, usuario_registrador, rece_foto1, id_sucu)
	VALUES(IDCLIENTE,   IDMOTIVO, MONTO,CURDATE(),'EN REPARACION','ACTIVO',ADELANTO,DEBE,ACCESORIOS,FENTREGA, COD_REC, 1, TECNICOID, USUA_ID, RUTA, p_idsucursal);
	 SELECT LAST_INSERT_ID();
	-- SET @ID_RECE = LAST_INSERT_ID();
	
	SET @cajaid = (select caja_id from caja where caja_estado = 'VIGENTE' and id_sucu = p_idsucursal);
	
-- 	INSERT INTO servicio (rece_id, servicio_monto, servicio_concepto, servicio_responsable, servicio_fregistro, servicio_entrega, servicio_estado, estado_caja, caja_id, tecnico_servi)
-- 	VALUES(LAST_INSERT_ID() , MONTO, ACCESORIOS, 'CARLOS', CURDATE(), 'EN REPARACION', 'ACTIVO', 'ABIERTO', @cajaid, TECNICOID );
	END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_REGISTRAR_REPARACION
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_REGISTRAR_REPARACION`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_REGISTRAR_REPARACION`(IN IDRECEPC INT, IN DESCRIP VARCHAR(255), IN ESTADOREP VARCHAR(255))
BEGIN

UPDATE recepcion SET
diagnostico_tecnico = DESCRIP,
rece_estado = ESTADOREP
WHERE rece_id = IDRECEPC  ;

END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_REGISTRAR_ROL
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_REGISTRAR_ROL`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_REGISTRAR_ROL`(IN ROL VARCHAR(25))
BEGIN
DECLARE CANTIDAD INT;
SET @CANTIDAD:=(SELECT COUNT(*) FROM rol where rol_nombre=ROL);
if @CANTIDAD = 0 THEN
INSERT into rol(rol_nombre,rol_fregistro,rol_estado)values(ROL,CURDATE(),'ACTIVO');
SELECT 1;
ELSE
SELECT 2;
END IF;
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_REGISTRAR_SERVICIO
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_REGISTRAR_SERVICIO`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_REGISTRAR_SERVICIO`(IN IDRECE INT, IN MONTO DECIMAL(10,2),IN CONCEPTO VARCHAR(255),IN RESPONSABLE VARCHAR(255),IN COMENTARIO VARCHAR(255), IN OBSERVA VARCHAR(200), IN MODELO VARCHAR(200),  IN IDFORMA_P INT, IN MONTO_EFEC DECIMAL(10,2), IN COD_OPERA VARCHAR(20), IN MONTO_TARJ DECIMAL(10,2), IN IDCAJA INT , IN IDTECNICO INT, IN ESTADOSERV VARCHAR(100), IN p_idsucursal INT)
BEGIN
INSERT INTO servicio(rece_id,servicio_monto,servicio_concepto,servicio_responsable,servicio_comentario,servicio_fregistro,servicio_entrega,servicio_estado, estado_caja, servicio_obser, servicio_modelo, fpago_id, monto_efectivo, cod_operacion, monto_tarjeta, caja_id, tecnico_servi, id_sucu) 
VALUES(IDRECE,MONTO,CONCEPTO,RESPONSABLE,COMENTARIO,CURDATE(),ESTADOSERV,'ACTIVO', 'ABIERTO', OBSERVA, MODELO, IDFORMA_P, MONTO_EFEC, COD_OPERA, MONTO_TARJ, IDCAJA, IDTECNICO, p_idsucursal);

-- INSERT INTO movimientos()


UPDATE recepcion SET
rece_estado = 'ENTREGADO'
WHERE rece_id = IDRECE;


END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_REGISTRAR_SUCURSALES
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_REGISTRAR_SUCURSALES`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_REGISTRAR_SUCURSALES`(IN p_razon VARCHAR(255),
    IN p_ruc VARCHAR(30),
    IN p_telefono VARCHAR(20),
    IN p_direccion VARCHAR(255),
    IN p_correo VARCHAR(50),
    IN p_id_almacen INT)
BEGIN
    INSERT INTO sucursales (
				confi_id,
        nombre_su,
        ruc_su,
        telefono_su,
        direccion_su,
        correo_su,
        id_almacen,
        estado_su,
				fecha_reg
    ) VALUES (
				3,
        p_razon,
        p_ruc,
        p_telefono,
        p_direccion,
        p_correo,
        p_id_almacen,
        'Activo',
				CURRENT_TIMESTAMP()
    );
    
   
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_REGISTRAR_TEST
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_REGISTRAR_TEST`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_REGISTRAR_TEST`(IN IDRECEP INT , IN ENCIEND VARCHAR(3) , IN TACTI VARCHAR(3), IN IMG VARCHAR(3), IN VIBRA VARCHAR(3), IN COBER VARCHAR(3), IN SENSO VARCHAR(3), IN CARG VARCHAR(3), IN BLUET VARCHAR(3), IN WIF VARCHAR(3), IN HUELL VARCHAR(3), IN HOM VARCHAR(3), IN `LATERA` VARCHAR(3), IN CAMAR VARCHAR(3), IN BATE VARCHAR(3), IN AURICUL VARCHAR(3), IN MICRO VARCHAR(3), IN FACE_ID VARCHAR(3), IN TORNIL VARCHAR(3))
BEGIN
UPDATE recepcion SET
enciende = ENCIEND,
tactil = TACTI,
imagen = IMG,
vibra = VIBRA,
cobertura = COBER,
sensor = SENSO,
carga = CARG,
bluetoo = BLUET,
wifi = WIF,
huella = HUELL,
home = HOM,
`lateral` = `LATERA`,
camara = CAMAR,
bateria = BATE,
auricular = AURICUL,
micro = MICRO,
face = FACE_ID ,
tornillo = TORNIL

where rece_id = IDRECEP;
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_REGISTRAR_TRASLADO_CABE
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_REGISTRAR_TRASLADO_CABE`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_REGISTRAR_TRASLADO_CABE`(IN p_almacen_origen_id INT,
    IN p_almacen_destino_id INT,
		IN p_idusu INT,
    IN p_glosa_t VARCHAR(255))
BEGIN
    INSERT INTO traslados (
        fecha_r,
        almacen_origen_id,
        almacen_destino_id,
        usu_id,
        estado,
        glosa_t
    ) VALUES (
        NOW(),
        p_almacen_origen_id,
        p_almacen_destino_id,
        p_idusu,
        'Activo',
        p_glosa_t
    );
    
    SELECT LAST_INSERT_ID() AS id_traslado;
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_REGISTRAR_UNIDAD_MEDIDA
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_REGISTRAR_UNIDAD_MEDIDA`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_REGISTRAR_UNIDAD_MEDIDA`(IN DESCRIPCION VARCHAR(25),IN ABREVIATURA VARCHAR(25))
BEGIN
DECLARE CANTIDAD INT;
SET @CANTIDAD:=(SELECT COUNT(*) FROM unidadmedida where unidad_descripcion COLLATE utf8mb4_general_ci=DESCRIPCION or unidad_abrevia COLLATE utf8mb4_general_ci= ABREVIATURA);
if @CANTIDAD = 0 THEN
INSERT into unidadmedida(unidad_descripcion, unidad_abrevia,unidad_estado)values(DESCRIPCION,ABREVIATURA,'ACTIVO');
SELECT 1;
ELSE
SELECT 2;
END IF;
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_REGISTRAR_USUARIOS
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_REGISTRAR_USUARIOS`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_REGISTRAR_USUARIOS`(IN USUARIO VARCHAR(20), IN CLAVE VARCHAR(255),IN CORREO VARCHAR(255),IN ROL INT,IN RUTA VARCHAR(255),IN p_idsucu INT)
BEGIN
DECLARE CANT INT;
SET @CANT:=(SELECT COUNT(*) FROM usuario WHERE usu_nombre = BINARY USUARIO);
IF @CANT = 0 THEN
	INSERT INTO usuario(usu_nombre, usu_contrasena, usu_email, rol_id, usu_foto, usu_estado, id_sucu)
	VALUES(USUARIO, CLAVE, CORREO, ROL, RUTA,'ACTIVO', p_idsucu);
	
	SELECT 1;
ELSE
	SELECT 2;
END IF;



END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_REGISTRAR_VENTA
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_REGISTRAR_VENTA`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_REGISTRAR_VENTA`(IN IDCLIENTE INT,
    IN COMPROBANTE VARCHAR(255),
    IN SERIE VARCHAR(255),
    IN NUMERO VARCHAR(255),
    IN IMPUESTO DECIMAL(10,2),
    IN TOTAL DECIMAL(10,2),
    IN IDCOMPROBANTE INT,
    IN PORCENTAJE DECIMAL(10,2),
    IN IDUSUARIO INT,
    IN IDFPAGO INT,
    IN OBSERVA VARCHAR(200),
    IN MONT_EFECT DECIMAL(10,2),
    IN COD_OPERAC VARCHAR(50),
    IN MONTO_TARJET DECIMAL(10,2),
    IN IDCAJA INT,
    IN P_DESCUENTO DECIMAL(10,2),
		IN p_sucuid INT,
		IN p_almaid INT,
		IN p_rolid INT)
BEGIN
   DECLARE ULTIMO_NUMERO INT;
    DECLARE NUEVO_NUMERO VARCHAR(10);
		DECLARE ESTADO_VENTA VARCHAR(20);
		
		-- Determinar el estado de la venta según la forma de pago CREDITO
   IF IDFPAGO = 5 THEN
       SET ESTADO_VENTA = 'REGISTRADA';
   ELSE
       SET ESTADO_VENTA = 'PAGADA';
   END IF;

    -- Obtener el último número de comprobante de la serie y convertirlo en entero
    SELECT COALESCE(MAX(CAST(venta_num_comprobante AS UNSIGNED)), 0)
    INTO ULTIMO_NUMERO
    FROM venta
    WHERE venta_serie = SERIE;

    -- Si el número ya existe, incrementarlo en 1
    IF ULTIMO_NUMERO >= CAST(NUMERO AS UNSIGNED) THEN
        SET ULTIMO_NUMERO = ULTIMO_NUMERO + 1;
    ELSE
        SET ULTIMO_NUMERO = CAST(NUMERO AS UNSIGNED);
    END IF;

    -- Formatear el número con ceros a la izquierda (5 dígitos de ejemplo)
    SET NUEVO_NUMERO = LPAD(ULTIMO_NUMERO, CHAR_LENGTH(NUMERO), '0');

    -- Insertar la nueva venta con el número corregido
    INSERT INTO venta (
        cliente_id, venta_comprobante, venta_serie, venta_num_comprobante, 
        venta_fregistro, venta_impuesto, venta_total, venta_estado, compro_id, 
        venta_porcentaje, usu_id, venta_hora, fpago_id, observacion, 
        estado_caja, monto_efectivo, cod_operacion, monto_tarjeta, caja_id, venta_descuento, id_sucu, id_almacen
    ) VALUES (
        IDCLIENTE, COMPROBANTE, SERIE, NUEVO_NUMERO, CURDATE(), IMPUESTO, TOTAL, 
        ESTADO_VENTA, IDCOMPROBANTE, PORCENTAJE, IDUSUARIO, CURRENT_TIME(), 
        IDFPAGO, OBSERVA, 'ABIERTO', MONT_EFECT, COD_OPERAC, MONTO_TARJET, IDCAJA, P_DESCUENTO, p_sucuid, p_almaid
    );

    -- Retornar el ID de la venta insertada
    SELECT LAST_INSERT_ID();
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_REGISTRAR_VENTA_OLD
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_REGISTRAR_VENTA_OLD`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_REGISTRAR_VENTA_OLD`(IN IDCLIENTE INT, IN COMPROBANTE VARCHAR(255), IN SERIE VARCHAR(255), IN NUMERO VARCHAR(255), IN IMPUESTO DECIMAL(10,2),IN TOTAL DECIMAL(10,2),IN IDCOMPROBANTE INT,IN PORCENTAJE DECIMAL(10,2),IN IDUSUARIO INT,IN IDFPAGO INT, IN OBSERVA VARCHAR(200),  IN MONT_EFECT DECIMAL(10,2),  IN COD_OPERAC VARCHAR(50),  IN MONTO_TARJET DECIMAL(10,2), IN IDCAJA INT, IN P_DESCUENTO DECIMAL(10,2))
BEGIN
INSERT INTO venta(cliente_id,venta_comprobante,venta_serie,venta_num_comprobante,venta_fregistro,venta_impuesto,venta_total,venta_estado,compro_id,venta_porcentaje,usu_id,venta_hora, fpago_id,observacion, estado_caja, monto_efectivo, cod_operacion, monto_tarjeta, caja_id, venta_descuento) 
VALUES (IDCLIENTE,COMPROBANTE,SERIE,NUMERO,CURDATE(),IMPUESTO,TOTAL,'PAGADA',IDCOMPROBANTE,PORCENTAJE,IDUSUARIO,CURRENT_TIME(),IDFPAGO,OBSERVA, 'ABIERTO', MONT_EFECT, COD_OPERAC, MONTO_TARJET, IDCAJA, P_DESCUENTO);
SELECT LAST_INSERT_ID();

END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_REGISTRAR_VISTA_INICIO
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_REGISTRAR_VISTA_INICIO`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_REGISTRAR_VISTA_INICIO`(IN p_mendid INT, IN p_rolid INT)
BEGIN

	UPDATE td_menu_detalle 
	SET vista_inicio = '0' 
	WHERE
	rol_id = p_rolid;

	UPDATE td_menu_detalle 
	SET vista_inicio = '1' 
	WHERE
	rol_id = p_rolid 
	AND mend_id = p_mendid;


END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_REPORTE_CAJA_CHICA
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_REPORTE_CAJA_CHICA`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_REPORTE_CAJA_CHICA`(IN FINICIO DATE, IN FFIN DATE, IN p_idsucursal INT, IN p_rolid INT)
SELECT
	c.caja_id, 
	c.caja_descripcion, 	
	c.caja_monto_inicial, 
	c.caja_monto_servicio,
	c.caja_monto_final, 
	c.caja_monto_egreso,
  CONCAT_WS(' ',DATE_FORMAT(c.caja_fecha_ap, '%d/%m/%Y') , c.caja_hora_aper) as  caja_fecha_ap,
	CONCAT_WS(' ',DATE_FORMAT(c.caja_fecha_cie, '%d/%m/%Y') , c.caja_hora_cierre) as caja_fecha_cie,
	c.caja_total_ingreso, 
	c.caja_total_egreso, 
-- 	SUM(caja.caja_monto_inicial + caja.caja_monto_final) - caja_monto_egreso  AS suma,
	c.caja_monto_total, 
	c.caja_estado,
	c.id_sucu,
	s.nombre_su
FROM
	caja c INNER JOIN sucursales s ON
	c.id_sucu = s.id_sucu
	WHERE (p_rolid = 1 OR c.id_sucu = p_idsucursal) AND c.caja_fecha_ap BETWEEN FINICIO AND FFIN 
	ORDER BY c.caja_id DESC
	-- -- WHERE (P_IDROL = 1 OR s.id_almacen = P_IDALMACEN)
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_REPORTE_GASTO_ANUAL
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_REPORTE_GASTO_ANUAL`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_REPORTE_GASTO_ANUAL`(IN ANIO VARCHAR(10), IN p_sucursal INT)
SELECT  
YEAR(a.gastos_fregistro) as ano,
count(a.gastos_monto) as cant_gastos,
MONTH(a.gastos_fregistro) as numero_mes, 
MONTHname(MIN(a.gastos_fregistro)) as mes, 
MAX(sl.nombre_su) as sucur,
SUM(a.gastos_monto) as gasto,
case month(MIN(a.gastos_fregistro)) 
WHEN 1 THEN 'Enero'
WHEN 2 THEN  'Febrero'
WHEN 3 THEN 'Marzo' 
WHEN 4 THEN 'Abril' 
WHEN 5 THEN 'Mayo'
WHEN 6 THEN 'Junio'
WHEN 7 THEN 'Julio'
WHEN 8 THEN 'Agosto'
WHEN 9 THEN 'Septiembre'
WHEN 10 THEN 'Octubre'
WHEN 11 THEN 'Noviembre'
WHEN 12 THEN 'Diciembre'
 END mesnombre  
from gastos a
JOIN sucursales sl ON a.id_sucu = sl.id_sucu
where a.gastos_estado='ACTIVO' and YEAR(a.gastos_fregistro) =ANIO and a.id_sucu = p_sucursal
GROUP BY YEAR(a.gastos_fregistro),
month(a.gastos_fregistro)
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_REPORTE_GASTO_FECHA
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_REPORTE_GASTO_FECHA`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_REPORTE_GASTO_FECHA`(IN FINICIO DATE, IN FFIN DATE)
SELECT
	* ,
	(select SUM(gastos_monto) from gastos WHERE gastos_fregistro BETWEEN FINICIO AND FFIN )
FROM
	gastos
	WHERE gastos_fregistro BETWEEN FINICIO AND FFIN
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_REPORTE_GASTO_MES
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_REPORTE_GASTO_MES`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_REPORTE_GASTO_MES`(IN MES INT, IN p_sucursal INT)
SELECT
	gastos.gastos_id, 
	gastos.gastos_descripcion, 
	gastos.gastos_monto, 
	gastos.gastos_responsable, 
	gastos.gastos_fregistro, 
	gastos.gastos_estado,
	gastos.tipo_mov,
	sl.nombre_su
FROM
	gastos
	JOIN sucursales sl ON gastos.id_sucu = sl.id_sucu
	WHERE gastos.gastos_estado ='ACTIVO' 
	and (select MONTH(gastos_fregistro))=MES and gastos.id_sucu = p_sucursal
	-- and YEAR(gastos_fregistro)=YEAR(CURDATE())
		ORDER BY gastos_id DESC
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_REPORTE_GASTO_TOTAL_ANUAL
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_REPORTE_GASTO_TOTAL_ANUAL`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_REPORTE_GASTO_TOTAL_ANUAL`()
SELECT 
YEAR(gastos_fregistro) as ano,
SUM(gastos_monto) as total_gasto_ano 
FROM gastos
where gastos_estado='ACTIVO'  GROUP BY YEAR(gastos_fregistro)
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_REPORTE_LISTAR_TOTAL_VENTAS_CAJA
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_REPORTE_LISTAR_TOTAL_VENTAS_CAJA`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_REPORTE_LISTAR_TOTAL_VENTAS_CAJA`(IN p_idsucusal INT)
BEGIN
    DECLARE v_monto_inicial DECIMAL(10,2) DEFAULT 0;
    DECLARE v_estado_caja VARCHAR(20);
    DECLARE v_fecha_apertura VARCHAR(50);
    DECLARE v_idcaja INT;

    -- Obtener datos de caja vigente
    SELECT 
        caja_id,
        caja_monto_inicial,
        caja_estado,
        CONCAT_WS(' ', DATE_FORMAT(caja_fecha_ap, '%d/%m/%Y'), caja_hora_aper)
    INTO 
        v_idcaja,
        v_monto_inicial,
        v_estado_caja,
        v_fecha_apertura
    FROM caja
    WHERE caja_estado = 'VIGENTE' AND id_sucu = p_idsucusal
    LIMIT 1;

    -- Retornar reporte
    SELECT 
        -- 1. Monto inicial de caja
        v_monto_inicial AS monto_inicial_caja,

        -- 2. Ventas: cantidad y total
        (SELECT COUNT(*) FROM venta 
         WHERE estado_caja = 'ABIERTO' AND venta_estado = 'PAGADA' AND id_sucu  = p_idsucusal) AS cant_ventas,

        (SELECT IFNULL(SUM(venta_total), 0) FROM venta 
         WHERE estado_caja = 'ABIERTO' AND venta_estado = 'PAGADA' AND id_sucu  = p_idsucusal) AS suma_ventas,

        -- 3. Gastos egresos: cantidad y total
        (SELECT COUNT(*) FROM gastos 
         WHERE estado_caja = 'ABIERTO' AND gastos_estado = 'ACTIVO' AND tipo_mov = 'EGRESO' AND id_sucu  = p_idsucusal) AS cant_egreso,

        (SELECT IFNULL(SUM(gastos_monto), 0) FROM gastos 
         WHERE estado_caja = 'ABIERTO' AND gastos_estado = 'ACTIVO' AND tipo_mov = 'EGRESO' AND id_sucu  = p_idsucusal) AS suma_egreso,

        -- 4. Estado y fecha de apertura de caja
        v_estado_caja AS estado,
        v_fecha_apertura AS fecha_apertura,

        -- 5. Servicios: cantidad y total
        (SELECT COUNT(*) FROM servicio 
         WHERE servicio_estado = 'ACTIVO' AND estado_caja = 'ABIERTO' AND id_sucu = p_idsucusal) AS cant_servicio,

        (SELECT IFNULL(SUM(servicio_monto), 0) FROM servicio 
         WHERE servicio_estado = 'ACTIVO' AND estado_caja = 'ABIERTO' AND id_sucu  = p_idsucusal) AS suma_servicio,

        -- 6. Ingresos por caja: cantidad y total
        (SELECT COUNT(*) FROM gastos 
         WHERE estado_caja = 'ABIERTO' AND gastos_estado = 'ACTIVO' AND tipo_mov = 'INGRESO' AND id_sucu  = p_idsucusal) AS cant_ingreso,

        (SELECT IFNULL(SUM(gastos_monto), 0) FROM gastos 
         WHERE estado_caja = 'ABIERTO' AND gastos_estado = 'ACTIVO' AND tipo_mov = 'INGRESO' AND id_sucu  = p_idsucusal) AS suma_ingreso,

        -- 7. Datos de configuración
        (SELECT confi_moneda FROM configuracion LIMIT 1) AS moneda,
        v_idcaja AS idcaja,
        (SELECT url_sistema FROM configuracion LIMIT 1) AS url_sistema,
        (SELECT cod_pais FROM configuracion LIMIT 1) AS cod_sistema,
        
        (SELECT  IFNULL(SUM(monto_abono),0) from venta_credito where estado_caja = 'ABIERTO' AND  id_sucu =  p_idsucusal ) as abonos;
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_REPORTE_MOVIMIENTOS_PORPRODUCTO_CONIMEI
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_REPORTE_MOVIMIENTOS_PORPRODUCTO_CONIMEI`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_REPORTE_MOVIMIENTOS_PORPRODUCTO_CONIMEI`(IN PRODUCT_ID  INT, IN p_idalmacen INT)
SELECT 
    m.producto_id,
    m.id_almacen,
		m.compro_venta as comprobante,
    p.producto_codigo,
    p.producto_nombre,
    m.tipo_movimiento AS kardex_tipo,
    DATE_FORMAT(m.fecha_reg, '%d/%m/%Y') AS fecha,
    m.observacion,
		IFNULL(m.imei, '-') as imei,
    -- Mostrar ingreso si es tipo INGRESO, caso contrario NULL
    CASE 
        WHEN m.tipo_movimiento IN ( 'INGRESO', 'ingreso directo', 'traslado_entrada') THEN m.cantidad 
        ELSE NULL 
    END AS kardex_ingreso,
    -- Mostrar salida si es tipo SALIDA, caso contrario NULL
    CASE 
        WHEN m.tipo_movimiento IN ('Venta', 'traslado_salida', 'SALIDA DIRECTA', 'Salida insumo Recep') THEN m.cantidad 
        ELSE NULL 
    END AS kardex_salida
FROM 
    movimientos m
JOIN 
    producto p ON m.producto_id = p.producto_id
WHERE 
    m.producto_id = PRODUCT_ID AND 
    m.id_almacen = p_idalmacen
ORDER BY 
    m.fecha_reg ASC
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_REPORTE_MOVIMIENTOS_PORPRODUCTO_SIN_IMEI
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_REPORTE_MOVIMIENTOS_PORPRODUCTO_SIN_IMEI`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_REPORTE_MOVIMIENTOS_PORPRODUCTO_SIN_IMEI`(IN PRODUCT_ID  INT, IN p_idalmacen INT)
SELECT 
    m.producto_id,
    m.id_almacen,
		m.compro_venta as comprobante,
    p.producto_codigo,
    p.producto_nombre,
    m.tipo_movimiento AS kardex_tipo,
    DATE_FORMAT(m.fecha_reg, '%d/%m/%Y') AS fecha,
    m.observacion,
		IFNULL(m.tecnico, '-') as tecnico,
    -- Mostrar ingreso si es tipo INGRESO, caso contrario NULL
    CASE 
        WHEN m.tipo_movimiento IN ( 'INGRESO', 'ingreso directo', 'traslado_entrada') THEN m.cantidad 
        ELSE NULL 
    END AS kardex_ingreso,
    -- Mostrar salida si es tipo SALIDA, caso contrario NULL
    CASE 
        WHEN m.tipo_movimiento IN ('Venta', 'traslado_salida', 'SALIDA DIRECTA', 'Salida insumo Recep') THEN m.cantidad 
        ELSE NULL 
    END AS kardex_salida
FROM 
    movimientos m
JOIN 
    producto p ON m.producto_id = p.producto_id
WHERE 
    m.producto_id = PRODUCT_ID AND 
    m.id_almacen = p_idalmacen
ORDER BY 
    m.fecha_reg ASC
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_REPORTE_PRODUCTO_EN_SAL
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_REPORTE_PRODUCTO_EN_SAL`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_REPORTE_PRODUCTO_EN_SAL`(IN p_idsucursal INT)
BEGIN

	 DECLARE v_idalmacen INT;
	 
	 SELECT su.id_almacen 
	 INTO v_idalmacen
	 from sucursales su
	 WHERE su.id_sucu = p_idsucursal;
	 
	 SELECT 
			p.producto_id,
			p.producto_codigo as codigo,
			p.producto_nombre as nombre,
			s.cantidad_s as stock_actual,
			s.id_almacen as almacen,
			sl.nombre_su,
			p.pro_imei,
			sl.id_sucu
			
	 FROM stock s
	 JOIN producto p ON
	 s.producto_id = p.producto_id
	 JOIN sucursales sl ON s.id_sucu = sl.id_sucu
	 WHERE s.id_sucu = p_idsucursal and s.id_almacen = v_idalmacen;



END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_REPORTE_SERVICIO_ANUAL
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_REPORTE_SERVICIO_ANUAL`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_REPORTE_SERVICIO_ANUAL`(IN ANIO VARCHAR(10), IN p_sucursal INT)
SELECT  
YEAR(s.servicio_fregistro) as ano,
    COUNT(s.servicio_fregistro) as cant_servicio,
    MONTH(s.servicio_fregistro) as numero_mes, 
    MONTHNAME(MIN(s.servicio_fregistro)) as mes, 
    SUM(s.servicio_monto) as monto_servicio,
		MAX(sl.nombre_su) as sucursnombre,
    CASE MONTH(MIN(s.servicio_fregistro)) 
WHEN 1 THEN 'Enero'
WHEN 2 THEN  'Febrero'
WHEN 3 THEN 'Marzo' 
WHEN 4 THEN 'Abril' 
WHEN 5 THEN 'Mayo'
WHEN 6 THEN 'Junio'
WHEN 7 THEN 'Julio'
WHEN 8 THEN 'Agosto'
WHEN 9 THEN 'Septiembre'
WHEN 10 THEN 'Octubre'
WHEN 11 THEN 'Noviembre'
WHEN 12 THEN 'Diciembre'
 END mesnombre  
from servicio s
JOIN sucursales sl ON s.id_sucu = sl.id_sucu
where YEAR(s.servicio_fregistro) =ANIO and s.id_sucu = p_sucursal
GROUP BY YEAR(s.servicio_fregistro), MONTH(s.servicio_fregistro)
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_REPORTE_SERVICIO_FECHAS_TECNICO
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_REPORTE_SERVICIO_FECHAS_TECNICO`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_REPORTE_SERVICIO_FECHAS_TECNICO`(IN FEINI DATE, IN FEFIN DATE, IN USUAID INT)
BEGIN
  IF USUAID IS NOT NULL THEN
        SELECT
            s.servicio_id, 
            CONCAT( ' R-000',s.rece_id ) as referencia, 
						r.rece_cod as r_codig,
            c.cliente_nombres,
            s.servicio_concepto,
            s.servicio_monto,  
            s.servicio_responsable, 
            s.servicio_entrega,
						DATE_FORMAT( s.servicio_fregistro, '%d/%m/%Y') as servicio_fregistro,
            s.servicio_comentario, 	
            s.tecnico_servi,
						DATE_FORMAT(r.rece_fregistro, '%d/%m/%Y') as rece_fregistro,
						DATEDIFF(s.servicio_fregistro, r.rece_fregistro) AS dias_diferencia,
						fp.fpago_descripcion,
						sl.nombre_su as sucur
						
        FROM
            servicio s
            INNER JOIN recepcion r ON s.rece_id = r.rece_id
            INNER JOIN cliente c ON r.cliente_id = c.cliente_id 
						INNER JOIN forma_pago fp ON s.fpago_id = fp.fpago_id
						JOIN sucursales sl ON s.id_sucu = sl.id_sucu
						
        WHERE 
            DATE(s.servicio_fregistro) BETWEEN FEINI AND FEFIN AND s.id_sucu = USUAID
						GROUP BY 
    s.servicio_id, s.rece_id, r.rece_cod, c.cliente_nombres, s.servicio_concepto, s.servicio_monto, s.servicio_responsable, s.servicio_entrega, s.servicio_fregistro, s.servicio_comentario, s.tecnico_servi, r.rece_fregistro, fp.fpago_descripcion
ORDER BY 
            s.servicio_fregistro;
					
    ELSE
        SELECT
            s.servicio_id, 
            CONCAT( ' R-000',s.rece_id ) as referencia, 
						r.rece_cod as r_codig,
            c.cliente_nombres,
            s.servicio_concepto,
            s.servicio_monto,  
            s.servicio_responsable, 
            s.servicio_entrega,
            DATE_FORMAT( s.servicio_fregistro, '%d/%m/%Y') as servicio_fregistro,
            s.servicio_comentario, 	
            s.tecnico_servi,
						DATE_FORMAT(r.rece_fregistro, '%d/%m/%Y') as rece_fregistro,
						DATEDIFF(s.servicio_fregistro, r.rece_fregistro) AS dias_diferencia,
						fp.fpago_descripcion,
						sl.nombre_su as sucur
						
        FROM
            servicio s
            INNER JOIN recepcion r ON s.rece_id = r.rece_id
            INNER JOIN cliente c ON r.cliente_id = c.cliente_id 
						INNER JOIN forma_pago fp ON s.fpago_id = fp.fpago_id
						JOIN sucursales sl ON s.id_sucu = sl.id_sucu
			
        WHERE 
            DATE(s.servicio_fregistro) BETWEEN FEINI AND FEFIN 
							GROUP BY 
    s.servicio_id, s.rece_id, r.rece_cod, c.cliente_nombres, s.servicio_concepto, s.servicio_monto, s.servicio_responsable, s.servicio_entrega, s.servicio_fregistro, s.servicio_comentario, s.tecnico_servi, r.rece_fregistro, fp.fpago_descripcion
ORDER BY 
            s.servicio_fregistro;
					
    END IF;
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_REPORTE_SERVICIO_MES
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_REPORTE_SERVICIO_MES`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_REPORTE_SERVICIO_MES`(IN MES INT, IN p_sucursal INT)
SELECT
	servicio.servicio_id, 
	servicio.rece_id, 
	recepcion.cliente_id, 
	cliente.cliente_nombres, 
	CONCAT_WS(' - ',recepcion.rece_equipo,recepcion.rece_concepto) as concepto, 
	recepcion.rece_monto, 
	recepcion.rece_estado, 
	servicio.servicio_monto, 
	servicio.servicio_concepto, 
	servicio.servicio_responsable, 
	servicio.servicio_comentario, 
	servicio.servicio_entrega,
	servicio.servicio_fregistro,
	servicio.servicio_estado,
	sl.nombre_su
FROM
	servicio
	INNER JOIN
	recepcion
	ON 
		servicio.rece_id = recepcion.rece_id
	INNER JOIN
	cliente
	ON 
		recepcion.cliente_id = cliente.cliente_id 
		JOIN sucursales sl ON servicio.id_sucu = sl.id_sucu
		WHERE MONTH(servicio.servicio_fregistro)=MES and servicio.id_sucu = p_sucursal
		-- YEAR(servicio.servicio_fregistro)=YEAR(CURDATE())
		ORDER BY servicio.servicio_fregistro DESC
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_REPORTE_UTILIDAD
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_REPORTE_UTILIDAD`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_REPORTE_UTILIDAD`()
SELECT
	detalle_venta.producto_id, 
	CONCAT_WS(' | ',producto.producto_codigo, producto.producto_nombre) as producto, 

	detalle_venta.vdetalle_cantidad, 
		SUM(detalle_venta.vdetalle_cantidad) as cantida_vendidos,
	MAX(detalle_venta.vdetalle_precio - detalle_venta.vdetalle_descuento) as precio_venta,
	MAX(producto.producto_pcompra) as producto_pcompra, 
	(MAX(detalle_venta.vdetalle_precio - detalle_venta.vdetalle_descuento) - producto.producto_pcompra  ) as utilidad,

	 SUM((detalle_venta.vdetalle_precio - producto.producto_pcompra - detalle_venta.vdetalle_descuento) * detalle_venta.vdetalle_cantidad)  as suma_total
FROM
	producto
	INNER JOIN
	detalle_venta
	ON 
		producto.producto_id = detalle_venta.producto_id
		JOIN stock ON
		producto.producto_id = stock.producto_id 
		WHERE vdetalle_estado = 'VENDIDO'
		 GROUP BY detalle_venta.producto_id, detalle_venta.vdetalle_cantidad
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_REPORTE_VENTA_ANIO
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_REPORTE_VENTA_ANIO`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_REPORTE_VENTA_ANIO`(IN ANIO VARCHAR(10), IN p_sucursal INT)
SELECT 
YEAR(v.venta_fregistro) as ano, 
MONTH(v.venta_fregistro) as numero_mes, 
MONTHname(MIN(v.venta_fregistro)) as mes,
count(v.venta_total) as cant_ventas,
SUM(v.venta_total) as total,
MAX(sl.nombre_su) as sucur,
case month(MIN(v.venta_fregistro)) 
WHEN 1 THEN 'Enero'
WHEN 2 THEN  'Febrero'
WHEN 3 THEN 'Marzo' 
WHEN 4 THEN 'Abril' 
WHEN 5 THEN 'Mayo'
WHEN 6 THEN 'Junio'
WHEN 7 THEN 'Julio'
WHEN 8 THEN 'Agosto'
WHEN 9 THEN 'Septiembre'
WHEN 10 THEN 'Octubre'
WHEN 11 THEN 'Noviembre'
WHEN 12 THEN 'Diciembre'
 END mesnombre 
FROM venta v
JOIN sucursales sl ON v.id_sucu = sl.id_sucu
where venta_estado ='PAGADA' and YEAR(v.venta_fregistro) =ANIO AND v.id_sucu = p_sucursal
GROUP BY YEAR(v.venta_fregistro),
month(v.venta_fregistro)
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_REPORTE_VENTA_ANULADA
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_REPORTE_VENTA_ANULADA`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_REPORTE_VENTA_ANULADA`(IN MES VARCHAR(5),IN ANIO VARCHAR(10))
SELECT
	venta.venta_id, 
	MONTH(venta_fregistro) as numero_mes, 
	cliente.cliente_nombres, 
	
	CONCAT_WS(' - ',venta.venta_comprobante, venta.venta_serie,venta.venta_num_comprobante) AS comprobante, 
	venta.venta_total, 
	venta.venta_fregistro, 
	venta.venta_estado, 
	venta.compro_id, 
	venta.usu_id, 
	usuario.usu_nombre
FROM
	venta
	INNER JOIN
	cliente
	ON 
		venta.cliente_id = cliente.cliente_id
	INNER JOIN
	comprobante
	ON 
		venta.compro_id = comprobante.compro_id
	INNER JOIN
	usuario
	ON 
		venta.usu_id = usuario.usu_id
		WHERE venta.venta_fregistro and venta_estado='ANULADA' 
		and (select MONTH(venta_fregistro))=MES 
		and YEAR(venta_fregistro)=ANIO
		ORDER BY venta_id DESC
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_REPORTE_VENTA_DEL_DIA
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_REPORTE_VENTA_DEL_DIA`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_REPORTE_VENTA_DEL_DIA`(IN FINICIO DATE, IN FFIN DATE, IN p_sucursal INT)
SELECT
  MAX( detalle_venta.vdetalle_id) as vdetalle_id, 
    detalle_venta.venta_id, 
    MAX(venta.venta_fregistro) AS fecha, -- Aplicando MAX() como función de agregación
    MAX(venta.venta_comprobante) as tipo_comprobante, -- Aplicando MAX() como función de agregación
    CONCAT_WS(' - ', MAX(venta.venta_serie), MAX(venta.venta_num_comprobante)) AS comprobante, -- Aplicando MAX() como función de agregación
    MAX(cliente.cliente_nombres) as cliente, -- Aplicando MAX() como función de agregación
    MAX(venta.venta_total - venta.venta_impuesto) as base_imp, -- Aplicando MAX() como función de agregación
    MAX(venta.venta_impuesto) as igv, -- Aplicando MAX() como función de agregación
    MAX(venta.venta_total) as total,
		MAX(usuario.usu_nombre) as usuario,
		MAX(sl.nombre_su) as sucur
FROM
	detalle_venta
	INNER JOIN
	venta
	ON 
		detalle_venta.venta_id = venta.venta_id
	INNER JOIN
	producto
	ON 
		detalle_venta.producto_id = producto.producto_id
		INNER JOIN
	cliente
	ON 
		venta.cliente_id = cliente.cliente_id
		INNER JOIN usuario 
		ON venta.usu_id = usuario.usu_id
		JOIN sucursales sl ON venta.id_sucu = sl.id_sucu
		where venta.venta_estado = 'PAGADA' and venta.venta_fregistro BETWEEN FINICIO AND FFIN 	and venta.id_sucu = p_sucursal
	GROUP BY detalle_venta.venta_id
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_REPORTE_VENTA_GENERAL
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_REPORTE_VENTA_GENERAL`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_REPORTE_VENTA_GENERAL`()
SELECT 
YEAR(v.venta_fregistro) as ano, 
MONTH(v.venta_fregistro) as numero_mes, 
MONTHname(v.venta_fregistro) as mes,
count(v.venta_total) as cant_fact,
SUM(v.venta_total) as total,
case month(v.venta_fregistro) 
WHEN 1 THEN 'Enero'
WHEN 2 THEN  'Febrero'
WHEN 3 THEN 'Marzo' 
WHEN 4 THEN 'Abril' 
WHEN 5 THEN 'Mayo'
WHEN 6 THEN 'Junio'
WHEN 7 THEN 'Julio'
WHEN 8 THEN 'Agosto'
WHEN 9 THEN 'Septiembre'
WHEN 10 THEN 'Octubre'
WHEN 11 THEN 'Noviembre'
WHEN 12 THEN 'Diciembre'
 END mesnombre 
FROM venta v
where venta_estado ='PAGADA' 
GROUP BY YEAR(v.venta_fregistro),
month(v.venta_fregistro)
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_REPORTE_VENTA_MES
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_REPORTE_VENTA_MES`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_REPORTE_VENTA_MES`(IN MES VARCHAR(5),IN ANIO VARCHAR(10), IN p_sucursal INT)
SELECT
	venta.venta_id, 
	cliente.cliente_nombres, 
	CONCAT_WS(' - ',venta.venta_comprobante,venta.venta_serie,venta.venta_num_comprobante) AS comprobante, 
	venta.venta_total, 
	venta.venta_fregistro, 
	venta.venta_estado, 
	COUNT(detalle_venta.vdetalle_cantidad) AS cant_prod, 
	venta.compro_id, 
	venta.usu_id, 
	usuario.usu_nombre,
		MAX(sl.nombre_su) as sucur
FROM
	venta
	INNER JOIN
	cliente
	ON 
		venta.cliente_id = cliente.cliente_id
	INNER JOIN
	comprobante
	ON 
		venta.compro_id = comprobante.compro_id
	INNER JOIN
	detalle_venta
	ON 
		venta.venta_id = detalle_venta.venta_id
	INNER JOIN
	usuario
	ON 
		venta.usu_id = usuario.usu_id
		JOIN sucursales sl ON venta.id_sucu = sl.id_sucu
		
		
		WHERE  venta_estado ='PAGADA'
		and (select MONTH(venta_fregistro))=MES 
		and YEAR(venta_fregistro)=ANIO
		and venta.id_sucu = p_sucursal
		GROUP BY venta.venta_id
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_REPORTE_VENTA_POR_ANIO_MES_USUARIO
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_REPORTE_VENTA_POR_ANIO_MES_USUARIO`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_REPORTE_VENTA_POR_ANIO_MES_USUARIO`(IN ID INT,IN ANIO VARCHAR(10), IN p_sucursal INT)
SELECT 
YEAR(v.venta_fregistro) as ano, 
    MONTH(v.venta_fregistro) as numero_mes, 
    MONTHNAME(MIN(v.venta_fregistro)) as mes, -- Aplicando MIN() como función de agregación
    COUNT(v.venta_total) as cant_ventas,
    SUM(v.venta_total) as total,
    v.usu_id, 
    MAX(usuario.usu_nombre) as usu_nombre, -- Aplicando MAX() como función de agregación
		MAX(sl.nombre_su) as sucur,
    CASE MONTH(MIN(v.venta_fregistro)) 
WHEN 1 THEN 'Enero'
WHEN 2 THEN  'Febrero'
WHEN 3 THEN 'Marzo' 
WHEN 4 THEN 'Abril' 
WHEN 5 THEN 'Mayo'
WHEN 6 THEN 'Junio'
WHEN 7 THEN 'Julio'
WHEN 8 THEN 'Agosto'
WHEN 9 THEN 'Septiembre'
WHEN 10 THEN 'Octubre'
WHEN 11 THEN 'Noviembre'
WHEN 12 THEN 'Diciembre'
 END mesnombre 
FROM venta v
INNER JOIN
	usuario
	ON 
		v.usu_id = usuario.usu_id
		JOIN sucursales sl ON v.id_sucu = sl.id_sucu
where v.venta_estado ='PAGADA' and YEAR(v.venta_fregistro) = ANIO and v.usu_id = ID AND v.id_sucu = p_sucursal
GROUP BY YEAR(v.venta_fregistro), MONTH(v.venta_fregistro), v.usu_id
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_REPORTE_VENTA_POR_ANIO_USUARIO
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_REPORTE_VENTA_POR_ANIO_USUARIO`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_REPORTE_VENTA_POR_ANIO_USUARIO`(IN ANIO VARCHAR(10), IN p_sucursal INT)
SELECT
	YEAR(venta_fregistro) as ano,
	venta.usu_id, 
	usuario.usu_nombre as nom_usuario, 
	count(venta_total) as cant_ventas,
	SUM(venta.venta_total) AS total,
	MAX(sl.nombre_su) as sucur
	
FROM
	venta
	INNER JOIN
	usuario
	ON 
		venta.usu_id = usuario.usu_id
		JOIN sucursales sl ON venta.id_sucu = sl.id_sucu
		where venta.venta_estado ='PAGADA'   and YEAR(venta_fregistro) = ANIO AND venta.id_sucu = p_sucursal
		GROUP BY YEAR(venta_fregistro), venta.usu_id, usuario.usu_nombre
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_REPORTE_VENTA_TOTAL
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_REPORTE_VENTA_TOTAL`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_REPORTE_VENTA_TOTAL`()
SELECT 
YEAR(venta_fregistro) as ano,
count(venta_total) as cant_venta_ano,
SUM(venta_total) as total_venta_ano
FROM venta
where venta_estado ='PAGADA' GROUP BY YEAR(venta_fregistro)
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_SELECT_PERMISOS
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_SELECT_PERMISOS`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_SELECT_PERMISOS`()
SELECT * from permiso
ORDER BY idpermiso
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_TRAER_DATA_GRUPO_XMENU
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_TRAER_DATA_GRUPO_XMENU`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_TRAER_DATA_GRUPO_XMENU`()
BEGIN
	SELECT
		grupo_id,
		men_grupo,
		grupo_icon 
	FROM
		grupos 
	WHERE
		estado = 1 
	 ORDER BY	grupo_id;

END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_TRAER_DATA_NOTAS_EDITAR
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_TRAER_DATA_NOTAS_EDITAR`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_TRAER_DATA_NOTAS_EDITAR`(IN p_idnota INT)
BEGIN

select nota_id,  descripcion, estado,  fecha, usu_id     from notas where nota_id =   p_idnota;


END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_TRAER_DATOS_MENU_X_ROLYMENU
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_TRAER_DATOS_MENU_X_ROLYMENU`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_TRAER_DATOS_MENU_X_ROLYMENU`(IN p_rol_id INT, IN p_menu_id INT)
BEGIN
	SELECT
		md.mend_id,
		m.men_id,
		m.men_vista,
		m.men_icon,
		m.men_ruta
	FROM
		td_menu_detalle md
		INNER JOIN menu m ON md.men_id = m.men_id 
	WHERE
		md.rol_id = p_rol_id 
		AND m.men_id = p_menu_id
		AND m.estado = 1 
	AND md.mend_permi = 'Si' ;
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_TRAER_IMEI_PROD
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_TRAER_IMEI_PROD`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_TRAER_IMEI_PROD`(IN ID_PR INT)
SELECT
	id_prod_imei,
	imei 
FROM
	producto_detalle 
WHERE
	producto_id = ID_PR and vendido = 'No'
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_UTILIDAD_X_VENTAS
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_UTILIDAD_X_VENTAS`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_UTILIDAD_X_VENTAS`(IN FEINI DATE, IN FEFIN DATE, IN P_IDSUCURSAL INT)
BEGIN
SELECT 
    vd.vdetalle_id,
    vd.venta_id,
    p.producto_nombre 	as producto,
    vd.vdetalle_cantidad as cantida_vendidos,
		CONCAT(vc.venta_comprobante, ': ', vc.venta_serie,'-', vc.venta_num_comprobante ) as comproventa,
		CONCAT(' Fecha: ', DATE_FORMAT(vd.vdetalle_fecha, '%d/%m/%Y')  ) as fechauti,
		vd.v_imei as imei,
    vd.vdetalle_precio AS precio_venta,
    p.producto_pcompra AS costo_unitario,
    ROUND((vd.vdetalle_precio - p.producto_pcompra) * vd.vdetalle_cantidad, 2) AS ganancia
FROM detalle_venta vd
JOIN producto p ON vd.producto_id = p.producto_id
JOIN venta vc ON vd.venta_id = vc.venta_id
WHERE vd.vdetalle_estado = 'VENDIDO' and vd.id_sucu = P_IDSUCURSAL AND vd.vdetalle_fecha BETWEEN FEINI AND FEFIN;
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_VALIDA_IMEI
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_VALIDA_IMEI`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_VALIDA_IMEI`(IN P_IMEI VARCHAR(100))
BEGIN
    DECLARE IMEI_EXISTE INT;

    -- Verificar si el IMEI existe en la tabla producto_detalle
    SELECT COUNT(*) INTO IMEI_EXISTE
    FROM producto_detalle
    WHERE imei = P_IMEI;

    -- Si no existe en producto_detalle, verificar en la tabla recepcion
    IF IMEI_EXISTE = 0 THEN
        SELECT COUNT(*) INTO IMEI_EXISTE
        FROM recep_equipo
        WHERE serie = P_IMEI;
    END IF;

    -- Devolver resultado
    IF IMEI_EXISTE > 0 THEN
        -- El IMEI existe en al menos una de las tablas
        SELECT 'El IMEI existe en la base de datos' AS mensaje;
    ELSE
        -- El IMEI no existe en ninguna de las tablas
        SELECT 'El IMEI no existe en la base de datos' AS mensaje;
    END IF;
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_VALIDA_IMEI2
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_VALIDA_IMEI2`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_VALIDA_IMEI2`(IN P_IMEI VARCHAR(100))
BEGIN
    DECLARE EXITO INT DEFAULT 0;

    -- Verificar si el IMEI existe en la tabla producto_detalle
    IF EXISTS (SELECT 1 FROM producto_detalle WHERE imei = P_IMEI) THEN
        SET EXITO = 1; -- IMEI encontrado en producto_detalle
    END IF;

    -- Si no se encontró en producto_detalle, verificar en la tabla recepcion
    IF EXITO = 0 AND EXISTS (SELECT 1 FROM recep_equipo WHERE serie = P_IMEI) THEN
        SET EXITO = 2; -- IMEI encontrado en recepcion
    END IF;

    -- Si no se encontró en ninguna tabla
    IF EXITO = 0 THEN
        SET EXITO = 3; -- IMEI no encontrado
    END IF;

    -- Devolver el resultado
    SELECT EXITO AS resultado;
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_VALIDA_IMEI_REINGRESO
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_VALIDA_IMEI_REINGRESO`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_VALIDA_IMEI_REINGRESO`(IN P_IMEI VARCHAR(100))
BEGIN
    DECLARE EXITO INT DEFAULT 0;

    -- Verificar si el IMEI existe en la tabla producto_detalle
    IF EXISTS (SELECT 1 FROM producto_detalle WHERE imei  = P_IMEI and vendido = 'No') THEN
        SET EXITO = 1; -- IMEI encontrado en el detalle de una venta - NO VENDIDO
    END IF;

    -- Si no se encontró en producto_detalle, verificar en la tabla recepcion
    IF EXITO = 0 AND EXISTS (SELECT 1 FROM producto_detalle WHERE imei = P_IMEI and vendido = 'Si') THEN
        SET EXITO = 2; -- IMEI encontrado en producto detalle  VENDIDO
    END IF;
		
		 -- Si no se encontró en producto_detalle, verificar en la tabla recepcion
    IF EXITO = 0 AND EXISTS (SELECT 1 FROM detalle_venta WHERE v_imei  = P_IMEI and vdetalle_estado = 'VENDIDO') THEN
        SET EXITO = 4; -- IMEI encontrado en producto detalle  VENDIDO
    END IF;

    -- Si no se encontró en ninguna tabla
    IF EXITO = 0 THEN
        SET EXITO = 3; -- IMEI no encontrado
    END IF;

    -- Devolver el resultado
    SELECT EXITO AS resultado;
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_VERIFICAR_USUARIO
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_VERIFICAR_USUARIO`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_VERIFICAR_USUARIO`(IN USUARIO VARCHAR(250))
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
	usuario u
	INNER JOIN rol r ON u.rol_id = r.rol_id
	INNER JOIN sucursales s ON s.id_sucu = u.id_sucu
where usu_nombre = BINARY USUARIO
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_VER_DETALLE_COMPRAS_X_PROVEE
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_VER_DETALLE_COMPRAS_X_PROVEE`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_VER_DETALLE_COMPRAS_X_PROVEE`(IN p_proveeid INT, IN FINICIO DATE, IN FFIN DATE)
BEGIN

SELECT
	p.producto_codigo, 
	p.producto_nombre, 
	p.producto_pcompra, 
	p.producto_pventa, 
	p.producto_fregistro, 
	p.producto_stock_inicial, 
	p.cliente_id, 
	c.cliente_nombres
FROM
	producto AS p
	INNER JOIN
	cliente AS c
	ON 
		p.cliente_id = c.cliente_id
		WHERE p.cliente_id = p_proveeid and producto_fregistro BETWEEN FINICIO AND FFIN;
		
 END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_VER_DETALLE_PRODUCTO
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_VER_DETALLE_PRODUCTO`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_VER_DETALLE_PRODUCTO`(IN ID_PRO INT)
SELECT
	imei,
	vendido
FROM
	producto_detalle 
WHERE
	producto_id = ID_PRO and vendido = 'No'
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_VER_DETALLE_RECEPCION
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_VER_DETALLE_RECEPCION`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_VER_DETALLE_RECEPCION`(IN ID_REC INT)
SELECT
id_equipo,
	equipo,
	serie,
	falla,
	monto,
	abono,
	diagnostico,
	rece_id
FROM
	recep_equipo 
WHERE
	rece_id = ID_REC
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_VER_DETALLE_VENTA
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_VER_DETALLE_VENTA`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_VER_DETALLE_VENTA`(IN ID_VENTA INT)
SELECT
    detalle_venta.vdetalle_id, 
    detalle_venta.venta_id, 
    detalle_venta.producto_id, 
    CASE
        WHEN producto.pro_imei = 'si' THEN CONCAT(producto.producto_nombre, ' - IMEI (', detalle_venta.v_imei,  ')')
        ELSE producto.producto_nombre
    END AS producto_nombre,
    detalle_venta.vdetalle_precio,
    detalle_venta.vdetalle_cantidad,
    (detalle_venta.vdetalle_precio * detalle_venta.vdetalle_cantidad -  detalle_venta.vdetalle_descuento ) AS subtotal,
    detalle_venta.vdetalle_descuento,
    detalle_venta.id_pro_imei as id_imei

FROM
    detalle_venta
INNER JOIN
    venta ON detalle_venta.venta_id = venta.venta_id
INNER JOIN
    producto ON detalle_venta.producto_id = producto.producto_id
		where detalle_venta.venta_id = ID_VENTA
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_VER_IMEI_VENDIDOS
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_VER_IMEI_VENDIDOS`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_VER_IMEI_VENDIDOS`(IN PRODID INT)
select pd.imei, pd.vendido from producto_detalle pd WHERE pd.producto_id = PRODID
;;
delimiter ;

-- ----------------------------
-- Triggers structure for table caja
-- ----------------------------
DROP TRIGGER IF EXISTS `VENTA_CERRAR`;
delimiter ;;
CREATE TRIGGER `VENTA_CERRAR` AFTER UPDATE ON `caja` FOR EACH ROW BEGIN

UPDATE venta SET
estado_caja= 'CERRADO'
where estado_caja='ABIERTO' and venta_estado = 'PAGADA';
END
;;
delimiter ;

-- ----------------------------
-- Triggers structure for table caja
-- ----------------------------
DROP TRIGGER IF EXISTS `GASTO_CERRAR`;
delimiter ;;
CREATE TRIGGER `GASTO_CERRAR` AFTER UPDATE ON `caja` FOR EACH ROW BEGIN

UPDATE gastos SET
estado_caja= 'CERRADO'
where estado_caja='ABIERTO';
END
;;
delimiter ;

-- ----------------------------
-- Triggers structure for table caja
-- ----------------------------
DROP TRIGGER IF EXISTS `SERVICIO_CERRAR`;
delimiter ;;
CREATE TRIGGER `SERVICIO_CERRAR` AFTER UPDATE ON `caja` FOR EACH ROW BEGIN

UPDATE servicio SET
estado_caja= 'CERRADO'
where estado_caja='ABIERTO';
END
;;
delimiter ;

-- ----------------------------
-- Triggers structure for table caja
-- ----------------------------
DROP TRIGGER IF EXISTS `venta_credito`;
delimiter ;;
CREATE TRIGGER `venta_credito` AFTER UPDATE ON `caja` FOR EACH ROW BEGIN

UPDATE venta_credito SET
estado_caja= 'CERRADO'
where estado_caja='ABIERTO' ;
END
;;
delimiter ;

-- ----------------------------
-- Triggers structure for table detalle_venta
-- ----------------------------
DROP TRIGGER IF EXISTS `TR_STOCK_PRODUCTO`;
delimiter ;;
CREATE TRIGGER `TR_STOCK_PRODUCTO` BEFORE INSERT ON `detalle_venta` FOR EACH ROW BEGIN
DECLARE STOCKACTUAL INT;
SET @STOCKACTUAL:=(SELECT producto_stock FROM producto WHERE producto_id=new.producto_id);
UPDATE producto SET
producto_stock=@STOCKACTUAL-new.vdetalle_cantidad
where producto_id=new.producto_id;
END
;;
delimiter ;

-- ----------------------------
-- Triggers structure for table pedido_n
-- ----------------------------
DROP TRIGGER IF EXISTS `insertar_bitacor`;
delimiter ;;
CREATE TRIGGER `insertar_bitacor` AFTER INSERT ON `pedido_n` FOR EACH ROW BEGIN

INSERT INTO pedido_bitacora (pedido_id,  fecha_segui, total_segui, estado_segui, pedido_correlativo)
    VALUES (NEW.pedido_id, NEW.pedido_fecha, NEW.pedido_total, NEW.pedido_estado, NEW.pedido_correlativo);



END
;;
delimiter ;

-- ----------------------------
-- Triggers structure for table producto
-- ----------------------------
DROP TRIGGER IF EXISTS `Generar_codigo`;
delimiter ;;
CREATE TRIGGER `Generar_codigo` BEFORE INSERT ON `producto` FOR EACH ROW begin
	declare siguiente_codigo int;
    set siguiente_codigo = (Select ifnull(max(convert(producto_id, signed integer)), 0) from producto) + 1;
    set new.producto_codigo = concat('P', LPAD( siguiente_codigo, 4, '0'));
end
;;
delimiter ;

-- ----------------------------
-- Triggers structure for table producto
-- ----------------------------
DROP TRIGGER IF EXISTS `inser_kardex`;
delimiter ;;
CREATE TRIGGER `inser_kardex` AFTER INSERT ON `producto` FOR EACH ROW BEGIN

	insert into kardex (kardex_fecha,  kardex_tipo,   kardex_ingreso,   kardex_p_ingreso,   kardex_total,   producto_id, producto_nombre,  producto_codigo,  kardex_precio_general) 
	VALUES       (NEW.producto_fregistro, 'INICIAL',  NEW.producto_stock,  NEW.producto_pcompra, NEW.producto_stock,  NEW.producto_id, NEW.producto_nombre, NEW.producto_codigo,    NEW.producto_pcompra );



end
;;
delimiter ;

-- ----------------------------
-- Triggers structure for table producto_detalle
-- ----------------------------
DROP TRIGGER IF EXISTS `INSERT_IMEI`;
delimiter ;;
CREATE TRIGGER `INSERT_IMEI` AFTER INSERT ON `producto_detalle` FOR EACH ROW BEGIN

-- INSERT INTO kardex( producto_id, imei) VALUES( NEW.producto_id, NEW.imei)

-- UPDATE kardex SET 
-- imei = NEW.imei
-- WHERE producto_id = NEW.producto_id and kardex_tipo = 'INICIAL';



END
;;
delimiter ;

-- ----------------------------
-- Triggers structure for table servicio
-- ----------------------------
DROP TRIGGER IF EXISTS `TR_ELIMINAR`;
delimiter ;;
CREATE TRIGGER `TR_ELIMINAR` BEFORE DELETE ON `servicio` FOR EACH ROW UPDATE recepcion SET
rece_estado = "EN REPARACION"
WHERE rece_id=old.rece_id
;;
delimiter ;

-- ----------------------------
-- Triggers structure for table stock
-- ----------------------------
DROP TRIGGER IF EXISTS `insert_automa_movimi`;
delimiter ;;
CREATE TRIGGER `insert_automa_movimi` AFTER INSERT ON `stock` FOR EACH ROW BEGIN
  /*  INSERT INTO movimientos (
        producto_id,
        id_almacen,
        cantidad,
        tipo_movimiento,
        referencia_id,
        fecha_reg,
        usuario_id,
        precio_unitario,
        observacion
    ) VALUES (
        NEW.producto_id,
        NEW.id_almacen,
        NEW.cantidad_s,
        'INGRESO',
        NEW.producto_id,
        NEW.fecha_reg,
        1, -- aquí puedes poner NEW.usuario_id si lo tienes
        NEW.precio_uni,
        CONCAT('Movimiento automático desde stock: ', NEW.tipo_s)
    );
		*/
END
;;
delimiter ;

-- ----------------------------
-- Triggers structure for table venta
-- ----------------------------
DROP TRIGGER IF EXISTS `tr_numero_compro`;
delimiter ;;
CREATE TRIGGER `tr_numero_compro` BEFORE INSERT ON `venta` FOR EACH ROW BEGIN
DECLARE NUMCOMPRO INT;

    -- Obtener el último número de comprobante
    SET @NUMCOMPRO := (SELECT compro_numero FROM comprobante WHERE compro_id = NEW.compro_id);

    -- Incrementar el número
    SET @NUMCOMPRO := @NUMCOMPRO + 1;

    -- Actualizar el número en la tabla comprobante con ceros a la izquierda (suponiendo 5 dígitos)
    UPDATE comprobante 
    SET compro_numero = LPAD(@NUMCOMPRO, CHAR_LENGTH(compro_numero), '0')
    WHERE compro_id = NEW.compro_id;
END
;;
delimiter ;

SET FOREIGN_KEY_CHECKS = 1;
