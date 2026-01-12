<?php
require_once __DIR__ . '/model/modelo_conexion.php';

try {
    $pdo = conexionBD::conexionPDO();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo "Starting Massive Restoration (V10) - Correcting '1 1 1' Views and broken List SPs...<br>";

    // --- 1. VIEWS RESTORATION ---
    echo "Restoring Real Views (Overwriting temporary '1 1 1' versions)...<br>";

    $pdo->exec("DROP VIEW IF EXISTS `view_listar_recepcion` ");
    $pdo->exec("CREATE VIEW `view_listar_recepcion` AS select `recepcion`.`rece_id` AS `rece_id`,concat(' R-000',`recepcion`.`rece_id`) AS `referencia`,`recepcion`.`cliente_id` AS `cliente_id`,`cliente`.`cliente_nombres` AS `cliente_nombres`,concat_ws(' - ',`recepcion`.`rece_equipo`,`recepcion`.`rece_concepto`) AS `motivo`,`recepcion`.`rece_caracteristicas` AS `rece_caracteristicas`,`recepcion`.`motivo_id` AS `motivo_id`,`motivo`.`motivo_descripcion` AS `motivo_descripcion`,`recepcion`.`rece_monto` AS `rece_monto`,`recepcion`.`rece_fregistro` AS `rece_fregistro`,`recepcion`.`rece_estado` AS `rece_estado`,`recepcion`.`rece_estatus` AS `rece_estatus`,`recepcion`.`rece_equipo` AS `rece_equipo`,`recepcion`.`rece_concepto` AS `rece_concepto`,`recepcion`.`rece_adelanto` AS `rece_adelanto`,`recepcion`.`rece_debe` AS `rece_debe`,`recepcion`.`rece_accesorios` AS `rece_accesorios`,`recepcion`.`rece_fentrega` AS `rece_fentrega`,`recepcion`.`marca_id` AS `marca_id`,`marca`.`marca_descripcion` AS `marca_descripcion`,`recepcion`.`rece_serie` AS `rece_serie`,`recepcion`.`enciende` AS `enciende`,`recepcion`.`tactil` AS `tactil`,`recepcion`.`imagen` AS `imagen`,`recepcion`.`vibra` AS `vibra`,`recepcion`.`cobertura` AS `cobertura`,`recepcion`.`sensor` AS `sensor`,`recepcion`.`carga` AS `carga`,`recepcion`.`bluetoo` AS `bluetoo`,`recepcion`.`wifi` AS `wifi`,`recepcion`.`huella` AS `huella`,`recepcion`.`home` AS `home`,`recepcion`.`lateral` AS `lateral`,`recepcion`.`camara` AS `camara`,`recepcion`.`bateria` AS `bateria`,`recepcion`.`auricular` AS `auricular`,`recepcion`.`micro` AS `micro`,`recepcion`.`face` AS `face`,`recepcion`.`tornillo` AS `tornillo`,`recepcion`.`rece_cod` AS `rece_cod`,`cliente`.`cliente_celular` AS `cliente_celular`,`recepcion`.`tecnico` AS `tecnico`,`recepcion`.`usuario_registrador` AS `usuario_registrador` from (((`recepcion` join `cliente` on((`recepcion`.`cliente_id` = `cliente`.`cliente_id`))) join `motivo` on((`recepcion`.`motivo_id` = `motivo`.`motivo_id`))) join `marca` on((`recepcion`.`marca_id` = `marca`.`marca_id`)))");

    $pdo->exec("DROP VIEW IF EXISTS `view_listar_recepcion_en_servicio` ");
    $pdo->exec("CREATE VIEW `view_listar_recepcion_en_servicio` AS select `recepcion`.`rece_id` AS `rece_id`,concat(' R-000',`recepcion`.`rece_id`) AS `referencia`,`cliente`.`cliente_nombres` AS `cliente`,`recepcion`.`rece_caracteristicas` AS `modelo`,concat_ws(' - ',`recepcion`.`rece_equipo`,`recepcion`.`rece_concepto`) AS `concepto`,`recepcion`.`rece_monto` AS `monto`,`recepcion`.`rece_fregistro` AS `fecha`,`recepcion`.`rece_estado` AS `entrega`,`recepcion`.`rece_adelanto` AS `adelanto`,`recepcion`.`rece_debe` AS `debe`,`recepcion`.`rece_fentrega` AS `rece_fentrega`,`recepcion`.`diagnostico_tecnico` AS `diagnostico_tecn`,`usu`.`usu_nombre` AS `nombre_tecnico`,`recepcion`.`tecnico` AS `idtecnico`,`recepcion`.`id_sucu` AS `id_sucu` from ((`recepcion` join `cliente` on((`recepcion`.`cliente_id` = `cliente`.`cliente_id`))) join `usuario` `usu` on((`recepcion`.`tecnico` = `usu`.`usu_id`))) where ((`recepcion`.`rece_estado` in ('REPARADO','NO REPARADO')) and (`recepcion`.`rece_estatus` = 'ACTIVO'))");

    $pdo->exec("DROP VIEW IF EXISTS `view_listar_servicio_rece` ");
    $pdo->exec("CREATE VIEW `view_listar_servicio_rece` AS select `servicio`.`servicio_id` AS `servicio_id`,`servicio`.`rece_id` AS `rece_id`,`recepcion`.`cliente_id` AS `cliente_id`,`cliente`.`cliente_nombres` AS `cliente_nombres`,concat_ws(' - ',`recepcion`.`rece_equipo`,`recepcion`.`rece_concepto`) AS `concepto`,`recepcion`.`rece_monto` AS `rece_monto`,`recepcion`.`rece_estado` AS `rece_estado`,`servicio`.`servicio_monto` AS `servicio_monto`,`servicio`.`servicio_concepto` AS `servicio_concepto`,`servicio`.`servicio_responsable` AS `servicio_responsable`,`servicio`.`servicio_comentario` AS `servicio_comentario`,`servicio`.`servicio_entrega` AS `servicio_entrega`,`servicio`.`servicio_fregistro` AS `servicio_fregistro`,`servicio`.`servicio_estado` AS `servicio_estado` from ((`servicio` join `recepcion` on((`servicio`.`rece_id` = `recepcion`.`rece_id`))) join `cliente` on((`recepcion`.`cliente_id` = `cliente`.`cliente_id`)))");

    $pdo->exec("DROP VIEW IF EXISTS `view_listar_usuario` ");
    $pdo->exec("CREATE VIEW `view_listar_usuario` AS select `u`.`usu_id` AS `usu_id`,`u`.`usu_nombre` AS `usu_nombre`,`u`.`usu_contrasena` AS `usu_contrasena`,`u`.`rol_id` AS `rol_id`,`u`.`usu_estado` AS `usu_estado`,`u`.`usu_email` AS `usu_email`,`u`.`usu_foto` AS `usu_foto`,`r`.`rol_nombre` AS `rol_nombre`,`u`.`id_sucu` AS `id_sucu`,`s`.`nombre_su` AS `nombre_su` from ((`usuario` `u` join `rol` `r` on((`u`.`rol_id` = `r`.`rol_id`))) join `sucursales` `s` on((`u`.`id_sucu` = `s`.`id_sucu`)))");


    // --- 2. STORED PROCEDURES RESTORATION ---
    echo "Restoring Critical Stored Procedures (Listings)...<br>";

    // SP_LISTAR_VENTA_FILTRO
    $pdo->exec("DROP PROCEDURE IF EXISTS SP_LISTAR_VENTA_FILTRO");
    $pdo->exec("CREATE PROCEDURE `SP_LISTAR_VENTA_FILTRO`(IN FINICIO DATE, IN FFIN DATE, IN IDUSUAR INT)
    BEGIN
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
        INNER JOIN cliente ON venta.cliente_id = cliente.cliente_id
        INNER JOIN comprobante ON venta.compro_id = comprobante.compro_id
        INNER JOIN usuario ON venta.usu_id = usuario.usu_id
        INNER JOIN forma_pago ON venta.fpago_id = forma_pago.fpago_id
    WHERE venta.venta_fregistro BETWEEN FINICIO AND FFIN AND venta.usu_id = IDUSUAR
    ORDER BY venta_id DESC;
    END");

    // SP_LISTAR_SERVICIO
    $pdo->exec("DROP PROCEDURE IF EXISTS SP_LISTAR_SERVICIO");
    $pdo->exec("CREATE PROCEDURE `SP_LISTAR_SERVICIO`(IN FINICIO DATE, IN FFIN DATE, IN TECNIUSU INT, IN p_idsucursal INT, IN p_rolid INT)
    BEGIN
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
        INNER JOIN recepcion ON servicio.rece_id = recepcion.rece_id
        INNER JOIN cliente ON recepcion.cliente_id = cliente.cliente_id 
        INNER JOIN forma_pago ON servicio.fpago_id = forma_pago.fpago_id
        JOIN sucursales ON servicio.id_sucu = sucursales.id_sucu
    WHERE servicio.servicio_fregistro BETWEEN FINICIO and FFIN 
      AND (p_rolid = 1 OR (servicio.tecnico_servi = TECNIUSU AND servicio.id_sucu = p_idsucursal));
    END");

    // SP_LISTAR_UNIDAD_MEDIDA
    $pdo->exec("DROP PROCEDURE IF EXISTS SP_LISTAR_UNIDAD_MEDIDA");
    $pdo->exec("CREATE PROCEDURE `SP_LISTAR_UNIDAD_MEDIDA`()
    BEGIN
    SELECT
        unidadmedida.unidad_id,
        unidadmedida.unidad_descripcion, 
        unidadmedida.unidad_abrevia, 
        unidadmedida.unidad_estado
    FROM
        unidadmedida
    WHERE
        unidadmedida.unidad_estado = 'ACTIVO' OR
        unidadmedida.unidad_estado = 'INACTIVO';
    END");

    // SP_LISTAR_USUARIO
    $pdo->exec("DROP PROCEDURE IF EXISTS SP_LISTAR_USUARIO");
    $pdo->exec("CREATE PROCEDURE `SP_LISTAR_USUARIO`()
    BEGIN
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
        INNER JOIN rol ON usuario.rol_id = rol.rol_id
    WHERE usuario.usu_id;
    END");

    // SP_REPORTE_CAJA_CHICA
    $pdo->exec("DROP PROCEDURE IF EXISTS SP_REPORTE_CAJA_CHICA");
    $pdo->exec("CREATE PROCEDURE `SP_REPORTE_CAJA_CHICA`(IN FINICIO DATE, IN FFIN DATE, IN p_idsucursal INT, IN p_rolid INT)
    BEGIN
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
        c.caja_monto_total, 
        c.caja_estado,
        c.id_sucu,
        s.nombre_su
    FROM
        caja c INNER JOIN sucursales s ON c.id_sucu = s.id_sucu
    WHERE (p_rolid = 1 OR c.id_sucu = p_idsucursal) AND c.caja_fecha_ap BETWEEN FINICIO AND FFIN 
    ORDER BY c.caja_id DESC;
    END");

    echo "Massive Restoration V10 completed successfully. Please refresh the Dashboard.<br>";

} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "<br>";
}
