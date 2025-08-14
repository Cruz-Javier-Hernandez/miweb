<?php

use \vista\Vista;
use \App\modelo\Producto;
use \App\modelo\Log_precios;
use \App\modelo\Existencia;

include_once("app/controlador/CorreoController.php");
class ProductoController
{
	public function index()
	{
		$data = Producto::all();
		return Vista::crear("productos.index", array("productos" => $data));
	}

	public function crear()
	{
		return Vista::crear("productos.crear");
	}
	// CREATE PRODUCT NEW
	public function crearproducto()
	{
		// SAVE IMAG
		if ($_FILES["producto_foto"]["error"] === UPLOAD_ERR_OK) {
			$nombreArchivo = $_FILES["producto_foto"]["name"];
			$ruta = "assets/img/Producto/" . $nombreArchivo;

			// Mover el archivo desde la ubicación temporal al destino deseado
			if (move_uploaded_file($_FILES["producto_foto"]["tmp_name"], $ruta)) {
				echo "El archivo se ha subido correctamente.";
			} else {
				echo "Hubo un error al subir el archivo.";
			}
		} else {

			echo "Error al subir el archivo. Código de error: " . $_FILES["producto_foto"]["error"];
		}
	
		$producto 					= new Producto();
		$producto->codigo 			= strtoupper(input("txtCodigo"));
		$producto->nombre 			= input("txtNombre");
		$producto->idGenero 		= input("txtIdGenero");
		$producto->idRubro 			= input("txtIdRubro");
		$producto->idCategoria 		= input("txtIdCategoria");
		$producto->idMarca 			= input("txtIdMarca");
		$producto->controlTalles 	= strtoupper(input("txtControlTalles"));
		$producto->controlColores 	= strtoupper(input("txtControlColores"));
		$producto->precioCompra 	= input("txtPrecioCompra");
		$producto->precioVenta 		= input("txtPrecioVenta");
		//$producto->formato_codigo = input("formatoCodeBar");
		$producto->FechaRegistro 	= date("Y-m-d H:i:s");
		$producto->LogUsuarioID 	= $_SESSION["id"];
		$producto->imagen 			= $ruta;
		$producto->guardar();
		//obtengo el id del ultimo registro
		$productos 			= Producto::all();
		if (end($productos) == false) { //si no hay productos
			$producto->id = 1;
		} else {
			$ultimo 		= end($productos);
		}
		//para Tabla existencias
		$arrayCantidades 	= json_decode($_POST['txtArrayCantidades'], true);
		$cant_array 		= count($arrayCantidades);
		$cant_subarray 		= count($arrayCantidades[0]);
		for ($i = 0; $i < $cant_array; $i++) {
			$existencia 				= new Existencia();
			$existencia->idProducto 	= $ultimo->id;
			$existencia->codProducto 	= $producto->codigo;
			$existencia->LogUsuarioID 	= $_SESSION["id"];
			for ($j = 0; $j < $cant_subarray; $j++) {
				switch ($j) {
					case 0:
						$existencia->talle = $arrayCantidades[$i][$j];
						break;
					case 1:
						$existencia->color = $arrayCantidades[$i][$j];
						break;
					case 2:
						$existencia->stock = $arrayCantidades[$i][$j];
						break;
				}
			}
			$existencia->guardar();
		}
		$Correo = new CorreoController();
		$Correo->notificacion("Producto", $producto->codigo);
		redireccionar("/productos");
	}
	// DELETE PRODUCTO 
	public function eliminar()
	{
		$producto = Producto::find(input("id"));
		$producto->eliminar();
		redireccionar("/productos");
	}
	//update producto
	public function editar()
	{
		$producto 			= Producto::find(input("id"));
		return Vista::crear("productos.editar", array("producto" => $producto));
	}
	//Historial de cambios 
	public function HistorialProducto()
	{
		$producto 			= Producto::find(input("codigo"));
		return Vista::crear("productos.HistorialProducto", array("producto" => $producto));
	}
	// UPDATE PRODUCTO 
	public function editarproducto()
	{
		//print_r(input("txtNombre")).die;		
		if ($_FILES["producto_foto"]["error"] === UPLOAD_ERR_OK) {
			$nombreArchivo = $_FILES["producto_foto"]["name"];
			$ruta = "assets/img/Producto/" . $nombreArchivo;

			// Mover el archivo desde la ubicación temporal al destino deseado
			if (move_uploaded_file($_FILES["producto_foto"]["tmp_name"], $ruta)) {
				echo "El archivo se ha subido correctamente.";
			} else {
				echo "Hubo un error al subir el archivo.";
			}
		} else {

			echo "Error al subir el archivo. Código de error: " . $_FILES["producto_foto"]["error"];
		}
		$now_timne 	= date("Y-m-d H:i:s");
		$producto 	= Producto::find(input("id"));
		//LOG DE PRECIO DE COMPRA Y VENTA
		if (($producto->precioCompra === input("txtPrecioCompra")) && ($producto->precioVenta == input("txtPrecioVenta")) && ($producto->precioCompraunidad == input("txtprecioCompraunidad"))) {
		} else {
			$log 						= new Log_precios();
			$log->productos_id 			= input("id");
			$log->precioCompra 			= input("txtPrecioCompra");
			$log->precioVenta 			= input("txtPrecioVenta");
			$log->preciocompraunidad 	= input("txtprecioCompraunidad");
			$log->FechaRegistro 		= $now_timne;
			$log->guardar();
		}

		$producto->codigo 				= strtoupper(input("txtCodigo"));
		$producto->nombre 				= input("txtNombre");
		//$producto->idRubro 			= input("txtIdRubro");en la edición no se puede modificar el rubro		
		//$producto->idGenero 			= input("txtIdGenero");en la edición no se puede modificar el genero			
		//$producto->idCategoria 		= input("txtIdCategoria");en la edición no se puede modificar el categoria				
		$producto->idMarca 				= input("txtIdMarca");
		$producto->precioCompra 		= input("txtPrecioCompra");
		$producto->precioVenta 			= input("txtPrecioVenta");
		$producto->precioCompraunidad 	= input("txtprecioCompraunidad");
		// $producto->Actualizado_Por 		= $_SESSION["privilegio"];
		$producto->formato_codigo 		= input("formatoCodeBar"); //nuevo codigo de barras   
		$producto->imagen 				= $ruta;
		$producto->LastUpdateID 		= $_SESSION["id"];

		if ($producto->guardar()) {
		}
		//para Tabla existencias
		$arrayCantidades 				= json_decode($_POST['txtArrayCantidades'], true);
		$cant_array 					= count($arrayCantidades);
		$cant_subarray 					= count($arrayCantidades[0]);

		//obtenemos todos los ids del producto a editar
		$existencias = Existencia::all();
		$arrayProductos = [];
		foreach ($existencias as $dato) {
			if ($dato->idProducto == input("id")) {
				$arrayProductos[] = $dato->id;
			}
		}


		//editamos el grupo de IDs del producto	
		foreach ($arrayProductos as $key => $val) {
			//echo "ID :".$arrayProductos[$key]."-";
			$existencia = Existencia::find($arrayProductos[$key]);
			//print_r($existencia).die;																		

			for ($i = 0; $i < $cant_array; $i++) {
				if ($existencia->talle == $arrayCantidades[$i][0] && $existencia->color == $arrayCantidades[$i][1]) {
					$existencia->idProducto 	= input("id");
					$existencia->talle 			= $arrayCantidades[$i][0];
					$existencia->color 			= $arrayCantidades[$i][1];
					$existencia->stock 			= $arrayCantidades[$i][2]; //indice 2 es de stock								
					$existencia->Style 			= $arrayCantidades[$i][3];
					$existencia->LastUpdateID 			= $_SESSION["id"];
					//echo $producto->codigo." - ".$arrayCantidades[$i][0]." - ".$arrayCantidades[$i][1]." - ".$arrayCantidades[$i][2]."<br>";
					$existencia->guardar();
				}
			}
		}

		//controla que el producto ya tiene multiples talles/colores, por lo tanto permite agregar
		//if($producto->versiones == "M"){
		if ($producto->controlTalles == "M" or $producto->controlColores == "M") {
			//nuevos colores
			$temp1 = [];
			$arrayNuevosColores = json_decode($_POST['txtArrayNuevosColores'], true);
			if ($arrayNuevosColores != null) {
				for ($i = 0; $i < count($arrayNuevosColores); $i++) {
					$res = array_keys(array_column($arrayCantidades, 1), $arrayNuevosColores[$i]);
					foreach ($res as $key) {
						$temp1[] = $arrayCantidades[$key];
					}
				}
			}
			//nuevos talles
			$temp2 = [];
			$arrayNuevosTalles = json_decode($_POST['txtArrayNuevosTalles'], true);
			if ($arrayNuevosTalles != null) {
				for ($i = 0; $i < count($arrayNuevosTalles); $i++) {
					$res = array_keys(array_column($arrayCantidades, 0), $arrayNuevosTalles[$i]);
					foreach ($res as $key) {
						$temp2[] = $arrayCantidades[$key];
					}
				}
			}

			$nuevos = array_map("unserialize", array_unique(array_map("serialize", array_merge($temp1, $temp2))));
			foreach ($nuevos as $nuevo) {
				$existencia = new Existencia();

				//guardo en tabla existencias
				$existencia->idProducto 	= input("id");
				$existencia->codProducto 	= $producto->codigo;
				$existencia->talle 			= $nuevo[0];
				$existencia->color 			= $nuevo[1];
				$existencia->stock 			= $nuevo[2];
				$existencia->LogUsuarioID 	= $_SESSION["id"];
				//$existencia->Style = input("color");					
				//echo input("id")." - ".$producto->codigo." - ".$nuevo[0]." - ".$nuevo[1]." - ".$nuevo[2]."<br>";
				$existencia->guardar();
			}
		}

		redireccionar("/productos");
	}

	public function cantidad()
	{
		$producto = Producto::all();
		$cantidad = count($producto);
		echo $cantidad;
	}
	public function cantidad_pares()
	{
		$pares = Existencia::all();
		$cantidadTotal = 0; // Inicializar la cantidad total

		foreach ($pares as $row) {
			if ($row->talle <> "UNICA" &&  $row->Activo = 1 && $row->color <> "UNICA") {

				$cantidadTotal += $row->stock; // Sumar el stock de cada producto
			}
		}

		echo $cantidadTotal; // Imprimir la cantidad total de stock
	}

	public function listado()
	{
		$productos = Producto::all();
		foreach ($productos as $productos) {
			echo $productos->nombre;
			echo $productos->stock . "<br>";
		}
	}
}
