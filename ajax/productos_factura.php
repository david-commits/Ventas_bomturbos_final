<!-- <style type="text/css">
   .thumbnail1{
position: relative;
z-index: 0;
}
.thumbnail1:hover{
background-color: transparent;
z-index: 50;
}
.thumbnail1 span{ /*Estilos del borde y texto*/
position: absolute;
background-color: white;
padding: 5px;
left: -100px;

visibility: hidden;
color: #FFFF00;
text-decoration: none;
}
.thumbnail1 span img{ /*CSS for enlarged image*/
border-width: 0;
padding: 2px;
}
.thumbnail1:hover span{ /*CSS for enlarged image on hover*/
visibility: visible;
top: 17px;
left: 60px; /*position where enlarged image should offset horizontally */
} 
img.imagen2{
padding:4px;
border:3px #0489B1 solid;
margin-left: 2px;
margin-right:5px;
margin-top: 5px;
float:left;
}

img.imagen4{
padding:4px;
border:3px #0489B1 solid;
margin-left: 5px;
margin-right:5px;
margin-top: 5px;
float:center;
}
td{
	color: white!important;
}
</style> -->
<?php
	include('is_logged.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado
	/* Connect To Database*/
	require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
	require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
	$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
    $inner="";
					$ctct1 = 0;

	if($action == 'ajax'){
		

		$arrayproq = explode(" ", $_REQUEST['q']);
		$arrayproq2 = explode(" ", $_REQUEST['q2']);
		$conarray2 = count($arrayproq2);
		$conarray = count($arrayproq);

		// escaping, additionally removing everything that could be (html/javascript-) code
        $q = mysqli_real_escape_string($con,(strip_tags($_REQUEST['q'], ENT_QUOTES)));
		$aColumns = array('id_producto', 'nombre_producto', 'medida');//Columnas de busqueda
		$ccolu = count($aColumns);
		$ccolu = $ccolu - 1;
		$sTable = "products";
		$sWhere = " ";
		$Marca=$_GET["marca"];
		$Modelo=$_GET["modelo"];
		$Motor=$_GET["motor"];
		$AnioCompa=$_GET["aniocompa"];
		$LitroCompa=$_GET["litrocompa"];
		$CategoriaCompa=$_GET["catecompa"];

		$inner = " pr inner join marca mc ON pr.id_marca = mc.id_marca ";
		



		if ($_REQUEST['marca'] != null || $_REQUEST['modelo'] != null || $_REQUEST['motor'] != '' || $_REQUEST['aniocompa'] != '' || $_REQUEST['litrocompa'] != '' || $_REQUEST['catecompa'] != '' || $_REQUEST['q'] != null || $_REQUEST['q2'] != null ) {

			$Marca = $_REQUEST['marca'];
			$Modelo = $_REQUEST['modelo'];
			$Motor = $_REQUEST['motor'];
			$AnioCompa=$_GET["aniocompa"];
			$LitroCompa=$_GET["litrocompa"];
			$CategoriaCompa=$_GET["catecompa"];
			$sWhere .= "WHERE pr.estado = 1";
			
			if ($_REQUEST['motor'] != '' || $_REQUEST['aniocompa'] != '' || $_REQUEST['litrocompa'] != ''  || $_REQUEST['marca'] != ''  || $_REQUEST['modelo'] != '' || $_REQUEST['q2'] != '' ) {
				$inner="pr INNER JOIN marca mc ON mc.id_marca=pr.id_marca inner join compatible cpt on cpt.id_producto=pr.id_producto inner join vehiculos vhc on vhc.d_vehiculo=cpt.id_vehiculo";
				# code...
			}
			else
			{
				$inner="pr INNER JOIN marca mc ON mc.id_marca=pr.id_marca";

			}


				// $inner="pr INNER JOIN compatible co ON co.id_producto=pr.id_producto INNER JOIN vehiculos vh ON vh.d_vehiculo=co.id_vehiculo INNER JOIN marca mc ON mc.id_marca=vh.id_marca";


					$ctct1 = strlen($sWhere);
					

					if(isset($CategoriaCompa) AND $CategoriaCompa!=""){
						if ($ctct1 == 20) {
							$sWhere.=" AND pr.cat_pro =$CategoriaCompa ";
						}else{
							$sWhere.=" AND pr.cat_pro =$CategoriaCompa ";
							$ctct1 = $ctct1 + 12;
						}
					}
					$ctct1 = strlen($sWhere);
					if(isset($Marca) AND $Marca!="" AND $Marca != 0){
						if ($ctct1 == 20) {
							$sWhere.=" AND vhc.id_marca=$Marca ";
						}
						else
						{
							$sWhere.=" AND vhc.id_marca=$Marca ";
							$ctct1 = $ctct1 + 12;
						}
					}
					$ctct1 = strlen($sWhere);
					if(isset($Modelo) AND $Modelo!="" AND $Modelo != 0){
						if ($ctct1 == 20){
							$sWhere.=" AND vhc.id_modelo=$Modelo ";
						}
						else
						{
							$sWhere.=" AND vhc.id_modelo=$Modelo ";
							$ctct1 = $ctct1 + 12;
						}
					}
					$ctct1 = strlen($sWhere);


					if(isset($Motor) AND $Motor!="" AND $Motor != " " AND $Motor != 0){
						if ($ctct1 == 20) {
							$sWhere.=" AND  vhc.motor='$Motor' ";
						}else{
							$sWhere.=" AND vhc.motor='$Motor' ";
							$ctct1 = $ctct1 + 12;
						}
					}
					$ctct1 = strlen($sWhere);

					if(isset($LitroCompa) AND $LitroCompa!="" AND $LitroCompa != " "){
						if ($ctct1 == 20) {
							$sWhere.=" AND vhc.combustible like '"."%".$LitroCompa."%"."' ";
						}else{
							$sWhere.=" AND vhc.combustible like '"."%".$LitroCompa."%"."' ";
							$ctct1 = $ctct1 + 12;
						}
					}
					$ctct1 = strlen($sWhere);
					if(isset($AnioCompa) AND $AnioCompa!="" AND $AnioCompa != " "){
						if ($ctct1 == 20) {
							$sWhere.=" AND vhc.anio like '"."%".$AnioCompa."%"."' ";
						}else
						{
							$sWhere.=" AND vhc.anio like '"."%".$AnioCompa."%"."' ";
							$ctct1 = $ctct1 + 21;
						}
					}
					$ctct1 = strlen($sWhere);


					if ( $_REQUEST['q'] != "" ){
					
							$sWhere .= " AND ";

						if ($ctct1 == 20) {
							for ($a=0; $a < $conarray ; $a++) { 
								$sWhere .=" concat( pr.id_producto, pr.nombre_producto, pr.medida, mc.nombre_marca, pr.codigoProveedor, pr.codigo_producto, pr.codigoOriginal, pr.codigoAlternativo ) LIKE '%".$arrayproq[$a]."%' AND ";
							}$sWhere = substr_replace( $sWhere, "", -4 );
						}else{
							for ($a=0; $a < $conarray ; $a++) { 
								$sWhere .=" concat( pr.id_producto, pr.nombre_producto, pr.medida, mc.nombre_marca, pr.codigoProveedor, pr.codigo_producto, pr.codigoOriginal, pr.codigoAlternativo ) LIKE '%".$arrayproq[$a]."%' AND ";
							}$sWhere = substr_replace( $sWhere, "", -4 );
							$ctct1 = $ctct1 + 21;
						}
					}

					if ( $_REQUEST['q2'] != "" ){
							$sWhere .= " AND "; 
					
						if ($ctct1 == 20) {
							for ($a=0; $a < $conarray2 ; $a++) { 
								$sWhere .=" concat( vhc.nombre_vehiculo, vhc.detalle ) LIKE '%".$arrayproq2[$a]."%' AND ";
							}$sWhere = substr_replace( $sWhere, "", -4 );
						}else{
							for ($a=0; $a < $conarray2 ; $a++) { 
								$sWhere .=" concat( vhc.nombre_vehiculo, vhc.detalle ) LIKE '%".$arrayproq2[$a]."%' AND ";
							}$sWhere = substr_replace( $sWhere, "", -4 );
							$ctct1 = $ctct1 + 21;
						}
					}

		}


		include 'pagination.php'; //include pagination file
		//pagination variables
		$page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
		$per_page = 10; //how much records you want to show
		$adjacents  = 4; //gap between pages after number of adjacents
		$offset = ($page - 1) * $per_page;
		//Count the total number of row in your table*/

$sqlll=  "SELECT count(pr.id_producto) AS numrows FROM $sTable $inner $sWhere";


		$count_query   = mysqli_query($con, $sqlll);
			
	
		$innerwhere = $inner.$sWhere;

		$row= mysqli_fetch_array($count_query);
		
		
		$numrows = $row['numrows'];
		$total_pages = ceil($numrows/$per_page);
		$reload = './index.php';
		//main query to fetch the data
		if($inner==""){
			$inner="pr INNER JOIN marca mc ON mc.id_marca=pr.id_marca";
		}


		$sql="SELECT DISTINCT pr.*, mc.* FROM  $sTable $inner $sWhere LIMIT $offset,$per_page";
		
		$sqlporcentaje="SELECT * FROM  constante WHERE estado = 1";

		//var_dump($sql);
		$query = mysqli_query($con, $sql);
		$queryporcentaje = mysqli_query($con, $sqlporcentaje);
		//loop through fetched data
		
		if ($numrows>0){
			
?>
			<div class="table-responsive">
			  <table class="table">
				<tr>
                    <th class="th-general">Fotos</th>
					<th class="th-general">Código interno</th>
					<th class="th-general">Descripción</th>
					<th class="th-general">Medida</th>
					<th class="th-general">Cant.</th>
					<th class="th-general">Precio Venta</th>
					<th class="th-general">Precio Compra</th>
                    <th class="th-general">Stock</th>
					<th class="th-general">Agregar</th>
				</tr>
<?php
				while ($rowporc=mysqli_fetch_array($queryporcentaje)) 
				{
					$traemoselporcentaje = $rowporc['monto'];
				}
				while ($row=mysqli_fetch_array($query)){
					$id_producto=$row['id_producto'];
					$codigo_producto=$row['codigo_producto'];
					$nombre_producto=$row['nombre_producto'];
					$medida=$row['medida'];
					$coriginal=$row['codigoOriginal'];
					$nombreMarca=$row['nombre_marca'];
					$detalleUbicacion=$row['detalle'];
					$codigoProveedor1=$row['codigoProveedor'];
                    $foto=$row['foto1'];




              $fotoprincipal=$row['fotoprincipal'];
              if($fotoprincipal == 1){
                $foto=$row['foto1'];
              
              }elseif ($fotoprincipal == 2) {
                $foto=$row['foto2'];
               
              }elseif ($fotoprincipal == 3) {
                $foto=$row['foto3'];
              
              }elseif ($fotoprincipal == 4) {
                $foto=$row['foto4'];
               
              }else{
                $foto='';
              }
              

 $foto1=$row['foto1'];
 $foto2=$row['foto2'];
 $foto3=$row['foto3'];
 $foto4=$row['foto4'];


                     	if ($_SESSION['tienda']==1){
                     	        $b=$row['b1'];
                     	}
                     	elseif($_SESSION['tienda']==2){
                     	        $b=$row['b2'];
                     	}
                     	elseif($_SESSION['tienda']==3){
                     	        $b=$row['b3'];
                     	}
                     	elseif($_SESSION['tienda']==4){
                     	        $b=$row['b4'];
                     	}
                     	elseif($_SESSION['tienda']==5){
                     	        $b=$row['b5'];
                     	}
                     	elseif($_SESSION['tienda']==6){
                     	        $b=$row['b6'];
                     	}             
					$precio_venta=$row["costo_venta_soles"];
					$precio_compra=$row["costo_soles"];
					
					// $precio_venta=number_format($precio_venta,2);

?>

				<tr>
<!--  1 -->
					<td class="th-general">
                    <?php if ($foto): ?>
                        <a class="" onclick="llamada('<?php echo $foto;?>', '<?php echo $foto1;?>', '<?php echo $foto2;?>', '<?php echo $foto3;?>','<?php echo $foto4;?>' )">
          					<img  class="imagen2" src="fotos/<?php echo $foto;?>" width="50" height="50" border="0" class="btn btn-primary" data-toggle="modal" href='#modal-id' />
      						<!--<span><img src="fotos/<?php echo $foto;?>"  class="imagen4"  border="0" alt="" width="420px"/></span>-->
      					</a>  
                    <?php else: ?>    	
                    <?php endif ?>
                    </td>   
<!--  1 -->
<!--  2 -->
                    <td class="th-general"><?php echo $id_producto.$nombreMarca; ?></td>
<!--  2 -->
<!--  3 -->
                    <td class="th-general"><a href="#modal-ide" id="<?php echo $id_producto; ?>" data-toggle="modal"  onclick="func_archivo('<?php echo $coriginal;?>', '<?php echo $detalleUbicacion;?>', '<?php echo $codigoProveedor1;?>')" ><?php echo $nombre_producto; ?></a>
                    </td>
<!--  3 -->
<!--  4 -->
					<td class="th-general"><?php echo $medida; ?></td>
<!--  4 -->
<!--  5 -->			
					<td class='col-xs-1 th-general'>
						<div class="pull-right">
							<input type="number" min="0" class="form-control estilo-placeholder pl-2 pr-0" id="cantidad_<?php echo $id_producto; ?>"  >
						</div>
					</td>
<!--  5 -->
<!--  6 -->
					<td class='col-xs-1 th-general'>
						<div class="pull-right">
							<input type="text" min="0" step="0.01" class="form-control estilo-placeholder" id="precio_venta_<?php echo $id_producto; ?>"  value="<?php echo $precio_venta;?>" >
							<input type="hidden" class="precio_venta_original"  value="<?php echo $precio_venta;?>" >
                        </div>
                    </td>

<!--  6 -->			<td class='col-xs-1 th-general'>
						<div class="pull-right">
							<input type="text" min="0" step="0.01" class="form-control estilo-placeholder" id="precio_compra_<?php echo $id_producto; ?>"  value="<?php echo $precio_compra;?>"  readonly>
							<input type="hidden" class="precio_compra_original"  value="<?php echo $precio_compra;?>" >
                        </div>
                    </td>
<!--  7 -->
					<td class='col-xs-1 th-general '><div ><input type="text" class="form-control estilo-placeholder" disabled id="stock_<?php echo $id_producto; ?>" value="<?php echo intval($b);?>"></div></td>
<!--  7 -->
<!--  8 -->	
					<td class=' th-general' class='text-center th-general'><a class='btn btn-info'href="#" onclick="agregar('<?php echo $id_producto ?>')"><i class="glyphicon glyphicon-plus"></i></a></td>
<!--  8 -->
			
				</tr>
<?php
				}
?>
				<tr>
					<td class=' th-general' colspan=9><span class="pull-right" ><?php
					 echo paginate($reload, $page, $total_pages, $adjacents);
					?></span>
					</td>
				</tr>
			</table>
		</div>
<?php
		}
		else{
echo('No se encontraron registros en la bùsqueda');
	}
			
	}
	else
	{
	
	}
?>
<script type="text/javascript">

func_archivo = function(codOriginal, detUbicacion, codProvee)
{
  $('#modal-body').empty();
  var codigo_original = "<b>Código Original : </b> "+codOriginal+" <br><br>";
  var detUbicacion = "<b>Ubicación del Producto : </b> "+detUbicacion+" <br><br>";
  var codigo_proveedor = "<b>Código Proveedor : </b> "+codProvee+" <br><br>";

  

  $('#modal-body').append(codigo_original+detUbicacion+codigo_proveedor);
}
</script>

<script type="text/javascript">
 llamada = function(link, link1, link2, link3, link4)
  {
var nuevoarraydefotos = new Array();






 var contadordefotos = 0;
    if (link != "" ) {
nuevoarraydefotos[contadordefotos] = link;
      contadordefotos = contadordefotos + 1;
    }
    if (link1 != "" ) {
nuevoarraydefotos[contadordefotos] = link1;
      contadordefotos = contadordefotos + 1;

    }
    if (link2 != "") {
nuevoarraydefotos[contadordefotos] = link2;
      contadordefotos = contadordefotos + 1;

    }
    if (link3 != "" ) {
nuevoarraydefotos[contadordefotos] = link3;
      contadordefotos = contadordefotos + 1;

    }
    if (link4 != "" ) {
nuevoarraydefotos[contadordefotos] = link4;
      contadordefotos = contadordefotos + 1;
    }


      console.log('array');
      console.log(nuevoarraydefotos);
      console.log('array');




var contcarrusel = "<ol class='carousel-indicators'>";
    var nuevoaumento = 0;


while(nuevoaumento < contadordefotos){
        if (nuevoaumento == 0) {
contcarrusel += " <li data-target='#myCarousel' data-slide-to='0' class='active'></li>";
      }else{
contcarrusel += " <li data-target='#myCarousel' data-slide-to='"+nuevoaumento+"'></li>";
      }
  nuevoaumento = nuevoaumento + 1;
}




 contcarrusel += "</ol>";
 contcarrusel += "  <div class='carousel-inner'>";
    var nuevoaumento1 = 0;

while(nuevoaumento1 < contadordefotos){
        if (nuevoaumento1 == 0) {
contcarrusel += "<div class='item active'><img src='fotos/"+nuevoarraydefotos[nuevoaumento1]+"' alt='Los Angeles' style='width:100%!important; height:100%!important'></div>";
      }else{
contcarrusel += "<div class='item'><img src='fotos/"+nuevoarraydefotos[nuevoaumento1]+"' alt='Chicag' style='width:100%!important; height:100%!important'></div>";
      }
  nuevoaumento1 = nuevoaumento1 + 1;
}


contcarrusel += "</div>";
contcarrusel += "<a class='left carousel-control' href='#myCarousel' data-slide='prev'><span class='glyphicon glyphicon-chevron-left'></span><span class='sr-only'>Previous</span></a><a class='right carousel-control' href='#myCarousel' data-slide='next'><span class='glyphicon glyphicon-chevron-right'></span><span class='sr-only'>Next</span></a>";

contcarrusel += "</div>";



  $('#myCarousel').empty();
   // var titulo="<span ><img src='fotos/"+link+"' class='imagen4' border='0' alt='' width='420px'/></span>   ";
     
     //*$('#modalbody').append(titulo);
     $('#myCarousel').append(contcarrusel);
  }
</script>


<div class="modal fade" id="modal-ide" >
  <div class="modal-dialog modal-dialog-scrollable" style="width: 630px!important;" >
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Pre visualizacion del Producto</h5>
      </div>
      <div class="modal-body" id="modal-body">
      </div>
      <div class="modal-footer">
        <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
      </div>
    </div>
  </div>
</div>



<div class="modal fade" id="modal-id" style="padding-left: 265px!important" >
  <div class="modal-dialog modal-dialog-scrollable" style="width: 630px!important; margin-left: 300px!important;" >
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Pre visualizacion del Producto</h5>
      </div>
      <div class="modal-body" id="modal-body" style="text-align: center;">
      		<div class="container" style="width: 50%!important; height: 50%!important;">
  			<h2></h2>  
  				<div id="myCarousel" class="carousel slide" data-ride="carousel">
				</div>
      	</div>
      	<div class="modal-footer">
        	
      	</div>
      </div>
      <div class="modal-footer">
        <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
      </div>
    </div>
  </div>
</div>



<style type="text/css">
	/* START TOOLTIP STYLES */
[tooltip] {
  position: relative; /* opinion 1 */
}

/* Applies to all tooltips */
[tooltip]::before,
[tooltip]::after {
  text-transform: none; /* opinion 2 */
  font-size: .9em; /* opinion 3 */
  line-height: 1;
  margin-left: 300px;
  user-select: none;
  pointer-events: none;
  position: absolute;
  display: none;
  opacity: 0;
}
[tooltip]::before {
  content: '';
  border: 5px solid transparent; /* opinion 4 */
  z-index: 1001; /* absurdity 1 */
}
[tooltip]::after {
  content: attr(tooltip); /* magic! */
  
  /* most of the rest of this is opinion */
  font-family: Helvetica, sans-serif;
  text-align: center;
  
  /* 
    Let the content set the size of the tooltips 
    but this will also keep them from being obnoxious
    */
  min-width: 10em;
  max-width: 50em;
  min-height: 10em;
  max-height: 50em;
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
  padding: 1ch 1.5ch;
  border-radius: .3ch;
  box-shadow: 0 1em 2em -.5em rgba(0, 0, 0, 0.35);
  background: #333;
  color: #fff;
  z-index: 1000; /* absurdity 2 */
}

/* Make the tooltips respond to hover */
[tooltip]:hover::before,
[tooltip]:hover::after {
  display: block;
}

/* don't show empty tooltips */
[tooltip='']::before,
[tooltip='']::after {
  display: none !important;
}

/* KEYFRAMES */
@keyframes tooltips-vert {
  to {
    opacity: .9;
    transform: translate(-50%, 0);
  }
}

@keyframes tooltips-horz {
  to {
    opacity: .9;
    transform: translate(0, -50%);
  }
}

/* FX All The Things */ 
[tooltip]:not([flow]):hover::before,
[tooltip]:not([flow]):hover::after,
[tooltip][flow^="up"]:hover::before,
[tooltip][flow^="up"]:hover::after {
  animation: tooltips-vert 300ms ease-out forwards;
}
table th{
	text-align: center!important;
}
</style>