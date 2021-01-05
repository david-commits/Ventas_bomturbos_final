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
.dt-button.red {
        color: black;       
        background:red;
    } 
    .dt-button.orange {
        color: black;
        background:orange;
    }
    .dt-button.green {
        color: black;
        background:green;
    }
    .dt-button.green1 {
        color: black;
        background:#01DFA5;
    }
    .dt-button.green2 {
        color: black;
        background:#2E9AFE;
    }
 tfoot {
    display: table-header-group;
} 
</style> -->

<?php

	
	
	include('is_logged.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado
	/* Connect To Database*/
	require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
	include 'pagination.php'; //include pagination file
	require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
	$tienda1=$_SESSION['tienda'];
        $usuario=$_SESSION['user_id'];
        date_default_timezone_set('America/Lima');
        $fecha1  = date("Y-m-d H:i:s");
	$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
	if (isset($_GET['id'])){
		$id_factura=intval($_GET['id']);
		$del1="UPDATE facturas set activo=0 where id_factura='".$id_factura."'";
                $sql1=mysqli_query($con, "select * from facturas where id_factura='".$id_factura."'");
                while ($row1=mysqli_fetch_array($sql1))
                {
                    $numero_factura=$row1["numero_factura"];
                    $tipo_doc=$row1["estado_factura"];
                    $tienda=$row1["tienda"];
                    $id_cliente=$row1["id_proveedor"];
         
                }
                $sql=mysqli_query($con, "select * from detalle_factura where numero_factura='".$numero_factura."' and ven_com=2 and tienda=$tienda and id_proveedor=$id_cliente and tipo_doc=$tipo_doc" );
                while ($row=mysqli_fetch_array($sql))
                {
                    $id_producto=$row["id_producto"];
                    $tienda=$row["tienda"];
                    $cantidad=$row["cantidad"];
                    $b="b".$tienda;
                    $productos1=mysqli_query($con, "UPDATE products SET $b=$b-$cantidad WHERE id_producto=$id_producto");
                    $sql1=mysqli_query($con, "select * from products where id_producto='".$id_producto."'");
                    while ($row1=mysqli_fetch_array($sql1))
                    {
                        if($tienda==1){
                            $b=$row1["b1"];
                        }
                        if($tienda==2){
                            $b=$row1["b2"];
                            
                        }
                        if($tienda==3){
                            $b=$row1["b3"];
                        }
         
                        if($tienda==4){
                            $b=$row1["b4"];
                        }
                        if($tienda==5){
                            $b=$row1["b5"];
                        }
                        if($tienda==6){
                            $b=$row1["b6"];
                        }
         
                    }
                    $c=$b+$cantidad;  
                    $insert=mysqli_query($con,"INSERT INTO detalle_factura VALUES ('','',$id_cliente','$usuario','$numero_factura','0','$id_producto','$cantidad','0','$tienda1','0','1','$fecha1','0','$tipo_doc','$c','3.2')");  
         
                }
                $del2="UPDATE detalle_factura set activo=0 where numero_factura='".$numero_factura."' and ven_com=2 and tienda=$tienda and tipo_doc=$tipo_doc and id_proveedor=$id_cliente";
        
		if ($delete1=mysqli_query($con,$del1) and $delete2=mysqli_query($con,$del2)){
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
			  <strong>Error!</strong> No se puedo eliminar los datos
			</div>
			<?php
			
		}
	}
	if($action == 'ajax'){
		
	
		$q = mysqli_real_escape_string($con,(strip_tags($_REQUEST["q"], ENT_QUOTES)));
		$sTable = "facturas f, clientes c, users u, proveedores p";
	   	$sWhere = "";
	   	$sWhere.=" WHERE f.id_proveedor=p.id_proveedores and f.id_vendedor=u.user_id and f.ven_com=2 and f.activo=1 and f.tienda=$tienda1";
	  	if ( $_GET['q'] != "" )
	  	{
	 	$sWhere.= " and  (p.nom_pro like '%$q%' or f.numero_factura like '%$q%')";
		  
	  	}
	  
	  	$sWhere.=" order by f.id_factura desc";
	  
	  
	  //pagination variables
	  $page = (isset($_REQUEST['page']) && !empty($_REQUEST["page"]))?$_REQUEST['page']:1;
	  $per_page = 10; //how much records you want to show
	  $adjacents  = 4; //gap between pages after number of adjacents
	  $offset = ($page - 1) * $per_page;
	  //Count the total number of row in your table*/
	//   $count_query   = mysqli_query($con, "SELECT DISTINCT count(*) AS numrows FROM $sTable  $sWhere");	 
	  $count_query   = mysqli_query($con, "SELECT count(DISTINCT	f.numero_factura,
	  																f.estado_factura, 
	  																f.fecha_factura, p.nom_pro) AS numrows 
													    FROM $sTable  $sWhere");
	  $row= mysqli_fetch_array($count_query);
	  $numrows = $row['numrows'];
	//   print_r($row);
	  $total_pages = ceil($numrows/$per_page);
	  $reload = "./facturas.php";
	  $sql="SELECT DISTINCT f.numero_factura, 
	  						f.estado_factura, 
							f.fecha_factura,
							p.nom_pro as nombre_cliente,
							u.nombres, 
							f.deuda_total, 
							f.total_venta, 
							f.activo, 
							f.id_factura, 
							f.moneda, 
							p.tel_pro as telefono_cliente 
			FROM  $sTable $sWhere
			LIMIT $offset,$per_page";
			
	  $query = mysqli_query($con, $sql);
	  //loop through fetched data
	  if ($numrows>0 || $numrows == 0){
		  echo mysqli_error($con);
		  ?>
		  <div class="table-responsive">
		  <table id="example" class="display nowrap" style="width:100%">
				<thead >
				  <tr class="th-general">
					  <th class="th-general">Nro doc</th>
					  <th class="th-general">Tipo de Doc</th>
					  <th class="th-general">Fecha</th>
					  <th class="th-general">Cliente</th>
					  <th class="th-general">Vendedor</th>
					  <th class="th-general">Estado</th>
					  <th class="th-general">Total</th>
					  <th class="th-general">Deuda</th>
					  <th class="th-general">Acciones</th>
				  </tr>
			  </thead> 
			  <tbody>               
			  <?php
			    while ($row=mysqli_fetch_array($query)){
								  
					  $activo=$row['activo'];
					  $id_factura=$row["id_factura"];
					  $numero_factura=$row['numero_factura'];
					  $fecha=date("d/m/Y", strtotime($row['fecha_factura']));
					  $nombre_cliente=$row["nombre_cliente"];
						  $moneda=$row['moneda'];
						  if($moneda==1){
							  $mon="S/.";
						  }else{
							  $mon="USD";
						  }
						  $estado_factura=$row['estado_factura'];
						  if($estado_factura==1){
							  $estado1="Factura";
						  }
						  if($estado_factura==2){
							  $estado1="Boleta";
						  }
						  if($estado_factura==3){
							  $estado1="Guia";
						  }
											  
					  	$telefono_cliente=$row['telefono_cliente'];
					  	//$email_cliente=$row['email_cliente'];
											  //$ruc=$row['doc'];
											  //$ot=$row['ot'];
						$deuda=$row['deuda_total'];
					  	$nombre_vendedor=$row['nombres'];
					  
						if ($deuda==0){$text_estado="Pagada";$label_class='label-success';}
						else{$text_estado="Credito";$label_class='label-warning';}
						$total_venta=$row['total_venta'];
											  
											  
				  ?>
				  <tr >
										 
					  <td class="th-general"><?php echo $numero_factura; ?></td>
					  <td class="th-general"><?php echo $estado1; ?></td>     
					  <td class="th-general"><?php echo $fecha; ?></td>
					  <td class="th-general"><?php echo $nombre_cliente;?></td>
					  <td class="th-general"><?php echo $nombre_vendedor; ?></td>
					  <td class="th-general"><span class="label <?php echo $label_class;?>"><?php echo $text_estado; ?></span></td>
					  <td class="th-general"><?php print"$";echo number_format ($total_venta,2); ?></td>
					  <td class="th-general"><?php print"$";echo number_format ($deuda,2); ?></td>
					  <td class="th-general">
				  
					  <a href="#" class='btn btn-primary btn-xs' title='Descargar documento' onclick="imprimir_factura('<?php echo $id_factura;?>');"><i class="glyphicon glyphicon-download-alt"></i></a> 
					  <a href="#" class='btn btn-cancelar btn-xs' title='Borrar documento' onclick="eliminar('<?php echo $id_factura; ?>')"><i class="glyphicon glyphicon-trash"></i> </a>
				  </td>
					  
				  </tr>
					  <?php  
					  $numrows=$numrows-1;
				}
					  ?>
				  <tr>
				  <td colspan=16 class="th-general"><span class="pull-right"><?php
				   echo paginate($reload, $page, $total_pages, $adjacents);
				  ?></span></td>
			  </tr>
			  </tbody>
			  <?php
			  	
			}
		}	
				?>
			  </table>
			</div>
			
  
