<?php 
	//comunica con el servidor para consultar
	require_once 'modelo_conexion.php';

	/**
	 * 
	 */
	class Modelo_Reporte_Venta extends conexionBD
	{
		
		 /**************************************************
 		       LISTAR VENTAS POR MES Y AÑO
 		  **************************************************/
		 public function Listar_Venta_Mes_Anio($mes,$anio, $sucursa)
		 {
			$c = conexionBD:: conexionPDO();
			$sql = "CALL SP_REPORTE_VENTA_MES(?,?,?)";
			$arreglo = array();
			$query = $c->prepare($sql);//mandamos el precedure
			$query ->bindParam(1,$mes);//enviamos los parametros seguun la posicion
			$query ->bindParam(2,$anio);
			$query ->bindParam(3,$sucursa);
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
		 public function Listar_select_Anio_Venta_mes()
		 {
			$c = conexionBD:: conexionPDO();

			$sql = "CALL SP_LISTAR_SELECT_ANIO_VENTA()";
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
 		       LISTAR VENTAS TOTAL ANUALES
 		  **************************************************/
		 public function Listar_Venta_Total_anual()
		 {
			$c = conexionBD:: conexionPDO();
			$sql = "CALL SP_REPORTE_VENTA_TOTAL()";
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
 		      PIVOT
 		  **************************************************/
		   public function Pivot_ventas($sucursa)
		   {
			  $c = conexionBD:: conexionPDO();
			  $sql = "CALL SP_PIVOT_VENTAS(?)";
			  $arreglo = array();
			  $query = $c->prepare($sql);//mandamos el precedure
			  $query ->bindParam(1,$sucursa);//enviamos los parametros seguun la posicion
			  $query ->execute();
			  $resultado = $query->fetchAll(PDO::FETCH_ASSOC);
			  foreach ($resultado as $resp) {
					  $arreglo["data"][]=$resp;//almacenando los datos del arreglo
			  }
			  return $arreglo;
			  conexionBD::cerrar_conexion();
		   }



		    /**************************************************
 		       LISTAR VENTAS POR AÑO
 		  **************************************************/
		 public function Listar_Venta_AnioM($anio, $sucursa)
		 {
			$c = conexionBD:: conexionPDO();
			$sql = "CALL SP_REPORTE_VENTA_ANIO(?,?)";
			$arreglo = array();
			$query = $c->prepare($sql);//mandamos el precedure
			$query ->bindParam(1,$anio);//enviamos los parametros seguun la posicion
			$query ->bindParam(2,$sucursa);
			$query ->execute();
			$resultado = $query->fetchAll(PDO::FETCH_ASSOC);
			foreach ($resultado as $resp) {
			        $arreglo["data"][]=$resp;//almacenando los datos del arreglo
			}
			return $arreglo;
			conexionBD::cerrar_conexion();
		 }




	  /**************************************************
 		       LISTAR RECORD DE VENTAS POR AÑO
 		  **************************************************/
		   public function Listar_Record_Venta_usuario_a($anio, $sucursa)
		   {
			  $c = conexionBD:: conexionPDO();
			  $sql = "CALL SP_REPORTE_VENTA_POR_ANIO_USUARIO(?,?)";
			  $arreglo = array();
			  $query = $c->prepare($sql);//mandamos el precedure
			  $query ->bindParam(1,$anio);//enviamos los parametros seguun la posicion
			  $query ->bindParam(2,$sucursa);
			  $query ->execute();
			  $resultado = $query->fetchAll(PDO::FETCH_ASSOC);
			  foreach ($resultado as $resp) {
					  $arreglo["data"][]=$resp;//almacenando los datos del arreglo
			  }
			  return $arreglo;
			  conexionBD::cerrar_conexion();
		   }


		    /**************************************************
 		       LISTAR RECORD DE VENTAS DETALLADO POR USUARIO
 		  **************************************************/
		   public function Listar_Record_usuario_Detallado($usuario,$anio, $sucursa)
		   {
			  $c = conexionBD:: conexionPDO();
			  $sql = "CALL SP_REPORTE_VENTA_POR_ANIO_MES_USUARIO(?,?,?)";
			  $arreglo = array();
			  $query = $c->prepare($sql);//mandamos el precedure
			  $query ->bindParam(1,$usuario);//enviamos los parametros seguun la posicion
			  $query ->bindParam(2,$anio);
			  $query ->bindParam(3,$sucursa);
			  $query ->execute();
			  $resultado = $query->fetchAll(PDO::FETCH_ASSOC);
			  foreach ($resultado as $resp) {
					  $arreglo["data"][]=$resp;//almacenando los datos del arreglo
			  }
			  return $arreglo;
			  conexionBD::cerrar_conexion();
		   }



		   /**************************************************
 		       LISTAR USUARIOS EN COMBO
 		  **************************************************/
		 public function Listar_select_Usuarios()
		 {
			$c = conexionBD:: conexionPDO();

			$sql = "call SP_LISTAR_SELECT_USUARIO_RECORD()";
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
 		       LISTAR VENTA DEL DIA POR FILTRO DE FECHA
 		  **************************************************/
		   public function Listar_Ventas_del_dia($finicio,$ffin, $sucursa)
		   {
			  $c = conexionBD:: conexionPDO();
			  $sql = "CALL SP_REPORTE_VENTA_DEL_DIA(?,?,?)";
			  $arreglo = array();
			  $query = $c->prepare($sql);//mandamos el precedure
			  $query ->bindParam(1,$finicio);//enviamos los parametros seguun la posicion
			  $query ->bindParam(2,$ffin);
			  $query ->bindParam(3,$sucursa);
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