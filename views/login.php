<?php
session_start();

require_once __DIR__ . '/../models/Database.php';
require_once __DIR__ . '/../models/User.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['mail'], $_POST['password'])) {
    $userModel = new User(Database::getInstance());

    //je recup le mail et mdp de l'user
    $user = $userModel->login($_POST['mail'], $_POST['password']);

    if ($user) {
        $_SESSION['auth'] = true;
        $_SESSION['id'] = $user['id'];
        $_SESSION['firstname'] = $user['firstname'];
        header('Location: index.php');
        exit();
    } else {
        $_SESSION['errormsg'] = 'Email ou mdp incorrect.';
    }
}
?>

<!DOCTYPE html>
<html lang="fr">

<?php include __DIR__ . '/../includes/head.php'; ?>
<link rel="stylesheet" href="../styles/login.css">


<body>
    <div class="container">
        <h1>Connexion</h1>

        <?php if (isset($_SESSION['errormsg'])): ?>
            <p class="error"><?= htmlspecialchars($_SESSION['errormsg']); unset($_SESSION['errormsg']); ?></p>
        <?php endif; ?>

        <form action="login.php" method="POST">
            <div>
                <label for="mail">Email</label>
                <input type="email" name="mail" id="mail" required>
            </div>
            <div>
                <label for="password">Mot de passe</label>
                <input type="password" name="password" id="password" required>
            </div>
            <div>
                <button type="submit">Se connecter</button>
                <p>Pas de compte Afrika ? <a href="signup.php">Inscris-toi ici !</a></p>
            </div>
        </form>
    </div>

</body>

</html>
