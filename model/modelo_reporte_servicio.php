<?php 
	//comunica con el servidor para consultar
	require_once 'modelo_conexion.php';

	/**
	 * 
	 */
	class Modelo_Reporte_Servicio extends conexionBD
	{
		
		 /**************************************************
 		       LISTAR EL SERVICIO POR MES
 		  **************************************************/
		 public function Listar_Servicio_Mes($mes, $sucursa)
		 {
			$c = conexionBD:: conexionPDO();
			$sql = "CALL SP_REPORTE_SERVICIO_MES(?,?)";
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
		 public function Listar_select_Anio_Servicio()
		 {
			$c = conexionBD:: conexionPDO();

			$sql = "CALL SP_LISTAR_ANIO_SERVICIO()";
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
 		       LISTAR EL SERVICIO POR AÑO
 		  **************************************************/
		 public function Listar_Servicio_Anio($anio, $sucursa)
		 {
			$c = conexionBD:: conexionPDO();
			$sql = "CALL SP_REPORTE_SERVICIO_ANUAL(?,?)";
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
 		       LISTAR EL SERVICIO POR FILTRO DE FECHA Y TECNICO
 		  **************************************************/
		   public function Listar_Servicio_fechas_tecnicoooooooooooooooooo($finicio,$ffin, $tecnico)
		   {
			  $c = conexionBD:: conexionPDO();
			  $sql = "CALL SP_REPORTE_SERVICIO_FECHAS_TECNICO(?,?,?)";
			  $arreglo = array();
			  $query = $c->prepare($sql);
			  $query ->bindParam(1,$finicio);
			  $query ->bindParam(2,$ffin);
			  $query ->bindParam(3,$tecnico);
			  $query ->execute();
			  $resultado = $query->fetchAll(PDO::FETCH_ASSOC);
			  foreach ($resultado as $resp) {
					  $arreglo["data"][]=$resp;
			  }
			  return $arreglo;
			  conexionBD::cerrar_conexion();
		   }

		   public function Listar_Servicio_fechas_tecnico($finicio, $ffin, $tecnico)
			{
				$c = conexionBD::conexionPDO();
				$sql = "CALL SP_REPORTE_SERVICIO_FECHAS_TECNICO(?, ?, ?)";
				$arreglo = array();
				$query = $c->prepare($sql);
				$query->bindParam(1, $finicio);
				$query->bindParam(2, $ffin);
				//$query->bindParam(3, $tecnico);
				
				// Verificar si $tecnico es una cadena vacía y convertirla en NULL si es necesario
				if ($tecnico === '') {
					$tecnico = null;
				}
				
				$query->bindParam(3, $tecnico); // Asegurarse de que $tecnico sea tratado como un entero
				$query->execute();
				$resultado = $query->fetchAll(PDO::FETCH_ASSOC);
				
				foreach ($resultado as $resp) {
					$arreglo["data"][] = $resp;
				}
				return $arreglo;
				conexionBD::cerrar_conexion();
				
				
			}

  









}


 ?>