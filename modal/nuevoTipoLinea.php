	<!doctype html>
<html lang="en">
<head>

   <script>
  function limpiarFormulario() {
    document.getElementById("guardar_tipoLinea").reset();
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
            
	<div class="modal fade" id="nuevoTipoLinea" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	 
         
               
            <div class="modal-dialog" role="document">
               
                
		<div class="modal-content">
                    
                  
                    
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Agregar Nuevo Tipo Linea </h4>
		  </div>
                    <br>
                    <span class="campos-obligatorios">Todos los campos son obligatorios</span>
                      
                    <div id="resultados_ajax"></div>
		  <div class="modal-body" style="height:450px;overflow-y: scroll;">
                      
			<form class="form-horizontal" method="post" id="guardar_tipoLinea" name="guardar_tipoLinea">

              <div class="form-group">
				<label for="nombre" class="col-sm-3 control-label">(*) Nombre:</label>
				<div class="col-md-9 col-sm-9 col-xs-12">
				  <input type="text" class="form-control estilo-placeholder" id="nombre" name="nombre" placeholder="Ingrese nombre tipo linea" required maxlength="50">
				</div>
			  </div>
			  <div class="form-group">
				<label for="descripcion" class="col-sm-3 control-label">Descripcion:</label>
				<div class="col-md-9 col-sm-9 col-xs-12">
				 <input type="text" class="form-control  estilo-placeholder" id="descripcion" name="descripcion" placeholder="Ingrese descripcion" maxlength="100" >
				</div>
			   </div>

		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-limpiar" onclick="limpiarFormulario()">Limpiar</button>
                      <button type="button" class="btn btn-cancelar" data-dismiss="modal">Cerrar</button>
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