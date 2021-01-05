<?php
	include('is_logged.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado
	/*Inicia validacion del lado del servidor*/

require __DIR__ . '/autoload.php';

use src\Nike42\Escpos\Printer;
use src\Nike42\Escpos\EscposImage;
use src\Nike42\Escpos\PrintConnectors\WindowsPrintConnector;
use src\Nike42\Escpos\PrintConnectors\FilePrintConnector;



		/* Connect To Database*/
		require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
		require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
		// escaping, additionally removing everything that could be (html/javascript-) code
                $codigo=mysqli_real_escape_string($con,(strip_tags($_POST["mod_codigobarra"],ENT_QUOTES)));
				$nombre=mysqli_real_escape_string($con,(strip_tags($_POST["mod_nombrebarra"],ENT_QUOTES)));
				$proveedor=mysqli_real_escape_string($con,(strip_tags($_POST["mod_proveedorbarra"],ENT_QUOTES)));
				$alternativo=mysqli_real_escape_string($con,(strip_tags($_POST["mod_alternativobarra"],ENT_QUOTES)));
				
				$costo=floatval($_POST['mod_costobarra']);
                
				$precio_venta=floatval($_POST['mod_preciobarra']);
		        $medida=mysqli_real_escape_string($con,(strip_tags($_POST["mod_medidabarra"],ENT_QUOTES)));
		        $detalle=mysqli_real_escape_string($con,(strip_tags($_POST["mod_detallebarra"],ENT_QUOTES)));



		        $inv=intval($_POST['mod_cant_ultimacomprabarra']);
				
               
                $tienda=$_SESSION['tienda'];
                $b="b".$tienda;
		$id_producto=$_POST['mod_idbarra'];

    $nombre_impresora = "4BARCODE 4B-2054TC";
    $connector = new WindowsPrintConnector($nombre_impresora);
    $printer = new Printer($connector);
    $printer->text("Ticket con PHP");
	$printer->setTextSize(2, 1);
	$printer->feed();
   	$printer->text("Hola mundo\n\nParzibyte.me\n\nNo olvides suscribirte");
$printer->feed(15);

$printer->cut();

$printer->pulse();

$printer->close();






?>