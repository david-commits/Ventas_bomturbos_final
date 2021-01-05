<?php
	include('is_logged.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado
	/*Inicia validacion del lado del servidor*/
	if (empty($_POST['nombre'])) {
           $errors[] = "Nombre de la modelo vacío";
        } else if (!empty($_POST['nombre'])){
		/* Connect To Database*/
		require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
		require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
		// escaping, additionally removing everything that could be (html/javascript-) code

   $nombre=mysqli_real_escape_string($con,(strip_tags($_POST["nombre"],ENT_QUOTES)));
   $cat_pro=mysqli_real_escape_string($con,(strip_tags($_POST["cat_pro"],ENT_QUOTES)));
   $tipo=mysqli_real_escape_string($con,(strip_tags($_POST["tipo"],ENT_QUOTES)));

   $marca=mysqli_real_escape_string($con,(strip_tags($_POST["marca"],ENT_QUOTES)));
   $modelo=mysqli_real_escape_string($con,(strip_tags($_POST["modelo"],ENT_QUOTES)));

   $codigoProducto=mysqli_real_escape_string($con,(strip_tags($_POST["codigoProducto"],ENT_QUOTES)));
   $codigoProveedor=mysqli_real_escape_string($con,(strip_tags($_POST["codigoProveedor"],ENT_QUOTES)));
   $codigoAlternativo=mysqli_real_escape_string($con,(strip_tags($_POST["codigoAlternativo"],ENT_QUOTES)));

   $medida=mysqli_real_escape_string($con,(strip_tags($_POST["medida"],ENT_QUOTES)));

   $detalle=mysqli_real_escape_string($con,(strip_tags($_POST["detalle"],ENT_QUOTES)));
   $costo=mysqli_real_escape_string($con,(strip_tags($_POST["costo"],ENT_QUOTES)));
   $tipoMoneda=mysqli_real_escape_string($con,(strip_tags($_POST["tipoMoneda"],ENT_QUOTES)));

   $multiplicando=mysqli_real_escape_string($con,(strip_tags($_POST["multiplicando"],ENT_QUOTES)));
   $uti=mysqli_real_escape_string($con,(strip_tags($_POST["uti"],ENT_QUOTES)));

   $precio=mysqli_real_escape_string($con,(strip_tags($_POST["precio"],ENT_QUOTES)));
   $inventario=mysqli_real_escape_string($con,(strip_tags($_POST["inventario"],ENT_QUOTES)));
   $files=mysqli_real_escape_string($con,(strip_tags($_POST["files"],ENT_QUOTES)));
var_dump($_POST); die;

$sql="INSERT INTO products (codigo_producto,  id_tipo, nombre_producto, date_added,  precio_producto,  costo_producto,  mon_costo,  mon_venta, id_marca,  id_modelo,codigoProveedor,codigoAlternativo,medida,detalle,b1,b2,b3,b4,b5,b6,cat_pro,pro_ser,foto1,foto2,foto3,foto4,web,pre_web,descripcion,megusta,nomegusta) VALUES ($codigoProducto,$tipo,$nombre,$date_added,$precio,$costo,'12','20',$marca, $modelo,$codigoProveedor,$codigoAlternativo,$medida,$detalle,'1','2','3','4','5','6',$cat_pro,'1','foto1','foto2','foto3','foto4','1','1','descripcion','1','1' )";


		$query_new_insert = mysqli_query($con,$sql) or die(mysqli_error($con));
			if ($query_new_insert){
				$messages[] = "Modelo ha sido ingresado satisfactoriamente.";
			} else{
				$errors []= "Modelo duplicado.";
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

