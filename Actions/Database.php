<?php

$server = "localhost";
$user = "phpmyadmin";
$password = "Mouslime74";

try {
    session_start();
    $bdd = new PDO("mysql:host=$server;dbname=Afrika", "$user", "$password");
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
} catch (PDOException $e) {
    echo 'Echec : ' . $e->getMessage();
}
