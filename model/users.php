<?php
function getUsers(): array | string
{
    try {
        $pdo = new PDO("mysql:host=localhost;dbname=coda_school;charset=utf8", 'root', '0000');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        die("Erreur de connexion : " . $e->getMessage());
    }

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $query="SELECT *  FROM users ORDER BY username LIMIT 10";
    $prep = $pdo->prepare($query);
    try
    {
        $prep->execute();
    }
    catch (PDOException $e)
    {
        return " erreur : ".$e->getCode() .' :</b> '. $e->getMessage();
    }

    $res = $prep->fetchAll();
    $prep->closeCursor();

    return $res;
}