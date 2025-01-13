<?php

use \App\modelo\Parametro;
use \App\modelo\Proveedor;
use \App\modelo\Sucursal;

$parametro = Parametro::find("1");
include("vistas/includes/menuSupABM.php");
?>
<!-- Contenido Principal -->
<div id="page-wrapper">
	<div class="container-fluid">
		<hr>
		<div class="row">
			<div class="col-lg-2 col-md-4 col-sm-6 col-xs-12">
				<a class="btn btn-danger pull-left " href="<?php echo htmlspecialchars($_SERVER['HTTP_REFERER']); ?>"><i class="fa fa-reply" aria-hidden="true"></i></a>
				<!-- 				<a class="btn btn-info pull-left " href="<?php url("facturas/crear"); ?>"><i class="fa fa-plus" aria-hidden="true"></i></a>
 -->
			</div>
		</div>
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-azulTienda">
					<div class="panel-heading">
						<h3 class="panel-title">Nueva Factura</h3>
					</div>
					<form action="<?php url("facturas/crearFacturas") ?>" method="POST" role="form" enctype="multipart/form-data">
						<div class="alert alert-info bd-info  mb-0" style="margin: 0px;"><strong>Aviso: </strong>Los Campos que contengan (<strong style="color: red;">*</strong>) son requeridos. </div>

						<div class="panel-body">
							<div class="row">
								<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
									<label for="nuemro">Numero de factura</label>
									<div class="input-group">
										<span class="input-group-addon"><i class="fa fa-file"></i></span>
										<input name="txtNfacturas" id="txtNfacturas" type="text" class="form-control" placeholder="N°Factura1" >
									</div>
								</div>
								<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
									<label for="Provedor">Provedor</label>
									<div class="input-group">
										<span class="input-group-addon"><i class="fa fa-users"></i></span>
										<select name="txtIdprovedor" id="txtIdprovedor" class="form-control" tabindex="1" autofocus>
											<?php
											$prove = Proveedor::all();
											foreach ($prove as $provedor) {
											?>
												<option value="<?php echo $provedor->id; ?>">
													<?php
													echo $provedor->razon_social;
													?>
												</option>
											<?php
											}
											?>
										</select>
									</div>
								</div>
								<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
									<label for="Sucursal">Sucursal</label>
									<div class="input-group">
										<span class="input-group-addon"><i class="fa fa-industry"></i></span>
										<select name="txtIdSucursal" id="txtIdSucursal" class="form-control" tabindex="2">
											<?php
											$sucursal = Sucursal::all();
											foreach ($sucursal as $sucur) {
											?>
												<option value="<?php echo $sucur->SucursalID; ?>">
													<?php
													echo $sucur->Sucursal;
													?>
												</option>
											<?php
											}
											?>
										</select>
									</div>
								</div>
								<div class="col-lg-2 col-md-4 col-sm-6 col-xs-12">
									<label for="pago">Total a Pagar</label>
									<div class="input-group">
										<span class="input-group-addon"><i class="fa fa-usd"></i></span>
										<input name="txtpago" id="txtpago" type="text" class="form-control" placeholder="Pago" tabindex="1" autofocus required  oninput="validarDecimal(this)">
									</div>
								</div>
								<?php
								//para mostrar fecha actual
								$timezone = "America/El_Salvador";
								date_default_timezone_set($timezone);
								$hoy = date("Y-m-d");
								?>
								<div class="col-lg-3 col-md-4 col-sm-6 col-xs-5">
									<div class="input-group">
										<label for="">Fecha de inicio</label>
										<input class="form-control" name="txtFechainicio" type="date" id="txtFechainicio" value="<?php echo $hoy; ?>">
									</div>
								</div>
								<div class="col-lg-3 col-md-4 col-sm-6 col-xs-5">
									<div class="input-group">
										<label for="">Fecha de Corte</label>
										<input class="form-control" name="txtFecha" type="date" id="txtFecha" value="<?php echo $hoy; ?>">
									</div>
								</div>
								<div class="col-lg-3" method="POST" autocomplete="off">

									<label>Foto o imagen del Factura</label><br>
									<div class="file is-small has-name">
										<label class="file-label">
											<input class="file-input" type="file" name="factura_foto" id="factura_foto" accept=".jpg, .png, .jpeg">
											<span class="file-cta">
												<span class="file-label">Imagen</span>
											</span>
											<span class="file-name">JPG, JPEG, PNG. (MAX 3MB)</span>
										</label>
									</div>
								</div>
							</div>

						</div>

						<div class="panel-footer clearfix">
							<a class="btn btn-danger pull-left text-white" style="color: white;" href="<?php echo htmlspecialchars($_SERVER['HTTP_REFERER']); ?>"><i class="fa fa-ban" aria-hidden="true"></i> Cancelar</a>
							<button type="submit" class="btn btn-info pull-right" tabindex="7"><i class="fa fa-floppy-o" aria-hidden="true"></i> Guardar</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Contenido Principal -->
<script>
	$('form').submit(function() {


		/* 	if (var_cuit == 0 || var_cuit == "") {
				alertify.warning("El CUIT no puede ser 0.");
				return false;
			} */
		/* 	if (var_telefono == 0 || var_telefono == "") {
				alertify.warning("El teléfono no puede ser 0.");
				return false;
			} */


	});
	function validarDecimal(input) {
		// Se permite una coma o un punto seguido de uno o más dígitos
		var regex = /^\d*\.?\d*$/;
		if (!regex.test(input.value)) {
			// Si la entrada no es un número decimal válido, se limpia el valor del campo
			input.value = input.value.replace(/[^\d\.]/g, '');
		}
	}
</script>
<?php
include("vistas/includes/menuInferior.php");
?>