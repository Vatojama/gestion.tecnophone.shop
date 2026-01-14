<?php 
	//comunica con el servidor para consultar
	require_once 'modelo_conexion.php';

	/**
	 * 
	 */
	class Modelo_Marca extends conexionBD
	{
		
		 /**************************************************
 		       LISTAR LA MARCA
 		  **************************************************/
		 public function Listar_Marca()
		 {
			$c = conexionBD:: conexionPDO();
			$sql = "CALL SP_LISTAR_MARCA()";
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
 		       REGISTRAR LA MARCA
 		  **************************************************/
		 public function Registrar_Marca($marca)//viene del controlador
		 {
			$c = conexionBD:: conexionPDO();

			$sql = "CALL SP_REGISTRAR_MARCA(?)";
			$query = $c->prepare($sql);//mandamos el precedure

			$query ->bindParam(1,$marca);//enviamos los parametros seguun la posicion del procedure

			$resultado = $query ->execute();
			//cuando en el procedure retorna 1 o 2
			if ($row = $query->fetchColumn()) {
				return $row;
			}
			conexionBD::cerrar_conexion();
		 }



		 /**************************************************
 		       MODIFICAR LA MARCA
 		  **************************************************/
		 public function Modificar_Marca($id,$marca,$estado)//viene del controlador
		 {
			$c = conexionBD:: conexionPDO();

			$sql = "CALL SP_MODIFICAR_MARCA(?,?,?)";
			$query = $c->prepare($sql);//mandamos el precedure

			$query ->bindParam(1,$id);//enviamos los parametros seguun la posicion del procedure
			$query ->bindParam(2,$marca);
			$query ->bindParam(3,$estado);
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
 		       ELIMINAR LA MARCA
 		  **************************************************/
		 public function Eliminar_Marca($id)//viene del controlador
		 {
			$c = conexionBD:: conexionPDO();

			$sql = "CALL SP_ELIMINAR_MARCA(?)";
			$query = $c->prepare($sql);//mandamos el precedure
			$query ->bindParam(1,$id);//enviamos los parametros seguun la posicion del procedure
			$resultado = $query ->execute();
			//solo de usa cuando no se retorna un valor en el procedure(actualizar)
			if($resultado){
				return 1;
			}else{
				return 0;
			}
			conexionBD::cerrar_conexion();
		 }









}


 ?>