<?php
session_start();
include('menu.php');
require_once ("config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
require_once ("config/conexion.php");
$sql1="select * from users where user_id=$_SESSION[user_id]";
$rw1=mysqli_query($con,$sql1);//recuperando el registro
$rs1=mysqli_fetch_array($rw1);//trasformar el registro en un vector asociativo
$modulo=$rs1["accesos"];
$a = explode(".", $modulo); 
if (!isset($_SESSION['user_login_status']) AND $_SESSION['user_login_status'] != 1) {
    header("location: login.php");
    exit;
}
if($a[1]==0){
    header("location:error.php");    
}
date_default_timezone_set('America/Lima');
$d=date("d");
$m=date("m");
$aa=date("Y");
$dd1=$aa."-".$m."-".$d;
$fech1=strtotime($dd1);
$f1=$fech1/(24*3600);
$a1=array();
$a2=array();
$a3=array();
$a4=array();
$fec=array();
$j=0;
$total1=0;
$total2=0;
$total3=0;
$total4=0;
for($i=($f1-9);$i<=$f1;$i++){
$fec[$j]=0;
$sql1="select * from facturas where activo=1"; 
$rs1=mysqli_query($con,$sql1);
$total1=0;
$total2=0;
$total3=0;
$total4=0;
$efectivo1=0;
$efectivo2=0;
$entrada=0;
$salida=0;
$a1[$j]=0;
$a2[$j]=0;
$a3[$j]=0;
$a4[$j]=0;
$a=0;
while($row1= mysqli_fetch_array($rs1)){
$fecha3=$row1['fecha_factura'];
$tienda=$row1['tienda'];
$tipo=$row1['ven_com'];
$condiciones=$row1['condiciones'];
$estado=$row1['estado_factura'];
$d3 = explode("-",$fecha3);
$dia=date("d",strtotime($fecha3)); 
$mes=date("m",strtotime($fecha3));  
$ano=$d3[0];
$dd=$ano."-".$mes."-".$dia;
$fecha=strtotime($dd);
if($fecha==$i*24*3600 && $tienda==$_SESSION['tienda']){    
    if(($tipo==1 || $tipo==3 || $tipo==5) and $estado<>6){
    if($condiciones>0){
        $entrada=$row1['total_venta'];
        if($tipo==1){
          $total1=$total1+$entrada;  
        }
        if($condiciones<>4){
        $total2=$total2+$entrada;}
        $salida=0;
    }else{
        $salida=0;
        $entrada=0;
    }
}
if($tipo==2 || $tipo==4 || $tipo==6 || ($tipo==1 and $estado==6)){
    
    if($condiciones>0){
        $salida=$row1['total_venta'];
        if($tipo==2){
          $total3=$total3+$salida;  
        }
        if($condiciones<>4){
            $total4=$total4+$salida;
        }
        $entrada=0;
    }else{
        $salida=0;
        $entrada=0;
    }
}

  $a=$a+1;  
}
}

$fec[$j]=date('d-m-Y',$i*24*3600);
$a1[$j]=$total1;
$a2[$j]=$total2;
$a3[$j]=$total3;
$a4[$j]=$total4;
$j=$j+1;
}
$a5=array();
$a6=array();
$a7=array();
$a8=array();
$fec1=array();
$j=1;
$total5=0;
$total6=0;
$total7=0;
$total8=0;    
$m1=date("m");
$ano=date("Y");  
    for($i=1;$i<=$m1;$i++){
 
    $fec1[$j]=0;
    $sql1="select * from facturas where activo=1"; 
    $rs1=mysqli_query($con,$sql1);
    $total5=0;
    $total6=0;
    $total7=0;
    $total8=0;
    $efectivo1=0;
    $efectivo2=0;
    $entrada=0;
    $salida=0;
    $a5[$j]=0;
    $a6[$j]=0;
    $a7[$j]=0;
    $a8[$j]=0;
    $a=0;
    while($row1= mysqli_fetch_array($rs1)){
        $fecha3=$row1['fecha_factura'];
        $tienda=$row1['tienda'];
        $tipo=$row1['ven_com'];
        $condiciones=$row1['condiciones'];
        $estado=$row1['estado_factura'];
        $d3 = explode("-",$fecha3);
        $dia=date("d",strtotime($fecha3)); 
        $mes=date("m",strtotime($fecha3));  
        $ano1=date("Y",strtotime($fecha3));  
        if($mes==$i && $ano==$ano1 && $tienda==$_SESSION['tienda']){    
            if(($tipo==1 || $tipo==3 || $tipo==5) and $estado<>6){
                if($condiciones>0){
                    $entrada=$row1['total_venta'];
                    if($tipo==1){
                        $total5=$total5+$entrada;  
                    }
                if($condiciones<>4){
                    $total6=$total6+$entrada;}
                    $salida=0;
                }else{
                    $salida=0;
                    $entrada=0;
                }
            }
            if($tipo==2 || $tipo==4 || $tipo==6 || ($tipo==1 and $estado==6)){
                if($condiciones>0){
                    $salida=$row1['total_venta'];
                    if($tipo==2){
                        $total7=$total7+$salida;  
                    }
                    if($condiciones<>4){
                        $total8=$total8+$salida;
                    }
                    $entrada=0;
                }else{
                    $salida=0;
                    $entrada=0;
                }
            }
            $a=$a+1;  
        }
    }
  if($j==1){
      $mes2="Enero";
  }  
  if($j==2){
      $mes2="Febrero";
  } 
  if($j==3){
      $mes2="Marzo";
  } 
  if($j==4){
      $mes2="Abril";
  } 
  if($j==5){
      $mes2="Mayo";
  } 
  if($j==6){
      $mes2="Junio";
  } 
  if($j==7){
      $mes2="Julio";
  } 
  if($j==8){
      $mes2="Agosto";
  } 
  if($j==9){
      $mes2="Septiembre";
  } 
  if($j==10){
      $mes2="Octubre";
  } 
  if($j==11){
      $mes2="Noviembre";
  } 
  if($j==12){
      $mes2="Diciembre";
  }   
$fec1[$j]=$mes2."-".$ano;
$a5[$j]=$total5;
$a6[$j]=$total6;
$a7[$j]=$total7;
$a8[$j]=$total8;
$j=$j+1;
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
  <!-- Custom styling plus plugins -->
  <link href="css/custom.css" rel="stylesheet">
  <link rel="icon" href="images/usuario16.jpg">
  <link rel="stylesheet" type="text/css" href="css/maps/jquery-jvectormap-2.0.3.css" />
  <link href="css/icheck/flat/green.css" rel="stylesheet">
  <link href="css/floatexamples.css" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css?family=Quicksand:300,400,500,600,700&display=swap" rel="stylesheet"> 
  <script src="js/jquery.min.js"></script>
  <style type="text/css">#dato{}</style>
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
          <!-- /menu prile quick info -->

          <br />

        </div>
      </div>

        
        <?php
          menu3();
          
      
        ?>

      <div class="right_col" role="main">

        <br />
        <div class="">

          <div class="row top_tiles">
            <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div id="dato" >
                <div class="tile-stats estadistica-azul">
                <div class="icon"><i class="fa fa-building"></i>
                </div>
                    <div class="count"><font color="white">S/.<?php echo $total1;?></font></div>

                    <h3><font color="white"><strong>VENTAS</strong></font></h3>
                    <p sTYLE="color:black"><strong>Fecha: <?php echo date("d-m-Y");?></strong></p>
              </div>
                  </div>  
            </div>
            <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
              <div class="tile-stats estadistica-rojo">
                <div class="icon"><i class="fa fa-shopping-cart"></i>
                </div>
                <div class="count"><font color="white">S/.<?php echo $total3;?></font></div>

                <h3><font color="white"><strong>COMPRAS</strong></font></h3>
                <p sTYLE="color:black"><strong>Fecha: <?php echo date("d-m-Y");?></strong></p>
              </div>
            </div>
            <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
              <div class="tile-stats estadistica-verde">
                <div class="icon"><i class="fa fa-money"></i>
                </div>
                <div class="count"><font color="white">S/.<?php echo $total2;?></font></div>

                <h3><font color="white"><strong>ENTRADAS</strong></font></h3>
                <p sTYLE="color:black"><strong>Fecha: <?php echo date("d-m-Y");?></strong></p>
              </div>
            </div>
            <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
              <div class="tile-stats estadistica-naranja">
                <div class="icon"><i class="fa fa-toggle-up"></i>
                </div>
                <div class="count"><font color="white">S/.<?php echo $total4;?></font></div>

                <h3><font color="white"><strong>SALIDAS</strong></font></h3>
                <p sTYLE="color:black"><strong>Fecha: <?php echo date("d-m-Y");?></strong></p>
              </div>
            </div>
          </div>

          <div class="row">
                <div class="col-md-6 col-sm-6 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                    
                    <p class="titulo-resumen">Grafica de barras Ventas y Compras (Últimos 10 días)</p>
                  
                  
                  <div class="clearfix"></div>
                </div>
                <div class="x_content1">
                  <div id="graph_bar_group1" style="width:100%; height:280px;"></div>
                  
                  
                </div>
              </div>
            </div>

               <div class="col-md-6 col-sm-6 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                    
                    <p class="titulo-resumen">Grafica de barras Entradas y Salidas (Últimos 10 días)</p>
                  
                  
                  <div class="clearfix"></div>
                </div>
                <div class="x_content1">
                  
                  
                  <div id="graph_bar_group" style="width:100%; height:280px;"></div>
                </div>
              </div>
            </div>
             
              <div class="col-md-6 col-sm-6 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                    
                    <p class="titulo-resumen">Grafica de barras Ventas y Compras (Últimos Meses)</p>
                  
                  
                  <div class="clearfix"></div>
                </div>
                <div class="x_content1">
                  
                  
                  <div id="graph_bar_group2" style="width:100%; height:280px;"></div>
                </div>
              </div>
            </div>
              
              
              
               <div class="col-md-6 col-sm-6 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                    
                    <p class="titulo-resumen">Grafica de barras Entradas y Salidas (Últimos Meses)</p>
                  
                  
                  <div class="clearfix"></div>
                </div>
                <div class="x_content1">
                  
                  
                  <div id="graph_bar_group3" style="width:100%; height:280px;"></div>
                </div>
              </div>
            </div>
      </div>
         
            </div>
     </div>

 
      </div>

      <div style="padding-right:20px !important">
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

  <script>
     $(function () {

    var day_data = [
        
        <?php
                    for($i = 0;$i<=9;$i++){
                ?>
                {"period": "<?php print"$fec[$i]";?>", "Entradas": <?php print"$a2[$i]";?>, "Salidas": <?php print"$a4[$i]";?>},
                <?php } ?>
        
        
        
    ];
    Morris.Bar({
        element: 'graph_bar_group',
        data: day_data,
        xkey: 'period',
        barColors: ['#04B431', 'orange', '#ACADAC', 'orange'],
        ykeys: ['Entradas', 'Salidas'],
        labels: ['Entradas', 'Salidas'],
        hideHover: 'auto',
        xLabelAngle: 60
    });

 

});
    $(function () {

   
    var day_data = [
        
        <?php
                    for($i = 0;$i<=9;$i++){
                ?>
                {"period": "<?php print"$fec[$i]";?>", "Ventas": <?php print"$a1[$i]";?>, "Compras": <?php print"$a3[$i]";?>},
                <?php } ?>
        
        
        
    ];
    Morris.Bar({
        element: 'graph_bar_group1',
        data: day_data,
        xkey: 'period',
        barColors: ['#0000FF', '#FF0000', '#ACADAC', '#3498DB'],
        ykeys: ['Ventas', 'Compras'],
        labels: ['Ventas', 'Compras'],
        hideHover: 'auto',
        xLabelAngle: 60
    });



var day_data = [
        
        <?php
                    for($i = 1;$i<=$m1;$i++){
                ?>
                {"period": "<?php print"$fec1[$i]";?>", "Entradas": <?php print"$a6[$i]";?>, "Salidas": <?php print"$a8[$i]";?>},
                <?php } ?>
        
        
        
    ];
    Morris.Bar({
        element: 'graph_bar_group3',
        data: day_data,
        xkey: 'period',
        barColors: ['#04B431', 'orange', '#ACADAC', 'orange'],
        ykeys: ['Entradas', 'Salidas'],
        labels: ['Entradas', 'Salidas'],
        hideHover: 'auto',
        xLabelAngle: 60
    });
    
    
    var day_data = [
        
        <?php
                    for($i = 1;$i<=$m1;$i++){
                ?>
                {"period": "<?php print"$fec1[$i]";?>", "Ventas": <?php print"$a5[$i]";?>, "Compras": <?php print"$a7[$i]";?>},
                <?php } ?>
        
        
        
    ];
    Morris.Bar({
        element: 'graph_bar_group2',
        data: day_data,
        xkey: 'period',
        barColors: ['#0000FF', '#FF0000', '#ACADAC', '#3498DB'],
        ykeys: ['Ventas', 'Compras'],
        labels: ['Ventas', 'Compras'],
        hideHover: 'auto',
        xLabelAngle: 60
    });
 

});
  </script> 
  <script src="js/moris/raphael-min.js"></script>
  <script src="js/moris/morris.min.js"></script>
 
</body>

</html>