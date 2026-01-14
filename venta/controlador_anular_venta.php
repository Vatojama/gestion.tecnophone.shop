<?php 

	require '../../model/modelo_venta.php';
	$MV = new Modelo_Venta();//instaciamopsç

	$id= htmlspecialchars($_POST['id'],ENT_QUOTES,'UTF-8');
	$estado= htmlspecialchars($_POST['estado'],ENT_QUOTES,'UTF-8');
$sucuid= htmlspecialchars($_POST['sucuid'],ENT_QUOTES,'UTF-8');

try {
    $consulta = $MV->Anular_Venta($id, $estado, $sucuid);
    echo $consulta;
} catch (PDOException $e) {
    echo $e->getMessage(); // Esto enviará el mensaje del SIGNAL SQLSTATE
}

	// $consulta = $MV->Anular_Venta($id,$estado, $sucuid);//llamamos al metodo del modelo
	// echo $consulta;

 ?>