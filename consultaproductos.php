<?php
session_start();
include('menu.php');
require_once ("config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
require_once ("config/conexion.php");//Contiene funcion que conecta a la base de datos
$consulta1 = "SELECT * FROM products ";
$result1 = mysqli_query($con, $consulta1);
$producto = array();
$i=0;
while ($valor1 = mysqli_fetch_array($result1, MYSQLI_ASSOC)) {
    if ($valor1['pro_ser']==1){
    $producto[$i]=utf8_decode($valor1['nombre_producto']);
    $i=$i+1;
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
if($a[15]==0){
    header("location:error.php");    
}

?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
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
  <link href="css/select/select2.min.css" rel="stylesheet">
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
  <!-- 
  <style type="text/css">
    input:focus {background: #A9D0F5;border-radius: 5px;outline: none;}
    input:hover {background: #A9D0F5;}
    input {background: #A9D0F5;margin-left: auto;margin-right: auto;font-weight: bold;}
  </style>
  <style>
    table tr:nth-child(odd) {background-color: #FBF8EF;}
    table tr:nth-child(even) {background-color: #EFFBF5;}
    #valor1 {border-bottom: 2px solid #F5ECCE;}
    #valor1:hover {background-color: white;border-bottom: 2px solid #A9E2F3;}
    .dt-button.red {color: black;background: red;}
    .dt-button.orange {color: black;background: orange;}
    .dt-button.green {color: black;background: green;}
    .dt-button.green1 {color: black;background: #01DFA5;}
    .dt-button.green2 {color: black;background: #2E9AFE;}
  </style>
  -->
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
$d=0;
while ($valor1 = mysqli_fetch_array($result2, MYSQLI_ASSOC)) { 
     if ($valor1['tipo']==1){
          $d=$valor1['id'];
          $nom_pro=$valor1['a1'];
          $codigo_producto=$valor1['a2'];        
          $marca=$valor1['a3'];
          $modelo=$valor1['a4'];
          $tipo=$valor1['a5'];
          $cat=$valor1['a6'];
          $color=$valor1['a7'];
     }
    
}

          
            ?>
           <div class="row">

          <div class="container">

            <br>
            <br><br>
            <br>

            <div class="panel panel-info">

              <div class="panel-heading">
                <h2> Buscar Datos de Productos en Sucursal <?php echo $_SESSION['tienda']; ?> </h2>
              </div>

                <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" method="GET" action="consultaproductos1.php">

                  <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                    <textarea rows="1" placeholder="Nombre del producto" name="nom_pro" id="autocomplete-custom-append" data-validate-length-range="4" class="form-control estilo-placeholder"></textarea>
                    <div id="autocomplete-container" style="position: relative; float: left; width: 400px; margin: 3px;">
                    </div>
                  </div>
                     


                      <div class="col-md-2 col-sm-12 col-xs-12 form-group">
                        <select class="select2_single form-control" name="cod_pro" required="required" tabindex="-1">
                            <option value="0" > Buscar c&oacute;digo
                            <?php
                            $consulta1 = "SELECT * FROM products ";
                            $result1 = mysqli_query($con, $consulta1);

                            while ($valor1 = mysqli_fetch_array($result1, MYSQLI_ASSOC)) {
                            ?>
                                <option  value="<?php echo $valor1['codigo_producto'];?>"><?php echo $valor1['codigo_producto'];?>     
                            <?php
    
                            }                            
                            ?>
                                                                                          
                        </select>
                      </div>
                     <div class="col-md-3 col-sm-12 col-xs-12 form-group">
                        <select class="select2_single form-control" name="cat" required="required" tabindex="-1">
                            <option value="0" > Buscar Categoria
                            <?php
                            $consulta3 = "select*from categorias where estado = 1 ORDER BY `categorias`.`nom_cat` ASC";
                            $result3 = mysqli_query($con,$consulta3);

                            while ($valor3 = mysqli_fetch_array($result3)) {
                            ?>
                                <option  value="<?php echo $valor3['id_categoria'];?>"><?php echo $valor3['nom_cat'];?>     
                            <?php
    
                            }                            
                            ?>
                                                                                       
                        </select>
                      </div>
                   
                      <div class="col-md-2 col-sm-12 col-xs-12 form-group">
                        <select class="select2_single form-control" name="marca" required="required" tabindex="-1">
                            <option class="custom-select"  value="0" > Buscar Marca
                            <?php
         
                            $consulta1 = "select distinct id_marca from products ORDER BY `products`.`id_marca` ASC";
                            $result1 = mysqli_query($con,$consulta1);

                            while ($valor1 = mysqli_fetch_array($result1)) {
                            ?>
                                    <option  class="custom-select"  value="<?php echo $valor1['id_marca'];?>"><?php echo $valor1['id_marca'];?>     
                            <?php
    
                            }                            
                            ?>
                                                                                          
                        </select>
                      </div>
                  
                        <div class="col-md-2 col-sm-12 col-xs-12 form-group">
                        <select class="select2_single form-control" name="modelo" required="required" tabindex="-1">
                            <option value="0" > Buscar Modelo
                            <?php
                            $consulta1 = "select distinct id_modelo from products ORDER BY `products`.`id_modelo` ASC";
                            $result1 = mysqli_query($con,$consulta1);

                            while ($valor1 = mysqli_fetch_array($result1)) {
                            ?>
                                <option class="custom-select"  value="<?php echo $valor1['id_modelo'];?>"><?php echo $valor1['id_modelo'];?>     
                            <?php
    
                            }                            
                            ?>
                                                                                          
                        </select>
                      </div>   








                        <div class="col-md-3 col-sm-12 col-xs-12 form-group">
                        <select class="select2_single form-control" name="tipo" tabindex="-1">
                            <option value="" > Buscar Tipo
                           
                       <option  value="1">Nuevo     
                       <option  value="0">De segunda     
                       <option  value="2">Repuesto                                                                   
                        </select>
                      </div>   

                     <!--                          <div class="col-md-2 col-sm-12 col-xs-12 form-group">
                        <select class="select2_single form-control" name="color" required="required" tabindex="-1">
                            <option value="0" > Buscar color
                            <?php
                            $consulta1 = "select distinct color from products ORDER BY `products`.`color` ASC";
                            $result1 = mysqli_query($con,$consulta1);

                            while ($valor1 = mysqli_fetch_array($result1)) {
                            ?>
                                <option  value="<?php echo $valor1['color'];?>"><?php echo $valor1['color'];?>     
                            <?php
    
                            }                            
                            ?>
                                                                                          
                        </select>
                      </div> -->   
                  
                      <div class="ln_solid"></div>
                    
                      
                  <input type="hidden" name="d" value="1">

                  <div class="pull-right separador-compras">
                    <button id="send" type="submit" name="enviar" class="btn btn-guardar leyenda-asistencia-personal">Buscar</button>
                  </div>

                            
                </form>
                  
          
                   </div>
                           </div>
                   </div>
       
          
          <div class="row">

                 <?php
                       
if(isset($nom_pro)){
  $nom_pro1=utf8_encode($nom_pro);  
}
if($d==0){

    $sql="select * from products";
}else{
  
if($nom_pro1<>""){
    $sql="select * from products where nombre_producto='$nom_pro1'";
}else{
    $codigo_producto1="";
    $marca1="";
    $modelo1="";
    $tipo1="";
    $cat1="";
    $color1="";
    if($codigo_producto<>"0"){
           $codigo_producto1="and (codigo_producto='$codigo_producto')"; 
        }
   if($marca<>"0"){
                $marca1="and (marca='$marca')";
            }
            if($modelo<>"0"){
                $modelo1="and (modelo='$modelo')";
            }
            if($tipo<>""){
                $tipo1="and (status_producto='$tipo')";
            }
            if($cat>0){
                $cat1="and (cat_pro='$cat')";
            }
            if($color<>""){
                $color1="and (color='$color')";
            }

    $sql="select * from products where pro_ser=1 $codigo_producto1 $marca1 $tipo1 $cat1 $modelo1 $color1"; 
}
$host= $_SERVER["HTTP_HOST"];
$url= $_SERVER["REQUEST_URI"];
$aa="http://".$host.$url;

?>
             <form action="ficheroExcel.php" method="post" target="_blank" id="FormularioExportacion">
                 <p><a class="btn btn-primary" href="tabla.php?t=0&a=<?php echo $aa;?>">Tabla Normal</a> 
                     
                     
                     <a class="btn btn-danger" href="tabla.php?t=2&a=<?php echo $aa;?>">Editar Stock</a>
                     &nbsp;
                   
                    <input type="hidden" id="datos_a_enviar" name="datos_a_enviar" />
            </form> 
    
             <div class="table-responsive">
                   
                  <table id="example" class="display nowrap" style="width:100%">
                    <thead>
                      <tr style="background-color:#FE9A2E;color:white; ">
                       <th>Numero  </th>
                       <th>Categoria  </th>
                        <th>Codigo  </th>
                        
                        <th>Producto </th>
                        
                        <th>Stock </th>
                        <th>Precio1  </th>
                         <th>Precio2  </th>
                         <th>Precio3  </th>
                        <th>Marca  </th>
                       <th>Modelo  </th>
                         <th>Tipo  </th>
                      </tr>
                    </thead>

                    <tbody>
   
   <?php
$s=1;
$rs=mysqli_query($con,$sql);
while($row= mysqli_fetch_array($rs)){
    
    $tienda=$_SESSION['tienda'];
    if($tienda==1){
        $inv=$row["b1"];
    }
    if($tienda==2){
        $inv=$row["b2"];
    }
    if($tienda==3){
        $inv=$row["b3"];
    }
    
    ?>
      
        <tr id="valor1">
 <?php
$consulta3 = "select*from categorias where estado = 1 ORDER BY `categorias`.`nom_cat` ASC";
$result3 = mysqli_query($con,$consulta3);

while ($valor3 = mysqli_fetch_array($result3)) {
   if($valor3['id_categoria']==$row["cat_pro"]){
       $cat1=$valor3['nom_cat'];
   }
    
}                            
                            ?>
     
                       <td class=" "><?php echo $s;?></td>
                       <td class=" "><?php echo $cat1;?></td>
                        <td class=" "><?php echo utf8_decode($row["codigo_producto"]);?></td>
                        
                        <td class=" "><?php 
                        $cadena=utf8_decode($row["nombre_producto"]);
                        
                        echo $cadena;?></td>
                        <?php 
                        
                        if($_SESSION['tabla']==2){
                            ?>
                    
                        <td class=" "><form id="ficha"><input size="3" text-align="center" id="<?php echo $row["id_producto"];?>" name="<?php echo $row["id_producto"];?>" type="text" value="<?php echo $inv;?>"></form></td>
                           <?php
                           }else{
                            
                          ?>  
                            
                        <td class=" "><?php echo $inv;?>  </td>
                          <?php
                           }
                           
                           ?>
                            
                        
                        <td class=" "><?php print"S/. $row[precio_producto]";?></td>
                        <td class=" "><?php print"S/. $row[precio2]";?></td>
                        <td class=" "><?php print"S/. $row[precio3]";?></td>
                        <td class=" "><?php echo $row["marca"];?></td>
                        <td class=" "><?php echo $row["modelo"];?></td>
                        <?php
                        if($row["status_producto"]==0){
                            $tip="De Segunda";
                        }
                        if($row["status_producto"]==1){
                            $tip="Nuevo";
                        }
                        if($row["status_producto"]==2){
                            $tip="Repuesto";
                        }
                        ?>
                        
                        
                        <td class=" "><?php echo $tip;?></td>
                        
                      </tr>                
    <?php
    $s=$s+1;
}
                        
                        ?>
             
                    </tbody>

                  </table>
     
                   
                     </form>
                </div>
              <?php
}
?>
            </div>

            <br />
            <br />
            <br />

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
<?php $a=$_SESSION['tabla'];?>

  <!-- Datatables -->
 
  <script type="text/javascript" src="js/autocomplete/countries.js"></script>
  <script src="js/autocomplete/jquery.autocomplete.js"></script>
  <!-- pace -->
  <script src="js/pace/pace.min.js"></script>
  <script type="text/javascript">
    $(function() {
      'use strict';
      
      var data =[
      <?php
                    for($i = 0;$i<count($producto);$i++){
                ?>
                '<?php echo $producto[$i];?>',
                <?php } ?>];
     
      
      
      var countriesArray = $.map(data, function(value, key) {
        return {
          value: value,
          data: key
        };
      });
      // Initialize autocomplete with custom appendTo:
      $('#autocomplete-custom-append').autocomplete({
        lookup: countriesArray,
        appendTo: '#autocomplete-container'
      });
    });
  </script>
  
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
  
<script type="text/javascript">

$(document).ready(function(){



    $('input').blur(function(){

        var field = $(this);

        var parent = field.parent().attr('id');

        field.css('background-color','#F7BE81');


        var dataString = 'value='+$(this).val()+'&field='+$(this).attr('name');

        $.ajax({

            type: "POST",

            url: "edit.php",

            data: dataString,

            success: function(data) {

                field.val(data);

                $('#'+parent+' .loader').fadeOut(function(){

                    $('#'+parent).append('<img src="descargar.png"/>').fadeIn('slow');

                });



            }

        });

    });

});

</script>  
 
<script>
 
$(document).ready(function() {
    $('#example').DataTable( {
        language: {
        "url": "",
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
                    extend: 'colvis',
                    text: 'Mostrar columnas',
                    className: 'green2',
                    exportOptions: {
                    columns: ':visible'
                }
                
                },   
                          
{
                    extend: 'pageLength',
                    text: 'Mostrar filas',
                    className: 'orange',
                    exportOptions: {
                    columns: ':visible'
                }
                
                },
                
                {
                    extend: 'copy',
                    text: 'COPIAR',
                    className: 'red',
                    exportOptions: {
                    columns: ':visible'
                }
                },
                
                
                
                {
                    extend: 'excel',
                    text: 'EXCEL',
                    className: 'green',
                    exportOptions: {
                    columns: ':visible'
                }
                },
                {
                    extend: 'csv',
                    text: 'CSV',
                    className: 'green1',
                    exportOptions: {
                    columns: ':visible'
                }
                },
                {
                    extend: 'print',
                    text: 'IMPRIMIR',
                    className: 'green2',
                    exportOptions: {
                    columns: ':visible'
                }
                },
            ]
        
        
    } );
} );



</script>


  
</body>

</html>




