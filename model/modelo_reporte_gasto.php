<?php 
	//comunica con el servidor para consultar
	require_once 'modelo_conexion.php';

	/**
	 * 
	 */
	class Modelo_Reporte_Gasto extends conexionBD
	{
		
		 /**************************************************
 		       LISTAR EL GASTO POR MES
 		  **************************************************/
		 public function Listar_Gasto_Mes($mes, $sucursa)
		 {
			$c = conexionBD:: conexionPDO();
			$sql = "CALL SP_REPORTE_GASTO_MES(?,?)";
			$arreglo = array();
			$query = $c->prepare($sql);//mandamos el precedure
			$query ->bindParam(1,$mes);//enviamos los parametros seguun la posicion
			$query ->bindParam(2,$sucursa);//enviamos los parametros seguun la posicion

			$query ->execute();
			$resultado = $query->fetchAll(PDO::FETCH_ASSOC);
			foreach ($resultado as $resp) {
			        $arreglo["data"][]=$resp;//almacenando los datos del arreglo
			}
			return $arreglo;
			conexionBD::cerrar_conexion();
		 }






		  /**************************************************
 		      LISTAR AÑOS EN COMBO
 		  **************************************************/
		 public function Listar_select_Anio_Gasto()
		 {
			$c = conexionBD:: conexionPDO();

			$sql = "CALL SP_LISTAR_ANIO_GASTO()";
			$arreglo = array();
			$query = $c->prepare($sql);//mandamos el precedure
			//$query ->bindParam(1,$usuario);//enviamos los parametros seguun la posicion
			$query ->execute();
			$resultado = $query->fetchAll();
			foreach ($resultado as $resp) {
			        $arreglo[]=$resp;//almacenando los datos del arreglo
			

			}
			return $arreglo;
			conexionBD::cerrar_conexion();
		 }







		  /**************************************************
 		       LISTAR GASTOS POR AÑO
 		  **************************************************/
		 public function Listar_Gasto_Anio($anio, $sucursa)
		 {
			$c = conexionBD:: conexionPDO();
			$sql = "CALL SP_REPORTE_GASTO_ANUAL(?,?)";
			$arreglo = array();
			$query = $c->prepare($sql);//mandamos el precedure
			$query ->bindParam(1,$anio);//enviamos los parametros seguun la posicion
			$query ->bindParam(2,$sucursa);//enviamos los parametros seguun la posicion

			$query ->execute();
			$resultado = $query->fetchAll(PDO::FETCH_ASSOC);
			foreach ($resultado as $resp) {
			        $arreglo["data"][]=$resp;//almacenando los datos del arreglo
			}
			return $arreglo;
			conexionBD::cerrar_conexion();
		 }





		   /**************************************************
 		       LISTAR GASTOS TOTALLL POR AÑO
 		  **************************************************/
		 public function Listar_Gasto_Total_Anio()
		 {
			$c = conexionBD:: conexionPDO();
			$sql = "CALL SP_REPORTE_GASTO_TOTAL_ANUAL()";
			$arreglo = array();
			$query = $c->prepare($sql);//mandamos el precedure
			$query ->execute();
			$resultado = $query->fetchAll(PDO::FETCH_ASSOC);
			foreach ($resultado as $resp) {
			        $arreglo["data"][]=$resp;//almacenando los datos del arreglo
			}
			return $arreglo;
			conexionBD::cerrar_conexion();
		 }








}


 ?>