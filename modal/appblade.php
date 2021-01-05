<?php
//Include database configuration file

    require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
    require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos

if(isset($_POST["country_id"]) && !empty($_POST["country_id"])){

    $query = "SELECT * FROM modelos WHERE  estado = 1 ORDER BY nombre_modelo ASC";
    $rs1=mysqli_query($con,$query);
        echo '<option class="custom-select"  value="">Seleccione Modelo</option>';
    while($row3=mysqli_fetch_array($rs1)){
            echo '<option class="custom-select" value="'.$row3['id_modelo'].'">'.$row3['nombre_modelo'].'</option>';
    }

}

if(isset($_POST["model_id"]) && !empty($_POST["model_id"])){
   // echo "<script>console.log('$_POST['marc_id']');</script>";
    $query = "SELECT * FROM products WHERE id_marca = ".$_POST['marc_id']." AND estado = 1 ORDER BY nombre_producto ASC";
    //echo "<script>console.log('$query')<script>";
    
    $rs1=mysqli_query($con,$query);
        echo '<option class="custom-select"  value="">Seleccione Producto</option>';
    while($row3=mysqli_fetch_array($rs1)){
            echo '<option class="custom-select" value="'.$row3['id_producto'].'">'.$row3['nombre_producto'].'</option>';
    }
}

if(isset($_POST["tlinea_m"]) && !empty($_POST["tlinea_m"])){
  //  $query = "SELECT * FROM motor WHERE idmarca = ".$_POST['marc_id_articulo']." AND idmodelo = ".$_POST['tlinea_m']." AND estado = 1 ORDER BY nombre ASC";
    $query = "SELECT * FROM marca WHERE  estado = 1 and id_tipoLinea =".$_POST["tlinea_m"]."   ORDER BY nombre_marca ASC";
    $rs1=mysqli_query($con,$query);
        echo '<option class="custom-select" value="">Seleccione Marca</option>';
    while($row3=mysqli_fetch_array($rs1)){
            echo '<option class="custom-select" value="'.$row3['id_marca'].'">'.$row3['nombre_marca'].'</option>';
    }
}

if(isset($_POST["model_id_articulo"]) && !empty($_POST["model_id_articulo"])){
  //  $query = "SELECT * FROM motor WHERE idmarca = ".$_POST['marc_id_articulo']." AND idmodelo = ".$_POST['model_id_articulo']." AND estado = 1 ORDER BY nombre ASC";
    $query = "SELECT * FROM motor WHERE  estado = 1 ORDER BY nombre ASC";
    $rs1=mysqli_query($con,$query);
        echo '<option class="custom-select" value="">Seleccione Motor</option>';
    while($row3=mysqli_fetch_array($rs1)){
            echo '<option class="custom-select" value="'.$row3['id_motor'].'">'.$row3['nombre'].'</option>';
    }
}


if(isset($_POST["marca_compatible_agregar"]) && !empty($_POST["marca_compatible_agregar"])){
    $nuevo = $_POST['marca_compatible_agregar'];
    $query = "SELECT * FROM modelos WHERE id_marca = ".$_POST['marca_compatible_agregar']." AND estado = 1 ORDER BY nombre_modelo ASC";
    $rs1=mysqli_query($con,$query);
        echo '<option  class="custom-select" value="">Seleccione Modelo</option>';
    while($row3=mysqli_fetch_array($rs1)){
            echo '<option class="custom-select" value="'.$row3['id_modelo'].'">'.$row3['nombre_modelo'].'</option>';
    }

}



if(isset($_POST["marca_m"]) && !empty($_POST["marca_m"])){
    $nuevo = $_POST['marca_m'];
    $query = "SELECT * FROM modelos WHERE id_marca = ".$_POST['marca_m']." AND estado = 1 ORDER BY nombre_modelo ASC";
    $rs1=mysqli_query($con,$query);
        echo '<option  class="custom-select" value="">Seleccione Modelo</option>';
    while($row3=mysqli_fetch_array($rs1)){
            echo '<option class="custom-select" value="'.$row3['id_modelo'].'">'.$row3['nombre_modelo'].'</option>';
    }

}
if(isset($_POST["modelo_m"]) && !empty($_POST["modelo_m"])){

    $mmmmarca = $_POST['marca_marca'];
    $mmmmodelo = $_POST['modelo_m'];

    $query = "SELECT * FROM motor WHERE idmarca = ".$_POST['marca_marca']." and estado = 1 and idmodelo = ".$mmmmodelo." ORDER BY nombre ASC";
  
    $rs1=mysqli_query($con,$query);
    

        echo '<option class="custom-select"  value="">Seleccione Motor</option>';
    while($row3=mysqli_fetch_array($rs1)){
            echo '<option class="custom-select" value="'.$row3['id_motor'].'">'.$row3['nombre'].'</option>';

    }

}

if(isset($_POST["mod_modelo_m_m"]) && !empty($_POST["mod_modelo_m_m"]) && isset($_POST["mod_marca_m_m"]) && !empty($_POST["mod_marca_m_m"])  ){

    $mmmmarca = $_POST['mod_marca_m_m'];
    $mmmmodelo = $_POST['mod_modelo_m_m'];
    $query = "SELECT * FROM motor WHERE idmarca = ".$_POST['mod_marca_m_m']." and idmodelo = ".$_POST['mod_modelo_m_m']." and estado = 1  ORDER BY nombre ASC";
    $rs1=mysqli_query($con,$query);
        echo '<option class="custom-select"  value="">Seleccione Motor</option>';
    while($row3=mysqli_fetch_array($rs1)){
            echo '<option class="custom-select" value="'.$row3['id_motor'].'">'.$row3['nombre'].'</option>';

    }
}


if(isset($_POST["modelo_nCompatible"]) && !empty($_POST["modelo_nCompatible"])){

    $nuevo = $_POST['modelo_nCompatible'];
    $nuevomarca = $_POST['marca_nCompatible'];
    $query = "SELECT * FROM motor WHERE idmodelo = ".$_POST['modelo_nCompatible']." AND estado = 1 AND idmarca = ".$_POST['marca_nCompatible']."  ORDER BY nombre ASC";
    $rs1=mysqli_query($con,$query);
        echo '<option  class="custom-select" value="">Seleccione Motor</option>';
    while($row3=mysqli_fetch_array($rs1)){
            echo '<option class="custom-select" value="'.$row3['id_motor'].'">'.$row3['nombre'].'</option>';
    }

}
if(isset($_POST["modelomotor_m"])){
    $mmmmodelo = $_POST['modelomotor_m'];

    $query = "SELECT * FROM motor WHERE idmodelo = ".$_POST['modelomotor_m']." and estado = 1  ORDER BY nombre ASC";
  
    $rs1=mysqli_query($con,$query);
    

        echo '<option class="custom-select"  value="">Seleccione Motor</option>';
    while($row3=mysqli_fetch_array($rs1)){
            echo '<option class="custom-select" value="'.$row3['id_motor'].'">'.$row3['nombre'].'</option>';

    }

}


if(isset($_POST["tl_tlinea"]) && !empty($_POST["tl_tlinea"])){
  //  $query = "SELECT * FROM motor WHERE idmarca = ".$_POST['marc_id_articulo']." AND idmodelo = ".$_POST['tl_tlinea']." AND estado = 1 ORDER BY nombre ASC";
    $query = "SELECT * FROM categorias WHERE  estado = 1 and id_tipoLinea =".$_POST["tl_tlinea"]."   ORDER BY nom_cat ASC";
    $rs1=mysqli_query($con,$query);
        echo '<option class="custom-select" value="">Seleccione Categoria</option>';
    while($row3=mysqli_fetch_array($rs1)){
            echo '<option class="custom-select" value="'.$row3['id_categoria'].'">'.$row3['nom_cat'].'</option>';
    }
}


?>