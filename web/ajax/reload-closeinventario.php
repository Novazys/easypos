<div class="panel-body">
<?php 

	 /** Actual month last day **/
	  function _data_last_month_day() {
	      $month = date('m');
	      $year = date('Y');
	      $day = date("d", mktime(0,0,0, $month+1, 0, $year));
	      return date('d/m/y', mktime(0,0,0, $month, $day, $year));
	  };
	  /** Actual month first day **/
	  function _data_first_month_day() {
	      $month = date('m');
	      $year = date('Y');
	      return date('d/m/y', mktime(0,0,0, $month, 1, $year));
	  }
 ?>

	<div class="row">
		<div class="col-md-12">

			<!-- Widget with rounded icon -->
			<div class="panel">
				<div class="panel-body text-center">
					<div class="icon-object border-primary-400 text-primary-400"><i class="icon-calendar icon-3x text-primary-400"></i>
					</div>
					<h2 class="no-margin text-semibold">INVENTARIO VIGENTE DESDE <?php echo _data_first_month_day() ?> HASTA
						<?php echo _data_last_month_day() ?> </h2>
					<span class="text-uppercase text-size-mini text-muted">Este se cerrara al finalizar el periodo</span> <br><br>
					<button id="btnInventario" onclick="CerrarInventario()" type="button" class="btn btn-danger heading-btn"> 
					<i class="icon-lock5"></i> Cerrar Inventario</button>
				</div>
			</div>
			<!-- /widget with rounded icon -->
		</div>
	</div>


