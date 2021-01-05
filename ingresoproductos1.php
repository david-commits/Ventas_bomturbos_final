<?php

session_start();
include('menu.php');

require_once ("config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
require_once ("config/conexion.php");//Contiene funcion que conecta a la base de datos
date_default_timezone_set('America/Lima');
$fecha  = date("Y-m-d H:i:s");
$nombre=$_POST['nombre'];

$variablecontador = 0;
$cat_pro=$_POST['cat_pro'];
$estado=$_POST['estado']; 
$marca=$_POST['marca'];

$consultacountcal = "SELECT count(*) as countca from products where cat_pro = $cat_pro and id_tipo = $estado and id_marca = $marca and estado = 1";
$queryca = mysqli_query($con, $consultacountcal);
 while ($rowca=mysqli_fetch_array($queryca)){ 
    $variablecontador = $rowca['countca'];
  }

$variablecontador = $variablecontador + 1;

$codigoprodcc = "precisa".$cat_pro.$estado.$marca.".".$variablecontador;

$pre_pro=$_POST['precio'];  
$mon_venta=$_POST['mon_costo']==1?1:2;
$cos_pro=$_POST['costo'];
$multiplicando=$_POST['multiplicando'];
$cos_pro1=$cos_pro*$multiplicando;
$mon_costo=$multiplicando;
$modelo=$_POST['modelo'];
$codigoOriginal=$_POST['codigoProducto'];
$codigoProveedor=$_POST['codigoProveedor'];
$codigoAlternativo=$_POST['codigoAlternativo'];
$medida=$_POST['medida'];
$detalle=$_POST['detalle'];
$inventario=$_POST['inventario'];
$tienda=$_SESSION['tienda'];

$prod = array();
    for($i=1 ;$i<=6;$i++){
        if($i==$tienda){
          $prod[$i]=$inventario;
        }else{
           $prod[$i]=0; 
        }
    }
$aa=0;




$id_producto=0; 
$consulta2 = "SELECT * FROM products ";
$result2 = mysqli_query($con, $consulta2);

$consulta23 = "SELECT count(*) as count FROM products ";
$result23 = mysqli_query($con, $consulta23);
 while ($row23=mysqli_fetch_array($result23)){
 	$rrr = $row23['count'];
 }
 $rrr = $rrr +1;

if ($rrr > 0) {
	$id_producto = $rrr;
}


$mensaje="";
 while ($valor2 = mysqli_fetch_array($result2, MYSQLI_ASSOC)) {

    if($valor2['nombre_producto']==$nombre AND $valor2['codigo_producto']==$codigoOriginal ){
        $mensaje="Nombre del producto duplicado";
    }

}


 if($mensaje<>"") {
    ?>

<?php
    header("location:ingresoproductos.php?mensaje=Codigo o nombre del producto duplicado");
}else{

if($aa==1){
   ?>
<script language="JavaScript" type="text/javascript">
alert("este texto es el que modificas");
</script>
<?php
    header("location:ingresoproductos.php"); 
    
}else{
  



    $namefinal="nuevo.jpg";
    $nombrecito = "";
    $nombrecitofinal = "";
    $nombrecito = $_FILES['files']['name'];
    $nombrecitsso = explode( '.', $nombrecito );
    $nombrecitofinal = end( $nombrecitsso);



    if (($nombrecitofinal != "JPEG" && $nombrecitofinal != "JPG" && $nombrecitofinal != "jpeg" && $nombrecitofinal != "jpg" && $nombrecitofinal != "PNG" && $nombrecitofinal != "png" && $nombrecitofinal != "PNEG" && $nombrecitofinal != "pneg") && $nombrecitofinal != "" ) {

          echo "<script>history.back(alert('Esta registrando un .$nombrecitofinal, Registre un archivo que sea imagen. JPG,JPEG,PNEG,PNG' ))</script>";
     
    }
    else
    {
 

    if(is_uploaded_file($_FILES['files']['tmp_name'])) {
        $ruta_destino = "fotos/";
        $namefinal="1producto".$id_producto.".jpg"; //linea nueva devuelve la cadena sin espacios al principio o al final
        $uploadfile=$ruta_destino.$namefinal;



    if(move_uploaded_file($_FILES['files']['tmp_name'], $uploadfile)) {

            $consulta = "INSERT INTO products
            (   `codigo_producto`,
                `nombre_producto`,
                `date_added`,
                `precio_producto`,
                `costo_producto`,
                `mon_costo`,
                `mon_venta`,
                `id_marca`,
                `id_modelo`,
                `codigoProveedor`,
                `codigoAlternativo`,
                `medida`,
                `detalle`,
                `cat_pro`,
                `pro_ser`,
                `id_tipo`,
                `codigoOriginal`,
                `b1`,
                `b2`,
                `b3`,
                `b4`,
                `b5`,
                `b6`,
                `foto1`,
                `foto2`,
                `foto3`,
                `foto4`,
                `web`,
                `pre_web`,
                `descripcion`,
                `megusta`,
                `nomegusta`)
                        values (
                        '$codigoprodcc',
                        '$nombre',
                        '$fecha',
                        '$pre_pro',
                        '$cos_pro',
                        '$mon_costo',
                        '$mon_venta',
                        '$marca',
                        '$modelo',
                        '$codigoProveedor',
                        '$codigoAlternativo',
                        '$medida',
                        '$detalle',
                        '$cat_pro',
                        '1',
                        '$estado',
                        '$codigoOriginal',
                        '$prod[1]',
                        '$prod[2]',
                        '$prod[3]',
                        '$prod[4]',
                        '$prod[5]',
                        '$prod[6]',
                        '$namefinal',
                        '',
                        '',
                        '',
                        '0',
                        '1',
                        'descripcion',
                        '1',
                        '0')";
          //var_dump($consulta);die;
        // mysqli_query($con, $consulta) or die(mysqli_error($con));

        if (mysqli_query($con, $consulta)) {  
            header("location:productos.php");
        } else {
              die("No se pudo insertar..");
        }
      }
      }else{

          $consulta = "INSERT INTO products ( `codigo_producto`, `nombre_producto`, `date_added`, `precio_producto`,`costo_producto`,`mon_costo`,`mon_venta`,`id_marca`,`id_modelo`, `codigoProveedor`,`codigoAlternativo`, `medida`, `detalle`, `cat_pro`, `pro_ser`, `id_tipo`, `codigoOriginal`, `b1`, `b2`,`b3`,`b4`,`b5`, `b6`,`foto1`,`foto2`, `foto3`,
                `foto4`, `web`, `pre_web`,`descripcion`, `megusta`, `nomegusta`)
            values ('$codigoprodcc','$nombre','$fecha', '$pre_pro','$cos_pro','$mon_costo','$mon_venta','$marca', '$modelo','$codigoProveedor',
                        '$codigoAlternativo','$medida','$detalle','$cat_pro','1', '$estado','$codigoOriginal','$prod[1]','$prod[2]',
                        '$prod[3]','$prod[4]','$prod[5]','$prod[6]','','','','','0','1','descripcion','1','0')";

      // var_dump( $consulta);die;
         $resultado=mysqli_query($con, $consulta) or die(mysqli_error($con));

        if ($resultado) {
            header("location:productos.php");
        } else {
              die("No se pudo insertar......");
        } 
        
      }

}

        if($multiplicando>1){
            $consulta1 = "UPDATE datosempresa SET dolar=".$multiplicando;
            if (mysqli_query($con, $consulta1)) {
                header("location:productos.php");
            } else {
              die("No se pudo insertar..");
            }        
       }
        
}
}
?>



