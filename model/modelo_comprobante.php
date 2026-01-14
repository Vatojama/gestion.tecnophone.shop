<?php 
	//comunica con el servidor para consultar
	require_once 'modelo_conexion.php';

	/**
	 * 
	 */
	class Modelo_Comprobante extends conexionBD
	{
		
		 /**************************************************
 		       LISTAR COMPROBANTE
 		  **************************************************/
		 public function Listar_Comprobante()
		 {
			$c = conexionBD:: conexionPDO();
			$sql = "CALL SP_LISTAR_COMPROBANTE()";
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
 		       REGISTRAR COMPROBANTE
 		  **************************************************/
		 public function Registrar_Comprobante($tipo,$serie,$numeroc)//viene del controlador
		 {
			$c = conexionBD:: conexionPDO();

			$sql = "CALL SP_REGISTRAR_COMPROBANTE(?,?,?)";
			$query = $c->prepare($sql);//mandamos el precedure

			$query ->bindParam(1,$tipo);//enviamos los parametros seguun la posicion del procedure
			$query ->bindParam(2,$serie);
			$query ->bindParam(3,$numeroc);
			$resultado = $query ->execute();

			//solo de usa cuando no se retorna un valor en el procedure(actualizar)
			if($resultado){
				return 1;
			}else{
				return 0;
			}
			conexionBD::cerrar_conexion();
		 }



		  /**************************************************
 		       MODIFICAR COMPROBANTE
 		  **************************************************/
		 public function Modificar_Comprobante($id,$tipo,$serie,$numeroc,$estado)//viene del controlador
		 {
			$c = conexionBD:: conexionPDO();

			$sql = "CALL SP_MODIFICAR_COMPROBANTE(?,?,?,?,?)";
			$query = $c->prepare($sql);//mandamos el precedure
			$query ->bindParam(1,$id);
			$query ->bindParam(2,$tipo);//enviamos los parametros seguun la posicion del procedure
			$query ->bindParam(3,$serie);
			$query ->bindParam(4,$numeroc);
			$query ->bindParam(5,$estado);
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
