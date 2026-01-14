<?php 
	//comunica con el servidor para consultar
	require_once 'modelo_conexion.php';

	/**
	 * 
	 */
	class Modelo_Venta extends conexionBD
	{
		
		 /**************************************************
 		       LISTAR VENTA POR FILTRO DE FECHA
 		  **************************************************/
		 public function Listar_Venta($finicio,$ffin, $idusuario_ventas)
		 {
			$c = conexionBD:: conexionPDO();
			$sql = "CALL SP_LISTAR_VENTA_FILTRO(?,?,?)";
			$arreglo = array();
			$query = $c->prepare($sql);//mandamos el precedure
			$query ->bindParam(1,$finicio);//enviamos los parametros seguun la posicion
			$query ->bindParam(2,$ffin);
			$query ->bindParam(3,$idusuario_ventas);
			$query ->execute();
			$resultado = $query->fetchAll(PDO::FETCH_ASSOC);
			foreach ($resultado as $resp) {
			        $arreglo["data"][]=$resp;//almacenando los datos del arreglo
			}
			return $arreglo;
			conexionBD::cerrar_conexion();
		 }

		 public function Listar_Venta_Admin($finicio,$ffin, $sucurid, $almaid, $rolid)
		 {
			$c = conexionBD:: conexionPDO();
			$sql = "CALL SP_LISTAR_VENTA_ADMIN(?,?,?,?,?)";
			$arreglo = array();
			$query = $c->prepare($sql);//mandamos el precedure
			$query ->bindParam(1,$finicio);//enviamos los parametros seguun la posicion
			$query ->bindParam(2,$ffin);
			$query ->bindParam(3,$sucurid);
			$query ->bindParam(4,$almaid);
			$query ->bindParam(5,$rolid);
			
			$query ->execute();
			$resultado = $query->fetchAll(PDO::FETCH_ASSOC);
			foreach ($resultado as $resp) {
			        $arreglo["data"][]=$resp;//almacenando los datos del arreglo
			}
			return $arreglo;
			conexionBD::cerrar_conexion();
		 }




		  /**************************************************
 		       LISTAR CLIENTE EN MODAL
 		  **************************************************/
		 public function Listar_Selec_Cliente()
		 {
			$c = conexionBD:: conexionPDO();
			$sql = "CALL SP_LISTAR_SELECT_CLIENTE()";
			$arreglo = array();
			$query = $c->prepare($sql);//mandamos el precedure
			$query ->execute();
			$resultado = $query->fetchAll(PDO::FETCH_ASSOC);
			foreach ($resultado as $resp) {
			        $arreglo["data"][]=$resp;//almacenando los datos del arreglo
			}
			return $arreglo;
			conexionBD::cerrar_conexion();
		 }




		  /**************************************************
 		       LISTAR PRODUCTO EN MODAL
 		  **************************************************/
		 public function Listar_Selec_Producto()
		 {
			$c = conexionBD:: conexionPDO();
			$sql = "CALL SP_LISTAR_PRODUCTO_VENTA()";
			$arreglo = array();
			$query = $c->prepare($sql);//mandamos el precedure
			$query ->execute();
			$resultado = $query->fetchAll(PDO::FETCH_ASSOC);
			foreach ($resultado as $resp) {
			        $arreglo["data"][]=$resp;//almacenando los datos del arreglo
			}
			return $arreglo;
			conexionBD::cerrar_conexion();
		 }




		   /**************************************************
 		       LISTAR COMPROBANTE EN COMBO
 		  **************************************************/
		 public function Listar_Selec_Comprobante()
		 {
			$c = conexionBD:: conexionPDO();

			$sql = "CALL SP_LISTAR_SELECT_COMPROBANTE()";
			$arreglo = array();
			$query = $c->prepare($sql);//mandamos el precedure
			//$query ->bindParam(1,$usuario);//enviamos los parametros seguun la posicion
			$query ->execute();
			$resultado = $query->fetchAll();
			foreach ($resultado as $resp) {
			        $arreglo[]=$resp;//almacenando los datos del arreglo
			

			}
			return $arreglo;
			conexionBD::cerrar_conexion();
		 }




		    /**************************************************
 		       LISTAR PRODUCTOS EN COMBO
 		  **************************************************/
		/* public function Listar_Selec_Productos_en_combo()
		 {
			$c = conexionBD:: conexionPDO();

			$sql = "CALL SP_LISTAR_SELECT_PRODUCTO_VENTA()";
			$arreglo = array();
			$query = $c->prepare($sql);//mandamos el precedure
			//$query ->bindParam(1,$usuario);//enviamos los parametros seguun la posicion
			$query ->execute();
			$resultado = $query->fetchAll();
			foreach ($resultado as $resp) {
			        $arreglo[]=$resp;//almacenando los datos del arreglo
			

			}
			return $arreglo;
			conexionBD::cerrar_conexion();
		 }*/

		 public function Listar_Selec_Productos_en_combo($term, $idalmac)
			{
				$c = conexionBD::conexionPDO();
				$sql = "CALL SP_LISTAR_SELECT_PRODUCTO_VENTA_NEW(:term, :idalmac)";
				$arreglo = array();
				$query = $c->prepare($sql);
				$query->bindParam(':term', $term, PDO::PARAM_STR);
				$query->bindParam(':idalmac', $idalmac, PDO::PARAM_INT);
				$query->execute();
				$resultado = $query->fetchAll();
				foreach ($resultado as $resp) {
					$arreglo[] = array(
						'id' => $resp['producto_id'],
						'text' => $resp['nombre'],
						'stock' => $resp['stock'],
						'precio_venta' => $resp['precio_venta'],
						'imei' => $resp['pro_imei'],
						'preciocomercial' => $resp['preciocomercial'],
						'preciomayorista' => $resp['preciomayorista']
					);
				}
				conexionBD::cerrar_conexion();
				return $arreglo;
			}






		   /**************************************************
 		      REGISTRAR VENTA CABECERA
 		  **************************************************/
		 public function Registrar_Venta($idcliente,$compro,$serie,$numero,$impuesto,$total,$tipo,$porcentaje,$idusuario,$idformapago, $observacion, $monto_efectiv, $cod_opera, $monto_tarje, $cajaid_v, $totaldesct, $sucurid, $almaid, $rolid)//viene del controlador
		 {
			$c = conexionBD:: conexionPDO();

			$sql = "CALL SP_REGISTRAR_VENTA(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
			$query = $c->prepare($sql);//mandamos el precedure

			$query ->bindParam(1,$idcliente);//enviamos los parametros seguun la posicion del procedure
			$query ->bindParam(2,$compro);
			$query ->bindParam(3,$serie);
			$query ->bindParam(4,$numero);
			$query ->bindParam(5,$impuesto);
			$query ->bindParam(6,$total);
			$query ->bindParam(7,$tipo);
			$query ->bindParam(8,$porcentaje);
			$query ->bindParam(9,$idusuario);
			$query ->bindParam(10,$idformapago);
			$query ->bindParam(11,$observacion);
			$query ->bindParam(12,$monto_efectiv);
			$query ->bindParam(13,$cod_opera);
			$query ->bindParam(14,$monto_tarje);
			$query ->bindParam(15,$cajaid_v);
			$query ->bindParam(16,$totaldesct);
			$query ->bindParam(17,$sucurid);
			$query ->bindParam(18,$almaid);
			$query ->bindParam(19,$rolid);

			$resultado = $query ->execute();
			//cuando en el procedure retorna 1 o 2 (GUARDAR)
			if ($row = $query->fetchColumn()) {
				return $row;
			}
			
			conexionBD::cerrar_conexion();
		 }





		   /**************************************************
 		      REGISTRAR DETALLE
 		  **************************************************/
		 public function Registrar_Detalle_Venta($id,$array_producto,$array_cantidad,$array_precio, $array_imei, $array_descnt, $idalmac, $idsucu, $array_idimeiv)//viene del controlador
		 {
			$c = conexionBD:: conexionPDO();
			 // Convertir '' a null para campos enteros
    if ($array_idimeiv === '' || $array_idimeiv === null) {
        $array_idimeiv = null;
    }

			$sql = "CALL SP_REGISTRAR_DETALLE_VENTA(?,?,?,?,?,?,?,?,?)";
			$query = $c->prepare($sql);//mandamos el precedure

			$query ->bindParam(1,$id);//enviamos los parametros seguun la posicion del procedure
			$query ->bindParam(2,$array_producto);
			$query ->bindParam(3,$array_cantidad);
			$query ->bindParam(4,$array_precio);
			$query ->bindParam(5,$array_imei);
			$query ->bindParam(6,$array_descnt);
			$query ->bindParam(7,$idalmac);
			$query ->bindParam(8,$idsucu);
			$query->bindParam(9, $array_idimeiv, PDO::PARAM_INT);


			$resultado = $query ->execute();
			//solo de usa cuando no se retorna un valor en el procedure
			if($resultado){
				return 1;
			}else{
				return 0;
			}
			conexionBD::cerrar_conexion();
		 }





		   /**************************************************
 		      ANULAR VENTA
 		  **************************************************/
		 public function Anular_Venta($id,$estado, $sucuid)//viene del controlador
		 {
			$c = conexionBD:: conexionPDO();

			$sql = "CALL SP_ANULAR_VENTA_NEW(?,?,?)";
			$query = $c->prepare($sql);//mandamos el precedure

			$query ->bindParam(1,$id);//enviamos los parametros seguun la posicion del procedure
			$query ->bindParam(2,$estado);
			$query ->bindParam(3,$sucuid);



			$resultado = $query ->execute();
			//solo de usa cuando no se retorna un valor en el procedure
			if($resultado){
				return 1;
			}else{
				return 0;
			}
			conexionBD::cerrar_conexion();
		 }


		    /**************************************************
 		      PAGAR LA VENTA
 		  **************************************************/
		 public function Pagar_Venta($id,$estado)//viene del controlador
		 {
			$c = conexionBD:: conexionPDO();

			$sql = "CALL SP_PAGAR_VENTA(?,?)";
			$query = $c->prepare($sql);//mandamos el precedure

			$query ->bindParam(1,$id);//enviamos los parametros seguun la posicion del procedure
			$query ->bindParam(2,$estado);


			$resultado = $query ->execute();
			//solo de usa cuando no se retorna un valor en el procedure
			if($resultado){
				return 1;
			}else{
				return 0;
			}
			conexionBD::cerrar_conexion();
		 }

		/**************************************************
 		      PAGAR LA VENTA
 		  **************************************************/
		 public function Eliminar_Item_abono_venta($iddetcredito)//viene del controlador
		 {
			$c = conexionBD:: conexionPDO();

			$sql = "CALL ELIMINAR_ITEN_VENTA_CREDITO(?)";
			$query = $c->prepare($sql);//mandamos el precedure

			$query ->bindParam(1,$iddetcredito); 
			$resultado = $query ->execute();
			//solo de usa cuando no se retorna un valor en el procedure
			if($resultado){
				return 1;
			}else{
				return 0;
			}
			conexionBD::cerrar_conexion();
		 }
		 /**************************************************
 		       ELIMINAR DETALLE DE VENTA Y ACTUALIZAR STOCK
 		  **************************************************/
		 public function Eliminar_Detalle_Venta($idventa, $idproducto, $cantidad, $idimei, $sucurid, $iddetalle)//viene del controlador
		 {
			$c = conexionBD:: conexionPDO();
			$sql = "CALL SP_ELIMINAR_DETALLE_VENTA(?,?,?,?,?,?)";
			$query = $c->prepare($sql);
			$query ->bindParam(1,$idventa);
			$query ->bindParam(2,$idproducto);
			$query ->bindParam(3,$cantidad);
			$query ->bindParam(4,$idimei);
			$query ->bindParam(5,$sucurid);
			$query ->bindParam(6,$iddetalle);
			$resultado = $query ->execute();
			if($resultado){
				return 1;
			}else{
				return 0;
			}
			conexionBD::cerrar_conexion();
		 }



		    /**************************************************
 		      REGISTRAR ABONO DE VENTA AL CREDITO
 		  **************************************************/
		 public function Registrar_Abono($idventa_ab, $monto_ab, $idusuario_ab, $sucurid_ab, $idcaja_ab)//viene del controlador
		 {
			$c = conexionBD:: conexionPDO();

			$sql = "CALL SP_REGISTRAR_ABONO_VENTA(?,?,?,?,?)";
			$query = $c->prepare($sql);//mandamos el precedure

			$query ->bindParam(1,$idventa_ab);
			$query ->bindParam(2,$monto_ab);
			$query ->bindParam(3,$idusuario_ab);
			$query ->bindParam(4,$sucurid_ab);
			$query ->bindParam(5,$idcaja_ab);

			$resultado = $query ->execute();
			//solo de usa cuando no se retorna un valor en el procedure
			if($resultado){
				return 1;
			}else{
				return 0;
			}
			conexionBD::cerrar_conexion();
		 }


		
		 
		 /**************************************************
 		       VER EL DETALLE DE LA VENTA POR EL ID
 		  **************************************************/
		   public function Ver_detalle_Venta($id)
		   {
			  $c = conexionBD:: conexionPDO();
			 // $sql = "CALL SP_VER_DETALLE_VENTA(?)";
			 $sql = "SELECT
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
							where detalle_venta.venta_id = ?";
			  $arreglo = array();
			  $query = $c->prepare($sql);//mandamos el precedure
			  $query ->bindParam(1,$id);//enviamos los parametros seguun la posicion
			  $query ->execute();
			  $resultado = $query->fetchAll(PDO::FETCH_ASSOC);
			  foreach ($resultado as $resp) {
					  $arreglo["data"][]=$resp;//almacenando los datos del arreglo
			  }
			  return $arreglo;
			  conexionBD::cerrar_conexion();
		   }




		   

		 /**************************************************
 		       MODIFICAR EMPRESA
 		  **************************************************/
		 public function Modificar_estado_Venta($idventa, $estado, $cajaid)//viene del controlador
		 {
			$c = conexionBD:: conexionPDO();

			$sql = "CALL SP_MODIFICAR_ESTADO_VENTA(?,?,?)";
			$query = $c->prepare($sql);//mandamos el precedure
			$query ->bindParam(1,$idventa);//enviamos los parametros seguun la posicion
			$query ->bindParam(2,$estado);
			$query ->bindParam(3,$cajaid);
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
 		       TRAER IMEI POR PRODUCTO 
 		  **************************************************/
		   public function Traer_Imei_pro($id_pro)
		   {
			  $c = conexionBD:: conexionPDO();
			 // $sql = "CALL SP_TRAER_IMEI_PROD(?)";
			  $sql = "SELECT
							pd.id_prod_imei,
							pd.imei ,
							p.producto_nombre,
							p.producto_id,
							s.precio_venta_s,
							 p.producto_pcomercial
						FROM
							producto_detalle pd
						INNER JOIN producto p ON pd.producto_id = p.producto_id
						INNER JOIN stock s ON pd.producto_id = s.producto_id
						WHERE
							pd.producto_id = ? and pd.vendido = 'No'";
			  $arreglo = array();
			  $query = $c->prepare($sql);//mandamos el precedure
			  $query ->bindParam(1,$id_pro);
			  $query ->execute();
			  $resultado = $query->fetchAll();
			  // foreach ($resultado as $resp) {
			  // 	$arreglo[]=$resp;
			  // }
			  foreach ($resultado as $resp) {
				  $arreglo[]=$resp;//almacenando los datos del arreglo
			  }
			  return $arreglo;
			  conexionBD::cerrar_conexion();
		   }


		   /**************************************************
 		       LISTAR ABONOS DE LA VENTA
 		  **************************************************/
		 public function Listar_Abonos_Venta($idventa)
		 {
			$c = conexionBD:: conexionPDO();
			$sql = "CALL SP_LISTAR_ABONOS_VENTA(?)";
			$arreglo = array();
			$query = $c->prepare($sql); 
			$query ->bindParam(1,$idventa); 
			
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