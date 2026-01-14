<?php 
    require_once 'modelo_conexion.php';

    class Modelo_Proveedor extends conexionBD
    {
        /**************************************************
               LISTAR PROVEEDOR
        **************************************************/
        public function Listar_Proveedor()
        {
            $c = conexionBD::conexionPDO();
            $sql = "CALL SP_LISTAR_PROVEEDOR()"; 
            $arreglo = array();
            $query = $c->prepare($sql);
            $query->execute();
            $resultado = $query->fetchAll(PDO::FETCH_ASSOC);
            
            foreach ($resultado as $resp) {
                $arreglo[] = $resp; 
            }
            return $arreglo;
            conexionBD::cerrar_conexion();
        }

        /**************************************************
               REGISTRAR PROVEEDOR (5 PARÁMETROS)
        **************************************************/
        public function Registrar_Proveedor($ruc,$razon,$direccion,$celular,$lista_negra)
        {
            $c = conexionBD::conexionPDO();
            $sql = "CALL SP_REGISTRAR_PROVEEDOR(?,?,?,?,?)";
            $query = $c->prepare($sql);

            $query->bindParam(1,$ruc);
            $query->bindParam(2,$razon);
            $query->bindParam(3,$direccion);       
            $query->bindParam(4,$celular);
            $query->bindParam(5,$lista_negra); 
            $query->execute();

            if ($row = $query->fetchColumn()) {
                return $row;
            }
            conexionBD::cerrar_conexion();
        }

        /**************************************************
               MODIFICAR PROVEEDOR (7 PARÁMETROS)
        **************************************************/
        public function Modificar_Proveedor($id,$ruc,$razon,$direccion,$celular,$estado,$lista_negra)
        {
            $c = conexionBD::conexionPDO();
            $sql = "CALL SP_MODIFICAR_PROVEEDOR(?,?,?,?,?,?,?)";
            $query = $c->prepare($sql);

            $query->bindParam(1,$id);
            $query->bindParam(2,$ruc);
            $query->bindParam(3,$razon);
            $query->bindParam(4,$direccion);
            $query->bindParam(5,$celular);
            $query->bindParam(6,$estado);
            $query->bindParam(7,$lista_negra); 
            $query->execute();

            if ($row = $query->fetchColumn()) {
                return $row;
            }
            conexionBD::cerrar_conexion();
        }
    }
?>