<?php 

	require '../../model/modelo_cotizacion.php';
	$MCOT = new Modelo_Cotizacion();//instaciamops

	$idproveedor= htmlspecialchars($_POST['idproveedor'],ENT_QUOTES,'UTF-8');
	$compro= htmlspecialchars($_POST['compro'],ENT_QUOTES,'UTF-8');
	$serie= htmlspecialchars($_POST['serie'],ENT_QUOTES,'UTF-8');

	$impuesto= htmlspecialchars($_POST['impuesto'],ENT_QUOTES,'UTF-8');
	$total= htmlspecialchars($_POST['total'],ENT_QUOTES,'UTF-8');
	$tipo= htmlspecialchars($_POST['tipo'],ENT_QUOTES,'UTF-8');
	$porcentaje= htmlspecialchars($_POST['porcentaje'],ENT_QUOTES,'UTF-8');
	$idusuario= htmlspecialchars($_POST['idusuario'],ENT_QUOTES,'UTF-8');
	$atiende= htmlspecialchars($_POST['atiende'],ENT_QUOTES,'UTF-8');

	$dias= htmlspecialchars($_POST['dias'],ENT_QUOTES,'UTF-8');
	$fpago= htmlspecialchars($_POST['fpago'],ENT_QUOTES,'UTF-8');


	$consulta = $MCOT->Registrar_Cotizacion($idproveedor,$compro,$serie,$impuesto,$total,$tipo,$porcentaje,$idusuario,$atiende,$dias,$fpago);//llamamos al metodo del modelo
	echo $consulta;

 ?>