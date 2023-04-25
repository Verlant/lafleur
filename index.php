<?php

session_start();
// var_dump($_SESSION);

// Pour afficher les erreurs PHP
error_reporting(E_ALL);
ini_set("display_errors", 1);

// Attention : A supprimer en production !!!

require 'util/autoLoad.php';
// require 'util/fonctions.inc.php';
// require 'util/validateurs.inc.php';
autoLoad();

$uc = filter_input(INPUT_GET, 'uc'); // Use Case

if (!isset($uc) or empty($uc)) {
    $uc = 'accueil';
}

require("app/views/template.php");
