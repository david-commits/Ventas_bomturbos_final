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

<?php

date_default_timezone_set('America/Lima');
?>

<page backtop="15mm" backbottom="15mm" backleft="15mm" backright="15mm" style="font-size: 12pt; font-family: arial" >
        <page_footer>
        
    </page_footer>
    
    <table cellspacing="0" style="width: 100%;">
        <tr>

            
			
			
			
        </tr>
    </table>
    <br>
    <?php 
				$sql_cliente=mysqli_query($con,"select * from clientes where id_cliente='$id_cliente'");
				$rw_cliente=mysqli_fetch_array($sql_cliente);
                                
                                //$sql_cliente1=mysqli_query($con,"select * from facturas where id_factura='$id_factura'");
				//$rw_cliente1=mysqli_fetch_array($sql_cliente1);
                                
                               
                if($_SESSION['doc_ventas']==1){                 
                          //http://www.xvideos.com/video23308882/nacho_s_dangerous_curves_kesha_ortega_raquel_adan_marta_la_croft_sheila_orteg      
			?>

	<br>
        <br><br>
        <br><br>
        <br><br>
        <br><br>
        
        
    <table cellspacing="0" style="width: 100%; text-align: left; font-size: 11pt;">
        
        
        
        
		<tr>
           <td width="450" height="10">
			
			<?php
                        //$dia=date("d",strtotime($rw_cliente1['fecha_factura']));
                        //$mes=date("m",strtotime($rw_cliente1['fecha_factura']));
                        //$ano=date("Y", strtotime($rw_cliente1['fecha_factura']));
                        $dia=date("d");
                        $mes=date("m");
                        $ano=date("Y");
                        
                        $mes2=mes1($mes);
                        $ano1=$ano%1000;
                        ?>
               
               &nbsp;&nbsp;&nbsp;&nbsp;<?php echo $dia;?>
               &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $mes2;?>
		   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                   <?php echo $ano1;?>
           
           </td>
                  
                   <td width="200">
			<?php
                echo $rw_cliente['doc'];
                
                ?>
			
		   </td>
        </tr>
      
        <tr>
           <td height="20">
               
               &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<?php
                echo $rw_cliente['nombre_cliente'];
                
                ?>
			
		   </td>
        </tr>
        <tr>
           <td height="20">
               &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<?php
                echo $rw_cliente['direccion_cliente'];
                
                ?>	
			
		   </td>
                    <td style="width:50%;" >
			
			
		   </td>
        </tr>
        
   
    </table>
    <br>
        <br>
        
    
    
    
    <?php
    
                }
               
    
    
    if($_SESSION['doc_ventas']==3){                 
                                
			?>

    <br>
    <br>
    <br>
    <br>
    <br>
    <br><br>
    <br>
    <br>
    <table cellspacing="0" style="width: 100%; text-align: left; font-size: 11pt;">
        
		
        
        <tr>
           <td width="450" style="width:50%;" >
               
               &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
               
		<?php
                echo $rw_cliente['nombre_cliente'];
                
                ?>
			
		   </td>
                    <td style="width:50%;" >
                        
                        
		<?php
                echo $rw_cliente['telefono_cliente'];
                
                ?>
			
		   </td>
        </tr>
        
        
   
    </table>
     <br>
		
	<br>
    <?php
    
                }
                
                
      
      if($_SESSION['doc_ventas']==2){                 
                                
			?>

	<br>
        <br>
        <br>
        <br>
        <br>
       
        
    <table cellspacing="0" style="width: 100%; text-align: left; font-size: 11pt;">
        
		
        
        <tr>
           <td width="220" height="15">
               &nbsp;&nbsp;&nbsp;&nbsp;
		<?php
                echo $rw_cliente['nombre_cliente'];
                
                ?>
			
		   </td>
                    <td>
		
			
		   </td>
        </tr>
        
        <tr>
           <td>
               &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<?php
                echo $rw_cliente['direccion_cliente'];
                
                ?>
			
		   </td>
                    <td>
		<?php
                echo $rw_cliente['doc'];
                
                ?>
			
		   </td>
        </tr>
        
        
    </table>
        <br> 
        
		
	
    <?php
    
                }          
                
                
                
                
                
                
                ?>
  
    <table cellspacing="0" style="width: 100%; text-align: left; font-size: 10pt;">
       

<?php

$nums=1;
$sumador_total=0;
$servicio=0;
$suma=0;
$tipo=$_SESSION['doc_ventas'];
$sql=mysqli_query($con, "select * from products, tmp where products.id_producto=tmp.id_producto and tmp.session_id='".$session_id."'");
while ($row=mysqli_fetch_array($sql))
	{
	$id_tmp=$row["id_tmp"];
	$id_producto=$row["id_producto"];
	$codigo_producto=$row['codigo_producto'];
	$cantidad=$row['cantidad_tmp'];
	$nombre_producto=$row['nombre_producto'];
    $detalle_ubicacion=$row['detalle'];
	
	$precio_venta=$row['precio_tmp'];
        
        
        $pro_ser=$row['pro_ser'];
        if ($pro_ser==2){
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
	if($_SESSION['doc_ventas']==3){ 
        if($suma<20){
        ?>

        <tr>
            <td width="60" height="20">
               &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;
                <?php echo $cantidad; ?></td>
            <td width="70"><?php echo $nombre_producto;?></td>
            <td width="40" ><?php echo $detalle_ubicacion;?></td>
            <td width="40" ><?php echo $precio_venta_f;?></td>
            <td width="40"><?php echo $precio_total_f;?></td>
            
        </tr>
        <br>

	<?php 
        $suma=$suma+1;
        }
        
        
        
        }
	
        
       
       if($_SESSION['doc_ventas']==2){ 
        if($suma<16){
        ?>

        <tr>
            <td width="30" height="17">
                 
                
                <?php echo $cantidad; ?></td>
            <td width="190"><?php echo $nombre_producto;?></td>
            <td width="50" ><?php echo $detalle_ubicacion;?></td>
            <td width="50" ><?php echo $precio_venta_f;?></td>
            <td width="50"><?php echo $precio_total_f;?></td>
            
        </tr>
        <br>

	<?php 
        $suma=$suma+1;
        }
      } 
  
      
      if($_SESSION['doc_ventas']==1){ 
        if($suma<8){
        ?>

        <tr>
            <td width="60" height="20">
                 
                <?php echo $cantidad; ?></td>
            <td width="480"><?php echo $nombre_producto;?></td>
            <td width="100" ><?php echo $detalle_ubicacion;?></td>
            <td width="100" ><?php echo $precio_venta_f;?></td>
            <td width="100"><?php echo $precio_total_f;?></td>
            
        </tr>
        <br>

	<?php 
        $suma=$suma+1;
        }
        
        
        
        }
        
        
        
        $date_added=date("Y-m-d H:i:s");
	//Insert en la tabla detalle_cotizacion
        
        
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
        $costo=$row3["costo_producto"];
        
        
        
        
        
	$insert_detail=mysqli_query($con, "INSERT INTO detalle_factura VALUES ('','$numero_factura','$id_producto','$cantidad','$precio_venta_r','$c','1','1','$date_added','$costo','$tipo','$d')");
	
        
        
        $productos1=mysqli_query($con, "UPDATE products SET $b=$b-$cantidad,precio_producto=$precio_venta_r WHERE id_producto=$id_producto and pro_ser=1");
        
        
        
	$nums++;
	//fin
        
        
        }
        
        if($_SESSION['doc_ventas']==3){
        for($i=$suma;$i<20;$i++){
        
        ?>

        <tr>
            <td width="100" height="20">
                 
               </td>
            <td width="290"></td>
            <td width="50" ></td>
            <td width="50" ></td>
            <td width="50"></td>
            
        </tr>
        <br>

	<?php 
        
        
        }
        }
        
        
        if($_SESSION['doc_ventas']==2){
        for($i=$suma;$i<15;$i++){
        
        ?>

        <tr>
             <td width="30" height="17">
               
          
             </td>
            <td width="190"></td>
            <td width="50" ></td>
            <td width="50" ></td>
            <td width="50"></td>
            
        </tr>
        <br>

	<?php 
        
        
        }
        }
        
        
        if($_SESSION['doc_ventas']==1){
        for($i=$suma;$i<8;$i++){
        
        ?>

        <tr>
            <td  height="20">
                
               </td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            
        </tr>
        <br>

	<?php 
        
        
        }
        }
        
        
        
        
        
	$subtotal=number_format($sumador_total,2,'.','');
	$total_iva=($subtotal * 18 )/100;
	$total_iva=number_format($total_iva,2,'.','');
	$total_factura=$subtotal-$total_iva;
        $moneda=intval($_GET['moneda']);
        if($moneda==1){
                 $mon="S/.";
                         
             }else{
                $mon="USD"; 
             }
         if($_SESSION['doc_ventas']==1){

            $decimales = explode(".",number_format($subtotal,2));
    $entera=explode(".",$subtotal);
            
           $texto=convertir($entera[0]).' y '. $decimales[1].'/100 NUEVOS SOLES';
            ?>      
	 <tr>
            <td colspan="3" height="20">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <?php echo $texto;?></td>
            <td> </td>
        </tr> 
        <tr>
            <td colspan="3" height="20"> </td>
            <td> <?php echo number_format($total_factura,2);?></td>
        </tr>
		<tr>
            <td colspan="3" height="20"> </td>
            <td> <?php echo number_format($total_iva,2);?></td>
        </tr>
        <tr>
            <td colspan="3" height="20"></td>
            <td><?php echo number_format($subtotal,2);?></td>
        </tr>
        
        
        <?php
        }
        
        if($_SESSION['doc_ventas']==3){
        ?>
        
        
        <br>
        <tr>
            <td colspan="3" ></td>
            <td><?php echo number_format($subtotal,2);?></td>
        </tr>
    <?php
        }
        if($_SESSION['doc_ventas']==2){
        ?>
        
        
        <br>
        <tr>
            <td colspan="3" ></td>
            <td><?php echo number_format($subtotal,2);?></td>
        </tr>
    <?php
        }
        
        
        ?>
    
        
        
    
    </table>
	
	
	
	<br>
	  

</page>



<?php

if($condiciones==4){
    $deuda=$sumador_total;
}else{
    $deuda=0;
}

if($servicio>0){
    $ser=1;
}else{
    $ser=0;
}

$date=date("Y-m-d H:i:s");

if($condiciones==1){
    $condiciones1=" en efectivo";
}
if($condiciones==2){
    $condiciones1=" en cheque";
}
if($condiciones==3){
    $condiciones1=" por transferencia bancaria";
}

if($condiciones==4){
    $condiciones1=" al crédito a $moneda días";
}

$cuenta="Se vende mercaderias".$condiciones1;

$documento=mysqli_query($con, "UPDATE documento SET numero=numero+1 WHERE id_documento=$tipo");
        
$insert=mysqli_query($con,"INSERT INTO facturas VALUES ('','$numero_factura','$date','$id_cliente','$id_vendedor','$condiciones','$sumador_total','$deuda','$tipo','$c','1','1','$ser','1','$cuenta','','0','0','$moneda')");
$delete=mysqli_query($con,"DELETE FROM tmp WHERE session_id='".$session_id."'");




$accion1=mysqli_query($con, "select * from facturas where numero_factura='".$numero_factura."' and estado_factura='".$tipo."'");
$row1=mysqli_fetch_array($accion1);

$id_factura=$row1["id_factura"];
header("location:ver_factura.php?id_factura=$id_factura");


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

