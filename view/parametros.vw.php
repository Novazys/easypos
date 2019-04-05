<?php

	$objParametro =  new Parametro();
	if ($tipo_usuario==1) {
?>

			<!-- Basic initialization -->
			<div class="panel panel-flat">
				<div class="breadcrumb-line">
					<ul class="breadcrumb">
						<li><a href="?View=Inicio"><i class="icon-home2 position-left"></i> Inicio</a></li>
						<li><a href="javascript:;">Parametros</a></li>
						<li class="active">Parametros del Sistema</li>
					</ul>
				</div>
					<div class="panel-heading">
						<h5 class="panel-title">Parametros</h5>

						<div class="heading-elements">
							<button type="button" class="btn btn-primary heading-btn"
							onclick="newParametro()">
							<i class="icon-database-add"></i> Agregar Nuevo/a</button>
						</div>
					</div>
					<div class="panel-body">
					</div>
					<div id="reload-div">
					<table class="table datatable-basic table-xxs table-hover">
						<thead>
							<tr>
								<th>No</th>
								<th>Empresa</th>
								<th>Propietario</th>
								<th>NIT</th>
								<th>% IVA</th>
								<th class="text-center">Opciones</th>
							</tr>
						</thead>

						<tbody>

						  <?php
								$filas = $objParametro->Listar_Parametros();
								if (is_array($filas) || is_object($filas))
								{
								foreach ($filas as $row => $column)
								{

									$nit = $column['numero_nit'];
									$nit =  substr($nit, 0, 7).'-'.substr($nit, 7,9);
								?>
									<tr>
					                	<td><?php print($column['idparametro']); ?></td>
					                	<td><?php print($column['nombre_empresa']); ?></td>
					                	<td><?php print($column['propietario']); ?></td>
					                	<td><?php print($nit); ?></td>
					                	<td><?php print($column['porcentaje_iva']); ?></td>
					                	<td class="text-center">
										<ul class="icons-list">
											<li class="dropdown">
												<a href="#" class="dropdown-toggle" data-toggle="dropdown">
													<i class="icon-menu9"></i>
												</a>

												<ul class="dropdown-menu dropdown-menu-right">
													<li><a
													href="javascript:;" data-toggle="modal" data-target="#modal_iconified"
													onclick="openParametro('editar',
								                     '<?php print($column["idparametro"]); ?>',
								                     '<?php print($column["nombre_empresa"]); ?>',
								                     '<?php print($column["propietario"]); ?>',
								                     '<?php print($nit); ?>',

								                     '<?php print($column["porcentaje_iva"]); ?>',
																		 '<?php print($column["porcentaje_retencion"]); ?>',
																		 '<?php print($column["monto_retencion"]); ?>',
																		 '<?php print($column["idcurrency"]); ?>',
								                     '<?php print($column["direccion_empresa"]); ?>')">
												   <i class="icon-pencil6">
											       </i> Editar</a></li>
													<li><a
													href="javascript:;" data-toggle="modal" data-target="#modal_iconified"
													onclick="openParametro('ver',
								                     '<?php print($column["idparametro"]); ?>',
								                     '<?php print($column["nombre_empresa"]); ?>',
								                     '<?php print($column["propietario"]); ?>',
								                     '<?php print($nit); ?>',

								                     '<?php print($column["porcentaje_iva"]); ?>',
																		 '<?php print($column["porcentaje_retencion"]); ?>',
																		 '<?php print($column["monto_retencion"]); ?>',
																		 '<?php print($column["idcurrency"]); ?>',
								                     '<?php print($column["direccion_empresa"]); ?>')">
													<i class=" icon-eye8">
													</i> Ver</a></li>
												</ul>
											</li>
										</ul>
									</td>
					                </tr>
								<?php
								}
							}
							?>

						</tbody>
					</table>
					</div>
				</div>

			<!-- Iconified modal -->
				<div id="modal_iconified" class="modal fade">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal">&times;</button>
								<h5 class="modal-title"><i class="icon-pencil7"></i> &nbsp; <span class="title-form"></span></h5>
							</div>

					        <form role="form" autocomplete="off" class="form-validate-jquery" id="frmModal">
								<div class="modal-body" id="modal-container">

								<div class="alert alert-info alert-styled-left text-blue-800 content-group">
						                <span class="text-semibold">Estimado usuario</span>
						                Los campos remarcados con <span class="text-danger"> * </span> son necesarios.
						                <button type="button" class="close" data-dismiss="alert">×</button>
						                <input type="hidden" id="txtID" name="txtID" class="form-control" value="">
                                      	<input type="hidden" id="txtProceso" name="txtProceso" class="form-control" value="">
						           </div>

									 <div class="form-group">
 										<div class="row">
 											<div class="col-sm-12">
												<label>Moneda <span class="text-danger">*</span></label>
												<select  data-placeholder="..." id="cbMoneda" name="cbMoneda"
													class="select-search" style="text-transform:uppercase;"
													onkeyup="javascript:this.value=this.value.toUpperCase();">
															 <?php
															$filas = $objParametro->Listar_Monedas();
															if (is_array($filas) || is_object($filas))
															{
															foreach ($filas as $row => $column)
															{
															?>
																<option value="<?php print ($column["idcurrency"])?>">
																<?php print ($column["CurrencyName"].' - Simbolo : '.$column["Symbol"].' - Idioma '.
																$column["Language"].' - ISO Moneda : '.$column["CurrencyISO"])?>
																</option>
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
											<div class="col-sm-12">
												<label>Empresa <span class="text-danger">*</span></label>
												<input type="text" id="txtEmpresa" name="txtEmpresa" placeholder="EJ. MINI MARKET"
												 class="form-control" style="text-transform:uppercase;"
                                        		onkeyup="javascript:this.value=this.value.toUpperCase();">
											</div>
										</div>
									</div>

									<div class="form-group">
										<div class="row">
											<div class="col-sm-12">
												<label>Propietario <span class="text-danger">*</span></label>
												<input type="text" id="txtPropietario" name="txtPropietario" placeholder="EJ. JUAN PEREZ"
												 class="form-control" style="text-transform:uppercase;"
                                        		onkeyup="javascript:this.value=this.value.toUpperCase();">
											</div>
										</div>
									</div>

									<div class="form-group">
										<div class="row">
											<div class="col-sm-6">
												<label>NIT <span class="text-danger">*</span></label>
												<input type="text" id="txtNIT" name="txtNIT" placeholder="EJ. 1403290-1"
												 class="form-control" style="text-transform:uppercase;"
                                        		onkeyup="javascript:this.value=this.value.toUpperCase();">
											</div>


										</div>
									</div>



									<div class="form-group">
										<div class="row">
											<div class="col-sm-6">
												<label>Porcentaje IVA <span class="text-danger">*</span></label>
												<input type="text" id="txtPIVA" name="txtPIVA" placeholder="EJ. 13.00"
												class="touchspin-prefix" value="0" style="text-transform:uppercase;"
                        onkeyup="javascript:this.value=this.value.toUpperCase();">
											</div>


											<div class="col-sm-6">
												<label>Porcentaje Retencion <span class="text-danger">*</span></label>
												<input type="text" id="txtPRET" name="txtPRET" placeholder="EJ. 1.00"
												class="touchspin-prefix" value="0" style="text-transform:uppercase;"
                        onkeyup="javascript:this.value=this.value.toUpperCase();">
											</div>

										</div>
									</div>


									<div class="form-group">
										<div class="row">

											<div class="col-sm-6">
												<label>Retener a partir de : <span class="text-danger">*</span></label>
												<input type="text" id="txtMontoR" name="txtMontoR" placeholder="EJ. 1.00"
												class="touchspin-prefix" value="0" style="text-transform:uppercase;"
												onkeyup="javascript:this.value=this.value.toUpperCase();">
											</div>

											<div class="col-sm-6">
												<label>Direccion <span class="text-danger">*</span></label>
												 <textarea rows="3" class="form-control"
													placeholder="EJ. AVENIDA ROOSEVELT Y C. ALMENDROS CDAD JARDIN , SAN MIGUE,
													 SAN MIGUEL" id="txtDireccion" name="txtDireccion"
													value="" style="text-transform:uppercase;"
													onkeyup="javascript:this.value=this.value.toUpperCase();">
													</textarea>
											</div>
										</div>
									</div>

								</div>

								<div class="modal-footer">
									<button id="btnGuardar" type="submit" class="btn btn-primary">Guardar</button>
									<button id="btnEditar" type="submit" class="btn btn-warning">Editar</button>
									<button  type="reset" class="btn btn-default" id="reset"
									class="btn btn-link" data-dismiss="modal">Cerrar</button>
								</div>
							</form>
						</div>
					</div>
				</div>
				<!-- /iconified modal -->
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
<script type="text/javascript" src="web/custom-js/parametro.js"></script>
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
