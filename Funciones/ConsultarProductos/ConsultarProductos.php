<?php
require_once ("../../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
require_once ("../../config/conexion.php");//Contiene funcion que conecta a la base de dato

//var_dump($_POST);  die;

if($_GET["opcion"]==1){
	$where="";
	if((isset($_POST["marca"]) AND $_POST["marca"]!="") OR (isset($_POST["modelo"]) AND $_POST["modelo"]!="")){
		$and=" and";

		if(isset($_POST["marca"]) AND $_POST["marca"]!=""){
			$where.=$and." m.id_marca=".$_POST["marca"];
		}

		if(isset($_POST["modelo"]) AND $_POST["modelo"]!=""){
			$where.=$and." mo.id_modelo=".$_POST["modelo"];
		}
	}
		$producto=$_POST["producto"];

		$sql="select c.id_compatible AS id,v.nombre_vehiculo as Vehiculo, m.nombre_marca as Marca, 
		mo.nombre_modelo as Modelo,
        v.cilindro AS Cilindro,
        v.motor AS Motor,
        v.anio AS Anio,
        v.detalle AS Detalle,
        v.combustible AS Combustible,
        c.estado AS Estado
        from vehiculos as v 
		INNER join compatible as c on c.id_vehiculo=v.d_vehiculo 
		INNER join marca as m on m.id_marca=v.id_marca 
		INNER join modelos as mo on mo.id_modelo=v.id_modelo
		INNER join products as pro on pro.id_producto=c.id_producto where pro.id_producto=$producto $where";

		$rs=mysqli_query($con,$sql);

		$data=null;
		while($row= mysqli_fetch_array($rs)){
		$data[]=$row;
	}	


}else if($_GET["opcion"]==2){
	$where="";
	if((isset($_POST["marca"]) AND $_POST["marca"]!="") OR (isset($_POST["modelo"]) AND $_POST["modelo"]!="")){
		$and=" and";

		if(isset($_POST["marca"]) AND $_POST["marca"]!=""){
			$where.=$and." ma.id_marca=".$_POST["marca"];
		}

		if(isset($_POST["modelo"]) AND $_POST["modelo"]!=""){
			$where.=$and." mo.id_modelo=".$_POST["modelo"];
		}

    	 if(isset($_POST["cilindro"]) AND $_POST["cilindro"]!=""){
			$where.=$and." mo.cilindro=".$_POST["cilindro"];
		}

		 if(isset($_POST["anio"]) AND $_POST["anio"]!=""){
			$where.=$and." mo.anio=".$_POST["anio"];
		}
		if(isset($_POST["motor"]) AND $_POST["motor"]!=""){
			$where.=$and." mo.motor=".$_POST["motor"];
		}
		if(isset($_POST["combustible"]) AND $_POST["combustible"]!=""){
			$where.=$and." mo.combustible=".$_POST["combustible"];
		}

	}

	$subconsulta="";

	if(isset($_POST["producto"])){
		$producto=$_POST["producto"];
		$subconsulta="and vh.d_vehiculo not in (select id_vehiculo from compatible where id_producto=$producto)";
	}

	$sql="SELECT DISTINCT(vh.d_vehiculo) AS id, vh.nombre_vehiculo AS Vehiculo, vh.detalle AS Detalle, mot.nombre AS Motor, vh.cilindro AS Cilindro, vh.anio AS Anio, vh.combustible AS Combustible, ma.nombre_marca AS Marca, mo.nombre_modelo AS Modelo FROM vehiculos vh INNER JOIN marca ma ON ma.id_marca=vh.id_marca INNER JOIN modelos mo ON mo.id_modelo=vh.id_modelo INNER JOIN motor mot on mot.id_motor=vh.motor where vh.estado=1 $subconsulta $where";
	$rs=mysqli_query($con,$sql);

	$data=null;
	while($row= mysqli_fetch_assoc($rs)){
		$data[]=$row;
	}

} else if($_GET["opcion"]==3){
	$producto=$_POST["producto"];
	$tipo=$_POST["id"];
	$sql="INSERT INTO compatible (id_producto,id_vehiculo) VALUES ('$producto','$tipo')";

	$query_new_insert = mysqli_query($con,$sql) or die(mysqli_error($con));
		
}else if($_GET["opcion"]==4){
	$producto=$_POST["producto"];
	$estado=$_POST["estado"];
	$sql="update compatible set estado=$estado where id_compatible=$producto";

	$query_new_insert = mysqli_query($con,$sql) or die(mysqli_error($con));
		
}else if($_GET["opcion"]==5){
	$sql="SELECT dolar FROM datosempresa";
	$rs=mysqli_query($con,$sql);

	$data=null;
	while($row= mysqli_fetch_row($rs)){
	$data[]=$row;
	}

}else if($_GET["opcion"]==6){
	$marca=$_POST["idMarca"];
	$sql="SELECT id_modelo AS id, nombre_modelo AS modelo FROM modelos where id_marca=$marca";
	$rs=mysqli_query($con,$sql);
	$data=null;
	while($row= mysqli_fetch_array($rs)){
	$data[]=$row;
	}
}else if($_GET["opcion"]==7){

		$nombrevehiculo=$_POST["Nombre"];
		$idmarca=$_POST["idMarca"];
		$idmodelo=$_POST["Modelo"];
		$motor=$_POST["Motor"];
		$cilindro=$_POST["Cilindro"];
		$anio=$_POST["Anio"];
		$combustible=$_POST["Combustible"];
		$detalle=$_POST["Detalle"];
		$estado=$_POST["Estado"];
		$id_vehiculo=$_POST["id"];

	$sql="UPDATE vehiculos SET nombre_vehiculo='".$nombrevehiculo."', id_marca='".$idmarca."', id_modelo='".$idmodelo."', motor='".$motor."', cilindro='".$cilindro."', anio='".$anio."', combustible='".$combustible."', detalle='".$detalle."', estado='".$estado."' WHERE d_vehiculo='".$id_vehiculo."'";

	$query_new_insert = mysqli_query($con,$sql) or die(mysqli_error($con));

}else if($_GET["opcion"]==8){
	$idVehiculo=$_POST["id"];
	$sql="SELECT id_marca AS idMarca, id_modelo AS Modelo,
	nombre_vehiculo AS Nombre, motor AS Motor,
	cilindro AS Cilindro,anio AS Anio,
	combustible AS Combustible, detalle AS Detalle,
	estado AS Estado, d_vehiculo AS id FROM  vehiculos";

	$rs=mysqli_query($con,$sql);

	$data=null;
	while($row= mysqli_fetch_array($rs)){
	$data[]=$row;

	}
}else if($_GET["opcion"]==9){
	$id=$_POST["marca"];
	$sql="SELECT mo.id_modelo as id, mo.nombre_modelo as nom FROM marca m join tipo_linea tp on tp.id_tipoLinea=m.id_tipoLinea JOIN modelos mo ON mo.id_marca=m.id_marca where tp.id_tipoLinea=2 and mo.estado=1 AND mo.id_marca= $id";

	$rs=mysqli_query($con,$sql);

	$data=null;
	while($row= mysqli_fetch_array($rs)){
		$data[]=$row;
	}
}

echo json_encode($data);

?>

