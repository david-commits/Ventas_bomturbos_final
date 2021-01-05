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
        e.preventDefault();
    }
  }
</script>
</head>


<?php
    if (isset($con))
    {
  ?>
          <body>  
            
  <div class="modal fade" id="nuevoVehiculo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
           
        <div class="modal-dialog" role="document">
                
    <div class="modal-content">
                    
      <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <h4 class="modal-title" id="myModalLabel">Agregar Vehiculo</h4>         
      </div> 
                     <br>
                    <span class="campos-obligatorios">Todos los campos son obligatorios</span>
                      
                    <div id="resultados_ajax"></div>
      <div class="modal-body">
                      
      <form class="form-horizontal" method="post" id="guardar_vehiculo" name="guardar_vehiculo">


        <div class="form-group">
        <label for="marca" class="col-sm-3 control-label">Marca:</label>
        <div class="col-md-9 col-sm-9 col-xs-12">
          <select class="form-control estilo-placeholder" id="marca" name="marca" required>
          <option class="custom-select" value="">-- Selecciona marca--</option>
                  <?php
                       
                        $nom = array();
                $sql2="SELECT m.id_marca as id, m.nombre_marca as nom FROM marca m where m.estado = 1 and m.id_tipoLinea = 3 " ;
                        $i=0;
                        $rs1=mysqli_query($con,$sql2);
                        while($row3=mysqli_fetch_array($rs1)){
                            $nom_marca=$row3["nom"];
                            $id_marca=$row3["id"];
                            ?>
                            <option class="custom-select" value="<?php  echo $id_marca;?>"><?php  echo $nom_marca;?></option>
                            <?php
                            $i=$i+1;
                        }
                        
                        ?>
                     
                         </select>

         </div>
         </div>
           <div class="form-group">
          <label for="modelo" class="col-sm-3 control-label">Tipo Modelo:</label>
            <div class="col-md-9 col-sm-9 col-xs-12">
              <select  class="form-control estilo-placeholder" id="modelo" name="modelo" required>
                <option class="custom-select" value="0">-- Selecciona Modelo --</option>

              </select>
            </div>
        </div>

           <div class="form-group">
        <label for="cilindro" class="col-sm-3 control-label">Litro:</label>
        <div class="col-md-9 col-sm-9 col-xs-12">
          <input type="text" class="form-control estilo-placeholder" id="cilindro" name="cilindro" placeholder="Ingrese Litro" required="true" maxlength="50" >
        </div>
          </div>


         <div class="form-group">
        <label for="anio" class="col-sm-3 control-label">Año:</label>
        <div class="col-md-9 col-sm-9 col-xs-12">
          <input type="text"  maxlength="50" class="form-control estilo-placeholder" id="anio" name="anio" placeholder="Ingrese año" required>
        </div>
          </div>


     <div class="form-group">
          <label for="motor" class="col-sm-3 control-label">Tipo Motor:</label>
            <div class="col-md-9 col-sm-9 col-xs-12">
              <select  class="form-control estilo-placeholder" id="motor" name="motor" required>
                <option class="custom-select" value="0">-- Selecciona Motor --</option>

              </select>
            </div>
        </div>



<!--
          <div class="form-group">
        <label for="motor" class="col-sm-3 control-label">Motor</label>
        <div class="col-md-9 col-sm-9 col-xs-12">
          <select class="form-control" id="motor" name="motor" required style="background-color:#A9F5BC;">
          <option value="">-- Selecciona Motor--</option>
                  <?php
                $sql22="SELECT * FROM motor where estado=1" ;
                        $i=0;
                        $rs21=mysqli_query($con,$sql22);
                        while($row32=mysqli_fetch_array($rs21)){
                            $nom_1=$row32["nombre"];
                            $id_motor_1=$row32["id_motor"];
                            ?>
                            <option value="<?php  echo $id_motor_1;?>"><?php  echo $nom_1;?></option>
                            <?php
                            $i=$i+1;
                        }
                        ?>
                         </select>
         </div>
         </div>
-->
     
           <div class="form-group">
        <label for="detalle" class="col-sm-3 control-label">Descripción:</label>
        <div class="col-md-9 col-sm-9 col-xs-12">
          <input type="text"  class="form-control estilo-placeholder" id="detalle" name="detalle" placeholder="Ingrese detalle">
        </div>
      </div>

          <div class="form-group">
        <label for="combustible" class="col-sm-3 control-label">Combustible:</label>
        <div class="col-md-9 col-sm-9 col-xs-12">
         <input type="text" class="form-control estilo-placeholder" id="combustible" name="combustible" placeholder="Ingrese litro" required="true"  maxlength="100">
         </div>
         </div>

        <div class="form-group">
         <label for="nombre" class="col-sm-3 control-label">Comentarios:</label>
         <div class="col-md-9 col-sm-9 col-xs-12">
          <input type="text"  class="form-control estilo-placeholder" id="nombre" name="nombre" placeholder="Ingrese Comentarios" maxlength="100">
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
  $('#marca').on('change',function(){
        var marca_m = $("#marca").val();
        console.log(marca_m);
        if(marca_m){


            $.ajax({
                type:'POST',
                url:'./modal/appblade.php',
                data:'marca_m='+marca_m,
                success:function(html){
                  console.log(html);
                    $('#modelo').html(html);
                }
            });

        }else{
            $('#modelo').html('<option class="custom-select" value="">Seleccione marca primero</option>');
        }
    });

  $('#modelo').on('change',function(){
        var modelo_m = $("#modelo").val();
        console.log(modelo_m);
        if(modelo_m){
            $.ajax({
                type:'POST',
                url:'./modal/appblade.php',
                data:'modelomotor_m='+modelo_m,
                success:function(html){
                  console.log(html);
                    $('#motor').html(html);
                }
            });
        }else{
            $('#motor').html('<option  class="custom-select" value="">Seleccione modelo primero</option>');
        }
    });

    </script>
