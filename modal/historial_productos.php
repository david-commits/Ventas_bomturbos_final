<!-- <style type="text/css">
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

</style> -->
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
	<div class="modal fade" id="myModal21" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
            <h4 class="modal-title">Historial de Precios del Producto</h4>
          </div>


          <input type="hidden" name="obtenemoselid" id="obtenemoselid">
                    
                    <div id="resultados_ajax2"></div>
        <div class="modal-body" style="height:430px;overflow-y: scroll;">
                            <input type="hidden" id="aidi" name="aidi">      
            <!--<form class="form-horizontal" method="post" id="" name="">
                <div class="form-group">

                        <div class="col-md-3 col-sm-3">
                            <button type="button" class="btn btn-default" onclick="loading1(1)"><span class='glyphicon glyphicon-search'></span> Buscar</button>
                        </div>
                </div>

                <div id="loader1" style="position: absolute; text-align: center; top: 55px;  width: 100%;display:none;"></div>
                    
                    <div class="outer_div123" ></div>
                    <br><br><br><br><br><br>
                    <div class="outer_div1234"></div>-->
                <div class="text-right">
                    <button type="button" class="btn btn-limpiar pull-r" onclick="loading1(1)">
                        <span class='glyphicon glyphicon-search'></span> Buscar
                    </button>
                </div>
                <div role="tabpanel">
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active">
                            <a href="#uploadTab" aria-controls="uploadTab" role="tab" data-toggle="tab">Historial Compras de Producto</a>
                        </li>
                        <li role="presentation">
                            <a href="#browseTab" aria-controls="browseTab" role="tab" data-toggle="tab">Historial de Precios Cambiados</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="uploadTab">
                            <div class="outer_div123" ></div>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="browseTab">
                            <div class="outer_div1234"></div>
                        </div>
                    </div>
                </div>


        </div>


		<div class="modal-footer">
			<button type="button" class="btn btn-cancelar" data-dismiss="modal">Cerrar</button>
		</div>
		<!--</form>-->

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


