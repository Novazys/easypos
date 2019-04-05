<?php

	function __autoload($className){
		$model = "../../model/". $className ."_model.php";
		$controller = "../../controller/". $className ."_controller.php";

		require_once($model);
		require_once($controller);
	}

	$fecha1 = isset($_GET['fecha1']) ? $_GET['fecha1'] : '';
	$fecha2 = isset($_GET['fecha2']) ? $_GET['fecha2'] : '';

	if($fecha1 == 'empty' && $fecha2 == 'empty'){

		$fecha1 = "";
		$fecha2 = "";

	} else {

		$fecha1 = DateTime::createFromFormat('d/m/Y', $fecha1)->format('Y-m-d');
		$fecha2 = DateTime::createFromFormat('d/m/Y', $fecha2)->format('Y-m-d');
	}


	$objVenta =  new Venta();
	$count_ventas = $objVenta->Count_Ventas('FECHAS',$fecha1,$fecha2);

	foreach ($count_ventas as $row => $column) {

		$ventas_anuladas = $column["ventas_anuladas"];
		$ventas_vigentes = $column["ventas_vigentes"];
		$ventas_contado = $column["ventas_contado"];
		$ventas_credito = $column["ventas_credito"];

	}



?>
<div class="panel-body">
	<div class="tabbable">
		<ul class="nav nav-tabs nav-tabs-highlight">
			<li class="active"><a href="#label-tab1" data-toggle="tab">VIGENTES <span id="span-ing" class="label
			label-success position-right"><?php echo $ventas_vigentes ?></span></a></li>
			<li><a href="#label-tab2" data-toggle="tab">ANULADAS <span id="span-dev" class="label bg-danger
			position-right"><?php echo $ventas_anuladas ?></span></a></li>
			<li><a href="#label-tab3" data-toggle="tab">VENTAS AL CONTADO <span id="span-pre" class="label bg-warning
			position-right"><?php echo $ventas_contado ?></span></a></li>
			<li><a href="#label-tab4" data-toggle="tab">VENTAS AL CREDITO <span id="span-gas" class="label bg-info
			position-right"><?php echo $ventas_credito ?></span></a></li>
		</ul>

		<div class="tab-content">
			<div class="tab-pane active" id="label-tab1">
				<!-- Basic initialization -->
				<div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">Ventas Vigentes</h5>
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
										<th>No. Venta</th>
										<th>Comprobante</th>
										<th>No.Comprobante</th>
										<th>Fecha y Hora Venta</th>
										<th>Tipo Pago</th>
										<th>Total</th>
										<th>Estado</th>
										<th>Opciones</th>
									</tr>
								</thead>

								<tbody>

								  <?php
										$filas = $objVenta->Listar_Ventas('FECHAS',$fecha1,$fecha2,1);
										if (is_array($filas) || is_object($filas))
										{
										foreach ($filas as $row => $column)
										{

										$fecha_venta = $column["fecha_venta"];
										if(is_null($fecha_venta))
										{
											$c_fecha_venta = '';

										} else {

											$c_fecha_venta = DateTime::createFromFormat('Y-m-d H:i:s',$fecha_venta)->format('d/m/Y H:i:s');
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
												<td><?php print($column['numero_venta']); ?></td>
												<td><?php print($tipo_comprobante); ?></td>
							                	<td><?php print($column['numero_comprobante']); ?></td>
							                	<td><?php print($c_fecha_venta); ?></td>
							                	<td><?php print($tipo_pago); ?></td>
							                	<td><?php print($column['total']); ?></td>
							                	<td><?php if($column['estado_venta'] == '1')
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
															   data-id="<?php print($column['idventa']); ?>"
																href="javascript:void(0)">
															   <i class="icon-cancel-circle2">
														       </i> Anular</a></li>

															   <li><a id="detail_pay"  data-toggle="modal" data-target="#modal_detalle"
															   data-id="<?php print($column['idventa']); ?>"
																href="javascript:void(0)">
															   <i class="icon-file-spreadsheet">
														       </i> Ver Detalle</a></li>

														       <li><a id="print_receip"
															   data-id="<?php print($column['idventa']); ?>"
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
						<h5 class="panel-title">Ventas Anuladas</h5>
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
										<th>No. Venta</th>
										<th>Comprobante</th>
										<th>No.Comprobante</th>
										<th>Fecha y Hora Venta</th>
										<th>Tipo Pago</th>
										<th>Total</th>
										<th>Estado</th>
										<th>Opciones</th>
									</tr>
								</thead>

								<tbody>

								  <?php
										$filas = $objVenta->Listar_Ventas('FECHAS',$fecha1,$fecha2,0);
										if (is_array($filas) || is_object($filas))
										{
										foreach ($filas as $row => $column)
										{

										$fecha_venta = $column["fecha_venta"];
										if(is_null($fecha_venta))
										{
											$c_fecha_venta = '';

										} else {

											$c_fecha_venta = DateTime::createFromFormat('Y-m-d H:i:s',$fecha_venta)->format('d/m/Y H:i:s');
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
												<td><?php print($column['numero_venta']); ?></td>
												<td><?php print($tipo_comprobante); ?></td>
							                	<td><?php print($column['numero_comprobante']); ?></td>
							                	<td><?php print($c_fecha_venta); ?></td>
							                	<td><?php print($tipo_pago); ?></td>
							                	<td><?php print($column['total']); ?></td>
							                	<td><?php if($column['estado_venta'] == '1')
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
															   data-id="<?php print($column['idventa']); ?>"
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
						<h5 class="panel-title">Ventas al Contado</h5>
						<div class="heading-elements">
							<button type="button"  id="print_contado"
							class="btn bg-danger-400 heading-btn" id="btnPrint" value="contado">
							<i class="icon-printer2"></i> Imprimir Reporte</button>
						</div>
					</div>
						<div class="panel-body">
							<table class="table datatable-basic table-xs table-hover">
								<thead>
									<tr>
										<th>No. Venta</th>
										<th>Comprobante</th>
										<th>No.Comprobante</th>
										<th>Fecha y Hora Venta</th>
										<th>Tipo Pago</th>
										<th>Total</th>
										<th>Estado</th>
										<th>Opciones</th>
									</tr>
								</thead>

								<tbody>

								  <?php
										$filas = $objVenta->Listar_Ventas('FECHAS',$fecha1,$fecha2,1);
										if (is_array($filas) || is_object($filas))
										{
										foreach ($filas as $row => $column)
										{

										$fecha_venta = $column["fecha_venta"];
										if(is_null($fecha_venta))
										{
											$c_fecha_venta = '';

										} else {

											$c_fecha_venta = DateTime::createFromFormat('Y-m-d H:i:s',$fecha_venta)->format('d/m/Y H:i:s');
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
												<td><?php print($column['numero_venta']); ?></td>
												<td><?php print($tipo_comprobante); ?></td>
							                	<td><?php print($column['numero_comprobante']); ?></td>
							                	<td><?php print($c_fecha_venta); ?></td>
							                	<td><?php print($tipo_pago); ?></td>
							                	<td><?php print($column['total']); ?></td>
							                	<td><?php if($column['estado_venta'] == '1')
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
															   data-id="<?php print($column['idventa']); ?>"
																href="javascript:void(0)">
															   <i class="icon-file-spreadsheet">
														       </i> Ver Detalle</a></li>

														       <li><a id="print_receip"
															   data-id="<?php print($column['idventa']); ?>"
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

			<div class="tab-pane" id="label-tab4">
				<!-- Basic initialization -->
				<div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">Ventas al Credito</h5>
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
										<th>No. Venta</th>
										<th>Comprobante</th>
										<th>No.Comprobante</th>
										<th>Fecha y Hora Venta</th>
										<th>Tipo Pago</th>
										<th>Total</th>
										<th>Opciones</th>
									</tr>
								</thead>

								<tbody>

								  <?php
										$filas = $objVenta->Listar_Ventas('FECHAS',$fecha1,$fecha2,2);
										if (is_array($filas) || is_object($filas))
										{
										foreach ($filas as $row => $column)
										{

										$fecha_venta = $column["fecha_venta"];
										if(is_null($fecha_venta))
										{
											$c_fecha_venta = '';

										} else {

											$c_fecha_venta = DateTime::createFromFormat('Y-m-d H:i:s',$fecha_venta)->format('d/m/Y H:i:s');
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
												<td><?php print($column['numero_venta']); ?></td>
												<td><?php print($tipo_comprobante); ?></td>
							                	<td><?php print($column['numero_comprobante']); ?></td>
							                	<td><?php print($c_fecha_venta); ?></td>
							                	<td><?php print($tipo_pago); ?></td>
							                	<td><?php print($column['total']); ?></td>
								                <td class="text-center">
													<ul class="icons-list">
														<li class="dropdown">
															<a href="#" class="dropdown-toggle" data-toggle="dropdown">
																<i class="icon-menu9"></i>
															</a>
															<ul class="dropdown-menu dropdown-menu-right">

														       <li><a id="delete_product"
															   data-id="<?php print($column['idventa']); ?>"
																href="javascript:void(0)">
															   <i class="icon-cancel-circle2">
														       </i> Anular</a></li>


															   <li><a id="detail_pay"  data-toggle="modal" data-target="#modal_detalle"
															   data-id="<?php print($column['idventa']); ?>"
																href="javascript:void(0)">
															   <i class="icon-file-spreadsheet">
														       </i> Ver Detalle</a></li>

														       <li><a id="print_receip"
															   data-id="<?php print($column['idventa']); ?>"
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
<script type="text/javascript" src="web/custom-js/ventafechas.js"></script>
