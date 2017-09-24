<?php
	session_start();
?><!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="css/materialize.css">
	<link rel="stylesheet" type="text/css" href="css/icons.css">
	<link rel="stylesheet" type="text/css" href="css/mycss.css">
	<link rel="stylesheet" type="text/css" href="css/sweetalert.css">
	<script type="text/javascript" src="js/angularjs.js"></script>
	<script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript" src="js/materialize.js"></script>
	<script type="text/javascript" src="js/sweetalert.js"></script>
	<script type="text/javascript" src="js/pagination.js"></script>
	<script type="text/javascript" src="app/app.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.8/angular-route.js"></script>
	<title>Sistema de material electivas</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta charset="utf-8">
	<link href="images/favicon.png" rel="icon" type="image/png" />
	<script type="text/javascript">
		$(document).ready(function(){
			$(".button-collapse").sideNav();
		});
	</script>
</head>
<body ng-app="app" class="index">
	<ul id="opciones" class="dropdown-content opciones">
	  	<li class="divider"></li>
	  	<li><a href="login/logout.php">Cerrar sesión</a></li>
	</ul>
	<nav>
		<div class="nav-wrapper">
		    <a href="#/" class="brand-logo"><img class="responsive-img logo" src="images/logo.png"></a>
		    <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
		    <ul class="right hide-on-med-and-down">
		      	<li><a href="#electivas">Electivas</a></li>
		      	<li><a href="#usuarios">Usuarios</a></li>
		      	<li><a class="dropdown-button" href="#!" data-activates="opciones"><i class="material-icons right">arrow_drop_down</i></a></li>
		    </ul>
		    <ul class="side-nav" id="mobile-demo">
		    	<li>
		          	<div class="card" style="margin-top: 0px;">
		            	<div class="card-image">
		              		<img src="images/fondo.jpg">
		              		<span class="card-title"><?php echo $_SESSION['user_nombre'];?></span>
		            	</div>
		            	<div class="card-action" style="background-color: #EE6E73;">
		              		<a href="login/logout.php" style="color: #FFFFFF;">Cerrar sesión</a>
		            	</div>
		          	</div>
		      	</li>
		        <li><a href="#electivas"><i class="material-icons">check</i>Electivas</a></li>
		        <li><a href="#usuarios"><i class="material-icons">person</i>Usuarios</a></li>
		    </ul>
		</div>
	</nav>
	<div ng-view>
	</div>
</body>
</html>