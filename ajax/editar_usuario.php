<?php
include('is_logged.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado
// checking for minimum PHP version
//if (version_compare(PHP_VERSION, '5.3.7', '<')) {
   // echo 'Current PHP version: ' . phpversion();
  //  exit("Sorry, Simple PHP Login does not run on a PHP version smaller than 5.3.7 !");
//} else if (version_compare(PHP_VERSION, '5.5.0', '<')) {
    // if you are using PHP 5.3 or PHP 5.4 you have to include the password_api_compatibility_library.php
    // (this library adds the PHP 5.5 password hashing functions to older versions of PHP)
   // require_once("../libraries/password_compatibility_library.php");
//}		
		if (empty($_POST['firstname2'])){
			$errors[] = "Nombres vacíos";
		}  elseif (empty($_POST['user_name2'])) {
            $errors[] = "Nombre de usuario vacío";
        }  elseif (strlen($_POST['user_name2']) > 64 || strlen($_POST['user_name2']) < 2) {
           $errors[] = "Nombre de usuario no puede ser inferior a 2 o más de 64 caracteres";
        } elseif (!preg_match('/^[a-z\d]{2,64}$/i', $_POST['user_name2'])) {
            $errors[] = "Nombre de usuario no encaja en el esquema de nombre: Sólo aZ y los números están permitidos , de 2 a 64 caracteres";
        }   elseif (
			!empty($_POST['user_name2'])
			&& !empty($_POST['firstname2'])
			
            && strlen($_POST['user_name2']) <= 64
           && strlen($_POST['user_name2']) >= 2
           && preg_match('/^[a-z\d]{2,64}$/i', $_POST['user_name2'])
           
          )
         {
            require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
			require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
			
				// escaping, additionally removing everything that could be (html/javascript-) code
                $firstname = mysqli_real_escape_string($con,(strip_tags($_POST["firstname2"],ENT_QUOTES)));
				
				$user_name = mysqli_real_escape_string($con,(strip_tags($_POST["user_name2"],ENT_QUOTES)));
                $user_email = mysqli_real_escape_string($con,(strip_tags($_POST["user_email2"],ENT_QUOTES)));
				
				$user_id=intval($_POST['mod_id']);
                                
				
                  $sucursal = $_POST['mod_sucursal'];
                  
                                
                                $dni=$_POST['mod_dni'];
                                $domicilio=$_POST['dom'];
                                $telefono=$_POST['tel'];
                               
                                $estado=$_POST['cboEstado'];
                                
                               // $balance=intval($_POST['balance']);
                                
                          //$c=$a1.".".$a2.".".$a3.".".$a4.".".$a5.".".$a6.".".$a7.".".$a8.".".$a9.".".$a10.".".$a11.".".$a12.".".$a13.".".$a14.".".$a15.".".$a16.".".$a17.".".$a18.".".$a19.".".$a20.".".$a21.".".$a22.".".$a23.".".$a24.".".$a25.".".$a26.".".$a27.".".$a28.".".$a29.".".$a30.".".$a31.".".$a32.".".$a33.".".$a34.".".$a35.".".$a36.".".$a37.".".$a38.".".$a39;      
                    //$accesos=$usuarios.".".$productos.".".$proveedores.".".$clientes.".".$ventas.".".$compras.".".$balance;            
               
					// write new user's data into database
                    $sql = "UPDATE users SET nombres='".$firstname."', user_name='".$user_name."', user_email='".$user_email."', dni='".$dni."', domicilio='".$domicilio."', telefono='".$telefono."', sucursal='".$sucursal."', estado='".$estado."'
                            WHERE user_id='".$user_id."';";
                    $query_update = mysqli_query($con,$sql);

                    // if user has been added successfully
                    if ($query_update) {
                        $messages[] = "La cuenta ha sido modificada con éxito.";
                    } else {
                        $errors[] = "Lo sentimos , el registro falló. Por favor, regrese y vuelva a intentarlo.";
                    }
                
            
        } else {
            $errors[] = "Un error desconocido ocurrió.";
        }
		
		if (isset($errors)){
			
			?>
			<div id="divparaborrar"  class="alert alert-danger" role="alert">
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
				<div id="divparaborrar"  class="alert alert-success" role="alert">
						<button  type="button" class="close" data-dismiss="alert">&times;</button>
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