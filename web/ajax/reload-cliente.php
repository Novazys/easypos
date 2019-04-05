<?php

	function __autoload($className){
		$model = "../../model/". $className ."_model.php";
		$controller = "../../controller/". $className ."_controller.php";

		require_once($model);
		require_once($controller);
	}

	$objCliente =  new Cliente();

 ?>
 <table class="table datatable-basic table-xxs table-hover">
	 <thead>
		 <tr>
			 <th>No</th>
			 <th>Cliente</th>
			 <th>NIT</th>
			 <th>Telefono</th>
			 <th>Estado</th>
			 <th class="text-center">Opciones</th>
		 </tr>
	 </thead>

	 <tbody>

		 <?php
			 $filas = $objCliente->Listar_Clientes();
			 if (is_array($filas) || is_object($filas))
			 {
			 foreach ($filas as $row => $column)
			 {

				 $nit = $column['numero_nit'];
				 $telefono = $column['numero_telefono'];


				 $telefono = substr($telefono, 0, 4).'-'.substr($telefono, 4, 4);
				 $nit =  substr($nit, 0, 7).'-'.substr($nit, 7,9);
			 ?>
				 <tr>
									 <td><?php print($column['codigo_cliente']); ?></td>
									 <td><?php print($column['nombre_cliente']); ?></td>
									 <td><?php print $nit; ?></td>
									 <td><?php print($telefono); ?></td>
									 <td><?php if($column['estado'] == '1')
										 echo '<span class="label label-success label-rounded"><span
										 class="text-bold">VIGENTE</span></span>';
										 else
										 echo '<span class="label label-default label-rounded">
									 <span
											 class="text-bold">DESCONTINUADO</span></span>'
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
								 onclick="openCliente('editar',
											 '<?php print($column["idcliente"]); ?>',
											 '<?php print($column["codigo_cliente"]); ?>',
											 '<?php print($column["nombre_cliente"]); ?>',
											 '<?php print($nit); ?>',
											 
											 '<?php print($column["direccion_cliente"]); ?>',
											 '<?php print($telefono); ?>',
											 '<?php print($column["email"]); ?>',
											 '<?php print($column["giro"]); ?>',
											 '<?php print($column["limite_credito"]); ?>',
											 '<?php print($column["estado"]); ?>')">
									<i class="icon-pencil6">
										</i> Editar</a></li>
								 <li><a
								 href="javascript:;" data-toggle="modal" data-target="#modal_iconified"
								 onclick="openCliente('ver',
											 '<?php print($column["idcliente"]); ?>',
											 '<?php print($column["codigo_cliente"]); ?>',
											 '<?php print($column["nombre_cliente"]); ?>',
											 '<?php print($nit); ?>',

											 '<?php print($column["direccion_cliente"]); ?>',
											 '<?php print($telefono); ?>',
											 '<?php print($column["email"]); ?>',
											 '<?php print($column["giro"]); ?>',
											 '<?php print($column["limite_credito"]); ?>',
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

<script type="text/javascript" src="web/custom-js/cliente.js"></script>
