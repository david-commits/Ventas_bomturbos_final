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
if($a[6]==0){
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

  <title> 
  Utilidades
  
  </title>

 <link href="css/bootstrap.min.css" rel="stylesheet">

  <link href="fonts/css/font-awesome.min.css" rel="stylesheet">
  <link href="css/animate.min.css" rel="stylesheet">

  <!-- Custom styling plus plugins -->
  <link href="css/custom.css" rel="stylesheet">
  <link href="css/icheck/flat/green.css" rel="stylesheet">
  <link href="css/datatables/tools/css/dataTables.tableTools.css" rel="stylesheet">
 <link href="css/select/select2.min.css" rel="stylesheet">
  <script src="js/jquery.min.js"></script>
 
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>


 <link rel="stylesheet" type="text/css" href="Buttons/css/buttons.dataTables.min.css"/>


<script type="text/javascript" src="DataTables/datatables.min.js"></script>


<script type="text/javascript" src="Buttons/js/buttons.flash.min.js"></script>


<script type="text/javascript" src="Buttons/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="Buttons/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="Buttons/js/buttons.print.min.js"></script>
<style>
    table tr:nth-child(odd) {background-color: #FBF8EF;}

table tr:nth-child(even) {background-color: #EFFBF5;}
 #valor1 {
              

border-bottom: 2px solid #F5ECCE;

}  

#valor1:hover {
              
background-color: white;
border-bottom: 2px solid #A9E2F3;

} 

.dt-button.red {
        color: black;
        
        background:red;
    }
 
    .dt-button.orange {
        color: black;
        background:orange;
    }
 
    .dt-button.green {
        color: black;
        background:green;
    }
    
    .dt-button.green1 {
        color: black;
        background:#01DFA5;
    }
    
    .dt-button.green2 {
        color: black;
        background:#2E9AFE;
    }
</style>
</head>

<body class="nav-md">

  <div class="container body">


    <div class="main_container">

      <div class="right_col" role="main">

            <div class="row">
            <?php
                $a=recoge1('f');
            ?>
            <h1 style="color:red;">Utilidades dia <?php echo $a;?></h1>        
              
            <?php
            if($a==0){
                $sql="";
            }else{
                ?>
                <div class="table-responsive">
                   
                  <table id="example" class="display nowrap" style="width:100%">
                    <thead>
                        <tr style="background-color:#FE9A2E;color:white; ">
                            <th>Número Doc </th>
                            <th>Tipo de Doc  </th>
                            <th>Fecha</th>
                            <th>Tipo  </th>
                            <th>Product/Servicio  </th>
                            <th>Cantidad </th>
                            <th>Ingreso  </th>
                            <th>Costo </th>
                            <th>Utilidad </th>
                        </tr>
                    </thead>

                    <tbody>  
 <?php  
 
$servicio=0;
$venta1=0;
$compra1=0;
$ingreso1=0;
$costo1=0;
$utilidad1=0;
$sql="select * from detalle_factura where activo=1"; 
$rs=mysqli_query($con,$sql);
while($row= mysqli_fetch_array($rs)){
    $fecha3=$row['fecha'];
    $d3 = explode("-",$fecha3);
    $dia=date("d",strtotime($fecha3)); 
    $mes=date("m",strtotime($fecha3));  
    $ano=$d3[0];
    $dd=$dia."-".$mes."-".$ano;
    $id_producto=$row['id_producto'];
    $ven_com=$row['ven_com'];
    $moneda=$row['moneda'];
    $numero_factura=$row['numero_factura'];
    $precio_compra=$row['precio_compra'];
    $id_detalle=$row['numero_factura'];
    $tipo_doc=$row['tipo_doc'];
    if($tipo_doc==1){
        $tipo_doc1="Factura";
    }
    
    if($tipo_doc==2){
        $tipo_doc1="Boleta";
    }
    if($tipo_doc==3){
        $tipo_doc1="Guia";
    }
    
    $precio_venta=$row['precio_venta'];
    $cantidad=$row['cantidad'];
    
    if($ven_com==1){
    $ingreso=$precio_venta*$cantidad;
    $costo=$precio_compra*$cantidad;
    $utilidad=$ingreso-$costo;
    $tipo1="Venta";
    $venta=$precio_venta*$cantidad;
    $compra=0;
    $d1=$precio_venta;
    $d2=$precio_compra;
}
if($ven_com==2){
    $ingreso=0;
    $costo=$precio_venta*$cantidad;
    $utilidad=$ingreso-$costo;
    $tipo1="Compra";
    $compra=$precio_venta*$cantidad;
    $venta=0;
    $d1=0;
    $d2=$precio_venta;
}
if($dd==$a){
    if($id_detalle>0){
    if(!is_numeric($id_producto)){
        $nombre=$id_producto;
        $tipo1="Servicio";
        $venta1=$venta1+$venta;
        $compra1=$compra1+$compra;
        $ingreso1=$ingreso1+$ingreso;
        $costo1=$costo1+$costo;
        $utilidad1=$utilidad1+$utilidad; 
    }else{
        $sql1="select * from $db_products where id_producto=$id_producto";
        $rs1=mysqli_query($db,$sql1);
        $row1=mysqli_fetch_array($rs1);
        $nombre=$row1['nombre_producto'];
        $venta1=$venta1+$venta;
        $compra1=$compra1+$compra;
        $ingreso1=$ingreso1+$ingreso;
        $costo1=$costo1+$costo;
        $utilidad1=$utilidad1+$utilidad;    
    }
 
        ?>
        <tr id="valor1">
            <td class=" "><?php print"$id_detalle";?></td>
            <td class=" "><?php print"$tipo_doc1";?></td>
            <td class=" "><?php print"$a";?></td>
            <td class=" "><?php print"$tipo1";?></td>
            <td class=" "><?php echo $nombre;?></td>
            <td class=" "><?php echo $mon;?></td>
            <td class=" "><?php echo $cantidad;?></td>
            <td class=" "><?php echo $d1;?></td>
            <td class=" "><?php echo $d2;?></td>
            <td class=" "><?php echo $utilidad;?></td>
                      
        </tr>                
        <?php
    }
}
}
}                       
?>
                </tbody>

                  </table>
                
                     </form>
                </div>
                <table class="table table-striped responsive-utilities jambo_table" style="background-color:#ACFA58;color:black;">
                    <tr><td colspan="2"><h3 style="color:blue;">Ventas-Compras:</h3></td>
                 
                        <td >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp</td>
                        <td class=" ">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp</td>
                        <td class=" ">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp</td>
                        <td class=" ">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp</td>
                    </tr>
                    <tr class="even pointer">
                       <td class=" "><strong><font color="blue">Ventas:</font></strong></td>
                        <td><?php echo $venta1;?></td>
                        <td class=" ">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp</td>
                        <td class=" ">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp</td>
                        <td class=" ">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp</td>
                        <td class=" ">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp</td>
                    </tr>
                    <tr class="even pointer">
                    <td class=" "><strong><font color="red">Compras:</font></strong></td>
                    <td><?php echo $compra1;?></td>
                        <td class=" ">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp</td>
                        <td class=" ">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp</td>
                        <td class=" ">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp</td>
                        <td class=" ">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp</td>
                       
                    </tr>
                    <tr class="even pointer">
                        <td class=" "><strong><font color="blue">Diferencia:</font></strong></td>
                        <td><?php $dif=$venta1-$compra1;echo $dif;?></td>
                        <td class=" ">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp</td>
                        <td class=" ">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp</td>
                        <td class=" ">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp</td>
                        <td class=" ">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp</td>
                         
                    </tr>
                    <tr><td colspan="2"><h3 style="color:#FF8000;">Ingresos-Costos:</h3></td>
                        <td class=" ">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp</td>
                        <td class=" ">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp</td>
                        <td class=" ">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp</td>
                        <td class=" ">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp</td>
                    </tr>
                    <tr class="even pointer">
                        <td class=" "><strong><font color="blue">Ingreso:</font></strong></td>
                        <td><?php echo $ingreso1;?></td>
                        <td class=" ">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp</td>
                        <td class=" ">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp</td>
                        <td class=" ">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp</td>
                        <td class=" ">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp</td>
                        
                    </tr>
                    <tr class="even pointer">
                        <td class=" "><strong><font color="red">Costos:</font></strong></td>
                        <td><?php echo $costo1;?></td>
                        <td class=" ">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp</td>
                        <td class=" ">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp</td>
                        <td class=" ">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp</td>
                        <td class=" ">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp</td>
                       
                    </tr>
                    <tr class="even pointer">
                        <td class=" "><strong><font color="blue">Utilidades:</font></strong></td>
                        <td><?php $dif1=$ingreso1-$costo1;echo $dif1;?></td>
                        <td class=" ">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp</td>
                        <td class=" ">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp</td>
                        <td class=" ">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp</td>
                        <td class=" ">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp</td>
                        
                    </tr>
                </table> 
            </div>
       
            <br />
            <br />
            <br />

          </div>
      
      </div>
      

    </div>

  </div>

  <div id="custom_notifications" class="custom-notifications dsp_none">
    <ul class="list-unstyled notifications clearfix" data-tabbed_notifications="notif-group">
    </ul>
    <div class="clearfix"></div>
    <div id="notif-group" class="tabbed_notifications"></div>
  </div>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/progressbar/bootstrap-progressbar.min.js"></script>
  <script src="js/nicescroll/jquery.nicescroll.min.js"></script>
  <script src="js/icheck/icheck.min.js"></script>
  <script src="js/custom.js"></script>
  <script type="text/javascript" src="js/autocomplete/countries.js"></script>
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




