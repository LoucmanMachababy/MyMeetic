<?php
session_start();
$errormsg = $_SESSION['errormsg'] ?? '';
unset($_SESSION['errormsg']);

require_once __DIR__ . '/../controllers/LoginController.php';
$loginController = new LoginController();
$loginController->login();
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
</head>

<body>
    <form method="POST">
        <?php
        if (!empty($errormsg)) {
            echo '<p class="error-message">' . htmlspecialchars($errormsg) . '</p>';
        }
        ?>

        <section>
            <div class="mail-section">
                <h1>Connexion</h1>
                <label for="InputMail" class="form-label">E-mail :</label>
                <input type="email" class="form-control" id="EmailInput" name="mail" required>
            </div>

            <div class="password-section">
                <label for="Password" class="form-label">Mot de passe :</label>
                <input type="password" class="form-control" name="password" required>
            </div>

            <button type="submit" class="btn btn-primary" name="validate">Se connecter</button>
            <a href="signup.php">
                <p>Je n'ai pas de compte, je m'inscris !</p>
            </a>
        </section>
    </form>
</body>

</html>