<?php 


	
    require '../../model/modelo_producto.php';
    $MP = new Modelo_Producto();

    $productoid = htmlspecialchars($_POST['productoid'], ENT_QUOTES, 'UTF-8');
     $sucurid = htmlspecialchars($_POST['sucurid'], ENT_QUOTES, 'UTF-8');
      $almacen = htmlspecialchars($_POST['almacen'], ENT_QUOTES, 'UTF-8');

	$consulta =  $MP->Traer_stock_productos( $productoid,  $sucurid ,  $almacen );//llamamos al modelo
	echo json_encode($consulta);
	

 ?>