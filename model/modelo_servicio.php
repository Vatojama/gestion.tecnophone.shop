<?php 
	//comunica con el servidor para consultar
	require_once 'modelo_conexion.php';

	/**
	 * 
	 */
	class Modelo_Servicio extends conexionBD
	{
		
		 /**************************************************
 		       LISTAR EL SERVICIO POR FILTRO DE FECHA
 		  **************************************************/
		 public function Listar_Servicio($finicio,$ffin, $idusuario_filtro, $sucurid, $rolid)
		 {
			$c = conexionBD:: conexionPDO();
			$sql = "CALL SP_LISTAR_SERVICIO(?,?,?,?,?)";
			$arreglo = array();
			$query = $c->prepare($sql);//mandamos el precedure
			$query ->bindParam(1,$finicio);//enviamos los parametros seguun la posicion
			$query ->bindParam(2,$ffin);
			$query ->bindParam(3,$idusuario_filtro);
			$query ->bindParam(4,$sucurid);
			$query ->bindParam(5,$rolid);
			$query ->execute();
			$resultado = $query->fetchAll(PDO::FETCH_ASSOC);
			foreach ($resultado as $resp) {
			        $arreglo["data"][]=$resp;//almacenando los datos del arreglo
			}
			return $arreglo;
			conexionBD::cerrar_conexion();
		 }



		 /**************************************************
 		    		   REGISTRAR SERVICIO
 		  **************************************************/
		 public function Registrar_Sevicio($idrecepcion,$monto,$concepto,$responsable,$comentario, $observa, $modelo,  $idformapago  , $monto_efectiv , $cod_opera ,$monto_tarje, $cajaid_se, $tecnicoid_se, $estadofinal, $sucursalid)
		 {
			$c = conexionBD:: conexionPDO();

			$sql = "CALL SP_REGISTRAR_SERVICIO(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
			$query = $c->prepare($sql);//mandamos el precedure
			$query ->bindParam(1,$idrecepcion);//enviamos los parametros seguun la posicion
			$query ->bindParam(2,$monto);
			$query ->bindParam(3,$concepto);
			$query ->bindParam(4,$responsable);
			$query ->bindParam(5,$comentario);
			$query ->bindParam(6,$observa);
			$query ->bindParam(7,$modelo);
			$query ->bindParam(8,$idformapago);
			$query ->bindParam(9,$monto_efectiv);
			$query ->bindParam(10,$cod_opera);
			$query ->bindParam(11,$monto_tarje);
			$query ->bindParam(12,$cajaid_se);
			$query ->bindParam(13,$tecnicoid_se);
			$query ->bindParam(14,$estadofinal);
			$query ->bindParam(15,$sucursalid);//agregamos el id de la sucursal


			$resultado = $query ->execute();


			//solo de usa cuando no se retorna un valor en el procedure
			if($resultado){
				return 1;
			}else{
				return 0;
			}

			conexionBD::cerrar_conexion();
		 }





		  /**************************************************
 		    		   ELIMINAR SERVICIO
 		  **************************************************/
		 public function Eliminar_Sevicio($id)
		 {
			$c = conexionBD:: conexionPDO();

			$sql = "CALL SP_ELIMINAR_SERVICIO(?)";
			$query = $c->prepare($sql);//mandamos el precedure
			$query ->bindParam(1,$id);//enviamos los parametros seguun la posicion


			$resultado = $query ->execute();


			//solo de usa cuando no se retorna un valor en el procedure
			if($resultado){
				return 1;
			}else{
				return 0;
			}

			conexionBD::cerrar_conexion();
		 }

		 /**************************************************
 		    		   CAMBIAR MONTOS A QUIPOS
 		  **************************************************/
		   public function Cambiar_monto_equipos_recep($id_equi_r, $monto_equi, $abono_equi,  $receid_equi)
		   {
			  $c = conexionBD:: conexionPDO();
  
			  $sql = "CALL SP_CAMBIAR_MONTOS_EQUIPOS_SERVICIO(?,?,?,?)";
			  $query = $c->prepare($sql);//mandamos el precedure
			  $query ->bindParam(1,$id_equi_r);//enviamos los parametros seguun la posicion
			  $query ->bindParam(2,$monto_equi);
			  $query ->bindParam(3,$abono_equi);
			  $query ->bindParam(4,$receid_equi);
			  $resultado = $query ->execute();
  
  
			  //solo de usa cuando no se retorna un valor en el procedure
			  if($resultado){
				  return 1;
			  }else{
				  return 0;
			  }
  
			  conexionBD::cerrar_conexion();
		   }
















}


 ?>