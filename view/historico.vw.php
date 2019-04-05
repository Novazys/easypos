<?php

	$objCompra =  new Compra();
	$objProducto =  new Producto();
	if($tipo_usuario == 1){

?>

			<!-- Basic initialization -->
			<div class="panel panel-flat">
				<div class="breadcrumb-line">
					<ul class="breadcrumb">
						<li><a href="?View=Inicio"><i class="icon-home2 position-left"></i> Inicio</a></li>
						<li><a href="javascript:;">Compras</a></li>
						<li class="active">Historico de Precios</li>
					</ul>
				</div>
					<div class="panel-heading">
						<h5 class="panel-title">Historico de Precios de Productos</h5>

					<form role="form" autocomplete="off" class="form-validate-jquery" id="frmSearch">
						<div class="heading-elements">

							<button id="btnGuardar" type="submit" class="btn btn-primary heading-btn">
							<i class="icon-search4"></i> Consultar</button>

							<button type="button" id="print_reporte" class="btn bg-danger-400 heading-btn"><i class="icon-printer2"></i> Imprimir Reporte</button>

						</div>
					</div>
					<div class="panel-body">
						<div class="row">
							 <div class="col-sm-6">
									<div class="form-group">
										<div class="row">
											<div class="col-sm-12">
												<select  data-placeholder="..." id="cbProducto" name="cbProducto"
													class="select-search" style="text-transform:uppercase;"
				                            		onkeyup="javascript:this.value=this.value.toUpperCase();">
				                            			 <?php
															$filas = $objProducto->Listar_Productos();
															if (is_array($filas) || is_object($filas))
															{
															foreach ($filas as $row => $column)
															{
															?>
																<option value="<?php print ($column["idproducto"])?>">
																<?php print ($column["codigo_barra"].' - '.$column["nombre_producto"])?></option>
															<?php
																}
															}
															 ?>
												</select>
											</div>
										</div>
									</div>
								  </form>
						   	  </div>
						  </div>
					</div>
					<div id="reload-div">
					<table class="table datatable-basic table-hover table-xs">
						<thead>
							<tr>
								<th>No</th>
								<th>Producto</th>
								<th>Marca</th>
								<th>Presentacion</th>
								<th>Proveedor</th>
								<th>Fecha</th>
								<th>Precio</th>
							</tr>
						</thead>

						<tbody>



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
<script type="text/javascript" src="web/custom-js/historico.js"></script>

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
