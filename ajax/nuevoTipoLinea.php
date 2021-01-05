<?php
	include('is_logged.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado
	/*Inicia validacion del lado del servidor*/
	if (empty($_POST['nombre'])) {
           $errors[] = "Nombre de la marca vacío";
        } else if (!empty($_POST['nombre'])){
			/* Connect To Database*/
			require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
			require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
			// escaping, additionally removing everything that could be (html/javascript-) code
			
			$nombre=mysqli_real_escape_string($con,(strip_tags($_POST["nombre"],ENT_QUOTES)));
			$descripcion=mysqli_real_escape_string($con,(strip_tags($_POST["descripcion"],ENT_QUOTES)));
	        date_default_timezone_set('America/Lima');
			$date_added=date("Y-m-d H:i:s");
			

			$consulta="SELECT * FROM tipo_linea WHERE nombre_tipoLinea='$nombre' AND estado=1";
	         $resultado=mysqli_query($con,$consulta);

	        if(mysqli_num_rows($resultado)>0)
	        {
	            // Si es mayor a cero imprimimos que ya existe el usuario
	            $errors []= "Tipo linea duplicado.";
	        }else{
            	$sql="INSERT INTO tipo_linea(nombre_tipoLinea,descripcion_tipoLinea,estado) VALUES ('$nombre','$descripcion','1')";

				$query_new_insert = mysqli_query($con,$sql) or die(mysqli_error($con));
				if ($query_new_insert){
					$messages[] = "Tipo Linea ha sido ingresado satisfactoriamente.";
				} else{
					$errors []= "Tipo Linea duplicado.";
				}
        	}
		} else {
			$errors []= "Error desconocido.";
		}

		
		if (isset($errors)){
			
			?>
			<div id="alertaborrar" class="alert alert-danger" role="alert">
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
				<div id="alertaborrar" class="alert alert-success" role="alert">
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