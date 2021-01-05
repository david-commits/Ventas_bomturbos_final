<!-- <style>
    table tr:nth-child(odd) {background-color: #FBF8EF;}
	table tr:nth-child(even) {background-color: #EFFBF5;}
	#valor1 {
	border-bottom: 2px solid #F5ECCE;
	}  
	#valor1:hover {          
	background-color: white;
	border-bottom: 2px solid #A9E2F3;
	} 
</style> -->

<?php

	include('is_logged.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado
	/* Connect To Database*/
	require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
	require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
	
	$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
	if (isset($_GET['id'])){
		$id_variable=intval($_GET['id']);
		$query=mysqli_query($con, "select * from asistencia where asistencia='".$id_variable."'");
		$count=mysqli_num_rows($query);
                
		if ($count==0){
			if ($delete1=mysqli_query($con,"DELETE FROM laborales WHERE id_laboral='".$id_variable."'")){
			?>
			<div class="alert alert-success alert-dismissible" role="alert">
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			  <strong>Aviso!</strong> Datos eliminados exitosamente.
			</div>
			<?php 
		}else {
			?>
			<div class="alert alert-danger alert-dismissible" role="alert">
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			  <strong>Error!</strong> Lo siento algo ha salido mal intenta nuevamente.
			</div>
			<?php
			
		}
			
		} else {
			?>
			<div class="alert alert-danger alert-dismissible" role="alert">
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			  <strong>Error!</strong> No se pudo eliminar ésta variable. 
			</div>
			<?php
		}
		
		
		
	}
	if($action == 'ajax'){
		// escaping, additionally removing everything that could be (html/javascript-) code
         $q = mysqli_real_escape_string($con,(strip_tags($_REQUEST['q'], ENT_QUOTES)));
		 $aColumns = array('variables','cod_var','des_var');//Columnas de busqueda
		 $sTable = "laborales";
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
		$sWhere.=" order by id_laboral desc";
		include 'pagination.php'; //include pagination file
		//pagination variables
		$page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
		$per_page = 10; //how much records you want to show
		$adjacents  = 4; //gap between pages after number of adjacents
		$offset = ($page - 1) * $per_page;
		//Count the total number of row in your table*/
		$count_query   = mysqli_query($con, "SELECT count(*) AS numrows FROM $sTable  $sWhere");
		$row= mysqli_fetch_array($count_query);
		$numrows = $row['numrows'];
		$total_pages = ceil($numrows/$per_page);
		$reload = './variableslab.php';
		//main query to fetch the data
		$sql="SELECT * FROM  $sTable $sWhere LIMIT $offset,$per_page";
		$query = mysqli_query($con, $sql);
		//loop through fetched data
		if ($numrows>0){
			
			?>
			<div class="table-responsive">
			  <table class="table">
				<thead>
					
				<tr>
					<th class="th-general">Nro</th>
					<th class="th-general">Color</th>
                   	<th class="th-general">Código</th>
					<th class="th-general">Nombre</th>
					<th class="th-general">Descripción</th>
                    <th class="th-general">Acciones</th>
				</tr>
				</thead>
<tbody>
	
				<?php
				$ii=1;
				while ($row=mysqli_fetch_array($query)){
						$id_laboral=$row['id_laboral'];
						$variables=$row['variables'];
						$des_var=$row['des_var'];
						$col_var=$row['col_var'];
                                               $cod_var=$row['cod_var'];
                                                
                                                
					?>
					
					<input type="hidden" value="<?php echo $variables;?>" id="variables<?php echo $id_laboral;?>">
					<input type="hidden" value="<?php echo $des_var;?>" id="des_var<?php echo $id_laboral;?>">
					<input type="hidden" value="<?php echo $cod_var;?>" id="cod_var<?php echo $id_laboral;?>">
					<input type="hidden" value="<?php echo $col_var;?>" id="col_var<?php echo $id_laboral;?>">
                                       
                                        <tr>
						<td class="th-general"><?php echo $ii; ?></td>
                                            
                                            <td bgcolor="<?php echo $col_var; ?>"> </td>
						<td class="th-general"><?php echo $cod_var; ?></td>
						<td class="th-general"><?php echo $variables; ?></td>
						<td class="th-general"><?php echo $des_var; ?></td>
                        <td class="th-general" >
                                                <?php
                                                if($id_laboral>0){
                                                    ?>
                    <span>
						<a href="#" class='btn btn-guardar' title='Editar Variable' onclick="obtener_datos('<?php echo $id_laboral;?>');" data-toggle="modal" data-target="#myModal2"><i class="fa fa-pencil"></i></a> 
						<a href="#" class='btn btn-cancelar' title='Borrar Variable' onclick="eliminar('<?php echo $id_laboral; ?>')"><i class="glyphicon glyphicon-trash"></i></a>
					</span>
						<?php }?></td>
					</tr>
					<?php
					$ii=$ii+1;
				}
				?>
				<tr>
					<td  colspan=7>
						<span class="pull-right">
							<?PHP
					 			echo paginate($reload, $page, $total_pages, $adjacents);
							?>
						</span>
					</td>
				</tr>
</tbody>
				
			  </table>
			</div>
			<?php
		}
	}
?>