<?php

	function conexion(){

		$DB_HOST = 'localhost';
		$DB_USER = 'root';
		$DB_PASSWORD = '';
		$DB_NAME = 'prueba_crear_digital';

		$mysqli = @new mysqli($DB_HOST,$DB_USER,$DB_PASSWORD,$DB_NAME);

		if(mysqli_connect_errno()){
			printf(error_db_connect());
			exit();
		}
		return $mysqli;


	}

	function cerrarConexion($conexion){

		mysqli_close($conexion);

	}

	function consulta($seleccion){

		$conexion = conexion();

		$resultado = $conexion->query("SELECT $seleccion");
		
		$datos = array();

		while ($row = $resultado->fetch_assoc()){

			$datos[] = $row;

		}

		cerrarConexion($conexion);

		return $datos;

	}

	function lista($seleccion, $tabla){

		$conexion = conexion();

		$resultado = $conexion->query("SELECT $seleccion FROM $tabla");

		$datos = array();

		while ($row = $resultado->fetch_assoc()){

			$datos[] = $row;

		}

		cerrarConexion($conexion);

		return $datos;

	}

	function listar($seleccion, $tabla, $condicion){

		$conexion = conexion();

		$resultado = $conexion->query("SELECT $seleccion FROM $tabla WHERE $condicion");

		$datos = array();

		while ($row = $resultado->fetch_assoc()){

			$datos[] = $row;

		}

		cerrarConexion($conexion);

		return $datos;

	}

	function insertar($tabla, $campos, $valores){

		$conexion = conexion();

		$resultado = $conexion->query("INSERT INTO $tabla($campos) VALUES($valores)");		

		cerrarConexion($conexion);

	}

	function update($tabla,$valores,$condicion){

		$conexion = conexion();

		$resultado = $conexion->query("UPDATE $tabla SET $valores WHERE $condicion");

		cerrarConexion($conexion);

	}

	function down($tabla, $condicion){

		$conexion = conexion();

		$resultado = $conexion->query("DELETE FROM $tabla WHERE $condicion");

		cerrarConexion($conexion);

	}

	function utf8_converter($array){

	    array_walk_recursive($array, function(&$item, $key){

		    if(!mb_detect_encoding($item, 'utf-8', true)){

		    	$item = utf8_encode($item);

		    }
		    
	    });

	    return $array;

  	}
  	
?>