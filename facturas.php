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
if ($a[22] == 0) {
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
  <!-- Bootstrap core CSS -->
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
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css" />
  <script type="text/javascript" src="Buttons/js/buttons.html5.min.js"></script>
  <script type="text/javascript" src="Buttons/js/buttons.print.min.js"></script>
  <script>
    $(document).ready(function() {
      $('[data-toggle="tooltip"]').tooltip();
    });
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

      <!-- top navigation -->
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
                    <a href="nueva_factura.php" class="btn btn-header"><span class="glyphicon glyphicon-plus"></span> Nuevo Doc</a>
                  </div>
                  <h4>Lista de Ventas</h4>
                </div>

                <div class="panel-body">
                  <form class="form-horizontal" role="form" id="datos_cotizacion">

                    <div class="form-group row">
                      <label for="q" class="col-md-4 control-label">Buscar Cliente o Número de Documento</label>
                      <div class="col-md-7">
                        <input type="text" class="form-control estilo-placeholder input-sm" id="q" placeholder="Buscar Cliente o Número de Documento" onkeyup='load(1);'>
                      </div>



                      <!-- <div class="col-md-2">
                        <button type="button" class="btn btn-guardar" onclick='load(1);'>Buscar</button>
                        <span id="loader"></span>
                      </div> -->

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
  <script src="js/progressbar/bootstrap-progressbar.min.js"></script>
  <script src="js/nicescroll/jquery.nicescroll.min.js"></script>

  <script src="js/icheck/icheck.min.js"></script>
  <script src="js/custom.js"></script>
  <script src="js/pace/pace.min.js"></script>
  <script type="text/javascript" src="js/usuarios.js"></script>
  <script type="text/javascript" src="js/VentanaCentrada.js"></script>
  <script type="text/javascript" src="js/facturas.js"></script>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>

  <script>
    $(function() {
      $("#q").autocomplete({
        source: "./ajax/autocomplete/clientes.php",
        minLength: 1,
        select: function(event, ui) {
          event.preventDefault();
          $('#id_cliente').val(ui.item.id_cliente);
          $('#q').val(ui.item.nombre_cliente);
          $('#tel1').val(ui.item.telefono_cliente);
          $('#mail').val(ui.item.email_cliente);


        }
      });


    });

    $("#q").on("keydown", function(event) {
      if (event.keyCode == $.ui.keyCode.LEFT || event.keyCode == $.ui.keyCode.RIGHT || event.keyCode == $.ui.keyCode.UP || event.keyCode == $.ui.keyCode.DOWN || event.keyCode == $.ui.keyCode.DELETE || event.keyCode == $.ui.keyCode.BACKSPACE) {
        $("#id_cliente").val("");
        $("#tel1").val("");
        $("#mail").val("");

      }
      if (event.keyCode == $.ui.keyCode.DELETE) {
        $("#q").val("");
        $("#id_cliente").val("");
        $("#tel1").val("");
        $("#mail").val("");
      }
    });
  </script>

</body>

</html>