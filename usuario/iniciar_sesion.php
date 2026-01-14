<?php
//requerimos un modelo
require __DIR__ . '/../../model/modelo_usuario.php';
//modelo usuario
//recibimos datos del js (parametros)
$MU = new Modelo_Usuario();//instaciamops
$usu = htmlspecialchars($_POST['u'], ENT_QUOTES, 'UTF-8');
$pass = htmlspecialchars($_POST['p'], ENT_QUOTES, 'UTF-8');

//llamaos a los datos verificar usuario del modelo
$consulta = $MU->VerificarUsuario($usu, $pass);
//$data = json_encode($consulta);//devuelve un array
if (count($consulta) > 0) {
    echo json_encode($consulta);
} else {
    echo 0;
}
