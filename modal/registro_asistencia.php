	<!doctype html>
<html lang="en">
<head>
<script>
  function limpiarFormulario() {
    document.getElementById("guardar_asistencia").reset();
    
    
    
  }
  
  
  
  var mostrarValor = function(x){
      var x;
var porciones = x.split('-');

      
      
     document.getElementById('valoreninput').value=porciones[1];
};
</script>
 


</head>
<?php
        //include('conexion.php');
        //include('menu.php');
        
        
        
		if (isset($con))
		{
	$tienda1=$_SESSION['tienda'];
                    
                    ?>

	<!-- Modal -->
     
        
          <body>  
            
	<div class="modal fade" id="nuevoProducto" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	 
         
               
            <div class="modal-dialog" role="document">
              
           
                
                
		<div class="modal-content">
                    
                  
                    
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Agregar nueva asistencia</h4>
		  </div>
		  <div class="modal-body">
			<form class="form-horizontal" method="post" id="guardar_asistencia" name="guardar_asistencia" >
			<div id="resultados_ajax"></div>
                        
			  <div class="form-group">
				<label for="nombre" class="col-sm-3 control-label">Empleado</label>
				<div class="col-sm-8">
				 <select class="form-control estilo-placeholder" id="nombre" name="nombre" required onchange="mostrarValor(this.value);">
					<option class="custom-select" value="">-- Selecciona Empleado --</option>
			
                        <?php
                        
                        
                        
                        $nom = array();
    $sql2="select * from users ORDER BY  `users`.`nombres` ASC ";
    
$rs1=mysqli_query($con,$sql2);
while($row3=mysqli_fetch_array($rs1)){
    
    if($tienda1==$row3["sucursal"]){
$user_id=$row3["user_id"];
$nombres=$row3["nombres"];
$hora=$row3["hora"];

$valor=$user_id."-".$hora;
?>

                                        <option  class="custom-select" value="<?php  echo $valor;?>"><?php  echo $nombres;?> </option>

<?php

}
 }                       
                        ?>
                     
                         </select>
				</div>
			  </div>
			  
                        
                        
                        
                     
                        <div class="form-group">
				<label for="nom_cat" class="col-sm-3 control-label">Hora de entrada:</label>
				<div class="col-md-8 col-sm-8 col-xs-12">
                                    <input type="text" class="form-control estilo-placeholder" name="valoreninput" id="valoreninput" placeholder="Hora" readonly>
				</div>
			  </div>
                 	
                        
                         <div class="form-group">
				<label for="tipo_reg" class="col-sm-3 control-label">Tipo de Registro:</label>
				<div class="col-sm-8">
				 <select class="form-control estilo-placeholder" id="tipo_reg" name="tipo_reg" required >
					<option value="">-- Selecciona tipo de registro --</option>
			
                        
                                        <option class="custom-select" value="1">Hora de Ingreso</option>
                                        <option class="custom-select" value="2">Hora de Salida</option>


                     
                         </select>
				</div>
			  </div>
                        
		  </div>
		  <div class="modal-footer">
                      
			<button type="button" class="btn btn-cancelar" data-dismiss="modal">Cerrar</button>
			<button type="submit" class="btn btn-guardar" id="guardar_datos">Guardar datos</button>
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


