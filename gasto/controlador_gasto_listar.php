<?php 

	require '../../model/modelo_gasto.php';
	$MG = new Modelo_Gasto();//instaciamops
	$idusuario_filtro= htmlspecialchars($_POST['idusuario_filtro'],ENT_QUOTES,'UTF-8');
	 $sucurid= htmlspecialchars($_POST['sucurid'],ENT_QUOTES,'UTF-8');
	  $rolid= htmlspecialchars($_POST['rolid'],ENT_QUOTES,'UTF-8');

	$consulta = $MG->Listar_Gasto( $idusuario_filtro, $sucurid, $rolid);//llamamos al modelo
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