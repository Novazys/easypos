<?php
	session_start();
	$tipo_usuario = $_SESSION['user_tipo'];
	function __autoload($className){
		$model = "../../model/". $className ."_model.php";
		$controller = "../../controller/". $className ."_controller.php";

		require_once($model);
		require_once($controller);
	}

	$objCredito = new Credito();
	$count_creditos = $objCredito->Count_Creditos();

	foreach ($count_creditos as $row => $column) {
		$total_vigentes = $column["count_pendientes"];
		$total_pagados = $column["count_pagados"];
	}



 ?>
 <div class="panel-body">
	 <div class="tabbable">
		 <ul class="nav nav-tabs nav-tabs-highlight">
			 <li class="active"><a href="#label-tab1" data-toggle="tab">VIGENTES <span id="span-ing" class="label
			 label-success position-right"><?php echo $total_vigentes  ?></span></a></li>
			 <li><a href="#label-tab2" data-toggle="tab">FINALIZADOS <span id="span-dev" class="label bg-danger
			 position-right"><?php echo $total_pagados  ?></span></a></li>
			 <li><a href="#label-tab3" data-toggle="tab">ABONOS <span id="span-pre" class="label bg-warning
			 position-right"></span></a></li>
		 </ul>

		 <div class="tab-content">
			 <div class="tab-pane active" id="label-tab1">
				 <!-- Basic initialization -->
				 <div class="panel panel-flat">
					 <div class="panel-heading">
						 <h5 class="panel-title">Creditos Vigentes</h5>
						 <div class="heading-elements">

						 </div>
					 </div>
						 <div class="panel-body">
							 <table class="table datatable-basic table-xs table-hover">
								 <thead>
									 <tr>
										 <th>Credito</th>
										 <th>Venta</th>
										 <th>Monto</th>
										 <th>Abonado</th>
										 <th>Restante</th>
										 <th>Cliente</th>
										 <th>Opciones</th>
									 </tr>
								 </thead>

								 <tbody>

									 <?php
										 $filas = $objCredito->Listar_Creditos(0);
										 if (is_array($filas) || is_object($filas))
										 {
										 foreach ($filas as $row => $column)
										 {

											 $fecha_credito = $column["fecha_credito"];
											 if(is_null($fecha_credito))
											 {
												 $c_fecha_credito = '';

											 } else {

												 $c_fecha_credito = DateTime::createFromFormat('Y-m-d H:i:s',$fecha_credito)->format('d/m/Y H:i:s');
											 }

										 ?>
											 <tr>
													 <td><?php print($column['codigo_credito']); ?></td>
													 <td><?php print($column['numero_venta']); ?></td>
													 <td><?php print($column['monto_credito']); ?></td>
													 <td><?php print($column['monto_abonado']); ?></td>
													 <td><?php print($column['monto_restante']); ?></td>
													 <td><?php print($column['cliente']); ?></td>

												 <td class="text-center">
													 <ul class="icons-list">
														 <li class="dropdown">
															 <a href="#" class="dropdown-toggle" data-toggle="dropdown">
																 <i class="icon-menu9"></i>
															 </a>
															 <ul class="dropdown-menu dropdown-menu-right">
																 <?php if($tipo_usuario == 1){ ?>
																 <li><a
																 href="javascript:;" data-toggle="modal" data-target="#Modal_Credito"
																 onclick="openCredito('editar',
																		'<?php print($column["idcredito"]); ?>',
																		'<?php print($column["codigo_credito"]); ?>',
																		'<?php print($column["nombre_credito"]); ?>',
																		'<?php print($c_fecha_credito); ?>',
																		'<?php print($column["monto_credito"]); ?>',
																		'<?php print($column["monto_abonado"]); ?>',
																		'<?php print($column["monto_restante"]); ?>',
																		'<?php print($column["estado_credito"]); ?>')">
																	<i class="icon-pencil6">
																		</i> Editar</a></li>
																		<?php } ?>

																	<li><a id="detail_pay"  data-toggle="modal" data-target="#modal_detalle" data-toggle="modal" data-target="#modal_detalle"
																	data-id="<?php print($column['idcredito']); ?>"
																 href="javascript:void(0)">
																	<i class="icon-file-spreadsheet">
																		</i> Ver Detalle</a></li>

																		<li><a id="print_estado"
																	data-id="<?php print($column['codigo_credito'].','.$column['idcredito']); ?>"
																 href="javascript:void(0)">
																	<i class="icon-typewriter">
																	</i> Estado de Cuenta</a></li>

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
						 </div>
					 </div>
			 </div>

			 <div class="tab-pane" id="label-tab2">
				 <!-- Basic initialization -->
				 <div class="panel panel-flat">
					 <div class="panel-heading">
						 <h5 class="panel-title">Creditos Finalizados</h5>
						 <div class="heading-elements">

						 </div>
					 </div>
						 <div class="panel-body">
							 <table class="table datatable-basic table-xs table-hover">
								 <thead>
									 <tr>
										 <th>Credito</th>
										 <th>Venta</th>
										 <th>Monto</th>
										 <th>Abonado</th>
										 <th>Restante</th>
										 <th>Cliente</th>
										 <th>Opciones</th>
									 </tr>
								 </thead>

								 <tbody>

									 <?php
										 $filas = $objCredito->Listar_Creditos(1);
										 if (is_array($filas) || is_object($filas))
										 {
										 foreach ($filas as $row => $column)
										 {


										 ?>
											 <tr>
													 <td><?php print($column['codigo_credito']); ?></td>
													 <td><?php print($column['numero_venta']); ?></td>
													 <td><?php print($column['monto_credito']); ?></td>
													 <td><?php print($column['monto_abonado']); ?></td>
													 <td><?php print($column['monto_restante']); ?></td>
													 <td><?php print($column['cliente']); ?></td>

												 <td class="text-center">
													 <ul class="icons-list">
														 <li class="dropdown">
															 <a href="#" class="dropdown-toggle" data-toggle="dropdown">
																 <i class="icon-menu9"></i>
															 </a>
															 <ul class="dropdown-menu dropdown-menu-right">

																	<li><a id="detail_pay"  data-toggle="modal" data-target="#modal_detalle" data-toggle="modal" data-target="#modal_detalle"
																	data-id="<?php print($column['idcredito']); ?>"
																 href="javascript:void(0)">
																	<i class="icon-file-spreadsheet">
																		</i> Ver Detalle</a></li>

																		<li><a id="print_estado"
																	data-id="<?php print($column['codigo_credito'].','.$column['idcredito']); ?>"
																 href="javascript:void(0)">
																	<i class="icon-typewriter">
																	</i> Estado de Cuenta</a></li>


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
						 </div>
					 </div>
			 </div>


			 <div class="tab-pane" id="label-tab3">
				 <!-- Basic initialization -->
				 <div class="panel panel-flat">
					 <div class="panel-heading">
						 <h5 class="panel-title">Abonos</h5>
						 <div class="heading-elements">
							 <?php $filas = $objCredito->Listar_Creditos(0);
							 if (is_array($filas) || is_object($filas))
							 { ?>
							 <button type="button" class="btn btn-primary heading-btn"
							 onclick="newAbono()">
							 <i class="icon-database-add"></i> Agregar Nuevo/a</button>
							 <?php } ?>

							 <button type="button" class="btn btn-danger heading-btn"
							 data-toggle="modal" data-target="#modal_print">
							 <i class="icon-printer2"></i> Imprimir Reporte</button>
						 </div>
					 </div>
						 <div class="panel-body">
							 <table class="table datatable-basic table-xs table-hover">
								 <thead>
									 <tr>
										 <th>Credito</th>
										 <th>Fecha Abono</th>
										 <th>Monto Abonado</th>
										 <th>Opciones</th>
									 </tr>
								 </thead>

								 <tbody>

									 <?php
										 $filas = $objCredito->Listar_Abonos_All();
										 if (is_array($filas) || is_object($filas))
										 {
										 foreach ($filas as $row => $column)
										 {
											 $fecha_abono = $column["fecha_abono"];
											 if(is_null($fecha_abono))
											 {
												 $c_fecha_abono = '';

											 } else {

												 $c_fecha_abono = DateTime::createFromFormat('Y-m-d H:i:s',$fecha_abono)->format('d/m/Y H:i:s');
											 }

										 ?>
											 <tr>
													 <td><?php print($column['codigo_credito']); ?></td>
													 <td><?php print($c_fecha_abono); ?></td>
													 <td><?php print($column['monto_abono']); ?></td>


												 <td class="text-center">
													 <ul class="icons-list">
														 <li class="dropdown">
															 <a href="#" class="dropdown-toggle" data-toggle="dropdown">
																 <i class="icon-menu9"></i>
															 </a>
															 <ul class="dropdown-menu dropdown-menu-right">

																 <li><a
																 href="javascript:;" data-toggle="modal" data-target="#Modal_Abono"
																 onclick="openAbono('ver',
																		'<?php print($column["idabono"]); ?>',
																		'<?php print($column['codigo_credito']); ?>',
																		'<?php print($c_fecha_abono); ?>',
																		'<?php print($column['monto_abono']); ?>',
																		'<?php print($column["idcredito"]); ?>')">
																	<i class="icon-eye">
																	</i> Ver</a></li>

																	<?php if($tipo_usuario==1){ ?>
																		 <li><a id="delete_abono"
																		 data-id="<?php print($column['idabono']); ?>"
																		 href="javascript:void(0)">
																		 <i class=" icon-trash">
																		 </i> Borrar</a></li>
																	<?php } ?>

																	<li><a href="javascript:;" data-toggle="modal" data-target="#modal_ticket"
																	onclick="Print_Ticket('<?php print($column["idabono"]); ?>')">
																	 <i class="icon-printer">
																	 </i> Comprobante </a></li>

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
						 </div>
					 </div>
			 </div>

		 </div>
	 </div>
 </div>
<script type="text/javascript" src="web/custom-js/credito.js"></script>
