<?php
	include('is_logged.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado
	/*Inicia validacion del lado del servidor*/

	if (empty($_POST['mod_idcompac'])) {
           $errors[] = "ID vacío";
        }else if (empty($_POST['mod_idvec'])) {
           $errors[] = "Nombre vacío";
        
		}  else if (
			!empty($_POST['mod_idmarca']) &&
			$_POST['mod_idmodel']!="" 
		){
		/* Connect To Database*/
		require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
		require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
		// escaping, additionally removing everything that could be (html/javascript-) code


		$idmodvehic=mysqli_real_escape_string($con,(strip_tags($_POST["mod_idvec"],ENT_QUOTES)));
		$idmodmarca=mysqli_real_escape_string($con,(strip_tags($_POST["mod_idmarca"],ENT_QUOTES)));
		$idmodmodel=mysqli_real_escape_string($con,(strip_tags($_POST["mod_idmodel"],ENT_QUOTES)));
		$idmodidprodc=mysqli_real_escape_string($con,(strip_tags($_POST["mod_idproduc"],ENT_QUOTES)));
		$idmodmotor=mysqli_real_escape_string($con,(strip_tags($_POST["mod_idmotor"],ENT_QUOTES)));

		$aidmodcompat=intval($_POST['mod_idcompac']);
        $consulta="SELECT * FROM compatible WHERE id_compatible='$aidmodcompat' and estado=1";
        $resultado=mysqli_query($con,$consulta);

        if(mysqli_num_rows($resultado)<=0)
        {
            // Si es mayor a cero imprimimos que ya existe el usuario
            $errors []= "Codigo o nombre de compatible no existe.";
        }else{

            $sql="UPDATE compatible SET  id_producto='".$idmodidprodc."', id_vehiculo='".$idmodvehic."', id_marcaVehiculo='".$idmodmarca."', id_modeloVehiculo='".$idmodmodel."',motor = '".$idmodmotor."'   WHERE id_compatible='".$aidmodcompat."'";

            $query_update = mysqli_query($con,$sql);
            if ($query_update){
                $messages[] = "Producto ha sido actualizado satisfactoriamente.";
            } else{
                $errors []= "Lo siento algo ha salido mal intenta nuevamente.Codigo Duplicado";
            }
        }

		} else {
			$errors []= "Error desconocido1.";
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





         
                
		


		