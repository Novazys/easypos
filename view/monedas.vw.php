<?php

	$objMoneda =  new Moneda();
	if($tipo_usuario==1){
?>

			<!-- Basic initialization -->
			<div class="panel panel-flat">
				<div class="breadcrumb-line">
					<ul class="breadcrumb">
						<li><a href="?View=Inicio"><i class="icon-home2 position-left"></i> Inicio</a></li>
						<li><a href="javascript:;">Parametros</a></li>
						<li class="active">Monedas</li>
					</ul>
				</div>
					<div class="panel-heading">
						<h5 class="panel-title">Monedas</h5>

						<div class="heading-elements">
							<button type="button" class="btn btn-primary heading-btn"
							onclick="newMoneda()">
							<i class="icon-database-add"></i> Agregar Nuevo/a</button>
						</div>
					</div>
					<div class="panel-body">
					</div>
					<div id="reload-div">
					<table class="table datatable-basic table-xxs table-hover">
						<thead>
							<tr>
								<th>No</th>
								<th>Estandar ISO</th>
								<th>Lenguaje</th>
								<th>Nombre Moneda</th>
								<th>Simbolo</th>
								<th class="text-center">Opciones</th>
							</tr>
						</thead>

						<tbody>

						  <?php
								$filas = $objMoneda->Listar_Monedas();
								if (is_array($filas) || is_object($filas))
								{
								foreach ($filas as $row => $column)
								{

								?>
									<tr>
								<td><?php print($column['idcurrency']); ?></td>
					                	<td><?php print($column['CurrencyISO']); ?></td>
					            		<td><?php print($column['Language']); ?></td>
					            		<td><?php print($column['CurrencyName']); ?></td>
					            		<td><?php print($column['Symbol']); ?></td>
					                	<td class="text-center">
										<ul class="icons-list">
											<li class="dropdown">
												<a href="#" class="dropdown-toggle" data-toggle="dropdown">
													<i class="icon-menu9"></i>
												</a>

												<ul class="dropdown-menu dropdown-menu-right">
													<li><a
													href="javascript:;" data-toggle="modal" data-target="#modal_iconified"
													onclick="openMoneda('editar',
								                     '<?php print($column["idcurrency"]); ?>',
								                     '<?php print($column["CurrencyISO"]); ?>',
								                     '<?php print($column["Language"]); ?>',
								                     '<?php print($column["CurrencyName"]); ?>',
								                     '<?php print($column["Money"]); ?>',
								                     '<?php print($column["Symbol"]); ?>')">
												   <i class="icon-pencil6">
											       </i> Editar</a></li>
													<li><a
													href="javascript:;" data-toggle="modal" data-target="#modal_iconified"
													onclick="openMoneda('ver',
								                     '<?php print($column["idcurrency"]); ?>',
								                     '<?php print($column["CurrencyISO"]); ?>',
								                     '<?php print($column["Language"]); ?>',
								                     '<?php print($column["CurrencyName"]); ?>',
								                     '<?php print($column["Money"]); ?>',
								                     '<?php print($column["Symbol"]); ?>')">
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
					</div>
				</div>

			<!-- Iconified modal -->
				<div id="modal_iconified" class="modal fade">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal">&times;</button>
								<h5 class="modal-title"><i class="icon-pencil7"></i> &nbsp; <span class="title-form"></span></h5>
							</div>

					        <form role="form" autocomplete="off" class="form-validate-jquery" id="frmModal">
								<div class="modal-body" id="modal-container">

								<div class="alert alert-info alert-styled-left text-blue-800 content-group">
						                <span class="text-semibold">Estimado usuario</span>
						                Los campos remarcados con <span class="text-danger"> * </span> son necesarios.
						                <button type="button" class="close" data-dismiss="alert">×</button>
						                <input type="hidden" id="txtID" name="txtID" class="form-control" value="">
                                      	<input type="hidden" id="txtProceso" name="txtProceso" class="form-control" value="">
						           </div>

									<div class="form-group">
										<div class="row">
											<div class="col-sm-5">
												<label>Estandard ISO <span class="text-danger">*</span></label>
												<input type="text" id="txtISO" name="txtISO" placeholder="SVC"
												 class="form-control" style="text-transform:uppercase;"
                                        		onkeyup="javascript:this.value=this.value.toUpperCase();">
											</div>
										</div>
									</div>

						 			<div class="form-group">
										<div class="row">
											<div class="col-sm-5">
												<label>Lenguaje <span class="text-danger">*</span></label>
												<input type="text" id="txtLenguaje" name="txtLenguaje" 
												 placeholder="ES"
												 class="form-control" style="text-transform:uppercase;"
                                        		onkeyup="javascript:this.value=this.value.toUpperCase();">
											</div>

											<div class="col-sm-7">
												<label>Nombre Completo <span class="text-danger">*</span></label>
												<input type="text" id="txtNombre" name="txtNombre" placeholder="Dolar Estadounidense"
												 class="form-control">
											</div>
										</div>
									</div>


						           <div class="form-group">
										<div class="row">
											<div class="col-sm-6">
												<label>Nombre Moneda </label>
												<input type="text" id="txtMoneda" name="txtMoneda" 
												 placeholder="US Dolar"
												 class="form-control" style="text-transform:uppercase;"
                                        		onkeyup="javascript:this.value=this.value.toUpperCase();">
											</div>

											<div class="col-sm-6">
												<label>Simbolo</label>
												<input type="text" id="txtSimbolo" name="txtSimbolo" 
												placeholder="$"
												 class="form-control" style="text-transform:uppercase;"
                                        		onkeyup="javascript:this.value=this.value.toUpperCase();">
											</div>

										</div>
									</div>

								</div>

								<div class="modal-footer">
									<button id="btnGuardar" type="submit" class="btn btn-primary">Guardar</button>
									<button id="btnEditar" type="submit" class="btn btn-warning">Editar</button>
									<button  type="reset" class="btn btn-default" id="reset"
									class="btn btn-link" data-dismiss="modal">Cerrar</button>
								</div>
							</form>
						</div>
					</div>
				</div>
				<!-- /iconified modal -->
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
<script type="text/javascript" src="web/custom-js/moneda.js"></script>
<?php } else { ?>

	<div class="panel-body">
		<div class="row">
			<div class="col-md-12">

				<!-- Widget with rounded icon -->
				<div class="panel">
					<div class="panel-body text-center">
						<div class="icon-object border-danger-400 text-primary-400"><i class="icon-lock5 icon-3x text-danger-400"></i>
						</div>
						<h2 class="no-margin text-semibold"> SU USUARIO NO POSEE PERMISOS SUFICIENTES </h2>
						<span class="text-uppercase text-size-mini text-muted">Su usuario no posee los permisos respectivos
						para poder accesar a este modulo. Lo invitamos a dar click </span> <a href="./?View=Inicio">AQUI</a> <br><br>

					</div>
				</div>
				<!-- /widget with rounded icon -->
			</div>
		</div>

<?php } ?>
