<?php 

	require '../../model/modelo_rol.php';
	$MR = new Modelo_Rol();//instaciamops
    $rol_id= htmlspecialchars($_POST['rol_id'],ENT_QUOTES,'UTF-8');
    
	$consulta = $MR->Listar_Permisos_x_rol($rol_id);//llamamos al modelo
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