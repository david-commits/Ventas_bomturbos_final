<?php
	include('is_logged.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado
	/*Inicia validacion del lado del servidor*/
	if (empty($_POST['mod_idMotor'])) {
           $errors[] = "ID vacío";
        }else if (empty($_POST['mod_marca_m'])) {
           $errors[] = "Marca vacío";
        
		}else if (empty($_POST['mod_modelo_m'])) {
           $errors[] = "Modelo vacío";
        
		}else if (empty($_POST['nombre_editar_motor'])) {
           $errors[] = "Nombre vacío";
        
		}  else if (
			!empty($_POST['mod_idMotor']) &&
			$_POST['mod_marca_m']!="" &&
			$_POST['mod_marca_m']!="" &&
			$_POST['nombre_editar_motor']!="" 
		){
		/* Connect To Database*/
		require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
		require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
		// escaping, additionally removing everything that could be (html/javascript-) code
		//$id_motor=mysqli_real_escape_string($con,(strip_tags($_POST["mod_idMotor"],ENT_QUOTES)));
		$id_modelo=mysqli_real_escape_string($con,(strip_tags($_POST["mod_modelo_m"],ENT_QUOTES)));
		$id_marca=mysqli_real_escape_string($con,(strip_tags($_POST["mod_marca_m"],ENT_QUOTES)));
		$nombre_motor=mysqli_real_escape_string($con,(strip_tags($_POST["nombre_editar_motor"],ENT_QUOTES)));
		$descripcion_motor=mysqli_real_escape_string($con,(strip_tags($_POST["descripcion_editar_motor"],ENT_QUOTES)));

		$id_motor=intval($_POST['mod_idMotor']);


        $consulta="SELECT * FROM motor WHERE idmarca=$id_marca AND idmodelo=$id_modelo AND nombre='$nombre_motor' AND descripcion='".$descripcion_motor."' and estado=1";
        $resultado=mysqli_query($con,$consulta);

        if(mysqli_num_rows($resultado)>0)
        {
            // Si es mayor a cero imprimimos que ya existe el usuario
            $errors []= "Este motor ya existe. Intente con datos diferentes.";
        }else{
            $sql="UPDATE motor SET idmarca='".$id_marca."', idmodelo='".$id_modelo."', nombre='".$nombre_motor."', descripcion='".$descripcion_motor."' WHERE id_motor='".$id_motor."'";

            $query_update = mysqli_query($con,$sql);
            if ($query_update){
                $messages[] = "Motor ha sido actualizado satisfactoriamente.";
            } else{
                $errors []= "Lo siento algo ha salido mal intenta nuevamente.";
            }
        }

		} else {
			$errors []= "Error desconocido1.";
		}
		
		if (isset($errors)){
			
			?>
			<div id="eliminaranunciomotor" class="alert alert-danger" role="alert">
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
				<div id="eliminaranunciomotor" class="alert alert-success" role="alert">
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





         
                
		


		