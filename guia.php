<?php
session_start();
include('menu.php');
require_once ("config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
require_once ("config/conexion.php");//Contiene funcion que conecta a la base de datos
$accion=recoge1('accion');
$consulta5 = "SELECT * FROM documento ";
$result5 = mysqli_query($con, $consulta5);
$guia1=0;
while ($valor5 = mysqli_fetch_array($result5, MYSQLI_ASSOC)) {
    
        $guia1=$valor5['numero'];
  
}
$sql="select * from facturas, guia, clientes where facturas.id_cliente=clientes.id_cliente and facturas.id_factura=$accion"; 
$rs=mysqli_query($con,$sql);
while($row= mysqli_fetch_array($rs)){
    $id_cliente=$row['id_cliente'];
    $razonsocial=$row['nombre_cliente'];
    $ruc=$row['doc'];
    $fecha=$row['fecha_factura'];
    $numero_factura=$row['numero_factura'];
    $tipo_doc=$row['estado_factura'];
    $tienda=$row['tienda'];
}
$dia1=date("d",strtotime($fecha)); 
$mes1=date("m",strtotime($fecha));  
$ano1=date("Y",strtotime($fecha));
$dir_par="";
$dom_lleg="";
$cont_lleg="";
$tel_lleg="";
$hor_lleg="";
$vehiculo="";
$inscripcion="";
$lic="";
$fecha1="";
$sql6="select * from facturas, guia, clientes where facturas.id_factura=guia.id_doc and facturas.id_cliente=$id_cliente"; 
$rs6=mysqli_query($con,$sql6);
while($valor6= mysqli_fetch_array($rs6)){
    $dir_par=$valor6['dir_par'];
        $dom_lleg=$valor6['dom_lleg'];
        $cont_lleg=$valor6['cont_lleg'];
        $tel_lleg=$valor6['tel_lleg'];
        
        $vehiculo=$valor6['vehiculo'];
        $inscripcion=$valor6['inscripcion'];
        $lic=$valor6['lic'];
}
$consulta1 = "SELECT * FROM guia ";
$result1 = mysqli_query($con, $consulta1);
$aa=0;
while ($valor1 = mysqli_fetch_array($result1, MYSQLI_ASSOC)) {
    if($valor1['id_doc']==$accion){
        $guia=$valor1['id'];
        $dir_par=$valor1['dir_par'];
        $dom_lleg=$valor1['dom_lleg'];
        $cont_lleg=$valor1['cont_lleg'];
        $tel_lleg=$valor1['tel_lleg'];
        $hor_lleg=$valor1['hor_lleg'];
        $vehiculo=$valor1['vehiculo'];
        $inscripcion=$valor1['inscripcion'];
        $lic=$valor1['lic'];
        $fecha1=$valor1['fecha'];
        if($valor1['guia']>0){
            $guia1=$valor1['guia'];
        }
        $aa=1;
    }
}

$consulta4 = "SELECT * FROM datosempresa ";
$result4 = mysqli_query($con, $consulta4);
$dir_par="";
while ($valor4 = mysqli_fetch_array($result4, MYSQLI_ASSOC)) {
      $dir_par=$valor4['dir_emp'];
  
}

$fecha3=$dia1."/".$mes1."/".$ano1;
if($aa==0 && $accion>0){
    $insert=mysqli_query($con,"INSERT INTO guia VALUES ('','$accion','','$dir_par','$dom_lleg','$cont_lleg','$tel_lleg','','$vehiculo','$inscripcion','$lic','')");
}
$sql1="select * from users where user_id=$_SESSION[user_id]";
$rw1=mysqli_query($con,$sql1);//recuperando el registro
$rs1=mysqli_fetch_array($rw1);//trasformar el registro en un vector asociativo
$modulo=$rs1["accesos"];
$a = explode(".", $modulo); 
if (!isset($_SESSION['user_login_status']) AND $_SESSION['user_login_status'] != 1) {
    header("location: login.php");
    exit;
}
if($a[22]==0){
    header("location:error.php");    
}

?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <!-- Meta, title, CSS, favicons, etc. -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Sistema de Ventas</title>
  <link rel=alternate media=print href="https://www.google.com.pe/">
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
  <script LANGUAGE="JavaScript" SRC="calendar.js"></script>
  <script>
    function limpiarFormulario() {
      document.getElementById("guardar_producto").reset();
    }
    var mostrarValor = function(x) {
       document.getElementById('precio').value=x;
    }
    var mostrarValor2 = function(x) {
      document.getElementById('precio').value=x;
    }
  </script>
  <script LANGUAGE="JavaScript" SRC="calendar.js"></script>
  <!-- <style type="text/css"> 
    .fijo {
      background: #333;
      color: white;
      height: 10px;
      width: 100%; /* hacemos que la cabecera ocupe el ancho completo de la página */
      left: 0; /* Posicionamos la cabecera al lado izquierdo */
      top: 0; /* Posicionamos la cabecera pegada arriba */
      position: fixed; /* Hacemos que la cabecera tenga una posición fija */
    } 
  </style> -->
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
          
        <!--  espacio adicional --> 
        <br>
        <br>
        <br>
        <br>

        <div class="panel bg--secondcolor border border-color--maincolor">  
       <div class="panel panel-info">
          <div class="panel-heading">
            <h2 class="panel-title">Datos de la Guía:</h2>
          </div>        
       </div> 

          <div class="panel-body"> 
        <?php print "<form  name=\"myForm\" class=\"form-horizontal form-label-left\"   oninput=\"range_control_value.value = range_control.valueAsNumber\" action=\"guia1.php\" method=\"POST\">"; ?>
                            <div class="form-group">
        <label for="razon social" class="col-sm-3 control-label">Razon Social:</label>
        <div class="col-md-8 col-sm-8 col-xs-12">
         <input type="text" class="form-control estilo-placeholder"  readonly value="<?php echo $razonsocial;?>">
        
                                
                                </div>
        </div>
                            <div class="form-group">
        <label for="ruc" class="col-sm-3 control-label">Ruc:</label>
        <div class="col-md-8 col-sm-8 col-xs-12">
         <input type="text" class="form-control estilo-placeholder"  readonly value="<?php echo $ruc;?>">
        
                                
                                </div>
        </div>
          
                        <div class="form-group">
        <label for="fecha" class="col-sm-3 control-label">Fecha:</label>
        <div class="col-md-8 col-sm-8 col-xs-12">
         <input type="text" class="form-control estilo-placeholder"  readonly value="<?php echo $fecha3;?>">
        
                                
                                </div>
        </div>
          
                            <div class="form-group">
        <label for="doc" class="col-sm-3 control-label">Número de Guía de Remisión (verificar):</label>
        <div class="col-md-8 col-sm-8 col-xs-12">
                                    <input type="text" class="form-control estilo-placeholder" name="guia" id="guia" value="<?php echo $guia1;?>">
        
                                
                                </div>
        </div>
          
          
          
                        <div class="form-group">
        <label for="doc" class="col-sm-3 control-label">Número de Documento:</label>
        <div class="col-md-8 col-sm-8 col-xs-12">
                                    <input type="text" class="form-control estilo-placeholder" readonly id="doc" value="<?php echo $numero_factura;?>">
        <input type="hidden" name="id_guia" id="id_guia" value="<?php echo $accion;?>"> 
                                
                                </div>
        </div>
                        <div class="form-group">
                            <label for="producto" class="col-sm-3 control-label">Fecha Inicio de Traslado:</label>
                             <div class="col-md-8 col-sm-8 col-xs-12">
                            <input placeholder="mm/dd/yyyy"  name="fecha"  data-validate-length-range="4" type="date"  class="form-control estilo-placeholder col-md-10" style="float: left;" id="fecha1"  aria-describedby="inputSuccess2Status3" value="<?php echo $fecha1;?>">
                              
                            </div>
                          </div>
          
                            <div class="form-group">
        <label for="dir_par" class="col-sm-3 control-label">Dirección de Partida:</label>
        <div class="col-md-8 col-sm-8 col-xs-12">
         <input type="text"  class="form-control estilo-placeholder"  id="dir_par" name="dir_par" placeholder="Dirección de Partida" value="<?php echo $dir_par;?>">
        </div>
        </div>
        
      <div class="form-group">
        <label for="dom_lleg" class="col-sm-3 control-label">Domicilio de Llegada:</label>
        <div class="col-md-8 col-sm-8 col-xs-12">
                                    
                                    <input type="search"  class="form-control  estilo-placeholder input-sm" id="dom_lleg" name="dom_lleg" placeholder="Domicilio de Llegada" value="<?php echo $dom_lleg;?>">
        </div>
        </div>
            
          
                        <div class="form-group">
        <label for="cont_lleg" class="col-sm-3 control-label">Contacto de Llegada:</label>
        <div class="col-md-8 col-sm-8 col-xs-12">
                                    
          <input type="search"  class="form-control estilo-placeholder input-sm" id="cont_lleg" name="cont_lleg" placeholder="Contacto de Llegada" value="<?php echo $cont_lleg;?>">
        </div>
        </div>
          
                            <div class="form-group">
        <label for="tel_lleg" class="col-sm-3 control-label">Teléfono de Llegada:</label>
        <div class="col-md-8 col-sm-8 col-xs-12">
                                    
          <input type="text" class="form-control estilo-placeholder input-sm" id="tel_lleg" name="tel_lleg" placeholder="Teléfono de Llegada" value="<?php echo $tel_lleg;?>">
        </div>
        </div>
          
          
                        <div class="form-group">
        <label for="hor_lleg" class="col-sm-3 control-label">Horario de Llegada:</label>
        <div class="col-md-8 col-sm-8 col-xs-12">
                                    
          <input type="text" class="form-control estilo-placeholder input-sm" id="hor_lleg" name="hor_lleg" placeholder="Horario de Llegada" value="<?php echo $hor_lleg;?>">
        </div>
        </div>
                        <div class="form-group">
        <label for="vehiculo" class="col-sm-3 control-label">Vehiculo Marca y Placa Nro:</label>
        <div class="col-md-8 col-sm-8 col-xs-12">
                                    
          <input type="text"  class="form-control estilo-placeholder input-sm" id="vehiculo" name="vehiculo" placeholder="Vehiculo Marca y Placa Nro" value="<?php echo $vehiculo;?>">
        </div>
        </div>
          
                            <div class="form-group">
        <label for="inscripcion" class="col-sm-3 control-label">Certificado de Inscripcion Nro:</label>
        <div class="col-md-8 col-sm-8 col-xs-12">
                                    
          <input type="text"  class="form-control estilo-placeholder input-sm" id="inscripcion" name="inscripcion" placeholder="Certificado de Inscripcion Nro" value="<?php echo $inscripcion;?>">
        </div>
        </div>
          
                        <div class="form-group">
        <label for="lic" class="col-sm-3 control-label">Licencia de Conducir:</label>
        <div class="col-md-8 col-sm-8 col-xs-12">
                                    
          <input type="text"  class="form-control estilo-placeholder input-sm" id="lic" name="lic" placeholder="Licencia de Conducir" value="<?php echo $lic;?>">
        </div>
        </div>
          <?php
          $fecha5="";
          if($fecha1<>""){
                $fecha4 = explode("-", $fecha1);
                $ano2=$fecha4[0]; // porción1
                $mes2=$fecha4[1];  // porción2
                $dia2=$fecha4[2]; 
                $fecha5=$dia2."/".$mes2."/".$ano2; 
          }
          $tienda=$_SESSION['tienda'];
          
          ?>
         
          <div class="text-right">
            <button type="submit" class="btn btn-guardar" name="aceptar" >Editar</button>
          </div>

       
           </form>
    </div> <!-- panel body -->
    </div>

          <div class="text-right">
            <a class="btn btn-info" style="media:all;" href="javascript:imprSelec('muestra')"><i class="fa fa-print"></i> Imprimir Guia</a>
            <a class="btn btn-primary" target="_blanck" href="pdf/documentos/ver_factura.php?id_factura=<?php echo $accion;?>"><i class="fa fa-print"></i> Imprimir Doc</a>
          </div>
          

          <h2 class="my-3 modal-title">Area de Impresión</h2>
          
          
          <?php
          
          if($tienda==1){
              
          ?>
          
          <div id="muestra"> 

      
    <table class="th-general" style="width: 100%; text-align: left; font-size:10pt;">  
            
        <tr>
            <td class="th-general">
              <?php echo 'Fecha: '.$fecha3;?>
             </td>
            <!-- <td class="th-general">        
              <?php// echo $fecha5;?>    
            </td> -->
        </tr>   
    </table> 
  <table class="th-general" style="width: 100%; text-align: left; font-size: 10pt;">

  <td class="th-general">   
      <?php echo 'Razón Social: '.$razonsocial;?>
      </td>
    <tr><td class="th-general">
    <?php echo 'Dirección de partida: '.$dir_par;?>
    <!-- </td>
    <td class="th-general"><?php echo $dom_lleg;?></td> -->
    </tr>
    
<!-- <tr><td class="th-general">
     <?php echo $cont_lleg;?>
    </td> 
    
    <td class="th-general" colspan="2">   
    <?php echo $vehiculo;?>
    </td>
</tr> -->


<tr><td class="th-general">
    
 
        
    <?php echo 'Ruc: '.$ruc;?></td></tr>
<tr><td class="th-general" height="10">
  
  
    </td ></tr>



</table>

    
    <div class="table-responsive">
    <table class="table th-general" style="width: 100%; text-align: left; font-size: 1.5rem;">
    <tr>
                        <th class="th-general py-3">CANT.</th>                        
                        <th class="th-general py-3" colspan="2">COD. INTERNO</th>
                        <!--<th>DNI</th>-->
                        <th class="th-general py-3">DESCRIPCIÓN</th>
     </tr>
        <?php

$sql4="select * from detalle_factura, products where detalle_factura.id_producto=products.id_producto and detalle_factura.numero_factura=$numero_factura and detalle_factura.tipo_doc=$tipo_doc and detalle_factura.tienda=$tienda and ven_com=1"; 
$rs4=mysqli_query($con,$sql4);
while($row4= mysqli_fetch_array($rs4)){
    $cantidad=$row4['cantidad'];
    $codigo=$row4['codigo_producto'];
    $nombre_producto=$row4['nombre_producto'];
    print"<tr><td class=th-general width=100 height=2>$cantidad<td><td class=th-general>$codigo</td><td width=350 height=2>$nombre_producto</td></tr>";
    
}

?>

        
    </table>
    </div>
        
    
    
    
          </div>

        <?php
       
           
       }
       if($tienda==2){
              
          ?>
          
          <div id="muestra"> 

            
        <br>&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        
        <?php echo $fecha3;?>
        &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <?php echo $fecha5;?>
 
<table class="th-general">
    <tr><td class="th-general" width="550" height="20"><?php echo $dir_par;?></td><td class="th-general"><?php echo $dom_lleg;?></td></tr>
    
<tr><td class="th-general"></td><td class="th-general"><?php echo $cont_lleg;?></td><td class="th-general">
           &nbsp;&nbsp;
       &nbsp;&nbsp;&nbsp;
       &nbsp;&nbsp;&nbsp;
       &nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp;&nbsp;
    
<br>

<tr><td class="th-general">
         <br>
         
           
    &nbsp;&nbsp;
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp;&nbsp;
    
    <?php echo $razonsocial;?></td><td colspan="2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    
    <?php echo $vehiculo;?></td></tr>


<tr><td class="th-general">
  
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
     &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
     &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
     &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <?php echo $ruc;?></td><td class="th-general" colspan="2"></td></tr>
<tr><td class="th-general" height="10">
    &nbsp;&nbsp;
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp;&nbsp;
  
    </td><td class="th-general">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    
    </td><td class="th-general">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        </td class="th-general"></tr>

</table>

    
    
    <table class="th-general">
        <?php


$sql4="select * from detalle_factura, products where detalle_factura.id_producto=products.id_producto and detalle_factura.numero_factura=$numero_factura and detalle_factura.tipo_doc=$tipo_doc and detalle_factura.tienda=$tienda and ven_com=1"; 
$rs4=mysqli_query($con,$sql4);
while($row4= mysqli_fetch_array($rs4)){
    $cantidad=$row4['cantidad'];
    $codigo=$row4['codigo_producto'];
    $nombre_producto=$row4['nombre_producto'];
    print"<tr><td class=th-general width=100 height=2>$cantidad<td><td class=th-general width=100 height=2>$codigo</td><td class=th-general width=350 height=2>$nombre_producto</td></tr>";
  
}

?>
        
             
    </table>
        
    
    
    
          </div>

        <?php
       
           
       }
          
         ?>
          
          <!-- footer content -->
          <div class="pr-3 py-5 my-1">
            <?php
              footer();
            ?>
          </div>
          <!-- /footer content -->

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
    
    
    $( "#nuevoProducto1" ).submit(function( event ) {
  $('#actualizar_datos').attr("disabled", true);
  
 var parametros = $(this).serialize();
   $.ajax({
      type: "POST",
      url: "registro_productos.php",
      data: parametros,
       beforeSend: function(objeto){
        $("#resultados_ajax2").html("Mensaje: Cargando...");
        },
      success: function(datos){
      $("#resultados_ajax2").html(datos);
      $('#actualizar_datos').attr("disabled", false);
      load(1);
      }
  });
  event.preventDefault();
})


function obtener_datos(id){
      var descripcion = $("#descripcion"+id).val();
                        var equipo = $("#equipo"+id).val();
                        var com_ser = $("#com_ser"+id).val();
                        var des_ser = $("#des_ser"+id).val();
                        
                        
                        $("#mod_descripcion").val(descripcion);
                        $("#mod_equipo").val(equipo);
                        $("#mod_com_ser").val(com_ser);
                        $("#mod_des_ser").val(des_ser);
        $("#mod_id").val(id);
    
    }
     function imprimir_factura(id_factura){
      VentanaCentrada('./pdf/documentos/ver_factura.php?id_factura='+id_factura,'Factura','','1024','768','true');
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
          
  $("#nombre_producto" ).on( "keydown", function( event ) {
            if (event.keyCode== $.ui.keyCode.LEFT || event.keyCode== $.ui.keyCode.RIGHT || event.keyCode== $.ui.keyCode.UP || event.keyCode== $.ui.keyCode.DOWN || event.keyCode== $.ui.keyCode.DELETE || event.keyCode== $.ui.keyCode.BACKSPACE )
            {
              $("#id_producto" ).val("");
              $("#inv_producto" ).val("");
              $("#precio_producto" ).val("");
                      
            }
            if (event.keyCode==$.ui.keyCode.DELETE){
              $("#nombre_producto" ).val("");
              $("#id_producto" ).val("");
              $("#inv_producto" ).val("");
              $("#precio_producto" ).val("");
            }
      }); 
  
 
  </script>
  
  
  <script type="text/javascript">
function imprSelec(muestra) { 
  var ficha=document.getElementById(muestra);
  var ventimp=window.open(' ','popimpr');
  ventimp.document.write(ficha.innerHTML);
  ventimp.document.close();
  ventimp.print();
  ventimp.close();
}
</script>
  
</body>

</html>