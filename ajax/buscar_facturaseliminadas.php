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


</style>
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
left: 40px; /*position where enlarged image should offset horizontally */
} 

img.imagen2{
padding:4px;
border:3px #0489B1 solid;
margin-left: 2px;
margin-right:5px;
margin-top: 5px;
float:left;

}

table tr:nth-child(odd) {background-color: #F5F6CE;}

table tr:nth-child(even) {background-color: #CEF6E3;}
 #valor1:hover {
              
background-color: white;
border-bottom: 2px solid #A9E2F3;

}  
#valor2:hover {
              
background-color: white;
border-bottom: 2px solid #A9E2F3;

} 
#valor1 {
              
background-color: #FBF8EF;
border-bottom: 2px solid #F5ECCE;

}  

#valor2 {
              
background-color: #EFFBF5;
border-bottom: 2px solid #F5ECCE;

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

.dataTables_wrapper .dataTables_paginate .paginate_button:hover {
  background: none;
  color: black!important;
  border-radius: 4px;
  border: 1px solid #828282;
}
 
.dataTables_wrapper .dataTables_paginate .paginate_button:active {
  background: none;
  color: black!important;
}

</style> -->

<?php

	
	
	include('is_logged.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado
	/* Connect To Database*/
	require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
	require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
	$tienda1=$_SESSION['tienda'];
        $usuario=$_SESSION['user_id'];

        
        date_default_timezone_set('America/Lima');
        
        $fecha1  = date("Y-m-d H:i:s");
        
	$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
	
	if($action == 'ajax'){
		// escaping, additionally removing everything that could be (html/javascript-) code
         $q = mysqli_real_escape_string($con,(strip_tags($_REQUEST['q'], ENT_QUOTES)));
		  $sTable = "facturas, clientes, users";
		 $sWhere = "";
		 $sWhere.=" WHERE facturas.id_cliente=clientes.id_cliente and facturas.tienda=$tienda1 and facturas.id_vendedor=users.user_id and facturas.ven_com=1 and facturas.activo=0 and facturas.numero_factura>0";
		
                 if ( $_GET['q'] != "" )
		{
		$sWhere.= " and  (clientes.nombre_cliente like '%$q%' or facturas.numero_factura like '%$q%' )";
			
		}
		
		$sWhere.=" order by facturas.id_factura desc";
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
		$reload = './facturas.php';
		//main query to fetch the data
		$sql="SELECT * FROM  $sTable $sWhere LIMIT $offset,$per_page";
		$query = mysqli_query($con, $sql);
           
		if ($numrows>0){
			echo mysqli_error($con);
			?>
			<div class="table-responsive">
			  <table class="table">
				<tr class="th-general" >
					
                                        <th class="th-general">Nro Doc</th>
                                        <th class="th-general">Tipo de Doc</th>
                                        <th class="th-general">Fecha</th>
                                        <th class="th-general">Cliente</th>
                                        <th class="th-general">Total</th>
                                        <th class="th-general">Deuda</th>
                                        <th class="th-general">Vendedor</th>
                                        <th class="th-general">Pago</th>
                                        <th class="th-general">Estado</th>
                                        <th class="th-general">Acciones</th>
					
				</tr>
                               
				<?php
				while ($row=mysqli_fetch_array($query)){
                                    
                                                $activo=$row['activo'];
						
                                                $id_factura=$row['id_factura'];
						$numero_factura=$row['numero_factura'];
						$fecha=date("d/m/Y", strtotime($row['fecha_factura']));
						$nombre_cliente=$row['nombre_cliente'];
						$telefono_cliente=$row['telefono_cliente'];
                                                $ruc=$row['doc'];
						$email_cliente=$row['email_cliente'];
                                                $baja=$row['baja'];
                                                $dni=$row['dni'];
                                                $folio=$row['folio'];
                                                
						$nombre_vendedor=$row['nombres'];
                                                
                                                $estado_factura1=$row['estado_factura'];
                                                
						$estado_factura=$row['condiciones'];
                                                $ven_com=$row['ven_com'];
                                                
                                                $moneda=$row['moneda'];
                                                if($moneda==1){
                                                    $mon="S/.";
                                                }else{
                                                    $mon="USD";
                                                }
                                                
                                                if($estado_factura1==1){
                                                    $estado1="Factura";
                                                    
                                                }
                                                if($estado_factura1==2){
                                                    $estado1="Boleta";
                                                    
                                                }
                                                if($estado_factura1==3){
                                                    $estado1="Guia";
                                                    
                                                }
                                               
                                                if($estado_factura==1){
                                                    $estado2="Efectivo";
                                                   
                                                }
                                                if($estado_factura==2){
                                                    $estado2="Cheque";
                                                    
                                                }
                                                if($estado_factura==3){
                                                    $estado2="Transf Bancaria";
                                                    
                                                }
                                                if($estado_factura==4){
                                                    $estado2="Crédito";
                                                    
                                                }
                                                
                                                $deuda=$row['deuda_total'];
                                                $servicio=$row['servicio'];
                                                $sql1="SELECT * FROM  servicio;";
                                                $query1 = mysqli_query($con, $sql1);
                                               
                                                while ($row1=mysqli_fetch_array($query1)){
                                                  if($row1['doc_servicio']==$numero_factura && $row1['tip_doc']==$estado_factura1)  {
                                                     $guia=$row1['guia'];
                                                     
                                                    
                                                  }
                                                }
                                              if ($servicio==0){$text_estado1="Productos";$label_class1='label-success';}
						else{$text_estado1="Servicios";$label_class1='label-warning';}
                                                
						if ($deuda==0){$text_estado="Pagada";$label_class='label-success';}
						else{$text_estado="Pendiente";$label_class='label-warning';}
						$total_venta=$row['total_venta'];
					?>
					<tr >
                                           
						<td  class="th-general"><?php print"$folio $numero_factura"; ?></td>
                                                <td  class="th-general"><?php echo $estado1; ?></td>
                                                <td  class="th-general"><?php echo $fecha; ?></td>
						<td  class="th-general"><?php echo $nombre_cliente;?></td>   
                                                <td  class="th-general" class='text-right'><?php print"$mon"; echo number_format ($total_venta,2); ?></td>					
                                                <td  class="th-general" class='text-right'><?php print"$mon"; echo number_format ($deuda,2); ?></td>
                                                <td  class="th-general"><?php echo $nombre_vendedor; ?></td>
                                                <td  class="th-general"><span class="label label-success"><?php echo $estado2; ?></span></td>
                                                <td  class="th-general"><span class="label <?php echo $label_class;?>"><?php echo $text_estado; ?></span></td>
						<td   class="th-general" class="text-right">
						   <a href="#" class='btn btn-primary btn-xs' title='Descargar documento' onclick="imprimir_factura('<?php echo $id_factura;?>');"><i class="glyphicon glyphicon-download-alt"></i></a> 
						 
                                                  <?php
                                                  if($estado_factura1<=2 && $baja=="0"){
                                                       ?>
                                                      <!--<a href="#" class='btn btn-danger btn-xs' title='Enviar doc de baja' onclick="imprimir_facturas1('<?php echo $id_factura;?>');"><i class="glyphicon glyphicon-download"></i></a> -->
						  <?php 
                                                  }
                                                
                                                    ?>
                                                    
                                                   <?php
                                                  if($estado_factura1<=2 && $baja<>"0"){
                                                       ?>
                                                     <!-- <a href="#" class='btn btn-danger btn-xs' title='Descargar doc de baja' onclick="imprimir_facturas2('<?php echo $baja.".xml";?>');"><i class="glyphicon glyphicon-download"></i></a> -->
						  <?php 
                                                  }
                                                
                                                    ?>    
                                                
                                                </td>
					</tr>
					<?php
                                        $numrows=$numrows-1;
                                        
				
                                }
				?>
				<tr>
					<td class="th-general" colspan=10><span class="pull-right"><?php
					 echo paginate($reload, $page, $total_pages, $adjacents);
					?></span></td>
				</tr>
			  </table>
			</div>
			<?php
		}
                }
	
?>

