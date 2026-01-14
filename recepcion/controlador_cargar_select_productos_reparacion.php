<?php 

    require '../../model/modelo_recepcion.php';
    $MREC = new Modelo_Recepcion();
     $idalmacen= htmlspecialchars($_POST['idalmacen'],ENT_QUOTES,'UTF-8');
	  $rolid= htmlspecialchars($_POST['rolid'],ENT_QUOTES,'UTF-8');

	$consulta = $MREC->Listar_Selec_Productos_insumos_rece($idalmacen,  $rolid);//llamamos al modelo
	echo json_encode($consulta);
	

 ?>