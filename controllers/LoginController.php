<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once 'models/Database.php';
require_once 'models/User.php';

class LoginController
{
    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['mail'], $_POST['password'])) {
            $userModel = new User(Database::getInstance());
            $user = $userModel->login($_POST['mail'], $_POST['password']);

            if ($user) {
                $_SESSION['auth'] = true;
                $_SESSION['id'] = $user['id'];
                $_SESSION['firstname'] = $user['firstname']; 
                header('Location: index.php'); 
                exit();
            } else {
                $_SESSION['errormsg'] = 'Email ou mot de passe incorrect.';
                header('Location: login.php');
                exit();
            }
        }
    }
}

$loginController = new LoginController();
$loginController->login();
