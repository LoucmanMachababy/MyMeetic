<?php
class User
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function getAllUsers()
    {
        $stmt = $this->db->query('SELECT * FROM User');
        return $stmt->fetchAll();
    }

    public function getUserById($id)
    {
        $stmt = $this->db->prepare('SELECT * FROM User WHERE id = ?');
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function login($mail, $password)
    {
        $stmt = $this->db->prepare('SELECT id, mail, mdp FROM User WHERE mail = ?');
        $stmt->execute([$mail]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['mdp'])) {
            return $user;
        }
        return false;
    }

    public function register($firstname, $lastname, $mail, $password, $gender, $city, $hobbies, $birthday)
    {
        if ($this->checkIfUserExists($mail)) {
            return 'L’utilisateur existe déjà.';
        }

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $this->db->prepare('
            INSERT INTO User (firstname, lastname, mail, mdp, gender, city, hobbies, birthday) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)
        ');
        return $stmt->execute([$firstname, $lastname, $mail, $hashedPassword, $gender, $city, $hobbies, $birthday]);
    }

    private function checkIfUserExists($mail)
    {
        $stmt = $this->db->prepare('SELECT id FROM User WHERE mail = ?');
        $stmt->execute([$mail]);
        return $stmt->rowCount() > 0;
    }

    public function updateUser($id, $firstname, $lastname, $mail, $gender, $city, $hobbies, $birthday)
    {
        $sql = "UPDATE User SET firstname = ?, lastname = ?, mail = ?, gender = ?, city = ?, hobbies = ?, birthday = ? WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$firstname, $lastname, $mail, $gender, $city, $hobbies, $birthday, $id]);
    }
}
