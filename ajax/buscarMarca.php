<?php
  include('is_logged.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado
  /* Connect To Database*/
  require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
        include 'pagination.php'; //include pagination file
  require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos

  $action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';

  if (isset($_GET['id'])){
    $id_marca=intval($_GET['id']);
    $query=mysqli_query($con, "select * from modelos where estado=1 AND id_marca='".$id_marca."'");
        $count=mysqli_num_rows($query);     
        if ($count==0){
            if ($delete1=mysqli_query($con,"UPDATE marca SET estado=0 WHERE id_marca='".$id_marca."'")){
            ?>
            <div id="eliminaranunciomarca" class="alert alert-success alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <strong>Aviso!</strong> Datos eliminados exitosamente.
            </div>
            <?php 
        }else {
            ?>
            <div id="eliminaranunciomarca" class="alert alert-danger alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <strong>Error!</strong> Lo siento algo ha salido mal intenta nuevamente.
            </div>
            <?php
            
        }
            
        } else {
            ?>
            <div id="eliminaranunciomarca" class="alert alert-danger alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <strong>Error!</strong> No se pudo eliminar ésta Marca.Existen Modelos vinculadas a Marca. 
            </div>
            <?php
        }
  }


  if (isset($_GET['idtipoLinea'])){

  $idtipoLinea=intval($_GET['idtipoLinea']);
  $idMarcaTag=intval($_GET['idMarcaTag']);
  //var_dump($idbuscartag);
  $sqltl = "SELECT id_tlineas FROM categorias where estado = 1 and id_categoria = $idMarcaTag ";
  $restl = mysqli_query($con, $sqltl);
  while($rowtl=mysqli_fetch_array($restl))  {
    $contenidotl = $rowtl['id_tlineas'];
  } 
  $sqltlpro = "SELECT id_categorias FROM marca where estado = 1 and id_marca = $idMarcaTag ";
  $restlpro = mysqli_query($con, $sqltlpro);
  while($rowtlpro=mysqli_fetch_array($restlpro))  {
    $contenidotlpro = $rowtlpro['id_categorias'];
  } 
//$contenidotlpro = "";
  $contenidotlproarray = explode(",", $contenidotlpro);
  $countarraypro = count($contenidotlproarray); 
  $arrayconcontadores = array();
  $iniciamosidestag ="0";
  $iniciamosnombrestags ="0";
  $idestagschecked ="0";
  $iniciadordeprueba =1;
  $sqltag = "SELECT * FROM tipo_linea where estado = 1 ";
  $restag = mysqli_query($con, $sqltag);
  /*while($rowtltag=mysqli_fetch_array($restag))  {
    //$contenidoidtag = $rowtltag['id_tag'];
    $contenidotltag = $rowtltag['id_tipoLinea'];
    $contenido = $rowtltag['nombre_tipoLinea'];
    $arraydetags = explode(",", $contenidotltag);
    $conarraytags = count($arraydetags);
    for ($i = 0; $i < $conarraytags; $i++) {
      if ($arraydetags[$i] ==  $contenidotl) {
        $arraydetagsregistrados = explode(",", $iniciamosidestag);
        $conarraytagsregistrados = count($arraydetagsregistrados);          
        if ($conarraytagsregistrados < 1) {
          $iniciamosidestag = $iniciamosidestag.",".$contenidotltag;
          $iniciamosnombrestags = $iniciamosnombrestags.",".$contenido;
        }else{
          for ($a=0; $a < $conarraytagsregistrados; $a++) { 
            if ($arraydetagsregistrados[$a] == $contenidotltag ) {
              $iniciadordeprueba = $iniciadordeprueba +1;
            }
          }
        }
              
        if ($iniciadordeprueba == 1) {
          $iniciamosidestag = $iniciamosidestag.",".$contenidotltag;
          $iniciamosnombrestags = $iniciamosnombrestags.",".$contenido;
        }
      }else{}
    }
  }*/ 
  /*$arraydeidescompletos = "0";
  $arraydenombrescompletos = "0";*/
  $sql_tlineas_tlineas = "SELECT * FROM categorias where estado = 1 and id_tipoLinea = $idtipoLinea";
  $rest_tl = mysqli_query($con, $sql_tlineas_tlineas);
  //echo "<script>console.log($sql_tlineas_tlineas);</script>";
  while($rowtl_tl=mysqli_fetch_array($rest_tl))  {
    //$contenidotltag = $rowtltag['id_tipoLinea'];
    //$contenido = $rowtltag['nombre_tipoLinea'];
    $iniciamosidestag = $iniciamosidestag.",".$rowtl_tl['id_categoria'];
    $iniciamosnombrestags = $iniciamosnombrestags.",".$rowtl_tl['nom_cat'];
  }

  //echo "<script>console.log($iniciamosidestag);</script>";
  $arraydeidescompletos = explode(",", $iniciamosidestag);
  $arraydenombrescompletos = explode(",", $iniciamosnombrestags);
  $conarraycompletos = count($arraydeidescompletos);
  ?>
    <div class="form-group">
      <label for="for_ttags" class="col-sm-3 control-label">Seleccione Categorias:</label>
        <div class="col-md-8 col-sm-8 col-xs-12"> 
        <?php       
          for ($aa=0; $aa < $conarraycompletos; $aa++) {  
            $arrayconcontadores[$aa] = 0 ;
            $arrayconcontadoresiguales[$aa] = 0 ;
            if ($arraydeidescompletos[$aa] > 0 ) {
              if ($contenidotlpro != "") {    
                for ($ai=0; $ai < $countarraypro; $ai++) { 
                // echo "<script>console.log($arrayconcontadores[2]);</script>";
                  if ($arraydeidescompletos[$aa] == $contenidotlproarray[$ai]) {
                    if ($arrayconcontadoresiguales[$aa] == 0){ 

                      if($arraydeidescompletos[$aa] > 0){?>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="checkbox" name="<?php echo $arraydeidescompletos[$aa];?>" id="<?php echo $arraydeidescompletos[$aa];?>" value="<?php echo $arraydeidescompletos[$aa];?>" checked ><?php echo $arraydenombrescompletos[$aa];?></input>
                        </div>
                        <?php  $arrayconcontadores[$aa] = 1; }else{}

                    }else{ }
                  }else{  
                    $arrayconcontadores[$aa] = $arrayconcontadores[$aa] + 1;
                    if ($arrayconcontadores[$aa] == $countarraypro) {?>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="checkbox" name="<?php echo $arraydeidescompletos[$aa];?>" id="<?php echo $arraydeidescompletos[$aa];?>" value="<?php echo $arraydeidescompletos[$aa];?>" ><?php echo $arraydenombrescompletos[$aa];?></input>
                      </div>
                    <?php }
                  }
                }
              }else{ echo "<script>console.log('eta gege');</script>"  ?>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="checkbox" name="<?php echo $arraydeidescompletos[$aa];?>" id="<?php echo $arraydeidescompletos[$aa];?>" value="<?php echo $arraydeidescompletos[$aa];?>" ><?php echo $arraydenombrescompletos[$aa];?></input>
                </div>
              <?php }
            }else{  }
          }  ?>
        </div>
    </div> 
  <?php  }





  if($action == 'ajax'){
    //$_REQUEST['q'] = "";

    $arrayproq = explode(" ", $_REQUEST['q']);
     $conarray = count($arrayproq);
        $aColumns = array( 'tp.nombre_tipoLinea', 'm.nombre_marca');//
    $nucarray = count($aColumns) - 1;
    // escaping, additionally removing everything that could be (html/javascript-) code

         $sTable = " marca as  m inner join tipo_linea as tp on tp.id_tipoLinea=m.id_tipoLinea ";
         $sWhere = "";
        echo "<script>console.log('listamos todo');</script>";
        $sWhere.=" WHERE m.estado=1 ";

    if ( $arrayproq[0] != ''){
      //$sWhere .= " AND ";
      for ($a=0; $a < $conarray ; $a++) { 
        $sWhere .= " AND ( ";
        for ( $i=0 ; $i< count($aColumns) ; $i++ ){
          $sWhere .= $aColumns[$i]." LIKE '%".$arrayproq[$a]."%' ";
          if ($i < $nucarray){
            $sWhere .= "OR ";
          }
        }
        $sWhere .= ") ";
      }
     //$sWhere = substr_replace( $sWhere, "", -4 );
    }
        $sWhere.=" order by m.id_marca asc";

    //pagination variables
        $page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
        $per_page = 10; //how much records you want to show
        $adjacents  = 4; //gap between pages after number of adjacents
        $offset = ($page - 1) * $per_page;
        //Count the total number of row in your table*/
        
        $count_query   = mysqli_query($con, "SELECT count(*) AS numrows FROM $sTable  $sWhere");
        $row= mysqli_fetch_array($count_query);
        $numrows = $row['numrows'];
        //var_dump($numrows);
        $total_pages = ceil($numrows/$per_page);
        $reload = './marca.php';
        //main query to fetch the data
        $sql="SELECT tp.nombre_tipoLinea as nombre,tp.id_tipoLinea as idt, m.id_marca as id, m.id_categorias as cod ,m.nombre_marca as name,m.descripcion_marca as des FROM $sTable  $sWhere LIMIT $offset,$per_page";
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
                                    <th class="th-general">Tipo Linea</th>
                                    <th class="th-general">Marca</th>
                                    <th class="th-general">Acciones</th>
          </tr>
        </thead>
                <tbody>
                    <?php
                    $nuevocontadorlista = 1;
                    $ii = 1;
                    while ($row=mysqli_fetch_array($query)){
                           $id_marca=$row['id'];
                         $id_tipo=$row['idt'];
                         $nombre_tipo=$row['nombre'];
                         $nombre_marca=$row['name'];
                         $cod=$row['cod'];
                            
                        ?>
                    <tr>
                        <input type="hidden" value="<?php echo $codigo_marca;?>" id="codigo_marca<?php echo $id_marca;?>">
                    <input type="hidden" value="<?php echo $id_tipo;?>" id="id_tipoLinea<?php echo $id_marca;?>">
                    <input type="hidden" value="<?php echo $nombre_tipo;?>" id="nombre_tipo<?php echo $id_marca;?>">
                    <input type="hidden" value="<?php echo $nombre_marca;?>" id="nombre_marca<?php echo $id_marca;?>">
                    <input type="hidden" value="<?php echo $descripcion_marca;?>" id="descripcion_marca<?php echo $id_marca;?>">
                    <input type="hidden" value="<?php echo $id_marca;?>" id="id_marca<?php echo $id_marca;?>">
                    <input type="hidden" value="<?php echo $cod;?>" id="cod<?php echo $id_marca;?>">

                        <td class="th-general"><?php echo $ii; ?></td>
                        
                        <td class="th-general"><?php echo $nombre_tipo; ?></td>
                    <td class="th-general"><?php echo $nombre_marca; ?></td>
                    <td class="th-general" class="tabla-botones"><span>
                        <a href="#" class='btn btn-guardar btn-xs' title='Editar Marca' onclick="obtener_datos('<?php echo $id_marca;?>');" data-toggle="modal" data-target="#myModalMarca"><i class="glyphicon glyphicon-edit"></i></a>
                         <a href="#" class='btn btn-guardar btn-xs' title='Agregar Categorias' onclick="obtener_datos_tag('<?php echo $id_marca;?>');" data-toggle="modal" data-target="#myModalMarcaTag"><i class="glyphicon glyphicon-paste"></i></a>
                        <a href="#" class='btn btn-cancelar btn-xs' title='Borrar Marca' onclick="eliminar('<?php echo $id_marca; ?>')"><i class="glyphicon glyphicon-trash"></i></a>
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
