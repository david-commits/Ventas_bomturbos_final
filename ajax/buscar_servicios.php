
<head>
    
    
    <link href="css/select2.css" rel = "stylesheet" />  
    <script>
        $(document).ready(function() { $("#valor").select2(); });
    </script>
  
  
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
</head>
<?php

	
	
	include('is_logged.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado
	/* Connect To Database*/
	require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
	require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
	
	$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
	if (isset($_GET['id'])){
		$numero_factura=intval($_GET['id']);
		$del1="UPDATE facturas set activo=0, deuda_total=0 where numero_factura='".$numero_factura."' and ven_com=1";
		$del2="UPDATE detalle_factura set activo=0 where numero_factura='".$numero_factura."' and ven_com=1";
               
              $sql=mysqli_query($con, "select * from detalle_factura where numero_factura='".$numero_factura."'");
while ($row=mysqli_fetch_array($sql))
	{
         $id_producto=$row["id_producto"];
         $tienda=$row["tienda"];
         $cantidad=$row["cantidad"];
         $b="b".$tienda;
         $productos1=mysqli_query($con, "UPDATE products SET $b=$b+$cantidad WHERE id_producto=$id_producto and pro_ser=1");
         
         
     }
        
      
                
                //$del3="UPDATE products SET $b=$b+$cantidad WHERE id_producto=$id_producto";
                
                
		if ($delete1=mysqli_query($con,$del1) and $delete2=mysqli_query($con,$del2)){
			?>
			<div class="alert alert-success alert-dismissible" role="alert">
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			  <strong>Aviso!</strong> Datos eliminados exitosamente
			</div>
			<?php 
		}else {
			?>
			<div class="alert alert-danger alert-dismissible" role="alert">
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			  <strong>Error!</strong> No se puedo eliminar los datos
			</div>
			<?php
			
		}
	}
	if($action == 'ajax'){
		// escaping, additionally removing everything that could be (html/javascript-) code
         //$q = mysqli_real_escape_string($con,(strip_tags($_REQUEST['q'], ENT_QUOTES)));
		 $sTable = "detalle_factura, products,users";
		 $sWhere = "";
		 $sWhere.=" WHERE detalle_factura.id_producto=products.id_producto and detalle_factura.numero_factura=0 and users.user_id=detalle_factura.precio_compra";
		
                
		
		$sWhere.=" order by detalle_factura.id_detalle asc";
		include 'pagination.php'; //include pagination file
		//pagination variables
		$page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
		$per_page = 20; //how much records you want to show
		$adjacents  = 4; //gap between pages after number of adjacents
		$offset = ($page - 1) * $per_page;
		//Count the total number of row in your table*/
		$count_query   = mysqli_query($con, "SELECT count(*) AS numrows FROM $sTable  $sWhere");
		$row= mysqli_fetch_array($count_query);
		$numrows = $row['numrows'];
		$total_pages = ceil($numrows/$per_page);
		$reload = './facturas.php';
		//main query to fetch the data
		$sql="SELECT * FROM  $sTable $sWhere ";
		$query = mysqli_query($con, $sql);
		//loop through fetched data
		if ($numrows>0){
			echo mysqli_error($con);
			?>

   


			<div class="table-responsive">
			  <table id="example" class="display nowrap" style="width:100%">
                              <tfoot>
				<tr>
					<th></th>
					<th>Fecha</th>
                                        <th></th>
					<th>Producto</th>
					<th>Vendedor</th>
					<th></th>
                                        <th>Sucursal</th>
                                        <th></th>
                                       
					
				</tr>
                                </tfoot>
                              
                              
                              <thead>
				<tr  style="background-color:#FE9A2E;color:white; ">
					<th>Nro</th>
					<th>Fecha</th>
                                        <th>Hora</th>
					<th>Producto</th>
					<th>Vendedor</th>
					<th>Cantidad</th>
                                        <th>Sucursal</th>
                                        <th>Tipo</th>
                                       
					
				</tr>
                                </thead>
				<?php
				while ($row=mysqli_fetch_array($query)){
                                    
                                                $producto=$row['nombre_producto'];
						
                                               
						$fecha=date("d/m/Y", strtotime($row['fecha']));
                                                $fecha1=date("H:i", strtotime($row['fecha']));
						$cantidad=$row['cantidad'];
						
                                                $tienda=$row['tienda'];
                                                $ven_com=$row['ven_com'];
                                                $vendedor=$row['nombres'];
                                                
                                                
                                                
                                                
                                                
                                                
                                                if ($ven_com==1){$text_estado1="Salida";$label_class1='label-success';}
						else{$text_estado1="Entrada";$label_class1='label-warning';}
                                                
						
					?>
					<tr id="valor1">
						<td><?php echo $numrows; ?></td>
						<td><?php echo $fecha; ?></td>
                                                <td><?php echo $fecha1; ?></td>
						<td><?php echo $producto; ?></td>
						<td><?php echo $vendedor; ?></td>
                                                <td><?php echo $cantidad; ?></td>
                                                <td><?php echo $tienda; ?></td>
                                                
						
						
                                                 <td><span class="label <?php echo $label_class1;?>"><?php echo $text_estado1; ?></span></td>
                                                 
                                                 
                                                 
                                              
						
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
    
        
        
        $('#datatableId tfoot tr').appendTo('#datatableId thead');
        
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
    
     initComplete: function () {
            this.api().columns([1, 3, 4,5,6,7]).every( function () {
                var column = this;
                
                
                var select = $('<select id="valor"><option value="">Buscar</option></select>')
                    .appendTo( $(column.footer()).empty() )
                    .on( 'change', function () {
                        var val = $.fn.dataTable.util.escapeRegex(
                            $(this).val()
                        );
 
                        column
                            .search( val ? '^'+val+'$' : '', true, false )
                            .draw();
                    } );
 
               column.data().unique().sort().each( function ( d, j ) {
                    var val = $('<span/>').html(d).text();
select.append( '<option value="' + val + '">' + val + '</option>' );
                } );
            } );
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
                    extend: 'pageLength',
                    text: 'Mostrar filas',
                    className: 'orange'
                },
                
                {
                    extend: 'copy',
                    text: 'COPIAR',
                    className: 'red'
                },
                
                
                
                {
                    extend: 'excel',
                    text: 'EXCEL',
                    className: 'green'
                },
                {
                    extend: 'csv',
                    text: 'CSV',
                    className: 'green1'
                },
                {
                    extend: 'print',
                    text: 'IMPRIMIR',
                    className: 'green2'
                }
            ],
        
        "pageLength": 20,
    } );
} );



</script>

 
    

    
  