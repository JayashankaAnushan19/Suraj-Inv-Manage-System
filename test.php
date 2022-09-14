<?php 
if (session_status() === PHP_SESSION_NONE || $_SESSION["id"] == "") {
	session_start();
	$_SESSION["uname"] = "Jayashanka";
	$_SESSION["id"] = 2;
	$_SESSION["accLvl"] = 0;
}
echo print_r($_SESSION);
?>