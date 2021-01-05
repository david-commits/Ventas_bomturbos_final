<?php
session_start();
include('menu.php');
require_once ("config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
require_once ("config/conexion.php");//Contiene funcion que conecta a la base de datos

$sql1="select * from users where user_id=$_SESSION[user_id]";
$rw1=mysqli_query($con,$sql1);//recuperando el registro
$rs1=mysqli_fetch_array($rw1);//trasformar el registro en un vector asociativo
$sql2="select * from sucursal ORDER BY  `sucursal`.`tienda` DESC ";
$rw2=mysqli_query($con,$sql2);//recuperando el registro
$rs2=mysqli_fetch_array($rw2);//trasformar el registro en un vector asociativo
$tienda1=$rs2["tienda"];
$modulo=$rs1["accesos"];
$a = explode(".", $modulo); 
if (!isset($_SESSION['user_login_status']) AND $_SESSION['user_login_status'] != 1) {
    header("location: login.php");
    exit;
}
if($a[16]==0){
    header("location:error.php");    
}

?>
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
  <link href="css/datatables/tools/css/dataTables.tableTools.css" rel="stylesheet">
  <link href="css/select/select2.min.css" rel="stylesheet">
  <script src="js/jquery.min.js"></script>
  <SCRIPT LANGUAGE="JavaScript" SRC="calendar.js"></SCRIPT>
  <script type="text/javascript" src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <link rel="stylesheet" type="text/css" href="DataTables/datatables.min.css" />
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>
  <link rel="stylesheet" type="text/css" href="Buttons/css/buttons.dataTables.min.css" />
  <script type="text/javascript" src="DataTables/datatables.min.js"></script>
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
$cliente="";
$fecha1="";
$fecha2="";
$tienda=0;
$tipo="";
while ($valor1 = mysqli_fetch_array($result2, MYSQLI_ASSOC)) {
    
     if ($valor1['tipo']==21){
          $d=$valor1['id'];
         $tipo=$valor1['a1'];
          //$nom_pro=trim($nom_pro1);
          $fecha1=$valor1['a2'];
          
          $fecha2=$valor1['a3'];
          $tiend=$valor1['a4'];
          if($tiend==7){
              $tienda1=1;
              $tienda2=$tienda1;
          }else{
              $tienda1=$tiend;
              $tienda2=$tiend;
          }
          //mm/dd/yyyy
          if ($fecha1<>""){
            $d1 = explode("-", $fecha1);
            $dia1=$d1[0]; 
            $mes1=$d1[1];
            $ano1=$d1[2];
            }
            $dd1=$ano1."-".$mes1."-".$dia1;
            if ($fecha2<>""){
                $d2 = explode("-", $fecha2);
                $dia2=$d2[0]; 
                $mes2=$d2[1];
                $ano2=$d2[2];
                $dd2=$ano2."-".$mes2."-".$dia2;
            }
      
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
                <h2>Total ventas por producto:</h2>
              </div>

              <form name="myForm" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" method="GET" action="masvendidos1.php">

              <br><br>

              <div class="form-group">
                <label class="col-md-3 col-sm-3 col-xs-12 control-label">Fecha Inicial:</label>
                <div class="col-md-8 col-sm-8 col-xs-12">
                  <input name="fecha1" data-validate-length-range="4" type="date" class="form-control estilo-placeholder input-fechas-horas-3" id="fecha1" value="<?php echo $fecha1; ?>" required>
                </div>
              </div>

              <div class="form-group">
                <label class="col-md-3 col-sm-3 col-xs-12 control-label">Fecha Final:</label>
                <div class="col-md-8 col-sm-8 col-xs-12">
                  <input name="fecha2" data-validate-length-range="4" type="date" class="form-control estilo-placeholder input-fechas-horas-3" id="fecha2" value="<?php echo $fecha2; ?>" required>
                </div>
              </div>

              <div class="form-group">
                <label class="col-md-3 col-sm-3 col-xs-12 control-label">Sucursal:</label>
                <div class="col-md-8 col-sm-8 col-xs-12">
                  <select class="form-control estilo-placeholder" name="tienda" required="required" tabindex="-1">
                    <?php
                    if ($tiend > 0) {
                      if ($tiend == 7) {
                        $t = "Todas";
                      } else {
                        $t = "Sucursal $tiend";
                      }
                    ?>
                      <option class="custom-select" value="<?php echo $tiend; ?>"><?php echo $t; ?></option>
                    <?php
                    } else {
                    ?>
                      <option class="custom-select" value="0">Escoger</option>
                    <?php
                    }
                    for ($i = 1; $i <= $tienda1; $i++) {
                    ?>
                      <option  class="custom-select" value="<?php echo $i; ?>">Sucursal <?php echo $i; ?></option>
                    <?php
                    }
                    ?>
                    <option class="custom-select" value="7">Todas</option>
                  </select>
                </div>
              </div>

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
                       

$cont=0;
$total11=0;
$total22=0;
if($d==0){
//$sql="select * from products ORDER BY  `products`.`id_producto` DESC LIMIT 0 , 100";
    $sql="";
}else{
 
$host= $_SERVER["HTTP_HOST"];
$url= $_SERVER["REQUEST_URI"];
$aa="http://".$host.$url;

?>
      
  <div class="table-responsive">
                   
                  <table id="example" class="display nowrap" style="width:100%">
                    <thead>
                      <tr >
                       <th class="th-general">Codigo </th>
                        
                        <th class="th-general">Producto </th>
                        
                        <th class="th-general">Productos Vendidos </th>
                        <th class="th-general">Total S/.</th>
                      <th class="th-general">Precio Promedio S/.</th>
                      </tr>
                    </thead>

                    <tbody>  
 <?php   
    
$sql="select * from products"; 
$total=0;
$rs=mysqli_query($con,$sql);
$s=0;
$a1=array();
$a2=array();
$cont=0; 
$j=0;
while($row= mysqli_fetch_array($rs)){
  if($cont<=$tipo){  
        $id_producto=$row['id_producto'];
        $nombre_producto=$row['nombre_producto'];
        $a2[$j]=utf8_decode($nombre_producto);
        $codigo=$row['codigo_producto'];
        $sql1="select * from detalle_factura where ven_com=1 and activo=1"; 
        $rs1=mysqli_query($con,$sql1);
        $s=$s+1;
        $num=0;
        $total1=0;
        $total2=0;
        $cant1=0;
    while($row1= mysqli_fetch_array($rs1)){
    $fecha3=$row1['fecha'];
    $venta=$row1['precio_venta']*$row1['cantidad'];
    $tienda=$row1['tienda'];
    $id_producto1=$row1['id_producto'];
    $cant=$row1['cantidad'];
    $d3 = explode("-",$fecha3);
    $dia=date("d",strtotime($fecha3)); 
    $mes=date("m",strtotime($fecha3));  
    $ano=$d3[0];
    $dd=$ano."-".$mes."-".$dia;
    $dd5=$mes."-".$dia."-".$ano;
    $fecha=strtotime($dd);
    $fech1=strtotime($dd1);
    $fech2=strtotime($dd2);
    if($id_producto==$id_producto1  && $fecha>=$fech1 && $fecha<=$fech2 && $tienda>=$tienda1 && $tienda<=$tienda2){       
    $cant1=$cant1+$cant;   
    $total1=$total1+$venta;
    if($total1){ 
        $a1[$j]=$total1;
    }
      
    $num=$num+1;
}
}
if($num>0){
    $promedio=$total1/$num;
}else{
    $promedio=0;
}

if($total1>0){
        ?>
               
                        
        <tr>
             
                        <td class="th-general" style="background-color: #343e59!important;"><?php echo $codigo;?></td>
                         
                        <td  class="th-general"class=" "><?php echo utf8_decode($nombre_producto);?></td>
                        
                        <td class="th-general" class=" "><?php echo $cant1;?></td>
                       
                        <td class="th-general" class='text-right'><strong><?php  echo number_format($total1,2);?></strong></td>
                         
                        <td class="th-general" class='text-right'><strong><?php  echo number_format($promedio,2);?></strong></td>
                        
                      </tr>                
    <?php 
$total11=$total11+$total1;
$cont=$cont+1;
}

} 
if($total1>0){
    $j=$j+1;
}

}

for($i = 0;$i<count($a1);$i++){
    for($j = 0;$j<count($a1);$j++){
        If ($a1[$i] >= $a1[$j]) {
            $b1 = $a1[$j];
            $b2 = $a2[$j];
            $a1[$j] = $a1[$i];
            $a2[$j] = $a2[$i];
            $a1[$i] = $b1;
            $a2[$i] = $b2;
        }
    }  
}
?>
                  </tbody>
                    <?php 
                    
                    if($_SESSION['tabla']>0)        {
                        
                    
                    ?>
                    <tr><td  class="th-general"  colspan="3"></td><td   class="th-general" class='text-right'><h2 style="color:blue;">Total Ventas :</h2></td><td   class="th-general"  class='text-right'><h2 style="color:red;">S/.<?php echo number_format ($total11,2);?></h2></td></tr>
                  <?php
                  }
                  ?>
                    </table>
                     </form>
                </div>
             
            <?php

    }
?>
             
            </div>
          
          <div class="row">
            
              <?php
                  if(isset($a1) && count($a1)>0){
                     
                      ?>
                
                  <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                  
                    <h2><font color="#FF4000"><strong>Grafica de barras productos mas vendidos.</strong></font> </h2>
                    
                    
                  
                  <div class="clearfix"></div>
                </div>
                <div class="x_content1">
                  <div id="graph_bar_group" style="width:100%; height:280px;"></div>
                </div>
              </div>
            </div>

                  
<?php
                  }
                    ?>
        
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
    $("#datos_a_enviar").val( $("<div>").append( $("#example").eq(0).clone()).html());
    $("#FormularioExportacion").submit();
});
});
</script>


<script>
     $(function () {

    /* data stolen from http://howmanyleft.co.uk/vehicle/jaguar_'e'_type */
    var day_data = [
        
        <?php
                    for($i = 0;$i<count($a1);$i++){
                ?>
                {"period": "<?php print"$a2[$i]";?>", "Venta": <?php print"$a1[$i]";?>},
                <?php } ?>
        
        
        
    ];
    Morris.Bar({
        element: 'graph_bar_group',
        data: day_data,
        xkey: 'period',
        barColors: ['#00FF40', '#DF0101', '#ACADAC', '#3498DB'],
        ykeys: ['Venta'],
        labels: ['Venta'],
        hideHover: 'auto',
        xLabelAngle: 20
    });


});

  </script>
  
  <script src="js/moris/raphael-min.js"></script>
  <script src="js/moris/morris.min.js"></script>
  
<script>
 
$(document).ready(function() {
    $('#example').DataTable( {
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
                    extend: 'pageLength',
                    text: 'Mostrar filas',
                    className: 'orange'
                },
                
                {
                    extend: 'copy',
                    text: 'COPIAR',
                    className: 'red'
                },
                
                
                
                {
                    extend: 'excel',
                    text: 'EXCEL',
                    className: 'green'
                },
                {
                    extend: 'csv',
                    text: 'CSV',
                    className: 'green1'
                },
                {
                    extend: 'print',
                    text: 'IMPRIMIR',
                    className: 'green2'
                }
            ],
        
        
    } );
} );



</script>


  
</body>

</html>




