<?php
include('is_logged.php'); //Archivo verifica que el usario que intenta acceder a la URL esta logueado
/* Connect To Database*/
require_once("../config/db.php"); //Contiene las variables de configuracion para conectar a la base de datos
require_once("../config/conexion.php"); //Contiene funcion que conecta a la base de datos
$tienda1 = $_SESSION['tienda'];
$action = (isset($_REQUEST['action']) && $_REQUEST['action'] != NULL) ? $_REQUEST['action'] : '';
if (isset($_GET['id'])) {
    $id_cliente = intval($_GET['id']);
    $query = mysqli_query($con, "select * from facturas where id_cliente='" . $id_cliente . "'");
    $count = mysqli_num_rows($query);
    if ($count == 0) {
        if ($delete1 = mysqli_query($con, "DELETE FROM clientes WHERE id_cliente='" . $id_cliente . "'")) {
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
            <strong>Error!</strong> No se pudo eliminar este cliente. Existen documentos vinculadas a este cliente.
        </div>
    <?php
    }
}
if ($action == 'ajax') {
    // escaping, additionally removing everything that could be (html/javascript-) code
    $q = mysqli_real_escape_string($con, (strip_tags($_REQUEST['q'], ENT_QUOTES)));
    $aColumns = array('nombre_cliente', 'doc'); //Columnas de busqueda
    $sTable = "clientes";
    $sWhere = " ";
    include 'pagination.php'; //include pagination file
    //pagination variables
    $page = (isset($_REQUEST['page']) && !empty($_REQUEST['page'])) ? $_REQUEST['page'] : 1;
    $per_page = 10; //how much records you want to show
    $adjacents  = 4; //gap between pages after number of adjacents
    $offset = ($page - 1) * $per_page;
    $count_query   = mysqli_query($con, "SELECT count(*) AS numrows FROM $sTable WHERE tipo1=1 and tienda=$tienda1 ");
    $row = mysqli_fetch_array($count_query);
    $numrows = $row['numrows'];
    $total_pages = ceil($numrows / $per_page);
    $reload = './clientes.php';
    $sql = "SELECT * FROM  $sTable WHERE tipo1=1 and tienda=$tienda1 ";
   // var_dump($sql);
    $query = mysqli_query($con, $sql);
    //loop through fetched data
    if ($numrows > 0) {

    ?>
        <div class="table-responsive">
            <table id="example" class="display nowrap" style="width:100%">
                <tfoot>
                    <!-- <tr>
                        <th class="tr-border-bottom"></th>
                        <th class="tr-border-bottom"><input type="search" class="estilo-placeholder input-fechas-horas-3" placeholder="Razón Social"></th>
                        <th class="tr-border-bottom"><input type="search" class="estilo-placeholder input-fechas-horas-3" placeholder="RUC"></th>
                        <th class="tr-border-bottom"><input type="search" class="estilo-placeholder input-fechas-horas-3" placeholder="DNI"></th>
                        <th class="tr-border-bottom"><input type="search" class="estilo-placeholder input-fechas-horas-3" placeholder="Teléfono"></th>
                        <th class="tr-border-bottom"><input type="search" class="estilo-placeholder input-fechas-horas-3" placeholder="Email"></th>
                        <th class="tr-border-bottom"></th>
                        <th class="tr-border-bottom"></th>
                    </tr> -->
                </tfoot>
                <thead>
                    <tr>
                        <th class="th-general">Nro</th>
                        <th class="th-general">Razon Social</th>
                        <th class="th-general">RUC</th>
                        <th class="th-general">DNI</th>
                        <th class="th-general">Teléfono</th>
                        <th class="th-general">Email</th>
                        <th class="th-general">Estado</th>
                        <th class="th-general">Acciones</th>
                    </tr>
                </thead>
                <?php
                while ($row = mysqli_fetch_array($query)) {
                    $id_cliente = $row['id_cliente'];
                    $nombre_cliente = $row['nombre_cliente'];
                    $telefono_cliente = $row['telefono_cliente'];
                    $email_cliente = $row['email_cliente'];
                    $direccion_cliente = $row['direccion_cliente'];
                    $doc = $row['doc'];
                    $dni = $row['dni'];
                    $departamento = $row['departamento'];
                    $provincia = $row['provincia'];
                    $distrito = $row['distrito'];
                    $cuenta = $row['cuenta'];

                    $prct_desc = $row['prct_desc'];
                    $id_sucursal_cliente = $row['sucursal'];
                    $ver_codigo = $row['ver_codigo'];


                    $vendedor = $row['vendedor'];
                    $status_cliente = $row['status_cliente'];
                    if ($status_cliente == 1) {
                        $estado = "Activo";
                    } else {
                        $estado = "Inactivo";
                    }
                    $date_added = date('d/m/Y', strtotime($row['date_added']));

                    $sqltraerdatosusuario = "SELECT * FROM users where estado = 1 and id_cliente=$id_cliente ";
                    $sqlparatraercount = "SELECT count(*) AS numrows FROM users where estado = 1 and id_cliente=$id_cliente ";
                    
                    $count_query_datausuario   = mysqli_query($con, $sqlparatraercount);
                    $row_datausuario = mysqli_fetch_array($count_query_datausuario);
                    $numrows_datausuario = $row_datausuario['numrows'];



   // var_dump($sql);
                    $querydatosusuarios = mysqli_query($con, $sqltraerdatosusuario);
                    while ($rowdatosusuario = mysqli_fetch_array($querydatosusuarios)) {
                        $user_name = $rowdatosusuario['user_name'];
                        $clave = $rowdatosusuario['clave'];
                         if ($numrows_datausuario > 0) { ?> 
                            <tr>
                            <input type="hidden" value="<?php echo $user_name; ?>" id="user_name<?php echo $id_cliente; ?>">
                            <input type="hidden" value="<?php echo $clave; ?>" id="clave<?php echo $id_cliente; ?>">
                            </tr>
                       <?php   }else{ ?>
                        <tr>
                            <input type="hidden" value="" id="user_name<?php echo $id_cliente; ?>">
                            <input type="hidden" value="" id="clave<?php echo $id_cliente; ?>">
</tr>
                         <?php }

                     ?> 
                    
                    <?php }

                ?>
                    <tr id="valor1">
                        <input type="hidden" value="<?php echo $nombre_cliente; ?>" id="nombre_cliente<?php echo $id_cliente; ?>">
                        <input type="hidden" value="<?php echo $telefono_cliente; ?>" id="telefono_cliente<?php echo $id_cliente; ?>">
                        <input type="hidden" value="<?php echo $prct_desc; ?>" id="prct_desc<?php echo $id_cliente; ?>">
                        <input type="hidden" value="<?php echo $id_sucursal_cliente; ?>" id="id_sucursal_cliente<?php echo $id_cliente; ?>">
                        <input type="hidden" value="<?php echo $ver_codigo; ?>" id="ver_codigo<?php echo $id_cliente; ?>">
                        <input type="hidden" value="<?php echo $email_cliente; ?>" id="email_cliente<?php echo $id_cliente; ?>">
                        <input type="hidden" value="<?php echo $doc; ?>" id="doc<?php echo $id_cliente; ?>">
                        <input type="hidden" value="<?php echo $vendedor; ?>" id="vendedor<?php echo $id_cliente; ?>">
                        <input type="hidden" value="<?php echo $direccion_cliente; ?>" id="direccion_cliente<?php echo $id_cliente; ?>">
                        <input type="hidden" value="<?php echo $status_cliente; ?>" id="status_cliente<?php echo $id_cliente; ?>">
                        <input type="hidden" value="<?php echo $dni; ?>" id="dni<?php echo $id_cliente; ?>">
                        <input type="hidden" value="<?php echo $departamento; ?>" id="departamento<?php echo $id_cliente; ?>">
                        <input type="hidden" value="<?php echo $provincia; ?>" id="provincia<?php echo $id_cliente; ?>">
                        <input type="hidden" value="<?php echo $distrito; ?>" id="distrito<?php echo $id_cliente; ?>">
                        <input type="hidden" value="<?php echo $cuenta; ?>" id="cuenta<?php echo $id_cliente; ?>">
                        <td class="th-general">
                            <?php echo $numrows; ?>
                        </td>
                        <td class="th-general"><?php echo $nombre_cliente; ?></td>
                        <td class="th-general"><?php echo $doc; ?></td>
                        <td class="th-general"><?php echo $dni; ?></td>
                        <td class="th-general"><?php echo $telefono_cliente; ?></td>
                        <td class="th-general"><?php echo $email_cliente; ?></td>
                        <td class="th-general"><?php echo $estado; ?></td>
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

<style>
    div.dataTables_wrapper div.dataTables_filter label {
    font-weight: normal;
    white-space: nowrap;
    text-align: left;
    margin 4px 4px 4px 4px;
    }    
</style>

<script>
    $(document).ready(function() {
        $('#example tfoot th').each(function() {
            var title = $(this).text();

            if (title == "DNI" || title == "RUC" || title == "Razon Social" || title == "Telefono" || title == "Email" || title == "Agregado")
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
