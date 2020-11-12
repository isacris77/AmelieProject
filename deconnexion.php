<?php


require_once 'inc/init.php';

session_start();
$_SESSION = array();
session_destroy();
header("Location: connexion.php");




require_once 'inc/header.php';

?>