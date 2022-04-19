<?php

session_start();

if(!isset($_SESSION["user_portal"])){
   header("Location:../../../SystemVA/login.php");
}

?>