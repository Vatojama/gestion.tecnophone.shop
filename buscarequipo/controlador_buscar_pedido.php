<?php 

	require '../../model/modelo_buscar_equipo.php';
	$MBEQ = new Modelo_Buscar_Equipo();//instaciamos

	$dni= htmlspecialchars($_POST['dni'],ENT_QUOTES,'UTF-8');
    $pedido= htmlspecialchars($_POST['pedido'],ENT_QUOTES,'UTF-8');

	$consulta = $MBEQ->Listar_Pedidos_timeline($dni, $pedido);//llamamos al modelo
	if (!empty($consulta)) {
		echo json_encode($consulta); // Devuelve los resultados si existen
	} else {
		echo json_encode([]); // Devuelve un array vacío si no hay datos
	}


 ?>