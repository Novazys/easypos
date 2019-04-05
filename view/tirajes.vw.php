<?php

	$objTiraje =  new Tiraje();
	if($tipo_usuario==1){
?>

			<!-- Basic initialization -->
			<div class="panel panel-flat">
				<div class="breadcrumb-line">
					<ul class="breadcrumb">
						<li><a href="?View=Inicio"><i class="icon-home2 position-left"></i> Inicio</a></li>
						<li><a href="javascript:;">Comprobantes</a></li>
						<li class="active">Tiraje de Comprobantes</li>
					</ul>
				</div>
					<div class="panel-heading">
						<h5 class="panel-title">Tiraje de Comprobantes</h5>

						<div class="heading-elements">
							<button type="button" class="btn btn-primary heading-btn"
							onclick="newTiraje()">
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
								<th>Fecha Resolucion</th>
								<th>Comprobante</th>
								<th>Disponibles</th>
								<th>Utilizados</th>
								<th class="text-center">Opciones</th>
							</tr>
						</thead>

						<tbody>

						  <?php
								$filas = $objTiraje->Listar_Tirajes();
								if (is_array($filas) || is_object($filas))
								{
								foreach ($filas as $row => $column)
								{
									$fecha_resolucion = $column["fecha_resolucion"];
									if(is_null($fecha_resolucion))
									{
										$envio_date = '';

									} else {

										$envio_date = DateTime::createFromFormat('Y-m-d',$fecha_resolucion)->format('d/m/Y');
									}


								?>
									<tr>
										<td><?php print($column['idtiraje']); ?></td>
					                	<td><?php print($envio_date); ?></td>
					            		<td><?php print($column['nombre_comprobante']); ?></td>
					            		<td><?php print($column['disponibles']); ?></td>
					            		<td><?php print($column['usados']); ?></td>
					                	<td class="text-center">
										<ul class="icons-list">
											<li class="dropdown">
												<a href="#" class="dropdown-toggle" data-toggle="dropdown">
													<i class="icon-menu9"></i>
												</a>

												<ul class="dropdown-menu dropdown-menu-right">
													<li><a
													href="javascript:;" data-toggle="modal" data-target="#modal_iconified"
													onclick="openTiraje('editar',
								                     '<?php print($column["idtiraje"]); ?>',
								                     '<?php print($envio_date); ?>',
								                     '<?php print($column["numero_resolucion"]); ?>',
								                     '<?php print($column["numero_resolucion_fact"]); ?>',
								                     '<?php print($column["serie"]); ?>',
								                     '<?php print($column["desde"]); ?>',
								                     '<?php print($column["hasta"]); ?>',
								                     '<?php print($column["disponibles"]); ?>',
								                     '<?php print($column["usados"]); ?>',
								                     '<?php print($column["idcomprobante"]); ?>')">
												   <i class="icon-pencil6">
											       </i> Editar</a></li>
													<li><a
													href="javascript:;" data-toggle="modal" data-target="#modal_iconified"
													onclick="openTiraje('ver',
								                     '<?php print($column["idtiraje"]); ?>',
								                     '<?php print($envio_date); ?>',
								                     '<?php print($column["numero_resolucion"]); ?>',
								                     '<?php print($column["numero_resolucion_fact"]); ?>',
								                     '<?php print($column["serie"]); ?>',
								                     '<?php print($column["desde"]); ?>',
								                     '<?php print($column["hasta"]); ?>',
								                     '<?php print($column["disponibles"]); ?>',
								                     '<?php print($column["usados"]); ?>',
								                     '<?php print($column["idcomprobante"]); ?>')">
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
												<label>Comprobante <span class="text-danger">*</span></label>
												<select  data-placeholder="..." id="cbCompro" name="cbCompro"
													class="select-search" style="text-transform:uppercase;"
				                            		onkeyup="javascript:this.value=this.value.toUpperCase();">
				                            			 <?php
															$filas = $objTiraje->Listar_Comprobantes();
															if (is_array($filas) || is_object($filas))
															{
															foreach ($filas as $row => $column)
															{
															?>
																<option value="<?php print ($column["idcomprobante"])?>">
																<?php print ($column["nombre_comprobante"])?>
																</option>
															<?php
																}
															}
															 ?>
													</select>
											</div>
											<div class="col-sm-5">
												<label>Fecha Tiraje <span class="text-danger">*</span></label>
												<div class="input-group">
												<span class="input-group-addon"><i class="icon-calendar3"></i></span>
												<input type="text" id="txtFechaT" name="txtFechaT" placeholder=""
												 class="form-control" style="text-transform:uppercase;"
		                     onkeyup="javascript:this.value=this.value.toUpperCase();">
		                    </div>
											</div>
										</div>
									</div>

									<div class="form-group">
										<div class="row">
											<div class="col-sm-6">
												<label>Numero Resolucion Facturas <span class="text-danger">*</span></label>
												<input type="text" id="txtNoResolucionF" name="txtNoResolucionF" placeholder="2006-1-1777777"
												 class="form-control" style="text-transform:uppercase;"
                                        		onkeyup="javascript:this.value=this.value.toUpperCase();">
											</div>

										</div>
									</div>

						 			<div class="form-group">
										<div class="row">
											<div class="col-sm-5">
												<label>Numero Resolucion <span class="text-danger">*</span></label>
												<input type="text" id="txtNoResolucion" name="txtNoResolucion" placeholder="2006-1-1770077"
												 class="form-control" style="text-transform:uppercase;"
                                        		onkeyup="javascript:this.value=this.value.toUpperCase();">
											</div>

											<div class="col-sm-7">
												<label>Serie <span class="text-danger">*</span></label>
												<input type="text" id="txtNoSerie" name="txtNoSerie" placeholder="DEL 15UN00000001|1 AL 1515UN00000001|20000"
												 class="form-control" style="text-transform:uppercase;"
                                        		onkeyup="javascript:this.value=this.value.toUpperCase();">
											</div>
										</div>
									</div>


						           <div class="form-group">
										<div class="row">
											<div class="col-sm-6">
												<label>Del</label>
												<input type="text" id="txtDel" name="txtDel" placeholder="1"
												 class="form-control" style="text-transform:uppercase;"
                                        		onkeyup="javascript:this.value=this.value.toUpperCase();">
											</div>

											<div class="col-sm-6">
												<label>Al</label>
												<input type="text" id="txtAl" name="txtAl" placeholder="200000"
												 class="form-control" style="text-transform:uppercase;"
                                        		onkeyup="javascript:this.value=this.value.toUpperCase();">
											</div>

										</div>
									</div>

						           <div class="form-group">
										<div class="row">
											<div class="col-sm-6">
												<label>Disponibles</label>
												<input type="text" id="txtDispo" name="txtDispo" placeholder=""
												 class="form-control" style="text-transform:uppercase;"
                                        		onkeyup="javascript:this.value=this.value.toUpperCase();"
                                        		disabled="disabled">
											</div>

											<div class="col-sm-6">
												<label>Utilizados</label>
												<input type="text" id="txtUsados" name="txtUsados" placeholder=""
												 class="form-control" style="text-transform:uppercase;"
                                        		onkeyup="javascript:this.value=this.value.toUpperCase();"
                                        		disabled="disabled">
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
<script type="text/javascript" src="web/custom-js/tiraje.js"></script>
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
