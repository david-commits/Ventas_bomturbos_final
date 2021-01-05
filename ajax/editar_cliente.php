<?php
	include('is_logged.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado
	/*Inicia validacion del lado del servidor*/
	

	if (empty($_POST['mod_id'])) {
           $errors[] = "ID vacío";
        }else if (empty($_POST['mod_nombre'])) {
           $errors[] = "Nombre vacío";
        }  else if ($_POST['mod_estado']==""){
			$errors[] = "Selecciona el estado del cliente";
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
		$telefono=mysqli_real_escape_string($con,(strip_tags($_POST["mod_telefono"],ENT_QUOTES)));
		$email=mysqli_real_escape_string($con,(strip_tags($_POST["mod_email"],ENT_QUOTES)));
		$direccion=mysqli_real_escape_string($con,(strip_tags($_POST["mod_direccion"],ENT_QUOTES)));
                $doc=mysqli_real_escape_string($con,(strip_tags($_POST["mod_doc"],ENT_QUOTES)));
                $dni=mysqli_real_escape_string($con,(strip_tags($_POST["mod_dni"],ENT_QUOTES)));
                
                $ven=mysqli_real_escape_string($con,(strip_tags($_POST["mod_ven"],ENT_QUOTES)));
        $date_added=date("Y-m-d H:i:s");
		
                
                $departamento=mysqli_real_escape_string($con,(strip_tags($_POST["mod_departamento"],ENT_QUOTES)));
                $provincia=mysqli_real_escape_string($con,(strip_tags($_POST["mod_provincia"],ENT_QUOTES)));
                $distrito=mysqli_real_escape_string($con,(strip_tags($_POST["mod_distrito"],ENT_QUOTES)));
                $cuenta=mysqli_real_escape_string($con,(strip_tags($_POST["mod_cuenta"],ENT_QUOTES)));


                $mod_usuario_cliente=mysqli_real_escape_string($con,(strip_tags($_POST["mod_usuario_cliente"],ENT_QUOTES)));
                $mod_clave_cliente=mysqli_real_escape_string($con,(strip_tags($_POST["mod_clave_cliente"],ENT_QUOTES)));
              
              
                $mod_prct_cliente_desc=mysqli_real_escape_string($con,(strip_tags($_POST["mod_prct_cliente_desc"],ENT_QUOTES)));
                $mod_ver_codigo_cliente=intval($_POST['mod_ver_codigo_cliente']);
                $mod_sucursal_cliente=intval($_POST['mod_sucursal_cliente']);


                
                $estado=intval($_POST['mod_estado']);
                $sucursal_mod=intval($_POST['sucursal_mod']);
                $sucursalnuevo=$_SESSION['tienda'];
        		//var_dump($_SESSION['tienda']);
        		//exit();
		
				$id_cliente=intval($_POST['mod_id']);
				$sql="UPDATE clientes SET nombre_cliente='".$nombre."', telefono_cliente='".$telefono."', email_cliente='".$email."', direccion_cliente='".$direccion."', status_cliente='".$estado."', vendedor='".$ven."', doc='".$doc."', dni='".$dni."', departamento='".$departamento."', provincia='".$provincia."', distrito='".$distrito."', cuenta='".$cuenta."', prct_desc='".$mod_prct_cliente_desc."', sucursal='".$mod_sucursal_cliente."', ver_codigo='".$mod_ver_codigo_cliente."' WHERE id_cliente='".$id_cliente."'";
			$query_update = mysqli_query($con,$sql);
			if ($query_update){
				$sqlsqlsql = "select * from users where estado=1 AND id_cliente='".$id_cliente."'";
				//var_dump($sqlsqlsql);
				$query=mysqli_query($con, "select * from users where estado=1 AND id_cliente='".$id_cliente."'");
        		$count=mysqli_num_rows($query);     
        		if ($count==0){
				

        			 $sqlinsercliente = "INSERT INTO users (nombres, clave, user_name,hora, user_email, date_added,accesos,dni,domicilio,telefono,sucursal,foto,estado, id_cliente)
                            VALUES('".$nombre."','".$mod_clave_cliente."','" . $mod_usuario_cliente . "', NOW(), '" . $email . "', '" .$date_added."', '0.0.0.0.0.0.0.0.0.0.0.0.0.0.0.0.0.0.0.0.0.0.0.0.0.0.0.0.0.0.0.0.0.0.0.0.0.0.0.0.0.0.0.1.0.0.0.0.0','".$dni."','".$direccion."','".$telefono."','".$sucursalnuevo."','usuario16.jpg' ,'1','".$id_cliente."');";
			

                            $query_new_user_insert = mysqli_query($con,$sqlinsercliente);

                    if ($query_new_user_insert) {
                        $messages[] = "Cliente actualizado y usuario registrado con éxito.";
                    } else {
                        $messages[] = "Lo sentimos , Solo se Actualizó el cliente.";
                    }
        		}else{
        			$sqlacusuario="UPDATE users SET nombres='".$nombre."', clave='".$mod_clave_cliente."', user_name='".$mod_usuario_cliente."', user_email='".$email."', dni='".$dni."', domicilio='".$direccion."', telefono='".$telefono."',  estado='1' WHERE id_cliente='".$id_cliente."'";
					$query_update_usuario = mysqli_query($con,$sqlacusuario);
					if ($query_update_usuario){
						$messages[] = "Cliente con su usuasrio ha sido actualizado satisfactoriamente.";
					}else{
						$messages[] = "Cliente ha sido actualizado satisfactoriamente.";
					}
        		}




			} else{
	//echo "<script>console.log('entramos a registrar todo, se modifico cliente11');</script>";

				$errors []= "Cliente duplicado.";
			}
		} else {
	//echo "<script>console.log('entramos a registrar todo, se modifico cliente22');</script>";

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