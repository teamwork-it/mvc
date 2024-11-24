<?php
require ("./Model/Repository/UserRepository.php");
require ("./Model/Entity/User.php");
class UserController
{
    private $userRepository;
    public $errors = [];
    public $action = null;

    public function __construct()
    {
        $this->userRepository = new UserRepository();
        $this->errors = [];
    }

    public function list()
    {
        $users = $this->userRepository->getAll();
        if(!is_array($users)) {
            $this->errors[] = $users;
        }
        require "./View/Users.php";
    }

    public function edit(int $id)
    {
        $user = $this->userRepository->get($id);
        $this->action = 'edit';
        if(!is_object($user)) {
            $this->errors[] = $user;
        }
        require "./View/User.php";
    }

    public function create()
    {
        $this->action = 'create';
        require "./View/User.php";
    }

    public function update(int $id)
    {
        $id = cleanString($_GET['id']);
        $username = !empty($_POST['username']) ? cleanString($_POST['username']) : null;
        $password = !empty($_POST['pass']) ? cleanString($_POST['pass']) : null;
        $confirmation = !empty($_POST['confirmation']) ? cleanString($_POST['confirmation']) : null;
        $email = !empty($_POST['email']) ? cleanString($_POST['email']) : null;
        $enabled = !empty($_POST['enabled']) ? cleanString($_POST['enabled']) : false;
        if (!empty($password) && !empty($confirmation) && ($password === $confirmation)) {
            $password = password_hash($password, PASSWORD_DEFAULT);
        } elseif(!empty($password) && !empty($confirmation) && ($password !== $confirmation)) {
            $this->errors[] = "Le mot de passe et sa confirmation sont différents";
        }

        if(empty($this->errors)) {
            $user = new User();
            $user->setId($id);
            $user->setEmail($email);
            $user->setUsername($username);
            $user->setEnabled($enabled);
            $user->setPassword($password);
            $updateResult = $this->userRepository->update($user);
            if (!is_bool($updateResult)) {
                $this->errors[] = $updateResult;
            } else {
                 $user = $this->userRepository->get($id);
            }

            require "./View/User.php";
        }

    }

    public function insert()
    {
        $username = !empty($_POST['username']) ? cleanString($_POST['username']) : null;
        $password = !empty($_POST['pass']) ? cleanString($_POST['pass']) : null;
        $confirmation = !empty($_POST['confirmation']) ? cleanString($_POST['confirmation']) : null;
        $email = !empty($_POST['email']) ? cleanString($_POST['email']) : null;
        $enabled = !empty($_POST['enabled']) ? cleanString($_POST['enabled']) : false;
        if ($password !== $confirmation) {
            $this->errors[] = "Le mot de passe et sa confirmation sont différents";
        } else {
            $password = password_hash($password, PASSWORD_DEFAULT);
            $user = new User();
            $user->setEmail($email);
            $user->setUsername($username);
            $user->setEnabled($enabled);
            $user->setPassword($password);
            $newUser =  $this->userRepository->create($user);
            if (!is_bool($newUser)) {
                $this->errors[] = $newUser;
                require "./View/User.php";
            } else {
                $this->list();
            }
        }
    }
}
