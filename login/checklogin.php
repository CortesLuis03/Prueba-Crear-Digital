<?php

	include('../php/conexion.php');

	$datos = json_decode(file_get_contents('php://input'));

	$codigo = $datos->codigo;
	$password = $datos->password;

	$seleccion = "*";
	$tabla = "`users`";
	$condicion = "`user_codigo` = '$codigo'";

	$filaUser = listar($seleccion, $tabla, $condicion);

	if (count($filaUser) > 0) {

		if($filaUser[0]['user_nit'] == $password){

			$validacion = iniciarSesion($codigo, $password, $filaUser);

		} else {

 			$validacion = 'Credenciales incorrectas';

		}

 	} else {

 		$validacion = 'Credenciales incorrectas';

 	}	

 	echo $validacion;

	function iniciarSesion($codigo, $pass, $datos){
			    

	    session_set_cookie_params(0);
	    session_start();

	    $_SESSION['loggedin'] = true;
	    $_SESSION['user_id'] = $datos[0]['user_id'];
	    $_SESSION['user_nombre'] = $datos[0]['user_nombre'];
	    $_SESSION['user_codigo'] = $datos[0]['user_codigo'];
	    $_SESSION['user_nit'] = $datos[0]['user_nit'];
	    $_SESSION['rol_id'] = $datos[0]['rol_id'];
	    $_SESSION['start'] = time();
	    $_SESSION['expire'] = $_SESSION['start'] + (600 * 60);
	    
		$validacion = 'Sesion iniciada';

	 	return $validacion;

	}

?>