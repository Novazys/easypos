<?php

	function __autoload($className){
		$model = "../../model/". $className ."_model.php";
		$controller = "../../controller/". $className ."_controller.php";

		require_once($model);
		require_once($controller);
	}


	$idapartado = isset($_GET['numero_transaccion']) ? $_GET['numero_transaccion'] : '';

	$objApartado=  new Apartado();
	$detalle = $objApartado->Listar_Detalle($idapartado);
	$info = $objApartado->Listar_Info($idapartado);

	foreach ($info as $row => $column) {

		$numero_apartado = $column["numero_apartado"];
		$fecha_apartado = $column["fecha_apartado"];
		$cliente = $column["cliente"];
		$fecha_limite_retiro = $column["fecha_limite_retiro"];
    $sumas = $column["sumas"];
    $iva = $column["iva"];
    $subtotal = $column["subtotal"];
    $total_exento = $column["total_exento"];
    $retenido = $column["retenido"];
    $total_descuento = $column["total_descuento"];
    $total = $column["total"];

	}

  $fecha_apartado = DateTime::createFromFormat('Y-m-d H:i:s', $column['fecha_apartado'])->format('d/m/Y H:i:s');
  $fecha_limite_retiro = DateTime::createFromFormat('Y-m-d H:i:s', $column['fecha_limite_retiro'])->format('d/m/Y H:i:s');

?>

	<!-- Collapsible with right control button -->
	<div class="panel-group panel-group-control panel-group-control-right content-group-lg">
		<div class="panel">
			<div class="panel-heading bg-info">
				<h6 class="panel-title">
					<a class="collapsed" data-toggle="collapse" href="#collapsible-control-right-group2">Clic para ver Información del Apartado</a>
				</h6>
			</div>
			<div id="collapsible-control-right-group2" class="panel-collapse collapse">
				<div class="panel-body">
          <div class="table-responsive">
            <table class="table table-xxs table-bordered">
             <tbody class="border-solid">
             <tr>
              <td width="5%" class="text-bold text-left">NO. APARTADO</td>
              <td width="35%"><?php echo $numero_apartado ?></td>
              <td width="2%" class="text-bold text-left">TOTAL</td>
              <td width="30%"><?php echo $total ?></td>
             </tr>
            <tr>
              <td width="5%" class="text-bold text-left">CLIENTE</td>
              <td width="30%"><?php echo $cliente ?></td>
              <td width="2%" class="text-bold text-left">FECHA</td>
              <td width="30%"><?php echo $fecha_apartado ?></td>
            </tr>
            <tr>
              <td width="20%" class="text-bold text-left">FECHA DE RETIRO</td>
              <td width="5%"><?php echo $fecha_limite_retiro ?></td>


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
