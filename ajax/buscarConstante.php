<?php
  include('is_logged.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado
  /* Connect To Database*/
  require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
        include 'pagination.php'; //include pagination file
  require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos

  $action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';

    if (isset($_GET['id'])){
        $id_constante=intval($_GET['id']);
            if ($delete1=mysqli_query($con,"UPDATE constante SET estado=0 WHERE id_constante='".$id_constante."'")){
            ?>
            <div id="eliminaranunciomodelo" class="alert alert-success alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <strong>Aviso!</strong> Datos eliminados exitosamente.
            </div>
            <?php 
        }else {
            ?>
            <div id="eliminaranunciomodelo" class="alert alert-danger alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <strong>Error!</strong> Lo siento algo ha salido mal intenta nuevamente.
            </div>
            <?php
            
        }

    }

       if (isset($_GET['idajustar'])){
        $id_constante=intval($_GET['idajustar']);
        $query=mysqli_query($con, "select * from constante where estado=1 AND id_constante='".$id_constante."'");
        $count=mysqli_num_rows($query);
               
        while ($row=mysqli_fetch_array($query)){
                $montopcj = $row['monto'];
                $dolarpcj = $row['dolar'];
        }


$querygananciatipo1= "UPDATE products set costo_soles = (precio_producto * $dolarpcj), tcp_compra = $dolarpcj, costo_venta_soles = ((precio_producto * $dolarpcj) + ganancia) where estado = 1 and tipo_ganancia = 1";
$querygananciatipo2= "UPDATE products set costo_soles = (precio_producto * $dolarpcj), tcp_compra = $dolarpcj, costo_venta_soles = 
((precio_producto * $dolarpcj) + ((precio_producto * $dolarpcj) * ganancia_monto_porcsoles) / 100 ) , ganancia = (((precio_producto * $dolarpcj) * ganancia_monto_porcsoles) / 100 ) where estado = 1 and tipo_ganancia = 2";

  $actualizarprecio1=mysqli_query($con, $querygananciatipo1);
  $actualizarprecio2=mysqli_query($con, $querygananciatipo2);



       /* $querypro=mysqli_query($con, "select * from products where estado=1");
        $countpro=mysqli_num_rows($querypro);
        while ($rowpro=mysqli_fetch_array($querypro)){
          //$variableparaobtenergananciaprodc = 0;
                $proidproducto = $rowpro['id_producto'];
                $proppro = $rowpro['precio_producto'];
                $procospro = $rowpro['costo_producto'];
                $tipo_ganancia = $rowpro['tipo_ganancia'];
                $promoncosto = $rowpro['mon_costo'];
                $producganancia = $rowpro['ganancia'];
                $ganancia_monto_porcsoles = $rowpro['ganancia_monto_porcsoles'];


                $variableparaobtenerelprecio = $proppro * $dolarpcj; 
                if ($tipo_ganancia == 1) {
                  $variableparaobtenergananciaprodc = $variableparaobtenerelprecio + $producganancia;//esta variable sirve para costo_venta_soles
                }elseif($tipo_ganancia == 2){
                  $auxiliargananciaporcentaje = (($variableparaobtenerelprecio * $ganancia_monto_porcsoles)/100);
                  $variableparaobtenergananciaprodc = $variableparaobtenerelprecio + $auxiliargananciaporcentaje;
                  $producganancia = $auxiliargananciaporcentaje;
                }else{

                }

        $insert=mysqli_query($con,"INSERT INTO producto_detalle VALUES ('','$proidproducto','$variableparaobtenerelprecio','$dolarpcj')");
        $dividir = $proppro / $promoncosto; 
        $cambiamos_precio = $dividir * $dolarpcj;
        $querquerquer = "UPDATE products SET costo_soles = $variableparaobtenerelprecio, tcp_compra = $dolarpcj, costo_venta_soles = $variableparaobtenergananciaprodc, ganancia=$producganancia WHERE id_producto='".$proidproducto."'";
        var_dump($querquerquer);
        $delete1=mysqli_query($con, $querquerquer);
        }*/

        if ($count!=0){

            ?>
            <div id="eliminaranuncioconstante" class="alert alert-success alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <strong>Aviso!</strong> Datos Actualizados Con Éxito. 
            </div>
            <?php 
       
            
        } else {
            ?> 
            <div id="eliminaranuncioconstante" class="alert alert-danger alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <strong>Error!</strong> No se pudo Actualizar los precios, Intentelo de nuevo Por Favor.
            </div>
            <?php
        }
        
        
    }

  if($action == 'ajax'){


    $arrayproq = explode(" ", $_REQUEST['q']);
    $conarray = count($arrayproq);
    // escaping, additionally removing everything that could be (html/javascript-) code
$aColumns = array('monto', 'detalle', 'dolar');//Columnas de busqueda
         $sTable = "constante";
 $nucarray = count($aColumns) - 1;

         $sWhere = "";

        $sWhere.=" WHERE estado=1 ";
    //pagination variables
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

    $sWhere.=" order by id_constante asc";


        $page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
        $per_page = 10; //how much records you want to show
        $adjacents  = 4; //gap between pages after number of adjacents
        $offset = ($page - 1) * $per_page;
        //Count the total number of row in your table*/
           $count_query   = mysqli_query($con, "SELECT count(*) AS numrows FROM $sTable  $sWhere");
        $row= mysqli_fetch_array($count_query);
        $numrows = $row['numrows'];
        $total_pages = ceil($numrows/$per_page);
        $reload = './constante.php';
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
   <th class="th-general">% Ganancia</th>
                                    <th class="th-general">Detalle</th>
                                    <th class="th-general">Dólar</th>
                                    <th class="th-general">Acciones</th>
          </tr>
        </thead>
                <tbody>
                    <?php
                    $nuevocontadorlista = 1;
                    $ii = 1;
                    while ($row=mysqli_fetch_array($query)){
                        $id_constante=$row['id_constante'];

                         $montopc=$row['monto'];
                         $detalle=$row['detalle'];
                         $dolar=$row['dolar'];
                            
                        ?>
                    <tr>
                      <input type="hidden" value="<?php echo $id_constante;?>" id="id_constante<?php echo $id_constante;?>">
                    <input type="hidden" value="<?php echo $montopc;?>" id="montopc<?php echo $id_constante;?>">
                    <input type="hidden" value="<?php echo $dolar;?>" id="dolar<?php echo $id_constante;?>">
                    <input type="hidden" value="<?php echo $detalle;?>" id="detalle<?php echo $id_constante;?>">

                        <td class="th-general"><?php echo $ii; ?></td>
                        
                            <td class="th-general"><?php echo $montopc; ?></td>
                    <td class="th-general"><?php echo $detalle; ?></td>
                        <td  class="th-general"><?php echo $dolar; ?></td>
                    <td class="th-general">
                        <span>

                           <a href="#" class='btn btn-guardar  btn-xs EditarMarca' title='Editar constante' onclick="obtener_datos('<?php echo $id_constante;?>');" data-toggle="modal" data-target="#myModalMarca"><i class="glyphicon glyphicon-edit"></i></a>
                           <a href="#" class='btn btn-cancelar btn-xs' title='Borrar constante' onclick="eliminar('<?php echo $id_constante; ?>')"><i class="glyphicon glyphicon-trash"></i></a>

                           <a href="#" class='btn btn-agregar btn-xs' title='Actualizar Precios' onclick="ajustarprecios('<?php echo $id_constante; ?>')"><i class="glyphicon glyphicon-retweet"></i></a>
                        </span>
                    </td>  
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
