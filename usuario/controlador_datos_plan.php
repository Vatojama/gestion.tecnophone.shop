<?php 

    require '../../model/modelo_usuario.php';
    
	$MU = new Modelo_Usuario();//instaciamos

	//$idusuario= htmlspecialchars($_POST['idusuario'],ENT_QUOTES,'UTF-8');

	$consulta = $MU->Listar_datos_Plan();//llamamos al modelo
	if ($consulta) {
		echo json_encode($consulta);
	}else{
		echo '{
			"sEcho" : 1,
			"iTotalRecords":"0",
			"iTotalDisplayRecords": "0",
			"aaData": []

		}';
	}


 ?>