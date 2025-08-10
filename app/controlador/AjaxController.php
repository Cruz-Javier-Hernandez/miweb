<?php
class AjaxController
{ 
    private $folder = 'ajax';
    public function Pedidos($primero)
    {
       require("assets/controllers/ajax/action_marcas.php");

    }
    public function Calendario($primero)
    {
       require("assets/controllers/ajax/action_guardar_evento.php");
    }
    public function kiosko($primero)
    {
       require("assets/controllers/ajax/action_Kiosko.php");
    }
}