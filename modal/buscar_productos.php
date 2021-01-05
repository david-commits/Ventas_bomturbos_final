
  <?php

    if (isset($con))
    {
  ?>  
 <script type="text/javascript">
     function limpiarFiltro() {
    document.getElementById("form_filtros").reset();
    $('#motor_m').html('<option value="">Seleccione modelo primero</option>');
    load(1);
  }

 </script>
      <!-- Modal -->
      <div class="modal fade modal-xl" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">Buscar productos <span id="cabecera_modal"></span></h4>
          </div>
          <div class="modal-body">
          <form class="form-horizontal" id="form_filtros" name="form_filtros">
            
              <div class="form-group row">
                <div class="col-md-4 col-sm-4 col-xs-12 separador-compras">
                      Categorías:
                    <select  class="form-control estilo-placeholder" id="categoria_m" onchange="cargarload(1)" name="categoria_m">
                      <option  class="custom-select" value="">-- Selecciona Categoría --</option>
                          <?php
                          $nom1 = array();
                          $sql1="select * from categorias where estado = 1  ";
                          $rs1=mysqli_query($con,$sql1);
                          while($row3=mysqli_fetch_array($rs1)){
                            $nombre_categoria=$row3["nom_cat"];
                            $id_categoria=$row3["id_categoria"];
                            ?>
                            <option  class="custom-select" value="<?php  echo $id_categoria;?>"><?php  echo $nombre_categoria;?></option>
                            <?php
                          }
                          ?>
                        </select>
                </div>

                <div class="col-md-4 col-sm-4 col-xs-12 separador-compras">
                  Marca:
                    <select  class="form-control estilo-placeholder" onchange="cargarload(1)" id="marca_m" name="marca">
                      <option  class="custom-select" value="">-- Selecciona Marca --</option>
                          <?php
                          $nom1 = array();
                          $sql1="select * from marca where id_tipoLinea = 3 and estado = 1";
                          $rs1=mysqli_query($con,$sql1);
                          while($row3=mysqli_fetch_array($rs1)){
                            $nombre_marca=$row3["nombre_marca"];
                            $id_marca=$row3["id_marca"];
                            ?>
                            <option  class="custom-select" value="<?php  echo $id_marca;?>"><?php  echo $nombre_marca;?></option>
                            <?php
                          }
                          ?>
                    </select>
                </div>

                <div class="col-md-4 col-sm-4 col-xs-12 separador-compras">
                  Modelo:
                    <select   class="form-control estilo-placeholder" onchange="cargarload(1)" id="modelo_m" name="modelo" >
                      <option class="custom-select" value="">-- Selecciona modelo --</option>
                    </select>
                </div>

                <div class="col-md-4 col-sm-4 col-xs-12 separador-compras">
                  Motor:
                    <select   class="form-control estilo-placeholder" onchange="cargarload(1)" id="motor_m" name="motor_m" >
                      <option class="custom-select" value="">-- Selecciona Motor --</option>
                    </select>
                </div>

                <div class="col-md-4 col-sm-4 col-xs-12 separador-compras">
                  Año:
                    <input type="text" name="anio_compatibilidad" onkeyup="cargarload(1)" id="anio_compatibilidad" class="form-control estilo-placeholder">
                </div>

                <div class="col-md-4 col-sm-4 col-xs-12 separador-compras">
                  Litros:
                    <input type="text" name="litros_compatibilidad" onkeyup="cargarload(1)" id="litros_compatibilidad" class="form-control estilo-placeholder">
                </div>

                <!--<div class="col-md-12 col-sm-12 col-xs-12 separador-compras">
                  <button type="button" class="btn btn-guardar" onclick="load(1)">
                      <span class='glyphicon glyphicon-search'></span> Buscar
                    </button>
                </div>-->

                <div class="col-md-4 col-sm-4 col-xs-12 separador-compras">
                  Dscripción Productos:
                    <input type="text" class="form-control estilo-placeholder" id="q" placeholder="Dscripción Productos" onkeyup="load(1)">
                </div>
                <div class="col-md-4 col-sm-4 col-xs-12 separador-compras">
                  Descripción Vehículos:
                    <input type="text" class="form-control estilo-placeholder" id="q2" placeholder="Descripción Vehículos" onkeyup="load(1)">
                </div>
                <div class="col-md-4 col-sm-4 col-xs-12 separador-compras" style="padding-top: 18px!important;">
                       <button type="button" class="btn btn-guardar" onclick="limpiarFiltro()">
                        <span class="glyphicon glyphicon-plus"></span> Limpiar Filtros
                      </button>
                </div>
              </div>             
             
            </form>
           <div id="loader" style="position: absolute;  text-align: center; top: 55px;  width: 100%;display:none;"></div><!-- Carga gif animado -->
        <div id="modal-body-scroll">
           <div class="outer_div" ></div><!-- Datos ajax Final -->
          
        </div>
         

          </div>
          <div class="modal-footer">
           <button type="button" class="btn btn-cancelar" data-dismiss="modal">Cerrar</button>
          </div>
        </div>
        </div>
      </div>
  <?php
    }
  ?>
<script type="text/javascript">
  $('#marca_m').on('change',function(){
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


  $('#modelo_m').on('change',function(){
        var modelo_m = $("#modelo_m").val();
        var marca_marca = $("#marca_m").val();
        if(modelo_m){
            $.ajax({
                type:'POST',
                url:'./modal/appblade.php',
                data:{'modelo_m': modelo_m, 'marca_marca': marca_marca },
                success:function(html){
                    $('#motor_m').html(html);
                }
            }); 
        }else{
            $('#motor_m').html('<option value="">Seleccione modelo primero</option>');
        }
    });
</script>


<!-- <style type="text/css">
  #modal-body-scroll{
  height: 410px;
  width: 100%;
  overflow-y: auto;
}
</style> -->