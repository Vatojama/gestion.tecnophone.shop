<?php 
require '../../model/modelo_recepcion.php';
$MREC = new Modelo_Recepcion(); // Instancia del modelo

$idcli = htmlspecialchars($_POST['idcli'], ENT_QUOTES, 'UTF-8');


// Registrar en la base de datos
$consulta = $MREC->Buscar_recep_cliente($idcli);
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
