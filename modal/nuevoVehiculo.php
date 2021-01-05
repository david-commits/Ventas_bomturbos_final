	<!doctype html>
<html lang="en">
<head>

   <script>
  function limpiarFormulario() {
    document.getElementById("guardar_vehiculo").reset();
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
		{}
	?>

	<!-- Modal -->
     
        
          <body>  
            
	<div class="modal fade" id="nuevoVehiculo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	 
            <div class="modal-dialog" role="document">
                
		<div class="modal-content" style="background: #F5ECCE;">
                    
                    
		  <div class="modal-header estilo-placeholder">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel"><i class='glyphicon glyphicon-edit'></i><font color="black"> Agregar nuevo vehiculo</font></h4>
		  </div>
                     <font color="black">LLenar los campos obligatorios</font> <font class="estilo-placeholder"> &nbsp;&nbsp;&nbsp;&nbsp;</font>
                      
                    <div id="resultados_ajax"></div>
		  <div class="modal-body" style="height:450px;overflow-y: scroll;">
                      
			<form class="form-horizontal" method="post" id="guardar_vehiculo" name="guardar_vehiculo">

				
                

				<div class="form-group">
				 <label for="d" class="col-sm-3 control-label">Nombre vehiculo</label>
				 <div class="col-md-9 col-sm-9 col-xs-12">
				  <input type="text"  class="form-control" id="nombre" name="nombre" placeholder="Ingrese descripcion" required>
				</div>
			   </div>

			  <div class="form-group">
				<label for="motor" class="col-sm-3 control-label">Motor vehiculo</label>
				<div class="col-md-9 col-sm-9 col-xs-12">
				  <input type="text"  class="form-control" id="motor" name="motor" placeholder="Ingrese codigo" required>
				</div>
			  </div>

              <div class="form-group">
				<label for="marca" class="col-sm-3 control-label">Marca vehiculo</label>
				<div class="col-md-9 col-sm-9 col-xs-12">
				  <select class="form-control" id="marca" name="marca" required style="background-color:#A9F5BC;">
					<option value="">-- Selecciona marca --</option>
			            <?php
                       
                        $nom = array();
                        $sql2="select * from marca where id_tipoLinea = 2 and estado = 1";
                        $i=0;
                        $rs1=mysqli_query($con,$sql2);
                        while($row3=mysqli_fetch_array($rs1)){
                            $nom_marca=$row3["nombre_marca"];
                            $id_marca=$row3["id_marca"];
                            ?>
                            <option value="<?php  echo $id_marca;?>"><?php  echo $nom_marca;?></option>
                            <?php
                            $i=$i+1;
                        }
                        
                        ?>
                         </select>

		  </div>
		  </div>

              <div class="form-group">
				<label for="modelo" class="col-sm-3 control-label">Modelo vehiculo</label>
				<div class="col-md-9 col-sm-9 col-xs-12">
				  <select class="form-control" id="modelo" name="modelo" required  style="background-color:#A9F5BC;">
					<option value="">-- Seleccione modelo --</option>
			            <?php
                       
                        $nom = array();
                        $sql2="select * from modelos where estado = 1 ";
                        $i=0;
                        $rs1=mysqli_query($con,$sql2);
                        while($row3=mysqli_fetch_array($rs1)){
                            $nom_marca=$row3["nombre_modelo"];
                            $id_marca=$row3["id_modelo"];
                            ?>
                            <option value="<?php  echo $id_modelo;?>"><?php  echo $nom_marca;?></option>
                            <?php
                            $i=$i+1;
                        }
                        
                        ?>
                     
                         </select>

			   </div>
			   </div>

			   <div class="form-group">
				<label for="anio" class="col-sm-3 control-label">Año</label>
				<div class="col-md-9 col-sm-9 col-xs-12">
				  <input type="text"  class="form-control" id="anio" name="anio" placeholder="Ingrese anio" >
				</div>
		      </div>


		       <div class="form-group">
				<label for="cilindro" class="col-sm-3 control-label">Cilindro</label>
				<div class="col-md-9 col-sm-9 col-xs-12">
				  <input type="text"  class="form-control" id="cilindro" name="cilindro" placeholder="Ingrese cilindro" >
				</div>
		      </div>


		      <div class="form-group">
				<label for="combustible" class="col-sm-3 control-label">Combustible</label>
				<div class="col-md-9 col-sm-9 col-xs-12">
				 <input type="text"  class="form-control" id="combustible" name="combustible" placeholder="Ingrese cilindro" >

			   </div>
			   </div>


           <div class="form-group">
				<label for="detalle" class="col-sm-3 control-label">Detalle</label>
				<div class="col-md-9 col-sm-9 col-xs-12">
				  <input type="text"  class="form-control" id="detalle" name="detalle" placeholder="Ingrese detalle" required>
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