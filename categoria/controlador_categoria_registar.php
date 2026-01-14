<?php 

	require '../../model/modelo_categoria.php';
	$MC = new Modelo_Categoria();//instaciamops
	$categoria= htmlspecialchars($_POST['categoria'],ENT_QUOTES,'UTF-8');
	//$estado= htmlspecialchars($_POST['e'],ENT_QUOTES,'UTF-8');

	$consulta = $MC->Registrar_Categoria($categoria);//llamamos al metodo del modelo
	echo $consulta;

 ?>