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
				<a class="btn btn-primary pull-left " href="<?php echo url("admin"); ?>"><i class="fa fa-home" aria-hidden="true" placeholder="Home"> </i></a>
				<a class="btn btn-info pull-left " href="<?php echo url("empleados"); ?>"><i class="fa fa-list" aria-hidden="true" placeholder="lista"> </i></a>
				<a class="btn btn-danger pull-left " href="<?php echo htmlspecialchars($_SERVER['HTTP_REFERER']); ?>"><i class="fa fa-reply" aria-hidden="true"></i></a>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-azulTienda">
					<div class="panel-heading">
						<h3 class="panel-title">Nuevo Empleado</h3>
					</div>
					<form action="<?php url("empleados/crearEmpleados") ?>" method="POST" role="form" enctype="multipart/form-data">
						<div class="alert alert-info bd-info  mb-0" style="margin: 0px;"><strong>Aviso: </strong>Los Campos que contengan (<strong style="color: red;">*</strong>) son requeridos. </div>

						<div class="panel-body">
							<div class="row">
								<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
									<label for="nuemro">Nombre de el Empleado</label>
									<div class="input-group">
										<span class="input-group-addon"><i class="fa fa-user"></i></span>
										<input name="txtnombre" id="txtnombre" type="text" class="form-control" placeholder="Nombre de Empleado">
									</div>
								</div>
								<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
									<label for="Sucursal">Sucursal</label>
									<div class="input-group">
										<span class="input-group-addon"><i class="fa fa-industry"></i></span>
										<select name="txtIdSucursal" id="txtIdSucursal" class="form-control" tabindex="2">
											<?php
											$sucursal = Sucursal::where('Activo', 1);
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
								<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
									<label for="Cargo">Cargo</label>
									<div class="input-group">
										<span class="input-group-addon"><i class="fa fa-tasks"></i></span>
										<select name="txtcargo" id="txtcargo" class="form-control" tabindex="2">

											<option value="Bodegero">Bodegero</option>
											<option value="Vendedor">Vendedor</option>
											<option value="Gerente">Gerente</option>
											<option value="Informatica">Informatica</option>

										</select>
									</div>
								</div>
								<div class="col-lg-2 col-md-4 col-sm-6 col-xs-12">
									<label for="Telefono">Telefono</label>
									<div class="input-group">
										<span class="input-group-addon"><i class="fa fa-phone"></i></span>
										<input name="txttelefono" id="txttelefono" type="text" class="form-control" placeholder="Telefono" tabindex="1">
									</div>
								</div>

								<div class="col-lg-3" method="POST" autocomplete="off">

									<label>Foto o Imagen de Perfil</label><br>
									<div class="file is-small has-name">
										<label class="file-label">
											<input class="file-input" type="file" name="empleado_foto" id="empleado_foto" accept=".jpg, .png, .jpeg">
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
							<button type="submit" class="btn btn-success pull-right" tabindex="7"><i class="fa fa-floppy-o" aria-hidden="true"></i> Guardar</button>
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
</script>
<?php
include("vistas/includes/menuInferior.php");
?>