<?php 
session_start();
require_once ("config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
require_once ("config/conexion.php");


		// NOMBRE DEL ARCHIVOY CHARSET
		header('Content-Type:text/xls');
		header('Content-Disposition: attachement; filename=Reporte_Excel.xls');
		?>
		<table>
			<thead>
				<tr>
					<th>Nro doc</th>
					<th>Tipo de Doc.</th>
					<th>Fecha</th>
					<th>Cliente</th>
					<th>Vendedor</th>
					<th>Estado</th>
					<th>Total</th>
					<th>Deuda</th>
				</tr>
			</thead>
			<tbody>
<?php
				$sql="SELECT DISTINCT facturas.numero_factura, facturas.estado_factura, facturas.fecha_factura, proveedores.nom_pro as nombre_cliente, users.nombres, facturas.deuda_total, facturas.total_venta, facturas.activo, facturas.id_factura, facturas.moneda, proveedores.tel_pro as telefono_cliente FROM facturas, clientes, users, proveedores WHERE facturas.id_proveedor=proveedores.id_proveedores and facturas.id_vendedor=users.user_id and ven_com=2 and activo=1 and facturas.tienda=1 order by facturas.id_factura desc";

				$query = mysqli_query($con, $sql);
				while ($row=mysqli_fetch_array($query)){
		                          
                        $activo=$row['activo'];
                        $id_factura=$row['id_factura'];
						$numero_factura=$row['numero_factura'];
						$fecha=date("d/m/Y", strtotime($row['fecha_factura']));
						$nombre_cliente=$row['nombre_cliente'];
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
					<tr>
                                           
						<td><?php echo $numero_factura; ?></td>
                        <td><?php echo $estado1; ?></td>     
						<td><?php echo $fecha; ?></td>
						<td><?php echo $nombre_cliente;?></td>
						<td><?php echo $nombre_vendedor; ?></td>
						<td><?php echo $text_estado; ?></td>
						<td><?php print"$";echo number_format ($total_venta,2); ?></td>
                        <td><?php print"$";echo number_format ($deuda,2); ?></td>
					</tr>
<?php
				}
?>
			</tbody>
		</table>
<?php		

?>