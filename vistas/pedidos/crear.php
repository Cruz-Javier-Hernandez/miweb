<?php

use App\modelo\Marca;
use \App\modelo\Parametro;
use \App\modelo\Producto;
use \App\modelo\Existencia;
$parametro = Parametro::find("1");
include("vistas/includes/menuSupABM.php");
$productos_id = '1232';
?>

<style>
    /* Estilos personalizados para el select */
    .custom-select {
        appearance: none;
        -webkit-appearance: none;
        -moz-appearance: none;
        background-color: #ffffff;
        border: 1px solid #ced4da;
        border-radius: .25rem;
        padding: .375rem .75rem;
        font-size: 1rem;
        line-height: 1.5;
    }

    /* Estilos para cuando el select está enfocado */
    .custom-select:focus {
        border-color: #80bdff;
        outline: 0;
        box-shadow: 0 0 0 .2rem rgba(0, 123, 255, .25);
    }

    /* Estilos para las opciones del select */
    .custom-select option {
        color: initial;
        background-color: #ffffff;
    }
</style>
<!-- Contenido Principal -->
<div id="page-wrapper">
    <div class="container-fluid">
        <hr>
        <div class="row">
            <div class="col-lg-2 col-md-4 col-sm-6 col-xs-12">
            <a class="btn btn-primary pull-left " href="<?php echo url("admin"); ?>"><i class="fa fa-home" aria-hidden="true" placeholder="Home"> </i></a>
				<a class="btn btn-info pull-left " href="<?php echo url("pedidos"); ?>"><i class="fa fa-list" aria-hidden="true" placeholder="lista"> </i></a>
				<a class="btn btn-danger pull-left " href="<?php echo htmlspecialchars($_SERVER['HTTP_REFERER']); ?>"><i class="fa fa-reply" aria-hidden="true"></i></a>
				
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-azulTienda">
                    <div class="panel-heading">
                        <h3 class="panel-title">Nuevo Pedido</h3>
                    </div>
                    <form action="<?php url("pedidos/crearPedidos") ?>" method="POST" role="form" enctype="multipart/form-data">
                        <div class="alert alert-info bd-info  mb-0" style="margin: 0px;"><strong>Aviso: </strong>Los Campos que contengan (<strong style="color: red;">*</strong>) son requeridos. </div>
                     
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                                    <label for="Producto">Codigo de Producto <strong style="color: red;">*</strong></label>
                                    <div class="input-group ">
                                        <select class="form-control Select2" id="txtcodigo" name="txtcodigo" tabindex="7">
                                            <option value="0">Seleccione...</option>
                                            <?php
                                            $prove = Producto::all();
                                            foreach ($prove as $Producto) {
                                            ?>
                                                <option value="<?php echo $Producto->id; ?>">
                                                    <?php
                                                    echo $Producto->codigo;
                                                    ?>
                                                </option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-5">
                                    <label for="Producto">Marca</label>
                                    <div class="input-group pb-5">
                                        <input class="pb-5 form-control" type="text" name="txtmarca" id="txtmarca" disabled>
                                    </div>
                                </div>
                                <div class="col-lg-1 col-md-2 col-sm-3 col-xs-3">
                                    <label for="stock">Stock</label>
                                    <div class="input-group pb-5">
                                        <input class="pb-5 form-control" type="text" name="txtStock" id="txtStock" disabled>
                                    </div>
                                </div>
                                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                                    <label for="talles">Tallas/colores</label>
                                    <div class="input-group ">
                                        <div class='btn-group '>
                                            <a id="btnActualizarStock" name="btnActualizarStock" class='btnMostrarTallesColores btn btn-green ' data-toggle='tooltip' title='Talle/Color'>
                                                <i class='fa fa-expand' aria-hidden='true'>
                                                </i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                                    <label for="imagen">Imagen</label>
                                    <div class="input-group form-control">
                                        <center><img id="imageElement" style="max-width: 60%; height: auto;"></center>
                                    </div>
                                </div>
                        
                            </div>
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
                                    <label for="Descripcion">Descripcion <strong style="color: red;">*</strong></label>
                                    <div class="input-group ">
                                        <span class="input-group-addon"><i class="fa fa-list-alt"></i></span>
                                        <textarea class="form-control" name="txtDescripcion" id="txtDescripcion" cols="37" rows="10" placeholder="Agregar Lista de Pedidos  Aquí..."></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel-footer clearfix">
                            <a class="btn btn-danger pull-left text-white" style="color: white;" href="<?php echo htmlspecialchars($_SERVER['HTTP_REFERER']); ?>"><i class="fa fa-ban" aria-hidden="true"></i> Cancelar</a>
                            <button type="submit" class="btn btn-success pull-right" tabindex="7"><i class="fa fa-floppy-o" aria-hidden="true"></i> Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modal_alta_existencias" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header modal-header-primary">
                <h4 class="modal-title" id="">Visualizar Stock</h4>
            </div>
            <div class="panel-body">
                <div class="form-group">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="table-responsive">
                                <table id="tablaTalleColor" class="table table-condensed table-bordered" cellspacing="0" width="100%">
                                    <thead>
                                        <th class="text-center" style="width:15%">Talle / Color</th>
                                        <?php
                                        //nuevo obtengo los datos directamente de tabla existencias							
                                        $existencias = Existencia::all();
                                        foreach ($existencias as $existencia) {
                                            if ($existencia->idProducto == isset($_POST['producto']) ) {
                                                $arrayC[] = $existencia->color;
                                                $arrayT[] = $existencia->talle;
                                                $arrayS[] = $existencia->Style;
                                            }
                                        }
                                        $arrayColores = array_unique($arrayC);
                                        sort($arrayColores);
                                        //$arrayT = array_unique($arrayT);
                                        $arraySs = array_unique($arrayS);
                                        //sort($arrayT);sha
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

        </div>
    </div>
</div>
<!-- Contenido Principal -->
<script>
    $(document).on('change', '#txtcodigo', function(event) {
        let selectmarca = $('#txtcodigo').val();
        // Aquí va tu lógica cuando el valor del select cambia
        jQuery.ajax({
            url: '<?php url("ajax/Pedidos/") ?>' + selectmarca,
            cache: false,
            type: 'POST',
            dataType: 'json',
            success: function(rs) {
                if (rs.done) {
                        $('#txtmarca').val(rs.marca);
                        $('#txtStock').val(rs.Stock);
                        $('#id').val(rs.id);
                        
                        $('#imageElement').attr('src', rs.image_url);
                    } else {
                        console.error('Error: ' + rs.message);
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error en la solicitud AJAX:', error);
                
            },
        });
    });
    $('form').submit(function() {


        /* 	if (var_cuit == 0 || var_cuit == "") {
        		alertify.warning("El CUIT no puede ser 0.");
        		return false;
        	} */
        /* 	if (var_telefono == 0 || var_telefono == "") {
        		alertify.warning("El teléfono no puede ser 0.");
        		return false;
        	} */


    });
</script>
<script src="<?php asset("bower_components/js/codigo_productos_editar.js") ?>"></script>
<?php
include("vistas/includes/menuInferior.php");
?>