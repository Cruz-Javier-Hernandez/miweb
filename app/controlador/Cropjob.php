<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
use \App\modelo\Calendario_eventos;
require_once '/home/u149112875/domains/plataformacesfe.com/public_html/calzados/app/controlador/CorreoController.php';
require_once '/home/u149112875/domains/plataformacesfe.com/public_html/calzados/libreria/ORM/DpORM.php';
require_once '/home/u149112875/domains/plataformacesfe.com/public_html/calzados/libreria/ORM/Modelo.php';
require_once '/home/u149112875/domains/plataformacesfe.com/public_html/calzados/app/modelo/Usuario.php';
require_once '/home/u149112875/domains/plataformacesfe.com/public_html/calzados/app/modelo/Calendario_eventos.php';

// Instancia de tu controlador
$correoController = new CorreoController();
// // Llamada a la función que deseas ejecutar
// $correoController->notificacion_Calendario('Evento importante', '2024-08-10');

$fechaActual = date('Y-m-d'); // Obtén la fecha actual en formato 'Y-m-d'
// Consultar la base de datos para obtener los eventos que coinciden con la fecha actual y no han sido notificados
$eventos = Calendario_eventos::where('end',$fechaActual);
foreach ($eventos as $row) {
    // Detalles de la notificación
        //notificacion_Calendario($row->title, $row->end);
        if ($row->Activo == 1) {
            $correoController->notificacion_Calendario($row->title, $row->end);
           
        }
}