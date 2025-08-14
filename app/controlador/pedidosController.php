<?php

use \vista\Vista;
use \App\modelo\Pedidos;
use \App\modelo\Producto;

include_once("app/controlador/CorreoController.php");
class PedidosController
{

    //ruta principal retorna el listado de Pedidoses
    public function index()
    {
        $data = Pedidos::all();
        return Vista::crear("pedidos.index", array(
            "pedidos" => $data
        ));
    }
    //direccion a la vista de Crear Pedidos
    public function crear()
    {
        return Vista::crear("pedidos.crear");
    }
    //funcion que reistra los pedidos a la base de datos
    public function crearPedidos()
    {
        $Pedidos                    = new Pedidos();
        $correo                     = new CorreoController();
        $Pedidos->idProducto        = input("txtcodigo");
        $Pedidos->FechaRegistro     = date("Y-m-d H:i:s");
        $Pedidos->Pendiente         = 1;
        $Pedidos->Descripcion       = input("txtDescripcion");
        $Pedidos->LogUsuarioID      = $_SESSION["id"];
        $Pedidos->guardar();
        $producto = Producto::find(input("txtcodigo"));
        $correo->notificacion("pedidos", $producto->codigo);
        redireccionar("/pedidos");
    }
    //funcion que regitra los pedidos Rechazados 
    public function rechazar()
    {
        $Pedidos = Pedidos::where("idProducto", input("id"));
        foreach ($Pedidos as $row) {
            $row->Rechazados    = 1;
            $row->Pendiente     = 0;
            $row->guardar();
            redireccionar("/pedidos");
        }
    }
    //funcion que regitra los pedidos Aprobados 
    public function aprobar()
    {
        $Pedidos = Pedidos::where("idProducto", input("id"));
        foreach ($Pedidos as $row) {
            $row->Aprobado = 1;
            $row->Pendiente = 0;
            $row->guardar();
            redireccionar("/pedidos");
        }
    }
    //funcion que regitra los pedidos Eliminados 
    public function eliminar()
    {
        $Pedidos = Pedidos::find(input("id"));

        $Pedidos->Activo        = 0;
        $Pedidos->guardar();
        redireccionar("/pedidos");
    }
    // public function eliminar(){
    // 	$Pedidos = Pedidos::find(input("id"));
    // 	$Pedidos->eliminar();
    // 	redireccionar("/Pedidoses");
    // }

    //funcion que redirecciona a vita de editar produtos los pedidos  
    public function editar()
    {
        $Pedidos = Pedidos::find(input("id"));
        return Vista::crear("Pedidos.editar", array(
            "Pedidos" => $Pedidos
        ));
    }
    //funcion que Regista las actualiciones a los regitros de la base de datos
    public function editarPedidos()
    {
        $Pedidos                    = Pedidos::find(input("id"));
        $Pedidos->razon_social      = input("txtRazonSocial");
        $Pedidos->direccion         = input("txtDireccion");
        $Pedidos->telefono          = input("txtTelefono");
        $Pedidos->email             = input("txtEmail");
        $Pedidos->cuit              = input("txtCuit");
        $Pedidos->condTributaria    = strtoupper(input("txtCondTributaria"));
        $Pedidos->guardar();
        redireccionar("/Pedidos");
    }
    //funcion de cantidad de pedidos
    public function cantidad()
    {
        $cantidad = 0;
        $Pedidos = Pedidos::all();
        foreach ($Pedidos as $row) {
            if ($row->Activo == 1 && $row->Pendiente == 1) {

                $cantidad += 1;
            }
        }

        echo $cantidad;
    }
}
