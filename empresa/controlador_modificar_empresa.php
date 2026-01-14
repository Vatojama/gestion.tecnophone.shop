<?php 

	require '../../model/modelo_empresa.php';
	
	
	$MEMP = new Modelo_Empresa();//instaciamops

	$id= htmlspecialchars($_POST['id'],ENT_QUOTES,'UTF-8');
	$razon= htmlspecialchars($_POST['razon'],ENT_QUOTES,'UTF-8');
	$ruc= htmlspecialchars($_POST['ruc'],ENT_QUOTES,'UTF-8');
	$repre= htmlspecialchars($_POST['repre'],ENT_QUOTES,'UTF-8');
	$direccion= htmlspecialchars($_POST['direccion'],ENT_QUOTES,'UTF-8');
	$celular= htmlspecialchars($_POST['celular'],ENT_QUOTES,'UTF-8');
	$telefono= htmlspecialchars($_POST['telefono'],ENT_QUOTES,'UTF-8');
	$correo= htmlspecialchars($_POST['correo'],ENT_QUOTES,'UTF-8');	
	$estado= htmlspecialchars($_POST['estado'],ENT_QUOTES,'UTF-8');	
	$url= htmlspecialchars($_POST['url'],ENT_QUOTES,'UTF-8');
	$cuenta01= htmlspecialchars($_POST['cuenta01'],ENT_QUOTES,'UTF-8');
	$nro_cuenta01= htmlspecialchars($_POST['nro_cuenta01'],ENT_QUOTES,'UTF-8');
	$cuenta02= htmlspecialchars($_POST['cuenta02'],ENT_QUOTES,'UTF-8');
	$nro_cuenta02= htmlspecialchars($_POST['nro_cuenta02'],ENT_QUOTES,'UTF-8');
	$moned= htmlspecialchars($_POST['moned'],ENT_QUOTES,'UTF-8');
	$cod_posta= htmlspecialchars($_POST['cod_posta'],ENT_QUOTES,'UTF-8');

	$tipoigv= htmlspecialchars($_POST['tipoigv'],ENT_QUOTES,'UTF-8');
	$igv= htmlspecialchars($_POST['igv'],ENT_QUOTES,'UTF-8');
	$moneda1= htmlspecialchars($_POST['moneda1'],ENT_QUOTES,'UTF-8');
	$moneda2= htmlspecialchars($_POST['moneda2'],ENT_QUOTES,'UTF-8');
	$nombresistema= htmlspecialchars($_POST['nombresistema'],ENT_QUOTES,'UTF-8');
	$link_sist= htmlspecialchars($_POST['link_sist'],ENT_QUOTES,'UTF-8');
	$codigo_pais= htmlspecialchars($_POST['codigo_pais'],ENT_QUOTES,'UTF-8');
	$clave_co= htmlspecialchars($_POST['clave_co'],ENT_QUOTES,'UTF-8');

	$consulta = $MEMP->Modificar_Empresa($id,$razon,$ruc,$repre,$direccion,$celular,$telefono,$correo,$estado,$url,$cuenta01,$nro_cuenta01,$cuenta02,$nro_cuenta02, $moned, $cod_posta ,$tipoigv, $igv, $moneda1, $moneda2, $nombresistema, $link_sist,$codigo_pais, $clave_co  );//llamamos al modelo
	echo $consulta;
	

 ?>