<?php 

	require '../../model/modelo_cotizacion.php';
	$MCOT = new Modelo_Cotizacion();//instaciamos

	$id= htmlspecialchars($_POST['id'],ENT_QUOTES,'UTF-8');
	$estado= htmlspecialchars($_POST['estado'],ENT_QUOTES,'UTF-8');


	$consulta = $MCOT->Activar_Cotizacion($id,$estado);//llamamos al metodo del modelo
	echo $consulta;

 ?>