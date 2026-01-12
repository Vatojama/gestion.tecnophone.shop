<?php
require_once __DIR__ . '/model/modelo_conexion.php';

try {
    $pdo = conexionBD::conexionPDO();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo "Starting Critical Restoration (V11) - Fixing JSON Errors in Reports and Sales...<br>";

    // --- 1. GASTOS / FINANZAS ---
    echo "Restoring Gasto Procedures...<br>";

    $pdo->exec("DROP PROCEDURE IF EXISTS SP_LISTAR_ANIO_GASTO");
    $pdo->exec("CREATE PROCEDURE `SP_LISTAR_ANIO_GASTO`()
    BEGIN
    SELECT YEAR(gastos_fregistro) as anio FROM gastos
    where gastos_estado='ACTIVO' 
    GROUP BY YEAR(gastos_fregistro);
    END");

    $pdo->exec("DROP PROCEDURE IF EXISTS SP_REPORTE_GASTO_ANUAL");
    $pdo->exec("CREATE PROCEDURE `SP_REPORTE_GASTO_ANUAL`(IN ANIO VARCHAR(10), IN p_sucursal INT)
    BEGIN
    SELECT  
    YEAR(a.gastos_fregistro) as ano,
    count(a.gastos_monto) as cant_gastos,
    MONTH(a.gastos_fregistro) as numero_mes, 
    MONTHname(MIN(a.gastos_fregistro)) as mes, 
    MAX(sl.nombre_su) as sucur,
    SUM(a.gastos_monto) as gasto,
    case month(MIN(a.gastos_fregistro)) 
    WHEN 1 THEN 'Enero'
    WHEN 2 THEN 'Febrero'
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
    GROUP BY YEAR(a.gastos_fregistro), month(a.gastos_fregistro);
    END");

    $pdo->exec("DROP PROCEDURE IF EXISTS SP_REPORTE_GASTO_MES");
    $pdo->exec("CREATE PROCEDURE `SP_REPORTE_GASTO_MES`(IN MES INT, IN p_sucursal INT)
    BEGIN
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
    ORDER BY gastos_id DESC;
    END");

    $pdo->exec("DROP PROCEDURE IF EXISTS SP_REPORTE_GASTO_TOTAL_ANUAL");
    $pdo->exec("CREATE PROCEDURE `SP_REPORTE_GASTO_TOTAL_ANUAL`()
    BEGIN
    SELECT 
    YEAR(gastos_fregistro) as ano,
    SUM(gastos_monto) as total_gasto_ano 
    FROM gastos
    where gastos_estado='ACTIVO' GROUP BY YEAR(gastos_fregistro);
    END");


    // --- 2. VENTAS / REPORTES VENTAS ---
    echo "Restoring Venta Procedures...<br>";

    $pdo->exec("DROP PROCEDURE IF EXISTS SP_LISTAR_VENTA_ADMIN");
    $pdo->exec("CREATE PROCEDURE `SP_LISTAR_VENTA_ADMIN`(IN FINICIO DATE, IN FFIN DATE, IN p_sucuid INT, IN p_almaid INT, IN p_rolid INT)
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
        (venta.venta_total - venta.venta_impuesto + venta.venta_descuento) as subtotal2,
        venta.monto_efectivo, 
        venta.cod_operacion, 
        venta.monto_tarjeta,
        (venta.venta_total + venta.venta_impuesto + venta.venta_descuento) as subtotal3,
        venta.venta_descuento,
        cliente.cliente_celular,
        venta.caja_id,
        s.nombre_su
    FROM
        venta
        INNER JOIN cliente ON venta.cliente_id = cliente.cliente_id
        INNER JOIN comprobante ON venta.compro_id = comprobante.compro_id
        INNER JOIN usuario ON venta.usu_id = usuario.usu_id
        INNER JOIN forma_pago ON venta.fpago_id = forma_pago.fpago_id
        INNER JOIN sucursales s ON venta.id_sucu = s.id_sucu
    WHERE venta.venta_fregistro BETWEEN FINICIO AND FFIN 
      AND (p_rolid = 1 OR venta.id_sucu = p_sucuid)
    ORDER BY venta_id DESC;
    END");

    $pdo->exec("DROP PROCEDURE IF EXISTS SP_REPORTE_VENTA_MES");
    $pdo->exec("CREATE PROCEDURE `SP_REPORTE_VENTA_MES`(IN MES VARCHAR(5),IN ANIO VARCHAR(10), IN p_sucursal INT)
    BEGIN
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
        INNER JOIN cliente ON venta.cliente_id = cliente.cliente_id
        INNER JOIN comprobante ON venta.compro_id = comprobante.compro_id
        INNER JOIN detalle_venta ON venta.venta_id = detalle_venta.venta_id
        INNER JOIN usuario ON venta.usu_id = usuario.usu_id
        JOIN sucursales sl ON venta.id_sucu = sl.id_sucu
    WHERE venta_estado ='PAGADA'
        and (select MONTH(venta_fregistro))=MES 
        and YEAR(venta_fregistro)=ANIO
        and venta.id_sucu = p_sucursal
    GROUP BY venta.venta_id;
    END");

    $pdo->exec("DROP PROCEDURE IF EXISTS SP_REPORTE_VENTA_TOTAL");
    $pdo->exec("CREATE PROCEDURE `SP_REPORTE_VENTA_TOTAL`()
    BEGIN
    SELECT 
    YEAR(venta_fregistro) as ano,
    count(venta_total) as cant_venta_ano,
    SUM(venta_total) as total_venta_ano
    FROM venta
    where venta_estado ='PAGADA' GROUP BY YEAR(venta_fregistro);
    END");

    $pdo->exec("DROP PROCEDURE IF EXISTS SP_REPORTE_VENTA_ANIO");
    $pdo->exec("CREATE PROCEDURE `SP_REPORTE_VENTA_ANIO`(IN ANIO VARCHAR(10), IN p_sucursal INT)
    BEGIN
    SELECT 
    YEAR(v.venta_fregistro) as ano, 
    MONTH(v.venta_fregistro) as numero_mes, 
    MONTHname(MIN(v.venta_fregistro)) as mes,
    count(v.venta_total) as cant_ventas,
    SUM(v.venta_total) as total,
    MAX(sl.nombre_su) as sucur,
    case month(MIN(v.venta_fregistro)) 
    WHEN 1 THEN 'Enero'
    WHEN 2 THEN 'Febrero'
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
    GROUP BY YEAR(v.venta_fregistro), month(v.venta_fregistro);
    END");

    $pdo->exec("DROP PROCEDURE IF EXISTS SP_REPORTE_VENTA_DEL_DIA");
    $pdo->exec("CREATE PROCEDURE `SP_REPORTE_VENTA_DEL_DIA`(IN FINICIO DATE, IN FFIN DATE, IN p_sucursal INT)
    BEGIN
    SELECT
        MAX(detalle_venta.vdetalle_id) as vdetalle_id, 
        detalle_venta.venta_id, 
        MAX(venta.venta_fregistro) AS fecha,
        MAX(venta.venta_comprobante) as tipo_comprobante,
        CONCAT_WS(' - ', MAX(venta.venta_serie), MAX(venta.venta_num_comprobante)) AS comprobante,
        MAX(cliente.cliente_nombres) as cliente,
        MAX(venta.venta_total - venta.venta_impuesto) as base_imp,
        MAX(venta.venta_impuesto) as igv,
        MAX(venta.venta_total) as total,
        MAX(usuario.usu_nombre) as usuario,
        MAX(sl.nombre_su) as sucur
    FROM
        detalle_venta
        INNER JOIN venta ON detalle_venta.venta_id = venta.venta_id
        INNER JOIN producto ON detalle_venta.producto_id = producto.producto_id
        INNER JOIN cliente ON venta.cliente_id = cliente.cliente_id
        INNER JOIN usuario ON venta.usu_id = usuario.usu_id
        JOIN sucursales sl ON venta.id_sucu = sl.id_sucu
    WHERE venta.venta_estado = 'PAGADA' and venta.venta_fregistro BETWEEN FINICIO AND FFIN and venta.id_sucu = p_sucursal
    GROUP BY detalle_venta.venta_id;
    END");

    $pdo->exec("DROP PROCEDURE IF EXISTS SP_REPORTE_VENTA_POR_ANIO_USUARIO");
    $pdo->exec("CREATE PROCEDURE `SP_REPORTE_VENTA_POR_ANIO_USUARIO`(IN ANIO VARCHAR(10), IN p_sucursal INT)
    BEGIN
    SELECT
        YEAR(venta_fregistro) as ano,
        venta.usu_id, 
        usuario.usu_nombre as nom_usuario, 
        count(venta_total) as cant_ventas,
        SUM(venta.venta_total) AS total,
        MAX(sl.nombre_su) as sucur
    FROM
        venta
        INNER JOIN usuario ON venta.usu_id = usuario.usu_id
        JOIN sucursales sl ON venta.id_sucu = sl.id_sucu
    WHERE venta.venta_estado ='PAGADA' and YEAR(venta_fregistro) = ANIO AND venta.id_sucu = p_sucursal
    GROUP BY YEAR(venta_fregistro), venta.usu_id, usuario.usu_nombre;
    END");

    $pdo->exec("DROP PROCEDURE IF EXISTS SP_LISTAR_SELECT_ANIO_VENTA");
    $pdo->exec("CREATE PROCEDURE `SP_LISTAR_SELECT_ANIO_VENTA`()
    BEGIN
    SELECT YEAR(venta_fregistro) as anio FROM venta
    where venta_estado <> 'ANULADA' 
    GROUP BY YEAR(venta_fregistro);
    END");

    $pdo->exec("DROP PROCEDURE IF EXISTS SP_PIVOT_VENTAS");
    $pdo->exec("CREATE PROCEDURE `SP_PIVOT_VENTAS`(IN p_sucursal INT)
    BEGIN
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
    GROUP BY YEAR(venta_fregistro);
    END");


    // --- 3. OTROS (SISTEMA, SERVICIOS, CAJA) ---
    echo "Restoring Other Procedures...<br>";

    $pdo->exec("DROP PROCEDURE IF EXISTS SP_LISTAR_ANIO_SERVICIO");
    $pdo->exec("CREATE PROCEDURE `SP_LISTAR_ANIO_SERVICIO`()
    BEGIN
    SELECT YEAR(servicio_fregistro) as anio FROM servicio
    GROUP BY YEAR(servicio_fregistro);
    END");

    $pdo->exec("DROP PROCEDURE IF EXISTS SP_REPORTE_LISTAR_TOTAL_VENTAS_CAJA");
    $pdo->exec("CREATE PROCEDURE `SP_REPORTE_LISTAR_TOTAL_VENTAS_CAJA`(IN p_idsucusal INT)
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
            v_monto_inicial AS monto_inicial_caja,
            (SELECT COUNT(*) FROM venta WHERE estado_caja = 'ABIERTO' AND venta_estado = 'PAGADA' AND id_sucu = p_idsucusal) AS cant_ventas,
            (SELECT IFNULL(SUM(venta_total), 0) FROM venta WHERE estado_caja = 'ABIERTO' AND venta_estado = 'PAGADA' AND id_sucu = p_idsucusal) AS suma_ventas,
            (SELECT COUNT(*) FROM gastos WHERE estado_caja = 'ABIERTO' AND gastos_estado = 'ACTIVO' AND tipo_mov = 'EGRESO' AND id_sucu = p_idsucusal AND caja_id = v_idcaja) AS cant_egreso,
            (SELECT IFNULL(SUM(gastos_monto), 0) FROM gastos WHERE estado_caja = 'ABIERTO' AND gastos_estado = 'ACTIVO' AND tipo_mov = 'EGRESO' AND id_sucu = p_idsucusal AND caja_id = v_idcaja) AS suma_egreso,
            v_estado_caja AS estado,
            v_fecha_apertura AS fecha_apertura,
            (SELECT COUNT(*) FROM servicio WHERE servicio_estado = 'ACTIVO' AND estado_caja = 'ABIERTO' AND id_sucu = p_idsucusal) AS cant_servicio,
            (SELECT IFNULL(SUM(servicio_monto), 0) FROM servicio WHERE servicio_estado = 'ACTIVO' AND estado_caja = 'ABIERTO' AND id_sucu = p_idsucusal) AS suma_servicio,
            (SELECT COUNT(*) FROM gastos WHERE estado_caja = 'ABIERTO' AND gastos_estado = 'ACTIVO' AND tipo_mov = 'INGRESO' AND id_sucu = p_idsucusal AND caja_id = v_idcaja) AS cant_ingreso,
            (SELECT IFNULL(SUM(gastos_monto), 0) FROM gastos WHERE estado_caja = 'ABIERTO' AND gastos_estado = 'ACTIVO' AND tipo_mov = 'INGRESO' AND id_sucu = p_idsucusal AND caja_id = v_idcaja) AS suma_ingreso,
            (SELECT confi_moneda FROM configuracion LIMIT 1) AS moneda,
            v_idcaja AS idcaja,
            (SELECT url_sistema FROM configuracion LIMIT 1) AS url_sistema,
            (SELECT cod_pais FROM configuracion LIMIT 1) AS cod_sistema,
            (SELECT IFNULL(SUM(monto_abono),0) from venta_credito where estado_caja = 'ABIERTO' AND id_sucu = p_idsucusal) as abonos;
    END");

    $pdo->exec("DROP PROCEDURE IF EXISTS SP_LISTAR_DATA_CONFIGURACION");
    $pdo->exec("CREATE PROCEDURE `SP_LISTAR_DATA_CONFIGURACION`()
    BEGIN
    SELECT
        c.confi_moneda, 
        c.confi_tipo_igv, 
        c.confi_igv, 
        c.confi_moneda1, 
        c.confi_moneda2,
        c.confi_nombre_sistema,
        c.config_foto
    FROM
        configuracion AS c;
    END");

    echo "Final Massive Restoration V11 completed successfully. All modules should be working now.<br>";

} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "<br>";
}
