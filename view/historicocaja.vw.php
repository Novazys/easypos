<?php 

	$objCaja =  new Caja();

?>

			<!-- Basic initialization -->
			<div class="panel panel-flat">
				<div class="breadcrumb-line">
					<ul class="breadcrumb">
						<li><a href="?View=Inicio"><i class="icon-home2 position-left"></i> Inicio</a></li>
						<li><a href="javascript:;">Caja</a></li>
						<li class="active">Historico de Caja</li>
					</ul>
				</div>
					<div class="panel-heading">
						<h5 class="panel-title">Historico de Caja</h5>
						<br>
						 <div class="row">
							 <div class="col-sm-6 col-md-5">
							 	<form role="form" autocomplete="off" class="form-validate-jquery" id="frmSearch">
									<div class="form-group">
										<div class="row">
											<div class="col-sm-5">
												<div class="input-group">
												<span class="input-group-addon"><i class="icon-calendar3"></i></span>
												<input type="text" id="txtF1" name="txtF1" placeholder=""
												 class="form-control input-sm" style="text-transform:uppercase;" 
						                		onkeyup="javascript:this.value=this.value.toUpperCase();">
						                		</div>
											</div>
											<div class="col-sm-5">
												<div class="input-group">
												<span class="input-group-addon"><i class="icon-calendar3"></i></span>
												<input type="text" id="txtF2" name="txtF2" placeholder=""
												 class="form-control input-sm" style="text-transform:uppercase;" 
						                		onkeyup="javascript:this.value=this.value.toUpperCase();">
						                		</div>
											</div>
											<div class="col-sm-2">
												<button style="margin-top: 0px;" id="btnBuscar" type="submit" class="btn btn-info btn-sm"> 
												<i class="icon-search4"></i> Consultar</button>
											</div>
										</div>
									</div>
								  </form>
						   	  </div>
						  </div>
					</div>
					<div class="panel-body">
					</div>
					<div id="reload-div">
					<table class="table datatable-basic table-xxs table-hover">
						<thead>
							<tr>
								<th>Fecha Apertura</th>
								<th>Monto Apertura</th>
								<th>Monto Cierre</th>
								<th>Fecha Cierre</th>
								<th>Estado</th>
								<th class="text-center">Opciones</th>
							</tr>
						</thead>

						<tbody>

						  <?php 
								$filas = $objCaja->Listar_Historico('',''); 
								if (is_array($filas) || is_object($filas))
								{
								foreach ($filas as $row => $column) 
								{

									$fecha_apertura = $column["fecha_apertura"];
									if(is_null($fecha_apertura))
									{
										$envio_date = '';

									} else {

									$envio_date = DateTime::createFromFormat('Y-m-d H:i:s',$fecha_apertura)->format('d/m/Y H:i:s');

									}

									$fecha_cierre = $column["fecha_cierre"];
									if(is_null($fecha_cierre))
									{
										$envio_date2 = '';

									} else {

									$envio_date2 = DateTime::createFromFormat('Y-m-d H:i:s',$fecha_cierre)->format('d/m/Y H:i:s');

									}

								?>
									<tr>
					                	<td><?php print($envio_date); ?></td>
					                	<td><?php print($column['monto_apertura']); ?></td>
					                	<td><?php print($column['monto_cierre']); ?></td>
					                	<td><?php print($envio_date2 ); ?></td>
					                	<td><?php if($column['estado'] == '1')
					                		echo '<span class="label label-success label-rounded"><span 
					                		class="text-bold">ABIERTA</span></span>';
					                		else 
					                		echo '<span class="label label-default label-rounded">
					                	<span 
					                	    class="text-bold">CERRADA</span></span>'
						                ?></td>
					                	<td class="text-center">
					                	<?php if($column['estado']=='1'){ ?>
										<ul class="icons-list">
											<li class="dropdown">
												<a href="#" class="dropdown-toggle" data-toggle="dropdown">
													<i class="icon-menu9"></i>
												</a>

												<ul class="dropdown-menu dropdown-menu-right">
													<li><a id="delete_product" 	
													data-id="<?php print($column['idcaja']); ?>" 
													href="javascript:void(0)">
													<i class="icon-safe">
													</i> Cerrar</a></li>
												</ul>
											</li>
										</ul>
										<?php } ?>
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
<script type="text/javascript" src="web/custom-js/hcaja.js"></script>