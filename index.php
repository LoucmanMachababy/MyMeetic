<?php
// Inclure la classe Database et User
require_once 'models/Database.php';
require_once 'models/User.php';

// Récupérer les utilisateurs
try {
    $userModel = new User(Database::getInstance());

    // Récupérer tous les utilisateurs
    $users = $userModel->getAllUsers();
} catch (Exception $e) {
    die("Erreur lors de la récupération des utilisateurs: " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="fr">
<?php include 'includes/head.php'; ?>

<body>
    <?php include 'includes/navbar.php'; ?>

    <div class="container">
        <h1>Rencontrez des utilisateurs</h1>

        <div class="profiles">
            <?php if (!empty($users)): ?>
                <?php foreach ($users as $user): ?>
                    <div class="profile-card">
                        <h2><?= htmlspecialchars($user['firstname']) ?> <?= htmlspecialchars($user['lastname']) ?></h2>
                        <p>Date de naissance: <?= htmlspecialchars($user['birthday']) ?></p>
                        <p>Genre: <?= htmlspecialchars($user['gender']) ?></p>
                        <p>Ville: <?= htmlspecialchars($user['city']) ?></p>
                        <p>Email: <?= htmlspecialchars($user['mail']) ?></p>
                        <p>Hobbies: <?= htmlspecialchars($user['hobbies'] ?? 'Non renseigné') ?></p>
                        <a href="chat.php?user_id=<?= htmlspecialchars($user['id']) ?>">Envoyer un message</a>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Aucun utilisateur trouvé.</p>
            <?php endif; ?>
        </div>
    </div>

</body>

</html>