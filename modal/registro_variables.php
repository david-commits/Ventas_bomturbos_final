	<!doctype html>
<html lang="en">
<head>
<script>
  function limpiarFormulario() {
    document.getElementById("guardar_variables").reset();
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
            
	<div class="modal fade" id="nuevoProducto" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	 
         
               
            <div class="modal-dialog" role="document">
              
           
                
                
		<div class="modal-content" >
                    
                  
                    
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Agregar nueva variable laboral</h4>
		  </div>
		  <div class="modal-body">
			<form class="form-horizontal" method="post" id="guardar_variables" name="guardar_variables">
			<div id="resultados_ajax"></div>
                        
                        <div class="form-group">
				<label for="variables" class="col-sm-3 control-label">Codigo:</label>
				<div class="col-md-8 col-sm-8 col-xs-12">
				  <input type="text" class="form-control estilo-placeholder" id="cod_var" name="cod_var" placeholder="Codigo de la variable" required>
				</div>
			  </div>
			  <div class="form-group">
				<label for="variables" class="col-sm-3 control-label">Nombre:</label>
				<div class="col-md-8 col-sm-8 col-xs-12">
				  <input type="text" class="form-control estilo-placeholder" id="variables" name="variables" placeholder="Nombre de la variable" required>
				</div>
			  </div>
			  
                     
                        
                        
			  <div class="form-group">
				<label for="des_var" class="col-sm-3 control-label">Descripcion:</label>
				<div class="col-md-8 col-sm-8 col-xs-12">
					<input type="text" class="form-control estilo-placeholder" id="des_var" name="des_var" placeholder="Descripcion de la variable" required>
				  
				</div>
			  </div>
                        
                        <div class="form-group">
				<label for="color" class="col-sm-3 control-label">Color:</label>
				<div class="col-md-8 col-sm-8 col-xs-12">
					<input class="form-control estilo-placeholder" type="color" id="color" name="col_var" placeholder="col_var" placeholder="Color de la variable" required>
				  
				</div>
			  </div>
                        
			 
			
		  </div>
		  <div class="modal-footer">
                       <button type="button" class="btn btn-cancelar" onclick="limpiarFormulario()">Limpiar</button>
			<button type="button" class="btn btn-cancelar" data-dismiss="modal">Cerrar</button>
			<button type="submit" class="btn btn-guardar" id="guardar_datos">Guardar datos</button>
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