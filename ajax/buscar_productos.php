<?php
  include('is_logged.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado
  /* Connect To Database*/
  require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
  require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
  $action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
  if (isset($_GET['id'])){
    $id_producto=intval($_GET['id']);
    $query=mysqli_query($con, "select * from detalle_factura where id_producto='".$id_producto."'");
    $count=mysqli_num_rows($query);      
    if ($count==0){
      if ($delete1=mysqli_query($con,"DELETE FROM products WHERE id_producto='".$id_producto."'")){
?>
        <div class="alert alert-success alert-dismissible" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <strong>Aviso!</strong> Datos eliminados exitosamente.
        </div>
<?php 
      }else {
?>
        <div class="alert alert-danger alert-dismissible" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <strong>Error!</strong> No se puede eliminar.
        </div>
<?php
      }
    }else {
?>
      <div class="alert alert-danger alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <strong>Error!</strong> No se pudo eliminar éste  producto. Existen datos vinculadas a éste producto. 
      </div>
<?php
    }
  }

  if($action == 'ajax'){
    $query1=mysqli_query($con, "select * from datosempresa where id_emp=1");
    $row1=mysqli_fetch_array($query1);
    $alerta=$row1['alerta'];
    $arrayproq = explode(" ", $_REQUEST['q']);
    $conarray = count($arrayproq);
    // escaping, additionally removing everything that could be (html/javascript-) code
    $q = mysqli_real_escape_string($con,(strip_tags($_REQUEST['q'], ENT_QUOTES)));
    $aColumns = array( 'pr.nombre_producto', 'pr.codigoOriginal','pr.codigoProveedor', 'pr.medida');//Columnas de busqueda
    $sTable = "products";
    $nucarray = count($aColumns) - 1;
    $sWhere = "";

    if ( $conarray != 0){
      $sWhere = "WHERE ";
      for ($a=0; $a < $conarray ; $a++) { 
        $sWhere .= " ( ";
        for ( $i=0 ; $i<count($aColumns) ; $i++ ){
          $sWhere .= $aColumns[$i]." LIKE '%".$arrayproq[$a]."%' ";
          if ($i < $nucarray){
            $sWhere .= "OR ";
          }
        }
        $sWhere .= ") AND ";
      }
      $sWhere = substr_replace( $sWhere, "", -4 );
    }
    $sWhere.=" order by pr.nombre_producto desc";
      
    include 'pagination.php'; //include pagination file
    //pagination variables
    $page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
    $per_page = 10; //how much records you want to show
    $adjacents  = 4; //gap between pages after number of adjacents
    $offset = ($page - 1) * $per_page;
    //Count the total number of row in your table*/

    if($q==""){
      $count_query   = mysqli_query($con, "SELECT count(*) AS numrows FROM products WHERE pro_ser=1");
    }else{
      $count_query   = mysqli_query($con, "SELECT count(*) AS numrows FROM products pr inner join proveedores cli $sWhere");
    }

    $row= mysqli_fetch_array($count_query);
    $numrows = $row['numrows'];
    $total_pages = ceil($numrows/$per_page);
    $reload = './productos.php';
    //main query to fetch the data
   
    if($q==""){
   
      $sql="SELECT pr.*,tp.*, pr.codigoProveedor as nomcodio, mr.nombre_marca AS marca FROM products pr inner join marca mr on mr.id_marca=pr.id_marca inner join tipo tp on tp.id_tipo=pr.id_tipo WHERE pro_ser=1 order by pr.nombre_producto ASC LIMIT $offset,$per_page ";
    }else{ 
    
      $sql="SELECT pr.*,tp.*, pr.codigoProveedor as nomcodio, mr.nombre_marca AS marca FROM products pr inner join marca mr on mr.id_marca=pr.id_marca  inner join tipo tp on tp.id_tipo=pr.id_tipo  $sWhere  LIMIT $offset,$per_page ";
    }


    $query = mysqli_query($con, $sql);


    //loop through fetched data
    if ($numrows>0){
?>
      <div class="table-responsive">
        <table id="example" class="display nowrap" style="width:100%">
        <!-- <table id="example" class="table"> -->
        <tfoot class="th-general">
          <tr class="th-general">
            <!-- <div class="pull-right separador-compras">
              <a href="ingresoProductos.php" class="btn btn-guardar" style="width: 150px;" id=""><span id="">Nuevo Producto</span></a>
            </div>  -->
          </tr>
        </tfoot>
        <thead >
          <tr class="th-general">
            <th class="th-general">Fotos</th>
            <th class="th-general">Código Original</th>
            <th class="th-general">Código Proveedor</th>
            <th class="th-general">Descripción</th>
            <th class="th-general">Stock</th>
            <th class="th-general">Marca</th>
            <th class="th-general">Medida</th>
            <th class="th-general">Precio de compra en dólares</th>
            <th class="th-general">Acciones</th>
          </tr>
        </thead>
<?php
        $i=0;

          while ($row=mysqli_fetch_array($query)){
            $pro_ser=$row['pro_ser'];
            if ($pro_ser==1){
              if($i%2==0){
                $table="valor1";
              }else{
                $table="valor2";
              }

              $i=$i+1;
              $id_producto=$row['id_producto'];
              $tcpregistrado=$row['tcp_compra'];
              
              


              $codigo_proveedor=$row['nomcodio'];
              $ganancia_monto_porcsoles=$row['ganancia_monto_porcsoles'];
              $codigo_producto=$row['codigo_producto'];
              $codigo_original=$row['codigoOriginal'];
              $codigo_alternativo=$row['codigoAlternativo'];




              $nombre_producto=$row['nombre_producto'];
              $tipo=$row['id_tipo'];
              $tipoNombre=$row['tipo'];
              $marca=$row['id_marca'];
              $marcaNombre=$row['marca'];


              $ganancian=$row['ganancia'];
              $costosolesn=$row['costo_soles'];
              $tipo_porcentajenn=$row['tipo_ganancia'];
              $gananciadelproducto=$row['ganancia'];
              $costo_venta_solesn=$row['costo_venta_soles'];


              $cat_pro=$row['cat_pro'];
              $codigoProveedor=$row['codigoProveedor'];
              $codigoAlternativo=$row['codigoAlternativo'];
              $medida=$row['medida'];
              $detalle=$row['detalle'];
              $pro_ser=$row['pro_ser'];
              
              $fotoprincipal=$row['fotoprincipal'];
              if($fotoprincipal == 1){
                $foto=$row['foto1'];
              
              }elseif ($fotoprincipal == 2) {
                $foto=$row['foto2'];
               
              }elseif ($fotoprincipal == 3) {
                $foto=$row['foto3'];
              
              }elseif ($fotoprincipal == 4) {
                $foto=$row['foto4'];
               
              }else{
                $foto='';
              }
              

 $foto1=$row['foto1'];
 $foto2=$row['foto2'];
 $foto3=$row['foto3'];
 $foto4=$row['foto4'];


              if ($_SESSION['tienda']==1){
                $b=$row['b1'];
              }elseif($_SESSION['tienda']==2){
                $b=$row['b2'];
              }elseif($_SESSION['tienda']==3){
                $b=$row['b3'];
              }elseif($_SESSION['tienda']==4){
                $b=$row['b4'];
              }elseif($_SESSION['tienda']==5){
                $b=$row['b5'];
              }elseif($_SESSION['tienda']==6){
                $b=$row['b6'];
              }
              $mon_venta=$row['mon_venta'];
              $dolar=$row['mon_costo'];
              $mon_costo=$row['mon_costo'];

              /*if ($row['mon_costo']>1){
                  $mon_costo=0;
              }else{
                  $mon_costo=1;
              }*/

              if($b<=$alerta){
                $label_class='label-danger';
              }else{
                $label_class='label-success';
              }

$numrowspseparados = 0 ;
$numrowspsep = 0 ;
    $count_query_pseparados   = mysqli_query($con, "SELECT count(*) AS numrows FROM producto_reserva where idProducto = $id_producto and procesado = 1 and status = 1");
        $rowpseparados= mysqli_fetch_array($count_query_pseparados);
        $numrowspseparados = $rowpseparados['numrows'];
        if ($numrowspseparados > 0) {
          $label_class='label-warning';

          $count_query_psep   = mysqli_query($con, "SELECT cantidad AS cant_separados FROM producto_reserva where idProducto = $id_producto and procesado = 1 and status = 1 ");
        $rowpsep= mysqli_fetch_array($count_query_psep);
        $numrowspsep = $rowpsep['cant_separados'];
        }


              

              if ($dolar==1){
                $mon="$";
              }else{
                $mon="$";
              }
                                                
              $date_added= date('d/m/Y', strtotime($row['date_added']));
              $precio_producto=$row['precio_producto'];

              if ($row['mon_costo'] == 0) {
                $costo_producto=$row['costo_producto'];
              }
              else
              {
              $costo_producto=$row['costo_producto']/$row['mon_costo'];

              }
              $costo=$row['costo_producto'];
              $utilidad=$row['precio_producto']-$row['costo_producto'];   

              $traertodoeldetalle = "SELECT * FROM detalle_factura where id_producto = ".$id_producto." order by id_detalle desc LIMIT 1";

              $querytraertodoeldetalle = mysqli_query($con, $traertodoeldetalle);
              $cantidaddetalletrue = 0;
              $cntiq = mysqli_num_rows($querytraertodoeldetalle);
              if ($cntiq == 0) {
                $id_fctracb = "0000";
                $cantidaddetalletrue=$cat_pro;
              }else{
                while ($rowtraertodoeldeta=mysqli_fetch_array($querytraertodoeldetalle)){
                  $traertodalafc = "SELECT * FROM facturas where numero_factura = ".$rowtraertodoeldeta['numero_factura'];
                  $querytraertodalafct = mysqli_query($con, $traertodalafc);
                  while ($rowtraertfct=mysqli_fetch_array($querytraertodalafct)){
                    $id_fctracb= $rowtraertfct['id_factura'];
                  }
                  $cantidaddetalletrue=$rowtraertodoeldeta['cantidad'];
                }
              }
?> 
              <tr id="<?php echo $table;?>"> 
                <input type="hidden" value="<?php echo $ganancian;?>" id="ganancian<?php echo $id_producto;?>">
                <input type="hidden" value="<?php echo $costosolesn;?>" id="costo_soles<?php echo $id_producto;?>">
                <input type="hidden" value="<?php echo $ganancia_monto_porcsoles;?>" id="ganancia_monto_porcsoles<?php echo $id_producto;?>">
                
                <input type="hidden" value="<?php echo $costo_venta_solesn;?>" id="costo_venta_s<?php echo $id_producto;?>">
                <input type="hidden" value="<?php echo $tcpregistrado;?>" id="tcp_compra<?php echo $id_producto;?>">
                <input type="hidden" value="<?php echo $tipo_porcentajenn;?>" id="tipo_porcentajenn<?php echo $id_producto;?>">

                 <input type="hidden" value="<?php echo $cantidaddetalletrue;?>" id="cant_ultimacompra<?php echo $id_producto;?>">
                <input type="hidden" value="<?php echo $id_fctracb;?>" id="code_barra<?php echo $id_producto;?>">
                <input type="hidden" value="<?php echo $codigo_producto;?>" id="codigo_producto<?php echo $id_producto;?>">
                <input type="hidden" value="<?php echo $codigo_alternativo;?>" id="codigo_alternativo<?php echo $id_producto;?>">
                
                <input type="hidden" value="<?php echo $nombre_producto;?>" id="nombre_producto<?php echo $id_producto;?>">
                <input type="hidden" value="<?php echo $gananciadelproducto;?>" id="gananciadelproducto<?php echo $id_producto;?>">
                <input type="hidden" value="<?php echo $b;?>" id="inv<?php echo $id_producto;?>">
                <input type="hidden" value="<?php echo $tipo;?>" id="id_tipo<?php echo $id_producto;?>">
                <input type="hidden" value="<?php echo $marca;?>" id="id_marca<?php echo $id_producto;?>">
                <input type="hidden" value="<?php echo $codigoProveedor;?>" id="codigoProveedor<?php echo $id_producto;?>">
                <input type="hidden" value="<?php echo $codigoAlternativo;?>" id="codigoAlternativo<?php echo $id_producto;?>">
                <input type="hidden" value="<?php echo $codigo_original;?>" id="codigo_original<?php echo $id_producto;?>">
                <input type="hidden" value="<?php echo $medida;?>" id="medida<?php echo $id_producto;?>">
                <input type="hidden" value="<?php echo $detalle;?>" id="detalle<?php echo $id_producto;?>">
                <input type="hidden" value="<?php echo $cat_pro;?>" id="cat_pro<?php echo $id_producto;?>">
                <input type="hidden" value="<?php echo $mon_venta;?>" id="mon_venta<?php echo $id_producto;?>">
                <input type="hidden" value="<?php echo $mon_costo;?>" id="mon_costo<?php echo $id_producto;?>">
                <input type="hidden" value="<?php echo number_format($dolar,2,'.','');?>" id="dolar<?php echo $id_producto;?>">
                <input type="hidden" value="<?php echo number_format($costo,2,'.','');?>" id="costo<?php echo $id_producto;?>">
                <input type="hidden" value="<?php echo number_format($precio_producto,2,'.','');?>" id="precio_producto<?php echo $id_producto;?>">
                <input type="hidden" value="<?php echo number_format($costo_producto,2,'.','');?>" id="costo_producto<?php echo $id_producto;?>">
                <input type="hidden" value="<?php echo number_format($utilidad,2,'.','');?>" id="utilidad<?php echo $id_producto;?>">  

                <td class="th-general">
<?php 
                  if ($foto == null || $foto == 0){
                  }else{
?>
                    <a class="" onclick="llamadabproductos('<?php echo $foto;?>', '<?php echo $foto1;?>', '<?php echo $foto2;?>', '<?php echo $foto3;?>','<?php echo $foto4;?>' )">
                      <img    class="imagen2" src="fotos/<?php echo $foto;?>" width="30" height="30" border="0"  class="btn btn-primary" data-toggle="modal" href='#modal-id' />
                 
                    </a>  
<?php  
                  }
?>                                         
                </td> 
                <td class="th-general" style="font-size: 14px!important;"><?php echo $codigo_original; ?></td>
                <td class="th-general" style="font-size: 14px!important;"><?php echo $codigo_proveedor; ?></td>
                <td class="th-general" width="50px" style="font-size: 14px!important;"><?php echo $nombre_producto; ?></td>


                <td class="th-general"><span class="label <?php echo $label_class;?>"><?php if ($numrowspseparados > 0) { echo $numrowspsep."/".$b; }else{echo $b;}  ?></span></td>
                <td class="th-general"><?php echo $marcaNombre;?></td>
                <td class="th-general"><?php echo $medida;?></td>
                <td class="th-general">
                <strong><?php echo $mon; ?><span class='pull-right'><?php echo number_format($precio_producto, 2); ?></strong></span>
                </td>
                <td class="th-general">
                <span>

                  <!-- Mostrar historial de precios - historial_productos.php -->
                  <a href="#" class='btn btn-primary btn-xs EditProducto' title='Mostrar Historial' onclick="obtener_datos_historial('<?php echo $id_producto; ?>');" data-toggle="modal" data-target="#myModal21"><i class="fa fa-clock-o"></i></a>

                  <!-- Mostrar historial de precios -->
                  <a href="#" class='btn btn-dark btn-xs' title='Agregar Producto Compatible' data-toggle="modal" onclick="obtenerId('<?php echo $id_producto; ?>')" data-target="#nuevoCompatible"><i class="glyphicon glyphicon-plus"></i></a>

                  <!-- Codigo de barra -->
                  <a href="#" class='btn btn-info btn-xs' title='Barra codigos' onclick="obtener_datos_barra('<?php echo $id_producto; ?>' );" data-toggle="modal" data-target="#myModalBarra"><i class="fa fa-barcode"></i></a>

                  <br>

                  <!-- fotos -->
                  <a href="fotos1.php?accion=<?php echo $id_producto; ?>" class='btn btn-agregar btn-xs' title='Editar fotos'><i class="fa fa-camera"></i></a>
                  
                  <!-- Editar -->
                  <a href="#" class='btn btn-limpiar btn-xs' title='Editar producto' onclick="obtener_datos('<?php echo $id_producto; ?>');" data-toggle="modal" data-target="#myModal2"><i class="glyphicon glyphicon-edit"></i></a>

                  <!-- cancelar -->
                  <a href="#" class="btn btn-cancelar btn-xs" title='Borrar producto' onclick="eliminar('<?php echo $id_producto; ?>')"><i class="glyphicon glyphicon-trash"></i></a>

                </span>
              </td>                         
              </tr>
<?php
            }
          }
?>
            <tr>
                <td colspan=16><span class="pull-right"><?PHP
                  echo paginate($reload, $page, $total_pages, $adjacents);
?>                </span>
                </td>
              </tr>
            </table>
          </div>
<?php
        }
      else
        {
          echo "No se encontraron registros";
        }
      }
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