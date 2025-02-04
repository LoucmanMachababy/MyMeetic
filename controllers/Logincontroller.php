<?php
require_once '../models/User.php';

class LoginController {
    public function login() {
        session_start();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $userModel = new User(Database::getInstance());
            $user = $userModel->login($_POST['mail'], $_POST['password']);
            if ($user) {
                $_SESSION['auth'] = true;
                $_SESSION['id'] = $user['id'];

                header('Location: ../index.php');
                exit;
            } else {
                $errormsg = 'Email ou mot de passe incorrect...';
            }
        }
        require_once '../views/login.php';
    }
}
?>