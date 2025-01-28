<?php

class usersViewContr extends User {
    
    <?php
    require_once 'User.class.php';
    
    class usersViewContr extends User {
    
        // Exemple d'une méthode pour ajouter un utilisateur via un contrôleur
        public function addNewUser($lastname, $firstname, $birthday, $gender, $city, $mail, $password, $hobbies) {
            if (!$this->emailExists($mail)) {
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                $this->addUser($lastname, $firstname, $birthday, $gender, $city, $mail, $hashedPassword, $hobbies);
                return "Inscription réussie !";
            } else {
                return "L'utilisateur existe déjà.";
            }
        }
    }
    

}