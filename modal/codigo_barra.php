<?php  
if (isset($con))
{
$sql3="select * from products";
$rs2=mysqli_query($con,$sql3);
/*while($row4=mysqli_fetch_array($rs2)){
    $dolar=$row4["dolar"];
}*/        
?>
<head>

	
</head>
    <body>  
	<!-- Modal -->
	<div class="modal fade" id="myModalBarra" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
		<div class="modal-content estilo-placeholder">
		  <div class="modal-header estilo-placeholder">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Código de Barra</h4>
		  </div>
                    
          <div id="resultados_ajax2"></div>
		  <div class="modal-body" style="height:500px;overflow-y: scroll;">
			<form class="form-horizontal" method="post" id="imprimir_codbar" name="imprimir_codbar">

                 <div class="form-group">
				<label for="mod_nombrebarra" class="col-sm-3 control-label">Nombre</label>
				<div class="col-md-9 col-sm-9 col-xs-12">
				  <input type="hidden" name="mod_idbarra" id="mod_idbarra">

				  <input  type="text" class="form-control estilo-placeholder" id="mod_nombrebarra" name="mod_nombrebarra" placeholder="Nombre del producto" required  maxlength="50">
				</div>
			  </div>
			<div class="form-group">
				<label for="mod_codigobarra" class="col-sm-3 control-label">Código Producto</label>
				<div class="col-md-9 col-sm-9 col-xs-12">
				  <input type="text" class="form-control estilo-placeholder" id="mod_codigobarra" name="mod_codigobarra" placeholder="Código del producto" required  maxlength="10">
				          
				</div>
			</div>
			
            <div class="form-group">
    				<label for="mod_proveedorbarra" class="col-sm-3 control-label">Codigo Proveedor</label>
    		 <div class="col-md-9 col-sm-9 col-xs-12">
              <input type="text"  class="form-control estilo-placeholder" id="mod_proveedorbarra" name="mod_proveedorbarra"  required  maxlength="30">
            </div>
            </div>

            <div class="form-group">
                    <label for="mod_alternativobarra" class="col-sm-3 control-label">Codigo Alternativo</label>
             <div class="col-md-9 col-sm-9 col-xs-12">
              <input type="text"  class="form-control estilo-placeholder" id="mod_alternativobarra" name="mod_alternativobarra"  required  maxlength="50">
            </div>
            </div>


        <div class="form-group">
           <label for="mod_medidabarra" class="col-sm-3 control-label">Medida</label>
            <div class="col-md-9 col-sm-9 col-xs-12">
          <input type="text"  class="form-control estilo-placeholder" id="mod_medidabarra" name="mod_medidabarra"  required  maxlength="50">
        </div>
        </div>


        
       <div class="form-group">
          <label for="mod_detallebarra" class="col-sm-3 control-label">Ubicación</label>
          <div class="col-md-9 col-sm-9 col-xs-12">
          <input type="text"  class="form-control estilo-placeholder" id="mod_detallebarra" name="mod_detallebarra"  required  maxlength="50">
        </div>
        </div>

                      
			
			  <div class="form-group">
				<label for="mod_costobarra" class="col-sm-3 control-label">Costo</label>
				<div class="col-md-9 col-sm-9 col-xs-12">
				  <input type="number" step="any" class="form-control estilo-placeholder"  id="mod_costobarra" name="mod_costobarra" placeholder="Precio de costo del producto" required pattern="^[0-9]{1,5}(\.[0-9]{0,2})?$" title="Ingresa sólo números con 0 ó 2 decimales" maxlength="8" >
				</div>
			</div>
                                
          <div class="form-group">
				<label for="mod_preciobarra" class="col-sm-3 control-label">Precio</label>
				<div class="col-md-9 col-sm-9 col-xs-12">
                     <input  type="number" step="any" class="form-control estilo-placeholder" id="mod_preciobarra" name="mod_preciobarra" placeholder="Precio 1" required pattern="^[0-9]{1,5}(\.[0-9]{0,2})?$" title="Ingresa sólo números con 0 ó 2 decimales" maxlength="8" >
				</div>
			</div>
             

        <div class="form-group">
            <label for="mod_cant_ultimacomprabarra" class="col-sm-3 control-label">Inventario de ultima carga o stock</label>
            <div class="col-md-9 col-sm-9 col-xs-12">
              <input type="number" step="any" class="form-control estilo-placeholder" id="mod_cant_ultimacomprabarra" name="mod_cant_ultimacomprabarra" placeholder="Precio de costo del producto" required pattern="^[0-9]{1,5}(\.[0-9]{0,2})?$" title="Ingresa sólo números con 0 ó 2 decimales" maxlength="8">
            </div>
        </div>

        <div class="form-group">
            <label for="estadobarra" class="col-sm-3 control-label">Estado</label>
            <div class="col-md-9 col-sm-9 col-xs-12">
             <select   class="form-control estilo-placeholder" id="estadobarra" name="estadobarra" required >
                <option value="0">Activo</option>
                <option value="1">Desactivado</option>
              </select>
            </div>
        </div>
			
				  <input type="hidden" name="mod_cbarra" id="mod_cbarra">


        <div class="form-group">
            <label for="estadobarra" class="col-sm-3 control-label">Código de Barra</label>
            <div class="col-md-9 col-sm-9 col-xs-12">
            <img id="b_code" src="libraries/barcode.php?text=01234seW89&size=50&orientation=horizontal&codetype=Code39"/>
            </div>
        </div>

			 
			
                    </div>
		<div class="modal-footer">
			<button type="button" class="btn btn-cancelar" data-dismiss="modal">Cerrar</button>
			<button type="submit" class="btn btn-agregar" id="imprimir_ticket">Imprimir Ticket</button>
		</div>
		</form>
            </div>
	  </div>
</div>
<?php
}
?>
</body>
<script>

    $(document).ready(function(){

        const GetDolarSol=function(){
            if($('#ObtenerSoles').is(":checked")){
                ObtenerSoles();
            }else if($('#ObtenerDolar').is(":checked")){
                ObtenerDolar();
            }
        }




        $('#mod_costo').keyup(function(){
            GetDolarSol();
        });

        $('#ganancia').keyup(function(){
            GetDolarSol();
        });

        const ObtenerTasaDolar=function(valor){
            $.ajax({
                type: "POST",
                url: "Funciones/ConsultarProductos/ConsultarProductos.php?opcion=5",
                dataType: "json",
                success: function(datos){
                    valor(datos[0][0]);
                }
            });
        }


        const CostoXTipoCambio=datar=>{
            ObtenerTasaDolar(function(data){
                $('#tcp').val(data);
                let Ns=(parseFloat($('#mod_costo').val())*parseFloat($('#tcp').val())).toFixed(2);
                $('#ns').val(Ns);
                datar(1);
            });
        }

        const ObtenerPrecio=()=>{
            let mPrecio=((parseFloat($('#ns').val()))+(parseFloat($('#ganancia').val()))).toFixed(2);
                $('#mod_precio').val(mPrecio)

        }

        const ObtenerSoles=function(){
            let mCosto=(parseFloat($('#mod_costo').val())).toFixed(2);
            $('#ns').val(mCosto)
            $('#tcp').val(1)
            ObtenerPrecio();
        }

        $('#ObtenerSoles').click(function () {
            ObtenerSoles();
        });

        const ObtenerDolar=function(){
            CostoXTipoCambio(function (datar) {
                if(datar==1){
                    ObtenerPrecio();
                }
            });
        }

        $('#ObtenerDolar').click(function () {
            ObtenerDolar();
        });



    });
</script>


