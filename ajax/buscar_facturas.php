<!-- <style>
    table tr:nth-child(odd) {background-color: #343e59; border-radius: 0.5rem;}
    table tr:nth-child(even) {background-color: #343e59; border-radius: 0.5rem;}
</style> 
<style>

#valor1 {             
border-bottom: 2px solid #F5ECCE;
}  
#valor1:hover {             
background-color: white;
border-bottom: 2px solid #A9E2F3;
} 
</style>
<style type="text/css">
   .thumbnail1{
position: relative;
z-index: 0;
}
.thumbnail1:hover{
background-color: transparent;
z-index: 50;
}
.thumbnail1 span{ /*Estilos del borde y texto*/
position: absolute;
background-color: white;
padding: 5px;
left: -100px;

visibility: hidden;
color: #FFFF00;
text-decoration: none;
}
.thumbnail1 span img{ /*CSS for enlarged image*/
border-width: 0;
padding: 2px;
}
.thumbnail1:hover span{ /*CSS for enlarged image on hover*/
visibility: visible;
top: 17px;
left: 40px; /*position where enlarged image should offset horizontally */
} 

img.imagen2{
padding:4px;
border:3px #0489B1 solid;
margin-left: 2px;
margin-right:5px;
margin-top: 5px;
float:left;

}


#valor1:hover {              
background-color: white;
border-bottom: 2px solid #A9E2F3;
}  
#valor2:hover {              
background-color: white;
border-bottom: 2px solid #A9E2F3;
} 
#valor1 {             
background-color: #FBF8EF;
border-bottom: 2px solid #F5ECCE;
}  
#valor2 {             
background-color: #EFFBF5;
border-bottom: 2px solid #F5ECCE;
} 
.dt-button.red {
color: black;
background:red;
}
.dt-button.orange {
color: black;
background:orange;
}
.dt-button.green {
color: black;
background:green;
}
.dt-button.green1 {
color: black;
background:#01DFA5;
}
.dt-button.green2 {
color: black;
background:#2E9AFE;
}
tfoot {
    display: table-header-group;
}
.dataTables_wrapper .dataTables_paginate .paginate_button:hover {
  background: none;
  color: black!important;
  border-radius: 4px;
  border: 1px solid #828282;
}
.dataTables_wrapper .dataTables_paginate .paginate_button:active {
  background: none;
  color: black!important;
}
</style> -->
<?php
    include('is_logged.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado
    /* Connect To Database*/
    require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
    require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
    $tienda1=$_SESSION['tienda'];
        $usuario=$_SESSION['user_id'];
        date_default_timezone_set('America/Lima');
        $fecha1  = date("Y-m-d H:i:s");
    $action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';


    if (isset($_GET['id'])){
        $id_factura=intval($_GET['id']);
        $del1="UPDATE facturas set activo=0 where id_factura='".$id_factura."'";
        $sql1=mysqli_query($con, "select * from facturas where id_factura='".$id_factura."'");
        while ($row1=mysqli_fetch_array($sql1)){
            $numero_factura=$row1["numero_factura"];
            $folio=$row1["folio"];
            $tipo_doc=$row1["estado_factura"];
            $tienda=$row1["tienda"];
            $id_cliente=$row1["id_cliente"];
            $deuda=$row1["deuda_total"];
            $nombre=$row1["nombre"];
        }
        $del4="UPDATE clientes SET deuda=deuda-$deuda WHERE id_cliente='".$id_cliente."'";
        $del2="UPDATE detalle_factura set activo=0 where folio='".$folio."' and numero_factura='".$numero_factura."' and ven_com=1 and tienda=$tienda and tipo_doc=$tipo_doc and id_cliente=$id_cliente";
        $count_query   = mysqli_query($con, "SELECT count(*) AS numrows FROM pagos  where id_factura=$id_factura");
        $row2= mysqli_fetch_array($count_query);
        $numrows = $row2['numrows'];
        if ($numrows==0 and $delete1=mysqli_query($con,$del1) and $delete2=mysqli_query($con,$del2) and $delete4=mysqli_query($con,$del4)){
            $sql=mysqli_query($con, "select * from detalle_factura where folio='".$folio."' and numero_factura='".$numero_factura."' and ven_com=1 and tienda=$tienda and id_cliente=$id_cliente and tipo_doc=$tipo_doc" );
            while ($row=mysqli_fetch_array($sql)){
                $id_producto=$row["id_producto"];
                $tienda=$row["tienda"];
                $cantidad=$row["cantidad"];
                $b="b".$tienda;
                $productos1=mysqli_query($con, "UPDATE products SET $b=$b+$cantidad WHERE id_producto=$id_producto");
                $sql1=mysqli_query($con, "select * from products where id_producto='".$id_producto."'");
                while ($row1=mysqli_fetch_array($sql1)){
                    $b=$row1["b$tienda"];
                }
                $c=$b-$cantidad;  
                $insert=mysqli_query($con,"INSERT INTO detalle_factura VALUES ('','$id_cliente','$usuario','$numero_factura','0','$id_producto','$cantidad','0','$tienda1','0','2','$fecha1','0','$tipo_doc','$c','3.2','$folio')"); 
            
                //var_dump($ksks);
                //die();
                $modificardespacho=mysqli_query($con,"UPDATE cabecera_orden set estado_pago = 6, estado_envio = 7 where nro_pre_orden ='".$numero_factura."'"); 

            }?>
            
            <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <strong>Aviso!</strong> Datos eliminados exitosamente.
            </div>
            <?php 
        }else{?>
            <div class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <strong>Error!</strong> No se puedo eliminar los datos existen cobros asociados.
            </div>
            <?php
            
        }
    }



    if($action == 'ajax'){
        // escaping, additionally removing everything that could be (html/javascript-) code
                $q = mysqli_real_escape_string($con,(strip_tags($_REQUEST['q'], ENT_QUOTES)));
        $sTable = "facturas, clientes, users";
        
        $sWhere = "";
        $sWhere.=" WHERE facturas.id_cliente=clientes.id_cliente and facturas.tienda=$tienda1 and facturas.id_vendedor=users.user_id and facturas.ven_com=1 and facturas.activo=1 ";
                if ( $_GET['q'] != "" )
        {
        $sWhere.= " and  (clientes.nombre_cliente like '%$q%' or facturas.numero_factura like '%$q%' )";
        }
        $sWhere.=" order by facturas.id_factura desc";
        include 'pagination.php'; //include pagination file
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
        $reload = './facturas.php';
        $sql="SELECT * FROM  $sTable $sWhere LIMIT $offset,$per_page";
      //  var_dump($sql);
        $query = mysqli_query($con, $sql);
        //loop through fetched data
        if ($numrows>0){
            echo mysqli_error($con);
            ?>
            <div class="table-responsive">
              <table class="table">
                <tr >
                                <th class="th-general">Nro Doc</th>
                                <th class="th-general" class='text-right'>Tipo de Doc</th>
                                <th class="th-general">Fecha</th>
                <th class="th-general">Cliente</th>
                <th  class="th-general" class='text-right'>Total</th>
                                <th class="th-general" class='text-right'>Deuda</th>
                                <th class="th-general" >Vendedor</th>
                                <th class="th-general">Pago</th>
                                <th class="th-general" class='text-right'>Estado</th>
                                <th  class="th-general" class='text-right'>Acciones</th>
                </tr>
                        <?php
                while ($row=mysqli_fetch_array($query)){
                                    
                                                $activo=$row['activo'];
                        if ($activo==1){
                                                $id_factura=$row['id_factura'];
                        $numero_factura=$row['numero_factura'];
                        $fecha=date("d/m/Y", strtotime($row['fecha_factura']));
                        $nombre_cliente=$row['nombre_cliente'];
                        $telefono_cliente=$row['telefono_cliente'];
                                                $ruc=$row['doc'];
                        $email_cliente=$row['email_cliente'];
                                                $folio=$row['folio'];
                                                $dni=$row['dni'];
                                                $ot=$row['ot'];
                        $nombre_vendedor=$row['nombres'];
                                                $estado_factura1=$row['estado_factura'];
                        $estado_factura=$row['condiciones'];
                                                $ven_com=$row['ven_com'];
                                                $moneda=$row['moneda'];
                                                if($moneda==1){
                                                    $mon="S/.";
                                                }else{
                                                    $mon="USD";
                                                }
                                                
                                                if($estado_factura1==1){
                                                    $estado1="Factura";
                                                    
                                                }
                                                if($estado_factura1==2){
                                                    $estado1="Boleta";
                                                    
                                                }
                                                if($estado_factura1==3){
                                                    $estado1="Guia";
                                                }
                                                if($estado_factura1==5){
                                                    $estado1="Nota de Debito";
                                                    
                                                }
                                                if($estado_factura1==6){
                                                    $estado1="Nota de Credito";
                                               }
                                               // cambio 08/02
                                               if($estado_factura1==7){
                                                    $estado1="Factura";
                                                    
                                                }
                                               
                                               
                                               if($estado_factura==1){
                                                    $estado2="Efectivo";
                                                }
                                                if($estado_factura==2){
                                                    $estado2="Cheque";
                                                    
                                                }
                                                if($estado_factura==3){
                                                    $estado2="Transf Bancaria";
                                                }
                                                if($estado_factura==4){
                                                    $estado2="Crédito";
                                               }
                                               /// cambio  08/02
                                               if($estado_factura==7){
                                                    $estado2="Efectivo";
                                                }
                                               
                                                $deuda=$row['deuda_total'];
                                                $servicio=$row['servicio'];
                                                $guia=0;
                                                $sql1="SELECT * FROM  servicio;";
                                                $query1 = mysqli_query($con, $sql1);
                                               
                                                while ($row1=mysqli_fetch_array($query1)){
                                                  if($row1['doc_servicio']==$numero_factura && $row1['tip_doc']==$estado_factura1)  {
                                                     $guia=$row1['guia'];
                                                 }
                                                }
                                                if ($servicio==0){$text_estado1="Productos";$label_class1='label-success';}
                                                else{$text_estado1="Servicios";$label_class1='label-warning';}
                                            if ($deuda==0){$text_estado="Pagada";$label_class='label-success';}
                        else{$text_estado="Pendiente";$label_class='label-warning';}
                        $total_venta=$row['total_venta'];
                    ?>
                    <tr>
                                           
                        <td  class="th-general"><?php print"$folio $numero_factura" ; ?></td>
                                                <td  class="th-general"><?php echo $estado1; ?></td>
                                                <td class="th-general"><?php echo $fecha; ?></td>
                        <td  class="th-general"><?php echo $nombre_cliente;?></td>
                                                <td class="th-general" class='text-right'><?php print"$mon"; echo number_format ($total_venta,2); ?></td>                   
                                                <td class="th-general" class='text-right'><?php print"$mon"; echo number_format ($deuda,2); ?></td>
                                                <td class="th-general"><?php echo $nombre_vendedor; ?></td>
                                                <td class="th-general"><span class="label label-success"><?php echo $estado2; ?></span></td>
                                                <td class="th-general"><span class="label <?php echo $label_class;?>"><?php echo $text_estado; ?></span></td>
                        <td  class="th-general" class="text-right">
                    <!--    <a href="editar_factura.php?id_factura=<?php echo $id_factura;?>" class='btn btn-default' title='Editar factura' ><i class="glyphicon glyphicon-edit"></i></a> -->
                            <a href="guia.php?accion=<?php echo $id_factura;?>" class='btn btn-info btn-xs' title='Guia de remision' ><i class="glyphicon glyphicon-edit"></i></a>

                            <a href="#" class='btn btn-primary btn-xs' title='Descargar doc' onclick="imprimir_factura('<?php echo $id_factura;?>');"><i class="glyphicon glyphicon-download-alt"></i></a> 
                                                
                            <!--<a href="#" class='btn btn-warning btn-xs' title='Enviar correo' onclick="imprimir_factura1('<?php echo $id_factura;?>');"><i class="glyphicon glyphicon-download"></i></a> -->
                                <?php  
                                    if ($estado_factura1<=3){
                                ?>
                                    <a href="#" class='btn btn-cancelar btn-xs' title='Borrar Doc' onclick="eliminar('<?php echo $id_factura; ?>')"><i class="glyphicon glyphicon-trash"></i> </a>
                                <?php
                                    }   
                                ?>
                        </td>
                    </tr>
                    <?php
                                        $numrows=$numrows-1;
                        }
                                }
                ?>
            <tr>
                    <td colspan=10><span class="pull-right"><?php
                     echo paginate($reload, $page, $total_pages, $adjacents);
                    ?></span></td>
                </tr>
              </table>
            </div>
            <?php
        }
                }
    
?>

