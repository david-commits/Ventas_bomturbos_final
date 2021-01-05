<!-- <style>
    table tr:nth-child(odd) {background-color: #FBF8EF;}
table tr:nth-child(even) {background-color: #EFFBF5;}
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
table tr:nth-child(odd) {background-color: #F5F6CE;}
table tr:nth-child(even) {background-color: #CEF6E3;}
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
    if($action == 'ajax'){
        // escaping, additionally removing everything that could be (html/javascript-) code
                $q = mysqli_real_escape_string($con,(strip_tags($_REQUEST['q'], ENT_QUOTES)));
        $sTable = "facturas, clientes, users";
        $sWhere = "";
        $sWhere.=" WHERE facturas.id_cliente=clientes.id_cliente and facturas.tienda=$tienda1 and (facturas.estado_factura<=2 or facturas.estado_factura=5 or facturas.estado_factura=6)and facturas.id_vendedor=users.user_id and facturas.ven_com=1 and facturas.activo=1 and facturas.numero_factura>0";
        
                 if ( $_GET['q'] != "" )
        {
        $sWhere.= " and  (clientes.nombre_cliente like '%$q%' or facturas.numero_factura like '%$q%' )";
            
        }
        
        $sWhere.=" order by facturas.id_factura desc";
        include 'pagination.php'; //include pagination file
        //pagination variables
        $page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
        $per_page = 20; //how much records you want to show
        $adjacents  = 4; //gap between pages after number of adjacents
        $offset = ($page - 1) * $per_page;
        //Count the total number of row in your table*/
        $count_query   = mysqli_query($con, "SELECT count(*) AS numrows FROM $sTable  $sWhere");
        $row= mysqli_fetch_array($count_query);
        $numrows = $row['numrows'];
        $total_pages = ceil($numrows/$per_page);
        $reload = './facturas.php';
                $sql1="SELECT * FROM sucursal where tienda=$tienda1";
        $query1 = mysqli_query($con, $sql1);
                $row1=mysqli_fetch_array($query1);
                $ruc1=$row1['ruc'];
            $sql="SELECT * FROM  $sTable $sWhere LIMIT $offset,$per_page";
        $query = mysqli_query($con, $sql);
        //loop through fetched data
        if ($numrows>0){
            echo mysqli_error($con);
            ?>
            <div class="table-responsive">
              <table class="table">
                <tr  style="background-color:#FE9A2E;color:white; ">
                    
                                        <th  class="th-general">Nro Doc</th>
                                        <th  class="th-general"class='text-right'>Tipo de Doc</th>
                                        
                    <th  class="th-general"> Fecha</th>
                    <th class="th-general">Cliente</th>
                    <th class="th-general" class='text-right'>Total</th>
                                        <th class="th-general" class='text-right'>Hora envio a Sunat</th>
                                        <th class="th-general" class='text-right'>Desc<br>XML</th>
                                        <th class="th-general" class='text-right'>
                                            <!-- <img src="ajax/sunat.png" width="25" height="25">
                                            Firmar y<br>Enviar -->
                                            Firmar y Enviar
                                        </th>
                    <th  class="th-general" class='text-right'>Respuesta<br>Sunat(CDR)</th>
                                        <th class="th-general" class='text-right'>Enviar <br>correo</th>
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
                                                $tip=0;
                                                $estado_factura1=$row['estado_factura'];
                                                if($estado_factura1==1){
                                                    $tip="01";
                                                }
                                                if($estado_factura1==2){
                                                    $tip="03";
                                                }
                                                if($estado_factura1==6){
                                                    $tip="07";
                                                }
                                                if($estado_factura1==5){
                                                    $tip="08";
                                                }
                                                $doc1="$ruc1-$tip-$folio-$numero_factura.xml";
                                                
                                                $doc2="$ruc1-$tip-$folio-$numero_factura";
                                                
                                                $doc3="R-$ruc1-$tip-$folio-$numero_factura.xml";
                                                $aceptado1="No enviado";
                                                $fecha3="";
                                                $hora3="";
                                                if (file_exists('../pdf/documentos/cdr/'.$doc3.'')) {
                                                    
                                               
                                                $xml = file_get_contents('../pdf/documentos/cdr/'.$doc3.'');

#== Obteniendo datos del archivo .XML 
$aceptado="";
                                                
    $DOM = new DOMDocument('1.0', 'ISO-8859-1');
    $DOM->preserveWhiteSpace = FALSE;
    $DOM->loadXML($xml);

    ### DATOS DE LA FACTURA ####################################################
    
    // Obteniendo RUC.
    $DocXML = $DOM->getElementsByTagName('Description');
        foreach($DocXML as $Nodo){
        $aceptado = $Nodo->nodeValue; 
    }  
    $DocXML = $DOM->getElementsByTagName('ResponseDate');
        foreach($DocXML as $Nodo){
        $fecha3 = $Nodo->nodeValue; 
    }
    $DocXML = $DOM->getElementsByTagName('ResponseTime');
        foreach($DocXML as $Nodo){
        $hora3 = $Nodo->nodeValue; 
    }
                                                
    $fecha3=date("d/m/Y", strtotime($fecha3));
                                                $pos = strpos($aceptado, "aceptada");
                                                
                                                if ($pos === false) {
    $aceptado1= "No aceptada";
} else {
    $aceptado1= "Aceptada";
   
}
                         }
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
                                                
                                                $deuda=$row['deuda_total'];
                                                $servicio=$row['servicio'];
                                               $sql1="SELECT * FROM  servicio;";
                                                $query1 = mysqli_query($con, $sql1);
                                               
                                                while ($row1=mysqli_fetch_array($query1)){
                                                  if($row1['doc_servicio']==$numero_factura && $row1['tip_doc']==$estado_factura1)  {
                                                     $guia=$row1['guia'];
                                                }
                                                }
                                                
                                                ?>
                                
                                
                                <?php
                                             
                                                if ($servicio==0){$text_estado1="Productos";$label_class1='label-success';}
                        else{$text_estado1="Servicios";$label_class1='label-warning';}
                                                
                        if ($deuda==0){$text_estado="Pagada";$label_class='label-success';}
                        else{$text_estado="Pendiente";$label_class='label-warning';}
                        $total_venta=$row['total_venta'];
                    ?>
                    <tr >
                                           
                        <td  class="th-general"> <?php echo $folio; ?>-<?php echo $numero_factura; ?></td>
                                                <td  class="th-general"><?php echo $estado1; ?></td>
                                                
                                                
                        <td class="th-general"><?php echo $fecha; ?></td>
                        <td class="th-general" ><?php echo $nombre_cliente;?>
                                                 </td>   
                                    <td  class="th-general"class='text-right'><?php print"$mon"; echo number_format ($total_venta,2); ?></td>                   
                                                <td  class="th-general"class='text-right'><font color='black'><strong><?php print"$fecha3&nbsp;&nbsp;"; echo $hora3; ?></strong></font></td>
                        <td class="th-general" class="text-right">
                                                    <?php
                                                    if($aceptado1=="No enviado"){
                                                        ?>
                                                    <a href="#" class='btn btn-primary btn-xs' title='Descargar xml' onclick="imprimir_factura('<?php echo $doc1;?>');"><i class="glyphicon glyphicon-download-alt"></i></a> 
                         
                                                            <?php
                                                    }
                                                    ?>
                                                    
                                                    <?php
                                                    if($aceptado1<>"No enviado"){
                                                        ?>
                                                    <a href="#" class='btn btn-primary btn-xs' title='Descargar xml' onclick="imprimir_factura2('<?php echo $doc1;?>');"><i class="glyphicon glyphicon-download-alt"></i></a> 
                         
                                                            <?php
                                                    }
                                                    ?>
                                                    
                                                    
                                                    
                                                    </td>
                                                    <td class="th-general" class="text-right">
                                                    <?php
                                                    if($folio<>"" and ($estado_factura1<=2 or $estado_factura1==5 or $estado_factura1==6)){
                                                        ?>
                                                    <a href="#" class='btn btn-guardar btn-xs' title='Firmar y enviar sunat' onclick="imprimir_facturas('<?php echo $doc2;?>');"><i class="glyphicon glyphicon-share"></i> Enviar</a> 
                         
                                                            <?php
                                                    }
                                                    ?>
                                                    
                                                
                                                
                                                </td>
                                                
                                                  <td class="th-general" class="text-right">
                                                    <?php
                                                    if($folio<>"" and ($estado_factura1<=2 or $estado_factura1==5 or $estado_factura1==6)){
                                                        ?>
                                                    <a href="#" class='btn btn-cancelar btn-xs' title='Descargar CDR' onclick="imprimir_factura1('<?php echo $doc3;?>');"><?php echo $aceptado1;?></a> 
                         
                                                            <?php
                                                    }
                                                    ?>
                                                    </td>
                                                    <td class="th-general">
                                                       <a href="#" class='btn btn-info btn-xs' title='Enviar correo' onclick="enviar_correo('<?php echo $id_factura;?>');"><i class="glyphicon glyphicon-envelope"></i></a> 
                                                        
                                                        
                                                    </td>
                    </tr>
                    <?php
                                        $numrows=$numrows-1;
                                        
                }
                                }
                ?>
                <tr>
                    <td colspan=11><span class="pull-right"><?php
                     echo paginate($reload, $page, $total_pages, $adjacents);
                    ?></span></td>
                </tr>
              </table>
            </div>
            <?php
        }
                }
    
?>

