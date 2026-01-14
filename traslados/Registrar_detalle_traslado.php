<?php 

    require '../../model/modelo_traslado.php';
    $MTR = new Modelo_Traslados();//instaciamos

	$id= htmlspecialchars($_POST['id'],ENT_QUOTES,'UTF-8');
	$producto= htmlspecialchars($_POST['producto'],ENT_QUOTES,'UTF-8');
	$precio= htmlspecialchars($_POST['precio'],ENT_QUOTES,'UTF-8');
    $cantidad= htmlspecialchars($_POST['cantidad'],ENT_QUOTES,'UTF-8');
    $idalmacendestino= htmlspecialchars($_POST['idalmacendestino'],ENT_QUOTES,'UTF-8');
    $idalmacenorigen= htmlspecialchars($_POST['idalmacenorigen'],ENT_QUOTES,'UTF-8');
	$idusuario= htmlspecialchars($_POST['idusuario'],ENT_QUOTES,'UTF-8');


	$array_producto=  explode(",", $producto);
    $array_precio =  explode(",", $precio);
	$array_cantidad = explode(",", $cantidad);
    
	
	for($i=0; $i < count($array_producto);$i++){
		$consulta = $MTR->Registrar_Detalle_Traslado($id,$array_producto[$i],$array_precio[$i], $array_cantidad[$i], $idalmacendestino, $idalmacenorigen, $idusuario);//llamamos al metodo del modelo
	}

	echo json_encode($consulta);
	

 ?>