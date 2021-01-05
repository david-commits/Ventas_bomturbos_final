<?php
session_start();
include("menu.php");
 $accion=recoge1('accion');
 $tipo=recoge1('tipo');


if ($accion==1) {
 $_SESSION['doc_ventas']=1;
}
if ($accion==2) {
 $_SESSION['doc_ventas']=2;
}

if ($accion==3) {
 $_SESSION['doc_ventas']=3;
}

if ($accion==5) {
 $_SESSION['doc_ventas']=5;
}

if ($accion==6) {
 $_SESSION['doc_ventas']=6;
}
if ($accion==7) {
 $_SESSION['doc_ventas']=7;
}



if($tipo==1){
header("location:nueva_factura.php");
}else{
 header("location:nueva_compras.php");   
}
?>