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
		// escaping, additionally removing everything that could be (html/javascript-) code
         $q = mysqli_real_escape_string($con,(strip_tags($_REQUEST['q'], ENT_QUOTES)));
		 $aColumns = array('codigo_producto', 'nombre_producto');//Columnas de busqueda
		 $sTable = "products";
		 $sWhere = "";
		if ( $_GET['q'] != "" )
		{
			$sWhere = "WHERE (";
			for ( $i=0 ; $i<count($aColumns) ; $i++ )
			{
				$sWhere .= $aColumns[$i]." LIKE '%".$q."%' OR ";
			}
			$sWhere = substr_replace( $sWhere, "", -3 );
			$sWhere .= ')';
		}
		include 'pagination.php'; //include pagination file
		//pagination variables
		$page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
		$per_page = 5; //how much records you want to show
		$adjacents  = 4; //gap between pages after number of adjacents
		$offset = ($page - 1) * $per_page;
		//Count the total number of row in your table*/
		$count_query   = mysqli_query($con, "SELECT count(*) AS numrows FROM $sTable  $sWhere");
		$row= mysqli_fetch_array($count_query);
		$numrows = $row['numrows'];
		$total_pages = ceil($numrows/$per_page);
		$reload = './index.php';
		//main query to fetch the data
		$sql="SELECT * FROM  $sTable $sWhere LIMIT $offset,$per_page";
		$query = mysqli_query($con, $sql);
		//loop through fetched data
		if ($numrows>0){
			
			?>
			<div class="table-responsive">
			  <table class="table">
				<tr  class="warning">
                                    <th>Foto</th>
					<th>Código</th>
					<th>Producto</th>
					<th><span class="pull-right">Cant.</span></th>
					<th><span class="pull-right">Precio</span></th>
                                        <th><span class="pull-right">Stock</span></th>
					<th class='text-center' style="width: 36px;">Agregar</th>
				</tr>
				<?php
				while ($row=mysqli_fetch_array($query)){
					$id_producto=$row['id_producto'];
					$codigo_producto=$row['codigo_producto'];
					$nombre_producto=$row['nombre_producto'];
                                        $foto=$row['foto1'];
                                        //$nombre_producto=$row['nombre_producto'];
                                        if ($_SESSION['tienda']==1){
                                                $b=$row['b1'];}
                                                elseif($_SESSION['tienda']==2){
                                                $b=$row['b2'];}
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
                                        
                                        
					$precio_venta=$row["precio_producto"];
					$precio_venta=number_format($precio_venta,2);
					?>
					<tr style="background-color: #81F7BE;color:black;">
						<td>
                                                
                                                 <a class="thumbnail1">
          <img  class="imagen2" src="fotos/<?php echo $foto;?>" width="50" height="50" border="0" />
      <span><img src="fotos/<?php echo $foto;?>" class="imagen2" width="300" height="300" border="0" /></span>
      
      </a>  
                                                
                                                
                                                </td>
                                            
                                                
                                                
                                                
                                                <td><?php echo $codigo_producto; ?></td>
						<td><?php echo $nombre_producto; ?></td>
						<td class='col-xs-1'>
						<div class="pull-right">
						<input type="text" class="form-control" style="text-align:right" id="cantidad_<?php echo $id_producto; ?>"  value="" >
						</div></td>
						<td class='col-xs-2'><div class="pull-right">
						<input type="search" class="form-control" style="text-align:center" id="precio_venta_<?php echo $id_producto; ?>"  value="<?php echo $precio_venta;?>" >
                                                
                                                    </div></td>
                                               <td class='col-xs-2'><div class="pull-right"><input type="text" class="form-control" style="text-align:right" disabled id="stock_<?php echo $id_producto; ?>" value="<?php echo $b;?>"></div></td>
						<td class='text-center'><a class='btn btn-info'href="#" onclick="agregar('<?php echo $id_producto ?>')"><i class="glyphicon glyphicon-plus"></i></a></td>
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
	}
?>