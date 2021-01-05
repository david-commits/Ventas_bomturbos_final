<!doctype html>
<html lang="en">
<head>
<script>
	function soloNumeros(e){
 		var key = window.event ? e.which : e.keyCode;
 		if (key < 48 || key > 57) {
     		e.preventDefault();
 		}
	}
</script>
</head>
<?php      
	if (isset($con))
	{
?> 
    <body>    
		<div class="modal fade" id="editarCompatible" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  			<div class="modal-dialog modal-lg" role="document">
				<div class="modal-content" >     
		  			<div class="modal-header" >
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        	<h4 class="modal-title" id="myModalLabel">Editar Producto Compatible</h4>
		  			</div>
                    	<div id="resultados_ajax"></div>
		  				<div class="modal-body" style="height:450px;overflow-y: scroll;">
			
						<form class="form-horizontal" method="post" id="actualizar_dato_compatibilidad" name="actualizar_dato_compatibilidad">
							<div id="resultados_ajax2"></div>
			  				<div class="col-md-4 col-sm-4 col-xs-12">
          						<label for="mod_idvec" class="control-label">Vehiculo</label>
				  					<select class="form-control estilo-placeholder" id="mod_idvec" name="mod_idvec" required>
          								<option class="custom-select"  value="">-- Seleccione Vehiculo --</option> 
<?php                       
				                        $nom = array();
				                        $sql2="select * from vehiculos";
				                        $i=0;
				                        $rs1=mysqli_query($con,$sql2);
				                        while($row3=mysqli_fetch_array($rs1)){
				                            $nom_vehiculo=$row3["nombre_vehiculo"];
				                            $id_vehiculo=$row3["d_vehiculo"];
				                            ?>
				                            <option class="custom-select" value="<?php  echo $id_vehiculo;?>"><?php  echo $nom_vehiculo;?></option>
				                            <?php
				                            $i=$i+1;
				                        }
?>
          							</select>
							</div>
							<div class="col-md-4 col-sm-4 col-xs-12">
          						<label for="mod_idmarca" class="control-label">Marca</label>
				  					<select class="form-control  estilo-placeholder" id="mod_idmarca" name="mod_idmarca" required>
          								<option class="custom-select" value="">-- Selecciona Marca del Vehiculo --</option>
<?php
				                        $nom = array();
				                        $sql2="select * from marca";
				                        $i=0;
				                        $rs1=mysqli_query($con,$sql2);
				                        while($row3=mysqli_fetch_array($rs1)){
				                            $nom_marca=$row3["nombre_marca"];
				                            $id_marca=$row3["id_marca"];
				                            ?>
				                            <option class="custom-select" value="<?php  echo $id_marca;?>"><?php  echo $nom_marca;?></option>
				                            <?php
				                            $i=$i+1;
				                        }
?>
          							</select>
							</div>
         					<div class="col-md-4 col-sm-4 col-xs-12">               
								<label for="mod_idmodel" class="control-label">Modelo Vehiculo</label>
				  				<select class="form-control  estilo-placeholder" id="mod_idmodel" name="mod_idmodel" required>
          							<option class="custom-select"  value="">-- Selecciona tipo de articulo --</option>
          							<option class="custom-select" value="">-- Selecciona modelo --</option>
<?php
				                        $nom = array();
				                        $sql2="select * from modelos";
				                        $i=0;
				                        $rs1=mysqli_query($con,$sql2);
				                        while($row3=mysqli_fetch_array($rs1)){
				                            $nom_modelo=$row3["nombre_modelo"];
				                            $id_modelo=$row3["id_modelo"];
				                            ?>
				                            <option class="custom-select" value="<?php  echo $id_modelo;?>"><?php  echo $nom_modelo;?></option>
				                            <?php
				                            $i=$i+1;
				                        }
?>
          						</select>
							</div>
         					<div class="col-md-4 col-sm-4 col-xs-12">               
								<label for="mod_idproduc" class="control-label">Articulo</label>
				  				<select class="form-control estilo-placeholder" id="mod_idproduc" name="mod_idproduc" required>
          							<option class="custom-select" value="">-- Selecciona tipo de articulo --</option>
<?php
				                        $nom = array();
				                        $sql2="select * from products";
				                        $i=0;
				                        $rs1=mysqli_query($con,$sql2);
				                        while($row3=mysqli_fetch_array($rs1)){
				                            $nom_producto=$row3["nombre_producto"];
				                            $id_producto=$row3["id_producto"];
				                            ?>
				                            <option class="custom-select" value="<?php  echo $id_producto;?>"><?php  echo $nom_producto;?></option>
				                            <?php
				                            $i=$i+1;
				                        }
?>
          						</select>
							</div>
							<div class="col-md-4 col-sm-4 col-xs-12">
						        <label for="mod_idmotor" class="control-label">Motor</label>
						        <select class="form-control estilo-placeholder" id="mod_idmotor" name="mod_idmotor" required>
          							<option class="custom-select" value="">-- Selecciona tipo de articulo --</option>
<?php
				                        $nom = array();
				                        $sql2="select * from motor";
				                        $i=0;
				                        $rs1=mysqli_query($con,$sql2);
				                        while($row3=mysqli_fetch_array($rs1)){
				                            $nom_motor=$row3["nombre"];
				                            $id_motor=$row3["id_motor"];
				                            ?>
				                            <option class="custom-select" value="<?php  echo $id_motor;?>"><?php  echo $nom_motor;?></option>
				                            <?php
				                            $i=$i+1;
				                        }
?>
          						</select>
						       

						        <input type="hidden" name="mod_idcompac" id="mod_idcompac">
							</div>
		  				</div>
		  				<div class="modal-footer">
				      		<button type="button" class="btn btn-cancelar" data-dismiss="modal">Cerrar</button>
							<button type="submit" class="btn btn-guardar" id="guardar_datos_c">Guardar datos</button>
		  				</div>
		  			</form>
				</div>
	  		</div>
		</div>
<?php
		}
?>            
    </body>          
</html>
