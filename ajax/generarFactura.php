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


    $sqlidcliente = "select cl.id_cliente from clientes cl inner join users usr on usr.id_cliente = cl.id_cliente where usr.user_id = $id_cliente";
    $queryidCliente = mysqli_query($con, $sqlidcliente);
    while ($rowIdCliente=mysqli_fetch_array($queryidCliente)){
      $id_cliente=$rowIdCliente['id_cliente'];
    }



    $sumador_Despacho = 0;
    $sqlConsultSumDesp = "SELECT SUM(precio) as sumado FROM detalle_cabecera where id_cabecera_orden = $id_despachof";
    $querySumDesp = mysqli_query($con, $sqlConsultSumDesp);
    while ($rowSumDesp=mysqli_fetch_array($querySumDesp)){
      $sumador_Despacho=$rowSumDesp['sumado'];
    }


  $id_fact_despacho = 0;
    $insert=mysqli_query($con,"INSERT INTO facturas (numero_factura, fecha_factura, fecha_entrega, id_cliente, baja, id_vendedor, condiciones, total_venta, deuda_total, estado_factura, tienda, ven_com, activo, servicio, moneda, nombre, obs, cuenta1, cuenta2, dias, folio) VALUES ('$nro_pre_orden','$fecha','$fecha','$id_cliente','0','".$_SESSION['user_id']."','1','$sumador_Despacho','0.00','1','".$_SESSION['tienda']."','1','1','1','1','','','0','0','0','F00".$_SESSION['tienda']."')");
    $id_fact_despacho = $con->insert_id;


    $sqlConsultDetalleDespacho = "SELECT * FROM detalle_cabecera where id_cabecera_orden = $id_despachof";

    $queryConsulDetalleDespa = mysqli_query($con, $sqlConsultDetalleDespacho);
    while ($rowConsulDetalleDespa=mysqli_fetch_array($queryConsulDetalleDespa)){
      $id_detalledespacho=$rowConsulDetalleDespa['id'];
      $id_cabecera_orden=$rowConsulDetalleDespa['id_cabecera_orden'];
      $id_vehiculo=$rowConsulDetalleDespa['id_vehiculo'];
      $id_producto_detalle=$rowConsulDetalleDespa['id_producto'];
      $precio_detalle=$rowConsulDetalleDespa['precio'];
      $cantidad_detalle=$rowConsulDetalleDespa['cantidad'];

$c1 = 0;
$c2 = 0;
$c3 = 0;
$c4 = 0;
$c5 = 0;
$c6 = 0;

$ctienda = 0;


       $sqlConspro = "SELECT precio_producto,costo_soles,b1,b2,b3,b4,b5,b6 FROM products where id_producto = $id_producto_detalle";
    $queryConsuPro = mysqli_query($con, $sqlConspro);
    while ($rowConsulPro=mysqli_fetch_array($queryConsuPro)){
      $costo_soles_deta=$rowConsulPro['costo_soles'];
      $precio_producto_deta=$rowConsulPro['precio_producto'];
      $c1=$rowConsulPro['b1'];
      $c2=$rowConsulPro['b2'];
      $c3=$rowConsulPro['b3'];
      $c4=$rowConsulPro['b4'];
      $c5=$rowConsulPro['b5'];
      $c6=$rowConsulPro['b6'];
    }

    if ($_SESSION['tienda'] == 1) {
    $c1 = $c1 - $cantidad_detalle;
    $ctienda = $c1;
    }else if($_SESSION['tienda'] == 2){
    $c2 = $c2 - $cantidad_detalle;
    $ctienda = $c2;
    }else if ($_SESSION['tienda'] == 3) {
    $c3 = $c3 - $cantidad_detalle;
    $ctienda = $c3;
    }else if ($_SESSION['tienda'] == 4) {
    $c4 = $c4 - $cantidad_detalle;
    $ctienda = $c4;
    }else if ($_SESSION['tienda'] == 5) {
    $c5 = $c5 - $cantidad_detalle;
    $ctienda = $c5;
    }else if ($_SESSION['tienda'] == 6) {
    $c6 = $c6 - $cantidad_detalle;
    $ctienda = $c6;
    }else{
    }



    $UpdateProduc=mysqli_query($con, "UPDATE products SET b1 = '".$c1."', b2 = '".$c2."', b3 = '".$c3."', b4 = '".$c4."', b5 = '".$c5."',b6 = '".$c6."' where id_producto = $id_producto_detalle ");
   

$nuevossss = "INSERT INTO detalle_factura (id_cliente, id_vendedor, numero_factura, ot, id_producto, cantidad, precio_venta,precio_ventadespacho, tienda, activo, ven_com, fecha, precio_compra, tipo_doc, inv_ini, moneda, folio, id_facturas) VALUES ('$id_cliente','".$_SESSION['user_id']."','$nro_pre_orden','0','$id_producto_detalle','$cantidad_detalle','$precio_producto_deta', '$precio_detalle','".$_SESSION['tienda']."','1','1','$fecha','$costo_soles_deta','$id_tipodocumento','$ctienda','1','F00".$_SESSION['tienda']."','$id_fact_despacho')";

  $insert_detail=mysqli_query($con, "INSERT INTO detalle_factura (id_cliente, id_vendedor, numero_factura, ot, id_producto, cantidad, precio_venta,precio_ventadespacho, tienda, activo, ven_com, fecha, precio_compra, tipo_doc, inv_ini, moneda, folio, id_facturas) VALUES ('$id_cliente','".$_SESSION['user_id']."','$nro_pre_orden','0','$id_producto_detalle','$cantidad_detalle','$precio_producto_deta', '$precio_detalle','".$_SESSION['tienda']."','1','1','$fecha','$costo_soles_deta','$id_tipodocumento','$ctienda','1','F00".$_SESSION['tienda']."','$id_fact_despacho')");
    }
    ?>
    <?php

 $UpdateCabecera=mysqli_query($con,"UPDATE cabecera_orden SET estado_factura = 1 where id = $id_despachof");

  echo "<script>history.back(alert('Se registro la Factura Satisfactoriamente!' ))</script>";
     }

?>
