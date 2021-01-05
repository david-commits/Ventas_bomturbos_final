<?php

	include('is_logged.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado
	/*Inicia validacion del lado del servidor*/



	if (empty($_POST['mod_id'])) {
        $errors[] = "ID vacío";
				
    }

    else if (empty($_POST['mod_codigo_mod'])) {
        $errors[] = "Código vacío";
			
    } 
 
    else if ($_POST['mod_tipo']==""){
		$errors[] = "Selecciona el tipo de producto";
				
	}
        /*else if ($_POST['mod_moncosto']==""){
			$errors[] = "Selecciona la moneda del costo";
		}*/
    else if ($_POST['mod_categoria']==""){
		$errors[] = "Selecciona la categoria";
			
	}              
    else if (empty($_POST['mod_nombre'])){
		$errors[] = "Nombre del producto vacío";
				
	}  else if (empty($_POST['mod_precio'])){
		$errors[] = "Precio de venta vacío";
			
	} else if (empty($_POST['mod_costo'])){
		$errors[] = "Precio de costo vacío";
			
	}
    else if ($_POST['mod_inv']<0){
				
				
		$errors[] = "Inventario no valido";
	}
    else if (
			!empty($_POST['mod_id']) &&
			!empty($_POST['mod_codigo_mod']) &&
			!empty($_POST['mod_nombre']) &&
			//$_POST['mod_moncosto']!="" &&
            $_POST['mod_tipo']!="" &&
            $_POST['mod_categoria']!="" &&
			!empty($_POST['mod_precio'])&&
			!empty($_POST['mod_costo'])
		){
			

		/* Connect To Database*/
		require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
		require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
		// escaping, additionally removing everything that could be (html/javascript-) code
		
                $codigo=mysqli_real_escape_string($con,(strip_tags($_POST["mod_codigo_mod"],ENT_QUOTES)));
				$nombre=mysqli_real_escape_string($con,(strip_tags($_POST["mod_nombre"],ENT_QUOTES)));
				$proveedor=mysqli_real_escape_string($con,(strip_tags($_POST["mod_proveedor"],ENT_QUOTES)));
				$alternativo=mysqli_real_escape_string($con,(strip_tags($_POST["mod_alternativo"],ENT_QUOTES)));
				$codigoproducto=mysqli_real_escape_string($con,(strip_tags($_POST["mod_codigo_mod"],ENT_QUOTES)));
				$codigooriginal=mysqli_real_escape_string($con,(strip_tags($_POST["mod_codigooriginal_mod"],ENT_QUOTES)));
				$cat_pro=intval($_POST['mod_categoria']);





				$tipo=intval($_POST['mod_tipo']);
				$valorprcttnn=intval($_POST['valorprctt']);
				$costo=floatval($_POST['mod_costo']);
				$mult = floatval($_POST['multiplicando_multiplicando']);
				$mon_costo=1;		
				$precio_venta=floatval($_POST['mod_precio']);
$costo_soles_n = 0 ;
$ganancia_s_n = 0 ;
$costo_soles_n = $costo * $mult;
$ganancia_s_n = $precio_venta - $costo_soles_n;
		        $marca=mysqli_real_escape_string($con,(strip_tags($_POST["mod_marca"],ENT_QUOTES)));
		        $valor_gananancia_porcsoles=mysqli_real_escape_string($con,(strip_tags($_POST["ganancia"],ENT_QUOTES)));
				
		        $medida=mysqli_real_escape_string($con,(strip_tags($_POST["mod_medida"],ENT_QUOTES)));
		        $detalle=mysqli_real_escape_string($con,(strip_tags($_POST["mod_detalle"],ENT_QUOTES)));
		        $inv=intval($_POST['mod_inv']);
                $tienda=$_SESSION['tienda'];
                $b="b".$tienda;
		$id_producto=$_POST['mod_id'];

		/////////////////////////////////////
		$sql="UPDATE products SET codigoAlternativo='".$alternativo."',codigo_producto='".$codigoproducto."',codigoOriginal='".$codigooriginal."',codigoProveedor='".$proveedor."',nombre_producto='".$nombre."', precio_producto='".$costo."', costo_producto='".$costo."' , id_marca=".$marca.",$b='".$inv."',mon_costo='".$mon_costo."',medida='".$medida."',detalle='".$detalle."',cat_pro=".$cat_pro.",id_tipo=".$tipo.",costo_soles=".$costo_soles_n.",tipo_ganancia=".$valorprcttnn." ,tcp_compra=".$mult.", ganancia=".$ganancia_s_n.", costo_venta_soles=".$precio_venta.", ganancia_monto_porcsoles=".$valor_gananancia_porcsoles." WHERE id_producto ='".$id_producto."'";

		$sqlcambiotc = "INSERT INTO producto_detalle (id_producto, monto_preciocambiado, cambiado_mon_costo)values(".$id_producto.",".$precio_venta.", ".$mult.")";
		///////////////////////
		$query_update = mysqli_query($con,$sql);
		$query_update_modificandoprecio = mysqli_query($con,$sqlcambiotc);
			if ($query_update){
				$messages[] = "Producto ha sido actualizado satisfactoriamente.";
			} else{
				$errors []= "Lo siento algo ha salido mal intenta nuevamente.Codigo Duplicado";
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