<?php
  include('is_logged.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado
  /* Connect To Database*/
  require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
        include 'pagination.php'; //include pagination file
  require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos

  $action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';

    if (isset($_GET['id'])){
        $id_vehiculo=intval($_GET['id']);
        $query=mysqli_query($con, "select * from compatible where id_vehiculo='".$id_vehiculo."'");
        $count=mysqli_num_rows($query);
                

        if ($count == 0){
            if ($delete1=mysqli_query($con,"DELETE FROM vehiculos WHERE d_vehiculo='".$id_vehiculo."'")){
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
              <strong>Error!</strong> No se pudo eliminar éste Vehículo porque se encuentra asociado en una compatibilidad.
            </div>
            <?php
        }
        
        
    }

  if($action == 'ajax'){

    $arrayproq = explode(" ", $_REQUEST['q']);
    $conarray = count($arrayproq);
    // escaping, additionally removing everything that could be (html/javascript-) code
$aColumns = array('m.nombre_marca', 'md.nombre_modelo', 'v.cilindro', 'v.motor', 'v.anio', 'v.detalle');//Columnas de busqueda
 $nucarray = count($aColumns) - 1;
         $sTable = " vehiculos as v inner join marca as m on v.id_marca=m.id_marca inner join modelos as md on md.id_modelo= v.id_modelo inner join motor mot on v.motor = mot.id_motor ";
         $sWhere = "";

        $sWhere.=" WHERE v.estado=1 ";
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
    $sWhere.=" order by v.d_vehiculo asc";
    //pagination variables
        $page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
        $per_page = 10; //how much records you want to show
        $adjacents  = 4; //gap between pages after number of adjacents
        $offset = ($page - 1) * $per_page;
        //Count the total number of row in your table*/
           $count_query   = mysqli_query($con, "SELECT count(*) AS numrows FROM $sTable  $sWhere");
        $row= mysqli_fetch_array($count_query);
        $numrows = $row['numrows'];
        $total_pages = ceil($numrows/$per_page);
        $reload = './vehiculos.php';
        //main query to fetch the data
        $sql="SELECT v.*, v.d_vehiculo as id, v.nombre_vehiculo as na, mot.nombre as nombre_motor ,mot.id_motor as idemotor,v.motor as mt,v.cilindro as ci,v.anio as anio,v.combustible as comb,v.detalle as det,m.id_marca as ma, m.nombre_marca as mar,md.nombre_modelo as model, md.id_modelo as idm, (CASE WHEN v.estado=1 THEN 'Activo' ELSE 'Inactivo' END) as est FROM $sTable $sWhere LIMIT $offset,$per_page";
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
   <th class="th-general">Foto</th>
   <th class="th-general">Marca</th>
                    <th class="th-general">Modelo</th>
                    <th class="th-general">Litro</th>
                    <th class="th-general">Motor</th>
                    <th class="th-general">Año</th>
                    <th class="th-general">Descripción</th>
                    <th class="th-general">Comentario</th>
                    

                    <th class="th-general">Acciones</th>
          </tr>
        </thead>
                <tbody>
                    <?php
                    $nuevocontadorlista = 1;
                    $ii = 1;
                    while ($row=mysqli_fetch_array($query)){
                          $id_vehiculo=$row['id'];
                         $id_marca=$row['ma'];
                         $na=$row['na'];
                         $nombre_marca=$row['mar'];
                         $nombre_modelo=$row['model'];
                         $id_modelo=$row['idm'];
                         $motor=$row['nombre_motor'];
                         $idemotor=$row['idemotor'];
                         $cilindro=$row['ci'];
                         $anio=$row['anio'];
                         $combustible=$row['comb'];
                         $descripcion=$row['det'];
                         $estado=$row['est'];


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


                            
                        ?>
                    <tr>
                        <input type="hidden" value="<?php echo $id_codigo;?>" id="codigo<?php echo $id_vehiculo;?>">

                   
                    <input type="hidden" value="<?php echo $id_marca;?>" id="id_marca<?php echo $id_vehiculo;?>">
                    <input type="hidden" value="<?php echo $na;?>" id="comentario<?php echo $id_vehiculo;?>">
                    <input type="hidden" value="<?php echo $id_modelo;?>" id="id_modelo<?php echo $id_vehiculo;?>">
                    <input type="hidden" value="<?php echo $idemotor;?>" id="motor<?php echo $id_vehiculo;?>">
                    <input type="hidden" value="<?php echo $cilindro;?>" id="cilindro<?php echo $id_vehiculo;?>">
                    <input type="hidden" value="<?php echo $anio;?>" id="anio<?php echo $id_vehiculo;?>">
                    <input type="hidden" value="<?php echo $combustible;?>" id="combustible<?php echo $id_vehiculo;?>">
                    <input type="hidden" value="<?php echo $descripcion;?>" id="detalle<?php echo $id_vehiculo;?>">
                    <input type="hidden" value="<?php echo $id_vehiculo;?>" id="d_vehiculo<?php echo $id_vehiculo;?>">
                    <input type="hidden" value="<?php echo $estado;?>" id="estado<?php echo $id_vehiculo;?>">

                        <td class="th-general"><?php echo $ii; ?></td>
                              <td class="th-general">
<?php 
                  if ($foto == null || $foto == 0){
                  }else{
?>
                    <a class="" onclick="llamadabvehiculos('<?php echo $foto;?>', '<?php echo $foto1;?>', '<?php echo $foto2;?>', '<?php echo $foto3;?>','<?php echo $foto4;?>' )">
                      <img    class="imagen2" src="fotos_vehiculo/<?php echo $foto;?>" width="30" height="30" border="0"  class="btn btn-primary" data-toggle="modal" href='#modal-id' />
                 
                    </a>  
<?php  
                  }
?>                                         
                </td>
                         <td class="th-general" ><?php echo $nombre_marca; ?></td>
                        <td class="th-general"><?php echo  $nombre_modelo; ?></td>
                        <td class="th-general" ><?php echo $cilindro; ?></td>
                        <td class="th-general" ><?php echo $motor; ?></td>
                        <td class="th-general" ><?php echo $anio; ?></td>
                        <td class="th-general" ><?php echo $descripcion; ?></td>
                        <td class="th-general" ><?php echo $na; ?></td>
                        <!-- <td ><?php echo $combustible; ?></td> -->
                  
                    <td class="th-general" ><span>
                      <a href="fotos1_vehiculo.php?accion=<?php echo $id_vehiculo; ?>" class='btn btn-agregar btn-xs' title='Editar fotos'><i class="fa fa-camera"></i></a>
                    <a href="#" class='btn btn-guardar btn-xs' title='Editar Vehiculo' onclick="obtener_datos('<?php echo $id_vehiculo;?>');" data-toggle="modal" data-target="#myModalVehiculo"><i class="glyphicon glyphicon-edit"></i></a>
                    <a href="#" class='btn btn-cancelar btn-xs' title='Borrar vehiculo' onclick="eliminar('<?php echo $id_vehiculo; ?>')"><i class="glyphicon glyphicon-trash"></i></a>
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