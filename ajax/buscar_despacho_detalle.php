<?php
  include('is_logged.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado
  require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
  require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
  $action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';


  if($action == 'ajax'){
    $arrayproq = $_REQUEST['q'];
    $iddelacabecera = $arrayproq;
    $sTable = " cabecera_orden cao inner join detalle_cabecera deca on cao.id=deca.id_cabecera_orden inner join products prc on deca.id_producto=prc.id_producto inner join marca mrc on prc.id_marca=mrc.id_marca inner join modelos modl on prc.id_modelo=modl.id_modelo inner join categorias cate on prc.cat_pro = cate.id_categoria";
    $sWhere = "";
    $sWhere.=" where cao.id = $iddelacabecera ";
      
    include 'pagination.php'; //include pagination file
    //pagination variables
    $page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
    $per_page = 5; //how much records you want to show
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
    $sql ="SELECT cao.*, deca.*, prc.*, mrc.nombre_marca, modl.nombre_modelo, cate.nom_cat as nombre_categoria FROM $sTable $sWhere LIMIT $offset,$per_page";
    //var_dump($sql);
    $query = mysqli_query($con, $sql);
    //loop through fetched data
    if ($numrows>0){
      ?>
      <div class="table-responsive">
        <table id="" class="display nowrap" style="width:100%">
          <tfoot class="th-general">
            <tr class="th-general">
            </tr>
          </tfoot>
          <thead >
            <tr class="th-general">
              <th class="th-general">#</th>
                <th class="th-general">Fotos</th>
                <th class="th-general">Nombre del Producto</th>
                <th class="th-general">Ubicación</th>
                <th class="th-general">Marca del Vehículo</th>
                <th class="th-general">Modelo del Vehículo</th>
                <th class="th-general">Motor</th>
                <th class="th-general">Cant. Litros</th>
                <th class="th-general">Año del Vehículo</th>
                <th class="th-general">Tipo de Combustible</th>
                <th class="th-general">Categoría de Repuesto</th>
                <th class="th-general">Marca de Repuesto</th>
                <th class="th-general">Medidas</th>
                <th class="th-general">Código</th>
                <th class="th-general">Precio</th>
                <th class="th-general">Cantidad</th>
            </tr>
          </thead>
            <?php
            $ii=1;
            while ($rowdetalle=mysqli_fetch_array($query)){
              $nombre_categoria = $rowdetalle['nombre_categoria'];
              $produc_detalle = $rowdetalle['detalle'];
              $nombreproduc = $rowdetalle['nombre_producto'];
              $nombre_marca = $rowdetalle['nombre_marca'];
              $nombre_modelo = $rowdetalle['nombre_modelo'];
              $id_vehiculo = $rowdetalle['id_vehiculo'];
              $codigo_producto = $rowdetalle['codigo_producto'];
              $foto1="";
              $foto2="";
              $foto3="";
              $foto4="";
              $foto="";
              $fotoprincipal=$rowdetalle['fotoprincipal'];
              if($fotoprincipal == 1){
                $foto=$rowdetalle['foto1'];
                $foto1=$rowdetalle['foto1'];
              }elseif ($fotoprincipal == 2) {
                $foto=$rowdetalle['foto2'];
                $foto2=$rowdetalle['foto2'];
              }elseif ($fotoprincipal == 3) {
                $foto=$rowdetalle['foto3'];
                $foto3=$rowdetalle['foto3'];
              }elseif ($fotoprincipal == 4) {
                $foto=$rowdetalle['foto4'];
                $foto4=$rowdetalle['foto4'];
              }else{
                $foto1=$rowdetalle['foto1'];
                $foto2=$rowdetalle['foto2'];
                $foto3=$rowdetalle['foto3'];
                $foto4=$rowdetalle['foto4'];
                $foto=$foto1;
              } 
              $medida = $rowdetalle['medida'];
              $costo_venta_soles = $rowdetalle['precio'];
              $cantidad = $rowdetalle['cantidad'];
              $sqldetallesvehiculo = "";
              $sqldetallesvehiculo="SELECT vhc.*, mrc.nombre_marca, mdl.nombre_modelo, mtr.nombre as motor_nombre_vehiculo FROM vehiculos vhc inner join marca mrc on vhc.id_marca = mrc.id_marca inner join modelos mdl on vhc.id_modelo=mdl.id_modelo  inner join motor mtr on vhc.motor = mtr.id_motor where vhc.d_vehiculo = $id_vehiculo";
              //var_dump($sqldetallesvehiculo);
              $nombre_modelo1 = "";
              $nombre_marca1 = "";
              $motor_nombre_vehiculo = "";
              $cilindro = "";
              $anio = "";
              $combustible = "";
              $querydetallesvehiculo = mysqli_query($con, $sqldetallesvehiculo);
              while ($rowdetallevehiculo=mysqli_fetch_array($querydetallesvehiculo)){
                $nombre_modelo1 = $rowdetallevehiculo['nombre_modelo'];
                $nombre_marca1 = $rowdetallevehiculo['nombre_marca'];
                $motor_nombre_vehiculo = $rowdetallevehiculo['motor_nombre_vehiculo'];
                $cilindro = $rowdetallevehiculo['cilindro'];
                $anio = $rowdetallevehiculo['anio'];
                $combustible = $rowdetallevehiculo['combustible'];
                //var_dump($motor_nombre_vehiculo);
              }
              ?>      
              <tr >   
                <td class="th-general"><?php echo $ii; ?></td>
                <td class="th-general">
                <?php 
                  if ($foto == null || $foto == 0){
                  }else{ ?>
                    <a class="" onclick="llamadabproductos('<?php echo $foto;?>', '<?php echo $foto1;?>', '<?php echo $foto2;?>', '<?php echo $foto3;?>','<?php echo $foto4;?>' )">
                      <img    class="imagen2" src="fotos/<?php echo $foto;?>" width="30" height="30" border="0"  class="btn btn-primary" data-toggle="modal" href='#modal-id' />
                    </a>  
                    <?php  
                  } ?> 
                </td>
                <td class="th-general"><?php echo $nombreproduc; ?></td>
                <td class="th-general"><?php echo $produc_detalle; ?></td>
                <td class="th-general"><?php echo $nombre_marca1; ?></td>
                <td class="th-general"><?php echo $nombre_modelo1; ?></td>
                <td class="th-general"><?php echo $motor_nombre_vehiculo; ?></td>
                <td class="th-general"><?php echo $cilindro; ?></td>
                <td class="th-general"><?php echo $anio; ?></td>
                <td class="th-general"><?php echo $combustible; ?></td>
                <td class="th-general"><?php echo $nombre_categoria; ?></td>
                <td class="th-general"><?php echo $nombre_marca; ?></td>
                <td class="th-general"><?php echo $medida; ?></td>
                <td class="th-general"><?php echo $codigo_producto; ?></td>
                <td class="th-general"><?php echo $costo_venta_soles; ?></td>
                <td class="th-general"><?php echo $cantidad; ?></td>               
              </tr>
              <?php
                $ii = $ii + 1;
            }?>
              <tr>
                <td colspan=16><span class="pull-right"><?PHP
                  echo paginate($reload, $page, $total_pages, $adjacents);
?>                </span>
                </td>
              </tr>
            </table>
          </div>
   <?php } 
        }
      else
        {
          echo "No se encontraron registros";
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
  <!-- <div class="modal-dialog modal-dialog-centered modal-lg"> -->
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        
        <h4 class="modal-title">Pre visualizacion de la imagen</h4>
      </div>
      <div class="modal-body" id="modalbody" style="text-align: center;">


      <!-- <div class="container" style="width: 50%!important; height: 50%!important;"> -->
      <div class="container">
  <h2></h2>  
  <div id="myCarousel" class="carousel slide" data-ride="carousel">
  </div>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-cancelar" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
</div>