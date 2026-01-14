<?php 
	//comunica con el servidor para consultar
	require_once 'modelo_conexion.php';

	/**
	 * 
	 */
	class Modelo_Buscar_Equipo extends conexionBD
	{




		 /**************************************************
 		      BUSCAR EQUIPO POR DNI
 		  **************************************************/
		 public function Listar_Equipo_dni($dni)
		 {
			$c = conexionBD:: conexionPDO();
			$sql = "CALL SP_BUSCAR_EQUIPO_DNI(?)";
			$arreglo = array();
			$query = $c->prepare($sql);//mandamos el precedure
			$query ->bindParam(1,$dni);//enviamos los parametros seguun la posicion

			$query ->execute();
			$resultado = $query->fetchAll(PDO::FETCH_ASSOC);
			foreach ($resultado as $resp) {
			        $arreglo["data"][]=$resp;//almacenando los datos del arreglo
			}
			return $arreglo;
			conexionBD::cerrar_conexion();
		 }

		  /**************************************************
 		      BUSCAR PEDIDOS POR DNI
 		  **************************************************/
		   public function Listar_Pedidos_timeline2222222($dni, $pedido)
		   {
			  $c = conexionBD:: conexionPDO();
			  $sql = "CALL SP_BUSCAR_PEDIDO_TIMELINE(?,?)";
			  $arreglo = array();
			  $query = $c->prepare($sql);//mandamos el precedure
			  $query ->bindParam(1,$dni);//enviamos los parametros seguun la posicion
			  $query ->bindParam(2,$pedido);//enviamos los parametros seguun la posicion
			  $query ->execute();

			  $resultado = $query->fetchAll(PDO::FETCH_ASSOC);
			  foreach ($resultado as $resp) {
					  $arreglo["data"][]=$resp;//almacenando los datos del arreglo
			  }
			  return $arreglo;
			  conexionBD::cerrar_conexion();
		   }
		   public function Listar_Pedidos_timeline($dni, $pedido)
			{
				$c = conexionBD::conexionPDO();
				$sql = "CALL SP_BUSCAR_PEDIDO_TIMELINE(?,?)";
				$query = $c->prepare($sql);
				$query->bindParam(1, $dni);
				$query->bindParam(2, $pedido);
				$query->execute();

				$resultado = $query->fetchAll(PDO::FETCH_ASSOC);
				conexionBD::cerrar_conexion();
			
				return $resultado ?: []; // Si $resultado es falso, retorna []
			}


		 /**************************************************
 		      BUSCAR EQUIPO POR DNI
 		  **************************************************/
		   public function Listar_Ventas_dni_inicio($dni)
		   {
			  $c = conexionBD:: conexionPDO();
			  $sql = "CALL SP_BUSCAR_VENTAS_CLIENTE_INICIO(?)";
			  $arreglo = array();
			  $query = $c->prepare($sql);//mandamos el precedure
			  $query ->bindParam(1,$dni);//enviamos los parametros seguun la posicion
  
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