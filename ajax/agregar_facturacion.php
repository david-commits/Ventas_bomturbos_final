<?php
	include('is_logged.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado
	$session_id= session_id();
	$session_name= $_SESSION['user_id'];
	$nuevasesion_identificador = "";
	$nuevasesion_identificador = $session_id.$session_name;
	$identificadordecompra = 2;
	if (isset($_POST['id'])){$id=$_POST['id'];}
	if (isset($_POST['cantidad'])){$cantidad=$_POST['cantidad'];}
	if (isset($_POST['precio_venta'])){$precio_venta=$_POST['precio_venta'];}
	if (isset($_POST['stock'])){$stock=$_POST['stock'];}
	// Cargo el tipo de Factura
	if (isset($_POST['tipoventa'])){$tipoventa=$_POST['tipoventa'];}
	/* Connect To Database*/
	require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
	require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
	
	if (!empty($id) and !empty($cantidad) and !empty($precio_venta) and ($cantidad>0) and ($precio_venta>0) and ($cantidad<=$stock))
	{
		$insert_tmp=mysqli_query($con, "INSERT INTO tmp (id_producto,cantidad_tmp,precio_tmp,session_id,session_con_id,venta_compra,tienda) VALUES ('$id','$cantidad','$precio_venta','$session_id','$nuevasesion_identificador','$identificadordecompra','1')");
	}
	if (isset($_GET['id']))//codigo elimina un elemento del array
	{
	$id_tmp=intval($_GET['id']);	
	$delete=mysqli_query($con, "DELETE FROM tmp WHERE id_tmp='".$id_tmp."'");
	}

?>
<table class="table">
  <thead>
  	
  <tr >
	<th class="th-general"style="color: white!important;" class='text-center'>CODIGO</th>
	<th  class="th-general"style="color: white!important;" class='text-center'>CANT.</th>
	<th class="th-general"style="color: white!important;" >DESCRIPCIÓN</th>
	<th class="th-general" style="color: white!important;" class='text-right'>PRECIO UNIT.</th>
	<th  class="th-general" style="color: white!important;"class='text-right'>PRECIO COMP.</th>
	<th  class="th-general"style="color: white!important;" class='text-right'>PRECIO TOTAL</th>
	<th class="th-general"style="color: white!important;" ></th>
  </tr>
  </thead>

<?php
	$sumador_total=0;
	$sumador_totalcosto=0;
	$sql=mysqli_query($con, "select * from tmp where tmp.session_id='".$session_id."' and session_con_id = '".$nuevasesion_identificador."' and venta_compra = '".$identificadordecompra."' ORDER BY  `tmp`.`id_tmp` ASC ");

	$traemoscdolar = "SELECT * FROM constante WHERE estado = 1";
	$sqldolar = mysqli_query($con, $traemoscdolar);
	$p_compra_sumatoraia = 0 ;
	while ($row=mysqli_fetch_array($sql))
	{
	$id_tmp=$row["id_tmp"];
	$id=$row["id_producto"];
	$cantidad=$row['cantidad_tmp'];
	$nombre_producto=$row["id_producto"];
        $codigo_producto="";
        if($id>0){
            $sql1=mysqli_query($con, "select * from products where id_producto='".$id."'");
            $row1=mysqli_fetch_array($sql1);
            $nombre_producto=$row1['nombre_producto'];
            $codigo_producto=$row1['codigo_producto'];
            $p_compra=$row1['costo_soles'];
            $p_compram = $p_compra * $cantidad;
            $p_compra_sumatoraia= $p_compra_sumatoraia+$p_compram;
            $sumador_totalcosto = $sumador_totalcosto + $p_compram;
        }
        echo "<script>$('#spanpreciocompra').html(".$p_compra_sumatoraia.");</script>";
	
	$precio_venta=$row['precio_tmp'];
	$precio_venta_f=$precio_venta;//Formateo variables
	$precio_venta_r=str_replace(",","",$precio_venta_f);//Reemplazo las comas
	$precio_total=$precio_venta_r*$cantidad;
	$precio_total_f=number_format($precio_total,2);//Precio total formateado
	$precio_total_r=str_replace(",","",$precio_total_f);//Reemplazo las comas
	$sumador_total+=$precio_total_r;//Sumador
	
		?>
		<tr >
			<td class="th-general" class='text-center' style="color: white!important;"><?php echo $codigo_producto;?></td>
			<td class="th-general" class='text-center cantidad' style="color: white!important;" style="background:white;"><?php echo $cantidad;?></td>
			<td class="th-general"style="color: white!important;"><?php echo $nombre_producto;?></td>
			<td class="th-general"style="color: white!important;" class='text-right' ><?php echo $precio_venta_f;?></td>
			<td class="th-general"style="color: white!important;" class='text-right  precio_compra' ><?php echo $p_compra;?></td>
			<td class="th-general"style="color: white!important;" class='text-right' ><?php echo $precio_total_f;?></td>
			<td class="th-general"style="color: white!important;" class='text-center'><a href="#" class='btn btn-danger btn-xs' onclick="eliminar('<?php echo $id_tmp ?>')"><i class="glyphicon glyphicon-trash"></i></a></td>
		</tr>		
		<?php

	while ($rowdolar=mysqli_fetch_array($sqldolar))
	{
		$prcntj = $rowdolar['monto'];
		$dolar = $rowdolar['dolar'];
	}



	}
	$procentajex = 0 ;
	// Si tiene IGV 
	
	$total_factura=number_format($sumador_total,2,'.','');
	echo "<script>$('#spanprecioventa').html(".$total_factura.");</script>";
	$procentajex = (($total_factura * 100)/$p_compra_sumatoraia);

	$procentajex = round($procentajex, 2);
	$procentajex = $procentajex - 100;
	echo "<script>$('#spanprecioporcentaje').html(".$procentajex.");</script>";




	$subtotal=($total_factura/1.18);
	$subtotal=number_format($subtotal,2,'.','');
	$total_iva=$total_factura-$subtotal;
	$total_iva=number_format($total_iva,2,'.','');
	//$total_factura=$subtotal-$total_iva;

        if ($_SESSION['doc_ventas']==1) {   
?>
                
             
                
<tr >
	<td style="color: white!important;" class="th-general"class='text-right' colspan=4 >SUBTOTAL</td>
	<td style="color: white!important;" class="th-general"id="dolarentra" class='text-right'><?php echo number_format($p_compra_sumatoraia,2);?></td>
	<td style="color: white!important;" class="th-general"class='text-right' ><?php echo number_format($subtotal,2);?></td>
	<td style="color: white!important;" class="th-general"></td>
	
</tr >
<tr >
	<td style="color: white!important;" class="th-general" class='text-right' colspan=4 >IGV (<?php echo 18?>)% </td>
	<td style="color: white!important;" class="th-general"></td>
	<td style="color: white!important;" class="th-general" class='text-right' ><?php echo number_format($total_iva,2);?></td>
	<td style="color: white!important;" class="th-general"></td>
</tr>

<?php
        }
		
		if ($_SESSION['doc_ventas']==7) {   
		
	$subtotal=number_format($sumador_total,2,'.','');
	$total_iva=0;
	$total_iva=number_format($total_iva,2,'.','');
	$total_factura=$subtotal-$total_iva;
	
?>
                
           
                
<tr >
	<td style="color: white!important;" class="th-general" class='text-right' colspan=4 >SUBTOTAL</td>
	<td  class="th-general"id="dolarentra"style="color: white!important;"  class='text-right' ><?php echo number_format($p_compra_sumatoraia,2);?></td>
	<td  style="color: white!important;" class="th-general"class='text-right' ><?php echo number_format($total_factura,2);?></td>
	<td style="color: white!important;" class="th-general"></td>
</tr >
<tr>
	<td style="color: white!important;"  class="th-general" class='text-right' colspan=4 >IGV	(<?php echo 18?>)% </td>
	<td style="color: white!important;" class="th-general"></td>
	<td style="color: white!important;"  class="th-general" class='text-right' ><?php echo number_format($total_iva,2);?></td>
	<td  style="color: white!important;" class="th-general"></td>
</tr>

<?php
        }
		
		
?>


<tr>
	<td style="color: white!important;"  class="th-general" class='text-right'  colspan=4 >TOTAL</td>
	<td  style="color: white!important;" class="th-general" id="dolarentra" class="dolarentra"></td>
	<td   style="color: white!important;"  class="th-general"id="total" class='text-right' ><?php echo number_format($total_factura,2);?></td>
	<td   style="color: white!important;"  class="th-general"id="sumador_totalcosto" class="sumador_totalcosto"></td>
</tr>

</table>

<?php 	
$multiplicamostodo = $sumador_totalcosto ;
$prcntj = (($prcntj * 1)/100);
$nuevoprcntj = $multiplicamostodo * $prcntj;
$multiplicamostodo = $multiplicamostodo + $nuevoprcntj;
	


if ($multiplicamostodo < $total_factura){
echo "<script>document.getElementById('consolidar').disabled = false;</script>";	
}else{
	 echo "<script>document.getElementById('consolidar').disabled = true;</script>"; 	  
}

?>
<style type="text/css">
	th
	{
		color: #343e59!important;
	}
	td
	{
		color: #343e59!important;
	}
</style>