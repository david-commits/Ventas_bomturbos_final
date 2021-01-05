<?php
include('is_logged.php'); //Archivo verifica que el usario que intenta acceder a la URL esta logueado
/* Connect To Database*/
require_once("../config/db.php"); //Contiene las variables de configuracion para conectar a la base de datos
require_once("../config/conexion.php"); //Contiene funcion que conecta a la base de datos
$tienda1 = $_SESSION['tienda'];
$action = (isset($_REQUEST['action']) && $_REQUEST['action'] != NULL) ? $_REQUEST['action'] : '';
if (isset($_GET['id'])) {
    $id_proveedores = intval($_GET['id']);
    $query = mysqli_query($con, "select * from facturas where id_proveedor='" . $id_proveedores . "'");
    $count = mysqli_num_rows($query);

    if ($count == 0) {
        if ($delete1 = mysqli_query($con, "DELETE FROM proveedores WHERE id_proveedores='" . $id_proveedores . "'")) {
?>
            <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <strong>Aviso!</strong> Datos eliminados exitosamente.
            </div>
        <?php
        } else {
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
            <strong>Error!</strong> No se pudo eliminar ésta Proveedor.Existen documentos vinculadas a este proveedor.
        </div>
    <?php
    }
}
if ($action == 'ajax') {
    // escaping, additionally removing everything that could be (html/javascript-) code
    //$q = mysqli_real_escape_string($con,(strip_tags($_REQUEST['q'], ENT_QUOTES)));
    //$aColumns = array('nombre_cliente','doc');//Columnas de busqueda
    $sTable = "proveedores";
    echo "<script>console.log('traemos los datoss');</script>";
    include 'pagination.php'; //include pagination file
    //pagination variables
    $page = (isset($_REQUEST['page']) && !empty($_REQUEST['page'])) ? $_REQUEST['page'] : 1;
    $per_page = 10; //how much records you want to show
    $adjacents  = 4; //gap between pages after number of adjacents
    $offset = ($page - 1) * $per_page;
    //Count the total number of row in your table*/
    $count_query   = mysqli_query($con, "SELECT count(*) AS numrows FROM $sTable ");
    $row = mysqli_fetch_array($count_query);
    $numrows = $row['numrows'];
    $total_pages = ceil($numrows / $per_page);
    $reload = './proveedores.php';
    //main query to fetch the data
    $sql = "SELECT * FROM  $sTable ";
    $query = mysqli_query($con, $sql);
    //loop through fetched data
    if ($numrows > 0) {
    ?>
        <div class="table-responsive">
            <table id="example" class="display nowrap" style="width:100%">
                <tfoot>
                    <!-- <tr>
                        <th class="tr-border-bottom">Nro</th>
                        <th class="tr-border-bottom"><input type="search" class="estilo-placeholder input-fechas-horas-3" placeholder="Razón Social"></th>
                        <th class="tr-border-bottom"><input type="search" class="estilo-placeholder input-fechas-horas-3" placeholder="RUC"></th>
                        <th class="tr-border-bottom"><input type="search" class="estilo-placeholder input-fechas-horas-3" placeholder="Teléfono"></th>
                        <th class="tr-border-bottom"><input type="search" class="estilo-placeholder input-fechas-horas-3" placeholder="Email"></th>
                        <th class="tr-border-bottom"></th>
                        <th class="tr-border-bottom"></th>
                        <th class="tr-border-bottom"></th>
                    </tr> -->
                </tfoot>
                <thead>
                    <tr>
                        <th class="th-general">Nro.</th>
                        <th class="th-general">Razón Social</th>
                        <th class="th-general">RUC</th>
                        <!--<th>DNI</th>-->
                        <th class="th-general">Teléfono</th>
                        <th class="th-general">Email</th>
                        <th class="th-general">Estado</th>
                        <th class="th-general">Código Proveedor</th>
                        <th  class="th-general">Acciones</th>
                    </tr>
                </thead>
                <?php
                while ($row = mysqli_fetch_array($query)) {
                    $id_cliente = $row['id_proveedores'];
                    $nombre_cliente = $row['nom_pro'];
                    $telefono_cliente = $row['tel_pro'];
                    $email_cliente = $row['email_provedor'];
                    $direccion_cliente = $row['dir_pro'];
                    $doc = $row['ruc_pro'];
                    //$dni=$row['ruc_pro'];
                    $departamento = $row['departamento'];
                    $provincia = $row['provincia'];
                    $distrito = $row['distrito'];
                    $cuenta = $row['cuenta_ban'];

                    $vendedor = $row['vendedor'];
                    $status_cliente = $row['status_proveedor'];
                    $codigo_del_proveedor = $row['codigoProveedor'];
                    if ($status_cliente == 1) {
                        $estado = "Activo";
                    } else {
                        $estado = "Inactivo";
                    }
                    $date_added = date('d/m/Y', strtotime($row['date_added']));
                ?>
                    <tr id="valor1">
                        <input type="hidden" value="<?php echo $nombre_cliente; ?>" id="nombre_cliente<?php echo $id_cliente; ?>">
                        <input type="hidden" value="<?php echo $telefono_cliente; ?>" id="telefono_cliente<?php echo $id_cliente; ?>">
                        <input type="hidden" value="<?php echo $email_cliente; ?>" id="email_cliente<?php echo $id_cliente; ?>">
                        <input type="hidden" value="<?php echo $doc; ?>" id="doc<?php echo $id_cliente; ?>">
                        <input type="hidden" value="<?php echo $vendedor; ?>" id="vendedor<?php echo $id_cliente; ?>">
                        <input type="hidden" value="<?php echo $direccion_cliente; ?>" id="direccion_cliente<?php echo $id_cliente; ?>">
                        <input type="hidden" value="<?php echo $status_cliente; ?>" id="status_cliente<?php echo $id_cliente; ?>">
                        <!--<input type="hidden" value="<?php echo $dni; ?>" id="dni<?php echo $id_cliente; ?>">-->
                        <input type="hidden" value="<?php echo $departamento; ?>" id="departamento<?php echo $id_cliente; ?>">
                        <input type="hidden" value="<?php echo $provincia; ?>" id="provincia<?php echo $id_cliente; ?>">
                        <input type="hidden" value="<?php echo $distrito; ?>" id="distrito<?php echo $id_cliente; ?>">
                        <input type="hidden" value="<?php echo $cuenta; ?>" id="cuenta<?php echo $id_cliente; ?>">
                        <input type="hidden" value="<?php echo $codigo_del_proveedor; ?>" id="codprove<?php echo $id_cliente; ?>">
                        <td class="th-general">
                            <?php echo $numrows; ?>
                        </td>
                        <td class="th-general"><?php echo $nombre_cliente; ?></td>
                        <td class="th-general"><?php echo $doc; ?></td>
                        <!--  <td ><?php echo $dni; ?></td>-->
                        <td class="th-general"><?php echo $telefono_cliente; ?></td>
                        <td class="th-general"><?php echo $email_cliente; ?></td>
                        <td class="th-general"><?php echo $estado; ?></td>
                        <td class="th-general"><?php echo $codigo_del_proveedor; ?></td>
                        <td class="th-general">
                            <span>
                                <a href="#" class='btn btn-cancelar btn-xs' title='Borrar cliente' onclick="eliminar('<?php echo $id_cliente; ?>')"><i class="glyphicon glyphicon-trash"></i></a>
                                <a href="#" class='btn btn-guardar btn-xs' title='Editar cliente' onclick="obtener_datos('<?php echo $id_cliente; ?>');" data-toggle="modal" data-target="#myModal2"><i class="glyphicon glyphicon-edit"></i></a>
                            </span>
                        </td>
                    </tr>
                <?php
                    $numrows = $numrows - 1;
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
        $('#example tfoot th').each(function() {
            var title = $(this).text();

            if (title == "RUC" || title == "DNI" || title == "Razon Social" || title == "Telefono" || title == "Email" || title == "Agregado")
                $(this).html('<input type="text" placeholder="' + title + '" />');
        });

        // DataTable
        var table = $('#example').DataTable();



        // Apply the search
        table.columns().every(function() {
            var that = this;

            $('input', this.footer()).on('keyup change', function() {
                if (that.search() !== this.value) {
                    that
                        .search(this.value)
                        .draw();
                }
            });           
        });


        $('#example').DataTable({
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
                [10, 25, 50, -1],
                ['10 filas', '25 filas', '50 filas', 'Mostrar todo']
            ],
            buttons:


                [

                    // {
                    //     extend: 'colvis',
                    //     text: 'Mostrar Columnas',
                    //     className: 'green2',
                    //     exportOptions: {
                    //         columns: ':visible'
                    //     }

                    // },

                    // {
                    //     extend: 'pageLength',
                    //     text: 'Mostrar Filas',
                    //     className: 'orange',
                    //     exportOptions: {
                    //         columns: ':visible'
                    //     }

                    // },

                    // {
                    //     extend: 'copy',
                    //     text: 'Copiar',
                    //     className: 'red',
                    //     exportOptions: {
                    //         columns: ':visible'
                    //     }
                    // },



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
                    //         columns: ':visible'
                    //     }
                    // },
                    // {
                    //     extend: 'print',
                    //     text: 'Imprimir',
                    //     className: 'green2',
                    //     exportOptions: {
                    //         columns: ':visible'
                    //     }
                    // },
                ],
            "pageLength": 20,

        });
    });
</script>