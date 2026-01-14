<?php 
	//comunica con el servidor para consultar
	require_once 'modelo_conexion.php';

	/**
	 * 
	 */
	class Modelo_Caja extends conexionBD
	{
		
		 /**************************************************
 		       LISTAR CAJAS
 		  **************************************************/
		 public function Listar_Cajas($finicio,$ffin,  $sucurid ,$rolid)
		 {
			$c = conexionBD:: conexionPDO();
			$sql = "CALL SP_REPORTE_CAJA_CHICA(?,?,?,?)";
			$arreglo = array();
			$query = $c->prepare($sql);//mandamos el precedure
			$query ->bindParam(1,$finicio);//enviamos los parametros seguun la posicion
			$query ->bindParam(2,$ffin);
			$query ->bindParam(3,$sucurid);
			$query ->bindParam(4,$rolid);
			$query ->execute();
			$resultado = $query->fetchAll(PDO::FETCH_ASSOC);
			foreach ($resultado as $resp) {
			        $arreglo["data"][]=$resp;//almacenando los datos del arreglo
			}
			return $arreglo;
			conexionBD::cerrar_conexion();
		 }



        
		   /**************************************************
 		      REGISTRAR APERTURA DE CAJA
 		  **************************************************/
	
		public function Registrar_Apertura_caja($descripcion,$monto, $sucurid )//viene del controlador
		 {
			$c = conexionBD:: conexionPDO();

			$sql = "CALL SP_REGISTRAR_APERTURA_CAJA(?,?,?)";
			$query = $c->prepare($sql);//mandamos el precedure
			$query ->bindParam(1,$descripcion);//enviamos los parametros seguun la posicion del procedure
			$query ->bindParam(2,$monto);
			$query ->bindParam(3,$sucurid);
			$resultado = $query ->execute();
			//cuando en el procedure retorna 1 o 2
			if ($row = $query->fetchColumn()) {
				return $row;
			}
			conexionBD::cerrar_conexion();
		 }


          /**************************************************
 		       LISTAR total ventas
 		  **************************************************/

           public function Listar_Total_Ventas_oldd( $sucurid)
           {
              $c = conexionBD:: conexionPDO();
  
              $sql = "CALL SP_REPORTE_LISTAR_TOTAL_VENTAS_CAJA(?)";
              $arreglo = array();
              $query = $c->prepare($sql);//mandamos el precedure
			  $query ->bindParam(1,$sucurid);
              $query ->execute();
              $resultado = $query->fetchAll();
              foreach ($resultado as $resp) {
                      $arreglo[]=$resp;//almacenando los datos del arreglo
              }
              return $arreglo;
              conexionBD::cerrar_conexion();
           }

		public function Listar_Total_Ventas( $sucurid)
           {
              $c = conexionBD:: conexionPDO();
  
              $sql = "SELECT 
                        c.caja_monto_inicial AS monto_inicial_caja,
                        (SELECT COUNT(*) FROM venta WHERE estado_caja = 'ABIERTO' AND venta_estado = 'PAGADA' AND id_sucu = c.id_sucu) AS cant_ventas,
                        (SELECT IFNULL(SUM(venta_total), 0) FROM venta WHERE estado_caja = 'ABIERTO' AND venta_estado = 'PAGADA' AND id_sucu = c.id_sucu) AS suma_ventas,
                        
                        (SELECT COUNT(*) FROM gastos WHERE estado_caja = 'ABIERTO' AND gastos_estado = 'ACTIVO' AND tipo_mov = 'EGRESO' AND id_sucu = c.id_sucu AND caja_id = c.caja_id) AS cant_egreso,
                        (SELECT IFNULL(SUM(gastos_monto), 0) FROM gastos WHERE estado_caja = 'ABIERTO' AND gastos_estado = 'ACTIVO' AND tipo_mov = 'EGRESO' AND id_sucu = c.id_sucu AND caja_id = c.caja_id) AS suma_egreso,
                        c.caja_estado AS estado,
                        CONCAT_WS(' ', DATE_FORMAT(c.caja_fecha_ap, '%d/%m/%Y'), c.caja_hora_aper) AS fecha_apertura,
                        (SELECT COUNT(*) FROM servicio WHERE servicio_estado = 'ACTIVO' AND estado_caja = 'ABIERTO' AND id_sucu = c.id_sucu) AS cant_servicio,
                        (SELECT IFNULL(SUM(servicio_monto), 0) FROM servicio WHERE servicio_estado = 'ACTIVO' AND estado_caja = 'ABIERTO' AND id_sucu = c.id_sucu) AS suma_servicio,
                        (SELECT COUNT(*) FROM gastos WHERE estado_caja = 'ABIERTO' AND gastos_estado = 'ACTIVO' AND tipo_mov = 'INGRESO' AND id_sucu = c.id_sucu AND caja_id = c.caja_id) AS cant_ingreso,
                        (SELECT IFNULL(SUM(gastos_monto), 0) FROM gastos WHERE estado_caja = 'ABIERTO' AND gastos_estado = 'ACTIVO' AND tipo_mov = 'INGRESO' AND id_sucu = c.id_sucu AND caja_id = c.caja_id) AS suma_ingreso,
                         (SELECT confi_moneda FROM configuracion LIMIT 1) AS moneda,
                        c.caja_id AS idcaja,
                         (SELECT url_sistema FROM configuracion LIMIT 1) AS url_sistema,
                        (SELECT cod_pais FROM configuracion LIMIT 1) AS cod_sistema,

                        
                        (SELECT IFNULL(SUM(monto_abono),0) from venta_credito where estado_caja = 'ABIERTO' AND id_sucu = c.id_sucu ) as abonos,
(
                            c.caja_monto_inicial +
                            (SELECT IFNULL(SUM(venta_total), 0) FROM venta WHERE estado_caja = 'ABIERTO' AND venta_estado = 'PAGADA' AND id_sucu = c.id_sucu) +
                            (SELECT IFNULL(SUM(servicio_monto), 0) FROM servicio WHERE servicio_estado = 'ACTIVO' AND estado_caja = 'ABIERTO' AND id_sucu = c.id_sucu) +
                            (SELECT IFNULL(SUM(gastos_monto), 0) FROM gastos WHERE estado_caja = 'ABIERTO' AND gastos_estado = 'ACTIVO' AND tipo_mov = 'INGRESO' AND id_sucu = c.id_sucu AND caja_id = c.caja_id) +
                            (SELECT IFNULL(SUM(monto_abono),0) from venta_credito where estado_caja = 'ABIERTO' AND id_sucu = c.id_sucu )
                        ) - (SELECT IFNULL(SUM(gastos_monto), 0) FROM gastos WHERE estado_caja = 'ABIERTO' AND gastos_estado = 'ACTIVO' AND tipo_mov = 'EGRESO' AND id_sucu = c.id_sucu AND caja_id = c.caja_id) AS monto_final_caja
                       
                    FROM caja c
                    WHERE c.caja_estado = 'VIGENTE' AND c.id_sucu = ?
                    LIMIT 1";
              $arreglo = array();
              $query = $c->prepare($sql);//mandamos la consulta
              $query ->bindParam(1,$sucurid);
              $query ->execute();
              $resultado = $query->fetchAll();
              foreach ($resultado as $resp) {
                      $arreglo[]=$resp;//almacenando los datos del arreglo
              }
              return $arreglo;
              conexionBD::cerrar_conexion();
           }



        /**************************************************
 		      REGISTRAR CIERRE DE CAJA
 		  **************************************************/
	
		public function Registrar_Cierre_caja($monto_ventas,$cant_ventas,$monto_gasto,$cant_gasto,$monto_total,$monto_servicio,$cant_servicio, $monto_ingre,  $cant_ingre, $idcaja, $montoabono)//viene del controlador
        {
           $c = conexionBD:: conexionPDO();

           $sql = "CALL SP_REGISTRAR_CAJA_CIERRE(?,?,?,?,?,?,?,?,?,?,?)";
           $query = $c->prepare($sql);//mandamos el precedure
           $query ->bindParam(1,$monto_ventas);//enviamos los parametros seguun la posicion del procedure
           $query ->bindParam(2,$cant_ventas);
           $query ->bindParam(3,$monto_gasto);
           $query ->bindParam(4,$cant_gasto);
           $query ->bindParam(5,$monto_total);
		   $query ->bindParam(6,$monto_servicio);
		   $query ->bindParam(7,$cant_servicio);
		   $query ->bindParam(8,$monto_ingre);
		   $query ->bindParam(9,$cant_ingre);
		   $query ->bindParam(10,$idcaja);
		   $query ->bindParam(11,$montoabono);
           $resultado = $query ->execute();
			//solo de usa cuando no se retorna un valor en el procedure(actualizar)
			if($resultado){
				return 1;
			}else{
				return 0;
			}
			conexionBD::cerrar_conexion();
		 }


		 /**************************************************
 		       LISTAR venta por idcaja
 		  **************************************************/
		   public function Listar_venta_por_cajaid($idcaja)
		   {
			  $c = conexionBD:: conexionPDO();
			  $sql = "CALL SP_LISTAR_VENTAS_CAJA_ID(?)";
			  $arreglo = array();
			  $query = $c->prepare($sql);//mandamos el precedure
			  $query ->bindParam(1,$idcaja);//enviamos los parametros seguun la posicion
			  
			  $query ->execute();
			  $resultado = $query->fetchAll(PDO::FETCH_ASSOC);
			  foreach ($resultado as $resp) {
					  $arreglo["data"][]=$resp;//almacenando los datos del arreglo
			  }
			  return $arreglo;
			  conexionBD::cerrar_conexion();
		   }



    }


?>