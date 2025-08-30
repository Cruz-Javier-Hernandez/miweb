<?php

use \App\modelo\Genero;
use \App\modelo\Rubro;
use \App\modelo\Categoria;
use \App\modelo\Estilo;
use \App\modelo\Marca;
use \App\modelo\Talle;
use \App\modelo\Color;
use \App\modelo\Existencia;
use \App\modelo\Parametro;

$parametro = Parametro::find(1); //para que me traiga los param de la moneda  
include("vistas/includes/menuSupABM.php");
?>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<!-- Contenido Principal -->
<div id="page-wrapper">
	<div class="container-fluid">
		<hr>
		<div class="row">
			<div class="col-lg-2 col-md-4 col-sm-6 col-xs-12">
				<a class="btn btn-primary pull-left " href="<?php echo url("admin"); ?>"><i class="fa fa-home" aria-hidden="true" placeholder="Home"> </i></a>
				<a class="btn btn-info pull-left " href="<?php echo url("productos"); ?>"><i class="fa fa-list" aria-hidden="true" placeholder="lista"> </i></a>
				<a class="btn btn-danger pull-left " href="<?php echo htmlspecialchars($_SERVER['HTTP_REFERER']); ?>"><i class="fa fa-reply" aria-hidden="true"></i></a>
				<a class="btn btn-success pull-left " href="<?php url("productos/crear"); ?>"><i class="fa fa-plus" aria-hidden="true"></i></a>
			</div>
		</div>
		<div class="row">
			<form action="<?php url("productos/editarproducto") ?>" method="POST" role="form" enctype="multipart/form-data">
				<div class="col-lg-12">
					<div class="panel panel-azulTienda">
						<div class="panel-heading">
							<h3 class="panel-title">Editar producto</h3>
						</div>
						<div class="alert alert-info bd-info mb-0" style="margin: 0px;"><strong>Aviso: </strong>Los Campos que contengan (<strong style="color: red;">*</strong>) son requeridos. </div>

						<div class="panel-body">
							<input type="hidden" value="<?php echo $producto->id ?>" name="id" id="id">
							<div class="form-group">
								<div class="row">
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
										<label>Código <strong style="color: red;">*</strong></label>
										<input value="<?php echo $producto->codigo ?>" id="txtCodigo" name="txtCodigo" class="form-control" type="text" pattern="[A-Z a-zñÑáéíóúÁÉÍÓÚ0-9_-]{1,35}" required autofocus tabindex="1">
									</div>
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
										<label>Estilo</label>
										<input value="<?php echo $producto->nombre ?>" id="txtNombre" name="txtNombre" type="text" pattern="[A-Z a-zñÑáéíóúÁÉÍÓÚ0-9._-]{1,50}" class="form-control" required tabindex="2">
									</div>
								</div>

								<div class="row">
									<div class="col-lg-2 col-md-4 col-sm-3 col-xs-6">
										<label for="txtRubro">Rubros <strong style="color: red;">*</strong></label>
										<select class="form-control" id="txtRubro" name="txtRubro" tabindex="3" style="color:#337ab7;" disabled>
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
										<input name="txtIdRubro" id="txtIdRubro" value="<?php echo $producto->idRubro; ?>" type="hidden">
									</div>
									<div class="col-lg-2 col-md-4 col-sm-3 col-xs-6">
										<label for="txtGenero">Géneros <strong style="color: red;">*</strong></label>
										<select class="form-control" id="txtGenero" name="txtGenero" tabindex="4" style="color:#337ab7;" disabled>
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
										<input name="txtIdGenero" id="txtIdGenero" value="<?php echo $producto->idGenero; ?>" type="hidden">
									</div>
									<div class="col-lg-2 col-md-4 col-sm-6 col-xs-6">
										<label for="txtCategoria">Categorías <strong style="color: red;">*</strong></label>
										<select class="form-control" id="txtCategoria" name="txtCategoria" tabindex="5" style="color:#337ab7;" disabled>
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
										<input name="txtIdCategoria" id="txtIdCategoria" value="<?php echo $producto->idCategoria; ?>" type="hidden">
									</div>
									<div class="col-lg-2 col-md-4 col-sm-6 col-xs-6">
										<label for="txtMarca">Marcas <strong style="color: red;">*</strong></label>
										<select class="form-control Select2" id="txtMarca" name="txtMarca" tabindex="7">
											<?php
											$marcas = Marca::all();
											foreach ($marcas as $marca) {
											?>
												<option value="<?php echo $marca->id; ?>">
													<?php
													echo $marca->descripcion;
													?>
												</option>
											<?php
											}
											?>
										</select>
										<input name="txtIdMarca" id="txtIdMarca" value="<?php echo $producto->idMarca; ?>" type="hidden">
									</div>
									<div class="row">
										<div class="col-lg-2 col-md-2 col-sm-3 col-xs-6">
											<label for="">Precio de Venta <strong style="color: red;">*</strong></label>
											<div class="input-group">
												<span class="input-group-addon"><?php echo $parametro->moneda; ?></span>
												<input value="<?php echo $producto->precioCompra ?>" name="txtPrecioCompra" type="number" step="any" min="1" class="form-control" required tabindex="8">
											</div>
										</div>
										<div class="col-lg-2 col-md-2 col-sm-3 col-xs-6">
											<label for="">Precio Minimo <strong style="color: red;">*</strong></label>
											<div class="input-group">
												<span class="input-group-addon"><?php echo $parametro->moneda; ?></span>
												<input value="<?php echo $producto->precioVenta ?>" name="txtPrecioVenta" type="number" step="any" min="1" class="form-control" required tabindex="9">
											</div>
										</div>
										<!-- <div class="col-lg-2 col-md-3 col-sm-3 col-xs-6">
											<label for="">P Compra <small> (Por unidad)</small> </label>
											<div class="input-group">
												<span class="input-group-addon"><?php echo $parametro->moneda; ?></span>
												<input value="<?php echo $producto->precioCompraunidad ?>" name="txtprecioCompraunidad" type="number" step="any" class="form-control" required tabindex="9">
											</div>
										</div> -->
									</div>
								</div>

								<hr>

								<div class="row">
									<div class="col-lg-1 col-md-4 col-sm-6 col-xs-6">
										<?php
										$arrayStockUni = [];
										$existencias = Existencia::all();

										foreach ($existencias as $existencia) {
											if ($existencia->idProducto == $producto->id && $existencia->Activo == 1) {
												$arrayStockUni[] = [$existencia->id, $existencia->talle, $existencia->color, $existencia->stock];
												$cantidad += $existencia->stock;
											}
										}
										$arrayStockOrdenado = [];
										function array_msort($array, $cols)
										{
											$colarr = array();
											foreach ($cols as $col => $order) {
												$colarr[$col] = array();
												foreach ($array as $k => $row) {
													$colarr[$col]['_' . $k] = strtolower($row[$col]);
												}
											}
											$eval = 'array_multisort(';
											foreach ($cols as $col => $order) {
												$eval .= '$colarr[\'' . $col . '\'],' . $order . ',';
											}
											$eval = substr($eval, 0, -1) . ');';
											eval($eval);
											$ret = array();
											foreach ($colarr as $col => $arr) {
												foreach ($arr as $k => $v) {
													$k = substr($k, 1);
													if (!isset($ret[$k])) $ret[$k] = $array[$k];
													$ret[$k][$col] = $array[$k][$col];
												}
											}
											return $ret;
										}
										$arrayOrder = array_msort($arrayStockUni, array('1' => SORT_ASC, '2' => SORT_ASC));
										$arrayStockOrdenado = array_values($arrayOrder);
										?>
										<label for="">Stock Total</label>
										<input name="txtStock" id="txtStock" type="number" class="form-control" value="<?php echo $cantidad ?>" tabindex="10" disabled>
									</div>
									<input name="txtArrayCantidades" id="txtArrayCantidades" type="hidden">
									<input name="txtArrayNuevosTalles" id="txtArrayNuevosTalles" type="hidden">
									<input name="txtArrayNuevosColores" id="txtArrayNuevosColores" type="hidden">

									<div class="col-lg-2 col-md-4 col-sm-6 col-xs-6">
										<label>Tabla</label>
										<br>
										<button id="btnActualizarStock" name="btnActualizarStock" type="button" class="btn btn-primary" tabindex="11">Talles y Colores</button>
									</div>
									<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
										<label>Foto o imagen del producto</label><br>
										<div class="file is-small has-name">
											<label class="file-label">
												<input class="file-input" type="file" name="producto_foto" accept=".jpg, .png, .jpeg">
												<span class="file-cta">
													<span class="file-label">Imagen</span>
												</span>
												<span class="file-name">JPG, JPEG, PNG. (MAX 3MB)</span>
											</label>
										</div>
									</div>
									<!-- Espacio para generar código de barra -->
									<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12" style="border: double;">
										<label for="txtCodigoBarra">Código de Barra</label>
										<div class="input-group">
											<input type="text" id="txtCodigoBarra" name="txtCodigoBarra" class="form-control" value="<?php echo  $producto->codigo_barra; ?>" tabindex="14" maxlength="13" pattern="[0-9]{8,13}" placeholder="EAN-13">
											<span class="input-group-btn">
												<button type="button" class="btn btn-info" id="btnGenerarBarra" tabindex="15">Generar</button>
												<button type="button" class="btn btn-warning" id="btnDescargarPDF" tabindex="16">Descargar PDF</button>
											</span>
										</div>
										<div id="barcodePreview" style="margin-top:10px;"></div>
									</div>
									<!-- jsPDF para descargar el código de barra en PDF -->
									<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
									<script>
										// Mostrar el código de barra al cargar la página si existe
										document.addEventListener('DOMContentLoaded', function() {
											var codigo = document.getElementById('txtCodigoBarra').value;
											if (codigo.length >= 8 && codigo.length <= 13 && /^\d+$/.test(codigo)) {
												document.getElementById('barcodePreview').innerHTML = '<svg id="svgBarcode"></svg>';
												JsBarcode("#svgBarcode", codigo, {
													format: "EAN13",
													width: 2,
													height: 60,
													displayValue: true
												});
										 }
										});

										document.getElementById('btnGenerarBarra').addEventListener('click', function() {
											var codigo = document.getElementById('txtCodigoBarra').value;
											if (codigo.length >= 8 && codigo.length <= 13 && /^\d+$/.test(codigo)) {
												document.getElementById('barcodePreview').innerHTML = '<svg id="svgBarcode"></svg>';
												JsBarcode("#svgBarcode", codigo, {
													format: "EAN13",
													width: 2,
													height: 60,
													displayValue: true
												});
											} else {
												document.getElementById('barcodePreview').innerHTML = '<span style="color:red;">Ingrese un código numérico válido (8-13 dígitos).</span>';
											}
										});

										document.getElementById('btnDescargarPDF').addEventListener('click', function() {
											var svg = document.getElementById('svgBarcode');
											var stockTotal = parseInt(document.getElementById('txtStock').value) || 1;
											if (!svg) {
												alert('Primero genere el código de barra.');
												return;
											}

											var serializer = new XMLSerializer();
											var svgString = serializer.serializeToString(svg);
											var canvas = document.createElement('canvas');
											var ctx = canvas.getContext('2d');
											var img = new Image();

											img.onload = function() {
												canvas.width = img.width;
												canvas.height = img.height;
												ctx.drawImage(img, 0, 0);
												var imgData = canvas.toDataURL('image/png');
												const { jsPDF } = window.jspdf;
												var pdf = new jsPDF();

												// --- CONFIGURACIÓN DE LAS COLUMNAS ---
												var cols = 3; // número de columnas
												var colWidth = 50; // ancho de cada código (ajustar según necesidad)
												var rowHeight = 20; // alto de cada código
												var marginX = 15; // margen izquierdo
												var marginY = 20; // margen superior
												var spacingX = 8; // espacio horizontal entre columnas
												var spacingY = 15; // espacio vertical entre filas

												var x = marginX;
												var y = marginY;
												var col = 0;

												for (var i = 0; i < stockTotal; i++) {
													pdf.addImage(imgData, 'PNG', x, y, colWidth, rowHeight);

													// Avanzar a la siguiente columna
													col++;
													if (col < cols) {
														x += colWidth + spacingX;
													} else {
														// Reiniciar a la primera columna y bajar una fila
														col = 0;
														x = marginX;
														y += rowHeight + spacingY;
													}

													// Si ya no cabe en la página → nueva página
													if (y + rowHeight > pdf.internal.pageSize.getHeight() - marginY) {
														pdf.addPage();
														x = marginX;
														y = marginY;
														col = 0;
													}
												}

												pdf.save('codigo_barra.pdf');
											};

											img.src = 'data:image/svg+xml;base64,' + btoa(unescape(encodeURIComponent(svgString)));
										});
									</script>

									<div class="col-lg-12 text-center">
										<div id="printCodeBar" style="display:none;">
											<svg id="barcode"></svg>
										</div>
										<br>
										<button class="btn btn-default" id="btnImpCodeBar" type="button" style="display:none">Imprimir</button>
									</div>
								</div>
							</div>
							<div class="panel-footer clearfix">
								<a class="btn btn-danger pull-left" href="<?php echo htmlspecialchars($_SERVER['HTTP_REFERER']); ?>" tabindex="13"><i class="fa fa-ban" aria-hidden="true"></i> Cancelar</a>
								<button type="submit" id="btnEditarProd" class="btn btn-success pull-right" tabindex="12"><i class="fa fa-floppy-o" aria-hidden="true"></i> Guardar</button>
							</div>
						</div>
					</div>
			</form>
			<!-- Librería JsBarcode para generar código de barras -->
			<script src="https://cdn.jsdelivr.net/npm/jsbarcode@3.11.5/dist/JsBarcode.all.min.js"></script>
			<script>
				$('#btnGenerarBarra').on('click', function() {
					var codigo = $('#txtCodigoBarra').val();
					if (codigo.length >= 8 && codigo.length <= 13 && /^\d+$/.test(codigo)) {
						$('#barcodePreview').html('<svg id="svgBarcode"></svg>');
						JsBarcode("#svgBarcode", codigo, {
							format: "EAN13",
							width: 2,
							height: 60,
							displayValue: true
						});
					} else {
						$('#barcodePreview').html('<span style="color:red;">Ingrese un código numérico válido (8-13 dígitos).</span>');
					}
				});
			</script>
		</div>
	</div>
</div>
<!-- Contenido Principal -->
<!-- Modal Alta de Existencias -->
<div class="modal fade" id="modal_alta_existencias" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header modal-header-primary">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="">Actualizar Stock</h4>
			</div>
			<div class="panel-body">
				<div class="form-group">
					<div class="row">
						<div class="col-lg-12">
							<button id="btnAgregarFilCol" class="btn btn-naranja btn-sm" data-toggle="tooltip" title="Agregar Talles y/o Colores"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Talles/Colores</button>
							<div class="table-responsive">
								<table id="tablaTalleColor" class="table table-condensed table-bordered" cellspacing="0" width="100%">
									<thead>
										<th class="text-center" style="width:15%">Talle / Color</th>
										<?php
										//nuevo obtengo los datos directamente de tabla existencias							
										$existencias = Existencia::all();
										foreach ($existencias as $existencia) {
											if ($existencia->idProducto == $producto->id) {
												$arrayC[] = $existencia->color;
												$arrayT[] = $existencia->talle;
												$arrayS[] = $existencia->Style;
											}
										}
										$arrayColores = array_unique($arrayC);
										sort($arrayColores);
										//$arrayT = array_unique($arrayT);
										$arraySs = array_unique($arrayS);
										//sort($arrayT);
										//sort($arraySs);
										$i = 0;
										foreach ($arrayColores as $arrayColor) {

										?>
											<th class="text-center"><?php echo $arrayColor; ?><input style="width: -webkit-fill-available;display: flex;" type="color" id="color" name="color" value="<?= $arraySs[$i] ?>"></th>
										<?php
											$i++;
										}
										?>
									</thead>
									<tbody>
										<?php
										$j = 0;
										$arrayTalles = array_unique($arrayT);
										sort($arrayTalles);
										foreach ($arrayTalles as $arrayTalle) {
										?>
											<tr>
												<td class="text-center" style="background-color:#337ab7; color:white;"><?php echo $arrayTalle; ?></td>
												<?php
												$cantCol = count($arrayColores);
												for ($i = 1; $i <= $cantCol; $i++) {
													echo "<td class='text-center cantidad' onkeypress='return testEnteros(event);' contenteditable='true'>" . $arrayStockOrdenado[$j][3] . "</td>";
													$j = $j + 1;
												}
												?>
											</tr>
										<?php
										} //foreach							
										?>
									</tbody>
								</table>

							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer clearfix">
				<button type="button" class="btn btn-danger pull-left" data-dismiss="modal" tabindex=""><i class="fa fa-ban" aria-hidden="true"></i> Cancelar</button>
				<button id="btnSaveTalleColor" name="btnSaveTalleColor" type="button" class="btn btn-success pull-right" tabindex=""><i class="fa fa-floppy-o" aria-hidden="true"></i> Actualizar</button>
			</div>
		</div>
	</div>
</div>
<!--Modal Agregar talles y/o colores-->
<div id="modal_agregarTalleColor" class="modal fade" tabindex="-1" role="dialog">
	<div class="modal-dialog modal-sm" role="document">
		<div class="modal-content">
			<div class="modal-header modal-header-primary">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Agregar Talles/Colores</h4>
			</div>
			<div class="modal-body">
				<div id="nuevosTalles" class="row">
					<div class="col-lg-12">
						<label for="">Tallas</label>
						<div class="input-group">
							<select class="form-control" id="txtTalle" name="txtTalle" tabindex="7">
							</select>
							<span class="input-group-btn">
								<a class="btn btn-naranja" id="btnAgregarTalle" name="btnAgregarTalle" tabindex="">Agregar</a>
							</span>
						</div>
					</div>
				</div>

				<div id="nuevosColores" class="row">
					<div class="col-lg-12">
						<label for="">Colores</label>
						<div class="input-group">
							<select class="form-control" id="txtColor" name="txtColor" tabindex="8"> </select>
							<span class="input-group-btn">
								<a class="btn btn-naranja" id="btnAgregarColor" name="btnAgregarColor" tabindex="">Agregar</a>
							</span>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer clearfix">
			</div>
		</div>
	</div>
</div>
<script>
	$(document).ready(function() {
		$('.Select2').select2();

	});
	$('#txtGenero > option[value="<?php echo $producto->idGenero; ?>"]').attr('selected', 'selected');
	$('#txtRubro > option[value="<?php echo $producto->idRubro; ?>"]').attr('selected', 'selected');
	$('#txtCategoria > option[value="<?php echo $producto->idCategoria; ?>"]').attr('selected', 'selected');

	$('#txtMarca > option[value="<?php echo $producto->idMarca; ?>"]').attr('selected', 'selected');

	$('#txtIdGenero').val(<?php echo $producto->idGenero; ?>);
	$('#txtIdRubro').val(<?php echo $producto->idRubro; ?>);
	$('#txtIdCategoria').val(<?php echo $producto->idCategoria; ?>);
	$('#txtIdMarca').val(<?php echo $producto->idMarca; ?>);
	idGenero = $('select#txtGenero').val();
	idRubro = $('select#txtRubro').val();
	idCategoria = $('select#txtCategoria').val();
</script>
<script src="<?php echo asset("bower_components/js/codigo_productos_editar.js") . '?v=' . time(); ?>"></script>
<?php
include("vistas/includes/menuInferior.php");
?>