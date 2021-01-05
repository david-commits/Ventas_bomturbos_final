  <!doctype html>
<html lang="en" >
<head>

   <script>
  function limpiarFormulario() {
    $("#marca_m").val(0);
      $("#modelo_m").val('Seleccione Modelo');
      $("#nombre").val('');
    document.getElementById("guardar_marca").reset();
  }
    function limpiarFormularioCerrar() {
    $("#marca_m").val(0);
      $("#modelo_m").val('Seleccione Modelo');
      $("#nombre").val('');
    
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
        
          <body>  
            
  <div class="modal fade" id="nuevoMotor" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"  >
               
            <div  role="document" class="modal-dialog modal-lg">
                
    <div class="modal-content">          
      <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Agregar nuevo Motor</h4>
      </div>
                  <br>
                    <span class="campos-obligatorios">Todos los campos son obligatorios</span>
                      
                    <div id="resultados_ajax"></div>
      <div class="modal-body" style="height:450px;overflow-y: scroll;">
                      
      <form class="form-horizontal" method="post" id="guardar_motor" name="guardar_motor">

        <div class="form-group">
          <label for="marca_m" class="col-sm-3 control-label">Tipo Marca:</label>
            <div class="col-md-8 col-sm-8 col-xs-12">
              <select  class="form-control estilo-placeholder" id="marca_m" name="marca_m" required>
                <option class="custom-select" value="0">-- Selecciona Marca --</option>
                  <?php
                    $nom = array();
                    $sql2="select * from marca where estado = 1  and id_tipoLinea = 3";
                    $i=0;
                    $rs1=mysqli_query($con,$sql2);
                    while($row3=mysqli_fetch_array($rs1)){
                      $nom_tipo=$row3["nombre_marca"];
                      $id_marca=$row3["id_marca"];
                  ?>
                    <option class="custom-select" value="<?php  echo $id_marca;?>"><?php  echo $nom_tipo;?></option>
                  <?php
                    $i=$i+1;
                    }    
                  ?>  
              </select>
            </div>
        </div>

        <div class="form-group">
          <label for="modelo_m" class="col-sm-3 control-label">Tipo Modelo:</label>
            <div class="col-md-8 col-sm-8 col-xs-12">
              <select  class="form-control estilo-placeholder" id="modelo_m" name="modelo_m" required>
                <option class="custom-select" value="0">-- Selecciona Modelo --</option>
                  <?php
                    $nom = array();
                    $sql2="select * from modelos where estado = 1 ";
                    $i=0;
                    $rs1=mysqli_query($con,$sql2);
                    while($row3=mysqli_fetch_array($rs1)){
                      $nom_tipom=$row3["nombre_modelo"];
                      $id_modelo=$row3["id_modelo"];
                  ?>
                    <option class="custom-select" value="<?php  echo $id_modelo;?>"><?php  echo $nom_tipom;?></option>
                  <?php
                    $i=$i+1;
                    }    
                  ?>  
              </select>
            </div>
        </div>

              <div class="form-group">
        <label for="nombre" class="col-sm-3 control-label">Nombre de Motor:</label>
        <div class="col-md-8 col-sm-8 col-xs-12">
          <input type="text"  class="form-control estilo-placeholder" id="nombre" name="nombre" placeholder="Ingrese nombre motor" required  maxlength="50">
        </div>
        </div>

          

      </div>
      <div class="modal-footer">
      <button type="button" class="btn btn-limpiar" onclick="limpiarFormulario()">Limpiar</button>
                      <button type="button" class="btn btn-cancelar" data-dismiss="modal" onclick="limpiarFormularioCerrar()">Cerrar</button>
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
  $('#marca_m').on('change',function(){
    console.log('waaaaaaaaaaaaaaaaaa');
        var marca_m = $("#marca_m").val();
        if(marca_m){
            $.ajax({
                type:'POST',
                url:'./modal/appblade.php',
                data:'marca_m='+marca_m,
                success:function(html){
                    $('#modelo_m').html(html);
                }
            }); 
        }else{
            $('#modelo_m').html('<option value="">Seleccione marca primero</option>');
        }
    });
/*

  $('#tipoModelo').on('change',function(){
        var tipoModelo = $("#tipoModelo").val();
        var tipoMarca = $("#tipoMarca").val();
        if(tipoModelo){
            $.ajax({
                type:'POST',
                url:'./modal/appblade.php',
                data:{'modelo_m': tipoModelo, 'marca_marca': tipoMarca },
                success:function(html){
                    $('#motor_m').html(html);
                }
            }); 
        }else{
            $('#motor_m').html('<option value="">Seleccione modelo primero</option>');
        }
    });*/
</script>