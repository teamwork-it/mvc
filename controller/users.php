<?php
require "model/users.php";
    $users = getUsers();
    if(!is_array($users)) {
        $errors[] = $users;
    }
require "view/users.php";
