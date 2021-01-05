	<?php
		if (isset($con))
		{
	?>
	<!-- Modal -->
	<div class="modal fade" id="myModalMarcaTag" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalModelo">Editar Categorias de Marca</h4>
		  </div>
		  <div class="modal-body">
			<form class="form-horizontal" method="post" id="editar_marca_tag" name="editar_marca_tag">
			<div id="resultados_ajax2_tag"></div>

<div class="form-group">
				<p id="labelparaver" class="col-sm-12 control-label" style="text-align: center;"></p>
			</div>

	<!--
				<div class="form-group">
				<label for="mod_categorian_1" class="col-sm-3 control-label">Categoría:</label>
				<div class="col-md-8 col-sm-8 col-xs-12">
					<select class="form-control estilo-placeholder" id="mod_categorian_1" name="mod_categorian_1" disabled="true">

					<option class="custom-select" value="">-- Seleccione Categoría --</option>

			            <?php
                       
                        $nom = array();
                        $sql2="select * from categorias where estado = 1 ";
                        $i=0;
                        $rs1=mysqli_query($con,$sql2);
                        while($row3=mysqli_fetch_array($rs1)){
                            $nom_cat=$row3["nom_cat"];
                            $id_categoria=$row3["id_categoria"];
                            ?>
                            <option class="custom-select" value="<?php  echo $id_categoria;?>"><?php  echo $nom_cat;?></option>
                            <?php
                            $i=$i+1;
                        }
                        
                        ?>
                     
                         </select>
				</div>
			    </div>  -->

					<input type="hidden" name="mod_idmarca_1" id="mod_idmarca_1" >
					<input type="hidden" name="mod_idtlinea_1" id="mod_idtlinea_1" >
                <!--<div class="form-group">
				<label for="mod_nombre_1" class="col-sm-3 control-label">Nombre tipo Articulo:</label>
				<div class="col-md-8 col-sm-8 col-xs-12">
				  <input type="text" class="form-control estilo-placeholder" id="mod_nombre_1" name="mod_nombre_1" required="true" maxlength="50" readonly>
				</div>
			    </div> --> 

			<div id="resultados_ajax_marcatag"></div>
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-cancelar" data-dismiss="modal">Cerrar</button>
			<button type="submit" class="btn btn-agregar" id="actualizar_marca_tag">Actualizar Datos</button>
		  </div>
		  </form>
		</div>
	  </div>
	</div>
	<?php
		}
	?>