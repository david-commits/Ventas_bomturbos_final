<?php
session_start();
include('menu.php');
require_once("config/db.php"); //Contiene las variables de configuracion para conectar a la base de datos
require_once("config/conexion.php"); //Contiene funcion que conecta a la base de datos
$sql1 = "select * from users where user_id=$_SESSION[user_id]";
$rw1 = mysqli_query($con, $sql1); //recuperando el registro
$rs1 = mysqli_fetch_array($rw1); //trasformar el registro en un vector asociativo
$modulo = $rs1["accesos"];
$a = explode(".", $modulo);
if (!isset($_SESSION['user_login_status']) and $_SESSION['user_login_status'] != 1) {
  header("location: login.php");
  exit;
}
if ($a[2] == 0) {
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
11
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
                    <button type='button' class="btn btn-header" data-toggle="modal" data-target="#nuevoProducto"><span class="glyphicon glyphicon-plus"></span> Nueva Sucursal</button>
                  </div>
                  <h4><i class='glyphicon glyphicon-search'></i>Buscar Sucursal</h4>
                </div>
                <div class="panel-body">
                  <?php

                  include("modal/registro_sucursal.php");
                  include("modal/editar_sucursal.php");

                  ?>
                  <form class="form-horizontal" role="form" id="datos_cotizacion">

                   <div class="form-group row">
                      <label for="q" class="col-md-1 control-label">Sucursal</label>
                      <div class="col-md-7">
                        <input type="text" class="form-control estilo-placeholder" id="q" placeholder="Nombre de la sucursal" onkeyup='load(1);'>
                      </div>
                      <div class="col-md-4">
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
    $(document).ready(function() {
      load(1);
    });

    function load(page) {
      var q = $("#q").val();
      $("#loader").fadeIn('slow');
      $.ajax({
        url: './ajax/buscar_sucursal.php?action=ajax&page=' + page + '&q=' + q,
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
      if (confirm("Realmente deseas eliminar la categoria")) {
        $.ajax({
          type: "GET",
          url: "./ajax/buscar_sucursal.php",
          data: "id=" + id,
          "q": q,
          beforeSend: function(objeto) {
            $("#resultados").html("Mensaje: Cargando...");
          },
          success: function(datos) {
            $("#resultados").html(datos);
            setTimeout(function(){   
    $("#resultados").html('');
        }, 1500);
            load(1);
          }
        });
      }
    }



    $("#guardar_sucursal").submit(function(event) {
      $('#guardar_datos').attr("disabled", true);

      var parametros = $(this).serialize();
      $.ajax({
        type: "POST",
        url: "ajax/nuevo_sucursal.php",
        data: parametros,
        beforeSend: function(objeto) {
          $("#resultados_ajax").html("Mensaje: Cargando...");
        },
        success: function(datos) {
          $("#resultados_ajax").html(datos);
          $('#guardar_datos').attr("disabled", false);

          limpiarFormulario();
      setTimeout(function(){ document.getElementById('alertaborrarsucursal').style.display = 'none'; }, 1500);
          load(1);
        }
      });
      event.preventDefault();
    })

    $("#editar_sucursal").submit(function(event) {
      $('#actualizar_datos').attr("disabled", true);

      var parametros = $(this).serialize();
      $.ajax({
        type: "POST",
        url: "ajax/editar_sucursal.php",
        data: parametros,
        beforeSend: function(objeto) {
          $("#resultados_ajax2").html("Mensaje: Cargando...");
        },
        success: function(datos) {
          $("#resultados_ajax2").html(datos);
          $('#actualizar_datos').attr("disabled", false);
      setTimeout(function(){ document.getElementById('eliminaranunciosucursal').style.display = 'none'; }, 1500);

          load(1);
        }
      });
      event.preventDefault();
    })


    function obtener_datos(id) {
      var nombre = $("#nombre" + id).val();
      var ruc = $("#ruc" + id).val();
      var direccion = $("#direccion" + id).val();
      var correo = $("#correo" + id).val();
      var telefono = $("#telefono" + id).val();

      $("#mod_nombre").val(nombre);
      $("#mod_ruc").val(ruc);
      $("#mod_direccion").val(direccion);
      $("#mod_correo").val(correo);
      $("#mod_telefono").val(telefono);
      $("#mod_id").val(id);

    }
  </script>

</body>

</html>