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

		$fecha1 = null;
		$fecha2 = null;

	} else {

		$fecha1 = DateTime::createFromFormat('d/m/Y', $fecha1)->format('Y-m-d');
		$fecha2 = DateTime::createFromFormat('d/m/Y', $fecha2)->format('Y-m-d');
	}


	$objPerecedero =  new Perecedero();

 ?>
					<table class="table datatable-basic table-xxs table-hover">
						<thead>
							<tr>
								<th>Barra</th>
								<th>Producto</th>
								<th>Marca</th>
								<th>Presentacion</th>
								<th>Vence</th>
								<th>Cant</th>
								<th>Estado</th>
								<th class="text-center">Opciones</th>
							</tr>
						</thead>

						<tbody>

						  <?php
								$filas = $objPerecedero->Listar_Perecederos($fecha1,$fecha2);
								if (is_array($filas) || is_object($filas))
								{
								foreach ($filas as $row => $column)
								{

									$fecha_vencimiento = $column["fecha_vencimiento"];
									if(is_null($fecha_vencimiento))
									{
										$envio_date = '';

									} else {

										$envio_date = DateTime::createFromFormat('Y-m-d',$fecha_vencimiento)->format('d/m/Y');
									}

								?>
									<tr>

					                	<td><?php print($column['codigo_barra']); ?></td>
					                	<td><?php print($column['nombre_producto']); ?></td>
					                	<td><?php print($column['nombre_marca']); ?></td>
					                	<td><?php print($column['siglas']); ?></td>
					                	<td><?php print($envio_date); ?></td>
					                	<td><?php print($column['cantidad_perecedero']); ?></td>
														<td><?php if($column['estado_perecedero'] == '1'){
					                		echo '<span class="label label-success label-rounded"><span
					                		class="text-bold">VIGENTE</span></span>';
														} else if($column['estado_perecedero'] == '0') {
					                		echo '<span class="label label-warning label-rounded">
					                	<span
					                	    class="text-bold">VENCIDO</span></span>';
														} else if ($column['estado_perecedero'] == '2'){
															echo '<span class="label bg-violet label-rounded">
					                	<span
					                	    class="text-bold">CANT. AGOTADA</span></span>';
														}
						                ?></td>
					                	<td class="text-center">
										<ul class="icons-list">
											<li class="dropdown">
												<a href="#" class="dropdown-toggle" data-toggle="dropdown">
													<i class="icon-menu9"></i>
												</a>

												<ul class="dropdown-menu dropdown-menu-right">
													<li><a
													href="javascript:;" data-toggle="modal" data-target="#modal_iconified"
													onclick="openPerecedero('editar',
								                     '<?php print($envio_date); ?>',
								                     '<?php print($column["cantidad_perecedero"]); ?>',
								                     '<?php print($column["estado_producto"]); ?>',
								                     '<?php print($column["idproducto"]); ?>')">
												   <i class="icon-pencil6">
											       </i> Editar</a></li>
													<li><a
													href="javascript:;" data-toggle="modal" data-target="#modal_iconified"
													onclick="openPerecedero('ver',
								                     '<?php print($envio_date); ?>',
								                     '<?php print($column["cantidad_perecedero"]); ?>',
								                     '<?php print($column["estado_producto"]); ?>',
								                     '<?php print($column["idproducto"]); ?>')">
													<i class=" icon-eye8">
													</i> Ver</a></li>
													<li><a id="delete_product"
													data-id="<?php print($column['idproducto'].','.$column['fecha_vencimiento']); ?>"
													href="javascript:void(0)">
													<i class=" icon-trash">
													</i> Borrar</a></li>
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

<script type="text/javascript" src="web/custom-js/perecedero.js"></script>
