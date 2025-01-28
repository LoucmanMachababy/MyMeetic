<?php
if (isset($_POST['validate'])) {

    $mail = htmlspecialchars($_POST['mail']);
    $firstname = htmlspecialchars($_POST['firstname']);
    $lastname = htmlspecialchars($_POST['lastname']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $gender = htmlspecialchars($_POST['SelectGender']);

    $checkIfMailAlreadyExists = $bdd->prepare('SELECT mail FROM users WHERE mail = ?');
    $checkIfMailAlreadyExists->execute(array($mail));


    if($checkIfMailAlreadyExists)->rowCount() == 0 {

        $insertUseONWebsite = $bdd->prepare('INSERT INTO users(lastname, firstname, gender, mail, password) VALUES (?, ?, ?, ?, ?) ');
        $insertUseONWebsite->execute(array($lastname, $firstname, $gender, $mail ));

    } else {

        $errormsg = 'Lutilisateur existe déjà sur le site';

    }

    // if (!empty($mail) && !empty($firstname) && !empty($lastname) && !empty($password) && !empty($gender)) {
    //     $errormsg = "Inscription réussie !";
    // } else {
    //     $errormsg = "Veuillez remplir tous les champs.";
    // }
}
?>
