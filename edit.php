m<?php

session_start();
sleep(1);
$data = intval($_POST['value']);
$field = $_POST['field'];

if($_SESSION['tienda']==1){
    $field1 ="b1";
}
if($_SESSION['tienda']==2){
    $field1 ="b2";
}
if($_SESSION['tienda']==3){
    $field1 ="b3";
}

if($data>=0){

$conexion = new mysqli('localhost','root','', 'sistema3');
$update = "UPDATE `products` SET $field1='".$data."' WHERE id_producto=$field";
$conexion->query($update);
echo $data;
}
?>