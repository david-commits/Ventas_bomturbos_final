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
            
	<div class="modal fade" id="nuevoVehiculoCompatible" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
               
            <div class="modal-dialog modal-lg" role="document">
                
		<div class="modal-content">          
		  <div class="modal-header" >
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Agregar Vehiculos compatibles </h4>
		  </div>
		  <div class="modal-body" style="height:450px;overflow-y: scroll;">
                      
			<form class="form-horizontal" method="post" id="guardar_marca" name="guardar_marca">

			  <div class="form-group">
				<label for="marca" class="col-sm-3 control-label">Marca</label>
				<div class="col-md-8 col-sm-8 col-xs-12">
				   <select @change="ListaModelo" v-model="filtroProducto.marca" class="form-control estilo-placeholder" id="marca" name="marca">
         			 <option class="custom-select" value="">-- Selecciona Marca --</option>
                        <?php
                        $nom1 = array();
                        $sql1="select * from marca where id_tipoLinea=3";
                        $rs1=mysqli_query($con,$sql1);
                        while($row3=mysqli_fetch_array($rs1)){
                            $nombre_marca=$row3["nombre_marca"];
                            $id_marca=$row3["id_marca"];
                            ?>
                            <option class="custom-select" value="<?php  echo $id_marca;?>"><?php  echo $nombre_marca;?></option>
                            <?php
                        }
                        
                        ?>
                    </select>
                    </div></div>
				
				 <label for="modelo" class="col-sm-3 control-label">Modelo</label>
	   				<div class="col-md-8 col-sm-8 col-xs-12">
                        <select v-model="filtroProducto.modelo" class="form-control estilo-placeholder" id="modelo" >
                            <option v-for="option in Modelos" :value="option.id" style=" background-color: #27283d; font-family: 'Quicksand', sans-serif;">
                                {{ option.nom }}
                            </option>
                        </select>
                  </div>  
				
				<br>
				<br>
				<br>
				<br>
				<div class="text-right my-3 mr-3">
					<input type="button" @click="Buscar" class="btn btn-limpiar" id="BuscarComp" value="Buscar">
				</div>
				<br>

			<div id="DivVehiculos" class="table-responsive">
			 <table id="searcCompatibleGuardar" class="table-striped display nowrap" style="width:100%">
	               <thead>
						<tr>
							<th  class="th-general"></th>
							<th  class="th-general">Marca</th>
	                        <th  class="th-general">Modelo</th>
	                        <th class="th-general">Litro</th>
	                        <th  class="th-general">Motor</th>
	                        <th class="th-general">Año</th>
	                        <th class="th-general">Combustible</th>
	                        <th class="th-general">Detalle</th>
	                        <th class="th-general">Comentario</th>
						</tr>
	                </thead>
					
					<tbody>    
	                <tr v-for="(data, index) in datos" :key="index">                                               
						<td class="th-general"><label class="form-checkbox"><input type="checkbox" :value="data.id" v-model="selected">
						<i class="form-icon"></i></label></td>
						<td  class="th-general">{{ data.Marca }}</td>
                        <td class="th-general">{{ data.Modelo }}</td>
                        <td class="th-general">{{ data.Cilindro}}</td>
						<td class="th-general">{{ data.Motor}}</td>
						<td class="th-general">{{ data.Anio}}</td>
						<td class="th-general">{{ data.Combustible}}</td>
						<td class="th-general">{{ data.Detalle}}</td>
						<td class="th-general">{{ data.Vehiculo}}</td>
                       
					</tr>
					</tbody>

			  </table>

			</div>


		  </div>
		  <div class="modal-footer">
			<!--<button  type="button" class="btn btn-warning" onclick="limpiarFormulario()">Limpiar</button>-->
             <button id="BtnCerrarAgregar" type="button" class="btn btn-cancelar" data-dismiss="modal">Cerrar</button>
            <button v-on:click="Agregar" class="btn btn-agregar" id=""><span id="">Agregar</span></button>
		  </div>
		  </form>

		</div>
	  </div>
	</div>
	<?php
		}
	?>
        <script type="text/javascript" src="ViewModels/consultaVehiculos.js"></script>
</body>
            
</html>