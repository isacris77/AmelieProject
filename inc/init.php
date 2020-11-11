<?php
$pdo = new PDO('mysql:host=localhost;dbname=amelie_nadalini','root','',
array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING,
    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'

));
session_start();
define('RACINE_SITE', '/amelieProject/');
$contenu ='';
require_once 'functions.php';