<?php

session_start();
session_unset();
session_destroy();

//header('Location: ../login');
echo "<script language='javascript'>window.location='../login'</script>";

?>