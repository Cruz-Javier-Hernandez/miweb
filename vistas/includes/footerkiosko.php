</body>


<footer class="navbar container-fluid bg-dark text-light">
    <div class="row">
        <!-- Sección: Información -->
       

        <!-- Sección: Dirección y Google Maps -->
        <div class="col-md-4">
           <a><h4 class="text-uppercase">ubicacion</h4></a>
            <a class="clearfix"><i class="glyphicon glyphicon-map-marker"> </i> <?= $calzado->domicilio_comercial ?></a>
            <a class="clearfix"><i class="glyphicon glyphicon-phone"> </i> +(503) <?= $calzado->telefono ?></a>
            <a class="clearfix"><i class="glyphicon glyphicon-envelope"> </i> <?= $calzado->email ?></a>

            <!-- Mapa de Google -->
            <div style="margin-top: 15px;">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3873.941354685093!2d-88.85327372571423!3d13.842558786558845!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8f635e9605ef1a79%3A0xb00091b2d041f5bb!2sCalzado%20Alexander!5e0!3m2!1sen!2ssv!4v1732246832157!5m2!1sen!2ssv"
                    width="100%"
                    height="200"
                    style="border:0;"
                    allowfullscreen=""
                    loading="lazy">
                </iframe>
            </div>
        </div>

        <!-- Sección: Redes Sociales -->
        <div class="col-md-4">
            <a href="">
                <h4 class="text-uppercase ">Síguenos</h4>
            </a>
            <a href="https://www.facebook.com/CalzadoAlexander1?mibextid=ZbWKwL" target="_blank" class="btn btn-primary btn-sm" style="margin-right: 5px;">
                <i class="glyphicon glyphicon-thumbs-up"></i> Facebook
            </a>
            <a href="https://www.facebook.com/CalzadoAlexander1?mibextid=ZbWKwL" target="_blank" class="btn btn-danger btn-sm" style="margin-right: 5px;">
                <i class="glyphicon glyphicon-camera"></i> Instagram
            </a>
            <a href="https://wa.me/<?= $calzado->telefono ?>" target="_blank" class="btn btn-success btn-sm" style="margin-right: 5px;">
                <i class="glyphicon glyphicon-comment"></i> WhatsApp
            </a>
        </div>
    </div>
    <hr style="border-top: 1px solid #ccc;">


    <div class="row text-center">
        <div class="col-md-12">
            <p class="text-white">&copy; 2024 Calzado Alexander. Todos los derechos reservados.</p>
        </div>
    </div>
</footer>