<?php
header('Content-Type: text/html; charset=utf-8');
require_once dirname(__FILE__) . '/model/modelo_conexion.php';

echo "<h1>🛠️ Restaurador Maestro de Procedimientos Almacenados (Recepción + Test)</h1>";

try {
    $c = conexionBD::conexionPDO();

    // --- 1. REGISTRO DE EQUIPO ---
    $sql1 = "DROP PROCEDURE IF EXISTS SP_REGISTRAR_DETALLE_RECE_EQUIPO;
    CREATE PROCEDURE SP_REGISTRAR_DETALLE_RECE_EQUIPO(
        IN ID_RECE INT,
        IN EQUIPO VARCHAR(255),
        IN SERIE VARCHAR(255),
        IN FALLA VARCHAR(255),
        IN MONTO DECIMAL(10,2),
        IN ABONO DECIMAL(10,2)
    )
    BEGIN
        INSERT INTO recep_equipo(rece_id, equipo, serie, falla, monto, abono, fecha)
        VALUES(ID_RECE, EQUIPO, SERIE, FALLA, MONTO, ABONO, CURDATE());
    END;";

    // --- 2. REGISTRO DE INSUMOS ---
    $sql2 = "DROP PROCEDURE IF EXISTS SP_REGISTRAR_DETALLE_INSUMOS_RECEP;
    CREATE PROCEDURE SP_REGISTRAR_DETALLE_INSUMOS_RECEP(
        IN ID_RECE INT,
        IN ID_PROD INT,
        IN CANT INT,
        IN MONTO DECIMAL(10,2),
        IN ID_USU INT,
        IN ID_ALM INT
    )
    BEGIN
        INSERT INTO recep_insumos(rece_id, producto_id, cantidad, monto_ri, fecha)
        VALUES(ID_RECE, ID_PROD, CANT, MONTO, NOW());
        
        UPDATE stock SET cantidad_s = cantidad_s - CANT 
        WHERE producto_id = ID_PROD AND id_almacen = ID_ALM;
    END;";

    // --- 3. LISTADO DE EQUIPOS (Para EDITAR) ---
    $sql3 = "DROP PROCEDURE IF EXISTS SP_VER_DETALLE_RECEPCION;
    CREATE PROCEDURE SP_VER_DETALLE_RECEPCION(
        IN ID_RE INT
    )
    BEGIN
        SELECT id_equipo, equipo, serie, falla, monto, abono FROM recep_equipo WHERE rece_id = ID_RE;
    END;";

    // --- 4. LISTADO DE INSUMOS (Para EDITAR) ---
    $sql4 = "DROP PROCEDURE IF EXISTS SP_LISTAR_INSUMOS_DETALLE_REPARACION;
    CREATE PROCEDURE SP_LISTAR_INSUMOS_DETALLE_REPARACION(
        IN ID_RE INT
    )
    BEGIN
        SELECT RI.id_insumo, P.producto_nombre, RI.cantidad, RI.monto_ri, RI.rece_id, RI.producto_id
        FROM recep_insumos RI
        INNER JOIN producto P ON RI.producto_id = P.producto_id
        WHERE RI.rece_id = ID_RE;
    END;";

    // --- 5. MODIFICAR RECEPCION (MAESTRO) ---
    $sql5 = "DROP PROCEDURE IF EXISTS SP_MODIFICAR_RECEPCION;
    CREATE PROCEDURE SP_MODIFICAR_RECEPCION(
        IN IDRECE INT, 
        IN IDCLIENTE INT, 
        IN CARACTERISTICAS VARCHAR(255), 
        IN IDMOTIVO INT,
        IN CONCEPTO VARCHAR(255),
        IN MONTO DECIMAL(10,2),
        IN ESTADO VARCHAR(100),
        IN ADELANTO DECIMAL(10,2),
        IN DEBE DECIMAL(10,2),
        IN ACCESORIOS VARCHAR(255), 
        IN FENTREGA DATE, 
        IN RECOGER VARCHAR(50),  
        IN TECNICOID INT
    )
    BEGIN
        UPDATE recepcion SET
            cliente_id = IDCLIENTE,
            rece_caracteristicas = CARACTERISTICAS,
            motivo_id = IDMOTIVO,
            rece_concepto = CONCEPTO,
            rece_monto = MONTO,
            rece_estatus = ESTADO,
            rece_adelanto = ADELANTO,
            rece_debe = DEBE,
            rece_accesorios = ACCESORIOS,
            rece_fentrega = FENTREGA,
            rece_estado = RECOGER,
            tecnico = TECNICOID
        WHERE rece_id = IDRECE;
    END;";

    // --- 6. ELIMINAR EQUIPO DETALLE ---
    $sql6 = "DROP PROCEDURE IF EXISTS SP_ELIMINAR_EQUIPO_DETALLE;
    CREATE PROCEDURE SP_ELIMINAR_EQUIPO_DETALLE(
        IN ID_EQ INT
    )
    BEGIN
        DELETE FROM recep_equipo WHERE id_equipo = ID_EQ;
    END;";

    // --- 7. ELIMINAR INSUMO DETALLE ---
    $sql7 = "DROP PROCEDURE IF EXISTS SP_ELIMINAR_INSUMO_REPARACION;
    CREATE PROCEDURE SP_ELIMINAR_INSUMO_REPARACION(
        IN ID_INS INT,
        IN CANT INT,
        IN PROD_ID INT,
        IN RECE_ID INT,
        IN USU_ID INT
    )
    BEGIN
        DELETE FROM recep_insumos WHERE id_insumo = ID_INS;
        UPDATE stock SET cantidad_s = cantidad_s + CANT 
        WHERE producto_id = PROD_ID LIMIT 1; 
    END;";

    // --- 8. REGISTRAR TEST (CON FOTO) ---
    $sql8 = "DROP PROCEDURE IF EXISTS SP_REGISTRAR_TEST;
    CREATE PROCEDURE SP_REGISTRAR_TEST(
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

    // --- 9. LISTAR RECEPCION (CON FOTO TEST) ---
    $sql9 = "DROP PROCEDURE IF EXISTS SP_LISTAR_RECEPCION;
    CREATE PROCEDURE SP_LISTAR_RECEPCION(IN FEINI DATE , IN FEFIN DATE, IN USUID INT, IN p_idsucursal INT, IN p_rolid INT)
    BEGIN
    SELECT
        r.rece_id,
        concat( ' R-000', r.rece_id ) as referencia, 
        r.cliente_id,
        c.cliente_nombres, 
        concat_ws( ' - ', r.rece_equipo, r.rece_concepto ) as motivo, 
        r.rece_caracteristicas, 
        r.motivo_id,  
        mo.motivo_descripcion, 
        r.rece_monto, 
        DATE_FORMAT(r.rece_fregistro, '%d/%m/%y') as rece_fregistro,
        r.rece_estado, 
        r.rece_estatus, 
        r.rece_equipo, 
        r.rece_concepto, 
        r.rece_adelanto, 
        r.rece_debe, 
        r.rece_accesorios, 
        r.rece_fentrega, 
        r.marca_id, 
        ma.marca_descripcion, 
        r.rece_serie, 
        r.enciende, 
        r.tactil, 
        r.imagen, 
        r.vibra, 
        r.cobertura, 
        r.sensor, 
        r.carga, 
        r.bluetoo, 
        r.wifi, 
        r.huella, 
        r.home, 
        r.lateral, 
        r.camara, 
        r.bateria, 
        r.auricular, 
        r.micro, 
        r.face, 
        r.tornillo, 
        r.rece_cod, 
        c.cliente_celular, 
        r.tecnico, 
        r.usuario_registrador,
        u.usu_nombre,
        r.rece_foto1,
        r.rece_foto2,
        r.id_sucu,
        s.nombre_su
    FROM
    recepcion as r 
                JOIN cliente as c ON r.cliente_id = c.cliente_id 
                JOIN motivo as mo ON r.motivo_id = mo.motivo_id
              JOIN marca as ma ON r.marca_id = ma.marca_id
              JOIN usuario u on r.tecnico = u.usu_id
                JOIN sucursales s ON r.id_sucu = s.id_sucu
            WHERE r.rece_fregistro BETWEEN FEINI and FEFIN and (p_rolid = 1 OR (r.usuario_registrador = USUID AND r.id_sucu = p_idsucursal));
    END;";

    // --- 10. LISTAR RECEPCION ADMIN (CON FOTO TEST) ---
    $sql10 = "DROP PROCEDURE IF EXISTS SP_LISTAR_RECEPCION_ADMIN;
    CREATE PROCEDURE SP_LISTAR_RECEPCION_ADMIN(IN FEINI DATE , IN FEFIN DATE)
    BEGIN
    SELECT
        r.rece_id,
        concat( ' R-000', r.rece_id ) as referencia, 
        r.cliente_id,
        c.cliente_nombres, 
        concat_ws( ' - ', r.rece_equipo, r.rece_concepto ) as motivo, 
        r.rece_caracteristicas, 
        r.motivo_id,  
        mo.motivo_descripcion, 
        r.rece_monto, 
        DATE_FORMAT(r.rece_fregistro, '%d/%m/%y') as rece_fregistro,
        r.rece_estado, 
        r.rece_estatus, 
        r.rece_equipo, 
        r.rece_concepto, 
        r.rece_adelanto, 
        r.rece_debe, 
        r.rece_accesorios, 
        r.rece_fentrega, 
        r.marca_id, 
        ma.marca_descripcion, 
        r.rece_serie, 
        r.enciende, 
        r.tactil, 
        r.imagen, 
        r.vibra, 
        r.cobertura, 
        r.sensor, 
        r.carga, 
        r.bluetoo, 
        r.wifi, 
        r.huella, 
        r.home, 
        r.lateral, 
        r.camara, 
        r.bateria, 
        r.auricular, 
        r.micro, 
        r.face, 
        r.tornillo, 
        r.rece_cod, 
        c.cliente_celular, 
        r.tecnico, 
        r.usuario_registrador,
        u.usu_nombre,
        r.rece_foto1,
        r.rece_foto2
    FROM
    recepcion as r 
                JOIN cliente as c ON r.cliente_id = c.cliente_id 
                JOIN motivo as mo ON r.motivo_id = mo.motivo_id
              JOIN marca as ma ON r.marca_id = ma.marca_id
              JOIN usuario u on r.tecnico = u.usu_id
            WHERE r.rece_fregistro BETWEEN FEINI and FEFIN;
    END;";

    echo "<h2>Restaurando Procedimientos...</h2>";

    $SPs = [
        "SP_REGISTRAR_DETALLE_RECE_EQUIPO" => $sql1,
        "SP_REGISTRAR_DETALLE_INSUMOS_RECEP" => $sql2,
        "SP_VER_DETALLE_RECEPCION" => $sql3,
        "SP_LISTAR_INSUMOS_DETALLE_REPARACION" => $sql4,
        "SP_MODIFICAR_RECEPCION" => $sql5,
        "SP_ELIMINAR_EQUIPO_DETALLE" => $sql6,
        "SP_ELIMINAR_INSUMO_REPARACION" => $sql7,
        "SP_REGISTRAR_TEST" => $sql8,
        "SP_LISTAR_RECEPCION" => $sql9,
        "SP_LISTAR_RECEPCION_ADMIN" => $sql10
    ];

    foreach ($SPs as $name => $sql) {
        $c->exec($sql);
        echo "<p style='color:green;'>✅ $name restaurado.</p>";
    }

    echo "<hr><p style='color:blue;'>🚀 Todos los procesos de Recepción y Test han sido actualizados con soporte para fotos y correcciones.</p>";

} catch (Exception $e) {
    echo "<p style='color:red;'>❌ Error crítico: " . $e->getMessage() . "</p>";
}
?>