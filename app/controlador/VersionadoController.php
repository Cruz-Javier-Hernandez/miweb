<?php
use \App\modelo\Reporte; 
use \vista\Vista;

class VersionadoController {

    public function index(){
        return Vista::crear("versionado.index");
    }
}