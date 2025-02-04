<?php
require_once '../controllers/LoginController.php';
?>
<!DOCTYPE html>
<html lang="en">
<?php include 'includes/head.php'; ?>

<form method="POST">
<?php if (isset($errormsg)) echo '<p>' . $errormsg . '</p>'; ?>

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
            <a href="signup.php"><p>Je n'ai pas de compte, je m'inscris !</p></a>
        </section>

    </form>

</body>
</html>