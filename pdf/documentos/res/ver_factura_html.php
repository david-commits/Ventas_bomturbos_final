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
  tr.border_bottom td {
  border:1px solid black;
  color:black;
  }
  #border_bottom2 {
  border:1px solid black;
  color:black;
  }
  #border_bottom3 {
  border:1px solid black;
  color:black;
  }
  tr.border_bottom1 td {
  border-left:1px solid black;
  }
  tr.border_bottom4 td {
  border-left:1px solid black;
  border-bottom: 1px solid black;
  }
  table.page_footer {width: 100%; border: none; background-color: white; padding: 2mm;border-collapse:collapse; border: none;}
  }
  td{
    font-size: 10px!important;
  }
</style>

<?php

  require 'phpqrcode/qrlib.php';
  $dir = '../temp/';
  if(!file_exists($dir))
	 mkdir($dir);
  $filename = $dir.'test.png';      
  $sql_factura1=mysqli_query($con,"select * from guia where id_doc='".$id_factura."'");
  $rw_factura1=mysqli_fetch_array($sql_factura1);
  if(isset($rw_factura1['guia'])){
    $guia=$rw_factura1['guia'];
  }else{
    $guia='-';
  }
         
  $sql_factura2=mysqli_query($con,"select * from users where user_id='".$id_vendedor."'");
  $rw_factura2=mysqli_fetch_array($sql_factura2);
  $vendedor=$rw_factura2['nombres'];
  $telefono=$rw_factura2['telefono'];
  $tienda1 = $_SESSION['tienda'];  
  $sql_factura2=mysqli_query($con,"select * from sucursal where tienda='".$tienda1."'");
  $rw_factura2=mysqli_fetch_array($sql_factura2);
  $logo=$rw_factura2['foto'];
  $dir=$rw_factura2['direccion'];
  $ruc=$rw_factura2['ruc'];
  $correo=$rw_factura2['correo'];

  $nombre=$rw_factura2['nombre'];

  if($tienda1==$tienda2){
?>    
  <page backtop="15mm" backbottom="15mm" backleft="15mm" backright="15mm" style="font-size: 12pt; font-family: arial" >
    
    <page_footer>
      <table class="page_footer">
        <tr>
          <td style="width: 100%; text-align: left">          
          </td>
        </tr>
      </table>
    </page_footer>
    
    <br>
    
<?php 
  $sql_cliente=mysqli_query($con,"select * from clientes where id_cliente='$id_cliente'");
	$rw_cliente=mysqli_fetch_array($sql_cliente);                           
  $sql_cliente1=mysqli_query($con,"select * from facturas where id_factura='$id_factura'");
	$rw_cliente1=mysqli_fetch_array($sql_cliente1);

    if($estado==1 or $estado==2 or $estado==5 or $estado==6){                 
      $tipo1="FACTURA";                 
      
      if($estado==2){
        $tipo1="BOLETA";                 
      }              
      if($estado==5){  
        $tipo1="NOTA DE DEBITO";
      }
      if($estado==6){  
        $tipo1="NOTA DE CREDITO";
      }
?>
  <table cellspacing="0" style="width: 100%; text-align: " border="0">
  	<tr>
      <td style="width: 30%; " height="10" >
		    <img src="<?php echo $logo;?>" width="250" height="100">	        
      </td>
      <td style="width: 35%; " align="right">
        <strong><?php echo $nombre;?></strong>	
        <br>
        <font style="font-size: 8pt;"><?php echo $dir;?></font>        
      </td>
      <td style="width: 40%; " height="10" align="center">
        <table border="1" cellspacing="0" style="width: 100%; text-align:center; font-size: 12pt; ">           
          <tr>
            <td align="center">
              <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font color="#04B4AE" size="7"><strong>R.U.C.<?php echo $ruc;?>
                               &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                               <br><?php echo $tipo1;?></strong></font>
           
               <br><font color="black" size="4"><strong></strong></font><font color="red" size="4"><strong><?php print"$folio-";echo $rw_cliente1['numero_factura'];?></strong></font>
               <br><br>
            </td>
          </tr>
        </table>
      </td>                
    </tr>
        
    <tr>
      <td colspan="3">           
        <font color="black"><strong>Señor(es):</strong></font>
		    <?php
          echo $rw_cliente['nombre_cliente'];      
        ?>
      </td>          

			<?php
        $dia=date("d",strtotime($rw_cliente1['fecha_factura']));
        $mes=date("m",strtotime($rw_cliente1['fecha_factura']));
        $ano=date("Y", strtotime($rw_cliente1['fecha_factura']));
        $mes2=mes1($mes);
        $ano1=$ano%1000;
      ?>
    </tr>
    <tr>
      <td height="20" colspan="3">
        <font color="black"><strong>Dirección:</strong></font>
		    <?php
          echo wordwrap($rw_cliente['direccion_cliente'],40,"<br>\n");         
        ?>	
		  </td>              
    </tr>     
    <tr>
      <td height="20">
        <font color="black"><strong>R.U.C.:</strong></font>
		    <?php
          echo $rw_cliente['doc'];      
        ?>	
      </td>
      <td>
        <font color="black"><strong>Fecha de Emisión:</strong></font><?php print" $dia/$mes/$ano";?>         
      </td>     
      <td width="200">
        <?php
          if($estado<=2){
            print'<font color="black"><strong>Nro de Guia:'.$guia.'</strong></font>'; 
          }
          if($estado>=5){
            print'<font color="black"><strong>Doc Modifica:</strong></font> '.$rw_cliente1['ot'].''; 
          }
        ?>  
		  </td>
    </tr>
    <tr>
      <td colspan="3">
        <?php
          $motivo=$rw_cliente1['obs'];
          if($estado==6){
            if($motivo=="01") {
               $r="ANULACION DE LA OPERACION";
            }
            if($motivo=="02") {
               $r="ANULACION POR ERROR EN EL RUC";
            }
            if($motivo=="03") {
               $r="CORRECION POR ERROR EN LA DESCRIPCION";
            }
            if($motivo=="04") {
               $r="DESCUENTO GLOBAL";
            }
            if($motivo=="05") {
               $r="DESCUENTO POR ITEM";
            } 
            if($motivo=="06") {
               $r="DEVOLUCION TOTAL";
            }
            if($motivo=="07") {
               $r="DEVOLUCION POR ITEM";
            }        
            if($motivo=="08") {
               $r="BONIFICACION";
            }
            if($motivo=="09") {
               $r="DISMINUCION EN EL VALOR";
            }
          }
          if($estado==5){
            if($motivo=="01") {
              $r="INTERES POR MORA";
            }    
            if($motivo=="02") {
              $r="AUMENTO EN EL VALOR";
            }       
            if($motivo=="03") {
              $r="PENALIDADES";
            }          
          }      
          if($estado>=5){
            print'<font color="black"><strong>Motivo:</strong></font>'.$r.''; 
          }        
        ?>
      </td> 
    </tr>
  </table>
  <?php
  }  
    if($estado==3){                       
      if($estado==3){  
        $tipo1="GUIA";
      }   
	?>  
      <table cellspacing="0" border="0" style="width: 100%; text-align: left; font-size: 10pt;">
        <tr>
          <td style="width:30%;"></td>
          <td style="width:20%;"></td>
          <td style="width:50%;"></td>
        </tr>
        <tr>
          <td  align="center">
		        <img src="<?php echo $logo;?>" width="120" height="70">	
          </td>
          <td>
          </td>
          <td align="center">
            <font color="#04B4AE"><strong><?php echo $nombre;?></strong></font>
            <br><font color="#04B4AE"><strong>RUC:<?php echo $ruc;?></strong></font>
            <br><font color="#04B4AE"><strong>GUIA <?php echo $rw_cliente1['numero_factura'];?></strong></font>
          </td>             
        </tr>
        <?php
          $dia=date("d",strtotime($rw_cliente1['fecha_factura']));
          $mes=date("m",strtotime($rw_cliente1['fecha_factura']));
          $ano=date("Y", strtotime($rw_cliente1['fecha_factura']));
          $mes2=mes1($mes);
          $ano1=$ano%1000;
        ?>
        <tr>
          <td colspan="2">      
            <font><strong>CLIENTE:<?php echo $rw_cliente['nombre_cliente'];?></strong></font>   
          </td>
          <td align="center">
            <font><strong>FECHA:<?php print" $dia/$mes/$ano";?></strong></font>   
          </td>          
        </tr>
      </table>
     
	    <br>
      <?php
      }  
      ?>
      <table cellspacing="0" style="width: 100%; height: 100%; text-align: left;border: 1px solid black;font-size: 10pt; margin-left: 0; padding-left: 0;" >  
		    <tr class="border_bottom">
			    <!-- <td style="width: 5%; font-size: 11px;" align="center">ITEM.</td> -->
          <td style="width: 6%; font-size: 11px;  " align="center">CANT.</td>
          <td style="width: 10%; font-size: 11px;  " align="center">COD. INTERNO</td>
          <td style="width: 55%; font-size: 11px;  " align="center">DESCRIPCION:</td>
          <td style="width: 13%; font-size: 11px;  " align="center">P.UNITARIO</td>
          <td style="width: 16%; font-size: 11px;  " align="center">    PRECIO TOTAL</td>
		    </tr>
      <?php
        $nums=1;
        $sumador_total=0;
        $sql1=mysqli_query($con, "select * from facturas where id_factura='".$id_factura."'");
        $row1=mysqli_fetch_array($sql1);
        $servicio=$row1["servicio"];
        $tipo1=$row1["estado_factura"];
        $id_cliente=$row1["id_cliente"];
        $numero_factura1=$row1["numero_factura"];

        $countquerydf = 0;
         $querycountdf=mysqli_query($con, "select count(*) from cabecera_orden co inner join detalle_cabecera dc on co.id = dc.id_cabecera_orden where co.nro_pre_orden = '".$numero_factura1."'");
        $countquerydf=mysqli_num_rows($querycountdf);    
   






        if($servicio==0){
        $sql=mysqli_query($con, "select * from products, detalle_factura, facturas where products.id_producto=detalle_factura.id_producto and detalle_factura.numero_factura=facturas.numero_factura and detalle_factura.numero_factura='$numero_factura1' and detalle_factura.tienda=$tienda1 and facturas.ven_com=detalle_factura.ven_com and detalle_factura.tipo_doc='".$tipo1."' and facturas.id_factura='".$id_factura."' and detalle_factura.id_cliente='".$id_cliente."'" );
        }else{
         $sql=mysqli_query($con, "select * from detalle_factura, facturas where detalle_factura.numero_factura=facturas.numero_factura and detalle_factura.numero_factura='$numero_factura1' and detalle_factura.tienda=$tienda1 and facturas.id_factura='".$id_factura."' and detalle_factura.tipo_doc='".$tipo1."' and detalle_factura.id_cliente='".$id_cliente."'" );   
        }

        $suma=0;
        $codigo_producto="";
        $r=1;
//var_dump($sql);
        while ($row=mysqli_fetch_array($sql)){
	        $id_producto=$row["id_producto"];

          $sqltraermarca = mysqli_query($con, "SELECT * FROM products where id_producto = ".$id_producto."");
          while ($sqltraermarcarow=mysqli_fetch_array($sqltraermarca)){
            $idmarcaproduc = $sqltraermarcarow['id_marca'];
                $detalle_produc=$sqltraermarcarow["detalle"];
            $sqltraermarcaname = mysqli_query($con, "SELECT * FROM marca where id_marca = ".$idmarcaproduc."");
            while ($sqltraermarcanrow=mysqli_fetch_array($sqltraermarcaname)){
              $id_inter = $id_producto.$sqltraermarcanrow['nombre_marca'];
            }
          }



	        if($servicio==0){
          
            $codigo_producto=$row['codigo_producto'];
        		$cantidad=$row['cantidad'];
        		$nombre_producto=$row['nombre_producto'];
          

          }else{
	          $cantidad=$row['cantidad'];
            $id_producto1=$row['id_producto'];  
            $inv_ini=$row['inv_ini'];
         
          $precio_ventaaa2 = 0 ;
            if($inv_ini>0){
              $sql2=mysqli_query($con, "select * from products where id_producto='".$id_producto1."'");
              $row2=mysqli_fetch_array($sql2);
              $nombre_producto=$row2["nombre_producto"];
	            $precio_venta=$row["precio_venta"];
              $precio_ventaaa2 = $row["precio_venta"];
            }else{
              $precio_ventaaa2 = $row["precio_venta"]; 
              $precio_venta=$row["precio_venta"];
              $nombre_producto=$row['id_producto'];  
            }

            if ($countquerydf > 0){
             //var_dump('aaaaaaa23232');
               $sql2obtenerprecio=mysqli_query($con, "select dc.* from cabecera_orden co inner join detalle_cabecera dc on co.id = dc.id_cabecera_orden where co.nro_pre_orden = '".$numero_factura1."' and id_producto ='".$id_producto1."' ");
                $row2obtprice=mysqli_fetch_array($sql2obtenerprecio);
                if(isset($row2obtprice["precio"])){
                  $precio_venta=$row2obtprice["precio"];
                }
                
            }
            if ($precio_venta > 0) {
              
            }else{
              $precio_venta = $precio_ventaaa2;
            }

          }
         
          $moneda=$row['moneda'];
        	$precio_venta_f=number_format($precio_venta,2);//Formateo variables
        	$precio_venta_r=str_replace(",","",$precio_venta_f);//Reemplazo las comas
        	$precio_total=$precio_venta_r*$cantidad;
        	$precio_total_f=number_format($precio_total,2);//Precio total formateado
        	$precio_total_r=str_replace(",","",$precio_total_f);//Reemplazo las comas
        	$sumador_total+=$precio_total_r;//Sumador

	        if($estado==3 OR $estado==5 OR $estado==6){ 
            if($suma<=20){
      ?>
        <tr class="border_bottom1">
          <!-- <td  height="10" align="center"><?php echo $r; ?></td> -->
          <td style="width: 6%;" height="" align="center"><?php echo $cantidad; ?></td>
          <td style="width: 14%;"  height="" align="center"><?php echo $id_inter; ?></td>
          <?php $nuevacadena = $nombre_producto.$codigo_producto;?>
          <td style="width: 54%;"><?php echo wordwrap($nuevacadena, 15,"<br>\n"); ?></td>
          <td style="width: 13%;" align="center"><?php echo $precio_venta_f;?></td>
          <td style="width: 11%;"align="center"><?php echo $precio_total_f;?></td>  
        </tr>
	    <?php 
        $suma=$suma+1;
        }
      }
	
        if($estado==1 or $estado==2){ 
          if($suma<=28){
      ?>

        <tr  class="border_bottom1">
          <!-- <td  height="" align="center"><?php echo $r; ?></td> -->
          <td style="width: 6%;"  height="" align="center"><?php echo $cantidad; ?></td>
          <td style="width: 14%;" height="" align="center"><?php echo $id_inter; ?></td>

          <?php $nuevacadena1 = $nombre_producto.$codigo_producto;?>
<td style="width: 54%;"><?php echo $nuevacadena1;?></td>
          <td   style="width: 13%;" >&nbsp; &nbsp; &nbsp;&nbsp; &nbsp;<?php echo $precio_venta_f;?></td>
          <td  style="width: 11%;">&nbsp; &nbsp; &nbsp;<?php echo $precio_total_f;?></td>
        </tr>
	    <?php 
        $suma=$suma+1;
        }
        }
        $r=$r+1;
        //fin 
	      }
        if($estado==3 OR $estado==5 OR $estado==6){
          for($i=$suma;$i<=20;$i++){
            $r1=1;
            if($i==20){
            $r1=4;
            }
      ?>
        <tr class="border_bottom<?php echo $r1;?>">
          <!-- <td></td> -->
          <td style="width: 2%;"></td>
          <td height="1">&nbsp;</td>
          <td></td>
          <td></td>
          <td></td>
        </tr>
	    <?php 
        }
        }
        if($estado==1 or $estado==2){
          for($i=$suma;$i<=28;$i++){
            $r1=1;
            if($i==28){
            $r1=4;
            }
      ?>
        <tr class="border_bottom<?php echo $r1;?>">
          <!-- <td>&nbsp;</td> -->
          <td style="width: 2%;"  height="1">&nbsp;</td>
          <td  height="1">&nbsp;</td>
          <td></td>
          <td></td>
          <td></td>
        </tr>
	    <?php 
        }
        }
	        $subtotal=number_format($sumador_total,2,'.','');	
	        $total_factura=number_format($sumador_total/1.18,2,'.','');
          $total_iva=number_format(0.18*$sumador_total/1.18,2,'.','');
          if($moneda==1){
            $mon="S/.";
            $mo1="SOLES";
            $mon2="S/.";
          }else{
            $mon="USD";
            $mo1="DOLARES";
            $mon2="&#36;";
          }
          if($estado==1 or $estado==5 or $estado==6){
            $decimales = explode(".",number_format($subtotal,2));
            $entera=explode(".",$subtotal);
            $texto=convertir($entera[0]).' y '. $decimales[1].'/100 '.$mo1;
      ?>      
        <tr>
          <td colspan="3" height="5">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;SON <?php echo $texto;?></td>
          <td align="left" id="border_bottom2"> SUBTOTAL :</td>
          <td id="border_bottom2" align="center">  <?php print"$mon2";echo number_format($total_factura,2);?></td>
        </tr>

        <tr>
          <!-- <td> </td> -->
          <td> </td>
          <td> </td>
          <td> </td>
          <td align="left" id="border_bottom2"> IGV 18% :</td>
          <td id="border_bottom2" align="center"> <?php print"$mon2";echo number_format($total_iva,2);?></td>
        </tr>
		    <tr>
          <td style=" border-bottom:  :1px solid black;"> </td>
          <!-- <td> </td> -->
          <td style=" border-bottom:  :1px solid black;"> </td>
          <td style=" border-bottom:  :1px solid black;"> </td>
          <td align="left" id="border_bottom2"> TOTAL :</td>
          <td id="border_bottom2" align="center"> <?php print"$mon2";echo number_format($subtotal,2);?></td>
        </tr>
       <!-- <tr>
          
          <td> </td>
          <td> </td>
          <td> </td>
          <td align="center" id="border_bottom2"> TOTAL:</td>
          <td id="border_bottom2" align="center"><?php print"$mon2";echo number_format($subtotal,2);?></td>
        </tr>-->
	    <?php
		    $tamanio = 10;
		    $level = 'Q';
		    $frameSize = 3;
		    $fechaqr = $dia . '/' . $mes . '/' .$ano;
		    $codigofinalqr = $ruc.'|01|' . $folio . '-' . $rw_cliente1['numero_factura'] . '|' . $total_iva . '|' . $subtotal . '|' . $fechaqr . '|06|' . $rw_cliente['doc'];
		    $contenido = 'Betsy te amo muchisimo';
		    QRcode::png($codigofinalqr, $filename, $level, $tamanio, $frameSize);
	    ?>
		    <tr>
			    <td colspan="3" style="width: 30%; " height="10" >
				  <img src="<?php echo $filename; ?>" width="150" height="150">	
			  </td>
        </tr>
      <?php
        }
        if($estado==2 or $estado==3 ){
      ?>
        <br>
        <tr>
          <!-- <td ></td> -->
          <td ></td>
          <td ></td>
          <td ></td>
          <td align="center" id="border_bottom2"> TOTAL:</td>
          <td style="font-size: 10px!important;" id="border_bottom3" align="center"><?php print"$mon2";echo number_format($subtotal,2);?></td>
        </tr>
      <?php
        }
      ?>
      </table>
	    <br>
    </page>
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
