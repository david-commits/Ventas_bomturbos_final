	<!doctype html>
<html lang="en">
<head>
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
</head>

<?php
       
        if (isset($con))
	{
	?>
  
          <body>  
            
	<div class="modal fade" id="nuevoProducto" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	     
            <div class="modal-dialog" role="document">
              
		<div class="modal-content">
                   
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="myModalLabel">Agregar nueva Sucursal</h4>
		  </div>
		   <br>
                    <span class="campos-obligatorios">Todos los campos son obligatorios</span>
		  <div class="modal-body">
			<form class="form-horizontal" action="" enctype="multipart/form-data" method="post" id="guardar_sucursal" name="guardar_sucursal">
			<div id="resultados_ajax"></div>
			  <div class="form-group">
				<label for="nombre" class="col-sm-3 control-label">(*)Nombre:</label>
				<div class="col-md-8 col-sm-8 col-xs-12">
				  <input type="text" class="form-control estilo-placeholder" id="nom_cat" name="nombre" placeholder="Nombre de la Sucursal" required>
				</div>
			  </div>
			  <div class="form-group">
				<label for="ruc" class="col-sm-3 control-label">(*)Ruc:</label>
				<div class="col-md-8 col-sm-8 col-xs-12">
					<input type="text" max="12" class="form-control estilo-placeholder" id="ruc" name="ruc" placeholder="R.U.C." onKeyPress="return soloNumeros(event)" >
				  
				</div>
			  </div>
                        
                        <?php
                        $sql2="select * from sucursal ";
                        $rs1=mysqli_query($con,$sql2);
                        $row3=mysqli_fetch_array($rs1);
                        $tienda=$row3["tienda"]+1;
                        ?>
                        <input type="hidden" nombre="mod_tienda" id="mod_tienda" value="<?php echo $tienda;?>" >
                      
                        <div class="form-group">
				<label for="direccion" class="col-sm-3 control-label">(*)Dirección:</label>
				<div class="col-md-8 col-sm-8 col-xs-12">
					<input type="text" class="form-control estilo-placeholder" id="direccion" name="direccion" placeholder="Dirección de la Sucursal" >
				  
				</div>
			  </div>
                        <div class="form-group">
				<label for="correo" class="col-sm-3 control-label">(*)Correo:</label>
				<div class="col-md-8 col-sm-8 col-xs-12">
					<input type="email" class="form-control estilo-placeholder" id="correo" name="correo" placeholder="Correo de la Sucursal" >
				  
				</div>
			  </div>
			 
			<div class="form-group">
				<label for="telefono" class="col-sm-3 control-label">(*)Teléfono:</label>
				<div class="col-md-8 col-sm-8 col-xs-12">
					<input type="text" class="form-control estilo-placeholder" id="telefono" name="telefono" placeholder="Teléfono de la Sucursal" onKeyPress="return soloNumeros(event)" >
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
        <script>


var input=  document.getElementById('ruc');
input.addEventListener('input',function(){
  if (this.value.length > 12) 
     this.value = this.value.slice(0,12); 
})
var input1=  document.getElementById('telefono');
input1.addEventListener('input',function(){
  if (this.value.length > 9) 
     this.value = this.value.slice(0,9); 
})


        
         function archivo(evt) {
			var files = evt.target.files; // FileList object
		
			// Obtenemos la imagen del campo "file".
			for (var i = 0, f; f = files[i]; i++) {
			  //Solo admitimos imágenes.
			  if (!f.type.match('image.*')) {
				continue;
			  }
		
			  var reader = new FileReader();
		
			  reader.onload = (function(theFile) {
				return function(e) {
				  // Insertamos la imagen
				 document.getElementById("list").innerHTML = ['<img  class="thumb" src="', e.target.result,'" title="', escape(theFile.name), '"/>'].join('');
				};
			  })(f);
		
			  reader.readAsDataURL(f);
			}
		  }
        document.getElementById('files').addEventListener('change', archivo, false);
        
        
        </script>    
</html>