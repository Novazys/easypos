<?php

	$objCompra =  new Compra();
	$count_compras = $objCompra->Count_Compras('FECHAS','','');

	if($tipo_usuario==1){

	foreach ($count_compras as $row => $column) {

		$compras_anuladas = $column["compras_anuladas"];
		$compras_vigentes = $column["compras_vigentes"];
		$compras_contado = $column["compras_contado"];
		$compras_credito = $column["compras_credito"];

	}



 ?>

			<!-- Labels -->
			<div class="row">
				<div class="col-lg-12">
					<div class="panel panel-flat">
						<div class="breadcrumb-line">
							<ul class="breadcrumb">
								<li><a href="?View=Inicio"><i class="icon-home2 position-left"></i> Inicio</a></li>
								<li><a href="javascript:;">Compras</a></li>
								<li class="active">Compras por Fechas</li>
							</ul>
						</div>
						<div class="panel-heading">
							<h6 class="panel-title">Compras por Fechas</h6>

					<div class="heading-elements">
							<form class="heading-form" action="#">
								<div class="form-group">
									<div class="checkbox checkbox-switchery switchery-sm">
										<label>
										<input type="checkbox" id="chkEstado" name="chkEstado"
										 class="switchery" checked="checked" >
										 <span id="lblchk">REPORTES DETALLADOS</span>
										 </label>
									</div>
								</div>
							</form>
						</div>

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
											<button style="margin-top: 0px;" id="btnGuardar" type="submit" class="btn btn-primary btn-sm">
											<i class="icon-search4"></i> Consultar</button>
										</div>
									</div>
								</div>
							  </form>
					   	  </div>
					  </div>

					</div>

					<div id="reload-div">
						<div class="panel-body">
							<div class="tabbable">
								<ul class="nav nav-tabs nav-tabs-highlight">
									<li class="active"><a href="#label-tab1" data-toggle="tab">VIGENTES <span id="span-ing" class="label
									label-success position-right"><?php echo $compras_vigentes ?></span></a></li>
									<li><a href="#label-tab2" data-toggle="tab">ANULADAS <span id="span-dev" class="label bg-danger
									position-right"><?php echo $compras_anuladas ?></span></a></li>
									<li><a href="#label-tab3" data-toggle="tab">COMPRAS AL CONTADO <span id="span-pre" class="label bg-warning
									position-right"><?php echo $compras_contado ?></span></a></li>
									<li><a href="#label-tab4" data-toggle="tab">COMPRAS AL CREDITO <span id="span-gas" class="label bg-info
									position-right"><?php echo $compras_credito ?></span></a></li>
								</ul>

								<div class="tab-content">
									<div class="tab-pane active" id="label-tab1">
										<!-- Basic initialization -->
										<div class="panel panel-flat">
											<div class="panel-heading">
												<h5 class="panel-title">Compras Vigentes</h5>
												<div class="heading-elements">
													<button type="button" id="print_vigentes"
													class="btn bg-danger-400 heading-btn" id="btnPrint" value="vigentes">
													<i class="icon-printer2"></i> Imprimir Reporte</button>
												</div>
											</div>
												<div class="panel-body">
													<table class="table datatable-basic table-xs table-hover">
														<thead>
															<tr>
																<th>Comprobante</th>
																<th>No.Comprobante</th>
																<th>F.Comprobante</th>
																<th>Proveedor</th>
																<th>Tipo Pago</th>
																<th>Total</th>
																<th>Estado</th>
																<th>Opciones</th>
															</tr>
														</thead>

														<tbody>

														  <?php
																$filas = $objCompra->Listar_Compras('FECHAS','','',1,'');
																if (is_array($filas) || is_object($filas))
																{
																foreach ($filas as $row => $column)
																{

																$fecha_comprobante = $column["fecha_comprobante"];
																if(is_null($fecha_comprobante))
																{
																	$c_fecha_comprobante = '';

																} else {

																	$c_fecha_comprobante = DateTime::createFromFormat('Y-m-d',$fecha_comprobante)->format('d/m/Y');
																}

																$tipo_comprobante = $column["tipo_comprobante"];
																if($tipo_comprobante == '1')
																{
																	$tipo_comprobante = 'TICKET';

																} else if ($tipo_comprobante == '2'){

																	$tipo_comprobante = 'FACTURA';

																} else if ($tipo_comprobante == '3'){

																	$tipo_comprobante = 'CREDITO FISCAL';
																}


																$tipo_pago = $column["tipo_pago"];
																if($tipo_pago == '1')
																{
																	$tipo_pago = 'CONTADO';

																} else if ($tipo_pago == '2'){

																	$tipo_pago = 'CREDITO';

																}

																?>
																	<tr>
																		<td><?php print($tipo_comprobante); ?></td>
													                	<td><?php print($column['numero_comprobante']); ?></td>
													                	<td><?php print($c_fecha_comprobante); ?></td>
													                	<td><?php print($column['nombre_proveedor']); ?></td>
													                	<td><?php print($tipo_pago); ?></td>
													                	<td><?php print($column['total']); ?></td>
													                	<td><?php if($column['estado_compra'] == '1')
													                		echo '<span class="label label-success label-rounded"><span
													                		class="text-bold">VIGENTE</span></span>';
													                		else
													                		echo '<span class="label label-default label-rounded">
													                	<span
													                	    class="text-bold">ANULADA</span></span>'
														                ?></td>
																		<td class="text-center">
																			<ul class="icons-list">
																				<li class="dropdown">
																					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
																						<i class="icon-menu9"></i>
																					</a>
																					<ul class="dropdown-menu dropdown-menu-right">

																					   <li><a id="delete_product"
																					   data-id="<?php print($column['idcompra']); ?>"
																						href="javascript:void(0)">
																					   <i class="icon-cancel-circle2">
																				       </i> Anular</a></li>

																					   <li><a id="detail_pay"  data-toggle="modal" data-target="#modal_detalle"
																					   data-id="<?php print($column['idcompra']); ?>"
																						href="javascript:void(0)">
																					   <i class="icon-file-spreadsheet">
																				       </i> Ver Detalle</a></li>

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
												<h5 class="panel-title">Compras Anuladas</h5>
												<div class="heading-elements">
													<button type="button" id="print_anuladas"
													class="btn bg-danger-400 heading-btn" id="btnPrint" value="anuladas">
													<i class="icon-printer2"></i> Imprimir Reporte</button>
												</div>
											</div>
												<div class="panel-body">
													<table class="table datatable-basic table-xs table-hover">
														<thead>
															<tr>
																<th>Comprobante</th>
																<th>No.Comprobante</th>
																<th>F.Comprobante</th>
																<th>Proveedor</th>
																<th>Tipo Pago</th>
																<th>Total</th>
																<th>Estado</th>
																<th>Opciones</th>
															</tr>
														</thead>

														<tbody>

														  <?php
																$filas = $objCompra->Listar_Compras('FECHAS','','',0,'');
																if (is_array($filas) || is_object($filas))
																{
																foreach ($filas as $row => $column)
																{

																$fecha_comprobante = $column["fecha_comprobante"];
																if(is_null($fecha_comprobante))
																{
																	$c_fecha_comprobante = '';

																} else {

																	$c_fecha_comprobante = DateTime::createFromFormat('Y-m-d',$fecha_comprobante)->format('d/m/Y');
																}

																$tipo_comprobante = $column["tipo_comprobante"];
																if($tipo_comprobante == '1')
																{
																	$tipo_comprobante = 'TICKET';

																} else if ($tipo_comprobante == '2'){

																	$tipo_comprobante = 'FACTURA';

																} else if ($tipo_comprobante == '3'){

																	$tipo_comprobante = 'CREDITO FISCAL';
																}


																$tipo_pago = $column["tipo_pago"];
																if($tipo_pago == '1')
																{
																	$tipo_pago = 'CONTADO';

																} else if ($tipo_pago == '2'){

																	$tipo_pago = 'CREDITO';

																}

																?>
																	<tr>
																		<td><?php print($tipo_comprobante); ?></td>
													                	<td><?php print($column['numero_comprobante']); ?></td>
													                	<td><?php print($c_fecha_comprobante); ?></td>
													                	<td><?php print($column['nombre_proveedor']); ?></td>
													                	<td><?php print($tipo_pago); ?></td>
													                	<td><?php print($column['total']); ?></td>
													                	<td><?php if($column['estado_compra'] == '1')
													                		echo '<span class="label label-success label-rounded"><span
													                		class="text-bold">VIGENTE</span></span>';
													                		else
													                		echo '<span class="label label-default label-rounded">
													                	<span
													                	    class="text-bold">ANULADA</span></span>'
														                ?></td>
														                <td class="text-center">
																			<ul class="icons-list">
																				<li class="dropdown">
																					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
																						<i class="icon-menu9"></i>
																					</a>
																					<ul class="dropdown-menu dropdown-menu-right">

																					   <li><a id="detail_pay"  data-toggle="modal" data-target="#modal_detalle"
																					   data-id="<?php print($column['idcompra']); ?>"
																						href="javascript:void(0)">
																					   <i class="icon-file-spreadsheet">
																				       </i> Ver Detalle</a></li>

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
												<h5 class="panel-title">Compras al Contado</h5>
												<div class="heading-elements">
													<button type="button" id="print_contado"
													class="btn bg-danger-400 heading-btn" id="btnPrint" value="contado">
													<i class="icon-printer2"></i> Imprimir Reporte</button>
												</div>
											</div>
												<div class="panel-body">
													<table class="table datatable-basic table-xs table-hover">
														<thead>
															<tr>
																<th>Comprobante</th>
																<th>No.Comprobante</th>
																<th>F.Comprobante</th>
																<th>Proveedor</th>
																<th>Tipo Pago</th>
																<th>Total</th>
																<th>Estado</th>
																<th>Opciones</th>
															</tr>
														</thead>

														<tbody>

														  <?php
																$filas = $objCompra->Listar_Compras('FECHAS','','','',1);
																if (is_array($filas) || is_object($filas))
																{
																foreach ($filas as $row => $column)
																{

																$fecha_comprobante = $column["fecha_comprobante"];
																if(is_null($fecha_comprobante))
																{
																	$c_fecha_comprobante = '';

																} else {

																	$c_fecha_comprobante = DateTime::createFromFormat('Y-m-d',$fecha_comprobante)->format('d/m/Y');
																}

																$tipo_comprobante = $column["tipo_comprobante"];
																if($tipo_comprobante == '1')
																{
																	$tipo_comprobante = 'TICKET';

																} else if ($tipo_comprobante == '2'){

																	$tipo_comprobante = 'FACTURA';

																} else if ($tipo_comprobante == '3'){

																	$tipo_comprobante = 'CREDITO FISCAL';
																}


																$tipo_pago = $column["tipo_pago"];
																if($tipo_pago == '1')
																{
																	$tipo_pago = 'CONTADO';

																} else if ($tipo_pago == '2'){

																	$tipo_pago = 'CREDITO';

																}

																?>
																	<tr>
																		<td><?php print($tipo_comprobante); ?></td>
													                	<td><?php print($column['numero_comprobante']); ?></td>
													                	<td><?php print($c_fecha_comprobante); ?></td>
													                	<td><?php print($column['nombre_proveedor']); ?></td>
													                	<td><?php print($tipo_pago); ?></td>
													                	<td><?php print($column['total']); ?></td>
													                	<td><?php if($column['estado_compra'] == '1')
													                		echo '<span class="label label-success label-rounded"><span
													                		class="text-bold">VIGENTE</span></span>';
													                		else
													                		echo '<span class="label label-default label-rounded">
													                	<span
													                	    class="text-bold">ANULADA</span></span>'
														                ?></td>
														                <td class="text-center">
																			<ul class="icons-list">
																				<li class="dropdown">
																					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
																						<i class="icon-menu9"></i>
																					</a>
																					<ul class="dropdown-menu dropdown-menu-right">

																					   <li><a id="detail_pay"  data-toggle="modal" data-target="#modal_detalle"
																					   data-id="<?php print($column['idcompra']); ?>"
																						href="javascript:void(0)">
																					   <i class="icon-file-spreadsheet">
																				       </i> Ver Detalle</a></li>

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

									<div class="tab-pane" id="label-tab4">
										<!-- Basic initialization -->
										<div class="panel panel-flat">
											<div class="panel-heading">
												<h5 class="panel-title">Compras al Credito</h5>
												<div class="heading-elements">
													<button type="button" id="print_credito"
													class="btn bg-danger-400 heading-btn" id="btnPrint" value="credito">
													<i class="icon-printer2"></i> Imprimir Reporte</button>
												</div>
											</div>
												<div class="panel-body">
													<table class="table datatable-basic table-xs table-hover">
														<thead>
															<tr>
																<th>Comprobante</th>
																<th>No.Comprobante</th>
																<th>F.Comprobante</th>
																<th>Proveedor</th>
																<th>Tipo Pago</th>
																<th>Total</th>
																<th>Estado</th>
																<th>Opciones</th>
															</tr>
														</thead>

														<tbody>

														  <?php
																$filas = $objCompra->Listar_Compras('FECHAS','','','',2);
																if (is_array($filas) || is_object($filas))
																{
																foreach ($filas as $row => $column)
																{

																$fecha_comprobante = $column["fecha_comprobante"];
																if(is_null($fecha_comprobante))
																{
																	$c_fecha_comprobante = '';

																} else {

																	$c_fecha_comprobante = DateTime::createFromFormat('Y-m-d',$fecha_comprobante)->format('d/m/Y');
																}

																$tipo_comprobante = $column["tipo_comprobante"];
																if($tipo_comprobante == '1')
																{
																	$tipo_comprobante = 'TICKET';

																} else if ($tipo_comprobante == '2'){

																	$tipo_comprobante = 'FACTURA';

																} else if ($tipo_comprobante == '3'){

																	$tipo_comprobante = 'CREDITO FISCAL';
																}


																$tipo_pago = $column["tipo_pago"];
																if($tipo_pago == '1')
																{
																	$tipo_pago = 'CONTADO';

																} else if ($tipo_pago == '2'){

																	$tipo_pago = 'CREDITO';

																}

																?>
																	<tr>
																		<td><?php print($tipo_comprobante); ?></td>
													                	<td><?php print($column['numero_comprobante']); ?></td>
													                	<td><?php print($c_fecha_comprobante); ?></td>
													                	<td><?php print($column['nombre_proveedor']); ?></td>
													                	<td><?php print($tipo_pago); ?></td>
													                	<td><?php print($column['total']); ?></td>
													                	<td><?php if($column['estado_compra'] == '1')
													                		echo '<span class="label label-success label-rounded"><span
													                		class="text-bold">VIGENTE</span></span>';
													                		else
													                		echo '<span class="label label-default label-rounded">
													                	<span
													                	    class="text-bold">ANULADA</span></span>'
														                ?></td>
														                <td class="text-center">
																			<ul class="icons-list">
																				<li class="dropdown">
																					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
																						<i class="icon-menu9"></i>
																					</a>
																					<ul class="dropdown-menu dropdown-menu-right">

																					   <li><a id="delete_product"
																					   data-id="<?php print($column['idcompra']); ?>"
																						href="javascript:void(0)">
																					   <i class="icon-cancel-circle2">
																				       </i> Anular</a></li>

																					   <li><a id="detail_pay"  data-toggle="modal" data-target="#modal_detalle"
																					   data-id="<?php print($column['idcompra']); ?>"
																						href="javascript:void(0)">
																					   <i class="icon-file-spreadsheet">
																				       </i> Ver Detalle</a></li>

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


<!-- Iconified modal -->
	<div id="modal_detalle" class="modal fade"  data-backdrop="false">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h5 class="modal-title"></i> &nbsp; <span class="title-form text-uppercase">Detalle de Compra</span></h5>
				</div>

		        <form role="form" autocomplete="off" class="form-validate-jquery" id="frmModal">
					<div class="modal-body" id="modal-container">

					<div id="reload-detalle">
							<!-- Collapsible with right control button -->
							<div class="panel-group panel-group-control panel-group-control-right content-group-lg">
								<div class="panel">
									<div class="panel-heading bg-info">
										<h6 class="panel-title">
											<a class="collapsed" data-toggle="collapse" href="#collapsible-control-right-group2">Clic para ver Información de la Compra</a>
										</h6>
									</div>
									<div id="collapsible-control-right-group2" class="panel-collapse collapse">
										<div class="panel-body">
											<div class="table-responsive">
												<table class="table table-xxs table-bordered">
												 <tbody class="border-solid">
													 <tr>
													 	<td width="5%" class="text-bold text-left">FECHA COMPRA</td>
														<td width="30%"></td>
														<td width="2%" class="text-bold text-left">FORMA PAGO</td>
														<td width="30%"></td>
													 </tr>
													<tr>
														<td width="5%" class="text-bold text-left">PROVEEDOR</td>
														<td width="30%"></td>
														<td width="2%" class="text-bold text-left">NIT</td>
														<td width="30%"></td>
													</tr>
													<tr>
														<td width="20%" class="text-bold text-left">NO. COMPROBANTE</td>
														<td width="5%"></td>
														<td width="10%" class="text-bold text-left">COMPROBANTE</td>
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
												<td width="10%">SUMAS</td>
												<td id="sumas"></td>
												<td></td>
											</tr>
											<tr>
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
												<td width="10%">SUBTOTAL</td>
												<td id="subtotal"></td>
												<td></td>
											</tr>
											<tr>
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
												<td width="10%">T. EXENTO</td>
												<td id="exentas"></td>
												<td></td>
											</tr>
											<tr>
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


<script type="text/javascript" src="web/custom-js/comprafechas.js"></script>



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
