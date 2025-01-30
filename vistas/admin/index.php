<?php

use App\modelo\Calendario;

include("vistas/includes/menuSupLimpio.php");
include(CONTROLADORES . 'CategoriaController.php');
include(CONTROLADORES . 'ProductoController.php');
include(CONTROLADORES . 'ClienteController.php');
include(CONTROLADORES . 'VentaController.php');
include(CONTROLADORES . 'UsuarioController.php');
include(CONTROLADORES . 'ProveedorController.php');
include(CONTROLADORES . 'FacturasController.php');
include(CONTROLADORES . 'MarcaController.php');
include(CONTROLADORES . 'GeneroController.php');
include(CONTROLADORES . 'CompraController.php');
include(CONTROLADORES . 'ComprobanteController.php');
include(CONTROLADORES . 'pedidosController.php');
include(CONTROLADORES . 'ReporteController.php');
include(CONTROLADORES . 'CalendarioController.php');
include(CONTROLADORES . 'EmpleadosController.php');
include(CONTROLADORES . 'AsistenciaController.php');
?>
<div id="page-wrapper" style="padding-top: 5%;">
	<div class="container-fluid2">
		<div class="row">
			<!-- Contenedor de PRODUCTOS -->
			<div class="col-lg-3 col-md-6 col-xs-6">
				<div class="panel panel-rojo">
					<div class="panel-heading">
						<div class="row">
							<div class="col-xs-3">
								<i class="fa fa-tasks fa-5x"></i>
							</div>
							<div class="col-xs-9 text-right">
								<div style="font-size: 10px;color: #E5E5E5;">PRODUCTOS:</div>
								<div style="font-size: 15px;color: #E5E5E5;">
									<?php
									$objeto = new ProductoController();
									$objeto->cantidad();
									?>
								</div>
								<div style="font-size: 10px;color: #E5E5E5;">PARES:</div>
								<div style="font-size: 10px;color: #E5E5E5;">
									<?php
									$objeto = new ProductoController();
									$objeto->cantidad_pares();
									?>
								</div>
							</div>
						</div>
					</div>
					<a href='<?php url("productos") ?>'>
						<div class="panel-footer">
							<span class="pull-left">Ver más</span>
							<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
							<div class="clearfix"></div>
						</div>
					</a>
					<strong>
				</div>
			</div>
			<!-- Contenedor de PROVEDORES -->
			<div class="col-lg-3 col-md-6 col-xs-6">
				<div class="panel panel-celeste cajasInicio">
					<div class="panel-heading">
						<div class="row">
							<div class="col-xs-3">
								<i class="fa fa-suitcase fa-5x"></i>
							</div>
							<div class="col-xs-9 text-right">
								<div class="huge">
									<?php
									$objeto = new ProveedorController();
									$objeto->cantidad();
									?>
								</div>
								<div class="small">PROVEDORES</div>
							</div>
						</div>
					</div>
					<a href='<?php url("proveedores") ?>'>
						<div class="panel-footer">
							<span class="pull-left">Ver más</span>
							<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
							<div class="clearfix"></div>
						</div>
					</a>
				</div>
			</div>
			<?php if ($_SESSION["user"] == "admin") {
				# code...
			?>
				<!-- Contenedor de USUARIOS -->
				<div class="col-lg-3 col-md-6 col-xs-6">
					<div class="panel panel-naranja cajasInicio">
						<div class="panel-heading">
							<div class="row">
								<div class="col-xs-3">
									<i class="fa fa-user fa-5x"></i>
								</div>
								<div class="col-xs-9 text-right">
									<div class="huge">
										<?php
										$objeto = new UsuarioController();
										$objeto->cantidad();
										?>
									</div>
									<div>USUARIO</div>
								</div>
							</div>
						</div>
						<a href='<?php url("usuarios") ?>'>
							<div class="panel-footer">
								<span class="pull-left">Ver más</span>
								<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
								<div class="clearfix"></div>
							</div>
						</a>
					</div>
				</div>
			<?php } ?>
			<!-- Contenedor de VENTAS -->
			<div class="col-lg-3 col-md-6 col-xs-6">
				<div class="panel panel-azulTienda cajasInicio">
					<div class="panel-heading">
						<div class="row">
							<div class="col-xs-3">
								<i class="fa fa-folder-open fa-5x"></i>
							</div>
							<div class="col-xs-9 text-right">
								<div class="huge">
									<?php
									$objeto = new VentaController();
									$objeto->cantidad();
									?>
								</div>
								<div>VENTAS</div>
							</div>
						</div>
					</div>

					<a href='<?php url("ventas/") ?>'>
						<div class="panel-footer">
							<span class="pull-left">Ver más</span>
							<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
							<div class="clearfix"></div>
						</div>
					</a>
				</div>
			</div>

			<!-- Contenedor de FACTURAS -->
			<div class="col-lg-3 col-md-6 col-xs-6">
				<div class="panel panel-yellow cajasInicio">
					<div class="panel-heading">
						<div class="row">
							<div class="col-xs-3">
								<i class="fa fa-folder-open fa-5x"></i>
							</div>
							<div class="col-xs-9 text-right">
								<div class="huge">
									<?php
									$objeto = new FacturasController();
									$objeto->cantidad();
									?>
								</div>
								<div>FACTURAS</div>
							</div>
						</div>
					</div>
					<a href='<?php url("facturas") ?>'>
						<div class="panel-footer">
							<span class="pull-left">Ver más</span>
							<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
							<div class="clearfix"></div>
						</div>
					</a>
				</div>
			</div>
			<!-- Contenedor de PEDIDOS -->
			<div class="col-lg-3 col-md-6 col-xs-6">
				<div class="panel panel-lila cajasInicio">
					<div class="panel-heading">
						<div class="row">
							<div class="col-xs-3">
								<i class="fa fa-truck fa-5x"></i>
							</div>
							<div class="col-xs-9 text-right">
								<div class="huge">
									<?php
									$objeto = new pedidosController();
									$objeto->cantidad();
									?>
								</div>
								<div>PEDIDOS</div>
							</div>
						</div>
					</div>
					<a href='<?php url("pedidos") ?>'>
						<div class="panel-footer">
							<span class="pull-left">Ver más</span>
							<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
							<div class="clearfix"></div>
						</div>
					</a>
				</div>
			</div>
			<div class="col-lg-3 col-md-6 col-xs-6">
				<div class="panel panel-bluechambray cajasInicio">
					<div class="panel-heading">
						<div class="row">
							<div class="col-xs-3">
								<i class="fa fa-calendar fa-5x"></i>
							</div>
							<div class="col-xs-9 text-right">
								<div class="huge">
									<?php
									$objeto = new CalendarioController();
									$objeto->cantidad();
									?>
								</div>
								<div>CALENDARIO/EVENTOS</div>
							</div>
						</div>
					</div>
					<a href='<?php url("calendario") ?>'>
						<div class="panel-footer">
							<span class="pull-left">Ver más</span>
							<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
							<div class="clearfix"></div>
						</div>
					</a>
				</div>
			</div>
			<div class="col-lg-3 col-md-6 col-xs-6">
				<div class="panel panel-brown cajasInicio">
					<div class="panel-heading">
						<div class="row">
							<div class="col-xs-3">
								<i class="fa fa-users fa-5x"></i>
							</div>
							<div class="col-xs-9 text-right">
								<div class="huge">
									<?php
									$objeto = new EmpleadosController();
									$objeto->cantidad();
									?>
								</div>
								<div>ASISTENCIA</div>
							</div>
						</div>
					</div>
					<a href='<?php url("asistencia") ?>'>
						<div class="panel-footer">
							<span class="pull-left">Ver más</span>
							<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
							<div class="clearfix"></div>
						</div>
					</a>
				</div>
			</div>
			<?php  if ($_SESSION["user"] == "admin") {
				
			?> 
				<!-- Contenedor de CONFIGURACION -->
				<div class="col-lg-3 col-md-6 col-xs-6">
					<div class="panel panel-bluedark cajasInicio">
						<div class="panel-heading">
							<div class="row">
								<div class="col-xs-3">
									<i class="fa fa-cog fa-5x"></i>
								</div>
								<div class="col-xs-9 text-right">
									<div class="huge">
										<i class="fa fa-wrench" aria-hidden="true"></i>
									</div>
									<div>CONFIGURACION</div>
								</div>
							</div>
						</div>
						<a href='<?php url("parametros") ?>'>
							<div class="panel-footer">
								<span class="pull-left">Configurar el Sistema</span>
								<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
								<div class="clearfix"></div>
							</div>
						</a>
					</div>
				</div>
			<?php } ?>
			<!-- Contenedor de REPORTES -->
			<div class="col-lg-3 col-md-6 col-xs-6">
				<div class="panel panel-negro cajasInicio">
					<div class="panel-heading">
						<div class="row">
							<div class="col-xs-3">
								<i class="fa fa-line-chart fa-5x"></i>
							</div>
							<div class="col-xs-9 text-right">
								<div class="huge">
									<i class="fa fa-bar-chart" aria-hidden="true"></i>
								</div>
								<div>REPORTES</div>
							</div>
						</div>
					</div>
					<a href='<?php url("reportes") ?>'>
						<div class="panel-footer">
							<span class="pull-left">Ver más</span>
							<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
							<div class="clearfix"></div>
						</div>
					</a>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Contenido Principal -->
<?php
include("vistas/includes/menuInferior.php");
$nomyape = $_SESSION["nomyape"];
if ($_SESSION["valor"] == "true") {
	$_SESSION["valor"] = "false";
	echo "<script>alertify.warning('Conectado como: $nomyape');</script>";
}
?>