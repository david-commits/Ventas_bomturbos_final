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
$sql2 = "select * from sucursal ORDER BY  `sucursal`.`tienda` DESC ";
$rw2 = mysqli_query($con, $sql2); //recuperando el registro
$rs2 = mysqli_fetch_array($rw2); //trasformar el registro en un vector asociativo
$tienda1 = $rs2["tienda"];
$a = explode(".", $modulo);
if (!isset($_SESSION['user_login_status']) and $_SESSION['user_login_status'] != 1) {
  header("location: login.php");
  exit;
}
if ($a[27] == 0) {
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
  <script src="js/jquery.min.js"></script>
  <SCRIPT LANGUAGE="JavaScript" SRC="calendar.js"></SCRIPT>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>
  <link rel="stylesheet" type="text/css" href="Buttons/css/buttons.dataTables.min.css" />
  <script type="text/javascript" src="DataTables/datatables.min.js"></script>
  <script type="text/javascript" src="Buttons/js/buttons.flash.min.js"></script>
  <script type="text/javascript" src="Buttons/js/dataTables.buttons.min.js"></script>
  <script type="text/javascript" src="Buttons/js/buttons.html5.min.js"></script>
  <script type="text/javascript" src="Buttons/js/buttons.print.min.js"></script>
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

          <!-- menu prile quick info -->
          <?php
          menu2();

          menu1();

          ?>
          <!-- /menu prile quick info -->


        </div>
      </div>


      <?php
      menu3();

      ?>


      <div class="right_col" role="main">
        <?php


        $consulta2 = "SELECT * FROM consultas ";
        $result2 = mysqli_query($con, $consulta2);

        $d = 0;
        $cliente = "";

        $fecha1 = "";
        $fecha2 = "";
        $tienda = 0;
        while ($valor1 = mysqli_fetch_array($result2, MYSQLI_ASSOC)) {



          if ($valor1['tipo'] == 10) {
            $d = $valor1['id'];
            $cliente = $valor1['a1'];
            //$nom_pro=trim($nom_pro1);
            $fecha1 = $valor1['a2'];

            $fecha2 = $valor1['a3'];
            $tiend = $valor1['a4'];
            if ($tiend == 7) {
              $tienda1 = 1;
              $tienda2 = $tienda1;
            } else {
              $tienda1 = $tiend;
              $tienda2 = $tiend;
            }

            if ($fecha1 <> "") {
              $d1 = explode("-", $fecha1);
              $dia1 = $d1[0];
              $mes1 = $d1[1];
              $ano1 = $d1[2];
            }
            $dd1 = $ano1 . "-" . $mes1 . "-" . $dia1;
            if ($fecha2 <> "") {
              $d2 = explode("-", $fecha2);
              $dia2 = $d2[0];
              $mes2 = $d2[1];
              $ano2 = $d2[2];
              $dd2 = $ano2 . "-" . $mes2 . "-" . $dia2;
            }
          }
        }

        ?>
        <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="container">




              <div class="panel panel-info">

                <div class="panel-heading">
                  <h4>Buscar Cobros por Cliente:</h4>
                </div>

                <br><br>

                <form name="myForm" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" method="POST" action="cobrosclientes1.php">

                  <div class="form-group">
                    <label class="col-sm-3 control-label">Nombre del Cliente:</label>
                    <div class="col-md-8 col-sm-8 col-xs-12">
                        <input placeholder="Nombre del Cliente" type="text" value="<?php echo $cliente; ?>" name="cliente" id="autocomplete-custom-append" data-validate-length-range="4" class="form-control estilo-placeholder"/>
                        <div id="autocomplete-container"> <!-- style="position: relative; float: left; width: 400px; margin: 3px;" -->
                        </div>
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="col-sm-3 control-label">Fecha Inicial:</label>
                    <div class="col-md-8 col-sm-8 col-xs-12">
                      <input name="fecha1" data-validate-length-range="4" type="date" class="form-control estilo-placeholder input-fechas-horas-3"  id="fecha1" value="<?php echo $fecha1; ?>" required>
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="col-sm-3 control-label">Fecha Final:</label>
                    <div class="col-md-8 col-sm-8 col-xs-12">
                      <input name="fecha2" data-validate-length-range="4" type="date" class="form-control estilo-placeholder input-fechas-horas-3"  id="fecha2" value="<?php echo $fecha2; ?>" required>
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="col-sm-3 control-label">Almacen:</label>
                    <div class="col-md-8 col-sm-8 col-xs-12">
                      <select class="form-control estilo-placeholder" name="tienda" required="required" tabindex="-1">
                        <?php
                        if ($tiend > 0) {
                          if ($tiend == 4) {
                            $t = "Todas";
                          } else {
                            $t = "Sucursal $tiend";
                          }
                        ?>
                          <option class="custom-select" value="<?php echo $tiend; ?>"><?php echo $t; ?></option>
                        <?php
                        } else {
                        ?>
                          <option class="custom-select" value="0">Escoger</option>
                        <?php
                        }
                        for ($i = 1; $i <= $tienda1; $i++) {
                        ?>
                          <option class="custom-select" value="<?php echo $i; ?>">Sucursal <?php echo $i; ?></option>
                        <?php
                        }
                        ?>
                        <option class="custom-select" value="7">Todas</option>
                      </select>
                      <br>
                      <br>
                    </div>
                  </div>

                  <input type="hidden" name="d" value="1">

                  <div class="text-right mr-4">
                    <button id="send" type="submit" name="enviar" class="btn btn-guardar btn-margin">Buscar</button>
                  </div>

                </form>

              </div>



            </div>
          </div>
        </div>

        <div class="row">



          <?php


          $total1 = 0;
          $total2 = 0;
          if ($d == 0) {
            //$sql="select * from products ORDER BY  `products`.`id_producto` DESC LIMIT 0 , 100";
            $sql = "";
          } else {
          ?>
            <?php

            $host = $_SERVER["HTTP_HOST"];
            $url = $_SERVER["REQUEST_URI"];
            $aa = "http://" . $host . $url;

            ?>


            <div class="table-responsive">

              <table id="example" class="table display nowrap">
                <thead>
                  <tr>
                    <th>Nro </th>
                    <th>Cliente </th>
                    <th>Fecha </th>
                    <th>Nro doc </th>
                    <th>Tipo </th>
                    <th>Venta </th>
                    <th>Deuda </th>
                    <th>Deuda Anterior </th>
                    <th>Pago </th>
                    <th>Nro Doc<br> Pago </th>
                    <th>Tipo Doc<br> Pago </th>
                    <th>Tipo de<br> Pago </th>
                    <th>Operacion <br> Y Banco: </th>

                    <th>Registrado </th>

                  </tr>
                </thead>

                <tbody>
                  <?php
                  $deuda1 = 0;
                  $sql = "select * from facturas, clientes, users where facturas.id_cliente=clientes.id_cliente and facturas.id_vendedor=users.user_id and facturas.activo=1 and (facturas.ven_com=3 or (facturas.deuda_total>0 and facturas.ven_com=1)) ORDER BY  `facturas`.`id_factura` ASC ";

                  $s = 1;
                  $rs = mysqli_query($con, $sql);

                  while ($row = mysqli_fetch_array($rs)) {

                    $id_factura = $row['id_factura'];
                    $deuda_anterior = $row['servicio'];
                    $deuda = $row['deuda_total'];
                    $fecha3 = $row['fecha_factura'];
                    $d3 = explode("-", $fecha3);
                    $dia = date("d", strtotime($fecha3));
                    $mes = date("m", strtotime($fecha3));
                    $ano = $d3[0];
                    $dd = $ano . "-" . $mes . "-" . $dia;
                    $dd5 = $mes . "-" . $dia . "-" . $ano;
                    $fecha = strtotime($dd);
                    $fech1 = strtotime($dd1);
                    $fech2 = strtotime($dd2);
                    $nombre_cliente = $row['nombre_cliente'];
                    $condiciones = $row['condiciones'];
                    if ($condiciones == 1) {
                      $condiciones1 = "Efectivo";
                    }
                    if ($condiciones == 2) {
                      $condiciones1 = "Cheque";
                    }
                    if ($condiciones == 3) {
                      $condiciones1 = "Transferencia Bancaria";
                    }
                    if ($condiciones == 4) {
                      $condiciones1 = "Deposito";
                    }


                    $numero_factura = $row['numero_factura'];
                    $obs = $row['obs'];
                    $vendedor1 = $row['nombres'];
                    $tienda = $row['tienda'];
                    $nombre_vendedor = $row['nombres'];
                    $estado_factura = $row['estado_factura'];

                    $sql1 = "select * from comprobante_pago where id_comprobante=$estado_factura";
                    $rs1 = mysqli_query($con, $sql1);

                    $row1 = mysqli_fetch_array($rs1);
                    $tipo = $row1['des_comprobante'];

                    $moneda = $row['moneda'];
                    if ($estado_factura <> 4) {
                      $text_estado = "Pagada";
                      $label_class = '';
                    } else {
                      $text_estado = "Pendiente";
                      $label_class = '';
                    }

                    $total_venta = $row['total_venta'];
                    if ($cliente == $nombre_cliente  && $fecha >= $fech1 && $fecha <= $fech2 && $tienda >= $tienda1 && $tienda <= $tienda2) {
                      if ($moneda == 1) {
                        $total1 = $total1 + $total_venta;
                        $mon = "S/.";
                      }
                      if ($moneda > 1) {
                        $total2 = $total2 + $total_venta;
                        $mon = "USD";
                      }
                      $deuda1 = $row['deuda'];
                      if ($deuda > 0) {
                  ?>

                        <tr id="valor1">

                          <td class=" "><?php echo $s; ?></td>
                          <td class=" "><?php echo $nombre_cliente; ?></td>
                          <td class=" "><?php print "$fecha3"; ?></td>
                          <td class=" "><?php echo $numero_factura; ?></td>
                          <td class=" "><?php echo $tipo; ?></td>
                          <td class=" "><?php print "$mon ";
                                        echo $total_venta; ?></td>
                          <td class=" "><?php print "$mon ";
                                        echo $deuda; ?></td>
                          <td class=" "></td>
                          <td class=" "></td>
                          <td class=" "></td>
                          <td class=" "></td>
                          <td class=" "></td>
                          <td class=" "></td>
                          <td class=" "><?php echo $nombre_vendedor; ?></td>

                        </tr>
                      <?php
                        $s = $s + 1;
                      } else {
                      ?>

                        <tr id="valor1">

                          <td class=" "><?php echo $s; ?></td>
                          <td class=" "><?php echo $nombre_cliente; ?></td>
                          <td class=" "><?php print "$fecha3"; ?></td>
                          <td class=" "></td>
                          <td class=" "></td>
                          <td class=" "></td>
                          <td class=" "></td>
                          <td class=" "><?php print "$mon ";
                                        echo $deuda_anterior; ?></td>
                          <td class=" "><?php print "$mon ";
                                        echo $total_venta; ?></td>
                          <td class=" "><?php echo $numero_factura; ?></td>
                          <td class=" "><?php echo $tipo; ?></td>
                          <td class=" "><?php echo $condiciones1; ?></td>
                          <td class=" "><?php echo $obs; ?></td>
                          <td class=" "><?php echo $nombre_vendedor; ?></td>


                        </tr>
                  <?php
                        $s = $s + 1;
                      }
                    }
                  }
                  ?>




                </tbody>
                <?php

                if ($_SESSION['tabla'] > 0) {


                ?>
                  <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>
                      <span class="text-warning">Deuda :</span>
                    </td>
                    <td>
                      <span class="text-danger">S/.<?php echo number_format($deuda1, 2); ?></span>
                    </td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                  </tr>
                <?php
                }
                ?>
              </table>

              </form>
            </div>


          <?php
          }
          ?>

        </div>

      </div>

      <!-- footer content -->
        <div class="p-4">
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
  </script>

  <script language="javascript">
    $(document).ready(function() {
      $(".botonExcel").click(function(event) {
        $("#datos_a_enviar").val($("<div>").append($("#example").eq(0).clone()).html());
        $("#FormularioExportacion").submit();
      });
    });
  </script>


  <script>
    $(document).ready(function() {
      $('#example').DataTable({
        language: {
          "url": "/dataTables/i18n/de_de.lang",
          "decimal": "",
          "show": "Mostrar",
          "emptyTable": "No hay informacion",
          "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
          "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
          "infoFiltered": "(Filtrado de _MAX_ total entradas)",
          "infoPostFix": "",
          "thousands": ",",
          "lengthMenu": "Mostrar _MENU_ Entradas",
          "loadingRecords": "Cargando...",
          "processing": "Procesando...",
          "search": "Buscar:",
          "zeroRecords": "Sin resultados encontrados",
          buttons: {
            copyTitle: 'Copiar filas al portapapeles',

            copySuccess: {
              _: 'Copiado %d fias ',
              1: 'Copiado 1 fila'
            },

            pageLength: {
              _: "Mostrar %d filas",
              '-1': "Mostrar Todo"
            }
          },
          "paginate": {
            "first": "Primero",
            "last": "Ultimo",
            "next": "Siguiente",
            "previous": "Anterior"
          }




        },
        bDestroy: true,
        dom: 'Bfrtip',
        lengthMenu: [
          [10, 25, 50, -1],
          ['10 filas', '25 filas', '50 filas', 'Mostrar todo']
        ],
        buttons:


          [

            {
              extend: 'pageLength',
              text: 'Mostrar filas',
              className: 'orange'
            },

            {
              extend: 'copy',
              text: 'COPIAR',
              className: 'red'
            },



            {
              extend: 'excel',
              text: 'EXCEL',
              className: 'green'
            },
            {
              extend: 'csv',
              text: 'CSV',
              className: 'green1'
            },
            {
              extend: 'print',
              text: 'IMPRIMIR',
              className: 'green2'
            }
          ],


      });
    });
  </script>


</body>

</html>