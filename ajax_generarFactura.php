<?php
	include('is_logged.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado
	/* Connect To Database*/
	require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
	require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
	$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
  $inner="";
	$ctct1 = 0;

 
	if (isset($_GET['iddespachoFactura'])){
    $id_despachof=intval($_GET['iddespachoFactura']);
    $sqlConsultDespacho = "SELECT * FROM cabecera_orden where id = $id_despachof";
    $queryConsulDespa = mysqli_query($con, $sqlConsultDespacho);
    while ($rowConsulDespa=mysqli_fetch_array($queryConsulDespa)){
      $nro_pre_orden=$rowConsulDespa['nro_pre_orden'];
      $fecha=$rowConsulDespa['fecha'];
      $id_cliente=$rowConsulDespa['id_cliente'];
      $id_tipodocumento=$rowConsulDespa['id_tipodocumento'];
      $tipo_de_envio=$rowConsulDespa['tipo_de_envio'];
      $direccion_envio=$rowConsulDespa['direccion_envio'];
      $estado_pago=$rowConsulDespa['estado_pago'];
      $estado_envio=$rowConsulDespa['estado_envio'];
    }

    $sumador_Despacho = 0;
    $sqlConsultSumDesp = "SELECT SUM(precio) as sumado FROM detalle_cabecera where id_cabecera_orden = $id_despachof";
    $querySumDesp = mysqli_query($con, $sqlConsultSumDesp);
    while ($rowSumDesp=mysqli_fetch_array($querySumDesp)){
      $sumador_Despacho=$rowSumDesp['sumado'];
    }

echo "<script>console.log('llego');</script>"
  $id_fact_despacho = 0;
    $insert=mysqli_query($con,"INSERT INTO facturas (numero_factura, fecha_factura, fecha_entrega, id_cliente, baja, id_vendedor, condiciones, total_venta, deuda_total, estado_factura, tienda, ven_com, activo, servicio, moneda, nombre, obs, cuenta1, cuenta2, dias, folio) VALUES ('$nro_pre_orden','$fecha','$fecha','$id_cliente','0','".$_SESSION['user_id']."','1','$sumador_Despacho','0.00','1','".$_SESSION['tienda']."','1','1','1','1','1','1','1','0','0','F00".$_SESSION['tienda']."')");
 






    $sqlConsultDetalleDespacho = "SELECT * FROM detalle_cabecera where id_cabecera_orden = $id_despachof";
    echo "<script>console.log($sqlConsultDetalleDespacho);</script>";
    //var_dump($sqlConsultDetalleDespacho);
    die();
    $queryConsulDetalleDespa = mysqli_query($con, $sqlConsultDetalleDespacho);
    while ($rowConsulDetalleDespa=mysqli_fetch_array($queryConsulDetalleDespa)){
      $id_detalledespacho=$rowConsulDetalleDespa['id'];
      var_dump($id_detalledespacho);
      $id_cabecera_orden=$rowConsulDetalleDespa['id_cabecera_orden'];
      $id_vehiculo=$rowConsulDetalleDespa['id_vehiculo'];
      $id_producto_detalle=$rowConsulDetalleDespa['id_producto'];
      $precio_detalle=$rowConsulDetalleDespa['precio'];
      $cantidad_detalle=$rowConsulDetalleDespa['cantidad'];



       $sqlConspro = "SELECT precio_producto,costo_soles FROM products where id_producto = $id_producto_detalle";
    $queryConsuPro = mysqli_query($con, $sqlConspro);
    while ($rowConsulPro=mysqli_fetch_array($queryConsuPro)){
      $costo_soles_deta=$rowConsulPro['costo_soles'];
      $precio_producto_deta=$rowConsulPro['precio_producto'];
    }



  $insert_detail=mysqli_query($con, "INSERT INTO detalle_factura (id_cliente, id_vendedor, numero_factura, ot, id_producto, cantidad, precio_venta,precio_ventadespacho, tienda, activo, ven_com, fecha, precio_compra, tipo_doc, inv_ini, moneda, folio) VALUES ('$id_cliente','".$_SESSION['user_id']."','$nro_pre_orden','0','$id_producto_detalle','$cantidad_detalle','$precio_producto_deta', '$precio_detalle','".$_SESSION['tienda']."','1','1','$fecha','$costo_soles_deta','$id_tipodocumento','0','1','F00".$_SESSION['tienda']."','$id_fact_despacho')");
    }?>

            <div class="alert alert-success alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <strong>Aviso!</strong> Factura Registrada Exitosamente.
            </div>

    <?php }





?>
