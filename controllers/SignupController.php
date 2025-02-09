<?php
require_once __DIR__ . '/../models/User.php';

class SignupController {
    public function signup() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $errormsg = '';

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (
                !empty($_POST['lastname']) &&
                !empty($_POST['firstname']) && 
                !empty($_POST['mail']) && 
                !empty($_POST['password']) && 
                !empty($_POST['gender']) && 
                !empty($_POST['city']) &&
                !empty($_POST['birthday'])
            ) {
                $lastname = htmlspecialchars($_POST['lastname']);
                $firstname = htmlspecialchars($_POST['firstname']);
                $mail = htmlspecialchars($_POST['mail']);
                $password = $_POST['password'];
                $gender = htmlspecialchars($_POST['gender']);
                $city = htmlspecialchars($_POST['city']);
                $hobbies = !empty($_POST['hobbies']) ? htmlspecialchars($_POST['hobbies']) : null;
                $birthday = htmlspecialchars($_POST['birthday']);

                $userModel = new User(Database::getInstance());
                $result = $userModel->register($mail, $firstname, $lastname, $password, $gender, $city, $hobbies, $birthday);

                if ($result === true) {
                    header('Location: ../index.php');
                    exit;
                } else {
                    $errormsg = $result;
                }
            } else {
                $errormsg = 'Veuillez remplir tous les champs obligatoires.';
            }
        }

        require_once __DIR__ . '/../views/signup.php';
    }
}
?>
