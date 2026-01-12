DELIMITER $$

DROP PROCEDURE IF EXISTS `SP_BUSCAR_MOV_IMEI_2`$$
CREATE PROCEDURE `SP_BUSCAR_MOV_IMEI_2`(
    IN `imei_buscar` VARCHAR(255)
)
BEGIN
    SELECT 
        k.kardex_id,
        DATE(k.kardex_fecha) AS fecha,
        p.producto_nombre AS articulo,
        pd.producto_imei AS imei,
        prov.prove_ruc AS proveedor,
        s.sucursal_nombre AS sucursal
    FROM kardex k
    INNER JOIN producto p ON k.producto_id = p.producto_id
    INNER JOIN producto_detalle pd ON p.producto_id = pd.producto_id
    LEFT JOIN proveedor prov ON k.kardex_p_ingreso = prov.prove_id
    LEFT JOIN stock s ON k.almacen_id = s.almacen_id
    WHERE pd.producto_imei = imei_buscar
    ORDER BY k.kardex_fecha DESC;
END$$

DELIMITER ;