<?php

use App\modelo\Producto;
use App\modelo\Sucursal;
use App\modelo\Rubro;

include("vistas/includes/menuSupReportes.php");
?>

<style>
	/* Estilos personalizados para el select */
	.custom-select {
		appearance: none;
		-webkit-appearance: none;
		-moz-appearance: none;
		background-color: #ffffff;
		border: 1px solid #ced4da;
		border-radius: .25rem;
		padding: .375rem .75rem;
		font-size: 1rem;
		line-height: 1.5;
	}

	/* Estilos para cuando el select está enfocado */
	.custom-select:focus {
		border-color: #80bdff;
		outline: 0;
		box-shadow: 0 0 0 .2rem rgba(0, 123, 255, .25);
	}

	/* Estilos para las opciones del select */
	.custom-select option {
		color: initial;
		background-color: #ffffff;
	}
</style>
<!-- Contenido Principal -->
<div id="page-wrapper">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12">
				<h2 class="page-header hstyle"><i class="fa fa-bar-chart fa-fw"></i> REPORTES GRAFICOS</h2>
				<a class="btn btn-primary pull-left " href="<?php echo url("admin"); ?>"><i class="fa fa-home" aria-hidden="true" placeholder="Home"> </i></a>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-6">
				<div class="panel panel-lila">
					<div class="panel-heading">
						<h3 class="panel-title"> VENTAS</h3>
					</div>
					<div class="panel-body">
						<div class="list-group">
							<div class="row">
								<div class="col-lg-3 col-md-4 col-sm-12">
									<div class="radio">
										<label><input type="radio" id="opcion" name="opcion" value="1" checked>DIARIAS</label>
									</div>
									<div class="radio">
										<label><input type="radio" id="opcion" name="opcion" value="2">MENSUALES</label>
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-3 col-md-4 col-sm-6 col-xs-6 ">
							<div class="input-group">
								<label for="Sucursal">Sucursal</label>
								<select class="form-control Select2" id="Sucursal" name="Sucursal" tabindex="7">
									<?php
									$Sucursales = Sucursal::all();
									foreach ($Sucursales as $Sucursal) {
									?>
										<option value="<?php echo $Sucursal->SucursalID; ?>">
											<?php
											echo $Sucursal->Sucursal;
											?>
										</option>
									<?php
									}
									?>
								</select>

							</div>
						</div>
						<div class="col-lg-3 col-md-4 col-sm-6 col-xs-6 ">
							<div class="input-group">
								<label for="Sucursal">Rublo</label>
								<select class="form-control Select2" id="rublo" name="rublo" tabindex="7">
									<?php
									$Rubro = Rubro::all();
									foreach ($Rubro as $row) {
									?>
										<option value="<?php echo $row->id; ?>">
											<?php
											echo $row->descripcion;
											?>
										</option>
									<?php
									}
									?>
								</select>

							</div>
						</div>
						<div class="col-lg-3 col-md-4 col-sm-6 col-xs-6 ">

							<label for="fechaInicioVtas">Fecha Inicial</label>
							<input type="date" id="fechaInicioVtas" name="fechaInicioVtas" class="form-control" required>
							<br>

						</div>
						<div class="col-lg-3 col-md-4 col-sm-6 col-xs-6 ">

							<label for="fechaFinVtas">Fecha Final</label>
							<input type="date" id="fechaFinVtas" name="fechaFinVtas" class="form-control" required>
						</div>

					</div>
					<div class="panel-footer clearfix">
						<button id="btnGenerarReporteVentas" class="btn btn-lila pull-right"><i class="fa fa-line-chart" aria-hidden="true"></i> Ver Gráfico</button>
					</div>
				</div>
			</div>
			<div class="col-lg-6" style="display: none;">
				<div class="panel panel-lila">
					<div class="panel-heading">
						<h3 class="panel-title"> Compras</h3>
					</div>
					<div class="panel-body">
						<div class="list-group">
							<div class="row">
								<div class="col-lg-6">
									<div class="radio">
										<label><input type="radio" id="opcionCompras" name="opcionCompras" value="1" checked>Diarias</label>
									</div>
									<div class="radio">
										<label><input type="radio" id="opcionCompras" name="opcionCompras" value="2">Mensuales</label>
									</div>
								</div>
							</div>
						</div>
						<label for="fechaInicioCompras">Fecha Inicial</label>
						<input type="date" id="fechaInicioCompras" name="fechaInicioCompras" class="form-control" required>
						<br>
						<label for="fechaFinCompras">Fecha Final</label>
						<input type="date" id="fechaFinCompras" name="fechaFinCompras" class="form-control" required>
					</div>
					<div class="panel-footer clearfix">
						<button id="btnGenerarReporteCompras" class="btn btn-lila pull-right">Ver Gráfico</button>
					</div>
				</div>
			</div>

			<div class="col-lg-6">
				<div class="panel panel-lila">
					<div class="panel-heading">
						<h3 class="panel-title"> MAS VENDIDOS</h3>
					</div>
					<div class="panel-body">
						<div class="col-lg-4 col-md-4 col-sm-6 col-xs-6 ">
							<div class="input-group">
								<label for="Sucursal_Venta">Sucursal</label>
								<select class="form-control Select2" id="Sucursal_Venta" name="Sucursal_Venta" tabindex="7">
									<?php
									$Sucursales = Sucursal::all();
									foreach ($Sucursales as $Sucursal) {
									?>
										<option value="<?php echo $Sucursal->SucursalID; ?>">
											<?php
											echo $Sucursal->Sucursal;
											?>
										</option>
									<?php
									}
									?>
								</select>

							</div>
						</div>
						<div class="col-lg-3 col-md-2 col-sm-6 col-xs-6">
							<div class="input-group">
								<label for="mes"> MES:</label>
								<select name="mes" id="mes" class="form-control Select2" required>
									<?php
									// Establecer el idioma en español
									setlocale(LC_TIME, 'es_ES.utf8', 'es_ES');
									// Generar opciones para los meses en letras
									for ($i = 1; $i <= 12; $i++) {
										$mesNumero = str_pad($i, 2, '0', STR_PAD_LEFT); // Añadir cero al principio si es necesario
										$nombreMes = strftime('%B', strtotime("2022-$mesNumero-01")); // Obtener nombre completo del mes
										echo "<option value=\"$mesNumero\">$nombreMes</option>";
									}
									?>
								</select>
							</div>
						</div>

						<div class="col-lg-3 col-md-2 col-sm-6 col-xs-6">
							<div class="input-group">
								<label for="anio">AÑO:</label>
								<select name="anio" id="anio" class="form-control Select2" required>
									<?php
									// Generar opciones para los años (puedes ajustar el rango según tus necesidades)
									$anioActual = date('Y');
									for ($anio = $anioActual; $anio >= $anioActual - 10; $anio--) {
										echo "<option value=\"$anio\">$anio</option>";
									}
									?>
								</select>
							</div>
						</div>
						<!-- <div class="col-lg-2 col-md-4 col-sm-12 ">
							<div class="input-group">
								<label for="fechaInicio">Fecha Inicial</label>
								<input type="date" id="fechaInicio" name="fechaInicio" class="form-control" required>
								<br>
							</div>
						</div>
						<div class="col-lg-2 col-md-4 col-sm-12 ">
							<div class="input-group">
								<label for="fechaFin">Fecha Final</label>
								<input type="date" id="fechaFin" name="fechaFin" class="form-control" required>
							</div>
						</div> -->

						<div class="col-lg-4 col-md-4 col-sm-6 col-xs-6 pt-5 ">
							<div class="input-group">
								<label for="Por">Por:</label>
								<br>
								<select class="form-control Select2" id="select1">
									<!-- 	<option value="3" selected>Con Mayor Stock (Top 10)</option>
									<option value="4">Más Caros (Top 10)</option> -->
									<option value="5">Marca (Top 10)</option>
									<option value="6">Codigo (Top 10)</option>
									<option value="7">Talla (Top 10)</option>

								</select>
							</div>
						</div>
						<div class="col-lg-5 col-md-4 col-sm-6 col-xs-6 " id="product_por" style="display:none;">
							<div class="input-group">
								<label for="Por">Codigo:</label>
								<br>
								<select class="form-control Select2" id="Por" name="Por" required>
									<?php
									$Producto = Producto::all();
									foreach ($Producto as $Producto) {
									?>
										<option value="<?php echo $Producto->codigo; ?>">
											<?php echo $Producto->codigo; ?>
										</option>
									<?php
									}
									?>
								</select>

							</div>
						</div>
						<!-- 				<div class="row">
							<div class="col-lg-12 form-group">
								<div class="input-group">
									<input type="text" class="form-control" id="codProd" value="" onKeyUp="this.value=this.value.toUpperCase();" placeholder="Código del Producto" tabindex="" autofocus>
									<span class="input-group-btn">
										<button id="btnBuscarCodTalles" class="btn btn-primary pull-right" title="Talles más vendidos"><span class="fa fa-search-plus" aria-hidden="true"></span> Talles</button>
									</span>
									<span class="input-group-btn">
										<button id="btnBuscarCodColores" class="btn btn-lila pull-right" title="Colores más vendidos"><span class="fa fa-search-plus" aria-hidden="true"></span> Colores</button>
									</span>
								</div>
							</div>
						</div> -->
					</div>
					<div class="panel-footer clearfix">
						<button id="btnReporteProd" class="btn btn-lila pull-right" title="Ver Gráfico"><i class="fa fa-line-chart" aria-hidden="true"></i> Ver Gráfico</button>
					</div>


				</div>
			</div>
			<div class="col-lg-6" style="display: none;">
				<div class="panel panel-lila">
					<div class="panel-heading">
						<h3 class="panel-title"> Ingresos y Egresos (Dinero efectivo)</h3>
					</div>
					<div class="panel-body">
						<div class="row">
							<div class="col-lg-6 form-group">
								<!--							   <label for="mesReporte">Mes</label>-->
								<select name="mesReporte" id="mesReporte" class="form-control">
									<option value="0" selected disabled>-- Seleccione el Mes --</option>
									<option value="1">Enero</option>
									<option value="2">Febrero</option>
									<option value="3">Marzo</option>
									<option value="4">Abril</option>
									<option value="5">Mayo</option>
									<option value="6">Junio</option>
									<option value="7">Julio</option>
									<option value="8">Agosto</option>
									<option value="9">Septiembre</option>
									<option value="10">Octubre</option>
									<option value="11">Noviembre</option>
									<option value="12">Diciembre</option>
								</select>
							</div>
							<div class="col-lg-6 form-group">
								<!--							   <label for="anioReporte">Año</label>    -->
								<div class="input-group">
									<input type="number" class="form-control" id="anioReporte" name="anioReporte" value="" placeholder="" tabindex="">
									<span class="input-group-btn">
										<button class="btn btn-lila pull-right" id="btnReporteIyE" data-toggle="tooltip" data-placement="left" title="Ver Gráfico"><i class="fa fa-line-chart" aria-hidden="true"></i></button>
									</span>
								</div>
							</div>
						</div>
						<label>Ingresos</label><label id="totIng"></label>
						<div id="myProgress">
							<div id="myBar">
								<div id="label">0%</div>
							</div>
						</div>
						<br>
						<label>Egresos</label><label id="totEgr"></label>
						<div id="myProgress2">
							<div id="myBar2">
								<div id="label2">0%</div>
							</div>
						</div>
					</div>
					<div class="panel-footer clearfix">
					</div>
				</div>
			</div>
			<div class="col-lg-6">
				<div class="panel panel-lila">
					<div class="panel-heading">
						<h3 class="panel-title"> VENTAS POR EMPLEADOS</h3>
					</div>
					<div class="panel-body">
						<div class="list-group">
							<div class="row">
								<div style="display:none;" class="col-lg-3 col-md-4 col-sm-12">
									<div class="radio">
										<label><input type="radio" id="opcion_ventas_empleados" name="opcion_ventas_empleados" value="1">DIARIAS</label>
									</div>
									<div class="radio">
										<label><input type="radio" id="opcion_ventas_empleados" name="opcion_ventas_empleados" value="2" checked>MENSUALES</label>
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-3 col-md-4 col-sm-6 col-xs-6 ">
							<div class="input-group">
								<label for="Sucursal">Sucursal</label>
								<select class="form-control Select2" id="Sucursal_empleados" name="Sucursal_empleados" tabindex="7">
									<?php
									$Sucursales = Sucursal::all();
									foreach ($Sucursales as $Sucursal) {
									?>
										<option value="<?php echo $Sucursal->SucursalID; ?>">
											<?php
											echo $Sucursal->Sucursal;
											?>
										</option>
									<?php
									}
									?>
								</select>

							</div>
						</div>

						<div class="col-lg-3 col-md-4 col-sm-6 col-xs-6 ">

							<label for="fechaInicioEmp">Fecha Inicial</label>
							<input type="date" id="fechaInicioEmp" name="fechaInicioEmp" class="form-control" required>
							<br>

						</div>
						<div class="col-lg-3 col-md-4 col-sm-6 col-xs-6 ">

							<label for="fechaFinEmp">Fecha Final</label>
							<input type="date" id="fechaFinEmp" name="fechaFinEmp" class="form-control" required>
						</div>

					</div>
					<div class="panel-footer clearfix">
						<button id="btnGenerarReporteEmplados" class="btn btn-lila pull-right"><i class="fa fa-line-chart" aria-hidden="true"></i> Ver Gráfico</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Contenido Principal -->
<!--      Ventana Modal    -->
<div class="modal fade" id="modalGraficos" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header modal-header-primary">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="tituloModal">Reportes Gráficos</h4>
			</div>
			<div class="modal-body">
				<div class="container-fluid">
					<div class="row">
						<div class="col-lg-12">
							<div style="width: 100%; padding-left: -5px;">
								<div class="table-responsive">
									<div id="container1" style="min-width: 510px; height: 500px; max-width: 600px; margin: 0 auto">
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!--      Ventana Modal    -->
<?php
include("vistas/includes/menuInferior.php");
?>