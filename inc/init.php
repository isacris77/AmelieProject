<?php
$bdd = new PDO('mysql:host=localhost;dbname=amelie_nadalini','root','',
);
session_start();
define('RACINE_SITE', '/amelieProject/');
$contenu ='';
require_once 'functions.php';