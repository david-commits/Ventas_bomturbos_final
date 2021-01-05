  <?php
    if (isset($con))
    {
  ?>
  <!-- Modal -->
  <div class="modal fade" id="myModalMotor" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Editar Motor</h4>
      </div>
      <div class="modal-body" style="height:500px;overflow-y: scroll;">
      <form class="form-horizontal" method="post" id="editar_motor" name="editar_motor">
      <div id="resultados_ajax2"></div>

      <div class="form-group">
          <label for="mod_marca_m" class="col-sm-3 control-label">Tipo Marca:</label>
            <div class="col-md-9 col-sm-9 col-xs-12">
         <input type="hidden" name="mod_idMotor" id="mod_idMotor">

              <select  class="form-control estilo-placeholder" id="mod_marca_m" name="mod_marca_m" required>
                <option class="custom-select" value="0">-- Selecciona Marca --</option>
                  <?php
                    $nom = array();
                    $sql2="select * from marca where estado = 1 and id_tipoLinea = 3 ";
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
          <label for="mod_modelo_m" class="col-sm-3 control-label">Tipo Modelo:</label>
            <div class="col-md-9 col-sm-9 col-xs-12">
              <select  class="form-control estilo-placeholder" id="mod_modelo_m" name="mod_modelo_m" required>
                <option class="custom-select" value="0">-- Selecciona Modelo --</option>
                  <?php
                    $nom = array();
                    $sql2="select * from modelos where estado = 1";
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
          <label for="nombre_editar_motor" class="col-sm-3 control-label">Nombre Motor:</label>
            <div class="col-md-9 col-sm-9 col-xs-12">
              <input type="text" class="form-control estilo-placeholder" id="nombre_editar_motor" name="nombre_editar_motor" maxlength="50">
            </div>
        </div>  

        <div class="form-group">
          <label for="descripcion_editar_motor" class="col-sm-3 control-label">Descripción Motor:</label>
            <div class="col-md-9 col-sm-9 col-xs-12">
              <input type="text" class="form-control estilo-placeholder" id="descripcion_editar_motor" name="descripcion_editar_motor" maxlength="50">
            </div>
        </div>  
                        
      </div>
      <div class="modal-footer">
      <button type="button" class="btn btn-cancelar" data-dismiss="modal">Cerrar</button>
      <button type="submit" class="btn btn-agregar" id="actualizar_datos">Actualizar datos</button>
      </div>
      </form>
    </div>
    </div>
  </div>
  <?php
    }
  ?>
  <script type="text/javascript">
  $('#mod_marca_m').on('change',function(){
    console.log('waaaaaaaaaaaaaaaaaa');
        var marca_m = $("#mod_marca_m").val();
        if(marca_m){
            $.ajax({
                type:'POST',
                url:'./modal/appblade.php',
                data:'marca_m='+marca_m,
                success:function(html){
                    $('#mod_modelo_m').html(html);
                }
            }); 
        }else{
            $('#mod_modelo_m').html('<option value="">Seleccione marca primero</option>');
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