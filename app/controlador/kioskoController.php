<?php

use \vista\Vista;
use \App\modelo\Producto;
use \App\modelo\Genero;
use \App\modelo\vista_controlstock;
use \App\modelo\Parametro;

class kioskoController
{
    // Propiedad para almacenar imágenes por género
    private $imagenes;

    public function __construct()
    {
        $this->imagenes = [
            "default"  => $this->getImages("kiosko"),
            "man"      => $this->getImages("kiosko/man"),
            "woman"    => $this->getImages("kiosko/woman"),
            "childen"  => $this->getImages("kiosko/childen"),
            "boy"      => $this->getImages("kiosko/boy"),
            "madan"    => $this->getImages("kiosko/madan"),
        ];
    }

    /**
     * Método para obtener imágenes de un directorio específico
     */
    private function getImages($path)
    {
        $basePath   = RUTA_BASE . "assets/img/$path/";
        $files      = glob($basePath . "*.{jpg,png,webp}", GLOB_BRACE);
        return array_map(fn($file) => str_replace(RUTA_BASE, "", $file), $files);
    }

    /**
     * Página principal
     */
    public function index()
    {
       
        return Vista::crear("kiosko_online.index", [
            "Producto"  => Producto::where("Activo", 1),
            "Genero"    => Genero::where("Activo", 1),
            "calzado"   => Parametro::find(1),
            "primero"   => true,
            "img"       => $this->imagenes["default"]
        ]);
    }

    /**
     * Cargar productos por género
     */
    public function cargarProductosPorGenero()
    {
        $id = (int) input("id"); // Sanitiza la entrada
        $productos = vista_controlstock::where("id_genero", $id);
        $categoria = Genero::find($id);
        $genero = Genero::where("Activo", 1);
        $primero = false;

        // Definir imágenes según el género
        $mapaImagenes = [
            6  => "man",
            7  => "woman",
            8  => "boy",
            9  => "childen",
            11 => "madan",
            12 => "default",
        ];

        $img = $this->imagenes[$mapaImagenes[$id] ?? "default"];

        return Vista::crear("kiosko_online.index", [
            "Producto"      => Producto::where("Activo", 1),
            "id"            => $id,
            "Genero"        => $genero,
            "Clasificacion" => $productos,
            "Categoria"     => $categoria,
            "primero"       => $primero,
            "img"           => $img
        ]);
    }
}
