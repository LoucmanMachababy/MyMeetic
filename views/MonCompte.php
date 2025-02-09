<?php
session_start();
require_once __DIR__ . '/../models/Database.php';
require_once __DIR__ . '/../models/User.php';

if (isset($_SESSION['auth']) && $_SESSION['auth'] === true) {
    $userModel = new User(Database::getInstance());
    $user = $userModel->getUserById($_SESSION['id']);
} else {
    header('Location: login.php'); 
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon Compte</title>
    <link rel="stylesheet" href="../styles/MonCompte.css">
</head>
<body>
    <?php include 'navbar.php'; ?>
    <h1>Mon compte</h1>

    <div class="profile-info">
        <p><strong>Prénom:</strong> <?= htmlspecialchars($user['firstname']) ?></p>
        <p><strong>Nom:</strong> <?= htmlspecialchars($user['lastname']) ?></p>
        <p><strong>Email:</strong> <?= htmlspecialchars($user['mail']) ?></p>
        <p><strong>Genre:</strong> <?= htmlspecialchars($user['gender']) ?></p>
        <p><strong>Ville:</strong> <?= htmlspecialchars($user['city']) ?></p>
        <p><strong>Hobbies:</strong> <?= htmlspecialchars($user['hobbies']) ?></p>
        <p><strong>Date de naissance:</strong> <?= htmlspecialchars($user['birthday']) ?></p>
        <a href="editprofil.php">Modifier mon profil</a>
    </div>

</body>
</html>
