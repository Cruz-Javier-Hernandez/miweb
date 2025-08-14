<?php

use \vista\Vista;
use \App\modelo\Usuario;
use \App\modelo\Correos;
use \App\modelo\vista_Correos;

class UsuarioController
{
    public function index()
    {
        $data = Usuario::where("Activo", 1);
        return Vista::crear("usuarios.index", array(
            "usuarios" => $data
        ));
    }

    public function crear()
    {
        return Vista::crear("usuarios.crear");
    }

    public function crearusuario()
    {
        $usuario                = new Usuario();
        $usuario->user          = input("txtUser");
        $usuario->nomyape       = input("txtNomyApe");
        $usuario->pass          = crypt(input("txtPassword"));
        $usuario->direccion     = input("txtDireccion");
        $usuario->telefono      = input("txtTelefono");
        $usuario->email         = input("txtEmail");
        $usuario->privilegio    = input("txtPrivilegio");
        $usuario->guardar();
        session_start();
        session_destroy();
        redireccionar("/login");
    }

    public function editar()
    {
        $usuario    = Usuario::find(input("id"));
        $Correo     = vista_Correos::where('id_usuario', input("id"));
        // print_r($Correo).die;
        return Vista::crear("usuarios.editar", array(
            "usuario" => $usuario,
            "correos" => $Correo
        ));
    }

    public function editarusuario()
    {
        $usuario            = Usuario::find(input("id"));
        $usuario->nomyape   = input("txtNomyApe");
        $usuario->user      = input("txtUser");
        $usuario->direccion = input("txtDireccion");
        $usuario->telefono  = input("txtTelefono");
        $usuario->pass       = crypt(input("password"));
        // Accedemos directamente a $_POST para capturar el array de correos
        $emails             = $_POST['txtEmail'] ?? []; // Verificar que exista el array de correos
        // Verificamos si el array de correos tiene al menos un correo
        if (!empty($emails)) {
            $usuario->email = $emails[0]; // Usamos el primer correo como el principal
        }
        $usuario->privilegio = input("txtPrivilegio");
         $usuario->guardar();

        $correosEliminados = input("correosEliminados"); // Traer el campo hidden
        $correosEliminadosArray = explode(",", $correosEliminados); // Convertir a array

        // Eliminar correos que estaban en el array de correos eliminados
        // if (!empty($correosEliminadosArray)) {
        //     foreach ($correosEliminadosArray as $row) {
        //         $correo1                 = Correos::where('id', 20);
        //         print_r($correo1).die;
        //         $correo1->LogUsuarioID   = input("id");
        //         $correo1->Activo         = 0;
        //         $correo1->guardar();
        //     }
        // }
        // Guardar correos adicionales en la tabla de Correos
        // Correos::where('usuarioID', $usuario->id)->delete(); // Eliminar correos previos

        // Obtener solo los correos existentes
        $previos = Correos::where('usuarioID', input("id"));
        $previo = []; // Inicializar array para almacenar correos existentes

        foreach ($previos as $row) {
            if ($row->Activo == 1) {

                $previo[] = $row->email;
            }
        }

        // foreach ($emails as $email) {
        //     // Comprobar si el correo ya existe en el array de correos previos
        //     if (!in_array($email, $previo)) {
        //         $correo                 = new Correos();
        //         $correo->usuarioID      = input("id");
        //         $correo->fecha_registro = date("Y-m-d H:i:s");
        //         $correo->email          = $email;
        //         $correo->LogUsuarioID   = input("id");
        //         $correo->Activo         = 1;
        //         $correo->guardar();
        //     }
        // }
        redireccionar("/usuarios");
    }


    //solo para que cada usuario pueda cambiar sus datos y pass
    public function editar_perfil()
    {
        $usuario    = Usuario::find(input("id"));
        return Vista::crear("usuarios.editar_perfil", array(
            "usuario" => $usuario,

        ));
    }

    //solo para que CADA usuario pueda cambiar sus datos y pass
    public function editarperfilusuario()
    {
        $usuario                = Usuario::find(input("id"));
        $usuario->user          = $usuario->user;
        $usuario->nomyape       = input("txtNomyApe");
        $usuario->pass          = crypt(input("txtPassword"));
        $usuario->direccion     = input("txtDireccion");
        $usuario->telefono      = input("txtTelefono");
        $usuario->email         = input("txtEmail");
        $usuario->privilegio    = $usuario->privilegio;
        $usuario->guardar();
        session_start();
        session_destroy();
        redireccionar("/login");
    }

    public function eliminar()
    {
        //es para el caso que un usuario logueado se autoelimina, el sistema sale al login
        if (input("id") == $_SESSION["id"]) {
            $usuario = Usuario::find(input("id"));
            $usuario->eliminar();
            redireccionar("/login");
        } else {
            $usuario = Usuario::find(input("id"));
            $usuario->eliminar();

            redireccionar("/usuarios");
        }
    }

    public function cantidad()
    {
        $usuario = Usuario::where("Activo",1);
        $cantidad = count($usuario);
        echo $cantidad;
    }
}
