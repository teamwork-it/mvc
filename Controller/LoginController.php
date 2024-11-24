<?php
require ("./Model/Repository/LoginRepository.php");
class LoginController
{
    private $loginRepository;
    public $errors = [];


    public function __construct()
    {
        $this->loginRepository = new LoginRepository();
        $this->errors = [];
    }

    public function login ()
    {
        if (isset($_POST['valid_login'])) {
            $username = $_POST['username'] ?? null;
            $pass = $_POST['pass'] ?? null;

            if(null === $username || null === $pass) {
                $this->errors[] = "identifiant ou mot de passe vide";
            } else {
                $connexion = $this->loginRepository->connect($username, $pass);

                if (empty($connexion) || !password_verify($pass, $connexion['password'])) {
                    $this->errors[] = "Erreur d'identification, veuillez essayer à nouveau";
                } elseif(0 === $connexion['enabled']) {
                    $this->errors[] = "Ce compte est désactivé";
                } else {
                    $_SESSION["auth"] = true;
                    $_SESSION["username"] = $connexion['username'];
                    header("Location: index.php");
                    exit();
                }
            }
        }


        require "./View/Login.php";
    }
}