<?php

use \vista\Vista;
use \App\modelo\empleados;
use App\modelo\Sucursal;

class EmpleadosController
{

	//ruta principal retorna el listado de empleados
	public function index()
	{
		$data = empleados::all();
		return Vista::crear("empleados.index", array(
			"empleado" => $data
		));
	}

	public function crear()
	{
		$data = Sucursal::all();
		
		return Vista::crear("empleados.crear",array(
			"Sucursal" =>$data
		));
	}

	public function editar()
	{
		$Empleados = empleados::find(input("id"));
		return Vista::crear("empleados.editar", array(
			"Empleados" 		=> $Empleados,
			"id_empleados" 	=> input("id_empleados")
		));
	}
	public function eliminar()
	{
		$Empleados 					= empleados::find(input("id"));
		$Empleados->Activo 			= 0;
		$Empleados->guardar();
		redireccionar("/empleados");
	
	}

	public function crearEmpleados()
	{
		// SAVE IMAG
		if ($_FILES["empleado_foto"]["error"] === UPLOAD_ERR_OK) {
			$nombreArchivo = $_FILES["empleado_foto"]["name"];
			$ruta = "assets/img/Empleados/" . $nombreArchivo;

			// Mover el archivo desde la ubicación temporal al destino deseado
			if (move_uploaded_file($_FILES["empleado_foto"]["tmp_name"], $ruta)) {
				echo "El archivo se ha subido correctamente.";
			} else {
				echo "Hubo un error al subir el archivo.";
			}
		} else {

			echo "Error al subir el archivo. Código de error: " . $_FILES["empleado_foto"]["error"];
		}
		$Empleados 					= new empleados();
		$Empleados->nombre 			= input("txtnombre");
		$Empleados->SucursalID 		= input("txtIdSucursal");
		$Empleados->telefono 		= input("txttelefono");
		$Empleados->fecha_Registro 	= date("Y-m-d H:i:s");
		$Empleados->Activo 			= 1;
		$Empleados->cargo 			= input("txtcargo");
		$Empleados->imagen 			= $ruta;
		$Empleados->LogUsuarioID    = $_SESSION["id"];
		$Empleados->guardar();
		redireccionar("/empleados");
	}

	public function editarEmpleado()
	{
		// SAVE IMAG
		if ($_FILES["empleado_foto"]["error"] === UPLOAD_ERR_OK) {
			$nombreArchivo = $_FILES["empleado_foto"]["name"];
			$ruta = "assets/img/Empleados/" . $nombreArchivo;

			// Mover el archivo desde la ubicación temporal al destino deseado
			if (move_uploaded_file($_FILES["empleado_foto"]["tmp_name"], $ruta)) {
				echo "El archivo se ha subido correctamente.";
			} else {
				echo "Hubo un error al subir el archivo.";
			}
		} else {

			echo "Error al subir el archivo. Código de error: " . $_FILES["empleado_foto"]["error"];
		}
		$Empleados 					= empleados::find(input("id"));
		$Empleados->nombre 			= input("txtnombre");
		$Empleados->SucursalID 		= input("txtIdSucursal");
		$Empleados->telefono 		= input("txttelefono");
		$Empleados->Activo 			= 1;
		$Empleados->cargo 			= input("txtcargo");
		$Empleados->imagen 			= $ruta;
		$Empleados->guardar();

		redireccionar("/empleados");
	}

	
	public function cantidad(){
        $proveedor = empleados::all();
        $cantidad = count($proveedor);        
        echo $cantidad;    
    }

}
