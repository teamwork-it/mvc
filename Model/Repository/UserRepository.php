<?php
class UserRepository
{
    private $pdo = null;

    public function __construct()
    {
        $this->pdo = Database::getInstance();
    }
    public function getAll(): array | string
    {
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $query="SELECT *  FROM users ORDER BY username LIMIT 10";
        $prep = $this->pdo->prepare($query);
        try
        {
            $prep->execute();
        }
        catch (PDOException $e)
        {
            return " erreur : ".$e->getCode() .' :</b> '. $e->getMessage();
        }

        $res = $prep->fetchAll(PDO::FETCH_OBJ);
        $prep->closeCursor();

        if ($res) {
            $users = [];
            foreach($res as $user) {
                $users[] = $this->createUserFromDatabase($user);
            }
        }

        return $users;
    }

    public function get($id): User | string |null
    {
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $query="SELECT *  FROM users WHERE id = :id";
        $prep = $this->pdo->prepare($query);
        $prep->bindValue(':id', $id, PDO::PARAM_INT);
        try
        {
            $prep->execute();
        }
        catch (PDOException $e)
        {
            return " erreur : ".$e->getCode() .' :</b> '. $e->getMessage();
        }

        $res = $prep->fetch(PDO::FETCH_OBJ);
        $prep->closeCursor();

        if($res) {
            return $this->createUserFromDatabase($res);
        }

        return null;
    }

    private function createUserFromDatabase(object $res): User
    {
        $user = new User();
        $user->setId($res->id);
        $user->setUsername($res->username);
        $user->setEnabled($res->enabled);
        $user->setEmail($res->email);

        return $user;
    }

    public function create(User $user)
    {
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $query="INSERT INTO users (username, password, email, enabled) VALUES (:username, :password, :email, :enabled)";
        $prep = $this->pdo->prepare($query);
        $prep->bindValue(':password', $user->getPassword());
        $prep->bindValue(':username', $user->getUsername());
        $prep->bindValue(':email', $user->getEmail());
        $prep->bindValue(':enabled', $user->getEnabled(), PDO::PARAM_BOOL);
        try
        {
            $prep->execute();
        }
        catch (PDOException $e)
        {
            return " erreur : ".$e->getCode() .' :</b> '. $e->getMessage();
        }
        $prep->closeCursor();

        return true;
    }

    public function update(User $user)
    {
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $query="UPDATE users SET username = :username, email = :email, enabled = :enabled WHERE id = :id";
        $prep = $this->pdo->prepare($query);
        $prep->bindValue(':id', $user->getId(), PDO::PARAM_INT);
        $prep->bindValue(':username', $user->getUsername());
        $prep->bindValue(':email', $user->getEmail());
        $prep->bindValue(':enabled', $user->getEnabled(), PDO::PARAM_BOOL);
        try
        {
            $prep->execute();
        }
        catch (PDOException $e)
        {
            return " erreur : ".$e->getCode() .' :</b> '. $e->getMessage();
        }
        $prep->closeCursor();

        if (null !== $user->getPassword()) {
            $query="UPDATE users SET password = :password WHERE id = :id";
            $prep = $this->pdo->prepare($query);
            $prep->bindValue(':id', $user->getId(), PDO::PARAM_INT);
            $prep->bindValue(':password', $user->getPassword());
            try
            {
                $prep->execute();
            }
            catch (PDOException $e)
            {
                return " erreur : ".$e->getCode() .' :</b> '. $e->getMessage();
            }
            $prep->closeCursor();
        }


        return true;
    }
}

