<style type="text/css">
   .thumbnail1{
position: relative;
z-index: 0;
}
.thumbnail1:hover{
background-color: transparent;
z-index: 50;
}
.thumbnail1 span{ /*Estilos del borde y texto*/
position: absolute;
background-color: white;
padding: 5px;
left: -100px;

visibility: hidden;
color: #FFFF00;
text-decoration: none;
}
.thumbnail1 span img{ /*CSS for enlarged image*/
border-width: 0;
padding: 2px;
}
.thumbnail1:hover span{ /*CSS for enlarged image on hover*/
visibility: visible;
top: 17px;
left: 60px; /*position where enlarged image should offset horizontally */
} 
img.imagen2{
padding:4px;
border:3px #0489B1 solid;
margin-left: 2px;
margin-right:5px;
margin-top: 5px;
float:left;
}
</style>
<?php
	include('is_logged.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado
	/* Connect To Database*/
	require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
	require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
	$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
    $inner="";
	$ctct1 = 0;
	if (isset($_GET['idparaeliminarvehiculo'])){
        $id_compatible=intval($_GET['idparaeliminarvehiculo']);
        //$query=mysqli_query($con, "select * from compatible where estado=1 AND id_vehiculo='".$id_vehiculo."'");
        //$count=mysqli_num_rows($query);
                
        //if ($count==0){
            if ($delete1=mysqli_query($con,"UPDATE compatible SET estado=0 WHERE  id_compatible='".$id_compatible."'")){
            ?>
            <div class="alert alert-success alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <strong>Aviso!</strong> Datos eliminados exitosamente.
            </div>
            <?php 
        }else {
            ?>
            <div class="alert alert-danger alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <strong>Error!</strong> Lo siento algo ha salido mal intenta nuevamente.
            </div>
            <?php
            
        }
            
        /*} else {
            ?>
            <div class="alert alert-danger alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <strong>Error!</strong> No se pudo eliminar éste vehículo.Existen productos compatibles con este vehículo. 
            </div>
            <?php
        }*/
        
        
        
    }
   if($action == 'ajax'){
		$sTable = "compatible";
		$sWhere = " ";
		$ideproducto=$_GET["q"];
		$Marca=$_GET["marca"];
		$Modelo=$_GET["modelo"];
		$Motor=$_GET["motor"];
		$AnioCompa=$_GET["aniocompa"];
		$Cilindro=$_GET["cilindro"];
		$Combustible=$_GET["combustible"];

		$inner1 = "SELECT DISTINCT cpb.id_compatible, mrc.nombre_marca, vhc.combustible , vhc.nombre_vehiculo as nncomentario  , mdl.nombre_modelo, vhc.cilindro, mtr.nombre, vhc.anio, vhc.detalle   FROM compatible cpb inner join products prc on cpb.id_producto = prc.id_producto inner join vehiculos vhc on cpb.id_vehiculo = vhc.d_vehiculo INNER join marca mrc on mrc.id_marca = vhc.id_marca inner join modelos mdl on vhc.id_modelo = mdl.id_modelo inner join motor mtr on vhc.motor = mtr.id_motor where prc.id_producto =".$ideproducto." AND cpb.estado = 1 ";
		$inner = " cpb inner join products prc on cpb.id_producto = prc.id_producto inner join vehiculos vhc on cpb.id_vehiculo = vhc.d_vehiculo INNER join marca mrc on mrc.id_marca = vhc.id_marca inner join modelos mdl on vhc.id_modelo = mdl.id_modelo inner join motor mtr on vhc.motor = mtr.id_motor where prc.id_producto =".$ideproducto." AND cpb.estado = 1 ";
		



		if ($_REQUEST['marca'] != null || $_REQUEST['modelo'] != null || $_REQUEST['motor'] != '' || $_REQUEST['aniocompa'] != '' || $_REQUEST['cilindro'] != '' || $_REQUEST['combustible'] != ''  ) {

			$Marca = $_REQUEST['marca'];
			$Modelo = $_REQUEST['modelo'];
			$Motor = $_REQUEST['motor'];
			$AnioCompa=$_GET["aniocompa"];
			$Cilindro=$_GET["cilindro"];
			$Combustible=$_GET["combustible"];
			$sWhere .= " ";
			



					if(isset($Combustible) AND $Combustible!=""){
					
							$sWhere.=" AND vhc.combustible like '"."%". $Combustible ."%"."' ";
						
					}

					if(isset($Marca) AND $Marca!="" AND $Marca != 0){
						
							$sWhere.=" AND vhc.id_marca=$Marca ";
					}

					if(isset($Modelo) AND $Modelo!="" AND $Modelo != 0){
						
							$sWhere.=" AND vhc.id_modelo=$Modelo ";
					}

					if(isset($Motor) AND $Motor!="" AND $Motor != " " AND $Motor != 0){
						
							$sWhere.=" AND vhc.motor='$Motor' ";
					}

					if(isset($Cilindro) AND $Cilindro!="" AND $Cilindro != " "){
						
							$sWhere.=" AND vhc.cilindro like '"."%".$Cilindro."%"."' ";
					}

					if(isset($AnioCompa) AND $AnioCompa!="" AND $AnioCompa != " "){
						
							$sWhere.=" AND vhc.anio like '"."%".$AnioCompa."%"."' ";
						
					}

}

		


		include 'pagination.php'; //include pagination file
		//pagination variables
		$page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
		$per_page = 5; //how much records you want to show
		$adjacents  = 4; //gap between pages after number of adjacents
		$offset = ($page - 1) * $per_page;
		//Count the total number of row in your table*/

$sqlll=  "SELECT COUNT(mrc.nombre_marca) AS numrows FROM $sTable $inner $sWhere";


		$count_query   = mysqli_query($con, $sqlll);
			
	
		$innerwhere = $inner.$sWhere;

		$row= mysqli_fetch_array($count_query);
		
		
		$numrows = $row['numrows'];
		$total_pages = ceil($numrows/$per_page);
		$reload = './index.php';
		//main query to fetch the data


		$sql="$inner1 $sWhere LIMIT $offset,$per_page";
		
		$sqlporcentaje="SELECT * FROM  constante WHERE estado = 1";
		


		$query = mysqli_query($con, $sql);
		$queryporcentaje = mysqli_query($con, $sqlporcentaje);
		//loop through fetched data
		

			
?>
			
			  <table  id="searcCompatible" class="display nowrap" style="width:100%">
                              
	               <thead>
						<tr>
							<th class="th-general">Marcas</th>
	                        <th class="th-general">Modelo</th>
	                        <th class="th-general">Litro</th>
	                        <th class="th-general">Motor</th>
	                        <th class="th-general">Año</th>
                          <th class="th-general">Descripción</th>
                          <th class="th-general">Combustible</th>
	                        <th class="th-general">Comentarios</th>
	                        <th class='text-right th-general'>Acciones</th>
						</tr>
	                </thead>

<?php

				while ($row=mysqli_fetch_array($query)){
					$id_compatible=$row['id_compatible'];
					$marca=$row['nombre_marca'];
					$modelo=$row['nombre_modelo'];
					$cilindro=$row['cilindro'];
          $nombre_motor=$row['nombre'];
					$combustible=$row['combustible'];
					$anio=$row['anio'];
          $detalle=$row['detalle'];
					$nncomentario=$row['nncomentario'];



?>

				<tbody>    
	                <tr class="th-general">       
						<td class="th-general"><?php echo $marca;?></td>
						<td class="th-general"><?php echo $modelo;?></td>
						<td class="th-general"><?php echo $cilindro;?></td>
						<td class="th-general"><?php echo $nombre_motor;?></td>
						<td class="th-general"><?php echo $anio;?></td>
            <td class="th-general"><?php echo $detalle;?></td>
            <td class="th-general"><?php echo $combustible;?></td>
						<td class="th-general"><?php echo $nncomentario;?></td>
						<td class="th-general"><span>
                            <a href="#" class='btn btn-cancelar btn-xs' title='Borrar compatible' onclick="eliminarcompatibilidad('<?php echo $id_compatible; ?>')"><i class="glyphicon glyphicon-trash"></i></a>
                        </span></td>               
					</tr>
					</tbody>
<?php
				}
?>
				<tr>
					<td class=' th-general' colspan=9><span class="pull-right" ><?php
					 echo paginate($reload, $page, $total_pages, $adjacents);
					?></span>
					</td>
				</tr>
			</table>
		
<?php

	}		
?>

             <script>
 
$(document).ready(function() {


    $('#searcCompatible tfoot th').each( function () {
        var title = $(this).text();

        if(title=="Nro" || title=="Tipo Linea" ||  title=="Marca" )
        $(this).html( '<input type="text" placeholder="'+title+'" />' );
    } );

   var table = $('#searcCompatible').DataTable();

        $('#searcCompatible').DataTable( {
        language: {
        "url": "/dataTables/i18n/de_de.lang",
                "decimal": "",
        "show": "Mostrar",
        "emptyTable": "No hay informacion",
        "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
        "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
        "infoFiltered": "(Filtrado de _MAX_ total entradas)",
        "infoPostFix": "",
        "thousands": ",",
        "lengthMenu": "Mostrar _MENU_ Entradas",
        "loadingRecords": "Cargando...",
        "processing": "Procesando...",
        "search": "Buscar:",
        "zeroRecords": "Sin resultados encontrados",
        buttons: {
                copyTitle: 'Copiar filas al portapapeles',
                
                copySuccess: {
                    _: 'Copiado %d fias ',
                    1: 'Copiado 1 fila'
                },
                
                pageLength: {
                _: "Mostrar %d filas",
                '-1': "Mostrar Todo"
            }
            },
        "paginate": {
            "first": "Primero",
            "last": "Ultimo",
            "next": "Siguiente",
            "previous": "Anterior"
        }
        
        
        
        
    },
         bDestroy: true,
            dom: 'Bfrtip',
        lengthMenu: [
            [ 10, 25, 50, -1 ],
            [ '10 filas', '25 filas', '50 filas', 'Mostrar todo' ]
        ],
        buttons: 
        
        
         [
                 
                {
                    extend: 'excel',
                    text: 'Excel',
                    className: 'green',
                    exportOptions: {
                    columns: ':visible'
                }
                },
         
            ],
         "pageLength": 20,
        
    } );
} );



</script>


<style type="text/css">
	/* START TOOLTIP STYLES */
[tooltip] {
  position: relative; /* opinion 1 */
}

/* Applies to all tooltips */
[tooltip]::before,
[tooltip]::after {
  text-transform: none; /* opinion 2 */
  font-size: .9em; /* opinion 3 */
  line-height: 1;
  margin-left: 300px;
  user-select: none;
  pointer-events: none;
  position: absolute;
  display: none;
  opacity: 0;
}
[tooltip]::before {
  content: '';
  border: 5px solid transparent; /* opinion 4 */
  z-index: 1001; /* absurdity 1 */
}
[tooltip]::after {
  content: attr(tooltip); /* magic! */
  
  /* most of the rest of this is opinion */
  font-family: Helvetica, sans-serif;
  text-align: center;
  
  /* 
    Let the content set the size of the tooltips 
    but this will also keep them from being obnoxious
    */
  min-width: 10em;
  max-width: 50em;
  min-height: 10em;
  max-height: 50em;
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
  padding: 1ch 1.5ch;
  border-radius: .3ch;
  box-shadow: 0 1em 2em -.5em rgba(0, 0, 0, 0.35);
  background: #333;
  color: #fff;
  z-index: 1000; /* absurdity 2 */
}

/* Make the tooltips respond to hover */
[tooltip]:hover::before,
[tooltip]:hover::after {
  display: block;
}

/* don't show empty tooltips */
[tooltip='']::before,
[tooltip='']::after {
  display: none !important;
}

/* KEYFRAMES */
@keyframes tooltips-vert {
  to {
    opacity: .9;
    transform: translate(-50%, 0);
  }
}

@keyframes tooltips-horz {
  to {
    opacity: .9;
    transform: translate(0, -50%);
  }
}

/* FX All The Things */ 
[tooltip]:not([flow]):hover::before,
[tooltip]:not([flow]):hover::after,
[tooltip][flow^="up"]:hover::before,
[tooltip][flow^="up"]:hover::after {
  animation: tooltips-vert 300ms ease-out forwards;
}
table th{
	text-align: center!important;
}
</style>