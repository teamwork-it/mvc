<?php


function connect(string $username, string $pass)
{
    try {
        $pdo = new PDO("mysql:host=localhost;dbname=coda_school;charset=utf8", 'root', '0000');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        die("Erreur de connexion : " . $e->getMessage());
    }

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $query="SELECT *  FROM users WHERE (username = :username OR email = :username)";
    $prep = $pdo->prepare($query);
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
