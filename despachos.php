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
</style> -->

<?php
session_start();
include('menu.php');
require_once ("config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
require_once ("config/conexion.php");
$sql1="select * from users where user_id=$_SESSION[user_id]";


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

<script type="text/javascript">
    function LimpiarDatos() {
    document.getElementById("buscar_despacho_filtro").reset();
  }
</script>
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
                  <h4>Despacho y Entrega de Productos</h4>
                </div>

                <form  id="buscar_despacho_filtro" name="buscar_despacho_filtro">
<div class="panel-body">
	<div class="form-group row">
										<div class="col-md-3 col-sm-3 col-xs-12 separador-compras separador">
											Cliente (*):
											<input type="text" class="form-control estilo-placeholder input-sm" id="nombre_cliente" placeholder="Nombre o Razón del Cliente" required>
											<input id="id_proveedores" type='hidden' class="custom-select">
										</div>

										<div class="col-md-3 col-sm-3 col-xs-12 separador-compras">
											Método de Envío (*):
                       <select  class="form-control estilo-placeholder" id="metodo_envio" name="metodo_envio" required>
                <option class="custom-select" value="0">-- Selecciona el Método --</option>
                   <?php
                    $sql21="select * from tipo_envios  where estado = 1";
                    $i=0;
                    $rs11=mysqli_query($con,$sql21);
                    while($row3=mysqli_fetch_array($rs11)){
                      $nombre_tenvio=$row3["nombre_tenvio"];
                      $id_tipoenvios=$row3["id_tipoenvios"];
                  ?>
                    <option class="custom-select" value="<?php  echo $id_tipoenvios;?>"><?php  echo $nombre_tenvio;?></option>
                  <?php
                    $i=$i+1;
                    }    
                  ?>  
                      </select>
										</div>

										<input type="hidden" class="form-control input-sm" id="ot" value="0">

										<div class="col-md-3 col-sm-3 col-xs-12 separador-compras">
											Estado del Envío:
                <select  class="form-control estilo-placeholder" id="estado_pago" name="estado_pago" required>
                  <option class="custom-select" value="0">-- Selecciona el Estado --</option>
                   <?php
                    $sql21="select * from parametro  where estado = 1 and id_tipo_param = 2";
                    $i=0;
                    $rs11=mysqli_query($con,$sql21);
                    while($row31=mysqli_fetch_array($rs11)){
                      $nombre_parametro=$row31["nombre_parametro"];
                      $id_parametro=$row31["id_parametro"];
                  ?>
                    <option class="custom-select" value="<?php  echo $id_parametro;?>"><?php  echo $nombre_parametro;?></option>
                  <?php
                    $i=$i+1;
                    }    
                  ?>  
                      </select>
										</div>

										<div class="col-md-3 col-sm-3 col-xs-12 separador-compras">
											Estado del Pago:

                                         <select  class="form-control estilo-placeholder" id="estado_envio" name="estado_envio" required>
                <option class="custom-select" value="0">-- Selecciona el Estado --</option>
                   <?php
                    $sql21="select * from parametro  where estado = 1 and id_tipo_param = 1";
                    $i=0;
                    $rs11=mysqli_query($con,$sql21);
                    while($row31=mysqli_fetch_array($rs11)){
                      $nombre_parametro=$row31["nombre_parametro"];
                      $id_parametro=$row31["id_parametro"];
                  ?>
                    <option class="custom-select" value="<?php  echo $id_parametro;?>"><?php  echo $nombre_parametro;?></option>
                  <?php
                    $i=$i+1;
                    }    
                  ?>  
                      </select>
                  	</div>

										<div class="col-md-12 col-sm-12 col-xs-12 text-right mt-3">
				              <button type="button" class="btn btn-limpiar" onclick="LimpiarDatos()">Limpiar</button>
                      <button type="button" class="btn btn-agregar" onclick="load(1)">Buscar Pedidos</button>
										</div>

									</div>
								</div>
</form>
            </div>
     


  </div>
    </div>
<!--aca esta la diferencia --->
              <div class="row">

            <div class="container">

              <div class="panel panel-info">                

                <div class="panel-body">
                              <div class="form-group row">
                  

                        <div class="col-md-7" style="display: none;">
                          <input type="text" class="form-control estilo-placeholder" id="q" name="q" placeholder="Buscar Categoria" onkeypress='load(1);'  >
                        </div>

                        <div class="col-md-2">
                          <!-- <button type="button" class="btn btn-default" onclick='load(1);'> -->
                          <!-- <span class="glyphicon glyphicon-search" ></span> Buscar</button> -->
                          <span id="loader"></span>
                        </div>
                    </div>
                  <?php
        include("modal/registro_categorias.php");
                  include("modal/editar_categorias.php");


                  ?>
    
        <div id="resultados"></div><!-- Carga los datos ajax -->
        <div class='outer_div'></div><!-- Carga los datos ajax -->

        <div style="display: none;">
          <input type="text" name="cdolarc" id="cdolarc" value="">
        </div>

                </div>
            </div>
     


  </div>
    </div>
</div>

        <?php
          footer();
          
          ?>
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

  /*  function eliminar(id) {
      var q = $("#q").val();
      if (confirm("Realmente deseas eliminar la categoria")) {
        $.ajax({
          type: "GET",
          url: "./ajax/buscar_categorias.php",
          data: "id=" + id,
          "q": q,
          beforeSend: function(objeto) {
            $("#resultados").html("Mensaje: Cargando...");
          },
          success: function(datos) {
            $("#resultados").html(datos);
            load(1);
           // location.reload();
      setTimeout(function(){ document.getElementById('alertborrarcategorias').style.display = 'none'; }, 1500);
      setTimeout(function(){ document.getElementById('resultados').style.display = 'none'; }, 1500);
          }
        });
      }
    }*/



    $("#guardar_categoria").submit(function(event) {
      $('#guardar_datos').attr("disabled", true);

      var parametros = $(this).serialize();
      $.ajax({
        type: "POST",
        url: "ajax/nuevo_categoria.php",
        data: parametros,
        beforeSend: function(objeto) {
          $("#resultados_ajax").html("Mensaje: Cargando...");
        },
        success: function(datos) {
          $("#resultados_ajax").html(datos);
          $('#guardar_datos').attr("disabled", false);
            limpiarFormulario();
      setTimeout(function(){ document.getElementById('alertborrarcategorias').style.display = 'none'; }, 1000);

          load(1);
        }
      });
      event.preventDefault();
    })

    $("#editar_categoria").submit(function(event) {
      $('#actualizar_datos').attr("disabled", true);

      var parametros = $(this).serialize();
      $.ajax({
        type: "POST",
        url: "ajax/editar_categoria.php",
        data: parametros,
        beforeSend: function(objeto) {
          $("#resultados_ajax2").html("Mensaje: Cargando...");
        },
        success: function(datos) {
          $("#resultados_ajax2").html(datos);
          $('#actualizar_datos').attr("disabled", false);
      setTimeout(function(){ document.getElementById('alertborrarcategorias').style.display = 'none'; }, 1500);
 setTimeout(function(){ document.getElementById('resultados_ajax2').style.display = 'none'; }, 1500);
          load(1);
        }
      });
      event.preventDefault();
    })

/*
function LimpiarDatos(){
    $("#nombre_cliente").val('');
    $("#metodo_envio").val(0);
    $("#estado_pago").val(0);
    $("#estado_envio").val(0);
}*/


function Registrarenunhidden(){
  //console.log('ojala prcd');
  var variableqs = $("#q").val();
console.log(variableqs);
document.getElementById('q11').value= variableqs;
//document.getElementById('q11').value = variableqs;
    //$("#q11").val(variableqs);

}





    function obtener_datos(id) {
      var nom_cat = $("#nom_cat" + id).val();
      var des_cat = $("#des_cat" + id).val();
      $("#mod_cat").val(nom_cat);
      $("#mod_des").val(des_cat);
      $("#mod_id").val(id);

    }




  $(document).ready(function(){


load(1);


  });


  function functVerDatos(){

  
cargardatoscompatibles();
  }





function load(page){
console.log('que fue ');
console.log('que fue ');
console.log('que fue ');

      var q1= $("#nombre_cliente").val();
      var q2= $("#metodo_envio").val();
      var q3= $("#estado_pago").val();
      var q4= $("#estado_envio").val();

      $("#loader").fadeIn('slow');
      $.ajax({
        url:'./ajax/buscar_despachos.php?action=ajax&page='+page+'&q1='+q1+'&q2='+q2+'&q3='+q3+'&q4='+q4,
         beforeSend: function(objeto){
        // $('#loader').html('<img src="./img/ajax-loader.gif"> Cargando...');
        },
        success:function(data){
          $(".outer_div").html(data).fadeIn('slow');
          $('#loader').html('');
          console.log('bbbbb');
        }
      })
    }


    function Registrar_factura_despacho(id) {
     // var q = $("#q").val();

    //var q= $("#q").val();
    if (confirm("Realmente deseas realizar la venta?")){ 
     $.ajax({
          type: "GET",
          url: "./ajax/generarFactura.php",
          data: "iddespachoFactura=" + id,
          beforeSend: function(objeto) {
            //$('#loader').html('<img src="./img/ajax-loader.gif"> Cargando...');
          },
          success: function(datos) {
            load(1);
          }
        });
    }


     /*if (confirm("Realmente deseas enviar este pedido a Factura??")) {
        $.ajax({
          type: "GET",
          url: "./ajax/generarFactura.php",
          data: "iddespachoFactura=" + id,
          beforeSend: function(objeto) {
            //$('#loader').html('<img src="./img/ajax-loader.gif"> Cargando...');
          },
          success: function(datos) {
            //$(".outer_div_compatible").html(data).fadeIn('slow');
           // $('#loader').html('');
            
           // load(1);
          }
        });
      }*/
    }




</script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>

<script src="js/Vue/Vue.js"></script>

<script>


</script>

</body>

</html>

<script type="text/javascript" src="ViewModels/consultaproductos.js"></script>
<script type="text/javascript" src="js/util/Objetos.js"></script>
