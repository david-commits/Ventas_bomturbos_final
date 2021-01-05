<?php
if (isset($_GET['term'])){
include("../../config/db.php");
include("../../config/conexion.php");
$return_arr = array();
/* If connection to database, run sql statement. */
if ($con)
{
	
	$fetch = mysqli_query($con,"SELECT * FROM proveedores where nom_pro like '%" . mysqli_real_escape_string($con,($_GET['term'])) . "%'"); 
	
	/* Retrieve and store in array the results of the query.*/
	while ($row = mysqli_fetch_array($fetch)) {
		$id_proveedores=$row['id_proveedores'];
		$row_array['value'] = $row['nom_pro'];
		$row_array['id_proveedores']=$id_proveedores;
		$row_array['nombre_proveedores']=$row['nom_pro'];
		$row_array['telefono_proveedores']=$row['tel_pro'];
		$row_array['email_proveedores']=$row['email_provedor'];
		array_push($return_arr,$row_array);
    }
	
}

/* Free connection resources. */
mysqli_close($con);

/* Toss back results as json encoded array. */
echo json_encode($return_arr);

}
?>