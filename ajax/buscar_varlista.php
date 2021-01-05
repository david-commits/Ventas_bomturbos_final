<style>
    table tr:nth-child(odd) {background-color: #FBF8EF;}

table tr:nth-child(even) {background-color: #EFFBF5;}
 #valor1 {
              

border-bottom: 2px solid #F5ECCE;

}  

#valor1:hover {
              
background-color: white;
border-bottom: 2px solid #A9E2F3;

} 


</style>

<?php
//session_start();



	include('is_logged.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado
	/* Connect To Database*/
	require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
	require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
	$tienda1=$_SESSION['tienda'];
        $dato="";

if(isset($_SESSION['asistencia1'])&& isset($_SESSION['asistencia2']) ){
    $aa=$_SESSION['asistencia1'];
    $bb=$_SESSION['asistencia2'];
    $dato=" and fecha_entrada>='$aa' and fecha_entrada<='$bb'";
}
        
	$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
	if (isset($_GET['id'])){
		$id_variable=intval($_GET['id']);
		
                
		
			if ($delete1=mysqli_query($con,"DELETE FROM asistencia WHERE id_asistencia='".$id_variable."'")){
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
			
		
		
		
		
	}
	if($action == 'ajax'){
		// escaping, additionally removing everything that could be (html/javascript-) code
         $q = mysqli_real_escape_string($con,(strip_tags($_REQUEST['q'], ENT_QUOTES)));
		 //$aColumns = array('nombres');//Columnas de busqueda
		 $sTable = "asistencia,users,laborales";
		 $sWhere = "";
                 $sWhere.=" WHERE users.sucursal=$tienda1 and asistencia.asistencia=laborales.id_laboral and asistencia.user_id=users.user_id $dato";
                 
		if ( $_GET['q'] != "" )
		{
		$sWhere.= " and  (users.nombres like '%$q%' or laborales.variables like '%$q%' or laborales.cod_var like '%$q%')";
			
		}
                 
                 
		$sWhere.=" order by id_asistencia desc ";
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
		$reload = './varlista.php';
		//main query to fetch the data
		$sql="SELECT * FROM  $sTable $sWhere LIMIT $offset,$per_page";
		$query = mysqli_query($con, $sql);
                $hora=0;
		//loop through fetched data
		if ($numrows>0){
			
			?>
			<div class="table-responsive">
			  <table class="table">
				<tr  >
					<th class="th-general">Nro</th>
					<th class="th-general">Foto</th>
                                    <th class="th-general">Nombre</th>
					<th class="th-general">Codigo</th>
                                        <th class="th-general">Variable</th>
                                        <th class="th-general">Fecha </th>
                                         <th class="th-general">Acciones </th>
                                        
                                        
					
				</tr>
				<?php
				$ii=1;
				while ($row=mysqli_fetch_array($query)){
						$id_asistencia=$row['id_asistencia'];
                                                $nombre1=$row['nombres'];
                                                $nombre=$row['user_id'];
                                                
                                                $asistencia=$row['asistencia'];
                                                
                                                
                                                
                                                $foto=$row['foto'];
                                                $cod_var1=$row['cod_var'];
                                                $variables=$row['variables'];
                                                $cod_var=$row['id_laboral'];
                                                $col_var=$row['col_var'];
                                                
						$fecha_entrada=$row['fecha_entrada'];
					
					?>
				    <tr>
						<td class="th-general"><?php echo $ii; ?></td>
						<td class="th-general"> 
                              <img src="images/<?php echo $foto;?>" class="avatar" alt="Avatar">
                            </td>
						<td class="th-general"><?php echo $nombre1; ?></td>
                                                <td class="th-general"><span><strong><font color="<?php echo $col_var;?>"><?php echo $cod_var1; ?></font></strong></span></td>
						<td class="th-general"><span><strong><font color="<?php echo $col_var;?>"><?php echo $variables; ?></font></strong></span></td>
						
                                               
                                                <td class="th-general" ><?php echo $fecha_entrada; ?></td>
                                                
                                              <input type="hidden" value="<?php echo $nombre;?>" id="nombre<?php echo $id_asistencia;?>">
					<input type="hidden" value="<?php echo $cod_var;?>" id="cod_var<?php echo $id_asistencia;?>">
					<input type="hidden" value="<?php echo $fecha_entrada;?>" id="fecha_entrada<?php echo $id_asistencia;?>">
                                         <?php 
                                         if($asistencia>0){
                                             
                                        
                                              ?> 
						<td class="th-general" >			
					<span class="pull-right"><a href=""   class='btn btn-warning btn-xs' title='Editar ' onclick="obtener_datos('<?php echo $id_asistencia;?>');" data-toggle="modal" data-target="#myModal2"><i class="fa fa-pencil"></i>Editar</a> 
					<a href="" class='btn btn-danger btn-xs' title='Borrar ' onclick="eliminar('<?php echo $id_asistencia; ?>')"><i class="glyphicon glyphicon-trash"></i>Borrar </a></span>
						</td>
                                                
                                           <?php
                                            }else{
                                                ?>
                                                <td  class="th-general">			
					<span class="pull-right"><a href=""   class='btn btn-warning btn-xs' title='Editar '><i class="fa fa-pencil"></i>Editar</a> 
					<a href="" class='btn btn-danger btn-xs' title='Borrar ' ><i class="glyphicon glyphicon-trash"></i>Borrar </a></span>
						</td>
                                            <?php
                                                }
                                           ?>
                                                
									
					
						
					</tr>
					<?php
					$ii=$ii+1;
				}
				?>
				<tr >
					<td class="th-general" colspan=7><span class="pull-right"><?PHP
					 echo paginate($reload, $page, $total_pages, $adjacents); 
					?></span></td>
				</tr>
                                
			  </table>
			</div>
			<?php
		}
	}
?>