<?php 
session_start();
require_once ("config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
require_once ("config/conexion.php");

$q = $_POST['q11'];
$q = substr_replace( $q, "", -1 );
if (isset($q) && $q != "" && $q != " ") {
		
	$arrayproq = explode(" ", $q);
    $conarray = count($arrayproq);

    $aColumns = array( 'pr.nombre_producto', 'pr.codigoOriginal','pr.codigoProveedor', 'pr.medida', 'pr.codigo_producto');//Columnas de busqueda
	$sTable = "products";
    $nucarray = count($aColumns) - 1;
	$sWhere = "";

	if ( $conarray != 0){
      	$sWhere = "WHERE ";
      		for ($a=0; $a < $conarray ; $a++) { 
        	$sWhere .= " ( ";
        		for ( $i=0 ; $i<count($aColumns) ; $i++ ){
          		$sWhere .= $aColumns[$i]." LIKE '%".$arrayproq[$a]."%' ";
          			if ($i < $nucarray){
            			$sWhere .= "OR ";
          			}
        		}
        		$sWhere .= ") AND ";
      		}
      	$sWhere = substr_replace( $sWhere, "", -4 );
	}
	$sWhere.=" order by pr.nombre_producto desc";







	//Count the total number of row in your table*/

    if($q==""){
      $count_query   = mysqli_query($con, "SELECT count(*) AS numrows FROM products WHERE pro_ser=1");
    }else{
      $count_query   = mysqli_query($con, "SELECT count(*) AS numrows FROM products pr inner join clientes cli $sWhere");
    }

    $row= mysqli_fetch_array($count_query);
	$numrows = $row['numrows'];
	
	//main query to fetch the data
		if($q==""){
   
      $sql="SELECT pr.*,tp.*, pr.codigoProveedor as nomcodio, mr.nombre_marca AS marca FROM products pr inner join marca mr on mr.id_marca=pr.id_marca  inner join tipo tp on tp.id_tipo=pr.id_tipo WHERE pro_ser=1 ";
    }else{ 
    
      $sql="SELECT pr.*,tp.*, pr.codigoProveedor as nomcodio, mr.nombre_marca AS marca  FROM products pr inner join marca mr on mr.id_marca=pr.id_marca  inner join tipo tp on tp.id_tipo=pr.id_tipo  $sWhere ";
    }

		$query = mysqli_query($con, $sql);
	
	if (isset($_POST['datos_cotizacion'])) 
	{
		// NOMBRE DEL ARCHIVOY CHARSET
		header('Content-Type:text/xls');
		header('Content-Disposition: attachement; filename=Reporte_Excel.xls');
		?>
		<table>
			<thead>
				<tr>
					<th>Codigo Original</th>
					<th>Codigo Proveedor</th>
					<th>Descripción</th>
					<th>Stock</th>
					<th>Marca</th>
					<th>Medida</th>
					<th>Precios</th>
				
				
				</tr>
			</thead>
			<tbody>
		<?php
	
		while ($row=mysqli_fetch_array($query)){
		            $codigo_original=$row['codigoOriginal'];
		            $codigoProveedor=$row['nomcodio'];
					$nombre_producto=$row['nombre_producto'];

					if ($_SESSION['tienda']==1){
		                $b=$row['b1'];
		            }elseif($_SESSION['tienda']==2){
		                $b=$row['b2'];
		            }elseif($_SESSION['tienda']==3){
		            	$b=$row['b3'];
		            }

		            $marcaNombre=$row['marca'];
		            $ubicacionproduc=$row['detalle'];
		            $catproduc=$row['cat_pro'];
		            $tipoarticuloproduc=$row['id_tipo'];
		            $medida=$row['medida'];
		            $dolar=$row['mon_costo'];

					if ($dolar==1){
		                $mon="S/";
		            }else{
		                $mon="S/";
		            }

		            $precio_producto=$row['precio_producto'];
					$mntp = number_format($precio_producto,2);
					$cadmtnp = $mon." ".$mntp;
?>
				<tr>
					<td><?php echo $codigo_original; ?></td>
					<td><?php echo $codigoProveedor; ?></td>
					<td><?php echo $nombre_producto; ?></td>
					<td><?php echo $b; ?></td>
					<td><?php echo $marcaNombre; ?></td>
					<td><?php echo $medida; ?></td>
					<td><?php echo $cadmtnp; ?></td>

					<!--<td><?php echo $ubicacionproduc; ?></td>
					<td><?php echo $catproduc; ?></td>
					<td><?php echo $tipoarticuloproduc; ?></td>-->
				</tr>
<?php
				}
	}

	
}
else
{

	if (isset($_POST['datos_cotizacion'])) 
	{

		// NOMBRE DEL ARCHIVOY CHARSET
		header('Content-Type:text/xls');
		header('Content-Disposition: attachement; filename=Reporte_Excel.xls');
		?>
		<table>
			<thead>
				<tr>
					<th>Código Original</th>
					<th>Código Proveedor</th>
					<th>Descripción</th>
					<th>Stock</th>
					<th>Marca</th>
					<th>Medida</th>
					<th>Precios</th>
					<th>Ubicación</th>
					<th>Categoria</th>
					<th>Tipo de Articulo</th>
					<th>Tipo de Cambio</th>
				</tr>
			</thead>
			<tbody>
<?php
				$sql="SELECT pr.*,tp.*, pr.codigoProveedor as nomcodio, mr.nombre_marca AS marca, mo.descripcion_modelo AS modelo, tp.tipo as nombretipo, catt.nom_cat as nombrecategoria FROM products pr inner join marca mr on mr.id_marca=pr.id_marca inner join modelos mo on mo.id_modelo=pr.id_modelo inner join tipo tp on tp.id_tipo=pr.id_tipo inner join categorias catt on catt.id_categoria = pr.cat_pro WHERE pro_ser=1";

				$query = mysqli_query($con, $sql);
				while ($row=mysqli_fetch_array($query)){
		            $codigo_original=$row['codigoOriginal'];
		            $codigoProveedor=$row['nomcodio'];
					$nombre_producto=$row['nombre_producto'];

					if ($_SESSION['tienda']==1){
		                $b=$row['b1'];
		            }elseif($_SESSION['tienda']==2){
		                $b=$row['b2'];
		            }elseif($_SESSION['tienda']==3){
		            	$b=$row['b3'];
		            }

		            $marcaNombre=$row['marca'];
		            $medida=$row['medida'];
		            $dolar=$row['mon_costo'];


		            $ubicaciondetalle=$row['detalle'];
		            $categoriaproduc=$row['nombrecategoria'];
		            $idtipoproduc=$row['nombretipo'];

		            $tipocambioproducto=$row['tcp_compra'];



		            $idproductoaconsultar=$row['id_producto'];
		            $montotipodecambio = 0 ;
		            $sqltraertcp="SELECT * FROM producto_detalle WHERE id_producto= ".$idproductoaconsultar." order by id desc LIMIT 1";
	$querytraertcp = mysqli_query($con, $sqltraertcp);
	$countquerytctcp = mysqli_num_rows($querytraertcp);

				if ($countquerytctcp > 0) {
							while ($rowtraertcp=mysqli_fetch_array($querytraertcp)){
									$traertcccp = $rowtraertcp['cambiado_mon_costo'];
									if ($traertcccp > 0 and $traertcccp != null) {
										$montotipodecambio = $traertcccp;
									}else
									{
										$montotipodecambio = $tipocambioproducto;
									}
								}
				}
				else
				{
				$montotipodecambio = $tipocambioproducto;
				}

		


					if ($dolar==1){
		                $mon="S/";
		            }else{
		                $mon="S/";
		            }

		            $precio_producto=$row['precio_producto'];
					$mntp = number_format($precio_producto,2);
					$cadmtnp = $mon." ".$mntp;
?>
				<tr>
					<td><?php echo $codigo_original; ?></td>
					<td><?php echo $codigoProveedor; ?></td>
					<td><?php echo $nombre_producto; ?></td>
					<td><?php echo $b; ?></td>
					<td><?php echo $marcaNombre; ?></td>
					<td><?php echo $medida; ?></td>
					<td><?php echo $cadmtnp; ?></td>

					<td><?php echo $ubicaciondetalle; ?></td>
					<td><?php echo $categoriaproduc; ?></td>
					<td><?php echo $idtipoproduc; ?></td>
					<td><?php echo $montotipodecambio; ?></td>
				</tr>
<?php
				}
?>
			</tbody>
		</table>
<?php		
	}
	else{

}}
?>