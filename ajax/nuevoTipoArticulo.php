<?php
	include('is_logged.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado
	/*Inicia validacion del lado del servidor*/
	if (empty($_POST['nombre'])) 
	{
        $errors[] = "Nombre de Tipo Artículo vacío";
    } else if (empty($_POST['n_categoria'])){
			$errors[] = "Nombre de la Categoría vacío";
		}else if (empty($_POST['tlinea'])){
			$errors[] = "Nombre del Tipo Línea vacío";
		}
    else if (!empty($_POST['nombre']) && !empty($_POST['n_categoria']) && !empty($_POST['tlinea']))
    {
		/* Connect To Database*/
		require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
		require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
		// escaping, additionally removing everything that could be (html/javascript-) code
			
		$nombre=mysqli_real_escape_string($con,(strip_tags($_POST["nombre"],ENT_QUOTES)));
		$n_categoria=intval($_POST['n_categoria']);
		$tlinea=intval($_POST['tlinea']);

	    date_default_timezone_set('America/Lima');
		$date_added=date("Y-m-d H:i:s");
			
		$consulta="SELECT * FROM tipo WHERE tipo='$nombre' and id_tipoLinea = $tlinea and id_categoria = $n_categoria AND estado=1";
	    $resultado=mysqli_query($con,$consulta);

	    if(mysqli_num_rows($resultado)>0)
	    {
	        // Si es mayor a cero imprimimos que ya existe el usuario
	        $errors []= "Tipo linea duplicado.";
	    }
	    else
	    {
           	$sql="INSERT INTO tipo(tipo,id_tipoLinea,id_categoria) VALUES ('$nombre', $tlinea, $n_categoria)";

			$query_new_insert = mysqli_query($con,$sql) or die(mysqli_error($con));
			if ($query_new_insert){
				$messages[] = "Tipo Artículo ha sido ingresado satisfactoriamente.";
			} 
			else
			{
				$errors []= "Tipo Artículo duplicado.";
			}
        }
	} 
	else 
	{
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