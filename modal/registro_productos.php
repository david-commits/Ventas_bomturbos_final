	<!DOCTYPE html>


<head>

  <script> 
      

function multiplicar(){
m1 = $("multiplicando").value;
m2 = $("#costo").value;
m3 = $("uti").value;
r = m1*m2;

$("resultado").value = r;

r2=$("resultado").value;
r1=1*r2+1*m3;
$("precio").value = r1;
}
      
      


</script> 

<script type="text/javascript">
	function va(esto)
	{		
		$('multiplicando').value=esto;
                m2 = $("costo").value;
                m3 = $("uti").value;
                r = esto*m2;
                $("resultado").value = r;
                r2=$("resultado").value;
                r1=1*r2+1*m3;
                $("precio").value = r1;
	}
	</script>
<script>
  function limpiarNuevoFormulario() {
   $("#nombre").val('');
   $("#cat_pro").val(0);
   $("#estado").val(0);
   $("#marca").val(0);
   $("#codigoProveedor").val('');
   $("#codigoAlternativo").val('');
   $("#codigoProducto").val('');
   $("#medida").val('');
   $("#costo").val('');
   $("#resultado").val('');
   $("#uti").val('');
   $("#precio").val('');
   $("#inventario").val('0');
   document.getElementById('tipo_gananciasoles').setAttribute('checked', true);
   document.getElementById('tipo_gananciadolares').setAttribute('checked', false);

  }

 function nuevafuncionprueba() {
  $("#nombre").val('');
   $("#cat_pro").val(0);
   $("#estado").val(0);
   $("#marca").val(0);
   $("#codigoProveedor").val('');
   $("#codigoAlternativo").val('');
   $("#codigoProducto").val('');
   $("#medida").val('');
   $("#costo").val('');
   $("#resultado").val('');
   $("#uti").val('');
   $("#precio").val('');
   $("#inventario").val('0');
   document.getElementById('tipo_gananciasoles').setAttribute('checked', true);
   document.getElementById('tipo_gananciadolares').setAttribute('checked', false);

  }

</script>


</head>
<?php
$nom = array();
$sql2="select * from products ";
$i=0;
$rs1=mysqli_query($con,$sql2);
while($row3=mysqli_fetch_array($rs1)){
    $nom[$i]=$row3["nombre_producto"];
    $i=$i+1;
}

$sqltraergenericos1 = "SELECT * FROM tipo WHERE tipo = 'GENERICO' ";
$sqltraergenericos2 = "SELECT * FROM categorias WHERE nom_cat = 'GENERICO' ";
$sqltraergenericos3 = "SELECT * FROM marca WHERE nombre_marca = 'GENERICO' ";

$rsgenerico1 = mysqli_query($con, $sqltraergenericos1);
$rsgenerico2 = mysqli_query($con, $sqltraergenericos2);
$rsgenerico3 = mysqli_query($con, $sqltraergenericos3);

while ($rowgenerico1 = mysqli_fetch_array($rsgenerico1)){
	$vgenerico1 = $rowgenerico1["id_tipo"];
}
while ($rowgenerico2 = mysqli_fetch_array($rsgenerico2)){
	$vgenerico2 = $rowgenerico2["id_categoria"];
}
while ($rowgenerico3 = mysqli_fetch_array($rsgenerico3)){
	$vgenerico3 = $rowgenerico3["id_marca"];
}

$consultatraemosprcntj = "SELECT * FROM constante WHERE estado = 1";
$result3 = mysqli_query($con, $consultatraemosprcntj);

while($nuevovalorprcntj = mysqli_fetch_array($result3))
{
  $prcntjtraido = $nuevovalorprcntj['monto'];
}


$consulta2 = "SELECT * FROM datosempresa ";
$result2 = mysqli_query($con, $consulta2);
$valor2 = mysqli_fetch_array($result2, MYSQLI_ASSOC);
$dolar=$valor2['dolar'];
	?>

	<!-- Modal -->
     
       
         <body>  
            
	<div class="modal fade" id="nuevoProducto" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	 
			<div class="modal-dialog" role="document">

				<div class="modal-content estilo-placeholder">

					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="myModalLabel">Agregar Nuevo Producto en la Tienda <?php echo $_SESSION['tienda']; ?></h4>
					</div>

					<div id="resultados_ajax_productos"></div>
<div class="modal-body" style="height:500px;overflow-y: scroll;">
						<form class="form-horizontal" method="post" id="guardar_producto" name="guardar_producto">
							
						<input name="auto_completarform" type="checkbox" id="auto_completarform" name="auto_completarform" value="1" style="margin-left: 95%;">

							<div class="form-group">
								<label for="nombre" class="col-sm-3 control-label">Nombre:</label>
								<div class="col-sm-9">
									<input type="text" class="form-control estilo-placeholder" id="nombre" name="nombre" placeholder="Nombre del producto" required>
								</div>
							</div>
                        
                        <div class="form-group">
				<label for="cat_pro" class="col-sm-3 control-label">Categoria:</label>
				<div class="col-md-9 col-sm-9 col-xs-12">
				 <select class="form-control estilo-placeholder" id="cat_pro" name="cat_pro" required>
					<option class="custom-select" value="0">-- Selecciona Categoria --</option>
			
                        <?php
                       
                        $nom = array();
                        $sql2="select * from categorias where estado = 1 order by nom_cat asc";
                        $i=0;
                        $rs1=mysqli_query($con,$sql2);
                        while($row3=mysqli_fetch_array($rs1)){
                            $nom_cat=$row3["nom_cat"];
                            $id_categoria=$row3["id_categoria"];
                            ?>
											<option class="custom-select" value="<?php echo $id_categoria; ?>"><?php echo $nom_cat; ?></option>
										<?php
                            $i=$i+1;
                        }
                        
                        ?>
                     
                         </select>
				</div>
			  </div>


<div class="form-group">
				<label for="codigoProveedor" class="col-sm-3 control-label">Codigo Proveedor:</label>
				<div class="col-md-9 col-sm-9 col-xs-12">

								<input type="text" class="form-control estilo-placeholder" id="codigoProveedor" name="codigoProveedor" placeholder="Còdigo del Proveedor" required>
				</div>
</div>





                         <div class="form-group">
				<label for="estado" class="col-sm-3 control-label">Tipo de Articulo:</label>
				<div class="col-md-9 col-sm-9 col-xs-12">
				 <select class="form-control estilo-placeholder" id="estado" name="estado" required>
					<option class="custom-select" value="0">-- Selecciona tipo de articulo --</option>
			
                        <?php
                       
                        $nom = array();
                        $sql2="select * from tipo where estado = 1 order by tipo asc ";
                        $i=0;
                        $rs1=mysqli_query($con,$sql2);
                        while($row3=mysqli_fetch_array($rs1)){
                            $nom_tipo=$row3["tipo"];
                            $id_tipo=$row3["id_tipo"];
                            ?>
                            <option class="custom-select" value="<?php  echo $id_tipo;?>"><?php  echo $nom_tipo;?></option>
                            <?php
                            $i=$i+1;
                        }
                        
                        ?>
				  </select>
				</div>
			  </div>
                        
                        
                         <div class="form-group">
				<label for="marca" class="col-sm-3 control-label">Marca:</label>
				<div class="col-md-9 col-sm-9 col-xs-12">
				 <select class="form-control estilo-placeholder" id="marca" name="marca" required>
					<option class="custom-select" value="0">-- Selecciona tipo de Marca --</option>
			
                        <?php
                       
                        $nom = array();
                        $sql2="select * from marca ORDER BY nombre_marca asc";
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
				<label for="codigoProducto" class="col-sm-3 control-label">Codigo Producto:</label>
				<div class="col-md-9 col-sm-9 col-xs-12">
				  <input type="text" class="form-control estilo-placeholder" id="codigoProducto" name="codigoProducto" placeholder="Ingrese el Codigo Producto" title="Ingrese el Codigo Producto" maxlength="50">
				</div>
			  </div>



			  






			  <div class="form-group">
				<label for="codigoAlternativo" class="col-sm-3 control-label">Codigo Alternativo:</label>
				<div class="col-md-9 col-sm-9 col-xs-12">
				  <input type="text" class="form-control estilo-placeholder" id="codigoAlternativo" name="codigoAlternativo" placeholder="Ingrese el codigo proveedor" title="Ingrese el codigo proveedor" maxlength="50">
				</div>
				<input type="hidden" id="porcentajeoculto" value="<?php echo $prcntjtraido; ?>">
			  </div>

			  <div class="form-group">
				<label for="medida" class="col-sm-3 control-label">Medida:</label>
				<div class="col-md-9 col-sm-9 col-xs-12">
				  <input type="text" class="form-control estilo-placeholder" id="medida" name="medida" placeholder="Ingrese la medida" title="Ingrese la medida" maxlength="50">
				</div>
			  </div>

                        
			  <div class="form-group">
				<label for="precio" class="col-sm-3 control-label">Costo en dólares:</label>
				<div class="col-md-9 col-sm-9 col-xs-12">
				  <input type="number" step="any" class="form-control estilo-placeholder"  id="costo" name="costo" onblur="FuncionQuitarCosto()"  placeholder="Precio de costo del producto" required pattern="^[0-9]{1,5}(\.[0-9]{0,2})?$" title="Ingresa sólo números con 0 ó 2 decimales" maxlength="8">


				        	<div class="form-group">
								<label for="precio" class="col-sm-3 control-label my-0">TCP:</label>
								<div class="col-md-9 col-sm-9 col-xs-12">
								  <input class="estilo-placeholder w-100 pl-3" type="number"  step="any" id="multiplicando" name="multiplicando" value="<?php echo $dolar; ?>">
								</div>
							</div>

							<div class="form-group">
								<label for="" class="col-sm-3 control-label my-0">Costo en S/:</label>
								<div class="col-md-9 col-sm-9 col-xs-12 flex align-items-center">
									<input type="text" class="estilo-placeholder w-100 pl-3" size="10" type="text" id="resultado" readonly/>
								</div>
							</div>

        					<div class="form-group">
								<label for="uti" class="col-sm-3 control-label">M. Ganancia en Dinero:</label>
								<div class="col-md-9 col-sm-9 col-xs-12">
									<input style="margin-top:20px;" type="radio" id="tipo_gananciasoles" class="tipo_ganancia" name="tipo_ganancia" value="gsoles">
								</div>
							</div>				

							<div class="form-group">
								<label for="uti" class="col-sm-3 control-label">M. Ganancia por %:</label>
								<div class="col-md-9 col-sm-9 col-xs-12">
									<input style="margin-top:11px;" type="radio" id="tipo_gananciadolares" class="tipo_ganancia" name="tipo_ganancia" value="gporcentaje">
								</div>
							</div>
			  </div>
                        
                   <!--     <div class="form-group">
				<label for="estado" class="col-sm-3 control-label">M GANANCIA EN MONTO</label>
				<div class="col-md-9 col-sm-9 col-xs-12">
				
					
                                <input name="mon_costo" id="montosoles" type="radio"  value="1" onclick="va(1);">Soles 
                                <input name="mon_costo" id="montodolares"  type="radio"  value="<?php echo $dolar;?>" onclick="va(<?php echo $dolar;?>);" checked>Dolares -->
								<input type="hidden" id="genericohidden1" name="genericohidden1" value="<?php echo $vgenerico1;?>">
								<input type="hidden" id="genericohidden2" name="genericohidden2" value="<?php echo $vgenerico2;?>">
								<input type="hidden" id="genericohidden3" name="genericohidden3" value="<?php echo $vgenerico3;?>"><!--
				  
				</div>
			  </div>-->
                      

							<div class="form-group">
								<label for="uti" class="col-sm-3 control-label">M ganancia:</label>
								<div class="col-md-9 col-sm-9 col-xs-12">
									<input type="number" step="any" class="form-control estilo-placeholder" id="uti" onChange="multiplicar();" name="uti" placeholder="Precio de venta del producto" required pattern="^[0-9]{1,5}(\.[0-9]{0,2})?$" title="Ingresa sólo números con 0 ó 2 decimales" maxlength="8">
								</div>
								<input type="hidden" id="montocporcentaje" value="">
								<input type="hidden" id="dolardefinidoya" value="<?php echo $dolar;  ?>">
								<input type="hidden" id="valorcostoblur" value="">
							</div>









<script>
function limpia(elemento)
{
elemento.value = "";
}

function verifica(elemento)
{
if(elemento.value == "")
elemento.value = "";
}
</script>
                             

			  							<div class="form-group">
								<label for="precio" class="col-sm-3 control-label">Precio venta soles:</label>
								<div class="col-md-9 col-sm-9 col-xs-12">
									<input type="number" step="any" class="form-control estilo-placeholder" id="precio" name="precio" placeholder="Precio 1" required pattern="^[0-9]{1,5}(\.[0-9]{0,2})?$" title="Ingresa sólo números con 0 ó 2 decimales" maxlength="8">
								</div>
							</div>
                        
    <!--            
			 
                        <div class="form-group">
				<label for="precio" class="col-sm-3 control-label">Precio 2</label>
				<div class="col-md-9 col-sm-9 col-xs-12">
                                    <input type="text"  class="form-control" id="precio" name="precio2" placeholder="Precio 2" required pattern="^[0-9]{1,5}(\.[0-9]{0,2})?$" title="Ingresa sólo números con 0 ó 2 decimales" maxlength="8">
				</div>
			  </div>

                          <div class="form-group">
				<label for="precio" class="col-sm-3 control-label">Precio 3</label>
				<div class="col-md-9 col-sm-9 col-xs-12">
                                    <input type="text"  class="form-control" id="precio" name="precio3" placeholder="Precio 3" required pattern="^[0-9]{1,5}(\.[0-9]{0,2})?$" title="Ingresa sólo números con 0 ó 2 decimales" maxlength="8">
				</div>
			  </div> -->
                        

			 
							<div class="form-group">
								<label for="precio" class="col-sm-3 control-label">Inventario:</label>
								<div class="col-md-9 col-sm-9 col-xs-12">
									<input type="text" class="form-control estilo-placeholder" id="inventario" name="inventario" placeholder="Inventario inicial del producto" required pattern="^[0-9]{1,5}(\.[0-9]{0,2})?$" title="Ingresa sólo números con 0 ó 2 decimales" maxlength="8">
								</div>
							</div>


			
		  </div>
					<div class="modal-footer">
						<button type="button" class="btn btn-cancelar" data-dismiss="modal" onclick="nuevafuncionprueba()">Cerrar</button>
						<button type="button" class="btn btn-limpiar" onclick="limpiarNuevoFormulario()">Limpiar</button>
						<button type="submit" class="btn btn-agregar" id="guardar_datos">Guardar Datos</button>
					</div>
					</form>
		</div>
	  </div>
	</div>
	<?php
	//	}
	?>
             <script type="text/javascript" src="js/autocomplete/countries.js"></script>
  <script src="js/autocomplete/jquery.autocomplete.js"></script>
  <!-- pace -->
  <script src="js/pace/pace.min.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    
        <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
	
       
        <script type="text/javascript">
	/*function va(esto)
	{		
		document.getElementById('multiplicando').value=esto;
                m2 = document.getElementById("costo").value;
                m3 = document.getElementById("uti").value;
                r5 = esto*m2;
                var r = r5.toFixed(2);
                document.getElementById("resultado").value = r;
                r2=document.getElementById("resultado").value;
                r1=1*r2+1*m3;
                var r6 = r1.toFixed(2);
              
	}*/
	</script>









        <script>
        	    $(document).ready(function() {
    
  var mc = $('input:radio[name=mon_costo]:checked').val();
    document.getElementById('multiplicando').value=mc;
    document.getElementById('inventario').value=0;
    var esto = $("#dolardefinidoya").val();
document.getElementById('multiplicando').value=esto;  
});


function FuncionQuitarCosto() {
var traemoselcosto = $("#costo").val();
var traemoselcostodelhidden = $("#valorcostoblur").val();

	if (traemoselcosto == null || traemoselcosto == NaN || traemoselcosto == 0 ) 
	{
		if (traemoselcostodelhidden == null  ||  traemoselcostodelhidden == NaN || traemoselcostodelhidden == 0 ) 
		{
			$("#costo").val(0);
		}
		else
		{
			$("#costo").val(traemoselcostodelhidden);
			var nuevomcp = $("#multiplicando").val();

			traemoselcostodelhidden = parseFloat(traemoselcostodelhidden);
	traemoselcostodelhidden = traemoselcostodelhidden.toFixed(2); 

	nuevomcp = parseFloat(nuevomcp);
	nuevomcp = nuevomcp.toFixed(2); 

	var resultadoresultado = traemoselcostodelhidden*nuevomcp;
	$("#resultado").val(resultadoresultado);





		}
	}
}

		$(function() {
						$("#nombre_producto").autocomplete({
							source: "ajax/autocomplete/productos.php",
							minLength: 2,
							select: function(event, ui) {
								event.preventDefault();
								$('#id_producto').val(ui.item.id_producto);
								$('#nombre_producto').val(ui.item.nombre_producto);
								$('#precio_producto').val(ui.item.precio_producto);
								$('#inv_producto').val(ui.item.inv_producto);
																
								
							 }
						});
						 
						
					});
					
	$("#nombre_producto" ).on( "keydown", function( event ) {
						if (event.keyCode== $.ui.keyCode.LEFT || event.keyCode== $.ui.keyCode.RIGHT || event.keyCode== $.ui.keyCode.UP || event.keyCode== $.ui.keyCode.DOWN || event.keyCode== $.ui.keyCode.DELETE || event.keyCode== $.ui.keyCode.BACKSPACE )
						{
							$("#id_producto" ).val("");
							$("#inv_producto" ).val("");
							$("#precio_producto" ).val("");
											
						}
						if (event.keyCode==$.ui.keyCode.DELETE){
							$("#nombre_producto" ).val("");
							$("#id_producto" ).val("");
							$("#inv_producto" ).val("");
							$("#precio_producto" ).val("");
						}
			});	
	
        







        $('input[type="checkbox"]').on('change', function(e){
    		if (this.checked) {
    			var caracteres = "abcdefghijkmnpqrtuvwxyzABCDEFGHJKMNPQRTUVWXYZ2346789";
       			var contrasena = "";

       			for (i=0; i<5; i++){
       				contrasena +=caracteres.charAt(Math.floor(Math.random()*caracteres.length)); 
       			} 

 				var gen3 = document.getElementById("genericohidden3").value;
 				var gen2 = document.getElementById("genericohidden2").value;
 				var gen1 = document.getElementById("genericohidden1").value;
				$("#cat_pro").val(gen2);
				$("#estado").val(gen1);
				$("#marca").val(gen3);
				$("#medida").val("generico");
				$("#codigoProveedor").val(contrasena);
				$("#codigoProducto").val(contrasena);
				$("#codigoAlternativo").val(contrasena);
    		} else {
    			$("#cat_pro").val(0);
				$("#estado").val(0);
				$("#marca").val(0);
				$("#medida").val("");
				$("#codigoProveedor").val("");
				$("#codigoProducto").val("");
				$("#codigoAlternativo").val("");
    		}
		});        




$("#costo").change(function(){
	var utilidad = $("#uti").val();
	var nuevocosto1 = $("#costo").val();
	var nuevocosto = $("#resultado").val();
	var multiplicando = $("#multiplicando").val();

	multiplicando = parseFloat(multiplicando);
	multiplicando = multiplicando.toFixed(2);

	nuevocosto1 = parseFloat(nuevocosto1);
	nuevocosto1 = nuevocosto1.toFixed(2);

	var resultadoresultado = multiplicando * nuevocosto1;
	resultadoresultado = parseFloat(resultadoresultado);
	resultadoresultado = resultadoresultado.toFixed(2);




	if (nuevocosto1 == 0 || nuevocosto1 == NaN ) {
		//console.log("es 0");
		$("#resultado").val(0);
	}
	else
	{
		console.log("diferente de 0");
	  var porNombre = document.getElementById("porcentajeoculto").value;
	  var memo = $('input:radio[name=tipo_ganancia]:checked').val();
	  var nuevoppp = porNombre/100;

	/*  if (memo == "gporcentaje") 
	  {
		var nuevoppp1 = nuevocosto1 * nuevoppp;
		$("#uti").val('');
		$("#uti").val(nuevoppp1);
	    document.getElementById("uti").value = nuevoppp1;
	    document.getElementById("montocporcentaje").value = nuevoppp;
	  }
	  else
	  {
    	document.getElementById("uti").value = '';
    	document.getElementById("precio").value = '';
  	  }
	*/
	utilidad = $("#uti").val();

	utilidad = parseFloat(utilidad);
	/*if (utilidad > 0) 
	{


	utilidad = parseFloat(utilidad);
	utilidad = utilidad.toFixed(2); 

	nuevocosto = parseFloat(nuevocosto);


	var sumacostutil = utilidad + resultadoresultado;

	$("#precio").val(sumacostutil);
	$("#valorcostoblur").val(nuevocosto);
	}
	else
	{

		resultadoresultado = parseFloat(resultadoresultado);
	resultadoresultado = resultadoresultado.toFixed(2); 
		$("#precio").val(sumacostutil);
	}
	*/
	$("#resultado").val(resultadoresultado);
	$("#uti").val('');
	$("#precio").val('');
}



}); 

$("#multiplicando").change(function(){
var nuevocosto = $("#costo").val();
var multiplicando = $("#multiplicando").val();
nuevocosto = parseFloat(nuevocosto);
nuevocosto = nuevocosto.toFixed(2); 

multiplicando = parseFloat(multiplicando);
multiplicando = multiplicando.toFixed(2); 

var resultadoresultado = nuevocosto*multiplicando;
resultadoresultado = resultadoresultado.toFixed(2); 
$("#resultado").val(resultadoresultado);
});








    $(".tipo_ganancia").change(function(){
    	$("#uti").val('');
    	$("#precio").val('');

});   
      

$( "#uti" ).change(function() {

 var memo = $('input:radio[name=tipo_ganancia]:checked').val();

   if (memo == "gporcentaje" ) 
        {
        	var resu = $("#resultado").val();
var uti = $("#uti").val();
        	uti = parseFloat(uti);
        	 uti = uti.toFixed(2);
        	var nuevopor = uti/100;
        	 nuevopor = parseFloat(nuevopor);
        	 nuevopor = nuevopor.toFixed(2);
        	
			resu = parseFloat(resu);
        	 resu = resu.toFixed(2);

        	 var resulproc = resu * nuevopor;

        	 
        	 resulproc = parseFloat(resulproc.toFixed(2));
	
resu = parseFloat(resu);

var nuevasuma = 0;
console.log(nuevasuma);
        	 nuevasuma = resu + resulproc;
        	nuevasuma = parseFloat(nuevasuma);
        	 nuevasuma = nuevasuma.toFixed(2);
        	console.log(nuevasuma);

        	 $("#precio").val(nuevasuma);

        }
        else
        {
        	var resu = $("#resultado").val();
var uti = $("#uti").val();
        	uti = parseFloat(uti);
        	uti = parseFloat(uti.toFixed(2));
			resu = parseFloat(resu);
			resu = parseFloat(resu.toFixed(2));

 var nuevasuma = 0;
        	 nuevasuma = resu + uti;
        	nuevasuma = parseFloat(nuevasuma.toFixed(2));
        	 $("#precio").val(nuevasuma);
        }



});









  </script>
      
        
            
            </body>
            
</html>