<?php
	include('is_logged.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado
	/*Inicia validacion del lado del servidor*/
	if (empty($_POST['mod_idtipo'])) {
           $errors[] = "ID vacío";
        }else if (empty($_POST['mod_nombre'])) {
           $errors[] = "Nombre vacío";
        
		}  else if (
			!empty($_POST['mod_idtipo']) &&
			$_POST['mod_nombre']!="" 
		){
		/* Connect To Database*/
		require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
		require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
		// escaping, additionally removing everything that could be (html/javascript-) code
	
		$nombre=mysqli_real_escape_string($con,(strip_tags($_POST["mod_nombre"],ENT_QUOTES)));
		$descripcion=mysqli_real_escape_string($con,(strip_tags($_POST["mod_descripcion"],ENT_QUOTES)));
		$estado=mysqli_real_escape_string($con,(strip_tags($_POST["mod_estado"],ENT_QUOTES)));
		
		$id_tipo=intval($_POST['mod_idtipo']);


		$consulta="SELECT * FROM tipo_linea WHERE nombre_tipoLinea='$nombre' AND estado=1 and id_tipoLinea!=$id_tipo";
         $resultado=mysqli_query($con,$consulta);

        if(mysqli_num_rows($resultado)>0)
        {
            // Si es mayor a cero imprimimos que ya existe el usuario
            $errors []= "Tipo linea duplicado.";
        }else{
        	$sql="UPDATE tipo_linea SET nombre_tipoLinea='".$nombre."', descripcion_tipoLinea='".$descripcion."', estado='".$estado."' WHERE id_tipoLinea='".$id_tipo."'";

		 $query_update = mysqli_query($con,$sql);
			if ($query_update){
				$messages[] = "El tipo de linea ha sido actualizado satisfactoriamente.";
			} else{
				$errors []= "Lo siento algo ha salido mal intenta nuevamente.Codigo Duplicado";
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





         
                
		


		