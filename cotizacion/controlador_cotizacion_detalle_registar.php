<?php 

	require '../../model/modelo_cotizacion.php';
	$MCOT = new Modelo_Cotizacion();//instaciamos

	$id= htmlspecialchars($_POST['id'],ENT_QUOTES,'UTF-8');
	$producto= htmlspecialchars($_POST['producto'],ENT_QUOTES,'UTF-8');
	$cantidad= htmlspecialchars($_POST['cantidad'],ENT_QUOTES,'UTF-8');
	$precio= htmlspecialchars($_POST['precio'],ENT_QUOTES,'UTF-8');

	$array_producto=  explode(",", $producto);
	$array_cantidad = explode(",", $cantidad);
	$array_precio =  explode(",", $precio);
	for($i=0; $i < count($array_producto);$i++){
		$consulta = $MCOT->Registrar_Detalle_Cotizacion($id,$array_producto[$i],$array_cantidad[$i],$array_precio[$i]);//llamamos al metodo del modelo
	}

	echo $consulta;

 ?>