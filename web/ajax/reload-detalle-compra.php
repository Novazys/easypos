<?php

	function __autoload($className){
		$model = "../../model/". $className ."_model.php";
		$controller = "../../controller/". $className ."_controller.php";

		require_once($model);
		require_once($controller);
	}


	$idcompra = isset($_GET['numero_transaccion']) ? $_GET['numero_transaccion'] : '';

	$objCompra =  new Compra();
	$detalle = $objCompra->Listar_Detalle($idcompra);
	$info = $objCompra->Listar_Info($idcompra);

	foreach ($info as $row => $column) {

		$fecha_compra = $column["fecha_compra"];
		$tipo_pago = $column["tipo_pago"];
		$nombre_proveedor = $column["nombre_proveedor"];
		$numero_nit = $column["numero_nit"];
		$numero_comprobante = $column["numero_comprobante"];
		$tipo_comprobante = $column["tipo_comprobante"];
		$sumas = $column["sumas"];
		$iva = $column["iva"];
		$subtotal = $column["subtotal"];
		$total_exento = $column["total_exento"];
		$retenido = $column["retenido"];
		$total = $column["total"];
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
							<td width="30%"><?php echo DateTime::createFromFormat('Y-m-d H:i:s', $fecha_compra)->format('d/m/Y H:i:s'); ?></td>
							<td width="2%" class="text-bold text-left">FORMA PAGO</td>
							<td width="30%"> <?php echo $tipo_pago; ?></td>
						 </tr>
						<tr>
							<td width="5%" class="text-bold text-left">PROVEEDOR</td>
							<td width="30%"><?php  echo $nombre_proveedor; ?></td>
							<td width="2%" class="text-bold text-left">NIT</td>
							<td width="30%"><?php echo $numero_nit; ?></td>
						</tr>
						<tr>
							<td width="20%" class="text-bold text-left">NO. COMPROBANTE</td>
							<td width="5%"><?php echo $numero_comprobante ?></td>
							<td width="10%" class="text-bold text-left">COMPROBANTE</td>
							<td width="5%"><?php if($tipo_comprobante == "1"){ echo "TICKET"; }elseif ($tipo_comprobante=="2") {echo "FACTURA";}
							elseif ($tipo_comprobante=="3"){ echo "CREDITO FISCAL";} ?></td>
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
						<td width="10%">SUMAS</td>
						<td id="sumas"><?php echo $sumas; ?></td>
						<td></td>
					</tr>
					<tr>
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
						<td width="10%">SUBTOTAL</td>
						<td id="subtotal"><?php echo $subtotal; ?></td>
						<td></td>
					</tr>
					<tr>
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
						<td width="10%">T. EXENTO</td>
						<td id="exentas"><?php echo $total_exento; ?></td>
						<td></td>
					</tr>
					<tr>
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
