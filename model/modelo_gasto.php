<?php
//comunica con el servidor para consultar
require_once __DIR__ . '/modelo_conexion.php';

/**
 * 
 */
class Modelo_Gasto extends conexionBD
{

    /**************************************************
           LISTAR GASTO
      **************************************************/
    public function Listar_Gasto($idusuario_filtro, $sucurid, $rolid)
    {
        $c = conexionBD::conexionPDO();
        $sql = "SELECT
                    	gastos.gastos_id, 
                    	gastos.gastos_descripcion, 
                     
                    	CAST(gastos.gastos_monto AS UNSIGNED) as gastos_monto, 
                    	gastos.gastos_responsable, 
                    	gastos.gastos_fregistro, 
                    	gastos.gastos_estado,
                    	gastos.tipo_mov,
                    	gastos.estado_caja,
                    	gastos.id_sucu,
                    	sucursales.nombre_su
                    FROM
                    	gastos JOIN sucursales ON
                    	gastos.id_sucu = sucursales.id_sucu
                    	WHERE ( ? = 1 OR (gastos.usu_id = ? AND gastos.id_sucu = ?))
                     
                    	ORDER BY gastos_id DESC";
        $arreglo = array();
        $query = $c->prepare($sql);//mandamos el precedure
        $query->bindParam(1, $rolid);//enviamos los parametros seguun la posicion del procedure
        $query->bindParam(2, $idusuario_filtro);
        $query->bindParam(3, $sucurid);

        $query->execute();
        $resultado = $query->fetchAll(PDO::FETCH_ASSOC);
        foreach ($resultado as $resp) {
            $arreglo["data"][] = $resp;//almacenando los datos del arreglo
        }
        return $arreglo;
        conexionBD::cerrar_conexion();
    }

    static public function Listar_data_Configuracion()
    {
        $c = conexionBD::conexionPDO();
        $sql = "CALL SP_LISTAR_DATA_CONFIGURACION()";
        $arreglo = array();
        $query = $c->prepare($sql);//mandamos el precedure
        //$query ->bindParam(1,$usuario);//enviamos los parametros seguun la posicion
        $query->execute();
        $resultado = $query->fetchAll();
        foreach ($resultado as $resp) {
            $arreglo["data"][] = $resp;//almacenando los datos del arreglo
        }
        return $arreglo;
        conexionBD::cerrar_conexion();
    }






    /**************************************************
          REGISTRAR GASTO
     **************************************************/
    public function Registrar_Gasto($gasto, $monto, $responsable, $tipomov, $sucursalid, $usuarioid)//viene del controlador
    {
        $c = conexionBD::conexionPDO();

        //$sql = "CALL SP_REGISTRAR_GASTOS(?,?,?,?,?,?)";
        $sqlcajaid = "select caja_id from caja where id_sucu=?  and caja_estado='VIGENTE' limit 1";
        $querycaja = $c->prepare($sqlcajaid);//mandamos el precedure
        $querycaja->bindParam(1, $sucursalid);
        $querycaja->execute();
        $resultadocaja = $querycaja->fetch(PDO::FETCH_ASSOC);
        $cajaid = $resultadocaja['caja_id'];


        $sql = "INSERT into gastos(gastos_descripcion,gastos_monto,gastos_responsable,gastos_fregistro,gastos_estado, estado_caja, tipo_mov, id_sucu, usu_id, caja_id)
			values(?,?,?, NOW(),'ACTIVO', 'ABIERTO', ?, ?, ?,?)";
        $query = $c->prepare($sql);//mandamos el precedure

        $query->bindParam(1, $gasto);//enviamos los parametros seguun la posicion del procedure
        $query->bindParam(2, $monto);
        $query->bindParam(3, $responsable);
        $query->bindParam(4, $tipomov);
        $query->bindParam(5, $sucursalid);
        $query->bindParam(6, $usuarioid);
        $query->bindParam(7, $cajaid);
        $resultado = $query->execute();
        //solo de usa cuando no se retorna un valor en el procedure(actualizar)
        if ($resultado) {
            return 1;
        } else {
            return 0;
        }
        conexionBD::cerrar_conexion();
    }



    /**************************************************
          MODIFICAR GASTO
     **************************************************/
    //modificar Rol
    public function Modificar_Gasto($id, $gasto, $monto, $responsable, $estado, $tipomov, $sucursalid)//viene del controlador
    {
        $c = conexionBD::conexionPDO();

        //$sql = "CALL SP_MODIFICAR_GASTOS(?,?,?,?,?, ?)";

        $sqlcajaid = "select caja_id from caja where id_sucu=?  and caja_estado='VIGENTE' limit 1";
        $querycaja = $c->prepare($sqlcajaid);//mandamos el precedure
        $querycaja->bindParam(1, $sucursalid);
        $querycaja->execute();
        $resultadocaja = $querycaja->fetch(PDO::FETCH_ASSOC);
        $cajaid = $resultadocaja['caja_id'];

        $sql = "UPDATE gastos set 
							gastos_descripcion=?, 
							gastos_monto=?, 
							gastos_responsable=?, 
							gastos_estado=?, 
							tipo_mov=?, 
							id_sucu=?,
							caja_id=? 
							where gastos_id=?";
        $query = $c->prepare($sql);//mandamos el precedure

        //enviamos los parametros seguun la posicion del procedure
        $query->bindParam(1, $gasto);
        $query->bindParam(2, $monto);
        $query->bindParam(3, $responsable);
        $query->bindParam(4, $estado);
        $query->bindParam(5, $tipomov);
        $query->bindParam(6, $sucursalid);
        $query->bindParam(7, $cajaid);
        $query->bindParam(8, $id);
        $resultado = $query->execute();
        //cuando en el procedure retorna 1 o 2 (GUARDAR)
        if ($resultado) {
            return 1;
        } else {
            return 0;
        }
        conexionBD::cerrar_conexion();
    }






}


