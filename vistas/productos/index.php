<?php
include("vistas/includes/menuSupDataTable.php");
?>
<style>
	#tablaProductosInactivo td:nth-child(1),
	#tablaProductosInactivo th:nth-child(1),
	#tablaProductosActivo td:nth-child(1),
	#tablaProductosActivo th:nth-child(1) {
		display: none;
	}


	.contenedor {
		/* width: 98%;
		max-width: 120em;
		padding: 1em; */
	}

	.contenedor .ul {
		width: 100%;
		display: flex;
		flex-flow: row nowrap;
		justify-content: flex-start;
		align-items: center;
		list-style: none;
		padding: 0%;
	}

	.contenedor .li {
		background-color: #2c3e50;
		padding: 2%;
		/*margin: 0 1em 0 0;*/
		transition: all .5s ease;
		border-top-left-radius: 10%;
		/* Bordes superiores redondeados */
		border-top-right-radius: 10%;
		transform: skew(-15deg);
		color: white;
	}

	.contenedor .li.activo {
		background-color: #44b6ae;
		color: white;
	}

	.contenedor .subcontenedor {
		display: grid;
		min-height: 10vh;


	}

	.contenedor .bloque {

		/* Asegura que todos los bloques estén en la misma posición */
		visibility: hidden;
		/* Oculta todos los bloques por defecto */
		opacity: 0;
		transition: all .5s ease;


	}

	.contenedor .bloque.activo {
		grid-area: 1 / 1 / 2 / 2;
		visibility: visible;
		/* Solo el bloque activo es visible */
		opacity: 1;


	}
</style>
<!-- Contenido Principal -->
<div id="page-wrapper">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12">
				<h2 class="hstyle ">GESTION DE PRODUCTOS</h2>
				<a class="btn btn-primary pull-left " href="<?php echo url("admin"); ?>"><i class="fa fa-home" aria-hidden="true" placeholder="Home"> </i></a>
				<a href="<?php url("productos/crear") ?>" id="btnNuevoProd" class="btn btn-success"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> PRODUCTOS</a>
			</div>
		</div>
		<br>
		<div class="contenedor">
			<ul class="ul">
				<li class="li activo ">PRODUCTOS ACTIVOS</li>
				<li class="li">PRODUCTOS INACTIVOS</li>
			</ul>
			<div class="subcontenedor ml-3">
				<div class="bloque activo ">
					<div class="row">
						<div class="col-lg-12">
							<div class="table-responsive">
								<table id="tablaProductosActivo" class="table-condensed table-hover table-bordered" cellspacing="0" width="100%">
									<thead>
										<tr>
											<th>Id</th>
											<th>Código</th>
											<th>Nombre</th>
											<th>Precio</th>
											<!-- <th>Precio Minimo</th>	 -->
											<th>Cantidad</th>
											<th>Marca</th>
											<th>Fecha/Registro</th>
											<th class='col-lg-2 col-md-4 col-sm-12 col-xs-12'>Imagen</th>
											<th>Acción</th>
										</tr>
									</thead>
								</table>
							</div>
						</div>
					</div>
				</div>
				<div class="bloque ">
					<div class="row">
						<div class="col-lg-12">
							<div class="table-responsive">
								<table id="tablaProductosInactivo" class="table-condensed table-hover table-bordered" cellspacing="0" width="100%">
									<thead>
										<tr>
											<th>Id</th>
											<th>Código</th>
											<th>Nombre</th>
											<th>Precio</th>
											<!-- <th>Precio Minimo</th>	 -->
											<th>Cantidad</th>
											<th>Marca</th>
											<th>Fecha de Registro</th>
											<th class='col-lg-2 col-md-4 col-sm-12 col-xs-12'>Imagen</th>
											<th>Acción</th>
										</tr>
									</thead>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>


	</div>
</div>
<!-- Contenido Principal -->
<script>
	const li = document.querySelectorAll('.li');
	const bloque = document.querySelectorAll('.bloque');

	li.forEach((cadaLi, i) => {
		li[i].addEventListener('click', () => {
			li.forEach((cadaLi, i) => {

				li[i].classList.remove('activo')
				bloque[i].classList.remove('activo')
			});
			li[i].classList.add('activo');
			bloque[i].classList.add('activo');
		});

	});
	//tabla PRODUCTOS
	//Control de stock con JQuery
	$('#tablaProductosActivo').DataTable({
		"lengthChange": true,
		"deferRender": true,
		"bProcessing": true,
		"bServerSide": true,
		"lengthMenu": [
			[10, 25, 50, -1],
			[10, 25, 50, "All"]
		],
		"pageLength": 10,
		dom: 'Bfrtilp',
		"sAjaxSource": "libreria/ServerSide/serversideControlStock.php",
		"columnDefs": [{
			"targets": -1,
			"data": null,
			"defaultContent": "<div class='btn-group'><button class='btn btn-primary btnEditar' data-toggle='tooltip' title='Editar'><i class='fa fa-pencil-square-o' aria-hidden='true'></i></button><button class='btn btn-danger btnEliminar' data-toggle='tooltip' title='Eliminar'><i class='fa fa-trash-o' aria-hidden='true'></i></button></div>"
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
			"sSearch": "Buscar:",
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
		//extension para BUTTONS		
		buttons: [{
				extend: 'excelHtml5',
				text: '<i class="fa fa-file-excel-o fa-lg"></i> ',
				titleAttr: 'Exportar a Excel',
				className: 'btn btn-default'
			},
			{
				extend: 'pdfHtml5',
				text: '<i class="fa fa-file-pdf-o fa-lg"></i> ',
				titleAttr: 'Exportar a PDF',
				className: 'btn btn-default'
			},
			{
				extend: 'print',
				text: '<i class="fa fa-print fa-lg"></i> ',
				titleAttr: 'Imprimir',
				className: 'btn btn-default'
			},
		]
	});
	//Control de stock con JQuery
	$('#tablaProductosInactivo').DataTable({
		"lengthChange": true,
		"deferRender": true,
		"bProcessing": true,
		"bServerSide": true,
		"lengthMenu": [
			[10, 25, 50, -1],
			[10, 25, 50, "All"]
		],
		"pageLength": 10,
		dom: 'Bfrtilp',
		"sAjaxSource": "libreria/ServerSide/serversideControlStockInactivo.php",
		"columnDefs": [{
			"targets": -1,
			"data": null,
			"defaultContent": "<div class='btn-group'><button class='btn btn-primary btnEditar' data-toggle='tooltip' title='Editar'><i class='fa fa-pencil-square-o' aria-hidden='true'></i></button><button class='btn btn-danger btnEliminar' data-toggle='tooltip' title='Eliminar'><i class='fa fa-trash-o' aria-hidden='true'></i></button></div>"
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
			"sSearch": "Buscar:",
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
		//extension para BUTTONS		
		buttons: [{
				extend: 'excelHtml5',
				text: '<i class="fa fa-file-excel-o fa-lg"></i> ',
				titleAttr: 'Exportar a Excel',
				className: 'btn btn-default'
			},
			{
				extend: 'pdfHtml5',
				text: '<i class="fa fa-file-pdf-o fa-lg"></i> ',
				titleAttr: 'Exportar a PDF',
				className: 'btn btn-default'
			},
			{
				extend: 'print',
				text: '<i class="fa fa-print fa-lg"></i> ',
				titleAttr: 'Imprimir',
				className: 'btn btn-default'
			},
		]
	});
	$(document).on("click", ".btnEditar", function() {
		var id = parseInt($(this).closest('tr').find('td:eq(0)').text()); //capturo la cantidad

		window.location.href = "productos/editar?id=" + id;
	});
	$(document).on("click", ".btnEliminar", function() {
		var id = parseInt($(this).closest('tr').find('td:eq(0)').text()); //capturo la cantidad		
		alertify.confirm('Eliminar Registro', '¿Está seguro de eliminar el registro?',
			function() {
				window.location.href = window.location.href = "productos/eliminar?id=" + id;
			},
			function() {
				alertify.error('Cancelado')
			});
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
if ($_SESSION["temp_elimina"] == "false") {
	echo "<script>     
                    alertify.error('No se pudo eliminar!').delay(2);
              </script>";
	$_SESSION["temp_elimina"] = "true";
}
?>