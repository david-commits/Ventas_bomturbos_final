<?php
include('is_logged.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado
	/*Inicia validacion del lado del servidor*/
	if (empty($_POST['nom_cat'])) {
           $errors[] = "Categoría vacía";
        } else if (empty($_POST['nom_cat'])){
			$errors[] = "Nombre de la categoría vacía";
		} else if (empty($_POST['tlinea'])){
			$errors[] = "Nombre de la Línea vacía";
		} 
                
                
                else if (
			!empty($_POST['nom_cat']) &&
			!empty($_POST['des_cat']) &&
			!empty($_POST['tlinea']) 
                        
                        
			
			
		){

		/* Connect To Database*/
		require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
		require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
		// escaping, additionally removing everything that could be (html/javascript-) code
		$nom_cat=mysqli_real_escape_string($con,(strip_tags($_POST["nom_cat"],ENT_QUOTES)));
		$des_cat=mysqli_real_escape_string($con,(strip_tags($_POST["des_cat"],ENT_QUOTES)));
		$idtlinea=intval($_POST['tlinea']);
		$sql="INSERT INTO categorias (nom_cat, des_cat,id_tipoLinea ,estado) VALUES ('$nom_cat','$des_cat',$idtlinea ,1)";

		$query_new_insert = mysqli_query($con,$sql);
			if ($query_new_insert){
				$messages[] = "Categoria ha sido ingresado satisfactoriamente.";
			} else{
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