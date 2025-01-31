<?php
require('Actions/Database.php');

class User
{
    private $bdd;

    public function __construct($bdd)
    {
        $this->bdd = $bdd;
    }

    public function register($mail, $firstname, $lastname, $password, $gender, $city, $hobbies, $birthday)
    {
        try {
            if ($this->checkIfUserExists($mail)) {
                return 'L’utilisateur existe déjà.';
            }

            //inserer lutilisateur avec toute les infos
            $this->insertUser($mail, $firstname, $lastname, $password, $gender, $city, $hobbies, $birthday);

            //recup les infos de l'utilisateur
            $userInfos = $this->getUserInfos($firstname, $lastname, $mail, $gender);
            $this->authenticateUser($userInfos);

            header('Location: index.php');
        } catch (PDOException $e) {
            return 'Erreur lors de l’inscription : ' . $e->getMessage();
        }
    }

    private function checkIfUserExists($mail)
    {

        $checkIfAlreadyExists = $this->bdd->prepare('SELECT mail FROM User WHERE mail = ?');
        $checkIfAlreadyExists->execute([$mail]);
        return $checkIfAlreadyExists->rowCount() > 0;
    }

    private function insertUser($mail, $firstname, $lastname, $password, $gender, $city, $hobbies, $birthday)
    {
        $insertUserOnWebsite = $this->bdd->prepare('
            INSERT INTO User (mail, firstname, lastname, mdp, gender, city, hobbies, birthday)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)
        ');
        $insertUserOnWebsite->execute([$mail, $firstname, $lastname, $password, $gender, $city, $hobbies, $birthday]);
    }

    private function getUserInfos($firstname, $lastname, $mail, $gender)
    {
        $getInfosOfThisUserReq = $this->bdd->prepare('SELECT id, firstname, lastname, mail, gender FROM User WHERE firstname = ? AND lastname = ? AND mail = ? AND gender = ?');
        $getInfosOfThisUserReq->execute([$firstname, $lastname, $mail, $gender]);
        return $getInfosOfThisUserReq->fetch();
    }

    private function authenticateUser($userInfos)
    {
        //authentifier lutilisateur
        
        $_SESSION['auth'] = true;
        $_SESSION['id'] = $userInfos['id'];
        $_SESSION['firstname'] = $userInfos['firstname'];
        $_SESSION['mail'] = $userInfos['mail'];
        $_SESSION['lastname'] = $userInfos['lastname'];
        $_SESSION['gender'] = $userInfos['gender'];
    }
}

if (isset($_POST['validate'])) {
    if (!empty($_POST['mail']) && !empty($_POST['firstname']) && !empty($_POST['lastname']) &&
        !empty($_POST['password']) && !empty($_POST['gender']) && !empty($_POST['city']) &&
        !empty($_POST['birthday'])) {

        $mail = htmlspecialchars($_POST['mail']);
        $firstname = htmlspecialchars($_POST['firstname']);
        $lastname = htmlspecialchars($_POST['lastname']);
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $gender = htmlspecialchars($_POST['gender']);
        $city = htmlspecialchars($_POST['city']);
        $hobbies = !empty($_POST['hobbies']) ? htmlspecialchars($_POST['hobbies']) : null;
        $birthday = htmlspecialchars($_POST['birthday']);

        $user = new User($bdd);
        $errormsg = $user->register($mail, $firstname, $lastname, $password, $gender, $city, $hobbies, $birthday);


    } else {
        $errormsg = 'Veuillez remplir tous les champs obligatoires.';
    }
}
?>