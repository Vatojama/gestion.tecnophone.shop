<?php
//comunica con el servidor para consultar
require_once __DIR__ . '/modelo_conexion.php';

/**
 * 
 */
class Modelo_Rol extends conexionBD
{


	/**************************************************
				listar Rol
	 **************************************************/
	public function Listar_Rol()
	{
		$c = conexionBD::conexionPDO();
		$sql = "CALL SP_LISTAR_ROL()";
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
				listar PERMISOS POR ROL
	 **************************************************/
	public function Listar_Permisos_x_rol($rol_id)
	{
		$c = conexionBD::conexionPDO();
		$sql = "CALL SP_EJECUTAR_INSERTAR_MENUS_DET(?)";
		$arreglo = array();
		$query = $c->prepare($sql); //mandamos el precedure
		$query->bindParam(1, $rol_id); //enviamos los parametros seguun la posicion
		$query->execute();
		$resultado = $query->fetchAll(PDO::FETCH_ASSOC);
		foreach ($resultado as $resp) {
			$arreglo["data"][] = $resp; //almacenando los datos del arreglo
		}
		return $arreglo;
		conexionBD::cerrar_conexion();
	}

	public function validar_menu_x_rol($rol_id, $men_id)
	{
		$c = conexionBD::conexionPDO();
		$sql = "CALL SP_TRAER_DATOS_MENU_X_ROLYMENU(?,?)";
		$arreglo = array();
		$query = $c->prepare($sql);//mandamos el precedure
		$query->bindParam(1, $rol_id);
		$query->bindParam(2, $men_id);
		$query->execute();
		$resultado = $query->fetchAll(PDO::FETCH_ASSOC);
		foreach ($resultado as $resp) {
			$arreglo["data"][] = $resp;//almacenando los datos del arreglo
		}
		return $arreglo;
		conexionBD::cerrar_conexion();
	}


	public function get_menu_x_rol($rol_id)
	{
		$c = conexionBD::conexionPDO();
		$sql = "CALL SP_MENU_X_ROL_PARAMENU(?)";
		$query = $c->prepare($sql);
		$query->bindParam(1, $rol_id);
		$query->execute();
		$resultado = $query->fetchAll(PDO::FETCH_ASSOC);
		conexionBD::cerrar_conexion();
		return $resultado; // Retorna el array directamente
		// var_dump($resultado);
	}

	public function get_traer_grupos_dinamico()
	{
		$c = conexionBD::conexionPDO();
		$sql = "CALL SP_TRAER_DATA_GRUPO_XMENU()";
		$query = $c->prepare($sql);
		//$query->bindParam(1, $rol_id);
		$query->execute();
		$resultado = $query->fetchAll(PDO::FETCH_ASSOC);
		conexionBD::cerrar_conexion();
		return $resultado; // Retorna el array directamente
	}


	public function get_traer_grupos_dinamico222()
	{
		$c = conexionBD::conexionPDO();
		$sql = "CALL SP_TRAER_DATA_GRUPO_XMENU()";
		$arreglo = array();
		$query = $c->prepare($sql);//mandamos el precedure
		//$query ->bindParam(1,$rol_id);
		//$query ->bindParam(2,$men_id);
		$query->execute();
		$resultado = $query->fetchAll(PDO::FETCH_ASSOC);
		foreach ($resultado as $resp) {
			$arreglo["data"][] = $resp;//almacenando los datos del arreglo
		}
		//var_dump($arreglo);
		return $arreglo;
		conexionBD::cerrar_conexion();
	}



	/**************************************************
				REGISTRAR Rol
	 **************************************************/
	public function Registrar_Rol($rol) //viene del controlador
	{
		$c = conexionBD::conexionPDO();

		$sql = "CALL SP_REGISTRAR_ROL(?)";
		$query = $c->prepare($sql); //mandamos el precedure

		$query->bindParam(1, $rol); //enviamos los parametros seguun la posicion del procedure

		$resultado = $query->execute();
		//cuando en el procedure retorna 1 o 2
		if ($row = $query->fetchColumn()) {
			return $row;
		}
		conexionBD::cerrar_conexion();
	}

	/**************************************************
				MODIFICAR Rol
	 **************************************************/
	public function Modificar_Rol($id, $rol, $estado) //viene del controlador
	{
		$c = conexionBD::conexionPDO();

		$sql = "CALL SP_MODIFICAR_ROL(?,?,?)";
		$query = $c->prepare($sql); //mandamos el precedure

		$query->bindParam(1, $id); //enviamos los parametros seguun la posicion del procedure
		$query->bindParam(2, $rol);
		$query->bindParam(3, $estado);
		$resultado = $query->execute();
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
				REGISTRAR Rol
	 **************************************************/
	public function Registrar_Vista_Inicio($sel_vista_ini, $rolid_vi) //viene del controlador
	{
		$c = conexionBD::conexionPDO();

		$sql = "CALL SP_REGISTRAR_VISTA_INICIO(?,?)";
		$query = $c->prepare($sql); //mandamos el precedure
		$query->bindParam(1, $sel_vista_ini); //enviamos los parametros seguun la posicion del procedure
		$query->bindParam(2, $rolid_vi);
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
				LISTAR ROLES EN COMBO
		  **************************************************/
	public function Listar_select_Vista_ini_activa($idrol)
	{
		$c = conexionBD::conexionPDO();

		$sql = "CALL SP_LISTAR_VISTA_INICIO_ACTIVA(?)";
		$arreglo = array();
		$query = $c->prepare($sql);//mandamos el precedure
		$query->bindParam(1, $idrol);//enviamos los parametros seguun la posicion
		$query->execute();
		$resultado = $query->fetchAll();
		foreach ($resultado as $resp) {
			$arreglo[] = $resp;//almacenando los datos del arreglo


		}
		return $arreglo;
		conexionBD::cerrar_conexion();
	}

	public function Habilitar_permiso($mend_id) //viene del controlador
	{
		$c = conexionBD::conexionPDO();
		$sql = "CALL SP_HABILITAR_PERMISO(?)";
		$query = $c->prepare($sql); //mandamos el precedure
		$query->bindParam(1, $mend_id);
		$resultado = $query->execute();

		if ($resultado) {
			return 1;
		} else {
			return 0;
		}
		conexionBD::cerrar_conexion();
	}

	public function Deshabilitar_permiso($mend_id) //viene del controlador
	{
		$c = conexionBD::conexionPDO();
		$sql = "CALL SP_DESHABILITAR_PERMISO(?)";
		$query = $c->prepare($sql); //mandamos el precedure
		$query->bindParam(1, $mend_id);
		$resultado = $query->execute();

		if ($resultado) {
			return 1;
		} else {
			return 0;
		}
		conexionBD::cerrar_conexion();
	}

	/**************************************************
			   LISTAR ROLES EN COMBO
		 **************************************************/
	public function Listar_select_Vista_ini()
	{
		$c = conexionBD::conexionPDO();

		$sql = "CALL SP_LISTAR_VISTA_INICIO()";
		$arreglo = array();
		$query = $c->prepare($sql);//mandamos el precedure
		// $query ->bindParam(1,$idrol);//enviamos los parametros seguun la posicion
		$query->execute();
		$resultado = $query->fetchAll();
		foreach ($resultado as $resp) {
			$arreglo[] = $resp;//almacenando los datos del arreglo


		}
		return $arreglo;
		conexionBD::cerrar_conexion();
	}
}
