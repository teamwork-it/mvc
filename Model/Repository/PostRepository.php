<?php
Class PostRepository {
    public function getAll()
    {
        $pdo = Database::getInstance();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $query="SELECT *  FROM post";
        $prep = $pdo->prepare($query);
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

        return $res;
    }
}