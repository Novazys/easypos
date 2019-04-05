<?php 

	$objInventario =  new Inventario();
	$objProducto = new Producto();
 ?>
<div id="reload-full-div">
	<!--<div class="breadcrumb-line">
		<ul class="breadcrumb">
			<li><a href="?View=Inicio"><i class="icon-home2 position-left"></i> Inicio</a></li>
			<li><a href="javascript:;">Inventario</a></li>
			<li class="active">Kardex de Productos</li>
		</ul> 
	  <div class="row">
		 <div class="breadcrumb col-lg-12">
				<div style="background-color: #FF5722;color: white;padding: 2px;font-size: 20px;
				text-align: center; text-transform: uppercase;font-weight: bold;width: 100%;">
					<span>
					resumen de saldos y movimientos de productos</span>
			    </div>
	   	  </div>
	  </div>
	</div>
	<br>
	 <div class="row">
		 <div class="col-sm-6 col-md-3">
		 	<form role="form" autocomplete="off" class="form-validate-jquery" id="frmSearch">
				<div class="form-group">
					<div class="row">
						<div class="col-sm-6">
							<label>Mes Inventario</label>
							<div class="input-group">
							<span class="input-group-addon"><i class="icon-calendar3"></i></span>
							<input type="text" id="txtMes" name="txtMes" placeholder=""
							 class="form-control input-sm" style="text-transform:uppercase;" 
	                		onkeyup="javascript:this.value=this.value.toUpperCase();">
	                		</div>
						</div>
						<div class="col-sm-4">
							<button style="margin-top: 27px;" id="btnGuardar" type="submit" class="btn btn-primary btn-sm"> 
							<i class="icon-search4"></i> Consultar</button>
						</div>
					</div>
				</div>
			  </form>
	   	  </div>
	  </div>

	  <div class="row">
		 <div class="col-md-12 col-lg-12">
			<!-- Basic initialization -->
			<!--<div class="panel panel-flat">
				<div class="panel-heading">
					<h5 class="panel-title">Kardex</h5>
					<div class="heading-elements">

						<div class="btn-group">
	                    	<button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown">
	                    	<i class="icon-printer2 position-left"></i> Imprimir Reporte 
	                    	<span class="caret"></span></button>
	                    	<ul class="dropdown-menu dropdown-menu-right">
								<li><a id="print_saldos" href="javascript:void(0)"
								><i class="icon-file-pdf"></i> Saldos y Movimientos</a></li>
								<li class="divider"></li>
								<li><a id="print_entradas" href="javascript:void(0)">
								<i class="icon-file-pdf"></i> Entradas del Mes</a></li>
								<li class="divider"></li>
								<li><a id="print_salidas" href="javascript:void(0)">
								<i class="icon-file-pdf"></i> Salidas del Mes</a></li>
							</ul>
						</div>

						<div class="btn-group">
	                    	<button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
	                    	<i class="icon-pencil6 position-left"></i> Registrar Movimiento 
	                    	<span class="caret"></span></button>
	                    	<ul class="dropdown-menu dropdown-menu-right">
								<li><a data-toggle="modal" data-target="#modal_iconified" 
								id="new_entrada" href="javascript:void(0)">
								<i class="icon-point-right"></i> Registrar Entrada</a></li>
								<li class="divider"></li>
								<li><a data-toggle="modal" data-target="#modal_iconified" 
								 id="new_salida" href="javascript:void(0)">
								<i class="icon-point-left"></i> Registrar Salida</a></li>
							</ul>
						</div>
					</div>
				</div>

				<div id="reload-div">
				   <div class="panel panel-body">
					<table class="table datatable-basic table-borderless table-hover table-xs">
						<thead>
							<tr>
								<th>No</th>
								<th>PRODUCTO</th>
								<th>MARCA</th>
								<th>SALDO INICIAL</th>
								<th>ENTRADAS</th>
								<th>SALIDAS</th>
								<th>SALDO</th>
							</tr>
						</thead>

						<tbody>
						
						  <?php 
								//$filas = $objInventario->Listar_Kardex(''); 
								//if (is_array($filas) || is_object($filas))
								{
								//foreach ($filas as $row => $column) 
								{
								?>
									<tr>
					                	<td><?php //print($column['idproducto']); ?></td>
					                	<td><?php //print($column['producto']); ?></td>
					                	<td><?php //print($column['nombre_marca']); ?></td>
					                	<td><?php //print($column['saldo_inicial']); ?></td>
					                	<td><?php //print($column['entradas']); ?></td>
					                	<td><?php //print($column['salidas']); ?></td>
					                	<td><?php //print($column['saldo_final']); ?></td>
					                </tr>
								<?php  
								}
							}
							?>
						
						</tbody>
					</table>
					</div>
				</div>	
			 </div>
	   	  </div>
	  </div>


	  <!-- Iconified modal -->
		<!--<div id="modal_iconified" class="modal fade">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h5 class="modal-title"><i class="icon-pencil7"></i> &nbsp; <span class="title-form"></span></h5>
					</div>

			        <form role="form" autocomplete="off" class="form-validate-jquery" id="frmMov">
						<div class="modal-body" id="modal-container">

						<div class="alert alert-info alert-styled-left text-blue-800 content-group">
				                <span class="text-semibold">Estimado usuario</span> 
				                Los campos remarcados con <span class="text-danger"> * </span> son necesarios.
				                <button type="button" class="close" data-dismiss="alert">×</button>
	                          	<input type="hidden" id="txtProceso" name="txtProceso" class="form-control" value="">
				        </div>

						<div class="form-group">
							<div class="row">
								<div class="col-sm-12">
									<label>Producto <span class="text-danger"> * </span></label>
									<select  data-placeholder="..." id="cbProducto" name="cbProducto" 
										class="select-search" style="text-transform:uppercase;" 
	                            		onkeyup="javascript:this.value=this.value.toUpperCase();">
	                            			 <?php 
												//$filas = $objProducto->Listar_Productos(); 
												//if (is_array($filas) || is_object($filas))
												{
												//foreach ($filas as $row => $column) 
												{
												?>
													<option value="<?php //print ($column["idproducto"])?>">
													<?php //print ($column["codigo_barra"].' - '.$column["nombre_producto"])?></option>
												<?php 
													}
												}
												 ?>
									</select>
								</div>
							</div>
						</div>


						<div class="form-group">
							<div class="row">
								<div class="col-sm-6">
									<label>Motivo <span class="text-danger"> * </span></label>
									<select  data-placeholder="..." id="cbMotivo" name="cbMotivo" 
										class="select-search" style="text-transform:uppercase;" 
	                            		onkeyup="javascript:this.value=this.value.toUpperCase();">
	                            		<option id="" value=""></option>
	                            		<option id="IN-INI" value="POR INVENTARIO INICIAL">POR INVENTARIO INICIAL</option>
                            			<option value="POR AJUSTE DE INVENTARIO">POR AJUSTE DE INVENTARIO</option>
                            			<option id="AVERIA" value="POR AVERIA DE PRODUCTO">POR AVERIA DE PRODUCTO</option>
                            			<option id="PROMOCIONAL" 
                            			value="POR PROMOCIONAL DE PROVEEDOR">POR PROMOCIONAL DE PROVEEDOR</option>
                            			<option value="POR CANJE DE PROVEEDOR">POR CANJE DE PROVEEDOR</option>
									</select>
								</div>

								<div class="col-sm-6">
									<label>Cantidad Movimiento</label>
										<input type="text" id="txtCant" name="txtCant" placeholder="0.00"
										class="touchspin-prefix" style="text-transform:uppercase;" 
	                            		 onkeyup="javascript:this.value=this.value.toUpperCase();">
								</div>

							</div>
						</div>

						</div>

						<div class="modal-footer">
							<button  type="reset" class="btn btn-default" id="reset" 
							class="btn btn-link" data-dismiss="modal">Cerrar</button>
							<button id="btnGuardar" type="submit" class="btn btn-primary">Guardar</button>
						</div>
					</form>
				</div>	
			</div>
		</div>
		<!-- /iconified modal -->
  <!-- </div> -->

<script type="text/javascript" src="web/custom-js/init-kardex.js"></script>