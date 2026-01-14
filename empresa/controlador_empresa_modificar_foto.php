<?php 

	require '../../model/modelo_empresa.php';
	
	$ruta = "";
	$MEMP = new Modelo_Empresa();//instaciamops
	$id= htmlspecialchars($_POST['id'],ENT_QUOTES,'UTF-8');
	$nombrefoto= htmlspecialchars($_POST['nombrefoto'],ENT_QUOTES,'UTF-8');
	$rutaactual= htmlspecialchars($_POST['rutaactual'],ENT_QUOTES,'UTF-8');

	$ruta = 'controller/empresa/foto/'.$nombrefoto;

	$consulta = $MEMP->Modificar_Logo_Empresa($id,$ruta,$rutaactual);//llamamos al modelo
	echo $consulta;
	if ($consulta==1 ) {
		if (!empty($nombrefoto)) {
			if (move_uploaded_file($_FILES['foto']['tmp_name'],"foto/".$nombrefoto));
			//validamos para que elimine las fotos anteriores menos la DEAFAULT
			if ($rutaactual !="controller/empresa/foto/default.png" ) {
				unlink('../../'.$rutaactual);
			}
			
		}
	}

 ?>