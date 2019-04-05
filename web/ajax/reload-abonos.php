<?php

	function __autoload($className){
		$model = "../../model/". $className ."_model.php";
		$controller = "../../controller/". $className ."_controller.php";

		require_once($model);
		require_once($controller);
	}

	$objCredito =  new Credito();

	$credito = isset($_GET['credito']) ? $_GET['credito'] : '';
?>

<table class="table datatable-basic table-hover table-xs">
	<thead>
		<tr>
			<th>Credito</th>
			<th>Monto Abono</th>
			<th>Fecha Abono</th>
			<th>Opciones</th>
		</tr>
	</thead>

	<tbody>

	   <?php
				$filas = $objCredito->Listar_Abonos($credito);
				if (is_array($filas) || is_object($filas))
				{
				foreach ($filas as $row => $column)
				{

					$fecha_abono = $column["fecha_abono"];
					if(is_null($fecha_abono))
					{
						$fecha_abono = '';

					} else {

						$fecha_abono = DateTime::createFromFormat('Y-m-d H:i:s',$fecha_abono)->format('d/m/Y H:i:s');
					}

				?>
					<tr>
						<td><?php print($column['codigo_credito']); ?></td>
						<td><?php print($column['monto_abono']); ?></td>
          	<td><?php print($fecha_abono); ?></td>
						<td></td>
          </tr>
				<?php
				}
			}
			?>

	</tbody>
</table>

<script type="text/javascript" src="web/custom-js/abono.js"></script>
