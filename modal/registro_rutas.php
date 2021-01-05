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
              
           
                
                
		<div class="modal-content" style="background: #F5ECCE;">
                    
                  
                    
		  <div class="modal-header" style="background: #58FAAC;">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel"><i class='glyphicon glyphicon-edit'></i><font color="black"> Agregar nuevo horario</font></h4>
		  </div>
		  <div class="modal-body">
			<form class="form-horizontal" method="post" id="guardar_rutas" name="guardar_rutas" >
			<div id="resultados_ajax"></div>
                        
			  <div class="form-group">
				<label for="nombre" class="col-sm-3 control-label">Conductor</label>
				<div class="col-sm-8">
				 <select class="form-control" id="nombre" name="nombre" required onchange="mostrarValor(this.value);">
					<option value="">-- Selecciona Conductor --</option>
			
                        <?php
                        
                        $link2=conectar1();
                        
                        $nom = array();
    $sql2="select * from $db_users ORDER BY  `users`.`nombres` ASC ";
    
$rs1=mysqli_query($link2,$sql2);
while($row3=mysqli_fetch_array($rs1)){
    
    if($tienda1==$row3["sucursal"]){
$user_id=$row3["user_id"];
$nombres=$row3["nombres"];
$hora=$row3["hora"];

$valor=$user_id."-".$hora;
?>

                                        <option value="<?php  echo $valor;?>"><?php  echo $nombres;?> </option>

<?php

}
 }                       
                        ?>
                     
                         </select>
				</div>
			  </div>
			  
                        
                        
                        
                     
                        <div class="form-group">
				<label for="nom_cat" class="col-sm-3 control-label">Hora de salida:</label>
				<div class="col-md-8 col-sm-8 col-xs-12">
                                    <input type="time" class="form-control" name="hora_salida" id="hora_salida" >
				</div>
			  </div>
                 	
                          <div class="form-group">
				<label for="nom_cat" class="col-sm-3 control-label">Fecha de salida:</label>
				<div class="col-md-8 col-sm-8 col-xs-12">
                                    <input type="date" class="form-control" name="dia_salida" id="dia_salida"  >
				</div>
			  </div>
                        
                        
                        <div class="form-group">
				<label for="nom_cat" class="col-sm-3 control-label">Hora de llegada:</label>
				<div class="col-md-8 col-sm-8 col-xs-12">
                                    <input type="time" class="form-control" name="hora_llegada" id="hora_llegada"  >
				</div>
			  </div>
                        
                           <div class="form-group">
				<label for="nom_cat" class="col-sm-3 control-label">Dia de llegada:</label>
				<div class="col-md-8 col-sm-8 col-xs-12">
                                    <input type="date" class="form-control" name="dia_llegada" id="dia_llegada" >
				</div>
			  </div>
                        
                        <div class="form-group">
				<label for="nombre" class="col-sm-3 control-label">Origen</label>
				<div class="col-sm-8">
				 <select class="form-control" id="origen" name="origen" required >
					<option value="">-- Selecciona origen --</option>
			
                        

                                        <option value="LIMA">LIMA </option>
                                        <option value="CANETE">CAÑETE </option>
                                        <option value="CHINCHA">CHINCHA </option>
                                        <option value="PISCO">PISCO </option>
                                        <option value="ICA">ICA </option>

                     
                         </select>
				</div>
			  </div>
                        
                        
                         <div class="form-group">
				<label for="nombre" class="col-sm-3 control-label">Destino</label>
				<div class="col-sm-8">
				 <select class="form-control" id="destino" name="destino" required >
					<option value="">-- Selecciona destino --</option>
			
                        

                                        <option value="LIMA">LIMA </option>
                                        <option value="CANETE">CAÑETE </option>
                                        <option value="CHINCHA">CHINCHA </option>
                                        <option value="PISCO">PISCO </option>
                                        <option value="ICA">ICA </option>

                     
                         </select>
				</div>
			  </div>
                        
                        
                        
                         <div class="form-group">
				<label for="nom_cat" class="col-sm-3 control-label">Unidad:</label>
				<div class="col-md-8 col-sm-8 col-xs-12">
                                    <input type="text" class="form-control" name="id_buses" id="id_buses" >
				</div>
			  </div>
                        
                        
                         <div class="form-group">
				<label for="nom_cat" class="col-sm-3 control-label">km:</label>
				<div class="col-md-8 col-sm-8 col-xs-12">
                                    <input type="text" class="form-control" name="km" id="km" >
				</div>
			  </div>
                          <div class="form-group">
				<label for="nom_cat" class="col-sm-3 control-label">Horas:</label>
				<div class="col-md-8 col-sm-8 col-xs-12">
                                    <input type="text" class="form-control" name="horas" id="horas" >
				</div>
			  </div>
                        
		  </div>
		  <div class="modal-footer">
                      
			<button type="button" class="btn btn-info" data-dismiss="modal">Cerrar</button>
			<button type="submit" class="btn btn-primary" id="guardar_datos">Guardar datos</button>
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


