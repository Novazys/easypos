<?php

	$objProducto =  new Producto();
	if($tipo_usuario==1){

?>
			 <div class="row">
				 <div class="col-sm-6 col-md-8">
			      	<!-- Detalle de Compra -->
						<div class="panel panel-default" id="panel-detalle">

							<div class="panel-heading">
								<h6 class="panel-title">Detalle de Compra</h6>
							</div>
							<div class="panel-body">
								<div class="form-group">
									<div class="row">
										<div class="col-sm-12">
											<div class="input-group">
											<span class="input-group-addon"><i class="icon-barcode2"></i></span>
											<input type="text" id="buscar_producto" name="buscar_producto"  placeholder="Busque un producto aqui..."
											 class="form-control" style="text-transform:uppercase;"
                                    		onkeyup="javascript:this.value=this.value.toUpperCase();">
                                    		</div>
										</div>
									</div>
								</div>

								<div class="table-responsive">
									<table id="tbldetalle" class="table table-xxs">
										<thead>
											<tr class="bg-blue">
												<th></th>
												<th>Producto</th>
												<th>Cant.</th>
												<th class="text-center">Precio</th>
												<th class="text-center">Exento</th>
												<th class="text-center">Importe</th>
												<th class="text-center">Quitar</th>
												<th class="text-center">Vence</th>
											</tr>
										</thead>
										<tbody>

										</tbody>
										<tfoot id="totales_foot">
											<tr>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td>SUMAS</td>
												<td></td>
												<td id="sumas"></td>
												<td></td>
											</tr>
											<tr>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td>IVA %</td>
												<td></td>
												<td id="iva"></td>
												<td></td>
											</tr>
											<tr>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td>SUBTOTAL</td>
												<td></td>
												<td id="subtotal"></td>
												<td></td>
											</tr>
											<tr>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td>RET. (-)</td>
												<td></td>
												<td id="ivaretenido"></td>
												<td></td>
											</tr>
											<tr>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td>T. EXENTO</td>
												<td></td>
												<td id="exentas"></td>
												<td></td>
											</tr>
											<tr>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td>TOTAL</td>
												<td></td>
												<td id="total"></td>
												<td></td>
											</tr>
										</tfoot>
									</table>
								</div>
							</div>
						</div>
					<!-- /Detalle de Compra -->
					<div class="form-group">
						<div class="row">
							<div class="col-sm-3">
								<button type="submit" id="btncancelar" class="btn bg-danger-700 btn-labeled btn-block"><b>
								<i class="icon-cancel-circle2"></i>
								</b> Cancelar Compra</button>
							</div>
						</div>
					</div>
			   	  </div>


			 <!-- Informacion Proveedor -->
			  	<div class="col-sm-6 col-md-4">
				 	<div class="panel panel-success" id="panel-cobro">
						<div class="panel-heading">
							<h6 class="panel-title"><h1 id="big_total" class="panel-title text-center text-black"></h1></h6>
						</div>
						<div class="panel-body">
						  <form role="form" autocomplete="off" class="form-validate-jquery" id="frmModal">

							<div class="form-group">
								<div class="row">
									<div class="col-sm-12">
										<label>Proveedor</label>
										<select  data-placeholder="..." id="cbProveedor" name="cbProveedor"
											class="select-size-xs" style="text-transform:uppercase;"
		                            		onkeyup="javascript:this.value=this.value.toUpperCase();">
		                            			 <?php
													$filas = $objProducto->Listar_Proveedores();
													if (is_array($filas) || is_object($filas))
													{
													foreach ($filas as $row => $column)
													{
													?>
														<option value="<?php print ($column["idproveedor"])?>">
														<?php print ($column["nombre_proveedor"])?></option>
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
										<label>Tipo Comprobante</label>
										<select  data-placeholder="..." id="cbCompro" name="cbCompro"
											class="select-size-xs" style="text-transform:uppercase;"
		                            		onkeyup="javascript:this.value=this.value.toUpperCase();">
		                            			<option value="1">TICKET</option>
		                            			<option value="2">FACTURA</option>
		                            			<option value="3">CREDITO FISCAL</option>
										</select>
									</div>
									<div class="col-sm-6">
										<label>Fecha Comprobante</label>
										<div class="form-group has-feedback has-feedback-left">
											<input type="text" id="txtFechaC" name="txtFechaC" placeholder=""
											 class="form-control">
	                                		<div class="form-control-feedback">
													<i class="icon-calendar3 text-size-base"></i>
											</div>
	                                	</div>
									</div>
								</div>
							</div>

							<div class="form-group">
								<div class="row">

									<div class="col-sm-6">
										<label>Forma de Pago</label>
										<select  data-placeholder="..." id="cbPago" name="cbPago"
											class="select-size-xs" style="text-transform:uppercase;"
		                            		onkeyup="javascript:this.value=this.value.toUpperCase();">
		                            			<option value="1">CONTADO</option>
		                            			<option value="2">CREDITO</option>
										</select>
									</div>

									<div class="col-sm-6">
										<label>No. Comprobante</label>

										<div class="form-group has-feedback has-feedback-left">
											<input type="text" id="txtNoCompro" name="txtNoCompro" placeholder="04508"
										 	class="form-control" style="text-transform:uppercase;"
                                			onkeyup="javascript:this.value=this.value.toUpperCase();">
	                                		<div class="form-control-feedback">
													<i class="icon-certificate text-size-base"></i>
											</div>
	                                	</div>


									</div>

								</div>
							</div>

							<div class="form-group">
								<div class="row">
									<div class="col-sm-12">
										<button type="submit" id="btnguardar" class="btn bg-success-700
										btn-labeled btn-block btn-ladda btn-ladda-spinner"><b><i class="icon-cash"></i>
										</b> Guardar Compra</button>
									</div>
								</div>
							</div>

						  </form>

						</div>
					</div>
				</div>
				<!-- Informacion Proveedor -->
			 </div>


				<?php include('./includes/footer.inc.php'); ?>
			</div>
			<!-- /content area -->
		</div>
		<!-- /main content -->
	</div>
	<!-- /page content -->
</div>
<!-- /page container -->
</body>
</html>
<script type="text/javascript" src="web/custom-js/compra.js"></script>

<?php } else { ?>

	<div class="panel-body">
		<div class="row">
			<div class="col-md-12">

				<!-- Widget with rounded icon -->
				<div class="panel">
					<div class="panel-body text-center">
						<div class="icon-object border-danger-400 text-primary-400"><i class="icon-lock5 icon-3x text-danger-400"></i>
						</div>
						<h2 class="no-margin text-semibold"> SU USUARIO NO POSEE PERMISOS SUFICIENTES </h2>
						<span class="text-uppercase text-size-mini text-muted">Su usuario no posee los permisos respectivos
						para poder accesar a este modulo. Lo invitamos a dar click </span> <a href="./?View=Inicio">AQUI</a> <br><br>

					</div>
				</div>
				<!-- /widget with rounded icon -->
			</div>
		</div>

<?php } ?>
