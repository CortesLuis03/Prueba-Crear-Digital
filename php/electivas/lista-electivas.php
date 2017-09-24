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
		case 'ver-inscritos':

			$id = $datos->id;

			$seleccion = "`users`.`user_nombre`, `users`.`user_codigo`";
			$tabla = "users_x_electiva
						INNER JOIN `users` ON `users`.`user_id` = `users_x_electiva`.`user_id`";
			$condicion = "`users_x_electiva`.`elec_id` = $id";

			$datos = listar($seleccion, $tabla, $condicion);

			$datos = utf8_converter($datos);

			echo json_encode($datos);

		break;
		case 'profesores':

			$seleccion = "DISTINCT `elec_profesor` as profe_nombre";
			$tabla = "`electivas`";

			$datos = lista($seleccion, $tabla);

			$datos = utf8_converter($datos);

			echo json_encode($datos);

		break;

	}

?>