<?php
	include('is_logged.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado
	/*Inicia validacion del lado del servidor*/
	if (empty($_POST['mod_idtipo'])) {
           $errors[] = "ID vacío";
        }else if (empty($_POST['mod_nombre'])) {
           $errors[] = "Nombre vacío";
        
		} else if (empty($_POST['mod_tlinea_mod'])) {
           $errors[] = "Tipo Linea vacío";
        
		}else if (empty($_POST['mod_categoria_mod'])) {
           $errors[] = "Categoría vacío";
        
		} else if (
			!empty($_POST['mod_idtipo']) && !empty($_POST['mod_tlinea_mod']) && !empty($_POST['mod_categoria_mod']) &&
			$_POST['mod_nombre']!="" 
		){
		/* Connect To Database*/
		require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
		require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
		// escaping, additionally removing everything that could be (html/javascript-) code
	
		$nombre=mysqli_real_escape_string($con,(strip_tags($_POST["mod_nombre"],ENT_QUOTES)));
		$estado=mysqli_real_escape_string($con,(strip_tags($_POST["mod_estado"],ENT_QUOTES)));
		
		$id_tipo=intval($_POST['mod_idtipo']);
		$mod_tlinea_mod=intval($_POST['mod_tlinea_mod']);
		$mod_categoria_mod=intval($_POST['mod_categoria_mod']);


		$consulta="SELECT * FROM tipo WHERE tipo='$nombre' and id_tipoLinea = $mod_tlinea_mod AND id_categoria = $mod_categoria_mod AND estado=1 and id_tipo!=$id_tipo";
         $resultado=mysqli_query($con,$consulta);

        if(mysqli_num_rows($resultado)>0)
        {
            // Si es mayor a cero imprimimos que ya existe el usuario
            $errors []= "Tipo linea duplicado.";
        }else{
        	$sql="UPDATE tipo SET tipo='".$nombre."',  id_tipoLinea = $mod_tlinea_mod , id_categoria = $mod_categoria_mod , estado=$estado WHERE id_tipo='".$id_tipo."'";
//var_dump($sql);
		 $query_update = mysqli_query($con,$sql);
			if ($query_update){
				$messages[] = "El tipo de articulo ha sido actualizado satisfactoriamente.";
			} else{
				$errors []= "Lo siento algo ha salido mal intenta nuevamente.Codigo Duplicado";
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





         
                
		


		