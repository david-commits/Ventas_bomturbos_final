	<!doctype html>
<html lang="en">
<head>

   <script>
  function limpiarFormulario() {
    document.getElementById("guardar_tipoArticulo").reset();
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
            
	<div class="modal fade" id="nuevoTipoArticulo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	 
         
               
            <div class="modal-dialog" role="document">
               
                
		<div class="modal-content">
                    
                  
                    
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Agregar Nuevo Tipo Artículo </h4>
		  </div>
                    <br>
                    <span class="campos-obligatorios">Todos los campos son obligatorios</span>
                      
                    <div id="resultados_ajax"></div>
		  <div class="modal-body" style="height:450px;overflow-y: scroll;">
                      
			<form class="form-horizontal" method="post" id="guardar_tipoArticulo" name="guardar_tipoArticulo">

			<div class="form-group">
				<label for="tlinea" class="col-sm-3 control-label">Tipo de Linea:</label>
				<div class="col-md-9 col-sm-9 col-xs-12">
				 
				<select class="form-control estilo-placeholder" id="tlinea" name="tlinea" required >

					<option class="custom-select" value="">-- Selecciona Tipo de Linea --</option>

			            <?php
                       
                        $nom = array();
                        $sql2="select * from tipo_linea where estado = 1 ";
                        $i=0;
                        $rs1=mysqli_query($con,$sql2);
                        while($row3=mysqli_fetch_array($rs1)){
                            $nom_tlinea=$row3["nombre_tipoLinea"];
                            $id_tlinea=$row3["id_tipoLinea"];
                            ?>
                            <option class="custom-select" value="<?php  echo $id_tlinea;?>"><?php  echo $nom_tlinea;?></option>
                            <?php
                            $i=$i+1;
                        }
                        
                        ?>
                     
                         </select>

				</div>
			  </div>

			  			<div class="form-group">
				<label for="n_categoria" class="col-sm-3 control-label">Categoría:</label>
				<div class="col-md-9 col-sm-9 col-xs-12">
				 
				<select class="form-control estilo-placeholder" id="n_categoria" name="n_categoria" required >                    
                         </select>

				</div>
			  </div>


              <div class="form-group">
				<label for="nombre" class="col-sm-3 control-label">Nombre:</label>
				<div class="col-md-9 col-sm-9 col-xs-12">
				  <input type="text" class="form-control  estilo-placeholder" id="nombre" name="nombre" placeholder="Ingrese nombre tipo linea" required maxlength="50">
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
<script type="text/javascript">
  $('#tlinea').on('change',function(){
    console.log('waaaaaaaaaaaaaaaaaa');
        var tlinea = $("#tlinea").val();
        if(tlinea){
            $.ajax({
                type:'POST',
                url:'./modal/appblade.php',
                data:'tl_tlinea='+tlinea,
                success:function(html){
                  console.log(html);
                    $('#n_categoria').html(html);
                }
            }); 
        }else{
            $('#n_categoria').html('<option value="">Seleccione Tipo Linea primero</option>');
        }
    });

</script>