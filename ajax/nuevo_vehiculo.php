<?php
	include('is_logged.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado
	/*Inicia validacion del lado del servidor*/
	if (empty($_POST['nombre'])) {
        $_POST['nombre']="";
        } else if (!empty($_POST['nombre'])){
		/* Connect To Database*/
		require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
		require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
		// escaping, additionally removing everything that could be (html/javascript-) code
		$nombre=mysqli_real_escape_string($con,(strip_tags($_POST["nombre"],ENT_QUOTES)));
		$marca=mysqli_real_escape_string($con,(strip_tags($_POST["marca"],ENT_QUOTES)));
		$modelo=mysqli_real_escape_string($con,(strip_tags($_POST["modelo"],ENT_QUOTES)));

		$motor=mysqli_real_escape_string($con,(strip_tags($_POST["motor"],ENT_QUOTES)));
		$anio=mysqli_real_escape_string($con,(strip_tags($_POST["anio"],ENT_QUOTES)));
		$cilindro=mysqli_real_escape_string($con,(strip_tags($_POST["cilindro"],ENT_QUOTES)));
		$combustible=mysqli_real_escape_string($con,(strip_tags($_POST["combustible"],ENT_QUOTES)));
		$detalle=mysqli_real_escape_string($con,(strip_tags($_POST["detalle"],ENT_QUOTES)));




$sql="INSERT INTO vehiculos (nombre_vehiculo,id_marca,id_modelo,motor,cilindro,anio,combustible,detalle,estado) VALUES ('$nombre','$marca','$modelo','$motor','$cilindro','$anio','$combustible','$detalle', '1')";


			$consulta="SELECT * FROM vehiculos WHERE nombre_vehiculo='$nombre' AND id_marca=$marca  AND id_modelo=$modelo AND motor='$motor' AND cilindro='$cilindro' AND anio='$anio' AND estado=1";

	         $resultado=mysqli_query($con,$consulta);
	        if(mysqli_num_rows($resultado)>0)
	        {
	            // Si es mayor a cero imprimimos que ya existe el usuario
	            $errors []= "Vehiculo duplicado.";
	        }else{
	        	$query_new_insert = mysqli_query($con,$sql) or die(mysqli_error($con));
				if ($query_new_insert){
					$messages[] = "Vehiculo ha sido ingresado satisfactoriamente.";
				} else{
					$errors []= "Vehiculo duplicado.";
				}
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

