<?php
class LoginRepository
{
    private $pdo = null;

    public function __construct()
    {
        $this->pdo = Database::getInstance();
    }

    public function connect(string $username, string $pass)
    {

        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $query="SELECT *  FROM users WHERE (username = :username OR email = :username)";
        $prep = $this->pdo->prepare($query);
        $prep->bindValue(':username', $username, PDO::PARAM_STR);
        $prep->bindValue(':password', $pass, PDO::PARAM_STR);
        try
        {
            $prep->execute();
        }
        catch (PDOException $e)
        {
            $response = " erreur : ".$e->getCode() .' :</b> '. $e->getMessage();
        }
        $res = $prep->fetch();
        $prep->closeCursor();
        return $res;
    }
}

