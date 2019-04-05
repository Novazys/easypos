<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="autor" content="Cocho's Developers">
    <meta name="description" content="Sistema de control de Actas de la Diócesis de San Miguel">
    <title>EasyPOS - Sus ventas mas fácil</title>


    <!-- Global stylesheets -->
    <!--<link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">-->
    <link href="web/assets/css/icons/icomoon/styles.css" rel="stylesheet" type="text/css">
    <link href="web/assets/css/icons/fontawesome/styles.min.css" rel="stylesheet" type="text/css">
    <link href="web/assets/css/bootstrap.css" rel="stylesheet" type="text/css">
    <link href="web/assets/css/core.css" rel="stylesheet" type="text/css">
    <link href="web/assets/css/components.css" rel="stylesheet" type="text/css">
    <link href="web/assets/css/colors.css" rel="stylesheet" type="text/css">
    <link rel="icon" type="image/png" href="web/assets/images/pos.png"/>
    <link rel="shortcut icon" href="web/assets/images/EasyPOS.ico">


    <!-- Core JS files -->
    <script type="text/javascript" src="web/assets/js/plugins/loaders/pace.min.js"></script>
    <script type="text/javascript" src="web/assets/js/core/libraries/jquery.min.js"></script>
    <script type="text/javascript" src="web/assets/js/core/libraries/bootstrap.min.js"></script>
    <script type="text/javascript" src="web/assets/js/plugins/loaders/blockui.min.js"></script>
    <script type="text/javascript" src="web/assets/js/plugins/forms/selects/select2.min.js"></script>
    <!-- /core JS files -->

    <!-- Theme JS files -->
    <script type="text/javascript" src="web/assets/js/plugins/forms/validation/validate.min.js"></script>
    <script type="text/javascript" src="web/assets/js/plugins/forms/validation/localization/messages_es.js"></script>
    <script type="text/javascript" src="web/assets/js/plugins/forms/styling/uniform.min.js"></script>
    <script type="text/javascript" src="web/assets/js/plugins/notifications/sweet_alert.min.js"></script>

    <script type="text/javascript" src="web/assets/js/core/app.js"></script>


    <!-- /theme JS files -->

</head>

<body class="login-container">

<!-- Page container -->
    <div class="page-container">

        <!-- Page content -->
        <div class="page-content">

            <!-- Main content -->
            <div class="content-wrapper">

                <!-- Content area -->
                <div class="content pb-20">

                    <!-- Aqui entra el Layout, // Las vistas se cargaran aqui adentro -->
                    <?php

                    if(file_exists($pathView)){
                        require($pathView);
                    } else {
                        require("./view/off.vw.php"); //Pagina Ops. Error Not Found (esto NO es 404)
                    }
                    ?>

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
