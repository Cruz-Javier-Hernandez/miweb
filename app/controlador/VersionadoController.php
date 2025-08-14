<?php
use \App\modelo\Reporte; 
use \vista\Vista;

class VersionadoController {

    public function index(){
        return Vista::crear("reportes.index");
    }
       
    public function reportes(){
        return Vista::crear("reportes.reportes");
    }
}