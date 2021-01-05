	<!doctype html>
<html lang="es" >
<head>

   <script>
  function limpiarFormulario() {
    document.getElementById("guardar_cliente").reset();
  }

  function limpiarFormularioCerrar() {
    document.getElementById("guardar_cliente").reset();
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
		if (isset($con))
		{
	?>
	<!-- Modal -->
         

	<div class="modal fade" id="nuevoCliente" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header" >
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Agregar nuevo cliente</h4>
		  </div>
		   <br>
                    <span class="campos-obligatorios">Todos los campos son obligatorios</span>
           <br>          
                    
                    <div id="resultados_ajax"></div>
                    
                    
                    
                    
		  <div class="modal-body" style="height:450px;overflow-y: scroll;">
                      
                      
                      
			<form class="form-horizontal" method="post" id="guardar_cliente" name="guardar_cliente">
	             
                            <div class="form-group">
				<label for="nombre" class="col-sm-3 control-label">Razon Social:</label>
				<div class="col-md-9 col-sm-9 col-xs-12">
				  <input type="text" class="form-control estilo-placeholder"  id="nombre" name="nombre" placeholder="Razon Social" required>
				</div>
			  </div>
                            
                             <div class="form-group">
				<label for="doc" class="col-sm-3 control-label">RUC:</label>
				<div class="col-md-9 col-sm-9 col-xs-12">

				  <input type="text" class="form-control estilo-placeholder" onKeyUp="mostrarValor(this.value);" id="doc" name="doc" placeholder="RUC" onKeyPress="return soloNumeros(event)" maxlength="11">

				</div>
			  </div>
                         <div class="form-group">
				<label for="doc" class="col-sm-3 control-label">DNI:</label>
				<div class="col-md-9 col-sm-9 col-xs-12">

				  <input type="text" class="form-control estilo-placeholder" id="dni" name="dni" placeholder="DNI" onKeyPress="return soloNumeros(event)" maxlength="8">

				</div>
			  </div>
                            
                        
                        
                        
			  <div class="form-group">
				<label for="telefono" class="col-sm-3 control-label">Teléfono:</label>
				<div class="col-md-9 col-sm-9 col-xs-12">

				  <input type="tel" class="form-control estilo-placeholder" id="telefono" name="telefono" placeholder="Teléfono" onKeyPress="return soloNumeros(event)" maxlength="9">

				</div>
			  </div>
			  
			  <div class="form-group">
				<label for="email" class="col-sm-3 control-label">Email:</label>
				<div class="col-md-9 col-sm-9 col-xs-12">
					<input type="email" class="form-control estilo-placeholder" id="email" name="email" placeholder="Email">
				  
				</div>
			  </div>
			  
                             <div class="form-group">
				<label for="departamento" class="col-sm-3 control-label">Departamento:</label>
				<div class="col-md-9 col-sm-9 col-xs-12">
					<input type="text" class="form-control estilo-placeholder" id="departamento" name="departamento" placeholder="Departamento">
				  
				</div>
			  </div>
                            
                           <div class="form-group">
				<label for="provincia" class="col-sm-3 control-label">Provincia:</label>
				<div class="col-md-9 col-sm-9 col-xs-12">
					<input type="text" class="form-control estilo-placeholder" id="provincia" name="provincia" placeholder="Provincia">
				  
				</div>
			  </div> 
                            
                            
                            
                            <div class="form-group">
				<label for="distrito" class="col-sm-3 control-label">Distrito:</label>
				<div class="col-md-9 col-sm-9 col-xs-12">
					<input type="text" class="form-control estilo-placeholder" id="distrito" name="distrito" placeholder="Distrito">
				  
				</div>
			  </div>  
                            
                            
			  <div class="form-group">
				<label for="direccion" class="col-sm-3 control-label">Dirección:</label>
				<div class="col-md-9 col-sm-9 col-xs-12">
					<textarea class="form-control estilo-placeholder" id="direccion" name="direccion"   maxlength="255" placeholder="Dirección"></textarea>
				  
				</div>
			  </div>

			  <div class="form-group">
				<label for="prct_cliente_desc" class="col-sm-3 control-label">Porcentaje Desc.:</label>
				<div class="col-md-9 col-sm-9 col-xs-12">
					<input class="form-control estilo-placeholder" id="prct_cliente_desc" name="prct_cliente_desc"   maxlength="255" placeholder="Porcentaje Desc."></input>
				  
				</div>
			  </div>

			  <div class="form-group">
				<label for="ver_codigo_cliente" class="col-sm-3 control-label">Código web:</label>
				<div class="col-md-9 col-sm-9 col-xs-12">
					<select  class="form-control estilo-placeholder" id="ver_codigo_cliente" name="ver_codigo_cliente" required>
                <option class="custom-select" value="0">-- Selecciona Código --</option>
                    <option class="custom-select" value="1">Código Proveedor</option> 
                    <option class="custom-select" value="2">Código Original</option> 
                    <option class="custom-select" value="3">Código Producto</option> 
              </select>
				  
				</div>
			  </div>

			    <div class="form-group">
          <label for="sucursal_cliente" class="col-sm-3 control-label">Sucursal:</label>
            <div class="col-md-9 col-sm-9 col-xs-12">
              <select  class="form-control estilo-placeholder" id="sucursal_cliente" name="sucursal_cliente" required>
                <option class="custom-select" value="0">-- Selecciona Sucursal --</option>
                  <?php
                    $nom = array();
                    $sql2="select * from sucursal";
                    $i=0;
                    $rs1=mysqli_query($con,$sql2);
                    while($row3=mysqli_fetch_array($rs1)){
                      $nombre=$row3["nombre"];
                      $id_sucursal=$row3["id_sucursal"];
                  ?>
                    <option class="custom-select" value="<?php  echo $id_sucursal;?>"><?php  echo $nombre;?></option>
                  <?php
                    $i=$i+1;
                    }    
                  ?>  
              </select>
            </div>
        </div>

			  
                             <div class="form-group">
				<label for="cuenta" class="col-sm-3 control-label">Cuenta Bancaria:</label>
				<div class="col-md-9 col-sm-9 col-xs-12">
					<textarea class="form-control estilo-placeholder" id="cuenta" name="cuenta"   maxlength="255" placeholder="Cuenta Bancaria"></textarea>
				  
				</div>
			  </div>
                            
                           <div class="form-group">
				<label for="ven" class="col-sm-3 control-label">Vendedor:</label>
				<div class="col-md-9 col-sm-9 col-xs-12">
				  <input type="text" class="form-control estilo-placeholder" id="ven" name="ven" placeholder="Vendedor">
				</div>
			  </div>  
                            
                            
			  <div class="form-group" style="display: none;">
				<label for="estado" class="col-sm-3 control-label">Estado:</label>
				<div class="col-md-9 col-sm-9 col-xs-12">
				 <select class="form-control" id="estado" name="estado" required>
					<option value="">-- Selecciona estado --</option>
					<option value="1" selected >Activo</option>
					<option value="0">Inactivo</option>
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

            
            </body>
            
</html>

