<?php 

require '../../model/modelo_tienda.php';
$MTIE = new Modelo_Tienda();//instaciamos
	$estadopedi= htmlspecialchars($_POST['estadopedi'],ENT_QUOTES,'UTF-8');
	 $pedidoid= htmlspecialchars($_POST['pedidoid'],ENT_QUOTES,'UTF-8');

	$consulta = $MTIE->Actualizar_estado_Pedido($estadopedi, $pedidoid);//llamamos al modelo
	echo $consulta;

 ?>