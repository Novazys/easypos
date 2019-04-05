<?php

	$objProveedor =  new Proveedor();
	if($tipo_usuario==1){

?>

			<!-- Basic initialization -->
			<div class="panel panel-flat">
				<div class="breadcrumb-line">
					<ul class="breadcrumb">
						<li><a href="?View=Inicio"><i class="icon-home2 position-left"></i> Inicio</a></li>
						<li><a href="javascript:;">Compras</a></li>
						<li class="active">Proveedores</li>
					</ul>
				</div>
					<div class="panel-heading">
						<h5 class="panel-title">Proveedores</h5>

						<div class="heading-elements">
							<button type="button" class="btn btn-primary heading-btn"
							onclick="newProveedor()">
							<i class="icon-database-add"></i> Agregar Nuevo/a</button>


							<button type="button" id="print_proveedor" class="btn btn-info heading-btn">
							<i class="icon-file-pdf"></i> Imprimir Reporte</button>

						</div>
					</div>
					<div class="panel-body">
					</div>
					<div id="reload-div">
					<table class="table datatable-basic table-xxs table-hover">
						<thead>
							<tr>
								<th>No</th>
								<th>Proveedor</th>
								<th>NIT</th>
								<th>Telefono</th>
								<th>Estado</th>
								<th class="text-center">Opciones</th>
							</tr>
						</thead>

						<tbody>

						  <?php
								$filas = $objProveedor->Listar_Proveedores();
								if (is_array($filas) || is_object($filas))
								{
								foreach ($filas as $row => $column)
								{

									$nit = $column['numero_nit'];
									$telefono = $column['numero_telefono'];
									$telefono_contacto = $column['telefono_contacto'];

									$telefono = substr($telefono, 0, 4).'-'.substr($telefono, 4, 4);
									$telefono_contacto = substr($telefono_contacto, 0, 4).'-'.substr($telefono_contacto, 4, 4);

									$nit =  substr($nit, 0, 7).'-'.substr($nit, 7,9);
								?>
									<tr>
					                	<td><?php print($column['codigo_proveedor']); ?></td>
					                	<td><?php print($column['nombre_proveedor']); ?></td>
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
													onclick="openProveedor('editar',
								                     '<?php print($column["idproveedor"]); ?>',
								                     '<?php print($column["codigo_proveedor"]); ?>',
								                     '<?php print($column["nombre_proveedor"]); ?>',
								                     '<?php print($telefono); ?>',
								                     '<?php print($nit); ?>',

								                     '<?php print($column["nombre_contacto"]); ?>',
								                     '<?php print($telefono_contacto); ?>',
								                     '<?php print($column["estado"]); ?>')">
												   <i class="icon-pencil6">
											       </i> Editar</a></li>
													<li><a
													href="javascript:;" data-toggle="modal" data-target="#modal_iconified"
													onclick="openProveedor('ver',
								                     '<?php print($column["idproveedor"]); ?>',
								                     '<?php print($column["codigo_proveedor"]); ?>',
								                     '<?php print($column["nombre_proveedor"]); ?>',
								                     '<?php print($telefono); ?>',
								                     '<?php print($nit); ?>',

								                     '<?php print($column["nombre_contacto"]); ?>',
								                     '<?php print($telefono_contacto); ?>',
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
												<label>Proveedor <span class="text-danger">*</span></label>
												<input type="text" id="txtProveedor" name="txtProveedor" placeholder="EJ. DISTRIBUIDORA BONILLA"
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
											<div class="col-sm-8">
												<label>Telefono <span class="text-danger">*</span></label>
												<input type="text" id="txtTelefono" name="txtTelefono" placeholder="EJ. 2680-0784"
												 class="form-control" style="text-transform:uppercase;"
                                        		onkeyup="javascript:this.value=this.value.toUpperCase();">
											</div>
										</div>
									</div>

									<div class="form-group">
										<div class="row">
											<div class="col-sm-6">
												<label>Contacto</label>
												<input type="text" id="txtContacto" name="txtContacto" placeholder="EJ. JUAN PEREZ"
												 class="form-control" style="text-transform:uppercase;"
                                        		onkeyup="javascript:this.value=this.value.toUpperCase();">
											</div>

											<div class="col-sm-6">
												<label>Telefono Contacto</label>
												<input type="text" id="txtTelefonoC" name="txtTelefonoC" placeholder="EJ. 7580-0841"
												 class="form-control" style="text-transform:uppercase;"
                                        		onkeyup="javascript:this.value=this.value.toUpperCase();">
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
<script type="text/javascript" src="web/custom-js/proveedor.js"></script>

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
