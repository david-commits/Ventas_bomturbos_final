<?php
// $db_db='bdventas_qa';
$db_db='bdventas_prod';

$db_products = $db_db.'.products';  
$db_clientes = $db_db.'.clientes';
$db_users = $db_db.'.users';
$db_facturas = $db_db.'.facturas';
$db_categorias= $db_db.'.categorias';
$db_datosempresa = $db_db.'.datosempresa';
$db_sucursal= $db_db.'.sucursal';
$db_detalle_factura= $db_db.'.detalle_factura';
$db_documento = $db_db.'.documento';
$db_comprobante_pago= $db_db.'.comprobante_pago';
$db_sub_tipo= $db_db.'.sub_tipo';
$db_servicio= $db_db.'.servicio';
//$db_db='akadeg3r_sistema';
function conectar2()
{

    //$db = mysqli_connect('localhost','akadeg3r_usuario','jocelyn2016');
 $db = mysqli_connect('167.86.115.89', 'root', 'dDvP3SjqQE7Xuf');
    if (!$db) {
        //cabecera('Error grave', 'menu_principal');
        print "<p>Imposible conectarse con la base de datos.</p>";
     
        exit();
    } else {
        return($db);
    }

}


$db_products = $db_db.'.products';


function recoge1($var)
{
    $tmp = (isset($_REQUEST[$var])) ? trim(strip_tags($_REQUEST[$var])) : '';
    if (get_magic_quotes_gpc()) {
        $tmp = stripslashes($tmp);
    }
    $tmp = str_replace('&', '&amp;',  $tmp);
    $tmp = str_replace('"', '&quot;', $tmp);
    $tmp = str_replace('í', '&iacute;', $tmp);
    
    
    return $tmp;
}


function menu1(){
    ?>
    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">

            <div class="menu_section">
              <h3>General</h3>
              <ul class="nav side-menu">
                 <li><a><i class="fa fa-home"></i> Empresa <span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu" style="display: none">
                      <li><a href="empresa.php">Empresa</a>
                    </li>
                    <li><a href="resumen.php">Resumen</a>
                    </li>
                    <li><a href="sucursal.php">Sucursales</a>
                    </li>
                    
                    
                  </ul>
                </li>
                
                <li><a><i class="fa fa-lock"></i> Usuarios <span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu" style="display: none">
                      <li><a href="usuarios.php">Usuarios</a>
                    </li>
                   <li><a href="asistencia.php">Asistencia</a>
                    </li>
                    
                  </ul>
                </li>
                
                <li><a><i class="fa fa-barcode"></i> Productos <span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu" style="display: none">
                      <li><a href="categorias.php">Categorias</a>
                    </li>
                    <li><a href="ingresoproductos.php">Ingresar Productos</a>
                    </li>
                    <li><a href="productos.php">Lista de Productos</a>
                    </li>
                    <li><a href="kardex.php">Kardex de Productos</a>
                    </li>
                    <li><a href="transferencia.php">Transferencia</a>
                    </li>
                    <li><a href="transferencia1.php">Lista de Transferencias</a>
                    </li>
                    
                    
                    <li><a href="consultaproductos.php">Consultas</a>
                    </li>
                     <li><a href="masvendidos.php">Ventas de productos</a>
                    </li>
                    
                    <li><a href="consultaprecios.php">Consulta Precios</a>
                    </li>
                    
                    
                  </ul>
                </li>
                
                <li><a><i class="fa fa-truck"></i> Proveedores <span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu" style="display: none">
                      <li><a href="proveedores.php">Proveedores</a>
                    </li>
                    
                    
                  </ul>
                </li>
                
                
                
                
                <li><a><i class="fa fa-user"></i> Clientes <span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu" style="display: none">
                      <li><a href="clientes.php">Clientes</a>
                    </li>
                   
                    
                  </ul>
                </li>
                
                <li><a><i class="fa fa-list-alt"></i> Ventas Productos<span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu" style="display: none">
                     <li><a href="documentos.php">Conf Documentos</a>
                       
                     </li>
                    
                      
                         
                    
                    
                      <li><a href="nueva_factura.php">Ventas Fact/Bol/Guia</a>
                          
                    </li>
                     
                    
                    
                    <li><a href="facturas.php">Lista de  Ventas</a>
                          
                    </li>
                    
                    <li><a href="ventasvendedor.php">Ventas por vendedor</a>
                          
                    </li>
                    
                     <li><a href="ventasclientes.php">Ventas por cliente</a>
                    </li>
                    <li><a href="resumenventas.php">Resumen Ventas</a>
                     <li><a href="cobros.php">Ventas por Cobrar</a></li>
                       <li><a href="cobrosclientes.php">Consulta de cobro de Ventas</a></li>   
                     
                    </li>
                  </ul>
                </li>
                
                
                <li><a><i class="fa fa-list-alt"></i> Ventas Servicios<span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu" style="display: none">
                    
                    
                    
                     <li><a href="ingresoservicios.php">Venta Servicios</a>
                          
                    </li>
                    <li><a href="servicios1.php">Lista Equipos</a>
                          
                    </li>
                    <li><a href="foraneos.php">Productos Externos</a>
                          
                    </li>
                      <li><a href="ventaservicios.php">Consulta Venta Servicios</a>
                          
                    </li>
                    <li><a href="ventaserviciostecnicos.php">Venta Servicios x tecnico</a>
                          
                    </li>
                    
                    
                  </ul>
                </li>
                
                
                <li><a><i class="fa fa-shopping-cart"></i> Compras <span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu" style="display: none">
                    
                    
                      <li><a href="nueva_compras.php">Compras Fact/Bol</a></li>
                          
                    
                    <li><a href="compras.php">Consulta Compras</a></li>
                    <li><a href="ventascompras.php">Compras por Vendedor</a></li>
                    <li><a href="ventasproveedor.php">Compras por Proveedor</a></li>
                     <li><a href="resumencompras.php">Resumen Compras</a>
                    <li><a href="pagos.php">Compras por Pagar</a></li>
                      <li><a href="pagosproveedores.php">Consulta de pago de compras</a></li> 
                    
                    
                    
                    </li>
                  </ul>
                </li>
                
                
                 
                
                
                
                
                
                
              <li><a><i class="fa fa-building"></i> Balance y otros <span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu" style="display: none">
                    
                    <li><a href="balance2.php">Balance</a></li>
                    
                      <li><a href="balance.php">Utilidades</a></li>
                      <li><a href="otrospagos.php">Otros Pagos/Cobros</a></li>     
                    
                          
                    
                   
                    </li>
                  </ul>
                </li>
                
                
                
                
              </ul>
            </div>
            

          </div>
            <?php
}



function menu2(){
    ?>
     <div class="profile">
            <div class="profile_pic">
              <img src="images/user.png" alt="..." class="img-circle profile_img">
            </div>
            <div class="profile_info">
              <span>Bienvenido</span>
              <?php
              //$db_db='akadeg3r_sistema';
              $db_db='oferth84_sistema1';
              $db_users = $db_db.'.users';
$db = conectar2();
$consulta1 = "SELECT * FROM $db_users ";
$result1 = mysqli_query($db, $consulta1);

while ($valor1 = mysqli_fetch_array($result1, MYSQLI_ASSOC)) {
    
    if($valor1['user_id']==$_SESSION['user_id']){
    $name=$valor1['nombres'];    
    }
    
    
    
}
              
              ?>
              
              
              <h2><?php echo $name;   ?></h2>
            </div>
          </div>
            <?php
}


function menu3(){
    ?>
    <div class="top_nav">

        <div class="nav_menu">
          <nav class="" role="navigation">
            <div class="nav toggle">
              <a id="menu_toggle"><i class="fa fa-bars"></i></a>
            </div>
<?php

$host= $_SERVER["HTTP_HOST"];
$url= $_SERVER["REQUEST_URI"];
$a="http://".$host.$url;

?>
              
              
            <ul class="nav navbar-nav navbar-right">
              <li class="">
                <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                  <img src="images/tienda.jpg" alt="">Sucursal<?php echo $_SESSION['tienda']; ?>
                  <span class=" fa fa-angle-down"></span>
                </a>
                <ul class="dropdown-menu dropdown-usermenu animated fadeInDown pull-right">
                  
                   <?php
              //$db_db='akadeg3r_sistema';
              $db_db='oferth84_sistema1';
              $db_sucursal = $db_db.'.sucursal';
$db = conectar2();
$consulta1 = "SELECT * FROM $db_sucursal ";
$result1 = mysqli_query($db, $consulta1);

while ($valor1 = mysqli_fetch_array($result1, MYSQLI_ASSOC)) {
    
    
    $tienda=$valor1['tienda'];    
    
    
    
    
}
              
              ?> 
                    
                    
                    
                    
                    <?php
                  for($i = 1 ;$i<=$tienda;$i++){
                      
                  
                  ?>
                    
                    <li><a href="tienda.php?t=<?php echo $i;?>&a=<?php echo $a;?>"> Sucursal <?php echo $i;?>  </a>
                  </li>
                  
                 
                  
                  <?php
                  }
                  ?>
                  <li><a href="salir.php">Salir</a>
                  </li>
                  
                </ul>
              </li>
                <li role="presentation" class="dropdown">
                    <a href="http://ofertasde.net/tienda/" target="_blanck" title="Pagina Web y Carrito de Compras">
                    <img src="carritocompras.jpg" heigt="65" width="55">
                  
                </a>
                
              </li>
              
              <li class="">
                  
                       <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- anuncio1 -->
<ins class="adsbygoogle"
     style="display:inline-block;width:410px;height:50px"
     data-ad-client="ca-pub-7624791494445756"
     data-ad-slot="2732896602"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>   
                      
                  
                
              </li>
              

            </ul>
              
              
          </nav>
        </div>

      </div>
            <?php
}




function footer(){
    ?>
<footer>
          
    
    
    <div class="copyright-info">
            <p class="pull-right">Sistemas Velazco.
            </p>
          </div>
          <div class="clearfix"></div>
        </footer>

<?php } ?>




