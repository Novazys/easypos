<?php

	$objPerecedero =  new Perecedero();
	if($tipo_usuario==1){
?>

			<!-- Basic initialization -->
			<div class="panel panel-flat">
				<div class="breadcrumb-line">
					<ul class="breadcrumb">
						<li><a href="?View=Inicio"><i class="icon-home2 position-left"></i> Inicio</a></li>
						<li><a href="javascript:;">Almacen</a></li>
						<li class="active">Productos Perecederos</li>
					</ul>
				</div>
					<div class="panel-heading">
						<h5 class="panel-title">Productos Perecederos</h5>
						<br>
						 <div class="row">
							 <div class="col-sm-6 col-md-5">
							 	<form role="form" autocomplete="off" class="form-validate-jquery" id="frmSearch">
									<div class="form-group">
										<div class="row">
											<div class="col-sm-5">
												<div class="input-group">
												<span class="input-group-addon"><i class="icon-calendar3"></i></span>
												<input type="text" id="txtF1" name="txtF1" placeholder=""
												 class="form-control input-sm" style="text-transform:uppercase;"
						                		onkeyup="javascript:this.value=this.value.toUpperCase();">
						                		</div>
											</div>
											<div class="col-sm-5">
												<div class="input-group">
												<span class="input-group-addon"><i class="icon-calendar3"></i></span>
												<input type="text" id="txtF2" name="txtF2" placeholder=""
												 class="form-control input-sm" style="text-transform:uppercase;"
						                		onkeyup="javascript:this.value=this.value.toUpperCase();">
						                		</div>
											</div>
											<div class="col-sm-2">
												<button style="margin-top: 0px;" id="btnBuscar" type="submit" class="btn btn-info btn-sm">
												<i class="icon-search4"></i> Consultar</button>
											</div>
										</div>
									</div>
								  </form>
						   	  </div>
						  </div>

						<div class="heading-elements">

							<div class="btn-group">
		                    	<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
		                    	<i class="icon-paragraph-justify3 position-left"></i> Opciones
		                    	<span class="caret"></span></button>
		                    	<ul class="dropdown-menu dropdown-menu-right">
									<li><a href="javascript:void(0)" onclick="newPerecedero()">
									<i class="icon-database-add"></i>
									Agregar Nuevo/a</a></li>
									<li class="divider"></li>
									<li><a id="print_reporte" href="javascript:void(0)">
									<i class="icon-file-pdf"></i> Imprimir Reporte</a></li>
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
								<th>Barra</th>
								<th>Producto</th>
								<th>Marca</th>
								<th>Presentacion</th>
								<th>Vence</th>
								<th>Cant</th>
								<th>Estado</th>
								<th class="text-center">Opciones</th>
							</tr>
						</thead>

						<tbody>

						  <?php
								$filas = $objPerecedero->Listar_Perecederos(null,null);
								if (is_array($filas) || is_object($filas))
								{
								foreach ($filas as $row => $column)
								{

									$fecha_vencimiento = $column["fecha_vencimiento"];
									if(is_null($fecha_vencimiento))
									{
										$envio_date = '';

									} else {

									$envio_date = DateTime::createFromFormat('Y-m-d',$fecha_vencimiento)->format('d/m/Y');

									}

								?>
									<tr>

					                	<td><?php print($column['codigo_barra']); ?></td>
					                	<td><?php print($column['nombre_producto']); ?></td>
					                	<td><?php print($column['nombre_marca']); ?></td>
					                	<td><?php print($column['siglas']); ?></td>
					                	<td><?php print($envio_date); ?></td>
					                	<td><?php print($column['cantidad_perecedero']); ?></td>
														<td><?php if($column['estado_perecedero'] == '1'){
					                		echo '<span class="label label-success label-rounded"><span
					                		class="text-bold">VIGENTE</span></span>';
														} else if($column['estado_perecedero'] == '0') {
					                		echo '<span class="label label-warning label-rounded">
					                	<span
					                	    class="text-bold">VENCIDO</span></span>';
														} else if ($column['estado_perecedero'] == '2'){
															echo '<span class="label bg-violet label-rounded">
					                	<span
					                	    class="text-bold">CANT. AGOTADA</span></span>';
														}
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
													onclick="openPerecedero('editar',
								                     '<?php print($envio_date); ?>',
								                     '<?php print($column["cantidad_perecedero"]); ?>',
								                     '<?php print($column["estado_producto"]); ?>',
								                     '<?php print($column["idproducto"]); ?>')">
												   <i class="icon-pencil6">
											       </i> Editar</a></li>
													<li><a
													href="javascript:;" data-toggle="modal" data-target="#modal_iconified"
													onclick="openPerecedero('ver',
								                     '<?php print($envio_date); ?>',
								                     '<?php print($column["cantidad_perecedero"]); ?>',
								                     '<?php print($column["estado_producto"]); ?>',
								                     '<?php print($column["idproducto"]); ?>')">
													<i class=" icon-eye8">
													</i> Ver</a></li>
													<li><a id="delete_product"
													data-id="<?php print($column['idproducto'].','.$column['fecha_vencimiento']); ?>"
													href="javascript:void(0)">
													<i class=" icon-trash">
													</i> Borrar</a></li>
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
												<label>Producto <span class="text-danger"> * </span></label>
												<select  data-placeholder="..." id="cbProducto" name="cbProducto"
													class="select-search" style="text-transform:uppercase;"
				                            		onkeyup="javascript:this.value=this.value.toUpperCase();">
				                            			 <?php
															$filas = $objPerecedero->Listar_Productos();
															if (is_array($filas) || is_object($filas))
															{
															foreach ($filas as $row => $column)
															{
															?>
																<option value="<?php print ($column["idproducto"])?>">
																<?php print ($column["codigo_barra"].' - '.$column["nombre_producto"])?></option>
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
											<div class="col-sm-4">
												<label>Fecha Vencimiento <span class="text-danger"> * </span></label>
												<div class="input-group">
												<span class="input-group-addon"><i class="icon-calendar3"></i></span>
												<input type="text" id="txtFechaV" name="txtFechaV" placeholder=""
												 class="form-control" style="text-transform:uppercase;"
		                                		onkeyup="javascript:this.value=this.value.toUpperCase();">
		                                		</div>
											</div>

											<div class="col-sm-5">
												<label>Cantidad <span class="text-danger">*</span></label>
												<input type="text" id="txtCantidad" name="txtCantidad" placeholder="EJ. 1"
												 class="form-control" value="1" style="text-transform:uppercase;"
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
<script type="text/javascript" src="web/custom-js/perecedero.js"></script>
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
