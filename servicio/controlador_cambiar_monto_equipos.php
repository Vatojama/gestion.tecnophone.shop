<?php 

	require '../../model/modelo_servicio.php';
	$MSE = new Modelo_Servicio();//instaciamopsç

	$id_equi_r= htmlspecialchars($_POST['id_equi_r'],ENT_QUOTES,'UTF-8');
	$monto_equi= htmlspecialchars($_POST['monto_equi'],ENT_QUOTES,'UTF-8');
	$abono_equi= htmlspecialchars($_POST['abono_equi'],ENT_QUOTES,'UTF-8');
    $receid_equi= htmlspecialchars($_POST['receid_equi'],ENT_QUOTES,'UTF-8');
	
	$consulta = $MSE->Cambiar_monto_equipos_recep($id_equi_r,$monto_equi,$abono_equi,  $receid_equi);
	echo $consulta;

 ?>