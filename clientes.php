<?php
session_start();
include('menu.php');
/* Connect To Database*/
require_once ("config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
require_once ("config/conexion.php");//Contiene funcion que conecta a la base de datos
$sql1="select * from users where user_id=$_SESSION[user_id]";
$rw1=mysqli_query($con,$sql1);//recuperando el registro
$rs1=mysqli_fetch_array($rw1);//trasformar el registro en un vector asociativo
$modulo=$rs1["accesos"];
$a = explode(".", $modulo); 
if (!isset($_SESSION['user_login_status']) AND $_SESSION['user_login_status'] != 1) {
    header("location: login.php");
    exit;
}
if($a[18]==0){
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
  <script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.1/js/dataTables.responsive.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.colVis.min.js"></script>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css" />
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
          <!-- /sidebar menu -->

          <!-- /menu footer buttons -->
          
          <!-- /menu footer buttons -->
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
                  <div class="btn-group pull-right">
                    <button type='button' class="btn btn-header" data-toggle="modal" onclick="limpiarformulario()" data-target="#nuevoCliente"><span class="glyphicon glyphicon-plus"></span> Nuevo Cliente</button>
                  </div>
                  <h4>Clientes</h4>
    </div>
    <div class="panel-body">
    
      
      
      <?php
        include("modal/registro_clientes.php");
        include("modal/editar_clientes.php");
                                
                                
      ?>
      
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
        $(document).ready(function(){
      load(1);
    });

    function load(page){
      console.log('si entra al load');
      var q= $("#q").val();
      $("#loader").fadeIn('slow');
      $.ajax({
        url:'./ajax/buscar_clientes.php?action=ajax&page='+page+'&q='+q,
         beforeSend: function(objeto){
         $('#loader').html('<img src="./img/ajax-loader.gif"> Cargando...');
        },
        success:function(data){
          $(".outer_div").html(data).fadeIn('slow');
          $('#loader').html('');
          
        }
      })
    }

  
    
      function eliminar (id)
    {
      var q= $("#q").val();
    if (confirm("Realmente deseas eliminar el cliente")){ 
    $.ajax({
        type: "GET",
        url: "./ajax/buscar_clientes.php",
        data: "id="+id,"q":q,
     beforeSend: function(objeto){
      $("#resultados").html("Mensaje: Cargando...");
      },
        success: function(datos){
    $("#resultados").html(datos);
    load(1);
    }
      });
    }
    }
    
    
  
$( "#guardar_cliente" ).submit(function( event ) {
  $('#guardar_datos').attr("disabled", true);
  
 var parametros = $(this).serialize();
   $.ajax({
      type: "POST",
      url: "ajax/nuevo_cliente.php",
      data: parametros,
       beforeSend: function(objeto){
        $("#resultados_ajax").html("Mensaje: Cargando...");
        },
      success: function(datos){
      $("#resultados_ajax").html(datos);
      $('#guardar_datos').attr("disabled", false);
      limpiarFormulario();
      load(1);
      }
  });
  event.preventDefault();
})

$( "#editar_cliente" ).submit(function( event ) {
  $('#actualizar_datos').attr("disabled", true);
  
 var parametros = $(this).serialize();
   $.ajax({
      type: "POST",
      url: "ajax/editar_cliente.php",
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
      var nombre_cliente = $("#nombre_cliente"+id).val();
                        var doc = $("#doc"+id).val();
                        var dni = $("#dni"+id).val();
                        var vendedor = $("#vendedor"+id).val();
      var telefono_cliente = $("#telefono_cliente"+id).val();
      var email_cliente = $("#email_cliente"+id).val();
      var direccion_cliente = $("#direccion_cliente"+id).val();
      var status_cliente = $("#status_cliente"+id).val();
                        
                        var departamento = $("#departamento"+id).val();
                        var provincia = $("#provincia"+id).val();
                        var distrito = $("#distrito"+id).val();
                        var cuenta = $("#cuenta"+id).val();
                        
                        var od1 = $("#od1"+id).val();
                        var od2 = $("#od2"+id).val();
                        var od3 = $("#od3"+id).val();
                        var od4 = $("#od4"+id).val();
                        var od5 = $("#od5"+id).val();
                        var od6 = $("#od6"+id).val();
                        var od7 = $("#od7"+id).val();
                        var od8 = $("#od8"+id).val();
                        
                        var oi1 = $("#oi1"+id).val();
                        var oi2 = $("#oi2"+id).val();
                        var oi3 = $("#oi3"+id).val();
                        var oi4 = $("#oi4"+id).val();
                        var oi5 = $("#oi5"+id).val();
                        var oi6 = $("#oi6"+id).val();
                        var oi7 = $("#oi7"+id).val();
                        var oi8 = $("#oi8"+id).val();

                        var prct_desc = $("#prct_desc"+id).val();
                        var id_sucursal_cliente = $("#id_sucursal_cliente"+id).val();
                        var ver_codigo = $("#ver_codigo"+id).val();


                        var username_mod = $("#user_name"+id).val();
                        var clave_mod = $("#clave"+id).val();
                        console.log('primero');
                        console.log(username_mod);
                        console.log(clave_mod);
                        console.log('primero');
                        
                        $("#mod_usuario_cliente").val(username_mod);
                        $("#mod_clave_cliente").val(clave_mod);

                        $("#mod_ver_codigo_cliente").val(ver_codigo);
                        $("#mod_sucursal_cliente").val(id_sucursal_cliente);
                        $("#mod_prct_cliente_desc").val(prct_desc);

                        
                        $("#mod_nombre").val(nombre_cliente);
                        $("#mod_doc").val(doc);
                        $("#mod_dni").val(dni);
                        $("#mod_ven").val(vendedor);
      $("#mod_telefono").val(telefono_cliente);
      $("#mod_email").val(email_cliente);
      $("#mod_direccion").val(direccion_cliente);
      $("#mod_estado").val(status_cliente);                      
                        $("#mod_id").val(id);
                        
                        $("#mod_departamento").val(departamento);    
                        $("#mod_provincia").val(provincia);    
                        $("#mod_distrito").val(distrito);    
                        $("#mod_cuenta").val(cuenta); 
                        
                        $("#odm1").val(od1);
                        $("#odm2").val(od2);
                        $("#odm3").val(od3);
                        $("#odm4").val(od4);
                        $("#odm5").val(od5);
                        $("#odm6").val(od6);
                        $("#odm7").val(od7);
                        $("#odm8").val(od8);
                        
                        $("#oim1").val(oi1);
                        $("#oim2").val(oi2);
                        $("#oim3").val(oi3);
                        $("#oim4").val(oi4);
                        $("#oim5").val(oi5);
                        $("#oim6").val(oi6);
                        $("#oim7").val(oi7);
                        $("#oim8").val(oi8);
                        
    
    }
  
        
        
        
        
        </script>

        
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
          
  $("#q" ).on( "keydown", function( event ) {
            if (event.keyCode== $.ui.keyCode.LEFT || event.keyCode== $.ui.keyCode.RIGHT || event.keyCode== $.ui.keyCode.UP || event.keyCode== $.ui.keyCode.DOWN || event.keyCode== $.ui.keyCode.DELETE || event.keyCode== $.ui.keyCode.BACKSPACE )
            {
              $("#id_cliente" ).val("");
              $("#tel1" ).val("");
              $("#mail" ).val("");
                      
            }
            if (event.keyCode==$.ui.keyCode.DELETE){
              $("#q" ).val("");
              $("#id_cliente" ).val("");
              $("#tel1" ).val("");
              $("#mail" ).val("");
            }
      });
        
        
        
      
 
  </script>

        
        
        
        
  </body>
</html>






























