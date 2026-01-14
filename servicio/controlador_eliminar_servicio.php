<?php 

	require '../../model/modelo_servicio.php';
	$MSE = new Modelo_Servicio();//instaciamopsç

	$id= htmlspecialchars($_POST['id'],ENT_QUOTES,'UTF-8');
	


	$consulta = $MSE->Eliminar_Sevicio($id);//llamamos al metodo del modelo
	echo $consulta;

 ?>