		$(document).ready(function(){
			load(1);
			
		});

		function load(page){
			var q= $("#q").val();
			$("#loader").fadeIn('slow');
			$.ajax({
				url:'./ajax/buscar_facturaseliminadas.php?action=ajax&page='+page+'&q='+q,
				 beforeSend: function(objeto){
				 $('#loader').html('<img src="./img/ajax-loader.gif"> Cargando...');
			  },
				success:function(data){
					$(".outer_div").html(data).fadeIn('slow');
					$('#loader').html('');
					$('[data-toggle="tooltip"]').tooltip({html:true}); 
					
				}
			})
		}

	
		
			
		
		function imprimir_factura(id_factura){
			VentanaCentrada('./pdf/documentos/ver_factura.php?id_factura='+id_factura,'Factura','','1024','768','true');
		}

function imprimir_facturas(id_factura){
			VentanaCentrada('./pdf/documentos/ver_factura3.php?id_factura='+id_factura,'Factura','','1024','768','true');
		}
                
                function imprimir_facturas1(id_factura){
			VentanaCentrada('./pdf/documentos/bajaDocumento.php?id_factura='+id_factura,'Factura','','1024','768','true');
		}
                
                function imprimir_facturas2(id_factura){
			VentanaCentrada('./pdf/documentos/baja/'+id_factura,'Documento de baja','','1024','768','true');
		}