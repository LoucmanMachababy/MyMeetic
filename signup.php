<?php require('Actions/SignupAction.php'); ?>
<!DOCTYPE html>
<html lang="en">
<?php include 'includes/head.php'; ?>
<body>

<form class="container" method="POST">

    <?php 
    if (isset($errormsg)) { 
        echo '<p>' . $errormsg . '</p>';
    } 
    ?>

    <section>
        <div class="mail-section">
            <h1>Inscription</h1>
            <label for="InputMail" class="form-label">E-mail :</label>
            <input type="email" class="form-control" id="EmailInput" name="mail" required>
        </div>

        <div class="firstname-section">
            <label for="Firstname" class="form-label">Prénom :</label>
            <input type="text" class="form-control" name="firstname" required>
        </div>

        <div class="lastname-section">
            <label for="Lastname" class="form-label">Nom :</label>
            <input type="text" class="form-control" name="lastname" required>
        </div>

        <div class="genre-section">
            <label for="SelectGender" class="form-label">Genre :</label>
            <select class="form-select" name="gender" required>
                <option value="Homme">Homme</option>
                <option value="Femme">Femme</option>
            </select>
        </div>

        <div class="hobbies-section">
            <label for="hobbies" class="form-label">Hobbies :</label>
            <input type="text" class="form-control" name="hobbies">
        </div>

        <div class="city-section">
            <label for="text" class="form-label">Ville :</label>
            <input type="text" class="form-control" name="city" required>
        </div>

        <div class="birthday-section">
            <label for="date" class="form-label">Date de naissance : </label>
            <input type="date" class="form-control" name="birthday" required>
        </div>

        <div class="password-section">
            <label for="Password" class="form-label">Mot de passe :</label>
            <input type="password" class="form-control" name="password" required>
        </div>

        <button type="submit" class="btn btn-primary" name="validate">S'inscrire</button>
    </section>

</form>

</body>
</html>
