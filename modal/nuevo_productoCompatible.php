	<!doctype html>
<html lang="en">
<head>

   <script>
  function limpiarFormulario() {
    document.getElementById("guardar_productoCompatible").reset();
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
            
	<div class="modal fade" id="nuevoProductoCompatible" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	 
  <div class="modal-dialog modal-lg" role="document">
		<div class="modal-content estilo-placeholder">
                    
		  <div class="modal-header estilo-placeholder">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel"><i class='glyphicon glyphicon-edit'></i><font color="white"> Agregar Nuevo Producto Compatible</font></h4>
		  </div>
                     <font color="white">LLenar los campos obligatorios test</font> <font class="estilo-placeholder"> &nbsp;&nbsp;&nbsp;&nbsp;</font>
                      
                    <div id="resultados_ajax"></div>
		  <div class="modal-body" style="height:450px;overflow-y: scroll;">
                      
			<form class="form-horizontal" method="post" id="guardar_productoCompatible" name="guardar_productoCompatible">

			  <div class="col-md-4 col-sm-4 col-xs-12">
          <label for="vehiculo" class="control-label">Vehiculo:</label>
				  <select class="form-control estilo-placeholder" id="vehiculo" name="vehiculo" required>
          <option class="custom-select"  value="">-- Seleccione Vehiculo --</option>
      
                        <?php
                       
                        $nom = array();
                        $sql2="select * from vehiculos";
                        $i=0;
                        $rs1=mysqli_query($con,$sql2);
                        while($row3=mysqli_fetch_array($rs1)){
                            $nom_vehiculo=$row3["nombre_vehiculo"];
                            $id_vehiculo=$row3["d_vehiculo"];
                            ?>
                            <option  class="custom-select"  value="<?php  echo $id_vehiculo;?>"><?php  echo $nom_vehiculo;?></option>
                            <?php
                            $i=$i+1;
                        }
                        
                        ?>
          </select>
				</div>


				<div class="col-md-4 col-sm-4 col-xs-12">
          <label for="marcavehiculo" class="control-label">Marca:</label>
				  <select class="form-control estilo-placeholder" id="marcavehiculo" name="marcavehiculo" required>
          <option  class="custom-select" value="">-- Selecciona Marca del Vehiculo --</option>
      
                        <?php
                       
                        $nom = array();
                        $sql2="select * from marca where estado = 1";
                        $i=0;
                        $rs1=mysqli_query($con,$sql2);
                        while($row3=mysqli_fetch_array($rs1)){
                            $nom_marca=$row3["nombre_marca"];
                            $id_marca=$row3["id_marca"];
                            ?>
                            <option  class="custom-select" value="<?php  echo $id_marca;?>"><?php  echo $nom_marca;?></option>
                            <?php
                            $i=$i+1;
                        }
                        
                        ?>
          </select>
				</div>
         

         <div class="col-md-4 col-sm-4 col-xs-12">               
				<label for="modelovehiculo" class="control-label">Modelo Vehiculo:</label>
				  <select class="form-control estilo-placeholder" id="modelovehiculo" name="modelovehiculo" required>
            <option  class="custom-select" value="">-- Selecciona modelo --</option>
          </select>
				</div>

              
         <div class="col-md-4 col-sm-4 col-xs-12">               
				<label for="articulo" class="control-label">Articulo:</label>
				  <select class="form-control estilo-placeholder" id="articulo" name="articulo" required>
          <option  class="custom-select" value="">-- Selecciona tipo de articulo --</option>
      
                  
          </select>
				</div>


				<div class="col-md-4 col-sm-4 col-xs-12">
          <label for="motorproducto" class="control-label">Motor:</label>
          <select class="form-control estilo-placeholder" id="motor_id" name="motor_id" required="">
            <option  class="custom-select" value="">-- Selecciona Motor --</option>
          </select>
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
<script type="text/javascript">
  $('#marcavehiculo').on('change',function(){
        var countryID = $("#marcavehiculo").val();
        console.log(countryID);
        console.log('sssss');
        if(countryID){
            $.ajax({
                type:'POST',
                url:'./modal/appblade.php',
                data:'country_id='+countryID,
                success:function(html){
                
                    $('#modelovehiculo').html(html);
                   
                }
            }); 
        }else{
            $('#modelovehiculo').html('<option  class="custom-select"  value="">Seleccione marca primero</option>');
            
        }
    });
</script>
<script type="text/javascript">
  $('#articulo').on('change',function(){
        var modelID = $("#modelovehiculo").val();
        var marcaID = $("#marcavehiculo").val();
        console.log("aaaaaaaaaaaa");
        console.log(marcaID);
        console.log(modelID);
        if(modelID){
            $.ajax({
                type:'POST',
                url:'./modal/appblade.php',

                data: {'model_id_articulo': modelID, 'marc_id_articulo': marcaID },
                success:function(html){
                    $('#motor_id').html(html);
                }
            }); 
        }else{
            $('#motor_id').html('<option  class="custom-select"  value="">Seleccione articulo primero</option>');
            
        }
    });

   $('#modelovehiculo').on('change',function(){
        var modelID = $("#modelovehiculo").val();
        var marcaID = $("#marcavehiculo").val();
        console.log("aaaaaaaaaaaa");
        console.log(marcaID);
        console.log(modelID);
        if(modelID){
            $.ajax({
                type:'POST',
                url:'./modal/appblade.php',

                data: {'model_id': modelID, 'marc_id': marcaID },
                success:function(html){
                  console.log(html);

                    $('#articulo').html(html);
                   
                }
            }); 
        }else{
            $('#articulo').html('<option class="custom-select"  value="">Seleccione modelo primero</option>');
            
        }
    });


</script>