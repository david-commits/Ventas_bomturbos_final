	<?php
		if (isset($con))
		{
	?>
	<!-- Modal -->
	<div class="modal fade" id="myModalVehiculo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalVehiculo">Editar Vehiculo</h4>
		  </div>
		  <div class="modal-body">
			<form class="form-horizontal" method="post" id="editar_vehiculo" name="editar_vehiculo">
			<div id="resultados_ajax2"></div>

			    <div class="form-group">
				<label for="mod_idMarca" class="col-sm-3 control-label">Marca Vehiculo:</label>
				<div class="col-md-9 col-sm-9 col-xs-12">
				<select class="form-control estilo-placeholder" id="mod_idMarca" name="mod_idMarca" required>
		
					<option class="custom-select" value="">-- Selecciona marca --</option>
			            <?php
                       
                        $nom = array();
                        $sql2="SELECT m.id_marca as id, m.nombre_marca as nom FROM marca m where m.estado = 1 and m.id_tipoLinea = 3  ";
                        $i=0;
                        $rs1=mysqli_query($con,$sql2);
                        while($row3=mysqli_fetch_array($rs1)){
                            $nom_marca=$row3["nom"];
                            $id_marca=$row3["id"];
                            ?>
                            <option class="custom-select" value="<?php  echo $id_marca;?>"><?php  echo $nom_marca;?></option>
                            <?php
                            $i=$i+1;
                        }
                        ?>
                     </select>
						

				</div>
			  </div>

                <div class="form-group">
				<label for="mod_idmodelo_mode" class="col-sm-3 control-label">Nombre Modelo:</label>
					<div class="col-md-9 col-sm-9 col-xs-12">
					  	<select  class="form-control estilo-placeholder" id="mod_idmodelo_mode" name="mod_idmodelo_mode" required >
		                <option class="custom-select" value="0">-- Selecciona Modelo --</option>
 <?php
                    $nom = array();
                    $sql2="select * from modelos where estado = 1 ";
                    $i=0;
                    $rs1=mysqli_query($con,$sql2);
                    while($row3=mysqli_fetch_array($rs1)){
                      $nom_tipom=$row3["nombre_modelo"];
                      $id_modelo=$row3["id_modelo"];
                  ?>
                    <option class="custom-select" value="<?php  echo $id_modelo;?>"><?php  echo $nom_tipom;?></option>
                  <?php
                    $i=$i+1;
                    }    
                  ?>  
		              </select>


              <!--<select  class="form-control estilo-placeholder" id="mod_idmodelo_mode" name="mod_idmodelo_mode" required>
                <option class="custom-select" value="0">-- Selecciona Modelo --</option>

              </select>-->

					</div>
			    </div>

				<div class="form-group">
				<label for="mod_cilindro" class="col-sm-3 control-label">Litros:</label>
				<div class="col-md-9 col-sm-9 col-xs-12">
				  <input type="text"  class="form-control estilo-placeholder" id="mod_cilindro" name="mod_cilindro" placeholder="Ingrese cilindro" maxlength="50" required="true">
				</div>
		      </div>
			    <div class="form-group">
				<label for="mod_anio" class="col-sm-3 control-label">Año:</label>
				<div class="col-md-9 col-sm-9 col-xs-12">
				  <input type="text" class="form-control estilo-placeholder" id="mod_anio" name="mod_anio" placeholder="Ingrese anio" required="true"   maxlength="50">
				</div>
		      </div>

 				<div class="form-group">
					<label for="mod_motor" class="col-sm-3 control-label">Motor:</label>
					<div class="col-md-9 col-sm-9 col-xs-12">
				  		<select class="form-control estilo-placeholder" id="mod_motor" name="mod_motor" required >
							<option class="custom-select" value="">-- Selecciona Motor--</option>
			            	<?php
       				  			$sql22="SELECT * FROM motor where estado=1" ;
                       	 		$i=0;
                        		$rs21=mysqli_query($con,$sql22);
                        		while($row32=mysqli_fetch_array($rs21)){
                            		$nom_1=$row32["nombre"];
                            		$id_motor_1=$row32["id_motor"];
                            ?>
                            		<option class="custom-select" value="<?php  echo $id_motor_1;?>"><?php  echo $nom_1;?></option>
                            <?php
                            		$i=$i+1;
                        		}
                        	?>
                        </select>
                        <!--<select  class="form-control estilo-placeholder" id="mod_motor" name="mod_motor" required>
                <option class="custom-select" value="0">-- Seleccione Motor --</option>

              </select>-->
				 	</div>
				</div>


        



		      <div class="form-group">
				<label for="mod_combustible" class="col-sm-3 control-label">Combustible:</label>
				<div class="col-md-9 col-sm-9 col-xs-12">
				 <input type="text" class="form-control estilo-placeholder" id="mod_combustible" name="mod_combustible" placeholder="Ingrese cilindro" maxlength="100" required="true">

			   </div>
			   </div>  
                        
			    <div class="form-group">
				<label for="mod_detalle" class="col-sm-3 control-label">Descripción:</label>
				<div class="col-md-9 col-sm-9 col-xs-12">
				  <input type="text" class="form-control estilo-placeholder" id="mod_detalle" name="mod_detalle" maxlength="100">
				</div>
			    </div>

                <div class="form-group">
                <label for="mod_comentario" class="col-sm-3 control-label">Comentario:</label>
                <div class="col-md-9 col-sm-9 col-xs-12">
                  <input type="text" class="form-control estilo-placeholder" id="mod_comentario" name="mod_comentario" maxlength="100">
                </div>
                </div>

                <input type="hidden" name="mod_idvehiculo" id="mod_idvehiculo">

			    <div class="form-group" style="display: none;">
				<label for="mod_estado" class="col-sm-3 control-label">Estado</label>
				<div class="col-md-9 col-sm-9 col-xs-12">
                    <select class="form-control estilo-placeholder" id="mod_estado" name="mod_estado" required="true" >
                        <option class="custom-select" value="1" checked>Activo</option>
                        <option class="custom-select" value="2">Inactivo</option>
                    </select>
				</div>
			    </div>


		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-cancelar" data-dismiss="modal">Cerrar</button>
			<button type="submit" class="btn btn-agregar" id="actualizar_datos">Actualizar datos</button>
		  </div>
		  </form>
		</div>
	  </div>
	</div>
	<?php
		}
	?>
	<script type="text/javascript">
  $('#mod_idMarca').on('change',function(){
        var marca_m = $("#mod_idMarca").val();
        console.log(marca_m);
        if(marca_m){


            $.ajax({
                type:'POST',
                url:'./modal/appblade.php',
                data:'marca_m='+marca_m,
                success:function(html){
                	console.log(html);
                    $('#mod_idmodelo_mode').html(html);
                }
            });

        }else{
            $('#mod_idmodelo_mode').html('<option value="">Seleccione marca primero</option>');
        }
    });
    </script>

<script type="text/javascript">
  $('#mod_idmodelo_mode').on('change',function(){
        var mod_marca_m_m = $("#mod_idMarca").val();
        var mod_modelo_m_m = $("#mod_idmodelo_mode").val();
        console.log(mod_marca_m_m);
        if(mod_marca_m_m){


            $.ajax({
                type:'POST',
                url:'./modal/appblade.php',
                data:'mod_marca_m_m='+mod_marca_m_m+'&mod_modelo_m_m='+mod_modelo_m_m,
                success:function(html){
                  console.log(html);
                    $('#mod_motor').html(html);
                }
            });

        }else{
            $('#mod_motor').html('<option class="custom-select" value="">Seleccione Modelo primero</option>');
        }
    });
</script>