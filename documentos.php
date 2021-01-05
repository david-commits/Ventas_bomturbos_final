<?php
session_start();
include('menu.php');
require_once("config/db.php"); //Contiene las variables de configuracion para conectar a la base de datos
require_once("config/conexion.php"); //Contiene funcion que conecta a la base de datos
$consulta1 = "SELECT * FROM clientes ";
$result1 = mysqli_query($con, $consulta1);
$sql1 = "select * from users where user_id=$_SESSION[user_id]";
$rw1 = mysqli_query($con, $sql1); //recuperando el registro
$rs1 = mysqli_fetch_array($rw1); //trasformar el registro en un vector asociativo
$modulo = $rs1["accesos"];
$a = explode(".", $modulo);
if (!isset($_SESSION['user_login_status']) and $_SESSION['user_login_status'] != 1) {
  header("location: login.php");
  exit;
}
if ($a[19] == 0) {
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
  <link href="css/datatables/tools/css/dataTables.tableTools.css" rel="stylesheet">
  <link href="css/select/select2.min.css" rel="stylesheet">
  <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
  <script>
    function limpiarFormulario() {
      document.getElementById("guardar_producto").reset();
    }
    var mostrarValor = function(x) {
      document.getElementById('precio').value = x;
    }
    var mostrarValor2 = function(x) {
      document.getElementById('precio').value = x;
    }
  </script>
  <SCRIPT LANGUAGE="JavaScript" SRC="calendar.js"></SCRIPT>
  <!-- *<style type="text/css">
    .fijo {
      background: #333;
      color: white;
      height: 10px;

      width: 100%;
      /* hacemos que la cabecera ocupe el ancho completo de la página */
      left: 0;
      /* Posicionamos la cabecera al lado izquierdo */
      top: 0;
      /* Posicionamos la cabecera pegada arriba */
      position: fixed;
      Hacemos que la cabecera tenga una posición fija 
    }
  </style> -->
  <!--[if lt IE 9]>
        <script src="../assets/js/ie8-responsive-file-warning.js"></script>
        <![endif]-->

  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
  <link href="https://fonts.googleapis.com/css?family=Quicksand:300,400,500,600,700&display=swap" rel="stylesheet">
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

          <br />
        </div>
      </div>
      <?php
      menu3();
      ?>

      <div class="right_col" role="main">
      <div class="container">

          <div class="panel panel-info contorno-para-divs">

            <div class="panel-heading" style="margin-bottom: 20px;">
              <h2>Datos de documentos:</h2>
            </div>

        <?php

        print "<form name=\"myForm\" class=\"form-horizontal form-label-left\"  enctype=\"multipart/form-data\" action=\"documentos1.php\" method=\"POST\">";
        $tien = "tienda" . $_SESSION['tienda'];
        $fol = "folio" . $_SESSION['tienda'];
        $consulta3 = "SELECT * FROM documento ";
        $result3 = mysqli_query($con, $consulta3);
        while ($valor3 = mysqli_fetch_array($result3, MYSQLI_ASSOC)) {
          if ($valor3['id_documento'] == 1) {
            $factura = $valor3["$tien"];
            $folio1 = $valor3["$fol"];
          }
          if ($valor3['id_documento'] == 2) {
            $boleta = $valor3["$tien"];
            $folio2 = $valor3["$fol"];
          }
          if ($valor3['id_documento'] == 3) {
            $guia = $valor3["$tien"];
          }
          if ($valor3['id_documento'] == 4) {
            $remision = $valor3["$tien"];
          }

          if ($valor3['id_documento'] == 5) {
            $nota_debito = $valor3["$tien"];
            $folio3 = $valor3["$fol"];
          }
          if ($valor3['id_documento'] == 6) {
            $nota_credito = $valor3["$tien"];
            $folio4 = $valor3["$fol"];
          }
        }
        ?>
        
          

          <div class="form-group">
            <label for="producto" class="col-sm-3 control-label">Número de Factura:</label>
            <div class="col-sm-4">
              <input type="text" class="form-control estilo-placeholder input-sm" name="folio1" id="folio1" value="<?php echo $folio1; ?>" placeholder="Folio">
            </div>

            <div class="col-sm-4">
              <input type="text" class="form-control estilo-placeholder input-sm" name="factura" id="factura" value="<?php echo $factura; ?>" placeholder="Número de Factura">

            </div>
          </div>

          <div class="form-group">
            <label for="inventario" class="col-sm-3 control-label">Número de Boleta:</label>
            <div class="col-sm-4">
              <input type="text" class="form-control estilo-placeholder input-sm" name="folio2" id="folio2" value="<?php echo $folio2; ?>" placeholder="Folio">

            </div>

            <div class="col-sm-4">
              <input type="text" class="form-control estilo-placeholder input-sm" id="boleta" name="boleta" value="<?php echo $boleta; ?>" placeholder="Número de Boleta">
            </div>
          </div>

          <div class="form-group">
            <label for="inventario" class="col-sm-3 control-label">Número de Nota Debito:</label>
            <div class="col-sm-4">
              <input type="text" class="form-control estilo-placeholder input-sm" name="folio3" id="folio3" value="<?php echo $folio3; ?>" placeholder="Folio">

            </div>

            <div class="col-sm-4">
              <input type="text" class="form-control estilo-placeholder input-sm" id="nota_debito" name="nota_debito" value="<?php echo $nota_debito; ?>" placeholder="Número de Nota de Debito">
            </div>
          </div>

          <div class="form-group">
            <label for="inventario" class="col-sm-3 control-label">Número de Nota Crédito:</label>
            <div class="col-sm-4">
              <input type="text" class="form-control estilo-placeholder input-sm" name="folio4" id="folio4" value="<?php echo $folio4; ?>" placeholder="Folio">

            </div>

            <div class="col-sm-4">
              <input type="text" class="form-control estilo-placeholder input-sm" id="nota_credito" name="nota_credito" value="<?php echo $nota_credito; ?>" placeholder="Número de Nota de Crédito">
            </div>
          </div>

          <div class="form-group">
            <label for="precio" class="col-sm-3 control-label">Numero de Guia:</label>
            <div class="col-sm-8">

              <input type="text" class="form-control estilo-placeholder input-sm" id="guia" name="guia" value="<?php echo $guia; ?>" placeholder="Número de Guía">
            </div>
          </div>

          <div class="form-group">
            <label for="precio" class="col-sm-3 control-label">Guia de Remision:</label>
            <div class="col-sm-8">

              <input type="text" class="form-control estilo-placeholder input-sm" id="remision" name="remision" value="<?php echo $remision; ?>" placeholder="Número de Guía">
            </div>
          </div>

          <?php
          $tienda = $_SESSION['tienda'];
          ?>

          <div class="form-group pull-right" style="padding-right: 15px">
              <button type="submit" class="btn btn-agregar btn-margin" name="aceptar">Aceptar</button>
          </div>

          
          </form>
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


  <!-- Datatables -->
  <script src="js/datatables/js/jquery.dataTables.js"></script>
  <script src="js/datatables/tools/js/dataTables.tableTools.js"></script>
  <script type="text/javascript" src="js/facturas.js"></script>
  <script type="text/javascript" src="js/VentanaCentrada.js"></script>
  <!-- pace -->
  <script src="js/pace/pace.min.js"></script>
  <script>
    $(document).ready(function() {
      $('input.tableflat').iCheck({
        checkboxClass: 'icheckbox_flat-green',
        radioClass: 'iradio_flat-green'
      });
    });

    var asInitVals = new Array();
    $(document).ready(function() {
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
        if (this.value == "") {
          this.className = "search_init";
          this.value = asInitVals[$("tfoot input").index(this)];
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

      var data = [
        <?php
        for ($i = 0; $i < count($producto); $i++) {
        ?> '<?php echo $producto[$i]; ?>',
        <?php } ?>
      ];



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


    $("#nuevoProducto1").submit(function(event) {
      $('#actualizar_datos').attr("disabled", true);

      var parametros = $(this).serialize();
      $.ajax({
        type: "POST",
        url: "registro_productos.php",
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
      var descripcion = $("#descripcion" + id).val();
      var equipo = $("#equipo" + id).val();
      var com_ser = $("#com_ser" + id).val();
      var des_ser = $("#des_ser" + id).val();


      $("#mod_descripcion").val(descripcion);
      $("#mod_equipo").val(equipo);
      $("#mod_com_ser").val(com_ser);
      $("#mod_des_ser").val(des_ser);
      $("#mod_id").val(id);

    }

    function imprimir_factura(id_factura) {
      VentanaCentrada('./pdf/documentos/ver_factura.php?id_factura=' + id_factura, 'Factura', '', '1024', '768', 'true');
    }
  </script>


  <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">

  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>



  <script>
    $(function() {
      $("#nombre_producto").autocomplete({
        source: "./ajax/autocomplete/productos.php",
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

    $("#nombre_producto").on("keydown", function(event) {
      if (event.keyCode == $.ui.keyCode.LEFT || event.keyCode == $.ui.keyCode.RIGHT || event.keyCode == $.ui.keyCode.UP || event.keyCode == $.ui.keyCode.DOWN || event.keyCode == $.ui.keyCode.DELETE || event.keyCode == $.ui.keyCode.BACKSPACE) {
        $("#id_producto").val("");
        $("#inv_producto").val("");
        $("#precio_producto").val("");

      }
      if (event.keyCode == $.ui.keyCode.DELETE) {
        $("#nombre_producto").val("");
        $("#id_producto").val("");
        $("#inv_producto").val("");
        $("#precio_producto").val("");
      }
    });
  </script>




</body>

</html>