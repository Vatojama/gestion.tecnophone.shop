<?php 

	require '../../model/modelo_venta.php';
	$MV = new Modelo_Venta();//instaciamopsç

	$idventa_ab= htmlspecialchars($_POST['idventa_ab'],ENT_QUOTES,'UTF-8');
    $monto_ab= htmlspecialchars($_POST['monto_ab'],ENT_QUOTES,'UTF-8');
    $idusuario_ab= htmlspecialchars($_POST['idusuario_ab'],ENT_QUOTES,'UTF-8');
    $sucurid_ab= htmlspecialchars($_POST['sucurid_ab'],ENT_QUOTES,'UTF-8');
    $idcaja_ab= htmlspecialchars($_POST['idcaja_ab'],ENT_QUOTES,'UTF-8');


    $consulta = $MV->Registrar_Abono($idventa_ab, $monto_ab, $idusuario_ab, $sucurid_ab, $idcaja_ab);//llamamos al metodo del modelo
	echo $consulta;

 ?>