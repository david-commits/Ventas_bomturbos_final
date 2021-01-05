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
    

    $arrayproq = explode(" ", $_REQUEST['q']);
    $conarray = count($arrayproq);
        $aColumns = array( 'nom_cat', 'des_cat');//
    $nucarray = count($aColumns) - 1;

    // escaping, additionally removing everything that could be (html/javascript-) code
//$aColumns = array('nom_cat');//Columnas de busqueda
         $sTable = " categorias ";
         $sWhere = "";
      $sWhere = " WHERE estado = 1";
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
        echo "<script>console.log('listamos todo');</script>";
        $sWhere.=" order by id_categoria asc";
    //pagination variables
        $page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
        $per_page = 10; //how much records you want to show
        $adjacents  = 4; //gap between pages after number of adjacents
        $offset = ($page - 1) * $per_page;
        //Count the total number of row in your table*/
        $sssdsdsd = "SELECT count(*) AS numrows FROM $sTable  $sWhere";
        $count_query   = mysqli_query($con, "SELECT count(*) AS numrows FROM $sTable  $sWhere");
        $row= mysqli_fetch_array($count_query);
        $numrows = $row['numrows'];
        $total_pages = ceil($numrows/$per_page);
        $reload = './categorias.php';
        //main query to fetch the data
        $sql="SELECT * FROM  $sTable $sWhere LIMIT $offset,$per_page";

        //var_dump($sql);
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
                        <th class="th-general">Nombre Tipo Linea</th>
                        <th class="th-general">Nombre</th>
                        <th class="th-general">Descripción</th>
                        <th class="th-general">Acciones</th>
          </tr>
        </thead>
                <tbody>
                    <?php
                    $nuevocontadorlista = 1;
                    $ii = 1;
                    $nombre_tipoLinea = "";
                    while ($row=mysqli_fetch_array($query)){
                            $id_categoria=$row['id_categoria'];
                            $nom_cat=$row['nom_cat'];
                            $des_cat=$row['des_cat'];
                            $id_tipoLinea =$row['id_tipoLinea'];
                            
$sqltl="SELECT * FROM  tipo_linea where id_tipoLinea = $id_tipoLinea";

        //var_dump($sql);
        $querysqltl = mysqli_query($con, $sqltl);
   while ($rowtl=mysqli_fetch_array($querysqltl)){
    $nombre_tipoLinea = $rowtl['nombre_tipoLinea'];
   }

                            //$nombre_tipoLinea =$row['nombre_tipoLinea'];
                        ?>
                    <tr>
                        <input type="hidden" value="<?php echo $nom_cat;?>" id="nom_cat<?php echo $id_categoria;?>">
                        <input type="hidden" value="<?php echo $nombre_tipoLinea;?>" id="nombre_tipoLinea<?php echo $id_categoria;?>">
                        <input type="hidden" value="<?php echo $id_tipoLinea;?>" id="id_tipoLinea<?php echo $id_categoria;?>">
                        <input type="hidden" value="<?php echo $des_cat;?>" id="des_cat<?php echo $id_categoria;?>">
                        <td class="th-general"><?php echo $ii; ?></td>
                        <td class="th-general"><?php echo $nombre_tipoLinea; ?></td>
                        <td class="th-general"><?php echo $nom_cat; ?></td>
                        <td class="th-general"><?php echo $des_cat; ?></td>
                        <td class="th-general"><span>
                            <a href="#" class='btn btn-guardar btn-xs' title='Editar categoría' onclick="obtener_datos('<?php echo $id_categoria;?>');" data-toggle="modal" data-target="#myModal2"><i class="fa fa-pencil"></i></a> 
                            <a href="#" class='btn btn-cancelar btn-xs' title='Borrar categoría' onclick="eliminar('<?php echo $id_categoria; ?>')"><i class="glyphicon glyphicon-trash"></i></a>
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
