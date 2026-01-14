<?php 

	require '../../model/modelo_usuario.php';
	$ruta = "";
	$MU = new Modelo_Usuario();//instaciamops
	$id= htmlspecialchars($_POST['id'],ENT_QUOTES,'UTF-8');	
	$clave= password_hash($_POST['clavenueva'],PASSWORD_DEFAULT,['cost'=>12]);

	$consulta = $MU->Modificar_Usuario_clave($id,$clave);//parametros de los campos de arriba //llamamos al modelo
	echo $consulta;

 ?>