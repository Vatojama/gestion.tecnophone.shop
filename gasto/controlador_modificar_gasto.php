<?php 

	require '../../model/modelo_gasto.php';
	$MG = new Modelo_Gasto();//instaciamops
	$id= htmlspecialchars($_POST['id'],ENT_QUOTES,'UTF-8');
	$gasto= htmlspecialchars($_POST['gasto'],ENT_QUOTES,'UTF-8');
	$monto= htmlspecialchars($_POST['monto'],ENT_QUOTES,'UTF-8');
	$responsable= htmlspecialchars($_POST['responsable'],ENT_QUOTES,'UTF-8');
	$estado= htmlspecialchars($_POST['estado'],ENT_QUOTES,'UTF-8');
	$tipomov= htmlspecialchars($_POST['tipomov'],ENT_QUOTES,'UTF-8');
	$sucursalid= htmlspecialchars($_POST['sucursalid'],ENT_QUOTES,'UTF-8');

	$consulta = $MG->Modificar_Gasto($id,$gasto,$monto,$responsable,$estado, $tipomov, $sucursalid);//llamamos al metodo del modelo
	echo $consulta;

 ?>