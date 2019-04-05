<?php 

	function __autoload($className){
		$model = "../../model/". $className ."_model.php";
		$controller = "../../controller/". $className ."_controller.php";
	
		require_once($model);
		require_once($controller);
	}

	$objTiraje =  new Tiraje();

 ?>					<table class="table datatable-basic table-xxs table-hover">
						<thead>
							<tr>
								<th>No</th>
								<th>Fecha Resolucion</th>
								<th>Comprobante</th>
								<th>Disponibles</th>
								<th>Utilizados</th>
								<th class="text-center">Opciones</th>
							</tr>
						</thead>

						<tbody>
						
						  <?php 
								$filas = $objTiraje->Listar_Tirajes(); 
								if (is_array($filas) || is_object($filas))
								{
								foreach ($filas as $row => $column) 
								{
									$fecha_resolucion = $column["fecha_resolucion"];
									if(is_null($fecha_resolucion))
									{
										$envio_date = '';

									} else {

										$envio_date = DateTime::createFromFormat('Y-m-d',$fecha_resolucion)->format('d/m/Y');
									}


								?>
									<tr>
										<td><?php print($column['idtiraje']); ?></td>
					                	<td><?php print($envio_date); ?></td>
					            		<td><?php print($column['nombre_comprobante']); ?></td>
					            		<td><?php print($column['disponibles']); ?></td>
					            		<td><?php print($column['usados']); ?></td>
					                	<td class="text-center">
										<ul class="icons-list">
											<li class="dropdown">
												<a href="#" class="dropdown-toggle" data-toggle="dropdown">
													<i class="icon-menu9"></i>
												</a>

												<ul class="dropdown-menu dropdown-menu-right">
													<li><a 
													href="javascript:;" data-toggle="modal" data-target="#modal_iconified"
													onclick="openTiraje('editar',
								                     '<?php print($column["idtiraje"]); ?>',
								                     '<?php print($envio_date); ?>',
								                     '<?php print($column["numero_resolucion"]); ?>',
								                     '<?php print($column["numero_resolucion_fact"]); ?>',
								                     '<?php print($column["serie"]); ?>',
								                     '<?php print($column["desde"]); ?>',
								                     '<?php print($column["hasta"]); ?>',
								                     '<?php print($column["disponibles"]); ?>',
								                     '<?php print($column["usados"]); ?>',
								                     '<?php print($column["idcomprobante"]); ?>')">
												   <i class="icon-pencil6">
											       </i> Editar</a></li>
													<li><a
													href="javascript:;" data-toggle="modal" data-target="#modal_iconified"
													onclick="openTiraje('ver',
								                     '<?php print($column["idtiraje"]); ?>',
								                     '<?php print($envio_date); ?>',
								                     '<?php print($column["numero_resolucion"]); ?>',
								                     '<?php print($column["numero_resolucion_fact"]); ?>',
								                     '<?php print($column["serie"]); ?>',
								                     '<?php print($column["desde"]); ?>',
								                     '<?php print($column["hasta"]); ?>',
								                     '<?php print($column["disponibles"]); ?>',
								                     '<?php print($column["usados"]); ?>',
								                     '<?php print($column["idcomprobante"]); ?>')">
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

<script type="text/javascript" src="web/custom-js/tiraje.js"></script>
