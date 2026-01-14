<?php 

	require '../../model/modelo_tienda.php';
	$MTIE = new Modelo_Tienda();//instaciamos
    $idpedido= htmlspecialchars($_POST['idpedido'],ENT_QUOTES,'UTF-8');


	$consulta = $MTIE->Listar_Detalle_Pedidos($idpedido);//llamamos al modelo
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