<?php
include("vistas/includes/menukiosko.php");

include(CONTROLADORES . 'ProductoController.php');

use \App\modelo\Parametro;

$calzado = Parametro::find(1);
?>
<style>
    /* .slider-frame {
    overflow: hidden;
    width: 100%;
    height: auto;
    position: relative;
}

.slider-frame ul {
    display: flex;
    width: 100%;
    animation: slide 16s infinite ease-in-out;
    padding: 0;
    margin: 0;
}

.slider-frame li {
    list-style: none;
    min-width: 100%;
    box-sizing: border-box;
}

.slider-frame img {
    width: 100%;
    height: auto;
}

@keyframes slide {
    0% { margin-left: 0%; }
    20% { margin-left: 0%; }

    25% { margin-left: -100%; }
    30% { margin-left: -100%; }

    35% { margin-left: -200%; }
    40% { margin-left: -200%; }

    45% { margin-left: -300%; }
    50% { margin-left: -300%; }

    55% { margin-left: -400%; }
    60% { margin-left: -400%; }

    65% { margin-left: -500%; }
    70% { margin-left: -500%; }

    75% { margin-left: -600%; }
    80% { margin-left: -600%; }

    85% { margin-left: -700%; }
    90% { margin-left: -700%; }

    95% { margin-left: -800%; }
    100% { margin-left: -800%; }


} */
    .carousel-inner>.item>img {
        width: 100%;
        height: auto;
    }

    .carousel-control.left,
    .carousel-control.right {
        background-image: none;
    }
</style>

<div class="row">
    <div class="container" style="margin-top: 20px;">

        <div class="row">
            <div class="col-lg-12 panel ">
                <div class="card" style="background-color: #fff; border-radius: 10px; padding: 20px; box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);">
                    <div class="row">
                        <!-- Columna para la Información -->
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <h2 class="text-uppercase" style="color: #333; font-weight: bold;">Calzado Alexander</h2> <!-- tamaño de las imagenes es de 2240 por todo -->
                            <?php if ($primero) { ?>
                                <p style="font-size: 16px; color: #555;">
                                    Ofrecemos los mejores calzados con la calidad y diseño que mereces. Visítanos y encuentra
                                    el par perfecto para ti, el zapato que quieres al precio que te gusta.
                                </p>
                                <ul style="list-style: none; padding: 0; font-size: 16px; color: #555;">
                                    <li>✔ Calzado para toda la familia.</li>
                                    <li>✔ Estilo y comodidad garantizados.</li>
                                    <li>✔ Encuentra lo que necesitas al mejor precio.</li>
                                    <li>✔ Envios Gratis a todo El Salvador.</li>
                                    <li>✔ El zapato que quieres al precio que te guste.</li>
                                </ul>
                            <?php } else { ?>
                                <h2 class="text-uppercase" style="color: #333; font-weight: bold;">
                                    <?= $Categoria->descripcion ?>
                                </h2>
                                <?= $Categoria->info ?>
                            <?php } ?>

                        </div>

                        <!-- Columna para el Carrusel -->
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <div id="info-carousel" class="carousel slide" data-ride="carousel">
                                <!-- Indicadores -->
                                <ol class="carousel-indicators">
                                    <?php foreach ($img as $key => $row) : ?>
                                        <li data-target="#info-carousel" data-slide-to="<?= $key ?>" class="<?= $key === 0 ? 'active' : '' ?>"></li>
                                    <?php endforeach; ?>
                                </ol>

                                <!-- Slides -->
                                <div class="carousel-inner">
                                    <?php foreach ($img as $key => $row) : ?>
                                        <div class="item <?= $key === 0 ? 'active' : '' ?>">
                                            <img src="<?= $row ?>" style="width:100%; height:300px; border-radius: 10px;">
                                        </div>
                                    <?php endforeach; ?>
                                </div>

                                <!-- Controles -->
                                <a class="left carousel-control" href="#info-carousel" data-slide="prev">
                                    <span class="glyphicon glyphicon-chevron-left"></span>
                                </a>
                                <a class="right carousel-control" href="#info-carousel" data-slide="next">
                                    <span class="glyphicon glyphicon-chevron-right"></span>
                                </a>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="row text-center" style="padding-bottom: 2%">

            <center>
                <ul class="nav nav-pills" role="tablist" style="display: inline-block;margin-left: 4%;">


                    <?php foreach ($Genero as $row) {
                        if ($row->id != $id) {
                    ?>
                            <li role="presentation">
                                <a onclick="cargarProductos(<?= $row->id ?>)" class="btn btn-green" aria-controls="contacto" role="tab" data-toggle="tab">
                                    <?= $row->descripcion ?>
                                </a>
                            </li>
                    <?php }
                    } ?>
                </ul>
            </center>

        </div>


        <div class="row">
            <div class="col-lg-12 ">
                <!-- Contenedor de PRODUCTOS -->
                <?php if ($primero) {
                    foreach ($Genero as $row) { ?>
                        <div class="col-lg-2 col-md-4 col-sm-4 col-xs-6">
                            <div class="panel ">
                                <div class="panel-heading" style="min-height: 136.85px;">
                                    <div class="row">
                                        <div class="col-xs-12 text-right">
                                            <div id="carousel-<?php echo $row->id; ?>" class="carousel slide" data-ride="carousel">
                                                <!-- Indicadores -->
                                                <ol class="carousel-indicators">
                                                    <?php
                                                    $imageCount = 0;
                                                    foreach ($Producto as $key => $row2) {
                                                        if ($row2->idGenero == $row->id && $row2->image != "") { ?>
                                                            <li data-target="#carousel-<?php echo $row->id; ?>" data-slide-to="<?php echo $imageCount; ?>" class="<?php echo $imageCount == 0 ? 'active' : ''; ?>"></li>
                                                    <?php
                                                            $imageCount++;
                                                        }
                                                    }
                                                    ?>
                                                </ol>

                                                <!-- Slides -->
                                                <div class="carousel-inner">
                                                    <?php
                                                    $imageCount = 0;
                                                    foreach ($Producto as $row2) {
                                                        if ($row2->idGenero == $row->id && $row2->imagen != "") {
                                                            $imagePath = $_SERVER['DOCUMENT_ROOT'] . "/calzados/" . $row2->imagen;
                                                            if (file_exists($imagePath)) {
                                                                $imageInfo = getimagesize($imagePath); // Obtén las dimensiones de la imagen
                                                                $width = $imageInfo[0];
                                                                $height = $imageInfo[1];

                                                                // Establece el ancho mínimo requerido


                                                                if ($width == 1280 || $width == 1600) { // Filtra solo las imágenes que cumplen con el ancho
                                                    ?>
                                                                    <div class="item <?php echo $imageCount == 0 ? 'active' : ''; ?>">
                                                                        <img src="/calzados/<?php echo $row2->imagen; ?>"
                                                                            alt=""
                                                                            loading="lazy"
                                                                            style="width: 100%; height: auto;"
                                                                            data-width="<?php echo $width; ?>"
                                                                            data-height="<?php echo $height; ?>">
                                                                    </div>
                                                    <?php
                                                                    $imageCount++;
                                                                }
                                                            }
                                                        }
                                                    }
                                                    ?>
                                                </div>

                                                <!-- Controles -->
                                                <a class="left carousel-control" href="#carousel-<?php echo $row->id; ?>" data-slide="prev">
                                                    <span class="glyphicon glyphicon-chevron-left"></span>
                                                    <span class="sr-only">Previous</span>
                                                </a>
                                                <a class="right carousel-control" href="#carousel-<?php echo $row->id; ?>" data-slide="next">
                                                    <span class="glyphicon glyphicon-chevron-right"></span>
                                                    <span class="sr-only">Next</span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class=" panel-azul">
                                    <!-- <a href='<?php url("kiosko") ?>'> -->
                                    <a href="javascript:void(0);" onclick="cargarProductos(<?= $row->id ?>)">
                                        <div class="panel-footer">
                                            <span class="pull-left"><?= $row->descripcion ?></span>
                                            <span class="pull-right"><i class="fa fa-arrow-circle-right boton-rebote"></i></span>
                                            <div class="clearfix"></div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>

                    <?php }
                } else { ?>
                    <?php foreach ($Clasificacion as $row) {
                        if ($row->imagen != "") {
                    ?>
                            <div class="col-lg-2 col-md-4 col-sm-4 col-xs-6">
                                <div class="panel">
                                    <div class="panel-heading" style="min-height: 136.85px;">
                                        <div class="row">
                                            <div class="col-xs-12 text-center">
                                                <?php


                                                $imagePath = $_SERVER['DOCUMENT_ROOT'] . "/calzados/" . $row->imagen;
                                                if (file_exists($imagePath)) {
                                                    $imageInfo = getimagesize($imagePath); // Obtén las dimensiones de la imagen
                                                    $width = $imageInfo[0];
                                                    $height = $imageInfo[1];

                                                ?>
                                                    <img src="/calzados/<?php echo $row->imagen; ?>"
                                                        alt=""
                                                        loading="lazy"
                                                        style="width: 100%; height: auto;"
                                                        data-width="<?php echo $width; ?>"
                                                        data-height="<?php echo $height; ?>"
                                                        onclick="showImageModal('/calzados/<?php echo $row->imagen; ?>')">

                                                <?php

                                                }


                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="panel-azul">
                                        <a>
                                            <div class="panel-footer" style="padding-left: 3%;">
                                                Precio: <span class="pull-right">$<?= substr($row->Precio, 7) ?></span><br>
                                                Marca: <small><span class="pull-right"><?= $row->mar ?></span></small><br>
                                                <!-- Pares Disponibles: <span class="pull-right"><?= $row->stock ?></span><br> -->
                                                Tallas: <span class="pull-right">

                                                    <div class='btn-group pull-right' role='group'>
                                                        <a class="btnMostrarTallesColores btn btn-green"
                                                            data-id="<?= $row->id ?>"
                                                            data-toggle="tooltip"
                                                            title="Talle/Color">
                                                            <i class="fa fa-expand" aria-hidden="true"></i>
                                                        </a>

                                                    </div>



                                                </span>
                                                <small>
                                                    <div class="clearfix">
                                                        <a class="btn-21" href="https://api.whatsapp.com/send?phone=50377443807&text=Hola,%20me%20gustaría%20saber%20más%20sobre%20este%20producto.%0A%0ACodigo:<?= $row->codigo ?>%0A%0APrecio:$<?= substr($row->Precio, 7) ?>%0A%0Ahttps://plataformacesfe.com/calzados/<?= $row->imagen ?>" target="_blank" class="whatsapp">
                                                            Compra Por WhatsApp <i class="fa fa-whatsapp"></i>
                                                        </a>
                                                    </div>
                                                </small>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                <?php }
                    }
                }
                ?>

            </div>
        </div>
    </div>
</div>
<!--Ventana Modal TALLES/COLORES-->
<div class="modal fade" id="modal_tallesColores" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header modal-header-greensteel">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Tallas Disponibles</h4>
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


<script>
    function showImageModal(imageSrc) {
        // Establece la ruta de la imagen en el modal
        document.getElementById('modalImage').src = imageSrc;
        // Muestra el modal
        $('#imageModal').modal('show');
    }


    $('html, body').animate({
        scrollTop: 500
    }, 'slow'); // Se desplaza 500 píxeles hacia abajo

    function cargarProductos(idGenero) {
        // window.location.href = "kiosko/cargarProductosPorGenero/?id=" + idGenero;
        const url = new URL(window.location.origin + "/calzados/kiosko/cargarProductosPorGenero/");
        url.searchParams.set("id", idGenero); // Actualiza o agrega el parámetro `id`

        window.location.href = url.href;



        // $.ajax({
        //     url: '<?= url("ajax/kiosko/") ?>' + idGenero,
        //     method: 'GET',
        //     success: function(response) {
        //         let productos = JSON.parse(response);
        //         let productosHtml = '';

        //         productos.forEach(function(producto) {
        //             productosHtml += `
        //         <div class="col-lg-2 col-md-6 col-xs-6">
        //             <div class="panel">
        //                 <div class="panel-heading" style="min-height: 136.85px;">
        //                     <img src="/calzados/${producto.imagen}" alt="" loading="lazy" style="width: 100%; height: auto;">
        //                 </div>
        //                 <div class="panel-footer">
        //                     <span class="pull-left">${producto.nombre}</span>
        //                     <div class="clearfix"></div>
        //                 </div>
        //             </div>
        //         </div>`;
        //         });

        //         $('#productos-container').html(productosHtml);
        //     }
        // });
    }
</script>

<!-- Contenido Principal -->
<?php
include("vistas/includes/footerkiosko.php");
?>
<?php
include("vistas/includes/menuInferior.php");
?>