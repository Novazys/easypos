<?php

$objVenta =  new Venta();
$objApartado =  new Apartado();
$count_Apartados = $objApartado->Count_Apartados('MES','','');

foreach ($count_Apartados as $row => $column) {

  $apartados_anuladas = $column["apartados_anuladas"];
  $apartados_vigentes = $column["apartados_vigentes"];
  $apartados_saldados = $column["apartados_saldados"];


}


 ?>

			<!-- Labels -->
			<div class="row">
				<div class="col-lg-12">
					<div class="panel panel-flat">
						<div class="breadcrumb-line">
							<ul class="breadcrumb">
								<li><a href="?View=Inicio"><i class="icon-home2 position-left"></i> Inicio</a></li>
								<li><a href="javascript:;">Apartados</a></li>
								<li class="active">Apartados del Mes</li>
							</ul>
						</div>
						<div class="panel-heading">
							<h6 class="panel-title">Ventas del Mes</h6>

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
							 <div class="col-sm-6 col-md-4">
							 	<form role="form" autocomplete="off" class="form-validate-jquery" id="frmSearch">
									<div class="form-group">
										<div class="row">
											<div class="col-sm-6">
												<div class="input-group">
												<span class="input-group-addon"><i class="icon-calendar3"></i></span>
												<input type="text" id="txtMes" name="txtMes" placeholder=""
												 class="form-control input-sm" style="text-transform:uppercase;"
						                		onkeyup="javascript:this.value=this.value.toUpperCase();">
						                		</div>
											</div>
											<div class="col-sm-6">
												<button style="margin-top: 0px;" id="btnGuardar" type="submit" class="btn btn-primary btn-sm">
												<i class="icon-search4"></i> Consultar</button>
											</div>
										</div>
									</div>
								  </form>
						   	  </div>
						  </div>




						</div>

           						<!-- Iconified modal -->
							<div id="modal_iconified_cash" class="modal fade">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal">&times;</button>
											<h5 class="modal-title"><i class="icon-cash"></i> &nbsp; <span class="title-form">Facturar Venta</span></h5>
										</div>

										<form role="form" autocomplete="off" class="form-validate-jquery" id="frmPago">
											<div class="modal-body" id="modal-container">
												<input type="hidden" id="txtID" name="txtID" class="form-control" value="">
												<div class="form-group">
													<div class="row">
														<div class="col-sm-8">
															<label>Seleccione el Cliente</label>
															<select  data-placeholder="..." id="cbCliente" name="cbCliente"
																class="select-size-xs" style="text-transform:uppercase;"
																 onkeyup="javascript:this.value=this.value.toUpperCase();"
																 disabled="disabled">
																 <option value=""></option>
																								<?php
																	$filas = $objVenta->Listar_Clientes();
																	if (is_array($filas) || is_object($filas))
																	{
																	foreach ($filas as $row => $column)
																	{
																	?>
																		<option value="<?php print ($column["idcliente"])?>">
																		<?php print ($column["nombre_cliente"])?></option>
																	<?php
																		}
																	}
																	 ?>
															 </select>
														</div>

														<div class="col-sm-4">
																<label>Limite Crediticio <span class="text-danger"></span></label>
																	<div class="input-group">
																	<span class="input-group-addon"><i class="icon-cash3"></i></span>
																	<input type="text" id="txtLimitC" name="txtLimitC" placeholder="0.00"
																	 class="form-control" style="text-transform:uppercase;"
																		onkeyup="javascript:this.value=this.value.toUpperCase();" readonly="readonly" disabled="disabled">
																	</div>
															</div>

													</div>
												</div>


											<div class="form-group">
												<div class="row">
													<div class="col-sm-6">
														<label>Seleccione comprobante de Venta</label>
														<select  data-placeholder="..." id="cbCompro" name="cbCompro"
															class="select-size-xs" style="text-transform:uppercase;"
															onkeyup="javascript:this.value=this.value.toUpperCase();">
																							<?php
																$filas = $objVenta->Listar_Comprobantes();
																if (is_array($filas) || is_object($filas))
																{
																foreach ($filas as $row => $column)
																{
																?>
																	<option value="<?php print ($column["idcomprobante"])?>">
																	<?php print ($column["nombre_comprobante"])?></option>
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

													<div id="div-cbMPago" class="col-sm-6">
													 <label>Metodo de Pago</label>
														 <select id="cbMPago" name="cbMPago" data-placeholder="Seleccione un metodo de pago..." class="select-icons">
																 <option value="1" data-icon="cash">EFECTIVO</option>
																 <option value="2" data-icon="credit-card">TARJETA DE DEBITO / CREDITO</option>
																 <option value="3" data-icon="cash4">EFECTIVO Y TARJETA</option>
														 </select>
													</div>
												</div>
											</div>


											<div class="form-group">
												<div class="row">
														<div class="col-sm-4">
																<label>A Pagar <span class="text-danger"> * </span></label>
																<div class="input-group">
																<span class="input-group-addon"><i class="icon-cash3"></i></span>
																<input type="text" id="txtDeuda" name="txtDeuda" placeholder="0.00"
																 class="form-control input-sm" style="text-transform:uppercase;"
																 onkeyup="javascript:this.value=this.value.toUpperCase();"
																 readonly="readonly" disabled="disabled">
															</div>
														</div>

													<div id="div-txtMonto" class="col-sm-4">
														<label>Efectivo Recibido <span class="text-danger"> * </span></label>
														<input type="text" id="txtMonto" name="txtMonto" placeholder="0.00"
														 class="form-control input-sm" style="text-transform:uppercase;"
														 onkeyup="javascript:this.value=this.value.toUpperCase();">
													</div>

														<div id="div-txtCambio" class="col-sm-4">
																<label>Cambio <span class="text-danger"> * </span></label>
																<div class="input-group">
																<span class="input-group-addon"><i class="icon-cash"></i></span>
																<input type="text" id="txtCambio" name="txtCambio" placeholder="0.00"
																 class="form-control input-sm" style="text-transform:uppercase;"
																onkeyup="javascript:this.value=this.value.toUpperCase();"
																readonly="readonly" disabled="disabled">
														</div>
													</div>
												</div>
											</div>

											<div class="form-group">
												<div class="row">
														<div id="div-txtNoTarjeta" class="col-sm-5">
																<label> Tarjeta Debito/Credito <span class="text-danger"> * </span></label>
																<div class="input-group">
																<span class="input-group-addon"><i class="icon-credit-card"></i></span>
																<input type="text" id="txtNoTarjeta" name="txtNoTarjeta" placeholder="numero de tarjeta"
																 class="form-control input-sm" style="text-transform:uppercase;"
																 onkeyup="javascript:this.value=this.value.toUpperCase();">
															</div>
														</div>

														<div id="div-txtHabiente" class="col-sm-7">
																<label> Tarjeta Habiente <span class="text-danger"> * </span></label>
																<div class="input-group">
																<span class="input-group-addon"><i class="icon-user"></i></span>
																<input type="text" id="txtHabiente" name="txtHabiente" placeholder="Juan Perez"
																 class="form-control input-sm" style="text-transform:uppercase;"
																 onkeyup="javascript:this.value=this.value.toUpperCase();">
															</div>
														</div>
												</div>
											</div>

											<div class="form-group">
												<div class="row">
														<div id="div-txtMontoTar" class="col-sm-5">
																<label> Monto Debitado <span class="text-danger"> * </span></label>
																 <input type="text" id="txtMontoTar" name="txtMontoTar" placeholder="0.00"
																 class="touchspin-prefix" value="0" style="text-transform:uppercase;"
																 onkeyup="javascript:this.value=this.value.toUpperCase();">
															</div>
												</div>
											</div>


											</div>

											<div class="modal-footer">
												<button  type="reset" class="btn btn-default" id="reset"
												class="btn btn-link" data-dismiss="modal">Cerrar</button>
												<button type="submit" id="btnRegistrar" class="btn bg-success-800 btn-labeled"><b><i class="icon-printer4"></i>
												</b> Facturar e Imprimir</button>
											</div>
										</form>
									</div>
								</div>
							</div>
							<!-- /iconified modal -->


            <div id="reload-div">
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
  																$filas = $objApartado->Listar_Apartados('MES','','',1);
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
  												<h5 class="panel-title">Apartados Anuladas</h5>
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
                                  $filas = $objApartado->Listar_Apartados('MES','','',0);
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
                                  $filas = $objApartado->Listar_Apartados('MES','','',2);
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
  					</div>



					</div>
				</div>
			</div>
			<!-- /labels -->




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











<script type="text/javascript" src="web/custom-js/apartadomes.js"></script>
