<?php
session_start();
include('menu.php');
require_once ("config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
require_once ("config/conexion.php");//Contiene funcion que conecta a la base de datos
$vehiculo=recoge1('vehiculo');
$namefinal="nuevo.jpg";
if($vehiculo==1){
    $foto="foto1";
}
if($vehiculo==2){
    $foto="foto2";
}
if($vehiculo==3){
    $foto="foto3";
}
if($vehiculo==4){
    $foto="foto4";
}
$dml="update vehiculos set $foto='".$namefinal."' where d_vehiculo=".$_SESSION['id_vehiculo'];
if(!mysqli_query($con,$dml)){
    die("No se pudo actualizar..");
}else{
    header("location:fotosvehiculo.php");
}
 
?>



