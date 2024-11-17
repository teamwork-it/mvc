<?php
function getUser(int $id): array | string
{
    try {
        $pdo = new PDO("mysql:host=localhost;dbname=coda_school;charset=utf8", 'root', '0000');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        die("Erreur de connexion : " . $e->getMessage());
    }

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $query="SELECT *  FROM users WHERE id = :id";
    $prep = $pdo->prepare($query);
    $prep->bindValue(':id', $id, PDO::PARAM_INT);
    try
    {
        $prep->execute();
    }
    catch (PDOException $e)
    {
        return " erreur : ".$e->getCode() .' :</b> '. $e->getMessage();
    }

    $res = $prep->fetch();
    $prep->closeCursor();

    return $res;
}

function insertUser(
    string $username,
    string $pass,
    string $email,
    bool $enabled
): bool | string
{
    try {
        $pdo = new PDO("mysql:host=localhost;dbname=coda_school;charset=utf8", 'root', '0000');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        die("Erreur de connexion : " . $e->getMessage());
    }

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $query="INSERT INTO users (username, password, email, enabled) VALUES (:username, :password, :email, :enabled)";
    $prep = $pdo->prepare($query);
    $prep->bindValue(':password', $pass);
    $prep->bindValue(':username', $username);
    $prep->bindValue(':email', $email);
    $prep->bindValue(':enabled', $enabled, PDO::PARAM_BOOL);
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

function updateUser(
    int $id,
    string $username,
    string $email,
    bool $enabled,
    ?string $pass = null,
): bool | string
{
    try {
        $pdo = new PDO("mysql:host=localhost;dbname=coda_school;charset=utf8", 'root', '0000');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        die("Erreur de connexion : " . $e->getMessage());
    }

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $query="UPDATE users SET username = :username, email = :email, enabled = :enabled WHERE id = :id";
    $prep = $pdo->prepare($query);
    $prep->bindValue(':id', $id, PDO::PARAM_INT);
    $prep->bindValue(':username', $username);
    $prep->bindValue(':email', $email);
    $prep->bindValue(':enabled', $enabled, PDO::PARAM_BOOL);
    try
    {
        $prep->execute();
    }
    catch (PDOException $e)
    {
        return " erreur : ".$e->getCode() .' :</b> '. $e->getMessage();
    }
    $prep->closeCursor();

    if (null !== $pass) {
        $query="UPDATE users SET password = :password WHERE id = :id";
        $prep = $pdo->prepare($query);
        $prep->bindValue(':id', $id, PDO::PARAM_INT);
        $prep->bindValue(':password', $pass);
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