<?php
	include('is_logged.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado
	/*Inicia validacion del lado del servidor*/
	if (empty($_POST['nombre'])) {
           $errors[] = "Pago vacío";
        } else if (!empty($_POST['pago'])){
		/* Connect To Database*/
		require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
		require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
		$nombre=mysqli_real_escape_string($con,(strip_tags($_POST["nombre"],ENT_QUOTES)));
                $ven_com=mysqli_real_escape_string($con,(strip_tags($_POST["ven_com"],ENT_QUOTES)));
                $cliente=mysqli_real_escape_string($con,(strip_tags($_POST["cliente"],ENT_QUOTES)));
		$rr=2;
                $vendedor=mysqli_real_escape_string($con,(strip_tags($_POST["vendedor"],ENT_QUOTES)));
                $condiciones=mysqli_real_escape_string($con,(strip_tags($_POST["condiciones"],ENT_QUOTES)));
                $pago=mysqli_real_escape_string($con,(strip_tags($_POST["pago"],ENT_QUOTES)));
                $estado_factura=mysqli_real_escape_string($con,(strip_tags($_POST["estado_factura"],ENT_QUOTES)));
                $numero_factura=mysqli_real_escape_string($con,(strip_tags($_POST["numero_factura"],ENT_QUOTES)));
                $obs=mysqli_real_escape_string($con,(strip_tags($_POST["obs"],ENT_QUOTES)));
                $moneda=1;
                $tienda=$_SESSION['tienda'];
                date_default_timezone_set('America/Lima');
		$date_added=date("Y-m-d H:i:s");
//aca se pasa ven_com (revisar que valor esta recibiendo puede ser - venta o compra)

		$sql="INSERT INTO facturas (numero_factura,fecha_factura,ot,id_cliente,baja,id_vendedor,condiciones,total_venta,deuda_total,estado_factura,tienda,ven_com,activo,servicio,moneda,nombre,obs,cuenta1,cuenta2,dias,folio) VALUES ('$numero_factura','$date_added','0','$cliente','0','$vendedor','$condiciones','$pago','0','$estado_factura','$tienda','$ven_com','1','$rr','1','$nombre','$obs','0','0','0','0')";
		$query_new_insert = mysqli_query($con,$sql);
			if ($query_new_insert){
				$messages[] = "Pago ha sido ingresado satisfactoriamente.";
			} else{
				$errors []= "Pago duplicado. $sql";
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