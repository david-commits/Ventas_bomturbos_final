<script>
  function limpiarFormulario() {
    document.getElementById("guardar_sucursal").reset();
  }
    function soloNumeros(e){
    var key = window.event ? e.which : e.keyCode;
    if (key < 48 || key > 57) {
        //Usando la definición del DOM level 2, "return" NO funciona.
        e.preventDefault();
    }
  }
</script>
 <style type="text/css"> 
.thumb {
            height: 100px;
            width:170px;
            border: 1px solid #000;
            margin: 10px 5px 0 0;
          }
</style> 
	<?php
		if (isset($con))
		{
	?>
	<!-- Modal -->
	<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
		<div class="modal-content" >
		  <div class="modal-header" >
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Editar Sucursal</h4>
		  </div>
		  <div class="modal-body">
			<form class="form-horizontal" method="post" id="editar_sucursal" name="editar_sucursal">
			<div id="resultados_ajax2"></div>
			  <div class="form-group">
				<label for="mod_nombre" class="col-sm-3 control-label">(*)Nombre:</label>
				<div class="col-md-8 col-sm-8 col-xs-12">
				  <input type="text" class="form-control  estilo-placeholder" id="mod_nombre" name="mod_nombre" placeholder="Nombre de la tienda" required>
					<input type="hidden" name="mod_id" id="mod_id">
				</div>
			  </div>
			   <div class="form-group">
				<label for="mod_ruc" class="col-sm-3 control-label">(*)Ruc:</label>
				<div class="col-md-8 col-sm-8 col-xs-12">
				  <textarea class="form-control estilo-placeholder" id="mod_ruc" name="mod_ruc" onKeyPress="return soloNumeros(event)"  placeholder="Ruc" required></textarea>
				</div>
			  </div>
			  
			  <div class="form-group">
				<label for="mod_direccion" class="col-sm-3 control-label">(*)Direccion:</label>
				<div class="col-md-8 col-sm-8 col-xs-12">
				  <textarea class="form-control estilo-placeholder" id="mod_direccion" name="mod_direccion" placeholder="Direccion" required></textarea>
				</div>
			  </div>
                        
                        <div class="form-group">
				<label for="mod_correo" class="col-sm-3 control-label">(*)Correo:</label>
				<div class="col-md-8 col-sm-8 col-xs-12">
				  <textarea type="email" class="form-control estilo-placeholder" id="mod_correo" name="mod_correo" placeholder="Correo" required></textarea >
				</div>
			  </div>
                        
                        <div class="form-group">
				<label for="mod_telefono" class="col-sm-3 control-label">(*)Teléfono:</label>
				<div class="col-md-8 col-sm-8 col-xs-12">
				  <textarea class="form-control estilo-placeholder" id="mod_telefono" name="mod_telefono" placeholder="Telefono" onKeyPress="return soloNumeros(event)"  required></textarea>
				</div>
			  </div>

				<div class="form-group">
					<label for="mod_estado_sucursal" class="col-sm-3 control-label">Estado Sede:</label>
						<div class="col-md-8 col-sm-8 col-xs-12">
				  			<select  class="form-control estilo-placeholder" id="mod_estado_sucursal" name="mod_estado_sucursal" required>
                <option class="custom-select" value="0">-- Seleccione --</option>
                <option class="custom-select" value="1">Sede Principal</option>

              </select>
						</div>
			  	</div>
			
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-cancelar" data-dismiss="modal">Cerrar</button>
			<button type="submit" class="btn btn-guardar" id="actualizar_datos">Actualizar datos</button>
		  </div>
		  </form>
		</div>
	  </div>
	</div>
	<?php
		}
	?>
	<script type="text/javascript">
		var input=  document.getElementById('mod_ruc');
input.addEventListener('input',function(){
  if (this.value.length > 12) 
     this.value = this.value.slice(0,12); 
})
var input1=  document.getElementById('mod_telefono');
input1.addEventListener('input',function(){
  if (this.value.length > 9) 
     this.value = this.value.slice(0,9); 
})
	</script>