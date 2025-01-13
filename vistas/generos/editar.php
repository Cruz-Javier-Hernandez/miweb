<?php
include("vistas/includes/menuSupLimpio.php");
?>
<!-- Contenido Principal -->
<div id="page-wrapper">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-2 col-md-4 col-sm-6 col-xs-12">
				<a class="btn btn-primary pull-left " href="<?php echo url("admin"); ?>"><i class="fa fa-home" aria-hidden="true" placeholder="Home"> </i></a>
				<a class="btn btn-info pull-left " href="<?php echo url("generos"); ?>"><i class="fa fa-list" aria-hidden="true" placeholder="lista"> </i></a>
				<a class="btn btn-danger pull-left " href="<?php echo htmlspecialchars($_SERVER['HTTP_REFERER']); ?>"><i class="fa fa-reply" aria-hidden="true"></i></a>
				<a class="btn btn-success pull-left " href="<?php url("generos/crear"); ?>"><i class="fa fa-plus" aria-hidden="true"></i></a>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-azulTienda">
					<div class="panel-heading">
						<h3 class="panel-title">Editar Género</h3>
					</div>
					<form action="<?php url("generos/editargenero") ?>" method="POST" role="form">
						<div class="alert alert-info bd-info  mb-0" style="margin: 0px;"><strong>Aviso: </strong>Los Campos que contengan (<strong style="color: red;">*</strong>) son requeridos. </div>

						<div class="panel-body">
							<input type="hidden" value="<?php echo $genero->id ?>" name="id">
							<div class="form-group">
								<label for="">Descripción</label>
								<input value="<?php echo $genero->descripcion ?>" name="txtDescripcion" type="text" pattern="[A-Z a-zñÑáéíóúÁÉÍÓÚ0-9_.,-]{1,30}" class="form-control" id="" placeholder="" tabindex="1" required autofocus>

							</div>
						</div>
						<div class="panel-footer clearfix">
							<a class="btn btn-danger pull-left" href="<?php $phpSelf = filter_input(INPUT_SERVER, 'HTTP_REFERER', FILTER_SANITIZE_URL);
																		echo $phpSelf; ?>"><i class="fa fa-ban" aria-hidden="true"></i> Cancelar</a>
							<button name="botonSubmit" class="btn btn-success pull-right" type="submit" tabindex="8"><i class="fa fa-floppy-o" aria-hidden="true"></i> Guardar</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Contenido Principal -->
<?php
include("vistas/includes/menuInferior.php");
?>