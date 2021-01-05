	<?php
		if (isset($con))
		{
	?>
	<!-- Modal -->
	<script>
	
		function limpiarFormularioCerrar() {
			document.getElementById("guardar_usuario").reset();
		}
		function limpiarFormulario() {
			document.getElementById("guardar_usuario").reset();
		}
		function soloNumeros(e){
    		var key = window.event ? e.which : e.keyCode;
   			if (key < 48 || key > 57) {
				//Usando la definición del DOM level 2, "return" NO funciona.
				e.preventDefault();
    		}
 		}
	</script>
	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
		<div class="modal-content" >
		  <div class="modal-header" >
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Agregar nuevo usuario</h4>
		  </div>
		   <br>
                    <span class="campos-obligatorios">Todos los campos son obligatorios</span>
		  <div class="modal-body">
			<form class="form-horizontal" method="post" id="guardar_usuario" name="guardar_usuario">
			<!--<font color="black">LLenar los campos obligatorios</font> <font style="background-color:#A9F5BC;color:white; "> &nbsp;&nbsp;&nbsp;&nbsp;</font>-->
                        
            <div id="resultados_ajax"></div>
			<div class="form-group">
				<label for="firstname" class="col-sm-3 control-label">(*) Nombres y Apellidos:</label>
				<div class="col-md-9 col-sm-9 col-xs-12">
				  <input type="text" class="form-control  estilo-placeholder" id="firstname" name="firstname" placeholder="Nombres" required>
				</div>
			</div>
			 
			<div class="form-group">
				<label for="user_name" class="col-sm-3 control-label">(*) Usuario:</label>
				<div class="col-md-9 col-sm-9 col-xs-12">
				  <input type="text" class="form-control  estilo-placeholder" id="user_name" name="user_name" placeholder="Usuario" pattern="[a-zA-Z0-9]{2,64}" title="Nombre de usuario ( sólo letras y números, 2-64 caracteres)"required>
				</div>
			</div>
			<div class="form-group">
				<label for="user_email" class="col-sm-3 control-label">(*) Email:</label>
				<div class="col-md-9 col-sm-9 col-xs-12">
				  <input type="email" class="form-control  estilo-placeholder" id="user_email" name="user_email" placeholder="Correo electrónico">
				</div>
			 </div>
            <div class="form-group">
				<label for="telefono" class="col-sm-3 control-label">Teléfono:</label>
				<div class="col-md-9 col-sm-9 col-xs-12">
				  <input type="text" class="form-control  estilo-placeholder" id="telefono" name="telefono" placeholder="Telefonos" maxlength="9" onKeyPress="return soloNumeros(event)">
				</div>
			</div>
                            
            <div class="form-group">
				<label for="domicilio" class="col-sm-3 control-label">Domicilio:</label>
				<div class="col-md-9 col-sm-9 col-xs-12">
				  <input type="text" class="form-control  estilo-placeholder" id="domicilio" name="domicilio" placeholder="Domiclio" >
				</div>
			</div> 
			<div class="form-group"> 
				<label for="dni" class="col-sm-3 control-label">(*) DNI:</label>
				<div class="col-md-9 col-sm-9 col-xs-12">
				  <input type="text" class="form-control  estilo-placeholder" id="dni" name="dni" placeholder="DNI" maxlength="8" onKeyPress="return soloNumeros(event)">
				</div>
			 </div>
                        
                        
                        
                         
                        
			 <div class="form-group">
				<label for="user_password_new" class="col-sm-3 control-label">(*) Contraseña:</label>
				<div class="col-md-9 col-sm-9 col-xs-12">
				  <input type="password"  class="form-control  estilo-placeholder" id="user_password_new" name="user_password_new" placeholder="Contraseña" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" title="Contraseña (Debe contener al menos un número y una letra mayúscula y minúscula, y al menos 6 o más caracteres)" required>
				</div>
			 
				<label for="user_password_repeat" class="col-sm-3 control-label">(*) Repetir:</label>
				<div class="col-md-9 col-sm-9 col-xs-12">
				  <input type="password" class="form-control  estilo-placeholder" id="user_password_repeat" name="user_password_repeat" placeholder="Repite contraseña" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" required>
				</div>
			 </div>
			 
			<div class="form-group">
				<label for="telefono" class="col-sm-3 control-label">(*) Estado:</label>
				<div class="col-md-9 col-sm-9 col-xs-12">
				  <select class="form-control  estilo-placeholder" id="cboEstado" name="cboEstado" >
				      <option  class="custom-select"value="1">Activo</option>
				      <option  class="custom-select"value="2">Desactivo</option>
				    </select>
				</div>
			</div>
                       
		  </div>
		  <div class="modal-footer">
                      <button type="button" class="btn btn-limpiar" onclick="limpiarFormulario()">Limpiar</button>
			<button type="button" class="btn btn-cancelar" data-dismiss="modal" onclick="limpiarFormularioCerrar()">Cerrar</button>
			<button type="submit" class="btn btn-agregar" id="guardar_datos">Guardar datos</button>
		  </div>
		  </form>
		</div>
	  </div>
	</div>
	<?php
		}
	?>