<?php 

	require '../../model/modelo_servicio.php';
	$MSE = new Modelo_Servicio();//instaciamopsç

	$idrecepcion= htmlspecialchars($_POST['idrecepcion'],ENT_QUOTES,'UTF-8');
	$monto= htmlspecialchars($_POST['monto'],ENT_QUOTES,'UTF-8');
	$concepto= htmlspecialchars($_POST['concepto'],ENT_QUOTES,'UTF-8');
	$responsable= htmlspecialchars($_POST['responsable'],ENT_QUOTES,'UTF-8');
	$comentario= htmlspecialchars($_POST['comentario'],ENT_QUOTES,'UTF-8');
	$observa= htmlspecialchars($_POST['observa'],ENT_QUOTES,'UTF-8');
	$modelo= htmlspecialchars($_POST['modelo'],ENT_QUOTES,'UTF-8');

	$idformapago= htmlspecialchars($_POST['idformapago'],ENT_QUOTES,'UTF-8');
	$monto_efectiv= htmlspecialchars($_POST['monto_efectiv'],ENT_QUOTES,'UTF-8');
	$cod_opera= htmlspecialchars($_POST['cod_opera'],ENT_QUOTES,'UTF-8');
	$monto_tarje= htmlspecialchars($_POST['monto_tarje'],ENT_QUOTES,'UTF-8');
	$cajaid_se= htmlspecialchars($_POST['cajaid_se'],ENT_QUOTES,'UTF-8');
	$tecnicoid_se= htmlspecialchars($_POST['tecnicoid_se'],ENT_QUOTES,'UTF-8');
	$estadofinal= htmlspecialchars($_POST['estadofinal'],ENT_QUOTES,'UTF-8');
	$sucursalid= htmlspecialchars($_POST['sucursalid'],ENT_QUOTES,'UTF-8');



	$consulta = $MSE->Registrar_Sevicio($idrecepcion,$monto,$concepto,$responsable,$comentario, $observa, $modelo , $idformapago  , $monto_efectiv , $cod_opera ,$monto_tarje , $cajaid_se , $tecnicoid_se, $estadofinal, $sucursalid);//llamamos al metodo del modelo
	echo $consulta;

 ?>