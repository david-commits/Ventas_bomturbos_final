<?php
session_start();
include('menu.php');
require_once ("config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
require_once ("config/conexion.php");//Contiene funcion que conecta a la base de datos 
$mensaje=recoge1('mensaje');

$consultatraemosprcntj = "SELECT * FROM constante WHERE estado = 1";
$result3 = mysqli_query($con, $consultatraemosprcntj);

while($nuevovalorprcntj = mysqli_fetch_array($result3))
{
  $prcntjtraido = $nuevovalorprcntj['monto'];
}

$consulta1 = "SELECT * FROM products ";
$result1 = mysqli_query($con, $consulta1);
$producto = array();
$i=0;
while ($valor1 = mysqli_fetch_array($result1, MYSQLI_ASSOC)) {
    if ($valor1['pro_ser']==1){
    $producto[$i]=$valor1['nombre_producto'];
    $i=$i+1;
    }
}
$consulta2 = "SELECT * FROM datosempresa ";
$result2 = mysqli_query($con, $consulta2);
$valor2 = mysqli_fetch_array($result2, MYSQLI_ASSOC);
$dolar=$valor2['dolar'];
$sql1="select * from users where user_id=$_SESSION[user_id]";
$rw1=mysqli_query($con,$sql1);//recuperando el registro
$rs1=mysqli_fetch_array($rw1);//trasformar el registro en un vector asociativo
$modulo=$rs1["accesos"];
$a = explode(".", $modulo); 
if (!isset($_SESSION['user_login_status']) AND $_SESSION['fuser_login_status'] != 1) {
    header("location: login.php");
    exit;
}
if($a[10]==0){
    header("location:error.php");    
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <!-- Meta, title, CSS, favicons, etc. -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
   <title>Sistema de Ventas</title>
   <link rel="icon" href="images/usuario16.jpg">
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="fonts/css/font-awesome.min.css" rel="stylesheet">
  <link href="css/animate.min.css" rel="stylesheet">  
  <!-- Custom styling plus plugins -->
  <link href="css/custom.css" rel="stylesheet">
  <link href="css/icheck/flat/green.css" rel="stylesheet">
  <link href="css/datatables/tools/css/dataTables.tableTools.css" rel="stylesheet">
  <link href="css/select/select2.min.css" rel="stylesheet">
  <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">  
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
  <script>
    function limpiarFormulario() {
      document.getElementById("guardar_producto").reset();
    }
  </script>
  <script>
    function multiplicar() {
      m1 = document.getElementById("multiplicando").value;
      m2 = document.getElementById("costo").value;
      m3 = document.getElementById("uti").value;
      r = m1 * m2;
      var r1 = r.toFixed(2);
      document.getElementById("resultado").value = r1;

      r2 = document.getElementById("resultado").value;
      r1 = 1 * r2 + 1 * m3;
      document.getElementById("precio").value = r1;
    }
  </script>
  <script type="text/javascript">
    function va(esto) {
      document.getElementById('multiplicando').value = esto;
      m2 = document.getElementById("costo").value;
      m3 = document.getElementById("uti").value;
      r5 = esto * m2;
      var r = r5.toFixed(2);
      document.getElementById("resultado").value = r;
      r2 = document.getElementById("resultado").value;
      r1 = 1 * r2 + 1 * m3;
      var r6 = r1.toFixed(2);
      document.getElementById("precio").value = r6;
    }
  </script>
  <link href="https://fonts.googleapis.com/css?family=Quicksand:300,400,500,600,700&display=swap" rel="stylesheet">
</head>

<body class="nav-md">

  <div class="container body">


    <div class="main_container">

      <div class="col-md-3 left_col">
        <div class="left_col scroll-view">

         
          <div class="clearfix"></div>

          <!-- menu prile quick info -->
          <?php
          menu2();
         
          menu1();
          
          ?>
       
        </div>
      </div>

        
        <?php
          menu3();
     
        
        ?>

      <div class="right_col" role="main">

      
        <div class="container">

        <br>
        <br>
        <br>

          <div class="panel panel-info">

            <div class="panel-heading">
              <h3>Ingresar Datos del Producto:</h3>
            </div>

        
          <?php
          if ($mensaje <> "") {
          ?>
            <div class="alert alert-danger" role="alert">
              <button type="button" class="close" data-dismiss="alert">&times;</button>
              <strong>Error! <?php echo $mensaje; ?></strong>
            </div>
          <?php
          }
       
     
          print "<form class=\"form-horizontal form-label-left\" id=\"guardar_producto\" enctype=\"multipart/form-data\" action=\"ingresoproductos1.php\" method=\"POST\">";
          ?>

          <div class="col-md-12 col-sm-12 col-xs-12" id=>
            <label for="d" class="control-label input-sm">Nombre del Producto<span class="campos-obligatorios">(Sin repetir) :</span></label>
            <input type="text" class="form-control estilo-placeholder separador-compras" id="nombre" name="nombre" placeholder="Nombre del Producto" required maxlength="100" >
            <div id="autocomplete-container" style="position: relative; float: left; width: 400px; margin: 3px;">
            </div>
          </div>
          

          
          <div class="col-md-6 col-sm-6 col-xs-12">
            <label for="cat_pro" class="control-label input-sm">Categoría :</label>
            <select class="form-control estilo-placeholder separador-compras" id="cat_pro" name="cat_pro" required >
              <option class="custom-select" value="">-- Selecciona Categoría --</option>
              <?php
              $nom = array();
              $sql2 = "select * from categorias where estado = 1 ";
              $i = 0;
              $rs1 = mysqli_query($con, $sql2);
              while ($row3 = mysqli_fetch_array($rs1)) {
                $nom_cat = $row3["nom_cat"];
                $id_categoria = $row3["id_categoria"];
              ?>
                <option class="custom-select" value="<?php echo $id_categoria; ?>"><?php echo $nom_cat; ?></option>
              <?php
                $i = $i + 1;
              }
              ?>
            </select>
          </div>


          <div class="col-md-6 col-sm-6 col-xs-12">
            <label for="estado" class="control-label input-sm">Tipo de Artículo :</label>
            <select class="form-control estilo-placeholder separador-compras" id="estado" name="estado" required >
              <option class="custom-select" value="
              ">-- Selecciona el Artículo --</option>
             <!-- <option class="custom-select" value="">-- Selecciona el Tipo --</option>
              <?php
              $nom = array();
              $sql2 = "select * from tipo where estado = 1";
              $i = 0;
              $rs1 = mysqli_query($con, $sql2);
              while ($row3 = mysqli_fetch_array($rs1)) {
                $nom_tipo = $row3["tipo"];
                $id_tipo = $row3["id_tipo"];
              ?>
                <option class="custom-select" value="<?php echo $id_tipo; ?>"><?php echo $nom_tipo; ?></option>
              <?php

                $i = $i + 1;
              }
              ?>-->
            </select>
            </select>
          </div>       


          <div class="col-md-6 col-sm-6 col-xs-12">
            <label for="marca" class="control-label input-sm">Marca :</label>
            <select class="form-control estilo-placeholder separador-compras" id="marca" name="marca" required >
              <option class="custom-select" value="0">-- Selecciona marca --</option>
             <!-- <?php
              $nom = array();
              $sql2 = "select * from marca WHERE id_tipoLinea = 4 and estado = 1";
              $i = 0;
              $rs1 = mysqli_query($con, $sql2);
              while ($row3 = mysqli_fetch_array($rs1)) {
                $nom_marca = $row3["nombre_marca"];
                $id_marca = $row3["id_marca"];
              ?>
                <option class="custom-select" value="<?php echo $id_marca; ?>"><?php echo $nom_marca; ?></option>
              <?php
                $i = $i + 1;
              }
              ?>-->
            </select>
          </div>
         
      <!--  
        <div class="col-md-4 col-sm-4 col-xs-12">
          <label for="modelo" class="control-label">Modelo</label>
          <select class="form-control" id="modelo" name="modelo" required  style="background-color:#A9F5BC;">
          <option value="">-- Selecciona modelo --</option>
      <?php
                       
                        $nom = array();
                        $sql2="select * from modelos where estado = 1 ";
                        $i=0;
                        $rs1=mysqli_query($con,$sql2);
                        while($row3=mysqli_fetch_array($rs1)){
                            $nom_marca=$row3["nombre_modelo"];
                            $id_modelo=$row3["id_modelo"];
                            ?>
                            <option value="<?php  echo $id_modelo;?>"><?php  echo $nom_marca;?></option>
                            <?php
                            $i=$i+1;
                        }
                        
                        ?>
          </select>
        </div>
-->




          <div class="col-md-6 col-sm-6 col-xs-12">
            <label for="codigoProducto" class="control-label input-sm">Código Original :</label>
            <input type="text" class="form-control estilo-placeholder separador-compras" id="codigoProducto" name="codigoProducto" required  maxlength="40" placeholder="Código Original">
          </div>

          <div class="col-md-6 col-sm-6 col-xs-12">
            <label for="codigoProveedor" class="control-label input-sm">Código Proveedor :</label>
            <input type="text" class="form-control estilo-placeholder separador-compras" id="codigoProveedor" name="codigoProveedor" required  maxlength="70" placeholder="Código Proveedor">
          </div>


          <div class="col-md-6 col-sm-6 col-xs-12">
            <label for="codigoAlternativo" class="control-label input-sm">Código Alternativo :</label>
            <input type="text" maxlength="50" class="form-control estilo-placeholder separador-compras" id="codigoAlternativo" name="codigoAlternativo" required placeholder="Código Alternativo">
          </div>

          <div class="col-md-6 col-sm-6 col-xs-12">
            <label for="medida" class="control-label input-sm">Medida :</label>
            <input type="text" class="form-control estilo-placeholder separador-compras" id="medida" name="medida" required maxlength="50" placeholder="Medida">
          </div>
    <div style="display: none;">
    <input name="mon_costo" type="radio"  value="1" onclick="va(1);" checked>Soles 
    <input type="number" id="costo" name="costo" value="0"></input>
    <input type="number" id="multiplicando" name="multiplicando" value="1"></input>
    <input type="number" id="modelo" name="modelo" value="1"></input>
     <input type="text" value=" "  class="form-control" id="detalle" name="detalle"  required maxlength="50"  style="background-color:#A9F5BC;">
        
    </div>
          <!--
          <div class="col-md-4 col-sm-4 col-xs-12">
            <label for="detalle" class="control-label input-sm">Ubicacion</label>
            <input type="text"  class="form-control estilo-placeholder separador-compras" id="detalle" name="detalle"  required maxlength="50"  >
          </div>
          <div class="col-md-4 col-sm-4 col-xs-12">
            <label for="costo" class="control-label input-sm">Costo</label>
            <input type="number" step="any"  class="form-control estilo-placeholder separador-compras" onChange="multiplicar();" id="costo" name="costo" placeholder="Precio de costo del producto" required pattern="^[0-9]{1,5}(\.[0-9]{0,2})?$" title="Ingresa sólo números con 0 ó 2 decimales" maxlength="8" >
          </div>
          <div class="col-md-4 col-sm-4 col-xs-12">
            <label for="estado" class="control-label input-sm">Tipo de Moneda</label>
            <label></label>
            <input name="mon_costo" type="radio"  value="1" onclick="va(1);">Soles 
            <input name="mon_costo" type="radio"  value="<?php echo $dolar; ?>" onclick="va(<?php echo $dolar; ?>);" checked>Dolares
            <input type="hidden" id="porcentajeoculto" value="<?php echo $prcntjtraido; ?>"> 
          </div>
          <div class="col-md-4 col-sm-4 col-xs-12">
            <label for="multiplicando" class="control-label input-sm">TCP</label>
            <input type="number" step="any"  id="multiplicando" name="multiplicando" onChange="multiplicar();">
            <br>
            <label class="control-label input-sm">N/S</label>
            <input  type="text"   type="text" id="resultado"  readonly/>                 
          </div>
          <div class="col-md-4 col-sm-4 col-xs-12">
            <label for="uti" class="control-label input-sm">M ganancia S/.</label>
            <input type="radio" id="tipo_ganancia" class="tipo_ganancia"  name="tipo_ganancia" value="gsoles">
            <label for="uti" class="control-label input-sm">M ganancia por %</label>
            <input type="radio" id="tipo_ganancia" class="tipo_ganancia" name="tipo_ganancia" value="gporcentaje"><br>
            <input type="number" step="any"  class="form-control estilo-placeholder separador-compras" id="uti" onChange="multiplicar();" name="uti" placeholder="Margen de Ganancia del Producto" required pattern="^[0-9]{1,5}(\.[0-9]{0,2})?$" title="Ingresa sólo números con 0 ó 2 decimales" maxlength="8"  >
            <input type="hidden" id="montocporcentaje" value=""> 
          </div>
        -->
          
          <div class="col-md-6 col-sm-6 col-xs-12">
            <label for="precio" class="control-label input-sm">Precio $ :</label>
            <input type="number" step="any" class="form-control estilo-placeholder separador-compras" id="precio" name="precio">
          </div>
             

          <div class="col-md-6 col-sm-6 col-xs-12">
            <label for="inventario" class="control-label input-sm">Inventario :</label>
            <input type="number" class="form-control estilo-placeholder separador-compras" id="inventario" name="inventario" placeholder="Cantidad de Artículos" required pattern="^[0-9]{1,5}(\.[0-9]{0,2})?$" title="Ingresa sólo números con 0 ó 2 decimales" maxlength="8" >
          </div>

          <div class="col-md-6 col-sm-6 col-xs-12">
            <label for="nombre" class="control-label input-sm">Ingresar Foto :</label>
            <input id="valor1" accept="image/jpeg" type="file" id="files" name="files" class="form-control estilo-placeholder separador-compras" />
          </div>
       
    <?php
    $nom = array();
    $sql2="select * from products ";
    $i=0;
$rs1=mysqli_query($con,$sql2);
while($row3=mysqli_fetch_array($rs1)){
  
    $nom[$i]=$row3["nombre_producto"];
    $i=$i+1;
}
  
$sql3="select distinct id_marca from products";
    $i=0;
  
$rs2=mysqli_query($con,$sql3);
while($row4=mysqli_fetch_array($rs2)){
   
    $marca[$i]=$row4["id_marca"];

    $i=$i+1;
}

$sql4="select distinct id_modelo from products ";
    $i=0;
$rs4=mysqli_query($con,$sql4);
while($row5=mysqli_fetch_array($rs4)){
    $modelo[$i]=$row5["id_modelo"];
    $i=$i+1;
}

    ?>       
    <script>
      
var tags = [];
                <?php
                    for($i = 0 ;$i<count($nom);$i++){
                ?>
                tags.push("<?php echo $nom[$i];?>");
                <?php } ?>
                         
    $( "#producto" ).autocomplete({
  source: function( request, response ) {
          var matcher = new RegExp( "^" + $.ui.autocomplete.escapeRegex( request.term ), "i" );
          response( $.grep( tags, function( item ){
              return matcher.test( item );
          }) );
      }
});

$(".tipo_ganancia").change(function(){
  var memo = $('input:radio[name=tipo_ganancia]:checked').val();
  var porNombre = document.getElementById("porcentajeoculto").value;
  var costojs = document.getElementById("costo").value;
  var nuevoppp = porNombre/100;

  var nuevoppp = costojs * nuevoppp;

  if (memo == "gporcentaje") 
  {

    $("#uti").prop("min", nuevoppp);
    document.getElementById("uti").value = nuevoppp;
    document.getElementById("montocporcentaje").value = nuevoppp;
    multiplicar();
  }
  else
  {
    document.getElementById("uti").value = '';
    multiplicar();
    $("#uti").prop("min", 0);

  }

});



</script>    
        
 
 </td></tr>
     
     

    <script>
    var tags1 = [];
      <?php
          for($i = 0 ;$i<count($marca);$i++){
      ?>
      tags1.push("<?php echo $marca[$i];?>");
      <?php } ?>
                
  

            
    $("#marca" ).autocomplete({
  source: function( request, response ) {
          var matcher = new RegExp( "^" + $.ui.autocomplete.escapeRegex( request.term ), "i" );
          response( $.grep( tags1, function( item ){
              return matcher.test( item );
          }) );
      }
});
    
    </script>
    
    
    <script>

    </script>
    
      <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
           <div class="modal-footer pull-rigth">
              <button type="button" class="btn btn-limpiar margen-arriba-20" onclick="limpiarFormulario()">Limpiar</button>
              <button type="submit" class="btn btn-agregar margen-arriba-20" id="guardar_datos">Guardar Datos</button>
          </div>
          </form>
          
          
          
           </div>
          </div>
         
        <!-- /footer content -->
      </div>
      <!-- /page content -->

    </div>

  </div>

  <div id="custom_notifications" class="custom-notifications dsp_none">
    <ul class="list-unstyled notifications clearfix" data-tabbed_notifications="notif-group">
    </ul>
    <div class="clearfix"></div>
    <div id="notif-group" class="tabbed_notifications"></div>
  </div>

  
  <script src="js/bootstrap.min.js"></script>

  <!-- bootstrap progress js -->
  <script src="js/progressbar/bootstrap-progressbar.min.js"></script>
  <script src="js/nicescroll/jquery.nicescroll.min.js"></script>
  <!-- icheck -->
  <script src="js/icheck/icheck.min.js"></script>

  <script src="js/custom.js"></script>


  <!-- Datatables -->
  <script src="js/datatables/js/jquery.dataTables.js"></script>
  <script src="js/datatables/tools/js/dataTables.tableTools.js"></script>

  <!-- pace -->
  <script src="js/pace/pace.min.js"></script>
  <script>
    $(document).ready(function() {

    });

    var asInitVals = new Array();
    $(document).ready(function() {
    
  var mc = $('input:radio[name=mon_costo]:checked').val();
    //document.getElementById('multiplicando').value=mc;
    

      var oTable = $('#example').dataTable({
        "oLanguage": {
          "sSearch": "Search all columns:"
        },
        "aoColumnDefs": [{
            'bSortable': false,
            'aTargets': [0]
          } //disables sorting for column one
        ],
        'iDisplayLength': 12,
        "sPaginationType": "full_numbers",
        "dom": 'T<"clear">lfrtip',
        "tableTools": {
          "sSwfPath": "js/datatables/tools/swf/copy_csv_xls_pdf.swf"
        }
      });
      $("tfoot input").keyup(function() {
        /* Filter on the column based on the index of this element's parent <th> */
        oTable.fnFilter(this.value, $("tfoot th").index($(this).parent()));
      });
      $("tfoot input").each(function(i) {
        asInitVals[i] = this.value;
      });
      $("tfoot input").focus(function() {
        if (this.className == "search_init") {
          this.className = "";
          this.value = "";
        }
      });
      $("tfoot input").blur(function(i) {
        if (this.value === "") {
          this.className = "search_init";
          this.value = asInitVals[$("tfoot input").index(this)];
        }
      });



      $('input.tableflat').iCheck({
        checkboxClass: 'icheckbox_flat-green',
        radioClass: 'iradio_flat-green'
      });




      $("#uti").blur(function(){
        var nuevoproculto = document.getElementById("montocporcentaje").value;
        var nuevouti = document.getElementById("uti").value;
        var memo = $('input:radio[name=tipo_ganancia]:checked').val();

        if (memo == "gporcentaje" ) 
        {
          if( parseFloat(nuevouti) < parseFloat(nuevoproculto))
          {
            document.getElementById("uti").value = nuevoproculto;
          }
          else
          {
          }
        }
        else
        {
          if( parseFloat(nuevouti) < 0)
          {
            document.getElementById("uti").value = 0;
          }
          else
          {
          }
          $("#uti").prop("min", 0);

        }
      });

    });
  </script>
  <script type="text/javascript" src="js/autocomplete/countries.js"></script>
  <script src="js/autocomplete/jquery.autocomplete.js"></script>
  <!-- pace -->
  <script src="js/pace/pace.min.js"></script>
  <script type="text/javascript">
    $(function() {
      'use strict';
      
      var data =[
      <?php
                    for($i = 0;$i<count($producto);$i++){
                ?>
                '<?php echo $producto[$i];?>',
                <?php } ?>];
     
      
      
      var countriesArray = $.map(data, function(value, key) {
        return {
          value: value,
          data: key
        };
      });
      // Initialize autocomplete with custom appendTo:
      $('#autocomplete-custom-append').autocomplete({
        lookup: countriesArray,
        appendTo: '#autocomplete-container'
      });
    });
  </script>
  
  <script src="js/select/select2.full.js"></script>
  <!-- form validation -->
  
  <script>
    $(document).ready(function() {
      $(".select2_single").select2({
        placeholder: "Seleccionar",
        allowClear: true
      });
      $(".select2_group").select2({});
      $(".select2_multiple").select2({
        maximumSelectionLength: 4,
        placeholder: "Con Max Selección límite de 4",
        allowClear: true
      });
    });
  </script>
  
  
  
</body>

</html>
<script type="text/javascript">
  $('#cat_pro').on('change',function(){
        var mod_cat_pro_m = $("#cat_pro").val();
        var mod_cat_pro_marca = $("#cat_pro").val();
        if(mod_cat_pro_m){
    console.log(mod_cat_pro_m);
            $.ajax({
                type:'POST',
                url:'appblade.php',
                data:'tl_mod_catpro_m='+mod_cat_pro_m,
                success:function(html){
                    $('#estado').html(html);
                  
                }

            }); 
            //cargar_marcacate(mod_cat_pro_m);
        }else{
            $('#estado').html('<option value="">Seleccione Tipo Linea primero</option>');
        }




                     /* */
    });

$('#estado').on('change',function(){
        var mod_cat_pro_marca = $("#cat_pro").val();
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
                    $('#marca').html(html);
                  
                }

            }); 
         // console.log('aea');
        }else{
          $('#marca').html('<option value="">Seleccione Categoría Primero</option>');
        }

                     /* */
    });



</script>
