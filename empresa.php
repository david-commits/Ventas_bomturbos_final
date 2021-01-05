<?php
session_start();
include('menu.php');
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
if($a[0]==0){
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
  <link href="https://fonts.googleapis.com/css?family=Quicksand:300,400,500,600,700&display=swap" rel="stylesheet"> 
  <script>
      function limpiarFormulario()
      {
        document.getElementById("guardar_producto").reset();
      }
  </script>
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


    .textfield10:hover {
          border:3px solid black; 
          }

    .textfield10:focus {
          border:3px solid black;
          -moz-box-shadow:inset 0 0 5px #FAFAFA;
          -webkit-box-shadow:inset 0 0 5px #FAFAFA;
          box-shadow:inset 0 0 5px #FAFAFA;
          background-color:#FAFAFA;  
          color:black;
          }

    .textfield10 {
          display: block;
          float:left;
          background-color:white;
          width:600px;
          color:#0489B1;
          padding-left: 5px;
          padding-top: 4px;
          margin:1.5px;
          border: 3px solid #BDBDBD;
          }       
  </style>
  <script type="text/javascript">
          function va(esto)
          {   
            document.getElementById('multiplicando').value=esto;
            m2 = document.getElementById("costo").value;
            m3 = document.getElementById("uti").value;
            r = esto*m2;
            document.getElementById("resultado").value = r;
            r2=document.getElementById("resultado").value;
            r1=1*r2+1*m3;
            document.getElementById("precio").value = r1;
          }
  </script> -->
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
$sql1="SELECT * FROM datosempresa WHERE id_emp=1";
$rw1=mysqli_query($con,$sql1);
while ($valor1 = mysqli_fetch_array($rw1)) {

    $nom_emp=$valor1['nom_emp'];
    $des_emp=$valor1['des_emp'];
    $mis_emp=$valor1['mis_emp'];
    $vis_emp=$valor1['vis_emp'];
    $dir_emp=$valor1['dir_emp'];
    $tel_emp=$valor1['tel_emp'];
    $email_emp=$valor1['email_emp'];
    $face_emp=$valor1['face_emp'];
    $tiwter_emp=$valor1['tiwter_emp'];
    $youtube_emp=$valor1['youtube_emp'];
    $linkedin_emp=$valor1['linkedin_emp'];
    $comentario1=$valor1['comentario1'];
    $comentario2=$valor1['comentario2'];
    $comentario3=$valor1['comentario3'];
    $comentario4=$valor1['comentario4'];
    $comentario5=$valor1['comentario5'];
   
}
?>
          
          <div class="div-contenedor" style="margin-top: 70px;">
<?php
print"<form class=\"form-horizontal form-label-left\" id=\"guardar_producto\"  action=\"empresa1.php\" method=\"POST\">";

?>
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                <h2>Cambiar datos de la empresa:</h2>
                            </div>     

                            <br>
                            <span class="campos-obligatorios">Llenar los Campos Obligatorios (*) </span>
                            <br><br>
 
                                
                           <div class="form-group">
        <label for="nom_emp" class="control-label col-md-3 col-sm-3 col-xs-12">(*) Nombre de la empresa : </label>
        <div class="col-md-9 col-sm-9 col-xs-12" >
                                    <textarea  id="valor1" class="form-control estilo-placeholder" id="nom_emp" name="nom_emp" placeholder="Nombre de la empresa" required><?php echo $nom_emp;?></textarea>
        </div>
        </div>     
                                
                              <div class="form-group">
        <label for="des_emp" class="control-label col-md-3 col-sm-3 col-xs-12">(*) Descripción de la empresa : </label>
        <div class="col-md-9 col-sm-9 col-xs-12">
                                    <textarea  id="valor1" class="form-control estilo-placeholder" id="des_emp" name="des_emp" placeholder="Descripcion de la empresa"><?php echo $des_emp;?></textarea>
        </div>
        </div> 
                    
                         <div class="form-group">
        <label for="mis_emp" class="control-label col-md-3 col-sm-3 col-xs-12">(*) Misión de la Empresa : </label>
        <div class="col-md-9 col-sm-9 col-xs-12">
                                    <textarea  id="valor1" class="form-control estilo-placeholder" id="mis_emp" name="mis_emp" placeholder="Mision de la Empresa"><?php echo $mis_emp;?></textarea>
        </div>
        </div> 
                  
                        
                       <div class="form-group">
        <label for="vis_emp" class="control-label col-md-3 col-sm-3 col-xs-12">(*) Visión de la Empresa : </label>
        <div class="col-md-9 col-sm-9 col-xs-12">
                                    <textarea id="valor1" class="form-control estilo-placeholder" id="vis_emp" name="vis_emp" placeholder="Visión de la Empresa"><?php echo $vis_emp;?></textarea>
        </div>
        </div> 
          
          
                        <div class="form-group">
        <label for="dir_emp" class="control-label col-md-3 col-sm-3 col-xs-12">(*) Dirección de la Empresa : </label>
        <div class="col-md-9 col-sm-9 col-xs-12">
                                    <textarea id="valor1" class="form-control estilo-placeholder" id="dir_emp" name="dir_emp" placeholder="Dirección de la Empresa"><?php echo $dir_emp;?></textarea>
        </div>
        </div> 
          
                        <div class="form-group">
        <label for="tel_emp" class="control-label col-md-3 col-sm-3 col-xs-12">(*) Teléfono de la Empresa : </label>
        <div class="col-md-9 col-sm-9 col-xs-12">
                                    <textarea id="valor1" class="form-control estilo-placeholder" id="tel_emp" name="tel_emp" placeholder="Dirección de la Empresa"><?php echo $tel_emp;?></textarea>
        </div>
        </div> 
   
          
                        <div class="form-group">
        <label for="email_emp" class="control-label col-md-3 col-sm-3 col-xs-12">(*) Email de la Empresa : </label>
        <div class="col-md-9 col-sm-9 col-xs-12">
                                    <textarea id="valor1" class="form-control estilo-placeholder" id="email_emp" name="email_emp" placeholder="Email de la Empresa"><?php echo $email_emp;?></textarea>
        </div>
        </div> 
          
                          <div class="form-group">
        <label for="face_emp" class="control-label col-md-3 col-sm-3 col-xs-12">Facebook de la Empresa : </label>
        <div class="col-md-9 col-sm-9 col-xs-12">
                                    <textarea id="valor1" class="form-control estilo-placeholder" id="face_emp" name="face_emp" placeholder="Facebook de la Empresa"><?php echo $face_emp;?></textarea>
        </div>
        </div> 
          
                            <div class="form-group">
        <label for="tiwter_emp" class="control-label col-md-3 col-sm-3 col-xs-12">Twitter de la Empresa : </label>
        <div class="col-md-9 col-sm-9 col-xs-12">
                                    <textarea id="valor1" class="form-control estilo-placeholder" id="tiwter_emp" name="tiwter_emp" placeholder="Twitter de la Empresa" required><?php echo $tiwter_emp;?></textarea>
        </div>
        </div> 
                          <div class="form-group">
        <label for="youtube_emp" class="control-label col-md-3 col-sm-3 col-xs-12">Youtube de la Empresa : </label>
        <div class="col-md-9 col-sm-9 col-xs-12">
                                    <textarea id="valor1" class="form-control estilo-placeholder" id="youtube_emp" name="youtube_emp" placeholder="Youtube de la Empresa"><?php echo $youtube_emp;?></textarea>
        </div>
        </div> 
          
                            <div class="form-group">
        <label for="linkedin_emp" class="control-label col-md-3 col-sm-3 col-xs-12">Linkedin de la Empresa : </label>
        <div class="col-md-9 col-sm-9 col-xs-12">
                                    <textarea id="valor1" class="form-control estilo-placeholder" id="linkedin_emp" name="linkedin_emp" placeholder="Linkedin de la Empresa"><?php echo $linkedin_emp;?></textarea>
        </div>
        </div>

        <h4 class="separador-form">Datos Adicionales de la Empresas : </h4>
        
        <div class="form-group">
          <label for="comentario1" class="control-label col-md-3 col-sm-3 col-xs-12 text-right">Comentario Slider1 : </label>
          <div class="col-md-9 col-sm-9 col-xs-12">
              <textarea id="valor1" class="form-control estilo-placeholder" id="comentario1" name="comentario1" placeholder="Comentario Slider1"><?php echo $comentario1;?></textarea>
          </div>
        </div>   
        
        <div class="form-group">
          <label for="comentario2" class="control-label col-md-3 col-sm-3 col-xs-12 text-right">Comentario Slider2 : </label>
          <div class="col-md-9 col-sm-9 col-xs-12">
              <textarea id="valor1" class="form-control estilo-placeholder" id="comentario2" name="comentario2" placeholder="Comentario Slider2"><?php echo $comentario2;?></textarea>
          </div>
        </div> 
              
        <div class="form-group">
          <label for="comentario3" class="control-label col-md-3 col-sm-3 col-xs-12 text-right">Comentario Slider3 : </label>
          <div class="col-md-9 col-sm-9 col-xs-12">
              <textarea id="valor1" class="form-control estilo-placeholder" id="comentario3" name="comentario3" placeholder="Comentario Slider3"><?php echo $comentario3;?></textarea>
          </div>
        </div>
              
        <div class="form-group">
          <label for="comentario4" class="control-label col-md-3 col-sm-3 col-xs-12 text-right">Comentario Slider4 : </label>
          <div class="col-md-9 col-sm-9 col-xs-12">
              <textarea id="valor1" class="form-control estilo-placeholder" id="comentario4" name="comentario4" placeholder="Comentario Slider4"><?php echo $comentario4;?></textarea>
          </div>
        </div>
        
        <div class="form-group">
          <label for="comentario4" class="control-label col-md-3 col-sm-3 col-xs-12 text-right">Comentario Slider5 : </label>
          <div class="col-md-9 col-sm-9 col-xs-12">
              <textarea id="valor1" class="form-control estilo-placeholder" id="comentario5" name="comentario5" placeholder="Comentario Slider5"><?php echo $comentario5;?></textarea>
          </div>
        </div>
  
      <div class="modal-footer">
          <button type="submit" class="btn btn-guardar" id="guardar_datos">Guardar datos</button>
      </div>

        </div>
        </div>
      </form>

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
  </script>
  
  
  
</body>

</html>




