<?php

session_start();

?>
<div class="row inicio">
	<div class="col m10 offset-m1 center-align">
		<h3>Bienvenido <?php echo $_SESSION['user_nombre'];?></h3>
	</div>
</div>