<?php  
if (isset($con))
{
$sql3="select * from datosempresa ";
$rs2=mysqli_query($con,$sql3);
while($row4=mysqli_fetch_array($rs2)){
    $dolar=$row4["dolar"];
}        
?>
<head>
<script> 
function multiplicar(){
m1 = document.getElementById("multiplicando1").value;
m2 = document.getElementById("mod_costo").value;
m3 = document.getElementById("utilidad").value;
r = m1*m2;
var r1 = r.toFixed(2);
document.getElementById("soles").value = r1;

r2=document.getElementById("soles").value;
r3=1*r2+1*m3;

var r4 = r3.toFixed(2);
document.getElementById("mod_precio").value = r4;
}
</script> 
<script>
var mostrarValor = function(x){
    if (x>0){
        x1=1;                 
                        }
    else{
        x1=<?php echo $dolar;?>;                  
    }
     
    document.getElementById('multiplicando1').value=x1;
    m2 = document.getElementById("mod_costo").value;
    m3 = document.getElementById("utilidad").value;
    r = x1*m2;
    var r1 = r.toFixed(2);
    document.getElementById("soles").value = r1;
    r2=document.getElementById("soles").value;
    r2=1*r2+1*m3;
    var r3 = r2.toFixed(2);
    document.getElementById("mod_precio").value = r3;
   
};                         
</script>
</head>
    <body>  
	<!-- Modal -->
	<div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
		<div class="modal-content estilo-placeholder">
		  <div class="modal-header estilo-placeholder">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel"><i class='glyphicon glyphicon-edit'></i><font color="black">Producto Compatible</font></h4>
		  </div>
                    
                    <div id="resultados_ajax2"></div>
		  <div class="modal-body" style="height:500px;overflow-y: scroll;">
			<form class="form-horizontal" method="post" id="editar_producto" name="editar_producto">
			


			  <div class="form-group">
				<label for="prov" class="col-sm-3 control-label">Marca vehiculo</label>
				<div class="col-md-8 col-sm-8 col-xs-12">
					<select class="form-control" id="prov" name="prov" required>
						<option value="">-- Selecciona Marca --</option>
                        <?php
                        $sql2="select * from marca ";
                        $rs1=mysqli_query($con,$sql2);
                        while($row3=mysqli_fetch_array($rs1)){
                            $nom_marca=$row3["nombre_marca"];
                            $id_marca=$row3["id_marca"];
                        ?>
                        <option value="<?php  echo $id_cliente;?>"><?php  echo $nom_marca;?></option>
                        <?php
                        }                        
                        ?>
                    </select>
				</div>
			</div>


			   <div class="form-group">
				<label for="prov" class="col-sm-3 control-label">Modelo vehiculo</label>
				<div class="col-md-8 col-sm-8 col-xs-12">
					<select class="form-control" id="prov" name="prov" required>
						<option value="">-- Selecciona modelo --</option>
                        <?php
                        $sql2="select * from modelo ";
                        $rs1=mysqli_query($con,$sql2);
                        while($row3=mysqli_fetch_array($rs1)){
                            $nom_modelo=$row3["nombre_modelo"];
                            $id_modelo=$row3["id_modelo"];
                        ?>
                        <option value="<?php  echo $id_cliente;?>"><?php  echo $nom_modelo;?></option>
                        <?php
                        }                        
                        ?>
                    </select>
				</div>
			</div>
			 
			<div class="form-group">
				<label for="prov" class="col-sm-3 control-label">Motor vehiculo</label>
				<div class="col-md-8 col-sm-8 col-xs-12">
					<select class="form-control" id="prov" name="prov" required>
						<option value="">-- Selecciona motor --</option>
                        <?php
                        $sql2="select * from products";
                        $rs1=mysqli_query($con,$sql2);
                        while($row3=mysqli_fetch_array($rs1)){
                            $nom_motor=$row3["motor"];
                            $id_producto=$row3["id_producto"];
                        ?>
                        <option value="<?php  echo $id_cliente;?>"><?php  echo $nom_motor;?></option>
                        <?php
                        }                        
                        ?>
                    </select>
				</div>
			</div>
			
			
                

			  <div class="table-responsive">
			  <table class="table">
			  	<tr  class="warning">
					<th>Código</th>
					<th>Producto</th>
					<th><span class="pull-right">Cant.</span></th>
					<th><span class="pull-right">Precio</span></th>
                    <th><span class="pull-right">Stock</span></th>
					<th class='text-center' style="width: 36px;">Agregar</th>
				</tr>

				<tr style="background-color: #81F7BE;color:black;">
						                     
                        <td><?php echo $codigo_producto; ?></td>
						<td><?php echo $nombre_producto; ?></td>
						<td class='col-xs-1'>
						<div class="pull-right">
						<input type="text" class="form-control" style="text-align:right" id="cantidad_<?php echo $id_producto; ?>"  value="" >
						</div></td>
						<td class='col-xs-2'><div class="pull-right">
						<input type="text" class="form-control" style="text-align:center" id="precio_venta_<?php echo $id_producto; ?>"  value="<?php echo $precio_venta;?>" >
                                                
                                                    </div></td>
                                               <td class='col-xs-2'><div class="pull-right"><input type="text" class="form-control" style="text-align:right" disabled id="stock_<?php echo $id_producto; ?>" value="<?php echo $b;?>"></div></td>
						<td class='text-center'><a class='btn btn-info'href="#" onclick="agregar('<?php echo $id_producto ?>')"><i class="glyphicon glyphicon-plus"></i></a></td>
					</tr>
			  </table>
			</div>
                        <?php 
                        $aa="";
                        if($_SESSION['user_id']<>1){
                            $aa="readonly";
                        }
                        ?>
                    </div>
		<div class="modal-footer">
			<button type="button" class="btn btn-info" data-dismiss="modal">Cerrar</button>
			<button type="submit" class="btn btn-primary" id="actualizar_datos">Actualizar datos</button>
		</div>
		</form>
            </div>
	  </div>
</div>
<?php
}
?>
</body>


