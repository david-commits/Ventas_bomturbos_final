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
if ($a[7] == 0) {
    header("location:error.php");
}
$a1 = recoge1('fecha1');
$a2 = recoge1('fecha2');
if ($a1 == 2 && isset($a1)) {
    $a2 = "Anual";
}
$a3 = recoge1('tienda');
$a4 = recoge1('asistencia');
$a5 = "";
$a6 = "";
$delete = mysqli_query($con, "DELETE FROM consultas");
$insert = mysqli_query($con, "INSERT INTO consultas VALUES ('','43','$a1','$a2','$a3','$a4','$a5','$a6')");
date_default_timezone_set('America/Lima');
$anio1 = date("Y");

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
    <SCRIPT LANGUAGE="JavaScript" SRC="calendar.js"></SCRIPT>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>
    <link rel="stylesheet" type="text/css" href="Buttons/css/buttons.dataTables.min.css" />
    <script type="text/javascript" src="DataTables/datatables.min.js"></script>
    <script type="text/javascript" src="Buttons/js/buttons.flash.min.js"></script>
    <script type="text/javascript" src="Buttons/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" src="Buttons/js/buttons.html5.min.js"></script>
    <script type="text/javascript" src="Buttons/js/buttons.print.min.js"></script>
    <script type="text/javascript">
        var mostrarValor = function(x) {
            var x;
            var y = "Anual";
            if (x > 1) {
                document.getElementById('anio').value = y;
                document.getElementById("anio").disabled = true;
            }
            if (x == 1) {
                document.getElementById('anio').value = <?php echo $anio1; ?>;
                document.getElementById("anio").disabled = false;
            }
        };
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
                $dd1 = "";
                $dd2 = "";
                while ($valor1 = mysqli_fetch_array($result2, MYSQLI_ASSOC)) {



                    if ($valor1['tipo'] == 43) {

                        $fecha1 = $valor1['a1'];
                        //$nom_pro=trim($nom_pro1);
                        $fecha2 = $valor1['a2'];
                        $tienda = $valor1['a3'];
                        $asistencia = $valor1['a4'];
                        if ($tienda == 7) {
                            $tien1 = 1;
                            $tien2 = 6;
                        }
                        if ($tienda <> 7) {
                            $tien1 = $tienda;
                            $tien2 = $tienda;
                        }
                        if ($fecha1 <> "") {
                            $d1 = explode("-", $fecha1);
                            $dia1 = $d1[0];
                            $mes1 = $d1[1];
                            $ano1 = $d1[2];
                            $dd1 = $ano1 . "-" . $mes1 . "-" . $dia1;
                        }
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
                        <!-- <div class="x_panel"> -->
                            <div class="panel panel-info">
                                <div class="panel-heading">
                                    <h2>Asistencia del Personal</h2>
                                </div>

                                <div class="panel-body">
                                    <form name="myForm" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" method="POST" action="consulta13.php">

                                        <div class="col-md-3 col-sm-3 col-xs-12">
                                            <label>Fecha 1:</label>
                                            <input class="form-control estilo-placeholder input-fechas-horas-3 col-md-10" value="<?php echo $fecha1; ?>" id="fecha1" name="fecha1" type="date" required="required">
                                        </div>



                                        <div class="col-md-3 col-sm-3 col-xs-12">
                                            <label>Fecha 2:</label>
                                            <input class="form-control estilo-placeholder input-fechas-horas-3 col-md-10" value="<?php echo $fecha2; ?>" id="fecha2" name="fecha2" type="date" required="required">
                                        </div>

                                        <div class="col-md-3 col-sm-3 col-xs-12">
                                            <label>Mostrar:</label>
                                            <select class="form-control estilo-placeholder col-md-10" name="asistencia" required="required" tabindex="-1">
                                                <?php
                                                if ($asistencia == 0) {
                                                ?>
                                                    <option class="custom-select" selected value="0">Solo Asistencia</option>
                                                <?php
                                                } else {
                                                ?>
                                                    <option class="custom-select" value="0">Solo Asistencia</option>
                                                <?php
                                                }
                                                if ($asistencia == 1) {
                                                ?>
                                                    <option class="custom-select" selected value="1">Min. Tardanza</option>
                                                <?php
                                                } else {
                                                ?>
                                                    <option class="custom-select" value="1">Min. Tardanza</option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>



                                        <div class="col-md-3 col-sm-3 col-xs-12">
                                            <label>Sucursal:</label>
                                            <select class="form-control estilo-placeholder col-md-10" name="tienda" required="required" tabindex="-1">
                                                <option class="custom-select" value="0">Escoger</option>
                                                <?php
                                                for ($i = 1; $i <= $tienda1; $i++) {

                                                    if ($i == $tienda) {
                                                ?>
                                                        <option class="custom-select" selected value="<?php echo $i; ?>">Sucursal <?php echo $i; ?></option>
                                                    <?php
                                                    } else {
                                                    ?>
                                                        <option class="custom-select" value="<?php echo $i; ?>">Sucursal <?php echo $i; ?></option>
                                                    <?php
                                                    }
                                                }
                                                if ($tienda == 7) {
                                                    ?>
                                                    <option class="custom-select" selected value="7">Todas</option>
                                                <?php
                                                } else {
                                                ?>
                                                    <option class="custom-select" value="7">Todas</option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                            <br>
                                            <br>
                                        </div>


                                        <input type="hidden" name="d" value="1">

                                        <div class="pull-right" style="margin: 15px 9px;">
                                            <button id="send" type="submit" name="enviar" class="btn btn-guardar">Buscar</button>
                                        </div>

                                        <br>
                                        <br>
                                        <div style="display: inline-flex; margin-left: 13px;">
                                                <p class="leyenda-asistencia-personal">Asistio: <font color="#00c689"><strong>A</strong></font></p>
                                                <p class="leyenda-asistencia-personal">Tardanza: <font color="orange"><strong>T</strong></font></p>
                                                <p class="leyenda-asistencia-personal">Falto: <font color="red"><strong>F</strong></font></p>
                                                    <?php
                                                    $sql2 = "select * from laborales ORDER BY  `laborales`.`variables` ASC ";

                                                    $rs1 = mysqli_query($con, $sql2);
                                                    while ($row3 = mysqli_fetch_array($rs1)) {
                                                        $id_laboral = $row3["id_laboral"];
                                                        if ($id_laboral > 0) {
                                                            $col_var = $row3["col_var"];
                                                            $variables = $row3["variables"];
                                                            $cod_var = $row3["cod_var"];
                                                    ?>
                                                <p class="leyenda-asistencia-personal"><?php echo $variables; ?>: <font color="<?php echo $col_var; ?>"><strong><?php echo $cod_var; ?></strong></font></p>
                                                    <?php
                                                        }
                                                    }
                                                    ?>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        <!-- </div>     -->
                    </div>
                </div>

                <div class="row" style="margin: auto;">

                    <div class="table-responsive">


                        <?php


                        $fech1 = strtotime($dd1);
                        $fech2 = strtotime($dd2);
                        $f1 = $fech1 / (24 * 3600);
                        $f2 = $fech2 / (24 * 3600);
                        $fech = array();
                        $fech1 = array();
                        $j = 0;
                        $text = "";

                        for ($i = $f1; $i <= $f2; $i++) {
                            $fec[$j] = date('Y-m-d', $i * 24 * 3600);
                            $fec1[$j] = date('d-m-Y', $i * 24 * 3600);
                            if ($i < $f2) {
                                $text = $text . " SUM(IF(DATE_FORMAT(fecha_entrada,'%Y-%m-%d')='$fec[$j]',If(asistencia=0,1+TIME_TO_SEC(min_tardanza)/60,10000*asistencia),0)) AS '$fec[$j]',";
                            } else {
                                $text = $text . " SUM(IF(DATE_FORMAT(fecha_entrada,'%Y-%m-%d')='$fec[$j]' ,If(asistencia=0,1+TIME_TO_SEC(min_tardanza)/60,10000*asistencia),0)) AS '$fec[$j]'";
                            }
                            $j = $j + 1;
                        }


                        ?>
                        <table id="example" class="display" style="width:100%">
                            <thead>
                                <tr>
                                    <th class="th-general">Personal </th>
                                    <th class="th-general">Dias Asistencia</th>
                                    <th class="th-general">Min Tardanza</th>
                                    <?php
                                    for ($i = 0; $i <= $j - 1; $i++) {
                                    ?>
                                        <th class="th-general"><?php echo $fec1[$i]; ?></th>
                                    <?php
                                    }
                                    ?>


                                </tr>
                            </thead>

                            <tbody>


                                <?php

                                if ($tienda > 0) {
                                    $sql = "SELECT nombres,
$text

FROM users, asistencia WHERE users.user_id=asistencia.user_id and users.sucursal>=$tien1 and users.sucursal<=$tien2 GROUP BY nombres
";

                                    //echo $sql;
                                    $rs = mysqli_query($con, $sql);

                                    while ($row = mysqli_fetch_array($rs)) {
                                        $suma = 0;
                                        $cont = 0;
                                        for ($i = 0; $i <= $j - 1; $i++) {
                                            if ($row[$fec[$i]] >= 1 && $row[$fec[$i]] < 10000) {
                                                $suma = $suma + $row[$fec[$i]] - 1;
                                                $cont = $cont + 1;
                                            }
                                        }


                                        $d = $row['nombres'];


                                ?>

                                        <tr id="valor1">

                                            <td class=" ">
                                                <font color="black"><strong><?php echo $d; ?></strong></font>
                                            </td>

                                            <td><?php echo $cont; ?> Dias</td>
                                            <td class=" ">
                                                <font color="blue"><strong><?php echo $suma; ?>min </strong></font>
                                            </td>

                                            <?php
                                            for ($i = 0; $i <= $j - 1; $i++) {
                                                $a = "";
                                                $color = "";
                                                if ($row[$fec[$i]] == 1) {
                                                    $color = "blue";


                                                    $a = "A";
                                                }
                                                if ($row[$fec[$i]] >= 10000) {

                                                    $g = $row[$fec[$i]] / 10000;
                                                    $sql2 = "select * from $db_laborales WHERE id_laboral=$g";
                                                    $rw2 = mysqli_query($db, $sql2); //recuperando el registro
                                                    $rs2 = mysqli_fetch_array($rw2); //trasformar el registro en un vector asociativo
                                                    $a = $rs2["cod_var"];
                                                    $color = $rs2["col_var"];
                                                }

                                                if ($row[$fec[$i]] > 1 && $row[$fec[$i]] < 10000) {
                                                    $color = "orange";
                                                    $a = "T";
                                                }
                                                if ($row[$fec[$i]] == 0) {
                                                    $color = "red";
                                                    $a = "F";
                                                }
                                                if ($asistencia == 0) {
                                                    $c = $a;
                                                } else {
                                                    $c = "";
                                                    if ($row[$fec[$i]] >= 1 && $row[$fec[$i]] < 10000) {
                                                        $c = round(($row[$fec[$i]] - 1) * 100) / 100;
                                                    } else {
                                                        $c = $a;
                                                    }
                                                }
                                            ?>


                                                <td bgcolor="<?php echo $color; ?> " align="center">
                                                    <font color='white'><strong><?php echo $c; ?></strong></font>
                                                </td>
                                            <?php



                                            }
                                            ?>




                                        </tr>
                                <?php

                                    }
                                }                        ?>




                            </tbody>


                        </table>


                    </div>

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


    <!-- Datatables -->


    <!-- pace -->
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

                dom: 'Bfrtip',
                lengthMenu: [
                    [10, 25, 50, -1],
                    ['10 filas', '25 filas', '50 filas', 'Mostrar todo']
                ],
                buttons:


                    [

                        {
                            extend: 'pageLength',
                            text: 'Mostrar Filas',
                            className: 'orange'
                        },

                        {
                            extend: 'copy',
                            text: 'Copiar',
                            className: 'red'
                        },



                        {
                            extend: 'excel',
                            text: 'Excel',
                            className: 'green'
                        },
                        {
                            extend: 'csv',
                            text: 'CSV',
                            className: 'green1'
                        },
                        {
                            extend: 'print',
                            text: 'Imprimir',
                            className: 'green2'
                        }
                    ],


            });
        });
    </script>



</body>

</html>