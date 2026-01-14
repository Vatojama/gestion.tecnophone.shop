<?php 
    require '../../model/modelo_proveedor.php';
    $MPRV = new Modelo_Proveedor();
    $consulta = $MPRV->Listar_Proveedor();
    if ($consulta) {
        // Importante: No tocamos la estructura, solo enviamos lo que el modelo trae
        echo json_encode(array(
            "sEcho" => 1,
            "iTotalRecords" => count($consulta),
            "iTotalDisplayRecords" => count($consulta),
            "aaData" => $consulta
        ));
    } else {
        echo '{
            "sEcho" : 1,
            "iTotalRecords":"0",
            "iTotalDisplayRecords": "0",
            "aaData": []
        }';
    }
?>