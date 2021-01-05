	<?php
		if (isset($con))
		{
	?>
	<!-- Modal -->
	<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document" >
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Editar Usuario</h4>
		  </div>
		  <div class="modal-body">
			 
		  	<span class="campos-obligatorios">LLenar los Campos Obligatorios (*)</span>
			<br><br>

		<form class="form-horizontal" method="post" id="editar_usuario" name="editar_usuario">
			<div id="resultados_ajax2"></div>

			<div class="form-group">
				<label for="firstname2" class="col-sm-3 control-label">(*)Nombre y Apellidos:</label>
				<div class="col-md-9 col-sm-9 col-xs-12">
				  <input type="text" class="form-control estilo-placeholder" id="firstname2" name="firstname2" placeholder="Nombres" required>
				  <input type="hidden" id="mod_id" name="mod_id">
				</div>
			  </div>
			  
			  <div class="form-group">
				<label for="user_name2" class="col-sm-3 control-label">(*) Usuario:</label>
				<div class="col-md-9 col-sm-9 col-xs-12">
				  <input type="text" class="form-control estilo-placeholder" id="user_name2" name="user_name2" placeholder="Usuario" pattern="[a-zA-Z0-9]{2,64}" title="Nombre de usuario ( sólo letras y números, 2-64 caracteres)"required>
				</div>
			  </div>
                        
			  <div class="form-group">
				<label for="user_email2" class="col-sm-3 control-label">Email:</label>
				<div class="col-md-9 col-sm-9 col-xs-12">
				  <input type="email" class="form-control estilo-placeholder" id="user_email2" name="user_email2" placeholder="Correo electrónico">
				</div>
			  </div>

			  <div class="form-group">
				<label for="dom" class="col-sm-3 control-label">Domicilio:</label>
				<div class="col-md-9 col-sm-9 col-xs-12">
				  <input type="text" class="form-control estilo-placeholder" id="dom" name="dom" placeholder="Domicilio">
				</div>
			  </div>
                        
              <div class="form-group">
			  	<label for="dni" class="col-sm-3 control-label">DNI:</label>
				<div class="col-md-9 col-sm-9 col-xs-12">
				  <input type="text" class="form-control estilo-placeholder" id="mod_dni" name="mod_dni" placeholder="DNI" maxlength="8" onKeyPress="return soloNumeros(event)">
				</div>
			  </div>
			  
			  <div class="form-group">
				<label for="tel" class="col-sm-3 control-label">Teléfono:</label>
				<div class="col-md-9 col-sm-9 col-xs-12">
				  <input type="text" class="form-control estilo-placeholder" id="tel" name="tel" placeholder="telefono" maxlength="9" onKeyPress="return soloNumeros(event)">
				</div>
			  </div>
                        
                        
            <!--<div class="form-group">
				<label for="hora_entrada" class="col-sm-3 control-label">Hora de Entrada:</label>
				<div class="col-md-3 col-sm-3 col-xs-12">
				  <input type="time" class="form-control estilo-placeholder" id="hora" name="hora" placeholder="Hora de Entrada">
				</div>
			</div>-->

			<div class="form-group">
				<label for="hora_entrada" class="col-sm-3 control-label">Sucursal Asignada:</label>
				<div class="col-md-9 col-sm-9 col-xs-12">
				  <input type="number" class="form-control estilo-placeholder" id="mod_sucursal" name="mod_sucursal" placeholder="Sucursal">
				</div>
			</div>
                        
                        

                        
            <div class="form-group" style="display: none;">
				<label for="estado" class="col-sm-3 control-label">Estado</label>
				<div class="col-md-9 col-sm-9 col-xs-12">
				  <select class="form-control estilo-placeholder" id="cboEstado" name="cboEstado" >
				      <option class="custom-select" value="0">Seleccion Opcion</option>
				      <option class="custom-select" value="1" selected>Activo</option>
				      <option class="custom-select" value="2">Desactivo</option> 
				    </select>
				</div>
			</div>
                        
                        
                    
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-cancelar" data-dismiss="modal">Cerrar</button>
			<button type="submit" class="btn btn-agregar" id="actualizar_datos2">Actualizar Datos</button>
		  </div>
		</form>
		</div>
	  </div>
	</div>
	<?php
		}
	?>