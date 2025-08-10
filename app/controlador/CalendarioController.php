<?php

use \vista\Vista;
use \App\modelo\Facturas;
use \App\modelo\Calendario;
use \App\modelo\Calendario_eventos;

include_once("app/controlador/CorreoController.php");

class CalendarioController
{
	// Ruta principal retorna el listado de Facturases
	public function factura()
	{
		$Calendario = Calendario::all();
		$result 	= [];
		foreach ($Calendario as $item) {
			//$data = $item->getData(); // Suponiendo que tienes un método getData() para obtener los datos
			$result[] = [
				'id' 			=> $item->id,
				'title' 		=> $item->title,
				'descripcion' 	=> $item->descripcion,
				'start' 		=> $item->start,
				'end'	 		=> $item->end,
				'color' 		=> $item->color,
			];
		}
		$json = json_encode($result);
		// Imprimir el JSON y detener la ejecución
		return Vista::crear("facturas.calendario", array(
			"json" => $json
		));
	}

	public function index()
	{
		$Calendario = Calendario_eventos::where("Activo", 1);
		$result 	= [];
		foreach ($Calendario as $item) {
			//$data = $item->getData(); // Suponiendo que tienes un método getData() para obtener los datos
			$result[] = [
				'id' 			=> $item->id,
				'title' 		=> $item->title,
				'descripcion' 	=> $item->descripcion,
				'start' 		=> $item->start,
				'end' 			=> $item->end,
			];
		}
		$json = json_encode($result);
		// Imprimir el JSON y detener la ejecución
		return Vista::crear("calendario.index", array(
			"json" => $json
		));
	}

	public function cantidad()
	{
		$cantidad = 0;
		$proveedor = Calendario_eventos::all();
		foreach ($proveedor as $row) {
			if ($row->end >= date("Y-m-d")) {
				$cantidad ++;
			}
		}

		echo $cantidad;
	}
	// Llamar manualmente a la función desde cualquier parte de tu código
}
