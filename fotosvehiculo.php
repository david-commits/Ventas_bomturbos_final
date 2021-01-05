  <?php
  session_start();
  include('menu.php');
  require_once ("config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
  require_once ("config/conexion.php");//Contiene funcion que conecta a la base de datos
  $disabled1="";
  $disabled2="";
  $disabled3="";
  $disabled4="";
  $consulta1 = "SELECT * FROM vehiculos where estado = 1 ";
  $result1 = mysqli_query($con, $consulta1);
  $id_vehiculo=$_SESSION['id_vehiculo'];
  while ($valor1 = mysqli_fetch_array($result1, MYSQLI_ASSOC)) {
      if ($valor1['d_vehiculo']==$id_vehiculo){

      $vehiculo_desc=$valor1['detalle'];
      $nfotoprincipal=$valor1['fotoprincipal'];

      //$codigo=$valor1['codigo_producto'];
      $foto1=$valor1['foto1'];
      $foto2=$valor1['foto2'];
      $foto3=$valor1['foto3'];
      $foto4=$valor1['foto4'];
      //$pre_web=$valor1['pre_web'];
      //$descripcion=$valor1['descripcion'];
      $web=$valor1['web'];
      if($foto1<>"nuevo.jpg"){
          $disabled1="disabled";
      }
      if($foto2<>"nuevo.jpg"){
          $disabled2="disabled";
      }
      if($foto3<>"nuevo.jpg"){
          $disabled3="disabled";
      }
      if($foto4<>"nuevo.jpg"){
          $disabled4="disabled";
      }
      
      
      
      }
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
  if($a[2]==0){
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

    <title>Fotos de Vehículos</title>
    <link rel="icon" href="images/usuario16.jpg">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="fonts/css/font-awesome.min.css" rel="stylesheet">
    <link href="css/animate.min.css" rel="stylesheet">
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
  </script>
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

  .thumb {
              height: 180px;
              width:170px;
              border: 1px solid #000;
              margin: 10px 5px 0 0;
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
            padding-top: 4px; margin:1.5px;	border: 3px solid #BDBDBD;
  }

  </style>
    
       
     
  </head>

  <body class="nav-md">

    <div class="container body">


      <div class="main_container">

        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">

            <!-- <div class="navbar nav_title" style="border: 0;">
              <a href="index.html" class="site_title"><i class="fa fa-paw"></i> <span>Facturacion</span></a>
            </div> -->
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
            
      <div>  
            
            
  <div class="panel panel-info ">
    <br><br><br>
      <div class="panel-heading">
          Editar datos del vehículo para web:
      </div>        
  </div>  
        
           <?php         
  print"<form class=\"form-horizontal form-label-left\" action=\"fotos2_vehiculo.php\" enctype=\"multipart/form-data\"  method=\"POST\">";

  ?>
         
           
                              <div class="form-group">
  				<label for="nombre" class="col-sm-3 control-label">Nombre del Vehículo:</label>
  				<div class="col-sm-8">
  					<input  type="text" class="form-control estilo-placeholder"  name="nombre" value="<?php echo $vehiculo_desc;?>" readonly="">
  				  
  				</div>
  			  </div>
                          <div class="form-group">
  				<label for="nombre" class="col-sm-3 control-label">Mostrar Web:</label>
  				<div class="col-sm-8">
                                      <select name="web" class="estilo-placeholder">
                                          <?php 
                                          if($web==1){
                                          ?>
                                          <option class="custom-select" selected value="1">Si</option>
                                          <?php
                                          }else{
                                           ?>   
                                          <option class="custom-select" value="1">Si</option>    
                                          <?php
                                          }
                                          ?>
                                          
                                           <?php 
                                          if($web==0){
                                          ?>
                                          <option class="custom-select" selected value="0">No</option>
                                          <?php
                                          }else{
                                              
                                          ?>
                                          <option class="custom-select" value="0">No</option>    
                                          <?php
                                          }
                                          ?>
                                          
                                      </select>
  				  
  				</div>
  			  </div>  
            
           
              <div class="form-group">
                <label for="nombre" class="col-sm-3 control-label">Ingresar foto1:<font class="text-warning"> Medida: 340x340</font></label>
  				        <div class="col-sm-8">
                    <input <?php echo $disabled1;?> accept="image/jpeg" type="file" id="files" name="files" class="form-control estilo-placeholder"/>
                      <?php
                        if($foto1<>"nuevo.jpg"){
                      ?>
                          <a href="fotos3_vehiculo.php?vehiculo=1"><img class="thumb" src="fotos_vehiculo/<?php echo $foto1;?>" onmouseover="this.src='images/eliminar.png';" onmouseout="this.src='fotos_vehiculo/<?php echo $foto1;?>';"></a>
                            <?php
                        }
                            ?>
                                     <output id="list"></output>
  	
          
  				</div>
          <?php 

            if ($nfotoprincipal == 1) {
              ?>
                <input type="checkbox" name="valor1"  id="valor1" value="1"  class="only-one" checked>            
              <?php 
            }else
            {
              ?>
                <input type="checkbox" name="valor1"  id="valor1" value="1"  class="only-one" >
              <?php
            }

          ?>
        
  			  </div> 
            
                              <div class="form-group">
  				<label for="nombre" class="col-sm-3 control-label">Ingresar foto2:<font class="text-warning"> Medida: 340x340</font></label>
  				<div class="col-sm-8">
  				<input <?php echo $disabled2;?> accept="image/jpeg" type="file" id="files1" name="files1" class="form-control estilo-placeholder"/>
         
                                  <?php
                                  if($foto2<>"nuevo.jpg"){
            
                                  ?>
                                          <a href="fotos3_vehiculo.php?vehiculo=2"><img class="thumb" src="fotos_vehiculo/<?php echo $foto2;?>" onmouseover="this.src='images/eliminar.png';" onmouseout="this.src='fotos_vehiculo/<?php echo $foto2;?>';"></a>
                                  <?php
                                  }
        
                                  ?>                                
                               
                                  <output id="list1"></output>
  				 
  				</div>
          <?php 

            if ($nfotoprincipal == 2) {
              ?>
                <input type="checkbox" name="valor2"  id="valor2" value="2"  class="only-one" checked>            
              <?php 
            }else
            {
              ?>
                <input type="checkbox" name="valor2"  id="valor2" value="2"  class="only-one" >
              <?php
            }

          ?>
  			  </div> 
            
            
                              <div class="form-group">
  				<label for="nombre" class="col-sm-3 control-label">Ingresar foto3:<font class="text-warning"> Medida: 340x340</font></label>
  				<div class="col-sm-8">
                                  <input <?php echo $disabled3;?> accept="image/jpeg" type="file" id="files2" name="files2" class="form-control estilo-placeholder"/>
         
                                  <?php
                                  if($foto3<>"nuevo.jpg"){
            
                                  ?>
                                          <a href="fotos3_vehiculo.php?vehiculo=3"><img class="thumb" src="fotos_vehiculo/<?php echo $foto3;?>" onmouseover="this.src='images/eliminar.png';" onmouseout="this.src='fotos_vehiculo/<?php echo $foto3;?>';"></a>
                                  <?php
                                  }
                                  ?>                                
                                     
                                   <output id="list2"></output>
  				 
  				</div>
          <?php 

            if ($nfotoprincipal == 3) {
              ?>
                <input type="checkbox" name="valor3"  id="valor3" value="3"  class="only-one" checked>            
              <?php 
            }else
            {
              ?>
                <input type="checkbox" name="valor3"  id="valor3" value="3"  class="only-one" >
              <?php
            }

          ?>
  			  </div> 
            
            
            
                          <div class="form-group">
  				<label for="nombre" class="col-sm-3 control-label">Ingresar foto4:<font class="text-warning"> Medida: 340x340</font></label>
  				<div class="col-sm-8">
  				<input <?php echo $disabled4;?> accept="image/jpeg" type="file" id="files3" name="files3" class="form-control estilo-placeholder"/>
                                  <?php
                                  if($foto4<>"nuevo.jpg"){
            
                                  ?>
                                          <a href="fotos3_vehiculo.php?vehiculo=4"><img class="thumb" src="fotos_vehiculo/<?php echo $foto4;?>" onmouseover="this.src='images/eliminar.png';" onmouseout="this.src='fotos_vehiculo/<?php echo $foto4;?>';"></a>
                                  <?php
                                  }
        
                                  ?>                                
             
                              <output id="list3"></output>
  				 
  				</div>
           <?php 

            if ($nfotoprincipal == 4) {
              ?>
                <input type="checkbox" name="valor4"  id="valor4" value="4"  class="only-one" checked>            
              <?php 
            }else
            {
              ?>
                <input type="checkbox" name="valor4"  id="valor4" value="4"  class="only-one" >
              <?php
            }

          ?>

  			  </div> 
            <script>
  		  function archivo(evt) {
  			var files = evt.target.files; // FileList object
  		
  			// Obtenemos la imagen del campo "file".
  			for (var i = 0, f; f = files[i]; i++) {
  			  //Solo admitimos imágenes.
  			  if (!f.type.match('image.*')) {
  				continue;
  			  }
  		
  			  var reader = new FileReader();
  		
  			  reader.onload = (function(theFile) {
  				return function(e) {
  				  // Insertamos la imagen
  				 document.getElementById("list").innerHTML = ['<img class="thumb" src="', e.target.result,'" title="', escape(theFile.name), '"/>'].join('');
  				};
  			  })(f);
  		
  			  reader.readAsDataURL(f);
  			}
  		  }
  		
                  function archivo1(evt) {
  			var files1 = evt.target.files; // FileList object
  		
  			// Obtenemos la imagen del campo "file".
  			for (var i = 0, f; f = files1[i]; i++) {
  			  //Solo admitimos imágenes.
  			  if (!f.type.match('image.*')) {
  				continue;
  			  }
  		
  			  var reader = new FileReader();
  		
  			  reader.onload = (function(theFile) {
  				return function(e) {
  				  // Insertamos la imagen
  				 document.getElementById("list1").innerHTML = ['<img class="thumb" src="', e.target.result,'" title="', escape(theFile.name), '"/>'].join('');
  				};
  			  })(f);
  		
  			  reader.readAsDataURL(f);
  			}
  		  }
                  
                  
                   function archivo2(evt) {
  			var files2 = evt.target.files; // FileList object
  		
  			// Obtenemos la imagen del campo "file".
  			for (var i = 0, f; f = files2[i]; i++) {
  			  //Solo admitimos imágenes.
  			  if (!f.type.match('image.*')) {
  				continue;
  			  }
  		
  			  var reader = new FileReader();
  		
  			  reader.onload = (function(theFile) {
  				return function(e) {
  				  // Insertamos la imagen
  				 document.getElementById("list2").innerHTML = ['<img class="thumb" src="', e.target.result,'" title="', escape(theFile.name), '"/>'].join('');
  				};
  			  })(f);
  		
  			  reader.readAsDataURL(f);
  			}
  		  }
                  
                  
                  
                  function archivo3(evt) {
  			var files3 = evt.target.files; // FileList object
  		
  			// Obtenemos la imagen del campo "file".
  			for (var i = 0, f; f = files3[i]; i++) {
  			  //Solo admitimos imágenes.
  			  if (!f.type.match('image.*')) {
  				continue;
  			  }
  		
  			  var reader = new FileReader();
  		
  			  reader.onload = (function(theFile) {
  				return function(e) {
  				  // Insertamos la imagen
  				 document.getElementById("list3").innerHTML = ['<img class="thumb" src="', e.target.result,'" title="', escape(theFile.name), '"/>'].join('');
  				};
  			  })(f);
  		
  			  reader.readAsDataURL(f);
  			}
  		  }
                  
  		  document.getElementById('files').addEventListener('change', archivo, false);
                    document.getElementById('files1').addEventListener('change', archivo1, false);
                    document.getElementById('files2').addEventListener('change', archivo2, false);
                    document.getElementById('files3').addEventListener('change', archivo3, false);
  	</script>
     
             <div class="modal-footer">
                       
  			<button type="submit" class="btn btn-agregar" id="guardar_datos">Guardar datos</button>
  		  
                    </div>
  		  </form> 
            
            
            </div>

            </div>

          <div style="padding-right: 20px !important;">
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



  let Checked = null;
  //The class name can vary
  for (let CheckBox of document.getElementsByClassName('only-one')){
    CheckBox.onclick = function(){
      if(Checked!=null){
        Checked.checked = false;
        Checked = CheckBox;
      }
      Checked = CheckBox;
    }
  }



    </script>
    
    
    
  </body>

  </html>




