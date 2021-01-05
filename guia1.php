<?php
session_start();
require_once ("config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
require_once ("config/conexion.php");//Contiene funcion que conecta a la base de datos
include('menu.php');
$id_guia=recoge1('id_guia'); 
$dir_par=$_POST['dir_par']; 
$fecha=recoge1('fecha'); 
$guia=recoge1('guia');  
$dom_lleg=recoge1('dom_lleg');  
$cont_lleg=recoge1('cont_lleg'); 
$tel_lleg=recoge1('tel_lleg'); 
$hor_lleg=recoge1('hor_lleg'); 
$vehiculo=recoge1('vehiculo'); 
$inscripcion=recoge1('inscripcion'); 
$lic=recoge1('lic'); 
$dml="update guia set guia='$guia',dir_par='$dir_par',dom_lleg='$dom_lleg',cont_lleg='$cont_lleg',tel_lleg='$tel_lleg',hor_lleg='$hor_lleg',vehiculo='$vehiculo',inscripcion='$inscripcion',lic='$lic',fecha='$fecha'
where id_doc=".$id_guia;
if(!mysqli_query($con,$dml)){
    die("No se pudo actualizar..");
}else{
    header("location:guia.php?accion=$id_guia");
}

$dml="update documento set numero=$guia+1 where id_documento=4";
if(!mysqli_query($con,$dml)){
    die("No se pudo actualizar..");
}else{
    header("location:guia.php?accion=$id_guia");
}
header("location:guia.php?accion=$id_guia");

?>