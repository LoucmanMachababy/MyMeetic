<?php
require_once 'User.class.php';

class usersView extends User {

    public function displayUser($email) {
        $user = $this->getUserByEmail($email);
        if ($user) {
            echo "Nom : " . $user['lastname'] . "<br>";
            echo "Prénom : " . $user['firstname'] . "<br>";
            echo "Ville : " . $user['city'] . "<br>";
            echo "Genre : " . $user['gender'] . "<br>";
            echo "Hobbies : " . $user['hobbies'] . "<br>";
        } else {
            echo "Utilisateur introuvable.";
        }
    }
}
