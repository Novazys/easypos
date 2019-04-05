<?php

	function __autoload($className){
		$model = "../../model/". $className ."_model.php";
		$controller = "../../controller/". $className ."_controller.php";

		require_once($model);
		require_once($controller);
	}


	$idventa = isset($_GET['numero_transaccion']) ? $_GET['numero_transaccion'] : '';

	$objVenta =  new Venta();
	$detalle = $objVenta->Listar_Detalle($idventa);
	$info = $objVenta->Listar_Info($idventa);

	foreach ($info as $row => $column) {

		$numero_venta = $column["numero_venta"];
		$fecha_venta = $column["fecha_venta"];
		$tipo_pago = $column["tipo_pago"];
		$cliente = $column["cliente"];
		$numero_comprobante = $column["numero_comprobante"];
		$tipo_comprobante = $column["tipo_comprobante"];
		$sumas = $column["sumas"];
		$iva = $column["iva"];
		$subtotal = $column["subtotal"];
		$total_exento = $column["total_exento"];
		$retenido = $column["retenido"];
		$total_descuento = $column["total_descuento"];
		$total = $column["total"];
		$pago_efectivo = $column['pago_efectivo'];
		$pago_tarjeta = $column['pago_tarjeta'];
		$numero_tarjeta = $column['numero_tarjeta'];
		$tarjeta_habiente = $column['tarjeta_habiente'];
		$cambio = $column['cambio'];
	}

	if($tipo_pago=="1")
	{
		$tipo_pago = "EFECTIVO";

	} else if ($tipo_pago=="2"){

		$tipo_pago = "TARJETA";

	} else if ($tipo_pago == "3"){

		$tipo_pago = "OTRO";
	}

?>

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
						<table class="table table-borderless table-striped table-xxs">
							<thead>
								<th>No. Venta</th>
								<th>Forma Pago</th>
								<th>No. Tarjeta</th>
								<th>Efectivo</th>
								<th>Debitado</th>
								<th>Cliente</th>
								<th>Fecha</th>
								<th>Comprobante</th>
								<th>No. Compro.</th>
								<th>Cambio</th>
							</thead>
						 <tbody class="border-solid">
							 <tr>
							 	<td><?php echo $numero_venta; ?></td>
								<td><?php echo $tipo_pago; ?></td>
								<td><?php echo $numero_tarjeta; ?></td>
								<td><?php echo $pago_efectivo; ?></td>
								<td><?php echo $pago_tarjeta; ?></td>
								<td><?php echo $cliente; ?></td>
								<td><?php echo DateTime::createFromFormat('Y-m-d H:i:s', $fecha_venta)->format('d/m/Y H:i:s');?></td>
								<td><?php if($tipo_comprobante == "1"){ echo "TICKET"; }elseif ($tipo_comprobante=="2") {echo "FACTURA";}
								elseif ($tipo_comprobante=="3"){ echo "CREDITO FISCAL";} ?></td>
								<td><?php echo $numero_comprobante; ?></td>
								<td><?php echo $cambio;?></td>
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

				 <?php
					if (is_array($detalle) || is_object($detalle))
					{
					foreach ($detalle as $row => $column)
					{

						$fecha_vence = $column["fecha_vence"];

						if($fecha_vence==""){
							$fecha_vence = "NO VENCE";
						} else {
							$fecha_vence = DateTime::createFromFormat('Y-m-d', $column['fecha_vence'])->format('d/m/Y');
						}

					?>
						<tr>
		                	<td><?php print($column['nombre_producto']); ?></td>
		                	<td><?php print($column['cantidad']); ?></td>
		                	<td><?php print($column['precio_unitario']); ?></td>
		                	<td><?php print($column['exento']); ?></td>
		                	<td><?php print($column['descuento']); ?></td>
		                	<td><?php print($column['importe']); ?></td>
		                	<td><?php print($fecha_vence); ?></td>
		                </tr>
					<?php
					}
				}
				?>

				</tbody>
				<tfoot>
					<tr>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td width="10%">SUMAS</td>
						<td id="sumas"><?php echo $sumas; ?></td>
						<td></td>
					</tr>
					<tr>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td width="10%">IVA %</td>
						<td id="iva"><?php echo $iva; ?></td>
						<td></td>
					</tr>
					<tr>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td width="10%">SUBTOTAL</td>
						<td id="subtotal"><?php echo $subtotal; ?></td>
						<td></td>
					</tr>
					<tr>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td width="10%">RET. (-)</td>
						<td id="ivaretenido"><?php echo $retenido; ?></td>
						<td></td>
					</tr>
					<tr>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td width="10%">T. EXENTO</td>
						<td id="exentas"><?php echo $total_exento; ?></td>
						<td></td>
					</tr>
					<tr>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td width="10%">DESCUENTO</td>
						<td id="descuentos"><?php echo $total_descuento; ?></td>
						<td></td>
					</tr>
					<tr>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td width="10%">TOTAL</td>
						<td id="total"><?php echo $total; ?></td>
						<td></td>
					</tr>
				</tfoot>
			</table>
		</div>
	</div>
