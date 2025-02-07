<?php
class User {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getAllUsers() {
        try {
            $stmt = $this->db->query('SELECT * FROM User'); 
            return $stmt->fetchAll(); 
        } catch (PDOException $e) {
            return 'Erreur lors de la récupération des utilisateurs : ' . $e->getMessage();
        }
    }

    public function login($mail, $password) {
        try {

            $checkUser = $this->db->prepare('SELECT id, mail, mdp FROM User WHERE mail = ?');
            $checkUser->execute([$mail]);

            if ($checkUser->rowCount() > 0) {
                $userInfos = $checkUser->fetch();

                if (password_verify($password, $userInfos['mdp'])) {
                    return $userInfos;
                }
            }
            return false;
        } catch (PDOException $e) {
            return 'Erreur lors de la connexion : ' . $e->getMessage();
        }
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

    private function checkIfUserExists($mail) {
        try {
            $stmt = $this->db->prepare('SELECT id FROM User WHERE mail = ?');
            $stmt->execute([$mail]);
            return $stmt->rowCount() > 0;
        } catch (PDOException $e) {
            return 'Erreur lors de la vérification de l\'existence de l\'utilisateur : ' . $e->getMessage();
        }
    }

    private function insertUser($mail, $firstname, $lastname, $password, $gender, $city, $hobbies, $birthday) {
        try {
            $stmt = $this->db->prepare('INSERT INTO User (mail, firstname, lastname, mdp, gender, city, hobbies, birthday) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)');
            $stmt->execute([$mail, $firstname, $lastname, $password, $gender, $city, $hobbies, $birthday]);
        } catch (PDOException $e) {
            return 'Erreur lors de l\'insertion de l\'utilisateur : ' . $e->getMessage();
        }
    }
}
?>
