<?php

	$objCredito = new Credito();
	$count_creditos = $objCredito->Count_Creditos();

	foreach ($count_creditos as $row => $column) {
		$total_vigentes = $column["count_pendientes"];
		$total_pagados = $column["count_pagados"];
	}



 ?>

			<!-- Labels -->
			<div class="row">
				<div class="col-lg-12">
					<div class="panel panel-flat">
						<div class="breadcrumb-line">
							<ul class="breadcrumb">
								<li><a href="?View=Inicio"><i class="icon-home2 position-left"></i> Inicio</a></li>
								<li><a href="javascript:;">Ventas al Credito</a></li>
								<li class="active">Administrar Credito</li>
							</ul>
						</div>
						<div class="panel-heading">
							<h5 class="panel-title">Administracion de Creditos</h5>
						</div>

					<div id="reload-div">
						<div class="panel-body">
							<div class="tabbable">
								<ul class="nav nav-tabs nav-tabs-highlight">
									<li class="active"><a href="#label-tab1" data-toggle="tab">VIGENTES <span id="span-ing" class="label
									label-success position-right"><?php echo $total_vigentes  ?></span></a></li>
									<li><a href="#label-tab2" data-toggle="tab">FINALIZADOS <span id="span-dev" class="label bg-danger
									position-right"><?php echo $total_pagados  ?></span></a></li>
									<li><a href="#label-tab3" data-toggle="tab">ABONOS <span id="span-pre" class="label bg-warning
									position-right"></span></a></li>
								</ul>

								<div class="tab-content">
									<div class="tab-pane active" id="label-tab1">
										<!-- Basic initialization -->
										<div class="panel panel-flat">
											<div class="panel-heading">
												<h5 class="panel-title">Creditos Vigentes</h5>
												<div class="heading-elements">

												</div>
											</div>
												<div class="panel-body">
													<table class="table datatable-basic table-xs table-hover">
														<thead>
															<tr>
																<th>Credito</th>
																<th>Venta</th>
																<th>Monto</th>
																<th>Abonado</th>
																<th>Restante</th>
																<th>Cliente</th>
																<th>Opciones</th>
															</tr>
														</thead>

														<tbody>

														  <?php
																$filas = $objCredito->Listar_Creditos(0);
																if (is_array($filas) || is_object($filas))
																{
																foreach ($filas as $row => $column)
																{

																	$fecha_credito = $column["fecha_credito"];
																	if(is_null($fecha_credito))
																	{
																		$c_fecha_credito = '';

																	} else {

																		$c_fecha_credito = DateTime::createFromFormat('Y-m-d H:i:s',$fecha_credito)->format('d/m/Y H:i:s');
																	}

																?>
																	<tr>
																			<td><?php print($column['codigo_credito']); ?></td>
										                	<td><?php print($column['numero_venta']); ?></td>
										                	<td><?php print($column['monto_credito']); ?></td>
																			<td><?php print($column['monto_abonado']); ?></td>
																			<td><?php print($column['monto_restante']); ?></td>
																			<td><?php print($column['cliente']); ?></td>

																		<td class="text-center">
																			<ul class="icons-list">
																				<li class="dropdown">
																					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
																						<i class="icon-menu9"></i>
																					</a>
																					<ul class="dropdown-menu dropdown-menu-right">
																						<?php if($tipo_usuario == 1){ ?>
																						<li><a
																						href="javascript:;" data-toggle="modal" data-target="#Modal_Credito"
																						onclick="openCredito('editar',
																							 '<?php print($column["idcredito"]); ?>',
																							 '<?php print($column["codigo_credito"]); ?>',
																							 '<?php print($column["nombre_credito"]); ?>',
																							 '<?php print($c_fecha_credito); ?>',
																							 '<?php print($column["monto_credito"]); ?>',
																							 '<?php print($column["monto_abonado"]); ?>',
																							 '<?php print($column["monto_restante"]); ?>',
																							 '<?php print($column["estado_credito"]); ?>')">
																						 <i class="icon-pencil6">
																							 </i> Editar</a></li>
																							 <?php } ?>

																					   <li><a id="detail_pay"  data-toggle="modal" data-target="#modal_detalle" data-toggle="modal" data-target="#modal_detalle"
																					   data-id="<?php print($column['idventa']); ?>"
																						href="javascript:void(0)">
																					   <i class="icon-file-spreadsheet">
																				       </i> Ver Detalle</a></li>

																				       <li><a id="print_estado"
																					   data-id="<?php print($column['codigo_credito'].','.$column['idcredito']); ?>"
																						href="javascript:void(0)">
																					   <i class="icon-typewriter">
																						 </i> Estado de Cuenta</a></li>

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
									</div>

									<div class="tab-pane" id="label-tab2">
										<!-- Basic initialization -->
										<div class="panel panel-flat">
											<div class="panel-heading">
												<h5 class="panel-title">Creditos Finalizados</h5>
												<div class="heading-elements">

												</div>
											</div>
												<div class="panel-body">
													<table class="table datatable-basic table-xs table-hover">
														<thead>
															<tr>
																<th>Credito</th>
																<th>Venta</th>
																<th>Monto</th>
																<th>Abonado</th>
																<th>Restante</th>
																<th>Cliente</th>
																<th>Opciones</th>
															</tr>
														</thead>

														<tbody>

														  <?php
																$filas = $objCredito->Listar_Creditos(1);
																if (is_array($filas) || is_object($filas))
																{
																foreach ($filas as $row => $column)
																{


																?>
																	<tr>
																			<td><?php print($column['codigo_credito']); ?></td>
										                	<td><?php print($column['numero_venta']); ?></td>
										                	<td><?php print($column['monto_credito']); ?></td>
																			<td><?php print($column['monto_abonado']); ?></td>
																			<td><?php print($column['monto_restante']); ?></td>
																			<td><?php print($column['cliente']); ?></td>

																		<td class="text-center">
																			<ul class="icons-list">
																				<li class="dropdown">
																					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
																						<i class="icon-menu9"></i>
																					</a>
																					<ul class="dropdown-menu dropdown-menu-right">

																					   <li><a id="detail_pay"  data-toggle="modal" data-target="#modal_detalle" data-toggle="modal" data-target="#modal_detalle"
																					   data-id="<?php print($column['idcredito']); ?>"
																						href="javascript:void(0)">
																					   <i class="icon-file-spreadsheet">
																				       </i> Ver Detalle</a></li>

																							 <li><a id="print_estado"
																						 data-id="<?php print($column['codigo_credito'].','.$column['idcredito']); ?>"
																						href="javascript:void(0)">
																						 <i class="icon-typewriter">
																						 </i> Estado de Cuenta</a></li>

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
									</div>


									<div class="tab-pane" id="label-tab3">
										<!-- Basic initialization -->
										<div class="panel panel-flat">
											<div class="panel-heading">
												<h5 class="panel-title">Abonos</h5>
												<div class="heading-elements">
													<?php $filas = $objCredito->Listar_Creditos(0);
													if (is_array($filas) || is_object($filas))
													{ ?>
													<button type="button" class="btn btn-primary heading-btn"
													onclick="newAbono()">
													<i class="icon-database-add"></i> Agregar Nuevo/a</button>
													<?php } ?>

													<button type="button" class="btn btn-danger heading-btn"
													data-toggle="modal" data-target="#modal_print">
													<i class="icon-printer2"></i> Imprimir Reporte</button>

												</div>
											</div>
												<div class="panel-body">
													<table class="table datatable-basic table-xs table-hover">
														<thead>
															<tr>
																<th>Credito</th>
																<th>Fecha Abono</th>
																<th>Monto Abonado</th>
																<th>Opciones</th>
															</tr>
														</thead>

														<tbody>

														  <?php
																$filas = $objCredito->Listar_Abonos_All();
																if (is_array($filas) || is_object($filas))
																{
																foreach ($filas as $row => $column)
																{
																	$fecha_abono = $column["fecha_abono"];
																	if(is_null($fecha_abono))
																	{
																		$c_fecha_abono = '';

																	} else {

																		$c_fecha_abono = DateTime::createFromFormat('Y-m-d H:i:s',$fecha_abono)->format('d/m/Y H:i:s');
																	}

																?>
																	<tr>
																			<td><?php print($column['codigo_credito']); ?></td>
										                	<td><?php print($c_fecha_abono); ?></td>
										                	<td><?php print($column['monto_abono']); ?></td>


																		<td class="text-center">
																			<ul class="icons-list">
																				<li class="dropdown">
																					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
																						<i class="icon-menu9"></i>
																					</a>
																					<ul class="dropdown-menu dropdown-menu-right">

																						<li><a
																						href="javascript:;" data-toggle="modal" data-target="#Modal_Abono"
																						onclick="openAbono('ver',
													                     '<?php print($column["idabono"]); ?>',
																							 '<?php print($column['codigo_credito']); ?>',
													                     '<?php print($c_fecha_abono); ?>',
																							 '<?php print($column['monto_abono']); ?>',
													                     '<?php print($column["idcredito"]); ?>')">
																					   <i class="icon-eye">
																						 </i> Ver</a></li>

																						<?php if($tipo_usuario==1){ ?>
																							 <li><a id="delete_abono"
																							 data-id="<?php print($column['idabono']); ?>"
																							 href="javascript:void(0)">
																							 <i class=" icon-trash">
																							 </i> Borrar</a></li>
																						<?php } ?>

																						<li><a href="javascript:;" data-toggle="modal" data-target="#modal_ticket"
																						onclick="Print_Ticket('<?php print($column["idabono"]); ?>')">
																						 <i class="icon-printer">
																						 </i> Comprobante </a></li>

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
									</div>

								</div>
							</div>
						</div>
					</div>



			</div>
		</div>
	</div>
	<!-- /labels -->

	<!-- Modal Credito -->
		<div id="Modal_Credito" class="modal fade">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h5 class="modal-title"><i class="icon-pencil7"></i> &nbsp; <span class="title-form"></span></h5>
					</div>

					<form role="form" autocomplete="off" class="form-validate-jquery" id="frmCredito">
						<div class="modal-body" id="modal-container">

						<div class="alert alert-warning alert-styled-left text-black-800 content-group">
								<span class="text-semibold">Estimado usuario.</span>
							  Si usted modifica esta informacion, sepa que puede generar un descuadre entre
								los montos del Credito y la suma de abonos realizados.
								<button type="button" class="close" data-dismiss="alert">×</button>
								<input type="hidden" id="txtID_C" name="txtID_C" class="form-control" value="">
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
										<label>Nombre Credito <span class="text-danger">*</span></label>
										<input type="text" id="txtNombre" name="txtNombre" placeholder="EJ. POR VENTA #V00000005"
										 class="form-control" style="text-transform:uppercase;"
										 onkeyup="javascript:this.value=this.value.toUpperCase();">
									</div>
								</div>
							</div>

							<div class="form-group">
								<div class="row">
									<div class="col-sm-6">
										<label>Fecha Credito <span class="text-danger"> * </span></label>
										<div class="input-group">
										<span class="input-group-addon"><i class="icon-calendar3"></i></span>
										<input type="text" id="txtFechaC" name="txtFechaC" placeholder=""
										 class="form-control" style="text-transform:uppercase;"
										onkeyup="javascript:this.value=this.value.toUpperCase();">
										</div>
									</div>


									<div class="col-sm-6">
										<label>Monto Credito <span class="text-danger"> * </span></label>
										<input type="text" id="txtMonto" name="txtMonto" placeholder="0.00"
										 class="form-control input-sm" style="text-transform:uppercase;"
										 onkeyup="javascript:this.value=this.value.toUpperCase();">
									</div>

								</div>
							</div>

							<div class="form-group">
								<div class="row">

									<div class="col-sm-6">
										<label>Monto Abonado <span class="text-danger"> * </span></label>
										<input type="text" id="txtMontoA" name="txtMontoA" placeholder="0.00"
										 class="form-control input-sm" style="text-transform:uppercase;"
										 onkeyup="javascript:this.value=this.value.toUpperCase();">
									</div>


									<div class="col-sm-6">
										<label>Monto Restante <span class="text-danger"> * </span></label>
										<input type="text" id="txtMontoR" name="txtMontoR" placeholder="0.00"
										 class="form-control input-sm" style="text-transform:uppercase;"
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
							<button id="btnEditar_C" type="submit" class="btn btn-warning">Editar</button>
							<button  type="reset" class="btn btn-default" id="reset"
							class="btn btn-link" data-dismiss="modal">Cerrar</button>
						</div>
					</form>
				</div>
			</div>
		</div>
		<!-- /Modal Credito -->

	<!-- Modal Abono -->
		<div id="Modal_Abono" class="modal fade">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h5 class="modal-title"><i class="icon-pencil7"></i> &nbsp; <span class="title-form"></span></h5>
					</div>

					<form role="form" autocomplete="off" class="form-validate-jquery" id="frmAbono">
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
										 <label> Credito <span class="text-danger"> * </span></label>
										 <select  data-placeholder="..." id="cbCredito" name="cbCredito"
											 class="select-search" style="text-transform:uppercase;"
												 onkeyup="javascript:this.value=this.value.toUpperCase();">
													<?php
														 $filas = $objCredito->Listar_Creditos(0);
														 if (is_array($filas) || is_object($filas))
														 {
														 foreach ($filas as $row => $column)
														 {
														 ?>
															 <option value="<?php print ($column["idcredito"])?>">
															 <?php print ($column["codigo_credito"].' - '.$column["cliente"])?></option>
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
										<label>Fecha Abono <span class="text-danger"> * </span></label>
										<div class="input-group">
										<span class="input-group-addon"><i class="icon-calendar3"></i></span>
										<input type="text" id="txtFechaA" name="txtFechaA" placeholder=""
										 class="form-control" style="text-transform:uppercase;"
										onkeyup="javascript:this.value=this.value.toUpperCase();">
										</div>
									</div>


									<div class="col-sm-6">
										<label>Monto Abono <span class="text-danger"> * </span></label>
										<input type="text" id="txtMontoAbono" name="txtMontoAbono" placeholder="0.00"
										 class="form-control input-sm" style="text-transform:uppercase;"
										 onkeyup="javascript:this.value=this.value.toUpperCase();">
									</div>
								</div>
							</div>
						</div>

						<div class="modal-footer">
							<button id="btnGuardar" type="submit" class="btn btn-primary">Guardar</button>
							<button id="btnEditar_A" type="submit" class="btn btn-warning">Editar</button>
							<button  type="reset" class="btn btn-default" id="reset"
							class="btn btn-link" data-dismiss="modal">Cerrar</button>
						</div>
					</form>
				</div>
			</div>
		</div>
		<!-- /Modal Abono -->

<!-- Iconified modal -->
	<div id="modal_detalle" class="modal fade">
		<div class="modal-dialog modal-full">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h5 class="modal-title"></i> &nbsp; <span class="title-form text-uppercase">Detalle de Venta</span></h5>
				</div>

		        <form role="form" autocomplete="off" class="form-validate-jquery" id="frmModal">
					<div class="modal-body" id="modal-container">

					<div id="reload-detalle">
							<!-- Collapsible with right control button -->
							<div class="panel-group panel-group-control panel-group-control-right content-group-lg">
								<div class="panel">
									<div class="panel-heading bg-info">
										<h6 class="panel-title">
											<a class="collapsed" data-toggle="collapse" href="#collapsible-control-right-group2">Clic para ver Información de la Venta</a>
										</h6>
									</div>
									<div id="collapsible-control-right-group2" class="panel-collapse collapse">
										<div class="panel-body">
											<div class="table-responsive">
												<table class="table table-xxs table-bordered">
												 <tbody class="border-solid">
												 <tr>
												 	<td width="5%" class="text-bold text-left">NO. VENTA</td>
													<td width="35%"></td>
													<td width="2%" class="text-bold text-left">FORMA PAGO</td>
													<td width="30%"></td>
												 </tr>
												<tr>
													<td width="5%" class="text-bold text-left">CLIENTE</td>
													<td width="30%"></td>
													<td width="2%" class="text-bold text-left">FECHA VENTA</td>
													<td width="30%"></td>
												</tr>
												<tr>
													<td width="20%" class="text-bold text-left">NO. COMPROBANTE</td>
													<td width="5%"></td>
													<td width="10%" class="text-bold text-left"></td>
													<td width="5%"></td>
												</tr>
												</tbody>
											</table>
										 </div>
										</div>
									</div>
								</div>
							</div>
							<!-- /collapsible with right control button -->

							<div class="panel-group panel-group-control panel-group-control-right content-group-lg">
								<div class="table-responsive">
									<table id="tbldetalle" class="table table-borderless table-striped table-xxs">
										<thead>
											<tr class="bg-blue">
												<th>Producto</th>
												<th>Cant.</th>
												<th>Precio</th>
												<th>Exento</th>
												<th>Descuento</th>
												<th>Importe</th>
												<th>Vence</th>
											</tr>
										</thead>
										<tbody>

										</tbody>
										<tfoot>
											<tr>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td width="10%">SUMAS</td>
												<td id="sumas"></td>
												<td></td>
											</tr>
											<tr>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td width="10%">IVA %</td>
												<td id="iva"></td>
												<td></td>
											</tr>
											<tr>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td width="10%">SUBTOTAL</td>
												<td id="subtotal"></td>
												<td></td>
											</tr>
											<tr>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td width="10%">RET. (-)</td>
												<td id="ivaretenido"></td>
												<td></td>
											</tr>
											<tr>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td width="10%">T. EXENTO</td>
												<td id="exentas"></td>
												<td></td>
											</tr>
											<tr>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td width="10%">DESCUENTO</td>
												<td id="descuentos"></td>
												<td></td>
											</tr>
											<tr>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td width="10%">TOTAL</td>
												<td id="total"></td>
												<td></td>
											</tr>
										</tfoot>
									</table>
								</div>
							</div>

						</div>

					</div>
				</form>
			</div>
		</div>
	</div>
	<!-- /iconified modal -->

	<!-- Iconified modal - Reporte -->
		<div id="modal_print" class="modal fade">
			<div class="modal-dialog modal-sm">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h5 class="modal-title"><i class="icon-pencil7"></i> &nbsp; <span class="title-form">Reporte de Abonos</span></h5>
					</div>

							<form role="form" autocomplete="off" class="form-validate-jquery" id="frmReport">
						<div class="modal-body" id="modal-container">

						<div class="alert alert-info alert-styled-left text-blue-800 content-group">
								<span class="text-semibold">Estimado usuario</span>
								Los campos remarcados con <span class="text-danger"> * </span> son necesarios.
								<button type="button" class="close" data-dismiss="alert">×</button>

						</div>

							<div class="form-group">
								<div class="row">
									<div class="col-sm-6">
										<label>Desde <span class="text-danger">*</span></label>
										<div class="input-group">
										<span class="input-group-addon"><i class="icon-calendar3"></i></span>
										<input type="text" id="txtDesde" name="txtDesde" placeholder=""
										 class="form-control" style="text-transform:uppercase;"
										 onkeyup="javascript:this.value=this.value.toUpperCase();">
										</div>
									</div>

									<div class="col-sm-6">
										<label>Hasta <span class="text-danger">*</span></label>
										<div class="input-group">
										<span class="input-group-addon"><i class="icon-calendar3"></i></span>
										<input type="text" id="txtHasta" name="txtHasta" placeholder=""
										 class="form-control" style="text-transform:uppercase;"
										 onkeyup="javascript:this.value=this.value.toUpperCase();">
										</div>
									</div>

								</div>
							</div>


						</div>

						<div class="modal-footer">
							<button id="btnReport" type="submit" class="btn btn-primary">Ver Reporte</button>
							<button  type="reset" class="btn btn-default" id="reset"
							class="btn btn-link" data-dismiss="modal">Cerrar</button>
						</div>
					</form>
				</div>
			</div>
		</div>
		<!-- /iconified modal - Reporte -->

		<!-- Large modal -->
<div id="modal_ticket" class="modal fade">
<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">&times;</button>
			<h5 class="modal-title">Tickets de Abono</h5>
		</div>

		<div class="modal-body">
				<div class="row">
				<div class="col-md-12">
					<div class="panel panel-flat">
						<div class="panel-heading">
							<h6 class="panel-title">Original</h6>
						</div>
						<div class="panel-body">
								<iframe name="ticket_frame" width="100%" height="450" id="ticket_frame" src="" frameborder="0" scrolling="yes"></iframe>
						</div>
					</div>
				</div>

				<div class="col-md-12">
					<div class="panel panel-flat">
						<div class="panel-heading">
							<h6 class="panel-title">Copia Cliente</h6>
						</div>

						<div class="panel-body">

							<iframe name="ticket2_frame"  width="100%" height="450"  id="ticket2_frame" src="" frameborder="0" scrolling="yes"></iframe>

						</div>
					</div>
				</div>
		</div>

		<div class="modal-footer">
			<button type="button" class="btn btn-link" data-dismiss="modal">Cerrar</button>
		</div>
	</div>
</div>
</div>
<!-- /large modal -->


	<script type="text/javascript" src="web/custom-js/credito.js"></script>
