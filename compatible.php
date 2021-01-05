<?php
session_start();  
include('menu.php');
require_once ("config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
require_once ("config/conexion.php");
$sql1="select * from users where user_id=$_SESSION[user_id]";
$rw1=mysqli_query($con,$sql1);//recuperando el registro
$rs1=mysqli_fetch_array($rw1);//trasformar el registro en un vector asociativo
$modulo=$rs1["accesos"];
$a = explode(".", $modulo); 
if (!isset($_SESSION['user_login_status']) AND $_SESSION['user_login_status'] != 1) {
    header("location: login.php");
    exit;
}
if($a[17]==0){
    header("location:error.php");    
}	
?>
<!DOCTYPE html>
<html lang="es">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Sistema de Ventas</title>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="fonts/css/font-awesome.min.css" rel="stylesheet">
	<link href="css/animate.min.css" rel="stylesheet">
	<link href="css/custom.css" rel="stylesheet">
	<link href="css/icheck/flat/green.css" rel="stylesheet">
	<link rel="icon" href="images/usuario16.jpg">
	<script src="js/jquery.min.js"></script>
	<script type="text/javascript" src="https://code.jquery.com/jquery-1.12.4.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.min.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.colVis.min.js"></script>
	<link href="https://cdn.datatables.net/buttons/1.5.1/css/buttons.dataTables.min.css" rel="stylesheet">
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.1/js/dataTables.responsive.min.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.min.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.colVis.min.js"></script>
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css" />
	<script type="text/javascript" src="Buttons/js/buttons.flash.min.js"></script>
	<script type="text/javascript" src="Buttons/js/dataTables.buttons.min.js"></script>
	<script type="text/javascript" src="Buttons/js/buttons.html5.min.js"></script>
	<script type="text/javascript" src="Buttons/js/buttons.print.min.js"></script>
	<link href="https://fonts.googleapis.com/css?family=Quicksand:300,400,500,600,700&display=swap" rel="stylesheet">
</head>
<body class="nav-md">

  <div class="container body">
    <div class="main_container">

      <div class="col-md-3 left_col">
        <div class="left_col scroll-view">
            <div class="clearfix"></div>

          <!-- menu prile quick info -->
            <?php
            menu2();
          
        
            menu1();
          
          ?>
     
        </div>
      </div>
        <?php
          menu3();
          
          ?>
      
      <div class="right_col" role="main">
        <div class="">
          <div class="page-title">
            <div class="title_left">
              
            </div>

            
          </div>
          <div class="clearfix"></div>

          <div class="row">

           <div class="container">
            <div class="panel panel-info">
		<div class="panel-heading">
									<div class="btn-group pull-right">
										<button type='button' onclick="limpiarFormulario()" class="btn btn-header" data-toggle="modal" data-target="#nuevoProductoCompatible"><span class="glyphicon glyphicon-plus"></span> Nuevo Producto Compatible</button>
									</div>
									<h4>Productos Compatibles</h4>
								</div>
		<div class="panel-body">
		<?php
                include("modal/nuevo_productoCompatible.php");
                include("modal/editar_compatible.php");
		        //include("modal/editar_proveedores.php");
                ?>
			
		<div id="resultados"></div><!-- Carga los datos ajax -->
                <div class='outer_div'></div><!-- Carga los datos ajax -->
		
                </div>
            </div>
            </div>
       </div>
  </div>
        <?php
          footer();
          
          ?>
      </div>
      
    </div>

  </div>

  <div id="custom_notifications" class="custom-notifications dsp_none">
    <ul class="list-unstyled notifications clearfix" data-tabbed_notifications="notif-group">
    </ul>
    <div class="clearfix"></div>
    <div id="notif-group" class="tabbed_notifications"></div>
  </div>

  <script src="js/bootstrap.min.js"></script>

  <!-- bootstrap progress js -->
  <script src="js/progressbar/bootstrap-progressbar.min.js"></script>
  <script src="js/nicescroll/jquery.nicescroll.min.js"></script>
  <!-- icheck -->
  <script src="js/icheck/icheck.min.js"></script>

  <script src="js/custom.js"></script>

  <!-- pace -->
 <script src="js/pace/pace.min.js"></script>
 

<script>
        $(document).ready(function(){
			load(1);
		});

		function load(page){
			var q= $("#q").val();
			$("#loader").fadeIn('slow');
			$.ajax({
				url:'./ajax/buscar_productoCompatible.php?action=ajax&page='+page+'&q='+q,
				 beforeSend: function(objeto){
				 $('#loader').html('<img src="./img/ajax-loader.gif"> Cargando...');
			  },
				success:function(data){
					$(".outer_div").html(data).fadeIn('slow');
					$('#loader').html('');
					
				}
			})
		}


		function eliminar (id)
		{
			var q= $("#q").val();
			if (confirm("Realmente deseas eliminar el proveedor")){

				$.ajax({
                	type: "GET",
                	url: "./ajax/buscar_productoCompatible.php",
                	data: "id="+id,"q":q,
		 			beforeSend: function(objeto){
						$("#resultados").html("Mensaje: Cargando...");
		  			},
                	success: function(datos){
						$("#resultados").html(datos);
						load(1);
					}
				});
			}
		}

$( "#guardar_productoCompatible" ).submit(function( event ) {
$('#guardar_datos').attr("disabled", true);

 var parametros = $(this).serialize();
	 $.ajax({
			type: "POST",
			url: "ajax/nuevoProductoCompatible.php",
			data: parametros,
			 beforeSend: function(objeto){
				$("#resultados_ajax").html("Mensaje: Cargando...");
			  },
			success: function(datos){
			$("#resultados_ajax").html(datos);
			$('#guardar_datos').attr("disabled", false);
			limpiarFormulario();
			load(1);
		  }
	});
  event.preventDefault();
})



$( "#actualizar_dato_compatibilidad" ).submit(function( event ) {
  $('#guardar_datos_c').attr("disabled", true);

 var parametros = $(this).serialize();

	 $.ajax({
			type: "POST",
			url: "ajax/editar_compatible.php",
			data: parametros,
			success: function(datos){
			$('#guardar_datos_c').attr("disabled", false);
			$("#resultados_ajax2").html(datos);
			load(1);
		  }
	});
  event.preventDefault();
});

	function obtener_datos(id){
	
		var idcompac = $("#id_compatible"+id).val();
        var idvehic = $("#id_vehiculo"+id).val();
        var idmarcave = $("#id_marcavehiculo"+id).val();
        var idmodelovec = $("#id_modelovehiculo"+id).val();
		var idproduc = $("#id_producto"+id).val();
		var idmotorvec = $("#motor"+id).val();
        $("#mod_idcompac").val(idcompac);
        $("#mod_idvec").val(idvehic);
        $("#mod_idmarca").val(idmarcave);
        $("#mod_idmodel").val(idmodelovec);
		$("#mod_idproduc").val(idproduc);
		$("#mod_idmotor").val(idmotorvec);
	}
     
        </script>

</body>

</html>
