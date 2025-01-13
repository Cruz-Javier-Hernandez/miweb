<?php

use App\modelo\Talle;
use \App\modelo\Rubro;
use \App\modelo\Genero;
use \App\modelo\Categoria;

include("vistas/includes/menuSupLimpio.php");
?>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<!-- Contenido Principal -->
<div id="page-wrapper">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-2 col-md-4 col-sm-6 col-xs-12">
				<a class="btn btn-primary pull-left " href="<?php echo url("admin"); ?>"><i class="fa fa-home" aria-hidden="true" placeholder="Home"> </i></a>
				<a class="btn btn-info pull-left " href="<?php echo url("talles"); ?>"><i class="fa fa-list" aria-hidden="true" placeholder="lista"> </i></a>
				<a class="btn btn-danger pull-left " href="<?php echo htmlspecialchars($_SERVER['HTTP_REFERER']); ?>"><i class="fa fa-reply" aria-hidden="true"></i></a>
				<a class="btn btn-success pull-left " href="<?php url("talles/crear"); ?>"><i class="fa fa-plus" aria-hidden="true"></i></a>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-azulTienda">
					<div class="panel-heading">
						<h3 class="panel-title">Editar Talle</h3>
					</div>
					<form action="<?php url("talles/editartalle") ?>" method="POST" role="form">
						<div class="alert alert-info bd-info  mb-0" style="margin: 0px;"><strong>Aviso: </strong>Los Campos que contengan (<strong style="color: red;">*</strong>) son requeridos. </div>

						<div class="panel-body">
							<input type="hidden" value="<?php echo $talle->id ?>" name="id">
							<div class="row">
								<div class="col-lg-2 col-md-4 col-sm-6 col-xs-12">
									<label for="">Rubro</label>
									<div class="input-group">
										<span class="input-group-addon"><i class="fa fa-check-circle fa-fw"></i></span>
										<select name="txtRubro" id="txtRubro" class="form-control" tabindex="1" autofocus>
											<?php
											$rubros = Rubro::all();
											foreach ($rubros as $rubro) {
											?>
												<option value="<?php echo $rubro->id; ?>">
													<?php
													echo $rubro->descripcion;
													?>
												</option>
											<?php
											}
											?>
										</select>
										<input name="txtIdRubro" id="txtIdRubro" value="<?php echo $talle->idRubro; ?>" type="hidden">
									</div>
								</div>
								<div class="col-lg-2 col-md-4 col-sm-6 col-xs-12">
									<label for="">Género</label>
									<div class="input-group">
										<span class="input-group-addon"><i class="fa fa-check-circle fa-fw"></i></span>
										<select name="txtGenero" id="txtGenero" class="form-control" tabindex="2">
											<?php
											$generos = Genero::all();
											foreach ($generos as $genero) {
											?>
												<option value="<?php echo $genero->id; ?>">
													<?php
													echo $genero->descripcion;
													?>
												</option>
											<?php
											}
											?>
										</select>
										<input name="txtIdGenero" id="txtIdGenero" value="<?php echo $talle->idGenero; ?>" type="hidden">
									</div>
								</div>

								<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
									<label for="">Categoría</label>
									<div class="input-group">
										<span class="input-group-addon"><i class="fa fa-check-circle fa-fw"></i></span>
										<select name="txtCategoria" id="txtCategoria" class="form-control Select2" tabindex="3">
											<?php
											$categorias = Categoria::all();
											foreach ($categorias as $categoria) {
											?>
												<option value="<?php echo $categoria->id; ?>">
													<?php
													echo $categoria->descripcion;
													?>
												</option>
											<?php
											}
											?>
										</select>
										<input name="txtIdCategoria" id="txtIdCategoria" value="<?php echo $talle->idCategoria; ?>" type="hidden">
									</div>
								</div>
								<div class="col-lg-2 col-md-4 col-sm-6 col-xs-12">
									<label for="">Descripción <strong style="color: red;">*</strong></label>
									<input name="txtDescripcion" type="text" class="form-control" id="txtDescripcion" value="<?php echo $talle->descripcion ?>" tabindex="4" required>
								</div>
							</div>

						</div>
						<div class="panel-footer clearfix">
							<a class="btn btn-danger pull-left" href="<?php echo htmlspecialchars($_SERVER['HTTP_REFERER']); ?>"><i class="fa fa-ban" aria-hidden="true"></i> Cancelar</a>
							<button type="submit" class="btn btn-success pull-right" tabindex="5"><i class="fa fa-floppy-o" aria-hidden="true"></i> Guardar</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Contenido Principal -->
<script type="text/javascript">
	$(document).ready(function() {


		$('#txtRubro > option[value="<?php echo $talle->idRubro; ?>"]').attr('selected', 'selected');
		$('#txtGenero > option[value="<?php echo $talle->idGenero; ?>"]').attr('selected', 'selected');
		$('#txtCategoria > option[value="<?php echo $talle->idCategoria; ?>"]').attr('selected', 'selected');

		$('#txtIdRubro').val(<?php echo $talle->idRubro; ?>);
		$('#txtIdGenero').val(<?php echo $talle->idGenero; ?>);
		$('#txtIdCategoria').val(<?php echo $talle->idCategoria; ?>);

		$('select#txtRubro').on('change', function() {
			idRubro = $(this).val();
			$('#txtIdRubro').val(idRubro);
		});
		$('select#txtGenero').on('change', function() {
			idGenero = $(this).val();
			$('#txtIdGenero').val(idGenero);
		});
		$('select#txtCategoria').on('change', function() {
			idCategoria = $(this).val();
			$('#txtIdCategoria').val(idCategoria);
		});
		$('.Select2').select2();
	});
</script>
<?php
include("vistas/includes/menuInferior.php");
?>