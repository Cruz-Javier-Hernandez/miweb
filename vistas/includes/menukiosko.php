<?php
header("Cache-Control: no-cache, must-revalidate");
header("Expires: Sat, 1 Jul 2000 05:00:00 GMT");
if (!isset($_SESSION["nomyape"])) {
    // redireccionar("/login");
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
<title><?= $_SESSION["Empresa"]?></title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="desiption" content="">
    <meta name="author" content="">

    <!-- Para ICONOS -->
    <!--  <link rel="apple-touch-icon" sizes="57x57" href="<?php asset("img/icoDP/apple-icon-57x57.png") ?>">
    <link rel="apple-touch-icon" sizes="60x60" href="<?php asset("img/icoDP/apple-icon-60x60.png") ?>">
    <link rel="apple-touch-icon" sizes="72x72" href="<?php asset("img/icoDP/apple-icon-72x72.png") ?>">
    <link rel="apple-touch-icon" sizes="76x76" href="<?php asset("img/icoDP/apple-icon-76x76.png") ?>">
    <link rel="apple-touch-icon" sizes="114x114" href="<?php asset("img/icoDP/apple-icon-114x114.png") ?>">
    <link rel="apple-touch-icon" sizes="120x120" href="<?php asset("img/icoDP/apple-icon-120x120.png") ?>">
    <link rel="apple-touch-icon" sizes="144x144" href="<?php asset("img/icoDP/apple-icon-144x144.png") ?>">
    <link rel="apple-touch-icon" sizes="152x152" href="<?php asset("img/icoDP/apple-icon-152x152.png") ?>">
    <link rel="apple-touch-icon" sizes="180x180" href="<?php asset("img/icoDP/apple-icon-180x180.png") ?>"> -->
    <!--     <link rel="icon" type="image/png" sizes="192x192" href="<?php asset("img/icoDP/android-icon-192x192.png") ?>">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php asset("img/icoDP/favicon-32x32.png") ?>">
    <link rel="icon" type="image/png" sizes="96x96" href="<?php asset("img/icoDP/favicon-96x96.png") ?>">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php asset("img/icoDP/favicon-16x16.png") ?>"> -->
    <!--   <link rel="manifest" href="<?php asset("img/icoDP/manifest.json") ?>">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="<?php asset("img/icoDP/ms-icon-144x144.png") ?>"> 
    <meta name="theme-color" content="#ffffff">
    <link rel="shortcut icon" href="<?php asset("img/icoDP/favicon.ico") ?>" type="image/x-icon">
    <link rel="icon" href="<?php asset("img/icoDP/favicon.ico") ?>" type="image/x-icon"> -->

    <!-- ARCHIVOS CSS-->
    <!-- Bootstrap Core CSS -->
    <link href="<?php asset("bower_components/bootstrap/css/bootstrap.min.css") ?>" rel="stylesheet">
    <!-- MetisMenu CSS -->
    <link href="<?php asset("bower_components/metisMenu/dist/metisMenu.min.css") ?>" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?php asset("bower_components/font-awesome/css/font-awesome.min.css") ?>" rel="stylesheet" type="text/css">
    <!-- Custom CSS -->
    <link href="<?php echo asset("bower_components/css/sb-admin-2.css") . '?v=' . time(); ?>" rel="stylesheet">

    <!--Archivos CSS para Alertify -->
    <!-- Alertify style -->
    <link href="<?php asset("bower_components/alertify/css/alertify.min.css") ?>" rel="stylesheet">
    <!-- Alertify theme -->
    <link href="<?php asset("bower_components/alertify/css/themes/default.min.css") ?>" rel="stylesheet">

    <!--ARCHIVOS JS-->
    <!-- JQuery -->
    <script src="<?php asset("bower_components/js/jquery.min.js") ?>"></script>
    <script src="<?php asset("bower_components/js/moment.min.js") ?>"></script>
    <link href="<?php asset("bower_components/css/fullcalendar.min.css") ?>" rel="stylesheet">
    <script src="<?php asset("bower_components/js/fullcalendar.js") ?>"></script>
    <script src="<?php asset("bower_components/js/es.js") ?>"></script>
    <!-- Bootstrap -->
    <script src="<?php asset("bower_components/bootstrap/js/bootstrap.min.js") ?>"></script>
    <!-- Metis Menu Plugin JavaScript -->
    <script src="<?php asset("bower_components/metisMenu/dist/metisMenu.min.js") ?>"></script>
    <!-- Custom Theme JavaScript -->
    <script src="<?php asset("bower_components/js/sb-admin-2.js") ?>"></script>
    <!--Código custom JS para alertify -->
    <script src="<?php asset("bower_components/alertify/alertify.min.js") ?>"></script>





    <script src="<?php asset("bower_components/datatables/js/jquery.dataTables.min.js")?>"></script>
	<!--Archivos JS para DataTables estilo Bootstrap -->
    <script src="<?php asset("bower_components/datatables/js/dataTables.bootstrap.min.js")?>"></script>
    <!--extension BUTTONS para DataTables -->
	<script src="<?php asset("bower_components/datatables/extensions/Buttons/js/dataTables.buttons.min.js")?>"></script>
	<script src="<?php asset("bower_components/datatables/extensions/Buttons/js/buttons.bootstrap.min.js")?>"></script>
	<script src="<?php asset("bower_components/datatables/extensions/Buttons/js/jszip.min.js")?>"></script>
	<script src="<?php asset("bower_components/datatables/extensions/Buttons/js/pdfmake.min.js")?>"></script>
	<script src="<?php asset("bower_components/datatables/extensions/Buttons/js/vfs_fonts.js")?>"></script>
	<script src="<?php asset("bower_components/datatables/extensions/Buttons/js/buttons.html5.min.js")?>"></script>
	<script src="<?php asset("bower_components/datatables/extensions/Buttons/js/buttons.print.min.js")?>"></script>
	<script src="<?php asset("bower_components/datatables/extensions/Buttons/js/buttons.colVis.min.js")?>"></script>
	<!--extension SELECT para DataTables -->
    <script src="<?php asset("bower_components/datatables/Select/js/dataTables.select.min.js")?>"></script>    
	<!--extension KEYTABLES para DataTables -->
	<script src="<?php asset("bower_components/datatables/extensions/keytable/dataTables.keyTable.min.js")?>"></script>    
	<!--scroller para datatables -->
	<!--	<script src="<?php asset("bower_components/datatables/extensions/scroller/js/dataTables.scroller.min.js")?>"></script>-->
    <!--Código JS para JQuery UI -->
    <script src="<?php asset("bower_components/jqueryUI/js/jquery-ui.min.js")?>"></script>
    
    <!--Plugin para Imprimir -->
    <script src="<?php asset("bower_components/jquery-PrintArea/jquery.PrintArea.js")?>"></script>	
	<!--Código custom JS para alertify -->
    <script src="<?php asset("bower_components/alertify/alertify.min.js")?>"></script>
	<!--NUEVO Código para Codigo de barra -->
    <script src="<?php asset("bower_components/jsBarcode/JsBarcode.all.min.js")?>"></script>
			
	<!--Código JS propio base -->
    <script src="<?php asset("bower_components/js/codigo_base.js")?>"></script>	    

    <script src="<?php echo asset('bower_components/js/codigo_ventas.js') . '?v=' . time(); ?>"></script>  


    <script>
        $(document).ready(function() {
            $('#page-loader').fadeOut(500);
        });
    </script>
    <style>
        .linea-superior {
            border-top: 2px solid white;
            display: inline-block;
            top: 0;
            animation: mover-superior 2s linear infinite alternate;

            /* Para que el span ocupe solo el espacio necesario */
        }

        .linea-inferior {
            border-bottom: 2px solid white;
            display: inline-block;
            bottom: 0;
            animation: mover-inferior 2s linear infinite alternate;

            /* Para que el span ocupe solo el espacio necesario */
        }

        .linea-superior,
        .linea-inferior {
            /*position: absolute;*/
            left: 0;
            right: 0;
            overflow: hidden;
        }


        @keyframes mover-superior {
            0% {
                transform: translateX(-50%);
            }

            100% {
                transform: translateX(0);
            }
        }

        @keyframes mover-inferior {
            0% {
                transform: translateX(50%);
            }

            100% {
                transform: translateX(0);
            }
        }

        .social-buttons {
            position: absolute;
            bottom: 7px;
            /* Ajusta esta posición según tus necesidades */
            right: 20px;
            /* Ajusta esta posición según tus necesidades */
            display: flex;
            flex-direction: column;
            /* gap: 10px; */
            /* z-index: 1000; */
            /* Asegúrate de que los botones estén encima de otros elementos */
        }

        .social-buttons a {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            font-size: 24px;
            transition: background-color 0.3s;
        }

        .social-buttons a.facebook {
            background-color: #3b5998;
        }

        .social-buttons a.whatsapp {
            background-color: #25d366;
        }

        .social-buttons a:hover {
            /* background-color: #0056b3; */
        }
    </style>
    <audio autoplay hidden>
        <source src="assets\sonido\Faos.mp3" type="audio/mpeg">
    </audio>
</head>

<body>
    <div id="page-loader"><span class="preloader-interior"></span></div>
    <div id="wrapper"><!-- Inicio "wrapper" -->
        <!-- Navigation -->
        <!--        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">-->
        <nav class="navbar navbar-default " role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">

                <div class="row" style="padding-bottom: 10%;margin-right: 0px;margin-left: 0px;">
                    <a class="navbar-brand" href='#' style="font-size: 155%;">
                        <img style="padding-right: 50px;padding-left: 14px;padding-top: 5%;" src="<?php asset("img/LogoMenuSup.png") ?>">
                        <span class="linea-superior ">Calzado</span>
                        <span class="linea-inferior">Alexander</span>
                    </a>
                </div>

            </div>
            <!-- Botones Sociales Fijos -->
            <div class="social-buttons">
                <a href="https://www.facebook.com/CalzadoAlexander1?mibextid=ZbWKwL" target="_blank" class="facebook">
                    <i class="fa fa-facebook"></i>
                </a>
                <a href="https://api.whatsapp.com/send?phone=50377443807&text=Hola,%20me%20gustaría%20saber%20más%20sobre%20sus%20productos" target="_blank" class="whatsapp">
                    <i class="fa fa-whatsapp"></i>
                </a>
            </div>

            <!-- /.navbar-static-side -->
        </nav>