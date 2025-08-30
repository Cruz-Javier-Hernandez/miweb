<?php

use \vista\Vista;
use \App\modelo\Facturas;
use \App\modelo\Proveedor;

class FacturasController
{

	//ruta principal retorna el listado de Facturases
	public function index()
	{
		$cantidad_pagos = 1;
		$data = Facturas::where("Activo", 1);
		return Vista::crear("facturas.index", array(
			"facturas" => $data,
			"cantidad_pagos" => $cantidad_pagos
		));
	}

	public function crear()
	{
		return Vista::crear("facturas.crear");
	}

	public function crearFacturas()
	{
		// SAVE IMAG
		if ($_FILES["factura_foto"]["error"] === UPLOAD_ERR_OK) {
			$nombreArchivo = $_FILES["factura_foto"]["name"];
			$ruta = "assets/img/Facturas/" . $nombreArchivo;

			// Mover el archivo desde la ubicación temporal al destino deseado
			if (move_uploaded_file($_FILES["factura_foto"]["tmp_name"], $ruta)) {
				echo "El archivo se ha subido correctamente.";
			} else {
				echo "Hubo un error al subir el archivo.";
			}
		} else {

			echo "Error al subir el archivo. Código de error: " . $_FILES["factura_foto"]["error"];
		}
		$Facturas 					= new Facturas();
		$Facturas->id_proveedor 	= input("txtIdprovedor");
		$Facturas->nroFactura 		= input("txtNfacturas");
		$Facturas->SucursalID 		= input("txtIdSucursal");
		$Facturas->total_pagar 		= input("txtpago");
		$Facturas->fecha_Registro 	= date("Y-m-d H:i:s");
		$Facturas->fecha_fin 		= input("txtFecha");
		$Facturas->fecha_inicio 	= input("txtFechainicio");
		$Facturas->Activo 			= 1;
		$Facturas->estado 			= "Emitida";
		$Facturas->imagen 			= $ruta;
		$Facturas->LogUsuarioID    	= $_SESSION["id"];
		$Facturas->guardar();
		redireccionar("/facturas");
	}

	public function eliminar()
	{
		$Facturas = Facturas::find(input("id"));
		if ($Facturas->eliminar()) {
			redireccionar("/facturas");
		} else {

			$Facturas->Activo		= 0;
			$Facturas->guardar();
			redireccionar("/facturas");
		}
	}

	public function editar()
	{
		$Facturas = Facturas::find(input("id_factura"));
		return Vista::crear("facturas.editar", array(
			"facturas" 		=> $Facturas,
			"id_factura" 	=> input("id_factura")
		));
	}

	public function canceladaFacturas()
	{
		$Facturas 			= Facturas::find(input("id"));
		$Facturas->estado 	= "Cancelada";
		$Facturas->guardar();
		redireccionar("/facturas");
	}

	public function editarFacturas()
	{
		// SAVE IMAG
		if ($_FILES["factura_foto"]["error"] === UPLOAD_ERR_OK) {
			$nombreArchivo = $_FILES["factura_foto"]["name"];
			$ruta = "assets/img/Facturas/" . $nombreArchivo;

			// Mover el archivo desde la ubicación temporal al destino deseado
			if (move_uploaded_file($_FILES["factura_foto"]["tmp_name"], $ruta)) {
				echo "El archivo se ha subido correctamente.";
			} else {
				echo "Hubo un error al subir el archivo.";
			}
		} else {

			echo "Error al subir el archivo. Código de error: " . $_FILES["factura_foto"]["error"];
		}
		$Facturas 					= Facturas::find(input("id"));
		$Facturas->id_proveedor 	= input("txtIdprovedor");
		$Facturas->nroFactura 		= input("txtNfacturas");
		$Facturas->SucursalID 		= input("txtIdSucursal");
		$Facturas->total_pagar 		= input("txtpago");
		//$Facturas->fecha_Registro 	= date("Y-m-d H:i:s");
		$Facturas->estado 			= "Editada";
		$Facturas->fecha_inicio 	= input("txtFechainicio");
		$Facturas->fecha_fin 		= input("txtFecha");
		$Facturas->imagen 			= $ruta;

		$Facturas->guardar();
		redireccionar("/facturas");
	}

	public function cantidad()
	{
		$Facturas = Facturas::where("Activo", 1);
		$cantidad = count($Facturas);
		echo $cantidad;
	}
	public function cantidad_pagos()
	{
		$facturas = Facturas::where("Activo", 1);
		$cantidad_pagos = count($facturas);
		echo $cantidad_pagos;
	}
}
