<?php 

	function __autoload($className){
		$model = "../../model/". $className ."_model.php";
		$controller = "../../controller/". $className ."_controller.php";
	
		require_once($model);
		require_once($controller);
	}

	$objUsuario =  new Usuario();

 ?>
		<table class="table datatable-basic table-xxs table-hover">
						<thead>
							<tr>
								<th>No</th>
								<th>Usuario</th>
								<th>Tipo de Usuario</th>
								<th>Empleado</th>
								<th>Estado</th>
								<th class="text-center">Opciones</th>
							</tr>
						</thead>

						<tbody>
						
						  <?php 
								$filas = $objUsuario->Listar_Usuarios(); 
								if (is_array($filas) || is_object($filas))
								{
								foreach ($filas as $row => $column) 
								{

								?>
									<tr>
										<td><?php print($column['idusuario']); ?></td>
					                	<td><?php print($column['usuario']); ?></td>
					            		<td><?php if($column['tipo_usuario'] == '1')
					                		echo '<span class="label label-warning label-rounded"><span 
					                		class="text-bold">ADMINISTRADOR</span></span>';
					                		else 
					                		echo '<span class="label label-info label-rounded">
					                		<span class="text-bold">CAJA</span></span>'
						                ?></td>
						                <td><?php print($column['nombre_empleado'].' '.$column['apellido_empleado']); ?></td>
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
													onclick="openUsuario('editar',
								                     '<?php print($column["idusuario"]); ?>',
								                     '<?php print($column["usuario"]); ?>',
								                     '<?php print($column["contrasena"]); ?>',
								                     '<?php print($column["tipo_usuario"]); ?>',
								                     '<?php print($column["estado"]); ?>',
								                     '<?php print($column["idempleado"]); ?>')"> 
												   <i class="icon-pencil6">
											       </i> Editar</a></li>
													<li><a
													href="javascript:;" data-toggle="modal" data-target="#modal_iconified"
													onclick="openUsuario('ver',
								                     '<?php print($column["idusuario"]); ?>',
								                     '<?php print($column["usuario"]); ?>',
								                     '<?php print($column["contrasena"]); ?>',
								                     '<?php print($column["tipo_usuario"]); ?>',
								                     '<?php print($column["estado"]); ?>',
								                     '<?php print($column["idempleado"]); ?>')"> 
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

<script type="text/javascript" src="web/custom-js/usuario.js"></script>
