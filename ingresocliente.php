<script>
  function soloNumeros(e){
    var key = window.event ? e.which : e.keyCode;
    if (key < 48 || key > 57) {
        //Usando la definición del DOM level 2, "return" NO funciona.
        e.preventDefault();
    }
  }
</script><?php
session_start();
include('menu.php');
require_once ("config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
require_once ("config/conexion.php");//Contiene funcion que conecta a la base de datos
$consulta2 = "SELECT * FROM datosempresa ";
$result2 = mysqli_query($con, $consulta2);
$valor2 = mysqli_fetch_array($result2, MYSQLI_ASSOC);
$dolar=$valor2['dolar'];
$sql1="select * from users where user_id=$_SESSION[user_id]";
$rw1=mysqli_query($con,$sql1);//recuperando el registro
$rs1=mysqli_fetch_array($rw1);//trasformar el registro en un vector asociativo
$doc="";
$nombre="";  
$sql2="select * from consultas where tipo=30";
$rw2=mysqli_query($con,$sql2);//recuperando el registro
$rs2=mysqli_fetch_array($rw2);//trasformar el registro en un vector asociativo
$doc=$rs2["a1"];
$nombre=$rs2["a2"];
$telefono=$rs2["a3"];
$direccion=$rs2["a4"];
$departamento="";
$provincia="";
$distrito="";
$accion=recoge1("accion");   
 if(isset($direccion)) {

     $direccion1=$direccion;
     $p1 = explode(" - ", $direccion1);
    
  $r="";   

$resultado = strpos($direccion1,"LA LIBERTAD -");
 
if($resultado !== FALSE){
    $departamento="LA LIBERTAD";
}
    
$resultado1 = strpos($direccion1,"AMAZONAS -");
 
if($resultado1 !== FALSE){
    $departamento="AMAZONAS";
}

$resultado2 = strpos($direccion1,"ANCASH -");
 
if($resultado2 !== FALSE){
    $departamento="ANCASH";
}

$resultado2 = strpos($direccion1,"APURIMAC -");
 
if($resultado2 !== FALSE){
    $departamento="APURIMAC";
}

$resultado2 = strpos($direccion1,"AYACUCHO -");
 
if($resultado2 !== FALSE){
    $departamento="AYACUCHO";
}
 
$resultado2 = strpos($direccion1,"CAJAMARCA -");
 
if($resultado2 !== FALSE){
    $departamento="CAJAMARCA";
}

$resultado2 = strpos($direccion1,"CALLAO -");
 
if($resultado2 !== FALSE){
    $departamento="CALLAO";
}

$resultado2 = strpos($direccion1,"CUSCO -");
 
if($resultado2 !== FALSE){
    $departamento="CUSCO";
}

$resultado2 = strpos($direccion1,"HUANCAVELICA -");
 
if($resultado2 !== FALSE){
    $departamento="HUANCAVELICA";
}

$resultado2 = strpos($direccion1,"HUANUCO -");
 
if($resultado2 !== FALSE){
    $departamento="HUANUCO";
}

$resultado2 = strpos($direccion1,"ICA -");
 
if($resultado2 !== FALSE){
    $departamento="ICA";
}


$resultado2 = strpos($direccion1,"JUNIN -");
 
if($resultado2 !== FALSE){
    $departamento="JUNIN";
}


$resultado2 = strpos($direccion1,"LAMBAYEQUE -");
 
if($resultado2 !== FALSE){
    $departamento="LAMBAYEQUE";
}

$resultado2 = strpos($direccion1,"LIMA -");
 
if($resultado2 !== FALSE){
    $departamento="LIMA";
}

$resultado2 = strpos($direccion1,"LORETO -");
 
if($resultado2 !== FALSE){
    $departamento="LORETO";
}

$resultado2 = strpos($direccion1,"MADRE DE DIOS -");
 
if($resultado2 !== FALSE){
    $departamento="MADRE DE DIOS";
}

$resultado2 = strpos($direccion1,"MOQUEGUA -");
 
if($resultado2 !== FALSE){
    $departamento="MOQUEGUA";
}

$resultado2 = strpos($direccion1,"PASCO -");
 
if($resultado2 !== FALSE){
    $departamento="PASCO";
}

$resultado2 = strpos($direccion1,"PIURA -");
 
if($resultado2 !== FALSE){
    $departamento="PIURA";
}

$resultado2 = strpos($direccion1,"PUNO -");
 
if($resultado2 !== FALSE){
    $departamento="PUNO";
}


$resultado2 = strpos($direccion1,"SAN MARTIN -");
 
if($resultado2 !== FALSE){
    $departamento="SAN MARTIN";
}

$resultado2 = strpos($direccion1,"TACNA -");
 
if($resultado2 !== FALSE){
    $departamento="TACNA";
}

$resultado2 = strpos($direccion1,"TUMBES -");
 
if($resultado2 !== FALSE){
    $departamento="TUMBES";
}

$resultado2 = strpos($direccion1,"UCAYALI -");
 
if($resultado2 !== FALSE){
    $departamento="UCAYALI";
}

if(!isset($p1[1]))
{
  $p1[1] = "";
}
if(!isset($p1[2]))
{
  $p1[2] = "";
}
 
    $provincia=$p1[1];
    $distrito=$p1[2];
 }    
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
<html lang="en">

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

<style type="text/css"> 
    .fijo {
  background: #333;
  color: white;
  height: 10px;
  
  width: 100%; /* hacemos que la cabecera ocupe el ancho completo de la página */
  left: 0; /* Posicionamos la cabecera al lado izquierdo */
  top: 0; /* Posicionamos la cabecera pegada arriba */
  position: fixed; /* Hacemos que la cabecera tenga una posición fija */
} 


.textfield10:hover {
                    border:3px solid black; 
}
.textfield10:focus {border:3px solid black;
                    -moz-box-shadow:inset 0 0 5px #FAFAFA;
-webkit-box-shadow:inset 0 0 5px #FAFAFA;
box-shadow:inset 0 0 5px #FAFAFA;
                  background-color:#FAFAFA;  
                  color:black;
}
.textfield10{display: block;  float:left;  background-color:white; width:600px;color:#0489B1;
          padding-left: 5px;
          padding-top: 4px; margin:1.5px; border: 3px solid #BDBDBD;
}

</style>
 
<!-- <style>
    table tr:nth-child(odd) {background-color: #FBF8EF;}

table tr:nth-child(even) {background-color: #EFFBF5;}
 .valor1 {
              

border-bottom: 2px solid #F5ECCE;

}  

-valor1:hover {
              
background-color: white;
border-bottom: 2px solid #A9E2F3;

} 


</style> -->


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

          <br>
          <br>
          <br>
          <br>

        <div class="container">
          <div class="panel panel-info">

            <div class="panel-heading">
              <h3><img src="images/sunat.png" width="30" height="30"> Buscar R.U.C. del Cliente:</h3>
            </div>

            <?php
            if ($accion <> "") {
            ?>
              <div class="alert alert-danger" role="alert">
                <strong>Error Cliente Duplicado</strong>
              </div>
            <?php
            }
            ?>

          <div class="panel-body">
            <div class="modal-body">
              <form class="form-horizontal" method="post" id="guardar_cliente" name="guardar_cliente" action="ingresocliente1.php">

                <div class="form-group">
                  <label for="doc" class="col-sm-3 control-label">RUC:</label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="number" class="form-control estilo-placeholder" value="<?php echo $doc; ?>" id="doc" name="doc" placeholder="BUSCAR RUC SUNAT" required="">
                  </div>
                  <div class="col-md-2 col-sm-2 col-xs-12">
                    <button type="submit" class="btn btn-guardar" name="ruc1" value="1" id="ruc1" style="margin-top: 0px;">Buscar Ruc Sunat</button>
                  </div>
                </div>

                <div class="form-group">
                  <label for="nombre" class="col-sm-3 control-label">Razon Social:</label>
                  <div class="col-md-8 col-sm-8 col-xs-12">
                    <input type="text" class="form-control estilo-placeholder" value="<?php echo $nombre; ?>" id="nombre" name="nombre" placeholder="Razon Social">
                  </div>
                </div>

                <div class="form-group">
                  <label for="doc" class="col-sm-3 control-label">DNI:</label>
                  <div class="col-md-8 col-sm-8 col-xs-12">
                    <input type="number" class="form-control estilo-placeholder" id="dni" name="dni" placeholder="DNI">
                  </div>
                </div>

                <div class="form-group">
                  <label for="telefono" class="col-sm-3 control-label">Teléfono:</label>
                  <div class="col-md-8 col-sm-8 col-xs-12">
                    <input type="number" class="form-control estilo-placeholder" value="<?php echo $telefono; ?>" id="telefono" name="telefono" placeholder="Teléfono">
                  </div>
                </div>

                <div class="form-group">
                  <label for="email" class="col-sm-3 control-label">Email:</label>
                  <div class="col-md-8 col-sm-8 col-xs-12">
                    <input type="email" class="form-control estilo-placeholder" id="email" name="email" placeholder="Email">
                  </div>
                </div>

                <div class="form-group">
                  <label for="departamento" class="col-sm-3 control-label">Departamento:</label>
                  <div class="col-md-8 col-sm-8 col-xs-12">
                    <input type="text" class="form-control estilo-placeholder" value="<?php echo $departamento; ?>" id="departamento" name="departamento" placeholder="Departamento">
                  </div>
                </div>

                <div class="form-group">
                  <label for="provincia" class="col-sm-3 control-label">Provincia:</label>
                  <div class="col-md-8 col-sm-8 col-xs-12">
                    <input type="text" class="form-control estilo-placeholder" value="<?php echo $provincia; ?>" id="provincia" name="provincia" placeholder="Provincia">
                  </div>
                </div>

                <div class="form-group">
                  <label for="distrito" class="col-sm-3 control-label">Distrito:</label>
                  <div class="col-md-8 col-sm-8 col-xs-12">
                    <input type="text" class="form-control estilo-placeholder" value="<?php echo $distrito; ?>" id="distrito" name="distrito" placeholder="Distrito">
                  </div>
                </div>

                <div class="form-group">
                  <label for="direccion" class="col-sm-3 control-label">Dirección:</label>
                  <div class="col-md-8 col-sm-8 col-xs-12">
                    <textarea class="form-control estilo-placeholder" id="direccion" name="direccion" maxlength="255" placeholder="Dirección"><?php echo $direccion; ?></textarea>
                  </div>
                </div>

                <div class="form-group">
                  <label for="cuenta" class="col-sm-3 control-label">Cuenta Bancaria:</label>
                  <div class="col-md-8 col-sm-8 col-xs-12">
                    <textarea class="form-control estilo-placeholder" id="cuenta" name="cuenta" maxlength="255" placeholder="Cuenta Bancaria"></textarea>
                  </div>
                </div>

                <div class="form-group">
                  <label for="ven" class="col-sm-3 control-label">Vendedor:</label>
                  <div class="col-md-8 col-sm-8 col-xs-12">
                    <input type="text" class="form-control estilo-placeholder" id="ven" name="ven" placeholder="Vendedor">
                  </div>
                </div>

                <div class="form-group">
                  <label for="estado" class="col-sm-3 control-label">Estado:</label>
                  <div class="col-md-8 col-sm-8 col-xs-12">
                    <select class="form-control estilo-placeholder" id="estado" name="estado" required>
                      <option class="custom-select" value="">-- Selecciona estado --</option>
                      <option class="custom-select" value="1" selected>Activo</option>
                      <option class="custom-select" value="0">Inactivo</option>
                    </select>
                  </div>
                </div>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-limpiar" onclick="limpiarFormulario()">Limpiar</button>
                <button type="button" class="btn btn-cancelar" data-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-agregar" id="aceptar" name="aceptar" value="1">Guardar Cliente</button>
            </div>

            </form>
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


  <!-- Datatables -->
  <script src="js/datatables/js/jquery.dataTables.js"></script>
  <script src="js/datatables/tools/js/dataTables.tableTools.js"></script>

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



var input=  document.getElementById('doc');
input.addEventListener('input',function(){
  if (this.value.length > 20) 
     this.value = this.value.slice(0,20); 
})

var input=  document.getElementById('dni');
input.addEventListener('input',function(){
  if (this.value.length > 8) 
     this.value = this.value.slice(0,8); 
})
var input=  document.getElementById('telefono');
input.addEventListener('input',function(){
  if (this.value.length > 20) 
     this.value = this.value.slice(0,20); 
})

  </script>
  
  
  
</body>

</html>




