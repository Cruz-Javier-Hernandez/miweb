<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Calzado Alexander</title>
  <!-- Para ICONOS -->
  <link rel="apple-touch-icon" sizes="57x57" href="<?php asset("img/icoDP/apple-icon-57x57.png") ?>">
  <link rel="apple-touch-icon" sizes="60x60" href="<?php asset("img/icoDP/apple-icon-60x60.png") ?>">
  <link rel="apple-touch-icon" sizes="72x72" href="<?php asset("img/icoDP/apple-icon-72x72.png") ?>">
  <link rel="apple-touch-icon" sizes="76x76" href="<?php asset("img/icoDP/apple-icon-76x76.png") ?>">
  <link rel="apple-touch-icon" sizes="114x114" href="<?php asset("img/icoDP/apple-icon-114x114.png") ?>">
  <link rel="apple-touch-icon" sizes="120x120" href="<?php asset("img/icoDP/apple-icon-120x120.png") ?>">
  <link rel="apple-touch-icon" sizes="144x144" href="<?php asset("img/icoDP/apple-icon-144x144.png") ?>">
  <link rel="apple-touch-icon" sizes="152x152" href="<?php asset("img/icoDP/apple-icon-152x152.png") ?>">
  <link rel="apple-touch-icon" sizes="180x180" href="<?php asset("img/icoDP/apple-icon-180x180.png") ?>">
  <link rel="icon" type="image/png" sizes="192x192" href="<?php asset("img/icoDP/android-icon-192x192.png") ?>">
  <link rel="icon" type="image/png" sizes="32x32" href="<?php asset("img/icoDP/favicon-32x32.png") ?>">
  <link rel="icon" type="image/png" sizes="96x96" href="<?php asset("img/icoDP/favicon-96x96.png") ?>">
  <link rel="icon" type="image/png" sizes="16x16" href="<?php asset("img/icoDP/favicon-16x16.png") ?>">
  <link rel="manifest" href="<?php asset("img/icoDP/manifest.json") ?>">
  <meta name="msapplication-TileColor" content="#ffffff">
  <meta name="msapplication-TileImage" content="<?php asset("img/icoDP/ms-icon-144x144.png") ?>">
  <meta name="theme-color" content="#ffffff">

  <link rel="shortcut icon" href="<?php asset("img/icoDP/favicon.ico") ?>" type="image/x-icon">
  <link rel="icon" href="<?php asset("img/icoDP/favicon.ico") ?>" type="image/x-icon">
  <!-- Archivos CSS -->
  <!-- Bootstrap Core CSS -->
  <link href="<?php asset("bower_components/bootstrap/css/bootstrap.min.css") ?>" rel="stylesheet">
  <!-- MetisMenu CSS -->
  <link href="<?php asset("bower_components/metisMenu/dist/metisMenu.min.css") ?>" rel="stylesheet">
  <!-- Custom CSS -->
  <link href="<?php asset("bower_components/css/sb-admin-2.css") ?>" rel="stylesheet">
  <!-- Custom Fonts -->
  <link href="<?php asset("bower_components/font-awesome/css/font-awesome.min.css") ?>" rel="stylesheet" type="text/css">
  <!--Archivos CSS para Alertify -->
  <!-- include the style -->
  <link href="<?php asset("bower_components/alertify/css/alertify.min.css") ?>" rel="stylesheet">
  <!-- include a theme -->
  <link href="<?php asset("bower_components/alertify/css/themes/bootstrap.min.css") ?>" rel="stylesheet">
  <!-- Archivos JS -->


  <script>
    $(document).ready(function() {
      $('#page-loader').fadeOut(500);
    });
  </script>
</head>

<!-- How to create a navigation bar:
 This is the html file:

 Put the class="active" in the html file/page you are coding in
 (e.g. put the class="active" in the Home.html file)
 To position a page link to the right do class="right"
-->
<style>
  #custom-search {
    border: 2px solid #007bff;
    border-radius: 25px;
    padding: 10px 15px;
    font-size: 16px;
    color: #333;
    transition: all 0.3s ease-in-out;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
  }

  #custom-search:focus {
    border-color: #0056b3;
    outline: none;
    box-shadow: 0 0 8px rgba(0, 91, 187, 0.6);
  }

  .form-group.has-feedback .form-control-feedback {
    pointer-events: none;
    top: 8px;
    right: 15px;
    color: #007bff;
  }

  .form-group.has-feedback .form-control-feedback:hover {
    color: #0056b3;
  }

  #tabla_productos td:nth-child(1) {
    display: none;

  }

  #tabla_productos th:nth-child(1) {
    display: none;
  }

  .resaltar {
    background-color: aqua;
    width: 50%;
  }

  a:hover {
    transition: 3s ease;
    transform: scale(1.20);
    color: white;
    background-color: #2C3E50;
  }

  nav {
    width: 100%;
    position: fixed;
    top: 0px;
    background-color: #2C3E50;
    box-shadow: 2px 0px 7px #000;
    z-index: 50;
  }

  .contenedor-tabla {
    display: table;
    width: 50%;
  }

  .contenedor-tr {
    display: table-row;
    width: 50%;

  }

  .contenedor-tr>a {
    text-decoration: none;
    color: white;
  }

  .contenedor-tr>a:hover {
    background-color: rgba(255, 255, 255, .1);
    transition: background-color .4s ease-in;
  }

  .contenedor-tr>a:last-child {
    border-right: 1px solid rgba(255, 255, 255, 0.3);
  }

  .table-cell-td {
    display: table-cell;
    padding: 20px 7px;
    border-left: 1px rgba(255, 255, 255, 0);
    text-align: center;
    width: 20%;

  }

  .table-cell-td:focus {
    outline: none;
  }

  .text-navbar {
    color: #ffff;
    font-size: 19px;
    float: left;
    margin-left: 2%;
    margin-top: 15px;
  }

  #mobile-menu-list {
    display: none;
  }

  section {
    width: 100%;
    margin: 0px;
    padding: 60px 0px;
  }

  article {
    width: 100%;
    margin: 0px;
    padding: 10px;
  }

  .card {
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
    max-width: 60px;
    margin: auto;
    text-align: center;
    font-family: arial;
  }

  .price {
    color: grey;
    font-size: 22px;
  }


  .card:hover {
    opacity: 0.7;
    background-color: yellow;
  }
</style>


<nav id="navbar-auto-hidden">
  <div class="row hidden-xs">
    <div class="col-xs-11">
      <h1>
        <img src="assets\img\descarga.png" aling="center" width="100" height="90" align="left"> </img>
        <center>
          <FONT COLOR="white"> Calzado Alexander</FONT>
        </center>
    </div>
    <div class="col-xs-1">
      <div class="contenedor-tabla pull-right">
        <div class="contenedor-tr">
          <a href="#" class="table-cell-td" data-toggle="modal" data-target=".modal-login">
            <i class="fa fa-user" style="font-size: 42px;display: block;"></i>&nbsp;&nbsp;Login</a>
        </div>
      </div>
    </div>
  </div>
  <div class="row visible-xs"><!-- Mobile menu navbar -->
    <div class="col-xs-12">
      <button class="btn btn-default pull-left button-mobile-menu" id="btn-mobile-menu">
        <i class="fa fa-th-list"></i>&nbsp;&nbsp;Menú
      </button>

      <a href="#" data-toggle="modal" data-target=".modal-login" id="button-login-xs" class="elements-nav-xs">
        <i class="fa fa-user"></i>&nbsp; Iniciar Sesión
      </a>

    </div>
</nav>
<div id="page-loader"><span class="preloader-interior"></span></div>
<div class="modal fade modal-login" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm" style="margin-top: 196px;">
    <div class="modal-content" id="modal-form-login" style="padding: 15px;">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <p class="text-center ">
          <i class="fa fa-user-circle-o fa-3x" aria-hidden="true"></i>
        </p>
        <h4 class="modal-title text-center " id="myModalLabel">Iniciar sesión</h4>
      </div>
      <form role="form" action="<?php url("login/ingresar") ?>" method="post">
        <input value="<?php csrf_token() ?>" name="_token" type="hidden">


        <div class="form-group label-floating">
          <label class="control-label" style="color: black;"><span class="glyphicon glyphicon-user"></span>&nbsp;Nombre</label>
          <input class="form-control" placeholder="usuario" name="user" pattern="[A-Za-z0-9_-]{1,20}" id="user" type="text" required autocomplete="on" autofocus>

        </div>
        <div class="form-group label-floating">
          <label class="control-label" style="color: black;"><span class="glyphicon glyphicon-lock"></span>&nbsp;Contraseña</label>
          <input class="form-control" placeholder="password" name="password" pattern="[A-Za-z0-9_-]{1,20}" id="password" type="password" required>
        </div>


        <button type="submit" id="singin" class="btn btn-lg btn-redTienda btn-block">Ingresar</button>

    </div>
    <div class="ResFormL" style="width: 100%; text-align: center; margin: 0;"></div>
    </form>
  </div>
</div>
</div>

<br>
<br>
<br>
<br>
<br>
<br>

<?php

use \App\modelo\Parametro;

$parametro = Parametro::find(1);
include("vistas/includes/menuSearch.php");
?>
<!-- Contenido Principal -->


<div class="row">
  <div class="col-lg-12">
    <div class="panel panel-green">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-barcode"></i> INVENTARIO </h3>
      </div>
      <div class="form-group has-feedback" style="max-width: 400px; margin: 0 auto;">
        <input
          id="custom-search"
          type="text"
          class="form-control"
          placeholder="🔍 Buscar Producto..."
          aria-label="Buscar Producto">
       
      </div>

      <div class="">
        <div class="row">
          <div class="col-lg-12">
            <div style="width: 100%; padding-right: -10px;">
              <div class="table-responsive">
                <table id="tabla_productos" class="table-condensed table-hover table-bordered" cellspacing="0" width="100%">
                  <thead>
                    <tr>
                      <th>Id</th>
                      <th>Código</th>
                      <th>Imagenes</th>
                      <th>Nombre</th>
                      <th>Precios</th>
                      <!-- 	<th>Precio Minimo</th>	 -->
                      <th>Pares</th>
                      <th>Marca</th>
                      <th>Tallas</th>
                    </tr>
                  </thead>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="panel-footer clearfix">
      </div>
    </div>
  </div>
  <!--Ventana Modal TALLES/COLORES-->
  <div class="modal fade" id="modal_tallesColores" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header modal-header-greensteel">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="">Stock actual</h4>
        </div>
        <div class="panel-body">
          <div class="form-group">
            <div class="row">
              <div class="col-lg-12">
                <div class="table-responsive">
                  <table id="tablaTalleColor" class="table table-bordered table-condensed" cellspacing="0" width="100%">
                    <thead>
                      <th class="text-center">Talle / Color</th>

                    </thead>
                    <tbody>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>

        </div>
        <div class="modal-footer clearfix">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal" tabindex=""><i class="fa fa-ban" aria-hidden="true"></i> Salir</button>

        </div>
      </div>
    </div>
  </div>

  <script>
    //tabla PRODUCTOS
    //Control de stock con JQuery
    $('#tabla_productos').DataTable({
      "lengthChange": true,
      "deferRender": true,
      "bProcessing": true,
      "bServerSide": true,
      "lengthMenu": [
        [10, 25, 50, -1],
        [10, 25, 50, "All"]
      ],
      "pageLength": 5,
      dom: 'Bfrtilp',
      "sAjaxSource": "./libreria/ServerSide/serversideVentasProductos.php",
      "columnDefs": [{
        "targets": -1,
        "data": null,
        "defaultContent": "<div class='wrapper text-center'><div class='btn-group' role='group'><a class='btnMostrarTallesColores btn btn-green' data-toggle='tooltip' title='Talle/Color'><i class='fa fa-expand' aria-hidden='true'></i></a></div></div>"
      }],
      "bDestroy": true,
      //configuro lenguaje en español
      "language": {
        "sProcessing": "Procesando...",
        "sLengthMenu": "Mostrar _MENU_ registros",
        "sZeroRecords": "No se encontraron resultados",
        "sEmptyTable": "Ningún dato disponible en esta tabla",
        "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
        "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
        "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
        "sInfoPostFix": "",
        "sSearch": "Buscar Producto:",
        "sUrl": "",
        "sInfoThousands": ",",
        "sLoadingRecords": "Cargando...",
        "oPaginate": {
          "sFirst": "Primero",
          "sLast": "Último",
          "sNext": "Siguiente",
          "sPrevious": "Anterior"
        },
        "oAria": {
          "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
          "sSortDescending": ": Activar para ordenar la columna de manera descendente"
        }
      },
      "dom": 'rtip',
      "iDisplayLength": 5,
    });
    $('#custom-search').on('keyup', function() {
      $('#tabla_productos').DataTable().search(this.value).draw();
    });

    function mostrarImagenCompleta(url) {
      // Crea un elemento de imagen en un div modal para mostrar la imagen a pantalla completa
      var modal = document.createElement('div');
      modal.style.position = 'fixed';
      modal.style.top = '0';
      modal.style.left = '0';
      modal.style.width = '100%';
      modal.style.height = '100%';
      modal.style.backgroundColor = 'rgba(0, 0, 0, 0.8)';
      modal.style.display = 'flex';
      modal.style.alignItems = 'center';
      modal.style.justifyContent = 'center';

      var img = document.createElement('img');
      img.src = url;
      img.style.maxWidth = '100%';
      img.style.maxHeight = '100%';

      // Cierra el modal cuando se hace clic en la imagen
      img.onclick = function() {
        modal.style.display = 'none';
      };

      modal.appendChild(img);
      document.body.appendChild(modal);
    }
  </script>

  <?php
  include("vistas/includes/menuInferior.php");
  ?>