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

  $objCotizacion = new Cotizacion();
	$count_cotizaciones = $objCotizacion->Count_Cotizaciones($fecha1,$fecha2);

	foreach ($count_cotizaciones as $row => $column) {
		$total_cotizaciones = $column["total_cotizaciones"];
	}


?>
<div class="panel-body">
  <div class="tabbable">
    <ul class="nav nav-tabs nav-tabs-highlight">
      <li class="active"><a href="#label-tab1" data-toggle="tab">COTIZACIONES REALIZADAS <span id="span-ing" class="label
      label-success position-right"><?php echo $total_cotizaciones  ?></span></a></li>
    </ul>

    <div class="tab-content">

      <div class="tab-pane active" id="label-tab1">
        <!-- Basic initialization -->
        <div class="panel panel-flat">
          <div class="panel-heading">
            <h5 class="panel-title">Cotizaciones</h5>
            <div class="heading-elements">

            </div>
          </div>
            <div class="panel-body">
              <table class="table datatable-basic table-xs table-hover">
                <thead>
                  <tr>
                    <th>Fecha</th>
                    <th>Numero</th>
                    <th>A Nombre De</th>
                    <th>Tipo Pago</th>
                    <th>Entrega</th>
                    <th>Total</th>
                    <th>Opciones</th>
                  </tr>
                </thead>

                <tbody>

                  <?php
                    $filas = $objCotizacion->Listar_Cotizaciones($fecha1,$fecha2);
                    if (is_array($filas) || is_object($filas))
                    {
                    foreach ($filas as $row => $column)
                    {

                      $fecha_cotizacion = $column["fecha_cotizacion"];
                      if(is_null($fecha_cotizacion))
                      {
                        $c_fecha_cotizacion = '';

                      } else {

                        $c_fecha_cotizacion = DateTime::createFromFormat('Y-m-d H:i:s',$fecha_cotizacion)->format('d/m/Y H:i:s');
                      }

                    ?>
                      <tr>
                          <td><?php print($c_fecha_cotizacion); ?></td>
                          <td><?php print($column['numero_cotizacion']); ?></td>
                          <td><?php print($column['a_nombre']); ?></td>
                          <td><?php print($column['tipo_pago']); ?></td>
                          <td><?php print($column['entrega']); ?></td>
                          <td><?php print($column['total']); ?></td>


                        <td class="text-center">
                          <ul class="icons-list">
                            <li class="dropdown">
                              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="icon-menu9"></i>
                              </a>
                              <ul class="dropdown-menu dropdown-menu-right">
                                 <li><a id="detail_pay"  data-toggle="modal"
                                  data-target="#modal_detalle" data-toggle="modal" data-target="#modal_detalle"
                                   data-id="<?php print($column['idcotizacion']); ?>"
                                  href="javascript:void(0)">
                                   <i class="icon-file-spreadsheet">
                                   </i> Ver Detalle</a>
                                 </li>

                                   <li><a id="print_invoice"
                                  data-id="<?php print($column['idcotizacion']); ?>"
                                  href="javascript:void(0)">
                                  <i class="icon-printer2">
                                  </i> Imprimir</a></li>

                                  <li><a id="delete_product"
                                  data-id="<?php print($column['idcotizacion']); ?>"
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
<script type="text/javascript" src="web/custom-js/cotizaciones.js"></script>
