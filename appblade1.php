<?php 

require_once ("config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
require_once ("config/conexion.php");


if(isset($_POST["tl_mod_catpro_marca_m"]) ){

 $query = "SELECT cm.*, mc.id_marca as imarca, mc.nombre_marca FROM categoria_marca cm inner join marca mc on cm.id_marca=mc.id_marca where cm.id_categoria = ".$_POST["tl_mod_catpro_marca_m"]." order by mc.nombre_marca asc";
    $rs1=mysqli_query($con,$query);
        echo '<option  class="custom-select" value="">Seleccione Marca</option>';
    while($row3=mysqli_fetch_array($rs1)){
            echo '<option class="custom-select" value="'.$row3['imarca'].'">'.$row3['nombre_marca'].'</option>';
    }
}


 ?>