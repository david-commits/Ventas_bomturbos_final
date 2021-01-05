<!-- <style type="text/css">
   .thumbnail1{
  position: relative;
  z-index: 0;}
  .thumbnail1:hover{

  background-color: transparent;
  z-index: 50;}
  .thumbnail1 span{ /*Estilos del borde y texto*/
  position: absolute;
  background-color: white;
  padding: 5px;
  left: -100px;

  visibility: hidden;
  color: #FFFF00;
  text-decoration: none;}
  .thumbnail1 span img{ /*CSS for enlarged image*/
  border-width: 0;
  padding: 2px;}
  .thumbnail1:hover span{ /*CSS for enlarged image on hover*/
  visibility: visible;
  top: 17px;
  left: 60px; /*position where enlarged image should offset horizontally */} 
  img.imagen2{
  padding:4px;

  border:3px #0489B1 solid;
  margin-left: 2px;
  margin-right:5px;
  margin-top: 5px;
  float:left;}


  img.imagen4{
padding:4px;
border:3px #0489B1 solid;
margin-left: 5px;
margin-right:5px;
margin-top: 5px;
float:center;
}

</style> -->
<?php
session_start();
include('menu.php');
require_once ("config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
require_once ("config/conexion.php");
$sql1="select * from users where user_id=$_SESSION[user_id]";

$sqlconstante = "SELECT dolar FROM `constante` where id_constante = (select MAX(id_constante) from constante)";
$rwconstante = mysqli_query($con, $sqlconstante);
/*$rwconstantedolar = mysqli_fetch_array($rwconstante);
$cdolar = $rwconstantedolar['dolar'];*/

$moncdol = 0;


$rw1=mysqli_query($con,$sql1);//recuperando el registro
$rs1=mysqli_fetch_array($rw1);//trasformar el registro en un vector asociativo
$sql2="select * from datosempresa where id_emp=1";
$rw2=mysqli_query($con,$sql2);//recuperando el registro
$rs2=mysqli_fetch_array($rw2);//trasformar el registro en un vector asociativo
$alerta=$rs2["alerta"];
$consulta1 = "SELECT * FROM products";
$result1 = mysqli_query($con, $consulta1);
$producto = array();
$i=0;
while ($valor1 = mysqli_fetch_array($result1, MYSQLI_ASSOC)) {
    $producto[$i]=$valor1['id_producto'];
    $i=$i+1;
}   

$iii= 0 ;
while ($valor1constantedolar = mysqli_fetch_array($rwconstante, MYSQLI_ASSOC)) {
    $productoconstantedolar[$iii]=$valor1constantedolar['dolar'];
    $moncdol = $productoconstantedolar[$iii];
    $iii=$iii+1;
} 

$modulo=$rs1["accesos"];
$a = explode(".", $modulo); 
if (!isset($_SESSION['user_login_status']) AND $_SESSION['user_login_status'] != 1) {
    header("location: login.php");
    exit;
}
if($a[11]==0){
    header("location:error.php");    
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <!-- Meta, title, CSS, favicons, etc. -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Sistema de Ventas</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="fonts/css/font-awesome.min.css" rel="stylesheet">
  <link href="css/animate.min.css" rel="stylesheet">
  <link rel="icon" href="images/usuario16.jpg">
  <!-- Custom styling plus plugins -->
  <link href="css/custom.css" rel="stylesheet">
  <link href="css/icheck/flat/green.css" rel="stylesheet">
  <script src="js/jquery.min.js"></script>
  <script type="text/javascript" src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.colVis.min.js"></script>
  <link href="https://cdn.datatables.net/buttons/1.5.1/css/buttons.dataTables.min.css" rel="stylesheet">
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.1/js/dataTables.responsive.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.colVis.min.js"></script>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css" />
  <script type="text/javascript" src="Buttons/js/buttons.flash.min.js"></script>
  <script type="text/javascript" src="Buttons/js/dataTables.buttons.min.js"></script>
  <script type="text/javascript" src="Buttons/js/buttons.html5.min.js"></script>
  <script type="text/javascript" src="Buttons/js/buttons.print.min.js"></script>
  <script src="js/Axios/Axios.js"></script>
  <script src="js/Vue/Vue.js"></script>
  <link href="https://fonts.googleapis.com/css?family=Quicksand:300,400,500,600,700&display=swap" rel="stylesheet">
</head>


<body class="nav-md">

  <div class="container body">


    <div class="main_container">

          <div class="col-md-3 left_col">
            <div class="left_col scroll-view">
              <div class="clearfix">
              </div>
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
        
      

          <!-- <div class="page-title">
             <div class="title_left">
            </div> 
          </div> -->


          <input type="hidden" name="" id="idProducto">

          <div class="clearfix">
          </div>

          <div class="row">

            <div class="container">

              <div class="panel panel-info">                
                <div class="panel-heading"> 
                <br>
                <div class="container">
                  <div class="row">
                    
 <div class="col-md-10">

                  <form method="POST" action="alerta.php">  
                   <!-- <div class="btn-group pull-right">
                      <input type="submit" class="btn btn-guardar" style="width: 150px;" name="datos_cotizacion" value="Imprimir Excel">
                    </div>.-->                  
                    <div class="btn-group pull-right">
                      <a href="ingresoproductos.php" class="btn btn-agregar" style="width: 150px;" id=""><span class="glyphicon glyphicon-plus"></span> Nuevo Producto</a>
                      &nbsp;
                    </div>
                    <font size="4" style="font-weight:500;">Productos en Sucursal  <?php echo $_SESSION['tienda']; ?> </font>  Alerta stock: <input type="text" size="8" class="estilo-placeholder-date" name="alerta" value="<?php echo $alerta; ?>">
                    <input type="submit" value="Enviar" class="btn btn-guardar btn-sm">                    
                  </form>   

  






                </div>
                 <div class="col-md-2">

                    <form class="form-horizontal" role="form" id="datos_cotizacion"  method="post" class="form" action="reporteexcel.php">
 <input type="hidden"  id="q11" name="q11" >
            <div class="form-group pull-right">
                      <input type="submit" class="btn btn-agregar" name="datos_cotizacion"  value="Imprimir Excel">
                    </div>

                  </form>
                 </div>
                  </div>
                </div>


                </div>

                <div class="panel-body">
                  <?php
                  include("modal/registro_productos.php");
                  include("modal/historial_productos.php");
                  include("modal/editar_productos.php");
                  include("modal/codigo_barra.php");
                  include("modal/registro_productoCompatible.php");
                  include("modal/nuevoCompatible.php");
                  include("modal/AgregarCompatible.php");
                  ?>
      


  <!--      <form class="form-horizontal" role="form" id="datos_cotizacion"  method="post" class="form" action="reporteexcel.php">

        
            <div class="form-group row">
                        <label for="q" class="col-md-4 control-label">Código o Nombre del Producto :</label>

                        <div class="col-md-7">
                          <input type="text" class="form-control estilo-placeholder" id="q" name="q" placeholder="Código o Nombre del Producto" onkeypress='load(1);'>
                        </div>

                        <div class="col-md-2">
                          <span id="loader"></span>
                        </div>
                    </div>
                    <div class="form-group pull-right">
                      <input type="submit" class="btn btn-agregar" style="width: 150px; display: flex;
    width: 150px;
    position: absolute;
    left: 85%;
    top: 12.5%;" name="datos_cotizacion" value="Imprimir Excel">
                    </div> 

                  </form>-->




            <div class="form-group row">
                        <label for="q" class="col-md-4 control-label">Código o Nombre del Producto :</label>

                        <div class="col-md-7">
                          <input type="text" class="form-control estilo-placeholder" id="q" name="q" placeholder="Código o Nombre del Producto" onkeypress='load(1);'  onblur="Registrarenunhidden()">
                        </div>

                        <div class="col-md-2">
                          <!-- <button type="button" class="btn btn-default" onclick='load(1);'> -->
                          <!-- <span class="glyphicon glyphicon-search" ></span> Buscar</button> -->
                          <span id="loader"></span>
                        </div>
                    </div>



        <div id="resultados"></div><!-- Carga los datos ajax -->
        <div class='outer_div'></div><!-- Carga los datos ajax -->

        <div style="display: none;">
          <input type="text" name="cdolarc" id="cdolarc" value="<?php echo $moncdol;?>">
        </div>

                </div>
            </div>
     


  </div>
    </div>
</div>

        <div style="margin-right: 20px !important;">
          <?php
          footer();
          ?>
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

  <!-- pace -->
  <script src="js/pace/pace.min.js"></script>
<script>
$( "#guardar_producto" ).submit(function( event ) {
  $('#guardar_datos').attr("disabled", true);

 var parametros = $(this).serialize();
   $.ajax({
      type: "POST",
      url: "ajax/nuevo_producto.php",
      data: parametros,
       beforeSend: function(objeto){
        $("#resultados_ajax_productos").html("Mensaje: Cargando...");
        },
      success: function(datos){
      $("#resultados_ajax_productos").html(datoss);
      $('#guardar_datos').attr("disabled", false);
      load(1);
      }
  });
  event.preventDefault();
})

    $( "#editar_producto" ).submit(function( event ) {
        $('#actualizar_datos').attr("disabled", true);
        var modcod = $("#mod_codigo_mod").val();
       
        var parametros = $(this).serialize();
        $.ajax({
            type: "POST",
            url: "ajax/editar_producto.php",
            data: parametros,
            beforeSend: function(objeto){
                $("#resultados").html("Mensaje: Cargando...");
            },
            success: function(datos){
    
                $("#resultados").html(datos);
                $('#actualizar_datos').attr("disabled", false);
                load(1);
            }
        });
        event.preventDefault();
    })

    $( "#imprimir_codbar" ).submit(function( event ) {
        $('#imprimir_ticket').attr("disabled", true);

        var parametros = $(this).serialize();
        $.ajax({
            type: "POST",
            url: "ajax/imprimir_producto.php",
            data: parametros,
            beforeSend: function(objeto){
                $("#resultados_ajax2").html("Mensaje: Cargando...");
            },
            success: function(datos){
                $("#resultados_ajax2").html(datos);
                $('#imprimir_ticket').attr("disabled", false);
                load(1);
            }
        });
        event.preventDefault();
    })


function Registrarenunhidden(){
	//console.log('ojala prcd');
	var variableqs = $("#q").val();
console.log(variableqs);
document.getElementById('q11').value= variableqs;
//document.getElementById('q11').value = variableqs;
		//$("#q11").val(variableqs);

}


  function obtener_datos_historial(id){
    $(".outer_div123").html('');
    $('#loader1').html('');
   

    
    let codigo_producto = $("#nombre_producto"+id).val();    
      $("#mod_id").val(id);
      $("#mod_codigo").val(codigo_producto);
      $("#aidi").val(id);
    }




  function obtener_datos(id){

        let codigo_producto = $("#codigo_producto"+id).val();
        let ganancia_monto_porcsoles = $("#ganancia_monto_porcsoles"+id).val();
        let gananciadelproducto = $("#gananciadelproducto"+id).val();
        let ntcp_compra = $("#tcp_compra"+id).val();
        let nombre_producto = $("#nombre_producto"+id).val();
        let precio_producto = $("#precio_producto"+id).val();
        let tipo_porcentajen = $("#tipo_porcentajenn"+id).val();

        let ganancian = $("#ganancian"+id).val();
        let costo_venta_s_n = $("#costo_venta_s"+id).val();
        let costo_producto = $("#costo_producto"+id).val();
        let tipo = $("#id_tipo"+id).val();
        let monventa = $("#mon_venta"+id).val();
        let moncosto = $("#mon_costo"+id).val();
        let cat_produc = $("#cat_pro"+id).val();
        let inv = $("#inv"+id).val();
        let marca = $("#id_marca"+id).val();
        let proveedor = $("#codigoProveedor"+id).val();
        let alternativo = $("#codigoAlternativo"+id).val();
        let codigo_original = $("#codigo_original"+id).val();
        let detalle = $("#detalle"+id).val();
        let dolar = $("#multiplicando_multiplicando").val();
        let costo = $("#costo"+id).val();
        let utilidad = $("#utilidad"+id).val();
        let medida = $("#medida"+id).val();
        var nuevomontodolar = $("#cdolarc").val();


        $("#mod_id").val(id);
        if (ntcp_compra > 0) 
        {
          $("#multiplicando_multiplicando").val(ntcp_compra);
        }
        else
        {
          $("#multiplicando_multiplicando").val(nuevomontodolar);
        }


        $("#mod_tganancia").val(tipo_porcentajen);
        $("#mod_codigo_mod").val(codigo_producto);
        $("#mod_nombre").val(nombre_producto);
        //$("#mod_precio").val(precio_producto);
        $("#mod_costo").val(precio_producto);
        costo_producto = precio_producto;
        $("#mod_tipo").val(tipo);
        $("#mod_monventa").val(monventa);
        $("#mod_moncosto").val(moncosto);
        $("#mod_categoria").val(cat_produc);
        $("#mod_inv").val(inv);
        $("#mod_marca").val(marca);
        $("#mod_proveedor").val(proveedor);
        $("#mod_alternativo").val(alternativo);
        $("#mod_codigooriginal_mod").val(codigo_original);
        $("#mod_medida").val(medida);
        $("#mod_detalle").val(detalle);
        $("#tcp").val(dolar);


        if(dolar==1){

            $("#mod_costo").val(costo_producto);
            setTimeout(function () {
              if (costo_producto > 0) 
              {
                  if(ganancian != 0 && ganancian != ''){
                    $("#ganancia").val(ganancia_monto_porcsoles.toFixed(3));
                    $("#mod_precio").val(costo_venta_s_n);
                }else{
                    $('#ganancia').val(ganancia_monto_porcsoles.toFixed(3));
                }
              }
              else
              {
                    if(ganancian != 0 && ganancian != ''){
                    $("#ganancia").val(ganancia_monto_porcsoles.toFixed(3));
                    $("#mod_precio").val(costo_venta_s_n);
                }else{
                    $('#ganancia').val(0);
                }
             
              }
            },200);
            $('#ObtenerSoles').prop("checked",true);
            $('#ObtenerDolar').prop("checked",false);
        }else{
          setTimeout(function () {
            if (costo_producto > 0){
              var codsto = 0 ;
              codsto =$('#multiplicando_multiplicando').val();
              var modcosto = 0 ;
              modcosto = $('#mod_costo').val();
              var modprecio = $('#mod_precio').val();
              codsto = parseFloat(codsto);
              codsto = codsto.toFixed(3); 
              modcosto = parseFloat(modcosto);
              modcosto = modcosto.toFixed(3); 
              modprecio = parseFloat(modprecio);
              modprecio = modprecio.toFixed(3); 
            
                var totalresultado =  modcosto * codsto;

                totalresultado = totalresultado.toFixed(3); 
                
                if(modcosto == 0){
                  $("#resultado_mod").val(0);
                }else{
                  $("#resultado_mod").val(totalresultado);
                }

                if(ganancian != 0 && ganancian != ''){
          console.log('aaaaaa');
                    if (tipo_porcentajen == 1) {
                      var nuevonuevonuevo = $("#resultado_mod").val();
                      var nuevototal1 =  parseFloat(gananciadelproducto);
                    $("#ganancia").val(ganancia_monto_porcsoles);
                    
                   
                  
 
                    }else if(tipo_porcentajen == 2){

                      var nuevonuevonuevo = $("#resultado_mod").val();
                      var nuevototal1 = parseFloat(nuevonuevonuevo) + parseFloat(gananciadelproducto);
                      var captamoselprctn = (nuevototal1 * 100);
                      captamoselprctn = captamoselprctn / parseFloat(nuevonuevonuevo);
                    captamoselprctn = captamoselprctn - 100;

                    $("#ganancia").val(ganancia_monto_porcsoles);

                    }else{
                     var nuevonuevonuevo = $("#resultado_mod").val();
                
                 //   $("#mod_precio").val(costo_venta_s_n);

                    }
                    //$("#ganancia").val(ganancian);
                    $("#mod_precio").val(costo_venta_s_n);
                }else{
          console.log('ooooooooooo');

                    var totiresu = modprecio - totalresultado;
                    $('#ganancia').val(ganancia_monto_porcsoles);
                }



            }
            else
            {


                if(ganancian != 0 && ganancian != ''){
                    $("#ganancia").val(ganancia_monto_porcsoles);
                    $("#mod_precio").val(costo_venta_s_n);
                }else{
                    $('#ganancia').val(0);
                }

              
              $('#resultado_mod').val(0);
            }


          },200);
          $("#mod_costo").val(precio_producto);
          $('#ObtenerDolar').prop("checked",true);
          $('#ObtenerSoles').prop("checked",false);
        }


        var nnnnresultadomod = $("#resultado_mod").val();
        $("#resultado_mod").val(nnnnresultadomod);
        var nnnnmultiplicando1 = $("#multiplicando1").val();
        $("#multiplicando1").val(nnnnmultiplicando1);


        $("#soles").val(costo);
        $("#utilidad").val(utilidad);
        if (costo_producto > 0){
          $('#ns').val((($('#mod_costo').val())*($('#tcp').val())).toFixed(3));
        }else{
          $('#ns').val(3.4);
        }
    }

      function obtener_datos_barra(id){

        console.log('asadsdasdasdasdasdasd');

        $("#ganancia").val('');
        $("#mod_precio").val('');
        let codigo_producto = $("#codigo_producto"+id).val();
        let nombre_producto = $("#nombre_producto"+id).val();
        let precio_producto = $("#precio_producto"+id).val();
        let ncostosoles = $("#costo_soles"+id).val();
        let ncostoventasoles = $("#costo_venta_s"+id).val();
        let costo_producto = $("#costo_producto"+id).val();

        let codigo_alternativonombre = $("#codigo_alternativo"+id).val();
        
        let tipo = $("#id_tipo"+id).val();
        let monventa = $("#mon_venta"+id).val();
        let moncosto = $("#mon_costo"+id).val();
        let cat_produc = $("#cat_pro"+id).val();
        let inv = $("#inv"+id).val();
        let marca = $("#id_marca"+id).val();
        let proveedor = $("#codigoProveedor"+id).val();
        let alternativo = $("#codigoAlternativo"+id).val();
        let detalle = $("#detalle"+id).val();
        let dolar = $("#dolar"+id).val();
        let costo = $("#costo"+id).val();
        let utilidad = $("#utilidad"+id).val();
        let medida = $("#medida"+id).val();
        let cant_ultimacompra = $("#cant_ultimacompra"+id).val();
        let cod_brra = $("#code_barra"+id).val();
        let cbarra = $("#codigo_producto"+id).val() +  $("#codigoProveedor"+id).val();

        console.log('121212121212');
        console.log(ncostoventasoles);
        console.log('121212121212');


        $("#mod_costobarra").val(ncostosoles);
        $("#mod_preciobarra").val(ncostoventasoles);
        $("#mod_idbarra").val(id);
        $("#mod_codigobarra").val(codigo_producto);
        $("#mod_nombrebarra").val(nombre_producto);
        //$("#mod_preciobarra").val(precio_producto);
        $("#mod_tipobarra").val(tipo);
        $("#mod_monventabarra").val(monventa);
        $("#mod_moncostobarra").val(moncosto);
        $("#mod_categoriabarra").val(cat_produc);
        $("#mod_invbarra").val(inv);
        $("#mod_marcabarra").val(marca);
        $("#mod_proveedorbarra").val(proveedor);
        $("#mod_alternativobarra").val(codigo_alternativonombre);
        $("#mod_medidabarra").val(medida);
        $("#mod_detallebarra").val(detalle);
        $("#mod_cant_ultimacomprabarra").val(cant_ultimacompra);
        $("#mod_cbarra").val(cbarra);
        let nuevocbarra = codigo_producto.substr(0, 6);
        let nnncb = "";
        if (cod_brra.length == 1) 
        {
          nnncb = "000"+cod_brra;
        }
        else if(cod_brra.length == 2)
        {
          nnncb = "00"+ cod_brra;
        }
        else if(cod_brra.length == 3)
        {
          nnncb = "000"+ cod_brra;
        }
        else if(cod_brra.length == 4)
        {
          nnncb = cod_brra;
        }
        else
        {
          nnncb = cod_brra.substr(0, 4);
        }
        nuevocbarra = nnncb + nuevocbarra ;
        $("#b_code").attr("src","libraries/barcode.php?text="+nuevocbarra+"&size=50&orientation=horizontal&codetype=Code39");
        $("#tcpbarra").val(dolar);


        if(dolar==1){
          $("#mod_costo").val(costo_producto);
            setTimeout(function () {
              $('#gananciabarra').val(($('#mod_preciobarra').val())-($('#mod_costobarra').val()));
            },200);
            $('#ObtenerSolesbarra').prop("checked",true);
            $('#ObtenerDolarbarra').prop("checked",false);

        }else 
        {
          setTimeout(function () {
            $('#gananciabarra').val((($('#mod_preciobarra').val())-($('#nsbarra').val())).toFixed(3));
          },200);
          $("#mod_costobarra").val(costo);
          $('#ObtenerDolarbarra').prop("checked",true);
          $('#ObtenerSolesbarra').prop("checked",false);
        }
        $("#solesbarra").val(costo);
        $("#utilidadbarra").val(utilidad);
        $('#nsbarra').val((($('#mod_costobarra').val())*($('#tcpbarra').val())).toFixed(3));
    }

  function obtenerId(id){
    $("#idProducto").val(id);
    $("#nombreProducto").html($("#nombre_producto"+id).val());
    setTimeout(function(){
      cargardatoscompatibles();
      $('#BtnBuscar').click();
    },500);
  }
    function cargardatoscompatibles(){
      var q =  $("#idProducto").val();
      var page =  1;
      console.log('nkñsdfnksdfgfdgjnfgdjn');
      //var categoria = $("#categoria_m").val();
      var marca = $("#marca_nuevoCompatible").val();
      var modelo = $("#modelo_nuevoCompatible").val();
      var motor = $("#motor_nuevoCompatible").val();
      var anio = $("#anio").val();
      var cilindro = $("#cilindro").val();
      var combustible = $("#combustible").val();
  

      $("#loader").fadeIn('slow');
      $.ajax({
        url: './ajax/productos_compatibles_v.php?action=ajax&page=' + page + '&marca=' + marca + '&q=' + q + '&modelo=' + modelo + '&motor=' + motor +'&aniocompa=' + anio + '&cilindro=' + cilindro + '&combustible=' + combustible,
        beforeSend: function(objeto) {
          $('#loader').html('<img src="./img/ajax-loader.gif"> Cargando...');
        },
        success: function(data) {
          $(".outer_div_compatible").html(data).fadeIn('slow');
          $('#loader').html('');

        }
      })
    }

    function cargardatoscompatiblesagregar(){
      //var q =  $("#idProducto").val();
      console.log('cargardatoscompatiblesagregar');
      var page =  1;
      //var categoria = $("#categoria_m").val();
      var marca = $("#marca_compatible_agregar").val();
      var modelo = $("#modelo_compatible_agregar").val();

console.log(marca);
console.log(modelo);
console.log('se muestra todo');
      $("#loader").fadeIn('slow');
      $.ajax({
        url: './ajax/productos_compatibles_agregar.php?action=ajax&page=' + page + '&marca=' + marca + '&modelo=' + modelo,
        beforeSend: function(objeto) {
          $('#loader').html('<img src="./img/ajax-loader.gif"> Cargando...');
        },
        success: function(data) {
          $(".outer_div_compatible_agregar").html(data).fadeIn('slow');
          $('#loader').html('');

        }
      })
    }


    function eliminarcompatibilidad(id) {
     // var q = $("#q").val();
     if (confirm("Realmente deseas eliminar el vehículo?")) {
        $.ajax({
          type: "GET",
          url: "./ajax/productos_compatibles_v.php",
          data: "idparaeliminarvehiculo=" + id,
          "q": q,
          beforeSend: function(objeto) {
            $('#loader').html('<img src="./img/ajax-loader.gif"> Cargando...');
          },
          success: function(datos) {
            //$(".outer_div_compatible").html(data).fadeIn('slow');
            $('#loader').html('');
            cargardatoscompatibles();
            load(1);
          }
        });
      }
    }


  $(document).ready(function(){

    $('#BtnCerrarAgregar').click(function(){
      setTimeout(function(){
        $('#BtnBuscar').click();
      },500);
    });




    $('#q').on('change', function () {
    }).change();

    $('#q').on('autocompleteselect', function (e, ui) {
      var nuevavariable = ui.item.value;
      
      setTimeout(function(){
      $('#q').val(nuevavariable);
      load(1);
      }, 1000);
      
    });

  });


  function functVerDatos(){

  
cargardatoscompatibles();
  }

    function loading12(page){
      var q= $("#aidi").val();
      $("#loader").fadeIn('slow');
      $.ajax({
        url:'./ajax/productos_precio_historial.php?action=ajax&page='+page+'&q='+q,
         beforeSend: function(objeto){
         $('#loader').html('<img src="./img/ajax-loader.gif"> Cargando...');
        },
        success:function(data){ 
          $(".outer_div1234").html(data).fadeIn('slow');
          $('#loader').html('');
        }
      });
    }




function load(page){



      var q= $("#q").val();
      $("#loader").fadeIn('slow');
      $.ajax({
        url:'./ajax/buscar_productos.php?action=ajax&page='+page+'&q='+q,
         beforeSend: function(objeto){
         $('#loader').html('<img src="./img/ajax-loader.gif"> Cargando...');
        },
        success:function(data){
          $(".outer_div").html(data).fadeIn('slow');
          $('#loader').html('');
          console.log('bbbbb');
        }
      })
    }





    function loading1(page){
      var q= $("#aidi").val();
      
      $("#loader").fadeIn('slow');


      $.ajax({
        url:'./ajax/productos_historial.php?action=ajax&page='+page+'&q='+q,
         beforeSend: function(objeto){
         $('#loader').html('<img src="./img/ajax-loader.gif"> Cargando...');
        },
        success:function(data){
          
          $(".outer_div123").html(data).fadeIn('slow');
          $('#loader').html('');
        }
      })

      loading12(1);

    }




</script>
<script type="text/javascript">


 llamadabproductos = function(link, link1, link2, link3, link4)
  {
var nuevoarraydefotos = new Array();






 var contadordefotos = 0;
    if (link != "" ) {
nuevoarraydefotos[contadordefotos] = link;
      contadordefotos = contadordefotos + 1;
    }
    if (link1 != "" ) {
nuevoarraydefotos[contadordefotos] = link1;
      contadordefotos = contadordefotos + 1;

    }
    if (link2 != "") {
nuevoarraydefotos[contadordefotos] = link2;
      contadordefotos = contadordefotos + 1;

    }
    if (link3 != "" ) {
nuevoarraydefotos[contadordefotos] = link3;
      contadordefotos = contadordefotos + 1;

    }
    if (link4 != "" ) {
nuevoarraydefotos[contadordefotos] = link4;
      contadordefotos = contadordefotos + 1;
    }


      console.log('array');
      console.log(nuevoarraydefotos);
      console.log('array');




var contcarrusel = "<ol class='carousel-indicators'>";
    var nuevoaumento = 0;


while(nuevoaumento < contadordefotos){
        if (nuevoaumento == 0) {
contcarrusel += " <li data-target='#myCarousel' data-slide-to='0' class='active'></li>";
      }else{
contcarrusel += " <li data-target='#myCarousel' data-slide-to='"+nuevoaumento+"'></li>";
      }
  nuevoaumento = nuevoaumento + 1;
}




 contcarrusel += "</ol>";
 contcarrusel += "  <div class='carousel-inner'>";
    var nuevoaumento1 = 0;

while(nuevoaumento1 < contadordefotos){
        if (nuevoaumento1 == 0) {
contcarrusel += "<div class='item active'><img src='fotos/"+nuevoarraydefotos[nuevoaumento1]+"' alt='Los Angeles' style='width:100%!important; height:100%!important'></div>";
      }else{
contcarrusel += "<div class='item'><img src='fotos/"+nuevoarraydefotos[nuevoaumento1]+"' alt='Chicag' style='width:100%!important; height:100%!important'></div>";
      }
  nuevoaumento1 = nuevoaumento1 + 1;
}


contcarrusel += "</div>";
contcarrusel += "<a class='left carousel-control' href='#myCarousel' data-slide='prev'><span class='glyphicon glyphicon-chevron-left'></span><span class='sr-only'>Previous</span></a><a class='right carousel-control' href='#myCarousel' data-slide='next'><span class='glyphicon glyphicon-chevron-right'></span><span class='sr-only'>Next</span></a>";

contcarrusel += "</div>";



  $('#myCarousel').empty();
   // var titulo="<span ><img src='fotos/"+link+"' class='imagen4' border='0' alt='' width='420px'/></span>   ";
     
     //*$('#modalbody').append(titulo);
     $('#myCarousel').append(contcarrusel);
  }
</script>



<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>

<script src="js/Vue/Vue.js"></script>

<script>
    $(function() {
        $("#q").autocomplete({
            source: "./ajax/autocomplete/productos.php",
            minLength: 1,
            select: function(event, ui) {
                event.preventDefault();
                $('#id_producto').val(ui.item.id_producto);
                $('#q').val(ui.item.marca);
                $('#precio_producto').val(ui.item.precio_producto);
                $('#inv_producto').val(ui.item.inv_producto);

         

             }
        });
    });





  $("#q" ).on( "keydown", function( event ) {
        if (event.keyCode== $.ui.keyCode.LEFT || event.keyCode== $.ui.keyCode.RIGHT || event.keyCode== $.ui.keyCode.UP || event.keyCode== $.ui.keyCode.DOWN || event.keyCode== $.ui.keyCode.DELETE || event.keyCode== $.ui.keyCode.BACKSPACE )
        {
            $("#id_producto" ).val("");
            $("#inv_producto" ).val("");
            $("#precio_producto" ).val("");

        }
        if (event.keyCode==$.ui.keyCode.DELETE){
            $("#q" ).val("");
            $("#id_producto" ).val("");
            $("#inv_producto" ).val("");
            $("#precio_producto" ).val("");
        }
    });

</script>
<script type="text/javascript">
  $('#marca_nuevoCompatible').on('change',function(){
        var marca_m = $("#marca_nuevoCompatible").val();
        console.log(marca_m);
        if(marca_m){


            $.ajax({
                type:'POST',
                url:'./modal/appblade.php',
                data:'marca_m='+marca_m,
                success:function(html){
                  console.log(html);
                    $('#modelo_nuevoCompatible').html(html);
                }
            });

        }else{
            $('#modelo_nuevoCompatible').html('<option class="custom-select" value="">Seleccione marca primero</option>');
        }
    });
</script>
</body>

</html>
<script type="text/javascript" src="js/productos.js"></script>
<script type="text/javascript" src="ViewModels/consultaproductos.js"></script>
<script type="text/javascript" src="js/util/Objetos.js"></script>
