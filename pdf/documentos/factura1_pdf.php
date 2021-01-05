<?php
  session_start();
  if (!isset($_SESSION['user_login_status']) AND $_SESSION['user_login_status'] != 1) {
        header("location: ../../login.php");
    exit;
    }
  /* Connect To Database*/
  include("../../config/db.php");
  include("../../config/conexion.php");
  $session_id= session_id();
  $session_name= $_SESSION['user_id'];
  $nuevasesion_identificador = "";
  $nuevasesion_identificador = $session_id.$session_name;
  $identificadordecompra = 1;
  $sql_count=mysqli_query($con,"select * from tmp where session_id='".$session_id."' and session_con_id = '".$nuevasesion_identificador."' and venta_compra = '".$identificadordecompra."'");
  $count=mysqli_num_rows($sql_count);




  if ($count==0){
  echo "<script>alert('No hay productos agregados a la factura')</script>";
  echo "<script>window.close();</script>";
  exit;
  }
  //require_once(dirname(__FILE__).'/../html2pdf.class.php'); 
  //Variables por GET
  $id_proveedores=intval($_GET['id_proveedores']);
    $id_vendedor=$_SESSION['user_id'];
    $fecha=$_GET['fecha'];
    $fechaemision=$_GET['fechaemision'];
    $hora=$_GET['hora'];
    $dolar=$_GET['tcp'];
    $dias=$_GET['dias'];
    $factura=$_GET['factura'];

    $moneda=intval($_GET['moneda']);
    $folio="";
        
    if($moneda==2){
        $moneda1=$dolar;  
    }else{
        $moneda1=1;
    }
  $condiciones=mysqli_real_escape_string($con,(strip_tags($_REQUEST['condiciones'], ENT_QUOTES)));
  //Fin de variables por GET
  $sql=mysqli_query($con, "select LAST_INSERT_ID(numero_factura) as last from facturas order by id_factura desc limit 0,1 ");
  $rw=mysqli_fetch_array($sql);
  $numero_factura=$factura;
?>

<style type="text/css">

table { vertical-align: top; }
tr    { vertical-align: top; }
td    { vertical-align: top; }
.midnight-blue{
  background:#2c3e50;
  padding: 4px 4px 4px;
  color:white;
  font-weight:bold;
  font-size:12px;
}
.silver{
  background:white;
  padding: 3px 4px 3px;
}
.clouds{
  background:#ecf0f1;
  padding: 3px 4px 3px;
}
.border-top{
  border-top: solid 1px #bdc3c7;
  
}
.border-left{
  border-left: solid 1px #bdc3c7;
}
.border-right{
  border-right: solid 1px #bdc3c7;
}
.border-bottom{
  border-bottom: solid 1px #bdc3c7;
}
table.page_footer {width: 100%; border: none; background-color: white; padding: 2mm;border-collapse:collapse; border: none;}
}

</style>
<page backtop="15mm" backbottom="15mm" backleft="15mm" backright="15mm" style="font-size: 12pt; font-family: arial" >
  <?php
  date_default_timezone_set('America/Lima');
  ?>
    <table cellspacing="0" style="width: 100%;">
        <tr>
            <td style="width: 25%; color: #444444;">
                <br>
            </td>
      <td style="width: 50%; color: #34495e;font-size:12px;text-align:center">  
            </td>
      <td style="width: 25%;text-align:right">
      FACTURA Nro <?php echo $numero_factura;?>
      </td>
        </tr>
    </table>
    <br>
    <table cellspacing="0" style="width: 100%; text-align: left; font-size: 11pt;">
        <tr>
           <td style="width:50%;" class='midnight-blue'>FACTURADO POR:</td>
        </tr>
    <tr>
            <td style="width:50%;" >
      <?php 
        $sql_cliente=mysqli_query($con,"select * from clientes where id_cliente='$id_proveedores'");
    $sql_obtener_tpc = mysqli_query($con, "select * from constante order by id_constante desc LIMIT 1");
        $rw_cliente=mysqli_fetch_array($sql_cliente);
    $rw_tcp=mysqli_fetch_array($sql_obtener_tpc);
    $nuevodolar = $rw_tcp['dolar'];
        echo $rw_cliente['nombre_cliente'];
        echo "<br>";
        echo $rw_cliente['direccion_cliente'];
        /*echo "<br> Telefono: ";
        echo $rw_cliente['telefono_cliente'];*/
        echo "<br> Email: ";
        echo $rw_cliente['email_cliente'];
      ?>
        </td>
        </tr>
    </table>
    <br>
  <table cellspacing="0" style="width: 100%; text-align: left; font-size: 11pt;">
        <tr>
            <td style="width:35%;" class='midnight-blue'>VENDEDOR</td>
        <td style="width:25%;" class='midnight-blue'>FECHA INGRESO</td>
        <td style="width:20%;" class='midnight-blue'>FORMA DE PAGO</td>
        <td style="width:20%;" class='midnight-blue'>FECHA EMISIÓN</td>
        </tr>
    <tr>
            <td style="width:35%;">
      <?php 
        $sql_user=mysqli_query($con,"select * from users where user_id='$id_vendedor'");
        $rw_user=mysqli_fetch_array($sql_user);
        echo $rw_user['nombres'];
      ?>
        </td>
        <td style="width:25%;"><?php echo date("d/m/Y");?></td>
        <td style="width:20%;" >
        <?php 
        if ($condiciones==1){echo "Efectivo";}
        elseif ($condiciones==2){echo "Cheque";}
        elseif ($condiciones==3){echo "Transferencia bancaria";}
        elseif ($condiciones==4){echo "Crédito";}
        ?>
        </td>
        <td style="width:20%;" >
          <?php echo $fechaemision; ?>
        </td>
        </tr>
    </table>
  <br>
    <table cellspacing="0" style="width: 100%; text-align: left; font-size: 10pt;">
        <tr>
            <th style="width: 3%;text-align:center" class='midnight-blue'>Nro.</th>
            <th style="width: 7%;text-align:center" class='midnight-blue'>Cód. Proveedor.</th>
            <th style="width: 10%;text-align:center" class='midnight-blue'>CANT.</th>
            <th style="width: 60%" class='midnight-blue'>DESCRIPCION</th>
            <th style="width: 15%;text-align: right" class='midnight-blue'>PRECIO UNIT.</th>
            <th style="width: 15%;text-align: right" class='midnight-blue'>PRECIO TOTAL</th>
        </tr>
    <?php
    $nums=1;
    $sumador_total=0;
    $servicio=0;
    $tipo=$_SESSION['doc_ventas'];
  $ideproductomalo = "";
    $sql=mysqli_query($con, "select * from products, tmp where products.id_producto=tmp.id_producto and tmp.session_id='".$session_id."'  and session_con_id = '".$nuevasesion_identificador."' and venta_compra = '".$identificadordecompra."'");
//aca traemos todos los datos del TMP para insertar en el detalle.

$cadenadeidsdetalle = "";

$countList = 1;
    while ($row=mysqli_fetch_array($sql))
    {
    
      $fecha1=date("Y-m-d", strtotime($fecha) );
      $date_added=$fecha1." ".$hora;
      $id_tmp=$row["id_tmp"];
      $id_producto=$row["id_producto"];
    
      $sql3=mysqli_query($con, "select * from products where id_producto='".$id_producto."'");
        $row3=mysqli_fetch_array($sql3);
          if ($_SESSION['tienda']==1){
          $b="b1";
          $c=1;
          $d=$row3["b1"];
          }
          elseif($_SESSION['tienda']==2){
          $b="b2";
          $c=2;
          $d=$row3["b2"];
          }
          elseif($_SESSION['tienda']==3){
          $b="b3";
          $c=3;
          $d=$row3["b3"];
          }
          elseif($_SESSION['tienda']==4){
          $b="b4";
          $c=4;
          $d=$row3["b4"];
          }
          elseif($_SESSION['tienda']==5){
          $b="b5";
          $c=5;
          $d=$row3["b5"];
          }
          elseif($_SESSION['tienda']==6){
          $b="b6";
          $c=6;
          $d=$row3["b6"];
          }
          $codigo_producto=$row['codigo_producto'];
          $cantidad=$row['cantidad_tmp'];
          $nombre_producto=$row['nombre_producto'];
          $costo_soles_n=$row3['costo_soles'];
          $codProvvvv=$row3['codigoProveedor'];
          $precio_venta=$row['precio_tmp'];
          $pro_ser=$row['pro_ser'];
          $pproducto=$row['precio_producto'];
          $ptotal = $pproducto*$cantidad;
          if ($pro_ser==1){
              $servicio=$servicio+1;
          }
          $precio_venta_f=number_format($precio_venta,2);//Formateo variables
          $precio_venta_r=str_replace(",","",$precio_venta_f);//Reemplazo las comas
          $precio_total=$precio_venta_r*$cantidad;
          $precio_total_f=number_format($precio_total,2);//Precio total formateado
          $precio_total_r=str_replace(",","",$precio_total_f);//Reemplazo las comas
          $sumador_total+=$precio_total_r;//Sumador
          if ($nums%2==0){
            $clase="clouds";
          } else {
            $clase="silver";
          }
      if($precio_venta == null || $precio_venta < 0){
        $precio_venta = 0;
      }
      if($costo_soles_n == null || $costo_soles_n < 0){
        $costo_soles_n = 0;
      }
      if($d == null || $d < 0){
        $d = 0;
      }
      if($c == null || $c < 0){
        $c = 0;
      }
      
          $insert_detail=mysqli_query($con, "INSERT INTO detalle_factura (id_cliente, id_proveedor, id_vendedor, numero_factura, id_producto, cantidad, 
      precio_venta, tienda, activo, ven_com, fecha, precio_compra, tipo_doc, inv_ini, moneda, folio, dscto, compra,ot) values 
      (0,'$id_proveedores','$id_vendedor', '$numero_factura','$id_producto',$cantidad,'$precio_venta','$c','1','2', '$date_added',
          '$costo_soles_n','1','$d', '1','', '0.00', '1', '')");

      $ideproductomalo .= $id_producto." reg-df ";
      
          
          $nuevosides = mysqli_query($con, "SELECT id_detalle FROM detalle_factura ORDER by id_detalle DESC LIMIT 1");
       $nuevosidesparadetalle = mysqli_query($con, "SELECT id_detalle FROM detalle_factura ORDER by id_detalle DESC LIMIT 1");
                $rw_nuevosides_1 =mysqli_fetch_array($nuevosidesparadetalle);
    $iddetallefct = $rw_nuevosides_1['id_detalle'];
      $insert_detalle_precio_producto = mysqli_query($con, "INSERT INTO detalle_precio_producto (id_producto, id_detalle_factura, precio_producto) VALUES ($id_producto, $numero_factura, $precio_venta)");

          while ($rownuevosql=mysqli_fetch_array($nuevosides))
          {
            $cadenadeidsdetalle.= $rownuevosql["id_detalle"].",";
          }
          $productos1=mysqli_query($con, "UPDATE products SET $b=$b+$cantidad,costo_producto=$precio_venta_r WHERE id_producto=$id_producto and pro_ser=1");

          $dolar1=mysqli_query($con, "UPDATE datosempresa SET dolar=$dolar WHERE id_emp=1");

        if($condiciones==4){
            $deuda=$sumador_total;
        }else{
            $deuda=0;
        }


$fecha1=date("Y-m-d", strtotime($fecha) );

$date=$fecha1." ".$hora;
$condiciones1="";
$cuenta="";
        
    }

$insertamoselsql=mysqli_query($con,"INSERT INTO facturas(numero_factura, fecha_factura, fecha_emision, id_proveedor, id_vendedor, condiciones, 
        total_venta, deuda_total, estado_factura, tienda, ven_com, activo, servicio, moneda, nombre, cuenta1, cuenta2, dias, folio) 
        VALUES ('$numero_factura','$date','$fechaemision',$id_proveedores,$id_vendedor,'$condiciones','$sumador_total','$deuda','$tipo',
        '$c','2','1','0','$moneda1','$cuenta','0','0','$dias','$folio')");

        $cadenadeidsdetalle = trim($cadenadeidsdetalle, ",");
        $cadenadeidsdetallearray = explode(",", $cadenadeidsdetalle);
        $contararrays = count($cadenadeidsdetallearray);






        $nuevosidesfactura = mysqli_query($con, "SELECT id_factura FROM facturas ORDER by id_factura DESC LIMIT 1");
        while ($rownuevosqlproducts=mysqli_fetch_array($nuevosidesfactura))
        {
          $cadenadeidsproducto= $rownuevosqlproducts["id_factura"];
        }

        for($i=0;$i<$contararrays;$i++){
          $updateparaeldetalle = mysqli_query($con, "UPDATE detalle_factura set id_facturas = $cadenadeidsproducto where id_detalle = $cadenadeidsdetallearray[$i]");

        }

        $delete=mysqli_query($con,"DELETE FROM tmp WHERE session_id='".$session_id."' and session_con_id = '".$nuevasesion_identificador."' and venta_compra = '".$identificadordecompra."'");
$sumador_totaln = 0 ;
    $sql111=mysqli_query($con, "select * from products, detalle_factura where products.id_producto=detalle_factura.id_producto and detalle_factura.id_facturas='".$cadenadeidsproducto."'");

    while ($row11=mysqli_fetch_array($sql111))
    {
              $fecha1=date("Y-m-d", strtotime($fecha) );

        //$date_added=$fecha;
$date_added=$fecha1." ".$hora;
     
      $id_producto=$row11["id_producto"];
    $sql31=mysqli_query($con, "select * from products where id_producto='".$id_producto."'");
        $row31=mysqli_fetch_array($sql31);
      if ($_SESSION['tienda']==1){
        $b="b1";
        $c=1;
        $d=$row31["b1"];
        }
        elseif($_SESSION['tienda']==2){
        $b="b2";
        $c=2;
        $d=$row31["b2"];
        }
        elseif($_SESSION['tienda']==3){
        $b="b3";
        $c=3;
        $d=$row31["b3"];
         }
         
         elseif($_SESSION['tienda']==4){
        $b="b4";
        $c=4;
        $d=$row31["b4"];
         }
         
         elseif($_SESSION['tienda']==5){
        $b="b5";
        $c=5;
        $d=$row31["b5"];
         }
         
         elseif($_SESSION['tienda']==6){
        $b="b6";
        $c=6;
        $d=$row31["b6"];
         }
      $codigo_producto=$row11['codigo_producto'];
      $cantidad=$row11['cantidad'];
      $nombre_producto=$row11['nombre_producto'];
      $costo_soles_n=$row31['costo_soles'];
      $codProvvvv=$row31['codigoProveedor'];
      $precio_venta=$row11['precio_venta'];
          $pro_ser=$row11['pro_ser'];
          $pproducto=$row11['precio_producto'];
          $ptotal = $pproducto*$cantidad;
          
      
      //ven_com (2) significa compra
      
      



        
          if ($pro_ser==1){
              $servicio=$servicio+1;
          }
      $precio_venta_f=number_format($precio_venta,2);//Formateo variables
      $precio_venta_r=str_replace(",","",$precio_venta_f);//Reemplazo las comas
      $precio_total=$precio_venta_r*$cantidad;
      $precio_total_f=number_format($precio_total,2);//Precio total formateado
      $precio_total_r=str_replace(",","",$precio_total_f);//Reemplazo las comas
      $sumador_totaln+=$precio_total_r;//Sumador
      if ($nums%2==0){
        $clase="clouds";
      } else {
        $clase="silver";
      }
  ?>

        <tr>
            <td class='<?php echo $clase;?>' style="width: 3%; text-align: center"><?php echo $countList; ?></td>
            <td class='<?php echo $clase;?>' style="width: 7%; text-align: center"><?php echo $codProvvvv; ?></td>
            <td class='<?php echo $clase;?>' style="width: 10%; text-align: center"><?php echo $cantidad; ?></td>
            <td class='<?php echo $clase;?>' style="width: 50%; text-align: left"><?php echo $nombre_producto;?></td>
            <td class='<?php echo $clase;?>' style="width: 15%; text-align: right"><?php echo $precio_venta_f;?></td>
            <td class='<?php echo $clase;?>' style="width: 15%; text-align: right"><?php echo $precio_total_f;?></td>
            
        </tr>

  <?php 
        
        $sql3=mysqli_query($con, "select * from products where id_producto='".$id_producto."'");
        $row3=mysqli_fetch_array($sql3);
        
        if ($_SESSION['tienda']==1){
        $b="b1";
        $c=1;
        $d=$row3["b1"];
        }
        elseif($_SESSION['tienda']==2){
        $b="b2";
        $c=2;
        $d=$row3["b2"];
        }
        elseif($_SESSION['tienda']==3){
        $b="b3";
        $c=3;
        $d=$row3["b3"];
         }
         
         elseif($_SESSION['tienda']==4){
        $b="b4";
        $c=4;
        $d=$row3["b4"];
         }
         
         elseif($_SESSION['tienda']==5){
        $b="b5";
        $c=5;
        $d=$row3["b5"];
         }
         
         elseif($_SESSION['tienda']==6){
        $b="b6";
        $c=6;
        $d=$row3["b6"];
         }
        //$costo=$row3["costo_producto"];
         
         
         $fecha1=date("Y-m-d", strtotime($fecha) );

        //$date_added=$fecha;
$date_added=$fecha1." ".$hora;
  //Insert en la tabla detalle_cotizacion
      
     
       $countList = $countList + 1; 
        
  $nums++;
  }
  $subtotal=number_format($sumador_totaln,2,'.','');
  $total_iva=($subtotal * 18 )/100;
  $total_iva=number_format($total_iva,2,'.','');
  $total_factura=$subtotal-$total_iva;
        $moneda=intval($_GET['moneda']);
        
                 $mon="$";
                         
             
        
        
         if ($_SESSION['doc_ventas']==1) {
        
?>
    
        <tr>

            <td colspan="5" style="widtd: 85%; text-align: right;">SUBTOTAL $ </td>
            <td style="widtd: 15%; text-align: right;"> <?php echo number_format($total_factura,2);?></td>
        </tr>
    <tr>
            <td colspan="5" style="widtd: 85%; text-align: right;">IGV (<?php echo 18; ?>)% $ </td>
            <td style="widtd: 15%; text-align: right;"> <?php echo number_format($total_iva,2);?></td>
        </tr>
        <?php
         }
         ?>
        
        
        <tr>
            <td colspan="5" style="widtd: 85%; text-align: right;">TOTAL $ </td>
            <td style="widtd: 15%; text-align: right;"> <?php echo number_format($subtotal,2);?></td>
        </tr>
    </table>
  
  
  
  <br>
  
  
  
    

</page>



<?php

if($condiciones==4){
    $deuda=$sumador_totaln;
}else{
    $deuda=0;
}


$fecha1=date("Y-m-d", strtotime($fecha) );

$date=$fecha1." ".$hora;
$condiciones1="";
$cuenta="";

?>