<?php
session_start();
include('menu.php');
require_once ("config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
require_once ("config/conexion.php");//Contiene funcion que conecta a la base de datos
$sql1="select * from users where user_id=$_SESSION[user_id] AND estado=1";
$rw1=mysqli_query($con,$sql1);//recuperando el registro
$rs1=mysqli_fetch_array($rw1);//trasformar el registro en un vector asociativo
$modulo=$rs1["accesos"];
$a = explode(".", $modulo); 
if (!isset($_SESSION['user_login_status']) AND $_SESSION['user_login_status'] != 1) {
    header("location: login.php");
    exit;
} 
if($a[4]==0){
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
  <link href="css/bootstrap.min.css" rel="stylesheet">

  <link href="fonts/css/font-awesome.min.css" rel="stylesheet">
  <link href="css/animate.min.css" rel="stylesheet">
  <link href="css/custom.css" rel="stylesheet">
  <link href="css/icheck/flat/green.css" rel="stylesheet">
  <link rel="icon" href="images/usuario16.jpg">
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
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css"/>
  <script type="text/javascript" src="Buttons/js/buttons.flash.min.js"></script>
  <script type="text/javascript" src="Buttons/js/dataTables.buttons.min.js"></script>
  <script type="text/javascript" src="Buttons/js/buttons.html5.min.js"></script>
  <script type="text/javascript" src="Buttons/js/buttons.print.min.js"></script>
</head>


<body class="nav-md">

  <div class="container body">


    <div class="main_container">

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
                    <button type='button' class="btn btn-header" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-plus"></span> Nuevo Usuario</button>
                  </div>
      <h4>Usuarios</h4>
                    </div>      
                    <div class="panel-body">
      <?php
      include("modal/registro_usuarios.php");
      include("modal/editar_usuarios.php");
      include("modal/cambiar_password.php");
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
  <script src="js/progressbar/bootstrap-progressbar.min.js"></script>
  <script src="js/nicescroll/jquery.nicescroll.min.js"></script>
  <script src="js/icheck/icheck.min.js"></script>
  <script src="js/custom.js"></script>
  <script src="js/pace/pace.min.js"></script>
  </body>
</html>
<script type="text/javascript" src="js/usuarios.js"></script>
<script>
$( "#guardar_usuario" ).submit(function( event ) {  
  $('#guardar_datos').attr("disabled", true);
  
 var parametros = $(this).serialize();
   $.ajax({
      type: "POST",
      url: "ajax/nuevo_usuario.php",
      data: parametros,
       beforeSend: function(objeto){
        $("#resultados_ajax").html("Mensaje: Cargando...");
        },
      success: function(datos){

      $("#resultados_ajax").html(datos);
      document.getElementById("guardar_usuario").reset();
      $('#guardar_datos').attr("disabled", false);
      load(1);
      }
  });
  event.preventDefault();
})

$( "#editar_usuario" ).submit(function( event ) {
  $('#actualizar_datos2').attr("disabled", true);
  


 var parametros = $(this).serialize();
   $.ajax({
      type: "POST",
      url: "ajax/editar_usuario.php",
      data: parametros,
       beforeSend: function(objeto){
        $("#resultados_ajax2").html("Mensaje: Cargando...");
        },
      success: function(datos){
      $("#resultados_ajax2").html(datos);
      $('#actualizar_datos2').attr("disabled", false);
            setTimeout(function(){ document.getElementById('divparaborrar').style.display = 'none'; }, 1000);
      load(1);
      }
  });
  event.preventDefault();
})

$( "#editar_password" ).submit(function( event ) {
  $('#actualizar_datos3').attr("disabled", true);
  
 var parametros = $(this).serialize();
   $.ajax({
      type: "POST",
      url: "ajax/editar_password.php",
      data: parametros,
       beforeSend: function(objeto){
        $("#resultados_ajax3").html("Mensaje: Cargando...");
        },
      success: function(datos){
      $("#resultados_ajax3").html(datos);
      document.getElementById("editar_password").reset();
      $('#actualizar_datos3').attr("disabled", false);
      load(1);
      }
  });
  event.preventDefault();
})
  function get_user_id(id){
    $("#user_id_mod").val(id);
  }

  function obtener_datos(id){
      var nombres = $("#nombres"+id).val();
      var apellidos = $("#apellidos"+id).val();
      var usuario = $("#usuario"+id).val();
                        var email = $("#email"+id).val();
                        var dni = $("#dni"+id).val();
                        var dom = $("#dom"+id).val();
                        var tel = $("#tel"+id).val();
                        var hora = $("#hora"+id).val();
                        var sucursal = $("#sucursal"+id).val();
                  $("#mod_id").val(id);
      $("#firstname2").val(nombres);
      $("#lastname2").val(apellidos);
      $("#user_name2").val(usuario);
      $("#user_email2").val(email);
                         $("#mod_dni").val(dni);
                        $("#dom").val(dom);
                        $("#tel").val(tel);
                        $("#hora").val(hora);
                        $("#mod_sucursal").val(sucursal);
    }
</script>


































