<?php 
	//comunica con el servidor para consultar
	require_once 'modelo_conexion.php';

	/**
	 * 
	 */
	class Modelo_Sucursales extends conexionBD
	{



		 /**************************************************
 		       LISTAR SUCURSALES EN DATATABLE
 		 **************************************************/
		 public function Listar_Sucursales()
		 {
			$c = conexionBD:: conexionPDO();
			$sql = "CALL SP_LISTAR_SUCURSALES()";
			$arreglo = array();
			$query = $c->prepare($sql);
			//$query ->bindParam(1,$usuario);
			$query ->execute();
			$resultado = $query->fetchAll(PDO::FETCH_ASSOC);
			foreach ($resultado as $resp) {
			        $arreglo["data"][]=$resp;//almacenando los datos del arreglo
			}
			return $arreglo;
			conexionBD::cerrar_conexion();
		 }

         
		 /**************************************************
 		       LISTAR ALMACENES EN COMBO
 		 **************************************************/
		 public function Listar_select_Almacen()
		 {
			$c = conexionBD:: conexionPDO();

			$sql = "CALL SP_LISTAR_SELECT_ALMACENES()";
			$arreglo = array();
			$query = $c->prepare($sql);
			//$query ->bindParam(1,$usuario);/
			$query ->execute();
			$resultado = $query->fetchAll();
			foreach ($resultado as $resp) {
			        $arreglo[]=$resp;//almacenando los datos del arreglo
			}
			return $arreglo;
			conexionBD::cerrar_conexion();
		 }

		 /**************************************************
 		       LISTAR ALMACENES DE DESTINO EN COMBO
 		 **************************************************/
		 public function Listar_select_Almacen_Origen()
		 {
			$c = conexionBD:: conexionPDO();

			$sql = "SELECT id_almacen, descripcion_al FROM almacen WHERE principal = 'Si' and estado_al = 'Activo'";
			$arreglo = array();
			$query = $c->prepare($sql);
			$query ->execute();
			$resultado = $query->fetchAll();
			foreach ($resultado as $resp) {
			        $arreglo[]=$resp;//almacenando los datos del arreglo
			}
			return $arreglo;
			conexionBD::cerrar_conexion();
		 }

		 /**************************************************
 		       LISTAR ALMACENES DE DESTINO EN COMBO
 		 **************************************************/
		 public function Listar_select_Almacen_Destino()
		 {
			$c = conexionBD:: conexionPDO();

			$sql = "SELECT id_almacen, descripcion_al FROM almacen WHERE principal <> 'Si' and estado_al = 'Activo'";
			$arreglo = array();
			$query = $c->prepare($sql);
			$query ->execute();
			$resultado = $query->fetchAll();
			foreach ($resultado as $resp) {
			        $arreglo[]=$resp;//almacenando los datos del arreglo
			}
			return $arreglo;
			conexionBD::cerrar_conexion();
		 }


         
	/**************************************************
 		       REGISTRAR SUCURSALES
	 **************************************************/
    public function Registrar_Sucursales($razon, $ruc, $telefono, $direccion, $correo, $id_almacen)
	{
		try {
			$c = conexionBD::conexionPDO();

			// 1. Verificar si el almacén ya está asignado a otra sucursal
			$sql_check = "SELECT COUNT(*) FROM sucursales WHERE id_almacen = ? AND estado_su = 'ACTIVO'";
			$query_check = $c->prepare($sql_check);
			$query_check->bindParam(1, $id_almacen);
			$query_check->execute();
			$almacen_usado = $query_check->fetchColumn();

			if ($almacen_usado > 0) {
				return [
					"tipo_msj" => "error",
					"msj" => "El almacén seleccionado ya está asignado a otra sucursal. Por favor, elija otro."
				];
			}

			$c->beginTransaction();

			$sql = "CALL SP_REGISTRAR_SUCURSALES(?,?,?,?,?,?)";
			$query = $c->prepare($sql);

			$query->bindParam(1, $razon); 
			$query->bindParam(2, $ruc);
			$query->bindParam(3, $telefono);
			$query->bindParam(4, $direccion);
			$query->bindParam(5, $correo);
			$query->bindParam(6, $id_almacen);

			$query->execute();

			$row = $query->fetchColumn();

			$c->commit();

			return [
				"tipo_msj" => "success",
				"msj" => "Sucursal registrada correctamente",
				"data" => $row
			];
		} catch (Exception $e) {
			if ($c && $c->inTransaction()) {
				$c->rollBack();
			}
			return [
				"tipo_msj" => "error",
				"msj" => "Error al registrar la sucursal: " . $e->getMessage()
			];
		} finally {
			conexionBD::cerrar_conexion();
		} 
	}


	/**************************************************
 		       MODIFICAR SUCURSALES
	 **************************************************/
 	 public function Modificar_Sucursales( $idsucu, $razon, $ruc, $telefono, $direccion, $correo, $id_almacen, $estadosu)
	{
		try {
			$c = conexionBD::conexionPDO();

			// 1. Verificar si el almacén ya está asignado a otra sucursal
			$sql_check = "SELECT COUNT(*) FROM sucursales WHERE id_almacen = ? AND estado_su = 'ACTIVO' and id_sucu != ?";
			$query_check = $c->prepare($sql_check);
			$query_check->bindParam(1, $id_almacen);
			$query_check->bindParam(2, $idsucu);
			$query_check->execute();
			$almacen_usado = $query_check->fetchColumn();

			if ($almacen_usado > 0) {
				return [
					"tipo_msj" => "error",
					"msj" => "El almacén seleccionado ya está asignado a otra sucursal. Por favor, elija otro."
				];
			}

			$c->beginTransaction();

			$sql = "CALL SP_MODIFICAR_SUCURSALES(?,?,?,?,?,?,?,?)";
			$query = $c->prepare($sql);

			$query->bindParam(1, $idsucu); 
			$query->bindParam(2, $razon); 
			$query->bindParam(3, $ruc);
			$query->bindParam(4, $telefono);
			$query->bindParam(5, $direccion);
			$query->bindParam(6, $correo);
			$query->bindParam(7, $id_almacen);
			$query->bindParam(8, $estadosu); 

			$query->execute();

			$row = $query->fetchColumn();

			$c->commit();

			return [
				"tipo_msj" => "success",
				"msj" => "SUCURSAL ACTUALIZADA CORRECTAMENTE ",
				"data" => $row
			];
		} catch (Exception $e) {
			if ($c && $c->inTransaction()) {
				$c->rollBack();
			}
			return [
				"tipo_msj" => "error",
				"msj" => "Error al Actualizar la sucursal: " . $e->getMessage()
			];
		} finally {
			conexionBD::cerrar_conexion();
		} 
	}



	/**************************************************
 		       ELIMINAR SUCURSALES
	 **************************************************/
 	public function Eliminar_Sucursales($idsuc)
	{
		try {
			$c = conexionBD::conexionPDO();

			// 1. Verificar si el almacén ya está asignado a otra sucursal
			$sql_check = "SELECT COUNT(*) FROM usuario WHERE id_sucu = ? AND usu_estado	= 'ACTIVO'";
			$query_check = $c->prepare($sql_check);
			$query_check->bindParam(1, $idsuc);

			$query_check->execute();
			$usuarios_asignados = $query_check->fetchColumn();

			if ($usuarios_asignados > 0) {
				return [
					"tipo_msj" => "error",
					"msj" => "LA SUCURSAL NO PUEDE SER ELIMINADA, TIENE USUARIOS ASIGNADOS. "
				];
			}

			// Validar si la sucursal tiene productos asignados
			$sql_check_prod = "SELECT COUNT(*) FROM producto WHERE id_sucu = ? ";
			$query_check_prod = $c->prepare($sql_check_prod);
			$query_check_prod->bindParam(1, $idsuc);
			$query_check_prod->execute();
			$productos_asignados = $query_check_prod->fetchColumn();

			if ($productos_asignados > 0) {
				return [
					"tipo_msj" => "error",
					"msj" => "LA SUCURSAL NO PUEDE SER ELIMINADA, TIENE PRODUCTOS ASIGNADOS."
				];
			}

			$c->beginTransaction();

			$sql = "CALL SP_ELIMINAR_SUCURSALES(?)";
			$query = $c->prepare($sql);

			$query->bindParam(1, $idsuc); 
			$query->execute();

			$row = $query->fetchColumn();

			$c->commit();

			return [
				"tipo_msj" => "success",
				"msj" => "SUCURSAL ELIMINADA CORRECTAMENTE ",
				"data" => $row
			];
		} catch (Exception $e) {
			if ($c && $c->inTransaction()) {
				$c->rollBack();
			}
			return [
				"tipo_msj" => "error",
				"msj" => "Error al Eliminar la sucursal: " . $e->getMessage()
			];
		} finally {
			conexionBD::cerrar_conexion();
		} 
	}
		


//////////////////////////////////////////////////PARA ALMACENES////////////////////////////////////////////////////
	/**************************************************
 		       LISTAR ALMACENES EN DATATABLE
	 **************************************************/
		 public function Listar_Almacen_table()
		 {
			$c = conexionBD:: conexionPDO();
			$sql = "CALL SP_LISTAR_ADLMACENES()";
			$arreglo = array();
			$query = $c->prepare($sql);
			//$query ->bindParam(1,$usuario);
			$query ->execute();
			$resultado = $query->fetchAll(PDO::FETCH_ASSOC);
			foreach ($resultado as $resp) {
			        $arreglo["data"][]=$resp;//almacenando los datos del arreglo
			}
			return $arreglo;
			conexionBD::cerrar_conexion();
		 }

		 /**************************************************
 		       REGISTRAR SUCURSALES
	 **************************************************/
    public function Registrar_Almacenes($descripcion, $abrevia)
	{
		try {
			$c = conexionBD::conexionPDO();

			// 1. Verificar si el almacén ya está asignado a otra sucursal
			$sql_check = "SELECT COUNT(*) FROM almacen WHERE  descripcion_al = ? OR codigo_al = ? ";
			$query_check = $c->prepare($sql_check);
			$query_check->bindParam(1, $descripcion);
			$query_check->bindParam(2, $abrevia);
			$query_check->execute();
			$almacen_usado = $query_check->fetchColumn();

			if ($almacen_usado > 0) {
				return [
					"tipo_msj" => "warning",
					"msj" => "El almacén registrado ya existe. Por favor, elija otro nombre o abreviatura."
				];
			}

			$c->beginTransaction();

			$sql = "CALL SP_REGISTRAR_ALMACENES(?,?)";
			$query = $c->prepare($sql);

			$query->bindParam(1, $descripcion); 
			$query->bindParam(2, $abrevia);

			$query->execute();

			$row = $query->fetchColumn();

			$c->commit();

			return [
				"tipo_msj" => "success",
				"msj" => "ALMACEN REGISTRADO CORRECTAMENTE",
				"data" => $row
			];
		} catch (Exception $e) {
			if ($c && $c->inTransaction()) {
				$c->rollBack();
			}
			return [
				"tipo_msj" => "error",
				"msj" => "Error al registrar el almacen: " . $e->getMessage()
			];
		} finally {
			conexionBD::cerrar_conexion();
		} 
	}


		 /**************************************************
 		       REGISTRAR SUCURSALES
	 **************************************************/
    public function Modificar_Almacenes($idalma, $descripcion, $abrevia, $estado)
	{
		try {
			$c = conexionBD::conexionPDO();

			// Verificar si el almacén ya existe con la misma descripción o abreviatura, excluyendo el actual
			$sql_check = "SELECT COUNT(*) FROM almacen WHERE  descripcion_al = ? OR codigo_al = ? and id_almacen != ?";
			$query_check = $c->prepare($sql_check);
			$query_check->bindParam(1, $descripcion);
			$query_check->bindParam(2, $abrevia);
			$query_check->bindParam(3, $idalma);
			$query_check->execute();
			$almace_usado = $query_check->fetchColumn();

			if ($almace_usado > 0) {
				return [
					"tipo_msj" => "warning",
					"msj" => "El almacén registrado ya existe. Por favor, elija otro nombre o abreviatura."
				];
			}

			$c->beginTransaction();

			$sql = "CALL SP_MODIFICAR_ALMACENES(?,?,?,?)";
			$query = $c->prepare($sql);

			$query->bindParam(1, $idalma); 
			$query->bindParam(2, $descripcion);
			$query->bindParam(3, $abrevia);
			$query->bindParam(4, $estado);
			$query->execute();

			$row = $query->fetchColumn();

			$c->commit();

			return [
				"tipo_msj" => "success",
				"msj" => "ALMACEN ACTUALIZADO CORRECTAMENTE",
				"data" => $row
			];
		} catch (Exception $e) {
			if ($c && $c->inTransaction()) {
				$c->rollBack();
			}
			return [
				"tipo_msj" => "error",
				"msj" => "Error al actualizar el almacen: " . $e->getMessage()
			];
		} finally {
			conexionBD::cerrar_conexion();
		} 
	}



	/**************************************************
 		       ELIMINAR ALMACEN
	 **************************************************/
 	public function Eliminar_Almacen($idalm)
	{
		try {
			$c = conexionBD::conexionPDO();

			// 1. Verificar si el almacén ya está asignado a otra sucursal
			$sql_check = "SELECT COUNT(*) FROM sucursales WHERE id_almacen = ? AND estado_su	= 'Activo'";
			$query_check = $c->prepare($sql_check);
			$query_check->bindParam(1, $idalm);

			$query_check->execute();
			$sucu_asignados = $query_check->fetchColumn();

			if ($sucu_asignados > 0) {
				return [
					"tipo_msj" => "error",
					"msj" => "EL ALMACEN NO PUEDE SER ELIMINADO, TIENE SUCURSAL ASIGNADA. "
				];
			}

			// Validar si la sucursal tiene productos asignados
			$sql_check_prod = "SELECT COUNT(*) FROM stock WHERE id_almacen = ? ";
			$query_check_prod = $c->prepare($sql_check_prod);
			$query_check_prod->bindParam(1, $idalm);
			$query_check_prod->execute();
			$stockProducto_asignados = $query_check_prod->fetchColumn();

			if ($stockProducto_asignados > 0) {
				return [
					"tipo_msj" => "error",
					"msj" => "EL ALMACEN NO PUEDE SER ELIMINADO, TIENE PRODUCTOS ASIGNADOS ."
				];
			}

			$c->beginTransaction();

			$sql = "CALL SP_ELIMINAR_ALMACEN(?)";
			$query = $c->prepare($sql);

			$query->bindParam(1, $idalm); 
			$query->execute();

			$row = $query->fetchColumn();

			$c->commit();

			return [
				"tipo_msj" => "success",
				"msj" => "ALMACEN ELIMINADO CORRECTAMENTE ",
				"data" => $row
			];
		} catch (Exception $e) {
			if ($c && $c->inTransaction()) {
				$c->rollBack();
			}
			return [
				"tipo_msj" => "error",
				"msj" => "Error al Eliminar el almacen: " . $e->getMessage()
			];
		} finally {
			conexionBD::cerrar_conexion();
		} 
	}















    }