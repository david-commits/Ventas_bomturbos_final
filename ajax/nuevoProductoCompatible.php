<?php
	include('is_logged.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado
	/*Inicia validacion del lado del servidor*/
	if (empty($_POST['marcavehiculo'])) {
        $errors[] = "Nombre de la marca vacío";
    } else if(empty($_POST['vehiculo'])){
        $errors[] = "vehiculo vacío";
    }else if(empty($_POST['modelovehiculo'])){
        $errors[] = "Modelo vacío";
    }else if(empty($_POST['articulo'])){
        $errors[] = "Artículo vacío";
    }else if(empty($_POST['motor_id'])){
        $errors[] = "Motor vacío";
    }
    else if (!empty($_POST['marcavehiculo']) && !empty($_POST['vehiculo']) && !empty($_POST['modelovehiculo']) && !empty($_POST['articulo']) && !empty($_POST['motor_id']) ){
		/* Connect To Database*/
		require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
		require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
		// escaping, additionally removing everything that could be (html/javascript-) code
		$vehiculo=mysqli_real_escape_string($con,(strip_tags($_POST["vehiculo"],ENT_QUOTES)));
		$marcavehiculo=mysqli_real_escape_string($con,(strip_tags($_POST["marcavehiculo"],ENT_QUOTES)));
		$modelovehiculo=mysqli_real_escape_string($con,(strip_tags($_POST["modelovehiculo"],ENT_QUOTES)));
		$articulo=mysqli_real_escape_string($con,(strip_tags($_POST["articulo"],ENT_QUOTES)));
		$motorproduc=mysqli_real_escape_string($con,(strip_tags($_POST["motor_id"],ENT_QUOTES)));
	    date_default_timezone_set('America/Lima');
		$date_added=date("Y-m-d H:i:s");
		$sql="INSERT INTO compatible (id_producto,id_vehiculo,id_marcaVehiculo,id_modeloVehiculo,motor) VALUES ('$articulo','$vehiculo','$marcavehiculo','$modelovehiculo','$motorproduc')";
		echo "<script>console.log($sql);</script>";
		$query_new_insert = mysqli_query($con,$sql) or die(mysqli_error($con));
		if ($query_new_insert){
			$messages[] = "compatibilidad ha sido ingresado satisfactoriamente.";
		} else{
			$errors []= "compatibilidad duplicado.";
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