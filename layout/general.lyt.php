<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="autor" content="Fernando Ventura">
	<meta name="description" content="Sistema de ventas EasyPOS">
	<title>EasyPOS - Sus ventas mas fácil</title>

	<!-- Global stylesheets -->
	<!--<link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">-->
	<link href="web/assets/css/icons/icomoon/styles.css" rel="stylesheet" type="text/css">
	<link href="web/assets/css/bootstrap.css" rel="stylesheet" type="text/css">
	<link href="web/assets/css/core.css" rel="stylesheet" type="text/css">
	<link href="web/assets/css/components.css" rel="stylesheet" type="text/css">
	<link href="web/assets/css/colors.css" rel="stylesheet" type="text/css">
	<link rel="icon" type="image/png" href="web/assets/images/pos.png"/>
	<link rel="shortcut icon" href="web/assets/images/EasyPOS.ico">

	<!-- /global stylesheets -->

	<!-- Core JS files -->
	<script type="text/javascript" src="web/assets/js/plugins/loaders/pace.min.js"></script>
	<script type="text/javascript" src="web/assets/js/core/libraries/jquery.min.js"></script>
	<script type="text/javascript" src="web/assets/js/core/libraries/bootstrap.min.js"></script>
	<script type="text/javascript" src="web/assets/js/plugins/loaders/blockui.min.js"></script>
	<!-- /core JS files -->

	<!-- Theme JS files -->
	<script type="text/javascript" src="web/assets/js/plugins/tables/datatables/datatables.min.js"></script>
	<script type="text/javascript" src="web/assets/js/plugins/tables/datatables/extensions/responsive.min.js"></script>
	<script type="text/javascript" src="web/assets/js/plugins/tables/datatables/extensions/buttons.min.js"></script>
	<script type="text/javascript" src="web/assets/js/plugins/forms/selects/select2.min.js"></script>
	<script type="text/javascript" src="web/assets/js/plugins/forms/validation/jquery.validate.js"></script>
	<script type="text/javascript" src="web/assets/js/plugins/forms/validation/localization/messages_es.js"></script>
	<script type="text/javascript" src="web/assets/js/plugins/forms/inputs/jquery.mask.js"></script>
	<script type="text/javascript" src="web/assets/js/plugins/ui/moment/moment_locales.min.js"></script>
	<script type="text/javascript" src="web/assets/js/plugins/forms/inputs/bootstrap-datetimepicker.js"></script>
	<script type="text/javascript" src="web/assets/js/plugins/forms/styling/switchery.min.js"></script>
	<script type="text/javascript" src="web/assets/js/plugins/forms/styling/switch.min.js"></script>
	<script type="text/javascript" src="web/assets/js/plugins/forms/inputs/touchspin.min.js"></script>


	<script type="text/javascript" src="web/assets/js/core/libraries/jquery_ui/core.min.js"></script>
	<script type="text/javascript" src="web/assets/js/plugins/extensions/mousewheel.min.js"></script>
	<script type="text/javascript" src="web/assets/js/plugins/forms/styling/uniform.min.js"></script>
	<script type="text/javascript" src="web/assets/js/plugins/notifications/sweet_alert.min.js"></script>
	<script type="text/javascript" src="web/assets/js/plugins/notifications/bootbox.min.js"></script>
	<script type="text/javascript" src="web/assets/js/plugins/uploaders/fileinput/fileinput.min.js"></script>
	<script type="text/javascript" src="web/assets/js/plugins/uploaders/fileinput/es.js"></script>
	<script type="text/javascript" src="web/assets/js/plugins/loaders/progressbar.min.js"></script>
	<script type="text/javascript" src="web/assets/js/plugins/extensions/cookie.js"></script>
	<script type="text/javascript" src="web/assets/js/plugins/visualization/d3/d3.min.js"></script>
	<script type="text/javascript" src="web/assets/js/plugins/visualization/c3/c3.min.js"></script>

	<script type="text/javascript" src="web/assets/js/core/app.js"></script>
	<!-- /theme JS files -->
</head>

<body class="sidebar-xs has-detached-right">

	<!-- Main navbar -->
	<div class="navbar navbar-inverse">
		<div class="navbar-header">
			<a class="navbar-brand" href="./?View=Inicio"><img src="web/assets/images/logo_easypos.png" alt=""></a>

			<ul class="nav navbar-nav visible-xs-block">
				<li><a data-toggle="collapse" data-target="#navbar-mobile"><i class="icon-lock2"></i></a></li>
				<li><a class="sidebar-mobile-main-toggle"><i class="icon-paragraph-justify3"></i></a></li>
			</ul>
		</div>

		<div class="navbar-collapse collapse" id="navbar-mobile">
			<ul class="nav navbar-nav">
				<li><a class="sidebar-control sidebar-main-toggle hidden-xs"><i class="icon-paragraph-justify3"></i></a></li>
			</ul>

			<p class="navbar-text"><span class="label bg-success">En Linea</span></p>

			<ul class="nav navbar-nav navbar-right">
				<li class="dropdown dropdown-user">
					<a class="dropdown-toggle" data-toggle="dropdown">
						<img src="web/assets/images/default.png" alt="">
						<span><b>Bienvenido!,</b> <?php echo $usuario ?></span>
						<i class="caret"></i>
					</a>

					<ul class="dropdown-menu dropdown-menu-right">
						<li><a href="web/ajax/ajxlogin.php?logout=true"><i class="icon-switch2"></i> Cerrar Sesión	</a></li>
					</ul>
				</li>
			</ul>
		</div>
	</div>
	<!-- /main navbar -->


	<!-- Page container -->
	<div class="page-container">

		<!-- Page content -->
		<div class="page-content">

			<!-- Main sidebar -->
			<div class="sidebar sidebar-main">
				<div class="sidebar-content">
					<!-- User menu -->
					<div class="sidebar-user">
						<div class="category-content">
							<div class="media">
								<div class="media-body">
									<span class="media-heading text-semibold"><?php echo $usuario ?></span>
									<div class="text-size-mini text-muted">
									 <?php echo $nombre_empleado ?>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!-- /user menu -->


					<!-- Main navigation -->
					<div class="sidebar-category sidebar-category-visible">
						<div class="category-content no-padding">
							<ul class="navigation navigation-main navigation-accordion">

								<?php include('./includes/menu.inc.php'); ?>

							</ul>
						</div>
					</div>
					<!-- /main navigation -->
				</div>
			</div>
			<!-- /main sidebar -->


			<!-- Main content -->
			<div class="content-wrapper">

				<!-- Content area -->
				<div class="content">


				<!-- Mini modal -->
				<div id="modal_mini" class="modal fade">
					<div class="modal-dialog modal-xs">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal">&times;</button>
								<h5 class="modal-title">Cambiar mi Contraseña</h5>
							</div>

							<div class="modal-body">
							 <!-- Password recovery -->
								<form id="frmResend" method="POST" action="" class="form-validate-jquery">
									<div class="panel panel-body login-form">
										<div class="text-center">
											<div class="icon-object border-warning text-warning"><i class=" icon-user-lock"></i></div>
											<h5 class="content-group">Restaurar Contraseña <small class="display-block">Ingrese su nueva contraseña.</small></h5>
										</div>

											<div class="form-group has-feedback">
												<input type="password" id="passwordr" name="passwordr" class="form-control" placeholder="Ingresar password">
												<div class="form-control-feedback">
													<i class="icon-user-lock text-muted"></i>
												</div>
											</div>


											<div class="form-group has-feedback">
												<input type="password" id="rpasswordr" name="rpasswordr"
												class="form-control" placeholder="Repetir password">
												<div class="form-control-feedback">
													<i class="icon-user-lock text-muted"></i>
												</div>
											</div>

										<button type="submit" class="btn bg-blue btn-block">Restaurar<i class="icon-key position-right"></i></button>
									</div>
								</form>
								<!-- /password recovery -->
							</div>
						</div>
					</div>
				</div>
				<!-- /mini modal -->

				<!-- Aqui entra el Layout, // Las vistas se cargaran aqui adentro -->
				<?php

				if(file_exists($pathView)){
					require($pathView);
				} else {
					require("./view/off.vw.php"); //Pagina Ops. Error Not Found (esto NO es 404)
				}
				?>
