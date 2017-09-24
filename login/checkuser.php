<?php

	include('../php/conexion.php');

	$datos = json_decode(file_get_contents('php://input'));

	$ctrl = $datos->ctrl;

	switch ($ctrl) {

		case 'validar-usuario':

			$codigo = $datos->codigo;

			$seleccion = "*";
			$tabla = "`users`";
			$condicion = "`user_codigo` = '$codigo'";

			$datos = listar($seleccion, $tabla, $condicion);

			if(count($datos) > 0){
				echo "Existe";
			} else {
				echo "No existe";
			}
			
		break;
		case 'crear-usuario':

			$nombre = $datos->nombre;
			$codigo = $datos->codigo;
			$documento = $datos->documento;

			$tabla = "`users`";
			$campos = "`user_nombre`, `user_codigo`, `user_nit`, `rol_id`";
			$valores = "'$nombre', '$codigo', '$documento', 2";

			insertar($tabla, $campos, $valores);

		break;

	}

?>