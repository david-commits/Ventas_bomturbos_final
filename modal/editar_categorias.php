	<?php
		if (isset($con))
		{
	?>
	<!-- Modal -->
	<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Editar categoria</h4>
		  </div>
		  <div class="modal-body">
			<form class="form-horizontal" method="post" id="editar_categoria" name="editar_categoria">
			<div id="resultados_ajax2"></div>

				<div class="form-group">
				<label for="mod_tlinea_mod" class="col-sm-3 control-label">Tipo Linea:</label>
				<div class="col-md-8 col-sm-8 col-xs-12">
				  <select class="form-control estilo-placeholder" id="mod_tlinea_mod" name="mod_tlinea_mod" required >

					<option class="custom-select" value="">-- Selecciona Tipo de Linea --</option>

			            <?php
                       
                        $nom = array();
                        $sql2="select * from tipo_linea where estado = 1 ";
                        $i=0;
                        $rs1=mysqli_query($con,$sql2);
                        while($row3=mysqli_fetch_array($rs1)){
                            $nom_tlinea=$row3["nombre_tipoLinea"];
                            $id_tlinea=$row3["id_tipoLinea"];
                            ?>
                            <option class="custom-select" value="<?php  echo $id_tlinea;?>"><?php  echo $nom_tlinea;?></option>
                            <?php
                            $i=$i+1;
                        }
                        
                        ?>
                     
                         </select>
				</div>
			  </div>
			  <div class="form-group">
				<label for="mod_cat" class="col-sm-3 control-label">Nombre:</label>
				<div class="col-md-8 col-sm-8 col-xs-12">
				  <input type="text" class="form-control estilo-placeholder" id="mod_cat" name="mod_cat" placeholder="Nombre de la categoria" required>
					<input type="hidden" name="mod_id" id="mod_id">
				</div>
			  </div>
			   <div class="form-group">
				<label for="mod_des" class="col-sm-3 control-label">Descripcón:</label>
				<div class="col-md-8 col-sm-8 col-xs-12">
				  <textarea class="form-control estilo-placeholder" id="mod_des" name="mod_des" placeholder="Descripcion de la categoria" required></textarea>
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