<?php 

	require '../../model/modelo_producto.php';
	$MP = new Modelo_Producto();//instaciamops
	    $idalmacen= htmlspecialchars($_POST['idalmacen'],ENT_QUOTES,'UTF-8');
		$rolid= htmlspecialchars($_POST['rolid'],ENT_QUOTES,'UTF-8');
	$consulta = $MP->Listar_Producto($idalmacen, $rolid);//llamamos al modelo
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