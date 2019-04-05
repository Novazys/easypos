<?php


	$objDashboard =  new Dashboard();

	$filas = $objDashboard->Datos_Paneles();

	$parametros = $objDashboard->Ver_Moneda_Reporte();
	if (is_array($parametros) || is_object($parametros))
	{
		foreach ($parametros as $row => $column) {

				$moneda = $column['Symbol'];

		}
	} else {
		$moneda = '';
	}

	$compras = $objDashboard->Compras_Anuales();
	$ventas = $objDashboard->Ventas_Anuales();

	if (is_array($filas) || is_object($filas))
	{
		foreach ($filas as $row => $column)
		{
			$compras_mes = $column["compras_mes"];
			$ventas_dia = $column["ventas_dia"];
			$inversion_stock = $column["inversion_stock"];
			$proveedores = $column["proveedores"];
			$marcas = $column["marcas"];
			$presentaciones = $column["presentaciones"];
			$productos = $column["productos"];
			$dinero_caja  = $column["dinero_caja"];
			$perecederos  = $column["perecederos"];
			$a_vencer  = $column["a_vencer"];
			$clientes  = $column["clientes"];
			$creditos  = $column["creditos"];
		}
	}



?>

				<div class="row">
					<div class="col-sm-6 col-md-3">
						<div class="panel panel-body bg-blue-400 has-bg-image">
							<div class="media no-margin">
								<div class="media-body">
									<h3 class="no-margin"><?php echo $moneda.' '.number_format($dinero_caja, 2, '.', ','); ?></h3>
									<span class="text-uppercase text-size-mini">DINERO EN CAJA</span>
								</div>

								<div class="media-right media-middle">
									<i class="icon-cash icon-3x opacity-75"></i>
								</div>
							</div>
						</div>
					</div>

					<div class="col-sm-6 col-md-3">
						<div class="panel panel-body bg-danger-400 has-bg-image">
							<div class="media no-margin">
								<div class="media-body">
									<h3 class="no-margin"><?php echo $moneda.' '.number_format($compras_mes, 2, '.', ','); ?></h3>
									<span class="text-uppercase text-size-mini">COMPRAS DEL MES </span>
								</div>

								<div class="media-right media-middle">
									<i class="icon-bag icon-3x opacity-75"></i>
								</div>
							</div>
						</div>
					</div>

					<div class="col-sm-6 col-md-3">
						<div class="panel panel-body bg-success-400 has-bg-image">
							<div class="media no-margin">
								<div class="media-left media-middle">
									<i class="icon-cash3 icon-3x opacity-75"></i>
								</div>

								<div class="media-body text-right">
									<h3 class="no-margin"><?php echo $moneda.' '.number_format($ventas_dia, 2, '.', ','); ?></h3>
									<span class="text-uppercase text-size-mini">EN VENTAS DEL DIA</span>
								</div>
							</div>
						</div>
					</div>

					<div class="col-sm-6 col-md-3">
						<div class="panel panel-body bg-indigo-400 has-bg-image">
							<div class="media no-margin">
								<div class="media-left media-middle">
									<i class="icon-price-tags icon-3x opacity-75"></i>
								</div>

								<div class="media-body text-right">
									<h3 class="no-margin"><?php echo $moneda.' '.number_format($inversion_stock, 2, '.', ','); ?></h3>
									<span class="text-uppercase text-size-mini">invertido en stock</span>
								</div>
							</div>
						</div>
					</div>


					<div class="col-sm-6 col-md-3">
						<div class="panel panel-body bg-teal-400 has-bg-image">
							<div class="media no-margin">
								<div class="media-left media-middle">
									<i class="icon-truck icon-3x opacity-75"></i>
								</div>

								<div class="media-body text-right">
									<h3 class="no-margin"><?php echo number_format($proveedores, 2, '.', ','); ?></h3>
									<span class="text-uppercase text-size-mini">Proveedores</span>
								</div>
							</div>
						</div>
					</div>

					<div class="col-sm-6 col-md-3">
						<div class="panel panel-body bg-green-400 has-bg-image">
							<div class="media no-margin">
								<div class="media-left media-middle">
									<i class="icon-cc icon-3x opacity-75"></i>
								</div>

								<div class="media-body text-right">
									<h3 class="no-margin"><?php echo number_format($marcas, 2, '.', ','); ?></h3>
									<span class="text-uppercase text-size-mini">Marcas</span>
								</div>
							</div>
						</div>
					</div>

					 <div class="col-sm-6 col-md-3">
						<div class="panel panel-body bg-orange-400 has-bg-image">
							<div class="media no-margin">
								<div class="media-left media-middle">
									<i class="icon-stack-star icon-3x opacity-75"></i>
								</div>

								<div class="media-body text-right">
									<h3 class="no-margin"><?php echo number_format($presentaciones, 2, '.', ','); ?></h3>
									<span class="text-uppercase text-size-mini">Presentaciones</span>
								</div>
							</div>
						</div>
					</div>

					<div class="col-sm-6 col-md-3">
						<div class="panel panel-body bg-slate-400 has-bg-image">
							<div class="media no-margin">
								<div class="media-left media-middle">
									<i class="icon-box icon-3x opacity-75"></i>
								</div>

								<div class="media-body text-right">
									<h3 class="no-margin"><?php echo number_format($productos, 2, '.', ','); ?></h3>
									<span class="text-uppercase text-size-mini">Productos ingresados</span>
								</div>
							</div>
						</div>
					</div>


					<div class="col-sm-6 col-md-3">
						<div class="panel panel-body bg-danger-600 has-bg-image">
							<div class="media no-margin">
								<div class="media-body">
									<h3 class="no-margin"><?php echo number_format($perecederos, 2, '.', ','); ?></h3>
									<span class="text-uppercase text-size-mini">Perecederos</span>
								</div>

								<div class="media-right media-middle">
									<i class="icon-calendar icon-3x opacity-75"></i>
								</div>
							</div>
						</div>
					</div>


					<div class="col-sm-6 col-md-3">
						<div class="panel panel-body bg-info-300 has-bg-image">
							<div class="media no-margin">
								<div class="media-body">
									<h3 class="no-margin"><?php echo number_format($a_vencer, 2, '.', ','); ?></h3>
									<span class="text-uppercase text-size-mini">Venceran en 30 dias</span>
								</div>

								<div class="media-right media-middle">
									<i class="icon-sort-time-asc icon-3x opacity-75"></i>
								</div>
							</div>
						</div>
					</div>


					<div class="col-sm-6 col-md-3">
						<div class="panel panel-body bg-pink-300 has-bg-image">
							<div class="media no-margin">
								<div class="media-body">
									<h3 class="no-margin"><?php echo number_format($clientes, 2, '.', ','); ?></h3>
									<span class="text-uppercase text-size-mini">Clientes</span>
								</div>

								<div class="media-right media-middle">
									<i class="icon-users4 icon-3x opacity-75"></i>
								</div>
							</div>
						</div>
					</div>


					<div class="col-sm-6 col-md-3">
						<div class="panel panel-body bg-violet-400 has-bg-image">
							<div class="media no-margin">
								<div class="media-body">
									<h3 class="no-margin"><?php echo number_format($creditos, 2, '.', ','); ?></h3>
									<span class="text-uppercase text-size-mini">Creditos Pendientes</span>
								</div>

								<div class="media-right media-middle">
									<i class="icon-wallet icon-3x opacity-75"></i>
								</div>
							</div>
						</div>
					</div>
				</div>
				<br> <br>
		<!--		<div class="row">
					<div class="col-lg-6">

							<div class="panel panel-flat">
								<div class="panel-heading">
									<h6 class="panel-title text-center text-uppercase">Ventas del Año</h6>
									<div class="chart-container text-center">
										<div class="display-inline-block" id="c3-pie-chart"></div>
									</div>
								</div>
							</div>
				   </div>
				</div>-->

				<div class="row">
						<div class="col-lg-12">
							<!-- Simple line chart -->
								<div class="panel panel-flat">
									<div class="panel-heading">
										<h6 class="panel-title text-black">COMPARATIVA VENTAS Y COMPRAS DEL AÑO  <?php echo date('Y') ?></h6>
									</div>
										<div class="panel-body">
											<div class="chart-container">
												<div class="chart" id="c3-line-chart"></div>
											</div>
										</div>
								</div>
								<!-- /simple line chart -->
						</div>
				</div>

					<!-- Main charts -->
					<div class="row">
						<div class="col-lg-6">

							<!-- Traffic sources -->
							<div class="panel panel-flat">
								<div class="panel-heading">
									<h6 class="panel-title text-center text-uppercase text-black">VENTAS DEL AÑO <?php echo date('Y') ?></h6>
								</div>

								<div class="container-fluid">
								  <div class="chart-container text-center">
									 <div class="display-inline-block" id="chart-ventas"></div>
								  </div>
								 </div>
							</div>
							<!-- /traffic sources -->

						</div>

						<div class="col-lg-6">

							<!-- Sales stats -->
							<div class="panel panel-flat">
								<div class="panel-heading">
									<h6 class="panel-title text-center text-uppercase text-black">COMPRAS DEL AÑO <?php echo date('Y') ?></h6>
								</div>

								<div class="container-fluid">
								 <div class="chart-container text-center">
									 <div class="display-inline-block" id="chart-compras"></div>
								  </div>
								</div>
							</div>
							<!-- /sales stats -->
						</div>
					</div>
					<!-- /main charts -->


					<?php include('./includes/footer.inc.php'); ?>

				</div>
				<!-- /content area -->

			</div>
			<!-- /main content -->

		</div>
		<!-- /page content -->

	</div>
	<!-- /page container -->

</body>
</html>

<script>

// Line chart
 // ------------------------------

 // Generate chart
 var line_chart = c3.generate({
		 bindto: '#c3-line-chart',
		 point: {
				 r: 4
		 },
		 size: { height: 400 },
		 color: {
				 pattern: ['#66BB6A', '#54CFDF', '#1E88E5']
		 },
		 data: {
				 columns: [
						 ['COMPRAS', <?php  foreach ($compras as $row => $column) {print($column['total'].',');}?>],
						 ['VENTAS', <?php  foreach ($ventas as $row => $column) {print($column['total'].',');}?>]
				 ],
				 type: 'spline'
		 },
		 grid: {
				 y: {
					   format: d3.format(""),
						 show: true
				 }
		 }
 });


    var pie_chart = c3.generate({
        bindto: '#chart-compras',
        size: { width: 500 },
        data: {
	        x: 'x',
	        columns: [
	            ['x', <?php  foreach ($compras as $row => $column) {print('"'.$column['mes'].'",');}?>],
	            ['MONTO', <?php  foreach ($compras as $row => $column) {print($column['total'].',');}?>]
	        ],
	        type : 'bar',
	        colors: {
           		MONTO: '#66BB6A'
        	},
	    },
	    axis : {
	    	x:{
	    		type: 'category',
	    	},
	         y : {
	            tick: {
	                format: d3.format("")
	               //format: function (d) { return "$" + d; }
	            }
	        }
	    }
    });

    var pie_chart = c3.generate({
        bindto: '#chart-ventas',
        size: { width: 500 },
        data: {
	        x: 'x',
	        columns: [
	            ['x', <?php  foreach ($ventas as $row => $column) {print('"'.$column['mes'].'",');}?>],
	            ['MONTO', <?php  foreach ($ventas as $row => $column) {print($column['total'].',');}?>]
	        ],
	        type : 'bar',
	        colors: {
           		MONTO: '#54CFDF'
        	},
	    },
	    axis : {
	    	x:{
	    		type: 'category',
	    	},
	         y : {
	            tick: {
	                format: d3.format("")
	               //format: function (d) { return "$" + d; }
	            }
	        }
	    }
    });



</script>
