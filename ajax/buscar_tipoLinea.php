<?php
  include('is_logged.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado
  /* Connect To Database*/
  require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
        include 'pagination.php'; //include pagination file
  require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos

  $action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';

        if (isset($_GET['id'])){
        $id_tipo=intval($_GET['id']);
        $query=mysqli_query($con, "select * from marca where estado=1 AND id_tipoLinea='".$id_tipo."'");
        $count=mysqli_num_rows($query);
                
        if ($count==0){
            if ($delete1=mysqli_query($con,"UPDATE tipo_linea SET estado=0 WHERE id_tipoLinea='".$id_tipo."'")){
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
              <strong>Error!</strong> Lo siento algo ha salido mal intenta nuevamente.
            </div>
        <?php
        }
            
        } else {
            ?>
            <div class="alert alert-danger alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <strong>Error!</strong> No se pudo eliminar el tipo de Linea .Existen Marcas vinculadas a este tipo. 
            </div>
            <?php
        }
            
        }

  if($action == 'ajax'){


    $arrayproq = explode(" ", $_REQUEST['q']);
    $conarray = count($arrayproq);

    // escaping, additionally removing everything that could be (html/javascript-) code
$aColumns = array('nombre_tipoLinea', 'descripcion_tipoLinea');//Columnas de busqueda
 $nucarray = count($aColumns) - 1;
         $sTable = "tipo_linea ";
         $sWhere = "";

        $sWhere.=" WHERE estado=1 ";
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
    //pagination variables
    $sWhere.=" order by id_tipoLinea asc";

        
        $page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
        $per_page = 10; //how much records you want to show
        $adjacents  = 4; //gap between pages after number of adjacents
        $offset = ($page - 1) * $per_page;
        //Count the total number of row in your table*/
 

           $count_query   = mysqli_query($con, "SELECT count(*) AS numrows FROM $sTable  $sWhere");
        $row= mysqli_fetch_array($count_query);
        $numrows = $row['numrows'];
        $total_pages = ceil($numrows/$per_page);
        $reload = './tipoLinea.php';
        //main query to fetch the data
         $sql="SELECT * FROM  $sTable $sWhere LIMIT $offset,$per_page";

        $query = mysqli_query($con, $sql);

        //loop through fetched data
        if ($numrows>0){
?>
      <div class="table-responsive">
        <table id="example" class="display nowrap" style="width:100%">
        <tfoot class="th-general">
          <tr class="th-general">
            <!-- <div class="pull-right separador-compras">
              <a href="ingresoProductos.php" class="btn btn-guardar" style="width: 150px;" id=""><span id="">Nuevo Producto</span></a>
            </div>  -->
          </tr>
        </tfoot>
        <thead >
          <tr class="th-general">
   <th class="th-general">Nro</th>
                             <th class="th-general">Nombre</th>
                    <th class="th-general">Descripción</th>
                    <th class="th-general">Acciones</th>
          </tr>
        </thead>
                <tbody>
                    <?php
                    $nuevocontadorlista = 1;
                    $ii = 1;
                    while ($row=mysqli_fetch_array($query)){
                         $id_tipoLinea=$row['id_tipoLinea'];
                         $nombre_tipo=$row['nombre_tipoLinea'];
                         $descripcion=$row['descripcion_tipoLinea'];
                         $estado=$row['estado'];
                            
                        ?>
                    <tr>
                      <input type="hidden" value="<?php echo $nombre_tipo;?>" id="nombre_tipoLinea<?php echo $id_tipoLinea;?>">
            <input type="hidden" value="<?php echo  $descripcion;?>" id="descripcion_tipoLinea<?php echo $id_tipoLinea;?>">
            <input type="hidden" value="<?php echo  $estado;?>" id="estado<?php echo $id_tipoLinea;?>">
            <input type="hidden" value="<?php echo $id_tipoLinea;?>" id="id_tipoLinea<?php echo $id_tipoLinea;?>">

                        <td class="th-general"><?php echo $ii; ?></td>
                        
   
                        <td  class="th-general"><?php echo $nombre_tipo; ?></td>
                         <td  class="th-general"><?php echo $descripcion; ?></td>
                    <td  class="th-general"><span>
                    <a href="#" class='btn btn-guardar btn-xs' title='Editar tipo linea' onclick="obtener_datos('<?php echo $id_tipoLinea;?>');" data-toggle="modal" data-target="#myModalTipoLinea"><i class="glyphicon glyphicon-edit"></i></a> 
                    <a href="#" class='btn btn-cancelar btn-xs' title='Borrar Tipo de linea' onclick="eliminar('<?php echo $id_tipoLinea; ?>')"><i class="glyphicon glyphicon-trash"></i></a>
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
