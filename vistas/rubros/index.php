<?php
include("vistas/includes/menuSupDataTable.php");
?>
<style>

.table td:nth-child(1){
  display:none;
  
}
.table th:nth-child(1){
  display:none;
}
</style>
<!-- Contenido Principal -->
<div id="page-wrapper">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12">                        
				<h2 class="hstyle">GESTION DE RUBROS</h2>
				<a class="btn btn-primary pull-left " href="<?php echo url("admin"); ?>"><i class="fa fa-home" aria-hidden="true" placeholder="Home"> </i></a>
				<a href="<?php url("rubros/crear") ?>" class="btn btn-success"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> RUBROS</a>
			</div>
		</div>	
		<br>
		<div class="row">
			<div class="col-lg-12">                        
				<div class="table-responsive">        
				<table  class="table table-striped table-hover table-condensed tabla" cellspacing="0" width="100%">
					<thead>
						<tr>
							<th >Id</th>
							<th>Descripción</th>
							<th class="text-center">Acción</th>
						</tr>
					</thead>
					<tbody>
					<?php foreach ($rubros as $rubro) {
					?>
						<tr>
							<td><?php echo $rubro->id; ?></td>
							<td><?php echo $rubro->descripcion; ?></td>
							<td>
							<div class='wrapper text-center'>	
								<div class="btn-group" role="group">
								<a href="<?php url("rubros/editar?id=".$rubro->id) ?>" class="btn btn-primary" data-toggle="tooltip" title="Editar"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>

								<button class="btn btn-danger" onclick="confirmar('<?php url("rubros/eliminar?id=".$rubro->id) ?>')" data-toggle="tooltip" title="Eliminar"><i class="fa fa-trash-o" aria-hidden="true"></i></button>     
								</div>    
							</div>	
							</td>
						</tr>
					<?php
					} ?>
					</tbody>
				</table>  
				</div>
			</div>
		</div>
	</div>	
</div>
<!-- Contenido Principal -->                    
<?php
    include("vistas/includes/menuInferior.php");
   //revisa que el registro sea eliminado o no, en el caso que esté asociado
    if ($_SESSION["temp_elimina"] == "false") {
        echo "<script>     
                    alertify.error('No se pudo eliminar!').delay(2);
              </script>";
        $_SESSION["temp_elimina"] = "true";
    }
?>