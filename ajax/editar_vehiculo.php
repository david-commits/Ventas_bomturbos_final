<?php
	include('is_logged.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado
	/*Inicia validacion del lado del servidor*/
	if (empty($_POST['mod_idvehiculo'])) {
       $errors[] = "ID vacío";
    }else if (empty($_POST['mod_idvehiculo'])) {
       $errors[] = "Nombre vacío";
    } else if (
        !empty($_POST['mod_idvehiculo'])
    ){
    /* Connect To Database*/
        require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
        require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
        // escaping, additionally removing everything that could be (html/javascript-) code
        $idmarca=mysqli_real_escape_string($con,(strip_tags($_POST["mod_idMarca"],ENT_QUOTES)));
        $idmodelo=mysqli_real_escape_string($con,(strip_tags($_POST["mod_idmodelo_mode"],ENT_QUOTES)));
        $motor=mysqli_real_escape_string($con,(strip_tags($_POST["mod_motor"],ENT_QUOTES)));
        $cilindro=mysqli_real_escape_string($con,(strip_tags($_POST["mod_cilindro"],ENT_QUOTES)));
        $anio=mysqli_real_escape_string($con,(strip_tags($_POST["mod_anio"],ENT_QUOTES)));
        $combustible=mysqli_real_escape_string($con,(strip_tags($_POST["mod_combustible"],ENT_QUOTES)));
        $estado=mysqli_real_escape_string($con,(strip_tags($_POST["mod_estado"],ENT_QUOTES)));
        $detalle=mysqli_real_escape_string($con,(strip_tags($_POST["mod_detalle"],ENT_QUOTES)));
        $mod_comentario=mysqli_real_escape_string($con,(strip_tags($_POST["mod_comentario"],ENT_QUOTES)));
        
        $id_vehiculo=intval($_POST['mod_idvehiculo']);

        $sql="UPDATE vehiculos SET id_marca='".$idmarca."', nombre_vehiculo='".$mod_comentario."',  id_modelo='".$idmodelo."', motor='".$motor."', cilindro='".$cilindro."', anio='".$anio."', combustible='".$combustible."', detalle='".$detalle."', estado='".$estado."' WHERE d_vehiculo='".$id_vehiculo."'";

            $consulta="SELECT * FROM vehiculos WHERE id_marca=$idmarca AND nombre_vehiculo='$mod_comentario' AND id_modelo=$idmodelo AND motor='$motor' AND cilindro='$cilindro' AND anio='$anio' AND estado=1 AND d_vehiculo!=$id_vehiculo";

             $resultado=mysqli_query($con,$consulta);

            if(mysqli_num_rows($resultado)>0)
            {
                // Si es mayor a cero imprimimos que ya existe el usuario
                $errors []= "Vehiculo duplicado.";
            }else{
                  $query_update = mysqli_query($con,$sql);
                if ($query_update){
                    $messages[] = " El Vehículo ha sido actualizado satisfactoriamente.";
                } else{
                    $errors []= "Lo siento algo ha salido mal intenta nuevamente.";
                }
            }   

       
    } else {
        $errors []= "Error desconocido.";
    }
		
    if (isset($errors)){
    ?>
    <div class="alert alert-danger" role="alert">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>Error!</strong>
            <?php
                foreach ($errors as $error) {
                    echo $error;
                }
            ?>
    </div>
    <?php
    }
    if (isset($messages)){
        ?>
        <div class="alert alert-success" role="alert">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>¡Bien hecho!</strong>
                <?php
                    foreach ($messages as $message) {
                        echo $message;
                    }
                ?>
        </div>
        <?php
    }

?>





         
                
		


		