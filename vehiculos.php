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
$modulo=$rs1["accesos"];
$a = explode(".", $modulo); 
if (!isset($_SESSION['user_login_status']) AND $_SESSION['user_login_status'] != 1) {
    header("location: login.php");
    exit;
}
if($a[17]==0){
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
      <input type="hidden" id="idVehiculoA">
      <div class="col-md-3 left_col">
        <div class="left_col scroll-view">
            <div class="clearfix"></div>
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
        <div class="">
          <div class="page-title">
            <div class="title_left">  
            </div>
          </div>
          <div class="clearfix"></div>
          <div class="row">
           <div class="container">
            <div class="panel panel-info">
    <div class="panel-heading">
        <div class="btn-group pull-right">
        <button type='button' class="btn btn-header" data-toggle="modal" data-target="#nuevoVehiculo"><span class="glyphicon glyphicon-plus"></span> Nuevo vehiculo</button>
      </div>
      <h4>Parque Automotor</h4>
    </div>
    <div class="panel-body">
                                   <div class="form-group row">
                        <label for="q" class="col-md-4 control-label">Datos del Vehículo :</label>

                        <div class="col-md-7">
                          <input type="text" class="form-control estilo-placeholder" id="q" name="q" placeholder="Buscar Vehiculo" onkeypress='load(1);'  >
                        </div>

                        <div class="col-md-2">
                          <!-- <button type="button" class="btn btn-default" onclick='load(1);'> -->
                          <!-- <span class="glyphicon glyphicon-search" ></span> Buscar</button> -->
                          <span id="loader"></span>
                        </div>
                    </div>
    <?php
                include("modal/nuevo_vehiculo.php");
            include("modal/editar_vehiculo.php");
                ?>
      
    <div id="resultados"></div><!-- Carga los datos ajax -->
                <div class='outer_div'></div><!-- Carga los datos ajax -->
    
                </div>
            </div>
            </div>
       </div>
  </div>
        <?php
          footer();
          
          ?>
      </div>
      
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
        $(document).ready(function(){
      load(1);
    });

    function load(page){
      var q= $("#q").val();
      $("#loader").fadeIn('slow');
      $.ajax({
        url:'./ajax/buscar_vehiculo.php?action=ajax&page='+page+'&q='+q,
         beforeSend: function(objeto){
         //$('#loader').html('<img src="./img/ajax-loader.gif"> Cargando...');
        },
        success:function(data){
          $(".outer_div").html(data).fadeIn('slow');
          $('#loader').html('');
          
        }
      })
    }



    function eliminar (id)
    {
      var q= $("#q").val();
    if (confirm("Confirmar para eliminar el Vehiculo")){  
    $.ajax({
                type: "GET",
                url: "./ajax/buscar_vehiculo.php",
                data: "id="+id,"q":q,
     beforeSend: function(objeto){
      $("#resultados").html("Mensaje: Cargando...");
      },
                success: function(datos){
    $("#resultados").html(datos);
     setTimeout(function(){
        $("#resultados").html(''); }, 1500);
    load(1);
    }
      });
    }
    }

$( "#guardar_vehiculo" ).submit(function( event ) {
$('#guardar_datos').attr("disabled", true);
 var parametros = $(this).serialize();
   $.ajax({
      type: "POST",
      url: "ajax/nuevo_vehiculo.php",
      data: parametros,
       beforeSend: function(objeto){
        $("#resultados_ajax").html("Mensaje: Cargando...");
        },
      success: function(datos){
      $("#resultados_ajax").html(datos);
      $('#guardar_datos').attr("disabled", false);
     limpiarFormulario();
      setTimeout(function(){
        $("#resultados_ajax").html(''); }, 1500);
      load(1);
      }
  });
  event.preventDefault();
})




$( "#editar_vehiculo" ).submit(function( event ) {
  $('#actualizar_datos').attr("disabled", true);

 var parametros = $(this).serialize();
 console.log(parametros)
   $.ajax({
      type: "POST",
      url: "ajax/editar_vehiculo.php",
      data: parametros,
       beforeSend: function(objeto){
        $("#resultados_ajax2").html("Mensaje: Cargando...");
        },
      success: function(datos){
      $("#resultados_ajax2").html(datos);
      $('#actualizar_datos').attr("disabled", false);
        setTimeout(function(){
        $("#resultados_ajax2").html(''); }, 1500);
      load(1);
      }
  });
  event.preventDefault();
})


  function obtener_datos(id){
              var idvehiculo = $("#d_vehiculo"+id).val();
              var nombre = $("#nombre_vehiculo"+id).val();
              var modestado = $("#estado"+id).val();
              var motor = $("#motor"+id).val();
                  var id_modelo = $("#id_modelo"+id).val();
                  console.log('-----');
                  console.log(modestado);
                        var id_marca = $("#id_marca"+id).val();
                        var anio = $("#anio"+id).val();
                        var cilindro = $("#cilindro"+id).val();
                        var combustible = $("#combustible"+id).val();
                        var descripcion = $("#detalle"+id).val();
                        var comentario = $("#comentario"+id).val();

                        $("#idVehiculoA").val(id);

                        $("#mod_idvehiculo").val(idvehiculo);
                        $("#mod_nombre").val(nombre);
                        $("#mod_motor").val(motor);
                        $("#mod_idMarca").val(id_marca);
                        $("#mod_idmodelo_mode").val(id_modelo);
                        $("#mod_anio").val(anio);
                        $("#mod_cilindro").val(cilindro);
                        $("#mod_combustible").val(combustible);
                        $("#mod_detalle").val(descripcion);              
                        $("#mod_comentario").val(comentario);              
    }
     
        </script>
        <script type="text/javascript">


 llamadabvehiculos  = function(link, link1, link2, link3, link4)
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

var contcarrusel = "<ol class='carousel-indicators'>";
    var nuevoaumento = 0;

/*
while(nuevoaumento < contadordefotos){
        if (nuevoaumento == 0) {
contcarrusel += " <li data-target='#myCarousel' data-slide-to='0' class='active'></li>";
      }else{
contcarrusel += " <li data-target='#myCarousel' data-slide-to='"+nuevoaumento+"'></li>";
      }
  nuevoaumento = nuevoaumento + 1;
}*/




 contcarrusel += "</ol>";
 contcarrusel += "  <div class='carousel-inner'>";
    var nuevoaumento1 = 0;

while(nuevoaumento1 < contadordefotos){
        if (nuevoaumento1 == 0) {
contcarrusel += "<div class='item active'><img src='fotos_vehiculo/"+nuevoarraydefotos[nuevoaumento1]+"' alt='Los Angeles' style='width:100%!important; height:100%!important'></div>";
      }else{
contcarrusel += "<div class='item'><img src='fotos_vehiculo/"+nuevoarraydefotos[nuevoaumento1]+"' alt='Chicag' style='width:100%!important; height:100%!important'></div>";
      }
  nuevoaumento1 = nuevoaumento1 + 1;
}


contcarrusel += "</div>";
contcarrusel += "<a class='left carousel-control' href='#myCarousel' data-slide='prev'><span class='glyphicon glyphicon-chevron-left'></span><span class='sr-only'>Previous</span></a><a class='right carousel-control' href='#myCarousel' data-slide='next'><span class='glyphicon glyphicon-chevron-right'></span><span class='sr-only'>Next</span></a>";

contcarrusel += "</div>";



  $('#myCarousel').empty();
  
     $('#myCarousel').append(contcarrusel);
  }
</script>


</body>
</script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script src="js/Vue/Vue.js"></script>
<script>
</script>
</html>
<script type="text/javascript" src="ViewModels/consultaproductos.js"></script>
<script type="text/javascript" src="js/util/Objetos.js"></script>
