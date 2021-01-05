	<?php
	if (isset($con)) {
	?>
		<!-- Modal -->
		<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="myModalLabel">Editar Proveedores</h4>
					</div>
					<div class="modal-body" style="height:500px;overflow-y: scroll;">
						<form class="form-horizontal" method="post" id="editar_proveedores" name="editar_proveedores">
							<div id="resultados_ajax2"></div>

							<div class="form-group">
								<label for="mod_nombre" class="col-sm-3 control-label">Razón Social:</label>
								<div class="col-md-9 col-sm-9 col-xs-12">
									<input type="text" class="form-control estilo-placeholder" id="mod_nombre" name="mod_nombre" required>
									<input type="hidden" name="mod_id" id="mod_id">
								</div>
							</div>

							<div class="form-group">
								<label for="mod_codprove" class="col-sm-3 control-label">Código Proveedor:</label>
								<div class="col-md-9 col-sm-9 col-xs-12">
									<input type="text" class="form-control estilo-placeholder" id="mod_codprove" name="mod_codprove">
								</div>
							</div>

							<div class="form-group">
								<label for="mod_doc" class="col-sm-3 control-label">R.U.C.:</label>
								<div class="col-md-9 col-sm-9 col-xs-12">
									<input type="text" class="form-control estilo-placeholder" id="mod_doc" name="mod_doc">
								</div>
							</div>

							<!--      
							<div class="form-group">
								<label for="mod_dni" class="col-sm-3 control-label">DNI</label>
								<div class="col-md-8 col-sm-8 col-xs-12">
								<input type="text" class="form-control" id="mod_dni" name="mod_dni">
								</div>
							</div>
                        	-->

							<div class="form-group">
								<label for="mod_telefono" class="col-sm-3 control-label">Teléfono:</label>
								<div class="col-md-9 col-sm-9 col-xs-12">
									<input type="tel" class="form-control estilo-placeholder" id="mod_telefono" name="mod_telefono" maxlength="9">
								</div>
							</div>

							<div class="form-group">
								<label for="mod_email" class="col-sm-3 control-label">Email:</label>
								<div class="col-md-9 col-sm-9 col-xs-12">
									<input type="email" class="form-control estilo-placeholder" id="mod_email" name="mod_email">
								</div>
							</div>

							<div class="form-group">
								<label for="mod_departamento" class="col-sm-3 control-label">Departamento:</label>
								<div class="col-md-9 col-sm-9 col-xs-12">
									<input type="text" class="form-control estilo-placeholder" id="mod_departamento" name="mod_departamento" placeholder="Departamento">
								</div>
							</div>

							<div class="form-group">
								<label for="mod_provincia" class="col-sm-3 control-label">Provincia:</label>
								<div class="col-md-9 col-sm-9 col-xs-12">
									<input type="text" class="form-control estilo-placeholder" id="mod_provincia" name="mod_provincia" placeholder="Provincia">
								</div>
							</div>

							<div class="form-group">
								<label for="mod_distrito" class="col-sm-3 control-label">Distrito:</label>
								<div class="col-md-9 col-sm-9 col-xs-12">
									<input type="text" class="form-control estilo-placeholder" id="mod_distrito" name="mod_distrito" placeholder="Distrito">
								</div>
							</div>


							<div class="form-group">
								<label for="mod_direccion" class="col-sm-3 control-label">Dirección:</label>
								<div class="col-md-9 col-sm-9 col-xs-12">
									<textarea class="form-control estilo-placeholder" id="mod_direccion estilo-placeholder" name="mod_direccion" maxlength="255" placeholder="Dirección"></textarea>
								</div>
							</div>

							<div class="form-group">
								<label for="mod_cuenta" class="col-sm-3 control-label">Cuenta Bancaria:</label>
								<div class="col-md-9 col-sm-9 col-xs-12">
									<textarea class="form-control estilo-placeholder" id="mod_cuenta" name="mod_cuenta" maxlength="255" placeholder="Cuenta Bancaria"></textarea>
								</div>
							</div>

							<div class="form-group">
								<label for="mod_ven" class="col-sm-3 control-label">Vendedor:</label>
								<div class="col-md-9 col-sm-9 col-xs-12">
									<input type="text" class="form-control estilo-placeholder" id="mod_ven" name="mod_ven">
								</div>
							</div>

							<div class="form-group" style="display: none;">
								<label for="mod_estado" class="col-sm-3 control-label">Estado:</label>
								<div class="col-md-9 col-sm-9 col-xs-12">
									<select class="form-control estilo-placeholder" id="mod_estado" name="mod_estado" required>
										<option class="custom-select" value="">-- Selecciona estado --</option>
										<option class="custom-select" value="1" selected>Activo</option>
										<option class="custom-select" value="0">Inactivo</option>
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