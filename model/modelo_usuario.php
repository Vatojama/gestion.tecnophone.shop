<?php
//comunica con el servidor para consultar
require_once __DIR__ . '/modelo_conexion.php';

/**
 * 
 */
class Modelo_Usuario extends conexionBD
{

	public function VerificarUsuario($usuario, $password)
	{

		/**************************************************
		 VERIFICAR SI ESTA REGISTRADO EN LA BD Y QUE CONICIDA EL USU
		 **************************************************/
		$c = conexionBD::conexionPDO();
		$sql = "CALL SP_VERIFICAR_USUARIO(?)";
		$arreglo = array();
		$query = $c->prepare($sql);//mandamos el precedure
		$query->bindParam(1, $usuario);//enviamos los parametros seguun la posicion
		$query->execute();
		$resultado = $query->fetchAll();
		foreach ($resultado as $resp) {
			// MODIFICACIÓN: Soporte híbrido para MD5 (Legacy) y Bcrypt (Seguro)
			if (password_verify($password, $resp['usu_contrasena']) || md5($password) == $resp['usu_contrasena']) {
				$arreglo[] = $resp; // Contraseña correcta (ya sea hash nuevo o antiguo)
			}
		}
		return $arreglo;
		conexionBD::cerrar_conexion();
	}



	/**************************************************
		   LISTAR USUARIOS EN DATATABLE
	 **************************************************/
	public function Listar_usuario()
	{
		$c = conexionBD::conexionPDO();
		$sql = "CALL SP_LISTAR_USUARIO()";
		$arreglo = array();
		$query = $c->prepare($sql);//mandamos el precedure
		//$query ->bindParam(1,$usuario);//enviamos los parametros seguun la posicion
		$query->execute();
		$resultado = $query->fetchAll(PDO::FETCH_ASSOC);
		foreach ($resultado as $resp) {
			$arreglo["data"][] = $resp;//almacenando los datos del arreglo


		}
		return $arreglo;
		conexionBD::cerrar_conexion();
	}




	/**************************************************
		   LISTAR ROLES EN COMBO
	 **************************************************/
	public function Listar_select_rol()
	{
		$c = conexionBD::conexionPDO();
		$sql = "CALL SP_LISTAR_SELECT_ROL()";
		$arreglo = array();
		$query = $c->prepare($sql);//mandamos el precedure
		//$query ->bindParam(1,$usuario);//enviamos los parametros seguun la posicion
		$query->execute();
		$resultado = $query->fetchAll();
		foreach ($resultado as $resp) {
			$arreglo[] = $resp;//almacenando los datos del arreglo
		}
		return $arreglo;
		conexionBD::cerrar_conexion();
	}

	/**************************************************
		  LISTAR SUCURSALES EN COMBO
	**************************************************/
	public function Listar_select_Sucursal()
	{
		$c = conexionBD::conexionPDO();
		$sql = "CALL SP_LISTAR_SELECT_SUCURSAL()";
		$arreglo = array();
		$query = $c->prepare($sql);//mandamos el precedure
		//$query ->bindParam(1,$usuario);//enviamos los parametros seguun la posicion
		$query->execute();
		$resultado = $query->fetchAll();
		foreach ($resultado as $resp) {
			$arreglo[] = $resp;//almacenando los datos del arreglo
		}
		return $arreglo;
		conexionBD::cerrar_conexion();
	}



	/**************************************************
		  LISTAR PERMISOS
	**************************************************/
	public function Listar_select_Permisos()
	{
		$c = conexionBD::conexionPDO();

		$sql = "CALL SP_SELECT_PERMISOS()";
		$arreglo = array();
		$query = $c->prepare($sql);//mandamos el precedure
		//$query ->bindParam(1,$usuario);//enviamos los parametros seguun la posicion
		$query->execute();
		$resultado = $query->fetchAll();
		foreach ($resultado as $resp) {
			$arreglo[] = $resp;//almacenando los datos del arreglo
		}
		return $arreglo;
		conexionBD::cerrar_conexion();
	}





	/**************************************************
		 REGISTRAR USUARIOS
	 **************************************************/
	public function Registrar_Usuario($usuario, $clave, $correo, $rol, $ruta, $sucuid)
	{
		$c = conexionBD::conexionPDO();

		$sql = "CALL SP_REGISTRAR_USUARIOS(?,?,?,?,?,?)";
		$query = $c->prepare($sql);//mandamos el precedure
		$query->bindParam(1, $usuario);//enviamos los parametros seguun la posicion
		$query->bindParam(2, $clave);
		$query->bindParam(3, $correo);
		$query->bindParam(4, $rol);
		$query->bindParam(5, $ruta);
		$query->bindParam(6, $sucuid);
		$resultado = $query->execute();
		if ($row = $query->fetchColumn()) {
			return $row;
		}

		//solo de usa cuando no se retorna un valor en el procedure
		/*if($resultado){
			return 1;
		}else{
			return 0;
		}*/

		conexionBD::cerrar_conexion();
	}




	/**************************************************
		  MODIFICAR USUARIOS
	 **************************************************/
	public function Modificar_Usuario($id, $usuario, $correo, $rol, $sucuid)//viene del controlador
	{
		$c = conexionBD::conexionPDO();

		$sql = "CALL SP_MODIFICAR_USUARIO(?,?,?,?,?)";
		$query = $c->prepare($sql);//mandamos el precedure
		$query->bindParam(1, $id);
		$query->bindParam(2, $usuario);//enviamos los parametros seguun la posicion del procedure
		$query->bindParam(3, $correo);
		$query->bindParam(4, $rol);
		$query->bindParam(5, $sucuid);
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
		  CAMBIAR ESTADO DE USUARIO
	 **************************************************/
	public function Modificar_Usuario_estado($id, $estado)//viene del controlador
	{
		$c = conexionBD::conexionPDO();

		$sql = "CALL SP_MODIFICAR_USUARIO_ESTADO(?,?)";
		$query = $c->prepare($sql);//mandamos el precedure
		$query->bindParam(1, $id);
		$query->bindParam(2, $estado);//enviamos los parametros seguun la posicion del procedure
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
		   CAMBIAR FOTO DE USUARIO
	 **************************************************/
	public function Modificar_Foto_Usuario($id, $ruta)//viene del controlador
	{
		$c = conexionBD::conexionPDO();

		$sql = "CALL SP_MODIFICAR_FOTO_USUARIO(?,?)";
		$query = $c->prepare($sql);//mandamos el precedure
		$query->bindParam(1, $id);
		$query->bindParam(2, $ruta);//enviamos los parametros seguun la posicion del procedure
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
		  CAMBIAR CLAVE DE USUARIO
	 **************************************************/
	public function Modificar_Usuario_clave($id, $clave)//viene del controlador
	{
		$c = conexionBD::conexionPDO();

		$sql = "CALL SP_MODIFICAR_CLAVE_USUARIO(?,?)";
		$query = $c->prepare($sql);//mandamos el precedure
		$query->bindParam(1, $id);
		$query->bindParam(2, $clave);//enviamos los parametros seguun la posicion del procedure
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
		  DATOS PARA EL PERFIL DEL USUARIO
	 **************************************************/
	public function Listar_datos_perfil($idusuario)
	{
		$c = conexionBD::conexionPDO();
		$sql = "CALL SP_DATOS_PERFIL_USUARIO(?)";
		$arreglo = array();
		$query = $c->prepare($sql);//mandamos el precedure
		$query->bindParam(1, $idusuario);//enviamos los parametros seguun la posicion
		$query->execute();
		$resultado = $query->fetchAll(PDO::FETCH_ASSOC);
		foreach ($resultado as $resp) {
			$arreglo["data"][] = $resp;//almacenando los datos del arreglo
		}
		return $arreglo;
		conexionBD::cerrar_conexion();
	}

	/**************************************************
		DATOS PARA EL PLAN DEL CLIENTE
   **************************************************/
	public function Listar_datos_Plan()
	{
		$c = conexionBD::conexionPDO();
		$sql = "CALL SP_LSTAR_PLAN()";
		$arreglo = array();
		$query = $c->prepare($sql);//mandamos el precedure
		// $query ->bindParam(1,$idusuario);//enviamos los parametros seguun la posicion
		$query->execute();
		$resultado = $query->fetchAll(PDO::FETCH_ASSOC);
		foreach ($resultado as $resp) {
			$arreglo["data"][] = $resp;//almacenando los datos del arreglo
		}
		return $arreglo;
		conexionBD::cerrar_conexion();
	}



}


