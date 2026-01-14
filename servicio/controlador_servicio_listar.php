<?php 

	require '../../model/modelo_servicio.php';
	$MSE = new Modelo_Servicio();//instaciamopsç

	$finicio= htmlspecialchars($_POST['finicio'],ENT_QUOTES,'UTF-8');
	$ffin= htmlspecialchars($_POST['ffin'],ENT_QUOTES,'UTF-8');
	$idusuario_filtro= htmlspecialchars($_POST['idusuario_filtro'],ENT_QUOTES,'UTF-8');
	 $sucurid= htmlspecialchars($_POST['sucurid'],ENT_QUOTES,'UTF-8');
	  $rolid= htmlspecialchars($_POST['rolid'],ENT_QUOTES,'UTF-8');

	$consulta = $MSE->Listar_Servicio($finicio,$ffin, $idusuario_filtro, $sucurid, $rolid);//llamamos al modelo
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