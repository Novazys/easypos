<?php 

	function __autoload($className){
		$model = "../../model/". $className ."_model.php";
		$controller = "../../controller/". $className ."_controller.php";
	
		require_once($model);
		require_once($controller);
	}

	$mes = isset($_GET['mes']) ? $_GET['mes'] : '';

	if($mes=='empty')
	{
		$mes = DateTime::createFromFormat('m/Y', date('m/Y'))->format('m-Y');

	} else {

		$mes = DateTime::createFromFormat('m/Y', $mes)->format('m-Y');
	}

	$objCompra =  new Compra();
	$count_compras = $objCompra->Count_Compras('MES',$mes,'');

	foreach ($count_compras as $row => $column) {
		
		$compras_anuladas = $column["compras_anuladas"];
		$compras_vigentes = $column["compras_vigentes"];
		$compras_contado = $column["compras_contado"];
		$compras_credito = $column["compras_credito"];

	}


?>
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
																$filas = $objCompra->Listar_Compras('MES',$mes,'',1,''); 
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
																$filas = $objCompra->Listar_Compras('MES',$mes,'',0,''); 
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
																$filas = $objCompra->Listar_Compras('MES',$mes,'','',1); 
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
													<button type="button"  id="print_credito"
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
																$filas = $objCompra->Listar_Compras('MES',$mes,'','',2); 
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
<script type="text/javascript" src="web/custom-js/comprames.js"></script>