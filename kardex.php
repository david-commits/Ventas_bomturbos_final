  <?php
  session_start();
  include('menu.php');
  require_once("config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
  require_once("config/conexion.php");//Contiene funcion que conecta a la base de datos
  // require_once ("kardex1.php");

  $consulta1 = "SELECT * FROM products ";
  $result1 = mysqli_query($con, $consulta1);
  $producto = array();
  $i=0;
  while ($valor1 = mysqli_fetch_array($result1, MYSQLI_ASSOC)) {
      $producto[$i]=$valor1['nombre_producto'];
      $i=$i+1;
      
  }   
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
  if($a[12]==0){
      header("location:error.php");    
  }

  ?>
  <!DOCTYPE html>
  <html lang="es">

  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <!-- Meta, title, CSS, favicons, etc. -->
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
            <!-- /menu prile quick info -->

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
  $producto1="";

  $fecha1="";
  $fecha2="";
  $tienda=0;
  while ($valor1 = mysqli_fetch_array($result2, MYSQLI_ASSOC)) {
      
       if ($valor1['tipo']==20){
            $d=$valor1['id'];
            
            $id_producto=$valor1['a1'];
            $producto1=$valor1['a6'];
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
              //para llenar el combo box
              $querySucursales = "SELECT * FROM sucursal";
              $sucursales = mysqli_query($con,$querySucursales);
      
              ?>
            
             
                 
          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="container">

                <div>


                  <div class="panel panel-info">

                    <div class="panel-heading">
                      <h4>Llenar los campos para saber el Kardex de un Producto:</h4>
                    </div>


                    <br><br>


                    <!-- <form name="myForm" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" method="POST" action="kardex1.php">

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Nombre del Producto:</label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                          <input class="form-control estilo-placeholder" placeholder="Nombre del Producto" type="text" value="<?php //echo $producto1; ?>" name="producto" id="autocomplete-custom-append" data-validate-length-range="4"/>
                          <div id="autocomplete-container" style="position: relative; float: left; width: 400px; margin: 3px;"></div>
                        </div>
                      </div>
                      

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Fecha Inicial:</label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                          <input class="form-control estilo-placeholder input-fechas-horas-3" name="fecha1" data-validate-length-range="4" type="date" style="float: left;" id="fecha1" value="<?php echo $fecha1; ?>" required>
                        </div>
                      </div>
                      
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Fecha Final:</label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                          <input class="form-control estilo-placeholder input-fechas-horas-3" name="fecha2" data-validate-length-range="4" type="date" style="float: left;" id="fecha2" value="<?php echo $fecha2; ?>" required>
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Sucursal:</label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                          <select class="form-control estilo-placeholder" name="tienda" required="required" tabindex="-1">
                          <option class="custom-select" value="0"><?php //echo '--Seleccione--'?></option>
                            <?php  //foreach ($sucursales as $opciones) : ?>             
              
                              <option class="custom-select" value="<?php //echo $opciones['id_sucursal']?>"><?php //echo $opciones['nombre']?></option>
                            <?php  //endforeach ?>
                          </select>
                        </div>
                        <input type="hidden" name="d" value="1">
                      </div>

                      <div class="pull-right separador-compras">
                        <button id="send" type="submit" name="enviar" class="btn btn-guardar leyenda-asistencia-personal">Buscar</button>
                      </div>
                        
                      
                      </form> -->
                    
                       
                     
                 
            
            

                <?php   

  // $total1=0;
  // $total2=0;
  // $saldo=0;
  // if(true){

  // $sql="select * from products ORDER BY  `products`.`id_producto` DESC LIMIT 0 , 100";
  // $resultados=mysqli_query($con,$sql);



  // //     $sql="";
  // // }else{

  // $host= $_SERVER["HTTP_HOST"];
  // $url= $_SERVER["REQUEST_URI"];
  // $aa="http://".$host.$url;

                      
  ?>
        
         
    <div class="table-responsive">
      <table id="example" class="table display nowrap" style="width:90%">
                      <thead>
                    
                        <tr >
                         
                          <!-- <th class="th-general">Fecha  </th>
                          <th class="th-general">Hora  </th>
                          <th class="th-general">Producto  </th>
                          
                          <th class="th-general">Descripción  </th>
                          <th class="th-general">Doc  </th>
                          <th class="th-general">Tipo  </th>
                          <th class="th-general">Cli/Pro/Usu </th>
                          <th class="th-general">Nombre </th>
                          <th class="th-general">Inicial </th>
                          <th class="th-general">Entrada </th>
                          <th class="th-general">Salida  </th>
                          <th class="th-general">Saldo </th> -->


                          <!-- <th class="th-general">id detalleFact </th>
                          <th class="th-general">id factura </th>
                          <th class="th-general">id facturas det</th>
                          <th class="th-general">id producto </th> -->
                          <th class="th-general">fecha y Hora  </th>
                          <th class="th-general">Producto  </th>   
                          <th class="th-general">Sucursal </th>
                          <th class="th-general">Cantidad </th>
                          <th class="th-general">Compra/Venta </th>                       
                          <!-- <th class="th-general">Inicial </th> -->
                          <th class="th-general">Entrada </th>
                          <th class="th-general">Salida  </th>
                          <th class="th-general">Stok Actual</th>
                          
                        
                        </tr>
                      </thead>

                      <tbody>  
   <?php   
  //aca llega    
  $sql="select  s.nombre as sucursal,
                p.id_producto as idProducto,
                p.nombre_producto as nombrePro,
                p.b1 as stok,
                df.cantidad as cantidad,
                df.fecha as fecha,
                df.ven_com as ventaCompra,
                f.id_factura as factura,
                df.id_facturas as detFactura,
                df.id_detalle as idDetalle
        FROM detalle_factura df
        left join facturas f on f.id_factura = df.id_facturas
        left join products p on p.id_producto = df.id_producto
        left join sucursal s on s.tienda = df.tienda
        WHERE df.id_facturas is not null 
        


    ORDER BY df.fecha ASC  "; 

  // $s=1;
  $rs=mysqli_query($con,$sql);

  while($row= mysqli_fetch_array($rs)){
    // $idfactura = $row['factura'];
    $ventaCompra = $row['ventaCompra'];
    $entrada = 0;
    $salida = 0;
    if($ventaCompra == 1){
      $ventaCompra = 'Venta';
    }else{
      $ventaCompra = 'Compra';
    }

    $cantProd = $row['cantidad'];
    if($ventaCompra == 'Compra'){
      $entrada = $cantProd;
    } else {
      $salida = $cantProd;
    }
  // $id_vendedor=$row['id_vendedor'];
  // $numero_factura=$row['numero_factura'];
  // $cantidad1=$row['cantidad'];
  // $precio_compra=$row['precio_venta'];
  // $tienda3=$row['tienda'];
  // $tipo=$row['ven_com'];
  // $tipo_doc=$row['tipo_doc'];
  // $inv_ini=$row['inv_ini'];
  // $id_producto1=$row['id_producto'];
  // if($tipo==1){
  //     $entrada=0;
  //     $salida=$cantidad1;
  //     if($numero_factura==0){
          
  //         $descripcion="Traslado de tienda";
          
  //     }else{
  //         if($precio_compra>0)
  //         {
  //             $descripcion="Ventas";
  //         }else{
  //             $descripcion="Documento Eliminado";
  //         }
       
  //     }
   
  // }else{
  //     $salida=0;
  //     $entrada=$cantidad1;
  //     if($numero_factura==0){
          
  //         $descripcion="Traslado de tienda";
  //     }else{
  //         if($precio_compra>0)
  //         {
  //             $descripcion="Compras";
  //         }else{
  //             $descripcion="Documento Eliminado";
  //         }
  //     }
  // }
  // $saldo=$inv_ini+$entrada-$salida;

  // if($tipo_doc==1){
          
  //         $descripcion1="Factura";
      
  //         if($tipo==1){
  //     $tipo_cliente="Cliente"; 
  //  }   
  //  if($tipo==2){
  //     $tipo_cliente="Proveedor"; 
  //  } 
          
          
          
  //     }
  // if($tipo_doc==2){
          
  //         $descripcion1="Boleta";
  //         if($tipo==1){
  //     $tipo_cliente="Cliente"; 
  //  }   
  //  if($tipo==2){
  //     $tipo_cliente="Proveedor"; 
  //  } 
          
          
  //     }
  //     if($tipo_doc==3){
          
  //         $descripcion1="Guia";
  //         if($tipo==1){
  //     $tipo_cliente="Cliente"; 
  //  }   
  //  if($tipo==2){
  //     $tipo_cliente="Proveedor"; 
  //  } 
          
  //     }
      
  //   if($tipo_doc==0){
          
  //         $descripcion1="Ninguno";
  //         $tipo_cliente="Usuario";
          
  //     }
      
  //     if($precio_compra==0){
          
  //         if($tipo==1){
  //     $tipo_cliente="Proveedor"; 
  //  }   
  //  if($tipo==2){
  //     $tipo_cliente="Cliente"; 
  //  } 
          
  //     }

   
  // if($tipo_doc>0){
      

  // $consulta1 = "SELECT * FROM facturas ";
  // $result1 = mysqli_query($con, $consulta1);


  // while ($valor1 = mysqli_fetch_array($result1, MYSQLI_ASSOC)) {
  //     if($valor1['numero_factura']==$numero_factura && $valor1['estado_factura']==$tipo_doc && $valor1['tienda']==$tienda3){

  //     $id=$valor1['id_cliente'];
      
  //     }
      
  // }


  // $consulta2 = "SELECT * FROM clientes ";
  // $result2 = mysqli_query($con, $consulta2);


  // while ($valor1 = mysqli_fetch_array($result2, MYSQLI_ASSOC)) {
      
  //     if($valor1['id_cliente']==$id){
  //     $cliente1=$valor1['nombre_cliente'];
      
  //     }
      
  // }

  // }


  // if($tipo_doc==0){
  //     $consulta2 = "SELECT * FROM users ";
  //     $result2 = mysqli_query($con, $consulta2);


  //     while ($valor1 = mysqli_fetch_array($result2, MYSQLI_ASSOC)) {
      
  //         if($valor1['user_id']==$id_vendedor){
  //     $nombre1=$valor1['nombres'];
      
      
  //     }
      
  // }
  // $cliente1=$nombre1;

  // }

  // $fecha3=$row['fecha'];
  // $d3 = explode("-",$fecha3);
  // $dia=date("d",strtotime($fecha3)); 
  // $mes=date("m",strtotime($fecha3));  
  // $ano=date("Y",strtotime($fecha3)); 
  // $dd=$ano."-".$mes."-".$dia;
  // $dd5=$mes."-".$dia."-".$ano;
  // $hora=date("H:i",strtotime($fecha3)); 
  // $fecha=strtotime($dd);
  // $fech1=strtotime($dd1);
  // $fech2=strtotime($dd2);
  // $tienda=$row['tienda'];
  // $total_venta=$row['precio_venta']*$cantidad1;
  // if($id_producto1==$id_producto  && $fecha>=$fech1 && $fecha<=$fech2 && $tienda>=$tienda1 && $tienda<=$tienda2){

  //         $total1=$total1+$total_venta;
  //         $mon="S/.";
        
          ?>
                         
          <tr id="valor1">
          <!-- <td class="th-general"> <?php //echo $row['idDetalle']; ?></td>
            <td class="th-general"> <?php //echo $row['factura']; ?></td>
            <td class="th-general"> <?php //echo $row['detFactura']; ?></td> -->
                          <!-- <td class="th-general"> <?php //echo $row['idProducto']; //print"$dd5"?></td> -->
                          <td class="th-general" ><?php echo $row['fecha']; //print"$hora";?></td>
                          <td class="th-general"><?php echo $row['nombrePro']; //echo utf8_decode($producto1);?></td>
                          
                          <td class="th-general"><?php echo $row['sucursal']; //echo $numero_factura;?></td>
                          
                          <td class="th-general"><?php echo $row['cantidad'];//echo $descripcion1;?></td>
                          <td class="th-general"><?php echo $ventaCompra;//echo $tipo_cliente;?></td>
                          
                          <td class="th-general"><?php echo $entrada;//echo utf8_decode($cliente1);?></td>
                          <td class="th-general"><?php echo $salida;// echo $inv_ini;?></td>
                          <!-- <td class="th-general"><?php //echo $entrada;?></td> -->
                          <!-- <td class="th-general"><?php //echo $salida;?></td> -->
                          <td class="th-general"><?php echo $row['stok']; //print"$descripcion";?></td>
                          <!-- <td class="th-general"><?php// echo $saldo;?></td> -->
                          
                          
                        </tr>                
      <?php
                    //     $s=$s+1;
                    // }
                    }                      
     ?>
                      
                      </tbody>

                    </table>
    </div>
        
                    
                  </div>
                
                
              <?php // } ?>
               
              <!-- </div> -->
              </div>
                     </div>
              </div>      
           
          <!-- /footer content -->
        </div>
        <!-- /page content -->

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

    <!-- bootstrap progress js -->
    <script src="js/progressbar/bootstrap-progressbar.min.js"></script>
    <script src="js/nicescroll/jquery.nicescroll.min.js"></script>
    <!-- icheck -->
    <script src="js/icheck/icheck.min.js"></script>

    <script src="js/custom.js"></script>


    <!-- Datatables -->
    
  <?php $a=$_SESSION['tabla'];?>
    <!-- pace -->
    <script src="js/pace/pace.min.js"></script>
    
    
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
          maximumSelectionLength: 100,
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
   

    $(document).ready(function(){
      $('.EditProducto').click(function(){
        $('.close').click();
      });
    
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
      buttons: [    
        // {
        //   extend: 'colvis',
        //   text: 'Mostrar columnas',
        //   className: 'green2',
        // },                 
        // {
        //   extend: 'pageLength',
        //   text: 'Mostrar filas',
        //   className: 'orange',
        // },    
        // {
        //   extend: 'copy',
        //   text: 'COPIAR',
        //   className: 'red',
        // },      
        {
          extend: 'excel',
          text: 'EXCEL',
          className: 'green',
        },
        // {
        //   extend: 'csv',
        //   text: 'CSV',
        //   className: 'green1',
        // },
        // {
        //   extend: 'print',
        //   text: 'IMPRIMIR',
        //   className: 'green2',
        // }
      ],
      "pageLength": 20,
    });
    });

  </script>




  </body>

  </html>




