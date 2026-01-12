<?php
session_start();
echo "<h2>DEBUG SESIÓN MIGUEL</h2>";
echo "<pre>";
print_r($_SESSION);
echo "</pre>";

echo "<h3>Variables Críticas:</h3>";
echo "S_IDUSUARIO: " . (isset($_SESSION['S_IDUSUARIO']) ? $_SESSION['S_IDUSUARIO'] : '❌ NO EXISTE') . "<br>";
echo "S_USUARIO: " . (isset($_SESSION['S_USUARIO']) ? $_SESSION['S_USUARIO'] : '❌ NO EXISTE') . "<br>";
echo "S_ROL: " . (isset($_SESSION['S_ROL']) ? $_SESSION['S_ROL'] : '❌ NO EXISTE') . "<br>";
echo "S_IDSUCURSAL: " . (isset($_SESSION['S_IDSUCURSAL']) ? $_SESSION['S_IDSUCURSAL'] : '❌ NO EXISTE') . "<br>";
echo "S_IDALMACEN: " . (isset($_SESSION['S_IDALMACEN']) ? $_SESSION['S_IDALMACEN'] : '❌ NO EXISTE') . "<br>";
?>