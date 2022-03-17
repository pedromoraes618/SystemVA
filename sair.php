<?php 
session_start();
unset($_SESSION["user_portal"]);
header("Location: ../../SystemVA/Login.php");
?>