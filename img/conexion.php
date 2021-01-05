<?php

function conectar1()
{

   
 $db = mysqli_connect('localhost', 'root', 'mysql');
    if (!$db) {
        //cabecera('Error grave', 'menu_principal');
        print "<p>Imposible conectarse con la base de datos.</p>";
     
        exit();
    } else {
        return($db);
    }

}
function desconectar()
{
	mysql_close();
}
?>
