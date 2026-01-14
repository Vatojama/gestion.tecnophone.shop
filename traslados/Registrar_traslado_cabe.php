<?php 

    require '../../model/modelo_traslado.php';
    $MTR = new Modelo_Traslados();//instaciamos

	$idalmacenorigen= htmlspecialchars($_POST['idalmacenorigen'],ENT_QUOTES,'UTF-8');
	$idalmacendestino= htmlspecialchars($_POST['idalmacendestino'],ENT_QUOTES,'UTF-8');
	$idusuario= htmlspecialchars($_POST['idusuario'],ENT_QUOTES,'UTF-8');
    $observacion= htmlspecialchars($_POST['observacion'],ENT_QUOTES,'UTF-8');

	$consulta = $MTR->Registrar_Traslado_cabe($idalmacenorigen,$idalmacendestino, $idusuario, $observacion  );
	echo json_encode($consulta);

 ?>