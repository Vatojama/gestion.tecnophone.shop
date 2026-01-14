<?php 
	//comunica con el servidor para consultar
	require_once 'modelo_conexion.php';

	/**
	 * 
	 */
	class Modelo_Categoria extends conexionBD
	{
		
		 /**************************************************
 		       LISTAR LA CATEGORIA
 		  **************************************************/
		 public function Listar_Categoria()
		 {
			$c = conexionBD:: conexionPDO();
			$sql = "CALL SP_LISTAR_CATEGORIA()";
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
 		       REGISTRAR CATEGORIA
 		  **************************************************/
		 public function Registrar_Categoria($categoria)//viene del controlador
		 {
			$c = conexionBD:: conexionPDO();

			$sql = "CALL SP_REGISTRAR_CATEGORIA(?)";
			$query = $c->prepare($sql);//mandamos el precedure

			$query ->bindParam(1,$categoria);//enviamos los parametros seguun la posicion del procedure

			$resultado = $query ->execute();
			//cuando en el procedure retorna 1 o 2
			if ($row = $query->fetchColumn()) {
				return $row;
			}
			conexionBD::cerrar_conexion();
		 }




		  /**************************************************
 		       MODIFICAR CATEGORIA
 		  **************************************************/
		 //modificar Rol
		 public function Modificar_Categoria($id,$categoria,$estado)//viene del controlador
		 {
			$c = conexionBD:: conexionPDO();

			$sql = "CALL SP_MODIFICAR_CATEGORIA(?,?,?)";
			$query = $c->prepare($sql);//mandamos el precedure

			$query ->bindParam(1,$id);//enviamos los parametros seguun la posicion del procedure
			$query ->bindParam(2,$categoria);
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









}


 ?>