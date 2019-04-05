<?php

	function __autoload($className){
		$model = "../../model/". $className ."_model.php";
		$controller = "../../controller/". $className ."_controller.php";

		require_once($model);
		require_once($controller);
	}

	$objPresentacion =  new Presentacion();

 ?>
<table class="table datatable-basic table-xxs table-hover">
	<thead>
		<tr>
			<th>No</th>
			<th>Presentacion</th>
			<th>Siglas</th>
			<th>Estado</th>
			<th class="text-center">Opciones</th>
		</tr>
	</thead>

	<tbody>

	  <?php
			$filas = $objPresentacion->Listar_Presentaciones();
			if (is_array($filas) || is_object($filas))
			{
			foreach ($filas as $row => $column)
			{
			?>
				<tr>
                	<td><?php print($column['idpresentacion']); ?></td>
                	<td><?php print($column['nombre_presentacion']); ?></td>
                	<td><?php print($column['siglas']); ?></td>
                	<td><?php if($column['estado'] == '1')
                		echo '<span class="label label-success label-rounded"><span
                		class="text-bold">VIGENTE</span></span>';
                		else
                		echo '<span class="label label-default label-rounded">
                	<span
                	    class="text-bold">DESCONTINUADA</span></span>'
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
								onclick="openPresentacion('editar',
			                     '<?php print($column["idpresentacion"]); ?>',
			                     '<?php print($column["nombre_presentacion"]); ?>',
			                     '<?php print($column["siglas"]); ?>',
			                     '<?php print($column["estado"]); ?>')">
							   <i class="icon-pencil6">
						       </i> Editar</a></li>
								<li><a
								href="javascript:;" data-toggle="modal" data-target="#modal_iconified"
								onclick="openPresentacion('ver',
			                     '<?php print($column["idpresentacion"]); ?>',
			                     '<?php print($column["nombre_presentacion"]); ?>',
			                     '<?php print($column["siglas"]); ?>',
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

<script type="text/javascript" src="web/custom-js/presentacion.js"></script>
