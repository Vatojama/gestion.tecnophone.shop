<?php 

	require '../../model/modelo_comprobante.php';
	$MCOMP = new Modelo_Comprobante();//instaciamops
	$id= htmlspecialchars($_POST['id'],ENT_QUOTES,'UTF-8');
	$tipo= htmlspecialchars($_POST['tipo'],ENT_QUOTES,'UTF-8');
	$serie= htmlspecialchars($_POST['serie'],ENT_QUOTES,'UTF-8');
	$numeroc= htmlspecialchars($_POST['numeroc'],ENT_QUOTES,'UTF-8');
	$estado= htmlspecialchars($_POST['estado'],ENT_QUOTES,'UTF-8');

	$consulta = $MCOMP->Modificar_Comprobante($id,$tipo,$serie,$numeroc,$estado);//llamamos al metodo del modelo
	echo $consulta;

 ?>