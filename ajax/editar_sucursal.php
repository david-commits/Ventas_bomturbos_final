<?php
	include('is_logged.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado
	/*Inicia validacion del lado del servidor*/
	if (empty($_POST['mod_id'])) {
           $errors[] = "ID vacío";
        } else if (empty($_POST['mod_nombre'])){
			$errors[] = "Nombre de la sucursal vacía";
		} 
                else if (
			
			!empty($_POST['mod_nombre'])
		){
		/* Connect To Database*/
		require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
		require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
		// escaping, additionally removing everything that could be (html/javascript-) code
		$nombre=mysqli_real_escape_string($con,(strip_tags($_POST["mod_nombre"],ENT_QUOTES)));
		$ruc=mysqli_real_escape_string($con,(strip_tags($_POST["mod_ruc"],ENT_QUOTES)));
		$direccion=mysqli_real_escape_string($con,(strip_tags($_POST["mod_direccion"],ENT_QUOTES)));
                $correo=mysqli_real_escape_string($con,(strip_tags($_POST["mod_correo"],ENT_QUOTES)));
                $telefono=mysqli_real_escape_string($con,(strip_tags($_POST["mod_telefono"],ENT_QUOTES)));
		
                
                
                
		$id_sucursal=$_POST['mod_id'];
		$mod_estado_sucursal=$_POST['mod_estado_sucursal'];

		$sqlchangeest = "UPDATE sucursal SET id_sucursal_principal = 0 where id_sucursal != 0";
		$query_update_changeest = mysqli_query($con,$sqlchangeest);



		$sql="UPDATE sucursal SET nombre='".$nombre."',ruc='".$ruc."',direccion='".$direccion."',correo='".$correo."',telefono='".$telefono."',id_sucursal_principal = ".$mod_estado_sucursal."  WHERE id_sucursal='".$id_sucursal."'";
		$query_update = mysqli_query($con,$sql);
			if ($query_update){
				$messages[] = "La Sucursal ha sido actualizado satisfactoriamente.";
			} else{
				//$errors []= "Lo siento algo ha salido mal intenta nuevamente.".mysqli_error($con);
                            $errors []= "Sucursal duplicada.";
			}
		} else {
			$errors []= "Error desconocido.";
		}
		
		if (isset($errors)){
			
			?>
			<div id="eliminaranunciosucursal" class="alert alert-danger" role="alert">
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
				<div id="eliminaranunciosucursal" class="alert alert-success" role="alert">
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