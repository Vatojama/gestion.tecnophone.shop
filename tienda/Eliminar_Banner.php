<?php 

require '../../model/modelo_tienda.php';
$MTIE = new Modelo_Tienda();//instaciamos
	$id= htmlspecialchars($_POST['id'],ENT_QUOTES,'UTF-8');	
	$consulta = $MTIE->Eliminar_Banner($id);//llamamos al metodo del modelo
	echo $consulta;

 ?>