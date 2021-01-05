	<?php
		if (isset($con))
		{
	?>
	<!-- Modal -->
	<div class="modal fade" id="myModalTipoLinea" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalModelo">Editar tipo de linea</h4>
		  </div>
		  <div class="modal-body">
			<form class="form-horizontal" method="post" id="editar_tipoLinea" name="editar_tipoLinea">
			<div id="resultados_ajax2"></div>

                <div class="form-group">
				<label for="mod_nombre" class="col-sm-3 control-label">Nombre tipo linea:</label>
				<div class="col-md-9 col-sm-9 col-xs-12">
					<input type="hidden" name="mod_idtipo" id="mod_idtipo">
				  <input type="text" class="form-control estilo-placeholder" id="mod_nombre" name="mod_nombre" required="true"  maxlength="50">
				</div>
			    </div>  
                        
			    <div class="form-group">
				<label for="mod_descripcion" class="col-sm-3 control-label">Descripcion:</label>
				<div class="col-md-9 col-sm-9 col-xs-12">
				  <input type="text" class="form-control estilo-placeholder" id="mod_descripcion" name="mod_descripcion" maxlength="100">
				</div>
			    </div>

			     <div class="form-group" style="display:none;">
				<label for="mod_estado" class="col-sm-3 control-label">Estado</label>
				<div class="col-md-9 col-sm-9 col-xs-12">
                  <select class="form-control estilo-placeholder" id="mod_estado" name="mod_estado" required="true">
                       <option class="custom-select" value="1" checked >Activo</option>
                       <option class="custom-select" value="0">Inactivo</option>
                   </select>
				</div>
			    </div>
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-cancelar" data-dismiss="modal">Cerrar</button>
			<button type="submit" class="btn btn-agregar" id="actualizar_tipoLinea">Actualizar datos</button>
		  </div>
		  </form>
		</div>
	  </div>
	</div>
	<?php
		}
	?>