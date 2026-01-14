<?php
//comunica con el servidor para consultar
require_once 'modelo_conexion.php';

/**
 * 
 */
class Modelo_Cliente extends conexionBD
{

	/**************************************************
				LISTAR CLIENTE
	 **************************************************/
	public function Listar_Cliente($sucurid, $rolid)
	{
		$c = conexionBD::conexionPDO();
		$sql = "CALL SP_LISTAR_CLIENTE(?,?)";
		$arreglo = array();
		$query = $c->prepare($sql); //mandamos el precedure
		$query->bindParam(1, $sucurid);
		$query->bindParam(2, $rolid);

		$query->execute();
		$resultado = $query->fetchAll(PDO::FETCH_ASSOC);
		foreach ($resultado as $resp) {
			$arreglo["data"][] = $resp; //almacenando los datos del arreglo
		}
		return $arreglo;
		conexionBD::cerrar_conexion();
	}

	/**************************************************
				LISTAR PROVEEDOR
	 **************************************************/
	public function Listar_Proveedor($sucurid, $rolid)
	{
		$c = conexionBD::conexionPDO();
		$sql = "CALL SP_LISTAR_PROVEEDOR(?,?)";
		$arreglo = array();
		$query = $c->prepare($sql); //mandamos el precedure
		$query->bindParam(1, $sucurid);
		$query->bindParam(2, $rolid);

		$query->execute();
		$resultado = $query->fetchAll(PDO::FETCH_ASSOC);
		foreach ($resultado as $resp) {
			$arreglo["data"][] = $resp; //almacenando los datos del arreglo
		}
		return $arreglo;
		conexionBD::cerrar_conexion();
	}


	/**************************************************
				LISTAR CLIENTE
	 **************************************************/
	public function Listar_Movimientos_Cliente($clienteid)
	{
		$c = conexionBD::conexionPDO();
		$sql = "CALL SP_MOVIMIENTOS_PROD_CLIENTE(?)";
		$arreglo = array();
		$query = $c->prepare($sql); //mandamos el precedure
		$query->bindParam(1, $clienteid);//enviamos los parametros seguun la posicion
		$query->execute();
		$resultado = $query->fetchAll(PDO::FETCH_ASSOC);
		foreach ($resultado as $resp) {
			$arreglo["data"][] = $resp; //almacenando los datos del arreglo
		}
		return $arreglo;
		conexionBD::cerrar_conexion();
	}


	/**************************************************
				VER EL DETALLE DE LA VENTA POR EL ID
		   **************************************************/
	public function Ver_detalle_Compras($idprovee, $finicio, $ffin)
	{
		$c = conexionBD::conexionPDO();
		$sql = "CALL SP_VER_DETALLE_COMPRAS_X_PROVEE(?,?,?)";
		$arreglo = array();
		$query = $c->prepare($sql);//mandamos el precedure
		$query->bindParam(1, $idprovee);//enviamos los parametros seguun la posicion
		$query->bindParam(2, $finicio);
		$query->bindParam(3, $ffin);
		$query->execute();
		$resultado = $query->fetchAll(PDO::FETCH_ASSOC);
		foreach ($resultado as $resp) {
			$arreglo["data"][] = $resp;//almacenando los datos del arreglo
		}
		return $arreglo;
		conexionBD::cerrar_conexion();
	}



	/**************************************************
				REGISTRAR CLIENTE
	 **************************************************/
	public function Registrar_Cliente($nombre, $dni, $cel, $direccion, $apellidop, $apellidom, $correo, $tipo_doc, $sucurid, $listanegra)
	{
		$c = conexionBD::conexionPDO();

		$sql = "CALL SP_REGISTRAR_CLIENTE(?,?,?,?,?,?, ?,?,?,?)";
		$query = $c->prepare($sql);

		$query->bindParam(1, $nombre);
		$query->bindParam(2, $dni);
		$query->bindParam(3, $cel);
		$query->bindParam(4, $direccion);
		$query->bindParam(5, $apellidop);
		$query->bindParam(6, $apellidom);
		$query->bindParam(7, $correo);
		$query->bindParam(8, $tipo_doc);
		$query->bindParam(9, $sucurid);
		$query->bindParam(10, $listanegra);



		try {
			$resultado = $query->execute();
			//cuando en el procedure retorna 1 o 2
			if ($row = $query->fetchColumn()) {
				return $row;
			}
			// If no column returned, maybe it's just success without output?
			// But the controller expects a number.
			// Let's check for error info
			$err = $query->errorInfo();
			if ($err[0] != '00000') {
				return "Error DB: " . $err[2];
			}
			return 0; // No ID returned
		} catch (Exception $e) {
			return "Excepcion: " . $e->getMessage();
		}
		conexionBD::cerrar_conexion();
	}




	/**************************************************
				MODIFICAR CLIENTE
	 **************************************************/
	//modificar Rol
	public function Modificar_Cliente($id, $nombre, $dni, $cel, $estado, $direccion, $apellidop, $apellidom, $correo, $tipo_doc, $listanegra) //viene del controlador
	{
		$c = conexionBD::conexionPDO();

		$sql = "CALL SP_MODIFICAR_CLIENTE(?,?,?,?,?,?,?,?,?,?,?)";
		$query = $c->prepare($sql); //mandamos el precedure

		$query->bindParam(1, $id); //enviamos los parametros seguun la posicion del procedure
		$query->bindParam(2, $nombre);
		$query->bindParam(3, $dni);
		$query->bindParam(4, $cel);
		$query->bindParam(5, $estado);
		$query->bindParam(6, $direccion);
		$query->bindParam(7, $apellidop);
		$query->bindParam(8, $apellidom);
		$query->bindParam(9, $correo);
		$query->bindParam(10, $tipo_doc);
		$query->bindParam(11, $listanegra);
		$resultado = $query->execute();
		//cuando en el procedure retorna 1 o 2 (GUARDAR)
		if ($row = $query->fetchColumn()) {
			return $row;
		}

		conexionBD::cerrar_conexion();
	}
}