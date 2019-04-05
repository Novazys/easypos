<?php

	function __autoload($className){
		$model = "../../model/". $className ."_model.php";
		$controller = "../../controller/". $className ."_controller.php";

		require_once($model);
		require_once($controller);
	}

	$objProducto =  new Producto();

 ?>
	<table class="table datatable-basic table-xxs table-hover">
						<thead>
							<tr>
								<th>Barra/Interno</th>
								<th>Producto</th>
								<th>Marca</th>
								<th>Presentacion</th>
								<th>S.Min.</th>
								<th>Stock</th>
								<th>P.Compra</th>
								<th>Precio</th>
								<th class="text-center">Opciones</th>
							</tr>
						</thead>

						<tbody>

						  <?php
								$filas = $objProducto->Listar_Productos();
								if (is_array($filas) || is_object($filas))
								{
								foreach ($filas as $row => $column)
								{
									$stock_print = "";
									$codigo_print = "";
									$codigo_barra = $column['codigo_barra'];
									$inventariable = $column['inventariable'];
									$stock = $column['stock'];
									$stock_min = $column['stock_min'];

									if($codigo_barra == '')
									{
										$codigo_print = $column['codigo_interno'];

									} else {

										$codigo_print = $codigo_barra;
									}

									if($inventariable == 1){

										if($stock >= 1 && $stock < $stock_min)
										{
											$stock_print = '<span class="label label-warning label-rounded"><span
						                	class="text-bold">POR AGOTARSE</span></span>';
										} else if ($stock == $stock_min) {

											$stock_print = '<span class="label label-info label-rounded"><span
						                	class="text-bold">EN MINIMO</span></span>';

										} else if ($stock > $stock_min){

											$stock_print = '<span
						                	class="">'.$stock.'</span>';
										} else if ($stock == 0){

											$stock_print = '<span class="label label-danger label-rounded">
						                	<span class="text-bold">AGOTADO</span></span>';
										}

									} else {

											$stock_print = '<span class="label label-primary label-rounded"><span
						                	class="text-bold">SERVICIO</span></span>';
									}




								?>
									<tr>
										<td><?php print($codigo_print); ?></td>
					                	<td><?php print($column['nombre_producto']); ?></td>
					                	<td><?php print($column['nombre_marca']); ?></td>
					                	<td><?php print($column['nombre_presentacion']); ?></td>
					                	<td><?php print($column['stock_min']); ?></td>
					                	<td class="success"><?php print($stock_print); ?></td>
					                	<td><?php print($column['precio_compra']); ?></td>
					                	<td><?php print($column['precio_venta']); ?></td>
					                	<td class="text-center">
										<ul class="icons-list">
											<li class="dropdown">
												<a href="#" class="dropdown-toggle" data-toggle="dropdown">
													<i class="icon-menu9"></i>
												</a>

												<ul class="dropdown-menu dropdown-menu-right">
													<li><a
													href="javascript:;" data-toggle="modal" data-target="#modal_iconified"
													onclick="openProducto('editar',
								                     '<?php print($column["idproducto"]); ?>',
								                     '<?php print($column["codigo_interno"]); ?>',
								                     '<?php print($column["codigo_barra"]); ?>',
								                     '<?php print($column["nombre_producto"]); ?>',
								                     '<?php print($column["precio_compra"]); ?>',
								                     '<?php print($column["precio_venta"]); ?>',
								                     '<?php print($column["precio_venta_mayoreo"]); ?>',
								                     '<?php print($column["stock"]); ?>',
								                     '<?php print($column["stock_min"]); ?>',
								                     '<?php print($column["idcategoria"]); ?>',
								                     '<?php print($column["idmarca"]); ?>',
								                     '<?php print($column["idpresentacion"]); ?>',
								                     '<?php print($column["estado"]); ?>',
								                     '<?php print($column["exento"]); ?>',
								                     '<?php print($column["inventariable"]); ?>',
								                     '<?php print($column["perecedero"]); ?>')">
												   <i class="icon-pencil6">
											       </i> Editar</a></li>
													<li><a
													href="javascript:;" data-toggle="modal" 
													data-target="#modal_iconified_barcode"
													onclick="openBarcode(
													'<?php print($column["codigo_barra"]); ?>',
													'<?php print($column["codigo_interno"]); ?>',
													'<?php print($column["nombre_producto"]); ?>',
													'<?php print($column["idproducto"]); ?>')">
													<i class="icon-barcode2">
													</i>Codigo de Barra</a></li>
													<li><a
													href="javascript:;" data-toggle="modal" data-target="#modal_iconified"
													onclick="openProducto('ver',
								                     '<?php print($column["idproducto"]); ?>',
								                     '<?php print($column["codigo_interno"]); ?>',
								                     '<?php print($column["codigo_barra"]); ?>',
								                     '<?php print($column["nombre_producto"]); ?>',
								                     '<?php print($column["precio_compra"]); ?>',
								                     '<?php print($column["precio_venta"]); ?>',
								                     '<?php print($column["precio_venta_mayoreo"]); ?>',
								                     '<?php print($column["stock"]); ?>',
								                     '<?php print($column["stock_min"]); ?>',
								                     '<?php print($column["idcategoria"]); ?>',
								                     '<?php print($column["idmarca"]); ?>',
								                     '<?php print($column["idpresentacion"]); ?>',
								                     '<?php print($column["estado"]); ?>',
								                     '<?php print($column["exento"]); ?>',
								                     '<?php print($column["inventariable"]); ?>',
								                     '<?php print($column["perecedero"]); ?>')">
													<i class=" icon-eye8">
													</i> Ver</a></li>
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

<script type="text/javascript" src="web/custom-js/producto.js"></script>
