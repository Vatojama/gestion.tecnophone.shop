<?php 

	require '../../model/modelo_categoria.php';
	$MC = new Modelo_Categoria();//instaciamops
	$id= htmlspecialchars($_POST['id'],ENT_QUOTES,'UTF-8');
	$categoria= htmlspecialchars($_POST['categoria'],ENT_QUOTES,'UTF-8');
	$estado= htmlspecialchars($_POST['estado'],ENT_QUOTES,'UTF-8');

	$consulta = $MC->Modificar_Categoria($id,$categoria,$estado);//llamamos al metodo del modelo
	echo $consulta;

 ?>