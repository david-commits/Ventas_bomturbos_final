<style>
    tfoot {
        display: table-header-group;
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
	if (isset($_GET['id'])){
		$id_categoria=intval($_GET['id']);
		$query=mysqli_query($con, "select * from products where cat_pro='".$id_categoria."'");
		$count=mysqli_num_rows($query);
                
		if ($count==0){
			if ($delete1=mysqli_query($con,"DELETE FROM categorias WHERE id_categoria='".$id_categoria."'")){
			?>
			<div id="eliminaranunciosucursal" class="alert alert-success alert-dismissible" role="alert">
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			  <strong>Aviso!</strong> Datos eliminados exitosamente.
			</div>
			<?php 
		}else {
			?>
			<div id="eliminaranunciosucursal" class="alert alert-danger alert-dismissible" role="alert">
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			  <strong>Error!</strong> Lo siento algo ha salido mal intenta nuevamente.
			</div>
			<?php
			
		}
			
		} else {
			?>
			<div id="eliminaranunciosucursal" class="alert alert-danger alert-dismissible" role="alert">
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			  <strong>Error!</strong> No se pudo eliminar ésta categoria.Existen productos asignados a esta categoría. 
			</div>
			<?php
		}
		
		
		
	}
	if($action == 'ajax'){
		// escaping, additionally removing everything that could be (html/javascript-) code
         $q = mysqli_real_escape_string($con,(strip_tags($_REQUEST['q'], ENT_QUOTES)));
		 $aColumns = array('nombre');//Columnas de busqueda
		 $sTable = "sucursal";
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
		$sWhere.=" order by id_sucursal asc";
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
		$reload = './sucursal.php';
		//main query to fetch the data
		$sql="SELECT * FROM  $sTable $sWhere LIMIT $offset,$per_page";
		$query = mysqli_query($con, $sql);
		//loop through fetched data
		if ($numrows>0){
			
			?>
			<br>
			<div class="table-responsive">
			  <table class="table" id="example" class="display nowrap">
				<thead>
					
				<tr>
                                    <th class="th-general">Nro</th>
                                    <th class="th-general">Logo</th>
                                    <th class="th-general">Nombre</th>
                                	<th class="th-general">Ruc</th>
									<th class="th-general">Teléfono</th>
                                    <th class="th-general">Correo</th>
                                    <th class="th-general">Estado Sede</th>
                                	<th class="th-general">Acciones</th>
				</tr>
				</thead>
<tbody>
	
				<?php
                $ii = 1;
				while ($row=mysqli_fetch_array($query)){
						$id_sucursal=$row['id_sucursal'];
						$nombre=$row['nombre'];
						$id_sucursal_principal=$row['id_sucursal_principal'];
						$ruc=$row['ruc'];
                                                $direccion=$row['direccion'];
                                                $correo=$row['correo'];
						$telefono=$row['telefono'];
                                               $foto=$row['foto'];
                                               
                                               if($foto==""){
                                                   $foto1="logo.jpg";
                                               }else{
                                                  $foto1=$foto; 
                                               }
                                                $tien=$row['tienda'];
                                                
					?>
					
					<input type="hidden" value="<?php echo $nombre;?>" id="nombre<?php echo $id_sucursal;?>">
					<input type="hidden" value="<?php echo $ruc;?>" id="ruc<?php echo $id_sucursal;?>">
					<input type="hidden" value="<?php echo $direccion;?>" id="direccion<?php echo $id_sucursal;?>">
					<input type="hidden" value="<?php echo $correo;?>" id="correo<?php echo $id_sucursal;?>">
                                        <input type="hidden" value="<?php echo $telefono;?>" id="telefono<?php echo $id_sucursal;?>">
                                       
                                        <tr >
						<td class="th-general"><?php echo $ii; ?></td>
						<td style="border-bottom: 1px solid #27283d;" class="th-general"><img width="100" height="60" src="pdf/documentos/<?php echo $foto1; ?>"></td>
                        <td class="th-general"><?php echo $nombre; ?></td>
						<td class="th-general"><?php echo $ruc; ?></td>
                                                    <td class="th-general"><?php echo $telefono; ?></td>
                                                <td class="th-general"><?php echo $correo; ?></td>
                                                <td class="th-general"><?php if($id_sucursal_principal == 1){ echo "Principal";}else{  echo ""; } ?></td>
                                                
									<td class="th-general"><span>
					
                                              <a href="sucursal2.php?accion=<?php echo $tien;?>" class="btn btn-guardar btn-xs" title='Editar logo'><i class="fa fa-pencil"></i> </a>                                   
                                              <a href="#" class="btn btn-cancelar btn-xs" title='Editar sucursal' onclick="obtener_datos('<?php echo $id_sucursal;?>');" data-toggle="modal" data-target="#myModal2"><i class="fa fa-pencil"></i> </a> 
					</td>
						
					</tr>
					<?php
                    $ii = $ii + 1;
				}
				?>

				<tr style="border-bottom: 1px solid #27283d;">
					<td colspan=8>
						<span class="pull-right">
							<?PHP
					 echo paginate($reload, $page, $total_pages, $adjacents);
					?></span></td>
				</tr>
</tbody>
			  </table>
			</div>
			<?php
		}
	}
?>

