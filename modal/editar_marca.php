	<?php
		if (isset($con))
		{
	?>
	<!-- Modal -->
	<div class="modal fade" id="myModalMarca" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Editar marca</h4>
		  </div>
		  <div class="modal-body" style="height:500px;overflow-y: scroll;">
			<form class="form-horizontal" method="post" id="editar_marca" name="editar_marca">
			<div id="resultados_ajax2"></div>

			<div class="form-group">
				<label for="mod_idTipo" class="col-sm-3 control-label">Tipo de Linea:</label>
				<div class="col-md-9 col-sm-9 col-xs-12">
				 <input type="hidden" name="mod_idMarca" id="mod_idMarca">
				<select class="form-control estilo-placeholder" id="mod_idTipo" name="mod_idTipo" required>
					<option class="custom-select" value="">-- Selecciona marca --</option>
			            <?php
                       
                        $nom = array();
                        $sql2="select * from tipo_linea where estado = 1 ";
                        $i=0;
                        $rs1=mysqli_query($con,$sql2);
                        while($row3=mysqli_fetch_array($rs1)){
                            $nombre_tipoLinea=$row3["nombre_tipoLinea"];
                            $id_tipoLinea=$row3["id_tipoLinea"];
                            ?>
                            <option class="custom-select" value="<?php  echo $id_tipoLinea;?>"><?php  echo $nombre_tipoLinea;?></option>
                            <?php
                            $i=$i+1;
                        }
                        
                        ?>
                     
                         </select>

				</div>
			  </div>
                        
                <div class="form-group">
				<label for="nombre" class="col-sm-3 control-label">Nombre Marca:</label>
				<div class="col-md-9 col-sm-9 col-xs-12">
				  <input type="text" class="form-control estilo-placeholder" id="mod_marca" name="mod_marca" maxlength="50">
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