<?php
$action = $_GET['action'] ?? 'login';

switch($action) {
    case 'login':
        require 'controllers/LoginController.php';
        $controller = new LoginController();
        $controller->login();
        break;
    case 'signup':
        require '../controllers/SignupController';
        $controller = new SignupController();
        $controller->signup();
        break;
    default:
        header('Location: ?action=login');
        exit;
}
?>