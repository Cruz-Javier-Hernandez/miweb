<?php

use App\modelo\Usuario;
use \App\modelo\vista_Correos;
use \vista\Vista;

// Llamada de los usuarios en la base de datos, una sola vez
class CorreoController
{
    // Función para enviar notificaciones generales
    public function notificacion($proceso, $detalle)
    {
        // Datos de correo
        $header  = "From: calzadoalexander503@gmail.com" . "\r\n";
        $header .= "X-Mailer: PHP/" . phpversion();
        // Casos de notificación dependiendo del proceso
        switch ($proceso) {
            case 'Producto':
                $asunto = "Nuevo Producto Registrado";
                $msgTemplate = "Nuevo Producto Registrado con el código: " . $detalle . ",
                Registrado Por el Usuario: ".$_SESSION["nomyape"]."";
                break;
            case 'venta':
                $asunto = "Nueva Venta";
                $msgTemplate = "Nueva Venta Registrada con los productos <strong>" . $detalle . "</strong>";
                break;
            case 'pedidos':
                $asunto = "Nuevo Pedido Registrado";
                $msgTemplate = "Hola [Nombre],

            Te escribo para notificarte que un 
            Nuevo Pedido Registrado con el producto 
            < $detalle >
            
            Gracias por tu atención.
    
            Saludos cordiales,
           ";

                break;

            default:
                // Si el proceso no coincide con ninguno de los casos
                return;
        }
        $correo = Usuario::where("Activo",1);

        foreach ($correo as $row) {
            // Reemplazar [Nombre] por el nombre real del usuario
            $msg    = str_replace('[Nombre]', $row->nomyape, $msgTemplate);
            // Obtener el correo electrónico del usuario
            $email  = $row->email;
            // Enviar el correo
            $mail   = @mail($email, $asunto, $msg, $header);
        }

        if ($mail) {
            echo "<h4>¡Correo enviado exitosamente!</h4>";
        } else {
            echo "<h4>Error al enviar el correo.</h4>";
        }
    }

    // Función para enviar notificaciones de calendario
    public function notificacion_Calendario($evento, $fecha)
    {
        $correos_correos = vista_Correos::all();
        $correos_ususarios = Usuario::where("Activo",1);
        // Datos de correo
        $header  = "From: calzadoalexander503@gmail.com" . "\r\n";
        $header .= "X-Mailer: PHP/" . phpversion();
        $fechas = "<" . $fecha . ">";
        $eventos = "<" . $evento . ">";
        $asunto = "Recordatorio: Evento de Calendario";
        $msgTemplate = "Hola [Nombre],

    Te escribo para recordarte que la fecha programada para $eventos el $fechas.
    
    Por favor, asegúrate de realizar alguna acción antes que finalize la fecha límite. Si necesitas más información , no dudes en entrar a https://plataformacesfe.com/calzados/admin
    
    Gracias por tu atención.
    
    Saludos cordiales,
   ";

        foreach ($correos_correos as $row) {
            // Reemplazar [Nombre] por el nombre real del usuario
            $msg = str_replace('[Nombre]', $row->Usuario, $msgTemplate);
            // Obtener el correo electrónico del usuario
            $email  = $row->email;
            // Enviar el correo
            $mail = @mail($email, $asunto, $msg, $header);
        }
        foreach ($correos_ususarios as $row) {
            // Reemplazar [Nombre] por el nombre real del usuario
            $msg = str_replace('[Nombre]', $row->nomyape, $msgTemplate);
            // Obtener el correo electrónico del usuario
            $email  = $row->email;
            // Enviar el correo
            $mail = @mail($email, $asunto, $msg, $header);
        }

        if ($mail) {
            echo "<h4>¡Correo enviado exitosamente!</h4>";
        } else {
            echo "<h4>Error al enviar el correo.</h4>";
        }
    }
}
