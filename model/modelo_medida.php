<?php 
	//comunica con el servidor para consultar
	require_once 'modelo_conexion.php';

	/**
	 * 
	 */
	class Modelo_Medida extends conexionBD
	{
		
		 /**************************************************
 		       LISTAR LA UNIDAD MEDIDA
 		  **************************************************/
		 public function Listar_Unidad_medida()
		 {
			$c = conexionBD:: conexionPDO();
			$sql = "CALL SP_LISTAR_UNIDAD_MEDIDA()";
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
 		       REGISTRAR LA UNIDAD MEDIDA
 		  **************************************************/
		 public function Registrar_Unidad_medida($descripcion,$abreviatura)//viene del controlador
		 {
			$c = conexionBD:: conexionPDO();

			$sql = "CALL SP_REGISTRAR_UNIDAD_MEDIDA(?,?)";
			$query = $c->prepare($sql);//mandamos el precedure

			$query ->bindParam(1,$descripcion);//enviamos los parametros seguun la posicion del procedure
            $query ->bindParam(2,$abreviatura);
			$resultado = $query ->execute();
			//cuando en el procedure retorna 1 o 2
			if ($row = $query->fetchColumn()) {
				return $row;
			}
			conexionBD::cerrar_conexion();
		 }


           /**************************************************
 		       MODIFICAR LA UNIDAD MEDIDA
 		  **************************************************/
		 //modificar Rol
		 public function Modificar_Unidad_medida($idmedida,$descripcion,$abreviatura,$estado)//viene del controlador
		 {
			$c = conexionBD:: conexionPDO();

			$sql = "CALL SP_MODIFICAR_UNIDAD_MEDIDA(?,?,?,?)";
			$query = $c->prepare($sql);//mandamos el precedure

			$query ->bindParam(1,$idmedida);//enviamos los parametros seguun la posicion del procedure
			$query ->bindParam(2,$descripcion);
            $query ->bindParam(3,$abreviatura);
			$query ->bindParam(4,$estado);
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
 		       ELIMINAR LA MEDIDA
 		  **************************************************/
		   public function Eliminar_UMedida($id)//viene del controlador
		   {
			  $c = conexionBD:: conexionPDO();
  
			  $sql = "CALL SP_ELIMINAR_UMEDIDA(?)";
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