<?php
session_start();
require_once __DIR__ . '/../models/Database.php';
require_once __DIR__ . '/../models/User.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //Récupérer les valeurs du form
    $firstname = $_POST['firstname'] ?? '';
    $lastname = $_POST['lastname'] ?? '';
    $mail = $_POST['mail'] ?? '';
    $password = $_POST['password'] ?? '';
    $gender = $_POST['gender'] ?? '';
    $city = $_POST['city'] ?? '';
    $hobbies = $_POST['hobbies'] ?? '';
    $birthday = $_POST['birthday'] ?? '';

    if (empty($firstname) || empty($lastname) || empty($mail) || empty($password) || empty($gender) || empty($city) || empty($hobbies) || empty($birthday)) {
        echo "Tous les champs sont requis.";
        exit();
    }

    $userModel = new User(Database::getInstance());
    $result = $userModel->register($firstname, $lastname, $mail, $password, $gender, $city, $hobbies, $birthday);

    if ($result === true) {
        header('Location: login.php');
        exit();
    } else {
        echo "Erreur : " . $result;
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <?php include __DIR__ . '/../includes/head.php'; ?>
    <link rel="stylesheet" href="../styles/signup.css">
</head>
<body>

    <form action="signup.php" method="POST">
        <label for="firstname">Prénom</label>
        <input type="text" name="firstname" required><br>

        <label for="lastname">Nom</label>
        <input type="text" name="lastname" required><br>

        <label for="mail">E-mail</label>
        <input type="email" name="mail" required><br>

        <label for="password">Mot de passe</label>
        <input type="password" name="password" required><br>

        <label for="gender">Genre</label>
        <select name="gender">
            <option value="male">Homme</option>
            <option value="female">Femme</option>
            <option value="other">Autre</option>
        </select><br>

        <label for="city">Ville</label>
        <input type="text" name="city" required><br>

        <label for="hobbies">Loisirs</label>
        <input type="text" name="hobbies" required><br>

        <label for="birthday">Date de naissance</label>
        <input type="date" name="birthday" required><br>

        <button type="submit">S'inscrire</button>
        <div>
            <p>Déjà inscrit ? <a href="login.php">Connecte-toi ici !</a></p>
        </div>
    </form>

</body>
</html>
