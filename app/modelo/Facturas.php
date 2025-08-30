<?php 
namespace App\modelo;

use libreria\ORM\Modelo;

class Facturas extends Modelo {
    protected static $table = "facturas";

    // Método para convertir el objeto a un array
    public function toArray() {
        return (array) $this->data; // Asegurando que los datos se convierten correctamente a array
		print_r($this->data).die;
    }
	
}
