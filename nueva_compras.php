<?php
session_start();
require_once("config/db.php"); //Contiene las variables de configuracion para conectar a la base de datos
require_once("config/conexion.php"); //Contiene funcion que conecta a la base de datos       
include('menu.php');
$sql1 = "select * from users where user_id=$_SESSION[user_id]";
$rw1 = mysqli_query($con, $sql1); //recuperando el registro
$rs1 = mysqli_fetch_array($rw1); //trasformar el registro en un vector asociativo
$modulo = $rs1["accesos"];
$sql2 = "select * from datosempresa where id_emp=1";
$rw2 = mysqli_query($con, $sql2); //recuperando el registro
$rs2 = mysqli_fetch_array($rw2); //trasformar el registro en un vector asociativo
$dolar = $rs2["dolar"];
$a = explode(".", $modulo);
if (!isset($_SESSION['user_login_status']) and $_SESSION['user_login_status'] != 1) {
	header("location: login.php");
	exit;
}
if ($a[33] == 0) {
	header("location:error.php");
}
?>


<!DOCTYPE html>
<html lang="es">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<!-- Meta, title, CSS, favicons, etc. -->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Sistema de Ventas</title>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="fonts/css/font-awesome.min.css" rel="stylesheet">
	<link href="css/animate.min.css" rel="stylesheet">
	<link rel="icon" href="images/usuario16.jpg">
	<!-- Custom styling plus plugins -->
	<link href="css/custom.css" rel="stylesheet">
	<link href="css/icheck/flat/green.css" rel="stylesheet">
	<script src="js/jquery.min.js"></script>
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

			<!-- top navigation -->
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

					<!--<div class="btn-group">
						<button type="button" class="btn btn-guardar">Tipo de documento</button>
						<button type="button" class="btn btn-guardar dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
							<span class="caret"></span>
						</button>
						<ul class="dropdown-menu" role="menu" class="custom-select">
							<li><a href="doc.php?accion=1&tipo=2" class="custom-select">Factura</a>
							</li>
							<li><a href="doc.php?accion=2&tipo=2" class="custom-select">Boleta</a>
							</li>
						</ul>
					</div>-->

					<br>
					<br>

					<div class="container">
						<div class="panel panel-info">
							<div class="panel-heading flex align-items-center justify-content-rigth">
								<?php

								if ($_SESSION['doc_ventas'] == 1) {
									$doc = "Factura";
// echo "<script>console.log('aaaaaaa');</script>";
								}
								elseif ($_SESSION['doc_ventas'] == 2) {
									$doc = "Boleta";
// echo "<script>console.log('bbbbbbbb');</script>";
								
								}
								else
								{
// echo "<script>console.log('ccccccccc');</script>";
									
									$doc = "Boleta";
								}
								?>



								<!---<h4>Nueva <?php echo "$doc"; ?> - Compra</h4>-->
								<h4 class="mr-3">Nuevo Documento de Compra</h4> 

									<!-- <div class="btn-group">
										<button type="button" class="btn btn-guardar"><h4><?php echo "$doc"; ?></h4></button>
										<button type="button" class="btn btn-guardar dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
											<span class="caret"></span>
										</button>
										<ul class="dropdown-menu" role="menu" class="custom-select">
											<li><a href="doc.php?accion=1&tipo=2" class="custom-select">Factura</a>
											</li>
											<li><a href="doc.php?accion=2&tipo=2" class="custom-select">Boleta</a>
											</li>
										</ul>
									</div> -->

								<div class="dropdown">
								  <button class="btn btn-limpiar dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" role="menu" style="color: #2c2c2c !important">
								    <?php echo "$doc"; ?>
								    <span class="caret"></span>
								  </button>
								  <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
									<li><a href="doc.php?accion=1&tipo=2" class="custom-select">Factura</a></li>
									<li><a href="doc.php?accion=2&tipo=2" class="custom-select">Boleta</a></li>
								  </ul>
								</div>	
					
							</div>
							<div class="panel-body">
								<?php
								include("modal/buscar_productos.php");
								include("modal/registro_productos.php");
								include("modal/registro_proveedores.php");

								?>
								<form class="form-horizontal" role="form" id="datos_factura" action="compras.php">

									<span class="campos-obligatorios">LLenar los Campos Obligatorios (*)</span>
									<br>
									<br>

									<div class="form-group row">
										<div class="col-md-4 col-sm-4 col-xs-12 separador-compras separador">
											Proveedor (*):
											<input type="text" class="form-control estilo-placeholder input-sm" id="nombre_proveedores" placeholder="Selecciona un proveedor" required>
											<input id="id_proveedores" type='hidden' class="custom-select">
										</div>

										<div class="col-md-4 col-sm-4 col-xs-12 separador-compras">
											Nro. Documento (*):
											<input type="text" class="form-control estilo-placeholder input-sm" id="factura" placeholder="Número de doc" required maxlength="8">
										</div>

										<input type="hidden" class="form-control input-sm" id="ot" value="0">

										<div class="col-md-4 col-sm-4 col-xs-12 separador-compras">
											Teléfono:
											<input type="tel" class="form-control estilo-placeholder input-sm" id="tel1" placeholder="Teléfono" readonly maxlength="9">
										</div>

										<div class="col-md-4 col-sm-4 col-xs-12 separador-compras">
											Email:
											<input type="email" class="form-control estilo-placeholder input-sm" id="mail" placeholder="Email" readonly>
										</div>

										<?php date_default_timezone_set('America/Lima'); ?>
										<div class="col-md-4 col-sm-4 col-xs-12 separador-compras">
											Fecha (*):
											<input type="date" class="form-control estilo-placeholder input-sm input-fechas-horas" id="fecha" value="<?php echo date("Y-m-d"); ?>" required>
										</div>

										<div class="col-md-4 col-sm-4 col-xs-12 separador-compras">
											Hora (*):
											<input type="time" class="form-control estilo-placeholder input-sm input-fechas-horas" id="hora" value="<?php echo date("H:i:s"); ?>" required>
										</div>

										<input type="hidden" class="form-control input-sm" value="<?php echo 1; ?>" name="moneda" id="moneda" required>
										<input type="hidden" class="form-control input-sm" value="<?php echo $dolar; ?>" name="tcp" id="tcp" required>

										<div class="col-md-4 col-sm-4 col-xs-12 separador-compras">
											Pago (*):
											<select class='form-control estilo-placeholder input-sm' id="condiciones">
												<option class="custom-select" value="1">Efectivo</option>
												<option class="custom-select" value="2">Cheque</option>
												<option class="custom-select" value="3">Transferencia bancaria</option>
												<option class="custom-select" value="4">Crédito</option>
											</select>
										</div>

										<div class="col-md-4 col-sm-4 col-xs-12 separador-compras">
											Nro. Días (*):
											<input type="text" value="0" class="form-control estilo-placeholder input-sm" id="dias" name="dias" placeholder="Número de Días de Crédito">
										</div>

										<div class="col-md-4 col-sm-4 col-xs-12 separador-compras">
											Fecha de Emisión (*):
											<input type="date" class="form-control estilo-placeholder input-sm input-fechas-horas" id="fecha_emision" value="<?php echo date("Y-m-d"); ?>" required>
										</div>
									</div>


									<div class="col-md-12">
										<div class="pull-right">
											<button type="button" class="btn btn-guardar" data-toggle="modal" onclick="setearForm()" data-target="#nuevoProducto">
												<span class="glyphicon glyphicon-plus"></span> Nuevo Producto
											</button>
											<button type="button" class="btn btn-guardar" data-toggle="modal" data-target="#nuevoProveedores">
												<span class="glyphicon glyphicon-user"></span> Nuevo Proveedor
											</button>
											<button id="id_nuevacompra" type="button" class="btn btn-agregar" data-toggle="modal" data-target="#myModal">
												<span class="glyphicon glyphicon-search"></span> Agregar Productos
											</button>
											<button type="submit" class="btn btn-guardar">
												<span class="glyphicon glyphicon-print"></span> Imprimir
											</button>
										</div>
									</div>
								</form>

								<div id="resultados" class='col-md-12' style="margin-top:10px"></div><!-- Carga los datos ajax -->
							</div>
						</div>
						<div class="row-fluid">
							<div class="col-md-12">




							</div>
						</div>
					</div>

				</div>
			</div>

			<!-- footer content -->

			<!-- /footer content -->

		</div>
		<!-- /page content -->
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


	<script type="text/javascript" src="js/VentanaCentrada.js"></script>

	<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
	<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
	<script>
		$(function() {
			$("#nombre_proveedores").autocomplete({
				source: "./ajax/autocomplete/proveedores.php",
				minLength: 1,
				select: function(event, ui) {
					event.preventDefault();
					$('#id_proveedores').val(ui.item.id_proveedores);
					$('#nombre_proveedores').val(ui.item.nombre_proveedores);
					$('#tel1').val(ui.item.telefono_proveedores);
					$('#mail').val(ui.item.email_proveedores);


				}
			});


		});

		$("#nombre_proveedores").on("keydown", function(event) {
			if (event.keyCode == $.ui.keyCode.LEFT || event.keyCode == $.ui.keyCode.RIGHT || event.keyCode == $.ui.keyCode.UP || event.keyCode == $.ui.keyCode.DOWN || event.keyCode == $.ui.keyCode.DELETE || event.keyCode == $.ui.keyCode.BACKSPACE) {
				$("#id_proveedores").val("");
				$("#tel1").val("");
				$("#mail").val("");

			}
			if (event.keyCode == $.ui.keyCode.DELETE) {
				$("#nombre_proveedores").val("");
				$("#id_proveedores").val("");
				$("#tel1").val("");
				$("#mail").val("");
			}
		});






		$(document).ready(function() {
			load(1);
		});

		$("#id_nuevacompra").click(function() {
			document.getElementById("cabecera_modal").innerHTML = "";
			document.getElementById("cabecera_modal").innerHTML = "COMPRAS";
		});



		function load(page) {
			console.log("pasamos a esta parte");
			var q = $("#q").val();
			var q1 = $("#marca_m").val();
			var q2 = $("#modelo_m").val();
			$("#loader").fadeIn('slow');
			$.ajax({
				url: './ajax/productos_compras.php?action=ajax&page=' + page + '&q=' + q + '&q1=' + q1 + '&q2=' + q2,
				beforeSend: function(objeto) {
					$('#loader').html('<img src="./img/ajax-loader.gif"> Cargando...');
				},
				success: function(data) {
					$(".outer_div").html(data).fadeIn('slow');
					$('#loader').html('');

				}
			})
		}

		function setearForm() {
			$("#nombre").val('');
			$("#cat_pro").val(0);
			$("#estado").val(0);
			$("#marca").val(0);
			$("#codigoProducto").val('');
			$("#codigoProveedor").val('');
			$("#codigoAlternativo").val('');
			$("#medida").val('');
			$("#costo").val('');
			$("#resultado").val('');
			$("#uti").val('');
			$("#precio").val('');
			$("#inventario").val(0);

		}

		function agregar(id) {
			var precio_venta = document.getElementById('precio_venta_' + id).value;
			var cantidad = document.getElementById('cantidad_' + id).value;
			var stock = document.getElementById('stock_' + id).value;
			//Inicia validacion
			if (precio_venta <= 0) {
				alert('Ingrese un precio');
				//document.getElementById('cantidad_' + id).focus();
				return false;
			}

			if (isNaN(cantidad) || cantidad < 0 || cantidad == '') {
				alert('Ingrese una cantidad adecuada.');
				//document.getElementById('cantidad_' + id).focus();
				return false;
			}

			document.getElementById(id).style.color = "red";

			//Fin validacion

			$.ajax({
				type: "POST",
				url: "./ajax/agregar_compras.php",
				data: "id=" + id + "&precio_venta=" + precio_venta + "&cantidad=" + cantidad + "&stock=" + stock,
				beforeSend: function(objeto) {
					$("#resultados").html("Mensaje: Cargando...");
				},
				success: function(datos) {
					$("#resultados").html(datos);
				}
			});




		}

		function eliminar(id) {

			$.ajax({
				type: "GET",
				url: "./ajax/agregar_compras.php",
				data: "id=" + id,
				beforeSend: function(objeto) {
					$("#resultados").html("Mensaje: Cargando...");
				},
				success: function(datos) {
					$("#resultados").html(datos);
				}
			});

		}

		$("#datos_factura").submit(function() {
			var id_proveedores = $("#id_proveedores").val();
			var id_vendedor = $("#id_vendedor").val();
			var condiciones = $("#condiciones").val();
			var factura = $("#factura").val();
			console.log(factura);
			var moneda = $("#moneda").val();
			var fecha = $("#fecha").val();
			var fechaemision = $("#fecha_emision").val();
			var hora = $("#hora").val();
			var ot = $("#ot").val();
			var tcp = $("#tcp").val();
			var dias = $("#dias").val();

			if (id_proveedores == "") {
				alert("Debes seleccionar un proveedor");
				$("#nombre_proveedores").focus();
				return false;
			}
			/*
					  		$.ajax({
					         type: "POST",
					         url: "./ajax/agregar_compras.php",
					         data: "id="+id+"&precio_venta="+precio_venta+"&cantidad="+cantidad+"&stock="+stock,
					 			beforeSend: function(objeto){
									$("#resultados").html("Mensaje: Cargando...");
					 			},
			        			success: function(datos){
									$("#resultados").html(datos);
								}
							});



			$.ajax({
								type: "POST",
								url: "pdf/documentos/factura1_pdf.php",
								data: "id_proveedores="+id_proveedores+"&id_vendedor="+id_vendedor+"&factura="+factura+"&moneda="+moneda+"&condiciones="+condiciones+"&fecha="+fecha+"&fechaemision="+fechaemision+"&hora="+hora+"&dias="+dias+"&tcp="+tcp+"&factura"+factura+"1024"+"768"+"true",
								success: function(datos){
									alert('Registro completado');
								$("#resultados_ajax_productos").html(datos);
								$('#guardar_datos').attr("disabled", false);
								load(1);
							  }
						});

			*/
			VentanaCentrada('./pdf/documentos/factura1_pdf.php?id_proveedores=' + id_proveedores + '&id_vendedor=' + id_vendedor + '&factura=' + factura + '&moneda=' + moneda + '&condiciones=' + condiciones + '&fecha=' + fecha + '&fechaemision=' + fechaemision + '&hora=' + hora + '&dias=' + dias + '&tcp=' + tcp + '&factura' + factura + '1024', '768', 'true');



		});

		$("#guardar_proveedores").submit(function(event) {
			$('#guardar_datos').attr("disabled", true);

			var parametros = $(this).serialize();
			$.ajax({
				type: "POST",
				url: "ajax/nuevo_proveedores.php",
				data: parametros,
				beforeSend: function(objeto) {
					$("#resultados_ajax").html("Mensaje: Cargando...");
				},
				success: function(datos) {
					$("#resultados_ajax").html(datos);
					$('#guardar_datos').attr("disabled", false);
					limpiarNuevoFormulario();
					load(1);
				}
			});
			event.preventDefault();
		})

		$("#guardar_producto").submit(function(event) {
			$('#guardar_datos').attr("disabled", true);

			var parametros = $(this).serialize();
			$.ajax({
				type: "POST",
				url: "ajax/nuevo_producto.php",
				data: parametros,
				beforeSend: function(objeto) {
					$("#resultados_ajax_productos").html("Mensaje: Cargando...");
				},
				success: function(datos) {
					$("#resultados_ajax_productos").html(datos);
					$('#guardar_datos').attr("disabled", false);
					limpiarNuevoFormulario();
					load(1);
				}
			});
			event.preventDefault();
		})
	</script>

</body>

</html>