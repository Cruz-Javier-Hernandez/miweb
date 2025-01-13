<?php

use \App\modelo\Cliente;
use \App\modelo\Detallepagoventa;
use \App\modelo\Formapago;
use \App\modelo\Parametro;

$parametro = Parametro::find(1); //para que me traiga los param de la moneda
include("vistas/includes/menuSupVentas.php");
?>

<style>

	#tabla_pendientes td:nth-child(1),
	#tabla_pendientes td:nth-child(2),
	#tabla_pendientes th:nth-child(1),
	#tabla_pendientes th:nth-child(2),
	#tabla_rechazadas td:nth-child(1),
	#tabla_rechazadas td:nth-child(2),
	#tabla_rechazadas th:nth-child(1),
	#tabla_rechazadas th:nth-child(2),
	#tabla_aprobados td:nth-child(1),
	#tabla_aprobados td:nth-child(2),
	#tabla_aprobados th:nth-child(1),
	#tabla_aprobados th:nth-child(2) {
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
		transform: translateY(50%);
		margin-top: 0%;
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
				<h3 class="hstyle">GESTION DE PEDIDOS</h3>
				<a class="btn btn-primary pull-left " href="<?php echo url("admin"); ?>"><i class="fa fa-home" aria-hidden="true" placeholder="Home"> </i></a>
				<a href="<?php url("pedidos/crear") ?>" id="btnNuevaVenta" class="btn btn-success"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> PEDIDO</a>
			</div>
		</div>
		<hr>
		<div class="contenedor">
			<ul class="ul">
				<li class="li activo ">PENDIENTES</li>
				<li class="li">APROVADOS</li>
				<li class="li">RECHAZADOS</li>
			</ul>
			<div class="subcontenedor ml-3">
				<div class="bloque activo ">
					<div class="col-lg-12 form-control">
						<div class="table-responsive">
							<table id="tabla_pendientes" class="table-striped table-bordered table-condensed" cellspacing="0" width="100%">
								<thead>
									<tr>
										<!-- Datos de la tabla VENTAS -->
										<th>id</th>
										<th>id</th>
										<th>Codigo</th>
										<th>Marcas </th>
										<th>Descripcion</th>
										<th>Fecha registro</th>
										<th>Imagen</th>
										<th class="text-center">Acción</th>
									</tr>
								</thead>
							</table>
						</div>
					</div>
				</div>
				<div class="bloque">
					<div class="col-lg-12 form-control">
						<div class="table-responsive">
							<table id="tabla_aprobados" class="table-striped table-bordered table-condensed" cellspacing="0" width="100%">
								<thead>
									<tr>
										<!-- Datos de la tabla VENTAS -->
										<th>id</th>
										<th>id</th>
										<th>Codigo</th>
										<th>Marcas </th>
										<th>Descripcion</th>
										<th>Fecha registro</th>
										<th>Imagen</th>
										<th class="text-center">Acción</th>
									</tr>
								</thead>
							</table>
						</div>
					</div>
				</div>
				<div class="bloque">
					<div class="col-lg-12 form-control">
						<div class="table-responsive">
							<table id="tabla_rechazadas" class="table-striped table-bordered table-condensed" cellspacing="0" width="100%">
								<thead>
									<tr>
										<!-- Datos de la tabla VENTAS -->
										<th>id</th>
										<th>id</th>
										<th>Codigo</th>
										<th>Marcas </th>
										<th>Descripcion</th>
										<th>Fecha registro</th>
										<th>Imagen</th>
										<th class="text-center">Acción</th>
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
<div class="modal fade" id="modal_tallesColores" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header modal-header-greensteel">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="">Stock actual</h4>
			</div>
			<div class="panel-body">
				<div class="form-group">
					<div class="row">
						<div class="col-lg-12">
							<div class="table-responsive">
								<table id="tablaTalleColor" class="table table-bordered table-condensed" cellspacing="0" width="100%">
									<thead>
										<th class="text-center">Talle / Color</th>

									</thead>
									<tbody>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>

			</div>
			<div class="modal-footer clearfix">
				<button type="button" class="btn btn-default pull-left" data-dismiss="modal" tabindex=""><i class="fa fa-ban" aria-hidden="true"></i> Salir</button>

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
	//tabla pendientes
	$('#tabla_pendientes').DataTable({
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
		"sAjaxSource": "libreria/ServerSide/serversidePedidos_pendientes.php",
		"columnDefs": [{
			"targets": -1,
			"data": null,
			"defaultContent": "<div class='wrapper text-center'><div class='btn-group'><a class='btnAprobar btn btn-green' data-toggle='tooltip' title='Aprobar'><i class='fa fa-check' aria-hidden='true'></i></a><button class='btn btn-danger btnAccion' data-toggle='tooltip' title='Eliminar'><i class='fa fa-times' aria-hidden='true'></i></button></div></div>"
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
	//tabla aprobados
	$('#tabla_aprobados').DataTable({
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
		"sAjaxSource": "libreria/ServerSide/serversidePedidos_aprobados.php",
		"columnDefs": [{
			"targets": -1,
			"data": null,
			"defaultContent": "<div class='wrapper text-center'><div class='btn-group'><button class='btn btn-danger btnEliminar' data-toggle='tooltip' title='Eliminar'><i class='fa fa-trash-o' aria-hidden='true'></i></button></div></div>"
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
	//tabla rechazadas
	$('#tabla_rechazadas').DataTable({
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
		"sAjaxSource": "libreria/ServerSide/serversidePedidos_rechazados.php",
		"columnDefs": [{
			"targets": -1,
			"data": null,
			"defaultContent": "<div class='wrapper text-center'><div class='btn-group'><button class='btn btn-danger btnEliminar' data-toggle='tooltip' title='Rechazar'><i class='fa fa-trash-o' aria-hidden='true'></i></button></div></div>"
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


	$(document).on("click", ".btnDetalle", function() {
		var id = parseInt($(this).closest('tr').find('td:eq(0)').text()); //capturo la cantidad
		window.location.href = "../ventas/detalle?id=" + id;
	});
	$(document).on("click", ".btnAccion", function() {
		var id = parseInt($(this).closest('tr').find('td:eq(0)').text()); //capturo la cantidad	
		alertify.confirm('rechazar Pedido', '¿Está seguro de rechazar el Pedido?',
			function() {
				window.location.href = window.location.href = "pedidos/rechazar?id=" + id
			},
			function() {
				alertify.error('Cancelado')
			});

	});
	$(document).on("click", ".btnEliminar", function() {
		var id = parseInt($(this).closest('tr').find('td:eq(1)').text()); //capturo la cantidad	
		alertify.confirm('Eliminar Pedido', '¿Está seguro de Eliminar el Pedido?',
			function() {
				window.location.href = window.location.href = "pedidos/eliminar?id=" + id
			},
			function() {
				alertify.error('Cancelado')
			});
	});
	$(document).on("click", ".btnAprobar", function() {
		var id = parseInt($(this).closest('tr').find('td:eq(0)').text()); //capturo la cantidad	
		alertify.confirm('Aprobar Pedido', '¿Está seguro de aprobar el Pedido?',
			function() {
				window.location.href = window.location.href = "pedidos/aprobar?id=" + id
			},
			function() {
				alertify.error('Cancelado')
			});

	});
</script>
<?php
include("vistas/includes/menuInferior.php");
?>