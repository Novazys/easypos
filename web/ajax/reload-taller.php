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

		$fecha1 = "";
		$fecha2 = "";

	} else {

		$fecha1 = DateTime::createFromFormat('d/m/Y', $fecha1)->format('Y-m-d');
		$fecha2 = DateTime::createFromFormat('d/m/Y', $fecha2)->format('Y-m-d');
	}

  $objTaller= new Taller();
  $count_ordenes = $objTaller->Count_Ordenes($fecha1,$fecha2);

  foreach ($count_ordenes as $row => $column) {
    $total_ordenes = $column["total_ordenes"];
  }

?>
  	<script type="text/javascript" src="web/custom-js/taller.js"></script>
<div class="panel-body">
  <div class="tabbable">
    <ul class="nav nav-tabs nav-tabs-highlight">
      <li class="active"><a href="#label-tab1" data-toggle="tab">ORDENES REALIZADAS <span id="span-ing" class="label
      label-success position-right"><?php echo $total_ordenes  ?></span></a></li>
    </ul>

    <div class="tab-content">

      <div class="tab-pane active" id="label-tab1">
        <!-- Basic initialization -->
        <div class="panel panel-flat">
          <div class="panel-heading">
            <h5 class="panel-title">Ordenes de Taller</h5>
            <div class="heading-elements">

              <button type="button" class="btn btn-primary heading-btn"
              onclick="newOrden()">
              <i class="icon-database-add"></i> Agregar Nuevo/a</button>

            </div>
          </div>
            <div class="panel-body">
              <table class="table datatable-basic table-xs table-hover">
                <thead>
                  <tr>
                    <th>Fecha Ingreso</th>
                    <th>Orden</th>
                    <th>Cliente</th>
                    <th>Aparato</th>
                    <th>Marca</th>
                    <th>Averia</th>
                    <th>Opciones</th>
                  </tr>
                </thead>

                <tbody>

                  <?php
                    $filas = $objTaller->Listar_Ordenes($fecha1,$fecha2);
                    if (is_array($filas) || is_object($filas))
                    {
                    foreach ($filas as $row => $column)
                    {

                      $fecha_ingreso = $column["fecha_ingreso"];
                      if(is_null($fecha_ingreso))
                      {
                        $c_fecha_ingreso = '';

                      } else {

                        $c_fecha_ingreso = DateTime::createFromFormat('Y-m-d H:i:s',$fecha_ingreso)->format('d/m/Y H:i:s');
                      }

                      $fecha_alta = $column["fecha_alta"];
                      if(is_null($fecha_alta))
                      {
                        $c_fecha_alta = '';

                      } else {

                        $c_fecha_alta = DateTime::createFromFormat('Y-m-d H:i:s',$fecha_alta)->format('d/m/Y H:i:s');
                      }


                      $fecha_retiro = $column["fecha_retiro"];
                      if(is_null($fecha_retiro))
                      {
                        $c_fecha_retiro = '';

                      } else {

                        $c_fecha_retiro = DateTime::createFromFormat('Y-m-d H:i:s',$fecha_retiro)->format('d/m/Y H:i:s');
                      }

                    ?>
                      <tr>
                        <td><?php print($c_fecha_ingreso); ?></td>
                        <td><?php print($column['numero_orden']); ?></td>
                        <td><?php print($column['nombre_cliente']); ?></td>
                        <td><?php print($column['aparato']); ?></td>
                        <td><?php print($column['nombre_marca']); ?></td>
                        <td><?php print($column['averia']); ?></td>

                        <td class="text-center">
                          <ul class="icons-list">
                            <li class="dropdown">
                              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="icon-menu9"></i>
                              </a>
                              <ul class="dropdown-menu dropdown-menu-right">
																<?php if($column["diagnostico"] == ''): ?>

																	<li><a href="javascript:;" data-toggle="modal" data-target="#modal_iconified2"
																		 onclick="openOrden('diagnostico',
																			 '<?php print($column["idorden"]); ?>',
																			 '<?php print($column["numero_orden"]); ?>',
																			 '<?php print($c_fecha_ingreso); ?>',
																			 '<?php print($column["idcliente"]); ?>',
																			 '<?php print($column["aparato"]); ?>',
																			 '<?php print($column["modelo"]); ?>',
																			 '<?php print($column["idmarca"]); ?>',
																			 '<?php print($column["serie"]); ?>',
																			 '<?php print($column["idtecnico"]); ?>',
																			 '<?php print($column["averia"]); ?>',
																			 '<?php print($column["observaciones"]); ?>',
																			 '<?php print($column["deposito_revision"]); ?>',
																			 '<?php print($column["deposito_reparacion"]); ?>',
																			 '<?php print($column["diagnostico"]); ?>',
																			 '<?php print($column["estado_aparato"]); ?>',
																			 '<?php print($column["repuestos"]); ?>',
																			 '<?php print($column["mano_obra"]); ?>',
																			 '<?php print($c_fecha_alta); ?>',
																			 '<?php print($c_fecha_retiro); ?>',
																			 '<?php print($column["ubicacion"]); ?>',
																			 '<?php print($column["parcial_pagar"]); ?>')">
																			<i class="icon-wrench">
																			</i> Hacer Diagnostico</a></li>

																			<li><a href="javascript:;" data-toggle="modal" data-target="#modal_iconified"
																				 onclick="openOrden('informacion-editar',
																					 '<?php print($column["idorden"]); ?>',
																					 '<?php print($column["numero_orden"]); ?>',
																					 '<?php print($c_fecha_ingreso); ?>',
																					 '<?php print($column["idcliente"]); ?>',
																					 '<?php print($column["aparato"]); ?>',
																					 '<?php print($column["modelo"]); ?>',
																					 '<?php print($column["idmarca"]); ?>',
																					 '<?php print($column["serie"]); ?>',
																					 '<?php print($column["idtecnico"]); ?>',
																					 '<?php print($column["averia"]); ?>',
																					 '<?php print($column["observaciones"]); ?>',
																					 '<?php print($column["deposito_revision"]); ?>',
																					 '<?php print($column["deposito_reparacion"]); ?>',
																					 '<?php print($column["diagnostico"]); ?>',
																					 '<?php print($column["estado_aparato"]); ?>',
																					 '<?php print($column["repuestos"]); ?>',
																					 '<?php print($column["mano_obra"]); ?>',
																					 '<?php print($c_fecha_alta); ?>',
																					 '<?php print($c_fecha_retiro); ?>',
																					 '<?php print($column["ubicacion"]); ?>',
																					 '<?php print($column["parcial_pagar"]); ?>')">
																					<i class="icon-pencil3">
																					</i> Editar Informacion</a></li>

																	<?php else: ?>

																		<li><a href="javascript:;" data-toggle="modal" data-target="#modal_iconified"
																			 onclick="openOrden('informacion-editar',
																				 '<?php print($column["idorden"]); ?>',
																				 '<?php print($column["numero_orden"]); ?>',
																				 '<?php print($c_fecha_ingreso); ?>',
																				 '<?php print($column["idcliente"]); ?>',
																				 '<?php print($column["aparato"]); ?>',
																				 '<?php print($column["modelo"]); ?>',
																				 '<?php print($column["idmarca"]); ?>',
																				 '<?php print($column["serie"]); ?>',
																				 '<?php print($column["idtecnico"]); ?>',
																				 '<?php print($column["averia"]); ?>',
																				 '<?php print($column["observaciones"]); ?>',
																				 '<?php print($column["deposito_revision"]); ?>',
																				 '<?php print($column["deposito_reparacion"]); ?>',
																				 '<?php print($column["diagnostico"]); ?>',
																				 '<?php print($column["estado_aparato"]); ?>',
																				 '<?php print($column["repuestos"]); ?>',
																				 '<?php print($column["mano_obra"]); ?>',
																				 '<?php print($c_fecha_alta); ?>',
																				 '<?php print($c_fecha_retiro); ?>',
																				 '<?php print($column["ubicacion"]); ?>',
																				 '<?php print($column["parcial_pagar"]); ?>')">
																				<i class="icon-pencil3">
																				</i> Editar Informacion</a></li>

																		<li><a href="javascript:;" data-toggle="modal" data-target="#modal_iconified2"
																			 onclick="openOrden('diagnostico-editar',
																				 '<?php print($column["idorden"]); ?>',
																				 '<?php print($column["numero_orden"]); ?>',
																				 '<?php print($c_fecha_ingreso); ?>',
																				 '<?php print($column["idcliente"]); ?>',
																				 '<?php print($column["aparato"]); ?>',
																				 '<?php print($column["modelo"]); ?>',
																				 '<?php print($column["idmarca"]); ?>',
																				 '<?php print($column["serie"]); ?>',
																				 '<?php print($column["idtecnico"]); ?>',
																				 '<?php print($column["averia"]); ?>',
																				 '<?php print($column["observaciones"]); ?>',
																				 '<?php print($column["deposito_revision"]); ?>',
																				 '<?php print($column["deposito_reparacion"]); ?>',
																				 '<?php print($column["diagnostico"]); ?>',
																				 '<?php print($column["estado_aparato"]); ?>',
																				 '<?php print($column["repuestos"]); ?>',
																				 '<?php print($column["mano_obra"]); ?>',
																				 '<?php print($c_fecha_alta); ?>',
																				 '<?php print($c_fecha_retiro); ?>',
																				 '<?php print($column["ubicacion"]); ?>',
																				 '<?php print($column["parcial_pagar"]); ?>')">
																				<i class="icon-pencil">
																				</i> Editar Diagnostico</a></li>


																	<?php endif; ?>

																	<li><a href="javascript:;" data-toggle="modal" data-target="#modal_ticket"
																	onclick="Print_Ticket('<?php print($column["idorden"]); ?>')">
																	 <i class="icon-printer">
																	 </i> Imprimir Ticket </a></li>

																		 <li><a id="print_invoice"
																		data-id="<?php print($column['idorden']); ?>"
																		href="javascript:void(0)">
																		<i class="icon-printer2">
																		</i> Imprimir Boleta</a></li>

																		<li><a id="delete_product"
																		data-id="<?php print($column['idorden']); ?>"
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
            </div>
          </div>
      </div>


    </div>
  </div>
</div>
