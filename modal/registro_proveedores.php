	<!doctype html>
<html lang="en">
<head>

   <script>
  function limpiarFormulario() {
    document.getElementById("guardar_proveedores").reset();
  }
    function limpiarFormularioCerrar() {
    document.getElementById("guardar_proveedores").reset();
  }
  function soloNumeros(e){
    var key = window.event ? e.which : e.keyCode;
    if (key < 48 || key > 57) {
        //Usando la definición del DOM level 2, "return" NO funciona.
        e.preventDefault();
    }
  }
</script>


</head>


<?php
        //include('conexion.php');
        //include('menu.php');
        
        
        
		if (isset($con))
		{
	?>

	<!-- Modal -->
     
        
		<body>
			<div class="modal fade" id="nuevoProveedores" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<h4 class="modal-title" id="myModalLabel">Agregar Nuevo Proveedor</h4>
						</div>
							<br>
							<span class="campos-obligatorios">LLenar los campos obligatorios</span>
						<div id="resultados_ajax"></div>
						<div class="modal-body" style="height:450px;overflow-y: scroll;">

							<form class="form-horizontal" method="post" id="guardar_proveedores" name="guardar_proveedores">

								<div class="form-group">
									<label for="nombre" class="col-sm-4 control-label">Nombre del Proveedor (*):</label>
									<div class="col-md-8 col-sm-8 col-xs-12">
										<input type="text" class="form-control estilo-placeholder" id="nombre" name="nombre" placeholder="Razon Social" required>
									</div>
								</div>
                        	
								<div class="form-group">
									<label for="codprov" class="col-sm-4 control-label">Código Proveedor:</label>
									<div class="col-md-8 col-sm-8 col-xs-12">
										<input type="text" class="form-control estilo-placeholder" id="codprov" name="codprov" placeholder="Código Proveedor" maxlength="50">
									</div>
								</div>


								<div class="form-group">
									<label for="doc" class="col-sm-4 control-label">RUC:</label>
									<div class="col-md-8 col-sm-8 col-xs-12">
										<input type="text" class="form-control estilo-placeholder" id="doc" name="doc" placeholder="RUC" maxlength="11" onKeyPress="return soloNumeros(event)">
									</div>
								</div>
                        
                <!--        <div class="form-group">
				<label for="doc" class="col-sm-3 control-label">DNI</label>
				<div class="col-md-8 col-sm-8 col-xs-12">
				  <input type="text" class="form-control" id="dni" name="dni" placeholder="DNI" maxlength="8" onKeyPress="return soloNumeros(event)">
				</div>
			  </div>-->
                            
                        
                        
                        
								<div class="form-group">
									<label for="telefono" class="col-sm-4 control-label">Teléfono:</label>
									<div class="col-md-8 col-sm-8 col-xs-12">
										<input type="number" class="form-control estilo-placeholder" id="telefono" name="telefono" placeholder="Teléfono" maxlength="9">
									</div>
								</div>

								<div class="form-group">
									<label for="email" class="col-sm-4 control-label">Email:</label>
									<div class="col-md-8 col-sm-8 col-xs-12">
										<input type="email" class="form-control estilo-placeholder" id="email" name="email" placeholder="Email">

									</div>
								</div>

								<div class="form-group">
									<label for="departamento" class="col-sm-4 control-label">Departamento:</label>
									<div class="col-md-8 col-sm-8 col-xs-12">
										<input type="text" class="form-control estilo-placeholder" id="departamento" name="departamento" placeholder="Departamento">

									</div>
								</div>

								<div class="form-group">
									<label for="provincia" class="col-sm-4 control-label">Provincia:</label>
									<div class="col-md-8 col-sm-8 col-xs-12">
										<input type="text" class="form-control estilo-placeholder" id="provincia" name="provincia" placeholder="Provincia">

									</div>
								</div>
                            
                            
                            
								<div class="form-group">
									<label for="distrito" class="col-sm-4 control-label">Distrito:</label>
									<div class="col-md-8 col-sm-8 col-xs-12">
										<input type="text" class="form-control estilo-placeholder" id="distrito" name="distrito" placeholder="Distrito">

									</div>
								</div>


								<div class="form-group">
									<label for="direccion" class="col-sm-4 control-label">Dirección:</label>
									<div class="col-md-8 col-sm-8 col-xs-12">
										<textarea class="form-control estilo-placeholder" id="direccion" name="direccion" maxlength="255" placeholder="Dirección"></textarea>

									</div>
								</div>

								<div class="form-group">
									<label for="cuenta" class="col-sm-4 control-label">Cuenta Bancaria:</label>
									<div class="col-md-8 col-sm-8 col-xs-12">
										<textarea class="form-control estilo-placeholder" id="cuenta" name="cuenta" maxlength="255" placeholder="Cuenta Bancaria"></textarea>

									</div>
								</div>

								<div class="form-group">
									<label for="ven" class="col-sm-4 control-label">Vendedor:</label>
									<div class="col-md-8 col-sm-8 col-xs-12">
										<input type="text" class="form-control estilo-placeholder" id="ven" name="ven" placeholder="Vendedor">
									</div>
								</div>
			 

								<div class="form-group" style="display: none;">
									<label for="estado" class="col-sm-4 control-label">Estado:</label>
									<div class="col-md-8 col-sm-8 col-xs-12">
										<select class="form-control estilo-placeholder" id="estado" name="estado" required>
											<option class="custom-select" value="">-- Selecciona estado --</option>
											<option class="custom-select" value="1" selected>Activo</option>
											<option class="custom-select" value="0">Inactivo</option>
										</select>
									</div>
								</div>



		  </div>
		  <div class="modal-footer">
							<button type="button" class="btn btn-cancelar" data-dismiss="modal" onclick="limpiarFormularioCerrar()">Cerrar</button>
							<button type="button" class="btn btn-limpiar" onclick="limpiarFormulario()">Limpiar</button>
							<button type="submit" class="btn btn-agregar" id="guardar_datos">Guardar Datos</button>
						</div>
						</form>
		</div>
	  </div>
	</div>
	<?php
		}
	?>

      
        
            
            </body>
            <script type="text/javascript">
            	            	var input=  document.getElementById('telefono');
input.addEventListener('input',function(){
  if (this.value.length > 12) 
     this.value = this.value.slice(0,12); 
})
            </script>
</html>