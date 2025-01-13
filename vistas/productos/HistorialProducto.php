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
use \App\modelo\Log_precios;
use App\modelo\Sucursal;

$parametro = Parametro::find(1); //para que me traiga los param de la moneda  
$Historia = Log_precios::all();
include("vistas/includes/menuSupABM.php");
?>
<!-- Contenido Principal -->
<div id="page-wrapper">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12">
				<hr>
			</div>
		</div>
		<div class="row">
			<form action="<?php url("productos/editarproducto") ?>" method="POST" role="form" enctype="multipart/form-data">
				<div class="col-lg-12">
					<div class="panel panel-azulTienda">
						<div class="panel-heading">
							<h3 class="panel-title">Ver producto</h3>
						</div>
						<div class="panel-body">
							<input type="hidden" value="<?php echo $producto->id ?>" name="id" id="id">
							<div class="form-group">
								<div class="row">
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
										<img src="\calzados\<?php echo $producto->imagen; ?>" alt="" style="max-width: 100%; height: auto;">
									</div>


									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
										<label for="">Código </label>
										<input value="<?php echo $producto->codigo ?>" id="txtCodigo" class="form-control" disabled>
									</div>
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
										<label for="">Estilo</label>
										<input value="<?php echo $producto->nombre ?>" id="txtNombre" class="form-control" disabled>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-2 col-md-4 col-sm-6 col-xs-12">
										<label for="txtRubro">Rubros </label>
										<select class="form-control" id="txtRubro" disabled>
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

									</div>
									<div class="col-lg-2 col-md-4 col-sm-6 col-xs-12">
										<label for="txtGenero">Géneros </label>
										<select class="form-control" id="txtGenero" disabled>
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

									</div>
									<div class="col-lg-2 col-md-4 col-sm-6 col-xs-12">
										<label for="txtCategoria">Categorías </label>
										<select class="form-control" id="txtCategoria" disabled>
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

									</div>
									<div class="col-lg-2 col-md-4 col-sm-6 col-xs-12">
										<label for="txtMarca">Marcas </label>
										<select class="form-control" id="txtMarca" disabled>
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
									</div>
									<div class="col-lg-2 col-md-2 col-sm-4 col-xs-6">
										<label for="">Precio de Venta </label>
										<div class="input-group">
											<span class="input-group-addon"><?php echo $parametro->moneda; ?></span>
											<input value="<?php echo $producto->precioCompra ?>" class="form-control" disabled>
										</div>
									</div>
									<div class="col-lg-2 col-md-2 col-sm-4 col-xs-6">
										<label for="">Precio Minimo </label>
										<div class="input-group">
											<span class="input-group-addon"><?php echo $parametro->moneda; ?></span>
											<input value="<?php echo $producto->precioVenta ?>" class="form-control" disabled>
										</div>
									</div>
									<div class="col-lg-2 col-md-3 col-sm-4 col-xs-6">
										<label for="">P Compra <small> (Por unidad)</small> </label>
										<div class="input-group">
											<span class="input-group-addon"><?php echo $parametro->moneda; ?></span>
											<input value="<?php echo $producto->precioCompraunidad ?>" class="form-control" disabled>
										</div>
									</div>
								</div>
								<hr>
								<div class="row">
									<div class="col-lg-2 col-md-4 col-sm-6 col-xs-6">
										<?php
										$arrayStockUni = [];
										$existencias = Existencia::all();

										foreach ($existencias as $existencia) {
											if ($existencia->idProducto == $producto->id) {
												//$arrayStockUni[]= [$existencia->talle, $existencia->stock];
												$arrayStockUni[] = [$existencia->id, $existencia->talle, $existencia->color, $existencia->stock];
												$cantidad += $existencia->stock; //sumo el stock total				
												//$arrayStockUni[] = $existencia->stock;//para guardar stock unitario 
												$cantIdProd; //cuantas veces se repite el IdProducto
											}
										}
										?>
										<label for="">Total de Producto Actual</label>
										<input name="txtStock" id="txtStock" type="number" class="form-control" value="<?php echo $cantidad ?>" tabindex="10" disabled>
									</div>

								</div>
								<hr>
								<div class="row">

									<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
										<div class="panel-heading">
											<h3 class="panel-title">HISTORIAL DE PRECIOS</h3>
										</div>
										<div class="table-responsive">
											<table id="historial" class="table-condensed table-hover table-bordered" cellspacing="0" width="100%">
												<thead>
													<tr>
														<th>Precio de Compra</th>
														<th>Precio Maximo</th>
														<th>Precio Minimo</th>
														<th>Fecha de Registro</th>

													</tr>
												</thead>
												<tbody>
													<div class="col-lg-2 col-md-4 col-sm-12 ">
														<div class="input-group">
															<label for="Sucursal">Sucursal</label>
															<select class="form-control" id="Sucursal" name="Sucursal" tabindex="7">
																<?php
																$Sucursales = Sucursal::all();
																foreach ($Sucursales as $Sucursal) {
																?>
																	<option value="<?php echo $Sucursal->SucursalID; ?>">
																		<?php
																		echo $Sucursal->Sucursal;
																		?>
																	</option>
																<?php
																}
																?>
															</select>

														</div>
													</div>

												</tbody>

											</table>
										</div>
									</div>
								</div>
							</div>
							<div class="panel-footer clearfix">
								<a class="btn btn-default pull-left" href="<?php echo htmlspecialchars($_SERVER['HTTP_REFERER']); ?>" tabindex="13"><i class="fa fa-ban" aria-hidden="true"></i> Salir</a>
							</div>
						</div>
					</div>
			</form>
		</div>
	</div>
</div>

<script>
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
<script src="<?php asset("bower_components/js/codigo_productos_editar.js") ?>"></script>
<?php
include("vistas/includes/menuInferior.php");
?>