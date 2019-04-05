<?php

	function __autoload($className){
		$model = "../../model/". $className ."_model.php";
		$controller = "../../controller/". $className ."_controller.php";

		require_once($model);
		require_once($controller);
	}


	$idcotizacion = isset($_GET['numero_transaccion']) ? $_GET['numero_transaccion'] : '';

	$objCotizacion =  new Cotizacion();
	$detalle = $objCotizacion->Listar_Detalle($idcotizacion);
	$info = $objCotizacion->Listar_Info($idcotizacion);

	foreach ($info as $row => $column) {

		$numero_cotizacion = $column["numero_cotizacion"];
		$fecha_cotizacion = $column["fecha_cotizacion"];
		$tipo_pago = $column["tipo_pago"];
		$a_nombre = $column["a_nombre"];
		$entrega = $column["entrega"];
		$sumas = $column["sumas"];
		$iva = $column["iva"];
		$subtotal = $column["subtotal"];
		$total_exento = $column["total_exento"];
		$retenido = $column["retenido"];
		$total_descuento = $column["total_descuento"];
		$total = $column["total"];
	}

?>

	<!-- Collapsible with right control button -->
	<div class="panel-group panel-group-control panel-group-control-right content-group-lg">
		<div class="panel">
			<div class="panel-heading bg-info">
				<h6 class="panel-title">
					<a class="collapsed" data-toggle="collapse" href="#collapsible-control-right-group2">Clic para ver Información de la Cotizacion</a>
				</h6>
			</div>
			<div id="collapsible-control-right-group2" class="panel-collapse collapse">
				<div class="panel-body">
					<div class="table-responsive">
            <table class="table table-xxs table-bordered">
             <tbody class="border-solid">
             <tr>
              <td width="5%" class="text-bold text-left">NO. COTIZACION</td>
              <td width="35%"><?php echo $numero_cotizacion; ?></td>
              <td width="2%" class="text-bold text-left">FORMA PAGO</td>
              <td width="30%"><?php echo $tipo_pago; ?></td>
             </tr>
            <tr>
              <td width="5%" class="text-bold text-left">A NOMBRE DE </td>
              <td width="30%"><?php echo $a_nombre; ?></td>
              <td width="2%" class="text-bold text-left">FECHA</td>
              <td width="30%"><?php echo DateTime::createFromFormat('Y-m-d H:i:s', $fecha_cotizacion)->format('d/m/Y H:i:s'); ?></td>
            </tr>
            <tr>
              <td width="20%" class="text-bold text-left">FORMA DE ENTREGA</td>
              <td width="5%"><?php echo $entrega ?></td>
              <td width="10%" class="text-bold text-left">TOTAL</td>
              <td width="5%"><?php echo $total ?></td>
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
            <th>Disponible</th>
					</tr>
				</thead>
				<tbody>

				 <?php
					if (is_array($detalle) || is_object($detalle))
					{
					foreach ($detalle as $row => $column)
					{

						$disponible = $column["disponible"];

						if($disponible=="0"){
							$disponible = "NO";
						} else {
							$disponible = "SI";
						}

					?>
						<tr>
		                	<td><?php print($column['nombre_producto']); ?></td>
		                	<td><?php print($column['cantidad']); ?></td>
		                	<td><?php print($column['precio_unitario']); ?></td>
		                	<td><?php print($column['exento']); ?></td>
		                	<td><?php print($column['descuento']); ?></td>
		                	<td><?php print($column['importe']); ?></td>
		                	<td><?php print($disponible); ?></td>
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
