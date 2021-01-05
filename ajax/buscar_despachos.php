<?php
  include('is_logged.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado
  /* Connect To Database*/
  require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
        include 'pagination.php'; //include pagination file
  require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos

  $action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
  echo "<script>console.log('aaaaaaaaaaa');</script>";
  if (isset($_GET['id'])){
    $id_categoria=intval($_GET['id']);
    $query=mysqli_query($con, "select * from products where estado=1 AND cat_pro='".$id_categoria."'");
    $count=mysqli_num_rows($query);      
        if ($count==0){
            if ($delete1=mysqli_query($con,"UPDATE categorias SET estado=0 WHERE  id_categoria='".$id_categoria."'")){
            ?>
            <div id="alertborrarcategorias"  class="alert alert-success alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <strong>Aviso!</strong> Datos eliminados exitosamente.
            </div>
            <?php 
        }else {
            ?>
            <div id="alertborrarcategorias" class="alert alert-danger alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <strong>Error!</strong> Lo siento algo ha salido mal intenta nuevamente.
            </div>
            <?php
            
        }
            
        } else {
            ?>
            <div id="alertborrarcategorias" class="alert alert-danger alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <strong>Error!</strong> No se pudo eliminar ésta categoria.Existen productos asignados a esta categoría. 
            </div>
            <?php
        }
  }

  if($action == 'ajax'){
    

    $arrayproq = explode(" ", $_REQUEST['q1']);
    $q2metoenvio = $_REQUEST['q2'];
    $q3estadoenvio = $_REQUEST['q3'];
    $q4estopago = $_REQUEST['q4'];
    
    $conarray = count($arrayproq);
        $aColumns = array('cl.nombre_cliente');//
    $nucarray = count($aColumns) - 1;

    // escaping, additionally removing everything that could be (html/javascript-) code
//$aColumns = array('nom_cat');//Columnas de busqueda
         $idsucursalprincipal = 0 ;
 


        $sTable = " cabecera_orden co inner join users usr on co.id_cliente = usr.user_id inner join tipo_envios te on co.tipo_de_envio = te.id_tipoenvios inner join clientes cl on usr.id_cliente = cl.id_cliente ";
         $sWhere = "WHERE co.id > 0 and cl.sucursal = ".$_SESSION['tienda']."";
    

      $sqlparatraersucursalprincipal = "SELECT * FROM sucursal where id_sucursal = ".$_SESSION['tienda']."";
$queryparasucursalprincipal = mysqli_query($con, $sqlparatraersucursalprincipal);
while ($rowsp=mysqli_fetch_array($queryparasucursalprincipal)){
  $idsucursalprincipal = $rowsp['id_sucursal_principal'];
}
//var_dump($idsucursalprincipal);

         
     // $sWhere = " WHERE estado = 1";3

         if (isset($q2metoenvio) && $q2metoenvio > 0) {
            $sWhere .= " AND co.tipo_de_envio = $q2metoenvio";
         }

         if (isset($q3estadoenvio) && $q3estadoenvio > 0) {
            $sWhere .= " AND co.estado_envio = $q3estadoenvio";
         }
         if (isset($q4estopago) && $q4estopago > 0) {
            $sWhere .= " AND co.estado_pago = $q4estopago";
         }

           if ( $arrayproq[0] != ''){
      for ($a=0; $a < $conarray ; $a++) { 
        $sWhere .= " and ( ";
        for ( $i=0 ; $i< count($aColumns) ; $i++ ){
          $sWhere .= $aColumns[$i]." LIKE '%".$arrayproq[$a]."%' ";
          if ($i < $nucarray){
            $sWhere .= "OR ";
          }
        }
        $sWhere .= ") ";
      }
     // $sWhere = substr_replace( $sWhere, "", -4 );
    }
        
       // $sWhere.=" order by id_categoria asc";
        $sWhere.="";
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
        $reload = './categorias.php';
        //main query to fetch the data
        $sql="SELECT  co.id, 
                      co.nro_pre_orden,
                      co.estado_factura as eefactura,
                      cl.nombre_cliente, 
                      cl.telefono_cliente, 
                      te.nombre_tenvio,
                      co.fecha,
                      co.estado_pago, 
                      co.estado_envio 
                      FROM  $sTable $sWhere 
                      order by co.id 
                      desc LIMIT $offset,$per_page";

//var_dump($sql);
        $query = mysqli_query($con, $sql);

        //loop through fetched data
        if ($numrows>0 || $numrows == 0){
?>
      <div class="table-responsive">
        <table id="example" class="table display nowrap">
        <tfoot class="th-general">
          <tr class="th-general">
            <!-- <div class="pull-right separador-compras">
              <a href="ingresoProductos.php" class="btn btn-guardar" style="width: 150px;" id=""><span id="">Nuevo Producto</span></a>
            </div>  -->
          </tr>
        </tfoot>
        <thead >
          <tr class="th-general">
                        <th class="th-general">#</th>
                        <th class="th-general">Cod. Orden</th>
                        <th class="th-general">Cliente</th>
                        <th class="th-general">Teléfono</th>
                        <th class="th-general">Método de Envío</th>
                        <th class="th-general">Cant. de Productos</th>
                        <th class="th-general">Monto</th>
                        <th class="th-general">Estado de Pago</th>
                        <th class="th-general">Estado de Envío</th>
                        <th class="th-general">Fecha</th>
                        <th class="th-general">Acciones</th>
          </tr>
        </thead>
<tbody>
  <?php 
    $nuevocontadorlista = 1;
    $ii = 1;
    if($idsucursalprincipal == 1){


      $count_query_sp   = mysqli_query($con, "SELECT count(*) AS numrows FROM cabecera_orden co inner join users usr on co.id_cliente = usr.user_id inner join tipo_envios te on co.tipo_de_envio = te.id_tipoenvios inner join clientes cl on usr.id_cliente = cl.id_cliente WHERE co.id > 0 and cl.sucursal = 0 order by co.id desc");
        $row_sp= mysqli_fetch_array($count_query_sp);
        $numrows_sp = $row_sp['numrows'];
    if ($numrows_sp > 0 ){

      $sqldataprincipal0="SELECT co.id, 
                          co.nro_pre_orden,
                          co.estado_factura as eeefactura,
                          cl.nombre_cliente, 
                          cl.telefono_cliente, 
                          te.nombre_tenvio,
                          co.fecha, 
                          co.estado_pago, 
                          co.estado_envio FROM cabecera_orden co 
                          inner join users usr on co.id_cliente = usr.user_id 
                          inner join tipo_envios te on co.tipo_de_envio = te.id_tipoenvios 
                          inner join clientes cl on usr.id_cliente = cl.id_cliente
                          WHERE co.id > 0 and cl.sucursal = 0 
                          order by co.id 
                          desc LIMIT $offset,$per_page";
      $querydataprincipal0 = mysqli_query($con, $sqldataprincipal0);
      while ($rowdataprincipal0=mysqli_fetch_array($querydataprincipal0)){
        $iddp=$rowdataprincipal0['id'];
        $eeefactura=$rowdataprincipal0['eeefactura'];
        $nro_pre_ordendp=$rowdataprincipal0['nro_pre_orden'];
        $nombre_clientedp=$rowdataprincipal0['nombre_cliente'];
        $telefono_clientedp=$rowdataprincipal0['telefono_cliente'];
        $nombre_tenviodp=$rowdataprincipal0['nombre_tenvio'];
        $colorestadopagodp = "";
        $colorestadoenviodp = "";
        $nombre_parametropagodp = "";
        $nombre_parametroenviodp = "";
        $fechadp = $rowdataprincipal0['fecha'];
        $estado_pagodp=$rowdataprincipal0['estado_pago'];
        $estado_enviodp=$rowdataprincipal0['estado_envio'];
        if ($estado_pagodp == 2) {
          $colorestadopagodp = "label-success";
        }else{
          $colorestadopagodp = "label-danger";
        }

        if ($estado_enviodp == 3) {
          $colorestadoenviodp = "label-warning";
        }else if ($estado_enviodp == 4){
          $colorestadoenviodp = "label-success";
        }else{
          $colorestadoenviodp = "label-danger";
        }
        
        $sqlcanpedp = "SELECT precio, 
                              cantidad 
                      FROM detalle_cabecera dc 
                      inner join cabecera_orden cao on dc.id_cabecera_orden = cao.id 
                      where cao.id = $iddp";
        $totalcantdp = 0;
        $totalpreciodp = 0;
        $querycantpedp = mysqli_query($con, $sqlcanpedp);
        while ($rowcantpedp=mysqli_fetch_array($querycantpedp)){
          $preciodp=$rowcantpedp['precio'];
          $cantidaddp=$rowcantpedp['cantidad'];
          $totalcantdp = $totalcantdp + $cantidaddp;
          $totalpreciodp = $totalpreciodp + $preciodp;
        }
      }
      ?>
      <tr>
        <input type="hidden" value="<?php echo $nom_cat;?>" id="nom_cat<?php echo $id_categoria;?>">
        <input type="hidden" value="<?php echo $des_cat;?>" id="des_cat<?php echo $id_categoria;?>">
        <td class="th-general"><?php echo $ii; ?></td>
        <td class="th-general"><?php echo $nro_pre_ordendp; ?></td>
        <td class="th-general"><?php echo $nombre_clientedp; ?></td>
        <td class="th-general"><?php echo $telefono_clientedp; ?></td>
        <td class="th-general"><?php echo $nombre_tenviodp; ?></td>
        <td class="th-general"><?php echo $totalcantdp; ?></td>
        <td class="th-general"><?php echo $totalpreciodp; ?></td>
        <td class="th-general"><span class="label <?php echo $colorestadopagodp;?>"><?php if($estado_pagodp == 0){$nombre_parametropagodp = "POR PAGAR";}else{$traemoselnombreparametropagodp = "select * from parametro where id_parametro = $estado_pagodp";
                            $queryppagodp = mysqli_query($con, $traemoselnombreparametropagodp);
        while ($rowppagodp=mysqli_fetch_array($queryppagodp)){
        $nombre_parametropagodp=$rowppagodp['nombre_parametro'];
        }} echo $nombre_parametropagodp; ?></span></td>

        <td class="th-general"><span class="label <?php echo $colorestadoenviodp;?>"><?php if($estado_enviodp == 0 ){ $nombre_parametroenviodp = "POR RECOGER";}else{$traemoselnombreparametroenviodp = "select * from parametro where id_parametro = $estado_enviodp";
          $querypenviodp = mysqli_query($con, $traemoselnombreparametroenviodp);
          while ($rowpenviodp=mysqli_fetch_array($querypenviodp)){
            $nombre_parametroenviodp=$rowpenviodp['nombre_parametro'];
          }
          }   echo $nombre_parametroenviodp; ?></span>
        </td>        
        <td class="th-general"><span>

          <a href="./consulta_despacho.php?iddespacho=<?php echo $iddp;?>" class='btn btn-guardar btn-xs' title='Editar categoria'><i class="fa fa-pencil"></i></a> 

          <!-- ¿van a cambiar este número de Whats App o el mensaje? D.M.-->
          <a href="https://api.whatsapp.com/send?phone=51992588799&text=¡Hola! Gracias por comunicarte con  LA CANASTA Minimarket delivery.  1.Visualiza y realiza tus pedidos en https://www.lacanastamarket.com/ 2.El monto mínimo de compra es de S/100.00 3.El costo de delivery es dependiendo de la zona de entrega.  4. En tu primer pedido el delivery es gratis." target="_blank" class="wptwa-account" data-number="" data-auto-text="" style="background:#ffffff;">
          <?php if ($eeefactura < 1): ?>
            
          <a href="#" class='btn btn-guardar btn-xs' title='Enviar Factura' onclick="Registrar_factura_despacho('<?php echo $iddp; ?>')"><i class="glyphicon glyphicon-ok"></i> </a>


          <?php endif ?>



          <!-- <a href="#" class='btn btn-cancelar btn-xs' title='Borrar categoria' onclick="eliminar('<?php echo $id; ?>')"><i class="glyphicon glyphicon-trash"></i></a>
          <a href="#" class='btn btn-cancelar btn-xs' title='Borrar categoria' onclick="eliminar('<?php echo $id; ?>')"><i class="glyphicon glyphicon-trash"></i></a>-->
          </span>
        </td>            
      </tr>
      <?php
        $nuevocontadorlista = $nuevocontadorlista + 1;
        $ii = $ii + 1;
    }}
?> 






                    <?php
              
                    while ($row=mysqli_fetch_array($query)){
                            $id=$row['id'];
                            $eefactura=$row['eefactura'];
                            $nro_pre_orden=$row['nro_pre_orden'];
                            $nombre_cliente=$row['nombre_cliente'];

                            $telefono_cliente=$row['telefono_cliente'];
                            $nombre_tenvio=$row['nombre_tenvio'];
                            $colorestadopago = "";
                            $colorestadoenvio = "";
                            $nombre_parametropago = "";
                            $nombre_parametroenvio = "";
                            $fecha = $row['fecha'];
                            $estado_pago=$row['estado_pago'];
                            $estado_envio=$row['estado_envio'];
                            
                            

                           // $estado_pago_id=$row['estado_pago_id'];

                            //var_dump($estado_pago);
                            if ($estado_pago == 2) {
                              $colorestadopago = "label-success";
                            }else{
                              $colorestadopago = "label-danger";
                            }

                            if ($estado_envio == 3) {
                              $colorestadoenvio = "label-warning";
                            }else if ($estado_envio == 4){
                              $colorestadoenvio = "label-success";
                            }else{
                              $colorestadoenvio = "label-danger";
                            }
                            
                            //$estado_envio=$row['estado_envio'];
                            
        $sqlcanpe="SELECT precio, 
                          cantidad 
                    FROM detalle_cabecera dc 
                    inner join cabecera_orden cao on dc.id_cabecera_orden = cao.id 
                    where cao.id = $id";

$totalcant = 0;
$totalprecio = 0;
        $querycantpe = mysqli_query($con, $sqlcanpe);
while ($rowcantpe=mysqli_fetch_array($querycantpe)){
  $precio=$rowcantpe['precio'];
  $cantidad=$rowcantpe['cantidad'];
  $totalcant = $totalcant + $cantidad;
  $totalprecio = $totalprecio + $precio;
}


                        ?>
                    <tr>
                        <input type="hidden" value="<?php echo $nom_cat;?>" id="nom_cat<?php echo $id_categoria;?>">
                        <input type="hidden" value="<?php echo $des_cat;?>" id="des_cat<?php echo $id_categoria;?>">
                        <td class="th-general"><?php echo $ii; ?></td>
                        <td class="th-general"><?php echo $nro_pre_orden; ?></td>
                        <td class="th-general"><?php echo $nombre_cliente; ?></td>
                        <td class="th-general"><?php echo $telefono_cliente; ?></td>
                        <td class="th-general"><?php echo $nombre_tenvio; ?></td>
                        <td class="th-general"><?php echo $totalcant; ?></td>
                        <td class="th-general"><?php echo $totalprecio; ?></td>


                        <td class="th-general"><span class="label <?php echo $colorestadopago;?>"><?php if($estado_pago == 0){$nombre_parametropago = "POR PAGAR";}else{$traemoselnombreparametropago = "select * from parametro where id_parametro = $estado_pago";
                            $queryppago = mysqli_query($con, $traemoselnombreparametropago);
                            while ($rowppago=mysqli_fetch_array($queryppago)){
                                $nombre_parametropago=$rowppago['nombre_parametro'];
                              }} echo $nombre_parametropago; ?></span></td>

                        <td class="th-general"><span class="label <?php echo $colorestadoenvio;?>"><?php if($estado_envio == 0 ){ $nombre_parametroenvio = "POR RECOGER";}else{$traemoselnombreparametroenvio = "select * from parametro where id_parametro = $estado_envio";
                            $querypenvio = mysqli_query($con, $traemoselnombreparametroenvio);
                              while ($rowpenvio=mysqli_fetch_array($querypenvio)){
                                $nombre_parametroenvio=$rowpenvio['nombre_parametro'];
                              }}   echo $nombre_parametroenvio; ?></span></td>
                        <td class="th-general" style="width: 135px ;"><?php echo $fecha; ?></td>
                        
                        <td class="th-general"><span>
                            <a href="./consulta_despacho.php?iddespacho=<?php echo $id;?>" class='btn btn-guardar btn-xs' title='Editar Categoría'>
                              <i class="glyphicon glyphicon-ok"></i>
                            </a> 
                             <?php if ($eefactura < 1): ?>


                        <a href="#" class='btn btn-guardar btn-xs' title='Enviar Factura' onclick="Registrar_factura_despacho('<?php echo $id; ?>')">
                          <i class="glyphicon glyphicon-share"></i>
                        </a>

                        <a href="https://api.whatsapp.com/send?phone=51992588799&text=¡Hola! Gracias por comunicarte con  LA CANASTA Minimarket delivery.  1.Visualiza y realiza tus pedidos en https://www.lacanastamarket.com/ 2.El monto mínimo de compra es de S/100.00 3.El costo de delivery es dependiendo de la zona de entrega.  4. En tu primer pedido el delivery es gratis." target="_blank" class="wptwa-account" data-number="" data-auto-text="" style="background:#ffffff;">
                               
                             <?php endif ?>
                           <!-- <a href="#" class='btn btn-cancelar btn-xs' title='Borrar categoria' onclick="eliminar('<?php echo $id; ?>')"><i class="glyphicon glyphicon-trash"></i></a>
                            <a href="#" class='btn btn-cancelar btn-xs' title='Borrar categoria' onclick="eliminar('<?php echo $id; ?>')"><i class="glyphicon glyphicon-trash"></i></a>-->
                        </span></td>            
                    </tr>
                        <?php
                        $nuevocontadorlista = $nuevocontadorlista + 1;
                        $ii = $ii + 1;
                    }
                    ?>             
              <tr>
                <td colspan=16><span class="pull-right"><?PHP
                  echo paginate($reload, $page, $total_pages, $adjacents);
?>                </span>
                </td>
              </tr>
              </tbody>
<?php
            }
          }
?>
            </table>
          </div>
<?php


?>
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
      {
        extend: 'colvis',
        text: 'Mostrar columnas',
        className: 'green2',
      },                 
      {
        extend: 'pageLength',
        text: 'Mostrar filas',
        className: 'orange',
      },    
      {
        extend: 'copy',
        text: 'COPIAR',
        className: 'red',
      },      
      {
        extend: 'excel',
        text: 'EXCEL',
        className: 'green',
      },
      {
        extend: 'csv',
        text: 'CSV',
        className: 'green1',
      },
      {
        extend: 'print',
        text: 'IMPRIMIR',
        className: 'green2',
      }
    ],
    "pageLength": 20,
  });
  });
</script>
