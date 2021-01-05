
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
            
	<div class="modal fade" id="myModalMarca" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
               
            <div  role="document" class="modal-dialog modal-lg">
                
		<div class="modal-content">          
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title" id="myModalLabel">Editar Constante</h4>
		  </div>	
					 <br>
                    <span class="campos-obligatorios">Todos los campos son obligatorios</span>
                      
                    <div id="resultados_ajax2"></div>
		  <div class="modal-body" style="height:450px;overflow-y:scroll;">
                      
			<form class="form-horizontal" method="post" id="editar_constante" name="editar_constante">

		 <div class="form-group">
				<label for="mod_Montopc" class="col-sm-3 control-label">Monto de Porcentaje de Ganancia:</label>
				<div class="col-md-9 col-sm-9 col-xs-12">
				  <input type="number" class="form-control estilo-placeholder" id="mod_Montopc" name="mod_Montopc" maxlength="50">
				</div>
			    </div> 

                <div class="form-group">
				<label for="mod_descripcion" class="col-sm-3 control-label">Detalle:</label>
				<div class="col-md-9 col-sm-9 col-xs-12">
				  <input type="text" class="form-control estilo-placeholder" id="mod_descripcion" name="mod_descripcion" maxlength="50">
				</div>
			    </div> 
			    <div class="form-group">
				<label for="mod_dolar" class="col-sm-3 control-label">Tipo Cambio Dólar:</label>
				<div class="col-md-9 col-sm-9 col-xs-12">
				  <input type="texts" class="form-control estilo-placeholder" id="mod_dolar" name="mod_dolar" maxlength="50">
				</div>
			    </div> 

          	  <input type="hidden" class="form-control estilo-placeholder" id="mod_idConstante" name="mod_idConstante" maxlength="50">

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
	            <script type="text/javascript">
            	var input=  document.getElementById('mod_Montopc');
input.addEventListener('input',function(){
  if (this.value.length > 5) 
     this.value = this.value.slice(0,5); 
})

            	var input=  document.getElementById('mod_dolar');
input.addEventListener('input',function(){
  if (this.value.length > 9) 
     this.value = this.value.slice(0,9); 
})
            </script>
</html>