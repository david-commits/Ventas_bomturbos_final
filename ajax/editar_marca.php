<?php
	include('is_logged.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado
	/*Inicia validacion del lado del servidor*/
	if (empty($_POST['mod_idMarca'])) {
           $errors[] = "ID vacío";
        }else if (empty($_POST['mod_marca'])) {
           $errors[] = "Nombre vacío";
        
		}  else if (
			!empty($_POST['mod_idMarca']) &&
			$_POST['mod_marca']!="" 
		){
		/* Connect To Database*/
		require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
		require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
		// escaping, additionally removing everything that could be (html/javascript-) code
		//$codigo=mysqli_real_escape_string($con,(strip_tags($_POST["mod_codigo"],ENT_QUOTES)));
		$id_tipo=mysqli_real_escape_string($con,(strip_tags($_POST["mod_idTipo"],ENT_QUOTES)));
		$marca=mysqli_real_escape_string($con,(strip_tags($_POST["mod_marca"],ENT_QUOTES)));
		//$descripcion=mysqli_real_escape_string($con,(strip_tags($_POST["mod_descripcion"],ENT_QUOTES)));

		$id_marca=intval($_POST['mod_idMarca']);


        $consulta="SELECT * FROM marca WHERE ( nombre_marca='$marca') AND id_tipoLinea=$id_tipo and estado=1 and id_marca!=$id_marca";
        $resultado=mysqli_query($con,$consulta);

        if(mysqli_num_rows($resultado)>0)
        {
            // Si es mayor a cero imprimimos que ya existe el usuario
            $errors []= "Codigo o nombre de marca duplicado.";
        }else{
            $sql="UPDATE marca SET id_tipoLinea='".$id_tipo."', nombre_marca='".$marca."', descripcion_marca='".$marca."' WHERE id_marca='".$id_marca."'";

            $query_update = mysqli_query($con,$sql);
            if ($query_update){
                $messages[] = "la Marca ha sido actualizado satisfactoriamente.";
            } else{
                $errors []= "Lo siento algo ha salido mal intenta nuevamente.Codigo Duplicado";
            }
        }

		} else {
			$errors []= "Error desconocido1.";
		}
		
		if (isset($errors)){
			
			?>
			<div id="eliminaranunciomarca" class="alert alert-danger" role="alert">
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
				<div id="eliminaranunciomarca" class="alert alert-success" role="alert">
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





         
                
		


		