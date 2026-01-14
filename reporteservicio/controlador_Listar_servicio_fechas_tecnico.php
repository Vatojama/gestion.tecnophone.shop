<?php 

require '../../model/modelo_reporte_servicio.php';
$MRSE = new Modelo_Reporte_Servicio();

	$finicio= htmlspecialchars($_POST['finicio'],ENT_QUOTES,'UTF-8');
	$ffin= htmlspecialchars($_POST['ffin'],ENT_QUOTES,'UTF-8');
	$tecnico= htmlspecialchars($_POST['tecnico'],ENT_QUOTES,'UTF-8');

	$consulta = $MRSE->Listar_Servicio_fechas_tecnico($finicio,$ffin, $tecnico);//llamamos al modelo
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