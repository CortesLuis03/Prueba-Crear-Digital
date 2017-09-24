<?php

  	session_start();

  	if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {

  		echo "<script language='javascript'>window.location='../'</script>";

	} else {

?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="../css/materialize.css">
	<link rel="stylesheet" type="text/css" href="../css/icons.css">
	<link rel="stylesheet" type="text/css" href="../css/mycss.css">
	<link rel="stylesheet" type="text/css" href="../css/sweetalert.css">
	<script type="text/javascript" src="../js/angularjs.js"></script>
	<script type="text/javascript" src="../js/jquery.js"></script>
	<script type="text/javascript" src="../js/materialize.js"></script>
	<script type="text/javascript" src="../js/sweetalert.js"></script>
	<script type="text/javascript" src="app.js"></script>
	<title>Login</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta charset="utf-8">
	<link href="../images/favicon.png" rel="icon" type="image/png" />
</head>
<body ng-app="appLogin">
	<div class="container" ng-controller="controladorLogin">
		<div class="row">
			<div class="col m6 offset-m3">
				<form class="form-login" ng-show="formulario">
					<div class="row">
						<div class="col s8 offset-s2">
							<img class="responsive-img" src="../images/login.png">
						</div>
					</div>
					<div class="row">
						<div class="col s12">
							<h5 class="center-align">
								Ingresa tus datos
							</h5>
						</div>
					</div>
					<div class="row">
						<div class="input-field col s10 offset-s1">
				          	<input id="codigo" name="codigo" type="text" ng-model="codigo">
				          	<label for="codigo">Código universitario</label>
				        </div>
					</div>
					<div class="row">
						<div class="input-field col s10 offset-s1">
				          	<input id="password" name="password" type="password" ng-model="password" ng->
	          				<label for="password">Documento de identidad</label>
				        </div>
					</div>
					<div class="row">
						<center>
							<button class="btn waves-effect waves-light" type="submit" name="action" ng-click="validarLogin()">Ingresar
							    <i class="material-icons right">send</i>
							</button>
							<br><br>
							<a href="" ng-click="formulario = false; nombre = ''; codigo_reg = ''; documento = '';">¿Aún no estás registrado?</a>
						</center>
					</div>
				</form>
				<form class="form-login" ng-hide="formulario">
					<div class="row">
						<div class="col s8 offset-s2">
							<img class="responsive-img" src="../images/register.png">
						</div>
					</div>
					<div class="row">
						<div class="col s12">
							<h5 class="center-align">
								Ingresa tus datos
							</h5>
						</div>
					</div>
					<div class="row">
						<div class="input-field col s10 offset-s1">
				          	<input id="nombre" name="nombre" type="text" ng-model="nombre">
				          	<label for="nombre">Nombre completo</label>
				        </div>
					</div>
					<div class="row">
						<div class="input-field col s10 offset-s1">
				          	<input id="codigo_reg" name="codigo_reg" type="text" ng-model="codigo_reg">
				          	<label for="codigo_reg">Código universitario</label>
				        </div>
					</div>
					<div class="row">
						<div class="input-field col s10 offset-s1">
				          	<input id="documento" name="documento" type="text" ng-model="documento">
	          				<label for="documento">Documento de identidad</label>
				        </div>
					</div>
					<div class="row">
						<center>
							<button class="btn waves-effect waves-light" type="submit" name="action" ng-click="registrarUsuario()">Enviar
							    <i class="material-icons right">send</i>
							</button>
							<br><br>
							<a href="" ng-click="formulario = true;"><i class="material-icons">arrow_back</i></a>
						</center>
					</div>
				</form>
			</div>
		</div>
	</div>
</body>
</html>
<?php

	}

?>