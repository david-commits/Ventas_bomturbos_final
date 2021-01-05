<?php
session_start();
require_once ("config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
require_once ("config/conexion.php");//Contiene funcion que conecta a la base de datos
include('menu.php');

$a1=recoge1('nom_pro');
$a2=recoge1('cod_pro');
$a3=recoge1('marca');
$a4=recoge1('modelo');
$a5=recoge1('tipo');
$a6=recoge1('cat');
$a7=recoge1('color');


$consulta="INSERT INTO consultas VALUES ('','1','$a1','$a2','$a3','$a4','$a5','$a6','$a7')";


$_SESSION['tabla']=2;
$delete=mysqli_query($con,"DELETE FROM consultas");
$insert=mysqli_query($con,$consulta);

header("location:consultaproductos.php");
?>
