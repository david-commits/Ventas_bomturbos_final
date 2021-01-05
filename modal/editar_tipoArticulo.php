	<?php
		if (isset($con))
		{
	?>
	<!-- Modal -->
	<div class="modal fade" id="myModalTipoArticulo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalModelo">Editar Tipo de Articulo</h4>
		  </div>
		  <div class="modal-body">
			<form class="form-horizontal" method="post" id="editar_tipoLinea" name="editar_tipoLinea">
			<div id="resultados_ajax2"></div>

               <div class="form-group">
				<label for="mod_tlinea_mod" class="col-sm-3 control-label">Tipo de Linea:</label>
				<div class="col-md-9 col-sm-9 col-xs-12">
					<select class="form-control estilo-placeholder" id="mod_tlinea_mod" name="mod_tlinea_mod" required >

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
				<label for="mod_categoria_mod" class="col-sm-3 control-label">Categoría:</label>
				<div class="col-md-9 col-sm-9 col-xs-12">
										<select class="form-control estilo-placeholder" id="mod_categoria_mod" name="mod_categoria_mod" required >

					<option class="custom-select" value="">-- Selecciona Categoria --</option>

			            <?php
                       
                        $nom = array();
                        $sql2="select * from categorias where estado = 1 ";
                        $i=0;
                        $rs1=mysqli_query($con,$sql2);
                        while($row3=mysqli_fetch_array($rs1)){
                            $nom_cat=$row3["nom_cat"];
                            $id_categoria=$row3["id_categoria"];
                            ?>
                            <option class="custom-select" value="<?php  echo $id_categoria;?>"><?php  echo $nom_cat;?></option>
                            <?php
                            $i=$i+1;
                        }
                        
                        ?>
                     
                         </select>
				</div>
			    </div>


                <div class="form-group">
				<label for="mod_nombre" class="col-sm-3 control-label">Nombre tipo Articulo:</label>
				<div class="col-md-9 col-sm-9 col-xs-12">
					<input type="hidden" name="mod_idtipo" id="mod_idtipo">
				  <input type="text" class="form-control estilo-placeholder" id="mod_nombre" name="mod_nombre" required="true" maxlength="50">
				</div>
			    </div>  

			     <div class="form-group" style="display: none;">
				<label for="mod_estado" class="col-sm-3 control-label">Estado</label>
				<div class="col-md-9 col-sm-9 col-xs-12">
                  <select class="form-control estilo-placeholder" id="mod_estado" name="mod_estado" required="true" >
                       <option class="custom-select" value="1" checked>Activo</option>
                       <option class="custom-select" value="0">Inactivo</option>
                   </select>
				</div>
			    </div>
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-cancelar" data-dismiss="modal">Cerrar</button>
			<button type="submit" class="btn btn-agregar" id="actualizar_tipoLinea">Actualizar Datos</button>
		  </div>
		  </form>
		</div>
	  </div>
	</div>
	<?php
		}
	?>

<script type="text/javascript">
  $('#mod_tlinea_mod').on('change',function(){
    console.log('waaaaaaaaaaaaaaaaaa');
        var tlinea = $("#mod_tlinea_mod").val();
        if(tlinea){
            $.ajax({
                type:'POST',
                url:'./modal/appblade.php',
                data:'tl_tlinea='+tlinea,
                success:function(html){
                    $('#mod_categoria_mod').html(html);
                }
            }); 
        }else{
            $('#mod_categoria_mod').html('<option value="">Seleccione Tipo Linea primero</option>');
        }
    });
</script>