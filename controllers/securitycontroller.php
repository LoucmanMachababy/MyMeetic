<?php
class SecurityController {
    public function checkAuth() {
        session_start();
        if (!isset($_SESSION['auth'])) {
            header('Location: ../views/login.php');
        }
    }
}