<?php

	include('../conexion.php');

	$datos = json_decode(file_get_contents('php://input'));

	$ctrl = $datos->ctrl;

	switch ($ctrl) {

		case 'validar-electiva':

			$nombre = $datos->nombre;

			$seleccion = "*";
			$tabla = "`electivas`";
			$condicion = "`elec_nombre` = '$nombre'";

			$datos = listar($seleccion, $tabla, $condicion);

			if(count($datos) > 0){
				echo "Existe";
			} else {
				echo "No existe";
			}

		break;		
		case 'crear-electiva':

			$nombre = $datos->nombre;
			$profesor = $datos->profesor;
			$descripcion = $datos->descripcion;
			$cupos = $datos->cupos;

			$tabla = "`electivas`";
			$campos = "`elec_nombre`, `elec_profesor`, `elec_descripcion`, `elec_dis_cupo`, `elec_total_cupo`";
			$valores = "'$nombre', '$profesor', '$descripcion', $cupos, $cupos";

			insertar($tabla, $campos, $valores);

		break;
		case 'editar-electiva':

			$id = $datos->id;
			$nombre = $datos->nombre;
			$profesor = $datos->profesor;
			$descripcion = $datos->descripcion;
			$cupos = $datos->cupos;

			$seleccion = "`elec_dis_cupo`, `elec_total_cupo`";
			$tabla = "`electivas`";
			$condicion = "`elec_id` = $id";

			$datos = listar($seleccion, $tabla, $condicion);

			if($cupos > $datos[0]['elec_total_cupo']){

				$diferencia = $cupos - $datos[0]['elec_total_cupo'];
				$cupos_totales = $datos[0]['elec_total_cupo'] + $diferencia;
				$cupos_dis = $datos[0]['elec_dis_cupo'] + $diferencia;

			} else if($cupos < $datos[0]['elec_total_cupo']){

				$diferencia = $datos[0]['elec_total_cupo'] - $cupos;
				$cupos_totales = $datos[0]['elec_total_cupo'] - $diferencia;
				$cupos_dis = $datos[0]['elec_dis_cupo'] - $diferencia;

			} else if($cupos == $datos[0]['elec_total_cupo']){

				$cupos_totales = $datos[0]['elec_total_cupo'];
				$cupos_dis = $datos[0]['elec_dis_cupo'];

			}

			$tabla = "`electivas`";
			$valores = "`elec_nombre`='$nombre', `elec_profesor`='$profesor', `elec_descripcion`='$descripcion', `elec_dis_cupo`=$cupos_dis, `elec_total_cupo`=$cupos_totales";
			$condicion = "`elec_id` = $id";

			update($tabla, $valores, $condicion);

		break;
		case 'remover':

			$id = $datos->id;

			$tabla = "`electivas`";
			$condicion = "`elec_id`=$id";

			down($tabla, $condicion);

		break;

	}

?>