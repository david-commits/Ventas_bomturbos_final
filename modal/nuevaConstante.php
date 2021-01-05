
<html lang="es" >
<head>

   <script>
  function limpiarFormulario() {
    document.getElementById("guardar_constante").reset();
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
        
          <body>  
            
	<div class="modal fade" id="nuevaConstante" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"  >
               
            <div  role="document" class="modal-dialog modal-lg">
                
		<div class="modal-content">          
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Agregar nueva Constante</h4>
		  </div>	
					 <br>
                    <span class="campos-obligatorios">Todos los campos son obligatorios</span>
                      
                    <div id="resultados_ajax2"></div>
		  <div class="modal-body" style="height:450px;overflow-y:scroll;">
                      
			<form class="form-horizontal" method="post" id="guardar_constante" name="guardar_constante">

			  <div class="form-group">
				<label for="montoconst" class="col-sm-3 control-label">(*)Monto de Porcentaje de Ganancia:</label>
				<div class="col-md-9 col-sm-9 col-xs-12">
				  <input type="number" step="any" class="form-control estilo-placeholder" id="montoconst" name="montoconst" placeholder="Ingrese monto de la constante" required maxlength="50">
				</div>
			  </div>

			  <div class="form-group">
				<label for="detalleconst" class="col-sm-3 control-label">(*)Detalle:</label>
				<div class="col-md-9 col-sm-9 col-xs-12">
				  <input type="text"  class="form-control estilo-placeholder" id="detalleconst" name="detalleconst" placeholder="Ingrese Detalle de la constante" required maxlength="50">
				</div>
			  </div>

              <div class="form-group">
				<label for="dolarconst" class="col-sm-3 control-label">(*)Tipo Cambio Dólar:</label>
				<div class="col-md-9 col-sm-9 col-xs-12">
				  <input type="number" step="any" class="form-control estilo-placeholder" id="dolarconst" name="dolarconst" placeholder="Ingrese dólar de la constante" required maxlength="50">
				</div>
			  </div> 

          

		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-limpiar" onclick="limpiarFormulario()">Limpiar</button>
                      <button type="button" class="btn btn-cancelar" data-dismiss="modal">Cerrar</button>
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
            	var input=  document.getElementById('dolarconst');
input.addEventListener('input',function(){
  if (this.value.length > 9) 
     this.value = this.value.slice(0,9); 
})

            	var input=  document.getElementById('montoconst');
input.addEventListener('input',function(){
  if (this.value.length > 5) 
     this.value = this.value.slice(0,5); 
})
            </script>
</html>