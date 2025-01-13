<?php
//comprobamos si tiene privilegios de admin para ver la pag - funciona OK
if ($_SESSION["privilegio"] != "admin" || $_SESSION["user"] != "admin") {
	redireccionar("/admin/error");
}
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
				<a class="btn btn-success pull-left " href="<?php url("usuarios/crear"); ?>"><i class="fa fa-plus" aria-hidden="true"></i></a>
			</div>
		</div>
		<div class="row">

			<div class="col-lg-12">
				<form role="form" action="<?php url("usuarios/editarusuario") ?>" method="POST" >
					<div class="panel panel-azulTienda">
						<div class="panel-heading">Editar Usuario</div>
						<div class="panel-body">
							<div class="col-lg-2 col-md-4 col-sm-6 col-xs-12">
								<input type="hidden" value="<?php echo $usuario->id ?>" name="id" id="id">
								<input type="hidden" id="correosEliminados" name="correosEliminados" value="">
								<label for="">Cuenta de Usuario</label>
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-user fa-fw"></i></span>
									<strong>
										<input class="form-control" placeholder="" value="<?php echo $usuario->user; ?>" name="txtUser" id="txtUser" type="text" tabindex="1" required autofocus>
									</strong>
								</div>
							</div>
							<div class="col-lg-2 col-md-4 col-sm-6 col-xs-12">
								<label for="">Nombre y Apellido</label>
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-user fa-fw"></i></span>
									<strong><input class="form-control" placeholder="Nombre y Apellido" name="txtNomyApe" id="txtNomyApe" type="text" value="<?php echo $usuario->nomyape ?>" required autocomplete="on" tabindex="2"></strong>
								</div>
							</div>
							<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
								<label for="">Dirección</label>
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-home fa-fw"></i></span>
									<strong><input class="form-control" placeholder="Dirección" value="<?php echo $usuario->direccion; ?>" name="txtDireccion" id="txtDireccion" type="text" required autocomplete="on" tabindex="3"></strong>
								</div>
							</div>
							<div class="col-lg-2 col-md-4 col-sm-6 col-xs-12">
								<label for="">Teléfono</label>
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-phone fa-fw"></i></span><strong><input class="form-control" placeholder="Teléfono" value="<?php echo $usuario->telefono; ?>" name="txtTelefono" id="txtTelefono" type="text" required autocomplete="on" tabindex="4"></strong>
								</div>
							</div>
							<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
								<!-- Correo Principal -->
								<label for="correoPrincipal">E-mail Principal</label>
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-envelope fa-fw"></i></span>
									<input class="form-control" placeholder="E-mail Principal" value="<?php echo $usuario->email; ?>" name="correoPrincipal" type="email" required autocomplete="on">
								</div>
							</div>
							<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">

								<!-- Correos Adicionales -->
								<label for="txtEmail[]">E-mails Adicionales</label>
								<a href="javascript:void(0);" id="btnAgregarCorreo" class="fa fa-plus-circle boton-rebote" aria-hidden="true" onclick="agregarInputCorreo()"></a>

								<div id="contenedor-correos">
									<?php foreach ($correos as $correo): ?>
										<div class="input-group mt-2" data-id="<?php echo $correo->id; ?>">
											<span class="input-group-addon"><i class="fa fa-envelope fa-fw"></i></span>
											<input class="form-control" placeholder="E-mail Adicional" value="<?php echo $correo->email; ?>" name="txtEmail[]" type="email" autocomplete="on">
											<span class="input-group-btn">
												<button class="btn btn-danger" type="button" onclick="eliminarInput(this)">X</button>
											</span>
										</div>
									<?php endforeach; ?>
								</div>
							</div>
							<div class="col-lg-2 col-md-4 col-sm-6 col-xs-12">
								<label for="">Permisos</label>
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-briefcase fa-fw"></i> Rol: </span>
									<strong>
										<select id="txtPrivilegio" name="txtPrivilegio" class="selectpicker form-control" tabindex="6">
											<option value="admin" <?php if ($usuario->privilegio == "admin") echo ' selected="selected"'; ?>>Administrador</option>
											<option value="normal" <?php if ($usuario->privilegio == "normal") echo ' selected="selected"'; ?>>Normal</option>
										</select>
									</strong>
								</div>
							</div>
							<div class="col-lg-2 col-md-4 col-sm-6 col-xs-12">
								<label for="">¿Cambiar contraseña?</label><br>
								<label>
									<input type="radio" name="opcion" id="si" value="si"> Sí
								</label>
								<label>
									<input type="radio" name="opcion" id="no" value="no" checked> No
								</label>
							</div>
							<div id="input-container" style="display: none;">
								<div class="col-lg-2 col-md-4 col-sm-6 col-xs-12">
									<label for="">Nueva Contraseña</label>
									<div class="input-group">
										<span class="input-group-addon"><i class="fa fa-key fa-fw"></i></span>
										<input class="form-control" placeholder="Ingrese Nueva Contraseña" name="password" id="password" type="password" tabindex="7">
									</div>
								</div>
								<div class="col-lg-2 col-md-4 col-sm-6 col-xs-12">
									<label for="">Confimacion de Contraseña</label>
									<div class="input-group">
										<span class="input-group-addon"><i class="fa fa-key fa-fw"></i></span>
										<input class="form-control" placeholder="Confirme la Contraseña" name="confirmaPassword" id="confirmaPassword" type="password" tabindex="8">
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="panel-footer clearfix">
						<a class="btn btn-danger pull-left" href="<?php echo htmlspecialchars($_SERVER['HTTP_REFERER']); ?>"><i class="fa fa-ban" aria-hidden="true"></i> Cancelar</a>
						<button type="submit" class="btn btn-success pull-right" tabindex="7"><i class="fa fa-floppy-o" aria-hidden="true"></i> Guardar</button>
					</div>
				</form>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-lg-12 text-center">
			<button class="btn btn-naranja" id="btnResetPass" name="btnResetPass">Resetear Password</button>
		</div>
	</div>

</div>
<script>
	const form 				= document.querySelector("form"); // Selecciona el formulario
    const radioSi 			= document.getElementById("si");
    const radioNo 			= document.getElementById("no");
    const inputContainer 	= document.getElementById("input-container");

    // Mostrar/Ocultar los campos de contraseña según la opción seleccionada
    radioSi.addEventListener("change", () => {
        if (radioSi.checked) {
            inputContainer.style.display = "block";
        }
    });

    radioNo.addEventListener("change", () => {
        if (radioNo.checked) {
            inputContainer.style.display = "none";
        }
    });

    // Interceptar el envío del formulario
    form.addEventListener("submit", (event) => {
        const password 			= document.getElementById("password").value;
        const confirmPassword 	= document.getElementById("confirmaPassword").value;

        if (radioSi.checked) {
            // Verificar contraseñas solo si se seleccionó "Sí"
            if (!password || !confirmPassword) {
                event.preventDefault(); // Prevenir el envío
                alertify.error("Ambos campos de contraseña son obligatorios.");
                document.getElementById("password").focus();
                return;
            }

            if (password !== confirmPassword) {
                event.preventDefault(); // Prevenir el envío
                alertify.error("Las contraseñas no coinciden.");
                document.getElementById("password").focus();
                return;
            }
        }

        // Mostrar mensaje de éxito y continuar con el envío
        // alertify.alert("Modificación de Datos", "¡Operación Exitosa!", () => {
        //     form.submit(); // Enviar el formulario
        // });
		form.submit();
    });

	function agregarInputCorreo() {
		const nuevoCorreo = document.createElement('div');
		nuevoCorreo.classList.add('input-group', 'mt-2');

		nuevoCorreo.innerHTML = `
        <span class="input-group-addon"><i class="fa fa-envelope fa-fw"></i></span>
        <input class="form-control" placeholder="E-mail" name="txtEmail[]" type="email" required autocomplete="on">
        <span class="input-group-btn">
            <button class="btn btn-danger" type="button" onclick="eliminarInput(this)">X</button>
        </span>
    `;

		document.getElementById('contenedor-correos').appendChild(nuevoCorreo);
	}

	function eliminarInput(element) {
		const correoDiv = element.parentNode.parentNode;
		const correoID = correoDiv.getAttribute('data-id');

		// Solo añadir al campo hidden si el correo tiene un ID (es decir, viene de la base de datos)
		if (correoID) {
			const campoCorreosEliminados = document.getElementById('correosEliminados');
			campoCorreosEliminados.value += (campoCorreosEliminados.value ? ',' : '') + correoID;
		}

		correoDiv.remove(); // Eliminar el contenedor completo del input
	}
</script>
<!-- Contenido Principal -->
<?php
include("vistas/includes/menuInferior.php");
?>