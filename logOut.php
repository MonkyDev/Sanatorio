<?php
session_start();
unset($_SESSION['usuario']);
unset($_SESSION['pk_user']);
unset($_SESSION['cedula']);

header("Location:index.php")
?>