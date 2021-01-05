<?php
session_start();
require_once ("config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
require_once ("config/conexion.php");
$alerta=$_POST['alerta'];
$dml="update datosempresa set alerta=$alerta where id_emp=1";
$res2=mysqli_query($con,$dml) OR die(mysqli_error($con));
if(!$res2){
    die("No se pudo actualizar..");
}else{
    header("location:productos.php");
}
               
        
        
        
 
 
 
 
 
?>



