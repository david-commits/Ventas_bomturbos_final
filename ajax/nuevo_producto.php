<?php
include('is_logged.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado
	/*Inicia validacion del lado del servidor*/
	 if (empty($_POST['nombre'])){
			$errors[] = "Nombre del producto vacío";
		} else if ($_POST['estado']==""){
			$errors[] = "Selecciona el estado del producto";
		} else if (empty($_POST['precio'])){
			$errors[] = "Precio de venta vacío";
		} else if (empty($_POST['costo'])){
			$errors[] = "Precio de costo vacío";
		} else if (empty($_POST['inventario'])){
			$errors[] = "Inventario vacío";
		} 
           else if (
			!empty($_POST['nombre']) &&
                        !empty($_POST['costo']) &&
                        !empty($_POST['inventario']) &&
                        
			$_POST['estado']!="" &&
                        $_POST['cat_pro']!="" &&
			!empty($_POST['precio'])
		){
		/* Connect To Database*/
		require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
		require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
		// escaping, additionally removing everything that could be (html/javascript-) code
		//$codigo=mysqli_real_escape_string($con,(strip_tags($_POST["codigo"],ENT_QUOTES)));
		
date_default_timezone_set('America/Lima');
$fecha  = date("Y-m-d H:i:s");
$estado=intval($_POST['estado']);
$nombre=mysqli_real_escape_string($con,(strip_tags($_POST["nombre"],ENT_QUOTES)));
$cat_pro=floatval($_POST['cat_pro']);
$pre_pro=floatval($_POST['precio']);
$mon_venta=1;
$cos_pro=floatval($_POST['costo']);
$multiplicando=floatval($_POST['multiplicando']);
//$cos_pro1=$cos_pro*$multiplicando;
$mon_costo=$multiplicando;
$marca=mysqli_real_escape_string($con,(strip_tags($_POST["marca"],ENT_QUOTES)));
//$modelo=mysqli_real_escape_string($con,(strip_tags($_POST["modelo"],ENT_QUOTES)));
$codigoOriginal=mysqli_real_escape_string($con,(strip_tags($_POST["codigoProducto"],ENT_QUOTES)));
$codigoProveedor=mysqli_real_escape_string($con,(strip_tags($_POST["codigoProveedor"],ENT_QUOTES)));
$codigoAlternativo=mysqli_real_escape_string($con,(strip_tags($_POST["codigoAlternativo"],ENT_QUOTES)));
$medida=mysqli_real_escape_string($con,(strip_tags($_POST["medida"],ENT_QUOTES)));
$detalle="";//mysqli_real_escape_string($con,(strip_tags($_POST["detalle"],ENT_QUOTES)));
$inventario=floatval($_POST['inventario']);
$tienda=$_SESSION['tienda'];

                $prod = array();
    for($i=1 ;$i<=6;$i++){
        if($i==$tienda){
          $prod[$i]=$inventario;
            
        }else{
           $prod[$i]=0; 
        }
        
    }
                
		$namefinal="";
		$sql="INSERT INTO products (   
		        `codigo_producto`,
                `nombre_producto`,
                `date_added`,
                `precio_producto`,
                `costo_producto`,
                `mon_costo`,
                `mon_venta`,
                `id_marca`,
                `codigoProveedor`,
                `codigoAlternativo`,
                `medida`,
                `cat_pro`,
                `pro_ser`,
                `id_tipo`,
                `codigoOriginal`,
                `b1`,
                `b2`,
                `b3`,
                `b4`,
                `b5`,
                `b6`,
                `foto1`,
                `foto2`,
                `foto3`,
                `foto4`,
                `web`,
                `pre_web`,
                `descripcion`,
                `megusta`,
                `nomegusta`,
                `id_modelo`,
                `detalle`) values (
                        '$codigoOriginal',
                        '$nombre',
                        '$fecha',
                        '$pre_pro',
                        '$cos_pro',
                        '$mon_costo',
                        '$mon_venta',
                        '$marca',
                        '$codigoProveedor',
                        '$codigoAlternativo',
                        '$medida',
                        '$cat_pro',
                        '1',
                        '1',
                        '$codigoOriginal',
                        '$prod[1]',
                        '$prod[2]',
                        '$prod[3]',
                        '$prod[4]',
                        '$prod[5]',
                        '$prod[6]',
                        '$namefinal',
                        'nuevo.jpg',
                        'nuevo.jpg',
                        'nuevo.jpg',
                        '0',
                        '1',
                        'descripcion',
                        '1',
                        '0',
                        '13',
                        '$detalle')";

		$query_new_insert = mysqli_query($con,$sql); 
			if ($query_new_insert){
				$messages[] = "Producto ha sido ingresado satisfactoriamente.";
			} else{
				$errors []= "Lo siento algo ha salido mal intenta nuevamente.".mysqli_error($con);
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