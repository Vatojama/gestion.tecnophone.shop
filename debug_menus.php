<?php
session_start();
require_once '../model/modelo_rol.php';

echo "<h2>DEBUG MENÚS MIGUEL</h2>";
echo "<h3>Sesión:</h3><pre>";
print_r($_SESSION);
echo "</pre>";

$rol = new Modelo_Rol();
$datos = $rol->get_menu_x_rol($_SESSION['S_ROL']);

echo "<h3>Menús encontrados: " . count($datos) . "</h3>";
echo "<pre>";
print_r($datos);
echo "</pre>";
?>