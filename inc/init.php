<?php

//connexion Ã  la base de donnÃ©es
$pdo = new pdo ('mysql :host=localhost;dbname=AmelieNadalini',
    'root',
    '',
        
    array(
        PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING,
        PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8' 
    ));

    session_start();

    //chemin du site 
    define('RACINE_SITE', '/amelieProject/');

    //variables d'affichage
    $contenu ='';


    //inclusions des fonctions
    require_once 'functions.php';

