<?php 
session_start();
require_once ("config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
require_once ("config/conexion.php");

$qidDespacho = $_POST['iddespacho_excel'];
		header('Content-Type:text/xls');
		header('Content-Disposition: attachement; filename=Reporte_Excel.xls');

?>
                            <table id="example" class="display nowrap" style="width:100%">
                            	 <div class="col-md-12 col-sm-12 col-xs-12 separador-compras separador">
  											 <h1>Datos del Pedido</h1>
  										  </div>
                              <tfoot class="th-general">
                                <tr class="th-general">
              <!-- <div class="pull-right separador-compras">
                <a href="ingresoProductos.php" class="btn btn-guardar" style="width: 150px;" id=""><span id="">Nuevo Producto</span></a>
              </div>  -->

  <?php 
    $iddelacabecera = $qidDespacho;
      // escaping, additionally removing everything that could be (html/javascript-) code
  //$aColumns = array('nom_cat');//Columnas de busqueda
           $sTable = " cabecera_orden cao inner join detalle_cabecera deca on cao.id=deca.id_cabecera_orden inner join products prc on deca.id_producto=prc.id_producto inner join marca mrc on prc.id_marca=mrc.id_marca inner join modelos modl on prc.id_modelo=modl.id_modelo inner join categorias cate on prc.cat_pro = cate.id_categoria";
           $sWhere = "";

         // $sWhere.=" order by id_categoria asc";
          $sWhere.=" where cao.id = $iddelacabecera ";
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
          $reload = './consulta_despacho.php';
          //main query to fetch the data





  ?>


            </tr>
          </tfoot>
                  <thead >
            <tr class="th-general">
     <th class="th-general">#</th>
                          <th class="th-general">Nombre del Producto</th>
                          <th class="th-general">Ubicacion</th>
                          <th class="th-general">Marca del Vehiculo</th>
                          <th class="th-general">Modelo del Vehiculo</th>
                          <th class="th-general">Motor</th>
                          <th class="th-general">Cant. Litros</th>
                          <th class="th-general">Anio del Vehiculo</th>
                          <th class="th-general">Tipo de Combustible</th>
                          <th class="th-general">Categoria de Repuesto</th>
                          <th class="th-general">Marca de Repuesto</th>
                          <th class="th-general">Medidas</th>
                          <th class="th-general">Codigo</th>
                          <th class="th-general">Precio</th>
                          <th class="th-general">Cantidad</th>
            </tr>
          </thead>
          <tbody>
            <?php        
              $sqldetalles="SELECT cao.*, deca.*, prc.*, mrc.nombre_marca, modl.nombre_modelo, cate.nom_cat as nombre_categoria FROM $sTable $sWhere LIMIT $offset,$per_page";
              //var_dump($sqldetalles);
              $querydetalles = mysqli_query($con, $sqldetalles);
              $nuevocontadorlista = 1;
              $ii = 1;
                while ($rowdetalle=mysqli_fetch_array($querydetalles)){
                  $nombre_categoria = $rowdetalle['nombre_categoria'];
                  $nombreproduc = $rowdetalle['nombre_producto'];
                  $produc_detalle = $rowdetalle['detalle'];
                  $nombre_marca = $rowdetalle['nombre_marca'];
                  $nombre_modelo = $rowdetalle['nombre_modelo'];
                  $id_vehiculo = $rowdetalle['id_vehiculo'];
                  $codigo_producto = $rowdetalle['codigo_producto'];
                  $medida = $rowdetalle['medida'];
                  $costo_venta_soles = $rowdetalle['costo_venta_soles'];
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
                              <tr>
                          <!--<input type="hidden" value="<?php echo $nom_cat;?>" id="nom_cat<?php echo $id_categoria;?>">
                          <input type="hidden" value="<?php echo $des_cat;?>" id="des_cat<?php echo $id_categoria;?>">-->
                          <td class="th-general" style="background: #343e59!important;"><?php echo $ii; ?></td>
                          <td class="th-general"><?php echo $nombreproduc; ?></td>
                          <td class="th-general"><?php echo $produc_detalle; ?></td>
                          <td class="th-general" style="background: #343e59!important;"><?php echo $nombre_marca1; ?></td>
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

          </tbody>
          <?php
           $ii = $ii + 1;
            }
            /*}*/
  ?>
        </table>
                              <div class="col-md-12 col-sm-12 col-xs-12 separador-compras separador">
                        <h1>Datos del Cliente</h1>
                        
                      </div>
    <div class="col-md-12 col-sm-12 col-xs-12 separador-compras separador">
                                      <div class="table-responsive">
                                <table id="example" class="display nowrap" style="width:100%">
          <tfoot class="th-general">
            <tr class="th-general">
              <!-- <div class="pull-right separador-compras">
                <a href="ingresoProductos.php" class="btn btn-guardar" style="width: 150px;" id=""><span id="">Nuevo Producto</span></a>
              </div>  -->

  <?php 
    $iddelacabecera = $qidDespacho;
      // escaping, additionally removing everything that could be (html/javascript-) code
  //$aColumns = array('nom_cat');//Columnas de busqueda
           $sTable = " cabecera_orden cao inner join users usr on cao.id_cliente=usr.user_id INNER join clientes cli on cli.id_cliente = usr.id_cliente  inner join tipo_envios tpe on cao.tipo_de_envio=tpe.id_tipoenvios ";
           $sWhere = "";

         // $sWhere.=" order by id_categoria asc";
          $sWhere.=" where cao.id = $iddelacabecera ";
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
          $reload = './consulta_despacho.php';
          //main query to fetch the data





  ?>


            </tr>
          </tfoot>
                  <thead >
            <tr class="th-general">
     <th class="th-general">Nombre</th>
                          <th class="th-general">Nro. Documento</th>
                          <th class="th-general">Telefono</th>
                          <th class="th-general">Correo</th>
                          <th class="th-general">Metodo de Envio</th>
                          <th class="th-general">Direccion</th>
                          <th class="th-general">Provincia</th>
            </tr>
          </thead>
          <tbody>
            <?php        
              $sqlclientes ="SELECT cli.*, tpe.nombre_tenvio FROM $sTable $sWhere LIMIT $offset,$per_page";
            //var_dump($sqlclientes);
              $queryclientes = mysqli_query($con, $sqlclientes);
              $nuevocontadorlistaa = 1;
              $iia = 1;
                while ($rowclientes=mysqli_fetch_array($queryclientes)){
                  $nombre_cliente = $rowclientes['nombre_cliente'];
                  $doc = $rowclientes['doc'];
                  $telefono_cliente = $rowclientes['telefono_cliente'];
                  $email_cliente = $rowclientes['email_cliente'];
                  $nombre_tenvio = $rowclientes['nombre_tenvio'];
                  $direccion_cliente = $rowclientes['direccion_cliente'];
                  $provincia = $rowclientes['provincia'];
            ?>      
                              <tr>
                          <!--<input type="hidden" value="<?php echo $nom_cat;?>" id="nom_cat<?php echo $id_categoria;?>">
                          <input type="hidden" value="<?php echo $des_cat;?>" id="des_cat<?php echo $id_categoria;?>">-->
                          <td class="th-general" style="background: #343e59!important;"><?php echo $nombre_cliente; ?></td>
                          <td class="th-general" style="background: #343e59!important;"><?php echo $doc; ?></td>
                          <td class="th-general"><?php echo $telefono_cliente; ?></td>
                          <td class="th-general" style="background: #343e59!important;"><?php echo $email_cliente; ?></td>
                          <td class="th-general"><?php echo $nombre_tenvio; ?></td>
                          <td class="th-general"><?php echo $direccion_cliente; ?></td>
                          <td class="th-general"><?php echo $provincia; ?></td>
                      </tr>

          </tbody>
          <?php
            }
            /*}*/
  ?>
        </table>
      </div>
                         
                      </div>
                                              <div class="col-md-12 col-sm-12 col-xs-12 separador-compras separador">
                        <h1>Estado de la Orden</h1>
                        
                      </div>

    <div class="col-md-12 col-sm-12 col-xs-12 separador-compras separador">                
      <table id="example" class="display nowrap" style="width:100%">
        <tfoot class="th-general">
          <tr class="th-general">
            <?php 
              $iddelacabecera = $qidDespacho;
              $textoepago = "";
              $textoeenvio = "";
              $sql21="select * from cabecera_orden where id = $iddelacabecera ";
              // var_dump($sql21);
              $i=0;
              $rs11=mysqli_query($con,$sql21);
                while($row31=mysqli_fetch_array($rs11)){
                  $epago = $row31['estado_pago'];
                  $estado_envio = $row31['estado_envio'];
                }
            ?>
            </tr>
        </tfoot>
        <thead >
          <tr class="th-general">
            <th class="th-general">Estado del Pago</th>
            <th class="th-general">Estado del Envio</element></th>
          </tr>
        </thead>
        <tbody>
          <?php        
            $sqlclientes ="SELECT cli.*, tpe.nombre_tenvio FROM $sTable $sWhere LIMIT $offset,$per_page";
            $queryclientes = mysqli_query($con, $sqlclientes);
            $nuevocontadorlistaa = 1;
            $iia = 1;?>
          <tr>
            <td class="th-general" style="background: #343e59!important;">
           
             
                  <?php
                    $nom = array();
                    $sql2="select * from parametro where estado = 1 and id_tipo_param = 1 ";
                    $i=0;
                    $rs1=mysqli_query($con,$sql2);
                      while($row3=mysqli_fetch_array($rs1)){
                        $nombre_parametro=$row3["nombre_parametro"];
                        $id_parametro=$row3["id_parametro"];
                        if ($epago == $id_parametro) {
                        	$textoepago = $nombre_parametro;
                        	}else{ 
$textoepago = "POR PAGAR";
}
          
                        }    
                        echo $textoepago;?>  
            
            </td>
            <td class="th-general" style="background: #343e59!important;">
              
                  <?php
                    $nom = array();
                    $sql2="select * from parametro where estado = 1 and id_tipo_param = 2";
                    $i=0;
                    $rs1=mysqli_query($con,$sql2);
                      while($row3=mysqli_fetch_array($rs1)){
                        $nombre_parametro=$row3["nombre_parametro"];
                        $id_parametro=$row3["id_parametro"];
                        if ($estado_envio == $id_parametro) {
                        	$textoeenvio = $nombre_parametro;
                        	 }else{
                        	$textoeenvio = "POR RECOGER";
}
             
                        } echo $textoeenvio;   
                        ?>  
         
            </td>
          </tr>
        </tbody>
      </table>
</div>




<?php



















?>