<?php

class User {
    protected $bdd;

    // Constructeur pour initialiser la connexion à la base de données
    public function __construct($db) {
        $this->bdd = $db;
    }

    // Méthode pour récupérer un utilisateur par email
    public function getUserByEmail($email) {
        $stmt = $this->bdd->prepare("SELECT * FROM User WHERE mail = ?");
        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Méthode pour ajouter un utilisateur
    public function addUser($lastname, $firstname, $birthday, $gender, $city, $mail, $password, $hobbies) {
        $stmt = $this->bdd->prepare("
            INSERT INTO User (lastname, firstname, birthday, gender, city, mail, mdp, hobbies)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)
        ");
        $stmt->execute([$lastname, $firstname, $birthday, $gender, $city, $mail, $password, $hobbies]);
    }

    // Méthode pour vérifier si un email existe déjà
    public function emailExists($email) {
        $stmt = $this->bdd->prepare("SELECT * FROM User WHERE mail = ?");
        $stmt->execute([$email]);
        return $stmt->rowCount() > 0;
    }
}
