<?php
	include('is_logged.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado
	/*Inicia validacion del lado del servidor*/
	if (empty($_POST['nombre'])) {
           $errors[] = "Nombre vacío";
        } else if (!empty($_POST['nombre'])){
		/* Connect To Database*/
		require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
		require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
		// escaping, additionally removing everything that could be (html/javascript-) code
		$nombre=mysqli_real_escape_string($con,(strip_tags($_POST["nombre"],ENT_QUOTES)));
		$doc=mysqli_real_escape_string($con,(strip_tags($_POST["doc"],ENT_QUOTES)));
                $dni=mysqli_real_escape_string($con,(strip_tags($_POST["dni"],ENT_QUOTES)));
                
                $ven=mysqli_real_escape_string($con,(strip_tags($_POST["ven"],ENT_QUOTES)));
                
                
                $telefono=mysqli_real_escape_string($con,(strip_tags($_POST["telefono"],ENT_QUOTES)));
		$email=mysqli_real_escape_string($con,(strip_tags($_POST["email"],ENT_QUOTES)));
		$direccion=mysqli_real_escape_string($con,(strip_tags($_POST["direccion"],ENT_QUOTES)));
		
                $departamento=mysqli_real_escape_string($con,(strip_tags($_POST["departamento"],ENT_QUOTES)));
                $provincia=mysqli_real_escape_string($con,(strip_tags($_POST["provincia"],ENT_QUOTES)));
                $distrito=mysqli_real_escape_string($con,(strip_tags($_POST["distrito"],ENT_QUOTES)));
                $cuenta=mysqli_real_escape_string($con,(strip_tags($_POST["cuenta"],ENT_QUOTES)));
                
              
                $tienda1=$_SESSION['tienda'];
                
                $estado=intval($_POST['estado']);


				$prct_cliente_desc=mysqli_real_escape_string($con,(strip_tags($_POST["prct_cliente_desc"],ENT_QUOTES)));
				
				if($prct_cliente_desc != ''){
					$prct_cliente_desc=mysqli_real_escape_string($con,(strip_tags($_POST["prct_cliente_desc"],ENT_QUOTES)));
				} else {
					$prct_cliente_desc='0';
				}
			


                $ver_codigo_cliente=intval($_POST['ver_codigo_cliente']);
                $sucursal_cliente=intval($_POST['sucursal_cliente']);
                

                date_default_timezone_set('America/Lima');
		$date_added=date("Y-m-d H:i:s");
		$sql="INSERT INTO clientes (nombre_cliente, 
									telefono_cliente, 
									email_cliente, 
									direccion_cliente, 
									status_cliente, 
									date_added,
									doc,
									dni,
									vendedor,
									pais,
									departamento,
									provincia,
									distrito,
									cuenta,
									tipo1,
									tienda,
									users,
									deuda,
									debe,
									prct_desc,
									sucursal,
									ver_codigo) VALUES ('$nombre','$telefono','$email','$direccion','$estado','$date_added','$doc','$dni','$ven','Peru','$departamento','$provincia','$distrito','$cuenta','1','$tienda1','0','0','0','$prct_cliente_desc','$sucursal_cliente','$ver_codigo_cliente')";
		$query_new_insert = mysqli_query($con,$sql);
			if ($query_new_insert){
				$messages[] = "Cliente ha sido ingresado satisfactoriamente.";
			} else{
				$errors []= "Cliente duplicado. $sql";
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