<style type="text/css">
   .thumbnail1{
	position: relative;
	z-index: 0;}
	.thumbnail1:hover{
	background-color: transparent;
	z-index: 50;}
	.thumbnail1 span{ /*Estilos del borde y texto*/
	position: absolute;
	background-color: white;
	padding: 5px;
	left: -100px;
	visibility: hidden;
	color: #FFFF00;
	text-decoration: none;}
	.thumbnail1 span img{ /*CSS for enlarged image*/
	border-width: 0;
	padding: 2px;}
	.thumbnail1:hover span{ /*CSS for enlarged image on hover*/
	visibility: visible;
	top: 17px;
	left: 60px; /*position where enlarged image should offset horizontally */} 
	img.imagen2{
	padding:4px;
	border:3px #0489B1 solid;
	margin-left: 2px;
	margin-right:5px;
	margin-top: 5px;
	float:left;}
</style>
<?php
	/*-------------------------
	Autor: Obed Alvarado
	Web: obedalvarado.pw
	Mail: info@obedalvarado.pw
	---------------------------*/
	include('is_logged.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado
	/* Connect To Database*/
	require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
	require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
	$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';


	if($action == 'ajax'){

//  $borrarTMP=mysqli_query($con, "truncate table tmp");
		
		// escaping, additionally removing everything that could be (html/javascript-) code
		$arrayproq = explode(" ", $_REQUEST['q']);
		$conarray = count($arrayproq);
        $q = mysqli_real_escape_string($con,(strip_tags($_REQUEST['q'], ENT_QUOTES)));
        $q1 = $_REQUEST['q1'];
        $q2 = $_REQUEST['q2'];
		$sTable = "products";
			include 'pagination.php'; //include pagination file
		//pagination variables
		$page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
		$per_page = 5; //how much records you want to show
		$adjacents  = 4; //gap between pages after number of adjacents
		$offset = ($page - 1) * $per_page;
        if ($q == "" || $q == " " || $q == null) 
        {
			$sql="SELECT pr.*, pr.codigoProveedor as nomcodio FROM products pr order by pr.nombre_producto ASC LIMIT $offset,$per_page";

			if ($q1 == 0 || $q1 == "" || $q1 == " " || $q1 == null) 
			{//existe q1
				if ($q2 == 0 || $q2 == "" || $q2 == " " || $q2 == null) 
				{//existe q2 pero no q1
					$sWhere = "";
				}
				else
				{//no existe q2 ni q1
					$sWhere = "WHERE  pr.id_modelo =".$q2."";
				}
			$sql="SELECT pr.*, pr.codigoProveedor as nomcodio FROM products pr $sWhere order by pr.nombre_producto ASC LIMIT $offset,$per_page";

			}
			else
			{//no existe q1
				if ($q2 == 0 || $q2 == "" || $q2 == " " || $q2 == null) 
				{//existe q2
					$sWhere = "WHERE pr.id_marca =".$q1."";
				}
				else
				{//no existe q2 pero si q1
					$sWhere = "WHERE pr.id_marca =".$q1." AND pr.id_modelo = ".$q2."";
				}
				$sql="SELECT pr.*, pr.codigoProveedor as nomcodio FROM products pr $sWhere order by pr.nombre_producto ASC LIMIT $offset,$per_page";

			}
        }

        else
        {
         	$aColumns = array('pr.codigoOriginal' ,'pr.codigoProveedor','pr.medida','pr.nombre_producto');//Columnas de busqueda
			$nucarray = count($aColumns) - 1;
		 	$sWhere = "";
			if ( $conarray != 0){
				$sWhere = "WHERE ";
				for ($a=0; $a < $conarray ; $a++) { 
					$sWhere .= " ( ";
					for ( $i=0 ; $i<count($aColumns) ; $i++ ){
						$sWhere .= $aColumns[$i]." LIKE '%".$arrayproq[$a]."%' ";
						if ($i < $nucarray) {
							$sWhere .= " OR ";
						}
					}
					$sWhere .= " ) AND ";
				}
				$sWhere = substr_replace( $sWhere, "", -4 );
			}
		$sql="SELECT pr.*, pr.codigoProveedor as nomcodio FROM products pr  $sWhere order by pr.nombre_producto ASC LIMIT $offset,$per_page";
         }
	
		//Count the total number of row in your table*/
		$count_query   = mysqli_query($con, "SELECT count(*) AS numrows FROM products pr inner join proveedores cli $sWhere");
		$row= mysqli_fetch_array($count_query);
		$numrows = $row['numrows'];
		$total_pages = ceil($numrows/$per_page);
		$reload = './index.php';
		//main query to fetch the data
		$query = mysqli_query($con, $sql);
		//loop through fetched data
		if ($numrows>0){
			?>
			<div class="table-responsive">
			  <table class="table">
				<tr>
                    <th class="th-general">Nro.</th>   
                    <th class="th-general">Foto</th>   
					<th class="th-general">Código Proveedor</th>
					<th class="th-general">Código Original</th>
					<th class="th-general">Producto</th>
					<th class="th-general">Cant.</th>
					<th class="th-general">Costo</th>
                    <th class="th-general">Stock</th>
					<th class="th-general">Agregar</th>
				</tr>
				<?php
				$countnn = 1 ;
				while ($row=mysqli_fetch_array($query)){
					$id_producto=$row['id_producto'];
					$cod_original=$row['codigoOriginal'];
					$detalle_ubicacion=$row['detalle'];
					$pmedida=$row['medida'];
					$codigo_producto=$row['nomcodio'];
					$codigo_alternativo=$row['codigoAlternativo'];
					$nombre_producto=$row['nombre_producto'];
                    $foto=$row['foto1'];
                    //$nombre_producto=$row['nombre_producto'];
                    if ($_SESSION['tienda']==1){
                        $b=$row['b1'];}
                    elseif($_SESSION['tienda']==2){
                        $b=$row['b2'];}
                    elseif($_SESSION['tienda']==3){
                        $b=$row['b3'];}
                    elseif($_SESSION['tienda']==4){
                        $b=$row['b4'];}
                    elseif($_SESSION['tienda']==5){
                        $b=$row['b5'];}
                    elseif($_SESSION['tienda']==6){
                        $b=$row['b6'];}

					$precio_venta=$row["costo_producto"];
					$precio_venta=number_format($precio_venta,2);
					?>
				<tr>
					<td class="th-general"><?php echo $countnn; ?></td>
					<td class="th-general">
                	    <?php if ($foto): ?>
                            <a class="thumbnail1"><img  class="imagen2" src="fotos/<?php echo $foto;?>" width="50" height="50" border="0" />
      						<span><img src="fotos/<?php echo $foto;?>" class="imagen2" width="300" height="300" border="0" /></span>
      						</a>  
                        <?php else: ?>	
                        <?php endif ?>                                  
                    </td>
                    <td class="th-general"><?php echo $codigo_producto; ?></td><!-- codigo proveedor -->
                    <td class="th-general"><?php echo $cod_original; ?></td><!-- codigo Original -->

					<td class="th-general"><a style="color:#FFFFFF;" id="<?php echo $id_producto; ?>" href="#modal-ide" data-toggle="modal"  onclick="func_archivo('<?php echo $cod_original; ?>','<?php echo $detalle_ubicacion; ?>','<?php echo $pmedida;?>')" ><?php echo $nombre_producto; ?></a></td>

					<td class='col-xs-1 th-general'><div class="pull-right"><input type="number" class="form-control estilo-placeholder" style="text-align:right" id="cantidad_<?php echo $id_producto; ?>"></div></td><!-- cant. -->

					<!--onkeypress="return check(event)"-->

					<td class='col-xs-2 th-general'>
						<div class="pull-right">
						 <input type="text" class="form-control estilo-placeholder" style="text-align:right; height: 25px;"  id="precio_venta_<?php echo $id_producto; ?>"  value="0">
						 <input readonly="true" type="text" class="form-control estilo-placeholder" style="text-align:right; height: 25px;" value="$<?php echo $precio_venta;?>" >
						</div>
					</td><!-- costo -->
                    <td class='col-xs-2 th-general'><div class="pull-right"><input type="text" class="form-control estilo-placeholder" style="text-align:right" disabled id="stock_<?php echo $id_producto; ?>" value="<?php echo $b;?>"></div></td><!-- stock -->
					<td class='text-center th-general'><a class='btn btn-info'href="#" onclick="agregar('<?php echo $id_producto ?>')"><i class="glyphicon glyphicon-plus"></i></a></td>
				</tr>
<?php
$countnn = $countnn + 1;
		}
?>
				<tr>
					<td class="th-general" colspan=9><span class="pull-right " ><?php echo paginate($reload, $page, $total_pages, $adjacents);?></span></td>
				</tr>
			</table>
		</div>
<?php
		}
	}
?>
<script type="text/javascript">
func_archivo = function(coriginal, ubi, pmedida)
{
  $('#modal-body').empty();
  var ccoriginal = "<b>Código Original : </b> "+coriginal+" <br><br>";
  var pmed = "<b>Medidas : </b> "+pmedida+" <br><br>";
  var cubi = "<b>Ubicación : </b> "+ubi+" <br><br>";
  $('#modal-body').append(ccoriginal + pmed +cubi );
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
      <!--  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>-->
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
	function check(e) {
    tecla = (document.all) ? e.keyCode : e.which;

    //Tecla de retroceso para borrar, siempre la permite
    if (tecla == 8) {
        return true;
    }

    // Patron de entrada, en este caso solo acepta numeros y letras
    patron = /[A-Za-z0-9]/;
    tecla_final = String.fromCharCode(tecla);
    return patron.test(tecla_final);
}
</script>