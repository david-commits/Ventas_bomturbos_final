	<?php
        $id_producto=1;
		if (isset($con))
		{
	?>	
			<!-- Modal -->
			<div class="modal fade bs-example-modal-lg" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			  <div class="modal-dialog modal-lg" role="document">
				<div class="modal-content">
				  <div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel">Descripción:</h4>
				  </div>
				  <div class="modal-body">
					<form class="form-horizontal">
					  
                                            <table class="table">
				<tr  class="warning">
                                   
					
                                    <th><span class="pull-center">Detalle de la Descripción</span></th>
					<th><span class="pull-center">Cant.</span></th>
					<th><span class="pull-center">Precio</span></th>
                                       
					<th class='text-center' style="width: 36px;">Agregar</th>
				</tr>
                                
                                <tr >
						
                                                
                                                
                                                
                                               
						<td class='col-xs-7'>
						<div class="pull-right">
                                                    <input type="text" class="form-control" style="text-align:left;width:500px;" id="descripcion" autocomplete="off" placeholder="Detalle de la descripción o servicio" >
						
                                                <input type="hidden" class="form-control" style="text-align:left;width:500px;" id="stock"  value="1000" >
						
                                                </div></td>
						<td class='col-xs-2'>
						<div class="pull-right">
						<input type="text" class="form-control" style="text-align:center" id="cantidad"  value="1" >
						</div></td>
						<td class='col-xs-2'>
                                                    <div class="pull-right">
						<input type="search" class="form-control" style="text-align:center" id="precio_venta"  >
                                                
                                                    </div></td>
                                             <td class='text-center'><a class='btn btn-info'href="#" onclick="agregar1()"><i class="glyphicon glyphicon-plus"></i></a></td>
					</tr>
                                
                                
                                            
                                            </table>    
                                            
                                            
                                            
					</form>
					<!-- Datos ajax Final -->
				  </div>
				  
				</div>
			  </div>
			</div>
	<?php
		}
	?>