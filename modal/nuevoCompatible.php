  <!doctype html>
  <html lang="en">
  <head>
     	<script>
     	function limpiarFormulario() {
     		document.getElementById("guardar_marca").reset();
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
                           
    	<div class="modal fade" id="nuevoCompatible" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"> 
          <div class="modal-dialog modal-lg" role="document">

  		<div class="modal-content">          
  		  	<div class="modal-header">

  			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
              <h4 class="modal-title" id="myModalLabel">
                Lista de Motores compatibles con:
                <span id="nombreProducto"></span>
              </h4>
  		  	</div>
                        
              <div id="resultados_ajax"></div>
  		  	<div class="modal-body" style="height:450px;overflow-y: scroll;">
                        
  			<form class="form-horizontal" method="post" id="guardar_marca" name="guardar_marca">

  				<div class="col-md-4 col-sm-4 col-xs-10">
  					<label for="marca_nuevoCompatible" class="col-sm-3 control-label">Marcas</label>
  				
  				   		<select  class="form-control estilo-placeholder" onchange="myFunctionChange()" id="marca_nuevoCompatible" name="marca_nuevoCompatible" >
           			 	<option class="custom-select"value="">-- Selecciona Marca --</option>
                          <?php
                          $nom1 = array();
                          $sql1="select * from marca where id_tipoLinea=3";
                          $rs1=mysqli_query($con,$sql1);
                          while($row3=mysqli_fetch_array($rs1)){
                              $nombre_marca=$row3["nombre_marca"];
                              $id_marca=$row3["id_marca"];
                              ?>
                              <option class="custom-select"value="<?php  echo $id_marca;?>"><?php  echo $nombre_marca;?></option>
                              <?php
                          }
                          
                          ?>
                      </select>
  				 </div>

  				  <div class="col-md-4 col-sm-4 col-xs-10">
  				 <label for="modelo" class="col-sm-3 control-label">Modelo</label>
                      <!--<select v-model="filtroProducto.modelo" class="form-control estilo-placeholder" id="modelo" >
                          <option v-for="option in Modelos" :value="option.id" style=" background-color: #27283d; font-family: 'Quicksand', sans-serif;">
                              {{ option.nom }}
                          </option>
                      </select>-->
                      <select  class="form-control estilo-placeholder" id="modelo_nuevoCompatible" onchange="myFunctionModeloChange()"  name="modelo_nuevoCompatible" required>
                  		<option class="custom-select" value="0">-- Selecciona Modelo --</option>
                		</select>
                    </div> 
                 

                  <div class="col-md-4 col-sm-4 col-xs-10">
  				<label for="cilindro" class="col-sm-3 control-label">Litro</label>
  				  <input type="text"  class="form-control estilo-placeholder" id="cilindro" name="cilindro" placeholder="Ingrese Litro"  maxlength="50" >
  				</div>
  		   

  			  	<div class="col-md-4 col-sm-4 col-xs-10">
  				<label for="anio" class="col-sm-3 control-label">Año</label>
  				  <input type="number"  maxlength="4"  class="form-control estilo-placeholder" id="anio" name="anio" placeholder="Ingrese año" >
  				</div>
  		  
  		     <div class="col-md-4 col-sm-4 col-xs-10">
  				<label for="motor_nuevoCompatible" class="col-sm-3 control-label">Motor </label>
  				<select  class="form-control estilo-placeholder" id="motor_nuevoCompatible"  name="motor_nuevoCompatible" required>
                  		<option class="custom-select" value="0">-- Selecciona Modelo --</option>
                		</select>
  	
  				</div>

  			 	<div class="col-md-4 col-sm-4 col-xs-10">
  				<label for="combustible" class="col-sm-3 control-label">Combustible</label>
  				 <input type="text" class="form-control estilo-placeholder" id="combustible" name="combustible" placeholder="Ingrese litro"  maxlength="100">
  				
  			   </div>


           <div class="col-md-4 col-sm-4 col-xs-10" style="margin-top: 30px;">
              <a href="#" id="BtnBuscar" onclick="functVerDatos()" class="btn btn-limpiar" id="">Buscar</a>
              <a href="#" data-toggle="modal" data-target="#nuevoVehiculoCompatible" class="btn btn-agregar" onclick="cargardatoscompatiblesagregar()" id=""><span id="">Agregar</span></a>
           </div>
  			 
             <div id="loader" style="position: absolute;  text-align: center; top: 55px;  width: 100%;display:none;"></div><!-- Carga gif animado -->
    				
  			<div id="DivCompatibles" class="table-responsive ">
                  <div class="outer_div_compatible" ></div><!-- Datos ajax Final -->
  			<!--<table  id="searcCompatible" class="display nowrap" style="width:100%">
                                
  	               <thead>
  						<tr>
  							<th class="th-general">Marca</th>
  	                        <th class="th-general">Modelo</th>
  	                        <th class="th-general">Litro</th>
  	                        <th class="th-general">Motor</th>
  	                        <th class="th-general">Año</th>
  	                        <th class="th-general">Descripcion</th>
  	                        <th class="th-general">Estado</th>
  	                        <th class='text-right th-general'>Acciones</th>
  						</tr>
  	                </thead>
  					
  					<tbody>    
  	                <tr class="th-general" v-for="(data, index) in datos" :key="index">       
  						<td class="th-general">{{ data.Marca }}</td>
                          <td class="th-general">{{ data.Modelo }}</td>
                          <td class="th-general">{{ data.Cilindro }}</td>
  	                    <td class="th-general">{{ data.Motor }}</td>
                          <td class="th-general">{{ data.Anio }}</td>
                          <td class="th-general">{{ data.Detalle }}</td>
                          <td class="th-general">{{ data.Estado==1?'Activo':'Inactivo' }}</td>

                          <td ><span class="pull-right">
  	                     <a href="#" @click="InactivarCompatible(data)" :class="{'btn btn-danger btn-xs': data.Estado==1,'btn btn-success btn-xs': data.Estado==0 }" title="">
  	                     <i :class="{'glyphicon glyphicon-remove': data.Estado==1, 'glyphicon glyphicon-ok': data.Estado==0}"></i></a>                     
  					</tr>
  					</tbody>

  			  </table>-->

  			</div>


  		  </div>
  		  <div class="modal-footer">
          <button type="button" class="btn btn-cancelar" data-dismiss="modal">Cerrar</button>
    			<button type="button" class="btn btn-limpiar" onclick="limpiarFormulario()">Limpiar</button>
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


  function myFunctionChange() {

     var marca_m = document.getElementById("marca_nuevoCompatible").value;
          console.log(marca_m);
          if(marca_m){


              $.ajax({
                  type:'POST',
                  url:'./modal/appblade.php',
                  data:'marca_m='+marca_m,
                  success:function(html){
                    //console.log(html);
                      $('#modelo_nuevoCompatible').html(html);
                  }
              });

          }else{
              $('#modelo_nuevoCompatible').html('<option class="custom-select" value="">Seleccione marca primero</option>');
          }
  }

  function myFunctionModeloChange() {

     var marca_m = document.getElementById("marca_nuevoCompatible").value;
     var modelo_m = document.getElementById("modelo_nuevoCompatible").value;

          if(modelo_m){

              $.ajax({
                  type:'POST',
                  url:'./modal/appblade.php',
                  data:'modelo_nCompatible='+ modelo_m + '&marca_nCompatible=' +marca_m,
                  success:function(html){
               
                      $('#motor_nuevoCompatible').html(html);
                  }
              });

          }else{
              $('#motor_nuevoCompatible').html('<option class="custom-select" value="">Seleccione Modelo primero</option>');
          }
  }


  </script>
  </html>