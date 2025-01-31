<?php

require('Actions/Database.php');

if (isset($_POST['validate'])) {

    if (!empty($_POST['mail']) && !empty($_POST['password'])) {

        $mail = htmlspecialchars($_POST['mail']);
        $password = htmlspecialchars($_POST['password']);

        $checkUser = $bdd->prepare('SELECT mail, mdp FROM User WHERE mail = ?');
        $checkUser->execute(array($mail));

        if ($checkUser->rowCount() > 0) {
            $userInfos = $checkUser->fetch();
            if (password_verify($password, $userInfos['mdp'])) {

                $_SESSION['auth'] = true;
                $_SESSION['id'] = $userInfos['id'];
                $_SESSION['firstname'] = $userInfos['firstname'];
                $_SESSION['mail'] = $userInfos['mail'];
                $_SESSION['lastname'] = $userInfos['lastname'];
                $_SESSION['gender'] = $userInfos['gender'];
                header('Location: index.php'); 

            } else {
                $errormsg = 'Mot de passe incorrect...';
            }
        } else {
            $errormsg = 'Votre mail est incorrect...';
        }

    } else {
        $errormsg = 'Veuillez compléter tous les champs.';
    }
}
?>