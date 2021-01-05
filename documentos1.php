<?php
session_start();
include('menu.php');
require_once ("config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
require_once ("config/conexion.php");//Contiene funcion que conecta a la base de datos

$tien="tienda".$_SESSION['tienda'];
$fol="folio".$_SESSION['tienda'];
$factura=$_POST['factura'];
$boleta=$_POST['boleta'];
$guia=$_POST['guia'];
$remision=$_POST['remision'];
$nota_debito=$_POST['nota_debito'];
$nota_credito=$_POST['nota_credito'];
$folio1=$_POST['folio1'];
$folio2=$_POST['folio2'];
$folio3=$_POST['folio3'];
$folio4=$_POST['folio4'];
$dml="update documento set $tien=$factura,$fol='$folio1' where id_documento=1 ";
if(!mysqli_query($con,$dml)){
    die("No se pudo actualizar1..$dml");
}else{
    header("location:documentos.php");
}
$dml="update documento set $tien=$boleta,$fol='$folio2' where id_documento=2 ";
if(!mysqli_query($con,$dml)){
    die("No se pudo actualizar2..");
}else{
    header("location:documentos.php");
}   
$dml="update documento set $tien=$guia where id_documento=3 ";
if(!mysqli_query($con,$dml)){
    die("No se pudo actualizar3..");
}else{
    header("location:documentos.php");
}
$dml="update documento set $tien=$remision where id_documento=4 " ;
if(!mysqli_query($con,$dml)){
    die("No se pudo actualizar4..");
}else{
    header("location:documentos.php");
}
$dml="update documento set $tien=$nota_debito,$fol='$folio3' where id_documento=5 ";
if(!mysqli_query($con,$dml)){
    die("No se pudo actualizar1..$dml");
}else{
    header("location:documentos.php");
}    
$dml="update documento set $tien=$nota_credito,$fol='$folio4' where id_documento=6 ";
if(!mysqli_query($con,$dml)){
    die("No se pudo actualizar1..$dml");
}else{
    header("location:documentos.php");
}     
        
?>



