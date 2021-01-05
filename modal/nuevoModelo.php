	<!doctype html>
<html lang="en">
<head>

   <script>
  function limpiarFormulario() {
    document.getElementById("guardar_modelo").reset();
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
            
	<div class="modal fade" id="nuevoModelo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	 
         
               
            <div class="modal-dialog" role="document">
              
           
                
                

		<div class="modal-content estilo-placeholder">
                    
                  
                    
		  <div class="modal-header estilo-placeholder" >
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel"><i class='glyphicon glyphicon-edit'></i><font color="white"> Agregar Modelo</font></h4>
		  </div>
                      <br>
                    <span class="campos-obligatorios">Todos los campos son obligatorios</span>
                    <div id="resultados_ajax"></div>
		  <div class="modal-body" style="height:450px;overflow-y: scroll;">
                      
			<form class="form-horizontal" method="post" id="guardar_modelo" name="guardar_modelo">

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
				<label for="marca" class="col-sm-3 control-label">Nombre de Marca:</label>
				<div class="col-md-9 col-sm-9 col-xs-12">
					<select  class="form-control estilo-placeholder" id="marca" name="marca" required>
                <option class="custom-select" value="0">- Selecciona Marca -</option>

              </select>
				  
				</div>
			  </div>


			<!-- <div class="form-group">
				<label for="marca" class="col-sm-3 control-label">Marca:</label>
				<div class="col-md-9 col-sm-9 col-xs-12">
				 
				<select class="form-control estilo-placeholder" id="marca" name="marca" required >

					<option class="custom-select" value="">-- Selecciona marca --</option>

			            <?php
                       
                        $nom = array();
                        $sql2="select * from marca where estado = 1 and id_tipoLinea = 3 or id_tipoLinea = 2 or id_tipoLinea = 4";
                        $i=0;
                        $rs1=mysqli_query($con,$sql2);
                        while($row3=mysqli_fetch_array($rs1)){
                            $nom_marca=$row3["nombre_marca"];
                            $id_marca=$row3["id_marca"];
                            ?>
                            <option class="custom-select" value="<?php  echo $id_marca;?>"><?php  echo $nom_marca;?></option>
                            <?php
                            $i=$i+1;
                        }
                        
                        ?>
                     
                         </select>

				</div>
			  </div>-->

			 
              <div class="form-group">
				<label for="nombre" class="col-sm-3 control-label">Nombre de Modelo:</label>
				<div class="col-md-9 col-sm-9 col-xs-12">

				  <input type="text" class="form-control estilo-placeholder" id="nombre" name="nombre" placeholder="Ingrese nombre marca" required maxlength="50" >

				</div>
			  </div>
               <div class="form-group">
				<label for="descripcion" class="col-sm-3 control-label">Descripción Modelo:</label>
				<div class="col-md-9 col-sm-9 col-xs-12">
				  <input type="text"  class="form-control estilo-placeholder" id="descripcion" name="descripcion" placeholder="Ingrese descripcion" maxlength="100">
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
            <script type="text/javascript">
  $('#tlinea').on('change',function(){
        var tlinea_m = $("#tlinea").val();
        console.log(tlinea_m);
        if(tlinea_m){


            $.ajax({
                type:'POST',
                url:'./modal/appblade.php',
                data:'tlinea_m='+tlinea_m,
                success:function(html){
                  console.log(html);
                    $('#marca').html(html);
                }
            });

        }else{
            $('#marca').html('<option class="custom-select" value="">Seleccione Tipo Linea primero</option>');
        }
    });
</script>
</html>