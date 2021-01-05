<?php
session_start();
include("menu.php");
$accion=recoge1('accion');
$_SESSION['id_vehiculo']=$accion;
header("location:fotosvehiculo.php");

?>