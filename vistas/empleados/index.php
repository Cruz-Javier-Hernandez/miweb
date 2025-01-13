<?php

use \App\modelo\Cliente;
use \App\modelo\Detallepagoventa;
use \App\modelo\Formapago;
use \App\modelo\Parametro;

$parametro = Parametro::find(1); //para que me traiga los param de la moneda
include("vistas/includes/menuSupDataTable.php");
?>
<style>
	#vistaEmpleados td:nth-child(1) {
		display: none;
	}
	#vistaEmpleados th:nth-child(1) {
		display: none;
	}
</style>
<!-- Contenido Principal -->
<div id="page-wrapper">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12">
				<h3 class="hstyle">GESTION DE EMPLEADOS</h3>
				<a class="btn btn-primary pull-left " href="<?php echo url("admin"); ?>"><i class="fa fa-home" aria-hidden="true" placeholder="Home"> </i></a> 
				<a href="<?php url("empleados/crear") ?>" id="btnNuevaVenta" class="btn btn-success"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> EMPLEADO</a>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-lg-12">
				<div class="table-responsive">
					<table id="vistaEmpleados" class="table-striped table-bordered table-condensed" cellspacing="0" width="100%">
						<thead>
							<tr>
								<!-- Datos de la tabla VENTAS -->
								<th>id</th>
								<th>Nombre</th>
								<th>Cargo</th>
								<th>Telefono</th>
								<th>Sucursal</th>
								<th>Fecha de Registro</th>
								<th>Perfil</th>
								<th>Acción</th>
							</tr>
						</thead>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Contenido Principal -->
<script>
	//tabla VENTAS	
	$('#vistaEmpleados').DataTable({
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
		"columnDefs": [ {
            "targets": -1,
            "data": null,
            "defaultContent": "<div class='btn-group'><button class='btn btn-primary btnEditar' data-toggle='tooltip' title='Editar'><i class='fa fa-pencil-square-o' aria-hidden='true'></i></button><button class='btn btn-danger btnEliminar' data-toggle='tooltip' title='Eliminar'><i class='fa fa-trash-o' aria-hidden='true'></i></button></div>"
        } ],
		"sAjaxSource": "libreria/ServerSide/serversideEmpleados.php",
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
	$(document).on("click", ".btnEditar", function(){		
		var id = parseInt($(this).closest('tr').find('td:eq(0)').text()) ; //capturo la cantidad
		
		window.location.href="empleados/editar?id="+id;	
	 });
	$(document).on("click", ".btnEliminar", function(){		
		var id = parseInt($(this).closest('tr').find('td:eq(0)').text()) ; //capturo la cantidad		
		alertify.confirm('Eliminar Registro','¿Está seguro de eliminar el registro?',
		function(){window.location.href=window.location.href="empleados/eliminar?id="+id;},
		function(){alertify.error('Cancelado')});
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