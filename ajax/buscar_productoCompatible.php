<style>
    .dt-button.red {
        color: black;   
        background:red;
    }
    .dt-button.orange {
        color: black;
        background:orange;
    }
    .dt-button.green {
        color: black;
        background:green;
    }
    .dt-button.green1 {
        color: black;
        background:#01DFA5;
    }
    .dt-button.green2 {
        color: black;
        background:#2E9AFE;
    }
    tfoot {
        display: table-header-group;
    }
</style>

<?php
    include('is_logged.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado
    /* Connect To Database*/
    require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
    require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
    $tienda1=$_SESSION['tienda'];
    $action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
    if (isset($_GET['id'])){
        $id_pcompatible=intval($_GET['id']);
        $query=mysqli_query($con, "select * from compatible where id_compatible='".$id_pcompatible."'");
        $count=mysqli_num_rows($query);          
        if ($count!=0){
            if ($delete1=mysqli_query($con,"UPDATE compatible SET estado = 0 WHERE id_compatible='".$id_pcompatible."'")){
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
        } else {
?>
            <div class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <strong>Error!</strong> No existe esa compatibilidad. 
            </div>
<?php
        }        
    }
	if($action == 'ajax'){
		// escaping, additionally removing everything that could be (html/javascript-) code
        //$q = mysqli_real_escape_string($con,(strip_tags($_REQUEST['q'], ENT_QUOTES)));
		//$aColumns = array('nombre_cliente','doc');//Columnas de busqueda
		$sTable = "compatible";
		include 'pagination.php'; //include pagination file
		//pagination variables
		$page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
		$per_page = 10; //how much records you want to show
		$adjacents  = 4; //gap between pages after number of adjacents
		$offset = ($page - 1) * $per_page;
		//Count the total number of row in your table*/
        $count_query   = mysqli_query($con, "SELECT count(*) AS numrows FROM $sTable");    
        $row= mysqli_fetch_array($count_query);
		$numrows = $row['numrows'];
		$total_pages = ceil($numrows/$per_page);
		$reload = './compatible.php';
		//main query to fetch the data        
        //$sql="SELECT * FROM  $sTable";
        $sql="SELECT cpt.*, pr.id_producto , pr.nombre_producto as nombreProducto, pr.codigoOriginal as codOrigin, pr.codigoProveedor as codprove,vh.d_vehiculo ,vh.nombre_vehiculo as nombreVehiculo, mrc.nombre_marca as nMarcaVehiculo,mrc.id_marca , mdl.nombre_modelo as nModeloVehiculo, mdl.id_modelo ,mtr.nombre as motor, mtr.id_motor FROM compatible cpt inner join products pr on cpt.id_producto=pr.id_producto inner join vehiculos vh on vh.d_vehiculo=cpt.id_vehiculo inner join marca mrc on mrc.id_marca=cpt.id_marcaVehiculo INNER join modelos mdl on mdl.id_modelo=cpt.id_modeloVehiculo inner join motor mtr on mtr.id_motor=cpt.motor where cpt.estado = 1
";
		

        $query = mysqli_query($con, $sql);
		//loop through fetched data
		if ($numrows>0){	
?>
			<div class="table-responsive">
			    <table id="example" class="display nowrap" style="width:100%">
                    <!-- <tfoot>
				        <tr>
                            <th>Nro</th>
                            <th>Vehiculo</th>
                            <th>Articulo</th>
                            <th>Marca del articulo</th>
                            <th>Modelo del articulo</th>
                            <th>Motor</th>
					        <th></th>
					        <th class='text-right'></th>
				        </tr>
                    </tfoot>  -->        
                    <thead>
				        <tr class="th-general">
                            <th class="th-general">Nro</th>
                            <th class="th-general">Vehiculo</th>
                            <th class="th-general">Articulo</th>
                            <th class="th-general">Marca del articulo</th>
                            <th class="th-general">Modelo del articulo</th>
                            <th class="th-general">Motor</th>
                            <th class="th-general">Código Original</th>
                            <th class="th-general">Código Proveedor</th>
					        <th class="th-general">Acciones</th>
				        </tr>
                    </thead>
<?php
				    while ($row=mysqli_fetch_array($query)){
                        $id_codorigin=$row['codOrigin'];
                        $id_codprove=$row['codprove'];
                        $id_compatible=$row['id_compatible'];
                      //  $aidicompa=$row['aidicompa'];
                        $id_vehiculo=$row['d_vehiculo'];
                        $nomvehiculo=$row['nombreVehiculo'];
                        //$nomvehiculo=$row['d_vehiculo'];
                        $id_marcavehiculo=$row['id_marca'];
                        $id_modelovehiculo=$row['id_modelo'];
                        $id_producto=$row['id_producto'];
                        $nomproducto=$row['nombreProducto'];
                        $id_marcaproducto=$row['nMarcaVehiculo'];
                        $id_modeloproducto=$row['nModeloVehiculo'];


                        $ide_motor=$row['motor'];
                        $id_motor=$row['id_motor'];
                     //   $aidicompa=$row['aidicompa'];
                       // $aidiproducto=$row['aidiproducto'];
                       // $aidivehiculo=$row['aidivehiculo'];
                       // $aidimarca=$row['aidimarca'];
                       // $aidimodelo=$row['aidimodelo'];
?>                   
                        <tr >
                        <input type="hidden" value="<?php echo $id_compatible;?>" id="id_compatible<?php echo $id_compatible;?>">
                        <input type="hidden" value="<?php echo $id_vehiculo;?>" id="id_vehiculo<?php echo $id_compatible;?>">
                        <input type="hidden" value="<?php echo $id_marcavehiculo;?>" id="id_marcavehiculo<?php echo $id_compatible;?>">
                        <input type="hidden" value="<?php echo $id_modelovehiculo;?>" id="id_modelovehiculo<?php echo $id_compatible;?>">
                        <input type="hidden" value="<?php echo $id_producto;?>" id="id_producto<?php echo $id_compatible;?>">
                        <input type="hidden" value="<?php echo $id_motor;?>" id="motor<?php echo $id_compatible;?>">
                            <td class="th-general"><?php echo $numrows; ?></td>
                            <td class="th-general"><?php echo $nomvehiculo; ?></td>
                            <td class="th-general"><?php echo $nomproducto; ?></td>
                            <td class="th-general"><?php echo $id_marcaproducto; ?></td>
                            <td class="th-general"><?php echo $id_modeloproducto; ?></td>
                            <td class="th-general"><?php echo $ide_motor; ?></td>
                            <td class="th-general"><?php echo $id_codorigin; ?></td>
                            <td class="th-general"><?php echo $id_codprove; ?></td>
					        <td class="th-general">
                                <span class="pull-right">
                                    <a href="#" class='btn btn-warning btn-xs' title='Editar Marca' onclick="obtener_datos('<?php echo $id_compatible;?>');" data-toggle="modal" data-target="#editarCompatible"><i class="glyphicon glyphicon-edit"></i></a> 
                                    <a href="#" class='btn btn-danger btn-xs' title='Borrar Marca' onclick="eliminar('<?php echo $id_compatible; ?>')"><i class="glyphicon glyphicon-trash"></i> </a>
                                </span>
                            </td>
					    </tr>
<?php
                        $numrows=$numrows-1;
                    }
?>				
			    </table>
			</div>
<?php
		}
	}
?>
<script>
$(document).ready(function() {
    $('#example tfoot th').each( function () {
        var title = $(this).text();
        if(title=="RUC" || title=="DNI" ||  title=="Razon Social" ||  title=="Telefono" ||  title=="Email" ||  title=="Agregado")
            $(this).html( '<input type="text" placeholder="'+title+'" />' );
    });
    // DataTable
    var table = $('#example').DataTable();
    // Apply the search
    table.columns().every( function () {
        var that = this;
        $( 'input', this.footer() ).on( 'keyup change', function () {
            if ( that.search() !== this.value ) {
                that
                    .search( this.value )
                    .draw();
            }
        });
    });   
        $('#example').DataTable( {
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
            // {
            //         extend: 'colvis',
            //         text: 'Mostrar columnas',
            //         className: 'green2',
            //         exportOptions: {
            //         columns: ':visible'
            //     }
                
            //     },   
                          
            //     {
            //         extend: 'pageLength',
            //         text: 'Mostrar filas',
            //         className: 'orange',
            //         exportOptions: {
            //         columns: ':visible'
            //     }
                
            //     },
                
            //     {
            //         extend: 'copy',
            //         text: 'Copiar',
            //         className: 'red',
            //         exportOptions: {
            //         columns: ':visible'
            //     }
            //     },
                {
                    extend: 'excel',
                    text: 'Excel',
                    className: 'green',
                    exportOptions: {
                    columns: ':visible'
                }
                },
                // {
                //     extend: 'csv',
                //     text: 'CSV',
                //     className: 'green1',
                //     exportOptions: {
                //     columns: ':visible'
                // }
                // },
                // {
                //     extend: 'print',
                //     text: 'Imprimir',
                //     className: 'green2',
                //     exportOptions: {
                //     columns: ':visible'
                // }
                // },
            ],
         "pageLength": 20,
    } );
} );
</script>