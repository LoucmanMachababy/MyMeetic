<?php
require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../models/Database.php';

class LoginController
{
    public function login()
    {
        session_start();

        if (!isset($_SESSION['errormsg'])) {
            $_SESSION['errormsg'] = '';
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['mail'], $_POST['password'])) {
            $userModel = new User(Database::getInstance());
            $user = $userModel->login($_POST['mail'], $_POST['password']);

            if ($user) {
                // Authentification réussie
                $_SESSION['auth'] = true;
                $_SESSION['id'] = $user['id'];
                $_SESSION['firstname'] = $user['firstname']; // Ajout du prénom à la session

                header('Location: /index.php'); 
                exit();
            } else {
                $_SESSION['errormsg'] = 'Email ou mot de passe incorrect.';
            }
        }

        include __DIR__ . '/../views/login.php';
    }
}

if ($_SERVER['SCRIPT_FILENAME'] === __FILE__) {
    $controller = new LoginController();
    $controller->login();
}