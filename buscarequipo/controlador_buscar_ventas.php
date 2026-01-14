<?php 

	require '../../model/modelo_buscar_equipo.php';
	$MBEQ = new Modelo_Buscar_Equipo();//instaciamopsç

	$dni= htmlspecialchars($_POST['dni'],ENT_QUOTES,'UTF-8');

	$consulta = $MBEQ->Listar_Ventas_dni_inicio($dni);//llamamos al modelo
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