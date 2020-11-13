<?php
$bdd = new PDO('mysql:host=127.0.0.1;dbname=amelie_nadalini','root','');
session_start();
define('RACINE_SITE', '/amelieProject/');
$contenu ='';
require_once 'functions.php';