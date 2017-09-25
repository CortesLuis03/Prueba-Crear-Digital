<?php

	include('../conexion.php');

	$datos = json_decode(file_get_contents('php://input'));

	$ctrl = $datos->ctrl;

	switch ($ctrl) {
		
		case 'usuarios':

			$criterio = $datos->criterio;

			$seleccion = "`user_nombre`, `user_codigo`, `user_id`";
			$tabla = "`users`";
			$condicion = "`rol_id` != 1 AND `user_nombre` LIKE '%".$criterio."%' OR `user_codigo` LIKE '%".$criterio."%'";

			$datos = listar($seleccion, $tabla, $condicion);

			//$datos = utf8_converter($datos);

			echo json_encode($datos);

		break;
		case 'electivas':

			$id = $datos->id;

			$seleccion = "`electivas`.`elec_nombre`";
			$tabla = "`users_x_electiva` 
						INNER JOIN `electivas` ON `electivas`.`elec_id` = `users_x_electiva`.`elec_id`";
			$condicion = "`users_x_electiva`.`user_id` = $id";

			$datos = listar($seleccion, $tabla, $condicion);

			//$datos = utf8_converter($datos);

			echo json_encode($datos);

		break;

	}

?>