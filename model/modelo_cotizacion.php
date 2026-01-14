<?php 
	//comunica con el servidor para consultar
	require_once 'modelo_conexion.php';

	/**
	 * 
	 */
	class Modelo_Cotizacion extends conexionBD
	{
		
		 /**************************************************
 		       LISTAR COTIZACION POR FILTRO DE FECHA
 		  **************************************************/
		 public function Listar_Cotizacion($finicio,$ffin)
		 {
			$c = conexionBD:: conexionPDO();
			$sql = "CALL SP_LISTAR_COTIZACION(?,?)";
			$arreglo = array();
			$query = $c->prepare($sql);//mandamos el precedure
			$query ->bindParam(1,$finicio);//enviamos los parametros seguun la posicion
			$query ->bindParam(2,$ffin);
			$query ->execute();
			$resultado = $query->fetchAll(PDO::FETCH_ASSOC);
			foreach ($resultado as $resp) {
			        $arreglo["data"][]=$resp;//almacenando los datos del arreglo
			}
			return $arreglo;
			conexionBD::cerrar_conexion();
		 }




		   /**************************************************
 		       LISTAR PROVEEDOR EN COMBO
 		  **************************************************/
		 public function Listar_Select_Proveedor()
		 {
			$c = conexionBD:: conexionPDO();

			$sql = "CALL SP_LISTAR_SELECT_PROVEEDOR()";
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
 		       LISTAR COMPROBANTE EN COMBO - SOLO COTIZACION
 		  **************************************************/
		 public function Listar_Select_Comp_Cotiz()
		 {
			$c = conexionBD:: conexionPDO();

			$sql = "CALL SP_LISTAR_SELECT_COMP_COTIZACION()";
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
 		       LISTAR FORMA DE PAGO EN COMBO
 		  **************************************************/
		 public function Listar_Select_Forma_pago()
		 {
			$c = conexionBD:: conexionPDO();

			$sql = "CALL SP_LISTAR_SELECT_FOR_PAGO()";
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
 		       LISTAR COMPROBANTE EN COMBO - SOLO COTIZACION
 		  **************************************************/
		 public function Listar_Select_numero_Cotiz()
		 {
			$c = conexionBD:: conexionPDO();

			$sql = "CALL SP_LISTAR_NUM_COTIZACION()";
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
 		      REGISTRAR COTIZACION CABECERA
 		  **************************************************/
		 public function Registrar_Cotizacion($idproveedor,$compro,$serie,$impuesto,$total,$tipo,$porcentaje,$idusuario,$atiende,$dias,$fpago)//viene del controlador
		 {
			$c = conexionBD:: conexionPDO();

			$sql = "CALL SP_REGISTRAR_COTIZACION(?,?,?,?,?,?,?,?,?,?,?)";
			$query = $c->prepare($sql);//mandamos el precedure

			$query ->bindParam(1,$idproveedor);//enviamos los parametros seguun la posicion del procedure
			$query ->bindParam(2,$compro);
			$query ->bindParam(3,$serie);
			$query ->bindParam(4,$impuesto);
			$query ->bindParam(5,$total);
			$query ->bindParam(6,$tipo);
			$query ->bindParam(7,$porcentaje);
			$query ->bindParam(8,$idusuario);
			$query ->bindParam(9,$atiende);
			$query ->bindParam(10,$dias);
			$query ->bindParam(11,$fpago);
	


			$resultado = $query ->execute();
			//cuando en el procedure retorna 1 o 2 (GUARDAR)
			if ($row = $query->fetchColumn()) {
				return $row;
			}
			//solo de usa cuando no se retorna un valor en el procedure(actualizar)
			//if($resultado){
			//	return 1;
			//}else{
			//	return 0;
			//}
			conexionBD::cerrar_conexion();
		 }



	     /**************************************************
 		      REGISTRAR COTIZACION DETALLE
 		 **************************************************/
		 public function Registrar_Detalle_Cotizacion($id,$array_producto,$array_cantidad,$array_precio)//viene del controlador
		 {
			$c = conexionBD:: conexionPDO();

			$sql = "CALL SP_REGISTRAR_DETALLE_COTIZACION(?,?,?,?)";
			$query = $c->prepare($sql);//mandamos el precedure

			$query ->bindParam(1,$id);//enviamos los parametros seguun la posicion del procedure
			$query ->bindParam(2,$array_producto);
			$query ->bindParam(3,$array_cantidad);
			$query ->bindParam(4,$array_precio);

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
 		      ANULAR COTIZACION
 		  **************************************************/
		 public function Anular_Cotizacion($id,$estado)//viene del controlador
		 {
			$c = conexionBD:: conexionPDO();

			$sql = "CALL SP_ANULAR_COTIZACION(?,?)";
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
 		      ANULAR COTIZACION
 		  **************************************************/
		 public function Activar_Cotizacion($id,$estado)//viene del controlador
		 {
			$c = conexionBD:: conexionPDO();

			$sql = "CALL SP_ACTIVAR_COTIZACION(?,?)";
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





















}


 ?>