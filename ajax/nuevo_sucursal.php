<?php
include('is_logged.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado
	/*Inicia validacion del lado del servidor*/
	if (empty($_POST['nombre'])) {
           $errors[] = "Sucursal vacía";
        } else if (empty($_POST['nombre'])){
			$errors[] = "Nombre de la sucursal vacía";
		} 
               
                else if (
			!empty($_POST['nombre']) 
              
		){
		/* Connect To Database*/
		require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
		require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
		// escaping, additionally removing everything that could be (html/javascript-) code
		$nombre=mysqli_real_escape_string($con,(strip_tags($_POST["nombre"],ENT_QUOTES)));
		$ruc=mysqli_real_escape_string($con,(strip_tags($_POST["ruc"],ENT_QUOTES)));
		$direccion=mysqli_real_escape_string($con,(strip_tags($_POST["direccion"],ENT_QUOTES)));
                $correo=mysqli_real_escape_string($con,(strip_tags($_POST["correo"],ENT_QUOTES)));
                $telefono=mysqli_real_escape_string($con,(strip_tags($_POST["telefono"],ENT_QUOTES)));
                
                $tienda=mysqli_query($con,"select * from sucursal ORDER BY  `sucursal`.`tienda` DESC ");
                $row1=mysqli_fetch_array($tienda);
                $tienda1=$row1["tienda"]+1;
                
        $queryvalidador=mysqli_query($con, "select * from sucursal ");
        $count=mysqli_num_rows($queryvalidador);     
        if ($count >= 6){
				$errors []= "No se puede registrar ninguna sucursal por llegar al límite.";

                }else{

                
                
                  $sql="INSERT INTO sucursal (tienda,nombre,ruc,direccion,correo,telefono,foto) VALUES ('$tienda1','$nombre','$ruc','$direccion','$correo','$telefono','logo.jpg')";
		  
                
                
		//$sql="INSERT INTO sucursal (tienda,nombre,ruc,direccion,correo,telefono) VALUES ('$tienda1','$nombre','$ruc','$direccion','$correo','$telefono')";
		
                
                $query_new_insert = mysqli_query($con,$sql);
			if ($query_new_insert){
				$messages[] = "Sucursal ha sido ingresado satisfactoriamente.";
			} else{
				$errors []= "Sucursal duplicada.";
			}}
		} else {
			$errors []= "Error desconocido.";
		}
		
		if (isset($errors)){
			
			?>
			<div id="alertaborrarsucursal" class="alert alert-danger" role="alert">
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
				<div id="alertaborrarsucursal" class="alert alert-success" role="alert">
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