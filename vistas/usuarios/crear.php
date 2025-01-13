<?php
//comprobamos si tiene privilegios de admin para ver la pag
if ($_SESSION["privilegio"] != "admin") {
	redireccionar("/admin/error");
}

use \App\modelo\Usuario;

include("vistas/includes/menuSupABM.php");
?>
<!-- Contenido Principal -->
<div id="page-wrapper">
	<div class="container-fluid">
		<hr>
		<div class="row">
			<div class="col-lg-2 col-md-4 col-sm-6 col-xs-12">
				<a class="btn btn-primary pull-left " href="<?php echo url("admin"); ?>"><i class="fa fa-home" aria-hidden="true" placeholder="Home"> </i></a>
				<a class="btn btn-info pull-left " href="<?php echo url("usuarios"); ?>"><i class="fa fa-list" aria-hidden="true" placeholder="lista"> </i></a>
				<a class="btn btn-danger pull-left " href="<?php echo htmlspecialchars($_SERVER['HTTP_REFERER']); ?>"><i class="fa fa-reply" aria-hidden="true"></i></a>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-12">
				<form role="form" action="<?php url("usuarios/crearUsuario") ?>" method="post">
					<div class="alert alert-info bd-info  mb-0" style="margin: 0px;"><strong>Aviso: </strong>Los Campos que contengan (<strong style="color: red;">*</strong>) son requeridos. </div>

					<div class="panel panel-azulTienda">
						<div class="panel-heading">Nuevo Usuario</div>
						<div class="panel-body">
							<div class="col-lg-2 col-md-4 col-sm-6 col-xs-12">
								<br>
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-user fa-fw"></i></span>
									<input class="form-control" placeholder="Nombre y Apellido" name="txtNomyApe" id="txtNomyApe" type="text" required autocomplete="on" autofocus tabindex="1">
								</div>
							</div>
							<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
								<br>
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-home fa-fw"></i></span>
									<input class="form-control" placeholder="Dirección" name="txtDireccion" id="txtDireccion" type="text" required autocomplete="on" tabindex="2">
								</div>
							</div>
							<div class="col-lg-2 col-md-4 col-sm-6 col-xs-12">
								<br>
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-phone fa-fw"></i></span>
									<input class="form-control" placeholder="Teléfono" name="txtTelefono" id="txtTelefono" type="text" required autocomplete="on" tabindex="3">
								</div>
							</div>
							<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
								<br>
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-envelope fa-fw"></i></span>
									<input class="form-control" placeholder="E-mail" name="txtEmail" id="txtEmail" type="email" required autocomplete="on" tabindex="4">
								</div>
							</div>
							<div class="col-lg-2 col-md-4 col-sm-6 col-xs-12">
								<br>
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-briefcase fa-fw"></i> Rol: </span>
									<select id="txtPrivilegio" name="txtPrivilegio" class="selectpicker form-control" tabindex="5">
										<option value="admin">Administrador</option>
										<option value="normal">Vendedor</option>
									</select>
								</div>
							</div>
							<div class="col-lg-2 col-md-4 col-sm-6 col-xs-12">
								<br>
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-user fa-fw"></i></span>
									<input class="form-control" placeholder="Ingrese un Usuario" name="user" id="user" type="text" tabindex="6" required>
								</div>
							</div>
							<div class="col-lg-2 col-md-4 col-sm-6 col-xs-12">
								<br>
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-key fa-fw"></i></span><input class="form-control" placeholder="Ingrese una password" name="password" id="password" type="password" required tabindex="7">
								</div>
							</div>
							<div class="col-lg-2 col-md-4 col-sm-6 col-xs-12">
								<br>
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-key fa-fw"></i></span>
									<input class="form-control" placeholder="Confirme la password" name="confirmaPassword" id="confirmaPassword" type="password" required tabindex="8">
								</div>
							</div>

						</div>
						<input name="txtUser" id="txtUser" type="hidden">
						<input name="txtPassword" id="txtPassword" type="hidden">
						<button type="submit" id="btnRegistrarUsuario" name="btnRegistrarUsuario" style="display:none;"></button>
					</div>
				</form>
			</div>
			<div class="col-lg-12">
				<div class="panel-group">
					<div class="panel panel-azulTienda">
						<div class="panel-body">
							<div class="btn-group">
								<a class="btn btn-danger pull-left" href="<?php echo htmlspecialchars($_SERVER['HTTP_REFERER']); ?>"><i class="fa fa-ban" aria-hidden="true"></i> Cancelar</a>
							</div>
							<div class="btn-group pull-right">
								<div class="btn-group">
									<button id="btnControlaPass" class="btn btn-success" tabindex="9"><i class="fa fa-floppy-o" aria-hidden="true"></i> Guardar</button>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Contenido Principal -->
<?php
include("vistas/includes/menuInferior.php");
?>