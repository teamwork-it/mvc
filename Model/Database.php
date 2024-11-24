<?php
class Database extends PDO {

    private static $_instance;

    /* Singleton */
    public static function getInstance() {

        if (!isset(self::$_instance)) {
            $connStr = 'mysql:host=localhost;dbname=coda_school'; //Ligne 1
            try {

                self::$_instance = new PDO($connStr, 'root', '0000');

            } catch (PDOException $e) {

                echo $e;
            }
        }
        return self::$_instance;
    }

}
?>
