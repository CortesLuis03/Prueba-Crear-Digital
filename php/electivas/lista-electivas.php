<?php

	include('../conexion.php');

	$datos = json_decode(file_get_contents('php://input'));

	$ctrl = $datos->ctrl;

	switch ($ctrl) {
		
		case 'electivas':

			$seleccion = "*";
			$tabla = "`electivas`";

			$datos = lista($seleccion, $tabla);

			$datos = utf8_converter($datos);

			echo json_encode($datos);

		break;
		case 'electiva':

			$id = $datos->id;

			$seleccion = "*";
			$tabla = "`electivas`";
			$condicion = "`elec_id` = $id";

			$datos = listar($seleccion, $tabla, $condicion);

			$datos = utf8_converter($datos);

			echo json_encode($datos);

		break;

	}

?>