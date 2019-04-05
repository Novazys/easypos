<?php 

	function __autoload($className){
		$model = "../../model/". $className ."_model.php";
		$controller = "../../controller/". $className ."_controller.php";
	
		require_once($model);
		require_once($controller);
	}

	$objMoneda =  new Moneda();

 ?>		

					<table class="table datatable-basic table-xxs table-hover">
						<thead>
							<tr>
								<th>No</th>
								<th>Estandar ISO</th>
								<th>Lenguaje</th>
								<th>Nombre Moneda</th>
								<th>Simbolo</th>
								<th class="text-center">Opciones</th>
							</tr>
						</thead>

						<tbody>

						  <?php
								$filas = $objMoneda->Listar_Monedas();
								if (is_array($filas) || is_object($filas))
								{
								foreach ($filas as $row => $column)
								{

								?>
									<tr>
								<td><?php print($column['idcurrency']); ?></td>
					                	<td><?php print($column['CurrencyISO']); ?></td>
					            		<td><?php print($column['Language']); ?></td>
					            		<td><?php print($column['CurrencyName']); ?></td>
					            		<td><?php print($column['Symbol']); ?></td>
					                	<td class="text-center">
										<ul class="icons-list">
											<li class="dropdown">
												<a href="#" class="dropdown-toggle" data-toggle="dropdown">
													<i class="icon-menu9"></i>
												</a>

												<ul class="dropdown-menu dropdown-menu-right">
													<li><a
													href="javascript:;" data-toggle="modal" data-target="#modal_iconified"
													onclick="openMoneda('editar',
								                     '<?php print($column["idcurrency"]); ?>',
								                     '<?php print($column["CurrencyISO"]); ?>',
								                     '<?php print($column["Language"]); ?>',
								                     '<?php print($column["CurrencyName"]); ?>',
								                     '<?php print($column["Money"]); ?>',
								                     '<?php print($column["Symbol"]); ?>')">
												   <i class="icon-pencil6">
											       </i> Editar</a></li>
													<li><a
													href="javascript:;" data-toggle="modal" data-target="#modal_iconified"
													onclick="openMoneda('ver',
								                     '<?php print($column["idcurrency"]); ?>',
								                     '<?php print($column["CurrencyISO"]); ?>',
								                     '<?php print($column["Language"]); ?>',
								                     '<?php print($column["CurrencyName"]); ?>',
								                     '<?php print($column["Money"]); ?>',
								                     '<?php print($column["Symbol"]); ?>')">
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


<script type="text/javascript" src="web/custom-js/moneda.js"></script>
