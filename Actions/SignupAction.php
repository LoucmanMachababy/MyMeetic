<?php
require('Actions/Database.php'); 

if (isset($_POST['validate'])) {


    if (!empty($_POST['mail']) && !empty($_POST['firstname']) && !empty($_POST['lastname']) && 
        !empty($_POST['password']) && !empty($_POST['gender']) && !empty($_POST['city']) && 
        !empty($_POST['birthday'])) {

        $mail = htmlspecialchars($_POST['mail']);
        $firstname = htmlspecialchars($_POST['firstname']);
        $lastname = htmlspecialchars($_POST['lastname']);
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $gender = htmlspecialchars($_POST['gender']);
        $city = htmlspecialchars($_POST['city']);
        $hobbies = !empty($_POST['hobbies']) ? htmlspecialchars($_POST['hobbies']) : null;
        $birthday = htmlspecialchars($_POST['birthday']);

        try {

            $checkIfAlreadyExists = $bdd->prepare('SELECT mail FROM User WHERE mail = ?');
            $checkIfAlreadyExists->execute([$mail]);

            if ($checkIfAlreadyExists->rowCount() == 0) {

                $insertUserOnWebsite = $bdd->prepare('
                    INSERT INTO User (mail, firstname, lastname, mdp, gender, city, hobbies, birthday)
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?)
                ');

                $insertUserOnWebsite->execute([$mail, $firstname, $lastname, $password, $gender, $city, $hobbies, $birthday]);

                $successMsg = 'Inscription réussie !';
            } else {
                $errormsg = 'L’utilisateur existe déjà.';
            }

        } catch (PDOException $e) {
            $errormsg = 'Erreur lors de l’inscription : ' . $e->getMessage();
        }

    } else {
        $errormsg = 'Veuillez remplir tous les champs obligatoires.';
    }
}
?>
