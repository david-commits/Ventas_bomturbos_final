	<?php
		if (isset($con))
		{
	?>
	<!-- Modal -->
	<div class="modal fade" id="myModalModelo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalModelo">Editar Modelo</h4>
		  </div>
		  <div class="modal-body">
			<form class="form-horizontal" method="post" id="editar_marca" name="editar_marca">
			<div id="resultados_ajax2"></div>

                			<div class="form-group">
				<label for="tlinea_mod" class="col-sm-3 control-label">Tipo de Linea:</label>
				<div class="col-md-9 col-sm-9 col-xs-12">
				 
				<select class="form-control estilo-placeholder" id="tlinea_mod" name="tlinea_mod"  >

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
				<label for="mod_idMarca" class="col-sm-3 control-label">Marca:</label>
				<div class="col-md-9 col-sm-9 col-xs-12">
				 <input type="hidden" name="mod_idModelo" id="mod_idModelo">
				<select class="form-control estilo-placeholder" id="mod_idMarca" name="mod_idMarca" required >
					<option class="custom-select" value="">-- Selecciona marca --</option>
			            <?php
                       
                        $nom = array();
                        $sql2="select * from marca where id_tipoLinea = 3 or id_tipoLinea = 4 or id_tipoLinea = 5 ";
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
			  </div>


                <div class="form-group">
				<label for="mod_modelo" class="col-sm-3 control-label">Nombre de Modelo:</label>
				<div class="col-md-9 col-sm-9 col-xs-12">
				  <input type="text" class="form-control estilo-placeholder" id="mod_modelo" name="mod_modelo" maxlength="50">
				</div>
			    </div>  
                        
			    <div class="form-group">
				<label for="mod_descripcion" class="col-sm-3 control-label">Descripción Modelo:</label>
				<div class="col-md-9 col-sm-9 col-xs-12">
				  <input type="text" class="form-control estilo-placeholder" id="mod_descripcion" name="mod_descripcion" maxlength="100">
				</div>
			    </div>

			    <div class="form-group" style="display: none">
				<label for="mod_estado" class="col-sm-3 control-label">Estado</label>
				<div class="col-md-9 col-sm-9 col-xs-12">
                    <select class="form-control estilo-placeholder" id="mod_estado" name="mod_estado" required="true" >
                        <option class="custom-select" value="1" checked>Activo</option>
                    </select>
				</div>
			    </div>
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-cancelar" data-dismiss="modal">Cerrar</button>
			<button type="submit" class="btn btn-agregar" id="actualizar_modelo">Actualizar datos</button>
		  </div>
		  </form>
		</div>
	  </div>
	</div>
	<?php
		}
	?>
	            <script type="text/javascript">
  $('#tlinea_mod').on('change',function(){
        var tlinea_m = $("#tlinea_mod").val();
        console.log(tlinea_m);
        if(tlinea_m){


            $.ajax({
                type:'POST',
                url:'./modal/appblade.php',
                data:'tlinea_m='+tlinea_m,
                success:function(html){
                  console.log(html);
                    $('#mod_idMarca').html(html);
                }
            });

        }else{
            $('#mod_idMarca').html('<option class="custom-select" value="">Seleccione Tipo Linea primero</option>');
        }
    });
</script>