<?php
	include('is_logged.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado
	/*Inicia validacion del lado del servidor*/
	if (empty($_POST['mod_id'])) {
           $errors[] = "ID vacío";
        } else if (empty($_POST['mod_cat'])){
			$errors[] = "Nombre de la categoria vacía";
		} 
                else if (
			
			!empty($_POST['mod_cat'])&&
			!empty($_POST['mod_des'])
		){
		/* Connect To Database*/
		require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
		require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
		// escaping, additionally removing everything that could be (html/javascript-) code
		$categoria=mysqli_real_escape_string($con,(strip_tags($_POST["mod_cat"],ENT_QUOTES)));
		$des=mysqli_real_escape_string($con,(strip_tags($_POST["mod_des"],ENT_QUOTES)));
		$mod_tlinea_mod=intval($_POST['mod_tlinea_mod']);
		
                
                
                
		$id_categoria=$_POST['mod_id'];
		$sql="UPDATE categorias SET nom_cat='".$categoria."', id_tipoLinea=".$mod_tlinea_mod."  , des_cat='".$des."'WHERE id_categoria='".$id_categoria."'";
		$query_update = mysqli_query($con,$sql);
			if ($query_update){
				$messages[] = "La Categoria ha sido actualizada satisfactoriamente.";
			} else{
				//$errors []= "Lo siento algo ha salido mal intenta nuevamente.".mysqli_error($con);
                            $errors []= "Categoria duplicada.";
			}
		} else {
			$errors []= "Error desconocido.";
		}
		
		if (isset($errors)){
			
			?>
			<div id="alertborrarcategorias" class="alert alert-danger" role="alert">
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
				<div id="alertborrarcategorias" class="alert alert-success" role="alert">
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