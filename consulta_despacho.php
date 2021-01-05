<!--   <style type="text/css">
     .thumbnail1{
    position: relative;
    z-index: 0;}
    .thumbnail1:hover{
    background-color: transparent;
    z-index: 50;}
    .thumbnail1 span{ /*Estilos del borde y texto*/
    position: absolute;
    background-color: white;
    padding: 5px;
    left: -100px;
    visibility: hidden;
    color: #FFFF00;
    text-decoration: none;}
    .thumbnail1 span img{ /*CSS for enlarged image*/
    border-width: 0;
    padding: 2px;}
    .thumbnail1:hover span{ /*CSS for enlarged image on hover*/
    visibility: visible;
    top: 17px;
    left: 60px; /*position where enlarged image should offset horizontally */} 
    img.imagen2{
    padding:4px;
    border:3px #0489B1 solid;
    margin-left: 2px;
    margin-right:5px;
    margin-top: 5px;
    float:left;}
  </style> -->
  <?php
  session_start();
  include('menu.php');
   include 'ajax/pagination.php'; //include pagination file
  require_once ("config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
  require_once ("config/conexion.php");
  $sql1="select * from users where user_id=$_SESSION[user_id]";
  $sqlconstante = "SELECT dolar FROM `constante` where id_constante = (select MAX(id_constante) from constante)";
  $rwconstante = mysqli_query($con, $sqlconstante);
  $moncdol = 0;
  $rw1=mysqli_query($con,$sql1);//recuperando el registro
  $rs1=mysqli_fetch_array($rw1);//trasformar el registro en un vector asociativo
  $sql2="select * from datosempresa where id_emp=1";
  $rw2=mysqli_query($con,$sql2);//recuperando el registro
  $rs2=mysqli_fetch_array($rw2);//trasformar el registro en un vector asociativo
  $alerta=$rs2["alerta"];
  $consulta1 = "SELECT * FROM products";
  $result1 = mysqli_query($con, $consulta1);
  $producto = array();
  $i=0;
  while ($valor1 = mysqli_fetch_array($result1, MYSQLI_ASSOC)) {
    $producto[$i]=$valor1['id_producto'];
    $i=$i+1;
  }   
  $iii= 0 ;
  while ($valor1constantedolar = mysqli_fetch_array($rwconstante, MYSQLI_ASSOC)) {
    $productoconstantedolar[$iii]=$valor1constantedolar['dolar'];
    $moncdol = $productoconstantedolar[$iii];
    $iii=$iii+1;
  } 
  $modulo=$rs1["accesos"];
  $a = explode(".", $modulo); 
  if (!isset($_SESSION['user_login_status']) AND $_SESSION['user_login_status'] != 1) {
    header("location: login.php");
    exit;
  }
  if($a[11]==0){
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
    <script src="js/Axios/Axios.js"></script>
    <script src="js/Vue/Vue.js"></script>
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
          </div>
        </div>
          <?php
            menu3();
          ?>
        <div class="right_col" role="main">
          <input type="hidden" name="" id="idProducto">
            <div class="clearfix"></div>
              <div class="row">
                <div class="container">
                  <div class="panel panel-info">                
                    <div class="panel-heading">
                      <h4>Precisa Motor - Orden de Compra ABC05052020 - Vista Interna</h4>
                    </div>
                    <div class="panel-body">
  	                  <div class="form-group row">
  									 	  <div class="col-md-12 col-sm-12 col-xs-12 separador-compras separador">
  											 <h1>Datos del Pedido</h1>
                         <input type="hidden" name="id_cabecera_hidden" id="id_cabecera_hidden" value="<?php echo $_GET['iddespacho']?>">
  										  </div>
                        <div class="col-md-12 col-sm-12 col-xs-12 separador-compras separador">
                          <div class="table-responsive">
                                <div class='outer_div'></div><!-- Carga los datos ajax -->
                
      </div>
            <div class="col-md-12 col-sm-12 col-xs-12 separador-compras separador mt-5">
                    
                    <div class="btn-group pull-right">
                    <form class="form-horizontal" role="form" id="datos_despacho_excel"  method="post" class="form" action="reporteexceldespacho.php">
                      <input type="hidden"  id="iddespacho_excel" name="iddespacho_excel" value="<?php echo $_GET['iddespacho'];?>" >
                     <!-- <button type='button' class="btn btn-danger" data-toggle="modal" style="margin-right: 20px;" onclick="limpiarformulario()" data-target="#nuevoCliente"><span class="glyphicon glyphicon-plus"></span>Descargar PDF</button>-->
                    
                     <button type='submit' class="btn btn-primary" data-toggle="modal" onclick="limpiarformulario()" data-target="#nuevoCliente"><span class="glyphicon glyphicon-download-alt"></span> Descargar Excel</button>
                    
                   <!--   <button type='button' class="btn btn-primary" data-toggle="modal" onclick="limpiarformulario()" data-target="#nuevoCliente"><span class="glyphicon glyphicon-plus"></span>Imprimir</button>-->
                        
                    </form>
               
                      

                    </div>
                        
                      </div>
                        
                      </div>
                        
                      </div>
                      <div class="col-md-12 col-sm-12 col-xs-12 separador-compras separador">
                        <h1>Datos del Cliente</h1>
                        
                      </div>
    <div class="col-md-12 col-sm-12 col-xs-12 separador-compras separador">
                                      <div class="table-responsive">
                                <table id="example_cliente" class="table display nowrap">
          <tfoot class="th-general">
            <tr class="th-general">
              <!-- <div class="pull-right separador-compras">
                <a href="ingresoProductos.php" class="btn btn-guardar" style="width: 150px;" id=""><span id="">Nuevo Producto</span></a>
              </div>  -->

  <?php 
    $iddelacabecera = $_GET['iddespacho'];
      // escaping, additionally removing everything that could be (html/javascript-) code
  //$aColumns = array('nom_cat');//Columnas de busqueda
           $sTable = " cabecera_orden cao inner join users usr on cao.id_cliente=usr.user_id INNER join clientes cli on cli.id_cliente = usr.id_cliente  inner join tipo_envios tpe on cao.tipo_de_envio=tpe.id_tipoenvios ";
           $sWhere = "";

         // $sWhere.=" order by id_categoria asc";
          $sWhere.=" where cao.id = $iddelacabecera ";
      //pagination variables
          $page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
          $per_page = 10; //how much records you want to show
          $adjacents  = 4; //gap between pages after number of adjacents
          $offset = ($page - 1) * $per_page;
          //Count the total number of row in your table*/
          $sssdsdsd = "SELECT count(*) AS numrows FROM $sTable  $sWhere";
          //var_dump($sssdsdsd);
          $count_query   = mysqli_query($con, "SELECT count(*) AS numrows FROM $sTable  $sWhere");
          $row= mysqli_fetch_array($count_query);
          $numrows = $row['numrows'];
          $total_pages = ceil($numrows/$per_page);
          $reload = './consulta_despacho.php';
          //main query to fetch the data





  ?>


            </tr>
          </tfoot>
                  <thead >
            <tr class="th-general">
     <th class="th-general">Nombre</th>
                          <th class="th-general">Nro. Documento</th>
                          <th class="th-general">Teléfono</th>
                          <th class="th-general">Correo</th>
                          <th class="th-general">Metodo de Envío</th>
                          <th class="th-general">Dirección</th>
                          <th class="th-general">Provincia</th>
            </tr>
          </thead>

            <?php        
              $sqlclientes ="SELECT cli.*, tpe.nombre_tenvio FROM $sTable $sWhere LIMIT $offset,$per_page";
            //var_dump($sqlclientes);
              $queryclientes = mysqli_query($con, $sqlclientes);
              $nuevocontadorlistaa = 1;
              $iia = 1;
                while ($rowclientes=mysqli_fetch_array($queryclientes)){
                  $nombre_cliente = $rowclientes['nombre_cliente'];
                  $doc = $rowclientes['doc'];
                  $telefono_cliente = $rowclientes['telefono_cliente'];
                  $email_cliente = $rowclientes['email_cliente'];
                  $nombre_tenvio = $rowclientes['nombre_tenvio'];
                  $direccion_cliente = $rowclientes['direccion_cliente'];
                  $provincia = $rowclientes['provincia'];
            ?>      
                              <tr>
                          <!--<input type="hidden" value="<?php echo $nom_cat;?>" id="nom_cat<?php echo $id_categoria;?>">
                          <input type="hidden" value="<?php echo $des_cat;?>" id="des_cat<?php echo $id_categoria;?>">-->
                          <td class="th-general"><?php echo $nombre_cliente; ?></td>
                          <td class="th-general"><?php echo $doc; ?></td>
                          <td class="th-general"><?php echo $telefono_cliente; ?></td>
                          <td class="th-general"><?php echo $email_cliente; ?></td>
                          <td class="th-general"><?php echo $nombre_tenvio; ?></td>
                          <td class="th-general"><?php echo $direccion_cliente; ?></td>
                          <td class="th-general"><?php echo $provincia; ?></td>
                      </tr>

       
          <?php
            }
            /*}*/
  ?>

        </table>
      </div>
                         
                      </div>
                        <div class="col-md-12 col-sm-12 col-xs-12 separador-compras separador mt-5">
                        <h1>Estado de la Orden</h1>
                        
                      </div>
<form action="actualizar_consultadespacho.php" method="POST">
    <div class="col-md-12 col-sm-12 col-xs-12 separador-compras separador">
      <div>
         <table id="example_otro" class="table display nowrap">
        <tfoot class="th-general">
          <tr class="th-general">
            <?php 
              $iddelacabecera = $_GET['iddespacho'];
              $sql21="select * from cabecera_orden where id = $iddelacabecera ";
              // var_dump($sql21);
              $i=0;
              $rs11=mysqli_query($con,$sql21);
                while($row31=mysqli_fetch_array($rs11)){
                  $epago = $row31['estado_pago'];
                  $estado_envio = $row31['estado_envio'];
                }
            ?>
            </tr>
        </tfoot>
        <thead >
          <tr class="th-general">
            <th class="th-general">Estado del Pago</th>
            <th class="th-general">Estado del Envío</element></th>
          </tr>
        </thead>
      
          <?php        
            $sqlclientes ="SELECT cli.*, tpe.nombre_tenvio FROM $sTable $sWhere LIMIT $offset,$per_page";
            $queryclientes = mysqli_query($con, $sqlclientes);
            $nuevocontadorlistaa = 1;
            $iia = 1;?>
          <tr>
            <td class="th-general">
              <select  class="form-control estilo-placeholder" id="estado_pago_mod" name="estado_pago_mod" required>
                <option class="custom-select" value="0">-- Selecciona Estado del Pago --</option>
                  <?php
                    $nom = array();
                    $sql2="select * from parametro where estado = 1 and id_tipo_param = 1 ";
                    $i=0;
                    $rs1=mysqli_query($con,$sql2);
                      while($row3=mysqli_fetch_array($rs1)){
                        $nombre_parametro=$row3["nombre_parametro"];
                        $id_parametro=$row3["id_parametro"];
                        if ($epago == $id_parametro) {?>
                        <option class="custom-select" value="<?php  echo $id_parametro;?>" selected><?php  echo $nombre_parametro;?></option>                          
                        <?php }else{ ?>
                        <option class="custom-select" value="<?php  echo $id_parametro;?>"><?php  echo $nombre_parametro;?></option>
                        <?php }
                        ?>
                        <?php
                          $i=$i+1;
                        }    
                        ?>  
              </select>
            </td>
            <td class="th-general">
              <select  class="form-control estilo-placeholder" id="estado_envio_mod" name="estado_envio_mod" required>
                <option class="custom-select" value="0">-- Selecciona Estado del Envío --</option>
                  <?php
                    $nom = array();
                    $sql2="select * from parametro where estado = 1 and id_tipo_param = 2";
                    $i=0;
                    $rs1=mysqli_query($con,$sql2);
                      while($row3=mysqli_fetch_array($rs1)){
                        $nombre_parametro=$row3["nombre_parametro"];
                        $id_parametro=$row3["id_parametro"];
                        if ($estado_envio == $id_parametro) {?>
                        <option class="custom-select" value="<?php  echo $id_parametro;?>" selected><?php  echo $nombre_parametro;?></option>
                        <?php }else{?>
                        <option class="custom-select" value="<?php  echo $id_parametro;?>"><?php  echo $nombre_parametro;?></option>
                        <?php }
                        ?>
                        <?php
                          $i=$i+1;
                        }    
                        ?>  
              </select>
            </td>
          </tr>
        </tbody>
      </table>
      </div>
</div>

<?php if ($epago != 6 || $estado_envio != 7): ?>
<div class="col-md-12 col-sm-12 col-xs-12 separador-compras separador" style="margin-top: 20px;">
  <input type="hidden" name="id_despacho_mod" id="id_despacho_mod" value="<?php echo $_GET['iddespacho'];?>">
    <div class="btn-group pull-right">
      <button type='submit' class="btn btn-agregar" ><span class="glyphicon glyphicon-upload"></span> Actualizar Estados</button>
    </div>                    
</div>
<?php endif ?>


</form>

                		</div>

  								</div>
                 

  				 
              </div>
       


    </div>
      </div>
  <!--aca esta la diferencia --->

  </div>

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
      function eliminar(id) {
        var q = $("#q").val();
        if (confirm("Realmente deseas eliminar la categoria")) {
          $.ajax({
            type: "GET",
            url: "./ajax/buscar_categorias.php",
            data: "id=" + id,
            "q": q,
            beforeSend: function(objeto) {
              $("#resultados").html("Mensaje: Cargando...");
            },
            success: function(datos) {
              $("#resultados").html(datos);
              load(1);
             // location.reload();
        setTimeout(function(){ document.getElementById('alertborrarcategorias').style.display = 'none'; }, 1500);
        setTimeout(function(){ document.getElementById('resultados').style.display = 'none'; }, 1500);
            }
          });
        }
      }



      $("#guardar_categoria").submit(function(event) {
        $('#guardar_datos').attr("disabled", true);

        var parametros = $(this).serialize();
        $.ajax({
          type: "POST",
          url: "ajax/nuevo_categoria.php",
          data: parametros,
          beforeSend: function(objeto) {
            $("#resultados_ajax").html("Mensaje: Cargando...");
          },
          success: function(datos) {
            $("#resultados_ajax").html(datos);
            $('#guardar_datos').attr("disabled", false);
              limpiarFormulario();
        setTimeout(function(){ document.getElementById('alertborrarcategorias').style.display = 'none'; }, 1000);

            load(1);
          }
        });
        event.preventDefault();
      })

      $("#editar_categoria").submit(function(event) {
        $('#actualizar_datos').attr("disabled", true);

        var parametros = $(this).serialize();
        $.ajax({
          type: "POST",
          url: "ajax/editar_categoria.php",
          data: parametros,
          beforeSend: function(objeto) {
            $("#resultados_ajax2").html("Mensaje: Cargando...");
          },
          success: function(datos) {
            $("#resultados_ajax2").html(datos);
            $('#actualizar_datos').attr("disabled", false);
        setTimeout(function(){ document.getElementById('alertborrarcategorias').style.display = 'none'; }, 1500);
   setTimeout(function(){ document.getElementById('resultados_ajax2').style.display = 'none'; }, 1500);
            load(1);
          }
        });
        event.preventDefault();
      })





  function Registrarenunhidden(){
    //console.log('ojala prcd');
    var variableqs = $("#q").val();
  console.log(variableqs);
  document.getElementById('q11').value= variableqs;
  //document.getElementById('q11').value = variableqs;
      //$("#q11").val(variableqs);

  }





      function obtener_datos(id) {
        var nom_cat = $("#nom_cat" + id).val();
        var des_cat = $("#des_cat" + id).val();
        $("#mod_cat").val(nom_cat);
        $("#mod_des").val(des_cat);
        $("#mod_id").val(id);

      }




    $(document).ready(function(){


  load(1);


    });


    function functVerDatos(){

    
  cargardatoscompatibles();
    }




/*
  function load(page){
  console.log('que fue ');
  console.log('que fue ');
  console.log('que fue ');

        var q= $("#q").val();
        $("#loader").fadeIn('slow');
        $.ajax({
          url:'./ajax/buscar_despachos.php?action=ajax&page='+page+'&q='+q,
           beforeSend: function(objeto){
          // $('#loader').html('<img src="./img/ajax-loader.gif"> Cargando...');
          },
          success:function(data){
            $(".outer_div").html(data).fadeIn('slow');
            $('#loader').html('');
            console.log('bbbbb');
          }
        })
      }*/







  </script>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>

  <script src="js/Vue/Vue.js"></script>

  <script>


  </script>

  </body>

  </html>

  <script type="text/javascript" src="ViewModels/consultaproductos.js"></script>
  <script type="text/javascript" src="js/util/Objetos.js"></script>


  <script type="text/javascript">


 llamadabproductos = function(link, link1, link2, link3, link4)
  {
var nuevoarraydefotos = new Array();






 var contadordefotos = 0;
    if (link != "" ) {
nuevoarraydefotos[contadordefotos] = link;
      contadordefotos = contadordefotos + 1;
    }
    if (link1 != "" ) {
nuevoarraydefotos[contadordefotos] = link1;
      contadordefotos = contadordefotos + 1;

    }
    if (link2 != "") {
nuevoarraydefotos[contadordefotos] = link2;
      contadordefotos = contadordefotos + 1;

    }
    if (link3 != "" ) {
nuevoarraydefotos[contadordefotos] = link3;
      contadordefotos = contadordefotos + 1;

    }
    if (link4 != "" ) {
nuevoarraydefotos[contadordefotos] = link4;
      contadordefotos = contadordefotos + 1;
    }


      console.log('array');
      console.log(nuevoarraydefotos);
      console.log('array');




var contcarrusel = "<ol class='carousel-indicators'>";
    var nuevoaumento = 0;


while(nuevoaumento < contadordefotos){
        if (nuevoaumento == 0) {
contcarrusel += " <li data-target='#myCarousel' data-slide-to='0' class='active'></li>";
      }else{
contcarrusel += " <li data-target='#myCarousel' data-slide-to='"+nuevoaumento+"'></li>";
      }
  nuevoaumento = nuevoaumento + 1;
}




 contcarrusel += "</ol>";
 contcarrusel += "  <div class='carousel-inner'>";
    var nuevoaumento1 = 0;

while(nuevoaumento1 < contadordefotos){
        if (nuevoaumento1 == 0) {
contcarrusel += "<div class='item active'><img src='fotos/"+nuevoarraydefotos[nuevoaumento1]+"' alt='Los Angeles' style='width:100%!important; height:100%!important'></div>";
      }else{
contcarrusel += "<div class='item'><img src='fotos/"+nuevoarraydefotos[nuevoaumento1]+"' alt='Chicag' style='width:100%!important; height:100%!important'></div>";
      }
  nuevoaumento1 = nuevoaumento1 + 1;
}


contcarrusel += "</div>";
contcarrusel += "<a class='left carousel-control' href='#myCarousel' data-slide='prev'><span class='glyphicon glyphicon-chevron-left'></span><span class='sr-only'>Previous</span></a><a class='right carousel-control' href='#myCarousel' data-slide='next'><span class='glyphicon glyphicon-chevron-right'></span><span class='sr-only'>Next</span></a>";

contcarrusel += "</div>";



  $('#myCarousel').empty();
   // var titulo="<span ><img src='fotos/"+link+"' class='imagen4' border='0' alt='' width='420px'/></span>   ";
     
     //*$('#modalbody').append(titulo);
     $('#myCarousel').append(contcarrusel);
  }
</script>

<div class="modal fade" id="modal-id">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        
        <h4 class="modal-title">Pre visualizacion de la imagen</h4>
      </div>
      <div class="modal-body" id="modalbody" style="text-align: center;">


      <div class="container" style="width: 50%!important; height: 50%!important;">
  <h2></h2>  
  <div id="myCarousel" class="carousel slide" data-ride="carousel">
  

    <!--  <ol class="carousel-indicators">
      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
      <li data-target="#myCarousel" data-slide-to="1"></li>
      <li data-target="#myCarousel" data-slide-to="2"></li>
      <li data-target="#myCarousel" data-slide-to="3"></li>
    </ol>

  

    <div class="carousel-inner">
      <div class="item active">
        <img src="fotos/1producto10.jpg" alt="Los Angeles" style="width:100%;">
      </div>

      <div class="item">
        <img src="fotos/1producto10.jpg" alt="Chicago" style="width:100%;">
      </div>
    
      <div class="item">
        <img src="fotos/1producto10.jpg" alt="New york" style="width:100%;">
      </div>
      <div class="item">
        <img src="fotos/1producto10.jpg" alt="New york" style="width:100%;">
      </div>
    </div>



    <a class="left carousel-control" href="#myCarousel" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>-->
</div>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
</div>
<script type="text/javascript">
    $(document).ready(function(){

      setTimeout(function(){
      $('#q').val(nuevavariable);
      load(1);
      }, 1000);
  });

function load(page){
      var q= $("#id_cabecera_hidden").val();
     // $("#loader").fadeIn('slow');
      $.ajax({
        url:'./ajax/buscar_despacho_detalle.php?action=ajax&page='+page+'&q='+q,

        success:function(data){
          $(".outer_div").html(data).fadeIn('slow');
         
          console.log('bbbbb');
        }
      })
    }

</script>