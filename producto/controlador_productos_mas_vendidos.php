<?php 

	require '../../model/modelo_producto.php';
	$MP = new Modelo_Producto();//instaciamops
	$finicio= htmlspecialchars($_POST['finicio'],ENT_QUOTES,'UTF-8');
	$ffin= htmlspecialchars($_POST['ffin'],ENT_QUOTES,'UTF-8');
	$sucurid= htmlspecialchars($_POST['sucurid'],ENT_QUOTES,'UTF-8');
	
	$consulta = $MP->Listar_Productos_mas_Vendidos($finicio, $ffin, $sucurid);//llamamos al modelo
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