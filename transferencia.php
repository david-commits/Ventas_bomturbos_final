<?php
session_start();
//include('ajax/is_logged.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado
include('menu.php');
require_once ("config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
require_once ("config/conexion.php");//Contiene funcion que conecta a la base de datos
$sql1="select * from users where user_id=$_SESSION[user_id]";
$rw1=mysqli_query($con,$sql1);//recuperando el registro
$rs1=mysqli_fetch_array($rw1);//trasformar el registro en un vector asociativo
$modulo=$rs1["accesos"];
$sql2="select * from sucursal ORDER BY  `sucursal`.`tienda` DESC ";
$rw2=mysqli_query($con,$sql2);//recuperando el registro
$rs2=mysqli_fetch_array($rw2);//trasformar el registro en un vector asociativo
$tienda1=$rs2["tienda"];
$a = explode(".", $modulo); 
if (!isset($_SESSION['user_login_status']) AND $_SESSION['user_login_status'] != 1) {
    header("location: login.php");
    exit;
}
if($a[13]==0){
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
<link href="https://fonts.googleapis.com/css?family=Quicksand:300,400,500,600,700&display=swap" rel="stylesheet"> 
</head>
  <SCRIPT LANGUAGE="JavaScript" SRC="calendar.js"></SCRIPT>
  <script>
    function limpiarFormulario() {
      document.getElementById("guardar_producto").reset();
    }
    var mostrarValor = function(x) {
      document.getElementById('precio').value = x;

    }
    var mostrarValor2 = function(x) {
      document.getElementById('precio').value = x;
    }
  </script>

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
        <br><br>
          <div class="container">
            <div class="form-group">
              <div class="col-md-12 col-sm-12 col-xs-12 "> 
               <button type="button" class="btn btn-guardar pull-right leyenda-asistencia-personal" onclick="AbrirModal()" name="aceptar">Registrar Transferencia</button>
              </div>   
              <br><br><br><br><br> 
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="panel panel-info" id="showmodaldatostransferencia" style="display: none;" >
                  <div class="panel-heading">
                    <h2>Datos de la Transferencia:</h2>
                  </div>

            <br>

            <?php
            print "<form name=\"myForm\" class=\"form-horizontal form-label-left\" id=\"guardar_producto\" enctype=\"multipart/form-data\" action=\"transferencia2.php\" method=\"POST\">";
            $mensaje = recoge1('mensaje');
            ?>

            <div class="form-group">
              <label for="producto" class="control-label col-md-3 col-sm-3 col-xs-12">Nombre del Producto:</label>
              <div class="col-md-8 col-sm-8 col-xs-12">
                <input type="text" class="form-control estilo-placeholder" id="nombre_producto" placeholder="Introduce el nombre del Producto" required>
                <input id="id_producto" name="id_producto" type='hidden'>
              </div>
            </div>

            <div class="form-group">
              <label for="inventario" class="control-label col-md-3 col-sm-3 col-xs-12">Inventario:</label>
              <div class="col-md-8 col-sm-8 col-xs-12">
                <input type="text" class="form-control estilo-placeholder" readonly id="inv_producto" name="inv_producto">
              </div>
            </div>

            <div class="form-group">
              <label for="precio" class="control-label col-md-3 col-sm-3 col-xs-12">Precio del Producto S/:</label>
              <div class="col-md-8 col-sm-8 col-xs-12">
                <input type="text" readonly class="form-control estilo-placeholder" id="precio_producto" name="precio" placeholder="precio_producto">
              </div>
            </div>

            <?php
            $tienda = $_SESSION['tienda'];
            ?>

            <div class="form-group">
              <label for="cantidad" class="control-label col-md-3 col-sm-3 col-xs-12">Cantidad a transferir de la Sucursal:<strong><?php echo $tienda; ?></strong>:</label>
              <div class="col-md-8 col-sm-8 col-xs-12">
                <input type="text" class="form-control estilo-placeholder" id="cantidad" name="cantidad" placeholder="Cantidad del Producto" required>
              </div>
            </div>

            <div class="form-group">
              <label for="tienda2" class="control-label col-md-3 col-sm-3 col-xs-12">A la Sucursal:</label>
              <div class="col-md-8 col-sm-8 col-xs-12">
                <select class="form-control estilo-placeholder" id="tienda2" name="tienda2" required>
                  <option class="custom-select" value="">-- Selecciona Sucursal --</option>
                    <?php
                        $nom = array();
                        $sql2="select * from sucursal ";
                        $i=0;
                        $rs1=mysqli_query($con,$sql2);
                        while($row3=mysqli_fetch_array($rs1)){
                            $nombre=$row3["nombre"];
                            $id_sucursal=$row3["id_sucursal"];
                            if ($id_sucursal == $tienda ) {
                              
                                 } else { ?>
                                  <option class="custom-select" value="<?php  echo $id_sucursal;?>"><?php  echo $nombre;?></option>

                                <?php  }    ?>
                            <?php
                            //$i=$i+1;
                        }
                        
                        ?>


               </select>

              </div>
            </div>
              
              <div class="form-group pull-right separador-compras">
                <button type="submit" class="btn btn-guardar leyenda-asistencia-personal" name="aceptar">Aceptar Transferencia</button>
              </div>
              <div class="form-group pull-right separador-compras">
                <button type="button" class="btn btn-guardar leyenda-asistencia-personal" onclick="CerrarModal()" name="aceptar">Cerrar</button>
              </div>

            </form>


          </div>
              <?php 

                         $aColumns = array('nom_cat');//Columnas de busqueda
         $sTable = "transferencias";
         $sWhere = "";
        
        $sWhere.=" WHERE estado=1 order by id_transferencias asc";
        include 'ajax/pagination.php'; //include pagination file
        //pagination variables
        $page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
        $per_page = 5; //how much records you want to show
        $adjacents  = 4; //gap between pages after number of adjacents
        $offset = ($page - 1) * $per_page;
        //Count the total number of row in your table*/
        $sssdsdsd = "SELECT count(*) AS numrows FROM $sTable  $sWhere";
        $count_query   = mysqli_query($con, "SELECT count(*) AS numrows FROM $sTable  $sWhere");
        $row= mysqli_fetch_array($count_query);
        $numrows = $row['numrows'];
        $total_pages = ceil($numrows/$per_page);
        $reload = '';
        //main query to fetch the data
        $sql="SELECT tr.id_transferencias, pr.nombre_producto , tr.tiendaenvia, tr.tiendarecibe, src.nombre as nombresrc1, srcc.nombre as nombresrc2 , tr.cantidad, usr.nombres FROM transferencias tr inner join products pr on tr.id_producto= pr.id_producto inner join users usr on usr.user_id=tr.usuario inner join sucursal src on src.id_sucursal = tr.tiendaenvia inner join sucursal srcc on srcc.id_sucursal = tr.tiendarecibe  LIMIT $offset,$per_page";
        $query = mysqli_query($con, $sql);
           
        //loop through fetched data
        if ($numrows>0){
            
            ?>
<div class="table-responsive">
    <table id="searchTransferencia" class="display nowrap" style="width:100%">
                <thead>
                    <tr>
                        <th class="th-general">Nro</th>
                        <th class="th-general">Producto</th>
                        <th class="th-general">Tienda Envía</th>
                        <th class="th-general">Cantidad</th>
                        <th class="th-general">Tienda Recibe</th>
                        <th class="th-general">Usuario Envía</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $nuevocontadorlista = 1;
                    $ii = 1;
                    while ($row=mysqli_fetch_array($query)){
                            $id_producto=$row['nombre_producto'];
                            $tiendaenvia=$row['tiendaenvia'];
                            $cantidad=$row['cantidad'];
                            $tiendarecibe=$row['tiendarecibe'];
                            $usuario=$row['nombres'];
                            $nombresrc1=$row['nombresrc1'];
                            $nombresrc2=$row['nombresrc2'];
                            
                        ?>
                    <tr>
                        <input type="hidden" value="<?php echo $nom_cat;?>" id="nom_cat<?php echo $id_producto;?>">
                        <input type="hidden" value="<?php echo $nom_cat;?>" id="nom_cat<?php echo $tiendaenvia;?>">
                        <input type="hidden" value="<?php echo $nom_cat;?>" id="nom_cat<?php echo $cantidad;?>">
                        <input type="hidden" value="<?php echo $nom_cat;?>" id="nom_cat<?php echo $tiendarecibe;?>">
                        <input type="hidden" value="<?php echo $des_cat;?>" id="des_cat<?php echo $usuario;?>">
                        <td class="th-general"><?php echo $ii; ?></td>
                        <td class="th-general" style="background: #343e59!important;"><?php echo $id_producto; ?></td>
                        <td class="th-general"><?php echo $nombresrc1; ?></td>
                        <td class="th-general"><?php echo $cantidad; ?></td>
                        <td class="th-general"><?php echo $nombresrc2; ?></td>
                        <td class="th-general"><?php echo $usuario; ?></td>
                       <!-- <td class="th-general"><span>
                            <a href="#" class='btn btn-guardar btn-xs' title='Editar categoria' onclick="obtener_datos('<?php echo $id_categoria;?>');" data-toggle="modal" data-target="#myModal2"><i class="fa fa-pencil"></i></a> 
                            <a href="#" class='btn btn-cancelar btn-xs' title='Borrar categoria' onclick="eliminar('<?php echo $id_categoria; ?>')"><i class="glyphicon glyphicon-trash"></i></a>
                        </span></td>            -->
                    </tr>
                        <?php
                        $nuevocontadorlista = $nuevocontadorlista + 1;
                        $ii = $ii + 1;
                    }
                    ?>             
              </tbody>
           <!--  <tr>
                    <td colspan=7><span class="pull-right"><?php echo paginate($reload, $page, $total_pages, $adjacents);?></span></td>
                </tr>-->
        </table>
</div>
            <?php
        }
    

              ?>

              </div>

            </div>
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
 /*  $('#searchTransferencia tfoot th').each( function () {
        var title = $(this).text();

        if(title=="Nro" || title=="Tipo Linea" ||  title=="Marca" )
        $(this).html( '<input type="text" placeholder="'+title+'" />' );
    } );*/

   var table = $('#searchTransferencia').DataTable();

        $('#searchTransferencia').DataTable( {
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
            [ 10, 25, 50, -1 ],
            [ '10 filas', '25 filas', '50 filas', 'Mostrar todo' ]
        ],
        buttons: 
        
        
         [
                 
                {
                    extend: 'excel',
                    text: 'Excel',
                    className: 'green',
                    exportOptions: {
                    columns: ':visible'
                }
                },
         
            ],
         "pageLength": 20,
        
    } );

    });

</script>
<!--<script type="text/javascript">

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
  </script>-->
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
    
    
  /*  $( "#nuevoProducto1" ).submit(function( event ) {
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
})*/


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



function AbrirModal(){
  $('#showmodaldatostransferencia').css('display','block');
}
function CerrarModal(){
  $('#showmodaldatostransferencia').css('display','none');
}

  </script>


</body>

</html>