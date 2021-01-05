<?php
session_start();
include('menu.php');
require_once("config/db.php"); //Contiene las variables de configuracion para conectar a la base de datos
require_once("config/conexion.php"); //Contiene funcion que conecta a la base de datos

$sql1 = "select * from users where user_id=$_SESSION[user_id]";
$rw1 = mysqli_query($con, $sql1); //recuperando el registro
$rs1 = mysqli_fetch_array($rw1); //trasformar el registro en un vector asociativo

$modulo = $rs1["accesos"];
$sql2 = "select * from sucursal ORDER BY  tienda DESC ";
$rw2 = mysqli_query($con, $sql2); //recuperando el registro
$rs2 = mysqli_fetch_array($rw2); //trasformar el registro en un vector asociativo
$tienda = $rs2["tienda"];
$a = explode(".", $modulo);
if (!isset($_SESSION['user_login_status']) and $_SESSION['user_login_status'] != 1) {
  header("location: login.php");
  exit;
}
if ($a[1] == 0) {
  header("location:error.php");
}


$usuario = recoge1('usuario');
$mensaje = recoge1('mensaje');

?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Sistema de Ventas</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="fonts/css/font-awesome.min.css" rel="stylesheet">
  <link href="css/animate.min.css" rel="stylesheet">
  <!-- Custom styling plus plugins -->
  <link href="css/custom.css" rel="stylesheet">
  <link href="css/icheck/flat/green.css" rel="stylesheet">
  <link href="css/datatables/tools/css/dataTables.tableTools.css" rel="stylesheet">
  <link href="css/select/select2.min.css" rel="stylesheet">
  <script src="js/jquery.min.js"></script>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css" />
  <link href="https://fonts.googleapis.com/css?family=Quicksand:300,400,500,600,700&display=swap" rel="stylesheet">
  <link rel="icon" href="images/usuario16.jpg">

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

          <br />

        </div>
      </div>


      <?php
      menu3();

      ?>

      <div class="right_col" role="main">


        <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12">
            
            <div class="contorno-para-divs-sin-altura">

              <div class="panel panel-info">
                  <div class="panel-heading"><h4>Accesos a Usuarios:</h4></div>
              </div>

              <form name="myForm" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" method="POST" action="acceso.php">

              <div class="form-group">
                <div class="col-md-12 col-sm-12 col-xs-12">
                  <label class="col-sm-3 control-label">Buscar Usuario:</label>
                  <div class="col-md-8 col-sm-8 col-xs-12">
                    <select class="select2_single form-control estilo-placeholder" tabindex="-1" id="usuario" name="usuario" required="required">
                      <option class="custom-select" value="">-- Selecciona Usuario --</option>



                      <?php

                      if ($usuario <> "") {
                      ?>
                        <option class="custom-select" selected value="<?php echo $usuario; ?>"><?php echo $usuario; ?></option>
                      <?php
                      }




                      $sql2 = "select * from users WHERE estado=1 ORDER BY  `users`.`nombres` ASC ";

                      $rs1 = mysqli_query($con, $sql2);
                      while ($row3 = mysqli_fetch_array($rs1)) {

                        $nombres = $row3["nombres"];
                        $user_id = $row3["user_id"];

                      ?>

                        <option class="custom-select" value="<?php echo $nombres; ?>"><?php echo $nombres; ?> </option>

                      <?php


                      }
                      ?>
                    </select>
                  </div>
                </div>
              </div>

                <input type="hidden" name="d" value="1">

                <div class="pull-right">
                  <button id="send" type="submit" name="enviar" class="btn btn-limpiar btn-margin">Buscar</button>
                </div>

              </form>


            </div>
          </div>
        </div>

        <div class="row">
          <?php

          function checked($valor)
          {
            if ($valor == 1) {
              return "checked";
            } else {
              return "";
            }
          }



          if ($usuario <> "") {

            $sql2 = "select * from users WHERE nombres='$usuario'";

            $rs1 = mysqli_query($con, $sql2);
            while ($row3 = mysqli_fetch_array($rs1)) {
              $accesos = $row3["accesos"];
              $a = explode(".", $accesos);
              $c1 = checked($a[0]);
              $c2 = checked($a[1]);
              $c3 = checked($a[2]);
              $c4 = checked($a[3]);
              $c5 = checked($a[4]);
              $c6 = checked($a[5]);
              $c7 = checked($a[6]);
              $c8 = checked($a[7]);
              $c9 = checked($a[8]);
              $c10 = checked($a[9]);
              $c11 = checked($a[10]);
              $c12 = checked($a[11]);
              $c13 = checked($a[12]);
              $c14 = checked($a[13]);
              $c15 = checked($a[14]);
              $c16 = checked($a[15]);
              $c17 = checked($a[16]);
              $c18 = checked($a[17]);
              $c19 = checked($a[18]);
              $c20 = checked($a[19]);
              $c21 = checked($a[20]);
              $c22 = checked($a[21]);
              $c23 = checked($a[22]);
              $c24 = checked($a[23]);
              $c25 = checked($a[24]);
              $c26 = checked($a[25]);
              $c27 = checked($a[26]);
              $c28 = checked($a[27]);
              $c29 = checked($a[28]);
              $c30 = checked($a[29]);
              $c31 = checked($a[30]);
              $c32 = checked($a[31]);
              $c33 = checked($a[32]);
              $c34 = checked($a[33]);
              $c35 = checked($a[34]);
              $c36 = checked($a[35]);
              $c37 = checked($a[36]);
              $c38 = checked($a[37]);
              $c39 = checked($a[38]);

              $c40 = checked($a[39]);
              $c41 = checked($a[40]);
              $c42 = checked($a[41]);
              $c43 = checked($a[42]);
              $c44 = checked($a[43]);
              $c45 = checked($a[44]);
              $c46 = checked($a[45]);
              $c47 = checked($a[46]);
              $c48 = checked($a[47]);
              $c49 = checked($a[48]);
            }

          ?>
            <div class="tabla-acceso-usuarios">
              <div class="table-responsive">
                <form action="accesos1.php" method="POST" name="f1">

                  <input type="hidden" name="nombres" value="<?php echo $usuario; ?>">
                  <input type="hidden" name="tienda" value="<?php echo $tienda; ?>">
                  <?php
                  if ($mensaje <> "") {
                  ?>
                    <div class="alert alert-success" role="alert">
                      <button type="button" class="close" data-dismiss="alert">&times;</button>
                      <strong> <?php echo $mensaje; ?></strong>

                    </div>
                  <?php
                  }
                  ?>

                  <div class="panel panel-info">
                    <div class="btn-group pull-right">
                        <a href="javascript:seleccionar_todo()" class="fltro-marcar-acceso btn btn-primary">Marcar Todos</a>
                        <a href="javascript:deseleccionar_todo()" class="fltro-marcar-acceso btn btn-limpiar">Marcar Ninguno</a>  
                    </div>
                    <div class="panel-heading">
                        <h4>Accesos a Usuarios:</h4>
                    </div>
                  </div>

                  <!-- en esta tabla estaba la clase "table-striped" -->
                  <table class="table responsive-utilities jambo_table bulk_action">
                    <thead>
                      <tr>
                        <th class="th-general"></th>
                        <th class="th-general column-title">Menu</th>
                        <th class="th-general column-title">Submenu</th>
                        <!-- <th class="th-general bulk-actions" colspan="7">
                          <a class="antoo" style="color:#fff; font-weight:500;">Accion masiva ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
                        </th> -->
                      </tr>
                    </thead>

                    <tbody>

                      <?php

                      if ($tienda >= 1) {
                      ?>

                        <tr class="tr-sucursal-acceso">
                          <td class="a-center ">
                            <input type="checkbox" name="a44" <?php echo $c44; ?> value="1">
                          </td>
                          <td class=" ">Sucursal</td>
                          <td class=" ">Sucursal 1</td>
                        </tr>
                      <?php
                      }


                      if ($tienda >= 2) {
                      ?>
                        <tr class="tr-sucursal-acceso">
                          <td class="a-center ">
                            <input type="checkbox" name="a45" <?php echo $c45; ?> value="1">
                          </td>
                          <td class=" ">Sucursal</td>
                          <td class=" ">Sucursal 2</td>

                        </tr>
                      <?php
                      }


                      if ($tienda >= 3) {
                      ?>
                        <tr class="tr-sucursal-acceso">
                          <td class="a-center ">
                            <input type="checkbox" name="a46" <?php echo $c46; ?> value="1">
                          </td>
                          <td class=" ">Sucursal</td>
                          <td class=" ">Sucursal 3</td>

                        </tr>
                      <?php
                      }


                      if ($tienda >= 4) {
                      ?>
                        <tr class="tr-sucursal-acceso">
                          <td class="a-center ">
                            <input type="checkbox" name="a47" <?php echo $c47; ?> value="1">
                          </td>
                          <td class=" ">Sucursal</td>
                          <td class=" ">Sucursal 4</td>
                        <?php
                      }


                      if ($tienda >= 5) {
                        ?>
                        </tr>
                        <tr class="tr-sucursal-acceso">
                          <td class="a-center ">
                            <input type="checkbox" name="a48" <?php echo $c48; ?> value="1">
                          </td>
                          <td class=" ">Sucursal</td>
                          <td class=" ">Sucursal 5</td>

                        </tr>
                      <?php
                      }


                      if ($tienda >= 6) {
                      ?>
                        <tr class="tr-sucursal-acceso">
                          <td class="a-center ">
                            <input type="checkbox" name="a49" <?php echo $c49; ?> value="1">
                          </td>
                          <td class=" ">Sucursal</td>
                          <td class=" ">Sucursal 6</td>

                        </tr>

                      <?php
                      }

                      ?>

                      <tr>
                        <td class="a-center ">
                          <input type="checkbox" name="a1" <?php echo $c1; ?> value="1">
                        </td>
                        <td class=" ">Empresa</td>
                        <td class=" ">Empresa </td>

                      </tr>

                      <tr class="even pointer">
                        <td class="a-center ">
                          <input type="checkbox" name="a2" <?php echo $c2; ?> value="1">
                        </td>
                        <td class=" ">Empresa</td>
                        <td class=" ">Resumen </td>

                      </tr>


                      <tr class="even pointer">
                        <td class="a-center ">
                          <input type="checkbox" name="a3" <?php echo $c3; ?> value="1">
                        </td>
                        <td class=" ">Empresa</td>
                        <td class=" ">Sucursales </td>

                      </tr>

                      <tr class="even pointer">
                        <td class="a-center ">
                          <input type="checkbox" name="a4" <?php echo $c4; ?> value="1">
                        </td>
                        <td class=" ">Empresa</td>
                        <td class=" ">Fotos </td>

                      </tr>

                      <tr>
                        <td class="a-center ">
                          <input type="checkbox" name="a5" <?php echo $c5; ?> value="1">
                        </td>
                        <td class=" ">Usuarios</td>
                        <td class=" ">Lista de Usuarios </td>

                      </tr>

                      <tr>
                        <td class="a-center ">
                          <input type="checkbox" name="a6" <?php echo $c6; ?> value="1">
                        </td>
                        <td class=" ">Usuarios</td>
                        <td class=" ">Variables descansos </td>

                      </tr>

                      <tr class="even pointer">
                        <td class="a-center ">
                          <input type="checkbox" name="a7" <?php echo $c7; ?> value="1">
                        </td>
                        <td class=" ">Usuarios</td>
                        <td class=" ">Lista de asistencia </td>

                      </tr>

                      <tr class="even pointer">
                        <td class="a-center ">
                          <input type="checkbox" name="a8" <?php echo $c8; ?> value="1">
                        </td>
                        <td class=" ">Usuarios</td>
                        <td class=" ">Consulta de asistencia </td>

                      </tr>

                      <tr class="even pointer">
                        <td class="a-center ">
                          <input type="checkbox" name="a9" <?php echo $c9; ?> value="1">
                        </td>
                        <td class=" ">Usuarios</td>
                        <td class=" ">Lista de descansos </td>

                      </tr>

                      <tr>
                        <td class="a-center ">
                          <input type="checkbox" name="a10" <?php echo $c10; ?> value="1">
                        </td>
                        <td class=" ">Productos</td>
                        <td class=" ">Categorias </td>

                      </tr>

                      <tr>
                        <td class="a-center ">
                          <input type="checkbox" name="a11" <?php echo $c11; ?> value="1">
                        </td>
                        <td class=" ">Productos</td>
                        <td class=" ">Ingresar Productos </td>

                      </tr>

                      <tr>
                        <td class="a-center ">
                          <input type="checkbox" name="a12" <?php echo $c12; ?> value="1">
                        </td>
                        <td class=" ">Productos</td>
                        <td class=" ">Lista de Productos </td>

                      </tr>

                      <tr>
                        <td class="a-center ">
                          <input type="checkbox" name="a13" <?php echo $c13; ?> value="1">
                        </td>
                        <td class=" ">Productos</td>
                        <td class=" ">Kardex de Productos </td>

                      </tr>

                      <tr>
                        <td class="a-center ">
                          <input type="checkbox" name="a14" <?php echo $c14; ?> value="1">
                        </td>
                        <td class=" ">Productos</td>
                        <td class=" ">Transferencia </td>

                      </tr>

                      <tr>
                        <td class="a-center ">
                          <input type="checkbox" name="a15" <?php echo $c15; ?> value="1">
                        </td>
                        <td class=" ">Productos</td>
                        <td class=" ">Lista de Transferencias </td>

                      </tr>

                      <tr>
                        <td class="a-center ">
                          <input type="checkbox" name="a16" <?php echo $c16; ?> value="1">
                        </td>
                        <td class=" ">Productos</td>
                        <td class=" ">Consultas de Productos </td>

                      </tr>

                      <tr>
                        <td class="a-center ">
                          <input type="checkbox" name="a17" <?php echo $c17; ?> value="1">
                        </td>
                        <td class=" ">Productos</td>
                        <td class=" ">Ventas de Productos </td>

                      </tr>

                      <tr>
                        <td class="a-center ">
                          <input type="checkbox" name="a18" <?php echo $c18; ?> value="1">
                        </td>
                        <td class=" ">Proveedores</td>
                        <td class=" ">Lista de Proveedores </td>

                      </tr>

                      <tr>
                        <td class="a-center ">
                          <input type="checkbox" name="a19" <?php echo $c19; ?> value="1">
                        </td>
                        <td class=" ">Clientes</td>
                        <td class=" ">Lista de Clientes </td>

                      </tr>


                      <tr>
                        <td class="a-center ">
                          <input type="checkbox" name="a20" <?php echo $c20; ?> value="1">
                        </td>
                        <td class=" ">Ventas de Productos</td>
                        <td class=" ">Configuracion de documentos </td>

                      </tr>

                      <tr>
                        <td class="a-center ">
                          <input type="checkbox" name="a21" <?php echo $c21; ?> value="1">
                        </td>
                        <td class=" ">Ventas de Productos</td>
                        <td class=" ">Ventas Fact/Bol/Guia </td>

                      </tr>



                      <tr>
                        <td class="a-center ">
                          <input type="checkbox" name="a23" <?php echo $c23; ?> value="1">
                        </td>
                        <td class=" ">Ventas de Productos</td>
                        <td class=" ">Lista de Ventas </td>

                      </tr>



                      <tr>
                        <td class="a-center ">
                          <input type="checkbox" name="a27" <?php echo $c27; ?> value="1">
                        </td>
                        <td class=" ">Ventas de Productos</td>
                        <td class=" ">Ventas por cobrar </td>

                      </tr>

                      <tr>
                        <td class="a-center ">
                          <input type="checkbox" name="a28" <?php echo $c28; ?> value="1">
                        </td>
                        <td class=" ">Ventas de Productos</td>
                        <td class=" ">Consulta de cobro de ventas </td>

                      </tr>

                      <tr>
                        <td class="a-center ">
                          <input type="checkbox" name="a29" <?php echo $c29; ?> value="1">
                        </td>
                        <td class=" ">Ventas de Servicios</td>
                        <td class=" ">Ventas de Servicios </td>

                      </tr>

                      <tr>
                        <td class="a-center ">
                          <input type="checkbox" name="a30" <?php echo $c30; ?> value="1">
                        </td>
                        <td class=" ">Ventas de Servicios</td>
                        <td class=" ">Lista de Equipos </td>

                      </tr>

                      <tr>
                        <td class="a-center ">
                          <input type="checkbox" name="a31" <?php echo $c31; ?> value="1">
                        </td>
                        <td class=" ">Ventas de Servicios</td>
                        <td class=" ">Productos Externos </td>

                      </tr>

                      <tr>
                        <td class="a-center ">
                          <input type="checkbox" name="a32" <?php echo $c32; ?> value="1">
                        </td>
                        <td class=" ">Ventas de Servicios</td>
                        <td class=" ">Consulta venta de Servicios </td>

                      </tr>

                      <tr>
                        <td class="a-center ">
                          <input type="checkbox" name="a33" <?php echo $c33; ?> value="1">
                        </td>
                        <td class=" ">Ventas de Servicios</td>
                        <td class=" ">Venta de Servicios x tecnico </td>

                      </tr>

                      <tr>
                        <td class="a-center ">
                          <input type="checkbox" name="a34" <?php echo $c34; ?> value="1">
                        </td>
                        <td class=" ">Compras</td>
                        <td class=" ">Compras Fac/Bol </td>

                      </tr>

                      <tr>
                        <td class="a-center ">
                          <input type="checkbox" name="a35" <?php echo $c35; ?> value="1">
                        </td>
                        <td class=" ">Compras</td>
                        <td class=" ">Consulta de compras </td>

                      </tr>



                      <tr>
                        <td class="a-center ">
                          <input type="checkbox" name="a39" <?php echo $c39; ?> value="1">
                        </td>
                        <td class=" ">Compras</td>
                        <td class=" ">Compras por pagar</td>

                      </tr>

                      <tr>
                        <td class="a-center ">
                          <input type="checkbox" name="a40" <?php echo $c40; ?> value="1">
                        </td>
                        <td class=" ">Compras</td>
                        <td class=" ">Consulta de pago de compras</td>

                      </tr>

                      <tr>
                        <td class="a-center ">
                          <input type="checkbox" name="a41" <?php echo $c41; ?> value="1">
                        </td>
                        <td class=" ">Balance y otros</td>
                        <td class=" ">Balance de entradas y salidas</td>

                      </tr>
                      <tr>
                        <td class="a-center ">
                          <input type="checkbox" name="a42" <?php echo $c42; ?> value="1">
                        </td>
                        <td class=" ">Balance y otros</td>
                        <td class=" ">Consulta de ventas y compras</td>

                      </tr>
                      <tr>
                        <td class="a-center ">
                          <input type="checkbox" name="a43" <?php echo $c43; ?> value="1">
                        </td>
                        <td class=" ">Balance y otros</td>
                        <td class=" ">Otros pagos y compras</td>

                      </tr>

                      <tr>
                        <td class="a-center ">
                          <input type="checkbox" name="a24" <?php echo $c24; ?> value="1">
                        </td>
                        <td class=" ">Reporte de Ventas</td>
                        <td class=" ">Ventas por vendedor mensual/anual/diario</td>

                      </tr>

                      <tr>
                        <td class="a-center ">
                          <input type="checkbox" name="a25" <?php echo $c25; ?> value="1">
                        </td>
                        <td class=" ">Reporte de Ventas</td>
                        <td class=" ">Ventas por cliente mensual/anual/diario</td>

                      </tr>
                      <tr>
                        <td class="a-center ">
                          <input type="checkbox" name="a26" <?php echo $c26; ?> value="1">
                        </td>
                        <td class=" ">Reporte de Ventas</td>
                        <td class=" ">Resumen de ventas </td>

                      </tr>



                      <tr>
                        <td class="a-center ">
                          <input type="checkbox" name="a36" <?php echo $c36; ?> value="1">
                        </td>
                        <td class=" ">Reporte de Compras</td>
                        <td class=" ">Compras por vendedor diario/mensual/anual</td>

                      </tr>

                      <tr>
                        <td class="a-center ">
                          <input type="checkbox" name="a37" <?php echo $c37; ?> value="1">
                        </td>
                        <td class=" ">Reporte de Compras</td>
                        <td class=" ">Compras por proveedor diario/mensual/anual</td>

                      </tr>

                      <tr>
                        <td class="a-center ">
                          <input type="checkbox" name="a38" <?php echo $c38; ?> value="1">
                        </td>
                        <td class=" ">Reporte de Compras</td>
                        <td class=" ">Resumen de compras </td>

                      </tr>


                    </tbody>

                  </table>

                  <div class="pull-right">
                    <button id="send" type="submit" name="enviar" class="btn btn-agregar btn-margin">Cambiar</button>
                  </div>
                </form>



              </div>
            </div>

          <?php

          }

          ?>



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

  <script src="js/pace/pace.min.js"></script>


  <script type="text/javascript" src="js/autocomplete/countries.js"></script>
  <script src="js/autocomplete/jquery.autocomplete.js"></script>
  <!-- pace -->
  <script src="js/pace/pace.min.js"></script>


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

  <script>
    function seleccionar_todo() {
      for (i = 0; i < document.f1.elements.length; i++)
        if (document.f1.elements[i].type == "checkbox")
          document.f1.elements[i].checked = 1
    }

    function deseleccionar_todo() {
      for (i = 0; i < document.f1.elements.length; i++)
        if (document.f1.elements[i].type == "checkbox")
          document.f1.elements[i].checked = 0
    }

    function disableOthers(field) {
      disableCheck(formulario.dos, field);
      disableCheck(formulario.tres, field);
    }
  </script>

  <script language="javascript">
    $(document).ready(function() {
      $(".botonExcel").click(function(event) {
        $("#datos_a_enviar").val($("<div>").append($("#example").eq(0).clone()).html());
        $("#FormularioExportacion").submit();
      });
    });
  </script>





</body>

</html>