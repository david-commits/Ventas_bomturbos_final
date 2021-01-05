<?php  
if (isset($con))
{
$sql3="select * from products";
$rs2=mysqli_query($con,$sql3);
/*while($row4=mysqli_fetch_array($rs2)){
    $dolar=$row4["dolar"];
}*/

$sqlconstante = "SELECT dolar FROM `constante` where id_constante = (select MAX(id_constante) from constante)";
$rwconstante = mysqli_query($con, $sqlconstante);
/*$rwconstantedolar = mysqli_fetch_array($rwconstante);
$cdolar = $rwconstantedolar['dolar'];*/

$nuevodolar = 0 ;
$iii= 0 ;
while ($valor1constantedolar = mysqli_fetch_array($rwconstante, MYSQLI_ASSOC)) {
    $productoconstantedolar[$iii]=$valor1constantedolar['dolar'];
    $nuevodolar = $productoconstantedolar[$iii];
    $iii=$iii+1;
} 

?>
<head>

    
</head>
    <body>  

	<!-- Modal -->
	<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
		<div class="modal-content estilo-placeholder">
		  <div class="modal-header estilo-placeholder">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel"><i class='glyphicon glyphicon-edit'></i><font color="white"> Editar producto</font></h4>
		  </div>

                    
          <div class="modal-body" style="height:500px;overflow-y: scroll;">
            <form class="form-horizontal" method="post" id="editar_producto" name="editar_producto">

                    <div id="resultados_ajax2"></div>
                 <div class="form-group">

				<label for="mod_nombre" class="col-sm-4 control-label">Nombre (*): </label>
				<div class="col-md-8 col-sm-8 col-xs-12">
				  <input type="hidden" name="mod_id" id="mod_id">
				  <input  type="text" class="form-control estilo-placeholder" id="mod_nombre" name="mod_nombre" placeholder="Nombre del producto" required maxlength="500">
				</div>
			  </div>
	




         <div class="form-group">

			<label for="mod_categoria" class="col-sm-4 control-label">Categoria (*):</label>
				<div class="col-md-8 col-sm-8 col-xs-12">
				<select class="form-control estilo-placeholder" id="mod_categoria" name="mod_categoria" required >
						<option class="custom-select"  value="">-- Selecciona categoria--</option>

                        <?php
                        $sql2=" SELECT * FROM categorias where estado = 1";
                        $rs1=mysqli_query($con,$sql2);
                        while($row3=mysqli_fetch_array($rs1)){
                            $nom_categoria=$row3["nom_cat"];
                            $id_categoria=$row3["id_categoria"];
                        ?>
                        <option class="custom-select"  value="<?php  echo $id_categoria;?>"><?php  echo $nom_categoria;?></option>
                        <?php
                        }                        
                        ?>
                    </select>
                    </div>
            </div>


        <div class="form-group">

				<label for="mod_tipo" class="col-sm-4 control-label">Tipo de producto (*):</label>
				 <div class="col-md-8 col-sm-8 col-xs-12">
				      <select class="form-control estilo-placeholder" id="mod_tipo" name="mod_tipo" required >
						<option class="custom-select"  value="">-- Selecciona tipo--</option>

                        <?php
                        $sql2=" SELECT * FROM tipo where estado = 1";
                        $rs1=mysqli_query($con,$sql2);
                        while($row3=mysqli_fetch_array($rs1)){
                            $nom_tipo=$row3["tipo"];
                            $id_tipo=$row3["id_tipo"];
                        ?>
                        <option class="custom-select"  value="<?php  echo $id_tipo;?>"><?php  echo $nom_tipo;?></option>
                        <?php
                        }                        
                        ?>
                      </select>
                    </div>
            </div>   



                  <div class="form-group">

                  	<label for="mod_marca" class="col-sm-4 control-label">Marca (*):</label>
					<div class="col-md-8 col-sm-8 col-xs-12">
				  <select class="form-control estilo-placeholder" id="mod_marca" name="mod_marca" required >

                           <option class="custom-select"  value="">-- Selecciona marca --</option>
      
                        <?php
                        $nom = array();
                        $sql2="select * from marca WHERE estado = 1 and id_tipoLinea=4";
                        $i=0;
                        $rs1=mysqli_query($con,$sql2);
                        while($row3=mysqli_fetch_array($rs1)){
                            $nom_marca=$row3["nombre_marca"];
                            $id_marca=$row3["id_marca"];
                            ?>
                            <option class="custom-select"  value="<?php  echo $id_marca;?>"><?php  echo $nom_marca;?></option>
                            <?php
                            $i=$i+1;
                        }
                        
                        ?>
                  </select>
                </div>
                </div>
         
    
            <div class="form-group">

				<label for="mod_codigooriginal_mod" class="col-sm-4 control-label">Código Original (*):</label>
				<div class="col-md-8 col-sm-8 col-xs-12">
				  <input type="text" class="form-control estilo-placeholder" id="mod_codigooriginal_mod" name="mod_codigooriginal_mod" placeholder="Código del producto" required maxlength="150">
				          
				</div>
			</div>

            <div class="form-group">
                <label for="mod_codigo_mod" class="col-sm-4 control-label">Código Producto (*):</label>
                <div class="col-md-8 col-sm-8 col-xs-12">
                  <input type="text" class="form-control estilo-placeholder" id="mod_codigo_mod" name="mod_codigo_mod" placeholder="Código del producto" required  maxlength="150">
                          
                </div>
            </div>
            <div class="form-group">
                    <label for="mod_proveedor" class="col-sm-4 control-label">Cod Proveedor (*):</label>
                    <div class="col-md-8 col-sm-8 col-xs-12">
                  <input type="text" class="form-control estilo-placeholder" id="mod_proveedor" name="mod_proveedor" placeholder="Código del producto" required  maxlength="150">
                  
                </div>
                </div>


            <div class="form-group">
                    <label for="mod_alternativo" class="col-sm-4 control-label">Codigo Alternativo (*):</label>
             <div class="col-md-8 col-sm-8 col-xs-12">

              <input type="text"  class="form-control estilo-placeholder" id="mod_alternativo" name="mod_alternativo"  required maxlength="150">

            </div>
            </div>


        <div class="form-group">
           <label for="mod_medida" class="col-sm-4 control-label">Medida (*):</label>
            <div class="col-md-8 col-sm-8 col-xs-12">
          <input type="text"  class="form-control estilo-placeholder" id="mod_medida" name="mod_medida"  required  maxlength="50">
        </div>
        </div>


        
       <div class="form-group">
          <label for="mod_detalle" class="col-sm-4 control-label">Ubicación (*):</label>
          <div class="col-md-8 col-sm-8 col-xs-12">
          <input type="text"  class="form-control estilo-placeholder" id="mod_detalle" name="mod_detalle"  required  maxlength="50">
        </div>
        </div>


                  <div class="form-group">
                <label for="mod_costo" class="col-sm-4 control-label">Precio de Compra en dólares:</label>
                <div class="col-sm-8">
                  <input type="number" step="any" class="form-control estilo-placeholder"  id="mod_costo" name="mod_costo" onblur="FuncionQuitarCosto()"  placeholder="Precio de costo del producto" required pattern="^[0-9]{1,5}(\.[0-9]{0,2})?$" title="Ingresa sólo números con 0 ó 2 decimales" maxlength="8">


                </div><br><br><br>


        <div class="form-group">
                <label for="precio" class="col-sm-4 control-label">TCP:</label>
                <div class="col-sm-8">
                  <input type="hidden"  id="multic" name="multic" value="<?php echo $nuevodolar; ?>">
                  <input type="hidden"  id="valorprctt" name="valorprctt" >

                  <input type="number" class="estilo-placeholder" step="any" id="multiplicando_multiplicando" name="multiplicando_multiplicando">
                Costo en S/<input  type="text" class="estilo-placeholder" size="10" type="text" id="resultado_mod"  readonly/>

                                </div>
              </div>  
        
        <div class="form-group">
                    <label for="mod_tganancia" class="col-sm-4 control-label">Tipo de Ganancia:</label>
                    <div class="col-md-8 col-sm-8 col-xs-12">

                  <select class="form-control estilo-placeholder" id="mod_tganancia" name="mod_tganancia" required >

                           <option class="custom-select"  value="0">-- Selecciona Tipo Ganancia --</option>
                            <option class="custom-select"  value="1">Ganancia en dinero</option>
                            <option class="custom-select"  value="2">Ganancia por Porcentaje</option>
                  </select>
                </div>
                </div>

       <!--         <label style="margin-left: 30px;" for="uti" class="control-label">M ganancia en dinero.</label>
        <input type="radio" id="tipo_gananciasoles" class="tipo_ganancia"  name="tipo_ganancia" value="gsoles">
        <label for="uti" class="control-label">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;M ganancia por %</label>
        <input type="radio" id="tipo_gananciadolares" class="tipo_ganancia" name="tipo_ganancia" value="gporcentaje"><br>
    -->
              </div>    

       <div class="form-group">
                            <label for="uti" class="col-sm-4 control-label">M Ganancia S/. o %:</label>
                            <div class="col-md-8 col-sm-8 col-xs-12">

				  <input type="number" step="any" class="form-control estilo-placeholder" name="ganancia" id="ganancia" placeholder="Margen de ganancia" required pattern="^[0-9]{1,5}(\.[0-9]{0,2})?$" title="Ingresa sólo números con 0 ó 2 decimales" maxlength="8">

                            </div>
            </div>
          
          <div class="form-group">

				<label for="mod_precio" class="col-sm-4 control-label">Precio venta soles:</label>
				<div class="col-md-8 col-sm-8 col-xs-12">
                     <input  type="number" step="any" class="form-control estilo-placeholder" id="mod_precio" name="mod_precio" placeholder="Precio 1" required pattern="^[0-9]{1,5}(\.[0-9]{0,2})?$" title="Ingresa sólo números con 0 ó 2 decimales" maxlength="8" >
				</div>
			</div>

             

        <div class="form-group">
            <label for="mod_inv" class="col-sm-4 control-label">Inventario:</label>
            <div class="col-md-8 col-sm-8 col-xs-12">

              <input type="number" step="any" class="form-control estilo-placeholder" id="mod_inv" name="mod_inv" placeholder="Precio de costo del producto" required pattern="^[0-9]{1,5}(\.[0-9]{0,2})?$" title="Ingresa sólo números con 0 ó 2 decimales" maxlength="8">

            </div>
        </div>

        <div class="form-group" style="display: none">
            <label for="estado" class="col-sm-4 control-label">Estado:</label>
            <div class="col-md-6 col-sm-6 col-xs-6">

             <select   class="form-control estilo-placeholder" id="estado" name="estado" required >
                <option class="custom-select"  value="0">Activo</option>

                <option class="custom-select"  value="1">Desactivado</option>
              </select>
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
</body>
<script>

    $(document).ready(function(){


        const GetDolarSol=function(){
            if($('#ObtenerSoles').is(":checked")){
                ObtenerSoles();
            }else if($('#ObtenerDolar').is(":checked")){
                ObtenerDolar();
            }
        }

        $('#mod_costo').keyup(function(){
            GetDolarSol();
        });

        $('#ganancia').keyup(function(){
            GetDolarSol();
        });

        const ObtenerTasaDolar=function(valor){
            $.ajax({
                type: "POST",
                url: "Funciones/ConsultarProductos/ConsultarProductos.php?opcion=5",
                dataType: "json",
                success: function(datos){
                    valor(datos[0][0]);
                }
            });
        }

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
            var nuevomcp = $("#multiplicando_multiplicando").val();

            traemoselcostodelhidden = parseFloat(traemoselcostodelhidden);
    traemoselcostodelhidden = traemoselcostodelhidden.toFixed(2); 

    nuevomcp = parseFloat(nuevomcp);
    nuevomcp = nuevomcp.toFixed(2); 

    var resultadoresultado = traemoselcostodelhidden*nuevomcp;
    $("#resultado").val(resultadoresultado);





        }
    }
}
        const CostoXTipoCambio=datar=>{
            ObtenerTasaDolar(function(data){
                $('#tcp').val(data);
                let Ns=(parseFloat($('#mod_costo').val())*parseFloat($('#tcp').val())).toFixed(2);
                $('#ns').val(Ns);
                datar(1);
            });
        }

        const ObtenerPrecio=()=>{
            let mPrecio=((parseFloat($('#ns').val()))+(parseFloat($('#ganancia').val()))).toFixed(2);
                $('#mod_precio').val(mPrecio)

        }

        const ObtenerSoles=function(){
            let mCosto=(parseFloat($('#mod_costo').val())).toFixed(2);
            $('#ns').val(mCosto)
            $('#tcp').val(1)
            ObtenerPrecio();
        }

        $('#ObtenerSoles').click(function () {
            ObtenerSoles();
        });

        const ObtenerDolar=function(){
            CostoXTipoCambio(function (datar) {
                if(datar==1){
                    ObtenerPrecio();
                }
            });
        }

    $("#mod_tganancia").change(function () {   
        var valorselectganancia = $("#mod_tganancia").val();
        if(valorselectganancia == "1"){
            var valorprct = 1;
        }
        else if(valorselectganancia == "2")
        {
            var valorprct = 2;
        }
        else
        {
            var valorprct = 3;
        }
        $("#valorprctt").val(valorprct);
    });








 /*   $("input[name=tipo_ganancia]").change(function () {   
        var memo = $('input:radio[name=tipo_ganancia]:checked').val();
        console.log(memo);

        if(memo == "gsoles"){
            var valorprct = 1;
        }
        else if(memo == "gporcentaje")
        {
            var valorprct = 2;
        }
        else
        {
            var valorprct = 3;
        }
        $("#valorprctt").val(valorprct);

    });*/



$( "#multiplicando_multiplicando" ).change(function() {

    var utilidad = $("#uti").val();
    var nuevocosto1 = $("#mod_costo").val();
    var nuevocosto = $("#resultado").val();
    var multiplicando = $("#multiplicando_multiplicando").val();

    multiplicando = parseFloat(multiplicando);
   
    multiplicando = multiplicando.toFixed(3);

    nuevocosto1 = parseFloat(nuevocosto1);
    nuevocosto1 = nuevocosto1.toFixed(3);

    var resultadoresultado = multiplicando * nuevocosto1;
    resultadoresultado = parseFloat(resultadoresultado);
    resultadoresultado = resultadoresultado.toFixed(2);




    if (nuevocosto1 == 0 || nuevocosto1 == NaN ) {

        $("#resultado_mod").val(0);
    }
    else
    {

      var porNombre = document.getElementById("porcentajeoculto").value;
     // var memo = $('input:radio[name=tipo_ganancia]:checked').val();
      var nuevoppp = porNombre/100;

    utilidad = $("#uti").val();

    utilidad = parseFloat(utilidad);

    $("#resultado_mod").val(resultadoresultado);
    document.getElementById("resultado_mod").value = resultadoresultado;
    $("#uti").val('');
    $("#ganancia").val('');
    $("#precio").val('');
    $("#mod_precio").val('');
}















});




$( "#ganancia" ).change(function() {
 var valorselectganancia = $("#mod_tganancia").val();
// var memo = $('input:radio[name=tipo_ganancia]:checked').val();
   if (valorselectganancia == "2" ) 
        {

        var resu = $("#resultado_mod").val();
        var uti = $("#ganancia").val();
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

             nuevasuma = resu + resulproc;
            nuevasuma = parseFloat(nuevasuma);
             nuevasuma = nuevasuma.toFixed(2);
             $("#mod_precio").val(nuevasuma);
        }
        else
        {
    

            var resu = $("#resultado_mod").val();
var uti = $("#ganancia").val();
            uti = parseFloat(uti);
            uti = parseFloat(uti.toFixed(2));
            resu = parseFloat(resu);
            resu = parseFloat(resu.toFixed(2));
 var nuevasuma = 0;

             nuevasuma = resu + uti;
            nuevasuma = parseFloat(nuevasuma.toFixed(2));
             $("#mod_precio").val(nuevasuma);

        }
});


$("#mod_tganancia").change(function(){
          $("#ganancia").val('');
        $("#mod_precio").val('');
});

/*    $(".tipo_ganancia").change(function(){
        $("#ganancia").val('');
        $("#mod_precio").val('');

});  */


$("#mod_costo").change(function(){
    var utilidad = $("#uti").val();
    var nuevocosto1 = $("#mod_costo").val();
    var nuevocosto = $("#resultado").val();
    var multiplicando = $("#multiplicando_multiplicando").val();

    multiplicando = parseFloat(multiplicando);
   
    multiplicando = multiplicando.toFixed(3);

    nuevocosto1 = parseFloat(nuevocosto1);
    nuevocosto1 = nuevocosto1.toFixed(3);

    var resultadoresultado = multiplicando * nuevocosto1;
    resultadoresultado = parseFloat(resultadoresultado);
    resultadoresultado = resultadoresultado.toFixed(2);




    if (nuevocosto1 == 0 || nuevocosto1 == NaN ) {

        $("#resultado_mod").val(0);
    }
    else
    {

      var porNombre = document.getElementById("porcentajeoculto").value;
      //var memo = $('input:radio[name=tipo_ganancia]:checked').val();
      var nuevoppp = porNombre/100;

    utilidad = $("#uti").val();

    utilidad = parseFloat(utilidad);

    $("#resultado_mod").val(resultadoresultado);
    document.getElementById("resultado_mod").value = resultadoresultado;
    $("#uti").val('');
    $("#precio").val('');
}
        $("#ganancia").val('');
        $("#mod_precio").val('');



}); 
        $('#ObtenerDolar').click(function () {
            ObtenerDolar();
        });



    });
</script>


<script type="text/javascript">
  $('#mod_categoria').on('change',function(){
        var mod_cat_pro_m = $("#mod_categoria").val();
        var mod_cat_pro_marca = $("#mod_categoria").val();
        if(mod_cat_pro_m){
    console.log(mod_cat_pro_m);
            $.ajax({
                type:'POST',
                url:'appblade.php',
                data:'tl_mod_catpro_m='+mod_cat_pro_m,
                success:function(html){
                    $('#mod_tipo').html(html);
                  
                }

            }); 
            //cargar_marcacate(mod_cat_pro_m);
        }else{
            $('#mod_tipo').html('<option value="">Seleccione Tipo Linea primero</option>');
        }




                     /* */
    });

$('#mod_tipo').on('change',function(){
        var mod_cat_pro_marca = $("#mod_categoria").val();
        console.log('si');
        console.log(mod_cat_pro_marca);
        console.log('si');
        if (mod_cat_pro_marca) 
        {
            console.log('gaea');
            $.ajax({
                type:'POST',
                url:'appblade1.php',
                data:'tl_mod_catpro_marca_m='+mod_cat_pro_marca,
                success:function(html){
                    $('#mod_marca').html(html);
                  
                }

            }); 
         // console.log('aea');
        }else{
          $('#mod_marca').html('<option value="">Seleccione Categoría Primero</option>');
        }

                     /* */
    });



</script>
