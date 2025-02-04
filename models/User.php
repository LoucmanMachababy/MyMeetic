<?php
class User {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function login($mail, $password) {
        $checkUser = $this->db->prepare('SELECT mail, mdp FROM User WHERE mail = ?');
        $checkUser->execute([$mail]);
        if ($checkUser->rowCount() > 0) {
            $userInfos = $checkUser->fetch();
            if (password_verify($password, $userInfos['mdp'])) {
                return $userInfos;
            }
        }
        return false;
    }

    public function register($mail, $firstname, $lastname, $password, $gender, $city, $hobbies, $birthday) {
        try {
            if ($this->checkIfUserExists($mail)) {
                return 'L’utilisateur existe déjà.';
            }
            $this->insertUser($mail, $firstname, $lastname, password_hash($password, PASSWORD_DEFAULT), $gender, $city, $hobbies, $birthday);
            return true;
        } catch (PDOException $e) {
            return 'Erreur lors de l’inscription : ' . $e->getMessage();
        }
    }

    // Les méthodes privées restent inchangées mais sont incluses dans cette classe
}
?>