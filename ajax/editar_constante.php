<?php
	include('is_logged.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado
	/*Inicia validacion del lado del servidor*/

	if (empty($_POST['mod_idConstante'])) {
           $errors[] = "ID vacío";
        }else if (empty($_POST['mod_Montopc'])) {
           $errors[] = "Nombre vacío";
        
		}  else if (
			!empty($_POST['mod_idConstante']) &&
			$_POST['mod_dolar']!="" 
		){
		/* Connect To Database*/
		require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
		require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
		// escaping, additionally removing everything that could be (html/javascript-) code
		$codigo=mysqli_real_escape_string($con,(strip_tags($_POST["mod_idConstante"],ENT_QUOTES)));
		$monto=mysqli_real_escape_string($con,(strip_tags($_POST["mod_Montopc"],ENT_QUOTES)));
		$dolar=mysqli_real_escape_string($con,(strip_tags($_POST["mod_dolar"],ENT_QUOTES)));
		$detalle=mysqli_real_escape_string($con,(strip_tags($_POST["mod_descripcion"],ENT_QUOTES)));

		$id_constante=intval($_POST['mod_idConstante']);


        $consulta="SELECT * FROM constante WHERE id_constante='$codigo' and estado=1";
        $resultado=mysqli_query($con,$consulta);

        if(mysqli_num_rows($resultado)<=0)
        {
            // Si es mayor a cero imprimimos que ya existe el usuario
            $errors []= "Codigo o nombre de constante no existe.";
        }else{

        	$querytraemoscnst=mysqli_query($con, "select * from constante where estado=1 AND id_constante='".$codigo."'");

	        while ($rowtraercsnt=mysqli_fetch_array($querytraemoscnst)){
	            $idcsnt = $rowtraercsnt['id_constante'];
	            $montocsnt = $rowtraercsnt['monto'];
	            $detallecsnt = $rowtraercsnt['detalle'];
	            $dolarcsn = $rowtraercsnt['dolar'];
	        }
        	$insertcsnt=mysqli_query($con,"INSERT INTO constante_detalle VALUES ('','$idcsnt','$montocsnt','$detallecsnt','$dolarcsn','')");



            $sql="UPDATE constante SET  monto='".$monto."', dolar='".$dolar."', detalle='".$detalle."' WHERE id_constante='".$id_constante."'";

            $query_update = mysqli_query($con,$sql);
            if ($query_update){
                $messages[] = "Producto ha sido actualizado satisfactoriamente.";
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





         
                
		


		