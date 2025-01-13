<?php
print_r(123).die;
use \App\modelo\Cliente;
use \App\modelo\Detallepagoventa;
use \App\modelo\Formapago;
use \App\modelo\Parametro;

$parametro = Parametro::find(1); //para que me traiga los param de la moneda
include("vistas/includes/menuSupDataTable.php");
?>
<style>
	#vistaFacturas td:nth-child(1) {
		display: none;

	}

	#vistaFacturas th:nth-child(1) {
		display: none;
	}
</style>
<!-- Contenido Principal -->
<div id="page-wrapper">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12">
				<h3 class="hstyle">GESTION DE FACTURAS</h3>
				<a href="<?php url("facturas/crear") ?>" id="btnNuevaVenta" class="btn btn-info"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> FACTURAS</a>
			</div>
		</div>
		<hr>
		<div class="row">
			<div class="col-lg-12">
				<div class="table-responsive">
					<table id="vistaFacturas" class="table-striped table-bordered table-condensed" cellspacing="0" width="100%">
						<thead>
							<tr>
								<!-- Datos de la tabla VENTAS -->

								<th>id</th>
								<th>N. de Factura</th>
								<th>Provedor</th>
								<th>Sucursal</th>
								<th>Fecha de Inicio</th>
								<th>Fecha de Registro</th>
								<th>Fecha fin</th>
								<th>Total apagar (<?php echo $parametro->moneda; ?>)</th>
								<th>Estado</th>
								<th class="text-center">Acción</th>
							</tr>
						</thead>
					</table>
				</div>
			</div>

		</div>
		<div class="row">
			<div class="col-lg-3 col-md-6">
				<div class="panel panel-rojo">
					<div class="panel-heading">
						<div class="row">
							<div class="col-xs-3">
								<i class="fa fa-tasks fa-5x"></i>
							</div>
							<div class="col-xs-9 text-right">
								<div>TOTAL</div>
								<div>TOTAL PAGADAS:</div>
								<div style="font-size: 15px;color: #E5E5E5;">
									<?php 
									// Si deseas imprimir el contenido del array de forma legible para humanos
									$suma_total = 0;
									// Iterar sobre cada factura en el array y sumar el valor de la clave "total"
									foreach ($facturas as $factura) {
										if ($factura->estado == "Cancelada") {
											$suma_total += $factura->total_pagar;

										}
									}
									// Imprimir la suma total
									echo  $suma_total;
									?>

								
								</div>
								<div>TOTAL PENDIENTES:</div>
								<div style="font-size: 15px;color: #E5E5E5;">
									<?php
									// Si deseas imprimir el contenido del array de forma legible para humanos
									$suma_total = 0;
									// Iterar sobre cada factura en el array y sumar el valor de la clave "total"
									foreach ($facturas as $factura) {
										if ($factura->estado == "Emitida" || "Editadas") {
											$suma_total += $factura->total_pagar;

										}
										
									}
									// Imprimir la suma total
									echo  $suma_total;
									?>
								</div>
							</div>
						</div>
					</div>

					<strong>
				</div>
			</div>
		</div>
		<div style="font-size: 23px;color: #E5E5E5;">
			<?php
			//echo $cantidad_pagos;
			?>
		</div>
	</div>
</div>
<!-- Contenido Principal -->
<script>
	//tabla VENTAS	
	$('#vistaFacturas').DataTable({
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
		"sAjaxSource": "libreria/ServerSide/serversideFacturas.php",
		"columnDefs": [{
			"targets": -1,
			"data": null,
			"render": function(data, type, row) {
				switch (data[8]) {
					case "Emitida":
					case "Editada":
						return "<div class='wrapper text-center'><div class='btn-group'><button class='btn btn-info btnDetalle' data-toggle='tooltip' title='Ver detalle'><i class='fa fa-file-text' aria-hidden='true'></i></button><button class='btn btn-danger btnDevolucion' data-toggle='tooltip' title='Realizar Pago'><i class='fa fa-check-circle-o' aria-hidden='true'></i></button></div></div>";

						break;
					case "Cancelada":
						return "<div class='wrapper text-center'><div class='btn-group'><button class='btn btn-info btnDetalle' data-toggle='tooltip' title='Ver detalle'><i class='fa fa-file-text' aria-hidden='true'></i></button></div></div>";

						break;
					case "Anulada":

						break;
				}

			}
		}],


		"bDestroy": true,
		"createdRow": function(row, data, index) {
			switch (data[8]) {
				case "Emitida":
				case "Editada":
					var fecha = data[6].split('/'); // Dividir la fecha en día, mes y año
					var fechaFormateada = fecha[2] + '-' + fecha[1] + '-' + fecha[0]; // Reorganizar la fecha en formato 'YYYY-MM-DD' para que sea compatible con Date
					var fechaActual = new Date(); // Obtener la fecha actual
					var fechaData = new Date(fechaFormateada); // Convertir la fecha de la fila en un objeto Date

					if (fechaActual > fechaData) {
						$('td', row).eq(6).css({
							'background-color': '#F44336',
							'color': 'white',
							'text-align': 'center',
						});
					}
					$('td', row).eq(8).css({
						'background-color': '#009688',
						'color': 'black',
						'text-align': 'center',
					});

					break;
				case "Cancelada":
					$('td', row).eq(8).css({ //para pintar una sola celda			
						'background-color': '#00E676',
						'color': 'white',
						'text-align': 'center',
					});
					break;
				case "Anulada":
					$('td', row).eq(8).css({ //para pintar una sola celda			
						'background-color': '#F44336',
						'color': 'white',
						'text-align': 'center',
					});
					break;
			}
		},
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
		window.location.href = "facturas/editar?id_factura=" + id;

		/* window.location.href="../ventas/detalle?id="+id; */
	});
	/* 	$(document).on("click", ".btnDevolucion", function(){		
			var id = parseInt($(this).closest('tr').find('td:eq(0)').text()) ; //capturo la cantidad				
			window.location.href=window.location.href="../ventas/devolucion?id="+id;		
		 }); */
	$(document).on("click", ".btnDevolucion", function() {
		var id = parseInt($(this).closest('tr').find('td:eq(0)').text()); //capturo la cantidad				
		window.location.href = window.location.href = "facturas/canceladaFacturas?id=" + id;
	});
</script>
<?php
include("vistas/includes/menuInferior.php");
?>