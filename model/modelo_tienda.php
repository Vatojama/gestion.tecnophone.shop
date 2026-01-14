<?php
//comunica con el servidor para consultar
require_once 'modelo_conexion.php';

/**
 * 
 */
class Modelo_Tienda extends conexionBD
{

	/**************************************************
 		       LISTAR LOS BANNER
	 **************************************************/
	public function Listar_Banner()
	{
		$c = conexionBD::conexionPDO();
		$sql = "CALL LISTAR_BANNER()";
		$arreglo = array();
		$query = $c->prepare($sql); //mandamos el precedure
		//$query ->bindParam(1,$usuario);//enviamos los parametros seguun la posicion
		$query->execute();
		$resultado = $query->fetchAll(PDO::FETCH_ASSOC);
		foreach ($resultado as $resp) {
			$arreglo["data"][] = $resp; //almacenando los datos del arreglo
		}
		return $arreglo;
		conexionBD::cerrar_conexion();
	}


	/**************************************************
 		    		   REGISTRAR BANNER
	 **************************************************/
	public function Registrar_Banner($descrip, $ruta)
	{
		$c = conexionBD::conexionPDO();

		$sql = "CALL SP_REGISTRAR_BANNER(?,?)";
		$query = $c->prepare($sql);
		$query->bindParam(1, $descrip);
		$query->bindParam(2, $ruta);
		$resultado = $query->execute();
		// if ($row = $query->fetchColumn()) {
		// 	return $row;
		// }

		//solo de usa cuando no se retorna un valor en el procedure
		if ($resultado) {
			return 1;
		} else {
			return 0;
		}

		conexionBD::cerrar_conexion();
	}


	/**************************************************
 		       ELIMINAR BANNER
	 **************************************************/
	public function Eliminar_Banner($id) //viene del controlador
	{
		$c = conexionBD::conexionPDO();

		$sql = "CALL SP_ELIMINAR_BANNER(?)";
		$query = $c->prepare($sql); //mandamos el precedure
		$query->bindParam(1, $id); //enviamos los parametros seguun la posicion del procedure
		$resultado = $query->execute();
		//solo de usa cuando no se retorna un valor en el procedure(actualizar)
		if ($resultado) {
			return 1;
		} else {
			return 0;
		}
		conexionBD::cerrar_conexion();
	}


	/**************************************************
 		       REGISTRAR REVICIO
	 **************************************************/
	public function Registrar_Servicio($titulo, $descripcion)
	{
		$c = conexionBD::conexionPDO();
		$sql = "INSERT INTO servicios_tienda (titulo, descripcion) VALUES (:titulo, :descripcion)";
		$query = $c->prepare($sql); //mandamos el precedure
		$query->bindParam(':titulo', $titulo);
		$query->bindParam(':descripcion', $descripcion);

		$resultado = $query->execute();
		//solo de usa cuando no se retorna un valor en el procedure(actualizar)
		if ($resultado) {
			return "ok";
		} else {
			return "error";
		}
		conexionBD::cerrar_conexion();
	}

	/**************************************************
 		       LISTAR LOS SERVICIOS
	 **************************************************/
	public function Listar_Servicio_tabla()
	{
		$c = conexionBD::conexionPDO();
		$sql = "select * from servicios_tienda";
		$arreglo = array();
		$query = $c->prepare($sql);
		$query->execute();
		$resultado = $query->fetchAll(PDO::FETCH_ASSOC);
		foreach ($resultado as $resp) {
			$arreglo["data"][] = $resp; //almacenando los datos del arreglo
		}
		return $arreglo;
		conexionBD::cerrar_conexion();
	}

	/**************************************************
 		       EDITAR REVICIO
	 **************************************************/
	public function Editar_Servicio($idserv, $titulo, $descripcion)
	{
		$c = conexionBD::conexionPDO();
		$sql = "UPDATE servicios_tienda SET titulo = :titulo, descripcion = :descripcion WHERE idserv = :idserv";
		$query = $c->prepare($sql); //mandamos el precedure
		$query->bindParam(':idserv', $idserv);
		$query->bindParam(':titulo', $titulo);
		$query->bindParam(':descripcion', $descripcion);

		$resultado = $query->execute();
		//solo de usa cuando no se retorna un valor en el procedure(actualizar)
		if ($resultado) {
			return "ok";
		} else {
			return "error";
		}
		conexionBD::cerrar_conexion();
	}



	/**************************************************
 		       LISTAR PEDIDO POR FILTRO DE FECHA
	 **************************************************/
	public function Listar_Pedidos_fecha($finicio, $ffin)
	{
		$c = conexionBD::conexionPDO();
		$sql = "CALL SP_LISTAR_PEDIDOS_FECHA(?,?)";
		$arreglo = array();
		$query = $c->prepare($sql); //mandamos el precedure
		$query->bindParam(1, $finicio); //enviamos los parametros seguun la posicion
		$query->bindParam(2, $ffin);

		$query->execute();
		$resultado = $query->fetchAll(PDO::FETCH_ASSOC);
		foreach ($resultado as $resp) {
			$arreglo["data"][] = $resp; //almacenando los datos del arreglo
		}
		return $arreglo;
		conexionBD::cerrar_conexion();
	}

	/**************************************************
 		       LISTAR DETAALLE PEDIDO 
	 **************************************************/
	public function Listar_Detalle_Pedidos($idpedido)
	{
		$c = conexionBD::conexionPDO();
		$sql = "CALL SP_LISTA_DETALLE_PEDIDO(?)";
		$arreglo = array();
		$query = $c->prepare($sql); //mandamos el precedure
		$query->bindParam(1, $idpedido); //enviamos los parametros seguun la posicion
		

		$query->execute();
		$resultado = $query->fetchAll(PDO::FETCH_ASSOC);
		foreach ($resultado as $resp) {
			$arreglo["data"][] = $resp; //almacenando los datos del arreglo
		}
		return $arreglo;
		conexionBD::cerrar_conexion();
	}


	/**************************************************
 		       ACTUALIZAR ESTADO DEL PEDIDO
	 **************************************************/
	public function Actualizar_estado_Pedido($estadopedi, $pedidoid) //viene del controlador
	{
		$c = conexionBD::conexionPDO();

		$sql = "CALL SP_ACTUALIZAR_ESTADO_PEDIDO(?,?)";
		$query = $c->prepare($sql); //mandamos el precedure
		$query->bindParam(1, $estadopedi);
		$query->bindParam(2, $pedidoid);
		$resultado = $query->execute();
		//solo de usa cuando no se retorna un valor en el procedure(actualizar)
		if ($resultado) {
			return 1;
		} else {
			return 0;
		}
		conexionBD::cerrar_conexion();
	}
}
