<?php
    session_start();
    require ("./Model/Database.php");
    require ("./Includes/helper.php");
    require("./Controller/PostController.php");
    require("./Controller/UserController.php");
    require("./Controller/LoginController.php");

    if(isset($_GET['deconnect'])) {
        session_destroy();
        header("Location: index.php");
        exit();
    }
?>
<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Mon App</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    </head>
    <body>
        <div class="container-fluid pt-1">
            <?php
                if(!empty($_SESSION['auth'])) {
                require "_partials/_navbar.php";
                    $controlerName = !empty($_GET['component'])
                    ? ucfirst(htmlspecialchars($_GET['component'], ENT_QUOTES, 'UTF-8')) . "Controller"
                    : 'UserController';

                    $actionName = !empty($_GET['action'])
                        ? htmlspecialchars($_GET['action'], ENT_QUOTES, 'UTF-8')
                        : 'list';

                    $subjectId = !empty($_GET['id'])
                        ? htmlspecialchars($_GET['id'], ENT_QUOTES, 'UTF-8')
                        : null;

                    if (class_exists($controlerName)) {
                        $controller = new $controlerName();
                        $controller->$actionName($subjectId);
                    } else {
                        throw new Exception("Class '$controlerName' does not exist");
                    }
                } else {
                    $loginController = new LoginController();
                    $loginController->login();
                }
            ?>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    </body>
</html>