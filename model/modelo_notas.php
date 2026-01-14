<?php
//comunica con el servidor para consultar
require_once 'modelo_conexion.php';

/**
 * 
 */
class Modelo_Notas extends conexionBD
{

	/**************************************************
 		       LISTAR ROLES EN COMBO
	 **************************************************/
	public function Listar_Notas_por_usuario($idusuario)
	{
		$c = conexionBD::conexionPDO();

		$sql = "CALL SP_LISTAR_NOTAS_X_USUARIO(?)";
		$arreglo = array();
		$query = $c->prepare($sql); //mandamos el precedure
		$query->bindParam(1, $idusuario); //enviamos los parametros seguun la posicion
		$query->execute();
		$resultado = $query->fetchAll();
		foreach ($resultado as $resp) {
			$arreglo[] = $resp; //almacenando los datos del arreglo


		}
		return $arreglo;
		conexionBD::cerrar_conexion();
	}


	//REGISTRAR NOTAS
	public function Registra_Notas($notas_r, $idusunot_r) //viene del controlador
	{
		$c = conexionBD::conexionPDO();

		$sql = "CALL SP_REGISTRAR_NOTAS(?,?)";
		$query = $c->prepare($sql); //mandamos el precedure

		$query->bindParam(1, $notas_r); //enviamos los parametros seguun la posicion del procedure
		$query->bindParam(2, $idusunot_r);
		$resultado = $query->execute();
		//solo de usa cuando no se retorna un valor en el procedure
		if ($resultado) {
			return 1;
		} else {
			return 0;
		}
		conexionBD::cerrar_conexion();
	}


	/**************************************************
 		       TRAER DATA DE LA NOTAS
	 **************************************************/
	public function Traer_Data_Notas_editar($idnota)
	{
		$c = conexionBD::conexionPDO();
		$sql = "CALL SP_TRAER_DATA_NOTAS_EDITAR(?)";
		$arreglo = array();
		$query = $c->prepare($sql); //mandamos el precedure
		$query->bindParam(1, $idnota);
		$query->execute();
		$resultado = $query->fetchAll();
		// foreach ($resultado as $resp) {
		// 	$arreglo[]=$resp;
		// }
		foreach ($resultado as $resp) {
			$arreglo[] = $resp; //almacenando los datos del arreglo
		}
		return $arreglo;
		conexionBD::cerrar_conexion();
	}

	public function Modificar_Notas($idnotas_e, $notas_e)
	{
		$c = conexionBD::conexionPDO();

		$sql = "CALL SP_MODIFICAR_NOTAS(?,?)";
		$query = $c->prepare($sql); //mandamos el precedure
		$query->bindParam(1, $idnotas_e); //enviamos los parametros seguun la posicion del procedure
		$query->bindParam(2, $notas_e);
		$resultado = $query->execute();
		//solo de usa cuando no se retorna un valor en el procedure
		if ($resultado) {
			return 1;
		} else {
			return 0;
		}
		conexionBD::cerrar_conexion();
	}


	public function Eliminar_Notas($id)
	{
		$c = conexionBD::conexionPDO();

		$sql = "CALL SP_ELIMINAR_NOTAS(?)";
		$query = $c->prepare($sql); //mandamos el precedure
		$query->bindParam(1, $id); //enviamos los parametros seguun la posicion del procedure
		$resultado = $query->execute();
		//solo de usa cuando no se retorna un valor en el procedure
		if ($resultado) {
			return 1;
		} else {
			return 0;
		}
		conexionBD::cerrar_conexion();
	}
}
