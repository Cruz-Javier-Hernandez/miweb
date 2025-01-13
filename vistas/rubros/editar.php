<?php
if ($_SESSION["privilegio"] != "admin") {
	redireccionar("/admin/error");
}
include("vistas/includes/menuSupLimpio.php");
?>
<!-- Contenido Principal -->
<div id="page-wrapper">
	<div class="container-fluid">
		
		<div class="row">
			<div class="col-lg-2 col-md-4 col-sm-6 col-xs-12">
				<a class="btn btn-primary pull-left " href="<?php echo url("admin"); ?>"><i class="fa fa-home" aria-hidden="true" placeholder="Home"> </i></a>
				<a class="btn btn-info pull-left " href="<?php echo url("rubros"); ?>"><i class="fa fa-list" aria-hidden="true" placeholder="lista"> </i></a>
				<a class="btn btn-danger pull-left " href="<?php echo htmlspecialchars($_SERVER['HTTP_REFERER']); ?>"><i class="fa fa-reply" aria-hidden="true"></i></a>
				<a class="btn btn-success pull-left " href="<?php url("rubros/crear"); ?>"><i class="fa fa-plus" aria-hidden="true"></i></a>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-azulTienda">
					<div class="panel-heading">
						<h3 class="panel-title">Editar Rubro</h3>
					</div>
					<form action="<?php url("rubros/editarrubro") ?>" method="POST" role="form">
						<div class="alert alert-info bd-info  mb-0" style="margin: 0px;"><strong>Aviso: </strong>Los Campos que contengan (<strong style="color: red;">*</strong>) son requeridos. </div>

						<div class="panel-body">
							<input type="hidden" value="<?php echo $rubro->id ?>" name="id">
							<div class="form-group">
								<label for="">Descripción</label>
								<input value="<?php echo $rubro->descripcion ?>" name="txtDescripcion" type="text" class="form-control" id="" placeholder="" tabindex="1" required autofocus>
							</div>
						</div>
						<div class="panel-footer clearfix">
							<a class="btn btn-danger pull-left" href="<?php echo htmlspecialchars($_SERVER['HTTP_REFERER']); ?>"><i class="fa fa-ban" aria-hidden="true"></i> Cancelar</a>
							<button type="submit" class="btn btn-success pull-right" tabindex="8"><i class="fa fa-floppy-o" aria-hidden="true"></i> Guardar</button>
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