<?php 

	function __autoload($className){
		$model = "../../model/". $className ."_model.php";
		$controller = "../../controller/". $className ."_controller.php";
	
		require_once($model);
		require_once($controller);
	}

	$objEmpleado =  new Empleado();

 ?>
		<table class="table datatable-basic table-xxs table-hover">
						<thead>
							<tr>
								<th>No</th>
								<th>Empleado</th>
								<th>Telefono</th>
								<th>Estado</th>
								<th class="text-center">Opciones</th>
							</tr>
						</thead>

						<tbody>

						  <?php
								$filas = $objEmpleado->Listar_Empleados();
								if (is_array($filas) || is_object($filas))
								{
								foreach ($filas as $row => $column)
								{

								$telefono = $column['telefono_empleado'];
								$telefono = substr($telefono, 0, 4).'-'.substr($telefono, 4, 4);

								?>
									<tr>
					                	<td><?php print($column['codigo_empleado']); ?></td>
					                	<td><?php print($column['nombre_empleado'].$column['apellido_empleado']); ?></td>
					                	<td><?php print($telefono); ?></td>
					                	<td><?php if($column['estado'] == '1')
					                		echo '<span class="label label-success label-rounded"><span
					                		class="text-bold">ACTIVO</span></span>';
					                		else
					                		echo '<span class="label label-default label-rounded">
					                	<span
					                	    class="text-bold">INACTIVO</span></span>'
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
													onclick="openEmpleado('editar',
								                     '<?php print($column["idempleado"]); ?>',
								                     '<?php print($column["codigo_empleado"]); ?>',
								                     '<?php print($column["nombre_empleado"]); ?>',
								                     '<?php print($column["apellido_empleado"]); ?>',
								                     '<?php print($telefono); ?>',
								                     '<?php print($column["email_empleado"]); ?>',
								                     '<?php print($column["estado"]); ?>')"> 
												   <i class="icon-pencil6">
											       </i> Editar</a></li>
													<li><a
													href="javascript:;" data-toggle="modal" data-target="#modal_iconified"
													onclick="openEmpleado('ver',
								                     '<?php print($column["idempleado"]); ?>',
								                     '<?php print($column["codigo_empleado"]); ?>',
								                     '<?php print($column["nombre_empleado"]); ?>',
								                     '<?php print($column["apellido_empleado"]); ?>',
								                     '<?php print($telefono); ?>',
								                     '<?php print($column["email_empleado"]); ?>',
								                     '<?php print($column["estado"]); ?>')"> 
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

<script type="text/javascript" src="web/custom-js/empleado.js"></script>
