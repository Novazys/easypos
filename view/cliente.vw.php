<?php

	$objCliente =  new Cliente();

?>

			<!-- Basic initialization -->
			<div class="panel panel-flat">
				<div class="breadcrumb-line">
					<ul class="breadcrumb">
						<li><a href="?View=Inicio"><i class="icon-home2 position-left"></i> Inicio</a></li>
						<li><a href="javascript:;">Ventas</a></li>
						<li class="active">Clientes</li>
					</ul>
				</div>
					<div class="panel-heading">
						<h5 class="panel-title">Clientes</h5>

						<div class="heading-elements">
							<button type="button" class="btn btn-primary heading-btn"
							onclick="newCliente()">
							<i class="icon-database-add"></i> Agregar Nuevo/a</button>

							<div class="btn-group">
		                    	<button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
		                    	<i class="icon-printer2 position-left"></i> Imprimir Reporte
		                    	<span class="caret"></span></button>
		                    	<ul class="dropdown-menu dropdown-menu-right">
									<li><a id="print_activos" href="javascript:void(0)"
									><i class="icon-file-pdf"></i> Clientes Activos</a></li>
									<li class="divider"></li>
									<li><a id="print_inactivos" href="javascript:void(0)">
									<i class="icon-file-pdf"></i> Clientes Inactivos</a></li>
								</ul>
							</div>


						</div>
					</div>
					<div class="panel-body">
					</div>
					<div id="reload-div">
					<table class="table datatable-basic table-xxs table-hover">
						<thead>
							<tr>
								<th>No</th>
								<th>Cliente</th>
								<th>NIT</th>
								<th>Telefono</th>
								<th>Estado</th>
								<th class="text-center">Opciones</th>
							</tr>
						</thead>

						<tbody>

						  <?php
								$filas = $objCliente->Listar_Clientes();
								if (is_array($filas) || is_object($filas))
								{
								foreach ($filas as $row => $column)
								{

									$nit = $column['numero_nit'];
									$telefono = $column['numero_telefono'];


									$telefono = substr($telefono, 0, 4).'-'.substr($telefono, 4, 4);
					$nit =  substr($nit, 0, 7).'-'.substr($nit, 7,9);
								?>
									<tr>
					                	<td><?php print($column['codigo_cliente']); ?></td>
					                	<td><?php print($column['nombre_cliente']); ?></td>
					                	<td><?php print $nit; ?></td>
					                	<td><?php print($telefono); ?></td>
					                	<td><?php if($column['estado'] == '1')
					                		echo '<span class="label label-success label-rounded"><span
					                		class="text-bold">VIGENTE</span></span>';
					                		else
					                		echo '<span class="label label-default label-rounded">
					                	<span
					                	    class="text-bold">DESCONTINUADO</span></span>'
						                ?></td>
					                	<td class="text-center">
										<ul class="icons-list">
											<li class="dropdown">
												<a href="#" class="dropdown-toggle" data-toggle="dropdown">
													<i class="icon-menu9"></i>
												</a>

												<ul class="dropdown-menu dropdown-menu-right">
													<li><a
													href="javascript:;" data-toggle="modal" data-target="#modal_iconified"
													onclick="openCliente('editar',
								                     '<?php print($column["idcliente"]); ?>',
								                     '<?php print($column["codigo_cliente"]); ?>',
								                     '<?php print($column["nombre_cliente"]); ?>',
								                     '<?php print($nit); ?>',

								                     '<?php print($column["direccion_cliente"]); ?>',
								                     '<?php print($telefono); ?>',
								                     '<?php print($column["email"]); ?>',
																		 '<?php print($column["giro"]); ?>',
																		 '<?php print($column["limite_credito"]); ?>',
								                     '<?php print($column["estado"]); ?>')">
												   <i class="icon-pencil6">
											       </i> Editar</a></li>
													<li><a
													href="javascript:;" data-toggle="modal" data-target="#modal_iconified"
													onclick="openCliente('ver',
																		'<?php print($column["idcliente"]); ?>',
																		'<?php print($column["codigo_cliente"]); ?>',
																		'<?php print($column["nombre_cliente"]); ?>',
																		'<?php print($nit); ?>',

																		'<?php print($column["direccion_cliente"]); ?>',
																		'<?php print($telefono); ?>',
																		'<?php print($column["email"]); ?>',
																		'<?php print($column["giro"]); ?>',
																		'<?php print($column["limite_credito"]); ?>',
																		'<?php print($column["estado"]); ?>')">
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
											<div class="col-sm-6">
												<label>Codigo</label>
												<input type="text" id="txtCodigo" name="txtCodigo" placeholder="AUTOGENERADO"
												 class="form-control" style="text-transform:uppercase;"
                                        		onkeyup="javascript:this.value=this.value.toUpperCase();" readonly="" disabled="disabled">
											</div>
										</div>
									</div>

									<div class="form-group">
										<div class="row">
											<div class="col-sm-12">
												<label>Nombre Cliente / Empresa <span class="text-danger">*</span></label>
												<input type="text" id="txtNombre" name="txtNombre" placeholder="EJ. JUAN PEREZ / LACTEOS MONTEGRANDE"
												 class="form-control" style="text-transform:uppercase;"
                                        		onkeyup="javascript:this.value=this.value.toUpperCase();">
											</div>
										</div>
									</div>

									<div class="form-group">
										<div class="row">

											<div class="col-sm-6">
												<label>NIT</label>
												<input type="text" id="txtNIT" name="txtNIT" placeholder="EJ. 1403290-1"
												 class="form-control" style="text-transform:uppercase;"
                                        		onkeyup="javascript:this.value=this.value.toUpperCase();">
											</div>

										</div>
									</div>

									<div class="form-group">
										<div class="row">
											<div class="col-sm-6">
												<label>Telefono</label>
												<input type="text" id="txtTelefono" name="txtTelefono" placeholder="EJ. 2680-0784"
												 class="form-control" style="text-transform:uppercase;"
                                        		onkeyup="javascript:this.value=this.value.toUpperCase();">
											</div>

											<div class="col-sm-6">
												<label>Email</label>
												<input type="email" id="txtEmail" name="txtEmail" placeholder="EJ. youremail@mail.com"
												 class="form-control">
											</div>
										</div>
									</div>

									<div class="form-group">
											<div class="row">

												<div class="col-sm-6">
													<label>Giro</label>
													<input type="text" id="txtGiro" name="txtGiro" placeholder="EJ. VENTA DE PRODUCTOS LACTEOS"
													 class="form-control" style="text-transform:uppercase;"
	                         onkeyup="javascript:this.value=this.value.toUpperCase();">
												</div>

												<div class="col-sm-6">
													<label>Limite Crediticio <span class="text-danger">*</span></label>
													<input type="text" id="txtLimitC" name="txtLimitC" placeholder="EJ. 25.00"
													class="touchspin-prefix" value="0" style="text-transform:uppercase;"
													onkeyup="javascript:this.value=this.value.toUpperCase();">
												</div>

											</div>
									</div>

									<div class="form-group">
										<div class="row">
											<div class="col-sm-12">
												<label>Direccion</label>
												 <textarea rows="2" class="form-control"
                           placeholder="EJ. AVENIDA ROOSEVELT Y C. ALMENDROS CDAD JARDIN , SAN MIGUEl SAN MIGUEL"
                           id="txtDireccion" name="txtDireccion"
                           value="" style="text-transform:uppercase;"
                           onkeyup="javascript:this.value=this.value.toUpperCase();">
                          </textarea>
											</div>
										</div>
									</div>

									<div class="form-group">
										<div class="row">
											<div class="col-sm-8">
												<div class="checkbox checkbox-switchery switchery-sm">
													<label>
													<input type="checkbox" id="chkEstado" name="chkEstado"
													 class="switchery" checked="checked" >
													 <span id="lblchk">VIGENTE</span>
												   </label>
												</div>
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
<script type="text/javascript" src="web/custom-js/cliente.js"></script>
