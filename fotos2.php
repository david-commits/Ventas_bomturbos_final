<?php
session_start();
include('menu.php');
require_once ("config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
require_once ("config/conexion.php");//Contiene funcion que conecta a la base de datos

$web=$_POST['web'];
$pre_web=$_POST['pre_web'];
$descripcion=$_POST['descripcion'];

$vvarlor1=(isset($_POST['valor1'])&& $_POST['valor1'] !=NULL)?$_POST['valor1']:'';
$vvarlor2=(isset($_POST['valor2'])&& $_POST['valor2'] !=NULL)?$_POST['valor2']:'';
$vvarlor3=(isset($_POST['valor3'])&& $_POST['valor3'] !=NULL)?$_POST['valor3']:'';
$vvarlor4=(isset($_POST['valor4'])&& $_POST['valor4'] !=NULL)?$_POST['valor4']:'';


$svvarlor1=(isset($_FILES['files']['tmp_name'])&& $_FILES['files']['tmp_name'] !=NULL)?$_FILES['files']['tmp_name']:'';
$svvarlor2=(isset($_FILES['files1']['tmp_name'])&& $_FILES['files1']['tmp_name'] !=NULL)?$_FILES['files1']['tmp_name']:'';
$svvarlor3=(isset($_FILES['files2']['tmp_name'])&& $_FILES['files2']['tmp_name'] !=NULL)?$_FILES['files2']['tmp_name']:'';
$svvarlor4=(isset($_FILES['files3']['tmp_name'])&& $_FILES['files3']['tmp_name'] !=NULL)?$_FILES['files3']['tmp_name']:'';


$nuevovalor = 0 ;
if($vvarlor1 != ""){
    $nuevovalor = $vvarlor1;
}elseif ($vvarlor2 != "") {
    $nuevovalor = $vvarlor2;
}elseif ($vvarlor3 != "") {
    $nuevovalor = $vvarlor3;
}elseif ($vvarlor4 != "") {
    $nuevovalor = $vvarlor4;
}


//if(is_uploaded_file($_FILES['files']['tmp_name']) || is_uploaded_file($_FILES['files1']['tmp_name']) || is_uploaded_file($_FILES['files2']['tmp_name']) || is_uploaded_file($_FILES['files3']['tmp_name']) ) {

if ($svvarlor1 != "") {
    if(is_uploaded_file($_FILES['files']['tmp_name']) && $_FILES['files']['type']<300000) {
        $ruta_destino = "fotos/";
        $namefinal="1producto".$_SESSION['id_producto'].".jpg"; //linea nueva devuelve la cadena sin espacios al principio o al final
        $uploadfile=$ruta_destino.$namefinal;
        if(move_uploaded_file($_FILES['files']['tmp_name'], $uploadfile)) {
            $dml="update products
            set foto1='".$namefinal."',web='".$web."',pre_web='".$pre_web."',descripcion='".$descripcion."', fotoprincipal=".$nuevovalor."
            where id_producto=".$_SESSION['id_producto'];
            $rs=mysqli_query($con,$dml) OR die(mysqli_error($con));
            if(!rs){
                die("No se pudo actualizar..");
            }else{
                header("location:productos.php");
            }
        }
    }
}


if ($svvarlor2 != "") {
    if(is_uploaded_file($_FILES['files1']['tmp_name'])&& $_FILES['files1']['type']<300000) {
        $ruta_destino = "fotos/";
        $namefinal="2producto".$_SESSION['id_producto'].".jpg"; //linea nueva devuelve la cadena sin espacios al principio o al final
        $uploadfile=$ruta_destino.$namefinal;
        if(move_uploaded_file($_FILES['files1']['tmp_name'], $uploadfile)) {
            $dml="update products
             set foto2='".$namefinal."',web='".$web."',pre_web='".$pre_web."',descripcion='".$descripcion."', fotoprincipal=".$nuevovalor."
            where id_producto=".$_SESSION['id_producto'];
            $rs=mysqli_query($con,$dml) OR die(mysqli_error($con));
            if(!rs){
                die("No se pudo actualizar..");
            }else{
                
                header("location:productos.php");
            }
        }
    }
}
 
if ($svvarlor3 != "") {
    if(is_uploaded_file($_FILES['files2']['tmp_name'])&& $_FILES['files2']['type']<300000) {
        $ruta_destino = "fotos/";
        $namefinal="3producto".$_SESSION['id_producto'].".jpg"; //linea nueva devuelve la cadena sin espacios al principio o al final
        $uploadfile=$ruta_destino.$namefinal;
        if(move_uploaded_file($_FILES['files2']['tmp_name'], $uploadfile)) {
            $dml="update products set foto3='".$namefinal."',web='".$web."',pre_web='".$pre_web."',descripcion='".$descripcion."', fotoprincipal=".$nuevovalor." where id_producto=".$_SESSION['id_producto'];
            $rs=mysqli_query($con,$dml) OR die(mysqli_error($con));
            if(!rs){
                die("No se pudo actualizar..");
           }else{
                header("location:productos.php");
           }
        }
    }
}


if ($svvarlor4 != "") {
   if(is_uploaded_file($_FILES['files3']['tmp_name'])&& $_FILES['files3']['type']<300000) {
        $ruta_destino = "fotos/";
        $namefinal="4producto".$_SESSION['id_producto'].".jpg"; //linea nueva devuelve la cadena sin espacios al principio o al final
        $uploadfile=$ruta_destino.$namefinal;
        if(move_uploaded_file($_FILES['files3']['tmp_name'], $uploadfile)) {
            $dml="update products set foto4='".$namefinal."',web='".$web."',pre_web='".$pre_web."',descripcion='".$descripcion."', fotoprincipal=".$nuevovalor." where id_producto=".$_SESSION['id_producto'];
            $rs=mysqli_query($con,$dml) OR die(mysqli_error($con));
            if(!rs){
                die("No se pudo actualizar..");
            }else{
                header("location:productos.php");
            }
        }
    }
}

if ($nuevovalor != "") {
    $dml="update products set fotoprincipal=".$nuevovalor." where id_producto=".$_SESSION['id_producto'];
            $rs=mysqli_query($con,$dml) OR die(mysqli_error($con));
            if(!rs){
                die("No se pudo actualizar..");
            }else{
                header("location:productos.php");
            }
}
  
header("location:productos.php");

