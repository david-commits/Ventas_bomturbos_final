<?php
include('is_logged.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado
/*Inicia validacion del lado del servidor*/
if (empty($_POST['nombre'])) {
           $errors[] = "Nombre del proveedor vacío";
        } else if (!empty($_POST['nombre'])){
/* Connect To Database*/
require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
// escaping, additionally removing everything that could be (html/javascript-) code
$nombre=mysqli_real_escape_string($con,(strip_tags($_POST["nombre"],ENT_QUOTES)));
$codprov=mysqli_real_escape_string($con,(strip_tags($_POST["codprov"],ENT_QUOTES)));
$doc=mysqli_real_escape_string($con,(strip_tags($_POST["doc"],ENT_QUOTES)));
                //$dni=mysqli_real_escape_string($con,(strip_tags($_POST["dni"],ENT_QUOTES)));
                $ven=mysqli_real_escape_string($con,(strip_tags($_POST["ven"],ENT_QUOTES)));
                $tienda1=$_SESSION['tienda'];
                $telefono=mysqli_real_escape_string($con,(strip_tags($_POST["telefono"],ENT_QUOTES)));
                $email=mysqli_real_escape_string($con,(strip_tags($_POST["email"],ENT_QUOTES)));
                $direccion=mysqli_real_escape_string($con,(strip_tags($_POST["direccion"],ENT_QUOTES)));
                $departamento=mysqli_real_escape_string($con,(strip_tags($_POST["departamento"],ENT_QUOTES)));
                $provincia=mysqli_real_escape_string($con,(strip_tags($_POST["provincia"],ENT_QUOTES)));
                $distrito=mysqli_real_escape_string($con,(strip_tags($_POST["distrito"],ENT_QUOTES)));
                $cuenta=mysqli_real_escape_string($con,(strip_tags($_POST["cuenta"],ENT_QUOTES)));
               
               
                $estado=intval($_POST['estado']);
                date_default_timezone_set('America/Lima');
$date_added=date("Y-m-d H:i:s");
$sql="INSERT INTO proveedores (nom_pro, tel_pro, email_provedor, dir_pro, status_proveedor, date_added,doc,ruc_pro,vendedor,departamento,provincia,distrito,cuenta_ban,codigoProveedor) VALUES ('$nombre','$telefono','$email','$direccion','$estado','$date_added','$doc','$doc','$ven','$departamento','$provincia','$distrito','$cuenta','$codprov')";
$query_new_insert = mysqli_query($con,$sql);
if ($query_new_insert){
$messages[] = "Proveedor ha sido ingresado satisfactoriamente.";
} else{
$errors []= "Proveedor duplicado.";
}
} else {
$errors []= "Error desconocido.";
}

if (isset($errors)){

?>
<div class="alert alert-danger" role="alert">
<button type="button" class="close" data-dismiss="alert">&times;</button>
<strong>Error!</strong>
<?php
foreach ($errors as $error) {
echo $error;
}
?>
</div>
<?php
}
if (isset($messages)){

?>
<div class="alert alert-success" role="alert">
<button type="button" class="close" data-dismiss="alert">&times;</button>
<strong>¡Bien hecho!</strong>
<?php
foreach ($messages as $message) {
echo $message;
}
?>
</div>
<?php
}

?>
