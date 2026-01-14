<?php 

	require '../../model/modelo_reporte_servicio.php';
	$MRSE = new Modelo_Reporte_Servicio();

	$mes= htmlspecialchars($_POST['mes'],ENT_QUOTES,'UTF-8');
$sucursa= htmlspecialchars($_POST['sucursa'],ENT_QUOTES,'UTF-8');

	$consulta = $MRSE->Listar_Servicio_Mes($mes, $sucursa);//llamamos al modelo
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