<?php

$server = "localhost";
$user = "phpmyadmin";
$password = "Mouslime74";

try {
    $connexion = new PDO("mysql:host=$server;dbname=Afrika", "$user", "$password");
    $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // $query = $connexion->prepare("SELECT * FROM `user`"); 

    echo 'connecter';

} catch (PDOException $e) {
    echo 'Echec : ' . $e->getMessage();
}
