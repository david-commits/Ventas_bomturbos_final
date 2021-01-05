<?php
session_start();
include('menu.php');
require_once("config/db.php"); //Contiene las variables de configuracion para conectar a la base de datos
require_once("config/conexion.php"); //Contiene funcion que conecta a la base de datos        
$sql1 = "select * from users where user_id=$_SESSION[user_id]";
$rw1 = mysqli_query($con, $sql1); //recuperando el registro
$rs1 = mysqli_fetch_array($rw1); //trasformar el registro en un vector asociativo
$aa = 0;
$bb = 0;
if (isset($_GET['fecha1']) && isset($_GET['fecha2'])) {
  $_SESSION['asistencia1'] = $_GET['fecha1'];
  $_SESSION['asistencia2'] = $_GET['fecha2'];
  $aa = $_GET['fecha1'];
  $bb = $_GET['fecha2'];
}
if (isset($_SESSION['asistencia1']) && isset($_SESSION['asistencia2'])) {
  $aa = $_SESSION['asistencia1'];
  $bb = $_SESSION['asistencia2'];
}
$modulo = $rs1["accesos"];
$a = explode(".", $modulo);
if (!isset($_SESSION['user_login_status']) and $_SESSION['user_login_status'] != 1) {
  header("location: login.php");
  exit;
}
if ($a[6] == 0) {
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
  <!-- Custom styling plus plugins -->
  <link href="css/custom.css" rel="stylesheet">
  <link href="css/icheck/flat/green.css" rel="stylesheet">
  <script src="js/jquery.min.js"></script>
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

      <!-- top navigation -->
      <?php
      menu3();

      ?>
      <!-- /top navigation -->

      <!-- page content -->
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
                  <h4>Buscar Asistencia entre dos fechas:</h4>
                  <div class="btn-encuadrado pull-right">
                    <button type='button' class="btn btn-header" data-toggle="modal" data-target="#nuevoProducto"><span class="glyphicon glyphicon-plus"></span> Registrar Asistencia</button>
                  </div>
                  <form action="asistencia.php" method="GET">
                    <input class="estilo-placeholder-date" type="date" name="fecha1" value="<?php echo $aa; ?>">
                    <input class="estilo-placeholder-date" type="date" name="fecha2" value="<?php echo $bb; ?>">
                    <input type="submit" class='btn btn-guardar btn-sm' value="Buscar">
                  </form>
                </div>

                <div class="panel-body">
                  <?php

                  include("modal/registro_asistencia.php");
                  include("modal/editar_asistencia.php");


                  ?>
                  <form class="form-horizontal" role="form" id="datos_cotizacion">

                    <div class="form-group row">
                      <label for="q" class="col-md-2 control-label">Buscar Nombre:</label>
                      <div class="col-md-5">
                        <input type="text" class="form-control estilo-placeholder" id="q" placeholder="Nombre" onkeyup='load(1);'>
                      </div>
                      <div class="col-md-3">
                        <button type="button" class="btn btn-guardar" onclick='load(1);'>
                          <span class="glyphicon glyphicon-search"></span> Buscar</button>
                        <span id="loader"></span>
                      </div>

                    </div>

                  </form>
                  <div id="resultados"></div><!-- Carga los datos ajax -->
                  <div class='outer_div'></div><!-- Carga los datos ajax -->



                </div>
              </div>

            </div>
          </div>
        </div>

        <!-- footer content -->
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
    $(document).ready(function() {
      load(1);
    });

    function load(page) {
      var q = $("#q").val();
      $("#loader").fadeIn('slow');
      $.ajax({
        url: './ajax/buscar_asistencia.php?action=ajax&page=' + page + '&q=' + q,
        beforeSend: function(objeto) {
          $('#loader').html('<img src="./img/ajax-loader.gif"> Cargando...');
        },
        success: function(data) {
          $(".outer_div").html(data).fadeIn('slow');
          $('#loader').html('');

        }
      })
    }



    function eliminar(id) {
      var q = $("#q").val();
      if (confirm("Realmente deseas eliminar la asistencia")) {
        $.ajax({
          type: "GET",
          url: "./ajax/buscar_asistencia.php",
          data: "id=" + id,
          "q": q,
          beforeSend: function(objeto) {
            $("#resultados").html("Mensaje: Cargando...");
          },
          success: function(datos) {
            $("#resultados").html(datos);
            load(1);
          }
        });
      }
    }



    $("#guardar_asistencia").submit(function(event) {
      $('#guardar_datos').attr("disabled", true);

      var parametros = $(this).serialize();
      $.ajax({
        type: "POST",
        url: "ajax/nuevo_asistencia.php",
        data: parametros,
        beforeSend: function(objeto) {
          $("#resultados_ajax").html("Mensaje: Cargando...");
        },
        success: function(datos) {
          $("#resultados_ajax").html(datos);
          $('#guardar_datos').attr("disabled", false);
          load(1);
        }
      });
      event.preventDefault();
    })

    $("#editar_asistencia").submit(function(event) {
      $('#actualizar_datos').attr("disabled", true);

      var parametros = $(this).serialize();
      $.ajax({
        type: "POST",
        url: "ajax/editar_asistencia.php",
        data: parametros,
        beforeSend: function(objeto) {
          $("#resultados_ajax2").html("Mensaje: Cargando...");
        },
        success: function(datos) {
          $("#resultados_ajax2").html(datos);
          $('#actualizar_datos').attr("disabled", false);
          load(1);
        }
      });
      event.preventDefault();
    })


    function obtener_datos(id) {
      var nom_cat = $("#nom_cat" + id).val();
      var des_cat = $("#des_cat" + id).val();
      $("#mod_cat").val(nom_cat);
      $("#mod_des").val(des_cat);
      $("#mod_id").val(id);

    }
  </script>


</body>

</HTML>