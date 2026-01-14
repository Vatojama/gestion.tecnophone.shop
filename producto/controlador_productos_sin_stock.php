<?php 

	require '../../model/modelo_producto.php';
	$MP = new Modelo_Producto();//instaciamops

	$sucurid= htmlspecialchars($_POST['sucurid'],ENT_QUOTES,'UTF-8');


	$consulta = $MP->Listar_Productos_sin_stock($sucurid);//llamamos al modelo
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