<?php
header('Content-Type: text/html; charset=utf-8');
require_once 'model/modelo_conexion.php';

echo "<h1>🛠️ Utilidad de Reparación de Base de Datos</h1>";

try {
    $c = conexionBD::conexionPDO();

    // --- 1. SP_REGISTRAR_CLIENTE ---
    echo "<p>Reparando SP_REGISTRAR_CLIENTE...</p>";
    $c->exec("DROP PROCEDURE IF EXISTS SP_REGISTRAR_CLIENTE");

    $sql_reg = "
    CREATE PROCEDURE SP_REGISTRAR_CLIENTE(
        IN NOMBRE VARCHAR(100),
        IN DNI VARCHAR(20),
        IN CELULAR VARCHAR(20),
        IN DIRECCION VARCHAR(255),
        IN APE_P VARCHAR(255),
        IN APE_M VARCHAR(255),
        IN CORREO VARCHAR(255),
        IN TIPODOC VARCHAR(50),
        IN p_idsucursal INT,
        IN p_listanegra VARCHAR(2)
    )
    BEGIN
        DECLARE v_cantidad INT;
        SELECT COUNT(*) INTO v_cantidad FROM cliente WHERE cliente_dni = DNI;

        IF v_cantidad = 0 THEN
            START TRANSACTION;
            INSERT INTO cliente (
                cliente_nombres, cliente_celular, cliente_dni, cliente_fregistro,
                cliente_estado, cliente_direccion, cliente_ape_p, cliente_ape_m,
                cliente_correo, cliente_tipo_doc, id_sucu, cliente_listanegra
            ) VALUES (
                NOMBRE, CELULAR, DNI, CURDATE(), 'ACTIVO', DIRECCION,
                APE_P, APE_M, CORREO, TIPODOC, p_idsucursal, p_listanegra
            );
            COMMIT;
            SELECT 1;
        ELSE
            SELECT 2;
        END IF;
    END;
    ";
    $c->exec($sql_reg);
    echo "<p style='color:green;'>✅ SP_REGISTRAR_CLIENTE creado correctamente.</p>";

    // --- 2. SP_MODIFICAR_CLIENTE ---
    echo "<p>Reparando SP_MODIFICAR_CLIENTE...</p>";
    $c->exec("DROP PROCEDURE IF EXISTS SP_MODIFICAR_CLIENTE");

    $sql_mod = "
    CREATE PROCEDURE SP_MODIFICAR_CLIENTE(
        IN ID INT,
        IN NOMBRE VARCHAR(100),
        IN DNI VARCHAR(20),
        IN CELULAR VARCHAR(20),
        IN ESTADO VARCHAR(100),
        IN DIRECCION VARCHAR(255),
        IN APE_P VARCHAR(255),
        IN APE_M VARCHAR(255),
        IN CORREO VARCHAR(255),
        IN TIPODOC VARCHAR(50),
        IN p_listanegra VARCHAR(2)
    )
    BEGIN
        DECLARE CLIENTEACTUAL VARCHAR(25);
        SET CLIENTEACTUAL = (SELECT cliente_dni FROM cliente WHERE cliente_id = ID);
        
        IF CLIENTEACTUAL = DNI THEN
            UPDATE cliente SET
                cliente_nombres = NOMBRE, cliente_celular = CELULAR,
                cliente_dni = DNI, cliente_estado = ESTADO,
                cliente_direccion = DIRECCION, cliente_ape_p = APE_P,
                cliente_ape_m = APE_M, cliente_correo = CORREO,
                cliente_tipo_doc = TIPODOC, cliente_listanegra = p_listanegra
            WHERE cliente_id = ID;
            SELECT 1;
        ELSE
            IF (SELECT COUNT(*) FROM cliente WHERE cliente_dni = DNI) = 0 THEN
                UPDATE cliente SET
                    cliente_nombres = NOMBRE, cliente_celular = CELULAR,
                    cliente_dni = DNI, cliente_estado = ESTADO,
                    cliente_direccion = DIRECCION, cliente_ape_p = APE_P,
                    cliente_ape_m = APE_M, cliente_correo = CORREO,
                    cliente_tipo_doc = TIPODOC, cliente_listanegra = p_listanegra
                WHERE cliente_id = ID;
                SELECT 1;
            ELSE
                SELECT 2;
            END IF;
        END IF;
    END;
    ";
    $c->exec($sql_mod);
    echo "<p style='color:green;'>✅ SP_MODIFICAR_CLIENTE creado correctamente.</p>";

    echo "<h3>🎉 ¡Todo listo! Por favor, intenta registrar un cliente ahora.</h3>";

} catch (Exception $e) {
    echo "<h3 style='color:red;'>❌ Error: " . $e->getMessage() . "</h3>";
}
?>