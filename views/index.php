<?php
session_start();
require_once __DIR__ . '/../models/Database.php';
require_once __DIR__ . '/../models/User.php';

// je verieifi si l'utilisateur est connecté
if (isset($_SESSION['auth']) && $_SESSION['auth'] === true) {
    $userModel = new User(Database::getInstance());
    $currentUserId = $_SESSION['id'];
    $users = $userModel->getAllUsers();
    $filteredUsers = array_filter($users, function ($user) use ($currentUserId) {
        return $user['id'] !== $currentUserId;
    });
    $filteredUsers = array_values($filteredUsers);
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
    <title>Accueil</title>
    <link rel="stylesheet" href="../styles/index.css">
</head>

<body>
    <?php include __DIR__ . '/navbar.php'; ?>
    <h1>Tchattez Maintenant !</h1>

    <div class="container">
        <?php foreach ($filteredUsers as $user): ?>
            <div class="user-card">
                <p>Prénom: <?= htmlspecialchars($user['firstname']) ?></p>
                <p>Nom: <?= htmlspecialchars($user['lastname']) ?></p>
                <p>Email: <?= htmlspecialchars($user['mail']) ?></p>
                <p>Genre: <?= htmlspecialchars($user['gender']) ?></p>
                <p>Ville: <?= htmlspecialchars($user['city']) ?></p>
                <p>Hobbies: <?= htmlspecialchars($user['hobbies']) ?></p>
                <p>Date de naissance: <?= htmlspecialchars($user['birthday']) ?></p>
                <form action="message.php" method="POST">
                    <button type="submit" name="user_id" value="<?= $user['id']; ?>">Envoyer un message</button>
                </form>
            </div>
        <?php endforeach; ?>
    </div>

</body>

</html>
