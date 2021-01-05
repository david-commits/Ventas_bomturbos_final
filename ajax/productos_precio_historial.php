<style type="text/css">
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

</style>
<?php

	include('is_logged.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado
	/* Connect To Database*/
	require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
	require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
	
	$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
	if($action == 'ajax'){
		// escaping, additionally removing everything that could be (html/javascript-) code
		$arrayproq = explode(" ", $_REQUEST['q']);
		$conarray = count($arrayproq);
		$escogemosid = $_REQUEST['q'];
	
         $q = mysqli_real_escape_string($con,(strip_tags($_REQUEST['q'], ENT_QUOTES)));

		 $aColumns = array('codigoOriginal' ,'codigoProveedor','medida','nombre_producto');//Columnas de busqueda
		 $sTable = "products";
		$nucarray = count($aColumns) - 1;
	
		 $queryhistorial = "SELECT * FROM producto_detalle where id_producto =".$escogemosid." ";

		include 'pagination.php'; //include pagination file
		//pagination variables
		$page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
		$per_page = 5; //how much records you want to show
		$adjacents  = 4; //gap between pages after number of adjacents
		$offset = ($page - 1) * $per_page;
		//Count the total number of row in your table*/
		$count_query   = mysqli_query($con, "SELECT count(*) AS numrows FROM detalle_precio_producto WHERE id_producto = ".$escogemosid."");
		$row= mysqli_fetch_array($count_query);
		$numrows = $row['numrows'];
		$total_pages = ceil($numrows/$per_page);
		$reload = './index.php';
		//main query to fetch the data
	
		$query = mysqli_query($con, $queryhistorial);
		//loop through fetched data
		if ($numrows>0){
			
			?>
			<div class="table-responsive">
				<h3>Historial de Precios Cambiados</h3>
			  <table class="table">
				<tr >
                                    <th class="th-general">Monto Cambiado</th>
                                    <th class="th-general">Tipo Cambio</th>
                                    <th class="th-general">Fecha</th>           
				</tr>
				<?php
				while ($row=mysqli_fetch_array($query)){
				

					$precioc=$row['monto_preciocambiado'];
					$preciotcp=$row['cambiado_mon_costo'];
					$created_at=$row['created_at'];
					
					?>
					<tr >


                                            <td class="th-general"><?php echo $precioc; ?></td><!-- codigo precio -->
                                            <td class="th-general"><?php echo $preciotcp; ?></td><!-- codigo precio -->
                                            <td class="th-general"><?php echo $created_at; ?></td><!-- codigo fecha de cambio -->                                            
					</tr>
					<?php
				}
				?>
				<tr>
					<td colspan=7><span class="pull-right"><?php
					 echo paginate($reload, $page, $total_pages, $adjacents);
					?></span></td>
				</tr>
			  </table>
			</div>
			<?php
		}
		else{
			?>
			<div><label>No se encontro registros</label></div>
			<?php
		}





	}

?>


