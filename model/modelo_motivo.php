<?php 
	//comunica con el servidor para consultar
	require_once 'modelo_conexion.php';

	/**
	 * 
	 */
	class Modelo_Motivo extends conexionBD
	{
		
		 /**************************************************
 		       LISTAR EL MOTIVO
 		  **************************************************/
		 public function Listar_Motivo()
		 {
			$c = conexionBD:: conexionPDO();
			$sql = "CALL SP_LISTAR_MOTIVO()";
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
 		       REGISTRAR EL MOTIVO
 		  **************************************************/
		 public function Registrar_Motivo($motivo)//viene del controlador
		 {
			$c = conexionBD:: conexionPDO();

			$sql = "CALL SP_REGISTRAR_MOTIVO(?)";
			$query = $c->prepare($sql);//mandamos el precedure

			$query ->bindParam(1,$motivo);//enviamos los parametros seguun la posicion del procedure

			$resultado = $query ->execute();
			//cuando en el procedure retorna 1 o 2
			if ($row = $query->fetchColumn()) {
				return $row;
			}
			conexionBD::cerrar_conexion();
		 }




		  /**************************************************
 		       MODIFICAR MOTIVO
 		  **************************************************/
		 //modificar Rol
		 public function Modificar_Motivo($id,$motivo,$estado)//viene del controlador
		 {
			$c = conexionBD:: conexionPDO();

			$sql = "CALL SP_MODIFICAR_MOTIVO(?,?,?)";
			$query = $c->prepare($sql);//mandamos el precedure

			$query ->bindParam(1,$id);//enviamos los parametros seguun la posicion del procedure
			$query ->bindParam(2,$motivo);
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