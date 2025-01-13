<?php
use \App\modelo\Parametro;
$parametro = Parametro::find(1); //para que me traiga los param de la moneda
include("vistas/includes/menuSupLimpio.php");
?>
<style>
    #Calendarioweb {
        max-height: none;
        /* Desactiva la altura máxima */
        overflow: visible;
        /* Asegúrate de que el contenido sea visible */
    }
    .fc {
        overflow: visible !important;
        /* Desactiva el overflow en el contenedor de FullCalendar */
    }
</style>
<div id="page-wrapper" style="/* min-height: 912px; */  padding-top: 0px;">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h3 class="hstyle">CALENDARIO</h3>
            </div>
        </div>
        <div class="row">
            <div class="col"></div>
            <div class="col-7">
                <div id="Calendarioweb"></div>
            </div>
            <div class="col"></div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        // Pasar la variable PHP a una variable JavaScript
        var dataFromPhp = <?php echo $json; ?>;
        $('#Calendarioweb').fullCalendar({
            header: {
                left: 'today,prev,next',
                center: 'title',
                right: 'month, basicWeek, basicDay'
            },
            // eventSources: [{
            //     color: "black",
            //     texcolor: "yellow"
            // }],
            events: <?php echo $json; ?>,
            eventClick: function(calEvent, jsEvent, view) {
                $('#tituloEvento').html(calEvent.title);
                $('#descripcion').html(calEvent.descripcion);
                $('#exampleModal').modal();
            }
        });
        var calendarEl = document.getElementById('Calendarioweb');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth', // Vista inicial del calendario
            contentHeight: 'auto', // Ajusta la altura automáticamente
            // Otras configuraciones del calendario
        });
    });
</script>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fs-5" id="tituloEvento"></h5>
            </div>
            <div class="modal-body">
                <div id="descripcion"></div>
            </div>
        </div>
    </div>
</div>
