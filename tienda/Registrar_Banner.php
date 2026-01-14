<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
	
    require '../../model/modelo_tienda.php';
    $MTIE = new Modelo_Tienda();//instanciamos
	$ruta = "";
	$descrip= htmlspecialchars($_POST['descrip'],ENT_QUOTES,'UTF-8');
	$nombrefoto= htmlspecialchars($_POST['nombrefoto'],ENT_QUOTES,'UTF-8');	
	
	if (empty($nombrefoto)) {
		$ruta = 'controller/tienda/foto/default.png';
	}else{
		$ruta = 'controller/tienda/foto/'.$nombrefoto;
	}

	$consulta = $MTIE->Registrar_Banner($descrip,$ruta);//llamamos al modelo
	//echo $consulta;
	echo "Consulta: " . $consulta . "<br>";

	if ($consulta == 1) { // Verificamos si la consulta fue exitosa
		echo "Consulta exitosa<br>";
		if (!empty($nombrefoto)) {
			// echo "Nombre de la foto: " . $nombrefoto . "<br>";
			// echo "Ruta temporal: " . $_FILES['foto']['tmp_name'] . "<br>";
	
			// Verificar si la carpeta existe y tiene permisos de escritura
			$targetDir = "foto/";
			if (!is_dir($targetDir)) {
			//	echo "La carpeta de destino no existe.<br>";
			} else if (!is_writable($targetDir)) {
			//	echo "La carpeta de destino no tiene permisos de escritura.<br>";
			} else {
				if (move_uploaded_file($_FILES['foto']['tmp_name'], $targetDir . $nombrefoto)) {
				//	echo "Foto subida correctamente.";
				} else {
				//	echo "Error al subir la foto.";
					// Mostrar el error específico de move_uploaded_file
					if (!file_exists($_FILES['foto']['tmp_name'])) {
					//	echo "El archivo temporal no existe.";
					} else {
					//	echo "Error desconocido al mover el archivo.";
					}
				}
			}
		}
	} else {
		echo "Error en la consulta.";
	}


	
	// if ($consulta==1 ) {
	// 	if (!empty($nombrefoto)) {
	// 		if (move_uploaded_file($_FILES['foto']['tmp_name'],"foto/".$nombrefoto));
	// 	}
	// }

 ?>