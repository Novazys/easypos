<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="autor" content="Fernando Ventura">
	<meta name="description" content="Sistema de ventas EasyPOS">
	<title>EasyPOS - Sus ventas mas fácil</title>

	<link href="web/assets/css/icons/fontawesome/styles.min.css" rel="stylesheet" type="text/css">

	<!-- Global stylesheets -->
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
	<link href="web/assets/css/icons/icomoon/styles.css" rel="stylesheet" type="text/css">
	<link href="web/assets/css/bootstrap.css" rel="stylesheet" type="text/css">
	<link href="web/assets/css/core.css" rel="stylesheet" type="text/css">
	<link href="web/assets/css/components.css" rel="stylesheet" type="text/css">
	<link href="web/assets/css/colors.css" rel="stylesheet" type="text/css">
	<link rel="icon" type="image/png" href="web/assets/images/pos.png"/>
	<link rel="shortcut icon" href="web/assets/images/EasyPOS.ico">
</head>

<body>

	<style type="text/css">
		@import 'https://fonts.googleapis.com/css?family=Inconsolata';

	html {
	  min-height: 100%;
	}

	body {
	  box-sizing: border-box;
	  height: 100%;
	  background-color: #000000;
	  background-image: radial-gradient(#11581E, #041607);
	  font-family: 'Inconsolata', Helvetica, sans-serif;
	  font-size: 1.5rem;
	  color: rgba(128, 255, 128, 0.8);
	  text-shadow: 0 0 1ex rgba(51, 255, 51, 1), 0 0 2px rgba(255, 255, 255, 0.8);
	}

	.overlay {
	  pointer-events: none;
	  position: absolute;
	  width: 100%;
	  height: 100%;
	  background: repeating-linear-gradient(180deg, rgba(0, 0, 0, 0) 0, rgba(0, 0, 0, 0.3) 50%, rgba(0, 0, 0, 0) 100%);
	  background-size: auto 4px;
	  z-index: 99;
	}

	.overlay::before {
	  content: "";
	  pointer-events: none;
	  position: absolute;
	  display: block;
	  top: 0;
	  left: 0;
	  right: 0;
	  bottom: 0;
	  width: 100%;
	  height: 100%;
	  background-image: linear-gradient(0deg, transparent 0%, rgba(32, 128, 32, 0.2) 2%, rgba(32, 128, 32, 0.8) 3%, rgba(32, 128, 32, 0.2) 3%, transparent 100%);
	  background-repeat: no-repeat;
	  animation: scan 7.5s linear 0s infinite;
	}

	@keyframes scan {
	  0% { background-position: 0 -100vh; }
	  35%, 100% { background-position: 0 100vh; }
	}

	.terminal {
	  box-sizing: inherit;
	  position: absolute;
	  height: 100%;
	  width: 1000px;
	  max-width: 100%;
	  padding: 4rem;
	  text-transform: uppercase;
	}

	.output {
	  color: rgba(128, 255, 128, 0.8);
	  text-shadow: 0 0 1ex #3f3, 0 0 2px rgba(255, 255, 255, 0.8);
	}

	.output::before {
	  content: "> ";
	}

	.input {
	  color: rgba(192, 255, 192, 0.8);
	  text-shadow: 0 0 1ex #3f3, 0 0 2px rgba(255, 255, 255, 0.8);
	}

	.input::before {
	  content: "$ ";
	}

	a {
	  color: #fff;
	  text-decoration: none;
	}

	a::before {
	  content: "[";
	}

	a::after {
	  content: "]";
	}

	.errorcode {
	  color: white;
	}

	.copyright {
	  font-size: .7rem;
	}
	</style>

	<!-- Aqui entra el Layout, // Las vistas se cargaran aqui adentro -->
	<?php  

	if(file_exists($pathView)){
		require($pathView);
	} else {
		require("./view/off.vw.php"); //Pagina Ops. Error Not Found (esto NO es 404)
	}
	?>