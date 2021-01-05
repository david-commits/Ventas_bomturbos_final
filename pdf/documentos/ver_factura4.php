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
        $ot=$rw_factura['ot'];
        
	$id_cliente=$rw_factura['id_cliente'];
	$id_vendedor=$rw_factura['id_vendedor'];
	$fecha_factura=$rw_factura['fecha_factura'];
	$condiciones=$rw_factura['condiciones'];
        $moneda=$rw_factura['moneda'];
        $estado=$rw_factura['estado_factura'];
        $tienda2=$rw_factura['tienda'];
        
        if($condiciones==1){
            $condiciones1="Efectivo";
        }
        if($condiciones==2){
            $condiciones1="Cheque";
        }
        if($condiciones==3){
            $condiciones1="Transferencia Bancaria";
        }
        if($condiciones==4){
            $condiciones1="Credito";
        }
        
        $tienda1=$_SESSION['tienda'];
	//require_once(dirname(__FILE__).'/../html2pdf.class.php');
   
        
        $sql_factura1=mysqli_query($con,"select * from guia where id_doc='".$id_factura."'");
        $rw_factura1=mysqli_fetch_array($sql_factura1);
        $guia=$rw_factura1['guia'];
        
        $sql_factura2=mysqli_query($con,"select * from sucursal where tienda='".$tienda1."'");
        $rw_factura2=mysqli_fetch_array($sql_factura2);
        $logo=$rw_factura2['foto'];
        $dir=$rw_factura2['direccion'];
        $ruc=$rw_factura2['ruc'];
        $correo=$rw_factura2['correo'];
        
     //ob_start();
     //include(dirname('__FILE__').'/res/ver_factura_html.php');
     //include('pdf/documentos/res/ver_factura_html.php');
    //$content = ob_get_clean();

    //try
    //{
        
     //   $html2pdf = new HTML2PDF('P', 'LETTER', 'es', true, 'UTF-8', array(0, 0, 0, 0));
    //    
    //    $html2pdf->pdf->SetDisplayMode('fullpage');
        
    //    $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
        
    //    $html2pdf->Output('Factura.pdf');
   // }
    //catch(HTML2PDF_exception $e) {
    //    echo $e;
   //     exit;
   // }
?>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<script type="text/javascript">
 
    
    
function imprSelec(muestra)
{
    var ficha=document.getElementById(muestra);var ventimp=window.open(' ','popimpr');ventimp.document.write(ficha.innerHTML);ventimp.document.close();ventimp.print();ventimp.close();
    window.close();

}




</script>
</head>
<link rel=alternate media=print href="https://www.google.com.pe/">
 <link href="css/bootstrap.min.css" rel="stylesheet">

  <link href="fonts/css/font-awesome.min.css" rel="stylesheet">
  <link href="css/animate.min.css" rel="stylesheet">

  <!-- Custom styling plus plugins -->
  <link href="css/custom.css" rel="stylesheet">
  <link href="css/icheck/flat/green.css" rel="stylesheet">
  <link href="css/datatables/tools/css/dataTables.tableTools.css" rel="stylesheet">
 <link href="css/select/select2.min.css" rel="stylesheet">
  <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
  
  
  
  
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


<?php

if($tienda1==$tienda2){
    ?>

<div id="muestra">

<page backtop="15mm" backbottom="15mm" backleft="15mm" backright="15mm" style="font-size: 12pt; font-family: arial" >
        <page_footer>
        <table class="page_footer">
            <tr>

                <td style="width: 50%; text-align: left">
                    
                </td>
               
            </tr>
        </table>
    </page_footer>
    <table cellspacing="0" style="width: 100%;">
       <tr>

            <td style="width: 50%; color: #444444;" align="center">
                
                <img src="<?php echo $logo;?>" width="150" height="50">	
                <br><?php echo $dir;?>
                <br><?php echo $correo;?>
            </td>
			<td style="width: 25%; color: #34495e;font-size:12px;text-align:center">
               
                
            </td>
			<td style="width: 25%;text-align:center">
                           RUC:<?php echo $ruc;?><br> <span style="background:#0B2161;color:white;">ORDEN DE TRABAJO </span><br><font color=red>Nro:<?php echo $ot;?></font>
			</td>
			
        </tr>
    </table>
    <br>
    <?php 
				$sql_cliente=mysqli_query($con,"select * from clientes where id_cliente='$id_cliente'");
				$rw_cliente=mysqli_fetch_array($sql_cliente);
                                
                                $od1=$rw_cliente['od1'];
                                $od2=$rw_cliente['od2'];
                                $od3=$rw_cliente['od3'];
                                $od4=$rw_cliente['od4'];
                                $od5=$rw_cliente['od5'];
                                $od6=$rw_cliente['od6'];
                                $od7=$rw_cliente['od7'];
                                $od8=$rw_cliente['od8'];
                                
                                
                                $oi1=$rw_cliente['oi1'];
                                $oi2=$rw_cliente['oi2'];
                                $oi3=$rw_cliente['oi3'];
                                $oi4=$rw_cliente['oi4'];
                                $oi5=$rw_cliente['oi5'];
                                $oi6=$rw_cliente['oi6'];
                                $oi7=$rw_cliente['oi7'];
                                $oi8=$rw_cliente['oi8'];
                                
                                
                                $sql_cliente1=mysqli_query($con,"select * from facturas where id_factura='$id_factura'");
				$rw_cliente1=mysqli_fetch_array($sql_cliente1);
                                
                                //echo "<br> Datos:";
				//echo $rw_cliente['nombre_cliente'];
				//echo "<br> Dirección:";
				//echo $rw_cliente['direccion_cliente'];
				//echo "<br> Teléfono: ";
				//echo $rw_cliente['telefono_cliente'];
				//echo "<br> Email: ";
				//echo $rw_cliente['email_cliente'];
                                 
                          
			?>

	
        
    <table cellspacing="0" style="width: 100%; text-align: left; " >
        
        <tr>
            <td></td>
           <td width="450" height="10" align="right">
			
			DIA MES AÑO
           
           </td>
            
        </tr>
        
        
		<tr>
                    
                    <td></td>
           <td width="450" height="10" align="right">
			
			<?php
                        $dia=date("d",strtotime($rw_cliente1['fecha_factura']));
                        $mes=date("m",strtotime($rw_cliente1['fecha_factura']));
                        $ano=date("Y", strtotime($rw_cliente1['fecha_factura']));
                        
                        
                        ?>
               
               <?php echo $dia;?>&nbsp;&nbsp;
               <?php echo $mes;?>&nbsp;&nbsp;
		   
                   <?php echo $ano;?>
           
           </td>
              
        </tr>
              <tr>
           <td>
               
               <span style="background:#0B2161;color:white;">SEÑORES:</span>
		<?php
                echo $rw_cliente['nombre_cliente'];
         
                ?>
	
		   </td>
                
                   <td>
                     <img src="tel.jpg" width="30" height="20">
		<?php
                echo $rw_cliente['telefono_cliente'];
                
                ?>  
                       
                   </td>
                   
                   
                   
        </tr>
        
        <tr>
            <td colspan="2">
               
                <span style="background:#0B2161;color:white;">DOMICILIO:</span>
		<?php
                echo $rw_cliente['direccion_cliente'];
                
                ?>
			
		   </td>
          
        </tr>
      
    </table>
    
    
    <?php
    
                ?>
    
    
      
  
     <table cellspacing="0" style="width: 100%; text-align: left;">
        

<?php
$valor1="";
$valor2="";
$valor3="";
$cod1="";
$cod2="";
$cod3="";

$nums=1;
$sumador_total=0;
$sql1=mysqli_query($con, "select * from facturas where id_factura='".$id_factura."'");
$row1=mysqli_fetch_array($sql1);
$servicio=$row1["servicio"];
$tipo1=$row1["estado_factura"];
if($servicio==0){
$sql=mysqli_query($con, "select * from products, detalle_factura, facturas where detalle_factura.tienda=facturas.tienda and products.id_producto=detalle_factura.id_producto and detalle_factura.ot=facturas.ot and facturas.ven_com=detalle_factura.ven_com  and facturas.ot='".$ot."'" );
}else{
 $sql=mysqli_query($con, "select * from detalle_factura, facturas where detalle_factura.tienda=facturas.tienda and detalle_factura.ot=facturas.ot and facturas.ot='".$ot."'");   
}
$suma=0;
while ($row=mysqli_fetch_array($sql))
	{
	$id_producto=$row["id_producto"];
        
        $id_categoria=$row["cat_pro"];
        $cod=$row["codigo_producto"];
        
	if($servicio==0){
        $codigo_producto=$row['codigo_producto'];
	$cantidad=$row['cantidad'];
	$nombre_producto=$row['nombre_producto'];
        }else{
          
	$cantidad=$row['cantidad'];
	
        
        
        $id_producto1=$row['id_producto'];  
        $inv_ini=$row['inv_ini'];
        if($inv_ini>0){
            $sql2=mysqli_query($con, "select * from products where id_producto='".$id_producto1."'");
            $row2=mysqli_fetch_array($sql2);
            $nombre_producto=$row2["nombre_producto"];}
            else{
            $nombre_producto=$row['id_producto'];  
        }
            
        }
	$precio_venta=$row['precio_venta'];
	$precio_venta_f=number_format($precio_venta,2);//Formateo variables
	$precio_venta_r=str_replace(",","",$precio_venta_f);//Reemplazo las comas
	$precio_total=$precio_venta_r*$cantidad;
	$precio_total_f=number_format($precio_total,2);//Precio total formateado
	$precio_total_r=str_replace(",","",$precio_total_f);//Reemplazo las comas
	$sumador_total+=$precio_total_r;//Sumador

      
        
        if($id_categoria==27){
            $valor1=$nombre_producto;
            $cod1=$cod;
        }
        if($id_categoria==28){
            $valor2=$nombre_producto;
            $cod2=$cod;
        }
        
        if($id_categoria<>27 && $id_categoria<>28){
            $valor3=$nombre_producto;
            $cod3=$cod;
        }
            ?>

       
        

	<?php 
        $suma=$suma+1;
        
   
	}
  
        
	$subtotal=number_format($sumador_total,2,'.','');
	$total_iva=($subtotal * 18 )/100;
	$total_iva=number_format($total_iva,2,'.','');
	$total_factura=$subtotal-$total_iva;
        if($moneda==1){
            $mon="S/.";
        }else{
            $mon="USD";
        }
        
        
        
        
        
        

           
            ?> 
         
         
         <tr>
            <td colspan="2">
                 
                Montura:
            <?php echo$valor1;?>  <?php echo $cod1;?></td>
            
            
        </tr> 
         
        
        <tr>
            <td colspan="2">
                 
               Cristal:
            <?php echo $valor2;?> <?php echo $cod2;?></td>
            
            
        </tr> 
        
        <tr>
            <td colspan="2">
                 
               Otros:
            <?php echo $valor3;?> <?php echo $cod3;?></td>
            
            
        </tr> 
        
        
         
        <br>
        <tr><td style="width: 30%; text-align: left;">
                <table cellspacing="0" style="width: 100%; text-align: left;" border="1" style=" text-align: right;">
                    <tr>
                        <td>LEJOS</td><td>ESF</td><td>CIL</td><td>EJE</td><td>DIP</td>
                        
                        
                    </tr>
                    <tr>
                        <td>OD</td><td><?php echo $od1;?></td><td><?php echo $od2;?></td><td><?php echo $od3;?></td><td><?php echo $od4;?></td>
                        
                    </tr>
                    <tr>
                        
                        <td>OI</td><td><?php echo $oi1;?></td><td><?php echo $oi2;?></td><td><?php echo $oi3;?></td><td><?php echo $oi4;?></td>
                    </tr>
                    <tr>
                        
                        <td>LEJOS</td><td>ESF</td><td>CIL</td><td>EJE</td><td>DIP</td>
                    </tr>
                    <tr>
                        <td>OD</td><td><?php echo $od5;?></td><td><?php echo $od6;?></td><td><?php echo $od7;?></td><td><?php echo $od8;?></td>
                        
                    </tr>
                    <tr>
                        
                        <td>OI</td><td><?php echo $oi5;?></td><td><?php echo $oi6;?></td><td><?php echo $oi7;?></td><td><?php echo $oi8;?></td>
                    </tr>
                    
                    
                    
                    
                </table>
                
                
                
                
                
            </td>
        
        
       
		
       
           
            <td align="right">
                <table cellspacing="0" >
                    
                    <tr><td> FECHA DE ENTREGA:<?php 
                    $fecha_entrega=date("d/m/Y", strtotime($rw_cliente1['fecha_entrega']));
                    echo $fecha_entrega;
                    ?>
                    </td></tr>
                    <tr><td> -------------------------------</td></tr>
                     <tr><td> FIRMA DEL CLIENTE</td></tr>
                    
                
                     <tr><td><span style="background:#BDBDBD;color:blue;">TRATADO &nbsp;&nbsp;S/ </span><?php echo number_format($rw_factura['total_venta'],2);?></td></tr>
                     <tr><td><span style="background:#BDBDBD;color:blue;">A CUENTA S/ </span><?php 
                $acuenta=$rw_factura['total_venta']-$rw_factura['deuda_total'];
                echo number_format($acuenta,2);?></td></tr>
                <tr><td><span style="background:#BDBDBD;color:blue;">SALDO &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;S/ </span> <?php echo number_format($rw_factura['deuda_total'],2);?></td></tr>
                
                
                </table>
                </td>
        </tr>
 
    </table>
	
	
	
	<br>
	
</page>
    
    
    
    
</div>



<?php 


}







function unidad($numuero){
switch ($numuero)
{
case 9:
{
$numu = "NUEVE";
break;
}
case 8:
{
$numu = "OCHO";
break;
}
case 7:
{
$numu = "SIETE";
break;
} 
case 6:
{
$numu = "SEIS";
break;
} 
case 5:
{
$numu = "CINCO";
break;
} 
case 4:
{
$numu = "CUATRO";
break;
} 
case 3:
{
$numu = "TRES";
break;
} 
case 2:
{
$numu = "DOS";
break;
} 
case 1:
{
$numu = "UN";
break;
} 
case 0:
{
$numu = "";
break;
} 
}
return $numu; 
}

function decena($numdero){

if ($numdero >= 90 && $numdero <= 99)
{
$numd = "NOVENTA ";
if ($numdero > 90)
$numd = $numd."Y ".(unidad($numdero - 90));
}
else if ($numdero >= 80 && $numdero <= 89)
{
$numd = "OCHENTA ";
if ($numdero > 80)
$numd = $numd."Y ".(unidad($numdero - 80));
}
else if ($numdero >= 70 && $numdero <= 79)
{
$numd = "SETENTA ";
if ($numdero > 70)
$numd = $numd."Y ".(unidad($numdero - 70));
}
else if ($numdero >= 60 && $numdero <= 69)
{
$numd = "SESENTA ";
if ($numdero > 60)
$numd = $numd."Y ".(unidad($numdero - 60));
}
else if ($numdero >= 50 && $numdero <= 59)
{
$numd = "CINCUENTA ";
if ($numdero > 50)
$numd = $numd."Y ".(unidad($numdero - 50));
}
else if ($numdero >= 40 && $numdero <= 49)
{
$numd = "CUARENTA ";
if ($numdero > 40)
$numd = $numd."Y ".(unidad($numdero - 40));
}
else if ($numdero >= 30 && $numdero <= 39)
{
$numd = "TREINTA ";
if ($numdero > 30)
$numd = $numd."Y ".(unidad($numdero - 30));
}
else if ($numdero >= 20 && $numdero <= 29)
{
if ($numdero == 20)
$numd = "VEINTE ";
else
$numd = "VEINTI".(unidad($numdero - 20));
}
else if ($numdero >= 10 && $numdero <= 19)
{
switch ($numdero){
case 10:
{
$numd = "DIEZ ";
break;
}
case 11:
{ 
$numd = "ONCE ";
break;
}
case 12:
{
$numd = "DOCE ";
break;
}
case 13:
{
$numd = "TRECE ";
break;
}
case 14:
{
$numd = "CATORCE ";
break;
}
case 15:
{
$numd = "QUINCE ";
break;
}
case 16:
{
$numd = "DIECISEIS ";
break;
}
case 17:
{
$numd = "DIECISIETE ";
break;
}
case 18:
{
$numd = "DIECIOCHO ";
break;
}
case 19:
{
$numd = "DIECINUEVE ";
break;
}
} 
}
else
$numd = unidad($numdero);
return $numd;
}

function centena($numc){
if ($numc >= 100)
{
if ($numc >= 900 && $numc <= 999)
{
$numce = "NOVECIENTOS ";
if ($numc > 900)
$numce = $numce.(decena($numc - 900));
}
else if ($numc >= 800 && $numc <= 899)
{
$numce = "OCHOCIENTOS ";
if ($numc > 800)
$numce = $numce.(decena($numc - 800));
}
else if ($numc >= 700 && $numc <= 799)
{
$numce = "SETECIENTOS ";
if ($numc > 700)
$numce = $numce.(decena($numc - 700));
}
else if ($numc >= 600 && $numc <= 699)
{
$numce = "SEISCIENTOS ";
if ($numc > 600)
$numce = $numce.(decena($numc - 600));
}
else if ($numc >= 500 && $numc <= 599)
{
$numce = "QUINIENTOS ";
if ($numc > 500)
$numce = $numce.(decena($numc - 500));
}
else if ($numc >= 400 && $numc <= 499)
{
$numce = "CUATROCIENTOS ";
if ($numc > 400)
$numce = $numce.(decena($numc - 400));
}
else if ($numc >= 300 && $numc <= 399)
{
$numce = "TRESCIENTOS ";
if ($numc > 300)
$numce = $numce.(decena($numc - 300));
}
else if ($numc >= 200 && $numc <= 299)
{
$numce = "DOSCIENTOS ";
if ($numc > 200)
$numce = $numce.(decena($numc - 200));
}
else if ($numc >= 100 && $numc <= 199)
{
if ($numc == 100)
$numce = "CIEN ";
else
$numce = "CIENTO ".(decena($numc - 100));
}
}
else
$numce = decena($numc);

return $numce; 
}

function miles($nummero){
if ($nummero >= 1000 && $nummero < 2000){
$numm = "MIL ".(centena($nummero%1000));
}
if ($nummero >= 2000 && $nummero <10000){
$numm = unidad(Floor($nummero/1000))." MIL ".(centena($nummero%1000));
}
if ($nummero < 1000)
$numm = centena($nummero);

return $numm;
}

function decmiles($numdmero){
if ($numdmero == 10000)
$numde = "DIEZ MIL";
if ($numdmero > 10000 && $numdmero <20000){
$numde = decena(Floor($numdmero/1000))."MIL ".(centena($numdmero%1000)); 
}
if ($numdmero >= 20000 && $numdmero <100000){
$numde = decena(Floor($numdmero/1000))." MIL ".(miles($numdmero%1000)); 
} 
if ($numdmero < 10000)
$numde = miles($numdmero);

return $numde;
} 

function cienmiles($numcmero){
if ($numcmero == 100000)
$num_letracm = "CIEN MIL";
if ($numcmero >= 100000 && $numcmero <1000000){
$num_letracm = centena(Floor($numcmero/1000))." MIL ".(centena($numcmero%1000)); 
}
if ($numcmero < 100000)
$num_letracm = decmiles($numcmero);
return $num_letracm;
} 

function millon($nummiero){
if ($nummiero >= 1000000 && $nummiero <2000000){
$num_letramm = "UN MILLON ".(cienmiles($nummiero%1000000));
}
if ($nummiero >= 2000000 && $nummiero <10000000){
$num_letramm = unidad(Floor($nummiero/1000000))." MILLONES ".(cienmiles($nummiero%1000000));
}
if ($nummiero < 1000000)
$num_letramm = cienmiles($nummiero);

return $num_letramm;
} 

function decmillon($numerodm){
if ($numerodm == 10000000)
$num_letradmm = "DIEZ MILLONES";
if ($numerodm > 10000000 && $numerodm <20000000){
$num_letradmm = decena(Floor($numerodm/1000000))."MILLONES ".(cienmiles($numerodm%1000000)); 
}
if ($numerodm >= 20000000 && $numerodm <100000000){
$num_letradmm = decena(Floor($numerodm/1000000))." MILLONES ".(millon($numerodm%1000000)); 
}
if ($numerodm < 10000000)
$num_letradmm = millon($numerodm);

return $num_letradmm;
}

function cienmillon($numcmeros){
if ($numcmeros == 100000000)
$num_letracms = "CIEN MILLONES";
if ($numcmeros >= 100000000 && $numcmeros <1000000000){
$num_letracms = centena(Floor($numcmeros/1000000))." MILLONES ".(millon($numcmeros%1000000)); 
}
if ($numcmeros < 100000000)
$num_letracms = decmillon($numcmeros);
return $num_letracms;
} 

function milmillon($nummierod){
if ($nummierod >= 1000000000 && $nummierod <2000000000){
$num_letrammd = "MIL ".(cienmillon($nummierod%1000000000));
}
if ($nummierod >= 2000000000 && $nummierod <10000000000){
$num_letrammd = unidad(Floor($nummierod/1000000000))." MIL ".(cienmillon($nummierod%1000000000));
}
if ($nummierod < 1000000000)
$num_letrammd = cienmillon($nummierod);

return $num_letrammd;
} 


function convertir($numero){
$numf = milmillon($numero);
return $numf;
}

function mes1($texto)
{
  if($texto=='01') {
    
    return "enero";
}elseif($texto=='02'){
    return "febrero";
}elseif($texto=='03'){
    return "marzo";
}elseif($texto=='04'){
    return "abril";
}elseif($texto=='05'){
    return "mayo";
}elseif($texto=='06'){
    return "junio";
}elseif($texto=='07'){
    return "julio";
}elseif($texto=='08'){
    return "agosto";
}elseif($texto=='09'){
    return "setiembre";
}elseif($texto=='10'){
    return "octubre";
}elseif($texto=='11'){
    return "noviembre";
}elseif($texto=='12'){
    return "diciembre";
}  
    
    
}

?>
