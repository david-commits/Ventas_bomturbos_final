

     <script>

  function soloNumeros(e){
    var key = window.event ? e.which : e.keyCode;
    if (key < 48 || key > 57) {
        //Usando la definición del DOM level 2, "return" NO funciona.
        e.preventDefault();
    }
  }
</script>
<?php
session_start();
include('menu.php');
include('appblade.php');
require_once("config/db.php"); //Contiene las variables de configuracion para conectar a la base de datos
require_once("config/conexion.php");
//include('conexion.php');
$sql1 = "select * from users where user_id=$_SESSION[user_id]";
$rw1 = mysqli_query($con, $sql1); //recuperando el registro
$rs1 = mysqli_fetch_array($rw1); //trasformar el registro en un vector asociativo
$modulo = $rs1["accesos"];
$sql2 = "select * from datosempresa where id_emp=1";
$rw2 = mysqli_query($con, $sql2); //recuperando el registro
$rs2 = mysqli_fetch_array($rw2); //trasformar el registro en un vector asociativo
$dolar = $rs2["dolar"];

$a = explode(".", $modulo);
if (!isset($_SESSION['user_login_status']) and $_SESSION['user_login_status'] != 1) {
  header("location: login.php");
  exit;
}

if ($a[20] == 0) {
  header("location:error.php");
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
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
          ?>
          <br />
          <?php
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

          <!--<div class="btn-group">
            <button type="button" class="btn btn-guardar">Tipo de Documento</button>
            <button type="button" class="btn btn-guardar dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
              <span class="caret"></span>
            </button>
            <ul class="dropdown-menu custom-select" role="menu">
              <li><a class="custom-select" href="doc.php?accion=1&tipo=1">Factura:</a>
              </li>
              <li><a class="custom-select" href="doc.php?accion=7&tipo=1">Factura sin IGV:</a>
              </li>
              <li><a class="custom-select" href="doc.php?accion=2&tipo=1">Boleta:</a>
              </li>
              <li><a class="custom-select" href="doc.php?accion=5&tipo=1">Nota de Débito:</a>
              </li>
              <li><a class="custom-select" href="doc.php?accion=6&tipo=1">Nota de Crédito:</a>
              </li>
              <li><a class="custom-select" href="doc.php?accion=3&tipo=1">Guía con IGV:</a>
              </li>
            </ul>
          </div>-->

          <br><br>

          <div class="container">
            <div class="panel panel-info">
              <div class="panel-heading">
                <?php
                $read = "";
                $required = "";
                $color = "";
                if ($_SESSION['doc_ventas'] == 1) {
                  $doc = "Factura";
                  $read = "readonly";
                  $required = "required";
                  $color = "#343E59";
                }
                if ($_SESSION['doc_ventas'] == 2) {
                  $doc = "Boleta";
                  $read = "readonly";
                }
                if ($_SESSION['doc_ventas'] == 3) {
                  $doc = "Guia IGV";
                  $read = "readonly";
                }
                if ($_SESSION['doc_ventas'] == 5) {
                  $doc = "Nota de Débito";
                }
                if ($_SESSION['doc_ventas'] == 6) {
                  $doc = "Nota de Crédito";
                }
                // factura sin IGV
                if ($_SESSION['doc_ventas'] == 7) {
                  $doc = "Factura sin IGV";
                  $read = "readonly";
                  $required = "required";
                  $color = "#343E59";
                }
                //$val=$_SESSION['doc_ventas']
                ?>
                <div class="row">

                  <div class="col-md-4 col-sm-4 col-xs-12 flex align-items-center justify-content-left">
                    <h4>Nueva:</h4>
                    <!-- Estilo de botón antiguo: -->
                    <!--<h4>Nueva <?php echo "$doc"; ?></h4>-->
                    <!-- <h4>Nueva 
                      <button type="button" class="btn btn-guardar" onchange="myFunctionChange()"><?php  echo "$doc";  ?></button>
                      <button type="button" class="btn btn-guardar dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                        <span class="caret"></span>
                      </button>
                      <ul class="dropdown-menu custom-select" role="menu">
                        <li><a class="custom-select" href="doc.php?accion=1&tipo=1">Factura:</a>
                        </li>
                        <li><a class="custom-select" href="doc.php?accion=7&tipo=1">Factura sin IGV:</a>
                        </li>
                        <li><a class="custom-select" href="doc.php?accion=2&tipo=1">Boleta:</a>
                        </li>
                        <li><a class="custom-select" href="doc.php?accion=5&tipo=1">Nota de Débito:</a>
                        </li>
                        <li><a class="custom-select" href="doc.php?accion=6&tipo=1">Nota de Crédito:</a>
                        </li>
                        <li><a class="custom-select" href="doc.php?accion=3&tipo=1">Guía con IGV:</a>
                        </li>
                      </ul>
                    </h4>-->
                    <div class="dropdown ml-3">
                      <button class="btn btn-guardar dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" onchange="myFunctionChange()">
                        <?php  echo "$doc";?>
                        <span class="caret"></span>
                      </button>
                      <ul class="dropdown-menu" aria-labelledby="dropdownMenu1" role="menu">
                        <li><a class="custom-select" href="doc.php?accion=1&tipo=1">Factura</a></li>
                        <li><a class="custom-select" href="doc.php?accion=7&tipo=1">Factura sin IGV</a></li>
                        <li><a class="custom-select" href="doc.php?accion=2&tipo=1">Boleta</a></li>
                        <li><a class="custom-select" href="doc.php?accion=5&tipo=1">Nota de Débito</a></li>
                        <li><a class="custom-select" href="doc.php?accion=6&tipo=1">Nota de Crédito</a></li>
                        <li><a class="custom-select" href="doc.php?accion=3&tipo=1">Guía con IGV</a></li>
                      </ul>
                    </div>
                  </div>

                  <div class="col-md-8 col-sm-8 col-xs-12 flex align-items-center justify-content-left" style="height: 38px">
                    <span>Precio Compra Actual <span id="spanpreciocompra">0</span>, Precio Venta Actual <span id="spanprecioventa">0</span>, % de ganancia o pérdida <span id="spanprecioporcentaje">0</span> </span>
                  </div>

                </div>


              </div>
              <div class="panel-body">
                <?php
               
                include("modal/buscar_productos.php");
                include("modal/buscar_servicio.php");
                //include("modal/registro_clientes.php");
                include("modal/registro_productos.php");
                ?>
                <form class="form-horizontal" role="form" id="datos_factura" action="facturas.php" method="get">
                 
                  <span class="campos-obligatorios">Llenar todos los (*) Campos Obligatorios</span>
                  <br><br>

            <div class="form-group row">
                    
                    <div class="col-md-4 col-sm-4 col-xs-12 separador-compras">
                      (*) Cliente:
                     <input type="search" class="form-control estilo-placeholder input-sm"  id="nombre_cliente" placeholder="Buscar un cliente válido" required>
                        <input id="id_cliente" type='hidden'>
                    </div>

                    <div class="col-md-4 col-sm-4 col-xs-12 separador-compras">
                      (*) Tipo de Documento:
                     <select class='form-control estilo-placeholder input-sm' id="tip_doc" name="tip_doc">
                          <option class="custom-select" value="2">RUC:</option>
                          <?php
                          if ($_SESSION['doc_ventas'] <> 1) {
                          ?>
                            <option class="custom-select" value="1">DNI:</option>
                          <?php
                          }
                          ?>
                        </select>       
                    </div>
                 <!--   <div class="form-group">
                        <label for="" class="col-sm-3 control-label"></label>
                        <input type="button" class="btn btn-guardar col-md-8 col-sm-8 col-xs-12" style=" margin-top: 15px;" id="btn-ingresar" value="Buscar Ruc/Dni" />
                    </div>  -->        


                    <?php
                    $consulta3 = "SELECT * FROM documento ";
                    $result3 = mysqli_query($con, $consulta3);
                    while ($valor3 = mysqli_fetch_array($result3, MYSQLI_ASSOC)) {
                      if ($valor3['id_documento'] == $_SESSION['doc_ventas']) {

                        if ($_SESSION['tienda'] == 1) {
                          $doc = $valor3['tienda1'] + 1;
                          $doc11 = $valor3['folio1'];
                        }
                        if ($_SESSION['tienda'] == 2) {
                          $doc = $valor3['tienda2'] + 1;
                          $doc11 = $valor3['folio2'];
                        }
                        if ($_SESSION['tienda'] == 3) {
                          $doc = $valor3['tienda3'] + 1;
                          $doc11 = $valor3['folio3'];
                        }
                        if ($_SESSION['tienda'] == 4) {
                          $doc = $valor3['tienda4'] + 1;
                          $doc11 = $valor3['folio4'];
                        }
                        if ($_SESSION['tienda'] == 5) {
                          $doc = $valor3['tienda5'] + 1;
                          $doc11 = $valor3['folio5'];
                        }
                        if ($_SESSION['tienda'] == 6) {
                          $doc = $valor3['tienda6'] + 1;
                          $doc11 = $valor3['folio6'];
                        }
                      }
                    }
                    ?>
                    <div class="col-md-4 col-sm-4 col-xs-12 separador-compras">
                      Dirección del Cliente:
                     <input type="text" autocomplete="off" style="background-color: <?php echo $color; ?>;" class="form-control estilo-placeholder input-sm" id="direccion_cliente" placeholder="Dirección del Cliente" <?php echo $required; ?>>
                    </div>

                    <div class="col-md-4 col-sm-4 col-xs-12 separador-compras">
                      Nro Documento:
                     <input type="number"  maxlength="20" autocomplete="off" class="form-control estilo-placeholder input-sm" id="doc1" placeholder="Nro Documento">
                    </div>
                    
                    <div class="col-md-4 col-sm-4 col-xs-12 separador-compras">
                      Teléfono:
                      <input type="number" autocomplete="off" class="form-control estilo-placeholder input-sm" id="tel1" placeholder="Teléfono">
                    </div>

                    <div class="col-md-4 col-sm-4 col-xs-12 separador-compras">
                      Email:
                      <input type="email" autocomplete="off" class="form-control estilo-placeholder input-sm" id="mail" placeholder="Email">
                    </div>

                    <div class="col-md-2 col-sm-2 col-xs-6 separador-compras">
                      Folio:
                      <input type="text" value="<?php echo $doc11; ?>" class="form-control estilo-placeholder input-sm" id="folio" placeholder="Folio" readonly>
                    </div>

                    <div class="col-md-2 col-sm-2 col-xs-6 separador-compras">
                      Número de Documento:
                       <input type="text" value="<?php echo $doc; ?>" class="form-control estilo-placeholder input-sm" id="factura" placeholder="Número de doc" readonly>  
                    </div>


                          <?php 
                          if ($_SESSION['doc_ventas'] == 5 or $_SESSION['doc_ventas'] == 6) {
                          ?>
                            <div  style="display: block;" id="displaydocmodificado" class="col-md-4 col-sm-4 col-xs-12 separador-compras">
                          <?php
                          }else{?>
                            <div  style="display: none;" id="displaydocmodificado" class="col-md-4 col-sm-4 col-xs-12 separador-compras">
                          <?php
                          } ?>

                      N° de Doc. Modificado:
                       <?php
                          if ($_SESSION['doc_ventas'] <> 5 and $_SESSION['doc_ventas'] <> 6) {
                          ?>
                            <input autocomplete="off" type="text" class="form-control estilo-placeholder input-sm" id="nro_doc" placeholder="Nro de Doc Asociado" <?php echo $read; ?>>
                          <?php
                          }

                          if ($_SESSION['doc_ventas'] == 5 or $_SESSION['doc_ventas'] == 6) {
                          ?>
                            N° Doc. Modificado:<select  class='form-control estilo-placeholder input-sm' id="nro_doc" required>
                              <?php
                              $consulta4 = "SELECT * FROM facturas WHERE estado_factura=1 ";
                              $result4 = mysqli_query($con, $consulta4);
                              while ($valor4 = mysqli_fetch_array($result4, MYSQLI_ASSOC)) {
                              ?>
                                Nro Documento Asociado:

                                <option class="custom-select" value="<?php print "$valor4[folio]-$valor4[numero_factura]"; ?>"><?php print "$valor4[folio]-$valor4[numero_factura]"; ?></option>
                              <?php
                              }
                              ?>
                            </select>
                          <?php
                          }
                          ?> 
                    </div>

                          <?php 
                          if ($_SESSION['doc_ventas'] == 5 or $_SESSION['doc_ventas'] == 6) {
                          ?>
                            <div  style="display: block;" id="displaynotacreditodebito" class="col-md-4 col-sm-4 col-xs-12 separador-compras">
                          <?php
                          }else{?>
                            <div  style="display: none;" id="displaynotacreditodebito" class="col-md-4 col-sm-4 col-xs-12 separador-compras">
                          <?php
                          } ?>

                      Motivo (Nota de Crédito y Débito):
                        <?php
                            if ($_SESSION['doc_ventas'] <> 5 and $_SESSION['doc_ventas'] <> 6) {
                            ?>
                              <input autocomplete="off" type="text" class="form-control estilo-placeholder input-sm" id="motivo" placeholder="Motivo" <?php echo $read; ?>>
                            <?php
                            }
                            if ($_SESSION['doc_ventas'] == 6) {
                            ?>
                              Motivo:
                              <select  class='form-control estilo-placeholder input-sm' id="motivo" required>
                                <option class="custom-select" value="">SELECCIONA MOTIVO</option>
                                <option class="custom-select" value="01">ANULACIÓN DE LA OPERACION</option>
                                <option class="custom-select" value="02">ANULACIÓN POR ERROR EN EL RUC</option>
                                <option class="custom-select" value="03">CORRECIÓN POR ERROR EN LA DESCRIPCIÓN</option>
                                <option class="custom-select" value="04">DESCUENTO GLOBAL</option>
                                <option class="custom-select" value="05">DESCUENTO POR ITEM</option>
                                <option class="custom-select" value="06">DEVOLUCIÓN TOTAL</option>
                                <option class="custom-select" value="07">DEVOLUCIÓN POR ITEM</option>
                                <option class="custom-select" value="08">BONIFICACIÓN</option>
                                <option class="custom-select" value="09">DISMINUCIÓN EN EL VALOR</option>
                              </select>
                            <?php
                            }
                            ?>
                            <?php
                            if ($_SESSION['doc_ventas'] == 5) {
                            ?>
                              Motivo:
                              <select  class='form-control estilo-placeholder input-sm' id="motivo" required>

                                <option class="custom-select" value="">SELECCIONA MOTIVO</option>
                                <option class="custom-select" value="01">INTERES POR MORA</option>
                                <option class="custom-select" value="02">AUMENTO EN EL VALOR</option>
                                <option class="custom-select" value="03">PENALIDADES</option>
                              </select>

                            <?php
                            }
                            ?>
                    </div>

                    <div class="col-md-4 col-sm-4 col-xs-12 separador-compras">
                      Descuento Producto Stock (*) :
                       <select  class='form-control estilo-placeholder input-sm' id="des" required>
                            <option  class="custom-select" value="1">SI</option>
                            <?php
                            if ($_SESSION['doc_ventas'] == 6) {
                              print "<option class='custom-select' value=2>NO</option>";
                            }
                            ?>
                          </select>
                    </div>

<?php date_default_timezone_set('America/Lima'); ?>

                    <div class="col-md-2 col-sm-2 col-xs-6 separador-compras">
                      Fecha (*) :
                       <input  type="date" class="form-control estilo-placeholder input-sm input-fechas-horas-2" id="fecha" value="<?php echo date("Y-m-d"); ?>" required>  
                    </div>

                    <div class="col-md-2 col-sm-2 col-xs-6 separador-compras">
                      Hora (*) :
                      <input  type="time" class="form-control estilo-placeholder input-sm input-fechas-horas-2" id="hora" value="<?php echo date("H:i:s"); ?>" required>  
                    </div>

                    

                    <input type="hidden" class="form-control estilo-placeholder input-sm" value="1" name="moneda" id="moneda" required>
                    <input type="hidden" class="form-control estilo-placeholder input-sm" value="<?php echo $dolar; ?>" name="tcp" id="tcp" required>

                    <div class="col-md-2 col-sm-2 col-xs-6 separador-compras">
                     Pago (*) :
                      <select  class='form-control estilo-placeholder input-sm' id="condiciones">
                            <option class="custom-select" value="1">Efectivo</option>
                            <option class="custom-select" value="2">Cheque</option>
                            <option class="custom-select" value="3">Transferencia bancaria</option>
                            <?php
                            if ($_SESSION['doc_ventas'] < 5) {
                            ?>
                              <option class="custom-select" value="4">Crédito</option>
                            <?php
                            }
                            ?>
                          </select>
                    </div>

                    <div class="col-md-2 col-sm-2 col-xs-6 separador-compras">
                     Número de Días(*) :
                      <input  autocomplete="off" type="text" value="0" class="form-control estilo-placeholder input-sm" id="dias" name="dias" placeholder="Número de días de crédito"> 
                    </div>

                 
            </div>

            <br><br>                 
            <div class="col-md-12 ">
                    <div class="pull-right">
                      <button type="button" class="btn btn-agregar" data-toggle="modal" data-target="#nuevoProducto">
                        <span class="glyphicon glyphicon-plus"></span> Nuevo producto
                      </button>

                      <button id="id_nuevacompra" type="button" class="btn btn-guardar" data-toggle="modal" data-target="#myModal">
                        <span class="glyphicon glyphicon-search"></span> Agregar productos
                      </button>

                      <button type="submit" class="btn btn-primary" id="consolidar" disabled="true">
                        <span class="glyphicon glyphicon-print"></span> Consolidar
                      </button>
                    </div>
            </div>
            </form>

                    <div id="resultados" class='col-md-12' style="margin-top:10px"></div><!-- Carga los datos ajax -->
                    </div>
            </div>
                    <div class="row-fluid">
                    <div class="col-md-12">

              </div>
            </div>
          </div>

        </div>
      </div>



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
  <script src="//code.jquery.com/jquery-1.11.2.min.js"></script>
  <!-- bootstrap progress js -->
  <script src="js/progressbar/bootstrap-progressbar.min.js"></script>
  <script src="js/nicescroll/jquery.nicescroll.min.js"></script>
  <!-- icheck -->
  <script src="js/icheck/icheck.min.js"></script>

  <script src="js/custom.js"></script>

  <!-- pace -->
  <script src="js/pace/pace.min.js"></script>


  <script type="text/javascript" src="js/VentanaCentrada.js"></script>

  <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
  <script>
    $(function() {
      $("#nombre_cliente").autocomplete({
        source: "./ajax/autocomplete/clientes.php",
        minLength: 1,
        select: function(event, ui) {
          event.preventDefault();
          $('#id_cliente').val(ui.item.id_cliente);
          $('#nombre_cliente').val(ui.item.nombre_cliente);
          $('#tel1').val(ui.item.telefono_cliente);
          $('#mail').val(ui.item.email_cliente);
          $('#doc1').val(ui.item.doc1);
          $('#direccion_cliente').val(ui.item.direccion_cliente);

        }
      });


    });

    $("#nombre_cliente").on("keydown", function(event) {
      if (event.keyCode == $.ui.keyCode.LEFT || event.keyCode == $.ui.keyCode.RIGHT || event.keyCode == $.ui.keyCode.UP || event.keyCode == $.ui.keyCode.DOWN || event.keyCode == $.ui.keyCode.DELETE || event.keyCode == $.ui.keyCode.BACKSPACE) {
        $("#id_cliente").val("");
        $("#tel1").val("");
        $("#mail").val("");
        $("#doc1").val("");
        $("#direccion_cliente").val("");
      }
      if (event.keyCode == $.ui.keyCode.DELETE) {
        $("#nombre_cliente").val("");
        $("#id_cliente").val("");
        $("#tel1").val("");
        $("#mail").val("");
        $("#doc1").val("");
        $("#direccion_cliente").val("");
      }
    });
    $(document).ready(function() {
      load(1);
    });

    $("#id_nuevacompra").click(function() {
      document.getElementById("cabecera_modal").innerHTML = "";
      document.getElementById("cabecera_modal").innerHTML = "VENTAS";
    });



function cargarload(){
  load(1);
}



    function load(page) {
      var q = $("#q").val();
      var q2 = $("#q2").val();
      var categoria = $("#categoria_m").val();
      var marca = $("#marca_m").val();
      var modelo = $("#modelo_m").val();
      var motor = $("#motor_m").val();
      var anio = $("#anio_compatibilidad").val();
      var litro = $("#litros_compatibilidad").val();

      console.log('asdasjkdjkas');
      console.log(anio);
      $("#loader").fadeIn('slow');
      $.ajax({
        url: './ajax/productos_factura.php?action=ajax&page=' + page + '&q=' + q + '&q2=' + q2 + '&marca=' + marca + '&modelo=' + modelo + '&motor=' + motor +'&aniocompa=' + anio + '&litrocompa=' + litro + '&catecompa=' + categoria,
        beforeSend: function(objeto) {
          $('#loader').html('<img src="./img/ajax-loader.gif"> Cargando...');
        },
        success: function(data) {
          $(".outer_div").html(data).fadeIn('slow');
          $('#loader').html('');

        }
      })
    }

    function agregar(id) {
      document.getElementById(id).style.color = "red";
      var precio_venta = document.getElementById('precio_venta_' + id).value;
      var cantidad = document.getElementById('cantidad_' + id).value;
      var stock = document.getElementById('stock_' + id).value;
      //Inicia validacion
      if (isNaN(cantidad)) {
        alert('Esto no es un numero');
        document.getElementById('cantidad_' + id).focus();
        return false;
      }

      if (cantidad == "" || cantidad == 0) {
        alert('Por favor ingrese la cantidad requirida');
        return;
      }
      if (parseInt(cantidad) > parseInt(stock)) {
        alert('La cantidad requirida es mayor al stock');
        return;
      }
      //Fin validacion
      $.ajax({
        type: "POST",
        url: "./ajax/agregar_facturacion.php",
        data: "id=" + id + "&precio_venta=" + precio_venta + "&cantidad=" + cantidad + "&stock=" + stock,
        beforeSend: function(objeto) {
          $("#resultados").html("Mensaje: Cargando...");
        },
        success: function(datos) {
          $("#resultados").html(datos);
        }
      });
    }

    function agregar1() {
      var precio_venta = document.getElementById('precio_venta').value;
      var cantidad = document.getElementById('cantidad').value;
      var id = document.getElementById('descripcion').value;
      var stock = document.getElementById('stock').value;
      //Inicia validacion
      if (isNaN(cantidad)) {
        alert('Esto no es un numero');
        document.getElementById('cantidad').focus();
        return false;
      }

      //Fin validacion

      $.ajax({
        type: "POST",
        url: "./ajax/agregar_facturacion.php",
        data: "id=" + id + "&precio_venta=" + precio_venta + "&cantidad=" + cantidad + "&stock=" + stock,
        beforeSend: function(objeto) {
          $("#resultados").html("Mensaje: Cargando...");
        },
        success: function(datos) {
          $("#resultados").html(datos);
        }
      });
    }

    function eliminar(id) {

      $.ajax({
        type: "GET",
        url: "./ajax/agregar_facturacion.php",
        data: "id=" + id,
        beforeSend: function(objeto) {
          $("#resultados").html("Mensaje: Cargando...");
        },
        success: function(datos) {
          $("#resultados").html(datos);
        }
      });

    }

    $("#datos_factura").submit(function(event) {

      var id_cliente = $("#id_cliente").val();
      var id_vendedor = $("#id_vendedor").val();
      var condiciones = $("#condiciones").val();
      var factura = $("#factura").val();
      var fecha = $("#fecha").val();
      var hora = $("#hora").val();
      var moneda = $("#moneda").val();
      var dias = $("#dias").val();
      var tcp = $("#tcp").val();
      var folio = $("#folio").val();
      var nro_doc = $("#nro_doc").val();
      var motivo = $("#motivo").val();
      var nombre_cliente = $("#nombre_cliente").val();
      var doc1 = $("#doc1").val();
      var tip_doc = $("#tip_doc").val();
      var tel1 = $("#tel1").val();
      var mail = $("#mail").val();
      var direccion = $("#direccion_cliente").val();
      var des = $("#des").val();
      if (id_cliente != '') {
        VentanaCentrada('./pdf/documentos/factura_pdf.php?id_cliente=' + id_cliente + '&id_vendedor=' + id_vendedor + '&factura=' + factura + '&dias=' + dias + '&condiciones=' + condiciones + '&fecha=' + fecha + '&hora=' + hora + '&moneda=' + moneda + '&tcp=' + tcp + '&folio=' + folio + '&nro_doc=' + nro_doc + '&motivo=' + motivo + '&nombre_cliente=' + nombre_cliente + '&doc1=' + doc1 + '&tip_doc=' + tip_doc + '&tel1=' + tel1 + '&mail=' + mail + '&direccion=' + direccion + '&des=' + des, 'Factura', '', '1024', '768', 'true');
      } else {
        alert('El cliente no esta registrado, porfavor de registrarlo');
        event.preventDefault();
      }
      // VentanaCentrada('./pdf/documentos/factura_pdf.php?id_cliente='+id_cliente+'&id_vendedor='+id_vendedor+'&factura='+factura+'&dias='+dias+'&condiciones='+condiciones+'&fecha='+fecha+'&hora='+hora+'&moneda='+moneda+'&tcp='+tcp+'&folio='+folio+'&nro_doc='+nro_doc+'&motivo='+motivo+'&nombre_cliente='+nombre_cliente+'&doc1='+doc1+'&tip_doc='+tip_doc+'&tel1='+tel1+'&mail='+mail+'&direccion='+direccion+'&des='+des,'Factura','','1024','768','true');
      var ex_regular_dato;
      ex_regular_dato = /^\d{8}(?:[-\s]\d[4])?$/;

      //if (((doc1 = Number(doc1)) && doc1 % 1 === 0 && rucValido(doc1)) |  ex_regular_dato.test (doc1) == true)  {


    });

    $("#guardar_cliente").submit(function(event) {
      $('#guardar_datos').attr("disabled", true);

      var parametros = $(this).serialize();
      $.ajax({
        type: "POST",
        url: "ajax/nuevo_cliente.php",
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


function myFunctionChange() {
  var x = document.getElementById("nuevodoc").value;
  alert(x);
 //document.getElementById("demo").innerHTML = "You selected: " + x;
}







    $("#guardar_producto").submit(function(event) {
      $('#guardar_datos').attr("disabled", true);

      var parametros = $(this).serialize();
      $.ajax({
        type: "POST",
        url: "ajax/nuevo_producto.php",
        data: parametros,
        beforeSend: function(objeto) {
          $("#resultados_ajax_productos").html("Mensaje: Cargando...");
        },
        success: function(datos) {
          $("#resultados_ajax_productos").html(datos);
          $('#guardar_datos').attr("disabled", false);
          load(1);
        }
      });
      event.preventDefault();
    })




    $(document).on('ready', function() {

      $('#btn-ingresar').click(function() {
        var url = "busqueda.php";

        $.ajax({
          type: "POST",
          url: url,
          data: $("#datos_factura").serialize(),
          success: function(data) {
            $('#doc1').html(data);

            porciones = data.split('|');


            document.getElementById("nombre_cliente").value = porciones[0];
            document.getElementById("direccion_cliente").value = porciones[1];
          }
        });

      });
    });

    function rucValido(ruc) {
      //11 dígitos y empieza en 10,15,16,17 o 20
      if (!(ruc >= 1e10 && ruc < 11e9 ||
          ruc >= 15e9 && ruc < 18e9 ||
          ruc >= 2e10 && ruc < 21e9))
        return false;

      for (var suma = -(ruc % 10 < 2), i = 0; i < 11; i++, ruc = ruc / 10 | 0)
        suma += (ruc % 10) * (i % 7 + (i / 7 | 0) + 1);
      return suma % 11 === 0;

    }


var input=  document.getElementById('doc1');
input.addEventListener('input',function(){
  if (this.value.length > 20) 
     this.value = this.value.slice(0,20); 
})

var input=  document.getElementById('tel1');
input.addEventListener('input',function(){
  if (this.value.length > 12) 
     this.value = this.value.slice(0,12); 
})

  </script>



</body>

</html>
