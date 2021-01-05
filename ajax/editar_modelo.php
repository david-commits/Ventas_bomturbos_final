<?php
	include('is_logged.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado
	/*Inicia validacion del lado del servidor*/
	if (empty($_POST['mod_idModelo'])) {
           $errors[] = "ID vacío";
        }else if (empty($_POST['mod_idModelo'])) {
           $errors[] = "Nombre vacío";
        
		}  else if (
			!empty($_POST['mod_idModelo']) &&
			$_POST['mod_modelo']!="" 
		){
		/* Connect To Database*/
		require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
		require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
		// escaping, additionally removing everything that could be (html/javascript-) code
		
		$modelo=mysqli_real_escape_string($con,(strip_tags($_POST["mod_modelo"],ENT_QUOTES)));
		$descripcion=mysqli_real_escape_string($con,(strip_tags($_POST["mod_descripcion"],ENT_QUOTES)));
		$estado=mysqli_real_escape_string($con,(strip_tags($_POST["mod_estado"],ENT_QUOTES)));
		

		$id_modelo=intval($_POST['mod_idModelo']);
		$sql="UPDATE modelos SET  nombre_modelo='".$modelo."', descripcion_modelo='".$descripcion."', estado='".$estado."' WHERE id_modelo='".$id_modelo."'";

			$consulta="SELECT * FROM modelos WHERE nombre_modelo='$modelo' AND estado=1 AND id_modelo!=$id_modelo";
	         $resultado=mysqli_query($con,$consulta);

	        if(mysqli_num_rows($resultado)>0)
	        {
	            // Si es mayor a cero imprimimos que ya existe el usuario
	            $errors []= "Modelo duplicado.";
	        }else{
	        	$query_update = mysqli_query($con,$sql);
				if ($query_update){
					$messages[] = " El Modelo ha sido actualizado satisfactoriamente.";
				} else{
					$errors []= "Lo siento algo ha salido mal intenta nuevamente.Codigo Duplicado";
				}
	        }

		 
		} else {
			$errors []= "Error desconocido.";
		}
		
		if (isset($errors)){
			
			?>
			<div id="eliminaranunciomodelo" class="alert alert-danger" role="alert">
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
				<div id="eliminaranunciomodelo" class="alert alert-success" role="alert">
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





         
                
		


		