<?php
	include('is_logged.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado
	/*Inicia validacion del lado del servidor*/
	if (empty($_POST['mod_idmarca_1'])) {
           $errors[] = "ID vacío";
        } else if (
			!empty($_POST['mod_idmarca_1']) 
		){
		/* Connect To Database*/
		require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
		require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
		// escaping, additionally removing everything that could be (html/javascript-) code
	

		
		$mod_idmarca_1=intval($_POST['mod_idmarca_1']);
		$mod_idtlinea_1=intval($_POST['mod_idtlinea_1']);
		
$sqltraertlinea="SELECT * FROM categorias WHERE estado=1 and id_tipoLinea = $mod_idtlinea_1";
$rw1linea=mysqli_query($con,$sqltraertlinea);
//var_dump($contadordefilasa);//cantidaddetipodelineas
$cadenaparatipodelinea = "0";

while ($valor1linea = mysqli_fetch_array($rw1linea)) {
	$id_tag = $valor1linea['id_categoria'];
//echo $id_tag;
	$variableconid = $id_tag;
	if (isset($_POST[$variableconid])) {

			$sqlinsertcatl="INSERT INTO categoria_marca (id_marca, id_categoria, estado) VALUES ( $mod_idmarca_1,$variableconid, 1) ";
		 $query_update = mysqli_query($con,$sqlinsertcatl);
			if ($query_update){}else{}




	$cadenaparatipodelinea.=",".$_POST[$variableconid];
	}else{
	$cadenaparatipodelinea.=",0";
	}
}

        $sql="UPDATE marca SET id_categorias='".$cadenaparatipodelinea."'  WHERE id_marca='".$mod_idmarca_1."'";

		 $query_update = mysqli_query($con,$sql);
			if ($query_update){
				$messages[] = "Las categorias de la Marca han sido actualizados satisfactoriamente.";
			} else{
				$errors []= "Lo siento algo ha salido mal intenta nuevamente.";
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





         
                
		


		