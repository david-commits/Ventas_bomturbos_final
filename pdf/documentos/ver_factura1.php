<?php
	
	session_start();
	if (!isset($_SESSION['user_login_status']) AND $_SESSION['user_login_status'] != 1) {
        header("location: ../../login.php");
		exit;
    }
	/* Connect To Database*/
	include("../../config/db.php");
	include("../../config/conexion.php");

	$id_factura= intval($_GET['id_factura']);

	/*var_dump($id_factura);
	die();*/
	$sql_count=mysqli_query($con,"select * from facturas where id_factura='".$id_factura."'");
	$count=mysqli_num_rows($sql_count);
	if ($count==0)
	{
	echo "<script>alert('Factura no encontrada')</script>";
	echo "<script>window.close();</script>";
	exit;
	}
	$sql_factura=mysqli_query($con,"select * from facturas where id_factura='".$id_factura."'");
	$rw_factura=mysqli_fetch_array($sql_factura);
	$numero_factura=$rw_factura['numero_factura'];
	$id_cliente=$rw_factura['id_proveedor'];
	$id_vendedor=$rw_factura['id_vendedor'];
	$fecha_factura=$rw_factura['fecha_factura'];
	$fechaemision=$rw_factura['fecha_emision'];
	$condiciones=$rw_factura['condiciones'];
        $moneda=$rw_factura['condiciones'];
        $estado=$rw_factura['estado_factura'];
        $tienda2=$rw_factura['tienda'];
        $tienda1=$_SESSION['tienda'];
	require_once(dirname(__FILE__).'/../html2pdf.class.php');
   
?>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <!-- Meta, title, CSS, favicons, etc. -->
  <meta charset="utf-8">  
    <script type="text/javascript">
 
    
    
function imprSelec(muestra)
{
    var ficha=document.getElementById(muestra);var ventimp=window.open(' ','popimpr');ventimp.document.write(ficha.innerHTML);ventimp.document.close();ventimp.print();ventimp.close();
    window.close();

}

</script>
    
</head>

<style type="text/css">
<!--
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
-->
</style>

<a class="btn btn-success"   onclick="javascript:window.close();" href="javascript:imprSelec('muestra')"><i class="fa fa-print"></i>Imprimir</a>
<div id="muestra">

    <?php

if($tienda1==$tienda2){
    ?>
<page backtop="15mm" backbottom="15mm" backleft="15mm" backright="15mm" style="font-size: 12pt; font-family: arial" >
        <page_footer>
        
    </page_footer>
    <table cellspacing="0" style="width: 100%;">
        <tr>

            <td style="width: 25%; color: #444444;">
                
                
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
           <td style="width:50%;" class='midnight-blue'>FACTURAR A</td>
        </tr>
		<tr>
           <td style="width:50%;" >
			<?php 
				$sql_cliente=mysqli_query($con,"select * from proveedores where id_proveedores='$id_cliente'");
				$rw_cliente=mysqli_fetch_array($sql_cliente);
				echo "<br>Proveedor:";
                                echo $rw_cliente['nom_pro'];
				echo "<br>Direccion:";
				echo $rw_cliente['dir_pro'];
				echo "<br> Telefono: ";
				echo $rw_cliente['tel_pro'];
				echo "<br> Email: ";
				echo $rw_cliente['email_provedor'];
			?>
			
		   </td>
        </tr>
        
   
    </table>
    
       <br>
		<table cellspacing="0" style="width: 100%; text-align: left; font-size: 11pt;">
        <tr>
           <td style="width:35%;" class='midnight-blue'>VENDEDOR</td>
		  <td style="width:25%;" class='midnight-blue'>FECHA</td>
		   <td style="width:20%;" class='midnight-blue'>FORMA DE PAGO</td>
		   <td style="width:20%;" class='midnight-blue'>FECHA DE EMISION</td>
        </tr>
		<tr>
           <td style="width:35%;">
			<?php 
				$sql_user=mysqli_query($con,"select * from users where user_id='$id_vendedor'");
				$rw_user=mysqli_fetch_array($sql_user);
				echo $rw_user['nombres'];
			?>
		   </td>
		  <td style="width:25%;"><?php echo date("d/m/Y", strtotime($fecha_factura));?></td>
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
            <th style="width: 3%;text-align: right" class='midnight-blue'>Nro.</th>
            <th style="width: 15%;text-align: right" class='midnight-blue'>Cod. Proveedor</th>
            <th style="width: 10%;text-align:center" class='midnight-blue'>CANT.</th>
            <th style="width: 42%" class='midnight-blue'>DESCRIPCION</th>
            <th style="width: 15%;text-align: right" class='midnight-blue'>PRECIO UNIT.</th>
            <th style="width: 15%;text-align: right" class='midnight-blue'>PRECIO TOTAL</th>
            
        </tr>

<?php
$nums=1;
$sumador_total=0;
$sql=mysqli_query($con, "select products.id_producto,products.codigoProveedor ,products.codigo_producto, detalle_factura.cantidad, products.nombre_producto, detalle_factura.precio_venta from detalle_factura detalle_factura inner join products products on detalle_factura.id_producto= products.id_producto where detalle_factura.id_facturas='".$id_factura."'");

$nuevocount = 1 ;
while ($row=mysqli_fetch_array($sql))
	{
	$id_producto=$row["id_producto"];
	$codigo_producto=$row['codigo_producto'];
	$cantidad=$row['cantidad'];
	$nombre_producto=$row['nombre_producto'];
	$cproveedor=$row['codigoProveedor'];
	
	$precio_venta=$row['precio_venta'];
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
	?>

        <tr>
            <td class='<?php echo $clase;?>' style="width: 3%; text-align: right"><?php echo $nuevocount;?></td>
            <td class='<?php echo $clase;?>' style="width: 15%; text-align: right"><?php echo $cproveedor;?></td>
            <td class='<?php echo $clase;?>' style="width: 10%; text-align: center"><?php echo $cantidad; ?></td>
            <td class='<?php echo $clase;?>' style="width: 42%; text-align: left"><?php echo $nombre_producto;?></td>
            <td class='<?php echo $clase;?>' style="width: 15%; text-align: right"><?php echo $precio_venta_f;?></td>
            <td class='<?php echo $clase;?>' style="width: 15%; text-align: right"><?php echo $precio_total_f;?></td>
            
        </tr>

	<?php 

	
	$nums++;
	$nuevocount = $nuevocount + 1;
	}
	$subtotal=number_format($sumador_total,2,'.','');
	$total_iva=($subtotal * 18 )/100;
	$total_iva=number_format($total_iva,2,'.','');
	$total_factura=$subtotal-$total_iva;
        if($moneda==1){
            $mon="$.";
        }else{
            $mon="USD";
        }
        
        if ($estado==1) {
?>
	  
        <tr>
            <td style="widtd: 60%; text-align: right;"> </td>
            <td colspan="4" style="widtd: 15%; text-align: right;">SUBTOTAL <?PHP echo $mon;?> </td>
            <td style="widtd: 15%; text-align: right;"> <?php echo number_format($total_factura,2);?></td>
        </tr>
		<tr>
            <td style="widtd: 60%; text-align: right;"></td>
            <td colspan="4" style="widtd: 15%; text-align: right;">IGV (<?php echo 18; ?>)% <?PHP echo $mon;?> </td>
            <td style="widtd: 15%; text-align: right;"> <?php echo number_format($total_iva,2);?></td>
        </tr>
        
        <?PHP
        }
        ?>
        
        <tr>
            
            
            <td style="widtd: 70%; text-align: right;"></td>
            <td colspan="4" style="widtd: 15%; text-align: right;">TOTAL <?PHP echo $mon;?> </td>
            <td style="widtd: 15%; text-align: right;"> <?php echo number_format($subtotal,2);?></td>
        </tr>
    </table>
	
	
	
	<br>
	
	
	
	  

</page>

</div>

<?php 


}
?>