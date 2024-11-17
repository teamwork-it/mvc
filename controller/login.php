<?php
require("model/login.php");

if(isset($_POST['valid_login'])) {
    $errors = [];
    $username = $_POST['username'] ?? null;
    $pass = $_POST['pass'] ?? null;

    if(null === $username || null === $pass) {
        $errors[] = "identifiant ou mot de passe vide";
    } else {
        $connexion = connect($username, $pass);

        if (empty($connexion) || !password_verify($pass, $connexion['password'])) {
            $errors[] = "Erreur d'identification, veuillez essayer à nouveau";
        } elseif(0 === $connexion['enabled']) {
            $errors[] = "Ce compte est désactivé";
        } else {
            $_SESSION["auth"] = true;
            $_SESSION["username"] = $connexion['username'];
            header("Location: index.php");
            exit();
        }
    }

}

require("view/login.php");