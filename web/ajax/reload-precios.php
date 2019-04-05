<?php 

	function __autoload($className){
		$model = "../../model/". $className ."_model.php";
		$controller = "../../controller/". $className ."_controller.php";
	
		require_once($model);
		require_once($controller);
	}

	$objCompra =  new Compra();

	$idproducto = isset($_GET['idproducto']) ? $_GET['idproducto'] : '';
?>

<table class="table datatable-basic table-hover table-xs">
	<thead>
		<tr>
			<th>No</th>
			<th>Producto</th>
			<th>Marca</th>
			<th>Presentacion</th>
			<th>Proveedor</th>
			<th>Fecha</th>
			<th>Precio</th>
		</tr>
	</thead>

	<tbody>
	
	   <?php 
				$filas = $objCompra->Listar_Historico($idproducto); 
				if (is_array($filas) || is_object($filas))
				{
				foreach ($filas as $row => $column) 
				{

					$fecha_precio = $column["fecha_precio"];
					if(is_null($fecha_precio))
					{
						$envio_date = '';

					} else {

						$envio_date = DateTime::createFromFormat('Y-m-d',$fecha_precio)->format('d/m/Y');
					}
			
				?>
					<tr>
						<td><?php print($column['idproducto']); ?></td>
						<td><?php print($column['nombre_producto']); ?></td>
	                	<td><?php print($column['nombre_marca']); ?></td>
	                	<td><?php print($column['siglas']); ?></td>
	                	<td><?php print($column['nombre_proveedor']); ?></td>
	                	<td><?php print($envio_date); ?></td>
	                	<td><?php print($column['precio_comprado']); ?></td>
	                </tr>
				<?php  
				}
			}
			?>
	
	</tbody>
</table>

<script type="text/javascript" src="web/custom-js/historico.js"></script>