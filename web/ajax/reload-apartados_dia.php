<?php

	function __autoload($className){
		$model = "../../model/". $className ."_model.php";
		$controller = "../../controller/". $className ."_controller.php";

		require_once($model);
		require_once($controller);
	}

	$objVenta =  new Venta();
	$objApartado =  new Apartado();
	$count_Apartados = $objApartado->Count_Apartados('HOY','','');

	foreach ($count_Apartados as $row => $column) {

		$apartados_anuladas = $column["apartados_anuladas"];
		$apartados_vigentes = $column["apartados_vigentes"];
		$apartados_saldados = $column["apartados_saldados"];


	}



?>
						<div class="panel-body">
							<div class="tabbable">
								<ul class="nav nav-tabs nav-tabs-highlight">
									<li class="active"><a href="#label-tab1" data-toggle="tab">VIGENTES <span id="span-ing" class="label
									label-success position-right"><?php echo $apartados_vigentes ?></span></a></li>
									<li><a href="#label-tab2" data-toggle="tab">ANULADOS <span id="span-dev" class="label bg-danger
									position-right"><?php echo $apartados_anuladas ?></span></a></li>
									<li><a href="#label-tab3" data-toggle="tab">FINALIZADOS<span id="span-pre" class="label bg-warning
									position-right"><?php echo $apartados_saldados ?></span></a></li>
								</ul>

								<div class="tab-content">
									<div class="tab-pane active" id="label-tab1">
										<!-- Basic initialization -->
										<div class="panel panel-flat">
											<div class="panel-heading">
												<h5 class="panel-title">Apartados Vigentes</h5>
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
																<th>No. Apartado</th>
																<th>Fecha y Hora Apartado</th>
																<th>Fecha de Retiro</th>
																<th>Cliente</th>
																<th>Restante</th>
																<th>Estado</th>
																<th>Opciones</th>
															</tr>
														</thead>

														<tbody>

														  <?php
																$filas = $objApartado->Listar_Apartados('HOY','','',1);
																if (is_array($filas) || is_object($filas))
																{
																foreach ($filas as $row => $column)
																{

																$fecha_apartado = $column["fecha_apartado"];
																if(is_null($fecha_apartado))
																{
																	$c_fecha_apartado = '';

																} else {

																	$c_fecha_apartado = DateTime::createFromFormat('Y-m-d H:i:s',$fecha_apartado)->format('d/m/Y H:i:s');
																}

                                $fecha_limite_retiro = $column["fecha_limite_retiro"];
																if(is_null($fecha_limite_retiro))
																{
																	$c_fecha_limite_retiro = '';

																} else {

																	$c_fecha_limite_retiro = DateTime::createFromFormat('Y-m-d H:i:s',$fecha_limite_retiro)->format('d/m/Y H:i:s');
																}



																?>
																	<tr>
																		<td><?php print($column['numero_apartado']); ?></td>
													                	<td><?php print($c_fecha_apartado); ?></td>
                                            <td><?php print($c_fecha_limite_retiro); ?></td>
                                            <td><?php print($column['cliente']); ?></td>
													                	<td><?php print($column['restante_pagar']); ?></td>
													                	<td><?php if($column['estado_apartado'] == '1' || $column['estado_apartado'] == '2'):
													                		echo '<span class="label label-success label-rounded"><span
													                		class="text-bold">VIGENTE</span></span>';
													                		elseif($column['estado_apartado'] == '0'):
													                		echo '<span class="label label-default label-rounded">
													                	<span
													                	    class="text-bold">ANULADO</span></span>';
													                	 endif;
														                ?></td>
																		<td class="text-center">
																			<ul class="icons-list">
																				<li class="dropdown">
																					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
																						<i class="icon-menu9"></i>
																					</a>
																					<ul class="dropdown-menu dropdown-menu-right">

																		<?php if($column['estado_apartado'] == '1')	: ?>


																	<li><a
																	href="javascript:;" data-toggle="modal" data-target="#modal_iconified_cash"
																	onclick="openPago(
																	'<?php print($column["restante_pagar"]); ?>',
																		'<?php print($column["idcliente"]); ?>',
																	'<?php print($column["idapartado"]); ?>')">
																	<i class="icon-cash3">
																	</i> Finalizar Venta</a></li>

															<?php endif; ?>

															


																					   <li><a id="delete_product"
																					   data-id="<?php print($column['idapartado']); ?>"
																						href="javascript:void(0)">
																					   <i class="icon-cancel-circle2">
																				       </i> Anular</a></li>

																					   <li><a id="detail_pay"  data-toggle="modal" data-target="#modal_detalle" data-toggle="modal" data-target="#modal_detalle"
																					   data-id="<?php print($column['idapartado']); ?>"
																						href="javascript:void(0)">
																					   <i class="icon-file-spreadsheet">
																				       </i> Ver Detalle</a></li>

																				       <li><a id="print_receip"
																					   data-id="<?php print($column['idapartado']); ?>"
																						href="javascript:void(0)">
																					   <i class="icon-typewriter">
																				       </i> Comprobante</a></li>

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
												<h5 class="panel-title">Apartados Anulados</h5>
												<div class="heading-elements">
													<button type="button" id="print_anuladas"
													class="btn bg-danger-400 heading-btn" id="btnPrint" value="ANULADOs">
													<i class="icon-printer2"></i> Imprimir Reporte</button>
												</div>
											</div>
												<div class="panel-body">
													<table class="table datatable-basic table-xs table-hover">
														<thead>
															<tr>
																<th>No. Apartado</th>
																<th>Fecha y Hora Apartado</th>
																<th>Fecha de Retiro</th>
																<th>Cliente</th>
																<th>Total</th>
																<th>Estado</th>
																<th>Opciones</th>
															</tr>
														</thead>

                            <tbody>

                              <?php
                                $filas = $objApartado->Listar_Apartados('HOY','','',0);
                                if (is_array($filas) || is_object($filas))
                                {
                                foreach ($filas as $row => $column)
                                {

                                $fecha_apartado = $column["fecha_apartado"];
                                if(is_null($fecha_apartado))
                                {
                                  $c_fecha_apartado = '';

                                } else {

                                  $c_fecha_apartado = DateTime::createFromFormat('Y-m-d H:i:s',$fecha_apartado)->format('d/m/Y H:i:s');
                                }

                                $fecha_limite_retiro = $column["fecha_limite_retiro"];
                                if(is_null($fecha_limite_retiro))
                                {
                                  $c_fecha_limite_retiro = '';

                                } else {

                                  $c_fecha_limite_retiro = DateTime::createFromFormat('Y-m-d H:i:s',$fecha_limite_retiro)->format('d/m/Y H:i:s');
                                }



                                ?>
                                  <tr>
                                    <td><?php print($column['numero_apartado']); ?></td>
                                            <td><?php print($c_fecha_apartado); ?></td>
                                            <td><?php print($c_fecha_limite_retiro); ?></td>
                                            <td><?php print($column['cliente']); ?></td>
                                            <td><?php print($column['total']); ?></td>
						                	<td><?php if($column['estado_apartado'] == '1' || $column['estado_apartado'] == '2'):
						                		echo '<span class="label label-success label-rounded"><span
						                		class="text-bold">VIGENTE</span></span>';
						                		elseif($column['estado_apartado'] == '0'):
						                		echo '<span class="label label-default label-rounded">
						                	<span
						                	    class="text-bold">ANULADO</span></span>';
						                	 endif;
							                ?></td>
                                    <td class="text-center">
                                      <ul class="icons-list">
                                        <li class="dropdown">
                                          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                            <i class="icon-menu9"></i>
                                          </a>
                                          <ul class="dropdown-menu dropdown-menu-right">


                                             <li><a id="detail_pay"  data-toggle="modal" data-target="#modal_detalle" data-toggle="modal" data-target="#modal_detalle"
                                             data-id="<?php print($column['idapartado']); ?>"
                                            href="javascript:void(0)">
                                             <i class="icon-file-spreadsheet">
                                               </i> Ver Detalle</a></li>

                                               <li><a id="print_receip"
                                             data-id="<?php print($column['idapartado']); ?>"
                                            href="javascript:void(0)">
                                             <i class="icon-typewriter">
                                               </i> Comprobante</a></li>

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
												<h5 class="panel-title">Apartados Finalizados</h5>
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
																<th>No. Apartado</th>
																<th>Fecha y Hora Apartado</th>
																<th>Fecha de Retiro</th>
																<th>Cliente</th>
																<th>Total</th>
																<th>Estado</th>
																<th>Opciones</th>
															</tr>
														</thead>

                            <tbody>

                              <?php
                                $filas = $objApartado->Listar_Apartados('HOY','','',2);
                                if (is_array($filas) || is_object($filas))
                                {
                                foreach ($filas as $row => $column)
                                {

                                $fecha_apartado = $column["fecha_apartado"];
                                if(is_null($fecha_apartado))
                                {
                                  $c_fecha_apartado = '';

                                } else {

                                  $c_fecha_apartado = DateTime::createFromFormat('Y-m-d H:i:s',$fecha_apartado)->format('d/m/Y H:i:s');
                                }

                                $fecha_limite_retiro = $column["fecha_limite_retiro"];
                                if(is_null($fecha_limite_retiro))
                                {
                                  $c_fecha_limite_retiro = '';

                                } else {

                                  $c_fecha_limite_retiro = DateTime::createFromFormat('Y-m-d H:i:s',$fecha_limite_retiro)->format('d/m/Y H:i:s');
                                }



                                ?>
                                  <tr>
                                    <td><?php print($column['numero_apartado']); ?></td>
                                            <td><?php print($c_fecha_apartado); ?></td>
                                            <td><?php print($c_fecha_limite_retiro); ?></td>
                                            <td><?php print($column['cliente']); ?></td>
                                            <td><?php print($column['total']); ?></td>
						                	<td><?php if($column['estado_apartado'] == '1' || $column['estado_apartado'] == '2'):
						                		echo '<span class="label label-success label-rounded"><span
						                		class="text-bold">VIGENTE</span></span>';
						                		elseif($column['estado_apartado'] == '0'):
						                		echo '<span class="label label-default label-rounded">
						                	<span
						                	    class="text-bold">ANULADO</span></span>';
						                	 endif;
							                ?></td>
							        <td class="text-center">
                                      <ul class="icons-list">
                                        <li class="dropdown">
                                          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                            <i class="icon-menu9"></i>
                                          </a>
                                          <ul class="dropdown-menu dropdown-menu-right">


                                             <li><a id="detail_pay"  data-toggle="modal" data-target="#modal_detalle" data-toggle="modal" data-target="#modal_detalle"
                                             data-id="<?php print($column['idapartado']); ?>"
                                            href="javascript:void(0)">
                                             <i class="icon-file-spreadsheet">
                                               </i> Ver Detalle</a></li>

                                               <li><a id="print_receip"
                                             data-id="<?php print($column['idapartado']); ?>"
                                            href="javascript:void(0)">
                                             <i class="icon-typewriter">
                                               </i> Comprobante</a></li>

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
<script type="text/javascript" src="web/custom-js/ventames.js"></script>
