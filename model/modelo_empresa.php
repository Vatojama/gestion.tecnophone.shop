<?php 
	//comunica con el servidor para consultar
	require_once 'modelo_conexion.php';

	/**
	 * 
	 */
	class Modelo_Empresa extends conexionBD
	{
		
		 /**************************************************
 		       LISTAR EMPRESA
 		  **************************************************/
		 public function Listar_Empresa()
		 {
			$c = conexionBD:: conexionPDO();
			$sql = "CALL SP_LISTAR_EMPRESA()";
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
 		       REGISTRAR EMPRESA
 		  **************************************************/
		 public function Registrar_Empresa($razon,$ruc,$repre,$direccion,$celular,$telefono,$correo,$ruta,$url,$cuenta01,$nro_cuenta01,$cuenta02,$nro_cuenta02)
		 {
			$c = conexionBD:: conexionPDO();

			$sql = "CALL SP_REGISTRAR_EMPRESA(?,?,?,?,?,?,?,?,?,?,?,?,?)";
			$query = $c->prepare($sql);//mandamos el precedure
			$query ->bindParam(1,$razon);//enviamos los parametros seguun la posicion
			$query ->bindParam(2,$ruc);
			$query ->bindParam(3,$repre);
			$query ->bindParam(4,$direccion);
			$query ->bindParam(5,$celular);
			$query ->bindParam(6,$telefono);
			$query ->bindParam(7,$correo);
			$query ->bindParam(8,$ruta);
			$query ->bindParam(9,$url);

			$query ->bindParam(10,$cuenta01);
			$query ->bindParam(11,$nro_cuenta01);
			$query ->bindParam(12,$cuenta02);
			$query ->bindParam(13,$nro_cuenta02);
			$resultado = $query ->execute();
			if ($row = $query->fetchColumn()) {
				return $row;
			}

			//solo de usa cuando no se retorna un valor en el procedure
			/*if($resultado){
				return 1;
			}else{
				return 0;
			}*/

			conexionBD::cerrar_conexion();
		 }






		 /**************************************************
 		       MODIFICAR EMPRESA
 		  **************************************************/
		 public function Modificar_Empresa($id,$razon,$ruc,$repre,$direccion,$celular,$telefono,$correo,$estado,$url,$cuenta01,$nro_cuenta01,$cuenta02,$nro_cuenta02, $moned, $cod_posta ,$tipoigv, $igv, $moneda1, $moneda2, $nombresistema, $link_sist,$codigo_pais, $clave_co )//viene del controlador
		 {
			$c = conexionBD:: conexionPDO();

			$sql = "CALL SP_MODIFICAR_EMPRESA(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
			$query = $c->prepare($sql);//mandamos el precedure
			$query ->bindParam(1,$id);//enviamos los parametros seguun la posicion
			$query ->bindParam(2,$razon);
			$query ->bindParam(3,$ruc);
			$query ->bindParam(4,$repre);
			$query ->bindParam(5,$direccion);
			$query ->bindParam(6,$celular);
			$query ->bindParam(7,$telefono);
			$query ->bindParam(8,$correo);
			$query ->bindParam(9,$estado);
			$query ->bindParam(10,$url);

			$query ->bindParam(11,$cuenta01);
			$query ->bindParam(12,$nro_cuenta01);
			$query ->bindParam(13,$cuenta02);
			$query ->bindParam(14,$nro_cuenta02);
			$query ->bindParam(15,$moned);
			$query ->bindParam(16,$cod_posta);
			$query ->bindParam(17,$tipoigv);
			$query ->bindParam(18,$igv);
			$query ->bindParam(19,$moneda1);
			$query ->bindParam(20,$moneda2);
			$query ->bindParam(21,$nombresistema);
			$query ->bindParam(22,$link_sist);
			$query ->bindParam(23,$codigo_pais);
			$query ->bindParam(24,$clave_co);
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
 		       MODIFICAR LOGO EMPRESA
 		  **************************************************/
		 public function Modificar_Logo_Empresa($id,$ruta)//viene del controlador
		 {
			$c = conexionBD:: conexionPDO();

			$sql = "CALL SP_MODIFICAR_FOTO_EMPRESA(?,?)";
			$query = $c->prepare($sql);//mandamos el precedure
			$query ->bindParam(1,$id);
			$query ->bindParam(2,$ruta);//enviamos los parametros seguun la posicion del procedure
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