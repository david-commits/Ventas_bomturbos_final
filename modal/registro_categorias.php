	<!doctype html>
<html lang="en">
<head>
<script>
  function limpiarFormulario() {
    document.getElementById("guardar_categoria").reset();
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
              
           
                
                
		<div class="modal-content">
                    
                  
                    
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Agregar nueva categoria</h4>
		  </div>
		   <br>
                    <span class="campos-obligatorios">Todos los campos son obligatorios</span>
		  <div class="modal-body">
			<form class="form-horizontal" method="post" id="guardar_categoria" name="guardar_categoria">
			<div id="resultados_ajax"></div>
			  

			<div class="form-group">
				<label for="tlinea" class="col-sm-2 control-label">Tipo Linea:</label>
				<div class="col-md-10 col-sm-10 col-xs-12">
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
				<label for="nom_cat" class="col-sm-2 control-label">Nombre:</label>
				<div class="col-md-10 col-sm-10 col-xs-12">
				  <input type="text" class="form-control estilo-placeholder" id="nom_cat" name="nom_cat" placeholder="Nombre de la categoria" required>
				</div>
			  </div>
			  
                     
                        
                        
			  <div class="form-group">
				<label for="des_cat" class="col-sm-2 control-label">Descripcion:</label>
				<div class="col-md-10 col-sm-10 col-xs-12">
					<input type="text" class="form-control estilo-placeholder" id="des_cat" name="des_cat" placeholder="Descripcion de la categoria" required>
				  
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