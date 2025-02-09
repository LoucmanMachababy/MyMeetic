<?php
session_start();
require_once __DIR__ . '/../models/Database.php';
require_once __DIR__ . '/../models/User.php';

if (!isset($_SESSION['auth']) || $_SESSION['auth'] !== true) {
    header('Location: login.php');
    exit();
}

$userModel = new User(Database::getInstance());
$user = $userModel->getUserById($_SESSION['id']);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $firstname = $_POST['firstname'] ?? '';
    $lastname = $_POST['lastname'] ?? '';
    $mail = $_POST['mail'] ?? '';
    $gender = $_POST['gender'] ?? '';
    $city = $_POST['city'] ?? '';
    $hobbies = $_POST['hobbies'] ?? '';
    $birthday = $_POST['birthday'] ?? '';

    $userModel->updateUser($_SESSION['id'], $firstname, $lastname, $mail, $gender, $city, $hobbies, $birthday);

    header('Location: MonCompte.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier mon profil</title>
    <link rel="stylesheet" href="../styles/editprofil.css">
</head>
<body>
    <?php include 'navbar.php'; ?>
    <h1>Modifier mon profil</h1>

    <div class="edit-profile-container">
        <form action="editprofil.php" method="POST">
            <label for="firstname">Prénom</label>
            <input type="text" name="firstname" value="<?= htmlspecialchars($user['firstname']) ?>" required>

            <label for="lastname">Nom</label>
            <input type="text" name="lastname" value="<?= htmlspecialchars($user['lastname']) ?>" required>

            <label for="mail">E-mail</label>
            <input type="email" name="mail" value="<?= htmlspecialchars($user['mail']) ?>" required>

            <label for="gender">Genre</label>
            <select name="gender">
                <option value="male" <?= $user['gender'] === 'male' ? 'selected' : '' ?>>Homme</option>
                <option value="female" <?= $user['gender'] === 'female' ? 'selected' : '' ?>>Femme</option>
                <option value="other" <?= $user['gender'] === 'other' ? 'selected' : '' ?>>Autre</option>
            </select>

            <label for="city">Ville</label>
            <input type="text" name="city" value="<?= htmlspecialchars($user['city']) ?>" required>

            <label for="hobbies">Loisirs</label>
            <input type="text" name="hobbies" value="<?= htmlspecialchars($user['hobbies']) ?>" required>

            <label for="birthday">Date de naissance</label>
            <input type="date" name="birthday" value="<?= htmlspecialchars($user['birthday']) ?>" required>

            <button type="submit">Enregistrer</button>
        </form>
    </div>
</body>
</html>
