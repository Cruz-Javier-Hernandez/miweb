<?php

use \App\modelo\Parametro;

$parametro = Parametro::find(1); //para que me traiga los param de la moneda
include("vistas/includes/menuSupLimpio.php");

?>
<div id="page-wrapper" style="padding-top: 0px;">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h3 class="hstyle">CALENDARIO DE EVENTOS</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-2 col-md-4 col-sm-6 col-xs-12">
                <a class="btn btn-primary pull-left " href="<?php echo htmlspecialchars($_SERVER['HTTP_REFERER']); ?>"><i class="fa fa-home" aria-hidden="true" placeholder="Home"></i></a>
            </div>
        </div>
        <br>
        <div class="row">

            <div class="col"></div>
            <div class="col-7">
                <div id="Calendarioweb"></div>
            </div>
            <div class="col"></div>
        </div>
    </div>
</div>
<!-- code of javascript -->
<script>
    $(document).ready(function() {
        var dataFromPhp = <?php echo $json; ?>;
        var NuevoEvento;
        // Pasar la variable PHP a una variable JavaScript
        $('#Calendarioweb').fullCalendar({
            header: {
                left: 'today,prev,next',
                center: 'title',
                right: 'month, basicWeek, basicDay'
            },
            dayClick: function(date, jsEvent, view) {
                $('#btnAgregar').fadeIn('fast');
                $('#btnEliminar').fadeOut('fast');
                $('#btnModificar').fadeOut('fast');
                limpiarFormulario();
                $('#txtFecha').val(date.format());
                $("#ModalEventos").modal();
            },
            events: dataFromPhp,
            eventClick: function(calEvent, jsEvent, view) {
                $('#btnAgregar').fadeOut('fast');
                $('#btnEliminar').fadeIn('fast');
                $('#btnModificar').fadeIn('fast');

                $('#txtTitulo').val(calEvent.title);
                $('#txtDescripcion').val(calEvent.descripcion);
                $('#txtID').val(calEvent.id);
                $('#ModalEventos').modal();
            }
        });

        $('#btnAgregar').click(function() {
            RecolectarDatos();
            EnviarInformacion('Agregar', NuevoEvento);
        });

        $('#btnEliminar').click(function() {
            RecolectarDatos();
            EnviarInformacion('Eliminar', NuevoEvento);
        });
        $('#btnModificar').click(function() {
            RecolectarDatos();
            EnviarInformacion('Modificar', NuevoEvento);
        });
        $('#btnCancelar').click(function() {
            $("#ModalEventos").modal('toggle');
        });

        function RecolectarDatos() {
            NuevoEvento = {
                id: $('#txtID').val(),
                title: $('#txtTitulo').val(),
                start: $('#txtFecha').val(),
                end: $('#txtFecha').val(),
                descripcion: $('#txtDescripcion').val()
            };
        }

        function EnviarInformacion(accion, objEvento) {
            $.ajax({
                type: 'POST',
                url: '<?php echo url("ajax/Calendario/") ?>' + accion,
                data: objEvento,
                success: function(rs) {
                    if (rs.done) {
                        //$("#Calendarioweb").fullCalendar('refetchEvents');
                        //$("#ModalEventos").modal('toggle');
                        location.reload();
                    }
                },
                error: function() {
                    alert("Hay un error.");
                }
            });
        }

        function limpiarFormulario() {
            $('#txtTitulo').val('');
            $('#txtDescripcion').val('');
            $('#txtID').val('');
        }
    });
</script>
<!-- Modal(agregar, modificar) -->
<div class="modal fade" id="ModalEventos" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fs-5" id="tituloEvento">NUEVA NOTA</h5>
            </div>
            <div class="modal-body">
                <input type="hidden" name="txtID" id="txtID">
                <div class="form-row">
                    <div class="form-group col-md-8">
                        <label for="Title">Titulo:</label>
                        <input type="text" name="txtTitulo" id="txtTitulo" class="form-control" placeholder="Titulo de Evento">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="Fecha"> Fecha:</label>
                        <input type="text" name="txtFecha" id="txtFecha" disabled class="form-control">
                    </div>

                    <div class="form-group ">
                        <label for="descripcion">Descripcion:</label>
                        <textarea name="txtDescripcion" id="txtDescripcion" cols="30" rows="3" class="form-control"></textarea>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnAgregar" class="btn btn-success">Agregar</button>
                <button type="button" id="btnModificar" class="btn btn-primary">Modificar</button>
                <button type="button" id="btnEliminar" class="btn btn-danger">Borrar</button>
                <button type="button" id="btnCancelar" class="btn btn-default" data-bs-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>