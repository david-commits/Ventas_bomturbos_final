<?php 

require_once ("config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
require_once ("config/conexion.php");


if(isset($_POST["tl_mod_catpro_m"]) && !empty($_POST["tl_mod_catpro_m"])){

    $nuevo = $_POST['marca_m'];
    $query = "SELECT * FROM tipo WHERE id_categoria = ".$_POST['tl_mod_catpro_m']." AND estado = 1 ORDER BY tipo ASC";
 
    $rs1=mysqli_query($con,$query);
        echo '<option  class="custom-select" value="">Seleccione Categoria</option>';
    while($row3=mysqli_fetch_array($rs1)){
            echo '<option class="custom-select" value="'.$row3['id_tipo'].'">'.$row3['tipo'].'</option>';
    }

}




 ?>