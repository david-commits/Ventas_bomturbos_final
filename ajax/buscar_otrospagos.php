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

	
	
	include('is_logged.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado
	/* Connect To Database*/
	require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
	require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
	$tienda1=$_SESSION['tienda'];
	$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
	if (isset($_GET['id'])){
		$numero_factura=intval($_GET['id']);
		
		
      
                
                //$del3="UPDATE products SET $b=$b+$cantidad WHERE id_producto=$id_producto";
                
                
		if ($delete1=mysqli_query($con,"DELETE FROM facturas WHERE id_factura='".$numero_factura."'")){
			?>
			<div class="alert alert-success alert-dismissible" role="alert">
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			  <strong>Aviso!</strong> Datos eliminados exitosamente
			</div>
			<?php 
		}else {
			?>
			<div class="alert alert-danger alert-dismissible" role="alert">
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			  <strong>Error!</strong> No se puede eliminar la operación
			</div>
			<?php
			
		}
	}
	if($action == 'ajax'){
		// escaping, additionally removing everything that could be (html/javascript-) code
         $q = mysqli_real_escape_string($con,(strip_tags($_REQUEST['q'], ENT_QUOTES)));
		  $sTable = "facturas, clientes, users";
		 $sWhere = "";
		 $sWhere.=" WHERE facturas.tienda=$tienda1 and facturas.id_cliente=clientes.id_cliente and facturas.id_vendedor=users.user_id and facturas.servicio=2";
		if ( $_GET['q'] != "" )
		{
		$sWhere.= " and  (clientes.nombre_cliente like '%$q%' or facturas.numero_factura like '%$q%')";
			
		}
		
		$sWhere.=" order by facturas.id_factura desc";
		include 'pagination.php'; //include pagination file
		//pagination variables
		$page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
		$per_page = 10; //how much records you want to show
		$adjacents  = 4; //gap between pages after number of adjacents
		$offset = ($page - 1) * $per_page;
		//Count the total number of row in your table*/
		
                
                $count_query= mysqli_query($con, "SELECT count(*) AS numrows FROM $sTable  $sWhere");    
                
		$row= mysqli_fetch_array($count_query);
		$numrows = $row['numrows'];
		$total_pages = ceil($numrows/$per_page);
		$reload = './otrospagos.php';
		//main query to fetch the data
		
                    
                $sql="SELECT * FROM $sTable $sWhere LIMIT $offset,$per_page";
		$query = mysqli_query($con, $sql);
		//loop through fetched data
		if ($numrows>0){
			echo mysqli_error($con);
			?>
			<div class="table-responsive">
			  <table class="table">
				<tr  style="background-color:#FE9A2E;color:white; ">
					<th>#</th>
					<th>Fecha</th>
                                        <th>Hora</th>
					<th>Destinatario</th>
					<th>Vendedor</th>
					<th>Nombre de la operación</th>
					<th class='text-right'>Total</th>
                                        <th class='text-right'>Deuda</th>
                                        <th class='text-right'>Tipo</th>
					<th class='text-right'>Acciones</th>
					
				</tr>
				<?php
				while ($row=mysqli_fetch_array($query)){
                                    
                                                
                                                $id_factura=$row['id_factura'];
                                                $ven_com=$row['ven_com'];
						$numero_factura=$row['numero_factura'];
						$fecha=date("d/m/Y", strtotime($row['fecha_factura']));
						$hora=date("H:i", strtotime($row['fecha_factura']));
                                                
                                                $servicio=$row['servicio'];
                                                
                                                $nombre_cliente=$row['nombre_cliente'];
						
                                                
                                                $telefono_cliente=$row['telefono_cliente'];
						$email_cliente=$row['email_cliente'];
						$nombre_vendedor=$row['nombres'];
						$estado_factura=$row['condiciones'];
                                                
                                                $proveedor=$row['nombre_cliente'];
                                                
                                                $tienda=$row['tienda'];
                                                
                                                
                                                $moneda=$row['moneda'];
                                                if($moneda==1){
                                                    $mon="S/.";
                                                }else{
                                                    $mon="USD";
                                                }
                                                
                                                if ($ven_com==6){$text_estado1="Pago";$label_class1='label-danger';}
                                                
                                                if ($ven_com==5){$text_estado1="Cobro";$label_class1='label-primary';}
						
                                                
                                                $text_estado=$row['nombre'];
                                                
						
						$total_venta=$row['total_venta'];
                                                $deuda=$row['deuda_total'];
                                                $cliente=$row['id_cliente'];
					?>
					<tr id="valor1">
						<td><?php echo $numero_factura; ?></td>
						<td><?php echo $fecha; ?></td>
                                                <td><?php echo $hora; ?></td>
						<td><a href="#" data-toggle="tooltip" data-placement="top" ><?php echo $nombre_cliente;?></a></td>
						<td><?php echo $nombre_vendedor; ?></td>
                                                <td><strong><?php echo $text_estado; ?></strong></td>
						<td class='text-right'><?php print"$mon"; echo number_format ($total_venta,2); ?></td>	
                                                <td class='text-right'><?php print"$mon"; echo number_format ($deuda,2); ?></td>
                                                <td><span class="label <?php echo $label_class1;?>"><?php echo $text_estado1; ?></span></td>
                                        
                                        <input type="hidden" value="<?php echo $text_estado;?>" id="nombre<?php echo $id_factura;?>">
                                                
                                        <input type="hidden" value="<?php echo $ven_com;?>" id="ven_com<?php echo $id_factura;?>">
                                                
                                        <input type="hidden" value="<?php echo $row['id_cliente'];?>" id="cliente<?php echo $id_factura;?>">
                                          <input type="hidden" value="<?php echo $row['user_id'];?>" id="vendedor<?php echo $id_factura;?>">      
                                          
                                          
                                        <input type="hidden" value="<?php echo $row['condiciones'];?>" id="condiciones<?php echo $id_factura;?>">
                                              
                                        
                                        <input type="hidden" value="<?php echo $total_venta;?>" id="total<?php echo $id_factura;?>"> 
                                                
                                          <input type="hidden" value="<?php echo $row['estado_factura'];?>" id="estado_factura<?php echo $id_factura;?>">       
                                            <input type="hidden" value="<?php echo $row['numero_factura'];?>" id="numero_factura<?php echo $id_factura;?>">       
                                               <input type="hidden" value="<?php echo $row['obs'];?>" id="obs<?php echo $id_factura;?>">       
                                            
                                          
                                          
                                               <td class="text-right">
					
                                                    <a href="#" class='btn btn-primary btn-xs' title='Realizar Operación' onclick="obtener_datos('<?php echo $id_factura;?>');" data-toggle="modal" data-target="#myModal2"><i class="glyphicon glyphicon-edit"></i>Editar</a> 
                                                    
                                                    <a href="#" class='btn btn-danger btn-xs' title='Borrar Operación' onclick="eliminar('<?php echo $id_factura; ?>')"><i class="glyphicon glyphicon-trash"></i>Borrar </a>
						
						
					</td>
						
					</tr>
					<?php
				
                                }
				?>
				<tr style="background:white;"> 
					<td colspan=10><span class="pull-right"><?php
					 echo paginate($reload, $page, $total_pages, $adjacents);
					?></span></td>
				</tr>
			  </table>
			</div>
			<?php
		}
                }
	
?>