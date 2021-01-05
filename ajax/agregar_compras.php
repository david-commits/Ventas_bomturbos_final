<?php
include('is_logged.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado
$session_id= session_id();
$session_name= $_SESSION['user_id'];
$nuevasesion_identificador = "";
$nuevasesion_identificador = $session_id.$session_name;
$identificadordecompra = 1;
if (isset($_POST['id'])){$id=$_POST['id'];}
if (isset($_POST['cantidad'])){$cantidad=$_POST['cantidad'];}
if (isset($_POST['precio_venta'])){$precio_venta=$_POST['precio_venta'];}
if (isset($_POST['stock'])){$stock=$_POST['stock'];}


	/* Connect To Database*/
	require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
	require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
	
if (!empty($id) and !empty($cantidad) and !empty($precio_venta) and ($cantidad>0) and ($precio_venta>0))
{
echo "<script>console.log('le pasamos todos los datos');</script>";
	$nrocount = 0 ;
	$sqlcount=mysqli_query($con, "SELECT count(*) as count from tmp where id_producto = ".$id." and session_id = '".$session_id."'"." and session_con_id = '".$nuevasesion_identificador."'"." and venta_compra = '".$identificadordecompra."'");

	while ($rowcount=mysqli_fetch_array($sqlcount))
	{
	$nrocount=$rowcount["count"];
	}

	if ($nrocount > 0) {
	echo "<script>alert('este producto ya existe en la cola');</script>";	
	}
	else
	{
echo "<script>console.log('registramos los datos');</script>";
		$insert_tmp=mysqli_query($con, "INSERT INTO tmp (id_producto,cantidad_tmp,precio_tmp,session_id,session_con_id,venta_compra,tienda) VALUES ('$id','$cantidad','$precio_venta','$session_id','$nuevasesion_identificador',$identificadordecompra, '1')");
	}
}
if (isset($_GET['id']))//codigo elimina un elemento del array
{
echo "<script>console.log('No le pasamos todos los datos');</script>";

$id_tmp=intval($_GET['id']);	
$delete=mysqli_query($con, "DELETE FROM tmp WHERE id_tmp='".$id_tmp."'");
}

?>
<table class="table">
<tr class="th-general">

	<th class="th-general" >Nro</th>
	<th class="th-general" >COD. PROVEEDOR.</th>
	<th class="th-general" >DESCRIPCIÓN</th>
	<th class="th-general" >CANT.</th>
	<th class="th-general" >PRECIO UNIT.</th>
	<th class="th-general" >PRECIO TOTAL</th>
	
	<th></th>
</tr>
<?php
	$sumador_total=0;
	$countAuto=1;
	$sql=mysqli_query($con, "select * from products, tmp where products.id_producto=tmp.id_producto and tmp.session_id='".$session_id."' and tmp.session_con_id='".$nuevasesion_identificador."' and venta_compra='".$identificadordecompra."' order by products.nombre_producto asc");

	while ($row=mysqli_fetch_array($sql))
	{
	$id_tmp=$row["id_tmp"];
	$codigo_producto=$row['codigoProveedor'];
	$cantidad=$row['cantidad_tmp'];
	$nombre_producto=$row['nombre_producto'];
	$precio_venta=$row['precio_tmp'];
	$precio_venta_f=number_format($precio_venta,2);//Formateo variables
	$precio_venta_r=str_replace(",","",$precio_venta_f);//Reemplazo las comas
	$precio_total=$precio_venta_r*$cantidad;
	$precio_total_f=number_format($precio_total,2);//Precio total formateado
	$precio_total_r=str_replace(",","",$precio_total_f);//Reemplazo las comas
	$sumador_total+=$precio_total_r;//Sumador
	
		?>
		<tr class="th-general">
			<td class="th-general" class='text-center' style="color: white!important;"><?php echo $countAuto;?></td>
			<td class="th-general" class='text-center' style="color: white!important;"><?php echo $codigo_producto;?></td>
			<td class="th-general" style="color: white!important;"><?php echo $nombre_producto;?></td>
			<td class="th-general" class='text-center' style="color: white!important;"><?php echo $cantidad;?></td>
			<td class="th-general" class='text-right' style="color: white!important;"><?php echo $precio_venta_f;?></td>
			<td class="th-general" class='text-right' style="color: white!important;"><?php echo $precio_total_f;?></td>
			<td class="th-general" class='text-center' style="color: white!important;"><a href="#" class='btn btn-danger btn-xs' onclick="eliminar('<?php echo $id_tmp ?>')"><i class="glyphicon glyphicon-trash"></i></a></td>
		</tr>		
		<?php

$countAuto = $countAuto +1;


	}
	$subtotal=number_format($sumador_total,2,'.','');
	$total_iva=($subtotal * TAX )/100;
	$total_iva=number_format($total_iva,2,'.','');
	$total_factura=$subtotal-$total_iva;

        if ($_SESSION['doc_ventas']==1) {   
?>
                
             
                
<tr class="th-general">
	<td class="th-general" class='text-right'  style="color: white!important;"></td>
	<td class="th-general" class='text-right' colspan=4 style="color: white!important;">SUBTOTAL</td>
	<td class="th-general" class='text-right' style="color: white!important;"><?php echo number_format($total_factura,2);?></td>
	<td></td>
</tr>
<tr class="th-general">
	<td class='text-right' style="color: white!important;"></td>
	<td class='text-right' colspan=4 style="color: white!important;">IGB (<?php echo 18?>)%</td>
	<td class='text-right' style="color: white!important;"><?php echo number_format($total_iva,2);?></td>
	<td></td>
</tr>

<?php
        }
?>


<tr class="th-general">
	<td class="th-general" class='text-right' style="color: white!important;"></td>
	<td class="th-general" class='text-right' colspan=4 style="color: white!important;">TOTAL</td>
	<td class="th-general" class='text-right' style="color: white!important;"><?php echo number_format($subtotal,2);?></td>
	<td></td>
</tr>

</table>
