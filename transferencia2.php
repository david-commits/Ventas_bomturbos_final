<?php
session_start();
include('menu.php');
require_once ("config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
require_once ("config/conexion.php");//Contiene funcion que conecta a la base de datos
$usuario=$_SESSION['user_id'];
$consulta1 = "SELECT * FROM products ";
$result1 = mysqli_query($con, $consulta1);
$id=$_POST['id_producto'];
$tienda2=$_POST['tienda2'];
$inv_productomostrar=$_POST['inv_producto'];
$precio_productomostrar=$_POST['precio'];
$cantidad_productomostrar=$_POST['cantidad'];


$cc2 = 0;
$c = 0;
$c1 = 0;
$c2 = 0;
$c3 = 0;
$c4 = 0;
$c5 = 0;
$c6 = 0;


$b1 = 0;
$b2 = 0;
$b3 = 0;
$b4 = 0;
$b5 = 0;
$b6 = 0;

while ($valor1 = mysqli_fetch_array($result1, MYSQLI_ASSOC)) {//en este while llega la cantidad existente del producto que se quiere hacer la transferencia
    if($valor1['id_producto']==$id){
        $c1=$valor1['b1'];
        $c2=$valor1['b2'];
        $c3=$valor1['b3'];
        $c4=$valor1['b4'];
        $c5=$valor1['b5'];
        $c6=$valor1['b6'];
    }
}
date_default_timezone_set('America/Lima');
$fecha1  = date("Y-m-d H:i:s");
$tienda=$_SESSION['tienda'];
$cantidad=$_POST['cantidad'];
$precio=$_POST['precio'];
$inv_producto=$_POST['inv_producto'];

if($tienda==1){
   $c=$c1;
}
if($tienda==2){
  $c=$c2;
}
if($tienda==3){
   $c=$c3;
}
if($tienda==4){
   $c=$c4;
}
if($tienda==5){
   $c=$c5;
}
if($tienda==6){
   $c=$c6;
}



if($tienda2==1){
   $c2=$c1;
}
if($tienda2==2){
  $c2=$c2;
}
if($tienda2==3){
   $c2=$c3;
}
if($tienda2==4){
   $c2=$c4;
}
if($tienda2==5){
   $c2=$c5;
}
if($tienda2==6){
   $c2=$c6;
}

//c es la cantidad de la tienda 1
//c2 es la cantidad de la tienda 2
$cantidadtienda1modificadaquitar = 0;
$cantidadtienda1modificadaagregar = 0;

//aca vamos a poner la cantidad que le pertenece a cada uno
$cantidadtienda1modificada = $c - $cantidad;
//aca vamos a poner la cantidad que le pertenece a cada uno
$cantidadtienda1modificadaagregar = $c2 + $cantidad;


if($tienda==1){
   $c1=$cantidadtienda1modificada;
}
if($tienda==2){
  $c2=$cantidadtienda1modificada;
}
if($tienda==3){
   $c3=$cantidadtienda1modificada;
}
if($tienda==4){
   $c4=$cantidadtienda1modificada;
}
if($tienda==5){
   $c5=$cantidadtienda1modificada;
}
if($tienda==6){
   $c6=$cantidadtienda1modificada;
}


if($tienda2==1){
   $c1=$cantidadtienda1modificadaagregar;
}
if($tienda2==2){
  $c2=$cantidadtienda1modificadaagregar;
}
if($tienda2==3){
   $c3=$cantidadtienda1modificadaagregar;
}
if($tienda2==4){
   $c4=$cantidadtienda1modificadaagregar;
}
if($tienda2==5){
   $c5=$cantidadtienda1modificadaagregar;
}
if($tienda2==6){
   $c6=$cantidadtienda1modificadaagregar;
}
$b1 = $c1;
$b2 = $c2;
$b3 = $c3;
$b4 = $c4;
$b5 = $c5;
$b6 = $c6;
/*$b1="b".$tienda;
$b2="b".$tienda2;
*/$user_id=$_SESSION['user_id'];



if($id>0 && $cantidad<=$inv_producto && $inv_producto>0 ){
    $consulta2 = "UPDATE products set b1=".$b1.", b2=".$b2.", b3=".$b3.", b4=".$b4.", b5=".$b5.", b6=".$b6." where id_producto=".$id."";
    $cqueryinserttransferencia = "INSERT INTO transferencias (id_producto, tiendaenvia, cantidad, tiendarecibe, usuario, estado) value(".$id.", ".$tienda.",".$cantidad.", ".$tienda2.", ".$usuario.", 1);"; 
        if (mysqli_query($con, $consulta2)) {
           // header("location:transferencia.php");
           if (mysqli_query($con, $cqueryinserttransferencia)) {
           echo "<script>
                alert('Cantidad de producto transferido.');
                window.location= 'transferencia.php'
                </script>";
           }
        } else {
              echo "<script>
                alert('No se pudo hacer la transferencia.');
                window.location= 'transferencia.php'
                </script>";
        }             
}else{
            echo "<script>history.back(alert('El producto no existe o la cantidad a transferir es superior a la existente en el inventario'))</script>";
}
?>



