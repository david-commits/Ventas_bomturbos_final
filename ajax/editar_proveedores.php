<?php
	include('is_logged.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado
	/*Inicia validacion del lado del servidor*/
	if (empty($_POST['mod_id'])) {
           $errors[] = "ID vacío";
        }else if (empty($_POST['mod_nombre'])) {
           $errors[] = "Nombre vacío";
        }  else if ($_POST['mod_estado']==""){
			$errors[] = "Selecciona el estado del proveedor";
		}  else if (
			!empty($_POST['mod_id']) &&
			!empty($_POST['mod_nombre']) &&
			$_POST['mod_estado']!="" 
		){
		/* Connect To Database*/
		require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
		require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
		// escaping, additionally removing everything that could be (html/javascript-) code
		$nombre=mysqli_real_escape_string($con,(strip_tags($_POST["mod_nombre"],ENT_QUOTES)));
		$codprove=mysqli_real_escape_string($con,(strip_tags($_POST["mod_codprove"],ENT_QUOTES)));
		$telefono=mysqli_real_escape_string($con,(strip_tags($_POST["mod_telefono"],ENT_QUOTES)));
		$email=mysqli_real_escape_string($con,(strip_tags($_POST["mod_email"],ENT_QUOTES)));
		$direccion=mysqli_real_escape_string($con,(strip_tags($_POST["mod_direccion"],ENT_QUOTES)));
                $doc=mysqli_real_escape_string($con,(strip_tags($_POST["mod_doc"],ENT_QUOTES)));
                //$dni=mysqli_real_escape_string($con,(strip_tags($_POST["mod_dni"],ENT_QUOTES)));
                
                $ven=mysqli_real_escape_string($con,(strip_tags($_POST["mod_ven"],ENT_QUOTES)));
		
                
                $departamento=mysqli_real_escape_string($con,(strip_tags($_POST["mod_departamento"],ENT_QUOTES)));
                $provincia=mysqli_real_escape_string($con,(strip_tags($_POST["mod_provincia"],ENT_QUOTES)));
                $distrito=mysqli_real_escape_string($con,(strip_tags($_POST["mod_distrito"],ENT_QUOTES)));
                $cuenta=mysqli_real_escape_string($con,(strip_tags($_POST["mod_cuenta"],ENT_QUOTES)));
                
                
                
                $estado=intval($_POST['mod_estado']);
		
		$id_cliente=intval($_POST['mod_id']);
	
		$sql="UPDATE proveedores SET nom_pro='".$nombre."', tel_pro='".$telefono."', email_provedor='".$email."', dir_pro='".$direccion."', status_proveedor='".$estado."', vendedor='".$ven."', ruc_pro='".$doc."', departamento='".$departamento."', provincia='".$provincia."', distrito='".$distrito."', cuenta='".$cuenta."' , codigoProveedor='".$codprove."' WHERE id_proveedores='".$id_cliente."'";
		$query_update = mysqli_query($con,$sql);
			if ($query_update){
				$messages[] = "Proveedor ha sido actualizado satisfactoriamente.";
			} else{
				$errors []= "Proveedor duplicado.";
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