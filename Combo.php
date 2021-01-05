<?php 
require_once ("config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
require_once ("config/conexion.php");

	$id=$_POST["id"];
	$sql="SELECT mo.id_modelo as id, mo.nombre_modelo as nom FROM marca m join tipo_linea tp on tp.id_tipoLinea=m.id_tipoLinea JOIN modelos mo ON mo.id_marca=m.id_marca where tp.id_tipoLinea=2 and mo.estado=1 AND mo.id_marca= $id";

	$result=mysqli_query($con,$sql);

	$cadena="<select required id='mod_idmodelo' name='mod_idmodelo' class='form-control'>";

	//var_dump(mysqli_fetch_row($result));die;
	while ($ver=mysqli_fetch_row($result)) {
		$cadena=$cadena.'<option class="custom-select"  value='.$ver[0].'>'.utf8_encode($ver[1]).'</option>';
	}
	echo  $cadena."</select>";

?>