<?php 
	//comunica con el servidor para consultar
	require_once 'modelo_conexion.php';

	/**
	 * 
	 */
	class Modelo_Traslados extends conexionBD
	{


         /**************************************************
 		       LISTAR TRASLADOS EN DATATABLE
 		 **************************************************/
		 public function Listar_Traslados()
		 {
			$c = conexionBD:: conexionPDO();
			$sql = "CALL SP_LISTAR_TRASLADOS()";
			$arreglo = array();
			$query = $c->prepare($sql);//mandamos el precedure
			//$query ->bindParam(1,$usuario);//enviamos los parametros seguun la posicion
			$query ->execute();
			$resultado = $query->fetchAll(PDO::FETCH_ASSOC);
			foreach ($resultado as $resp) {
			        $arreglo["data"][]=$resp;//almacenando los datos del arreglo
			

			}
			return $arreglo;
			conexionBD::cerrar_conexion();
		 }


		   /**************************************************
 		      REGISTRAR TRASLADO CABECERA
 		  **************************************************/
		   public function Registrar_Traslado_cabe($idalmacenorigen,$idalmacendestino, $idusuario, $observacion )
		   {
				try {
				$c = conexionBD:: conexionPDO();
				$c->beginTransaction();
					
				$sql = "CALL SP_REGISTRAR_TRASLADO_CABE(?,?,?,?)";
				$query = $c->prepare($sql);//mandamos el precedure
	
				$query ->bindParam(1,$idalmacenorigen);
				$query ->bindParam(2,$idalmacendestino);
				$query ->bindParam(3,$idusuario);
				$query ->bindParam(4,$observacion);
				$query->execute();

				$row = $query->fetchColumn();
				$query->closeCursor();
				$c->commit();

				return [
					"tipo_msj" => "success",
					"msj" => "TRASLADO REGISTRADO CON EXITO",
					"data" => $row
				];
				
				} catch (Exception $e) {
					if ($c && $c->inTransaction()) {
						$c->rollBack();
					}
					return [
						"tipo_msj" => "error",
						"msj" => "Error al registrar el traslado: " . $e->getMessage()
					];
				} finally {
					conexionBD::cerrar_conexion();
				} 
		   }

		   
		   /**************************************************
 		      REGISTRAR DETALLE TRASLADO
 		  **************************************************/
		public function Registrar_Detalle_Traslado_old($id, $array_producto, $array_precio, $array_cantidad, $idalmacendestino, $idalmacenorigen)
		 {
			try {
				$c = conexionBD::conexionPDO();
				$c->beginTransaction();

				$productos = explode(",", $array_producto);
				$cantidades = explode(",", $array_cantidad);
				$precio = explode(",", $array_precio);

				// VALIDAR STOCK SUFICIENTE EN ALMACÉN DE ORIGEN
				for ($i = 0; $i < count($productos); $i++) {
					$producto_id = $productos[$i];
					$cantidad_requerida = $cantidades[$i];

					$sql = "SELECT cantidad_s FROM stock WHERE producto_id = ? AND id_almacen = ?";
					$stmt = $c->prepare($sql);
					$stmt->execute([$producto_id, $idalmacenorigen]);
					$stock_actual = $stmt->fetchColumn();

					if ($stock_actual === false || $stock_actual < $cantidad_requerida) {
						$c->rollBack();
						return [
							"tipo_msj" => "error",
							"msj" => "STOCK INSUFICIENTE PARA EL PRODUCTO con ID $producto_id EN EL ALMACÉN DE ORIGEN."
						];
					}
				}

				// REGISTRAR DETALLE DEL TRASLADO
				$sql = "CALL SP_REGISTRAR_DETALLE_TRASLADO(?,?,?,?)";
				$query = $c->prepare($sql);
				$query->bindParam(1, $id);
				$query->bindParam(2, $array_producto);
				$query->bindParam(3, $array_precio);
				$query->bindParam(4, $array_cantidad);
				$query->execute();
				$row = $query->fetchColumn();

				// ACTUALIZAR STOCK: RESTAR AL ORIGEN Y SUMAR AL DESTINO
				for ($i = 0; $i < count($productos); $i++) {
					$producto_id = $productos[$i];
					$cantidad = $cantidades[$i];
					$preciovent = $precio[$i];

					// Restar stock del origen
					$sql = "UPDATE stock SET cantidad_s = cantidad_s - ? WHERE producto_id = ? AND id_almacen = ?";
					$stmt = $c->prepare($sql);
					$stmt->execute([$cantidad, $producto_id, $idalmacenorigen]);

					// Verificar si existe stock en el destino
					$sql = "SELECT COUNT(*) FROM stock WHERE producto_id = ? AND id_almacen = ?";
					$stmt = $c->prepare($sql);
					$stmt->execute([$producto_id, $idalmacendestino]);
					$existe = $stmt->fetchColumn();

					if ($existe) {
						// Si ya existe, sumar stock
						$sql = "UPDATE stock SET cantidad_s = cantidad_s + ? WHERE producto_id = ? AND id_almacen = ?";
						$stmt = $c->prepare($sql);
						$stmt->execute([$cantidad, $producto_id, $idalmacendestino]);
					} else {
						// Si no existe, insertar nueva fila en stock
						$sql = "INSERT INTO stock (producto_id, id_almacen, cantidad_s, precio_venta_s, tipo_s, fecha_reg) VALUES (?, ?, ?,?, 'TRANSFERENCIA', NOW() )";
						$stmt = $c->prepare($sql);
						$stmt->execute([$producto_id, $idalmacendestino, $cantidad, $preciovent]);
					}
				}

				$c->commit();

				return [
					"tipo_msj" => "success",
					"msj" => "TRASLADO REGISTRADO CON ÉXITO",
					"data" => $row
				];
			} catch (Exception $e) {
				if ($c && $c->inTransaction()) {
					$c->rollBack();
				}
				return [
					"tipo_msj" => "error",
					"msj" => "Error al registrar el traslado: " . $e->getMessage()
				];
			} finally {
				conexionBD::cerrar_conexion();
			}
		}


		public function Registrar_Detalle_Traslado($id, $array_producto, $array_precio, $array_cantidad, $idalmacendestino, $idalmacenorigen, $usuario_id)
		{
			try {
				$c = conexionBD::conexionPDO();
				$c->beginTransaction();

				$productos = explode(",", $array_producto);
				$cantidades = explode(",", $array_cantidad);
				$precio = explode(",", $array_precio);

				// VALIDAR STOCK SUFICIENTE EN ALMACÉN DE ORIGEN
				for ($i = 0; $i < count($productos); $i++) {
					$producto_id = $productos[$i];
					$cantidad_requerida = $cantidades[$i];

					$sql = "SELECT cantidad_s FROM stock WHERE producto_id = ? AND id_almacen = ?";
					$stmt = $c->prepare($sql);
					$stmt->execute([$producto_id, $idalmacenorigen]);
					$stock_actual = $stmt->fetchColumn();

					if ($stock_actual === false || $stock_actual < $cantidad_requerida) {
						$c->rollBack();
						return [
							"tipo_msj" => "error",
							"msj" => "STOCK INSUFICIENTE PARA EL PRODUCTO con ID $producto_id EN EL ALMACÉN DE ORIGEN."
						];
					}
				}

				// REGISTRAR DETALLE DEL TRASLADO
				$sql = "CALL SP_REGISTRAR_DETALLE_TRASLADO(?,?,?,?)";
				$query = $c->prepare($sql);
				$query->bindParam(1, $id);
				$query->bindParam(2, $array_producto);
				$query->bindParam(3, $array_precio);
				$query->bindParam(4, $array_cantidad);
				$query->execute();
				$row = $query->fetchColumn();

				// traer la sucursal por el almacen de desstino
					$sql = "SELECT id_sucu FROM sucursales WHERE  id_almacen = ?";
					$stmt = $c->prepare($sql);
					$stmt->execute([$idalmacendestino]);
					$sucurslid= $stmt->fetchColumn();

				// ACTUALIZAR STOCK Y REGISTRAR MOVIMIENTOS
				for ($i = 0; $i < count($productos); $i++) {
					$producto_id = $productos[$i];
					$cantidad = $cantidades[$i];
					$preciovent = $precio[$i];

					// Restar stock del origen
					$sql = "UPDATE stock SET cantidad_s = cantidad_s - ? WHERE producto_id = ? AND id_almacen = ?";
					$stmt = $c->prepare($sql);
					$stmt->execute([$cantidad, $producto_id, $idalmacenorigen]);

					// Registrar movimiento salida
					$sql = "INSERT INTO movimientos (producto_id, id_almacen, cantidad, tipo_movimiento, referencia_id, fecha_reg, usuario_id, observacion)
							VALUES (?, ?, ?, 'traslado_salida', ?, NOW(), ?, CONCAT('salida traslado: ', $idalmacenorigen, ' a ', $idalmacendestino, ' prod ', $producto_id , ' cant ', $cantidad))";
					$stmt = $c->prepare($sql);
					$stmt->execute([$producto_id, $idalmacenorigen, -$cantidad, $id, $usuario_id]);

					// Verificar si existe stock en el destino
					$sql = "SELECT COUNT(*) FROM stock WHERE producto_id = ? AND id_almacen = ?";
					$stmt = $c->prepare($sql);
					$stmt->execute([$producto_id, $idalmacendestino]);
					$existe = $stmt->fetchColumn();

					if ($existe) {
						// Sumar stock al destino
						$sql = "UPDATE stock SET cantidad_s = cantidad_s + ? WHERE producto_id = ? AND id_almacen = ?";
						$stmt = $c->prepare($sql);
						$stmt->execute([$cantidad, $producto_id, $idalmacendestino]);
					} else {
						// Insertar nuevo stock
						$sql = "INSERT INTO stock (producto_id, id_almacen, cantidad_s, precio_venta_s, tipo_s, fecha_reg, id_sucu)
								VALUES (?, ?, ?, ?, 'TRANSFERENCIA', NOW(), ?)";
						$stmt = $c->prepare($sql);
						$stmt->execute([$producto_id, $idalmacendestino, $cantidad, $preciovent, $sucurslid]);
					}

					// Registrar movimiento entrada
					$sql = "INSERT INTO movimientos (producto_id, id_almacen, cantidad, tipo_movimiento, referencia_id, fecha_reg, usuario_id, observacion)
							VALUES (?, ?, ?, 'traslado_entrada', ?, NOW(), ?, CONCAT('ingreso traslado: ', $idalmacenorigen, ' a ', $idalmacendestino, ' prod ', $producto_id , ' cant ', $cantidad))";
					$stmt = $c->prepare($sql);
					$stmt->execute([$producto_id, $idalmacendestino, $cantidad, $id, $usuario_id]);
				}

				$c->commit();
				return [
					"tipo_msj" => "success",
					"msj" => "TRASLADO REGISTRADO CON ÉXITO",
					"data" => $row
				];
			} catch (Exception $e) {
				if ($c && $c->inTransaction()) {
					$c->rollBack();
				}
				return [
					"tipo_msj" => "error",
					"msj" => "Error al registrar el traslado: " . $e->getMessage()
				];
			} finally {
				conexionBD::cerrar_conexion();
			}
		}




		  /**************************************************
 		       LISTAR TRASLADOS EN DATATABLE
 		 **************************************************/
		 public function Listar_Detalle_Traslados($idtras)
		 {
				$c = conexionBD:: conexionPDO();
				$sql = "CALL SP_LISTAR_DETALLE_TRASLADO(?)";
				$arreglo = array();
				$query = $c->prepare($sql);//mandamos el precedure
				$query ->bindParam(1,$idtras);//enviamos los parametros seguun la posicion
				$query ->execute();
				$resultado = $query->fetchAll(PDO::FETCH_ASSOC);
				foreach ($resultado as $resp) {
						$arreglo["data"][]=$resp;//almacenando los datos del arreglo
				

				}
				return $arreglo;
				conexionBD::cerrar_conexion();
			}

		 /**************************************************
 		       ANULAR TRASLADO
 		**************************************************/
		
		public function Anular_Traslado($traslado_id, $usuario_id) {
			try {
				$c = conexionBD::conexionPDO();
				$c->beginTransaction();

				// 1. Verificar que el traslado esté activo
				$sql = "SELECT estado, almacen_origen_id, almacen_destino_id FROM traslados WHERE id_traslado = ?";
				$stmt = $c->prepare($sql);
				$stmt->execute([$traslado_id]);
				$traslado = $stmt->fetch(PDO::FETCH_ASSOC);

				if (!$traslado || $traslado['estado'] === 'Anulado') {
					return ["tipo_msj" => "warning", "msj" => "Traslado inválido o ya esta anulado."];
				}

				$id_origen = $traslado['almacen_origen_id'];
				$id_destino = $traslado['almacen_destino_id'];

				// 2. Obtener los productos del traslado
				$sql = "SELECT producto_id, cantidad_t FROM detalle_traslados WHERE id_traslado = ?";
				$stmt = $c->prepare($sql);
				$stmt->execute([$traslado_id]);
				$detalles = $stmt->fetchAll(PDO::FETCH_ASSOC);

				foreach ($detalles as $detalle) {
					$producto_id = $detalle['producto_id'];
					$cantidad = $detalle['cantidad_t'];

					// Validar que el stock en destino sea suficiente para anular
					$sql = "SELECT cantidad_s FROM stock WHERE producto_id = ? AND id_almacen = ?";
					$stmt = $c->prepare($sql);
					$stmt->execute([$producto_id, $id_destino]);
					$stock = $stmt->fetchColumn();

					if ($stock === false || $stock < $cantidad) {
						$c->rollBack();
						return ["tipo_msj" => "warning", 
								"msj" => "Stock insuficiente para anular el traslado, revisa las salidas directas del producto ID $producto_id. Stock actual: $stock, requerido: $cantidad"];
					}

					// 3. Revertir stock (sumar a origen, restar a destino)

					// Sumar al origen
					$sql = "UPDATE stock SET cantidad_s = cantidad_s + ? WHERE producto_id = ? AND id_almacen = ?";
					$c->prepare($sql)->execute([$cantidad, $producto_id, $id_origen]);

					// Restar al destino
					$sql = "UPDATE stock SET cantidad_s = cantidad_s - ? WHERE producto_id = ? AND id_almacen = ?";
					$c->prepare($sql)->execute([$cantidad, $producto_id, $id_destino]);

					// 4. Registrar movimientos inversos
					$sql = "INSERT INTO movimientos
						(producto_id, id_almacen, cantidad, tipo_movimiento, referencia_id, usuario_id, fecha_reg, observacion)
						VALUES (?, ?, ?, 'ANULAR ENTRADA', ?, ?,  NOW(), CONCAT('anulacion entrada traslado: ', ' prod ', $producto_id , ' cant ', $cantidad, ' idtrasl ', $traslado_id))";
					$c->prepare($sql)->execute([$producto_id, $id_origen, $cantidad, $traslado_id, $usuario_id]);

					$sql = "INSERT INTO movimientos
						(producto_id, id_almacen, cantidad, tipo_movimiento, referencia_id, usuario_id, fecha_reg, observacion)
						VALUES (?, ?, ?, 'ANULAR SALIDA', ?, ?,  NOW(),  CONCAT('anulacion salida traslado: ', ' prod ', $producto_id , ' cant ', $cantidad, ' idtrasl ', $traslado_id))";
					$c->prepare($sql)->execute([$producto_id, $id_destino, -$cantidad, $traslado_id, $usuario_id]);
				}

				// 5. Marcar el traslado como anulado
				$sql = "UPDATE traslados SET estado = 'Anulado' WHERE id_traslado = ?";
				$c->prepare($sql)->execute([$traslado_id]);

				$c->commit();
				return ["tipo_msj" => "success", "msj" => "TRASLADO ANULADO CON ÉXITO"];

			} catch (Exception $e) {
				if ($c && $c->inTransaction()) {
					$c->rollBack();
				}
				return ["tipo_msj" => "error", "msj" => "Error al anular traslado: " . $e->getMessage()];
			} finally {
				conexionBD::cerrar_conexion();
			}
		}



    }