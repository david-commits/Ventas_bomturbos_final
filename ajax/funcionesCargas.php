<?php 


include('is_logged.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado
$session_id= session_id();



if (isset($_POST['id_proveedores'])){$id_proveedores=$_POST['id_proveedores'];}
if (isset($_POST['id_vendedor'])){$id_vendedor=$_POST['id_vendedor'];}
if (isset($_POST['factura'])){$factura=$_POST['factura'];}
if (isset($_POST['moneda'])){$moneda=$_POST['moneda'];}
if (isset($_POST['condiciones'])){$condiciones=$_POST['condiciones'];}
if (isset($_POST['fechaemision'])){$fechaemision=$_POST['fechaemision'];}
if (isset($_POST['hora'])){$hora=$_POST['hora'];}
if (isset($_POST['dias'])){$dias=$_POST['dias'];}
if (isset($_POST['tcp'])){$tcp=$_POST['tcp'];}


	/* Connect To Database*/
	require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
	require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
if (!empty($id_proveedores) and !empty($id_vendedor) and !empty($factura) and !empty($moneda) and !empty($condiciones)and !empty($fechaemision)and !empty($hora)and !empty($dias) and !empty($tcp))
{

$update_tmp=mysqli_query($con, "UPDATE products set nombre_producto = 'ANILLOS NPR 025 TOYOTA 2Y, 3Y1' where id_producto = 1");

}

?>
