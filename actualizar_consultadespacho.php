<?php

session_start();
include('menu.php');

require_once ("config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
require_once ("config/conexion.php");//Contiene funcion que conecta a la base de datos


$id_despacho_mod=$_POST['id_despacho_mod']; 
$estado_pago_mod=$_POST['estado_pago_mod'];
$estado_envio_mod=$_POST['estado_envio_mod'];
echo $id_despacho_mod;
echo "<br>";
echo $estado_pago_mod;
echo "<br>";
echo $estado_envio_mod;

$consulta = "UPDATE cabecera_orden set estado_pago = ".$estado_pago_mod." , estado_envio = ".$estado_envio_mod." where id = ".$id_despacho_mod." ";

	if (mysqli_query($con, $consulta)) {  
    	header("location:despachos.php");
	} else {
    	echo "<script>history.back(alert('no se pudo actualizar los estados, intentelo nuevamente.' ))</script>";
	}
?>